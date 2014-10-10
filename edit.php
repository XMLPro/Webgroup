<?php
	session_start();
	$dsn = 'mysql:dbname=WebGroup;host=localhost';
	$user = 'WebGroup';
	$password = 'divtyu';
	function h($s) {
    	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
	}	
	try{
		$dbh = new PDO($dsn, $user, $password);
		if ($dbh == null){
			$_SESSION['error1'] = '通信で問題が発生しました。';
			header('Location: login.php');
			exit();
		}
	$dbh->query('SET NAMES UTF-8');
	$after = h($_POST['after']);
	$date = h($_POST['date']);	
	$sql = 'UPDATE task SET task=? , time=? Where task=?';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($after,$date,$_POST['before']));
	
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;	
?>
