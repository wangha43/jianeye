<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$licence = isset($_GET['licence']) ? $licence : 'a1t1l1c1';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$limit = 10;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$result = car_detail_oil($id, $page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>统计</title>
</head>
    <?php echo $linkheader;?>
<body>
    <?php echo $nav;?>
    <!-- 油耗线与车辆危险分数线 <br>
    -->
    <div class="page-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6">
                    <div id="container_1"></div>
                              <?php echo page($page, $count, $limit, 4);?>
                    </div>
            </div>
            <!-- 油耗与刹车时间里程和时间（看能否得到）<br>
            -->
        <!--     <div class="row">
                <div class="col-sm-6">
                    <div id="container_2"></div>
                </div>
            </div>
            <br> -->
            <!-- 油耗与待速比例<br>
            增加曲线图
    1.急加速和急刹车次数和油耗线 -->
  <!--   <div class="row">
                <div class="col-sm-6">
            <div id="container"></div>
        </div>
    </div> -->
            <br>

            <br>
            <!-- 车辆油耗详情：<br>
            司机 GPS里程 ME里程 实际里程 (ME里程 校正里程)   加油量  -->
            <div class="row">
            <div class="col-sm-6">
                <table  class="table table-bordered table-hover">
                    <tr>
                        <th>司机</th>
                        <th>GPS里程</th>
                        <th>ME里程</th>
                        <th>实际里程(ME里程 校正里程)</th>
                        <th>加油量</th>

                    </tr>
                    <?php foreach ($result[1] as $item) {?>
                    <tr>
                        <td><?php echo $item["司机"];?></td>
                        <td><?php echo $item["GPS里程"];?></td>
                        <td><?php echo $item["ME里程"];?></td>
                        <td><?php echo $item["实际里程"];?></td>
                        <td><?php echo $item["加油量"];?></td>
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
    <script>
    $(function(){
        $('#container_1').highcharts({
        title: {
            text: '月份数据统计',
           //center
        },

        xAxis: {
            categories: [<?php foreach ($result[0] as $item) {?>
                '<?php echo $item["月份"];?>',
<?php }
?>]
        },
        yAxis: {
            title: {
                text: '相应数值'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series:  [{
            name: '油耗线',
            data: [
             <?php foreach ($result[0] as $item) {?>
                <?php echo $item["油耗"];?>,
            <?php }
?>
            ]
        }, {
            name: '车辆危险分数线',
            data: [
            <?php foreach ($result[0] as $item) {?>
                <?php echo $item["危险分数"];?>,
            <?php }
?>
             ]
        }, {
            name: '怠速比例',
            data: [  <?php foreach ($result[0] as $item) {?>
                <?php echo $item["怠速比例"];?>,
            <?php }
?>]
        }, {
            name: '急加速和急刹车次数',
            data: [
                <?php foreach ($result[0] as $item) {?>
                <?php echo $item["急加速与急刹车次数"];?>,
            <?php }
?>
            ]
        }]
    });
});
</script>

</html>