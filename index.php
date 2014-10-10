<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/layout.css" rel="stylesheet" >
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/cupertino/jquery-ui-1.10.4.custom.min.css">
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>To Do リスト</h1>
		<div class="btn-group">
			<a class="btn btn-large" data-target="#addTask" role="button" data-toggle="modal" style="background: float: left;"><i class="icon-pencil"></i><span class="hidden-phone"> Add</span></a>
			<a id="edit" class="btn btn-large" href="#"><i class="icon-edit"></i><span class="hidden-phone"> Edit</span></a>
			<a id="trash" class="btn btn-large" href="#"><i class="icon-trash"></i><span class="hidden-phone"> Trash</span></a>
            <!--
			<a id="achieve" class="btn btn-large" href="#"><i class="icon-ok"></i><span class="hidden-phone"> Achieve</span></a>

			<a id="refresh" class="btn btn-large" href="#"><i class="icon-refresh"></i><span class="hidden-phone"> Refresh</span></a>

            -->
		</div>
		<p class="visible-phone" style="padding-right: 3%;padding-top: 3%">date:<input type="text" id="date"></p>
		
        <a class="btn btn-large" style="float:right" href="./login.php">Logout</a>
        	
		<div id="addTask"class="modal hide fade" style="margin-top: 8%; height: 35%;">
  			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    			<h3>add task</h3>
  			</div>
  			<div id="modal1" class="modal-body">
   				<span>Task:</span>　<input type="text" id="Avalue" placeholder="タスクを入力してください"><br />
   				<span>Date:</span> <input type="text" class="taskCal"> 　　　まで

  			</div>
  			<div class="modal-footer" >
    			<a href="#" class="btn" data-dismiss="modal">Close</a>
   				<a href="#" class="btn btn-primary" id="create">Save task</a>
  			</div>
		</div>
			
    	<div id="editTask"class="modal hide fade" style="margin-top: 8%">
  			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   				<h3>edit task</h3>
  			</div>
  			<div id="modal2"class="modal-body">
    			<span>Task:</span> <input type="text" id="Evalue"><br/>
    			<span>Date:</span> <input type="text" class="taskCal"> 　　　まで
  			</div>
  			<div class="modal-footer">
    			<a href="#" class="btn" data-dismiss="modal">Close</a>
    			<a href="#" class="btn btn-primary" id="change" data-dismiss="modal">edit task</a>
  			</div>
		</div>
            
		<div id="main" style="margin-top: 5%;">
			<div class="title"><span class="itiran">タスク一覧</span><span class="simekiri">締切り</span></div>
   			<div class="row-fluid">
 				 <div class="span5">

 				 <div id="box">
  					<ul>
  					<?php
						session_start();
						$dsn = 'mysql:dbname=WebGroup;host=localhost';
						$user = 'WebGroup';
						
						$password = 'divtyu';
						try{
							$dbh = new PDO($dsn, $user, $password);
							if ($dbh == null){
								$_SESSION['error1'] = '通信で問題が発生しました。';
								header('Location: login.php');
								exit();
							}
							$dbh->query('SET NAMES UTF-8');
							
							$sql = 'select * from task';
							foreach ($dbh->query($sql) as $row) {    
								if($_SESSION['name'] == $row['password'] && $row['important'] == 0){
									$pieces = explode(" ",$row['time']);
									$piece = explode("-",$pieces[0]);
									?><li><span class='task'><?php print $row['task'] ?></span><span class='term'><?php print $piece[1]."/".$piece[2] ?></span></li><?php
								}
							}
							
						}catch (PDOException $e){
							print('Error:'.$e->getMessage());
							die();
						}
						$dbh = null;					
					?>
    				</ul>
    				</div>
    				<div id="boxSub">
  					<ul>
  					<?php
						$dsn = 'mysql:dbname=WebGroup;host=localhost';
						$user = 'WebGroup';
						$password = 'divtyu';
						$array = array();
						try{		
						$dbh = new PDO($dsn, $user, $password);
							if ($dbh == null){
								$_SESSION['error1'] = '通信で問題が発生しました。';
								header('Location: login.php');
								exit();
							}
							$dbh->query('SET NAMES UTF-8');
									
							$sql = 'select * from task';
							foreach ($dbh->query($sql) as $row) {    
								if($row['important'] == 1){
									array_push($array,$row['task']);
								}
							}
							$_SESSION['achieve'] = $array;
							if(count($_SESSION['achieve'])>0){
								for($i = 0;$i<count($_SESSION['achieve']);$i++){
									?><li><?php print $_SESSION['achieve'][$i] ?></li><?php
								}
							}
						}catch (PDOException $e){
							print('Error:'.$e->getMessage());
							die();
						}
						$dbh = null;					
					?>
    				</ul>
    				</div>
    			</div>
  				<div class="span7">
  					<div id="datepicker" class="hidden-phone" style="font-size: 150%; padding-left: 12%;"></div>
  				</div>
			</div>
		</div>
	</div>
</body>
</html>