<SCRIPT src="./js/hpr.js"></SCRIPT>
<center><div class="block info">
	<div class="header">
        <span>Магазин Подарков</span>
	
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<form action=main.php method=POST name=present>
<input type=hidden name=post_id value=20><input type=hidden name=vcode value=<?=scod()?>>
<tr><td>
<table cellpadding=4 cellspacing=1 border=0 align=center width=100%>
<tr><th colspan=4 align=center><img src=/img/image/gameplay/other/shopod.jpg width=760 height=255 border=0></th></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<?
echo'
<tr>
<td>
<img src=/img/image/1x1.gif width=1 height=10>
</td>
</tr>
<table class=tbl1 width=100% border=0 align=center>
<tr><td><div align=center>' . $msg . '</div><b><tr><th colspan=4 align=center><a  href="?pod_swi=0" class=nickname><font  color=#000000><span>Общие</span></font></a> | <a  href="?pod_swi=1" class=nickname><font  color=#000000><span>Мужские</span></font></a> | <a  href="?pod_swi=2" class=nickname><font  color=#000000><span>Женские</span></font></a> | <a  href="?pod_swi=6" class=nickname><font  color=#FF6600><span>8 Марта</span></font></a> | <a  href="?pod_swi=4" class=nickname><font  color=#000000 Февраля</font></a> | <a  href="?pod_swi=5" class=nickname><font  color=#red><span>К дню 23 февраля</span></font></a></th></tr></b>
<table class=tbl1 border=0 width=100%>';
if(empty($pod_swi)){$pod_swi=0;}
switch($pod_swi){
	case 0: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id<5;"); break;
	case 1: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id<9 AND id>4;"); break; 
	case 2: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id<13 AND id>8;"); break; 
	case 3: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id>116 AND id<121;"); break; 
	case 4: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id>122 AND id<127;"); break;
  case 5: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id<117 and id>100;"); break;  
  case 6: $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id<182 and id>150;"); break;
}
$i=0;
if(mysqli_num_rows($sql)>0){
while ($r = mysqli_fetch_assoc($sql))
	{
		if($i==0)echo "<tr><SCRIPT language=JavaScript>";
		echo "showpresent('$r[id]','f$r[id]','".($pod_swi==3?$r['price'].' DLR':lr($r['price']))."','$r[name]','');";$i++;
		if($i==4){echo "</SCRIPT></tr>";$i=0;}
	}
if($i!=0){for($t=$i;$i<=4;$i++){echo "<td>&nbsp;</td>";}}
    echo '</SCRIPT></tr><tr><td colspan=4 bgcolor=#ffffff><div align=center><font class=freetxt>Подарок для: <input type=text name=prnick class=input_cl_s size=20 maxlength=25> Подпись: <input type=text name=prtext class=input_cl_s size=40 maxlength=40> <input type=submit value="Отправить" class=lbut onClick="javascript: return check_pres();"> <input type="checkbox" name="pranon" /> Анонимно</div></td></tr>';
}
else {
	$inputs="<input type=button class=invbut ";
	$inpute="/> ";
	$buttons="";
	$vcod=scode();
	$time=time()+2592000;
	if($player['present']==0 and time()<$time){
        $buttons .= $inputs . "onclick=\"javascript: if(confirm('Вы хотите получить свой подарок?')) {location='main.php?post_id=106&act=1&vcode=" . $vcod . "'}\" value=\"Получить праздничный Подарок\"  " . $inpute;
		echo "<tr><td align=center>".$buttons."</td></tr>";
	}
	else{
        echo "<tr><td align=center><b><font class=weaponch style=\"color:gray\">В данном разделе нет подарков.</font></b><br><font class=weaponch style=\"color:#dd0000\"><b>Ожидайте презенты согласно красным дням на календарном листе.</b></font></td></tr>";
	}
}
echo'</table></td></tr>';
?>
</td></tr>
</form>
</div>