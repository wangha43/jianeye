/*
 * jQuery autoResize (textarea auto-resizer)
 * @copyright James Padolsey http://james.padolsey.com
 * @version 1.04
 */
 $(document).ready(function(){
	 var curWidth  = $(".col-sm-6").width();  
	 var curHeight = $(".row").height();
	 console.log(curHeight);
	 console.log(curWidth);
	              $(window).resize(function(){
	                  var nowwidth=$(this).width();  
	                   $("col-sm-6").each(function(){                
	                         zoomTimes=curWidth/curHeight;  
	                         $(this).height(nowwidth/zoomTimes);  
	               });
	                    	 var curWidth  = $(".col-sm-6").width();  
			 var curHeight = $(".row").height();
			 console.log(curHeight);
			 console.log(curWidth);
	}); 
});