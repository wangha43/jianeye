<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 0;
}
$date = isset($_GET["date"]) ? $_GET["date"] : null;
if (isset($_GET['date'])) {
	$getdate = explode("至", $_GET['date']);
}
$limit = 5;
$date1 = isset($_GET['date']) ? $getdate[0] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$date2 = isset($_GET['date']) ? $getdate[0] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$result = car_rank($date1, $date2, $page);
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <?php echo $linkheader;?>
</head>
  <style type="text/css">
	th,td{text-align: center}
  </style>
<body>
<div>
  <div class="page-container">
             <div class="main-content">
             <div class="row">
	  <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
        <tr>
            <th>车牌号（点击进入车辆查看详细）</th>
            <th>里程</th>
            <th>FCW</th>
            <th>PCW</th>
            <th>急加速</th>
            <th>急减速</th>
            <th>危险总分</th>
            <th>排名</th>

        </tr>
       <?php foreach ($result["data"] as $items) {?>
        <tr>
            <td><a href='../car/car_detail.php?id=<?php echo $items['车牌号'];?>' target="_parent"><?php echo $items['车牌号'];?></a></td>
            <td class="danger"><?php echo $items['里程'];?></td>
            <td><?php echo $items['FCW'];?></td>
            <td><?php echo $items['PCW'];?></td>
            <td><?php echo $items['急加速'];?></td>
            <td><?php echo $items['急减速'];?></td>
            <td class="yellow"><?php echo $items['危险总分'];?></td>
            <td><?php echo $items['排名'];?></td>
        </tr>
         <?php }
?>
        <tfoot>
      <!-- 表格加一个按钮 '趋势' -->
        </tfoot>
    </table>
    <?php echo page($page, $count, $limit, 6, $class = 'paginate_button');?>
   </div>
 </div>
</div>
   </div>
<script>
    $('table a').click(function(){
        event.preventDefault();
        parent.location.href=$(this).attr('href');
    });
</script>
</body>
</html>
