<?php
	$url="http://lxh.yz-rst.com/index.php?c=user&a=login";  
	$cookie = dirname(__FILE__) . '/cookie_rst.txt'; 
						$post_data=array (  
							"username"=>"test2@126.com",  
							"password"=>"112233",
							"rememberMe"=>""
							);  
						$ch=curl_init();  
						curl_setopt($ch,CURLOPT_URL,$url);  
						curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
						curl_setopt($ch,CURLOPT_POST,1);  
						curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);  
						$output=curl_exec($ch);  
						curl_close($ch);
						echo $output;
?>