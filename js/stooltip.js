var tipobj,op;

function tooltip(el,txt) {
  tipobj=document.getElementById('stooltipmsg');
  tipobjtext=document.getElementById('stooltiptext');
  if (txt!='') {
    op = 0.1;
    tipobjtext.innerHTML = txt == '' ? '&nbsp;': txt;
    tipobj.style.opacity = op;
    tipobj.style.visibility="visible";
    el.onmousemove=positiontip;
    appear();
  }
}
 
function hide_info(el) {
  if (document.getElementById('stooltipmsg')!==null) {
    document.getElementById('stooltipmsg').style.visibility='hidden';
  }
  el.onmousemove='';
}
 
function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
 
function positiontip(e) {
var tipobj=document.getElementById('stooltipmsg');
var ie=document.all && !window.opera;
var ns6=document.getElementById && !document.all;
var offsetfromcursorY=-5 // y offset of tooltip
var offsetfromcursorX=-15
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
var winwidth=ie? ietruebody().clientWidth : window.innerWidth-20
var winheight=ie? ietruebody().clientHeight : window.innerHeight-20
 
var rightedge=ie? winwidth-event.clientX-offsetfromcursorX : winwidth-e.clientX-offsetfromcursorX;
var bottomedge=ie? winheight-event.clientY-offsetfromcursorY : winheight-e.clientY-offsetfromcursorY;
 
if (rightedge < tipobj.offsetWidth)  tipobj.style.left=curX-tipobj.offsetWidth-30-offsetfromcursorX+"px";
else tipobj.style.left=curX-offsetfromcursorX+"px";
 
if (bottomedge < tipobj.offsetHeight) tipobj.style.top=curY-tipobj.offsetHeight-offsetfromcursorY+"px"
else tipobj.style.top=curY+offsetfromcursorY+"px";
}
function appear() {
  var ns6=document.getElementById && !document.all;
  if(op < 1) {   
  op += 0.1;
  tipobj.style.opacity = op;
  if(!ns6){tipobj.style.filter = 'alpha(opacity='+op*100+')';}
  t = setTimeout('appear()', 30);
  }
} 
document.write("<div id='stooltipmsg' class='stooltip'><div id='tooltips' class='tooltips'><div id='stooltiptext' style='padding: 0; margin: 0;'></div></div></div>");