<!-- 顶部导航层 -->
<div class="header-top">
	<a class="header-top-logo" href="Index.php">Library</a>
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
					<i class="header-menu-icon"></i>
					<span>系统配置</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="admin-index.php">
							<i class="header-menu-icon"></i>
							<span>我的首页</span>
						</a>
					</li>
					<li>
						<a href="admin-passwd.php">
							<i class="header-menu-icon"></i>
							<span>修改密码</span>
						</a>
					</li>
					<li>
						<a href="admin-default.php">
							<i class="header-menu-icon"></i>
							<span>初始值设置</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="header-menu-cate">
				<a href="javascript:void(0);">
					<i class="header-menu-icon"></i>
					<span>人员管理</span>
					<i class="header-menu-toggle">></i>
				</a>
				<ul>
					<li>
						<a href="admin-user.php">
							<i class="header-menu-icon"></i>
							<span>读者管理</span>
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
