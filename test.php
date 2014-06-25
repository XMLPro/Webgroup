<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>新規登録</title>
</head>
<body>
<?php
$dsn = 'mysql:dbname=WebGroup;host=localhost';
$user = 'WebGroup';
$password = 'divtyu';
try{
    $dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES UTF-8');
	$name = $_POST['username'];
	$sql = 'select * from user';
    foreach ($dbh->query($sql) as $row) {
		if($name == $row['password']){
        	header('Location: issue.html');
			exit;
		}
    }
	header('Location: index.html');
	exit;
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;
?>
<form action="" method="post">
	<input type="text" name="username">
	<input type="submit" value="送信">
</form>
</body>
</html>