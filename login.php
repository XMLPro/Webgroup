<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
	href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container">
	<h3>TODOLIST</h3>
	<div class="hero-unit">
		<h1>Hello!</h1>
		<h3>Login</h3>
	
		<p><div id="form">
				<strong>ユーザ名</strong> <input type="text" placeholder="username">
				<label>
        			<input type="checkbox"> パスワードを保存する
     			 </label>
			</div>
		</p>
		<p>
			<div id="Lbtn">
				<a class="btn btn-large btn-primary" href="#"><i class="icon-ok"></i> Log In</a>
			</div>
		</p>
	</div>
	<div id = "newcomer">
		<form action="newcomer.php" method="post">
		<strong>新規ユーザ名</strong> <input type="text" placeholder="username" name="username">
				<label>
        			<input type="checkbox"> パスワードを保存する
     			 </label>
				<!--<a class="btn btn-large btn-primary"><i class="icon-ok"></i>登録</a>-->
				<input type="submit">
				<?php session_start(); ?>
				<?php	if(isset($_SESSION['error'])): ?>
					<p><?php echo $_SESSION['error'];?></p>
				<?php endif; ?>
				<?php	if(isset($_SESSION['test'])): ?>
					<p><?php echo $_SESSION['test'];?></p>					
				<?php endif; ?>
		</form>
	</div>
</div>
<script type="text/javascript"
src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script> 
<script type="text/javascript"
src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
</script>
</body>
</html>