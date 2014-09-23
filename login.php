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
		<?php session_start(); ?>
		<p><div id="form">
			<form action="sansho.php" method="post">
				<strong>ユーザ名</strong> <input type="text" placeholder="username" name="username1" value="<?php if(isset($_COOKIE["visited"])) echo $_COOKIE["visited"] ; ?>">
				 <?php if(isset($_SESSION['tyu1'])): ?>
					<p><?php echo $_SESSION['tyu1']; ?></p>
					<?php $_SESSION['tyu1'] = NULL; ?>
				<?php endif; ?>			
				<?php	if(isset($_SESSION['error1'])): ?>
					<p><?php echo $_SESSION['error1']; ?></p>
					<?php $_SESSION['error1'] = NULL; ?>
				<?php endif; ?>
				<?php	if(isset($_SESSION['ha'])): ?>
					<p><?php echo $_SESSION['ha']; ?></p>
					<?php $_SESSION['ha'] = NULL; ?>
					<?php ?>					
				<?php endif; ?>
			</div>
		</p>
		<input type="submit" value="ログイン">
		<!--
		<p>
			<div id="Lbtn">
				<a class="btn btn-large btn-primary" href="#"><i class="icon-ok"></i> Log In</a>
			</div>
		</p>
		-->
		</form>
	</div>
	<div id = "newcomer">
		<form action="newcomer.php" method="post">
		<strong>新規ユーザ名</strong> <input type="text" placeholder="username" name="username">
				<input type="submit">
				<?php if(isset($_SESSION['tyu'])): ?>
					<p><?php echo $_SESSION['tyu']; ?></p>
					<?php $_SESSION['tyu'] = NULL; ?>
				<?php endif; ?>			
				<?php	if(isset($_SESSION['error'])): ?>
					<p><?php echo $_SESSION['error']; ?></p>
					<?php $_SESSION['error'] = NULL; ?>
				<?php endif; ?>
				<?php	if(isset($_SESSION['test'])): ?>
					<p><?php echo $_SESSION['test']; ?></p>
					<?php $_SESSION['test'] = NULL; ?>
					<?php ?>					
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