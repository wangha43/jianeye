<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>jianeye后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link media="all" href="<?php echo base_url().'/';?>admin_layout/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container">
		<form id="loginform" method="post" action="">
        <table class="mainbox" width="600">
            <tbody>
                <tr>
                    <td class="loginbox">
                    	<img src="<?php echo base_url().'/';?>layouts/images/zh_cn/logo.png" />
                    </td>
                    <td class="login">
                    <table class="login_tab">
                    	<tr>
                        	<td>用户名:</td>
                            <td><input type="text" id="username" tabindex="1" class="txt" name="username"/></td>
                        </tr>
                        <tr>
                        	<td>密　码:</td>
                            <td><input type="password" value="" id="password" tabindex="2" class="txt" name="password"/></td>
                        </tr>
                        <tr>
                        	<td>验证码:</td>
                        	<td><input type="text" value="" tabindex="3" class="txt" name="imgcode" style="width:70px;"/> </td>
                            
                        </tr>
                        <tr>
                        	
                    <td>
                	<input type="submit" tabindex="4" class="btn" value="登 录" name="submit"/>
                    </td><td><img id="imgcode" src="<?php echo site_url()."/admin/imgcode";?>" title="看不清楚，点击换一张"/></td>
                        </tr>
                    </table>
                   
                    </td>
                </tr>
            </tbody>
        </table>
        </form>
</div>
<div class="footer">© 2015 <a href="">jianeye</a></div>
</body>
<script type="text/javascript">
        var img=document.getElementById('imgcode');
    
        img.onclick=function(){
        this.src='<?php echo site_url();?>/admin/imgcode?id='+Math.random();
        }


</script>
</html>