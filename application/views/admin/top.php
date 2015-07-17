<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link media="all" href="<?php echo base_url();?>admin_layout/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="mainhd">
后台管理系统

       <a href="<?php echo base_url();?>/admin/index" target="_blank">查看首页</a> 您好, <EM><?php echo $_SESSION['admin_user']?></EM> [ <a href="<?php echo site_url("admin/login");?>" target="_top">退出</a> ]

</div>
</body>
</html>
