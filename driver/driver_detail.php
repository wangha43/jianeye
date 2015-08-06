<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$name['driver_name'] = '';
}
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = 10;
$time = time();
$toweek = $time - 24 * 3600 * date('w', $time);
$result = single_driver_statistics($id, $page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>驾驶员安全风险统计</title>
</head>
    <script src='http://api.map.baidu.com/api?v=1.4'></script>
    <?php echo $linkheader;?>
    <style>
                                        h4{
                                            line-height: 32px;
                                        }
                                </style>
<body>
    <!-- 可选时间段 周 月份 -->
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
            <?php echo $navr;?>
            <section class="profile-env">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="chart-item-bg del1">
                            <div class="user-info-sidebar">
                                <a href="" class="user-img">
                                    <img src="../assets/images/user-4.png" alt="user-img" class="img-cirlce img-responsive img-thumbnail" style="width:60px;height:60px">
                                    <?php givestar(4.5);?>
                                </a>
                                  <span class="user-title">
                                        &nbsp;驾驶员名
                                        <span class="user-status is-online"></span>
                                    </span>
                                <span class="user-title">
                                    <input id="switch-state" type="checkbox" checked></span>
                                <span class="user-title on">监管中</span>
                                <ul class="list-unstyled user-info-list">
                                    <li>
                                        <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1" data-to='<?php echo $result["rank"][9]["安全分数"];?>
                                            ' data-suffix="" data-duration="3" data-easing="false">
                                            <div class="xe-icon"> <i class="linecons-user"></i>
                                            </div>
                                            <div class="xe-label"> <strong class="num">1</strong>
                                                <span>本周危险分数</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="500" data-to='<?php echo $result["rank"][9]["排名"];?>
                                            ' data-duration="4" data-easing="true">
                                            <div class="xe-icon"> <i class="linecons-user"></i>
                                            </div>
                                            <div class="xe-label"> <strong class="num">1000</strong>
                                                <span>本周排名</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="1" data-to="117" data-suffix="k" data-duration="3" data-easing="false">
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
                        <div id="eMapContainer" style="height:470px"></div>
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
                <div class="col-sm-6"></div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="chart-item-bg">
                        <div id="container" ></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="chart-item-bg">
                        <div id="container_3" ></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="chart-item-bg">
                    <div id="container_6" ></div>
                </div>
            </div>
            <div class="row">
                <div class="chart-item-bg">
                    <div id="container_5" ></div>
                </div>
            </div>
            <!-- +1个表格 统计星期内数据 图形表格化 表格可以按月或者周 显示周或者天内数据
    表格上额外放置按钮 -->
            <div class="row">
                <div class="chart-item-bg">
                    <div id="container_4" >
                        <h4>
                            <center>驾驶员本周数据</center>
                        </h4>
                        <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
                            <tr>
                                <th>时间</th>
                                <th>名字</th>
                                <th>里程</th>
                                <th>FCW</th>
                                <th>PCW</th>
                                <th>急加速</th>
                                <th>急减速</th>
                                <th>危险总分</th>
                            </tr>
                            <?php foreach ($result["daylist"] as $item) {?>
                            <tr>
                                <td>
                                    <?php echo $item["星期"];?></td>
                                <td>
                                    <?php echo $item['驾驶员名'];?></td>
                                <td class="danger">
                                    <?php echo $item["里程"];?></td>
                                <td>
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
            </div>

        </div>
    </div>
</body>
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
    <?php echo $bottomsc;?>
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
        categories = [<?php foreach ($result["rank"] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>];
        name = <?php echo '"' . $result["daylist"][0]["驾驶员名"] . '"'?> +"近10周安全风险统计",
        data = [
        <?php foreach ($result["rank"] as $item) {?>
            {
                y: <?php echo $item["安全分数"];?>,
                color: "<?php echo getcolor($item["安全分数"]);?>",
            },
            <?php }
?>];

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
                        window.location.href="driver_explain.php?date="+categories[this.x]+"&<?php if (isset($id)) {
	echo 'id=' . $id;
}
?>";
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
    $('#container_3').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: <?php echo '"' . $result["daylist"][0]["驾驶员名"] . '"'?> +'安全风险趋势'
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
                point: {
                    events: {
                        click: function() {
                              window.location.href="driver_explain.php?date="+categories[this.x]+"&<?php if (isset($id)) {
	echo 'id=' . $id;
}
?>";
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
    var    name = <?php echo '"' . $result["daylist"][0]["驾驶员名"] . '"'?> +'排名趋势',
        data = [
        <?php foreach ($result["rank"] as $item) {?>
            {
                y: <?php echo $item["排名"]?>,
                color: colors[1],
            },
            <?php }
?>];

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
                text: '排名'
            }
        },
        plotOptions: {
                 line: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                              window.location.href="driver_explain.php?date="+categories[this.x]+"&<?php if (isset($id)) {
	echo 'id=' . $id;
}
?>";
                        }
                    }
                }
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
            data: data,
        }],
        exporting: {
            enabled: true
        }
    })
   .highcharts(); // return chart
   <?php
$result = drver_scresult($page);
$count = $result["count"];
?>
    var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = ['驾驶员1', '驾驶员2', '驾驶员3', '驾驶员4', '驾驶员5', '驾驶员6', '驾驶员7', '驾驶员8', '驾驶员9', '驾驶员10'],
        name = '驾驶员安全风险表',
        data = [
            <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php echo getcolor($item["危险分数"]);?>",
            },
            <?php }
?>];

   $('#container_6').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '本月驾驶员安全风险绩效表'
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
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                                window.location.href="";
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
<?php
$result = driver_history("驾驶员", $id, $page);
?>
   var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result["data"] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '驾驶员历史汇总表',
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
            text: '驾驶员历史汇总表'
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

});
</script>
</html>