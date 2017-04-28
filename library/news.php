<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 新闻通知</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link href="css/news.css" rel="stylesheet" />
</head>
<body>
    <?php
        // 引入页眉
        include 'index-master-header.php';

        // 获取新闻通知总数量--用于分页
        $counts = $db->getNum('select * from news where newsType = "新闻通知"');
        $onePage = 10 > $counts ? $counts : 10; // 一页显示16条记录
        $allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

        // 获取传入的参数page 当前页
        if (isset($_GET['page']) && $_GET['page'] >= 1) {
            $page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
        } else {
            $page = 1; // 未传参则默认是首页
        }

        // 获取新闻通知 sql
        $logSql = 'select * from news where newsType = "新闻通知" order by newsDate desc';

        // 分页限制
        $logSql .= ' limit '.($page - 1) * $onePage.', '.$onePage;

        $infos = $db->getData($logSql); // 存储信息
    ?>

    <h1 class="html-title">新闻通知</h1>
    <ul class="main center">
        <?php
            for ($i = 0; $i < sizeof($infos); $i++) {
        ?>
            <li class="list-item">
                <time class="list-item-time"><?php echo $infos[$i]['newsDate'];?><i class="list-item-icon"></i></time>
                <div class="list-item-wrap">
                    <a class="list-item-title" target="_blank" href="key-value.php?newId=<?php echo $infos[$i]['newId'].'">'.$infos[$i]['title'];?></a>
                    <p class="list-item-text">
                    <?php 
                        echo strip_tags($infos[$i]['content']); // 去除字符串中的html标签
                    ?>
                    </p>
                </div>
            </li>
        <?php
            }
        ?>
    </ul>
    
    <!-- 分页 -->
    <div class="pages pages-news">
        <span class="pages-loc"><?php echo $page.' / '.$allPages;?> 页</span>
        <?php 
            if ($page == 1) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">首页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">上一页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="news.php?page=1">首页</a>'
                    .'<a class="tobutton pages-op" href="news.php?page='.($page-1).'">上一页</a>';
            }

            if ($page == $allPages) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="news.php?page='.($page+1).'">下一页</a>'
                    .'<a class="tobutton pages-op" href="news.php?page='.$allPages.'">尾页</a>';
            }
        ?>
    </div>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
</body>
</html>