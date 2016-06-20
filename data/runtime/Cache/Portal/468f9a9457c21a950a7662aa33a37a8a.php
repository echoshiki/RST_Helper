<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta name="author" content="ThinkCMF">
	<?php  function _sp_helloworld(){ echo "hello ThinkCMF!"; } function _sp_helloworld2(){ echo "hello ThinkCMF2!"; } function _sp_helloworld3(){ echo "hello ThinkCMF3!"; } ?>
	<?php $portal_index_lastnews="1,2"; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX2.1.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
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
	

<link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
<link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
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
				 <input type="text" class="" placeholder="搜索" name="keyword" value="<?php echo I('get.keyword');?>"/>
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
	<a class="list-group-item" href="<?php echo U('portal/UserPost/index');?>"><i class="fa fa-newspaper-o fa-fw"></i> 新闻中心</a>
	<a class="list-group-item" href="http://lxh.yz-rst.com/" target="_blank"><i class="fa fa-camera-retro fa-fw"></i> 微场景</a>
	<a class="list-group-item" href="#"><i class="fa fa-shopping-cart fa-fw"></i> 产品中心</a>
	<a class="list-group-item" href="<?php echo U('user/profile/edit');?>"><i class="fa fa-list-alt fa-fw"></i> 修改资料</a>
	<a class="list-group-item" href="<?php echo U('user/profile/password');?>"><i class="fa fa-lock fa-fw"></i> 修改密码</a>
	<a class="list-group-item" href="<?php echo U('user/profile/avatar');?>"><i class="fa fa-user fa-fw"></i> 编辑头像</a>
<!-- 	<a class="list-group-item" href="<?php echo U('user/profile/bang');?>"><i class="fa fa-exchange fa-fw"></i> 绑定账号</a>
	<a class="list-group-item" href="<?php echo U('user/favorite/index');?>"><i class="fa fa-star-o fa-fw"></i> 我的收藏</a>
	<a class="list-group-item" href="<?php echo U('comment/comment/index');?>"><i class="fa fa-comments-o fa-fw"></i> 我的评论</a> -->
</div>
                </div>
                <div class="span9">
                    <div class="tabs">
                        <ul class="nav nav-tabs">
							<li><a href="<?php echo U('UserPost/index',array('term'=>empty($term['term_id'])?'':$term['term_id']));?>" target="_self">新闻一览</a></li>
							<li class="active"><a href="<?php echo U('UserPost/add',array('term'=>empty($term['term_id'])?'':$term['term_id']));?>" target="_self">添加新闻</a></li>
						</ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="one">	
								<form action="<?php echo U('UserPost/edit_post');?>" method="post" class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
									<div class="row-fluid">
										<div class="span9">
											<table class="table table-bordered">
												<tr>
													<th width="80">栏目</th>
													<td>
														<select multiple="multiple" style="max-height: 100px;"name="term[]"><?php echo ($taxonomys); ?></select>
														<div>windows：按住 Ctrl 按钮来选择多个选项,Mac：按住 command 按钮来选择多个选项</div>
													</td>
												</tr>
												<tr>
													<th>标题</th>
													<td>
														<input type="hidden" name="post[id]" value="<?php echo ($post["id"]); ?>">
														<input type="text" style="width: 400px;" name="post[post_title]" required value="<?php echo ($post["post_title"]); ?>" placeholder="请输入标题"/>
														<span class="form-required">*</span>
													</td>
												</tr>
												<tr>
													<th>关键词</th>
													<td>
														<input type="text" name="post[post_keywords]" style="width: 400px" value="<?php echo ($post['post_keywords']); ?>" placeholder="请输入关键字">
														多关键词之间用空格或者英文逗号隔开
													</td>
												</tr>
							
												<tr>
													<th>文章来源</th>
													<td>
														<input type="text" name="post[post_source]" value="<?php echo ($post['post_source']); ?>" style="width: 400px" placeholder="请输入文章来源">
													</td>
												</tr>
												<tr>
													<th>摘要</th>
													<td>
														<textarea name="post[post_excerpt]" required style="width: 98%; height: 50px;" placeholder="请填写摘要"><?php echo ($post["post_excerpt"]); ?></textarea>
														<span class="form-required"></span>
													</td>
												</tr>
												<tr>
													<th>内容</th>
													<td>
														<script type="text/plain" id="content" name="post[post_content]"><?php echo ($post["post_content"]); ?></script>
													</td>
												</tr>
												<tr>
													<th>相册图集</th>
													<td>
														<fieldset>
															<legend>图片列表</legend>
															<ul id="photos" class="pic-list unstyled">
																<?php if(is_array($smeta['photo'])): foreach($smeta['photo'] as $key=>$vo): $img_url=sp_get_asset_upload_path($vo['url']); ?>
																<li id="savedimage<?php echo ($key); ?>">
																	<input type="text" name="photos_url[]" value="<?php echo ($img_url); ?>" title="双击查看" style="width: 310px;height:48px;" ondblclick="image_priview(this.value);" class="input image-url-input"> 
																	<input type="text" name="photos_alt[]" value="<?php echo ($vo["alt"]); ?>" style="width: 160px;height:48px;" class="input image-alt-input" onfocus="if(this.value == this.defaultValue) this.value = ''" onblur="if(this.value.replace(' ','') == '') this.value = this.defaultValue;">
																	<a class="img_a" href="javascript:onClick=image_priview('<?php echo ($img_url); ?>')"><img class="img_prew" src="<?php echo sp_get_asset_upload_path($vo['url']);?>" style="height:50px;"></img></a>
																	<a href="javascript:flashupload('replace_albums_images', '图片替换','savedimage<?php echo ($key); ?>',replace_image,'10,gif|jpg|jpeg|png|bmp,0','','','')">替换</a>
																	<a href="javascript:remove_div('savedimage<?php echo ($key); ?>')">移除</a>
																</li><?php endforeach; endif; ?>
															</ul>
														</fieldset>
														<a href="javascript:;" onclick="javascript:flashupload('albums_images', '图片上传','photos',change_images,'10,gif|jpg|jpeg|png|bmp,0','','','')" class="btn btn-small">选择图片</a>
													</td>
												</tr>
											</table>
										</div>
										<div class="span3">
											<table class="table table-bordered">
												<tr>
													<td><b>缩略图</b></td>
												</tr>
												<tr>
													<td>
														<div style="text-align: center;">
															<input type="hidden" name="smeta[thumb]" id="thumb" value="<?php echo ((isset($smeta["thumb"]) && ($smeta["thumb"] !== ""))?($smeta["thumb"]):''); ?>">
															<a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
																<?php if(empty($smeta['thumb'])): ?><img src="/themes/simplebootx/Public/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand"/>
																<?php else: ?>
																	<img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" id="thumb_preview" width="135" style="cursor: hand"/><?php endif; ?>
															</a>
															<input type="button" class="btn btn-small" onclick="$('#thumb_preview').attr('src','/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片"  style="margin-top:10px">
														</div>
													</td>
												</tr>
												<tr>
													<th>发布时间</th>
												</tr>
												<tr>
													<td><input type="text" name="post[post_modified]" value="<?php echo ($post["post_modified"]); ?>" class="js-datetime" style="width: 160px;"></td>
												</tr>								
											</table>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary js-ajax-submit" type="submit">提交</button>
										<a class="btn" href="<?php echo U('AdminPost/index');?>">返回</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<!-- 编辑器 -->
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
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
	<?php if(APP_DEBUG): ?><style>
			#think_page_trace_open{
				z-index:9999;
			}
		</style><?php endif; ?>	
<!-- 编辑器 -->

	<script type="text/javascript" src="/public/js/common.js"></script>
	<script type="text/javascript" src="/public/js/content_addtop.js?t=<?php echo time();?>"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.DIMAUB;
	</script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		$(function() {
			//setInterval(function(){public_lock_renewal();}, 10000);
			$(".js-ajax-close-btn").on('click', function(e) {
				e.preventDefault();
				Wind.use("artDialog", function() {
					art.dialog({
						id : "question",
						icon : "question",
						fixed : true,
						lock : true,
						background : "#CCCCCC",
						opacity : 0,
						content : "您确定需要关闭当前页面嘛？",
						ok : function() {
							setCookie("refersh_time", 1);
							window.close();
							return true;
						}
					});
				});
			});
			/////---------------------
			Wind.use('validate', 'ajaxForm', 'artDialog', function() {
				//javascript

				//编辑器
				editorcontent = new baidu.editor.ui.Editor();
				editorcontent.render('content');
				try {
					editorcontent.sync();
				} catch (err) {
				}
				//增加编辑器验证规则
				jQuery.validator.addMethod('editorcontent', function() {
					try {
						editorcontent.sync();
					} catch (err) {
					}
					;
					return editorcontent.hasContents();
				});
				var form = $('form.js-ajax-forms');
				//ie处理placeholder提交问题
				if ($.browser.msie) {
					form.find('[placeholder]').each(function() {
						var input = $(this);
						if (input.val() == input.attr('placeholder')) {
							input.val('');
						}
					});
				}
				//表单验证开始
				form.validate({
					//是否在获取焦点时验证
					onfocusout : false,
					//是否在敲击键盘时验证
					onkeyup : false,
					//当鼠标掉级时验证
					onclick : false,
					//验证错误
					showErrors : function(errorMap, errorArr) {
						//errorMap {'name':'错误信息'}
						//errorArr [{'message':'错误信息',element:({})}]
						try {
							$(errorArr[0].element).focus();
							art.dialog({
								id : 'error',
								icon : 'error',
								lock : true,
								fixed : true,
								background : "#CCCCCC",
								opacity : 0,
								content : errorArr[0].message,
								cancelVal : '确定',
								cancel : function() {
									$(errorArr[0].element).focus();
								}
							});
						} catch (err) {
						}
					},
					//验证规则
					rules : {
						'post[post_title]' : {
							required : 1
						},
						'post[post_content]' : {
							editorcontent : true
						}
					},
					//验证未通过提示消息
					messages : {
						'post[post_title]' : {
							required : '请输入标题'
						},
						'post[post_content]' : {
							editorcontent : '内容不能为空'
						}
					},
					//给未通过验证的元素加效果,闪烁等
					highlight : false,
					//是否在获取焦点时验证
					onfocusout : false,
					//验证通过，提交表单
					submitHandler : function(forms) {
						$(forms).ajaxSubmit({
							url : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
							dataType : 'json',
							beforeSubmit : function(arr, $form, options) {

							},
							success : function(data, statusText, xhr, $form) {
								if (data.status) {
									setCookie("refersh_time", 1);
									//添加成功
									Wind.use("artDialog", function() {
										art.dialog({
											id : "succeed",
											icon : "succeed",
											fixed : true,
											lock : true,
											background : "#CCCCCC",
											opacity : 0,
											content : data.info,
											button : [ {
												name : '继续编辑？',
												callback : function() {
													//reloadPage(window);
													return true;
												},
												focus : true
											}, {
												name : '返回列表页',
												callback : function() {
													location = "<?php echo U('UserPost/index');?>";
													return true;
												}
											} ]
										});
									});
								} else {
									isalert(data.info);
								}
							}
						});
					}
				});
			});
			////-------------------------
		});
	</script>
</body>
</html>