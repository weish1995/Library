<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-图书编辑</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 用于初始化
		$booksId = '';
		$bookName = '';
		$author = '';
		$img = '';
		$press = '';
		$pressDate = '';
		$pages = '';
		$language = '';
		$ibsn = '';
		$price = 0.00;
		$theme = '';
		$series = '';
		$summary = '';
		$cateId = 0;
		$keyword = '';
		$inputDate = date('Y-m-d', time());
		$adminName = '';

		// id存在则是修改 不存在则是添加
		if (isset($_GET['booksId'])) {
			$sql = 'select * from books join admin on admin.adminId = books.adminId where booksId = "'.$_GET['booksId'].'"';
			$info = $db->getData($sql)[0];

			$booksId = $info['booksId'];
			$bookName = $info['bookName'];
			$author = $info['author'];
			$img = $info['img'];
			$press = $info['press'];
			$pressDate = $info['pressDate'];
			$pages = $info['pages'];
			$language = $info['language'];
			$ibsn = $info['ibsn'];
			$price = $info['price'];
			$theme = $info['theme'];
			$series = $info['series'];
			$summary = $info['summary'];
			$cateId = $info['cateId'];
			$keyword = $info['keyword'];
			$inputDate = $info['inputDate'];
			$adminName = $info['adminName'];
		}

		// 修改或添加操作
		if (isset($_POST['subOk'])) {
			/* 上传图片 图片存在时 将要上传的图片移动到指定路径 */
			if (!empty($_FILES['img']['name'])) {
				$img = "imgs/".$_FILES['img']['name'];
				move_uploaded_file($_FILES['img']['tmp_name'], dirname(dirname(__FILE__))."\\".$img);
			}

			if ($booksId != '') {
				// 修改信息的sql语句
				$sqlinfo = "update books set bookName = '".$_POST['txtName']."', author = '".$_POST['txtAuthor']."', img = '".$img."', press='".$_POST['txtPress']."', pressDate = '".$_POST['txtPressDate']."', pages = ".$_POST['txtPages'].", language = '".$_POST['selLang']."', ibsn = '".$_POST['txtIbsn']."', price = '".$_POST['txtPrice']."', theme = '".$_POST['txtTheme']."', series = '".$_POST['txtSeries']."', summary = '".$_POST['txtSummary']."', cateId = ".$_POST['selCate'].", keyword = '".$_POST['txtKeyword']."', inputDate = '".date("Y-m-d", time())."', adminId = '".$_SESSION['user']."' where booksId = '".$booksId."'";
			} else {
				// 添加书籍的sql语句
				$booksId = time(); // 时戳 生成id
				$sqlinfo = "insert into books (booksId, bookName, author, img, press, pressDate, pages, language, ibsn, price, theme, series, summary, cateId, keyword, inputDate, adminId) values ('".$booksId."', '".$_POST['txtName']."', '".$_POST['txtAuthor']."', '".$img."', '".$_POST['txtPress']."', '".$_POST['txtPressDate']."', '".$_POST['txtPages']."', '".$_POST['selLang']."', '".$_POST['txtIbsn']."', ".$_POST['txtPrice'].", '".$_POST['txtTheme']."', '".$_POST['txtSeries']."', '".$_POST['txtSummary']."', '".$_POST['selCate']."', '".$_POST['txtKeyword']."', '".date('Y-m-d', time())."', '".$_SESSION['user']."')";
			}

			if ($db->singleOp($sqlinfo)) {
				echo '<script>alert("操作成功");top.location="admin-books.php"</script>';
			} else {
				echo '<script>alert("操作失败");</script>';
			}


		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">图书管理</h3>
			<small class="content-subtitle">编辑图书信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-person"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">添加/修改图书信息</span>
			</div>
		</div>

		<form class="wrap wrap-user-edit" method="post" action="" enctype="multipart/form-data">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>EDIT BOOKS
			</h3>
			<div class="wrap-left">
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtId"><span class="require">*</span>馆藏号：</label>
					<input class="wrap-new-text" name="txtId" id="txtId" value="<?php echo $booksId;?>" type="text"  placeholder="自动生成馆藏号：" disabled>
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtName"><span class="require">*</span>书籍名：</label>
					<input class="wrap-new-text" name="txtName" id="txtName" value="<?php echo $bookName;?>" type="text" required placeholder="请输入书籍名：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtAuthor"><span class="require">*</span>作者：</label>
					<input class="wrap-new-text" type="text" name="txtAuthor" id="txtAuthor" value="<?php echo $author;?>" required placeholder="请输入作者名：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtPress">出版社：</label>
					<input class="wrap-new-text" type="text" name="txtPress" id="txtPress" value="<?php echo $press;?>" placeholder="请输入出版社名字：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtPressDate">出版时间：</label>
					<input class="wrap-new-text" type="date" name="txtPressDate" id="txtPressDate" value="<?php echo $pressDate;?>" placeholder="请输入出版时间：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtPages">页码：</label>
					<input class="wrap-new-text" type="number" name="txtPages" id="txtPages" value="<?php echo $pages;?>" placeholder="请输入页码：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtIbsn">ibsn：</label>
					<input class="wrap-new-text" type="text" name="txtIbsn" id="txtIbsn" value="<?php echo $ibsn;?>"  placeholder="请输入IBSN：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="selLang">语言：</label>
					<select class="wrap-new-text wrap-new-select" name="selLang">
						<option value="中文" <?php if ($language == "中文") echo 'selected'?>>中文</option>
						<option value="英语" <?php if ($language == "英语") echo 'selected'?>>英语</option>
						<option value="法语" <?php if ($language == "法语") echo 'selected'?>>法语</option>
						<option value="日语" <?php if ($language == "日语") echo 'selected'?>>日语</option>
						<option value="德语" <?php if ($language == "德语") echo 'selected'?>>德语</option>
						<option value="韩语" <?php if ($language == "韩语") echo 'selected'?>>韩语</option>
						<option value="俄语" <?php if ($language == "俄语") echo 'selected'?>>俄语</option>
						<option value="泰语" <?php if ($language == "泰语") echo 'selected'?>>泰语</option>
						<option value="其他" <?php if ($language == "其他") echo 'selected'?>>其他</option>
					</select>
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtInputDate">录入时间：</label>
					<input class="wrap-new-text" type="date" name="txtInputDate" id="txtInputDate" value="<?php echo $inputDate;?>"  placeholder="请输入时间：">
				</div>
			</div>
			<div class="wrap-left">
				<div class="wrap-group">
					<label class="wrap-new-label" for="img">图片:</label>
					<input class="wrap-new-text wrap-new-file" type="file" name="img" id="img">
					<img src="../<?php echo $img?>" class="wrap-new-image">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtPrice"><span class="require">*</span>单价：</label>
					<input class="wrap-new-text" type="text" name="txtPrice" id="txtPrice" value="<?php echo sprintf('%.2f', $price);?>" required pattern="^\d*.\d{2}$" placeholder="输入规则：xxx.xx">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtTheme">主题:</label>
					<input class="wrap-new-text" type="text" name="txtTheme" id="txtTheme" value="<?php echo $theme;?>" placeholder="请输入主题：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtSeries">从书号：</label>
					<input class="wrap-new-text" type="text" name="txtSeries" id="txtSeries" value="<?php echo $series;?>" placeholder="请输入从书号：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtKeyword">关键词：</label>
					<input class="wrap-new-text" type="text" name="txtKeyword" id="txtKeyword" value="<?php echo $keyword;?>" placeholder="请输入关键词：">
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="selCate">类别：</label>
					<select class="wrap-new-text wrap-new-select" name="selCate" id="selCate">
						<?php
							// 从数据库里面读取到所有的数据类别
							$allCate = $db->getData('select * from category');
							$selectd = ''; // 默认选中项
							for ($i = 0; $i < sizeof($allCate); $i++) {
								if ($allCate[$i]['cateId'] == $cateId) {
									$selectd = 'selectd';
								} else {
									$selected = '';
								}

								echo '<option value="'.$allCate[$i]['cateId'].'" '.$selectd.'>'.$allCate[$i]['cateName'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtAdminName">上传人：</label>
					<input class="wrap-new-text" type="text" name="txtAdminName" id="txtAdminName" value="<?php echo $adminName;?>" placeholder="请输入关键词：" disabled>
				</div>
				<div class="wrap-group">
					<label class="wrap-new-label" for="txtSummary">概述:</label>
					<textarea class="wrap-new-text wrap-new-area" name="txtSummary" id="txtSummary"><?php echo $summary;?></textarea>
				</div>
			</div>
			<div class="wrap-group wrap-group-btn book-edit-wrap">
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
