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
    <?php echo $linkheader;?>
<body>
    <!-- 可选时间段 周 月份 -->
    <div class="page-container">
      <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
          <!--   排名趋势线性图 -->
          <div class="row">
            <div class="col-sm-2">
                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1" data-to='<?php echo $result[0][9]["安全分数"];?>' data-suffix="" data-duration="3" data-easing="false">
                        <div class="xe-icon">
                            <i class="linecons-truck"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">1</strong>
                            <span>本周危险分数</span>
                        </div>
                    </div>

                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1000" data-to='<?php echo $result[0][9]["排名"];?>' data-duration="4" data-easing="true">
                        <div class="xe-icon">
                            <i class="linecons-truck"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">1000</strong>
                            <span> 本周排名</span>
                        </div>
                    </div>
                      <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1000" data-to='<?php echo $result[0][9]["排名"] - $result[0][8]["排名"];?>' data-duration="4" data-easing="true">
                        <div class="xe-icon">
                            <i class="linecons-truck"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">-500</strong>
                            <span> 较上周排名</span>
                        </div>
                    </div>
        </div>
                <div class="col-sm-6" >
            <div id="container_2" ></div>
               <?php echo page($page, $count, $limit, 4);?>
        </div>
        <div class="col-sm-4" >
            <div id="container_3"></div>
        </div>
    </div>
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container"></div>
                </div>
                 <div class="col-sm-6" >
                    <div id="container_1" ></div>
                </div>
            </div>
           <!--  <a href="3.车辆的风险安全详解.html">点击柱状图或线性图显示详情</a> -->
            <!-- +1个表格 统计星期内数据 图形表格化 表格可以按月或者周 显示周或者天内数据
    表格上额外放置按钮 -->
    <div class="row">
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
                        <td><?php echo $item["里程"];?></td>
                        <td class="danger"><?php echo $item["FCW"];?></td>
                        <td><?php echo $item["PCW"];?></td>
                        <td><?php echo $item["急加速"];?></td>
                        <td><?php echo $item["急减速"];?></td>
                        <td class="yellow"><?php echo $item["危险总分"];?></td>
                    </tr>
                    <?php }
?></table>
            </div>
            <br>

          <!--   在点的上方显示趋势数据 -->
            <br>
            <div class="row"></div>
         <!--    司机危险分数占比饼图 -->
            <span></span>
     <!--        <a href="../司机/2.司机安全风险统计.html">点击跳转司机第2页</a> -->
        </div>
    </div>
</body>
  <?php echo $bottomsc;?>
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
});
</script>

</html>