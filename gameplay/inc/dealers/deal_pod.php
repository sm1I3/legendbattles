<?
echo'
<tr>
<td>
<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10>
<form action=main.php method=POST name=present>
<input type=hidden name=post_id value=21><input type=hidden name=vcode value="'.scode().'">
</td>
</tr>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td><FIELDSET name=field_dealers id=field_dealers><LEGEND align=center><b> <font color=gray>У Вас с собой '.$player['baks'].' Изумруд</font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100%>
';
$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE ".($_GET['ng']==1?"id>116 and id<121":"id>999").";");
$i=0;
while ($r = mysqli_fetch_assoc($sql))
{
	if($i==0)echo "<tr><SCRIPT language=JavaScript>";
	echo "showpresent('$r[id]','f$r[id]','$r[price] ".($_GET['ng']==1?"DLR":"$")."','$r[name]','');";$i++;
	if($i==4){echo "</SCRIPT></tr>";$i=0;}
}
if($i!=0){for($t=$i;$i<=4;$i++){echo "<td>&nbsp;</td>";}}
echo'</SCRIPT></tr><tr><td colspan=4 bgcolor=#ffffff><div align=center><font class=freetxt>Подарок для: <input type=text name=prnick class=input_cl_s size=20 maxlength=25> Подпись: <input type=text name=prtext class=input_cl_s size=40 maxlength=40> <input type=submit value="Отправить" class=lbut onClick="javascript: return check_pres();"></div></td></tr>';
echo'</td></tr></table></FIELDSET>';
?>
