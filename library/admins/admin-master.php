<!-- 顶部导航层 -->
<div class="header-top">
	<a class="header-top-logo" href="../index.php">Library</a>
	<a class="logout" href="javascript:void(0)">退出</a>
</div>
<?php 
	session_start();
	include '../data.php';
	$db = new DataBase(); // 数据库操作类

	// 判断是否登录
	if (!(isset($_SESSION['user']) && $_SESSION['role'] == 'admin')) {
		header('location:../login.php');
	}

	$userinfo = $db->getData('select * from admin where adminId = "'.$_SESSION['user'].'"')[0]; // 获取登录管理员的信息
?>
<header class="header">
	<!-- 头像 角色 -->
	<div class="header-person">
		<img class="header-person-img" src="../imgs/h2.png">
		<div class="header-person-info">
			<div class="header-person-info-name">Hello, <?php echo $userinfo['adminName'];?></div>
			<div class="header-person-info-role">admin</div>
		</div>
	</div>

	<!-- 菜单 -->
	<nav>
		<ul class="header-menu">
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon header-menu-icon-option"></i>
					<span>系统配置</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="admin-index.php">
							<i class="header-menu-icon header-menu-icon-home"></i>
							<span>我的首页</span>
						</a>
					</li>
					<li>
						<a href="admin-passwd.php">
							<i class="header-menu-icon header-menu-icon-lock"></i>
							<span>修改密码</span>
						</a>
					</li>
					<li>
						<a href="admin-default.php">
							<i class="header-menu-icon header-menu-icon-set"></i>
							<span>初始值设置</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon header-menu-icon-people"></i>
					<span>人员书籍</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="admin-user.php">
							<i class="header-menu-icon header-menu-icon-person"></i>
							<span>读者管理</span>
						</a>
					</li>
					<li>
						<a href="admin-category.php">
							<i class="header-menu-icon header-menu-icon-cate"></i>
							<span>书籍类别</span>
						</a>
					</li>
					<li>
						<a href="admin-books.php">
							<i class="header-menu-icon header-menu-icon-book"></i>
							<span>图书管理</span>
						</a>
					</li>
					<li>
						<a href="admin-comm.php">
							<i class="header-menu-icon header-menu-icon-comm"></i>
							<span>书籍推荐</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon header-menu-icon-link"></i>
					<span>资源信息</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="admin-intr.php">
							<i class="header-menu-icon header-menu-icon-desc"></i>
							<span>图书馆概述</span>
						</a>
					</li>
					<li>
						<a href="admin-news.php">
							<i class="header-menu-icon header-menu-icon-email"></i>
							<span>新闻通知</span>
						</a>
					</li>
					<li>
						<a href="admin-download.php">
							<i class="header-menu-icon header-menu-icon-download"></i>
							<span>资源下载</span>
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
		<div class="pop-content-item">书籍：<span class="pop-content-item-book"></span></div>
		<div class="pop-content-item">理由：<span class="pop-content-item-reson"></span></div>
	</div>
</div>
