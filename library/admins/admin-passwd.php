<!DOCTYPE html>
<html>
<head>
	<title>系统配置-修改密码</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">修改密码</h3>
			<small class="content-subtitle">经常更换密码更安全哟</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-option"></i>系统配置
				</span>>
				<span class="content-breadcrumb-span">修改密码</span>
			</div>
		</div>

		<form class="frm-passwd wrap" action="" method="post">
			<h3 class="frm-passwd-title wrap-title">
				<i class="frm-passwd-title-icon wrap-title-icon header-menu-icon-lock"></i>PASSWORD
			</h3>
			<input class="frm-passwd-input" type="password" name="txtOldPwd" placeholder="请输入旧密码" required>
			<input class="frm-passwd-input frm-passwd-newpwd" type="password" name="txtNewPwd" placeholder="请输入密码，6-16位" required pattern="\w{6,16}">
			<input class="frm-passwd-input frm-passwd-newagain" type="password" name="txtNewAgain" placeholder="确认密码" required>
			<input class="frm-passwd-submit" type="submit" name="btnOk" value="修改">
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>

<?php
	// 点击了修改密码按钮
	if (isset($_POST['btnOk']) && $_POST['btnOk'] == '修改') {
		$oldPasswd = $_POST['txtOldPwd']; // 旧密码
		$newPasswd = $_POST['txtNewPwd']; // 新密码

		// 检测输入旧密码是否正确的sql语句
		$sqlOld = 'select * from admin where adminId = "'.$_SESSION['user'].'" and passwd = "'.$oldPasswd.'"';

		if ($db->dataSet($sqlOld)) {
			// 修改密码的sql语句
			$sqlNew = 'update admin set passwd = "'.$newPasswd.'" where adminId = "'.$_SESSION['user'].'"';

			if ($db->singleOp($sqlNew)) {
				echo '<script>alert("密码修改成功")</script>';
			}
		} else {
			echo '<script>alert("旧密码错误")</script>';
		}
	}
?>