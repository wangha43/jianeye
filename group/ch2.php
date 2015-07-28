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
$limit = 5;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 1;
}
if (isset($_GET['date'])) {
	$getdate = explode("至", $_GET['date']);
}
$date1 = isset($_GET['date']) ? $getdate[0] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$date2 = isset($_GET['date']) ? $getdate[0] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$result = car_order("集团", $date1, $date2, $page, $id);

$count = isset($result["count"]) ? $result["count"] : 10;
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
<div class="page-container">
             <div class="main-content">
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
       <?php foreach ($result[0] as $items) {?>
        <tr>
            <td><a href='../car/car_detail.php?id=<?php echo $items['车牌号'];?>'><?php echo $items['车牌号'];?></a></td>
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
        <tr>
               <td>总分（所有的车辆分数总和）</td>
            <td class="danger"><?php echo $result["总分"]["里程"];?></td>
            <td><?php echo $result["总分"]["FCW"];?></td>
            <td><?php echo $result["总分"]["PCW"];?></td>
            <td><?php echo $result["总分"]["急加速"];?></td>
            <td><?php echo $result["总分"]["急减速"];?></td>
            <td><?php echo $result["总分"]["危险总分"];?></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
    <?php echo page($page, $count, $limit, 6, $class = 'paginate_button');?>
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
