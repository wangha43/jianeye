<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
$result = road_safe();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
    <?php echo $linkheader;?>
     <script src='http://api.map.baidu.com/api?v=1.4'></script>
    <style type="text/css">#tabl tr,th{text-align: center!important;}</style>
<body>
    <div class="page-container">
        <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
         <div class="row">
              <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-tabs-justified">
                        <li>
                            <a href="all.php" >
                                <span class="visible-xs"> <i class="fa-home"></i>
                                </span>
                                <span class="hidden-xs">车辆运行时间</span>
                            </a>
                        </li>
                        <li >
                            <a href="car_runtime_sp.php">
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
                        <li >
                            <a href="time_safe.php">
                                <span class="visible-xs">
                                    <i class="fa-cog"></i>
                                </span>
                                <span class="hidden-xs">时段安全风险</span>
                            </a>
                        </li>
                        <li class="active">
                            <a  href="#settings-3"  data-toggle="tab">
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
                                <div></div>
                            </div>
                            <div class="col-sm-6">
                            <div class="chart-item-bg">
                                <div id="eMapContainer" style="height:494px"></div>
                            </div>
                            </div>
                                   <div class="row">
                             <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
                        <tr>
                            <th>路段名</th>
                            <th>时段名</th>
                            <th>各类消息</th>
                            <th>安全危险分数</th>
                            <th>查看整改效果</th>
                            <th>地图模式</th>
                        </tr>
                        <?php foreach ($result as $item) {?>
                            <tr>
                                <td><?php echo $item["路段名"];?></td>
                                <td><?php echo $item["时段名"];?></td>
                                <td><?php echo $item["各类消息"];?></td>
                                <td><?php echo $item["安全危险分数"];?></td>
                                <td>
                                    <a href="trend.php?road=<?php echo urlencode($item["路段名"]);?>&time=<?php echo urlencode($item["时段名"]);?>">查看整改效果</a>
                                </td>
                                <td>
                                    <a href="map.php?road=<?php echo urlencode($item["路段名"]);?>&time=<?php echo urlencode($item["时段名"]);?>">地图模式</a>
                                </td>
                            </tr>
                            <?php }
?>
                    </table>
    </div>
                    <div class="row">
                        <?php echo page($page, $count, $limit, 4);?>
                    </div>
                        </div>
                    </div>
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