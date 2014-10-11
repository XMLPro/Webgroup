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
	$delete = $_POST['task'];
	for($i = 0; $i < count($delete); $i++){
		$delete_h = h($delete[$i]);			
		$sql = 'DELETE FROM task WHERE task = ? AND password=?';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($delete_h,$_SESSION['name']));
	}
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	$dbh = null;
?>
 