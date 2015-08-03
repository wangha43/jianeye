<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$result = road_safe();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <div class="row">
                    <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
                        <tr>
                            <th>路段名</th>
                            <th>时段名</th>
                            <th>各类消息</th>
                            <th>安全危险分数</th>
                            <th>查看整改效果</th>
                            <th>地图模式</th>
                        </tr>
                        <?php foreach ($result as $item) {?>
                            <tr>
                                <td><?php echo $item["路段名"];?></td>
                                <td><?php echo $item["时段名"];?></td>
                                <td><?php echo $item["各类消息"];?></td>
                                <td><?php echo $item["安全危险分数"];?></td>
                                <td>
                                    <a href="trend.php?road=<?php echo urlencode($item["路段名"]);?>&time=<?php echo urlencode($item["时段名"]);?>">查看整改效果</a>
                                </td>
                                <td>
                                    <a href="map.php?road=<?php echo urlencode($item["路段名"]);?>&time=<?php echo urlencode($item["时段名"]);?>">地图模式</a>
                                </td>
                            </tr>
                            <?php }
?>

                    </table>
            </div>
        </div>
    </div>
</body>
<?php echo $bottomsc;?>
</html>