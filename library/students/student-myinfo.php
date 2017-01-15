<!DOCTYPE html>
<html>
<head>
	<title>个人中心-我的资料</title>
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		include 'student-master.php'; 

		// 获取当前用户的个人资料
		$myinfo = $db->getData('select * from students where studentId = "'.$_SESSION['user'].'"')[0];
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">我的资料</h3>
			<small class="content-subtitle">记得要完善自己的资料哦</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon"></i>个人中心
				</span>>
				<span class="content-breadcrumb-span">我的资料</span>
			</div>
		</div>

		<form class="wrap wrap-myinfo" method="post" action="" enctype="multipart/form-data">
			<h3 class="wrap-title">
				<i class="wrap-title-icon"></i>PROFILE
			</h3>
			<div class="wrap-myinfo-group">
				<label class="wrap-myinfo-half" for="txtName">姓名：</label>
				<input class="wrap-myinfo-text wrap-myinfo-half" type="text" name="txtName" id="txtName" placeholder="请输入姓名：" value="<?php echo $myinfo['studentName'];?>">
			</div>
			<div class="wrap-myinfo-group">
				<label class="wrap-myinfo-half" for="txtPhoto">修改照片：</label>
				<input class="wrap-myinfo-text wrap-myinfo-half" type="file" name="txtPhoto" id="txtPhoto"  accept=".png,.jpg,.jpeg,.gif">
			</div>
			<label for="txtTel">电话：</label>
			<input class="wrap-myinfo-text" type="text" name="txtTel" id="txtTel" placeholder="请输入电话：" value="<?php echo $myinfo['tel'];?>">
			<label for="txtQq">QQ：</label>
			<input class="wrap-myinfo-text" type="text" name="txtQq" id="txtQq" placeholder="请输入QQ：" value="<?php echo $myinfo['qq'];?>">
			<label for="txtEmail">Email：</label>
			<input class="wrap-myinfo-text" type="email" name="txtEmail" id="txtEmail" placeholder="请输入电子邮箱：" value="<?php echo $myinfo['email'];?>">
			<label for="txtAddr">地址：</label>
			<input class="wrap-myinfo-text" type="text" name="txtAddr" id="txtAddr" placeholder="请输入地址：" value="<?php echo $myinfo['address'];?>">
			<input class="wrap-myinfo-button" type="submit" name="subOk" value="修改">
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
</body>
</html>

<?php
	if (isset($_POST['subOk']) && $_POST['subOk'] == '修改') {
		$imgName = $myinfo['photo']; // 存储上传的图片的路径，未上传则存储的是原图片路径

		/* 上传图片 图片存在时 将要上传的图片移动到指定路径 */
		if (!empty($_FILES['txtPhoto']['name'])) {
			$imgName = "imgs/".$_FILES['txtPhoto']['name'];
			move_uploaded_file($_FILES['txtPhoto']['tmp_name'], dirname(dirname(__FILE__))."\\".$imgName);
		}

		// 修改资料的sql语句
		$sqlinfo = 'update students set studentName = "'.$_POST['txtName'].'", photo = "'.$imgName.'", email="'.$_POST['txtEmail'].'", address = "'.$_POST['txtAddr'].'", qq = "'.$_POST['txtQq'].'", tel = "'.$_POST['txtTel'].'" where studentId = "'.$_SESSION['user'].'"';

		if ($db->singleOp($sqlinfo)) {
			echo '<script>alert("修改成功");top.location="student-myinfo.php"</script>';
		} else {
			echo '<script>alert("修改失败");top.location="student-myinfo.php"</script>';
		}
	}
?>