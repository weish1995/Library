<!DOCTYPE html>
<html>
<head>
	<title>登录中心</title>
	<link rel="stylesheet" type="text/css" href="css/master.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<form class="frm-login" method="post" action="">
		<input type="text" name="txtUser" placeholder="登录名" required><br />
		<input type="password" name="txtPasswd" placeholder="密码" required><br />
		<input type="radio" name="radRole" value="student" checked>学生
		<input type="radio" name="radRole" value="admin">管理员<br />
		<input type="submit" name="subOk" value="登录">
	</form>
</body>
</html>

<?php 
	include 'data.php';
	session_start();
	$_SESSION['user'] = '';
	$_SESSION['passwd'] = '';
	$_SESSION['role'] = '';

	var db = new DataBase();
	if (isset($_POST['subOk']) && $_POST['subOk'] == '登录') {
		var user = $_POST['txtUser'];
		var passwd = $_POST['txtPasswd'];

		var sql = 'select * from students '
	}
?>