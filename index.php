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
			<a id="achieve" class="btn btn-large" href="#"><i class="icon-ok"></i><span class="hidden-phone"> Achieve</span></a>
		</div>
			
		<p class="visible-phone" style="padding-right: 3%;padding-top: 3%">date:<input type="text" id="date"></p>
			
		<div id="addTask"class="modal hide fade" style="margin-top: 8%">
  			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    			<h3>add task</h3>
  			</div>
  			<div id="modal1" class="modal-body">
   				<input type="text" id="Avalue" placeholder="タスクを入力してください">
  			</div>
  			<div class="modal-footer">
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
    			<input type="text" id="Evalue">
  			</div>
  			<div class="modal-footer">
    			<a href="#" class="btn" data-dismiss="modal">Close</a>
    			<a href="#" class="btn btn-primary" id="change" data-dismiss="modal">edit task</a>
  			</div>
		</div>
            
		<div id="main" style="margin-top: 5%;">
   			<div class="row-fluid">
 				 <div id="box"class="span5">
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
								if($name == $row['password']){
									?><li><?php $row['task'] ?></li><?php
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
  				<div class="span7">
  					<div id="datepicker" class="hidden-phone" style="font-size: 150%; padding-left: 12%;"></div>
  				</div>
			</div>
		</div>
	</div>
</body>
</html>