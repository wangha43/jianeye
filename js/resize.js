/*
 * 
 * 
 * 
 */
 function seth(){
 	var nowwidth=$("#container").width();  
    	var zoomTimes= $(".col-sm-6").attr('data-pv');      
    	$("#container").css("height",nowwidth/zoomTimes+"px");        
	// $("#container").each(function(){                
	// $(this).css("height",nowwidth/zoomTimes+"px");  
	// });
 }
 $(document).ready(function(){
	 var curWidth  = $(".col-sm-6").width();  
	 var curHeight = $(".col-sm-6").height();
	 var zoom=curWidth/curHeight;
	 $(".col-sm-6").attr('data-pv',zoom);
	              $(window).resize(function(){
	             	setTimeout(seth(),500);
	}); 
});