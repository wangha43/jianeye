<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$limit = 10;
$result = drver_scresult($page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>本月司机安全风险表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
                <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
            <div class="row">
               <div class="col-sm-6">
                    <div id="container" ></div>
                </div>
            </div>
            <!-- 柱状图 要求可以翻页 -->

            <div id="container_1">
                <!--       显示司机排名表格 -->
                <div class="row">
                <div class="col-sm-6">
                        <table class="table table-bordered table-hover" text-align="center" id="tabl">
                            <tr>
                                <th>名字</th>
                                <th>危险分数</th>
                                <th>排名</th>
                                <th>升降</th>
                                <th>安全奖标准（如￥1000）</th>
                                <th>安全奖励比例</th>
                                <th>实际奖励</th>
                                <th>备注</th>
                            </tr>
                            <?php foreach ($result["0"] as $item) {?>
                            <tr>
                                <td>
                                    <?php echo $item["司机名"];?></td>
                                <td>
                                    <?php echo $item["危险分数"];?></td>
                                <td>
                                    <?php echo $item["排名"];?></td>
                                <td>
                                    <?php echo $item["升降"];?></td>
                                <td>
                                    <?php echo $item["安全奖标准"];?></td>
                                <td>
                                    <?php echo $item["奖励比例"];?></td>
                                <td>
                                    <?php echo $item["实际奖励"];?></td>
                                <td>
                                    <?php echo $item["备注"];?></td>
                            </tr>
                            <?php }
?>
                 <?php
echo page($page, $count, $limit, 6, $class = 'paginate_button');
?>
                            <tfoot>
                                <tr>
                                    <td>总分（所有的人员分数总和）</td>
                                    <td class="danger" colspan="7"><?php echo $result["合计危险总分"];?></td>
                                </tr>
                            </tfoot>
                        </table>
                </div></div>
                <!-- 每个格子存在背景色
点击后显示
默认为最近星期时间段的排名 --> </div>
        </div>
    </div>
</body>
    <?php echo $bottomsc;?>
    <script>
    $(function () {
    var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = ['司机1', '司机2', '司机3', '司机4', '司机5', '司机6', '司机7', '司机8', '司机9', '司机10'],
        name = '司机安全风险表',
        data = [
            <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php echo getcolor($item["危险分数"]);?>",
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
            text: '本月司机安全风险绩效表'
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