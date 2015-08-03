$(document).ready(function(){
	
	})
function adjustIframeHeightOnLoad(text) {
         document.getElementById(text).style.height = document.getElementById(text).contentWindow.document.body.scrollHeight + "px";
     }