<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-书籍推荐</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 购买操作
		if (isset($_GET['buyId'])) {
			$buyId = $_GET['buyId'];

			$sql = 'update recommends set recomType = "已购买" where recomId = '.$buyId;
			if ($db->singleOp($sql)) {
				echo '<script>alert("修改成功!")</script>';
			} else {
				echo '<script>alert("修改失败!")</script>';
			}
		}

		// 获取检索词  通过表单提交或url传递
		if (isset($_POST['btnSearch']) || isset($_GET['txtSearch'])) {
			$txtSearch = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : $_GET['txtSearch'];

			// 用于搜索时拼接到sql上的语句
			$searchStr = ' where studentName like "%'.$txtSearch.'%" or bookName like "%'.$txtSearch.'%" ';
		} else {
			$searchStr = ''; // 没有检索词则不需要更改sql
		}

		// 获取所有推荐信息记录--用于分页
		$counts = $db->getNum('select * from recommends join students on students.studentId = recommends.studentId '.$searchStr);
		$onePage = 10 > $counts ? $counts : 10; // 一页显示10条记录
		$allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

		// 获取传入的参数page 当前页
		if (isset($_GET['page']) && $_GET['page'] >= 1) {
			$page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
		} else {
			$page = 1; // 未传参则默认是首页
		}

		// 获取指定长度sql
		$logSql = 'select * from recommends join students on students.studentId = recommends.studentId '.$searchStr;

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
			<h3 class="content-title">书籍推荐</h3>
			<small class="content-subtitle">对读者推荐的信息进行管理</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-people"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">书籍推荐</span>
			</div>
		</div>

		<div class="wrap wrap-users">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-comm"></i>RECOMMEND
			</h3>

			<form class="wrap-search" action="" method="get">
				<input class="wrap-search-text" type="text" name="txtSearch" placeholder="姓名/书籍 检索" value="<?php 
						if (isset($txtSearch)) {
							echo $txtSearch;
						}
					?>">
				<input class="wrap-search-btn" type="submit" name="btnSearch" value="搜索">
			</form>

			<div class="mytable">
				<div class="mytable-th">
					<div class="mytable-th-td" alt="bookName">
						推荐书籍<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="studentName">
						推荐人<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="author">
						作者<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="press">
						出版社<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="ibsn">
						IBSN<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="agree">
						推荐数<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">
						推荐理由
					</div>
					<div class="mytable-th-td" alt="recomDate">
						推荐日期<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td" alt="recomType">
						状态<i class="mytable-th-td-icon"></i>
					</div>
					<div class="mytable-th-td">
						操作
					</div>
				</div>
				<?php 
					for ($i = 0; $i < count($infos); $i++) {
				?>
				<div class="mytable-tr">
					<div class="mytable-tr-td bookName">
						<?php echo $infos[$i]['bookName'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['studentName'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['author'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['press'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['ibsn'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['agree'];?>
					</div>
					<div class="mytable-tr-td" alt="<?php echo $infos[$i]['reason'];?>">
						<a class="click-detail" href="javascript:void(0)">点击查看</a>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['recomDate'];?>
					</div>
					<div class="mytable-tr-td">
						<?php echo $infos[$i]['recomType'];?>
					</div>
					<div class="mytable-tr-td">
						<?php
							if ($infos[$i]['recomType'] == '未购买') {
								echo '<a class="icon-op buy" title="购买" href="admin-comm.php?buyId='.$infos[$i]['recomId'].'">购买</a>';
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
						echo '<a class="tobutton pages-op" href="admin-comm.php?page=1'.$sortStr.'">首页</a>'
							.'<a class="tobutton pages-op" href="admin-comm.php?page='.($page-1).$sortStr.'">上一页</a>';
					}

					if ($page == $allPages) {
						echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
							.'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
					} else {
						echo '<a class="tobutton pages-op" href="admin-comm.php?page='.($page+1).$sortStr.'">下一页</a>'
							.'<a class="tobutton pages-op" href="admin-comm.php?page='.$allPages.$sortStr.'">尾页</a>';
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
