<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-详情图书编辑</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 用于初始化
		$eachId = '';
		$bookName = '';
		$floor = 0;
		$shelfNo = 0;
		$addr = '';
		$status = '在馆';

		// id存在则是修改 不存在则是添加
		if (isset($_GET['eachId'])) {
			$sql = 'select * from eachbooks where eachId = "'.$_GET['eachId'].'"';
			$info = $db->getData($sql)[0];

			$eachId = $info['eachId'];
			$floor = $info['floor'];
			$shelfNo = $info['shelfNo'];
			$addr = $info['addr'];
			$status = $info['status'];
		}

		// 未传递booksId 连接到 books页面
		if (isset($_GET['booksId'])) {
			$bookName = $db->getSingleData('select bookName from books where booksId = "'.$_GET['booksId'].'"');
		} else {
			header('location: admin-books.php');
		}

		// 修改或添加操作
		if (isset($_POST['subOk'])) {
			if ($eachId != '') {
				// 修改信息的sql语句
				$sqlinfo = "update eachbooks set floor = ".$_POST['selFloor'].", shelfNo = ".$_POST['selShelf'].", addr = '".$_POST['txtAddr']."' where eachId = '".$eachId."' and booksId = '".$_GET['booksId']."'";
			} else {
				// 添加书籍的sql语句
				$eachId =time(); // 时戳 生成id
				$sqlinfo = 'insert into eachbooks (eachId, booksId, floor, shelfNo, addr, status) values ("'.$eachId.'", "'.$_GET['booksId'].'", "'.$_POST['selFloor'].'", "'.$_POST['selShelf'].'", "'.$_POST['txtAddr'].'", "在馆")';
			}

			if ($db->singleOp($sqlinfo)) {
				echo '<script>alert("操作成功");top.location="admin-eachbooks.php?booksId='.$_GET['booksId'].'"</script>';
			} else {
				echo '<script>alert("操作失败");</script>';
			}


		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">图书管理</h3>
			<small class="content-subtitle">编辑详情图书信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-person"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">添加/修改详情图书信息</span>
			</div>
		</div>

		<form class="wrap wrap-user-edit" method="post" action="">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>EDIT EACHBOOKS
			</h3>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtId"><span class="require">*</span>索书号：</label>
				<input class="wrap-new-text" name="txtId" id="txtId" value="<?php echo $eachId;?>" type="text"  placeholder="自动生成索书号：" disabled>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtName"><span class="require">*</span>书籍名：</label>
				<input class="wrap-new-text" name="txtName" id="txtName" disabled value="<?php echo $bookName;?>" type="text" required placeholder="请输入书籍名：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="selFloor"><span class="require">*</span>楼层号：</label>
				<select class="wrap-new-text wrap-each-select" name="selFloor">
					<?php
						// 从初始化表中读取楼层数
						$floorNum = $db->getSingleData('select value_ from `default` where key_ = "楼层数"');
						$selected = '';

						for ($i = 1; $i <= $floorNum; $i++) {
							if ($i == $floor) {
								$selected = 'selected'; // 设置默认选中
							} else {
								$selected = '';
							}

							echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
						}
					?>
				</select>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="selShelf"><span class="require">*</span>书架号：</label>
				<select class="wrap-new-text wrap-each-select" name="selShelf">
					<?php
						$shelfNum = $db->getSingleData('select value_ from `default` where key_ = "书架数"');
						$selected = '';
						echo $shelfNo;

						for ($i = 1; $i <= $shelfNum; $i++) {
							if ($i == $shelfNo) {
								$selected = 'selected'; // 设置默认选中
							} else {
								$selected = '';
							}

							echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
						}
					?>
				</select>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtAddr"><span class="require">*</span>详细地址：</label>
				<input class="wrap-new-text" type="text" name="txtAddr" id="txtAddr" required value="<?php echo $addr;?>"  placeholder="请输入详细地址：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtAddr"><span class="require">*</span>书籍状态：</label>
				<input class="wrap-new-text" type="text" name="txtAddr" id="txtAddr" disabled required value="<?php echo $status;?>">
			</div>
			<div class="wrap-group wrap-group-btn book-edit-wrap">
				<input class="wrap-new-button" type="submit" name="subOk" value="确定">
				<input class="wrap-new-button" type="reset" name="reset" value="重置">
				<a  class="wrap-new-button" href="admin-eachbooks.php?booksId=<?php echo $_GET['booksId'];?>">返回</a>
			</div>
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>
