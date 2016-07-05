<?php
namespace Product\Model;
use Common\Model\CommonModel;
class CategoriesModel extends CommonModel {

	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('name', 'require', '分类名称不能为空！', 1, 'regex', 3),
	);

	protected function _after_insert($data,$options){
		parent::_after_insert($data,$options);
		$category_id = $data['category_id'];
		$parent_id   = $data['parent'];
		if ($parent_id == 0) {
			$d['path']="0-$category_id";
		} else {
			$parent = $this->where("category_id=$parent_id")->find();
			$d['path'] = $parent['path'].'-'.$category_id;
		}
		$this->where("category_id = $category_id")->save($d);
	}
	
	protected function _after_update($data,$options){
		parent::_after_update($data,$options);
		if (isset($data['parent'])) {
			$category_id=$data['category_id'];
			$parent_id=$data['parent'];
			if ($parent_id==0) {
				$d['path']="0-$category_id";
			} else {
				$parent=$this->where("category_id=$parent_id")->find();
				$d['path']=$parent['path'].'-'.$category_id;
			}
			$result=$this->where("category_id=$category_id")->save($d);
			if ($result) {
				$children=$this->where(array("parent"=>$category_id))->select();
				foreach ($children as $child){
					$this->where(array("category_id"=>$child['category_id']))->save(array("parent"=>$category_id,"category_id"=>$child['category_id']));
				}
			}
		}
		
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
	

}