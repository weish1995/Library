<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-读者管理</title>
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
			if ($db->singleOp('delete from students where studentId = "'.$_GET['deleteId'].'"')) {
				echo '<script>alert("删除成功!")</script>';
			} else {
				echo '<script>alert("删除失败!")</script>';
			}
		}

		// 从默认表里获取到超期每天的费用
		$price = $db->getSingleData('select value_ from `default` where key_ = "超期单价"');

		// 获取检索词  通过表单提交或url传递
		if (isset($_POST['btnSearch']) || isset($_GET['txtSearch'])) {
			$txtSearch = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : $_GET['txtSearch'];

			// 用于搜索时拼接到sql上的语句
			$searchStr = ' where studentId like "%'.$txtSearch.'%" or studentName like "%'.$txtSearch.'%" ';
		} else {
			$searchStr = ''; // 没有检索词则不需要更改sql
		}

		// 获取所有读者记录--用于分页
		$counts = $db->getNum('select * from students'.$searchStr);
		$onePage = 10 > $counts ? $counts : 10; // 一页显示10条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取学生信息指定长度的登录日志信息sql
		$logSql = 'select * from students'.$searchStr;

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
			<h3 class="content-title">读者管理</h3>
			<small class="content-subtitle">对读者的信息进行管理</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-people"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">读者管理</span>
			</div>
		</div>

		<div class="wrap wrap-users">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-allcomm"></i>USERS
			</h3>

			<form class="wrap-search" action="" method="get">
				<a class="wrap-add" href="admin-user-edit.php"></a>
				<input class="wrap-search-text" type="text" name="txtSearch" placeholder="Id/姓名 检索" value="<?php 
						if (isset($txtSearch)) {
							echo $txtSearch;
						}
					?>">
				<input class="wrap-search-btn" type="submit" name="btnSearch" value="搜索">
			</form>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td">
						头像
					</div>
					<div class="mytable-th-td" alt="studentId">
						读者号<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="studentName">
						姓名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="passwd">
						密码<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">
						欠款金额
					</div>
					<div class="mytable-th-td" alt="money">
						缴费金额<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td">
						<img class="mytable-tr-td-img" src="../<?php echo $infos[$i]['photo'];?>">
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['studentId'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['studentName'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['passwd'];?>
					</div>
					<div class="mytable-tr-td">
						<?php
							// 获取超期天数总数
							$sqlDiff= 'select sum(timestampdiff(DAY, destine, endDate)) from records where studentId = "'.$infos[$i]['studentId'].'" and endDate > destine';

							$diff = floatval($db->getSingleData($sqlDiff)); // 获取并转换为浮点数

							echo number_format($diff * $price, 2);
						?>
					</div>
					<div class="mytable-tr-td">
						<?php echo number_format($infos[$i]['money'], 2);;?>
					</div>
					<div class="mytable-tr-td">
						<a class="icon-op delete" title="删除" href="admin-user.php?deleteId=<?php echo $infos[$i]['studentId'];?>">删除</a>
						<a class="icon-op edit" title="编辑(缴费)" href="admin-user-edit.php?studentId=<?php echo $infos[$i]['studentId'];?>">编辑(缴费)</a>
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
						echo '<a class="tobutton pages-op" href="admin-user.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="admin-user.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="admin-user.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="admin-user.php?page='.$allPages.$sortStr.'">尾页</a>';
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
