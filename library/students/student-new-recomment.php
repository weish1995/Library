<!DOCTYPE html>
<html>
<head>
	<title>图书推荐-添加推荐</title>
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		include 'student-master.php'; 
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">我的推荐</h3>
			<small class="content-subtitle">向管理员推荐优秀的书籍吧</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon"></i>推荐信息
				</span>>
				<span class="content-breadcrumb-span">新建推荐</span>
			</div>
		</div>

		<form class="wrap wrap-new-recom" method="post" action="">
			<h3 class="wrap-title">
				<i class="wrap-title-icon"></i>NEW RECOMMEND
			</h3>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtName"><span class="require">*</span>书籍名：</label>
				<input class="wrap-new-text" type="text" name="txtName" id="txtName" required placeholder="请输入书籍名：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtAuthor"><span class="require">*</span>作者：</label>
				<input class="wrap-new-text" type="text" name="txtAuthor" id="txtAuthor" required placeholder="请输入作者：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtPress"><span class="require">*</span>出版社：</label>
				<input class="wrap-new-text" type="text" name="txtPress" id="txtPress" required placeholder="请输入出版社：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtIbsn"><span class="require">*</span>IBSN</label>
				<input class="wrap-new-text" type="text" name="txtIbsn" id="txtIbsn" required placeholder="请输入IBSN：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtReason"><span class="require">*</span>推荐理由：</label>
				<textarea class="wrap-new-text" id="txtReason" name="txtReason" placeholder="请输入推荐理由："></textarea>
			</div>
			<div class="wrap-group">
				<input class="wrap-new-button" type="submit" name="subAdd" value="添加">
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
	if (isset($_POST['subAdd']) && $_POST['subAdd'] == '添加') {
		// 点击添加之后将数据写入数据库
		$sqlRecom = 'insert into recommends (studentId, bookName, author, press, ibsn, reason, recomDate, recomType) values'
					.'("'.$_SESSION['user'].'", "'.$_POST['txtName'].'", "'.$_POST['txtAuthor'].'", "'.$_POST['txtPress'].'", "'.$_POST['txtIbsn'].'", "'.$_POST['txtReason'].'", "'.date('Y-m-d', time()).'", "未购买")';

		echo $sqlRecom;

		if ($db->singleOp($sqlRecom)) {
			echo '<script>alert("推荐成功");top.location="student-recomment.php";</script>';
		} else {
			echo '<script>alert("推荐失败");</script>';
		}
	}
?>