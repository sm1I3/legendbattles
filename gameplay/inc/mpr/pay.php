<? 
$newsclon = Array(5=>"<img src='/img/image/signs/light.gif' width='15' height='12' title='Истинный Свет' align='absmiddle'/>","<img src='/img/image/signs/dark.gif' width='15' height='12' title='Истинная Тьма' align='absmiddle'/>","<img src='/img/image/signs/sumer.gif' width='15' height='12' title='Нейтральные Сумерки' align='absmiddle'/>","<img src='/img/image/signs/chaos.gif' width='15' height='12' title='Абсолютный Хаос' align='absmiddle'/>");
$scnames = Array(5=>'Истинный Свет','Истинная Тьма','Нейтральные Сумерки','Абсолютный Хаос');
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

echo 
"<tr><td width=100%>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"./js/prem.js?".time()."\"></SCRIPT>
<SCRIPT language=\"JavaScript\">
var premuim;var price;var dlr;var scod;var lr;
scod = '".scode()."';
dlr = ".$player['baks'].";
lr = ".$player['nv'].";
price = [".$price."];\n
premium = [".$premium."];\n
</script>";
echo'
<div class="block pay">
	<div class="header">
		<span>Платные сервисы</span>
	</div>
	<div class="content">
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr width=100%><td align=center colspan=5><font class="freemain"><font color="#3564A5"><b>Аккаунты</b></font></font></td></tr>
<tr>
<td width="20%" align="center"><img src="/img/image/NewDesign/premium/basic.gif" onclick="writeinfo(0);"></td>
<td width="20%" align="center"><img src="/img/image/pinfo/p2.png" onclick="writeinfo_lr(1);"></td>
<td width="20%" align="center"><img src="/img/image/pinfo/p3.png" onclick="writeinfo(2);"></td>
<td width="20%" align="center"><img src="/img/image/pinfo/p4.png" onclick="writeinfo(3);"></td>
</tr>
<tr>
<td align="center">   '.($basic=="basic" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до '.date("d.m.y",$prdb[1]).'</font>' : '').'</td>
<td align="center">   '.($pr=="pr" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до '.date("d.m.y",$prdb[1]).'</font>' : '').'</td>
<td align="center">   '.($gld=="gld" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до '.date("d.m.y",$prdb[1]).'</font>' : '').'</td>
<td align="center">   '.($vip=="vip" ? '<font class="freemain"><font color="#3564A5"><b>  Активен</b></font></font><br><font class=weaponch>до '.date("d.m.y",$prdb[1]).'</font>' : '').'</td>
</tr>
<tr>
<td align="center" colspan=5>
<div id="prem_info">
<font class="freemain"><font color="#3564A5"><b>Сервисы</b></font></font><br><br>
<table cellpadding="5" cellspacing="0" border="0" width="90%" class=nickname>
<tr><td width=60%>Обнуление персонажа (добавляет в возможности 1 обнуление)</td><td align="center">'.($player['baks']>=7 ? '<form method=POST width=100%><input class=lbut type=submit value=" Купить за 7 Изумруд" width=100%><input type=hidden name="obnul" value="1"><input type=hidden name="vcode" value="'.scode().'"><input type=hidden name="post_id" value="67"></form>' : '<input class=lbut type=button value=" 7 Изумруд " disabled>').'</td></td></tr>
';
echo'
</table>
</div>
</td>
</tr>
</table>
</div>
</div>
';
?>