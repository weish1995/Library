<!DOCTYPE html>
<html>
<head>
	<title>图书推荐-电子订单推荐</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/student-contents.css">
</head>
<body>
	<?php 
		// error_reporting(0); // 不显示警告
		include 'student-master.php';

		// 点赞操作
		if (isset($_GET['recomId']) && $_GET['recomId'] >= 1) {
			// 先检查点赞表里面是否有记录，即是否已经点赞过
			if ($db->dataSet('select * from agrees where studentsId = "'.$_SESSION['user'].'" and recomId = '.$_GET['recomId'])) {
				echo '<script>alert("你已经推荐过了")</script>';
			} else {
				// 没点赞的话就把数据库中点赞的数据+1，并将点赞操作写入数据库
				$sqlAgree = 'insert into agrees (studentsId, recomId) values ("'.$_SESSION['user'].'", '.$_GET['recomId'].')';
				$sqlUpdate = 'update recommends set agree = (agree+1) where recomId = '.$_GET['recomId'];

				if ($db->singleOp($sqlAgree) && $db->singleOp($sqlUpdate)) {
					echo '<script>alert("推荐成功")</script>';
				} else {
					echo '<script>alert("推荐失败")</script>';
				}
			}
		}

		// 获取当前学生的所有登录日志的总次数--用于分页
		$counts = $db->getNum('select * from recommends where recomType = "未购买"');
		$onePage = 16 > $counts ? $counts : 16; // 一页显示16条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取当前学生指定长度的登录日志信息sql
		$logSql = 'select * from recommends where recomType = "未购买"';

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

		$infos = $db->getData($logSql); // 存储信息
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">电子订单推荐</h3>
			<small class="content-subtitle">还没购买的所有推荐信息</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-comm"></i>图书推荐
				</span>>
				<span class="content-breadcrumb-span">电子订单推荐</span>
			</div>
		</div>

		<div class="wrap wrap-recomall">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-allcomm"></i>RECOMMEND ALL
			</h3>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td mytable-th-td-large" alt="bookName">
						书籍名<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="press">
						出版社<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-large" alt="author">
						作者<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">理由</div>
					<div class="mytable-th-td mytable-th-td-small" alt="agree">
						推荐量<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td mytable-th-td-small">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['bookName'];?></div>
					<div class="mytable-tr-td"><?php echo $infos[$i]['press'];?></div>
					<div class="mytable-tr-td mytable-th-td-large"><?php echo $infos[$i]['author'];?></div>
					<div class="mytable-tr-td" alt="<?php echo $infos[$i]['reason'];?>">
						<a class="click-detail" href="javascript:void(0)">点击查看</a>
					</div>
					<div class="mytable-tr-td mytable-th-td-small"><?php echo $infos[$i]['agree'];?></div>		
					<div class="mytable-tr-td mytable-th-td-small">
						<a class="recomall-table-agree" href="student-recomall.php?page=<?php echo $page.'&recomId='.$infos[$i]['recomId'].$sortStr;?>"></a>
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
						echo '<a class="tobutton pages-op" href="student-recomall.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="student-recomall.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="student-recomall.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="student-recomall.php?page='.$allPages.$sortStr.'">尾页</a>';
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