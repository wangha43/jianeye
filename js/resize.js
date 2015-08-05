/*
 * jQuery autoResize (textarea auto-resizer)
 * @copyright James Padolsey http://james.padolsey.com
 * @version 1.04
 */
 var curWidth  = $("col-sm-6").width();  
 var curHeight = $("col-sm-6").height();
              $(window).resize(function(){
                  var nowwidth=$(this).width();  
                   $("col-sm-6").each(function(){                
                         zoomTimes=curWidth/curHeight;  
                         $(this).height(nowwidth/zoomTimes);  
                });
            });     
