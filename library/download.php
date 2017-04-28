<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 资源中心</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link href="css/download.css" rel="stylesheet" />
</head>
<body>
    <?php
        // 引入页眉
        include 'index-master-header.php';

        // 获取资源下载总数量--用于分页
        $counts = $db->getNum('select * from news where newsType = "资源下载"');
        $onePage = 12 > $counts ? $counts : 12; // 一页显示16条记录
        $allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

        // 获取传入的参数page 当前页
        if (isset($_GET['page']) && $_GET['page'] >= 1) {
            $page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
        } else {
            $page = 1; // 未传参则默认是首页
        }

        // 资源下载 sql
        $logSql = 'select * from news where newsType = "资源下载" order by newsDate desc';

        // 分页限制
        $logSql .= ' limit '.($page - 1) * $onePage.', '.$onePage;

        $infos = $db->getData($logSql); // 存储信息
    ?>

    <h1 class="html-title">资源中心</h1>
    <ul class="main center">
        <?php 
            for ($i = 0; $i < sizeof($infos); $i++) {
        ?>
        <li class="down-item" title="<?php echo $infos[$i]['title'];?>">
            <b class="down-item-title"><?php echo $infos[$i]['title'];?></b>
            <time class="down-item-time"><?php echo $infos[$i]['newsDate'];?></time>
            <p class="down-item-desc"><?php echo $infos[$i]['content'];?></p>
            <a class="down-item-load" href="<?php echo $infos[$i]['newsSrc'];?>" download="">下载</a>
        </li>
        <?php
            }
        ?>
    </ul>

    <!-- 分页 -->
    <div class="pages pages-download">
        <span class="pages-loc"><?php echo $page.' / '.$allPages;?> 页</span>
        <?php 
            if ($page == 1) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">首页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">上一页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="download.php?page=1">首页</a>'
                    .'<a class="tobutton pages-op" href="download.php?page='.($page-1).'">上一页</a>';
            }

            if ($page == $allPages) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="download.php?page='.($page+1).'">下一页</a>'
                    .'<a class="tobutton pages-op" href="download.php?page='.$allPages.'">尾页</a>';
            }
        ?>
    </div>
    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
</body>
</html>