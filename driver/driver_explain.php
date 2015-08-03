<?php
require '../includelib/header.php';
require '../includelib/fun.php';
require '../header.php';
require "../db_api.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 1;
}
$date = isset($_GET['date']) ? $_GET['date'] : '';

$limit = 5;
if (isset($_GET['date'])) {
	$getdate = explode("至", $_GET['date']);
}
$date1 = isset($_GET['date']) ? $getdate[0] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$date2 = isset($_GET['date']) ? $getdate[1] : date("Y-m-d", time() - date("w", time()) * 24 * 3600);
$result = type_explain("司机", $date1, $date2, $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>司机安全风险趋势表</title>
</head>
	<?php echo $linkheader;?>
	<style type="text/css"></style>
<body>
	<!-- 时间选择
		参照itune 时间只选择月和周
		<br>
	对照文总图片
		加上
		点击详情显示地图
	 -->

	<div class="page-container">
		<?php echo $nav;?>
		<div class="main-content">
			 <?php echo $navr;?>
			<div class="row">
				<div class="col-sm-6">
					姓名：
					<?php echo $result['姓名'];?>
					<br>
					单位:
					<?php echo $result['单位'];?>
					<br>
					时间段：
					<?php echo $date;?>
					<br>
					危险分数：<?php echo $result['危险分数'];?>
					<br>
					排名： <?php echo $result['排名'];?>
					<br>
					危险级别：<?php echo $result['危险级别'];?>
					<br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<table class="table table-bordered table-striped table-condensed table-hover" text-align="center" id="tabl">
							<tr>
								<th>事件</th>
								<th>等级</th>
								<th>描述</th>
								<th>详情</th>
							</tr>
							<tr>
								<td>刹车</td>
								<td>
								<?php givestar($result["刹车等级"]);?>
									</td>
								<td>留意-保持车距，缓慢减速</td>
								<td>
									<a href="<?php $case = urlencode('刹车');
echo $_SERVER['PHP_SELF'] . '&case=' . $case;?>">详情</a>
								</td>
							</tr>
							<tr>
								<td>急刹车</td>
								<td>
										<?php givestar($result["急刹车等级"]);?></td>
								<td>很好-继续保持</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>加速</td>
								<td>
										<?php givestar($result["加速等级"]);?></td>
								<td>很好-继续保持</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>急加速</td>
								<td>
										<?php givestar($result["急加速等级"]);?></td>
								<td>注意-请勿急踩油门</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>急转弯</td>
								<td>
										<?php givestar($result["急转弯等级"]);?></td>
								<td>很好-请继续保持</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>急换道</td>
								<td>
										<?php givestar($result["急换道等级"]);?>
									</td>
								<td>很好-请继续保持</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>超速</td>
								<td>
										<?php givestar($result["超速等级"]);?></td>
								<td>危险-请控制车速避免事故</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>碰撞</td>
								<td>
										<?php givestar($result["碰撞等级"]);?></td>
								<td>很好-继续保持</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>Mobileye HW</td>
								<td>
									<?php givestar($result["Mobileye HW"]);?></td></td>
								<td>注意-保持车距</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>Mobileye FCW</td>
								<td>
										<?php givestar($result["Mobileye FCW"]);?></td>
								<td>注意-保持车距</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>Mobileye LDWR</td>
								<td>
									<?php givestar($result["Mobileye LDWR"]);?></td>
								<td>危险-左道偏离</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
							<tr>
								<td>Mobileye LDWL</td>
								<td>
									<?php givestar($result["Mobileye LDWL"]);?></td>
								<td>危险-右道偏离</td>
								<td>
									<a href="">详情</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

</body>
<?php echo $bottomsc;?>
	<script>
 function geturl(){
                                var arg = {};
                                var match = null;
                                var search = decodeURIComponent(location.search.substring(1));
                                var reg = /(?:([^&]+)=([^&]+))/g;
                                while((match = reg.exec(search))!==null){
                                    arg[match[1]] = match[2];
                                }
                                return arg;
                            };
 $('a').click(function(){
 	    	var getargs=geturl();
                        	var url='?';
                        for(var str in getargs){
                            url+=str+'='+getargs[str]+'&' ;
                        }
 	event.preventDefault();
 	var acase = $(this).parent().siblings("td:first").html();
 	window.location.href = 'map.php'+url+'&case='+encodeURIComponent(acase);
 });
 </script>
</html>