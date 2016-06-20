<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta name="author" content="ThinkCMF">
	<?php  function _sp_helloworld(){ echo "hello ThinkCMF!"; } function _sp_helloworld2(){ echo "hello ThinkCMF2!"; } function _sp_helloworld3(){ echo "hello ThinkCMF3!"; } ?>
	<?php $portal_index_lastnews="1,2"; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX2.1.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.1.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX2.1.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
	<meta name="author" content="ThinkCMF">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link rel="icon" href="/themes/simplebootx/Public/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/themes/simplebootx/Public/images/favicon.ico" type="image/x-icon">
    <link href="/themes/simplebootx/Public/simpleboot/themes/simplebootx/theme.min.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
	<!--[if IE 7]>
	<link rel="stylesheet" href="/themes/simplebootx/Public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/themes/simplebootx/Public/css/style.css" rel="stylesheet">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
<style type="text/css">
.tab-content{overflow: visible;}
</style>
<!--加载Css-->
<link rel="stylesheet" type="text/css" href="/public/js/shearphoto/css/ShearPhoto.css" />
</head>
<body class="body-white" id="top">
	<?php echo hook('body_start');?>
<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="/"><img src="/themes/simplebootx/Public/images/logo.png"/></a>
       <div class="nav-collapse collapse" id="main-menu">
       	<?php
 $effected_id="main-menu"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label <b class='caret'></b></a>"; $ul_class="dropdown-menu" ; $li_class="" ; $style="nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
		
		<ul class="nav pull-right" id="main-menu-user">
			<li class="dropdown user login">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	            <img src="/themes/simplebootx//Public/images/headicon.png" class="headicon" id="avatar_small"/>
	            <span class="user-nicename"></span><b class="caret"></b></a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('user/center/index');?>"><i class="fa fa-user"></i> &nbsp;个人中心</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo U('user/index/logout');?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a></li>
	            </ul>
          	</li>
          	<li class="dropdown user offline">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	           		<img src="/themes/simplebootx//Public/images/headicon.png" class="headicon"/>登录<b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'sina'));?>"><i class="fa fa-weibo"></i> &nbsp;微博登录</a></li>
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'qq'));?>"><i class="fa fa-qq"></i> &nbsp;QQ登录</a></li>
	               <li><a href="<?php echo leuu('user/login/index');?>"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo leuu('user/register/index');?>"><i class="fa fa-user"></i> &nbsp;注册</a></li>
	            </ul>
          	</li>
		</ul>
		<div class="pull-right">
        	<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>" style="margin:18px 0;">
				 <input type="text" class="" placeholder="Search" name="keyword" value="<?php echo I('get.keyword');?>"/>
				 <input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
			</form>
		</div>
       </div>
     </div>
   </div>
 </div>

		<div class="container tc-main">
                <div class="row">
                    <div class="span3">
	                    <div class="list-group">
	<a class="list-group-item" href="<?php echo U('user/profile/edit');?>"><i class="fa fa-list-alt fa-fw"></i> 修改资料</a>
	<a class="list-group-item" href="<?php echo U('user/profile/password');?>"><i class="fa fa-lock fa-fw"></i> 修改密码</a>
	<a class="list-group-item" href="<?php echo U('user/profile/avatar');?>"><i class="fa fa-user fa-fw"></i> 编辑头像</a>
	<a class="list-group-item" href="<?php echo U('user/profile/bang');?>"><i class="fa fa-exchange fa-fw"></i> 绑定账号</a>
	<a class="list-group-item" href="<?php echo U('user/favorite/index');?>"><i class="fa fa-star-o fa-fw"></i> 我的收藏</a>
	<a class="list-group-item" href="<?php echo U('comment/comment/index');?>"><i class="fa fa-comments-o fa-fw"></i> 我的评论</a>
</div>
                    </div>
                    <div class="span9">
                           <div class="tabs">
                               <ul class="nav nav-tabs">
                                   <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-user"></i> 修改头像</a></li>
                               </ul>
                               <div class="tab-content">
					<div class="tab-pane active" id="one">
					<div class="row">
					<?php if(empty($user['avatar'])): ?><img src="/themes/simplebootx//Public/images/headicon_128.png" class="headicon" id="avatar_big" style="max-width:128px"/>
					<?php else: ?>
					<img src="<?php echo sp_get_user_avatar_url($avatar);?>?t=<?php echo time();?>" class="headicon" id="avatar_big"/><?php endif; ?>
					<div id="shearphoto_loading">程序加载中......</div>
					<div id="shearphoto_main">
						<div class="Effects" id="shearphoto_Effects" autocomplete="off">
							<strong class="EffectsStrong">截图效果</strong>
							<a href="javascript:;" StrEvent="原图" class="Aclick"><img src="/public/js/shearphoto/images/Effects/e0.jpg"/>原图</a>
							<a href="javascript:;" StrEvent="美肤"><img src="/public/js/shearphoto/images/Effects/e1.jpg"/>美肤效果</a>
							<a href="javascript:;" StrEvent="素描"><img src="/public/js/shearphoto/images/Effects/e2.jpg"/>素描效果</a>
							<a href="javascript:;" StrEvent="自然增强"><img src="/public/js/shearphoto/images/Effects/e3.jpg" />自然增强</a>
							<a href="javascript:;" StrEvent="紫调"><img src="/public/js/shearphoto/images/Effects/e4.jpg" />紫调效果</a>
							<a href="javascript:;" StrEvent="柔焦"><img src="/public/js/shearphoto/images/Effects/e5.jpg"/>柔焦效果</a>
							<a href="javascript:;" StrEvent="复古"><img src="/public/js/shearphoto/images/Effects/e6.jpg"/>复古效果</a>
							<a href="javascript:;" StrEvent="黑白"><img src="/public/js/shearphoto/images/Effects/e7.jpg"/>黑白效果</a>
							<a href="javascript:;" StrEvent="仿lomo"><img src="/public/js/shearphoto/images/Effects/e8.jpg"/>仿lomo</a>
							<a href="javascript:;" StrEvent="亮白增强"><img src="/public/js/shearphoto/images/Effects/e9.jpg"/>亮白增强</a>
							<a href="javascript:;" StrEvent="灰白"><img src="/public/js/shearphoto/images/Effects/e10.jpg"/>灰白效果</a>
							<a href="javascript:;" StrEvent="灰色"><img src="/public/js/shearphoto/images/Effects/e11.jpg"/>灰色效果</a>
							<a href="javascript:;" StrEvent="暖秋"><img src="/public/js/shearphoto/images/Effects/e12.jpg"/>暖秋效果</a>
							<a href="javascript:;" StrEvent="木雕"><img src="/public/js/shearphoto/images/Effects/e13.jpg"/>木雕效果</a>
							<a href="javascript:;" StrEvent="粗糙"><img src="/public/js/shearphoto/images/Effects/e14.jpg"/>粗糙效果</a>
						</div>
						<div class="primary"> 
							<div id="main">
								<div class="point"></div>
								<div id="SelectBox">
									<form    id="ShearPhotoForm" enctype="multipart/form-data" method="post"  target="POSTiframe">
									<a href="javascript:;" id="selectImage"><input type="file"  name="UpFile" autocomplete="off"/></a>
									</form>           
									<a href="javascript:;" id="PhotoLoading"></a>
									<a href="javascript:;" id="camerasImage"></a>
								</div>
								<div id="relat">
									<div id="black"></div>
									<div id="movebox">
										<div id="smallbox">
										<img src="/public/js/shearphoto/images/default.gif" class="MoveImg"  style="max-width:300%"/>
										</div>
										<i id="borderTop"></i>
										<i id="borderLeft"></i>
										<i id="borderRight"></i>
										<i id="borderBottom"></i>
										<i id="BottomRight"></i>
										<i id="TopRight"></i>
										<i id="Bottomleft"></i>
										<i id="Topleft"></i>
										<i id="Topmiddle"></i>
										<i id="leftmiddle"></i>
										<i id="Rightmiddle"></i>
										<i id="Bottommiddle"></i>
									</div>
									<img src="/public/js/shearphoto/images/default.gif" class="BigImg" />
								</div>
							</div> 
							<div style="clear: both"></div>
							<div id="Shearbar">
								<a id="LeftRotate" href="javascript:;"><em></em>向左旋转</a>
								<em class="hint L"></em>
								<div class="ZoomDist" id="ZoomDist">
									<div id="Zoomcentre"></div>
									<div id="ZoomBar"></div>
									<span class="progress"></span>
								</div>
								<em class="hint R"></em>
								<a id="RightRotate" href="javascript:;">向右旋转<em></em></a>
								<p class="Psava">
									<a id="againIMG"  href="javascript:;">重新选择</a>
									<a id="saveShear" href="javascript:;">保存截图</a>
								</p>
							</div>
						</div>   
						<div style="clear: both"></div>
					</div>
					<div id="photoalbum">
						<i id="close"></i>
						<ul>
							<li><img src="/public/js/shearphoto/file/photo/1.jpg" serveUrl="file/photo/1.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/2.jpg" serveUrl="file/photo/2.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/3.jpg" serveUrl="file/photo/3.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/4.jpg" serveUrl="file/photo/4.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/5.jpg" serveUrl="file/photo/5.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/6.jpg" serveUrl="file/photo/6.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/7.jpg" serveUrl="file/photo/7.jpg" /></li>
							<li><img src="/public/js/shearphoto/file/photo/8.jpg" serveUrl="file/photo/8.jpg" /></li>
						</ul>
					</div>
					<div id="CamBox">
						<p class="lens"></p>
						<div id="CamFlash"></div>
						<p class="cambar">
						<a href="javascript:;" id="CamOk"  >拍照</a>
						<a href="javascript:;" id="setCam">设置</a>
						<a href="javascript:;" id="camClose">关闭</a>
						<span style="clear:both;"></span>
						</p>
						<div id="timing"></div>
					</div>
				</div></div>
                               </div>							
                           </div>
                    </div>
                </div>

		<br>
<br>
<br>
<!-- Footer ================================================== -->
<hr>
<?php echo hook('footer');?>
<div id="footer">
	<div class="links">
		<?php $links=sp_getlinks(); ?>
		<?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="<?php echo ($vo["link_target"]); ?>"><?php echo ($vo["link_name"]); ?></a><?php endforeach; endif; ?>
	</div>
	<p>
		Made by <a href="http://www.thinkcmf.com" target="_blank">ThinkCMF</a>
		Code licensed under the 
		<a href="http://www.apache.org/licenses/LICENSE-2.0" rel="nofollow" target="_blank">Apache License v2.0</a>.
		<br />
		Based on 
		<a href="http://getbootstrap.com/2.3.2/" target="_blank">Bootstrap</a>.
		Icons from 
		<a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a>
	</p>
</div>
<div id="backtotop">
	<i class="fa fa-arrow-circle-up"></i>
</div>
<?php echo ($site_tongji); ?>


	</div>
	<!-- /container -->
	<!--加载Js-->
	<script  type="text/javascript" src="/public/js/shearphoto/js/ShearPhoto.js?t=<?php echo time();?>" ></script>
	<script  type="text/javascript"  src="/public/js/shearphoto/js/webcam_ShearPhoto.js?t=<?php echo time();?>" ></script>
	<script  type="text/javascript"  src="/public/js/shearphoto/js/alloyimage.js?t=<?php echo time();?>" ></script>
	<script  type="text/javascript"  src="/public/js/shearphoto/js/handle.js?t=<?php echo time();?>" ></script>
    <script type="text/javascript">
        var SHEAR = {
			PATH_RES: '/public/js',
			PATH_AVATAR: '/data/upload/avatar',
			URL:"<?php echo U('profile/do_avatar');?>",
        };
    </script>
	<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/themes/simplebootx/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/js/frontend.js"></script>
	<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login');?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.offline").show();
			}
			
		});	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>


</body>
</html>