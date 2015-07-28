<?php
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$date = isset($_GET["time"]) ? $_GET["time"] : date("Ymd", time());
$result = device_warn($date);
$limit = 5;
$count = $result["count"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>事故</title>
</head>
 <?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>
  <?php echo $nav;?>
    <div class="page-container">
        <div class="main-content">
        <div class="row">
                <form action="" method ="get" class="form">
                    <div class="col-sm-4">
                       <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value=""  name="time" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    </form>
            </div>
            <div class="row">
                <div class="col-sm-6" >
<div id="container">
    <table class="table table-bordered table-hover">

            <tr>
               <th>车辆</th>
               <th>故障代码</th>
               <th>发生时间</th>
               <th>发生地点</th>
               <th>处理人</th>
               <th>处理结果</th>
               <th>处理时间</th>
            </tr>
            <?php foreach ($result[0] as $item ) {?>
            <tr>
                <td><?php echo $item["车牌号"];?></td>
                <td><?php echo $item["故障代码"];?></td>
                <td><?php echo $item["发生地点"];?></td>
                <td><?php echo $item["发生时间"];?></td>
                <td><?php echo $item["处理人"];?></td>
                <td><?php echo $item["处理结果"];?></td>
                <td><?php echo $item["处理时间"];?></td>
            </tr>
            <?}?>
    </table>
        <?php echo page($page, $count, $limit, 4);?>
</div>
  </div>
  </div>
  </div>
  </div>
<!-- 表格：<br /> -->


<br>

</body>
<?php echo $bottomsc;?>
</html>
<script>
var d= new Date();
var str = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
$('.form_date').datetimepicker({
        language:  'zh-CN',
        format:"yyyy-mm-dd",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        endDate:str,
    });
</script>
<script>
                    $(".form-control").change(function(){
                            $(".form").submit();
                    });
</script>