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

		// 删除
		if (isset($_GET['deleteId'])) {
			if ($db->singleOp('delete from news where newId = "'.$_GET['deleteId'].'" and newsType = "资源下载"')) {
				echo '<script>alert("删除成功!")</script>';
			} else {
				echo '<script>alert("删除失败!")</script>';
			}
		}

		// 获取检索词  通过表单提交或url传递
		if (isset($_POST['btnSearch']) || isset($_GET['txtSearch'])) {
			$txtSearch = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : $_GET['txtSearch'];

			// 用于搜索时拼接到sql上的语句
			$searchStr = ' where title like "%'.$txtSearch.'%" ';
		} else {
			$searchStr = ''; // 没有检索词则不需要更改sql
		}

		// 获取所有记录--用于分页
		// sql语句
		$logSql = 'select * from news join admin on news.adminId = admin.adminId '.$searchStr.' and newsType = "资源下载"';
		$counts = $db->getNum($logSql);
		$onePage = 12 > $counts ? $counts : 12; // 一页显示12条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

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

		// 搜索排序
		if (isset($txtSearch)) {
			$sortStr .= '&txtSearch='.$txtSearch;
		}

		// 分页限制
		$logSql .= ' limit '.($page - 1) * $onePage.', '.$onePage;

		$infos = $db->getData($logSql); // 存储信息
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">资源下载</h3>
			<small class="content-subtitle">书籍相关文档，电子版</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-link"></i>资源信息
				</span>>
				<span class="content-breadcrumb-span">资源下载</span>
			</div>
		</div>

		<div class="wrap wrap-users">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-download"></i>DOWNLOAD
			</h3>

			<form class="wrap-search" action="" method="get">
				<a class="wrap-add" href="admin-download-edit.php"></a>
				<input class="wrap-search-text" type="text" name="txtSearch" placeholder="标题名 检索" value="<?php 
						if (isset($txtSearch)) {
							echo $txtSearch;
						}
					?>">
				<input class="wrap-search-btn" type="submit" name="btnSearch" value="搜索">
			</form>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-large" alt="title">
						标题<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="newsDate">
						发布时间<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="adminName">
						发布人<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-large">
						<?php echo $infos[$i]['title'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['newsDate'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['adminName'];?>
					</div>
					<div class="mytable-tr-td">
						<a class="icon-op delete" title="删除" href="admin-download.php?deleteId=<?php echo $infos[$i]['newId'];?>">删除</a>
						<a class="icon-op edit" title="编辑" href="admin-download-edit.php?id=<?php echo $infos[$i]['newId'];?>">编辑</a>
					</div>
				</div>
				<?php
					}
				?>
			</div>

			<!-- 分页 -->
			<div class="pages">
				<span class="pages-loc"><?php echo $page.' / '.$allPages;?> 页</span>
				<?php 
					if ($page == 1) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">首页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">上一页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="admin-download.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="admin-download.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="admin-download.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="admin-download.php?page='.$allPages.$sortStr.'">尾页</a>';
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
