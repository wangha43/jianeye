<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <title></title>
  <meta name="keywords" content="公司介绍" />
  <meta name="description" content="" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/cui.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/lib.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/page.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/metallic.css" />
  <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  // hm.src = "//hm.baidu.com/hm.js?b71dab72a36cb69e9bc52c6fcbf2854b";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
  <div id="hd">
    <div class="wp" style="position:relative;">
      <a href="<?php echo site_url();?>" class="logo">
        <img src="<?php echo base_url();?>layouts/images/zh_cn/logo.png" alt=""></a>
      <div class="hdr">
      <a href="feel/index.htm" class="se s1" onclick="alert('欢迎来公司现场体验?建设中。。。');return false;">现场体验</a>
        |
        <a href="apply/index.htm" class="se s2" onclick="alert('登记企业资料，客服人员稍后联系?建设中。。。');return false;">申请加入</a>
        <div class="ph_cs">020-XXXXXX</div>
      </div>
    </div>
  </div>
  <div id="nv">
    <div class="wp">
      <ul class="clearfix">
        <li >
          <a href="<?php echo site_url();?>">首页</a>
        </li>
        <?php foreach ($col as $item) {?>
        <li >
          <a  href="<?php echo site_url().'/jianeye/'.$item[0]->url;?>"><?php echo $item[0]->module;?></a>
          <div class="bar flv">
          <?php foreach ($item as $key => $value) {?>
            <a href="<?php echo site_url().'/jianeye/'.$value->url;?>"><?php echo $value->colum;?></a>
          <?php }?>
          </div>
        </li>
        <?php }?>   
    </ul>
</div>
<div class="libar"></div>
</div>