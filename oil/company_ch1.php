<?php
    require('../includelib/header.php');
    require('../includelib/fun.php');
    $page=isset($_GET['page'])?$_GET['page']:1;
    if(isset($_GET['date'])){
        $date=$_GET['date'];
    }else{
        $date=date('Ym',strtotime('0 month'));
    }
    $limit=5;
    $offset=($page-1)*$limit;
	$sql="select * from company_son order by id limit $offset,$limit";
    $data=get_all($sql,$conn);
    $il=array();
    foreach ($data as $item){
    $sql = "select sum(oil_spend) from result_car_oil where month=$date and car_licence
    in(select car_name from car where belong in(select id from line where belong in(select id from team where belong=".$item['id'].")))";
        $il[]=get_one($sql,$conn)['sum(oil_spend)'];
    }
    $sql="select count(id) from company_son";
    $count=get_one($sql,$conn)['count(id)'];


    function da_driver_($date1,$date2,$driver){

      return [['司机姓名','排名','得分'],['张三','1','100'],['张三','2','200']];
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
<div class="row">
	<div class="col-sm-6">
	  <table class="table table-striped table-bordered dataTable" text-align="center" id="tabl">
        <tr>
            <th>公司名</th>
             <th>行驶总里程</th>
             <th>本月行驶里程</th>
             <th>加油量</th>
             <th>油耗</th>
             <th>详情</th>
        </tr>
       <?php foreach($data as $key=>$items){?>
        <tr>
            <td><a href="oil_son_company.php?id=<?php echo $items['id'];?>"><?php echo $items['company_son'];?></a></td>
            <td class="danger">538</td>
            <td>35</td>
            <td><?php echo $il[$key];?>L</td>
            <td><?php echo $il[$key];?>L</td>
            <td>详情</td>    
        </tr>
         <?php }?>
      
    </table> 
    <?php echo page($page,$count,$limit,6,$class='paginate_button');?>
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
