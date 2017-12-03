var d=document;
var upSc = '112';
d.write('<SCRIPT src="js/jquery.js?'+upSc+'"></SCRIPT>');
d.write ('<script language=javascript src=js/personaj.js?'+upSc+'></script><SCRIPT language=javascript src="js/lavka.js?'+upSc+'"></SCRIPT><SCRIPT src="js/fightn.js?'+upSc+'"></SCRIPT>');

var curTimeFor;
var curTimeInt;
var allTime;
var RETURN_win = '';
var ID_return='';
var GetById = function (id) {return document.getElementById(id);}
function set_return_win(ID_r)
{
	ID_return=ID_r;
	parent.frames["top_frame"].document.getElementById(ID_return).innerHTML = '<div class=but>Загрузка<br><img src=images/loader.gif></div>';
}

function show_return(text)
{
	parent.frames["top_frame"].document.getElementById(ID_return).innerHTML = text;
}

function waiter(time,upd,info)
{
	if (!time) return;
	if (!info) info = '';
	   clearInterval(curTimeInt);

	if (!upd) upd = 1; else upd = 0;
	   allTime = time;
       curTimeFor = time;

		  var addtxt = '';
		  //$("#zcenter").css({left:'40%',top:'140px',width:'165px',height:'30px'});
		  $("#zcenter").css({top:'140px'});
		  addtxt = '<table style="width:190px;" border=0 cellspacing=0 cellspadding=0><tr><td align=right><img src=images/skill.gif height=8 width=0 id=waiter_on>&nbsp;</td><td align=left>';
		  addtxt += '<img src=images/no.png height=8 style="width:190px;" id=waiter_off>&nbsp;</td></table>';

		  if (info!=undefined && info!='') addtxt+= '&nbsp;'+info;
         document.getElementById("waiter").innerHTML = '<font class=guest>&nbsp;Действие, ещё <b id=waiter_time>'+allTime+'</b> сек.<br>'+addtxt;

        curTimeFor = curTimeFor-1;
		$(function(){$("#waiter_on").animate({width:190},1000*allTime);$("#waiter_off").animate({width:0},1000*allTime);});

          clearInterval(curTimeInt);
       curTimeInt = setInterval("winterv("+upd+",'"+info+"')",1000);
}


function winterv(upd,info)
{
	if (!document.getElementById("waiter") || !document.getElementById("waiter_time"))
		{
			clearInterval(curTimeInt);
			return;
		}
       if(curTimeFor>0 || (!upd && curTimeFor==0))
       {
         document.getElementById("waiter_time").innerHTML = Math.round(curTimeFor);
	      curTimeFor = curTimeFor - 1;
       }
       else if (upd)
       {
          clearInterval(curTimeInt);
	      document.getElementById("waiter").innerHTML = '<a href=main.php class=timef>Обновление</a></i>';
	      window.location = "main.php";
       }
	   else
       {
			clearInterval(curTimeInt);
			document.getElementById("waiter").innerHTML = '';
       }
}

function set_apps(on)
{
if (on)
{
for (var i=1;i<=7;i++)
	if ($('but'+i)) $('but'+i).disabled = false;
}
else
{
for (var i=1;i<=7;i++)
	if ($('but'+i)) $('but'+i).disabled = true;
}
}








function getByName(nn)
{
	var a = d.getElementsByName(nn);
	return a[0];
}
var sila = 1;
var lovk = 1;
var udacha = 1;
var zdorov = 1;
var znanya = 1;
var power = 1;
var ups = 0;
var ssila = 1;
var slovk = 1;
var sudacha = 1;
var szdorov = 1;
var sznanya = 1;
var spower = 1;
var nym = 0;
var nmym = 0;
var nsym = 0;
var LEVEL;

function pluses(stat,onclick)
{
	return "<table border=0 cellspacing=0 cellspadding=0 width=60><tr><td>"+stat+"</td><td width=15><img src='images/DS/plus.png' onclick='"+onclick+"(1)' style='cursor:pointer;'></td><td width=15><img src='images/DS/minus.png' style='cursor:pointer' onclick='"+onclick+"(-1)'></td></tr></table>";
}

function start (ss,sl,su,szd,szn,sp,sup,level)
{
LEVEL = level;
sila = ss;
lovk = sl;
udacha = su;
zdorov = szd;
znanya = szn;
power = sp;
ups = sup;
ssila = ss;
slovk = sl;
sudacha = su;
szdorov = szd;
sznanya = szn;
spower = sp;
if (ups>0){
d.getElementById('sila').innerHTML = pluses(ss,'stups');
d.getElementById('lovk').innerHTML = pluses(sl,'stupl');
d.getElementById('udacha').innerHTML = pluses(su,'stupu');
d.getElementById('zdorov').innerHTML = pluses(szd,'stupzd');
if (level>=5)d.getElementById('znanya').innerHTML = pluses(szn,'stupzn');
else d.getElementById('znanya').innerHTML = szn;
d.getElementById('power').innerHTML = pluses(sp,'stupp');
}else
{
d.getElementById('sila').innerHTML = ss;
d.getElementById('lovk').innerHTML = sl;
d.getElementById('udacha').innerHTML = su;
d.getElementById('zdorov').innerHTML = szd;
d.getElementById('znanya').innerHTML = szn;
d.getElementById('power').innerHTML = sp;
}
if (ups > 0)
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
else
d.getElementById('ups').innerHTML = '';
}

function stups (up) {
if ((up==-1 && sila > ssila) | (up==1))
if (up==-1 | ups>0) {
sila += up;
d.getElementById('sila').innerHTML = pluses(sila,'stups');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function stupl (up) {
if ((up==-1 && lovk > slovk) | (up==1))
if (up==-1 | ups>0) {
lovk += up;
d.getElementById('lovk').innerHTML = pluses(lovk,'stupl');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function stupu (up) {
if ((up==-1 && udacha > sudacha) | (up==1))
if (up==-1 | ups>0) {
udacha += up;
d.getElementById('udacha').innerHTML = pluses(udacha,'stupu');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function stupzd (up) {
if ((up==-1 && zdorov > szdorov) | (up==1))
if (up==-1 | ups>0) {
zdorov += up;
d.getElementById('zdorov').innerHTML = pluses(zdorov,'stupzd');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function stupzn (up) {
if ((up==-1 && znanya > sznanya ) | (up==1))
if (up==-1 | ups>0) {
znanya += up;
d.getElementById('znanya').innerHTML = pluses(znanya,'stupzn');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function stupp (up) {
if ((up==-1 && power > spower) | (up==1))
if (up==-1 | ups>0) {
power += up;
d.getElementById('power').innerHTML = pluses(power,'stupp');
ups -= up;
d.getElementById('ups').innerHTML ='<i>Повышений:&nbsp;'+ups+'</i>';
}}
function save () { // Сохраняем
d.getElementById('SAVEstats').innerHTML = '<form method=post action="add_stat_user/stats.php" target="returner" name=stats>'+'<input type=hidden name=stats value=1><input type=hidden name=s1 value='+sila+'>'+'<input type=hidden name=s2 value='+lovk+'>'+'<input type=hidden name=s3 value='+udacha+'>'+'<input type=hidden name=s4 value='+zdorov+'>'+'<input type=hidden name=s5 value='+znanya+'>'+'<input type=hidden name=s6 value='+power+'>'+'<input type=hidden name=ups value='+ups+'>'+'</form>';
parent.frames['top_frame'].document.stats.submit();
set_return_win('SAVEstats');
start (sila,lovk,udacha,zdorov,znanya,power,ups,LEVEL);
}
function s_y()
{
var max_m = (100+level*70);
var b=0;
var s=0;
var bs='b';
var bf='bs';
nym = document.ym.nbs.value;
nsym = document.ym.nss.value;
for (b=1;b<15;b++) {
bs = 'b' + b;
bf = 'bs' + b;
d.getElementById(bs).innerHTML = '['+getByName(bf).value+'/30]';
if (nym>0) d.getElementById(bs).innerHTML+='<img src=\'images/DS/plus.png\' onclick="um_up(\'b\','+b+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'b\','+b+')" style="cursor:pointer;">';
}


nym = document.ym.nbs.value;
nsym = document.ym.nss.value;
 for (b=16;b<18;b++) {
bs1 = 'b' + b;
bf1 = 'bs' + b;
d.getElementById(bs).innerHTML = '['+getByName(bf).value+'/30]';
if (nym>0) d.getElementById(bs).innerHTML+='<img src=\'images/DS/plus.png\' onclick="um_up(\'b\','+b+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'b1\','+b+')" style="cursor:pointer;">';
}





for (m=1;m<15;m++) {
bs = 'm' + m;
bf = 'ms' + m;
if (getByName(bf).value>max_m) getByName(bf).value=max_m;
d.getElementById(bs).innerHTML = '['+getByName(bf).value+'/'+max_m+']<img src="images/skill.gif" height=8 width='+(30*getByName(bf).value/max_m)+'><img src="images/no.png" height=8 width='+(30-30*getByName(bf).value/max_m)+'>';
}

for (m=1;m<8;m++) {
bs = 's' + m;
bf = 'ss' + m;
d.getElementById(bs).innerHTML = '['+getByName(bf).value+'/100]';
if (nsym>0) d.getElementById(bs).innerHTML+='<img src=\'images/DS/plus.png\' onclick="um_up(\'s\','+m+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'s\','+m+')" style="cursor:pointer;">';
}

if (nym != 0) d.getElementById('nymen').innerHTML = nym;
if (nsym != 0) d.getElementById('nsymen').innerHTML = nsym;
}

function um_up(type,num) {
if ((nym>0) && (type=='b') && (d.getElementById('bs'+num).value<30)) {
nym--;
document.ym.nbs.value = nym;
getByName('bs'+num).value++;
d.getElementById('b'+num).innerHTML = '['+getByName('bs'+num).value +'/30]' + '<img src=\'images/DS/plus.png\' onclick="um_up(\'b\','+num+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'b\','+num+')" style="cursor:pointer;">';
d.getElementById('nymen').innerHTML = nym;
}
if ((nsym>0) && (type=='s') && (d.getElementById('ss'+num).value<100)) {
nsym--;
document.ym.nss.value = nsym;
getByName('ss'+num).value++;
d.getElementById('s'+num).innerHTML = '['+getByName('ss'+num).value +'/100]'+ '<img src=\'images/DS/plus.png\' onclick="um_up(\'s\','+num+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'s\','+num+')" style="cursor:pointer;">';
d.getElementById('nsymen').innerHTML = nsym;
}
}

function um_down(type,num) {
if (type=='b') {
var ztemp = getByName('bs'+num).value;
var ctemp = getByName('bf'+num).value;
ztemp++;
ctemp++;
if (ztemp>ctemp){
nym++;
document.ym.nbs.value = nym;
getByName('bs'+num).value--;
d.getElementById('b'+num).innerHTML = '['+getByName('bs'+num).value +'/30]'+ '<img src=\'images/DS/plus.png\' onclick="um_up(\'b\','+num+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'b\','+num+')" style="cursor:pointer;">';
d.getElementById('nymen').innerHTML = nym;
}}



 if (type=='b') {
var ztemp = getByName('bs'+num).value;
var ctemp = getByName('bf'+num).value;
ztemp++;
ctemp++;
if (ztemp>ctemp){
nym++;
document.ym.nbs.value = nym;
getByName('bs'+num).value--;
d.getElementById('b'+num).innerHTML = '['+getByName('bs'+num).value +'/30]'+ '<img src=\'images/DS/plus.png\' onclick="um_up(\'b\','+num+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'b\','+num+')" style="cursor:pointer;">';
d.getElementById('nymen').innerHTML = nym;
}}
if (type=='s') {
var ztemp = getByName('ss'+num).value;
var ctemp = getByName('sf'+num).value;
ztemp++;
ctemp++;
if (ztemp>ctemp){
nsym++;
document.ym.nss.value = nsym;
getByName('ss'+num).value--;
d.getElementById('s'+num).innerHTML = '['+getByName('ss'+num).value+'/100]' + '<img src=\'images/DS/plus.png\' onclick="um_up(\'s\','+num+')" style="cursor:pointer;"> <img src=\'images/DS/minus.png\' onclick="um_down(\'s\','+num+')" style="cursor:pointer;">';
d.getElementById('nsymen').innerHTML = nsym;
}}
}



function exit_confirm()
{
       return confirm('Вы действительно хотите покинуть игру?');
}
function exit_redir()
{
       if(exit_confirm()) location = 'exit.php';
}

function exit_pers()
{
       return confirm('Вы действительно хотите сменить персонажа?');
}
function exit_redir_pers()
{
       if(exit_pers()) location = 'exit.php?pers=1';
}

   if(parent.loading)
	parent.load(30);
