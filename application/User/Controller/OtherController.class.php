<?php

/**
 * 其他功能
 */
namespace User\Controller;
use Common\Controller\MemberbaseController;
class OtherController extends MemberbaseController {
	
	function _initialize(){
		parent::_initialize();
	}

	public function scene() {
        $this->display(":scene");
    }
}