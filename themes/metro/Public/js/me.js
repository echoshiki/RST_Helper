$(document).ready(function(){

		var current = $(".current-line");  // 获取下划线
		var width = current.innerWidth();  // 获取下划线默认长度

		$('.login-tab-con').find("a").click(function() {
			var no = $(this).index();   // 获取点击主体的序号
			var leftNew = $(this).position().left;   // 获取点击主体的位置偏移量
			$('.login-tab-con').find("a").removeClass();
			$(this).addClass("current");
			current.stop().animate({
				left: leftNew,
				width: width
			},300);
			if (no == 0) { 
				$('#login-form').attr('style','display:block');
		 		$('#reg-form').attr('style','display:none');
			} else { 
				$('#reg-form').attr('style','display:block');
				$('#login-form').attr('style','display:none');
			}
		});

	});