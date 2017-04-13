<!DOCTYPE html>
<html>
<head>
	<title>系统配置-初始值设置</title>
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 从数据表default中读出 时长 和 超期费用  用于默认显示
		$time = $db->getData('select value_ from `default` where key_ = "时长"')[0][0];
		$price = $db->getData('select value_ from `default` where key_ = "超期单价"')[0][0];
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">初始值设置</h3>
			<small class="content-subtitle">需要注意的是，修改之前的数据不会改变。</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon"></i>系统配置
				</span>>
				<span class="content-breadcrumb-span">初始值设置</span>
			</div>
		</div>

		<form class="frm-default wrap" action="" method="post">
			<h3 class="wrap-title">
				<i class="wrap-title-icon"></i>DEFAULT
			</h3>
			<label class="frm-default-label" for="txtTime">借阅时长：</label>
			<input class="frm-default-text" type="number" name="txtTime" id="txtTime" required placeholder="请输入时长" min="1" max="10" value="<?php echo $time;?>">月
			<label class="frm-default-label" for="txtPrice">超期费用：</label>
			<input class="frm-default-text" type="text" name="txtPrice" id="txtPrice" required placeholder="请输入费用" pattern="\d.\d" value="<?php echo $price;?>">元/天
			<input class="frm-default-submit" type="submit" name="subOk" value="修改">
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>

<?php
	// 当点击修改之后 修改数据表里的数据
	if (isset($_POST['subOk']) && $_POST['subOk'] == '修改') {
		$sqlTime = 'update `default` set value_ = "'.$_POST['txtTime'].'" where key_ = "时长"';
		$sqlPrice = 'update `default` set value_ = "'.$_POST['txtPrice'].'" where key_ = "超期单价"';

		if ($db->singleOp($sqlTime) && $db->singleOp($sqlPrice)) {
			echo '<script>alert("修改成功"); top.location="admin-default.php";</script>';
		}
	}
?>
