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
	if ($dbh == null){
        header("HTTP/1.0 404 Not Found");
    }
	$dbh->query('SET NAMES UTF-8');
	$name = $_POST['username'];
	$sql = 'INSERT INTO user (password) VALUES (?)';
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array($name));
	if ($flag){
        header('Location: index.html');
    }else{
        header("HTTP/1.0 404 Not Found");
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>
</body>
</html>