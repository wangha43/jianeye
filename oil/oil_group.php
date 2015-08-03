<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = oil_init("集团", $id, $page);
$limit = 10;
$count = $result["count"];
$son = get_soncompany("集团", $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>集团油耗趋势表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">
    </style>
<body>

    <!-- 按月份
    按从高到低显示 -->
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <div class="row">
                 <div class="col-sm-6">
                    <div id="container_3"></div>
                       <?php echo page($page, $count, $limit, 4);?>
                </div>
            </div>
            <div class="row">
             <div class="col-sm-6" >
                    <div id="container"></div>
                </div>
                <div class="col-sm-6" >
                    <div id="container_2"></div>
                </div>
            </div>

            <!--           <span stye="color:red">点击柱状图显示表格</span>
        加一个趋势折线图 数据同上
        <br>
        存在危险线 低于危险线是绿色 -->
        <div class="row">
                  <!--   1个表格
                    <br>
                    子公司名  行驶总里程  本月行驶里程 加油量 油耗  详情（点击后去向子公司油耗页面）
 -->                    <br>
                    <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr>
                            <th>分公司名</th>
                            <th>行驶总里程</th>
                            <th>本月行驶里程</th>
                            <th>本月加油量</th>
                            <th>本月油耗</th>
                            <th>详情</th><!-- （点击后去向子公司油耗页面） -->
                        </tr>
        <?php foreach ($son as $item) {?>
                        <tr>
                            <td><?php echo $item["下级名"];?></td>
                            <td><?php echo $item["行驶总里程"];?></td>
                            <td><?php echo $item["本月行驶里程"];?></td>
                            <td><?php echo $item["本月加油量"];?></td>
                            <td><?php echo $item["本月油耗"];?></td>
                            <td><a href="oil_company.php?id=<?php echo $item['id'];?>">详情</a></td>
                        </tr>
        <?php }
?>
                    </table>
        </div>
    </div>
</div>
</body>
<?php echo $bottomsc;?>
<script>

    $(function () {

    var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result[0] as $item) {?>
                                '<?php echo $item["月份"];?>',
<?php }
?>],
        name = '油耗图',
        data = [ <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["油耗"];?>,
                color:'<?php echo getcolor($item["油耗"]);?>',
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
            text: '集团油耗表'
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '油耗量'
            }
        },
        plotOptions: {
            column: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                               var dt=this.category;
                         $('html,body').animate({scrollTop: $("#container_1").offset().top}, 500);
                                                        window.open("group_ch1.php?date="+dt,'ch1');
                                            $('#ch1').css('height','300px');
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
                    s = this.x +'<br/><b>油耗为:'+ this.y + 'L' ;
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
   $('#container_2').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '集团油耗曲线表'
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '油耗量'
            }
        },
        plotOptions: {
            line: {
                cursor: 'pointer',
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
                    s = this.x +'<br/><b>油耗为:'+ this.y + 'L' ;
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
     $('#container_3').highcharts({
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
        series: [{
            name: '油耗',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['油耗'] . ',';
}
?>
            ]
        }, {
            name: '怠速时长占跟总运行时长比例',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['怠速'] . ',';
}
?>]
        }, {
            name: '急加速次数',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['急加速'] . ',';
}
?>]
        }, {
            name: '刹车里程跟总运行里程比例',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['刹车'] . ',';
}
?>]
        }, {
            name: '集团安全危险分数',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['安全危险分数'] . ',';
}
?>]
        }]
    });

</script>
</html>