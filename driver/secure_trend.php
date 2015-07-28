<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$limit = 10;
$result = secure_trend($page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>平均危险分数走势图</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <!--    默认为周
        可选月份
        有史以来线状图<br>
    默认显示最近10周

        翻页
    <br>
    报表首页
        根据权限显示
    <br>
    -->
    <?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container"></div>
                <?php echo page($page, $count, $limit, 4);?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container_1" ></div>
                </div>
            </div>
        </div>
    </div>
    <!--   颜色将依据实际而定
                         <span stye="color:red">点击柱状图进入下一层</span>
公司->子公司(贡献柱形图由高到底)->...->司机->详细图解（如同3->5） -->
</body>
<?php echo $bottomsc;?>
<script>
    $(function(){
var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
            categories = [<?php foreach ($result[0] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '车辆安全风险表',
        data = [
        <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["单位车辆平均危险分数"];?>,
                color: "<?php echo getcolor($item["单位车辆平均危险分数"]);?>",
            },
            <?php }
?>
          ];
    $('#container').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '单位车辆的平均危险分数走势图'
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '平均危险分数'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        tooltip: {
             enabled: true,
            formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>平均危险分数为:'+ this.y ;
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
         $('#container_1').highcharts({
        title: {
            text: '危险分数占比图',
           //center
        },
         chart: {
            type: 'pie'
        },
        xAxis: {
            categories:[]
        },
        yAxis: {
            title: {
                text: '贡献值'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '贡献值',
            data: [
                <?php foreach ($result[1] as $item) {?>
                    ["<?php echo $item["事件类型"];?>",<?php echo $item["事件占比"];?>],
                <?php }
?>
            ]
        }]
    });
});

</script>
</html>