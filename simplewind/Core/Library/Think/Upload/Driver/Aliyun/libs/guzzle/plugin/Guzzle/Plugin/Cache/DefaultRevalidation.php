<?php

namespace Guzzle\Plugin\Cache;

use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\BadResponseException;

/**
 * Default revalidation strategy
 */
class DefaultRevalidation implements RevalidationInterface
{
    /** @var CacheStorageInterface Cache object storing cache data */
    protected $storage;

    /** @var CanCacheStrategyInterface */
    protected $canCache;

    /**
     * @param CacheStorageInterface     $cache    Cache storage
     * @param CanCacheStrategyInterface $canCache Determines if a message can be cached
     */
    public function __construct(CacheStorageInterface $cache, CanCacheStrategyInterface $canCache = null)
    {
        $this->storage = $cache;
        $this->canCache = $canCache ?: new DefaultCanCacheStrategy();
    }

    public function revalidate(RequestInterface $request, Response $response)
    {
        try {
            $revalidate = $this->createRevalidationRequest($request, $response);
            $validateResponse = $revalidate->send();
            if ($validateResponse->getStatusCode() == 200) {
                return $this->handle200Response($request, $validateResponse);
            } elseif ($validateResponse->getStatusCode() == 304) {
                return $this->handle304Response($request, $validateResponse, $response);
            }
        } catch (BadResponseException $e) {
            $this->handleBadResponse($e);
        }

        // Other exceptions encountered in the revalidation request are ignored
        // in hopes that sending a request to the origin server will fix it
        return false;
    }

    public function shouldRevalidate(RequestInterface $request, Response $response)
    {
        if ($request->getMethod() != RequestInterface::GET) {
            return false;
        }

        $reqCache = $request->getHeader('Cache-Control');
        $resCache = $response->getHeader('Cache-Control');

        $revalidate = $request->getHeader('Pragma') == 'no-cache' ||
            ($reqCache && ($reqCache->hasDirective('no-cache') || $reqCache->hasDirective('must-revalidate'))) ||
            ($resCache && ($resCache->hasDirective('no-cache') || $resCache->hasDirective('must-revalidate')));

        // Use the strong ETag validator if available and the response contains no Cache-Control directive
        if (!$revalidate && !$reqCache && $response->hasHeader('ETag')) {
            $revalidate = true;
        }

        return $revalidate;
    }

    /**
     * Handles a bad response when attempting to revalidate
     *
     * @param BadResponseException $e Exception encountered
     *
     * @throws BadResponseException
     */
    protected function handleBadResponse(BadResponseException $e)
    {
        // 404 errors mean the resource no longer exists, so remove from
        // cache, and prevent an additional request by throwi