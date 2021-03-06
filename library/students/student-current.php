<!DOCTYPE html>
<html>
<head>
	<title>借阅信息-当前借阅</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 存在则表示 用户点击了续借 需要进行续借操作
		if (isset($_GET['recordId']) && $_GET['recordId'] >= 1) {
			// 获取到借阅记录
			$sqlRec = 'select * from records where recordId = '.$_GET['recordId'];

			// 数据存在才进行操作
			if ($db->dataSet($sqlRec)) {
				$recInfos = $db->getData($sqlRec)[0];
				
				// 超期的书籍不能续借
				if (strtotime($recInfos['destine']) >= strtotime(date("y-m-d",time()))) {
					// 预期还书时间的十天内才能续借
					if (strtotime($recInfos['destine']) < strtotime('+10 days', time())) {
						// 最多只能续借两次
						if ($recInfos['renew'] < 2) {
							// 从初始化表（default）里面获取到默认 一次借书的时长
							$durate = $db->getSingleData('select value_ from `default` where key_ = "时长"');
							
							// 当前时间加上一次借书的时长的到续借之后的还书时间
							$destine = date('Y-m-d', strtotime('+'.$durate.' months', time()));

							// 续借的sql语句
							$sqlRenew = 'update records set destine = "'.$destine.'", renew = '.($recInfos['renew']+1).' where recordId = '.$_GET['recordId'];

							if ($db->singleOp($sqlRenew)) {
								echo '<script>alert("续借成功")</script>';
							} else {
								echo '<script>alert("续借失败")</script>';
							}
						} else {
							echo '<script>alert("最多只能续借两次")</script>';
						}
					} else {
						echo '<script>alert("到期十天之内才能续借")</script>';
					}
			
				} else {
					echo '<script>alert("所借书籍已超期，不能续借")</script>';
				}
			}
		}

		// 获取当前学生的所有当前借阅书籍的总数--用于分页
		$counts = $db->getNum('select * from records where studentId = "'.$_SESSION['user'].'" and endDate is null');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取学生当前借阅信息sql
		$logSql = 'select * from records join eachbooks on records.eachId = eachbooks.eachId '
					.' join books on books.booksId = eachbooks.booksId '
					.'where records.endDate is null and studentId = "'.$_SESSION['user'].'"';

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
			<h3 class="content-title">当前借阅</h3>
			<small class="content-subtitle">已经借阅还未归还的书籍</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-circle"></i>借阅信息
				</span>>
				<span class="content-breadcrumb-span">当前借阅</span>
			</div>
		</div>

		<div class="wrap wrap-current">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-current"></i>CURRENT
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-small">
						状态
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="eachbooks.eachId">
						索书号<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="renew">
						续借次数<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="startDate">
						借阅日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="destine">
						应还日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-small">续借</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-small">
						<?php
							// 判断借书记录的当前状态
							if (strtotime($infos[$i]['destine']) < strtotime(date("y-m-d",time()))) {
								echo '<i class="book-state book-state-red">超期</i>';
							} else {
								echo '<i class="book-state book-state-green">正常</i>';
							}
						?>
					</div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['eachId'];?></div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName']?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['renew'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['startDate'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['destine'];?></div>
					<div class="mytable-tr-td mytable-th-td-small">
						<a class="current-table-renew" href="student-current.php?page=<?php echo $page.'&recordId='.$infos[$i]['recordId'].$sortStr;?>"></a>
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
						echo '<a class="tobutton pages-op" href="student-current.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-current.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-current.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-current.php?page='.$allPages.$sortStr.'">尾页</a>';
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