<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书馆信息管理系统 - 联系我们</title>
    <link href="css/index-master.css" rel="stylesheet" />
    <link href="css/contact.css" rel="stylesheet" />
</head>
<body>
    <?php
        // 引入页眉
        include 'index-master-header.php';
    ?>

    <h1 class="html-title">联系我们</h1>
    <div class="map-container" id="container"></div>
    <address class="map-desc map-desc-addr">
        地址：
        <?php
            // 从初始化表(default)中获取地址
            echo $db->getSingleData('select value_ from `default` where key_ = "地址"');
        ?>
    </address>
    <p class="map-desc map-desc-tele">
        电话：
        <?php
            // 从初始化表(default)中获取电话
            echo $db->getSingleData('select value_ from `default` where key_ = "电话"');
        ?>
    </p>

    <?php
        // 引入页脚
        include 'index-master-footer.php';
    ?>

    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=ee4f1aee4c13b2526137c940cdf5d9e2"></script>
    <script type="text/javascript">
        var map = new AMap.Map('container', {
            resizeEnable: true,
            zoom: 18,
            center: [106.530257,29.452519]
        });

        AMap.plugin(['AMap.ToolBar','AMap.Scale','AMap.OverView'],
            function(){
                map.addControl(new AMap.ToolBar());

                map.addControl(new AMap.Scale());

                map.addControl(new AMap.OverView({isOpen:true}));
            });

        //构建信息窗体中显示的内容
        function openInfo() {
            // 获取地址和电话
            var $addr = $('.map-desc-addr').html(),
                $tele = $('.map-desc-tele').html();

            //构建信息窗体中显示的内容
            var info = [];
            info.push('<h3 style="border-bottom: 1px dotted #ccc; padding-bottom: 5px; font-size: 16px; font-weight: 400;">XX图书馆</h3>');
            info.push('<p style="font-size: 12px; line-height: 2em;">' + $addr + '<br />' + $tele + '</p>');

            infoWindow = new AMap.InfoWindow({
                content: info.join("<br>") //使用默认信息窗体框样式，显示信息内容
            });
            infoWindow.open(map, [106.530257,29.452519]);
        }

        openInfo();
    </script>
</body>
</html>