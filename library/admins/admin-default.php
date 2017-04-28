<!DOCTYPE html>
<html>
<head>
	<title>系统配置-初始值设置</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 从数据表default中读出 时长超期费用  用于默认显示
		$time = $db->getSingleData('select value_ from `default` where key_ = "时长"');
		$price = $db->getSingleData('select value_ from `default` where key_ = "超期单价"');
		$tele = $db->getSingleData('select value_ from `default` where key_ = "电话"');
		$addr = $db->getSingleData('select value_ from `default` where key_ = "地址"');
		$floors = $db->getSingleData('select value_ from `default` where key_ = "楼层数"');
		$shelf = $db->getSingleData('select value_ from `default` where key_ = "书架数"');
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">初始值设置</h3>
			<small class="content-subtitle">切勿轻易修改，可能会使以前的数据消失</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-option"></i>系统配置
				</span>>
				<span class="content-breadcrumb-span">初始值设置</span>
			</div>
		</div>

		<form class="frm-default wrap" action="" method="post">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-set"></i>DEFAULT
			</h3>
			<label class="frm-default-label" for="txtTime">借阅时长：</label>
			<input class="frm-default-text" type="number" name="txtTime" id="txtTime" required placeholder="请输入时长" min="1" max="10" value="<?php echo $time;?>">月
			<label class="frm-default-label" for="txtPrice">超期费用：</label>
			<input class="frm-default-text" type="text" name="txtPrice" id="txtPrice" required placeholder="请输入费用" pattern="\d.\d" value="<?php echo $price;?>">元/天
			<label class="frm-default-label" for="txtFloors">楼层数：</label>
			<input class="frm-default-text" type="text" name="txtFloors" id="txtFloors" required placeholder="请输入楼层" value="<?php echo $floors;?>">
			<label class="frm-default-label" for="txtShelf">每层书架数：</label>
			<input class="frm-default-text" type="text" name="txtShelf" id="txtShelf" required placeholder="请输入每层的书架数" value="<?php echo $shelf;?>">
			<label class="frm-default-label" for="txtTele">电话：</label>
			<input class="frm-default-text" type="text" name="txtTele" id="txtTele" required placeholder="请输入电话" value="<?php echo $tele;?>">
			<label class="frm-default-label" for="txtAddr">地址：</label>
			<input class="frm-default-text" type="text" name="txtAddr" id="txtAddr" required placeholder="请输入地址" value="<?php echo $addr;?>">
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
		$sqlTele = 'update `default` set value_ = "'.$_POST['txtTele'].'" where key_ = "电话"';
		$sqlAddr = 'update `default` set value_ = "'.$_POST['txtAddr'].'" where key_ = "地址"';
		$sqlFloors = 'update `default` set value_ = "'.$_POST['txtFloors'].'" where key_ = "楼层数"';
		$sqlShelf = 'update `default` set value_ = "'.$_POST['txtShelf'].'" where key_ = "书架数"';

		if ($db->singleOp($sqlTime) && $db->singleOp($sqlPrice) && $db->singleOp($sqlTele) && $db->singleOp($sqlAddr) && $db->singleOp($sqlFloors) && $db->singleOp($sqlShelf)) {
			echo '<script>alert("修改成功"); top.location="admin-default.php";</script>';
		}
	}
?>
