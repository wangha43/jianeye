<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>轮播图片管理</title>
<link rel="stylesheet" href="<?php echo base_url();?>/admin_layout/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo base_url();?>/admin_layout/includes/page/css.css" />
<link rel="stylesheet" href="<?php echo base_url();?>bootstrap-3.2.0-dist/css/bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url();?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/common.js"></script>
</head>
<body>
<div class="container">
    <h3 class="marginbot">轮播图片管理<a href="<?php echo site_url('admin/image_turn_add')?>" class="sgbtn">添加新图片</a></h3>
    <div class="mainbox">
        <form action="" method="post" name="my_form">
            <table class="datalist fixwidth table-hover">
                <tbody>
                    <tr>
                <th nowrap="nowrap">全选
    <input name="chkall" id="chkall" class="checkbox" type="checkbox" /></th>
                        <th nowrap="nowrap">图片序号</th>
                        <th nowrap="nowrap">图片</th>
                        <th nowrap="nowrap">添加时间</th>
                        <th nowrap="nowrap">详情</th>
                    </tr>
                    <?php  foreach($images as $item) {?>
                    <tr>
                        <td width="80">
                        <input name="del[]" value="<?php echo $item->id;?>" class="checkbox" type="checkbox">
                        </td>
                        <td width="150">
                        <?php echo $item->id;?>
                        </td>
                        <td><img style="width:20px;height:15px;" src="<?php echo base_url().'/uploadfile/images/'.$item->url; ?>" alt="" /><?php ?></td>
                        
                        <td width="150"><?php echo date("Y-m-d H:i",$item->time);?></td>
                        <td width="100"><a href="<?php echo site_url("admin/image_turn_edit");?>?id=<?php echo $item->id;?>">修改</a></td>
                    </tr>
                    <?php }?>
                    <tr class="nobg">
                        <td><input value="提 交" class="btn-default" type="submit" ></td>
                        <td class="tdpage" colspan="4">
                           
                            <?php echo $pagination;?>
                        </td>
                    </tr>                
                </tbody>
            </table>
        <div class="margintop"></div>
        </form>
    </div>
</div>
</body>
  <script>
     
        var my_form=document.forms['my_form'];
        var num=0;
        my_form.onsubmit=function(){
            var del=this.elements['del[]'];
            for(var i=0;i<del.length;i++){
                if(del[i].checked){
                    num++;
                }
            } 
            if(num==0){
            alert('您没有选择要删除图片');
            return false;
            }else{
            return window.confirm('您确定删除吗？');
            }
        };
       

    </script>
</html>