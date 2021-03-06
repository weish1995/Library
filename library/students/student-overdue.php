<!DOCTYPE html>
<html>
<head>
	<title>借阅信息-超期信息</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 获取到超期记录的总数--用于分页
		$counts = $db->getNum('select * from records where studentId = "'.$_SESSION['user'].'"');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from records join eachbooks on eachbooks.eachId = records.eachId join books on eachbooks.booksId = books.booksId where studentId = "'.$_SESSION['user'].'" and recordId in (select recordId from records where endDate is null and "'.date('Y-m-d', time()).'" > destine union select recordId from records where endDate > destine)';

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
			<h3 class="content-title">超期信息</h3>
			<small class="content-subtitle">在规定时间内未归还的书籍记录</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-circle"></i>借阅信息
				</span>>
				<span class="content-breadcrumb-span">超期信息</span>
			</div>
		</div>

		<div class="wrap wrap-overdue">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-overdue"></i>OVERDUE
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-small">状态</div>
					<div class="mytable-th-td mytable-th-td-large" alt="eachbooks.eachId">
						索书号<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="startDate">
						借阅日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="destine">
						应还日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="endDate">
						归还日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">超期天数</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-small">
						<?php
							// 判断借书记录的当前状态
							if (!$infos[$i]['endDate']) {
								echo '<i class="book-state book-state-red">未归还</i>';
							} else {
								echo '<i class="book-state book-state-green">已归还</i>';
							}
						?>
					</div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['eachId'];?></div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['startDate'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['destine'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['endDate'];?></div>
					<div class="mytable-tr-td">
						<?php
							// 计算超期时间

							// 如果没有归还 结束时间定为今天
							$time = $infos[$i]['endDate'] != NULL ? strtotime($infos[$i]['endDate']) : time();
							$diff = floor(($time - strtotime($infos[$i]['destine'])) / 86400); // 根据时间戳的差值除以一天的秒数得到时间的差值
							echo $diff;
						?>
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
						echo '<a class="tobutton pages-op" href="student-overdue.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-overdue.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-overdue.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-overdue.php?page='.$allPages.$sortStr.'">尾页</a>';
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