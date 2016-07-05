<?php
namespace Product\Model;
use Common\Model\CommonModel;
class CategoryRelationshipsModel extends CommonModel {
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}

}