<!DOCTYPE html>
<html>
<head>
	<title>资源信息-资源下载</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 用于初始化
		$title = '';
		$content = '';
		$newsDate = date('Y-m-d', time());
		$file = '';

		// id存在则是修改 不存在则是添加
		if (isset($_GET['id'])) {
			$info = $db->getData('select * from news where newId = '.$_GET['id'].' and newsType = "资源下载"')[0];

			$title = $info['title'];
			$content = $info['content'];
			$newsDate = $info['newsDate'];
			$file = $info['newsSrc'];
		}

		// 点击按钮后 修改或添加
		if (isset($_POST['subOk'])) {
			$eTitle = $_POST['txtTitle'];
			$eContent = trim($_POST['container']);
			$eAdmin = $_SESSION['user'];
			$eDate = date('Y-m-d', time());

			/* 上传附件 附件存在时 将要上传的附件移动到指定路径 */
			if (!empty($_FILES['txtFile']['name'])) {
				$file = "imgs/".$_FILES['txtFile']['name'];
				move_uploaded_file($_FILES['txtFile']['tmp_name'], dirname(dirname(__FILE__))."\\".$file);
			}

			if (isset($_GET['id'])) {
				// 修改
				$sqlinfo = "update news set title = '".$eTitle."', content = '".$eContent."', adminId = '".$eAdmin."'"
						.", newsDate = '".$eDate."', newsSrc = '".$file."' where newId = ".$_GET['id']." and newsType = '资源下载'";
			} else {
				// 添加
				$sqlinfo = "insert into news (title, content, adminId, newsDate, newsSrc, newsType) values "
						."('".$eTitle."', '".$eContent."', '".$eAdmin."', '".$eDate."', '".$file."', '资源下载')";
			}

			if ($db->singleOp($sqlinfo)) {
				echo '<script>alert("操作成功");top.location="admin-download.php"</script>';
			} else {
				echo '<script>alert("操作失败");</script>';
			}
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">资源下载</h3>
			<small class="content-subtitle">添加/修改资源下载信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-download"></i>资源下载
				</span>>
				<span class="content-breadcrumb-span">添加/修改资源下载</span>
			</div>
		</div>

		<form class="wrap wrap-news-edit" method="post" action="" enctype="multipart/form-data">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>EDIT USER
			</h3>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtTitle"><span class="require">*</span>标题：</label>
				<input class="wrap-new-text" name="txtTitle" id="txtTitle" value="<?php echo $title;?>" type="text" required placeholder="标题">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtFile">附件：</label>
				<input class="wrap-new-text wrap-new-file" name="txtFile" id="txtFile" type="file" placeholder="附件">
				<?php echo $file;?>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtDate"><span class="require">*</span>修改日期：</label>
				<input class="wrap-new-text" name="txtDate" id="txtDate" value="<?php echo $newsDate;?>" type="text" required placeholder="日期" disabled>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="container">说明：</label>
			    <textarea class="wrap-group-textarea" name="container"><?php echo trim($content);?></textarea>
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
</body>
</html>
