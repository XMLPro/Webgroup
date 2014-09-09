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
			
	$sql = 'UPDATE task SET task=? Where task=?';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($_POST['after'],$_POST['before']));
	
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;	
?>
