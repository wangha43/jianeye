$(document).ready(function(){
	$("body").addClass("page-body");
	$("body").addClass("skin-lime");
	})
function adjustIframeHeightOnLoad(text) {
         document.getElementById(text).style.height = document.getElementById(text).contentWindow.document.body.scrollHeight + "px";
     }