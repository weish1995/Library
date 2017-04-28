<!DOCTYPE html>
<html>
<head>
	<title>图书推荐-我的推荐</title>
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
		$counts = $db->getNum('select * from recommends where studentId = "'.$_SESSION['user'].'"');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from recommends where studentId = "'.$_SESSION['user'].'"';

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
			<h3 class="content-title">我的推荐</h3>
			<small class="content-subtitle">向图书馆推荐购买的书籍记录</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-comm"></i>图书推荐
				</span>>
				<span class="content-breadcrumb-span">我的推荐</span>
			</div>
		</div>

		<div class="wrap wrap-recommend">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-mycomm"></i>RECOMMEND
			</h3>

			<a class="recommend-new" href="student-new-recomment.php" title="添加" alt="添加"></a>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="ibsn">
						ISBN<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="author">
						作者<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="press">
						出版社<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="recomType">
						状态<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="recomDate">
						推荐日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">理由</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['ibsn'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['author'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['press'];?></div>
					<div class="mytable-tr-td">
						<i class="book-state book-state-<?php echo $infos[$i]['recomType'] == '已购买' ? 'green' : 'red'; ?>">
							<?php echo $infos[$i]['recomType'];?>
						</i>
					</div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['recomDate'];?></div>
					<div class="mytable-tr-td" alt="<?php echo $infos[$i]['reason'];?>">
						<a class="click-detail" href="javascript:void(0)">点击查看</a>
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
						echo '<a class="tobutton pages-op" href="student-recomment.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-recomment.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-recomment.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-recomment.php?page='.$allPages.$sortStr.'">尾页</a>';
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