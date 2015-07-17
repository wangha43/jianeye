<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>后台首页</title>
</head>
<body>
	<h3>统计信息</h3>
	<ul>
	</ul>
	<h3>系统信息</h3>
	<ul class="memlist fixwidth">
    	<li>主机名:<?php echo $_SERVER['SERVER_NAME'];?> ( port:<?php echo $_SERVER['SERVER_PORT'];?> )</li> 
		<li>操作系统:<?php echo PHP_OS;?></li>
		<li>服务器软件:<?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
		<li>数据库平台:<?php echo mysqli_get_server_info($conn);?></li>	
	</ul>
</body>
</html>