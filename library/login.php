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
	date_default_timezone_set('PRC');
	$_SESSION['user'] = '';
	$_SESSION['role'] = ''; // 重新访问登录页面时，将session的值置空

	$db = new DataBase(); // 数据库操作类

	if (isset($_POST['subOk']) && $_POST['subOk'] == '登录') { // 点击登录按钮
		$user = $_POST['txtUser'];
		$passwd = $_POST['txtPasswd'];
		$role = $_POST['radRole'];
		$sql = '';

		if ($role == 'student') { // 学生登录
			$sql .= 'select * from students where studentId = "'.$user.'" and passwd = "'.$passwd.'"';

			if ($db->dataSet($sql)) { // 检测是否存在
				$_SESSION['user'] = $user;
				$_SESSION['role'] = 'student';

				// 记录每一次登录的信息，写入到loginfo表里
				$locIp = getenv('HTTP_CLIENT_IP');
				$db->singleOp('insert into loginfo (studentId, logDate, logAddr)  values ("'.$_SESSION['user'].'", "'.date('Y-m-d H:i:s', time()).'", "'.$locIp.'")');

				header('location:students/student-index.php');
			} else {
				echo '<script>alert("登录名或密码错误")</script>';
			}
		} else { // 管理员登录
			$sql .= 'select * from admin where adminId = "'.$user.'" and passwd = "'.$passwd.'"';

			if ($db->dataSet($sql)) { // 检测是否存在
				$_SESSION['user'] = $user;
				$_SESSION['role'] = 'admin';
				header('location:admins/admin-index.php');
			} else {
				echo '<script>alert("登录名或密码错误")</script>';
			}
		}
	}
?>