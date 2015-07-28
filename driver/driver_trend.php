<?php
$time = time();
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
$name = isset($_GET["name"]) ? $_GET["name"] : null;
$time = isset($_GET["time"]) ? $_GET["time"] : null;
$type = $_GET["type"];
$result = driver_trend($type, $id, $name, $time);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>司机整改趋势表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container_2"></div>
                </div>
            </div>
        </div>
    </div>
</body>
    <?php echo $bottomsc;?>
    <script>
$(function(){
var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result[1] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '车辆安全风险表',
        data = [
        <?php foreach ($result[1] as $item) {?>
             {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php getcolor($item["危险分数"])?>",
            },
        <?php }
?>
            ];
    $('#container_2').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: "司机<?php if (isset($_GET['name'])) {
	echo $_GET['name'];
}
?>整改趋势表"
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '危险分数'
            }
        },
        plotOptions: {
            line: {
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: this.color,
                    style: {
                        fontWeight: 'bold'
                    },
                },
            },
        },
        tooltip: {
             enabled: true,
             formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>危险分数为:'+ this.y ;
                return s;
            }
        },
        series: [{
            name: '趋势',
            data: data,
        }],
          exporting: {
            enabled: true
        }
    });
});
</script>
</html>