<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改图片</title>
<link rel="stylesheet" href="<?php echo base_url();?>admin_layout/style.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin_layout/includes/calendar/calendar.css" media="all" />
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>admin_layout/includes/ueditor/ueditor.config.js"></script>
 <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>admin_layout/includes/ueditor/lang/zh-cn/zh-cn.js"></script>
 <style type="text/css">
    #edui1{width:450px;}
    input{font: 12px "courier new";}
    input.button{width: 180px;
                    height: 25px;
                    padding-top: 2px\9;
                    font-size: 14px;
                    padding: 0;
                    background-color:#3FA61F;
                    background-position: 0 -240px;
                    border: 0;
                    cursor: pointer;
                    color:white;}
</style>
</head>
<body>
<div class="container">
    <h3 class="marginbot">修改图片<a href="<?php echo site_url('admin/image_turn_list')?>" class="sgbtn">返回图片列表</a></h3>
    <div class="mainbox">
        <form action="" name="my_form" method="post" enctype="multipart/form-data">
            <table class="opt" style="width:600px;">
                <tbody>
                    <tr>
                        <th>图片标题：</th>
                    </tr>
                    <tr>
                        <td>
                        <input name="title" class="txt" style="width:400px;" type="text" value="<?php echo $image[0]->title;?>">
                        </td>
                    </tr>
                    <tr>
                        <th>图片描述：</th>
                    </tr>
                    <tr>
                        <td>
                        <input name="describ" class="txt" style="width:400px;" type="text" value="<?php echo $image[0]->describ;?>">
                        </td>
                    </tr>
                    <tr>
                        <th>原图：</th>
                    </tr>
                    <tr>
                        <td>
                        <img style="width:300px;height:250px;" src="<?php echo base_url('uploadfile/images').'/'.$image[0]->url;?>" alt="" />
                        </td>
                    </tr>
                        <th>上传图片：<input id="f" type="file" name="f" onchange="change()" /></th>
                    <tr>
                        <tr>
                            <td>预览：<br /><img id="preview" alt="" name="pic" /></td>
                        </tr>
                        <th>修改时间:</th>
                    </tr>
                    <tr>
                        <td>
         <input type="text" readonly="readonly" name="time" id="addtime" value="<?php echo date("Y-m-d H:i",$image[0]->time);?>"/>
        <input class="button" type="button" id="selbtn" name="time" value="选择时间" onclick="showCalendar('addtime', '%Y-%m-%d %H:%M', '24', false, 'selbtn');" />
                        </td>
                    </tr>
                

                </tbody>
            </table>
           
            <div class="opt"><input name="submit" value=" 提 交 " class="btn" tabindex="3" type="submit"></div>
    </div> </form>
</div>
</body>
<script type="text/javascript" src="<?php echo base_url();?>admin_layout/includes/calendar/calendar.js"></script>
<script>
    var my_form= document.forms['my_form'];

    my_form.onsubmit=function(){

        //标题、英文标题、排序、 自己验证。
        //通过所见即所得的编辑器，获取内容是否为空。
        var content= ue.getContent();
        if (content=='') {
            alert('内容不能为空');
            return false;
        }
 }
 function change() {
     var pic = document.getElementById("preview");
     var file = document.getElementById("f");
     var ext=file.value.substring(file.value.lastIndexOf(".")+1).toLowerCase();
     // gif在IE浏览器暂时无法显示
     if(ext!='png'&&ext!='jpg'&&ext!='jpeg'){
         alert("必须上传图片！"); return;
     }
     // IE浏览器
     if (document.all) {
 
         file.select();
         var reallocalpath = document.selection.createRange().text;
         var ie6 = /msie 6/i.test(navigator.userAgent);
         // IE6浏览器设置img的src为本地路径可以直接显示图片
         if (ie6) pic.src = reallocalpath;
         else {
             // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
             pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";
             // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
             pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
         }
     }else{
         html5Reader(file);
     }
 }
 
 function html5Reader(file){
     var file = file.files[0];
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function(e){
         var pic = document.getElementById("preview");
         pic.src=this.result;
     }
 }

</script>
</html>