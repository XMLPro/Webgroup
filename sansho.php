<?php
session_start();
setcookie("visited",$_POST['username1']);
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
	$name = $_POST['username1'];
	if($name == ""){
		$_SESSION['tyu1'] = '入力してください。';
		header('Location: login.php');
		exit();
	}
	$sql = 'select * from user';
    foreach ($dbh->query($sql) as $row) {    
        if($name == $row['password']){
			header('Location: index.php');
			$_SESSION['name'] = $name;
			$_SESSION['tyu1'] = NULL;
			$_SESSION['error1'] = NULL;
			$_SESSION['ha'] = NULL;
			exit();
		}
    }
	$_SESSION['ha'] = 'その名前は存在しません。';
	header('Location: login.php');
	exit();
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>
