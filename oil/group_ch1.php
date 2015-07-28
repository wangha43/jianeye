<?php
require '../includelib/header.php';
require '../includelib/fun.php';

if (isset($_GET['date'])) {
	$date = $_GET['date'];
} else {
	$date = date('Ym', strtotime('0 month'));
}
$sql = "select * from company";
$data = get_all($sql, $conn);
$il = array();
foreach ($data as $item) {
	$sql = "select sum(oil_spend) from result_car_oil where month=$date and car_licence
    in(select car_name from car where belong in(select id from line where belong in(select id from team where belong in(select id from company_son where belong=" . $item['id'] . "))))";
	$il[] = get_one($sql, $conn)['sum(oil_spend)'];
}
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
 <div class="col-sm-6">
	<div>
	  <table class="table table-striped table-bordered dataTable" text-align="center" id="tabl">
        <tr>
             <th>子公司名</th>
             <th>行驶总里程</th>
             <th>本月行驶里程</th>
             <th>加油量</th>
             <th>油耗</th>
             <th>详情(点击后去向子公司油耗页面)</th>
        </tr>
       <?php foreach ($il as $key => $value) {?>
        <tr>
            <td><?php echo $data["$key"]['company'];?></td>
            <td class="danger">538</td>
            <td>35</td>
            <td><?php echo $value;?>L</td>
            <td><?php echo $value;?>L</td>
            <td><a href='oil_company.php?licence=<?php echo $data["$key"]['id'];?>'>详情</a></td>
        </tr>
         <?php }
?>

    </table>
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
