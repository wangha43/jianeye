<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$result = road_safe_time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th{text-align: center!important;}
</style>
<body>
 <?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6">
 	<table class="table table-bordered table-hover" text-align="center" id="tabl">
        <tr>
            <th>时段名</th>
            <th>各类消息</th>
            <th>安全危险分数</th>
            <th>查看整改效果 </th>
            <th>地图模式</th>
        </tr>

           <?php foreach ($result as $item) {?>
                            <tr>
                                <td><?php echo $item["时段名"];?></td>
                                <td><?php echo $item["各类消息"];?></td>
                                <td><?php echo $item["安全危险分数"];?></td>
                                <td>
                                    <a href="trend.php?time=<?php echo urlencode($item["时段名"]);?>">查看整改效果</a>
                                </td>
                                <td>
                                    <a href="map.php?time=<?php echo urlencode($item["时段名"]);?>">地图模式</a>
                                </td>
                            </tr>
                            <?php }
?>

    </table>
    </div>
    </div>
    </div>
    </div>
</body>
<?php echo $bottomsc;?>
</html>