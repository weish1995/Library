<!DOCTYPE html>
<html>
<head>
	<title>借阅信息-当前借阅</title>
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		include 'student-master.php';

		// 获取当前学生的所有登录日志的总次数--用于分页
		$counts = $db->getNum('select * from records where studentId = "'.$_SESSION['user'].'" and endDate is null');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from records, books where records.studentId = "'.$_SESSION['user'].'" and records.bookId = books.bookId limit '.($page - 1) * $onePage.', '.$onePage;

		$infos = $db->getData($logSql); // 存储登录日志信息
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">当前借阅</h3>
			<small class="content-subtitle">已经借阅还未归还的书籍</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon"></i>借阅信息
				</span>>
				<span class="content-breadcrumb-span">当前借阅</span>
			</div>
		</div>

		<!-- 展示登录信息 -->
		<div class="wrap wrap-current">
			<h3 class="wrap-title">
				<i class="wrap-title-icon"></i>CURRENT
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td">状态</div>
					<div class="mytable-th-td">书籍名</div>
					<div class="mytable-th-td">馆藏地</div>
					<div class="mytable-th-td">续借次数</div>
					<div class="mytable-th-td">借阅日期</div>
					<div class="mytable-th-td">应还日期</div>
					<div class="mytable-th-td">续借</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td">超期</div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td">花溪中山图书馆</div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['renew'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['startDate'];?></div>
					<div class="mytable-tr-td"><?php echo date("Y-m-d", strtotime("+1 months", strtotime($infos[$i]['startDate'])));?></div>
					<div class="mytable-tr-td">+</div>
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
						echo '<a class="tobutton pages-op" href="student-current.php?page=1">首页</a>'
							.'<a class="tobutton pages-op" href="student-current.php?page='.($page-1).'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-current.php?page='.($page+1).'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-current.php?page='.$allPages.'">尾页</a>';
					}
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
</body>
</html>