<!DOCTYPE html>
<html>
<head>
	<title>资源信息-图书馆概述</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
	<!-- 富文本控件 -->
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 修改
		if (isset($_POST['edit'])) {
			if ($db->singleOp("update `default` set value_ = '".$_POST['container']."' where key_ = '图书馆概况'")) {
				echo '<script>alert("修改成功")</script>';
			} else {
				echo '<script>alert("修改失败")</script>';
			}
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">图书馆概述</h3>
			<small class="content-subtitle">对图书馆的简单介绍</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-link"></i>资源信息
				</span>>
				<span class="content-breadcrumb-span">图书馆概述</span>
			</div>
		</div>

		<form class="frm-intr wrap" method="post" action="">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-desc"></i>INTRODUCTION
			</h3>
			<!-- 加载编辑器的容器 -->
		    <script id="container" name="container" class="container" type="text/plain">
		        <?php
		        	// 从数据库中获取数据
		        	echo $db->getSingleData('select value_ from `default` where key_ = "图书馆概况"');
		        ?>
		    </script>
		    <input type="submit" class="wrap-intr-edit" name="edit" value="修改">
		</form>
	</div>


	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
	<!-- 富文本控件 -->

    <!-- 配置文件 -->
    <script type="text/javascript" src="../ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="../ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
		    autoHeightEnabled: true,
		    autoFloatEnabled: true
        });
    </script>
</body>
</html>
