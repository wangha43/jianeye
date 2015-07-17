// JScript 文件

 
calendar = new Date();
year = calendar.getYear();
month = calendar.getMonth();
day = calendar.getDay();
date = calendar.getDate();
year = 1900 + year;
cent = parseInt(year/100);
g = year % 19;
k = parseInt((cent - 17)/25);
i = (cent - parseInt(cent/4) - parseInt((cent - k)/3) + 19*g + 15) % 30;
i = i - parseInt(i/28)*(1 - parseInt(i/28)*parseInt(29/(i+1))*parseInt((21-g)/11));
j = (year + parseInt(year/4) + i + 2 - cent + parseInt(cent/4)) % 7;
l = i - j;
emonth = 3 + parseInt((l + 40)/44); 
edate = l + 28 - 31*parseInt((emonth/4));
emonth--;
var dayname = 
new Array ("1", "2", "3", "4", "5", "6", "7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
var monthname =
new Array ("1","2","3","4","5","6","7","8","9","10","11","12" );

/*-----------------[start]--------------*/

document.write('<div id="Calendar">');

document.write('<div id="day-title">');
document.write(year + '年-');
document.write(monthname[month] + '月');
document.write('</div>');

document.write('<table id="day-data">');

document.write('<tr>');
document.write('<td><span class="on">');
document.write(dayname[day]);
document.write('</span></td>');

for(var i=1;i<10;i++){
	document.write('<td><span>');
	document.write(dayname[day+i]);
	document.write('</span></td>');
	if(i==4){
		document.write('</tr><tr>')
	};
};
document.write('</tr>');

document.write('</table>');

document.write('</div>');

/*-----------------[end]--------------*/

//-->
       
// var now,hours,minutes,seconds,timeValue; 

// showtime(); 
 