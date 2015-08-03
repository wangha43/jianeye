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
    <title>司机安全风险统计</title>
</head>
    <?php echo $linkheader;?>
<body>
    <!-- 可选时间段 周 月份 -->
    <div class="page-container">
          <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <div class="row">
        <div class="col-sm-3">
                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1" data-to='<?php echo $result["rank"][9]["安全分数"];?>' data-suffix="" data-duration="3" data-easing="false">
                        <div class="xe-icon">
                            <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">1</strong>
                            <span>本周危险分数</span>
                        </div>
                    </div>

                    <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1000" data-to='<?php echo $result["rank"][9]["排名"];?>' data-duration="4" data-easing="true">
                        <div class="xe-icon">
                            <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">1000</strong>
                            <span> 本周排名</span>
                        </div>
                    </div>
                      <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="1000" data-to='<?php echo $result["rank"][9]["排名"] - $result["rank"][8]["排名"];?>' data-duration="4" data-easing="true">
                        <div class="xe-icon">
                            <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">-500</strong>
                            <span> 较上周排名</span>
                        </div>
                    </div>
        </div>
        <div class="col-sm-6">
            <div id="container_2"></div>
            <?php echo page($page, $count, $limit, 4);?>
        </div>
         <div class="col-sm-3"></div>
    </div>

        <div class="row">
            <div class="col-sm-6">
                    <div id="container" ></div>
            </div>
            <div class="col-sm-6">
                   <div id="container_3" ></div>
            </div>
    </div>

            <a href="driver_explain.php<?php if (isset($id)) {
	echo '?id=' . $id;
}
?>"></a>
            <!-- +1个表格 统计星期内数据 图形表格化 表格可以按月或者周 显示周或者天内数据
    表格上额外放置按钮 -->
    <div class="row">
            <div id="container_4" >
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
                        <td><?php echo $item["星期"];?></td>
                        <td>
                            <?php echo $item['司机名'];?></td>
                        <td class="danger"><?php echo $item["里程"];?></td>
                        <td><?php echo $item["FCW"];?></td>
                        <td><?php echo $item["PCW"];?></td>
                        <td><?php echo $item["急加速"];?></td>
                        <td><?php echo $item["急减速"];?></td>
                        <td class="yellow">
                            <?php echo $item["危险总分"];?></td>
                    </tr>
                    <?php }
?></table>
            </div>
       </div>

        </div>
    </div>
</body>
<?php echo $bottomsc;?>
    <script>
    $(function () {

    var colors = ['red', 'yellow', 'orange', 'blue', 'green'],
        categories = [<?php foreach ($result["rank"] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>];
        name = <?php echo '"' . $result["daylist"][0]["司机名"] . '"'?> +"近10周安全风险统计",
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
            text: <?php echo '"' . $result["daylist"][0]["司机名"] . '"'?> +'司机安全风险趋势'
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





    var    name = <?php echo '"' . $result["daylist"][0]["司机名"] . '"'?> +'排名趋势',
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

});
</script>

</html>