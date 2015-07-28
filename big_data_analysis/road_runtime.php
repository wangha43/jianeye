<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$result = road_run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>道路通行情况分析表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <!-- 可选消息类型：各类警告（按次数统计）
<br>
    按精度 算出各区域发生的次数 由大到小排柱形显示（多类型堆叠） 所有的区域 可翻页
    <br>
    <span stye="color:red">点击进入地图模式</span>
    -->
    <?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6">
                    <div id="container_1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div id="container_2"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div id="container_3"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php echo $bottomsc;?>
    <script>
    $(function () {
    $('#container_1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '刹车事件路段报警次数'
        },
        xAxis: {
            categories: [
            <?php foreach ($result[0] as $item) {?>'<?php echo $item["路段名"];?>',<?php }
?>]
        },
        yAxis: {
            min: 0,
            title: {
                text: '道路'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            // align: 'right',
            // x: -70,
            // verticalAlign: 'top',
            // y: 20,
            // floating: true,
          enabled:false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br>'+
                    this.series.name +': '+ this.y +'<br>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: '刹车次数',
            data: [  <?php foreach ($result[0] as $item) {?><?php echo $item["刹车次数"];?>,<?php }
?>]
        }]
    });
   $('#container_2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'FCW路段报警次数'
        },
        xAxis: {
            categories: [
                <?php foreach ($result[1] as $item) {?>'<?php echo $item["路段名"];?>',<?php }
?>
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: '道路'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            // align: 'right',
            // x: -70,
            // verticalAlign: 'top',
            // y: 20,
            // floating: true,
            // color:'red',
            enabled:false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br>'+
                    this.series.name +': '+ this.y +'<br>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'FCW次数',
            data: [
                 <?php foreach ($result[1] as $item) {?><?php echo $item["FCW次数"];?>,<?php }
?>
            ]
        }]
    });
 $('#container_3').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'PCW路段报警次数'
        },
        xAxis: {
            categories: [
               <?php foreach ($result[2] as $item) {?>'<?php echo $item["路段名"];?>',<?php }
?>
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: '道路'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            // align: 'right',
            // x: -70,
            // verticalAlign: 'top',
            // y: 20,
            // floating: true,
            enabled:false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br>'+
                    this.series.name +': '+ this.y +'<br>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'PCW次数',
            data: [   <?php foreach ($result[2] as $item) {?><?php echo $item["PCW"];?>,<?php }
?>]
        }]
    });
});
</script>
</html>