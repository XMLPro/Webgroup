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
			
	$sql = 'DELETE FROM task WHERE task = :delete_task';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array(':delete_task' => $_POST['task']));
	
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;	
?>
