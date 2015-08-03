<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
$result = car_use($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>车辆利用率</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
             <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
          <div class="row">
                <div class="col-sm-5"></div>
                <form action="">
                    <div class="col-sm-2" >
                        <input type="text" placeholder="请输入车牌号" class="form-control"  name="id"></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn-block btn">提交</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container" ></div>
                </div>
                   <div class="col-sm-6" >
                    <div id="container_1" ></div>
                </div>
            </div>
            <!-- 行驶天数   停驶天数（里程小于指定数作为停驶天） 饼图 -->
    </div>
    </div>
</body>
    <?php echo $bottomsc;?>
    <script>
    <?php if (isset($_GET["id"])) {
	?>
$(function(){
    var colors = [ 'blue', 'black',];
    $('#container').highcharts({
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '行驶天数   停驶天数（里程小于指定数作为停驶天） 饼图'
        },
        colors:colors,
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '安全分数',
            data: [
            <?php foreach ($result[0] as $key => $value) {?>
                ["<?php echo $key;?>",<?php echo $value;?>],
                <?php }
	?>
            ]
        }]
    });
     $('#container_1').highcharts({
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '行车时间   熄火时间（根据ME工作时间）饼图'
        },
        colors:colors,
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '安全分数',
            data: [
                  <?php foreach ($result[1] as $key => $value) {?>
                ["<?php echo $key;?>",<?php echo $value;?>],
                <?php }
	?>
            ]
        }]
    });
})
<?php }
?>
</script>
</html>