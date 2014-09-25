<?php
	session_start();
	$dsn = 'mysql:dbname=WebGroup;host=localhost';
	$user = 'WebGroup';
	$password = 'divtyu';
	function h($s) {
    	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
	}
	$array = array();
	try{
		$dbh = new PDO($dsn, $user, $password);
		if ($dbh == null){
			$_SESSION['error1'] = '通信で問題が発生しました。';
			header('Location: login.php');
			exit();
		}
	$dbh->query('SET NAMES UTF-8');
	$achieve = h($_POST['task']);		
	$sql = 'UPDATE task set important = 1 WHERE task = ?';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($achieve));
	
	$sql = 'select * from task';
	foreach ($dbh->query($sql) as $row) {    
		if($row['important'] == 1){
			array_push($array,$row['task']);
		}
	}
	$_SESSION['achieve'] = $array;
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;
?>