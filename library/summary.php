<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 图书馆概况</title>
    <link href="css/index-master.css" rel="stylesheet" />
</head>
<body>
    <?php
        // 引入页眉
        include 'index-master-header.php';
    ?>

    <h1 class="html-title">图书馆概况</h1>
    <div class="main center">
        <?php
            // 从数据库里面直接读出显示
            $sql = 'select value_ from `default` where key_ = "图书馆概况"';
            echo $db->getSingleData($sql);
        ?>
    </div>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
</body>
</html>