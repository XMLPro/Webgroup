<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>新規登録</title>
</head>
<body>
<?php
session_start();
$dsn = 'mysql:dbname=WebGroup;host=localhost';
$user = 'WebGroup';
$password = 'divtyu';
try{
    $dbh = new PDO($dsn, $user, $password);
	if ($dbh == null){
        $_SESSION['error'] = '通信で問題が発生しました。';
		header('Location: login.php');
		exit();
    }
	$dbh->query('SET NAMES UTF-8');
	$name = $_POST['username'];
	if($name == ""){
		$_SESSION['tyu'] = '入力してください。';
		header('Location: login.php');
		exit();
	}
	$sql = 'select * from user';
    foreach ($dbh->query($sql) as $row) {    
        if($name == $row['password']){
			$_SESSION['test'] = 'その名前は既に使われています。';
			header('Location: login.php');
			exit();
		}
    }
	$sql = 'INSERT INTO user (password) VALUES (?)';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($name));
	if ($flag){
        header('Location: index.php');
		$_SESSION['name'] = $name;
		$_SESSION['test'] = NULL;
		$_SESSION['error'] = NULL;
		$_SESSION['tyu'] = NULL;
		exit();
    }else{
        $_SESSION['error'] = '通信で問題が発生しました。';
		header('Location: login.php');
		exit();
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>
</body>
</html>