<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-详情书籍</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		if (!isset($_GET['booksId'])) {
			header('location:admin-books.php');
		}

		// 删除
		if (isset($_GET['deleteId'])) {
			if ($db->singleOp('delete from eachbooks where eachId = "'.$_GET['deleteId'].'" and booksId = "'.$_GET['booksId'].'"')) {
				echo '<script>alert("删除成功!")</script>';
			} else {
				echo '<script>alert("删除失败!")</script>';
			}
		}

		// 获取当前书籍的所有详细书籍记录--用于分页
		$sql = 'select * from eachbooks join books on books.booksId = eachbooks.booksId where eachbooks.booksId = "'.$_GET['booksId'].'"';

		$infos = $db->getData($sql); // 存储信息
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">图书管理</h3>
			<small class="content-subtitle">对详细书籍信息进行管理</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-people"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">详细书籍管理</span>
			</div>
		</div>

		<div class="wrap wrap-users">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-eachbook"></i>EACHBOOKS
			</h3>

			<a class="wrap-add wrap-add-each" href="admin-eachbooks-edit.php?booksId=<?php echo $_GET['booksId'];?>"></a>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td">
						索书号
					</div>
					<div class="mytable-th-td">
						书籍名
					</div>
					<div class="mytable-th-td">
						所在楼层
					</div>
					<div class="mytable-th-td">
						所在书架
					</div>
					<div class="mytable-th-td">
						详细所在
					</div>
					<div class="mytable-th-td">
						状态
					</div>
					<div class="mytable-th-td mytable-th-td-large">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['eachId'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['bookName'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['floor'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['shelfNo'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['addr'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['status'];?>
					</div>
					<div class="mytable-tr-td mytable-th-td-large">
						<a class="icon-op delete" title="删除" href="admin-eachbooks.php?deleteId=<?php echo $infos[$i]['eachId'].'&booksId='.$_GET['booksId'];?>">删除</a>
						<a class="icon-op edit" title="编辑" href="admin-eachbooks-edit.php?eachId=<?php echo $infos[$i]['eachId'].'&booksId='.$_GET['booksId'];?>">编辑</a>
						<?php
								if ($infos[$i]['status'] == "在馆" || $infos[$i]['status'] == "预约中") {
									$lendStr = '借书';
									$lendClass = 'lend';
								}
								if ($infos[$i]['status'] == "已借出") {
									$lendStr = '还书';
									$lendClass = 'back';
								}
							?>
						<a class="icon-op <?php echo $lendClass;?>" title="<?php echo $lendStr;?>" href="admin-eachbooks-lend.php?eachId=<?php echo $infos[$i]['eachId']?>"><?php echo $lendStr;?></a>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>
