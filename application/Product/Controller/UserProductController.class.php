<?php
// +----------------------------------------------------------------------
// | Name : 产品模块 (用户界面)
// +----------------------------------------------------------------------
// | Data : 2016.06.28
// +----------------------------------------------------------------------
// | Author: LiuCheng <echoshiki@outlook.com>
// +----------------------------------------------------------------------

namespace Product\Controller;
use Common\Controller\MemberbaseController;

class UserProductController extends MemberbaseController {

	protected $products_model;
	protected $category_relationships_model;
	protected $categories_model;
	
	function _initialize() {
		parent::_initialize();
		$this->products_model   = D("Product/Products");
		$this->categories_model = D("Product/Categories");
		$this->category_relationships_model = D("Product/CategoryRelationships");
	}


	function index(){	
		$this->_lists();
		$this->_getTree();
		$this->display();
	}


	function add(){
		$categories  = $this->categories_model->order(array("listorder"=>"asc"))->select();
		$category_id = intval(I("get.category"));
		$this->_getCategoryTree();   
		$category = $this->categories_model->where("category_id=$category_id")->find();

		$this->assign("author","1");
		$this->assign("category",$category);
		$this->assign("categories",$categories);
		$this->display();
	}


	function add_post(){
		if (IS_POST) {
			if(empty($_POST['category'])){
				$this->error("请至少选择一个分类栏目！");
			}

			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}

			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			 
			$_POST['post']['date'] = date("Y-m-d H:i:s",time());
			$_POST['post']['author'] = 0;
			$_POST['post']['user']	= sp_get_current_userid();   // 客户id
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
			$article['content']=htmlspecialchars_decode($article['content']);
			$article['status']  = 0;   // 文章初始状态为未审核
			$result = $this->products_model->add($article);
			if ($result) {
				foreach ($_POST['category'] as $mcategory_id){
					$this->category_relationships_model->add(array("category_id"=>intval($mcategory_id),"object_id"=>$result));
				}
				
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
			 
		}
	}


	public function edit(){
		$id = intval(I("get.id"));
		$category_relationship = M('CategoryRelationships')->where(array("object_id"=>$id,"status"=>1))->getField("category_id",true);
		$this->_getCategoryTree($category_relationship);
		$categories = $this->categories_model->select();
		$product = $this->products_model->where("id=$id")->find();
		$this->assign("product",$product);
		$this->assign("smeta",json_decode($product['smeta'],true));
		$this->assign("categories",$categories);
		$this->assign("category",$category_relationship);
		$this->display();
	}


	public function edit_post(){
		if (IS_POST) {
			if(empty($_POST['category'])){
				$this->error("请至少选择一个分类栏目！");
			}
			$post_id = intval($_POST['post']['id']);
			$this->category_relationships_model->where(array("object_id"=>$post_id,"category_id"=>array("not in",implode(",", $_POST['category']))))->delete();
			foreach ($_POST['category'] as $mcategory_id){
				$find_category_relationship = $this->category_relationships_model->where(array("object_id"=>$post_id,"category_id"=>$mcategory_id))->count();
				if(empty($find_category_relationship)){
					$this->category_relationships_model->add(array("category_id"=>intval($mcategory_id),"object_id"=>$post_id));
				}else{
					$this->category_relationships_model->where(array("object_id"=>$post_id,"category_id"=>$mcategory_id))->save(array("status"=>1));
				}
			}
			
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl = sp_asset_relative_url($url);
					$_POST['smeta']['photo'][] = array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}

			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			unset($_POST['post']['author']);
			$article = I("post.post");
			$article['smeta'] = json_encode($_POST['smeta']);
			$article['content'] = htmlspecialchars_decode($article['content']);
			$result = $this->products_model->save($article);
			if ($result!==false) {
				$this->success("保存成功！");
			} else {
				$this->error("保存失败！");
			}
		}
	}


	private function _getCategoryTree($category = array(), $where = array()) {
		$result = $this->categories_model->where($where)->order(array("listorder"=>"asc"))->select();   //筛选出分类
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminCategory/add", array("parent" => $r['category_id'])) . '">添加子类</a> | <a href="' . U("AdminCategory/edit", array("id" => $r['category_id'])) . '">修改</a> | <a class="js-ajax-delete" href="' . U("AdminCategory/delete", array("id" => $r['category_id'])) . '">删除</a> ';
			$r['visit'] = "<a href='#'>访问</a>";
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id'] = $r['category_id'];
			$r['parentid'] = $r['parent'];
			$r['selected'] = in_array($r['category_id'], $category) ? "selected" : "";
			$r['checked'] = in_array($r['category_id'], $category) ? "checked" : "";
			$array[] = $r;
		}
		
		$tree->init($array);
		$str = "<option value='\$id' \$selected>\$spacer\$name</option>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
	}


	private  function _lists($status=1) {
		$category_id = 0;
		if(!empty($_REQUEST["category"])){
			$category_id = intval($_REQUEST["category"]);
			$category = $this->categories_model->where("category_id = $category_id")->find();
			$this->assign("category",$category);
			$_GET['category'] = $category_id;
		}
		
		$where_ands = empty($category_id) ? array("a.status=$status") : array("a.category_id = $category_id and a.status=$status");
		
		$fields = array(
				'start_time'=> array("field"=>"date","operator"=>">"),
				'end_time'  => array("field"=>"date","operator"=>"<"),
				'keyword'   => array("field"=>"title","operator"=>"like"),
		);

		if(IS_POST){
			foreach ($fields as $param =>$val){
				if (isset($_POST[$param]) && !empty($_POST[$param])) {
					$operator = $val['operator'];
					$field    = $val['field'];
					$get = $_POST[$param];
					$_GET[$param] = $get;
					if($operator == "like"){
						$get = "%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}else{
			foreach ($fields as $param => $val){
				if (isset($_GET[$param]) && !empty($_GET[$param])) {
					$operator = $val['operator'];
					$field    = $val['field'];
					$get = $_GET[$param];
					if($operator == "like"){
						$get = "%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}
		
		$where = join(" and ", $where_ands);		
		$where .= " and b.user = ".sp_get_current_userid();

		$count = $this->category_relationships_model
					  ->alias("a")
					  ->join(C ( 'DB_PREFIX' )."products b ON a.object_id = b.id")
					  ->where($where)
					  ->count();
			
		$page = $this->page($count, 20);
				
		$products = $this->category_relationships_model
					  ->alias("a")
					  ->join(C ( 'DB_PREFIX' )."products b ON a.object_id = b.id")
					  ->where($where)
					  ->limit($page->firstRow . ',' . $page->listRows)
					  ->order("a.listorder ASC,b.modified DESC")->select();
		$users_obj = M("Users");
		$users_data = $users_obj->field("id,user_login")->where("user_status=1")->select();
		$users = array();
		foreach ($users_data as $u){
			$users[$u['id']]=$u;
		}
		
    	$categories = $this->categories_model->order(array("category_id = $category_id"))->getField("category_id,name",true);
		$this->assign("users",$users);
    	$this->assign("categories",$categories);
		$this->assign("Page", $page->show('Admin'));
		$this->assign("current_page",$page->GetCurrentPage());
		unset($_GET[C('VAR_URL_PARAMS')]);
		$this->assign("formget",$_GET);
		$this->assign("products",$products);
	}


	private function _getTree(){
		$category_id = empty($_REQUEST['category']) ? 0 : intval($_REQUEST['category']);
		$result = $this->categories_model->order(array("listorder"=>"asc"))->select();
		
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminCategory/add", array("parent" => $r['category_id'])) . '">添加子类</a> | <a href="' . U("AdminCategory/edit", array("id" => $r['category_id'])) . '">修改</a> | <a class="js-ajax-delete" href="' . U("AdminCategory/delete", array("id" => $r['category_id'])) . '">删除</a> ';
			$r['visit'] = "<a href='#'>访问</a>";
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id'] = $r['category_id'];
			$r['parentid'] = $r['parent'];
			$r['selected'] = $category_id == $r['category_id'] ? "selected" : "";
			$array[] = $r;
		}
		
		$tree->init($array);
		$str="<option value='\$id' \$selected>\$spacer\$name</option>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
	}


	function delete(){
		if(isset($_GET['tid'])){
			$tid = intval(I("get.tid"));
			$data['status'] = 0;
			if ($this->category_relationships_model->where("tid = $tid")->save($data)) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		if(isset($_POST['ids'])){
			$tids = join(",",$_POST['ids']);
			$data['status'] = 0;
			if ($this->category_relationships_model->where("tid in ($tids)")->save($data)) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	}
}



