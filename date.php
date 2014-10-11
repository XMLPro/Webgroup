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
	$array = array();
	$$sql = 'select * from task';
		foreach ($dbh->query($sql) as $row) {    
			if($_SESSION['name'] == $row['password']){
				if(!in_array($row['time'],$array)){
					array_push($array,$row['time']);
				}
			}
		}
	echo json_encode($array);
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;	
?>