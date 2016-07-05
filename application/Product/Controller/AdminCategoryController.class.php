<?php
// +----------------------------------------------------------------------
// | Name : 分类模块
// +----------------------------------------------------------------------
// | Data : 2016.06.22
// +----------------------------------------------------------------------
// | Author: LiuCheng <echoshiki@outlook.com>
// +----------------------------------------------------------------------

namespace Product\Controller;
use Common\Controller\AdminbaseController;
class AdminCategoryController extends AdminbaseController {
	
	protected $categories_model;
	protected $taxonomys=array("article"=>"文章","picture"=>"图片");
	
	function _initialize() {
		parent::_initialize();
		$this->categories_model = D("Product/Categories");
		$this->assign("taxonomys",$this->taxonomys);
	}

	function index() {
		$result = $this->categories_model->order(array("listorder"=>"asc"))->select();
		$tree   = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminCategory/add", array("parent" => $r['category_id'])) . '">'.L('ADD_SUB_CATEGORY').'</a> | <a href="' . U("AdminCategory/edit", array("id" => $r['category_id'])) . '">'.L('EDIT').'</a> | <a class="js-ajax-delete" href="' . U("AdminCategory/delete", array("id" => $r['category_id'])) . '">'.L('DELETE').'</a> ';
			$url=U('product/list/index',array('id'=>$r['category_id']));
			$r['url'] = $url;
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id']=$r['category_id'];
			$r['parentid']=$r['parent'];
			$array[] = $r;
		}
		$tree->init($array);
		$str = "<tr>
					<td><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input input-order'></td>
					<td>\$id</td>
					<td>\$spacer <a href='\$url' target='_blank'>\$name</a></td>
	    			<td>\$taxonomys</td>
					<td>\$str_manage</td>
				</tr>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
		$this->display();
	}

	function add(){
	 	$parentid = intval(I("get.parent"));  
	 	$tree = new \Tree();

	 	$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
	 	$tree->nbsp = '&nbsp;&nbsp;&nbsp;';

	 	// 整理出树形分类列表
	 	$categories = $this->categories_model->order(array("path"=>"asc"))->select();	
	 	$new_categories = array();
	 	foreach ($categories as $r) {
	 		$r['id'] 	   = $r['category_id'];
	 		$r['parentid'] = $r['parent'];
	 		$r['selected'] = (!empty($parentid) && $r['category_id']==$parentid)? "selected":"";   // 如果是在某分类下添加子分类，则选中此分类
	 		$new_categories[] = $r;
	 	}
	 	$tree->init($new_categories);
	 	$tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
	 	$tree = $tree->get_tree(0,$tree_tpl);   // 输出分类树
	 	
	 	$this->assign("categories_tree",$tree);
	 	$this->assign("parent",$parentid);
	 	$this->display();
	}
	
	function add_post(){
		if (IS_POST) {
			if ($this->categories_model->create()) {
				if ($this->categories_model->add()!==false) {
				    F('all_categories',null);
					$this->success("添加成功！",U("AdminCategory/index"));
				} else {
					$this->error("添加失败！");
				}
			} else {
				$this->error($this->categories_model->getError());
			}
		}
	}

	function edit(){
		$id = intval(I("get.id"));
		$data = $this->categories_model->where(array("category_id" => $id))->find();   
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		// 筛选出除被编辑的分类外的其余分类列表，并进行树形结构化
		$categories = $this->categories_model->where(array("category_id" => array("NEQ",$id), "path"=>array("notlike","%-$id-%")))->order(array("path"=>"asc"))->select();
		$new_categories = array();
		foreach ($categories as $r) {
			$r['id'] = $r['category_id'];
			$r['parentid'] = $r['parent'];
			$r['selected'] = $data['parent']==$r['category_id']?"selected":"";
			$new_categories[] = $r;
		}
		$tree->init($new_categories);
		$tree_tpl = "<option value='\$id' \$selected>\$spacer\$name</option>";
		$tree = $tree->get_tree(0,$tree_tpl);
		
		$this->assign("categories_tree",$tree);
		$this->assign("data",$data);
		$this->display();
	}
	
	function edit_post(){
		if (IS_POST) {
			if ($this->categories_model->create()) {
				if ($this->categories_model->save()!==false) {
				    F('all_terms',null);
					$this->success("修改成功！");
				} else {
					$this->error("修改失败！");
				}
			} else {
				$this->error($this->categories_model->getError());
			}
		}
	}

	//排序
	public function listorders() {
		$status = parent::_listorders($this->categories_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	/**
	 *  删除
	 */
	public function delete() {
		$id = intval(I("get.id"));
		$count = $this->categories_model->where(array("parent" => $id))->count();
		
		if ($count > 0) {
			$this->error("该菜单下还有子类，无法删除！");
		}
		
		if ($this->categories_model->delete($id)!==false) {
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
	}


}