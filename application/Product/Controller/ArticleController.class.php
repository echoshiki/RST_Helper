<?php
// +----------------------------------------------------------------------
// | Name : 产品详情模块
// +----------------------------------------------------------------------
// | Data : 2016.06.29
// +----------------------------------------------------------------------
// | Author: LiuCheng <echoshiki@outlook.com>
// +----------------------------------------------------------------------
/**
 * 产品内页
 */
namespace Product\Controller;
use Common\Controller\HomebaseController;
class ArticleController extends HomebaseController {
    //文章内页
    public function index() {
    	$id = intval($_GET['id']);

    	$article = sp_sql_post($id,'');

    	if(empty($article)){
    	    header('HTTP/1.1 404 Not Found');
    	    header('Status:404 Not Found');
    	    if(sp_template_file_exists(MODULE_NAME."/404")){
    	        $this->display(":404");
    	    }
    	    return ;
    	}
    	$categoryid = $article['category_id'];
    	$category_obj = M("Categories");
    	$category = $category_obj->where("category_id='$categoryid'")->find();

    	
    	$article_id = $article['object_id'];

    	$products_model = M("Products");
    	
    	$article_date = $article['modified'];
    	
    	$join = "".C('DB_PREFIX').'products as b on a.object_id =b.id';
    	$join2 = "".C('DB_PREFIX').'users as c on b.author = c.id';
    	$rs = M("CategoryRelationships");
    	
    	$next = $rs->alias("a")->join($join)->join($join2)->where(array("modified"=>array("egt",$article_date), "tid"=>array('neq',$id), "a.status"=>1,'category_id'=>$categoryid))->order("modified asc")->find();
    	$prev = $rs->alias("a")->join($join)->join($join2)->where(array("modified"=>array("elt",$article_date), "tid"=>array('neq',$id), "a.status"=>1,'category_id'=>$categoryid))->order("modified desc")->find();
    	
    	
    	$this->assign("next",$next);
    	$this->assign("prev",$prev);
    	
    	$smeta = json_decode($article['smeta'],true);
    	$content_data = sp_content_page($article['content']);
    	$article['content'] = $content_data['content'];
    	$this->assign("page",$content_data['page']);
    	$this->assign($article);
    	$this->assign("smeta",$smeta);
    	$this->assign("category",$category);
    	$this->assign("article_id",$article_id);
    	
    	$tplname = $category["one_tpl"];
    	$tplname = sp_get_apphome_tpl($tplname, "article");
    	$this->display(":$tplname");
    }
    
}
