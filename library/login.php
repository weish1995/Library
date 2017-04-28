<!DOCTYPE html>
<html>
<head>
	<title>登录中心</title>
	<link rel="stylesheet" type="text/css" href="css/index-master.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<?php 
		include 'index-master-header.php';
	?>
	<form class="frm-login" method="post" action="">
		<label class="login-label" for="txtUser">用户名：</label>
		<input type="text" class="login-text" name="txtUser" id="txtUser" placeholder="登录名" required />
		<label class="login-label" for="txtPasswd">密码：</label>
		<input type="password" class="login-text" name="txtPasswd" id="txtPasswd" placeholder="密码" required />
		<div class="login-radio-wrap">
			<input class="login-radio" type="radio" name="radRole" id="radStudent" value="student" checked>
			<label class="login-radio-label" for="radStudent">学生</label>
			<input class="login-radio" type="radio" name="radRole" id="radAdmin" value="admin">
			<label class="login-radio-label" for="radAdmin">管理员</label>
		</div>
		<div class="login-btn-wrap">
			<input class="login-btn" type="submit" name="subOk" value="登录">
		</div>
	</form>
	<?php 
		include 'index-master-footer.php';
	?>
</body>
</html>

<?php 
	$_SESSION['user'] = '';
	$_SESSION['role'] = ''; // 重新访问登录页面时，将session的值置空

	// 获取url参数 
	if (isset($_GET['url'])) {
		$url = $_GET['url'];
	} else {
		$url = '';
	}

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

				// 实时更新欠款记录表 owe表
				// 获取到超期的借阅记录
				$infoOverDue = $db->getData('select *from records where studentId = "'.$_SESSION['user'].'" and endDate > destine');

				// 获取超期一天的费用
				$price = $db->getSingleData('select value_ from `default` where key_="超期单价"');
				
				// 遍历这些记录 看有没有写入到欠款记录表里面
				for ($i = 0; $i < count($infoOverDue); $i++) {
					// 判断是否已经写入过数据库了
					if (!$db->dataSet('select * from owe where recordId = '.$infoOverDue[$i]['recordId'].' and season = "所借书籍超期"')) {
						// 计算超期时间
						$diff = floor((strtotime($infoOverDue[$i]['endDate']) - strtotime($infoOverDue[$i]['destine'])) / 86400);// 根据时间戳的差值除以一天的秒数得到时间的差值
						$oweMoney = $diff * $price; // 计算欠费
						$sqlIn = 'insert into owe (recordId, season, oweMoney, repay, oweDate) values ('.$infoOverDue[$i]['recordId'].', "所借书籍超期", '.$oweMoney.', '.$oweMoney.', "'.$infoOverDue[$i]['endDate'].'")';
						$db->singleOp($sqlIn);
					}
				}

				if ($url == '') {
					header('location:students/student-index.php');
				} else {
					header('location:'.$url);
				}
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