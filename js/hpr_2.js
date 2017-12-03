function showpresent(pid,pimage,pprice,palt,pcheck) {
document.write('<td bgcolor=#ffffff width=25%><div align=center><table cellpadding=0 cellspacing=0 border=0><tr><td bgcolor=#333333><table cellpadding=5 cellspacing=1 border=0><tr><td bgcolor=#ffffff><img src=http://img.legendbattles.ru/image/presents/'+pimage+'.gif width=100 height=100 title="'+palt+'"><br><div align=center><b><font class=freetxt><input type=radio name=pid value='+pid+pcheck+'> '+pprice+'</div></td></tr></table></td></tr></table><div></td>');
}
function check_pres() {
var Error = 0;
if(!document.present.prnick.value) Error = 1;
if(!document.present.prtext.value) Error = 1;
if(Error==1) { alert("Заполните все поля!"); return false; }
return true;
}
