<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "select driver_name from driver where belong=$id";
	$name = get_all($sql, $conn);
	$sql = "select car_name from car where  id=$id";
	$car = get_one($sql, $conn)['car_name'];
	$date = $_GET['date'];
} else {
	$name['driver_name'] = '';
	$date = '';
	$car = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车辆安全风险地图</title>
<script src='http://api.map.baidu.com/api?v=1.4'></script>
</head>
    <?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th{text-align: center!important;}
</style>
<body>
<!-- 	地图区域
		可以选择区域
		参照文总图片
		时间段按照上一级
	列出报警消息列表（包含车牌号） -->
    <div class="page-container">
    	 <?php echo $nav;?>
        <div class="main-content">
        	 <?php echo $navr;?>
            <div class="row">
                <div class="col-sm-6" >
		<table class="table table-bordered table-hover" text-align="center" id="tabl">
			<tr>
				<th>时间</th>
				<th>时速</th>
				<th>司机</th>
				<th>车牌号</th>
			</tr>
			<?php
if (isset($_GET['id']) && is_array($name)) {
	foreach ($name as $key => $value) {
		?>
			<tr>
				<td><?php echo $date;?></td>
				<td>时速1</td>
				<td><?php echo $value['driver_name'];?></td>
				<td><?php echo $car;?></td>
			</tr>
			<?php }}
?>
		</table>
	</div>
	<div class="col-sm-6">
	<div id='eMapContainer' style='height:600px;' ></div>
	</div>
	</div>
	</div>
	</div>
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
}catch(ex){  }
</script>
 </body>
 <?php echo $bottomsc;?>
</html>