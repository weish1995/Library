<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-读者编辑</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 用于初始化
		$studentId = '';
		$name = '';
		$passwd = '';
		$tele = '';
		$email = '';
		$qq = '';
		$addr = '';

		// id存在则是修改 不存在则是添加
		if (isset($_GET['studentId'])) {
			$studentInfo = $db->getData('select * from students where studentId = "'.$_GET['studentId'].'"')[0];

			$studentId = $_GET['studentId'];
			$name = $studentInfo['studentName'];
			$passwd = $studentInfo['passwd'];
			$tele = $studentInfo['tel'];
			$email = $studentInfo['email'];
			$qq = $studentInfo['qq'];
			$addr = $studentInfo['address'];
			$photo = $studentInfo['photo'];
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">读者管理</h3>
			<small class="content-subtitle">添加/修改读者信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-person"></i>读者管理
				</span>>
				<span class="content-breadcrumb-span">添加/修改读者信息</span>
			</div>
		</div>

		<form class="wrap wrap-user-edit" method="post" action="" enctype="multipart/form-data">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>EDIT USER
			</h3>
			<div class="wrap-left">
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtId"><span class="require">*</span>读者Id：</label>
					<input class="wrap-new-text" name="txtId" id="txtId" value="<?php echo $studentId;?>" type="text" required placeholder="读者Id" <?php if ($studentId != '') echo 'disabled=""';?>>
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtName"><span class="require">*</span>姓名：</label>
					<input class="wrap-new-text" type="text" name="txtName" id="txtName" value="<?php echo $name;?>" required placeholder="请输入姓名：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtTele">联系方式：</label>
					<input class="wrap-new-text" type="text" name="txtTele" id="txtTele" value="<?php echo $tele;?>" placeholder="请输入联系方式：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtQq">qq：</label>
					<input class="wrap-new-text" type="text" name="txtQq" id="txtQq" value="<?php echo $qq;?>" placeholder="请输入QQ：">
				</div>
			</div>
			<div class="wrap-left">
				<div class="wrap-group">
					<label class="wrap-new-label" for="photo">头像：</label>
					<input class="wrap-new-text wrap-new-file" type="file" name="photo" id="photo">
					<img src="../<?php echo $photo?>" class="wrap-new-image">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtPasswd"><span class="require">*</span>密码：</label>
					<input class="wrap-new-text" type="text" name="txtPasswd" id="txtPasswd" value="<?php echo $passwd;?>" required pattern="\w{6,16}" placeholder="请输入密码：6-16位">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtEmail">Email:</label>
					<input class="wrap-new-text" type="email" name="txtEmail" id="txtEmail" value="<?php echo $email;?>" placeholder="请输入Email：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtAddr">地址：</label>
					<input class="wrap-new-text" type="text" name="txtAddr" id="txtAddr" value="<?php echo $addr;?>" placeholder="请输入地址：">
				</div>
			</div>
			<div class="wrap-group wrap-group-btn">
				<input class="wrap-new-button" type="submit" name="subOk" value="确定">
				<input class="wrap-new-button" type="reset" name="reset" value="重置">
			</div>
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>

<?php
	// 修改或添加操作
	if (isset($_POST['subOk'])) {
		/* 上传图片 图片存在时 将要上传的图片移动到指定路径 */
		if (!empty($_FILES['photo']['name'])) {
			$imgName = "imgs/".$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'], dirname(dirname(__FILE__))."\\".$imgName);
		} else {
			$imgName = $photo;
		}

		if ($studentId != '') {
			// 修改资料的sql语句
			$sqlinfo = 'update students set studentName = "'.$_POST['txtName'].'", photo = "'.$imgName.'", passwd = "'.$_POST['txtPasswd'].'", email="'.$_POST['txtEmail'].'", address = "'.$_POST['txtAddr'].'", qq = "'.$_POST['txtQq'].'", tel = "'.$_POST['txtTele'].'" where studentId = "'.$studentId.'"';
		} else {
			// 检测用户id是否存在  若存在则不执行下面的操作
			if ($db->dataSet('select * from students where studentId = "'.$_POST['txtId'].'"')) {
				echo '<script>alert("用户名已存在");</script>';
				return;
			}

			// 添加用户的sql语句
			$sqlinfo = 'insert into students (studentId, studentName, photo, passwd, email, address, qq, tel) values '
					.'("'.$_POST['txtId'].'", "'.$_POST['txtName'].'", "'.$imgName.'", "'.$_POST['txtPasswd'].'", "'
					.$_POST['txtEmail'].'", "'.$_POST['txtAddr'].'", "'.$_POST['txtQq'].'", "'.$_POST['txtTele'].'")';
		}

		if ($db->singleOp($sqlinfo)) {
			echo '<script>alert("操作成功");top.location="admin-user.php"</script>';
		} else {
			echo '<script>alert("操作失败");</script>';
		}
	}
?>
