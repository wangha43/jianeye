<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = car_runtime($page);
$count = $result["count"];
$limit = 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车辆运行时间总表</title>
     <?php echo $linkheader;?>
</head>

<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>
 <!-- 表格显示
 车辆运行时间报表 -->
	<?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
            <div class="row">
     <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
        <tr>
            <th>线路</th>
            <th>班次</th>
            <th>运行时间</th>
            <th>里程</th>
            <th>平均速度</th>
            <th>起点</th>
            <th>途径</th>
            <th>终点</th>
            <th>出发时间</th>
            <th>到达时间</th>
            <th>明细</th>
            <th>详情</th>
        </tr>
        <?php foreach ($result[0] as $item) {?>
        <tr>
            <td class=""><?php echo $item["线路"];?></td>
            <td class=""><?php echo $item["班次"];?></td>
            <td class=""><?php echo $item["运行时间"];?></td>
            <td class=""><?php echo $item["里程"];?></td>
            <td class=""><?php echo $item["平均速度"];?></td>
        	<td class=""><?php echo $item["起点"];?></td>
        	<td class=""><?php echo $item["途径"];?></td>
            <td class=""><?php echo $item["终点"];?></td>
            <td class=""><?php echo $item["出发时间"];?></td>
            <td class=""><?php echo $item["到达时间"];?></td>
            <td><?php echo $item["明细"];?></td>
            <td><a href='http://localhost/jianeye/driver/map.php?car_run=<?php echo $item["id"];?>'>详情</a></td>
        </tr>
        <?php }
?>
        <tfoot>
        <tr>

        </tr>
        </tfoot>
    </table>
    </div>
    <div class="row">
        <?php echo page($page, $count, $limit, 4);?>
    </div>
<!-- 不按线路运行时间报表 -->

    </div>
    </div>
</body>
<?php echo $bottomsc;?>
<script>
</script>
</html>