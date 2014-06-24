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
			$("<li>" + t + "</li>").prependTo("ul").hide().slideDown(900, function(){
				$(this).show();
			});
			//$("ul").prepend("<li>" + t + "</li>").hide();
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
		var temp = "";
		$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				temp = $(this).text();
				console.log(this);
				console.log($(this).text());
				count++;
			}
		});
		if(count == 1){
			$("#editTask").modal("show");
			$("#Evalue").val(temp).focus(function(){
				$(this).select();
			}).on("click", function(){
				$(this).select();
			});
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
					$(".selected").replaceWith("<li class='hiding'>" + t + "</li>").hide();
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
				$(this).hide(700, function(){
					$(this).remove();	
				});
			}
		});
	});
	
	$("#achieve").click(function(){
		console.log("achieveボタンが押された");
				$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				$(this).hide(700, function(){
					$(this).remove();	
				});
			}
		});
	});
});