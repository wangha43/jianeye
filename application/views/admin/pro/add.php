<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新文章</title>
<link rel="stylesheet" href="<?php echo base_url();?>admin_layout/style.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin_layout/includes/calendar/calendar.css" media="all" />
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>admin_layout/includes/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>admin_layout/includes/ueditor/ueditor.all.min.js"> </script>
 <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>admin_layout/includes/ueditor/lang/zh-cn/zh-cn.js"></script>
 <style type="text/css">
    input{font: 12px "courier new";}
    input.button{width: 80px;
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
    <h3 class="marginbot">添加新文章<a href="<?php echo site_url('admin/pro_list')?>" class="sgbtn">返回文章列表</a></h3>
    <div class="mainbox">
        <form action="" name="my_form" method="post">
            <table class="opt" style="width:600px;">
                <tbody>
                 <tr>
                        <th>模块选择：</th>
                    </tr>
                    <tr>
                        <td>
                        <select name="cid" id="">
                        <?php foreach ($col as $item) {?>
                                <option value="<?php echo $item->id;?>"><?php echo $item->colum;?></option>
                            <?php }
?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章名称：</th>
                    </tr>
                    <tr>
                        <td>
                        <input name="title" class="txt" style="width:400px;" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                    </tr>
                    <tr>
                        <td><script name="content" id="editor" type="text/plain"></script></td>
                    </tr>
                    <tr>
                        <th>新闻时间:</th>
                    </tr>
                    <tr>
                        <td>
        <input type="text" readonly="readonly" name="time" id="addtime" />
<input class="button" type="button" id="selbtn" name="time" value="选择时间" onclick="showCalendar('addtime', '%Y-%m-%d %H:%M', '24', false, 'selbtn');" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="opt"><input name="submit" value=" 提 交 " class="btn" tabindex="3" type="submit"></div>
    </div> </form>
</div>
</body>
<script name="content">
   var a= {
        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo','fontsize'],
            ['fontfamily','bold','simpleupload']
        ],
        autoHeightEnabled: true,
        autoFloatEnabled: true,
        minFrameHeight:400,
        };




      var ue = UE.getEditor('editor',a);

        ue.ready(function() {
            //设置编辑器的内容
            ue.setContent('');
        });


</script>
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
</script>
</html>