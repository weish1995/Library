<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 书籍详情</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link href="css/book-item.css" rel="stylesheet" />
</head>
<body>
    <?php
        error_reporting(0);
        // 引入页眉
        include 'index-master-header.php';

        $booksId = '';
        $key = '';
        $words = '';

        if (isset($_GET['booksId'])) {
            $booksId = $_GET['booksId'];
        }

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        }

        if (isset($_GET['words'])) {
            $words = $_GET['words'];
        }

        // 获取url所带参数
        $paramStr = $_SERVER["QUERY_STRING"];

        // 获取url
        $url = $_SERVER["PHP_SELF"];

        // 预约按钮
        if (isset($_GET['eachId'])) {
            $eachId = $_GET['eachId'];

            // 验证是否登录
            if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
                header('Location:login.php?url='.$url.'?'.$paramStr);
            }

            // 检测当前用户所预约书籍是否达到3本（最多只能预约3本书籍）
            $sqlOver = 'select count(orderId) from orders where studentsId = "'.$_SESSION['user'].'" '
                    .'and orderType = "生效中"';

            if ($db->getSingleData($sqlOver) < 3) {
                // 检查所选书籍状态是否为在馆
                if ($db->dataSet('select * from eachbooks where status = "在馆" and eachId = "'.$eachId.'"')) {
                    // 在馆才能被预约 将数据写入预约表中 并修改书籍的状态
                    $sqlOrder = 'insert into orders (studentsId, eachId, orderDate, orderType) values ("'.$_SESSION['user'].'", "'.$eachId.'", "'.date("Y-m-d").'", "生效中")';

                    if ($db->singleOp($sqlOrder)) {
                        $db->singleOp('update eachbooks set status = "预约中" where eachId = "'.$eachId.'"');

                        echo '<script>alert("预约成功!")</script>';
                    } else {
                        echo '<script>alert("预约失败!")</script>';
                    }
                }
            } else {
                // 达到三本
                echo '<script>alert("预约失败！你预约的书籍数量已达到3本")</script>';
            }
        }
    ?>

    <!-- 搜索层 -->
    <div class="search">
        <div class="search-wrap">
            <select class="search-select" value="<?php echo $key;?>">
                <option value="all">全部</option>
                <option value="bookName" <?php if ($key=='bookName') echo 'selected';?>>藏书名</option>
                <option value="author" <?php if ($key=='author') echo 'selected';?>>作者</option>
                <option value="press" <?php if ($key=='press') echo 'selected';?>>出版社</option>
                <option value="ibsn" <?php if ($key=='ibsn') echo 'selected';?>>ibsn</option>
                <option value="theme" <?php if ($key=='theme') echo 'selected';?>>主题</option>
                <option value="keyword" <?php if ($key=='keyword') echo 'selected';?>>关键词</option>
            </select>
            <input class="search-input" id="searchInput" type="text" placeholder="检索书籍名/作者/描述" />
            <button class="search-button">搜索</button>
        </div>
    </div>

    <!-- 主体内容 -->
    <div class="book-container">
        <div class="center">
            <div class="book">
                <?php 
                    // 详情书籍sql
                    $sqlCurr = 'select * from books join category on category.cateId = books.cateId join admin on admin.adminId = books.adminId where books.booksId = "'.$booksId.'"';
                    $infoCurr = $db->getData($sqlCurr)[0];
                ?>
                <h2 class="book-title book-title-book">文献详情 > <?php echo $infoCurr['bookName'];?></h2>
                <div class="book-wrap">
                    <img class="book-cover" src="<?php echo $infoCurr['img'];?>" title="<?php echo $infoCurr['bookName'];?>" />
                    <div class="book-detail">
                        <b class="book-detail-name"><?php echo $infoCurr['bookName'];?></b>
                        <ul class="book-detail-wrap">
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">作者：</span>
                                <?php echo $infoCurr['author'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">出版社：</span>
                                <?php echo $infoCurr['press'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">出版时间：</span>
                                <?php echo $infoCurr['pressDate'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">语种：</span>
                                <?php echo $infoCurr['language'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">页码：</span>
                                <?php echo $infoCurr['pages'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">ibsn：</span>
                                <?php echo $infoCurr['ibsn'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">主题：</span>
                                <?php echo $infoCurr['theme'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">从书号：</span>
                                <?php echo $infoCurr['series'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">概述：</span>
                                <?php echo $infoCurr['summary'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">关键词：</span>
                                <?php echo $infoCurr['keyword'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">所属类别：</span>
                                <?php echo $infoCurr['cateName'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">上传人：</span>
                                <?php echo $infoCurr['adminName'];?>
                            </li>
                            <li class="book-detail-item">
                                <span class="book-detail-item-title">上架时间：</span>
                                <?php echo $infoCurr['inputDate'];?>
                            </li>
                        </ul>
                    </div>
                    <div class="book-pos">
                        <b class="book-pos-title">本地馆藏</b>
                        <table class="book-pos-wrap">
                            <tr class="book-pos-head">
                                <th class="book-pos-th">索书号</th>
                                <th class="book-pos-th">藏书名</th>
                                <th class="book-pos-th">架位</th>
                                <th class="book-pos-th">馆藏状态</th>
                                <th class="book-pos-th">操作</th>
                            </tr>
                            <?php
                                // 获取到书籍的每一本信息
                                $sqlEachs = 'select * from eachbooks where booksId = "'.$booksId.'"';
                                $infoEachs = $db->getData($sqlEachs);
                                for ($i = 0; $i < sizeof($infoEachs); $i++) {
                            ?>
                            <tr class="book-pos-tr">
                                <td class="book-pos-td"><?php echo $infoEachs[$i]['eachId'];?></td>
                                <td class="book-pos-td"><?php echo $infoCurr['bookName'];?></td>
                                <td class="book-pos-td">
                                    <?php 
                                        // 拼接字符串 将地址完整拼接
                                        echo $infoEachs[$i]['floor'].'楼'.$infoEachs[$i]['shelfNo'].'架'.$infoEachs[$i]['addr'];
                                    ?>
                                </td>
                                <td class="book-pos-td"><?php echo $infoEachs[$i]['status'];?></td>
                                <td class="book-pos-td"><a class="book-pos-td-a" href="book-item.php?<?php echo $paramStr.'&eachId='.$infoEachs[$i]['eachId']?>">
                                    <?php
                                        if ($infoEachs[$i]['status'] == '在馆') {
                                            echo '预约';
                                        }
                                    ?>
                                </a></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="recom">
                <h2 class="book-title book-title-recom">相关文献</h2>
                <ul class="recom-container">
                    <?php
                        // 相关文献 是根据搜索词选取的  拼接sql语句
                        $sqlSame = 'select * from books ';

                        // 当下拉框选择为全部时 模糊搜索下拉框所有字段
                        if ($_GET['key'] == 'all') {
                            $sqlSame .= 'where bookName like "%'.$words.'%" or author like "%'.$words.'%" '
                                    .'or press like "%'.$words.'%" or ibsn like "%'.$words.'%" '
                                    .'or theme like "%'.$words.'%" or keyword like "%'.$words.'%" ';
                        } else {
                            // 当下拉框的值不是全部时 模糊搜索指定字段
                            $sqlSame .= 'where '.$key.' like "%'.$words.'%" ';
                        }

                        // 限制值搜索前六条
                        $sqlSame .= 'limit 0, 6 ';

                        // 当根据检索条件只能检索到该书本身时，相关文献推荐改为 全部书籍中推荐6本
                        if ($db->getNum($sqlSame) == 1 || $key == '') {
                            $sqlSame = 'select * from books limit 0, 6';
                        }

                        $infoSame = $db->getData($sqlSame);
                        for ($i = 0; $i < sizeof($infoSame); $i++) {
                            // 检索到当前显示的书籍则跳过
                            if ($infoSame[$i]['booksId'] == $booksId) {
                                continue;
                            }
                    ?>
                    <li class=recom-item>
                        <a class="recom-item-title" href="
                            <?php 
                                echo 'book-item.php?key='.$key.'&words='.$words.'&booksId='.$infoSame[$i]['booksId'];
                            ?>
                        "><?php echo $infoSame[$i]['bookName']?></a>
                        <p class="recom-item-desc">关键词：<?php echo $infoSame[$i]['keyword']?></p>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>

    <script type="text/javascript" src="scripts/index-contents.js"></script>
    <script>
        $('.book-pos-td-a').on('click', function(e) {
            if (!confirm("确定要预约吗?")) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>