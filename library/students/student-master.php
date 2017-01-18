<!-- 顶部导航层 -->
<div class="header-top">
	<a class="header-top-logo" href="stu-index.php">Library</a>
	<a class="logout" href="javascript:void(0)">退出</a>
</div>
<?php 
	session_start();
	include '../data.php';
	$db = new DataBase(); // 数据库操作类

	// 判断是否登录
	if (!(isset($_SESSION['user']) && $_SESSION['role'] == 'student')) {
		header('location:../login.php');
	}

	$userinfo = $db->getData('select * from students where studentId = "'.$_SESSION['user'].'"')[0]; // 获取登录用户的信息
?>
<header class="header">
	<!-- 头像 角色 -->
	<div class="header-person">
		<img class="header-person-img" src="../<?php echo $userinfo['photo'];?>">
		<div class="header-person-info">
			<div class="header-person-info-name">Hello, <?php echo $userinfo['studentName'];?></div>
			<div class="header-person-info-role">student</div>
		</div>
	</div>

	<!-- 菜单 -->
	<nav>
		<ul class="header-menu">
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon"></i>
					<span>个人中心</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="student-index.php">
							<i class="header-menu-icon"></i>
							<span>我的首页</span>
						</a>
					</li>
					<li>
						<a href="student-myinfo.php">
							<i class="header-menu-icon"></i>
							<span>我的资料</span>
						</a>
					</li>
					<li>
						<a href="student-passwd.php">
							<i class="header-menu-icon"></i>
							<span>修改密码</span>
						</a>
					</li>
					<li>
						<a href="student-loginfo.php">
							<i class="header-menu-icon"></i>
							<span>登录日志</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon"></i>
					<span>借阅信息</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="student-current.php">
							<i class="header-menu-icon"></i>
							<span>当前借阅</span>
						</a>
					</li>
					<li>
						<a href="student-history.php">
							<i class="header-menu-icon"></i>
							<span>历史借阅</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="header-menu-icon"></i>
							<span>预约记录</span>
						</a>
					</li>
					<li>
						<a href="student-overdue.php">
							<i class="header-menu-icon"></i>
							<span>超期信息</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="header-menu-icon"></i>
							<span>欠款记录</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon"></i>
					<span>图书推荐</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="student-recomment.php">
							<i class="header-menu-icon"></i>
							<span>我的推荐</span>
						</a>
					</li>
					<li>
						<a href="student-recomall.php">
							<i class="header-menu-icon"></i>
							<span>电子订单推荐</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</header>

<!-- 弹出层 -->
<div class="pop-wrap">
	<div class="pop-content">
		<i class="pop-close"></i>
		<div class="pop-content-item">书籍：<span class="pop-content-item-book">《JavaScript从入门到放弃》</span></div>
		<div class="pop-content-item">理由：<span class="pop-content-item-reson">啊实打实大所大所大所多高合金钢尔特让他风格和豆腐干从V型的CVS的方式啊实打实大所大所大所多高合金钢尔特让他风格和豆腐干从V型的CVS的方式啊实打实大所大所大所多高合金钢尔特让他风格和豆腐干从V型的CVS的方式啊实打实大所大所大所多高合金钢尔特让他风格和豆腐干从V型的CVS的方式</span></div>
	</div>
</div>
