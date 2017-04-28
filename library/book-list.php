<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 书籍列表</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link href="css/form.css" rel="stylesheet" />
    <link href="css/book-list.css" rel="stylesheet" />
</head>
<body>
    <?php
        // 引入页眉
        include 'index-master-header.php';

        $paramStr = ''; // 用于记录要传递的字符串
        $key = '';
        $words = '';
        $condStr = ''; // 检测条件
        $k = ''; //  二次检索 字段
        $v = ''; // 二次检索 值

        if (isset($_GET['k'])) {
            $k = $_GET['k'];
        }

        if (isset($_GET['v'])) {
            $v = $_GET['v'];
        }

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        }

        if (isset($_GET['words'])) {
            $words = $_GET['words'];
        }

        // 拼接sql字符串
        $sqlBooks = 'select * from books ';

        // 当下拉框选择为全部时 模糊搜索下拉框所有字段
        if ($_GET['key'] == 'all') {
            $condStr .= 'where bookName like "%'.$words.'%" or author like "%'.$words.'%" '
                    .'or press like "%'.$words.'%" or ibsn like "%'.$words.'%" '
                    .'or theme like "%'.$words.'%" or keyword like "%'.$words.'%" ';
        } else {
            // 当下拉框的值不是全部时 模糊搜索指定字段
            $condStr .= 'where '.$key.' like "%'.$words.'%" ';
        }

        $sqlBooks .= $condStr;

        $paramStr = 'key='.$key.'&words='.$words;
        if ($k != '') {
            $paramStr .= '&k='.$k.'&v='.$v;
        }

        // 获取搜索书籍总数量--用于分页
        $counts = $db->getNum($sqlBooks);
        $onePage = 12 > $counts ? $counts : 12; // 一页显示12条记录
        $allPages = $onePage == 0 ? 1 : ceil($counts / $onePage); // 总页数

        // 获取传入的参数page 当前页
        if (isset($_GET['page']) && $_GET['page'] >= 1) {
            $page = $_GET['page'] > $allPages ? $allPages : $_GET['page']; // 传入参数大于总页数，默认显示最后一页
        } else {
            $page = 1; // 未传参则默认是首页
        }

        // 分页限制
        $sqlBooks .= ' limit '.($page - 1) * $onePage.', '.$onePage;
        $infos = $db->getData($sqlBooks); // 存储信息
    ?>

    <!-- 搜索层 -->
    <div class="search">
        <div class="search-wrap">   
            <select class="search-select">
                <option value="all">全部</option>
                <option value="bookName" <?php if ($key=='bookName') echo 'selected';?>>藏书名</option>
                <option value="author" <?php if ($key=='author') echo 'selected';?>>作者</option>
                <option value="press" <?php if ($key=='press') echo 'selected';?>>出版社</option>
                <option value="ibsn" <?php if ($key=='ibsn') echo 'selected';?>>ibsn</option>
                <option value="theme" <?php if ($key=='theme') echo 'selected';?>>主题</option>
                <option value="keyword" <?php if ($key=='keyword') echo 'selected';?>>关键词</option>
            </select>
            <input class="search-input" id="searchInput" type="text" placeholder="检索书籍名/作者/描述" value="<?php echo $words;?>" />
            <button class="search-button">搜索</button>
        </div>
    </div>

    <!-- 主页内容 -->
    <div class="main center">
        <div class="left">
            <h2 class="main-title"><i class="main-title-icon main-title-icon-total"></i>检索结果统计</h2>
            <div class="screen-item">
                <h3 class="screen-item-title">语言</h3>
                <ul>
                    <?php
                        // 根据语言分类
                        $sqlLang = 'select count(*) as number,language from books '.$condStr.' group by language';

                        $infoLang = $db->getData($sqlLang);
                        for ($i = 0; $i < sizeof($infoLang); $i++) {
                    ?>
                    <li class="screen-item-list">
                        <a class="screen-item-list-src" href="<?php echo 'book-list.php?'.$paramStr.'&k=language&v='.$infoLang[$i]['language'];?>">
                            <?php echo $infoLang[$i]['language'];?>
                        </a>
                        <?php echo $infoLang[$i]['number'];?>篇
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="screen-item">
                <h3 class="screen-item-title">作者</h3>
                <ul>
                    <?php
                        // 根据作者分类
                        $sqlAuthor = 'select count(*) as number,author from books '.$condStr.' group by author';

                        $infoAuthor = $db->getData($sqlAuthor);
                        for ($i = 0; $i < sizeof($infoAuthor); $i++) {
                    ?>
                    <li class="screen-item-list">
                        <a class="screen-item-list-src" href="<?php echo 'book-list.php?'.$paramStr.'&k=author&v='.$infoAuthor[$i]['author'];?>">
                            <?php echo $infoAuthor[$i]['author'];?>
                        </a>
                        <?php echo $infoAuthor[$i]['number'];?>篇
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="screen-item">
                <h3 class="screen-item-title">出版社</h3>
                <ul>
                    <?php
                        // 根据出版社分类
                        $sqlPress = 'select count(*) as number,press from books '.$condStr.' group by press';

                        $infoPress = $db->getData($sqlPress);
                        for ($i = 0; $i < sizeof($infoPress); $i++) {
                    ?>
                    <li class="screen-item-list">
                        <a class="screen-item-list-src" href="<?php echo 'book-list.php?'.$paramStr.'&k=press&v='.$infoPress[$i]['press'];?>">
                            <?php echo $infoPress[$i]['press'];?>
                        </a>
                        <?php echo $infoPress[$i]['number'];?>篇
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="right">
            <h2 class="main-title">
                <i class="main-title-icon main-title-icon-search"></i>
                检索条件 “<span>
                    <?php 
                        echo $key.'='.$words;
                        if ($k != '') {
                            echo '　'.$k.'='.$v;
                        }
                    ?>
                </span>”
                <span class="result">
                    共<b class="result-number"><?php echo $counts;?></b>条记录
                </span>
            </h2>
            <?php
                // 输出书本条目信息
                for ($i = 0; $i < sizeof($infos); $i++) {
                    // 二次检索 去除不符合检索条件的数据
                    if ($k != '' && $infos[$i][$k] != $v) {
                        continue;
                    }
            ?>
            <dl class="list-item">
                <dt class="list-item-title"><a class="list-item-title-name" href="book-item.php?<?php echo 'booksId='.$infos[$i]['booksId'].'&'.$paramStr;?>">
                    <?php 
                        // 不区分大小写 将搜索字体变成红色
                        echo str_ireplace($words, '<i>'.$words.'</i>', $infos[$i]['bookName']);
                    ?>
                </a> </dt>
                <dd class="list-item-image-wrap">
                    <a href="book-item.php?<?php echo 'booksId='.$infos[$i]['booksId'].'&'.$paramStr;?>">
                        <img class="list-item-image" src="<?php echo $infos[$i]['img'];?>" title="no-full-text" alt="no-full-text" />
                    </a>
                </dd>
                <dd class="list-item-info">
                    <?php 
                        // 不区分大小写 将搜索字体变成红色
                        echo str_ireplace($words, '<i>'.$words.'</i>', $infos[$i]['press']);
                    ?>　
                    <span class="list-item-info-span">
                        <?php echo $infos[$i]['pressDate'];?>
                    </span>
                </dd>
                <dd class="list-item-info">
                    <span class="list-item-info-span">作者：　</span>
                    <?php
                        // 不区分大小写 将搜索字体变成红色
                        echo str_ireplace($words, '<i>'.$words.'</i>', $infos[$i]['author']);
                    ?> 著.
                </dd>
                <dd class="list-item-info">
                    <span class="list-item-info-span">关键词：　</span>
                    <?php 
                        // 不区分大小写 将搜索字体变成红色
                        echo str_ireplace($words, '<i>'.$words.'</i>', $infos[$i]['keyword']);
                    ?>
                </dd>
                <dd class="list-item-info">
                    <span class="list-item-info-span">IBSN：　</span>
                    <?php 
                        // 不区分大小写 将搜索字体变成红色
                        echo str_ireplace($words, '<i>'.$words.'</i>', $infos[$i]['ibsn']);
                    ?>
                </dd>
                <dd class="list-item-borrow">
                    <?php
                        // 从eachBooks获取当前书籍在册数 从records获取借出数量
                        $currId = $infos[$i]['booksId'];
                        $total = $db->getNum('select * from eachBooks where booksId = "'.$currId.'"');
                        $rest = $db->getNum('select * from eachBooks where booksId = "'.$currId.'" and status = "在馆"');

                        echo '馆藏（'.$total.'）/　可借（'.$rest.'）';
                    ?>
                </dd>
            </dl>
            <?php
                }
            ?>
        </div>
    </div>

    <!-- 分页 -->
    <div class="pages pages-list center">
        <span class="pages-loc"><?php echo $page.' / '.$allPages;?> 页</span>
        <?php 
            if ($page == 1) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">首页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">上一页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="book-list.php?page=1&'.$paramStr.'">首页</a>'
                    .'<a class="tobutton pages-op" href="book-list.php?page='.($page-1).'&'.$paramStr.'">上一页</a>';
            }

            if ($page == $allPages) {
                echo '<a class="tobutton pages-op disabled" href="javascript:void(0)">下一页</a>'
                    .'<a class="tobutton pages-op disabled" href="javascript:void(0)">尾页</a>';
            } else {
                echo '<a class="tobutton pages-op" href="book-list.php?page='.($page+1).'&'.$paramStr.'">下一页</a>'
                    .'<a class="tobutton pages-op" href="book-list.php?page='.$allPages.'&'.$paramStr.'">尾页</a>';
            }
        ?>
    </div>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
    <script type="text/javascript" src="scripts/index-contents.js"></script>
</body>
</html>