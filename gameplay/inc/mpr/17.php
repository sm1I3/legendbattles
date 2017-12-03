<?
$newsclon = Array(5 => "<img src='http://img.legendbattles.ru/image/signs/light.gif' width='15' height='12' title='Истинный Свет' align='absmiddle'/>", "<img src='http://img.legendbattles.ru/image/signs/dark.gif' width='15' height='12' title='Истинная Тьма' align='absmiddle'/>", "<img src='http://img.legendbattles.ru/image/signs/sumer.gif' width='15' height='12' title='Нейтральные Сумерки' align='absmiddle'/>", "<img src='http://img.legendbattles.ru/image/signs/chaos.gif' width='15' height='12' title='Абсолютный Хаос' align='absmiddle'/>");
$scnames = Array(5 => 'Истинный Свет', 'Истинная Тьма', 'Нейтральные Сумерки', 'Абсолютный Хаос');
$premium='';
$price='';
$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM premium_info;");
while($row = mysqli_fetch_assoc($sql)){
	$premium .= "['".$row['id']."','".$row['mass']."','".$row['exp']."','".$row['drop']."','".$row['exp_max']."','".$row['exp_pvp']."','".$row['exp_sklon']."','".$row['exit']."','".$row['seif']."','".$row['auto']."','".$row['smiles']."'],";
	$price .= "['".$row['price_10']."','".$row['price_30']."','".$row['price_60']."','".$row['price_90']."'],";
}
$premium=substr_replace($premium, '', -1);
$price=substr_replace($price, '', -1);
$prdb=explode("|",$player['premium']);
$prdb[0]==1 ? $basic="basic" : $basic="no_basic";
$prdb[0]==2 ? $pr="pr" : $pr="no_pr";
$prdb[0]==3 ? $gld="gld" : $gld="no_gld";
$prdb[0]==4 ? $vip="vip" : $vip="no_vip";
$prdb[0]==5 ? $vip="platinum" : $vip="platinum";

echo 
"<tr><td width=100%>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"./js/prem.js?".time()."\"></SCRIPT>
<SCRIPT language=\"JavaScript\">
var premuim;var price;var dlr;var scod;var lr;
scod = '".scode()."';
dlr = ".$player['dd'].";
lr = ".$player['nv'].";
price = [".$price."];\n
premium = [".$premium."];\n
</script>";
echo'
<font class=proce>
<fieldset>
<LEGEND align=center><B><font color=gray>&nbsp;Платные сервисы&nbsp;</font></B></LEGEND>
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr width=100%><td align=center colspan=5><font class="freemain"><font color="#3564A5"><b>Аккаунты</b></font></font></td></tr>
<tr>
<td width="20%" align="center"><img src="http://img.legendbattles.ru/image/NewDesign/premium/basic.gif" onclick="writeinfo(0);"></td>
<td width="20%" align="center"><img src="http://img.legendbattles.ru/image/pinfo/p2.png" onclick="writeinfo_lr(1);"></td>
<td width="20%" align="center"><img src="http://img.legendbattles.ru/image/pinfo/p3.png" onclick="writeinfo(2);"></td>
<td width="20%" align="center"><img src="http://img.legendbattles.ru/image/pinfo/p4.png" onclick="writeinfo(3);"></td>
<td width="20%" align="center"><img src="http://img.legendbattles.ru/image/pinfo/p5.png" onclick="writeinfo(4);"></td>
</tr>
<tr>
<td align="center">   ' . ($basic == "basic" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до ' . date("d.m.y", $prdb[1]) . '</font>' : '') . '</td>
<td align="center">   ' . ($pr == "pr" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до ' . date("d.m.y", $prdb[1]) . '</font>' : '') . '</td>
<td align="center">   ' . ($gld == "gld" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до ' . date("d.m.y", $prdb[1]) . '</font>' : '') . '</td>
<td align="center">   ' . ($vip == "vip" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до ' . date("d.m.y", $prdb[1]) . '</font>' : '') . '</td>
<td align="center">   ' . ($platinum == "platinum" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до ' . date("d.m.y", $prdb[1]) . '</font>' : '') . '</td>
</tr>
<tr>
<td align="center" colspan=5>
<div id="prem_info">
<font class="freemain"><font color="#3564A5"><b>Сервисы</b></font></font><br><br>
<table cellpadding="5" cellspacing="0" border="0" width="90%" class=nickname>
<tr><td width=60%>Обнуление персонажа (добавляет в возможности 1 обнуление)</td><td align="center">' . ($player['dd'] >= 7 ? '<form method=POST width=100%><input class=lbut type=submit value=" Купить за 7 DLR " width=100%><input type=hidden name="obnul" value="1"><input type=hidden name="vcode" value="' . scode() . '"><input type=hidden name="post_id" value="67"></form>' : '<input class=lbut type=button value=" 7 DLR " disabled>') . '</td></td></tr>
';
$i=5;
while($i <= 8){
    echo '<tr><td>Покупка склонности персонажу ' . $newsclon[$i] . ' ' . $scnames[$i] . '</td><td align="center">' . ($player['dd'] >= 100 ? ($player['clan_id'] == 'none' ? '<form method=POST width=100%><input class=lbut type=submit value=" Купить за 100 DLR " width=100%><input type=hidden name="sklon" value="' . $i . '"><input type=hidden name="vcode" value="' . scode() . '"><input type=hidden name="post_id" value="68"></form>' : 'недоступно персонажам состоящим в клане') : '<input class=lbut type=button value=" 100 DLR " disabled>') . '</td></td></tr>';
	$i++;
}
echo'
</table>
</div>
</td>
</tr>
</table>
</fieldset>
</td></tr>
';
?>