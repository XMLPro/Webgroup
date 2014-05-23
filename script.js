
$(window).load(function () {
	$(".delete").hide();
	var flag = true;
	var t = $("#task").val();
	$("#task").focus(function(){
		$("#message").text("");
	});
	$(".create").click(function(){
		t = $("#task").val();
		//var c = new RegExp("\s+");
		if(t != ""/* && !(t.match(\s+)*/){
			console.log("タスクが生成された！");
			var text = $("#task").val("");
			$("ul").prepend("<li name='li'><label><input type='checkbox'id='cb'><span class='t'>" + t + "</span></label></li>");
		}
	});
/*	$("#task").keypress(function(e){
		if(e.which == 13){
			$(".create").click(function(){
				var t = $("#task").val();
				if(t != ""){
				console.log("タスクが生成された！");
				var text = $("#task").val("");
				$("ul").prepend("<li name='li'><label><input type='checkbox'id='cb'>" + t + "</label></li>");
				return false;
				}
			});
		}
	});
*/

	$(document).on("click", "#cb", function(){
		console.log("チェックされた");
		$("#message").text("");
		$(".delete").show();
		$("input:checkbox").each(function(){
			if(this.checked && flag == true && !($(this).hasClass("check"))){
				console.log("確認");
				$(this).parent().parent().append("<input type='button' class='edit' value='編集'><input type='button' class='achieve' value='達成'>");
				console.log($(this).parent());
				//console.log(this);
				$(this).addClass("check");
				flag = false;
			}else if(!(this.checked) && $(this).hasClass("check")){
				console.log("チェックが外された");
				$(this).parent().nextAll().remove();
				$(this).removeClass("check");
			}
		});
		flag = true;
	});
	$(document).on("click", ".delete", function(){
		$("input:checkbox").each(function(){
			if(this.checked){
			$(this).parent().parent().remove();
			}
		});
		$(this).hide();
	});
	$(document).on("click", ".achieve", function(){
		console.log("達成ボタンが押された");
		console.log(t);
		$(".delete").hide();
		$(this).parent().remove();
		$("#message").text(t + "が達成されました!!!!");
	});
	$(document).on("click", ".edit", function(){
		console.log("編集ボタンが押された");
		$(".delete").hide();
		//console.log($(this).parent());
		//console.log($(this).prev().children());
		$(this).prev().replaceWith("<input type='text' size=20' id='et'>");
		$(this).next().remove();
		$(this).replaceWith("<input type='button' value='完了' class='done'>");
		
	});
	$(document).on("click", ".done", function(){
		console.log("完了ボタンが押された");
		t = $(this).prev().val();
			//console.log(t);
			if(t != ""){
			$(this).prev().replaceWith("<label><input type='checkbox' id='cb'><span id='t'>" + t + "</span></label>");
			$(this).remove();
		}
	});
});
