<?php
require '../header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>可能事故</title>
</head>
<?php echo $linkheader;?>
<style type="text/css">
    #tabl tr,th,td{text-align: center!important;}
</style>
<body>
    <div class="page-container">
            <?php echo $nav;?>
        <div class="main-content">
             <?php echo $navr;?>
            <div class="row">
                <div class="col-sm-6" >
<div>
<table class="table table-bordered table-hover">
    <tr>
        <th>司机</th>
        <th>车牌号</th>
        <th>时间</th>
        <th>地点</th>
        <th>视频</th>
        <th>速度降幅</th>
    </tr>
    <tr>
        <td>司机1</td>
        <td>车牌号1</td>
        <td>时间1</td>
        <td>地点1</td>
        <td>视频1</td>
        <td>速度降幅1</td>
    </tr>
</table>
    </div>
    </div>
    </div>
    </div>
</div>
<!-- 表格：<br>
司机 车牌号 时间 地点 视频 速度降幅 -->
<br>

</body>
<?php echo $bottomsc;?>
</html>