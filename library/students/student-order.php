<!DOCTYPE html>
<html>
<head>
	<title>借阅信息-预约记录</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 取消预约操作
		if (isset($_GET['orderId']) && $_GET['orderId'] >= 1) {

			// 获取预约的类型，防止sql注入
			$type = $db->getSingleData('select orderType from orders where orderId = '.$_GET['orderId']);

			if ($type == '生效中') {
				if ($db->singleOp('update orders set orderType = "已取消" where orderId ='.$_GET['orderId'])) {
					// 取消预约之后 将书籍状态改为 在馆
					// 获取到操作书籍的索书号
					$eachId = $db->getSingleData('select eachId from orders where orderId = '.$_GET['orderId']);

					$sqlStatus = 'update eachbooks set status = "在馆" where eachId = "'.$eachId.'"';
					$db->singleOp($sqlStatus);

					echo '<script>alert("取消预约成功");</script>';
				} else {
					echo '<script>alert("取消预约失败");</script>';
				}
			}
		}

		// 获取当前学生的所有登录日志的总次数--用于分页
		$counts = $db->getNum('select * from orders where orders.studentsId = "'.$_SESSION['user'].'"');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from orders join eachbooks on eachbooks.eachId = orders.eachId join books on books.booksId = eachbooks.booksId where orders.studentsId = "'.$_SESSION['user'].'"';

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
			<h3 class="content-title">预约记录</h3>
			<small class="content-subtitle">没有库存的书籍预约记录</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-circle"></i>借阅信息
				</span>>
				<span class="content-breadcrumb-span">预约记录</span>
			</div>
		</div>

		<div class="wrap wrap-order">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-order"></i>ORDER
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-small" alt="orderType">
						状态<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="eachbooks.eachId">
						索书号<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="orderDate">
						预约时间<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-small">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-small">
						<?php
							// 判断借书记录的当前状态
							if ($infos[$i]['orderType'] == '生效中') {
								echo '<i class="book-state book-state-green">生效中</i>';
							}
							if ($infos[$i]['orderType'] == '超时') {
								echo '<i class="book-state book-state-x">超时</i>';
							}
							if ($infos[$i]['orderType'] == '已借') {
								echo '<i class="book-state book-state-red">已借</i>';
							}
							if ($infos[$i]['orderType'] == '已取消') {
								echo '<i class="book-state book-state-x">已取消</i>';
							}
						?>
					</div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['eachId'];?></div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['orderDate'];?></div>
					<div class="mytable-tr-td mytable-th-td-small">
						<?php
							/* 只有待生效和生效中的预约记录可以取消 */
							if ($infos[$i]['orderType'] == '待生效' || $infos[$i]['orderType'] == '生效中') {
								echo '<a class="order-table-cancel" href="student-order.php?page='.$page.'&orderId='.$infos[$i]['orderId'].$sortStr.'" title="取消预约"></a>';
							}
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
						echo '<a class="tobutton pages-op" href="student-order.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-order.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-order.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-order.php?page='.$allPages.$sortStr.'">尾页</a>';
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