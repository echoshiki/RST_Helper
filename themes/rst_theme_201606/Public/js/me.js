$(document).ready(function(){
		var hash = location.hash;
		if (hash == "#signin") { 
			login_show();
		}

		if (hash == "#signup") { 
			reg_show();
		}

		 function login_show() {
		 	$('#login-form').attr('style','display:block');
			$('#reg-form').attr('style','display:none');
			$('#active-line').attr('class','login-active-line');
			$('#login-btn').attr('class','active');
			$('#reg-btn').attr('class','');
		 }

		 function reg_show() {
		 	$('#reg-form').attr('style','display:block');
			$('#login-form').attr('style','display:none');
			$('#active-line').attr('class','reg-active-line');
			$('#reg-btn').attr('class','active');
			$('#login-btn').attr('class','');
		 }

		$('#login-btn').click(function() {
			$('#login-form').attr('style','display:block');
			$('#reg-form').attr('style','display:none');
			$('#active-line').attr('class','login-active-line');
			$(this).attr('class','active');
			$('#reg-btn').attr('class','');
		});
		$('#reg-btn').click(function() {
			$('#reg-form').attr('style','display:block');
			$('#login-form').attr('style','display:none');
			$('#active-line').attr('class','reg-active-line');
			$(this).attr('class','active');
			$('#login-btn').attr('class','');
		});
	});