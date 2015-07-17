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