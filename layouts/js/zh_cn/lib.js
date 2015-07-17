$(window).load(function() {

	$('.row1 .m1,.list2 li,.list3 li,.row4 .m2, .list1 li').hover(function(){
		$(this).toggleClass("hover");
	});

	$('.solo-a .list1 li').each(function(i){
		var _this = this;
		setTimeout(function(){
			$(_this).addClass("hover");
			setTimeout(function(){
				$(_this).removeClass("hover");
			}, 800)
		},500*i);
	});



if($.fn.flexslider){
		$('#ban .flexslider').flexslider({
		  animation: "fade",
		  controlNav: "thumbnails",
		  start: function(slider){
			var animateSlide = slider.slides.eq(slider.animatingTo);
			flyIn(animateSlide, 'h3', 100, 100, 'left');
			flyIn(animateSlide, 'h4', -100, 100, 'left');
			flyIn(animateSlide, 'p', 20, 100, 'left');
			flyIn(animateSlide, 'h6', 20, 100, 'top');
		  },
		  before: function(slider){
			var animateSlide = slider.slides.eq(slider.animatingTo-1);
				flyOut(animateSlide, 'h3', 100, 100, 'left');
				flyOut(animateSlide, 'h4', -100, 100, 'left');
				flyOut(animateSlide, 'p', 20, 100, 'left');
				flyOut(animateSlide, 'h6', 20, 100, 'top');
		  },
		  after: function(slider) {
		     if (!slider.playing) {
		       slider.play();
		     }
			 var animateSlide = slider.slides.eq(slider.animatingTo);
				 flyIn(animateSlide, 'h3', 100, 100, 'left');
				 flyIn(animateSlide, 'h4', -100, 100, 'left');
				 flyIn(animateSlide, 'p', 20, 100, 'left');
				 flyIn(animateSlide, 'h6', 20, 100, 'top');

		   }
		});
}
if($.fn.fancybox){
	$("#pop").fancybox({
            'fitToView':false,
            'autoSize':false,
            'width'             : '700px',
            'height'             : '400px',
            'type'              : 'iframe',
            'padding'           : 10,
            "iframe" : {
                   scrolling : 'auto'
               }
        });
}
	function flyIn(li, ele, extend, time, dir){
			var _this = $(li).find(ele);
				switch (dir){
					case 'left':
			 			_this.css({"left": extend});
				 			_this.stop().delay(time).animate({"left":0,"opacity":1}, 1000);
			 		break;
			 		case 'top':
 			 			_this.css({"top":  extend});
 				 			_this.stop().delay(time).animate({"top":0,"opacity":1}, 1000);
				}
	}
		function flyOut(li, ele, extend, time, dir){
				var _this = $(li).find(ele);
					switch (dir){
						case 'left':
					 			_this.stop().delay(time).animate({"left":'+='+extend,"opacity":0}, 1000);
				 		break;
				 		case 'top':
	 				 			_this.stop().delay(time).animate({"top":'+='+extend,"opacity":0}, 1000);
					}
		}

	if($.fn.adGallery){
		   $('#gallery').adGallery({
				width: 732,
				height: 416
			}); 
	}
	var $adNav = $('#gallery .ad-nav'); 
	$('.tog-gal').appendTo('.ad-nav');
	$('body').on('click','.tog-gal',function(){
			$adNav.animate({
				bottom: $adNav.css('bottom') == '0px' ? -72: 0
			})
	});


	function Tabs(tabs,container,active,event){

			$(container).slice(1).hide();

	        $(tabs).bind(event,function(){
	        	var oIndex = $(tabs).index(this);
	        	$(this).addClass(active).siblings(tabs).removeClass(active);
	        	$(container).eq(oIndex).show().siblings(container).hide();
	        	return false;
		    })

	};
	Tabs(".pz-tab-tit li",".pz-tab-con","hover","click");
	Tabs(".pz-tab2-tit li",".pz-tab2-con","hover","click");
	Tabs(".row1 .col-l .m1",".row1 .m1-con","open","mouseenter");

	if($.fn.slide){
		jQuery(".slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:false});
	}
	$('.s-nv li.open > a').addClass("has-sub");

	// 选项卡
	$('.my-check').each(function(){
	    if( $(this).hasClass('active') ){
	        $(this).next('input').attr('checked',true);
					$(this).find('.my-check').next('input').removeAttr('disabled');
	    };
	});
	$('.my-checkbox').click(function(){
	    $(this).find('.my-check').toggleClass('active');
	    if( $(this).find('.my-check').hasClass('active') ){
	        $(this).find('.my-check').next('input').attr('checked',true);
	        $(this).find('.my-check').next('input').removeAttr('disabled');
			
	    }else{
	        $(this).find('.my-check').next('input').removeAttr('checked');
					$(this).find('.my-check').next('input').attr('disabled',true);
	    };
	});


	$(':radio').each(function(){
	    var rname = $(this).attr('name');
	    $(this).prev('.my-radio').addClass(rname);
	});
	$('.my-radiobox').click(function(){
	    var laname = $(this).find('input').attr('name');
	    $('.my-radiobox em').removeClass('active');
	    $('.my-radiobox input').removeAttr('checked');
	    $(this).find('.my-radio').addClass('active');
	    $(this).find('.my-radio').next('input').attr('checked',true);
	});
	
	$('.s-nv li .smv1').click(function(){
		$(".s-nv dl").hide();
		$(this).parent('li').toggleClass('open');
		$(this).next('dl').stop().slideToggle();
	});
	$("dl",".s-nv li:not(.open) ").hide();
	
	
	
	
});




