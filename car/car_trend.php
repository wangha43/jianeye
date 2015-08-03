<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$time = time();
$toweek = $time - 24 * 3600 * date('w', $time);
for ($i = 0; $i <= 10; $i++) {
	if ($i == 0) {
		$data[] = date('m月d日', $toweek) . '-至今';
	} else {
		$data[] = date('m月d日', $toweek - 24 * 3600 * 7 * $i) . '-' . date('m月d日', $toweek - 24 * 3600 * 7 * ($i - 1));
	}
}
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
    <title>车辆整改趋势表</title>
</head>
    <?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th{text-align: center!important;}
</style>
<body>
    <div class="page-container">
          <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
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
        categories = [<?php
for ($i = 9; $i >= 0; $i--) {
	echo '"' . $data[$i] . '",';
}
?>],
        name = '车辆安全风险表',
        data = [<?php foreach ($result[1] as $item) {?>
             {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php getcolor($item["危险分数"])?>",
            },
        <?php }
?>];
    $('#container_2').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: "车辆<?php if (isset($_GET['name'])) {
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