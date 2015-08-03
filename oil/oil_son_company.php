<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = oil_init("子公司", $id, $page);
$limit = 10;
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>子公司油耗趋势表</title>
</head>
<?php echo $linkheader;?>
<style type="text/css">#tabl tr,th,td{text-align: center!important;}</style>
<body>
<!-- 以分公司为最小单位

按月份
<br>
-->
<!-- 用分页表现
1.与危险分数线关系图 <br>
4.与刹车时间里程和时间（看能否得到）
<br>
2.与待速比例关系图
<br>
3.与三急次数关系图
<br>
5.油耗趋势图
<br>
6.可选的其他事件次数自由组合
<br>
-->
<div class="page-container">
        <?php echo $nav;?>
    <div class="main-content">
     <?php echo $navr;?>
        <div class="row">
            <div class="col-sm-6">
                <div id="container_3" ></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div id="container"></div>
            </div>
            <div class="col-sm-6">
                <div id="container_2" ></div>
            </div>
        </div>

        <!-- <span stye="color:red">点击柱状图显示表格</span>
    加一个趋势折线图 数据同上
    <br>
    存在危险线 低于危险线是绿色 -->
    <div class="row">

    </div>
    <div id="container_1">
    <div class="row" >
                <iframe src="" id="ch1" frameborder="0" name="ch1" width="100%" scrolling="no" height="0px" onload="adjustIframeHeightOnLoad('ch1')"></iframe>
            </div>
        <div class="row">
                <iframe src="" id="ch2" frameborder="0" name="ch2" width="100%" scrolling="no" height="0px" onload="adjustIframeHeightOnLoad('ch2')"></iframe>
                <!--     司机油耗 车辆油耗 两个表格<br>
                司机名  行驶总里程  本月行驶里程 加油量 油耗  详情
                <br>
                车牌名  车辆总里程  本月行驶里程 加油量 油耗  详情  -->
    </div>
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
        data = [
          <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["油耗"];?>,
                color:'<?php echo getcolor($item["油耗"]);?>',
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
            text: '分公司油耗表'
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
                            window.open("ch1.php?date="+dt,'ch1');
                            window.open("ch2.php?date="+dt,'ch2');
                              var wi= document.getElementById("ch1").contentWindow.document.body.scrollHeight + "px";
                                    var cc=$("#container_1").offset().top+wi;
                                     $('html,body').animate({scrollTop: $("#container_1").offset().top+wi}, 500);
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
            text: '分公司油耗曲线表'
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
            categories: [<?php
for ($i = 9; $i >= 0; $i--) {
	echo "'" . date('Ym', strtotime("-$i month")) . "',";
}
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
            name: '子公司安全危险分数',
            data: [  <?php foreach ($result[0] as $item) {
	echo $item['安全危险分数'] . ',';
}
?>]
  }]
    });

</script>
</html>