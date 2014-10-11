$(function(){

//    $('body').tubular({videoId: '_A3i2KorZCk'}); // where idOfYourVideo is the YouTube ID.
var dateList = [];
dateList.push("2014-10-22");
dateList.push("2014-10-23");
console.log(dateList);
console.log(dateList[1]);
$("#datepicker").datepicker({
		//showButtonPanel: "true"
		beforeShowDay: function(date) {
			for (var i = 0; i < dateList.length; i++) {
				console.log(dateList[i]);
				var set = Date.parse(dateList[i]);
				var task_day = new Date();
				task_day.setTime(set);  
				console.log(date);
				if (date.getYear() == task_day.getYear() &&  
					date.getMonth() == task_day.getMonth() &&
					date.getDate() == task_day.getDate()) {
					console.log(dateList);
				return [true, 'kigen', ''];
			}
			console.log("qqq");
		}
		return [false, "", ""];


	},onSelect: function(){
		var selectedDate = $("#datepicker").datepicker().val();
		console.log(selectedDate);
	}
});
$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	/*$( "#datepicker" ).datepicker( "option", {beforeShowDay: function(date) {
	if (date.getDay() == 0) {
	  // クラス名を設定
	  return [false, 'kigen', ''];
	}
  }
});*/

$("#date").datepicker();
$(".taskCal").datepicker({
	onSelect: function(){
			//var selectedDate = $(".taskCal").datepicker().val();
			//console.log(selectedDate);
		}
	});
$( ".taskCal" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

$(".title").width($("#box").width());

$(document).on("click", "#create", function(){
	console.log("saveボタンが押された！");
	var t = $(this).parent().parent().find("#Avalue").val();
	var date = $(this).parent().parent().find(".taskCal").val();
	console.log(this);
	console.log(t);
	console.log(date);
	var dateArray = date.split("-");
	var term = dateArray[1] + "/" + dateArray[2];
	var data;
	if(t != "" && date != ""){
		var d = false;
		data = {'task' : t , 'date': date};
		if($("li").size() > 0){
			$("li").each(function(){
					//console.log($(this).text());
					console.log(t);
					if(t == $(this).text()){
						d = true;
					}
				});
		}
		if(!d){
			$("<li><span class='task'>" + t + "</span><span class='term'>" + term + "</span></li>").prependTo("ul").hide().slideDown(900, function(){
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
					data: data,
					success: function(){
						$('#tusin').remove();
					}
				});

				dateList.push(date);
				console.log(dateList);
				$("#datepicker").datepicker("destroy");
				$("#datepicker").datepicker({
					
					onSelect: function(){
						var selectedDate = $("#datepicker").datepicker().val();
						console.log(selectedDate);
					}, beforeShowDay: function(date) {
						for (var i = 0; i < dateList.length; i++) {
							var task_day = new Date();
							task_day.setTime(Date.parse(dateList[i]));
							console.log(task_day);  

							if (task_day.getYear() == date.getYear() &&  
								task_day.getMonth() == date.getMonth() &&
								task_day.getDate() == date.getDate()) {
								return [true, 'kigen', ''];
						}
					}
					return [true, "", ""];
				}
			});
				$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				$(this).parent().parent().find("#Avalue").val("");
				$(this).parent().parent().find(".taskCal").val("");
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
	var date;
	$("li").each(function(){
		console.log(this);
		var flag = $(this).hasClass("selected");
		if(flag){
			temp = $(this).find(".task").text();
			date = $(this).find(".term").text();
			console.log(date);
			console.log(temp);
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

		$(".taskCal").val(date);
			//$( ".taskCal" ).datepicker( "setDate", "2012-10-12" );
			
			$(document).on("click", "#change", function(){
				console.log("edit taskボタンが押された！");
				var t = $(this).parent().parent().find("#Evalue").val();
				console.log(this);
				console.log(t);
				var date = $(this).parent().parent().find(".taskCal").val();
				var dateArray = date.split("-");
				var term = dateArray[1] + "/" + dateArray[2];
				console.log(date);
				console.log(term);

				if(t != null && date != null){
					$(".selected").replaceWith("<li class='hiding'><span class='task'>" + t + "</span><span class='term'>" + term + "</span></li>").show();
					$(this).parent().parent().find("#Evalue").val("");
					$("#editTask").modal("hide");
					$("ul").append("<li id='tusin'>通信中...</li>");
					$.ajax({
						type: "POST",
						url: "edit.php",
						data: 'before=' + temp + '&after=' + t + "&date=" + date,
						success: function(){
							$('#tusin').remove();
						}
					});
					dateList.push(date);
					console.log(dateList);
					$("#datepicker").datepicker("destroy");
					$("#datepicker").datepicker({
						
						onSelect: function(){
							var selectedDate = $("#datepicker").datepicker().val();
							console.log(selectedDate);
						}, beforeShowDay: function(date) {
							for (var i = 0; i < dateList.length; i++) {
								var task_day = new Date();
								task_day.setTime(Date.parse(dateList[i]));
								console.log(task_day);  

								if (task_day.getYear() == date.getYear() &&  
									task_day.getMonth() == date.getMonth() &&
									task_day.getDate() == date.getDate()) {
									return [true, 'kigen', ''];
							}
						}
						return [true, "", ""];
					}
				});
					$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
				}
			});
		//	$(".selected").css("color", "black");
		//	$(".selected").removeClass("selected");
	}
});

$("#trash").click(function(){
	console.log("trashボタンが押された");
	var temp;
	var array = [];
	$("li").each(function(){
		console.log(this);
		var flag = $(this).hasClass("selected");
		if(flag){
			temp = $(this).find(".task").text();
			console.log(temp);
			array.push(temp);
				//console.log(array);
				$(this).hide(700, function(){
					$(this).remove();	
				});
			}
		});
	if (array.length != 0) {
		$("ul").append("<li id='tusin'>通信中...</li>");
		console.log(array);
		$.ajax({
			type: "POST",
			url: "trash.php",
			data: {'task' : array},
			success: function(data){
				$('#tusin').remove();
				console.log(data);
			}
		});
		array = [];
	};
	if($("ul").height() >= 250){
		$("#box").css("overflow", "hidden");
	}
});

$("#achieve").click(function(){
	console.log("achieveボタンが押された");
	var temp = '';
	$("li").each(function(){
		console.log(this);
		var flag = $(this).hasClass("selected");
		temp = $(this).text();
		if(flag){
			$(this).hide(700, function(){
				$(this).remove();
				$("ul").append("<li id='tusin'>通信中...</li>");
				$.ajax({
					type: "POST",
					url: "achieve.php",
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
	if($(".boxSub").height() >= 250){
		$("#boxSub").css("overflow-y", "scroll");
	}
	$("#box").toggle(2000);
	$("#boxSub").toggle(2000);
});
});