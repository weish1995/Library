<!DOCTYPE html>
<html>
<head>
	<title>资源信息-新闻通知</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 点击按钮后 修改或添加
		if (isset($_POST['subOk'])) {
			$eTitle = $_POST['txtTitle'];
			$eContent = $_POST['container'];
			$eAdmin = $_SESSION['user'];
			$eDate = date('Y-m-d', time());

			if (isset($_GET['id'])) {
				// 修改
				$sqlinfo = "update news set title = '".$eTitle."', content = '".$eContent."', adminId = '".$eAdmin."'"
						.", newsDate = '".$eDate."' where newId = ".$_GET['id']." and newsType = '新闻通知'";
			} else {
				// 添加
				$sqlinfo = "insert into news (title, content, adminId, newsDate, newsType) values ('".$eTitle."', '".$eContent."', '".$eAdmin."', '".$eDate."', '新闻通知')";
			}

			if ($db->singleOp($sqlinfo)) {
				echo '<script>alert("操作成功");top.location="admin-news.php"</script>';
			} else {
				echo '<script>alert("操作失败");</script>';
			}
		}

		// 用于初始化
		$title = '';
		$content = '';
		$newsDate = date('Y-m-d', time());

		// id存在则是修改 不存在则是添加
		if (isset($_GET['id'])) {
			$info = $db->getData('select * from news where newId = '.$_GET['id'].' and newsType = "新闻通知"')[0];

			$title = $info['title'];
			$content = $info['content'];
			$newsDate = $info['newsDate'];
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">新闻通知</h3>
			<small class="content-subtitle">添加/修改新闻通知信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-email"></i>新闻通知
				</span>>
				<span class="content-breadcrumb-span">添加/修改新闻通知信息</span>
			</div>
		</div>

		<form class="wrap wrap-news-edit" method="post" action="" enctype="multipart/form-data">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>EDIT USER
			</h3>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtTitle"><span class="require">*</span>标题：</label>
				<input class="wrap-new-text" name="txtTitle" id="txtTitle" value="<?php echo $title;?>" type="text" required placeholder="新闻标题">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtDate"><span class="require">*</span>修改日期：</label>
				<input class="wrap-new-text" name="txtDate" id="txtDate" value="<?php echo $newsDate;?>" type="text" required placeholder="日期" disabled>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="container">内容：</label>
				<!-- 加载编辑器的容器 -->
			    <script id="container" name="container" class="container" type="text/plain">
			        <?php
			        	// 初始化
			        	echo $content;
			        ?>
			    </script>
			</div>
			<div class="wrap-group">
				<input type="submit" name="subOk" value="确定">
				<input class="wrap-news-edit-btn" type="reset" name="txtSet" value="重置">
			</div>
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
