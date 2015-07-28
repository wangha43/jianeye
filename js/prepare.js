document.onreadystatechange = subSomething;//当页面加载状态改变的时候执行这个方法. 
function subSomething() 
{ 
if(document.readyState == "Uninitialized") {//当页面接收状态 
	show_loading_bar(30);	
}
if(document.readyState == "Loading") {//当页面接收状态 
	show_loading_bar(70);	
}
if(document.readyState == "complete") {//当页面加载状态 
	show_loading_bar(100);	
}
}
function adjustIframeHeightOnLoad(text) {
         document.getElementById(text).style.height = document.getElementById(text).contentWindow.document.body.scrollHeight + "px";
     }