<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 1;
}
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = 10;
$time = time();
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = single_car_statistics($id, $page);
$count = $result[3]["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>车辆安全风险统计</title>
</head>
    <script src='http://api.map.baidu.com/api?v=1.4'></script>
    <?php echo $linkheader;?>
<body>
    <!-- 可选时间段 周 月份 -->
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
            <?php echo $navr;?>
            <!--   排名趋势线性图 -->
            <section class="profile-env">
                <div class="row">
                    <div class="col-sm-4">
                            <div class="chart-item-bg del1">
                            <div class="user-info-sidebar">
                            <a href="" class="user-img">
                                <img src="../assets/images/car.png" alt="car-img" class="img-cirlce img-responsive img-thumbnail" style="width:60px;height:60px">
                                <?php givestar(4.5);?>
                            </a>
                              <span class="user-title">
                                    &nbsp;车牌号
                                    <span class="user-status is-online"></span>
                                </span>
                            <span class="user-title">
                                 <input id="switch-size" type="checkbox" checked data-size="mini">
                                </span>
                            <span class="user-title">监管中</span>
                            <ul class="list-unstyled user-info-list">
                                <li>
                                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1" data-to='<?php echo $result[0][9]["安全分数"];?>
                                        ' data-suffix="" data-duration="1.5" data-easing="false">
                                        <div class="xe-icon"> <i class="linecons-user"></i>
                                        </div>
                                        <div class="xe-label"> <strong class="num">1</strong>
                                            <span>本周危险分数</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="500" data-to='<?php echo $result[0][9]["排名"];?>
                                        ' data-duration="1" data-easing="true">
                                        <div class="xe-icon"> <i class="linecons-user"></i>
                                        </div>
                                        <div class="xe-label"> <strong class="num">1000</strong>
                                            <span>本周排名</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="1" data-to="117" data-suffix="k" data-duration="1" data-easing="false">
                                        <div class="xe-icon">
                                            <i class="linecons-user"></i>
                                        </div>
                                        <div class="xe-label">
                                            <strong class="num">117k</strong>
                                            <span>行驶公里</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-success btn-block text-left">
                                <span class="pull-left">是否工作中</span>
                                <i class="fa-check pull-right"></i>
                            </button>
                            <style>
                                    .btn-success{
                                            width:70%;
                                            margin:0 15%;
                                            margin-bottom: 10%;
                                    }
                                    .del1{
                                        padding-bottom: 10px;
                                    }
                            </style>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-8">
                        <div id="eMapContainer" style="height:494px"></div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chart-item-bg">
                        <div class="chart-label">
                            <div id="network-mbs-packets" class="h1 text-purple text-bold" data-count="this" data-from="0.00" data-to="21.05" data-suffix="km/h" data-duration="1">0.00mb/s</div>
                            <span class="text-small text-muted text-upper">速度</span>
                        </div>
                        <div class="chart-right-legend">
                            <div id="network-realtime-gauge" style="width: 170px; height: 240px"></div>
                        </div>
                        <div id="realtime-network-stats" style="height: 450px"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="container_2" ></div>
                    <?php echo page($page, $count, $limit, 4);?></div>
            </div>
            <div class="row">
                <div class="col-sm-6" >
                        <div class="chart-item-bg">
                    <div id="container"></div>
                </div>
                </div>
                <div class="col-sm-6" >
                    <div class="chart-item-bg">
                    <div id="container_1" ></div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" >
                      <div class="chart-item-bg">
                                <h4><center>车辆本周数据</center></h4>
                                <style>
                                        h4{
                                            line-height: 32px;
                                        }
                                </style>
                <table class="table table-bordered table-hover" text-align="center" id="tabl">
                    <tr>
                        <th>日期</th>
                        <th>里程</th>
                        <th>FCW</th>
                        <th>PCW</th>
                        <th>急加速</th>
                        <th>急减速</th>
                        <th>危险总分</th>
                    </tr>
                    <?php foreach ($result[1] as $item) {?>
                    <tr>
                        <td>
                            <?php echo $item["日期"];?></td>
                        <td>
                            <?php echo $item["里程"];?></td>
                        <td class="danger">
                            <?php echo $item["FCW"];?></td>
                        <td>
                            <?php echo $item["PCW"];?></td>
                        <td>
                            <?php echo $item["急加速"];?></td>
                        <td>
                            <?php echo $item["急减速"];?></td>
                        <td class="yellow">
                            <?php echo $item["危险总分"];?></td>
                    </tr>
                    <?php }
?></table>
    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="chart-item-bg">
                    <div id="container_3"></div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <div class="chart-item-bg">
                    <div id="container_8"></div>
                </div>
                </div>
                <div class="col-sm-6">
                  <div class="chart-item-bg">
                    <div id="container_9"></div>
                </div>
                </div>
            </div>
            <!--车辆油耗-->
            <div class="row">
                <div class="col-sm-6">
                  <div class="chart-item-bg">
                    <div id="container_4"></div>
                </div>
                </div>
                <div class="col-sm-6">
                  <div class="chart-item-bg">
                    <div id="container_6" ></div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <div class="chart-item-bg">
   <h4><center>本车油耗</center></h4>
                    <table  class="table table-bordered table-hover">
                        <tr>
                            <th>司机</th>
                            <th>GPS里程</th>
                            <th>ME里程</th>
                            <th>实际里程(ME里程 校正里程)</th>
                            <th>加油量</th>

                        </tr>
                        <?php $result = car_detail_oil($id, $page);?>
                        <?php foreach ($result[1] as $item) {?>
                        <tr>
                            <td>
                                <?php echo $item["司机"];?></td>
                            <td>
                                <?php echo $item["GPS里程"];?></td>
                            <td>
                                <?php echo $item["ME里程"];?></td>
                            <td>
                                <?php echo $item["实际里程"];?></td>
                            <td>
                                <?php echo $item["加油量"];?></td>
                        </tr>
                        <?php }
$result = single_car_statistics($id, $page);
?></table>
    </div>
                </div>
                <div class="col-sm-6">
                  <div class="chart-item-bg">
                    <div id="container_7" ></div>
                </div>
                </div>
            </div>
            <div class="row" >
              <div class="chart-item-bg">
                <div  id='container_5'></div>
            </div>
            </div>
            <!--  <a href="3.车辆的风险安全详解.html">点击柱状图或线性图显示详情</a>
        -->
        <!-- +1个表格 统计星期内数据 图形表格化 表格可以按月或者周 显示周或者天内数据
    表格上额外放置按钮 -->

        <br>

        <!--   在点的上方显示趋势数据 -->
        <br>
        <div class="row"></div>
        <!--    司机危险分数占比饼图 -->
        <span></span>
        <!--        <a href="../司机/2.司机安全风险统计.html">点击跳转司机第2页</a>
    -->
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
                   $(window).on('xenon.resize', function()
                    {
                        $("#realtime-network-stats").data("dxChart").render();
                    });
            function networkRealtimeChartTick(min_max, min_max2)
                {
                    var $ = jQuery,
                        i = 0;

                    var chart_data = $('#realtime-network-stats').dxChart('instance').option('dataSource');

                    var count = $('#realtime-network-stats').data('iCount');

                    $('#realtime-network-stats').data('iCount', count + 1);

                    chart_data.shift();
                    chart_data.push({id: count + 1, x1: between(min_max[0],min_max[1]), x2: between(min_max2[0],min_max2[1])});

                    $('#realtime-network-stats').dxChart('instance').option('dataSource', chart_data);
                }
                    // Realtime Network Stats
                var i = 0,
                        rns_values = [130,150],
                        rns2_values = [39,50],
                        realtime_network_stats = [];

                    for(i=0; i<=100; i++)
                    {
                        realtime_network_stats.push({ id: i, x1: between(rns_values[0], rns_values[1]), x2: between(rns2_values[0], rns2_values[1])});
                    }
                $("#realtime-network-stats").dxChart({
                        dataSource: realtime_network_stats,
                        commonSeriesSettings: {
                            type: "area",
                            argumentField: "id"
                        },
                        series: [
                            { valueField: "x1", name: "Packets Sent", color: '#7c38bc', opacity: .4 },
                            { valueField: "x2", name: "Packets Received", color: '#000', opacity: .5},
                        ],
                        legend: {
                            verticalAlignment: "bottom",
                            horizontalAlignment: "center"
                        },
                        commonAxisSettings: {
                            label: {
                                visible: false
                            },
                            grid: {
                                visible: true,
                                color: '#f5f5f5'
                            }
                        },
                        legend: {
                            visible: false
                        },
                        argumentAxis: {
                            valueMarginsEnabled: false
                        },
                        valueAxis: {
                            max: 500
                        },
                        animation: {
                            enabled: false
                        }
                    }).data('iCount', i);
            $('#network-realtime-gauge').dxCircularGauge({
                        scale: {
                            startValue: 0,
                            endValue: 200,
                            majorTick: {
                                tickInterval: 50
                            }
                        },
                        rangeContainer: {
                            palette: 'pastel',
                            width: 3,
                            ranges: [
                                { startValue: 0, endValue: 50, color: "#7c38bc" },
                                { startValue: 50, endValue: 100, color: "#7c38bc" },
                                { startValue: 100, endValue: 150, color: "#7c38bc" },
                                { startValue: 150, endValue: 200, color: "#7c38bc" },
                            ],
                        },
                        value: 140,
                        valueIndicator: {
                            offset: 10,
                            color: '#7c38bc',
                            type: 'triangleNeedle',
                            spindleSize: 12
                        }
                    });
            function networkRealtimeGaugeTick()
                {
                    var nr_gauge = jQuery('#network-realtime-gauge').dxCircularGauge('instance');

                    nr_gauge.value( between(50,200) );
                }
            function networkRealtimeChartTick(min_max, min_max2)
                {
                    var $ = jQuery,
                        i = 0;

                    var chart_data = $('#realtime-network-stats').dxChart('instance').option('dataSource');

                    var count = $('#realtime-network-stats').data('iCount');

                    $('#realtime-network-stats').data('iCount', count + 1);

                    chart_data.shift();
                    chart_data.push({id: count + 1, x1: between(min_max[0],min_max[1]), x2: between(min_max2[0],min_max2[1])});

                    $('#realtime-network-stats').dxChart('instance').option('dataSource', chart_data);
                }
                function networkRealtimeGaugeTick()
                {
                    var nr_gauge = jQuery('#network-realtime-gauge').dxCircularGauge('instance');

                    nr_gauge.value( between(50,200) );
                }
             function networkRealtimeMBupdate()
                {
                    var $el = jQuery("#network-mbs-packets"),
                        options = {
                            useEasing : true,
                            useGrouping : true,
                            separator : ',',
                            decimal : '.',
                            prefix : '' ,
                            suffix : 'km/h'
                        },
                        cntr = new countUp($el[0], parseFloat($el.text().replace('km/h')), parseFloat(between(10,25) + 1/between(15,30)), 2, 1.5, options);

                    cntr.start();
                }
                function between(randNumMin, randNumMax)
                {
                    var randInt = Math.floor((Math.random() * ((randNumMax + 1) - randNumMin)) + randNumMin);

                    return randInt;
                }
                setInterval(function(){  networkRealtimeChartTick(rns_values, rns2_values); }, 1000);
                    setInterval(function(){ networkRealtimeGaugeTick(); }, 2000);
                    setInterval(function(){ networkRealtimeMBupdate(); }, 3000);
</script>
<script>
    $(function () {
    var colors = ['red', 'yellow', 'orange', 'blue', 'green'],
        categories = [<?php foreach ($result[0] as $item) {?>
                '<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>',
            <?php }
?>],
        name = <?php echo '"' . $id . '"'?>+'车辆近10周安全风险统计',
        data = [
        <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["安全分数"];?>,
                color: "<?php echo getcolor($item['安全分数']);?>",
            },
                <?php }
?>
            ];
    function setChart(name, categories, data, color) {
    chart.xAxis[0].setCategories(categories, true);
    chart.series[0].remove(false);
    chart.addSeries({
        name: name,
        data: data,
        color: color || 'white'
    }, false);
    chart.redraw();
    }

    var chart = $('#container').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: name
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
            column: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            window.location.href='car_explain.php?date='+categories[this.x]+'&'+"id=<?php echo $id;?>";
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    color: this.color,
                    style: {
                        fontWeight: 'bold'
                    },
                    formatter: function() {
                        return this.y;
                    }
                }
            }
        },
        tooltip: {
            formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>危险分数:'+ this.y ;
                return s;
            }
        },
        series: [{
            name: '',
            data: data,
        }],
        exporting: {
            enabled: true
        }
    })
   .highcharts(); // return chart
    var chart = $('#container_1').highcharts({
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
                text: '危险分数'
            }
        },
        plotOptions: {
            line: {
               dataLabels: {
                    enabled: true,
                    color: this.color,
                },
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            window.location.href='car_explain.php?date='+categories[this.x]+'&'+"id=<?php echo $id;?>";
                        }
                    }
                },
            }
        },
        tooltip: {
            formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>危险分数:'+ this.y ;
                return s;
            }
        },
        series: [{
            name: '',
            data: data,
        }],
        exporting: {
            enabled: true
        }
    })
   .highcharts(); // return chart

    var chart = $('#container_2').highcharts({
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
                text: '车辆排名'
            }
        },
        plotOptions: {
             line: {
               dataLabels: {
                    enabled: true,
                    color: this.color,
                },
                cursor: 'pointer',
                 point: {
                    events: {
                        click: function() {
                            window.location.href='car_explain.php?date='+categories[this.x]+'&'+"id=<?php echo $id;?>";
                        }
                    }
                },
            },
            series: {
                dataLabels: {
                     enabled: true,
                    formatter: function () {
                        if(this.point.index==0){
                            return '<span style="color:">'+this.y + '(0)'+'/256'+ '</span>';
                        }else{
                        var index= this.series.yData[this.point.index]-this.series.yData[this.point.index-1];
                            if(index>0)
                            return '<span style="color:red">'+this.y + '(+' + index +')'+'/256'+ '</span>';
                            else
                            return '<span style="color:green">'+this.y + '(' + index +')'+'/256'+ '</span>';
                        }
                    }
                }
            }
        },
        tooltip: {
            formatter: function() {
                  if(this.point.index==0){
                            return this.x +'<br/><b>排名:'+ this.y+'<br/><b>排名进度:'+ '0';
                        }else{
                        var index= this.series.yData[this.point.index]-this.series.yData[this.point.index-1];
                            if(index>0)
                            return this.x +'<br/><b>排名:'+ this.y+'<br/><b>排名进度:' + '+'+index ;
                            else
                            return this.x +'<br/><b>排名:'+ this.y+'<br/><b>排名进度:' + index;
                        }
            }
        },
        series: [{
            name: '',
            data:   [
        <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["排名"]?>,
                color: colors[1],
            },
            <?php }
?>],
        }],
        exporting: {
            enabled: true
        }
    })
   .highcharts(); // return chart
    var colors = ['red', 'yellow', 'orange', 'blue', 'green','green'];
    $('#container_3').highcharts({
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '司机占比饼图'
        },
        colors:colors,
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                point:{
                events:{
                    click:function(){
                     window.location.href='../driver/driver_detail.php?id='+(this.pid);
                    }
                }
                },
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
                <?php foreach ($result[2] as $item) {?>
                {name:'<?php echo $item["司机名"];?>',   y: <?php echo $item["司机占比"];?>,pid: <?php echo $item["司机工号"];?>},
                <?php }
?>
            ]
        }]
    });
<?php $result = car_detail_oil($id, $page);?>
  $('#container_4').highcharts({
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

<?php
$result = driver_history("车辆", $id, $page);
?>
   var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result["data"] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '司机历史汇总表',
        data = [
        <?php foreach ($result["data"] as $item) {?>
            {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php echo getcolor($item["危险分数"]);?>",
            },
            <?php }
?>
             ];
$('#container_5').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '车辆历史汇总表'
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '风险指数'
            }
        },
        plotOptions: {
            column: {
                point: {
                    events: {
                        click: function() {
                           }
                    }
                },
                dataLabels: {
                    enabled: true,
                    color: this.color,
                    style: {
                        fontWeight: 'bold'
                    },
                    formatter: function() {
                        return this.y;
                    }
                }
            }
        },
        tooltip: {
            formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>风险指数为:'+ this.y ;
                return s;
            }
        },
        series: [{
            name: '',
            data: data,
        }],
        exporting: {
            enabled: true
        }
    })
   .highcharts(); // return chart

<?php $result = car_use($id);
?>
 var colors = [ 'blue', 'black',];
   $('#container_6').highcharts({
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
     $('#container_7').highcharts({
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

<?php
$time = time();
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
$name = isset($_GET["name"]) ? $_GET["name"] : null;
$time = isset($_GET["time"]) ? $_GET["time"] : null;
$type = $_GET["type"];
$result = driver_trend($type, $id, $name, $time);
?>
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
 name =
 $('#container_8').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: <?php echo '"' . $id . '"'?>+'车辆整改趋势',
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
<?php
$result = secure_trend($page);
?>
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
    $('#container_9').highcharts({
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
});
</script>

</html>