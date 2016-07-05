<?php
$configs = array(
    'TAGLIB_BUILD_IN' => THINKCMF_CORE_TAGLIBS . ',Product\Lib\Taglib\Product',
    'TMPL_TEMPLATE_SUFFIX' => '.html', // 默认模板文件后缀
    'TMPL_FILE_DEPR' => '/', // 模板文件MODULE_NAME与ACTION_NAME之间的分割符
    'HTML_CACHE_RULES' => array(
        // 定义静态缓存规则
        // 定义格式1 数组方式
        'article:index' => array('product/article/{id}',600),
        'index:index' => array('product/index',600),
        'list:index' => array('product/list/{id}_{p}',60)
    ),
    'BUSINESS_TYPE' => array('生产','销售','批发'),
    'TYPE' => array('供应','采购','招商合作')
);

return array_merge($configs);

