<?php
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$time = time();
$toweek = $time - 24 * 3600 * date('w', $time);
$count = 30;
$limit = 10;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$result = securesch("线路", $id, $page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $linkheader;?>
    <meta charset="UTF-8">
    <title>线路 安全风险趋势表</title>
</head>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <!-- 默认10个星期 可选月份  可选时间段 月份或者星期  -->
            <div class="row">
                <div class="col-sm-6">
                    <div id="container" ></div>
                        <?php echo page($page, $count, $limit, 4);?>
                </div>
                  <div class="col-sm-6">
                <div id="container_2"></div>
            </div>
            </div>
            <!--    点击柱状图显示表格
    加一个趋势折线图 数据同上<br>
            存在危险线 低于危险线是绿色 -->
            <!--   <span style="color:red">点击柱状图显示表格</span>
        -->
        <div class="row">

        </div>
         <div id="container_1" >
        <div class="row">
                    <iframe src="" id="ch1" frameborder="0" name="ch1" width="100%" scrolling="no" height="0px" onload="adjustIframeHeightOnLoad('ch1')"></iframe>
                          </div>
        <div class="row">
                    <iframe src="" id="ch2" frameborder="0" name="ch2" width="100%" scrolling="no" height="0px" onload="adjustIframeHeightOnLoad('ch2')"></iframe>
         </div>
        </div>
        进入分公司：
        <div class="row">
            <div class="col-sm-2">
                <select class="form-control" id="selec" >
                <?php foreach ($result[1] as $item) {?>
                    <option value="<?php echo $item["下级id"];?>"> <?php echo $item["下级名称"];?></option>
                 <?php }
?>
                </select>
            </div>
        </div>
    </div>
</div>
</body>
<?php echo $bottomsc;?><script>
    $(function () {
       $("#selec").change(function(){
            window.location.href="../company/securech.php?id="+$(this).val();
       });
    var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php
foreach ($result[0] as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '车辆安全风险表',
     data = [
            <?php foreach ($result[0] as $item) {?>
             {
                y: <?php echo $item["安全危险分数"];?>,
                color: "<?php echo getcolor($item["安全危险分数"])?>",
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
            text: '线路安全风险表'
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
                            window.open('ch1.php?date='+this.category+'&id=<?php echo $id;?>','ch1');
                             window.open('ch2.php?date='+this.category+'&id=<?php echo $id;?>','ch2');
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
   $('#container_2').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '线路安全风险表'
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
           line: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                              window.open('ch1.php?date='+this.category+'&id=<?php echo $id;?>','ch1');
                             window.open('ch2.php?date='+this.category+'&id=<?php echo $id;?>','ch2');
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
             enabled: true,
             formatter: function() {
                var point = this.point,
                    s = this.x +'<br/><b>风险指数为:'+ this.y ;
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