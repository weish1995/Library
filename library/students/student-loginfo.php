<!DOCTYPE html>
<html>
<head>
	<title>个人中心-登录日志</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php
		error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 获取当前学生的所有登录日志的总次数--用于分页
		$counts = $db->getNum('select * from loginfo where studentId = "'.$_SESSION['user'].'"');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from loginfo, students where loginfo.studentId = "'.$_SESSION['user'].'" and students.studentId = loginfo.studentId ';

		$sortStr = ''; // 存储url上的sort和sortType链接

		// 排序以及排序方式
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
			$sortStr .= '&sort='.$sort;

			if (isset($_GET['sortType'])) {
				$sortType = $_GET['sortType'];
				$sortStr .= '&sortType='.$sortType;
			} else {
				$sortType = '';
			}

			$logSql .= ' order by '.$sort.' '.$sortType;
		}

		// 分页限制
		$logSql .= ' limit '.($page - 1) * $onePage.', '.$onePage;

		$infos = $db->getData($logSql); // 存储登录日志信息
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">登录日志</h3>
			<small class="content-subtitle">记录了您的每一次登录</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-person"></i>个人中心
				</span>>
				<span class="content-breadcrumb-span">登录日志</span>
			</div>
		</div>

		<div class="wrap wrap-loginfo">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-text"></i>LOGINFO
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td" alt="studentName">用户名<i class="mytable-th-td-icon"></i></div>
					<div class="mytable-th-td" alt="logDate">登录时间<i class="mytable-th-td-icon"></i></div>
					<div class="mytable-th-td" alt="logAddr">登录Ip地址<i class="mytable-th-td-icon"></i></div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td"><?php echo $infos[$i]['studentName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['logDate'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['logAddr'];?></div>
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
						echo '<a class="tobutton pages-op" href="student-loginfo.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-loginfo.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-loginfo.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-loginfo.php?page='.$allPages.$sortStr.'">尾页</a>';
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