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
$typename = isset($_GET['typename']) ? $_GET["typename"] : 1;
$id = getstageid("子公司", $typename)["id"];
$result = stage_history("子公司", $id, $page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>车辆历史汇总表</title>
</head>
    <?php echo $linkheader;?>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <!--  一共的总分表
        可以选择时间  默认到现在<br>
    可以翻页的柱状图
         按从高到低显示 -->
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
         <div class="row">
                <div class="col-sm-5"></div>
                <form action="">
                    <div class="col-sm-2" >
                        <input type="text" placeholder="请输入子公司名称" class="form-control"  name="typename"></div>
                </div>
         <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn-block btn">提交</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-6" >
                    <div  id='container'></div>
                      <?php if (isset($_GET["id"])) {
	echo page($page, $count, $limit, 6, $class = 'paginate_button');
}
?></div>
            <div class="col-sm-6" >
                <div  id='container_1'></div>
            </div>
            </div>

            <!--   <span stye="color:red">点击柱状图 显示饼状图</span>
        -->

        <!-- 柱状图  数据与饼图一样 -->
        <div class="row">
                <div id='container_2' style="display:none">
                    <!--表格 -->
                     <div class="row">
                    <table class="table table-bordered table-striped table-condensed table-hover tables" text-align="center" id="tabl">
                        <tr>
                            <th>路段名</th>
                            <th>各类消息</th>
                            <th>综合</th>
                            <th>查看整改效果</th>
                            <th>地图模式</th>
                        </tr>
                      </table>
                  </div>
                   <div class="row">
                    <table class="table table-bordered table-striped table-condensed table-hover tables" text-align="center" id="tabl">
                        <tr>
                            <th>时段名</th>
                            <th>各类消息</th>
                            <th>综合</th>
                            <th>查看整改效果</th>
                            <th>地图模式</th>
                        </tr>

            </table>
        </div>
         <div class="row">
                    <table class="table table-bordered table-striped table-condensed table-hover tables" text-align="center" id="tabl">
                        <tr>
                            <th>路段名</th>
                            <th>时段名</th>
                            <th>各类消息</th>
                            <th>综合</th>
                            <th>查看整改效果</th>
                            <th>地图模式</th>
                        </tr>
</table>
    </div>
                </div>
            </div>
        </div>
    </div>
<!--
    加柱状图  数据与饼图一样<br>
表格1：路段名  各类消息  综合  查看整改效果  地图模式（进入司机第4张）     前5个或翻页
<br>
表格2：时段名  各类消息  综合  查看整改效果  地图模式（进入司机第4张）     前5个或翻页
<br>
表格3：时段名  路段名  各类消息  综合  查看整改效果  地图模式（进入司机第4张）  前5个或翻页
<br>--></body>
<?php echo $bottomsc;?>
<?php if (isset($_GET["typename"])) {
	?>
<script>
    var id='<?php echo $id;?>';
$(function(){
                var colors = ['red', 'yellow', 'orange', 'blue', 'green','red', 'yellow', 'orange', 'blue', 'green',],
        categories = [<?php foreach ($result[0] as $item) {?>
                '<?php echo $item["起始日期"] . "至" . $item["终止日期"];?>',
            <?php }
	?>],
        name = '司机历史汇总表',
        data = [
        <?php foreach ($result[0] as $item) {?>
            {
                y: <?php echo $item["危险分数"];?>,
                color: "<?php echo getcolor($item["危险分数"]);?>",
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
            text: '子公司历史汇总表'
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
                            show_loading_bar({
                                            pct:100,
                                        });
                            $('html,body').animate({scrollTop:$("#container_1").offset().top},500);
                            var date=this.category;
                            $.post('http://localhost/jianeye/api/stage_history.php', { 'stage':'子公司','date':this.category,'id':id}, function (text) {
                                            var json=eval(text);
                                            var dn =new Array();
                                            for(var i=0,l=json.length;i<l;i++){
                                                var ar= new Array();
                                            for(var key in json[i]){
                                                ar.push(json[i][key]);
                                                ar.unshift();
                                            }
                                            dn.push(ar);
                                            dn.unshift();
                                            }
                                    var colors = ['red', 'yellow', 'orange', 'blue', 'green','green'];
                                     $('#container_1').highcharts({
                                                                 chart: {
                                                                    plotBackgroundColor: null,
                                                                    plotBorderWidth: null,
                                                                    plotShadow: false
                                                                },
                                                                title: {
                                                                    text: '安全饼图'
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
                                                                                    var ac_type= this.name;
                                                                                     show_loading_bar(70);
                                                                                     $.ajax({
                                                                                                url:"http://localhost/jianeye/api/stage_history_road.php",
                                                                                                method:"post",
                                                                                                dataType: 'json',
                                                                                                 data: {
                                                                                                    'stage':'子公司',
                                                                                                    'date': date,
                                                                                                    'category':ac_type,
                                                                                                    'id':id,
                                                                                                },
                                                                                               success: function(resp){
                                                                                                   show_loading_bar(100);
                                                                                                   $('#container_2').children(".row").eq(0).children("table").eq(0).children("tr").eq(0).append("<tr></tr>");
                                                                                                   str="";
                                                                                                   for(var i=0,l=resp[0].length;i<l;i++){
                                                                                                        str+='<tr>';
                                                                                                        str+='<td>'+resp[0][i].路段名+'</td>';
                                                                                                        str+='<td>'+resp[0][i].消息+'</td>';
                                                                                                        str+='<td>'+resp[0][i].综合+'</td>';
                                                                                                        str+='<td><a href="trend.php?id='+id+'&name='+resp[0][i].路段名+'">'+"查看整改效果"+'</a></td>';
                                                                                                        str+='<td><a href="map_history.php?id='+id+'&name='+resp[0][i].路段名+'">'+"地图模式"+'</a></td>';
                                                                                                        str+='</tr>';
                                                                                                    }
                                                                                                   $(str).appendTo( $('#container_2').children(".row").eq(0).children("table").eq(0));
                                                                                                   str="";
                                                                                                      for(var i=0,l=resp[1].length;i<l;i++){
                                                                                                        str+='<tr>';
                                                                                                        str+='<td>'+resp[1][i].时段名+'</td>';
                                                                                                        str+='<td>'+resp[1][i].消息+'</td>';
                                                                                                        str+='<td>'+resp[1][i].综合+'</td>';
                                                                                                        str+='<td><a href="trend.php?id='+id+'&time='+resp[1][i].时段名+'">'+"查看整改效果"+'</a></td>';
                                                                                                        str+='<td><a href="map_history.php?id='+id+'&time='+resp[1][i].时段名+'">'+"地图模式"+'</a></td>';
                                                                                                        str+='</tr>';
                                                                                                    }
                                                                                                     $(str).appendTo( $('#container_2').children(".row").eq(1).children("table").eq(0));
                                                                                                         str="";
                                                                                                      for(var i=0,l=resp[2].length;i<l;i++){
                                                                                                        str+='<tr>';
                                                                                                        str+='<td>'+resp[2][i].路段名+'</td>';
                                                                                                        str+='<td>'+resp[2][i].时段名+'</td>';
                                                                                                        str+='<td>'+resp[2][i].消息+'</td>';
                                                                                                        str+='<td>'+resp[2][i].综合+'</td>';
                                                                                                        str+='<td><a href="trend.php?id='+id+'&name='+resp[2][i].路段名+'&time='+resp[2][i].时段名+'">'+"查看整改效果"+'</a></td>';
                                                                                                        str+='<td><a href="map_history.php?id='+id+'&name='+resp[2][i].路段名+'&time='+resp[2][i].时段名+'">'+"地图模式"+'</a></td>';
                                                                                                        str+='</tr>';
                                                                                                    }
                                                                                                     $(str).appendTo( $('#container_2').children(".row").eq(2).children("table").eq(0));
                                                                                               }
                                                                                     });
                                                                                  $('#container_2').css('display','block');
                                                                                 $('html,body').animate({scrollTop:$("#container_2").offset().top},500);
                                                                                 }
                                                                       },
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
                                                                    name: '危险分数占比',
                                                                    data: dn,
                                                                }]
                                                            });

                             });
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
<?php }
?></script>
<script>
$(function(){

});
</script>
</html>