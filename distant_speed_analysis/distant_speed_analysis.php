<?php
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$date = isset($_GET["time"]) ? $_GET["time"] : date("Ymd", time());
$result = distant_speed_anasis($date);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>路段超速统计分析（时速>100km/h）</title>
    <?php echo $linkheader;?>
</head>
<body>
    <!--    时速>
    100超速统计 -->
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
     <div class="row">
                <form action="" method ="get" class="form">
                    <div class="col-sm-4">
                       <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value=""  name="time" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    </form>
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div class="col-sm-6" >
                    <div id="container_3"></div>
                </div>
                <div class="col-sm-6" >
                    <div id="container_4"></div>
                </div>
            </div>
            <!-- 时速&lt;=100超速统计 -->
            <!--  路段超速排名表
     两个柱状图 -->
            <!--     点击进入地图 --> </div>
    </div>
</body>
<?php echo $bottomsc;?>
    <script>
      var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [
                <?php foreach ($result["大于100"] as $item) {?>
                '<?php echo $item["司机"];?>',
                <?php }
?>

                '司机2', '司机3', '司机4', '司机5', '司机6', '司机7', '司机8', '司机9', '司机10'],
        name = '司机安全风险表',
        data = [
              <?php foreach ($result["大于100"] as $item) {?>
            {
                y: <?php echo $item["超速次数"];?>,

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

    var chart = $('#container_3').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '路段超速排名表(时速>100)'
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '超速次数'
            }
        },
        plotOptions: {
            column: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                              window.location.href="../driver/driver_detail.php?id="+this.category;
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
     categories = [
                <?php foreach ($result["小于100"] as $item) {?>
                '<?php echo $item["司机"];?>',
                <?php }
?>

                '司机2', '司机3', '司机4', '司机5', '司机6', '司机7', '司机8', '司机9', '司机10'],
        name = '司机安全风险表',
        data = [
              <?php foreach ($result["小于100"] as $item) {?>
            {
                y: <?php echo $item["超速次数"];?>,

            },
            <?php }
?>];
   $('#container_4').highcharts({
        legend: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '路段超速排名表(时速<=100)'
        },

        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: '超速次数'
            }
        },
        plotOptions: {
            column: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            window.location.href="../driver/driver_detail.php?id="+this.category;
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
   .highcharts();
</script>
</html>
<script>
var d= new Date();
var str = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
$('.form_date').datetimepicker({
        language:  'zh-CN',
        format:"yyyymmdd",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        endDate:str,
    });
</script>
<script>
                    $(".form-control").change(function(){
                            $(".form").submit();
                    });
</script>