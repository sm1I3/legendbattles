<tr><td>
<font class=proce>
<FIELDSET>
    <LEGEND align=center><B><font color=gray>&nbsp;Подарки и открытки&nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td>
<table cellpadding=0 cellspacing=4 border=0 width=100%><tr><td align=center><font class=freetxt>
                <? $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podarki WHERE id='" . $player['id'] . "';");
if(mysqli_num_rows($sql)>0){
$i=0;
while ($r = mysqli_fetch_assoc($sql)) {
$vcod=scode();
//if($r['podarok']<9996){
//echo "<img src=http://img.legendbattles.ru/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]. Действителен до: ".date("d.m.Y",$r['srok'])."\" onClick=\"javascript: if(parent.DeleteTrue('Подарок')) { location='main.php?post_id=51&uid=$player[id]&wn=$r[podarok]&vcode=$vcod' }\">";
//}
//else 
$opencheck=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `mark_pod`.`open`,`mark_pod`.`id` FROM `mark_pod` WHERE `id`='".$r['podarok']."' LIMIT 1;"));
if($opencheck['open']=='1'){
    echo "<img src=http://img.legendbattles.ru/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]\" style=\"cursor:pointer;\" onClick=\"javascript: if(parent.DeleteTrueNG('Подарок')) { location='main.php?post_id=52&uid=$player[id]&wn=$r[podarok]&vcode=$vcod&ul=$player[login]' }\">";
}
else{
	echo "<img src=http://img.legendbattles.ru/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]\">";
}
$i++;
if($i==6){echo "<br>";$i=0;}
}
} else {
    ?>У Вас нет подарков и открыток<? } ?></font></td>
    </tr>
</table>
    </td>
</tr>
</table></td>
</tr></table></FIELDSET></td></tr>
