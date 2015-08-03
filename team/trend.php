<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
}
if (isset($_GET["name"])) {
	$type["路段"] = $_GET["name"];
} else {
	$type["路段"] = "路段";
}
if (isset($_GET["time"])) {
	$type["时段"] = $_GET["time"];
}
$limit = 10;
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
$result = stage_trend("车队", $id, $type);
$count = $result["count"];
// print_r($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>车队线路整改趋势表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <!-- <span stye="color:red">线状图 最近10周 对象为路段或时段等</span>
-->
<div class="page-container">
    <?php echo $nav;?>
<div class="main-content">
    <?php echo $navr;?>
        <div class="row">
            <div class="col-sm-6">
                <div id="container_2" style="width:700px"></div>
                <?php echo page($page, $count, $limit, 4);?>
            </div>
        </div>
    </div>
</div>
</body>
<?php echo $bottomsc;?>
<script>
$(function(){
var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result[0] as $item) {?>
                '<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>',
            <?php }
?>],
        // name = '车辆安全风险表',
        data = [
        <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["危险分数"];?>,
                color:'<?php echo getcolor($item["危险分数"]);?>',
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
            text: "车队<?php echo isset($_GET['name']) ? $_GET['name'] : '';?><?php echo isset($_GET['time']) ? $_GET['time'] : '';?>整改趋势表"
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