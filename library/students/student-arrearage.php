<!DOCTYPE html>
<html>
<head>
	<title>借阅信息-欠款记录</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		// error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 从默认表里获取到超期每天的费用
		$price = $db->getSingleData('select value_ from `default` where key_ = "超期单价"');

		// 获取当前登陆学生的欠费总数和缴费总数
		$oweDetail = $db->getSingleData('select sum(timestampdiff(DAY, destine, endDate)) from records join students on students.studentId = records.studentId where endDate > destine and students.studentId = "'.$_SESSION['user'].'"');
		$oweDetail *= $price;

		$money = $db->getSingleData('select money from students where studentId = "'.$_SESSION['user'].'"');

		// 获取当前学生的所有欠款记录的总数--用于分页
		$sqlOwe = 'select *, timestampdiff(DAY, destine, endDate) as diff from records join students on students.studentId = records.studentId join eachbooks on eachbooks.eachId = records.eachId join books on books.booksId = eachbooks.booksId where endDate is not null and endDate > destine and students.studentId = "'.$_SESSION['user'].'"';

		$counts = $db->getNum($sqlOwe);
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的欠款记录sql
		$logSql = $sqlOwe;

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
			<h3 class="content-title">欠款记录</h3>
			<small class="content-subtitle">所欠费用的详细信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-circle"></i>借阅信息
				</span>>
				<span class="content-breadcrumb-span">欠款记录</span>
			</div>
		</div>

		<div class="wrap wrap-arrearage">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-money"></i>ARREARAGE
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-large" alt="eachbooks.eachId">
						索书号<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						欠款书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="endDate">
						欠款时间<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="diff">
						欠款金额<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large">
						欠款原因
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['eachId'];?></div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['endDate'];?></div>
					<div class="mytable-tr-td">￥<?php 
						echo number_format($infos[$i]['diff'] * $price, 2);
					?></div> <!-- number_format 保留两位小数 -->
					<div class="mytable-tr-td mytable-th-td-large">书籍借阅超期</div>
				</div>
				<?php
					}
				?>
			</div>

			<!-- 欠费及缴费总结 -->
			<div class="wrap-arrearage-detail">
				总欠款金额：￥<?php echo number_format($oweDetail, 2);?>元，
				总交款金额￥<?php echo number_format($money, 2);?>元
			</div>

			<!-- 分页 -->
			<div class="pages">
				<span class="pages-loc"><?php echo $page.' / '.$allPages;?> 页</span>
				<?php 
					if ($page == 1) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">首页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">上一页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-arrearage.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-arrearage.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-arrearage.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-arrearage.php?page='.$allPages.$sortStr.'">尾页</a>';
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