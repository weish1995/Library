<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 新闻通知、详细信息</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link href="css/key-value.css" rel="stylesheet" />
</head>
<body>
    <?php
        error_reporting(0);

        // 引入页眉
        include 'index-master-header.php';
        if (isset($_GET['newId']) && $_GET['newId'] >= 1) {
            $info = $db->getData('select * from news where newId = '.$_GET['newId'])[0];
        } 
    ?>

    <h1 class="html-title">新闻通知 - 详细信息</h1>
    <div class="main center">
        <h2 class="notice-title"><?php echo $info['title'];?></h2>
        <div class="notice-desc">
            <time class="notice-desc-info">发布时间：<?php echo $info['newsDate'];?></time>|
            <span class="notice-desc-info">
            发布者：
            <?php
                echo $db->getSingleData('select adminName from admin where adminId = "'.$info['adminId'].'"');
            ?>
            </span>
        </div>
        <article class="main-content">
            <?php echo $info['content'];?>
        </article>
    </div>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
</body>
</html>