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

		// 获取所有读者记录--用于分页
		$sql = 'select * from eachbooks join books on books.booksId = eachbooks.booksId where eachbooks.booksId = "'.$_GET['booksId'].'"';
		$counts = $db->getNum($sql);
		$onePage = 10 > $counts ? $counts : 10; // 一页显示10条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取学生信息指定长度的登录日志信息sql
		$logSql = $sql;

		$sortStr = ''; // 存储url上的sort和sortType链接 

		// 排序以及排序方式
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort']; // 排序字段值
			$sortStr .= '&sort='.$sort; // 排序字符串

			if (isset($_GET['sortType'])) { // 排序方式  升序 或者 降序
				$sortType = $_GET['sortType'];
				$sortStr .= '&sortType='.$sortType;
			} else {
				$sortType = '';
			}

			$logSql .= ' order by '.$sort.' '.$sortType;
		}

		// 分页限制
		$logSql .= ' limit '.($page - 1) * $onePage.', '.$onePage;

		$infos = $db->getData($logSql); // 存储信息
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
						<a class="delete" href="admin-eachbooks.php?deleteId=<?php echo $infos[$i]['eachId'].'&booksId='.$_GET['booksId'];?>">删除</a>
						<a href="admin-eachbooks-edit.php?eachId=<?php echo $infos[$i]['eachId'].'&booksId='.$_GET['booksId'];?>">编辑</a>
						<a class="lend" href="admin-eachbooks.php?lendId=<?php echo $infos[$i]['eachId'].'&booksId='.$_GET['booksId'];?>">借出</a>
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
