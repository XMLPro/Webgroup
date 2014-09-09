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
			var d = false;
			$("li").each(function(){
				console.log($(this).text());
				console.log(t);
				if(t == $(this).text()){
					d = true;
				}
			});
			if(!d){
				$("<li>" + t + "</li>").prependTo("ul").hide().slideDown(900, function(){
					$(this).show();
				});
				if($("ul").height() >= 250){
					$("#box").css("overflow-y", "scroll");
				}	
				//$("ul").prepend("<li>" + t + "</li>").hide();
				$("ul").append("<li id='tusin'>通信中...</li>");
				$.ajax({
				   type: "POST",
				   url: "add.php",
				   data: 'task=' + t,
				   success: function(){
				     $('#tusin').remove();
				   }
				 });
				$(this).parent().parent().find("#Avalue").val("");
				$("#addTask").modal("toggle");
			}else{
				$("<p class='warning1'>違う名前を指定してください</p>").appendTo("#modal1").css("color", "red");
				$("#Avalue").focus(function(){
					$(".warning1").remove();
					$(this).select();
				}).on("click", function(){
					$(this).select();
				});
			}
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

	var before_t = "";
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

			$(document).on("click", "#change", function(){
				console.log("edit taskボタンが押された！");
				var t = $(this).parent().parent().find("#Evalue").val();
				console.log(this);
				console.log(t);
	
				if(t != ""){
						$(".selected").replaceWith("<li class='hiding'>" + t + "</li>").hide();
						$("ul").append("<li id='tusin'>通信中...</li>");
						$.ajax({
						   type: "POST",
						   url: "edit.php",
						   data: 'before=' + temp + '&after=' + t,
						   success: function(){
						     $('#tusin').remove();
						   }
						 });
						$(this).parent().parent().find("#Evalue").val("");
						$("#editTask").modal("hide");
						$("ul").append("<li id='tusin'>通信中...</li>");
				$.ajax({
				   type: "POST",
				   url: "edit.php",
				   data: 'before=' + temp + '&after=' + t,
				   success: function(){
				     $('#tusin').remove();
				   }
				 });
				}
			});
		//	$(".selected").css("color", "black");
		//	$(".selected").removeClass("selected");
		}
	});
	
	$("#trash").click(function(){
		console.log("trashボタンが押された");
		var temp = '';
		$("li").each(function(){
			console.log(this);
			var flag = $(this).hasClass("selected");
			if(flag){
				temp = $(this).text();
				$(this).hide(700, function(){
					$(this).remove();
					$("ul").append("<li id='tusin'>通信中...</li>");
				$.ajax({
				   type: "POST",
				   url: "trash.php",
				   data: 'task=' + temp,
				   success: function(){
				     $('#tusin').remove();
				   }
				 });	
				});
			}
		});
		if($("ul").height() >= 250){
			$("#box").css("overflow", "hidden");
		}
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
		if($("ul").height() >= 250){
			$("#box").css("overflow", "hidden");
		}
	});
});