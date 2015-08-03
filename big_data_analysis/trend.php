<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
if (isset($_GET["time"])) {
	$cond["时段"] = $_GET["time"];
}
if (isset($_GET["road"])) {
	$cond["路段"] = $_GET["road"];
}
$result = get_trend($cond);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>路段时段危险分数走势图</title>
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
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container"></div>
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
            categories = [<?php foreach ($result[1] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '<?php foreach ($cond as $key => $value) {echo $value;}
?>安全危险分数趋势图',
        data = [
        <?php foreach ($result as $item) {?>
            {
                y: <?php echo $item["安全危险分数"];?>,
                color: '<?php echo getcolor($item["安全危险分数"]);?>'
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
            text: name
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '安全危险分数'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        tooltip: {
             enabled: true,
                formatter: function() {
                    var point = this.point,
                        s = this.x +'<br/><b>安全危险分数为:'+ this.y ;
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