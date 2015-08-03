<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
if (isset($_GET['date'])) {
	$date = $_GET['date'];
} else {
	$date = date('Ym', strtotime('0 month'));
}
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$limit = 5;
// echo '<pre>';
// print_r($data);
$result = get_all_driver($date, $page);
$count = $result["count"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
 <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="../css/page.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="../assets/css/xenon-core.css"/>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <style type="text/css">
	th,td{text-align: center}
  </style>
<body>
<div class="page-container">
    <div class="main-content">
<div class="row">
	  <table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
        <tr>
            <th>司机名</th>
             <th>行驶总里程</th>
             <th>本月行驶里程</th>
             <th>加油量</th>
             <th>油耗</th>
             <th>详情</th>
        </tr>
       <?php foreach ($result[0] as $items) {?>
        <tr>
            <td><?php echo $items['司机名'];?></td>
            <td class="danger"><?php echo $items['行驶总里程'];?></td>
            <td><?php echo $items['本月行驶里程'];?></td>
            <td><?php echo $items['加油量']?>L</td>
            <td><?php echo $items['油耗']?>L</td>
            <td><a href='oil_driver_detail.php?id=<?php echo $items['id'];?>'>详情</a></td>
        </tr>
         <?php }
?>

    </table>
    <?php echo page($page, $count, $limit, 6, $class = 'paginate_button');?>
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
