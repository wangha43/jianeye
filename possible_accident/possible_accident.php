<?php
require '../includelib/fun.php';
require '../header.php';
require '../db_api.php';
$time = isset($_GET["time"]) ? $_GET["time"] : date("Y-m-d", time());
$result = accident($time);
$limit = 10;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$count = $result["count"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>可能事故</title>
</head><?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>

<!-- 表格：<br>
司机 车牌号 时间 地点 视频 速度降幅（发生前1秒速度减去发生时的速度，越短越好） 从高速降为0的时间  给送到安全员的信息传输
 -->
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
         <?php echo $navr;?>
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
<div class="">
<table class="table table-bordered table-hover">
    <tr>
        <th>司机</th>
        <th>车牌号</th>
        <th>时间</th>
        <th>地点</th>
        <th>视频</th>
        <th>速度降幅</th>
    </tr>
<?php foreach ($result[0] as $item) {?>
    <tr>
        <td><?php echo $item["司机名"];?></td>
        <td><?php echo $item["车牌号"];?></td>
        <td><?php echo $item["时间"];?></td>
        <td><?php echo $item["地点"];?></td>
        <td><?php echo $item["视频url"];?></td>
        <td><?php echo $item["速度降幅"];?></td>
    </tr>
    <?php }
?>
</table>
     <?php echo page($page, $count, $limit, 4);?>
    </div>
    </div>
    </div>
    </div>
</div>
</body>
<?php echo $bottomsc;?>
</html>
<script>
var d= new Date();
var str = d.getFullYear()+"-"+(d.getMonth()+2)+"-"+d.getDate();
$('.form_date').datetimepicker({
        language:  'zh-CN',
        format:"yyyy-mm-dd",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView:2,
        minView:2,
        forceParse: 0,
        endDate: d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate(),
    });
</script>
<script>
                    $(".form-control").change(function(){
                            $(".form").submit();
                    });
</script>