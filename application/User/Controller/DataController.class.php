<?php

/**
 * 会员数据分析
 */
namespace User\Controller;
use Common\Controller\MemberbaseController;
class DataController extends MemberbaseController {
	
	function _initialize(){
		parent::_initialize();
	}
    //会员中心
	public function index() {

    	$this->display(':data');
    }
}
