<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <title>广州戩智眼</title>
  <meta name="keywords" content="广州戩智眼" />
  <meta name="description" content="广州戩智眼" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <!--  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  -->
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/cui.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/lib.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/style.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>layouts/css/zh_cn/flexslider.css" />
  <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
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
        <li class="current">
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
       
</div>

</li>
</ul>
</div>
<div class="libar"></div>
<div id="ban">
<div id="slide">
<?php foreach ($images as $key=>$item) {?>
<li  href="javascript:;" class="<?php if($key==0) echo "crf";?>">
<img src="<?php echo base_url('uploadfile/images').'/'.$item->url;?>" alt="">
<div class="datxt ">
<h3><?php echo $item->title;?></h3>
<h4><?php echo $item->describ;?></h4>
<p>
</p>
<h6>
<!-- <a href="" class="more-a"></a> -->
</h6>
</div>
</li>
<?php }?>
</div>
<div class='banselt'>
<?php foreach ($images as $item) {?>
<span>
<img src="<?php echo base_url('uploadfile/images/thumb').'/'.$item->url;?>" alt="" />
</span>
<?php }?>
</div>
<div class="flex flex-next"></div>
<div class="flex flex-prev"></div>
</div>
<div class="solo-a">
<div class="wp">
<ul class="list1">
<li>
<div class="front">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>"> <b class="s1"></b>
<span>前碰撞预警</span> <em>当可能与前方车辆发生碰撞时, FCW将在发生碰撞前最多2.7秒发出警报</em>
</a>
</div>
<div class="back">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>"> <b class="s1"></b>
<span>前碰撞预警</span> <em>当可能与前方车辆发生碰撞时, FCW将在发生碰撞前最多2.7秒发出警报</em>
</a>
</div>
</li>
<li>
<div class="front">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s2"></b>
<span>行人探测防撞警示</span>
<em>当可能与前方行人发生碰时,声音警报一连串高音量蜂鸣。</em>
</a>
</div>
<div class="back">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s2"></b>
<span>行人探测防撞警示</span>
<em>当可能与前方行人发生碰时,声音警报一连串高音量蜂鸣。</em>
</a>
</div>
</li>
<li>
<div class="front">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s3"></b>
<span>车道偏离预警</span>
<em>当您无意中偏离车道时,会发出警报。如果您在换道时使用方向灯,则不发出警报。</em>
</a>
</div>
<div class="back">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s3"></b>
<span>车道偏离预警</span>
<em>当您无意中偏离车道时,会发出警报。如果您在换道时使用方向灯,则不发出警报。</em>
</a>
</div>
</li>
<li>
<div class="front">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s4"></b>
<span>车道危险预警</span>
<em>显示您与前方车辆的车距。如果您正在接近设定车距,将向您发出危险警报。</em>
</a>
</div>
<div class="back">
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<b class="s4"></b>
<span>车道危险预警</span>
<em>显示您与前方车辆的车距。如果您正在接近设定车距,将向您发出危险警报。</em>
</a>
</div>
</li>
</ul>
</div>
</div>
<div class="row1">
<div class="wp">
<h3 class="t1">
解决方案
<span>Solutions</span>
</h3>
<div class="col-l">
<dl class="m1 open">
<dt>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2014/0606/20140606113837457.jpg" alt=""></a>
</dt>
<dd>
<h3>被动安全</h3>
<p>安全带、安全气囊系统是一种被动安全性（见汽车安全性能）的保护系统，它与座椅安全带配合使用，可以为乘员提供有效的防撞保护。</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">Learn more</a>
</h6>
<span class="ar"></span>
</dd>
</dl>
<dl class="m1 ">
<dt>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2014/1202/20141202054045278.png" alt=""></a>
</dt>
<dd>
<h3>主动安全</h3>
<p>GPS车速实时监控、疲劳驾驶（司机驾驶时间控制）、车道偏离预警、车距监测预警、车辆前碰撞预警、行人避撞预警、急转弯预警等</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">Learn more</a>
</h6>
<span class="ar"></span>
</dd>
</dl>
<dl class="m1 ">
<dt>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2014/0613/20140613095134983.jpg" alt=""></a>
</dt>
<dd>
<h3>预测安全</h3>
<p>根据大数据，判断司机、路段、时段的危险级别。从而在危险发生前，将隐患消除，或者降低。</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">Learn more</a>
</h6>
<span class="ar"></span>
</dd>
</dl>
</div>
<div class="col-r">
<div class="m1-con">
<img src="<?php echo base_url();?>uploadfile/2014/0612/20140612044058331.jpg" width="528" height="263" alt="" />
<img src="<?php echo base_url();?>uploadfile/2014/1202/thumb_528_263_20141202050604793.png" width="528" height="263" alt="" />
</div>
<div class="m1-con">
<img src="<?php echo base_url();?>uploadfile/2014/1202/20141202055211610.png" width="528" height="263" alt="" />
<img src="uploadfile/2014/1202/20141202055227127.png" width="528" height="263" alt="" />
</div>
<div class="m1-con">
<img src="<?php echo base_url();?>uploadfile/2014/0612/20140612040950350.jpg" width="528" height="263" alt="" />
<img src="<?php echo base_url();?>uploadfile/2014/0612/20140612041003782.jpg" width="528" height="263" alt="" />
</div>
</div>
</div>
</div>
<div class="h"></div>
<div class="row2">
<h3 class="t1">
戬智眼
<em>服务</em>
<span>Service</span>
</h3>
<div class="wp">
<!--       <p class="solo-p">
In order to "improve the quality of service and comfortable home," and the company was founded, the company's services is an important criterion, but also the company's strengths.
</p>
-->
<div class="h"></div>
<ul class="list2">
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="s1"></a>
<p>
了解用户需求，为用户提供最专业、全面的安全驾驶知识导入专业方案：根据情况设计规范要求，对司机、路段的具体特点，精确采集数据，为...
</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-b">Learn more</a>
</h6>
</li>
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="s2"></a>
<p>
安全管理的“PDCA循环”；持续改进。公司安全管理风险、车辆安全风险、司机安全风险等。油耗管理、车辆利用率管理,为公司管理带来...
</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-b">Learn more</a>
</h6>
</li>
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="s3"></a>
<p>
主动安全、预测安全根据大数据，判断司机、路段、时段的危险级别。从而在危险发生前，将隐患消除，或者降低。事故重建、分析、管理...
</p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-b">Learn more</a>
</h6>
</li>
</ul>
</div>
<div class="h20"></div>
</div>
<div class="row3">
<h3 class="t1">
工程案例
<span>Projects</span>
</h3>
<!-- <p class="solo-p">
Case is typical of the rich variety of meaningful events in which people live production experienced a statement. It is a story in which people experience the intentional interception.
</p>
-->
<p class="arrow">
<a style="cursor:default;" href="javascript:;"></a>
</p>
<div class="wp">
<ul class="list3">
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2015/0209/20150209043356640.jpg" alt=""></a>
<div class="con">
<h3>广州二汽</h3>
<!-- <h4>Heating system</h4>
-->
<p></p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">查看详细</a>
</h6>
</div>
</li>
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2015/0306/20150306111618662.jpg" alt=""></a>
<div class="con">
<h3>交通集团</h3>
<!-- <h4>Heating system</h4>
-->
<p></p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">查看详细</a>
</h6>
</div>
</li>
<li>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2015/0402/20150402104715706.jpg" alt=""></a>
<div class="con">
<h3>物流运输</h3>
<!-- <h4>Heating system</h4>
-->
<p></p>
<h6>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>" class="more-a">查看详细</a>
</h6>
</div>
</li>
</ul>
</div>
</div>
<div class="row4">
<div class="wp">
<div class="col-l">
<h3 class="t2">
资讯中心/
<em>Information Center</em>
</h3>
<dl class="m2">
<dt>
<b>07</b>
Jan
</dt>
<dd>
<h3>
<em>2015-01-07</em>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">谷歌诺基亚等涉足无人驾驶</a>
</h3>
<p>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">详情&raquo;</a>
为完全的无人驾驶汽车对道路进行扫描...
</p>
</dd>
</dl>
<dl class="m2">
<dt>
<b>03</b>
Mar
</dt>
<dd>
<h3>
<em>2015-03-03</em>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">谷歌诺基亚等涉足无人驾驶</a>
</h3>
<p>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">详情&raquo;</a>
为完全的无人驾驶汽车对道路进行扫描...
</p>
</dd>
</dl>
<dl class="m2">
<dt>
<b>04</b>
Mar
</dt>
<dd>
<h3>
<em>2015-03-04</em>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">谷歌诺基亚等涉足无人驾驶</a>
</h3>
<p>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">详情&raquo;</a>
为完全的无人驾驶汽车对道路进行扫描...
</p>
</dd>
</dl>
<dl class="m2">
<dt>
<b>08</b>
May
</dt>
<dd>
<h3>
<em>2015-05-08</em>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">谷歌诺基亚等涉足无人驾驶</a>
</h3>
<p>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">详情&raquo;</a>
为完全的无人驾驶汽车对道路进行扫描...
</p>
</dd>
</dl>
</div>
<div class="col-r">
<h3 class="t2">
戬智眼课堂/
<em>classroom</em>
</h3>
<dl class="m3">
<dt>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2015/0104/20150104042458210.jpg" alt=""></a>
</dt>
<dd>
<h3>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">我们不做中国的Mobileye,我要做它的数据挖掘机</a>
</h3>
<p>
在Mobileye业务的空白点上,有一家中国公司打算借道Mobileye强大的硬件能力,做数据挖掘,用自己的方法做补充者...
<a href="learn/buy/warm/23.php">详情&raquo;</a>
</p>
</dd>
</dl>
<dl class="m3">
<dt>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">
<img src="<?php echo base_url();?>uploadfile/2015/0306/20150306100410665.jpg" alt=""></a>
</dt>
<dd>
<h3>
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">三年无收益咬牙坚持 砸钱拼研发</a>
</h3>
<p>
Mobileye的成功来之不易,Mobileye首席执行官Ziv Aviram在耶路撒冷接受21世纪经济报道专访,讲述了该公司“十年磨一剑”坚持研发创新的成功秘诀...
<a href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">详情&raquo;</a>
</p>
</dd>
</dl>
</div>
</div>
</div>
<div class="h"></div>
<div id="fd">
<div class="wp">
<div class="fd-nv">
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">关于我们</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">产品中心</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">解决方案</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">工程案例</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">资讯中心</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">优惠套餐</a>
<a  href="<?php echo site_url().'/jianeye/'."aboutus_introduct";?>">戬智眼</a>
</div>
<dl class="fd-con">
<dt> <strong>联系我们</strong>
<em>contact</em>
</dt>
<dd>
<p class="s2">广州市戬智眼安防科技有限公司</p>
<p class="s3">电话：020-XXXXXX &nbsp;&nbsp;&nbsp;&nbsp; 020-39299611</p>
<p class="s4">电子邮件：lin@jianeye.net</p>
<p class="s5">
公司地址：广东省广州市番禺区
<br />
XXX大厦3楼
</p>
<p class="s6">
备案编号：XXXX&nbsp;&nbsp;
</p>
<div class="erweima">
<img src="<?php echo base_url();?>layouts/images/zh_cn/weixinerweima.jpg" alt="" />
<br />
请关注官方微信!
</div>
</dd>
</dl>
<a href="<?php echo site_url();?>">
<img src="<?php echo base_url();?>layouts/images/zh_cn/map.png" alt="" class="fd-map"></a>
<dl class="fd-link c">
<dt>友情链接</dt>
<dd>
<a href="http://www.baidu.com" target="_blank">百度</a>
<a href="http://www.sina.com.cn" target="_blank">新浪</a>
<a href="http://qq.com" target="_blank">腾讯</a>
<a href="http://1688.com" target="_blank">阿里巴巴</a>
</dd>
<div class="fvr webdisgn">
<a href="http://www.mobileye.com/" target="_blank" title="">合作伙伴</a>
：
<a href="http://www.mobileye.com/" target="_blank" title="">mobileye</a>
</div>
</dl>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>layouts/js/zh_cn/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>layouts/js/zh_cn/jquery.ad-gallery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>layouts/js/zh_cn/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>layouts/js/zh_cn/lib.js"></script>
<script type="text/javascript">
    $("#nv li").hover(function(){
        var index=$(this).index();
        $("#nv li.current").addClass("curr");
        if(index==0) return;
        $(".bar",this).show();
        $("#nv .libar").show();
        $(">a",this).addClass("hover");
    },function(){
        $("#nv li.current").removeClass("curr");  
        $(".bar",this).hide();
        $("#nv .libar").hide();
        $(">a",this).removeClass("hover");
    })
    
    $("#nv li:eq(0)").hover(function(){
        $("#nv li.current").addClass("curr");
    },function(){
        $("#nv li.current").removeClass("curr");  
    })

  
  </script>

</body>
</html>
<script type="text/javascript" src="<?php echo base_url();?>layouts/js/zh_cn/jquery.flexslider-min.js"></script>
<script type="text/javascript">
 /*2014-6-20*/
 jQuery.extend(jQuery.easing, {
  def: 'easeInOutQuint',
  easeInOutQuint: function(x, t, b, c, d) {
    if ((t /= d / 2) < 1) return c / 2 * t * t * t * t * t + b;
    return c / 2 * ((t -= 2) * t * t * t * t + 2) + b;
  }
}); 
  $.easing.def="easeInOutQuint";
  //  autoSlide("#slide");
  //banner
  $(".banselt span").eq(0).addClass("current");
  var curIndex=0;
  var time=1200;
  var slideTime=5000;
  var sindex=0;
  var lisize=$("#slide li").size();
  var banli=$("#slide li");
  var int=setInterval("autoSlide()",slideTime);
//  window.clearInterval(int);

  function autoSlide(){
    curIndex+1>=lisize?curIndex=-1:false;
    show(curIndex+1);
    if(sindex > banli.size()){
      sindex=0;
    }else{
      sindex++;
    }

  }
  function show(index){
    $.easing.def="easeOutQuad";
    banli.eq(curIndex).stop(false,true).delay(600).fadeOut(time);
    banli.eq(curIndex).find("h3").stop(false,true).animate({opacity:0,left:"200px"},time);
    banli.eq(curIndex).find("h4").stop(false,true).animate({opacity:0,left:"-100px"},time);
    banli.eq(curIndex).find("p").delay(100).stop(false,true).animate({opacity:0,left:"100px"},time);;
    banli.eq(curIndex).find("h6").delay(500).stop(false,true).animate({opacity:0,top:"50px"},time);
    banli.removeClass("cur");
    $(".banselt span").removeClass("current");
    $(".banselt span").eq(index).addClass("current");
    banli.eq(index).find("h3").css("left","-150px").stop(false,true).delay(1200).animate({opacity:1,left:0},time);
    banli.eq(index).find("h4").css("left","250px").stop(false,true).delay(1200).animate({opacity:1,left:0},time);
    banli.eq(index).find("p").delay(100).css("left","-150px").stop(false,true).delay(1200).animate({opacity:1,left:0},time);
    banli.eq(index).find("h6").delay(200).css("top","70px").stop(false,true).delay(1600).animate({opacity:1,top:0},time);
    banli.eq(index).stop(false,true).delay(600).fadeIn(time).addClass("cur");
    sindex=index;
    curIndex=index;
  }
  $(".flex-prev").click(function(){       //上一张
    if(banli.is(":animated")){
    return false;
    }
    window.clearInterval(int);
    if(sindex<=0){
      sindex=lisize-1;
      show(sindex);
    }else{
      sindex--;
      show(sindex);
    }
    int=setInterval("autoSlide()",slideTime);

  })
  $(".flex-next").click(function(){     //上一张
    if(banli.is(":animated")){
    return false;}
    window.clearInterval(int);
    if(sindex>=lisize-1){
      sindex=0;
      show(sindex);
    }else{
      sindex++;
      show(sindex);
    }
    int=setInterval("autoSlide()",slideTime);

  })
  
  $(".banselt span").click(function(){
    if(banli.is(":animated")){
    return false;
    }
    if($(this).attr("class")=="current"){
      return false;
    }
    show($(this).index())
    window.clearInterval(int);
    int=setInterval("autoSlide()",slideTime);
  })
  
//banner end

  </script>