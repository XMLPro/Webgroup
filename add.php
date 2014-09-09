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
			
	$sql = 'INSERT INTO task (task,password) VALUES (?,?)';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($_POST['task'],$_SESSION['name']));
	
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;	
?>