<?php
// +----------------------------------------------------------------------
// | ModuleName: Spread
// +----------------------------------------------------------------------
// | Author: echoshiki
// +----------------------------------------------------------------------
// | Date: 2016.07.19 pm
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\AdminbaseController;
class AdminSpreadController extends AdminbaseController {
	protected $posts_model;
	protected $spread_model;

	function _initialize() {
		parent::_initialize();
		$this->posts_model = D("Portal/Posts");
		$this->spread_model = D("Portal/Spread");	
	}

	public function index () {
		$this->_lists();
		$this->display();
	}

	public function add () {	
		$sites = C('SPREAD_SITE');
		$this->assign('sites',$sites);
		$this->display();
	}

	public function add_post () {
		$data = I('post.');
		if (!$data['url']) { $this->error('地址不能留空！'); }
		if (!$data['station']) { $this->error('平台不能留空'); }
		$data['consoler'] = sp_get_current_admin_id();
		$data['date'] = time();
		$res = $this->spread_model->add($data);			
		if ($res) {
			$this->success('添加成功！！',U('AdminSpread/index/post_id/'.$data['post_id']));
		} else{
			$this->error('添加失败！！',U('AdminSpread/index/post_id/'.$data['post_id']));
		}
	}

	public function edit () {
		$sites = C('SPREAD_SITE');
		$map['id'] = intval(I("get.id"));
		$data = $this->spread_model->where($map)->find();
		$this->assign("data",$data);		
		$this->assign('sites',$sites);
		$this->display();
	}

	public function edit_post () {
		$data = I('post.');
		if (!$data['url']) { $this->error('地址不能留空！'); }
		if (!$data['station']) { $this->error('平台不能留空'); }
		$data['consoler'] = sp_get_current_admin_id();
		$this->spread_model->save($data);
		$this->success('添加成功！！',U('AdminSpread/index/post_id/'.$data['post_id']));
	}


	public function delete () {
		if(isset($_GET['id'])){
			$map['id'] = intval(I("get.id"));
			if ($this->spread_model->where($map)->delete()) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		if(isset($_POST['ids'])){
			$ids = join(",",$_POST['ids']);
			if ($this->spread_model->where("id in ($ids)")->delete()) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	}

	private  function _lists () {	
		$post_id = I('get.post_id');
		$map['post_id'] = $post_id;

		$count = $this->spread_model->where($map)->count();	
		$page  = $this->page($count, 20);	
		$data  = $this->spread_model->where($map)->limit($page->firstRow . ',' . $page->listRows)->select();

		// 格式化数据
		$sites = C('SPREAD_SITE');
		foreach ($data as $key => $value) {
			$data[$key]['date']    = date('Y-m-d',$value['date']);
			$data[$key]['station'] = $sites[$value['station']];
			$userInfo = M('users')->field('user_login')->where(array('id',$value['consoler']))->find();
			$data[$key]['consoler'] = $userInfo['user_login'];
		}

		$this->assign("Page", $page->show('Admin'));
		$this->assign("current_page",$page->GetCurrentPage());
		unset($_GET[C('VAR_URL_PARAMS')]);
		$this->assign("data",$data);
	}

}