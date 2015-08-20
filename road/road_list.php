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
    <title>路况分析</title>
       <script src='http://api.map.baidu.com/api?v=1.4'></script>
      <?php echo $linkheader;?>
</head>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
<style>
    .xe-widget.xe-counter .xe-icon i, .xe-widget.xe-counter-block .xe-upper .xe-icon i, .xe-widget.xe-progress-counter .xe-upper .xe-icon i {
    display: block;
    background: #68b828;
    color: #fff;
    text-align: center;
    font-size: 23px;
    line-height: 60px;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 50%;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 50%;
    -moz-background-clip: padding;
    border-radius: 50%;
    background-clip: padding-box;
}
.xe-widget.xe-counter .xe-icon, .xe-widget.xe-counter .xe-label, .xe-widget.xe-counter-block .xe-upper .xe-icon, .xe-widget.xe-counter-block .xe-upper .xe-label, .xe-widget.xe-progress-counter .xe-upper .xe-icon, .xe-widget.xe-progress-counter .xe-upper .xe-label {
    display: table-cell;
    vertical-align: middle;
    padding: 15px;
}
</style>
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <!-- 默认10个星期 可选月份  可选时间段 月份或者星期  -->
            <div class="row">
                <div class="col-sm-6">
                 <div class="chart-item-bg">
                    <div id="container_1"></div>
                </div>
                </div>
                <div class="col-sm-6">
                 <div class="chart-item-bg">
                      <div id="eMapContainer" style="height:400px"></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                 <div class="chart-item-bg">
                    <div id="container_2"></div>
                </div>
                </div>
                <div class="col-sm-6">
                     <div class="chart-item-bg">
                    <div id="container_4"></div>
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                 <div class="chart-item-bg">
                    <div id="container_3"></div>
                </div>
                </div>
                    <div class="col-sm-2">
                 <div class="chart-item-bg">
                     <div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="99.9" data-suffix="" data-duration="2">
                        <div class="xe-icon">
                            <i class="linecons-cloud"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">99</strong>
                            <span>事件次数</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-2">
                 <div class="chart-item-bg">
                   <div class="xe-widget xe-counter xe-counter-purple" data-count=".num" data-from="1" data-to="117" data-suffix="k" data-duration="2" data-easing="false">
                        <div class="xe-icon">
                            <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">117k</strong>
                            <span>车通行量</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-2">
                 <div class="chart-item-bg">
                    <div class="xe-widget xe-counter xe-counter-danger" data-count=".num" data-from="1000" data-to="99.9" data-duration="2" data-easing="true" data-suffix="%">
                        <div class="xe-icon">
                           <i class="linecons-lightbulb"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">%</strong>
                            <span>事故占比</span>
                        </div>
                </div>
                </div>
                </div>
            </div>
        </div>
</div>
</body>
<?php echo $bottomsc;?>
<script>
            try{
            var map = new BMap.Map('eMapContainer');
            var point = new BMap.Point(116.404,39.915);
            map.addControl(new BMap.NavigationControl());
            map.addControl(new BMap.MapTypeControl());
            map.enableScrollWheelZoom(true);
            map.centerAndZoom(point,11);
            map.setCurrentCity('广州');
            var marker = new BMap.Marker(point);
            map.addOverlay(marker);
            }catch(ex){
             }
</script>
<script>
 $(function () {
    $('#container_1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '急转弯'
        },
        xAxis: {
            categories: [
            <?php foreach ($result[0] as $item) {?>'<?php echo $item["路段名"];?>',<?php }
?>]
        },
        yAxis: {
            min: 0,
            title: {
                text: '发生次数'
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
            text: '人车混行'
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
                text: '发生次数'
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
            text: '长下坡'
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
                text: '发生次数'
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
 $('#container_4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '路面颠簸'
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
                text: '发生次数'
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