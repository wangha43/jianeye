$(document).ready(function(){
	$("body").addClass("<page-body></page-body>");
	})
function adjustIframeHeightOnLoad(text) {
         document.getElementById(text).style.height = document.getElementById(text).contentWindow.document.body.scrollHeight + "px";
     }