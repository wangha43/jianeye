<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$result = car_runtime_sp($page);
$count = $result["count"];
$limit = 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车辆运行时间总表</title>
     <?php echo $linkheader;?>
     <link rel="stylesheet" href="../assets/all.css"></head>
     <script src='http://api.map.baidu.com/api?v=1.4'></script>
</head>
<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>
 <!-- 表格显示
 车辆运行时间报表 -->
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
             <div class="row">
                <div class="col-sm-12">
                  <ul class="nav nav-tabs nav-tabs-justified">
                        <li>
                            <a href="all.php">
                                <span class="visible-xs"> <i class="fa-home"></i>
                                </span>
                                <span class="hidden-xs">车辆运行时间</span>
                            </a>
                        </li>
                        <li  class="active">
                            <a href="#settings-3"   data-toggle="tab">
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
                        <div class="tab-pane active" id="settings-3">
                        <div class="col-sm-6">
                            <div class="row">
                                        <div class="xe-widget xe-vertical-counter xe-vertical-counter-danger" data-count=".num" data-from="0" data-to="67.9" data-decimal="." data-suffix="%" data-duration="3">
                                        <div class="xe-icon">
                                            <i class="fa-warning"></i>
                                        </div>

                                        <div class="xe-label">
                                            <strong class="num">67.9%</strong>
                                            <span style="font-size:15px">异常比例</span>
                                        </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-sm-6">
                                           <div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="150" data-suffix="分钟" data-duration="2">
                                            <div class="xe-upper">
                                            <div class="xe-icon">
                                                <i class="fa-clock-o"></i>
                                            </div>
                                            <div class="xe-label">
                                                <strong class="num">0分钟</strong>
                                                <span>异常运行时间</span>
                                            </div>
                                           </div>
                                           <div class="xe-lower">
                                            <div class="border"></div>
                                            <span>正常运行时间</span>
                                            <strong>120分钟</strong>
                                           </div>
                                           </div>
                                </div>
                                <div class="col-sm-6">
                                            <div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="50" data-suffix="KM" data-duration="2">
                                            <div class="xe-upper">
                                            <div class="xe-icon">
                                                <i class="fa-clock-o"></i>
                                            </div>
                                            <div class="xe-label">
                                                <strong class="num">50KM</strong>
                                                <span>异常平均公里数</span>
                                            </div>
                                           </div>
                                           <div class="xe-lower">
                                            <div class="border"></div>
                                            <span>正常平均公里数</span>
                                            <strong>20km</strong>
                                           </div>
                                           </div>
                                </div>
                                     </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="chart-item-bg">
                                <div id="eMapContainer" style="height:420px"></div>
                            </div>
                            </div>
                                   <div class="row">
                                         <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
                                            <tr>
                                                <th>异常起点</th>
                                                <th>异常起点时间</th>
                                                <th>途经地点及时间</th>
                                                <th>异常终点</th>
                                                <th>异常终点时间</th>
                                                <th>原线路</th>
                                                <th>班次</th>
                                                <th>运行时间</th>
                                                <th>里程</th>
                                                <th>异常次数</th>
                                                <th>平均速度</th>
                                                <th>出发时间</th>
                                                <th>到达时间</th>
                                                <th>明细</th>
                                                <th>详情</th>
                                            </tr>
                                            <?php foreach ($result[0] as $item) {?>
                                            <tr>
                                                <td class=""><?php echo $item["起点"];?></td>
                                                <td class=""></td>
                                                <td class=""><?php echo $item["途径"];?></td>
                                                <td class=""><?php echo $item["终点"];?></td>
                                                 <td class=""></td>
                                                <td class=""><?php echo $item["原线路"];?></td>
                                                <td class=""><?php echo $item["班次"];?></td>
                                                <td class=""><?php echo $item["运行时间"];?></td>
                                                <td class=""><?php echo $item["里程"];?></td>
                                                <td class="">1</td>
                                                <td class=""><?php echo $item["平均速度"];?></td>
                                                <td class=""><?php echo $item["出发时间"];?></td>
                                                <td class=""><?php echo $item["到达时间"];?></td>
                                                <td>
                                                <button class="btn btn-success btn-xs" onclick="jQuery('#modal-1').modal('show', {backdrop: 'static'});">
                                                <?php echo $item["明细"];?>
                                                </button>
                                                </td>
                                                <td><a href='http://localhost/jianeye/driver/map.php?car_run=<?php echo $item["id"];?>'>详情</a></td>
                                            </tr>
                                            <?php }
?>
                                            <tfoot>
                                            <tr>

                                            </tr>
                                            </tfoot>
                                        </table>
                            </div>
    <div class="row">
        <?php echo page($page, $count, $limit, 4);?>
    </div>
                        </div>

                    </div>
  </div>
<!-- 不按线路运行时间报表 -->
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
<?php echo $bottomsc;?>
<script>
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
</script>
</html>