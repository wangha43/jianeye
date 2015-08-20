<?php
header("Content-type: text/html; charset=utf-8");
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>大数据分析</title>
	<?php echo $linkheader;?>
	<link rel="stylesheet" href="../assets/all.css"></head>
	<script src='http://api.map.baidu.com/api?v=1.4'></script>
<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>
	<!-- 可选时间段 周 月份 -->
	<div class="page-container">
		<?php echo $nav;?>
		<div class="main-content">
			<?php echo $navr;?>
			<!--   排名趋势线性图 -->
			<div class="row">
				<div class="col-sm-12">
					<ul class="nav nav-tabs nav-tabs-justified">
						<li class="active">
							<a href="#settings-3" data-toggle="tab">
								<span class="visible-xs"> <i class="fa-home"></i>
								</span>
								<span class="hidden-xs">车辆运行时间</span>
							</a>
						</li>
						<li>
							<a href="car_runtime_sp.php" >
								<span class="visible-xs"> <i class="fa-user"></i>
								</span>
								<span class="hidden-xs">车辆运行异常</span>
							</a>
						</li>
						<li>
							<a href="" >
								<span class="visible-xs">
									<i class="fa-envelope-o"></i>
								</span>
								<span class="hidden-xs">单个事件安全风险</span>
							</a>
						</li>
						<li>
							<a href="road_safe.php">
								<span class="visible-xs">
									<i class="fa-cog"></i>
								</span>
								<span class="hidden-xs">路段安全风险</span>
							</a>
						</li>
						<li>
							<a href="time_safe.php">
								<span class="visible-xs">
									<i class="fa-cog"></i>
								</span>
								<span class="hidden-xs">时段安全风险</span>
							</a>
						</li>
						<li>
							<a href="road_time_safe.php">
								<span class="visible-xs">
									<i class="fa-bell-o"></i>
								</span>
								<span class="hidden-xs">路段加时段安全风险</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active"  id="settings-3">
							<div class="row">
								<div class="col-sm-6">
									<div id="container_1" style="min-height:494px"></div>
								</div>
								<div class="col-sm-6">
									<div class="chart-item-bg">
										<div id="eMapContainer" style="height:494px"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="80" data-suffix="分钟" data-duration="2">
										<div class="xe-upper">
											<div class="xe-icon">
												<i class="fa-clock-o"></i>
											</div>
											<div class="xe-label"> <strong class="num">180分钟</strong>
												<span>历史最快</span>
											</div>
										</div>
										<div class="xe-lower">
											<div class="border"></div>

											<span>黄金比例最快占比</span> <strong>10%</strong>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="150" data-suffix="分钟" data-duration="2">
										<div class="xe-upper">
											<div class="xe-icon">
												<i class="fa-clock-o"></i>
											</div>
											<div class="xe-label">
												<strong class="num">80分钟</strong>
												<span>历史最慢</span>
											</div>
										</div>
										<div class="xe-lower">
											<div class="border"></div>
											<span>黄金比例最慢占比</span>
											<strong>10%</strong>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<table class="table table-bordered table-striped table-condensed table-hover" style="text-align:center" id="tabl">
									<tr  style="text-align:center" >
										<th>线路</th>
										<th>班次</th>
										<th>运行时间</th>
										<th>里程</th>
										<th>平均速度</th>
										<th>起点</th>
										<th>途径</th>
										<th>终点</th>
										<th>出发时间</th>
										<th>到达时间</th>
										<th>明细</th>
										<th>详情</th>
									</tr>
									<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = car_runtime($page);
$count = $result["count"];
$limit = 10;
foreach ($result[0] as $item) {?>
									<tr>
										<td class="">
											<?php echo $item["线路"];?></td>
										<td class="">
											<?php echo $item["班次"];?></td>
										<td class="">
											<?php echo $item["运行时间"];?></td>
										<td class="">
											<?php echo $item["里程"];?></td>
										<td class="">
											<?php echo $item["平均速度"];?></td>
										<td class="">
											<?php echo $item["起点"];?></td>
										<td class="">
											<?php echo $item["途径"];?></td>
										<td class="">
											<?php echo $item["终点"];?></td>
										<td class="">
											<?php echo $item["出发时间"];?></td>
										<td class="">
											<?php echo $item["到达时间"];?></td>
										<td>
											<button class="btn btn-success btn-xs" onclick="jQuery('#modal-1').modal('show', {backdrop: 'static'});">明细</button>
										</td>
										<td>
											<a href='http://localhost/jianeye/driver/map.php?car_run=<?php echo $item["id"];?>'>详情</a>
										</td>
									</tr>
									<?php }
?>
									<tfoot>
										<tr></tr>
									</tfoot>
								</table>
								<?php echo page($page, $count, $limit, 4);?></div>


							<!-- Modal 5 (Long Modal)-->
	<div class="modal fade" id="modal-5">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Long Height Modal</h4>
				</div>

				<div class="modal-body">

					<img src="assets/images/eiffel.jpg" alt="" class="img-responsive" />

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal 1 (Basic)-->
	<div class="modal fade" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">明细</h4>
				</div>

				<div class="modal-body">
					<div id="results">

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
	//ajax获取信息
	$("#results" ).load( "fetch_pages.php"); //load initial records
	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("fetch_pages.php",{"page":page}, function(){ //get content from PHP page
		});

	});
	//地图
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
});
</script>
	<script>
$(function () {
$('#container_1').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: '车辆运行时间'
        },
        xAxis: {
            type: 'datetime'	,
              dateTimeLabelFormats: { // don't display the dummy year
                 day: '%b %e',
            week: '%b %e'
            },
        },
        yAxis: {
            title: {
                text: '耗费时间(分钟)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%b%e}日  : {point.y:.2f} 分钟'
                }
            },

        },
        series: [{
          name:"班次消耗时间",
          type: 'line',
          data: [
             {
                name: '0',
                x: Date.UTC(2015,8,12),
                y: 190
            },
               {
                name: '2',
                x: Date.UTC(2015,8,13),
                y: 200
              },
               {
                name: '1',
                x: Date.UTC(2015,8,14),
                y: 200
              },
               {
                name: '6',
                x: Date.UTC(2015,8,15),
                y: 180
              },
              {
                name: '3',
                x: Date.UTC(2015,8,16),
                y: 200
              },
               {
                name: '5',
                x: Date.UTC(2015,8,16),
                y: 200
              },
              {
                name: '4',
                x: Date.UTC(2015,8,16),
                y: 200
              },
            ],
    },
    {
    	name:"平均消耗时间",
    	type:"line",
    	data:[[Date.UTC(2015,8,12), 195], [Date.UTC(2015,8,16), 195]],
    	enableMouseTracking: false
    }
    ]
    });
});
</script>
<?php echo $bottomsc;?>
</html>