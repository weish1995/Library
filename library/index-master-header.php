<!-- 页眉 -->
<header class="header">
    <div class="center">
        <a class="header-title" href="index.php" title="图书馆管理系统" alt="图书馆管理系统">
            <i class="header-title-icon">LOGO</i>
            <b class="header-title-text">图书馆信息管理系统</b>
        </a>
        <div class="user-container">
            <?php
                include 'data.php';
                session_start();
                $db = new DataBase(); // 数据库操作类

                if (isset($_SESSION['user']) && $_SESSION['user'] != '') { 
                    // 已经登录 -- 显示 个人中心选项
                    if ($_SESSION['role'] == 'student') {
                        // 学生登录
                        $url = 'students/student-index.php';

                        // 获取头像的sql语句
                        $sql = 'select photo from students where studentId = "'.$_SESSION['user'].'"';
                        $imgSrc = $db->getSingleData($sql);
                    } else {
                        // 管理员登录
                        $url = 'admins/admin-index.php';

                        // 管理员没有头像 显示默认值
                        $imgSrc = 'imgs/person.png';
                    }

                    echo '<a class="user-item" href="'.$url.'" title="个人中心">
                             <img class="user-item-image" src="'.$imgSrc.'" title="个人中心" alt="个人中心" />
                             个人中心
                          </a>
                          <a class="user-item log-out" href="login.php" title="退出">退出</a>';
                } else {
                    // 未登录 -- 显示 登录选项
                    echo '<a class="user-item" href="login.php">登录</a>';
                }
            ?>    
        </div>
        <nav class="nav">
            <ul class="nav-wrap">
                <li class="nav-item"><a class="nav-item-a" href="index.php" title="首页">首页</a> </li>
                <li class="nav-item"><a class="nav-item-a" href="summary.php" title="图书馆概况">图书馆概况</a> </li>
                <li class="nav-item"><a class="nav-item-a" href="news.php" title="新闻通知">新闻通知</a> </li>
                <li class="nav-item"><a class="nav-item-a" href="download.php" title="资源中心">资源中心</a> </li>
                <li class="nav-item"><a class="nav-item-a" href="contact.php" title="联系我们">联系我们</a> </li>
            </ul>
        </nav>
    </div>
</header>

<script src="scripts/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    // 退出登录按钮
    $('.log-out').on('click', function(e) {
        if (!confirm('确定退出登录吗？')) {
            e.preventDefault();
        }
    });
</script>