<?php
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
if (isset($_GET["time"])) {
	$score = driver_statistics("车辆", $_GET["time"]);
} else {
	$score = driver_statistics("车辆", date("Y-m-d", time()));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>车辆安全风险表</title>
      <?php echo $linkheader;?>
</head>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
            <!-- 默认10个星期 可选月份  可选时间段 月份或者星期  -->
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
                <div class="col-sm-6" >
                    <div id="container"></div>
                </div>
                <div class="col-sm-6" >
                    <div id="container_2"></div>
                </div>
            </div>
            <!-- <span style="color:red">点击柱状图或线性图显示表格</span>
        -->
        <!--     加一个趋势折线图 数据同上<br>
        存在危险线 低于危险线是绿色 -->
        <div class="row">

                <div id="container_1" style="display:none">
                    <iframe src="" id="ch1" frameborder="0" name="ch1" width="100%" scrolling="no" height="0px"   onload="adjustIframeHeightOnLoad('ch1')"></iframe>
                    <!-- 每个格子存在背景色
点击后显示
默认为最近星期时间段的排名 -->

            </div>
        </div>
        </div>
</div>
</body>
<?php echo $bottomsc;?>
<script>
    $(function () {
    var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($score as $item) {?>
                "<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>",
            <?php }
?>],
        name = '车辆安全风险表',
       data = [    <?php foreach ($score as $item) {?>
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
            text: '车辆安全风险表'
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
                            window.open('ch1.php?date='+this.category,'ch1');
                               $("#container_1").css('display','block');
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
                    s = this.x +'<br/><b>危险分数为:'+ this.y ;
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
            text: '车辆安全风险表'
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
                             window.open('ch1.php?date='+this.category,'ch1');
                               $("#container_1").css('display','block');
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
            // line: {
            //     dataLabels: {
            //         enabled: true
            //     },
            //     enableMouseTracking: false
            // }
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
<script>
var d= new Date();
var str = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
$('.form_date').datetimepicker({
        language:  'zh-CN',
        format:"yyyy-mm-dd",
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
</html>