
$(window).load(function () {
	var flag = true;
	$(".create").click(function(){
		var t = $("#task").val();
		if(t != ""){
			console.log("タスクが生成された！");
			var text = $("#task").val("");
			$("ul").prepend("<li name='li'><label id = 'a'><input type='checkbox'id='cb'>" + t + "</label></li>");
		}
	});
	$(document).on("click", "#cb", function(){
		console.log("チェックされた");
		$("input:checkbox").each(function(){
		
		/*	$(this).addClass(function(){
				return 'list' + index;
			});
			$(this).addClass(function(){
				console.log("クラスができた");
				return 'task' + index;
			});
			var checkId = 'task' + index;*/
			
			if(this.checked && flag == true && !($(this).hasClass("check"))){
				console.log("確認");
				$(this).parent().after("<input type='button' class='edit' value='編集'><input type='button' class='achive' value='達成'>");
				$(this).addClass("check");
				flag = false;
				
		//	var i = this;
		//	console.log(this);
			}
			//index++;
		});
		flag = true;
	});	
	
	$(document).on("click", ".remove", function(){
		console.log("タスクが削除された");
	
	});	
});
