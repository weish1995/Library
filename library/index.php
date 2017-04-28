<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 首页</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
</head>
<body>
    <?php
        error_reporting(0);
        // 引入页眉
        include 'index-master-header.php';
    ?>
    
    <!-- search层 -->
    <div class="item search">
        <h2 class="item-title search-title">资源检索，快速查找书籍</h2>
        <div class="search-wrap">
            <select class="search-select">
                <option value="all">全部</option>
                <option value="bookName">藏书名</option>
                <option value="author">作者</option>
                <option value="press">出版社</option>
                <option value="press">ibsn</option>
                <option value="theme">主题</option>
                <option value="keyword">关键词</option>
            </select>
            <input class="search-input" id="searchInput" type="text" placeholder="检索书籍名/作者/描述" />
            <button class="search-button">搜索</button>
        </div>
        <p class="search-desc">说明：馆藏纸本图书检索</p>
    </div>

    <article class="article">
        <!-- 学基础课，拿学分 -->
        <section class="item basic center">
            <h2 class="item-title basic-title">好读书，读好书</h2>
            <p class="basic-text">书让你走人生路途唱出春花秋月，落英缤纷;书让你在浩瀚海洋中尽情畅游;<br />书点燃希望，让你在无穷无尽的人生漫漫路上永远不会迷失方向，一直像帆一样将你这只小船送道路的终极。
                </p>
            <article>
                <section class="section-item basic-process">
                    <h3 class="section-item-title">如何读一本好书？</h3>
                    <ul class="basic-process-container">
                        <li class="basic-process-item"><i class="process-item-icon process-item-icon-select"></i>浏览</li>
                        <li class="basic-process-item"><i class="process-item-icon process-item-icon-study"></i>提问、思考</li>
                        <li class="basic-process-item"><i class="process-item-icon process-item-icon-exam"></i>细读、复述</li>
                        <li class="basic-process-item"><i class="process-item-icon process-item-icon-score"></i>品味、总结</li>
                    </ul>
                    <a class="basic-process-button" href="book-list.php?key=all" title="查看更多书籍">
                        查看更多书籍<i class="basic-process-button-icon"></i>
                    </a>
                </section>
                <section class="section-item score">
                    <h3 class="section-item-title">作者热榜TOP5</h3>
                    <ul class="score-wrap">
                        <?php
                            $sqlAuthor = 'select *, count(books.author) as counts from records '
                                    .'join eachbooks on records.eachId = eachbooks.eachId '
                                    .'join books on books.booksId = eachbooks.booksId '
                                    .'where records.endDate is not null group by books.author '
                                    .'order by count(books.author) desc limit 0, 5';

                            $infoAuthor = $db->getData($sqlAuthor);
                            for ($i = 0; $i < sizeof($infoAuthor); $i++) {
                        ?>
                        <li class="score-item">
                            <a target="_blank" href="book-list.php?key=author&words=<?php echo $infoAuthor[$i]['author'];?>">
                                <img class="score-item-image" src="<?php echo $infoAuthor[$i]['img'];?>" title="代表作" alt="代表作" />
                                <i class="score-item-rank score-item-rank-first"><?php echo $i+1;?></i>
                                <span class="score-item-name"><?php echo $infoAuthor[$i]['author'];?></span>
                                <span class="score-item-credit" title="借阅次数"><?php echo $infoAuthor[$i]['counts'];?></span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </section>
            </article>
        </section>

        <!-- 专业课 -->
        <section class="item major">
            <h2 class="item-title major-title">借阅书籍热榜推荐</h2>
            <article>
                <section class="center major-hot">
                    <div class="major-section-title">
                        <i class="major-section-title-icon"></i>
                        读书不觉春已深，一寸光阴一寸金。不是道人来引笑，周情孔思正追寻。
                    </div>
                    <div class="section-item-hot">
                        <h3 class="section-item-title section-item-hot-title">书籍年度借阅榜TOP10</h3>
                    </div>
                    <ul class="major-hot-container">
                        <?php
                            $sqlYear = 'select *,count(eachbooks.booksId) as count from records '
                                    .'join eachbooks on records.eachId = eachbooks.eachId '
                                    .'join books on books.booksId = eachbooks.booksId '
                                    .'where records.endDate is not null and DATE_SUB(CURDATE(), INTERVAL 1 YEAR) < endDate'
                                    .' group by eachbooks.booksId order by count(eachbooks.booksId) desc limit 0, 10';

                            $infoYear = $db->getData($sqlYear);

                            for ($i = 0; $i < sizeof($infoYear); $i++) {
                        ?>
                        <li class="major-hot-item">
                            <div class="major-hot-item-wrap transition">
                                <img class="hot-item-icon" src="<?php echo $infoYear[$i]['img'];?>" />
                                <?php echo $infoYear[$i]['bookName'];?>
                                <div class="hot-item-hover transition">
                                    <b class="hot-item-hover-job"><?php echo $infoYear[$i]['bookName'];?></b>
                                    <span class="hot-item-hover-sign">已借阅<?php echo $infoYear[$i]['count'];?>人/次</span>
                                    <a target="_blank" class="hot-item-hover-detail" href="book-item.php?booksId=<?php echo $infoYear[$i]['booksId'];?>" title="书籍详情">书籍详情</a>
                                </div>
                            </div>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </section>
                <section class="major-entr">
                    <div class="center">
                        <div class="major-section-title">
                            <i class="major-section-title-icon"></i>
                            三更灯火五更鸡，正是男儿读书时。黑发不知勤学早，白首方悔读书迟。
                        </div>
                        <div class="section-item">
                            <h3 class="section-item-title section-item-entr-title">书籍月度借阅榜</h3>
                        </div>
                        <ul class="entr-container">
                            <?php
                                $sqlMonth = 'select * from records join eachbooks on records.eachId = eachbooks.eachId '
                                    .'join books on books.booksId = eachbooks.booksId '
                                    .'where records.endDate is not null and DATE_SUB(CURDATE(), INTERVAL 1 MONTH) < endDate'
                                    .' group by eachbooks.booksId order by count(eachbooks.booksId) desc limit 0, 3';

                                $infoMonth = $db->getData($sqlMonth);

                                for ($i = 0; $i < sizeof($infoMonth); $i++) {
                            ?>
                            <li class="entr-item">
                                <a target="_blank" href="book-item.php?booksId=<?php echo $infoMonth[$i]['booksId'];?>">
                                    <img class="entr-image" src="<?php echo $infoMonth[$i]['img'];?>" title="<?php echo $infoMonth[$i]['bookName'];?>" />
                                    <div class="entr-item-wrap">
                                        <b class="entr-item-title"><?php echo $infoMonth[$i]['bookName'];?></b>
                                        <small class="entr-item-subtitle"><?php echo $infoMonth[$i]['author'];?> 著</small>
                                    </div>
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </section>
            </article>
        </section>

        <!-- 创业资讯 -->
        <section class="item center info">
            <div class="section-item section-item-info">
                <h3 class="section-item-title info-title">新闻资讯</h3>
            </div>
            <article class="info-container">
                <section class="info-item info-left">
                    <header class="info-item-header">
                        <h4 class="info-item-title">关注新闻资讯，信息更快掌握！</h4>
                        <a class="info-item-more" href="news.php">更多 >></a>
                    </header>
                    <div class="info-left-image-wrap">
                        <img class="info-left-image" src="imgs/info01.jpg" title="关注新闻资讯，信息更快掌握！" alt="关注新闻资讯，信息更快掌握！" />
                        <p class="info-left-image-desc">关注新闻资讯，信息更快掌握！</p>
                    </div>
                    <ul class="info-left-list">
                        <?php 
                            // 获取前十二个通知新闻
                            $infoNews = $db->getData('select * from news where newsType = "新闻通知" limit 0, 12');

                            for ($i = 0; $i < sizeof($infoNews); $i++){
                        ?>
                        <li class="info-left-list-item">
                            <a target="_blank" href="key-value.php?newId=<?php echo $infoNews[$i]['newId'];?>" title="<?php echo $infoNews[$i]['title'];?>">
                            <?php echo $infoNews[$i]['title'];?></a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </section>
                <section class="info-item info-right">
                    <header class="info-item-header">
                        <h4 class="info-item-title">资源下载</h4>
                        <a class="info-item-more" href="download.php">更多 >></a>
                    </header>
                    <ul class="info-right-container">
                        <?php
                            // 获取前3个资源下载
                            $infoLoad = $db->getData('select * from news where newsType = "资源下载" limit 0, 3');

                            for ($i = 0; $i < sizeof($infoLoad); $i++){
                        ?>
                        <li class="info-right-item">
                            <a class="info-right-item-a" href="<?php echo $infoLoad[$i]['newsSrc'];?>" download="">
                                <img class="info-right-item-image" src="imgs/download.png" />
                                <div class="info-right-item-wrap">
                                    <b class="info-right-item-title" title="<?php echo $infoLoad[$i]['title'];?>"><?php echo $infoLoad[$i]['title'];?></b>
                                    <p class="info-right-item-text" title="<?php echo $infoLoad[$i]['content'];?>"><?php echo $infoLoad[$i]['content'];?></p>
                                </div>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </section>
            </article>
        </section>
    </article>
    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>
    
    <script src="scripts/index-contents.js"></script>
</body>
</html>