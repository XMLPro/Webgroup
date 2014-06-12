$(function(){
	$("#datepicker").datepicker({
		//showButtonPanel: "true"
		onSelect: function(){
			var selectedDate = $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'}).val();
			console.log(selectedDate);
		}
	});
	$("#date").datepicker();
	

	$(document).on("click", "#create", function(){
		console.log("saveボタンが押された！");
		var t = $(this).parent().parent().find("#Avalue").val();
		console.log(this);
		console.log(t);
	
		if(t != ""){
			$("ul").prepend("<li>" + t + "</li>");
			$(this).parent().parent().find("#Avalue").val("");
			$("#addTask").modal("toggle");
		}
	});
	
	$(document).on("click", "li", function(){
		console.log("リストが選択された");
		var flag = $(this).hasClass("selected");
		if(!(flag)){
			$(this).css("color", "white");
			$(this).addClass("selected");
		}else{
			$(this).css("color", "black");
			$(this).removeClass("selected");
		}
	});

	$("#edit").click(function(){
		console.log("editボタンが押された");
		var count = 0;
		$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				count++;
			}
		});
		if(count == 1){
			$("#editTask").modal("show");
		/*	$("li").each(function(){
				var flag = $(this).hasClass("selected");
				if(flag){
					console.log(this);
					task = $(this).val();
					console.log(task);
				}
			});*/
			$(document).on("click", "#change", function(){
				console.log("edit taskボタンが押された！");
				var t = $(this).parent().parent().find("#Evalue").val();
				console.log(this);
				console.log(t);
	
				if(t != ""){
					$(".selected").replaceWith("<li>" + t + "</li>");
					$(this).parent().parent().find("#Evalue").val("");
					$("#editTask").modal("hide");
				}
			});
		//	$(".selected").css("color", "black");
		//	$(".selected").removeClass("selected");
		}
	});
	
	$("#trash").click(function(){
		console.log("trashボタンが押された");
		$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				$(this).remove();
			}
		});
	});
	
	$("#achieve").click(function(){
		console.log("achieveボタンが押された");
				$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				$(this).remove();
			}
		});
	});
});