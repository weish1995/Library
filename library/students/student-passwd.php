<!DOCTYPE html>
<html>
<head>
	<title>我的首页</title>
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/student-passwd.css">
</head>
<body>
	<?php include 'student-master.php'; ?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">修改密码</h3>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon"></i>个人中心
				</span>>
				<span class="content-breadcrumb-span">修改密码</span>
			</div>
		</div>

		<form class="frm-passwd" action="" method="post">
			<h3 class="frm-passwd-title">
				<i class="frm-passwd-title-icon"></i>PASSWORD
			</h3>
			<input class="frm-passwd-input" type="password" name="txtOldPwd" placeholder="请输入旧密码" required>
			<input class="frm-passwd-input frm-passwd-newpwd" type="password" name="txtNewPwd" placeholder="请输入密码" required>
			<input class="frm-passwd-input frm-passwd-newagain" type="password" name="txtNewAgain" placeholder="确认密码" required>
			<input class="frm-passwd-submit" type="submit" name="btnOk" value="提交">
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-passwd.js"></script>
</body>
</html>