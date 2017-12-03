<?php
echo'
<div class="block info">
	<div class="header">
		<span>Бонусы</span>
	</div>
 <table cellpadding=0 cellspacing=1 border=0 width=25% align=center>
 ';
if($pers['clan_id']!='none'){
	$clsql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM clans WHERE clan_id='".$pers['clan_id']."';"));
	echo'
	<tr><td colspan=3 align=center>'.$msg.'</td></tr>
	<tr align=center><td colspan=3><font class=travma>Денег с собой <b>' . $pers['baks'] . '</b> Изумруда</font></td></tr>
	<tr align=left><td colspan=3><div class="underline"></div></td></tr>
	<tr align=center><td colspan=3><font class=travma>Максимальное количество апов <b>100</b>. Доступно <b>' . $clsql['cl_up'] . '</b>.</font></div></td></tr>
	' . ($pers['dd'] >= 125 ? ($clsql['cl_up'] == 0 ? '<tr align=left><td colspan=3><div class="underline"></div></td></tr><tr align=center><td colspan=3><form method=post><font class=travma>Приобрести: <input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="100"><input class=lbut type=submit value="+10 апов [ 125 Изумруда ]"></form></td></tr>' : '') : '') . '
	<tr align=left><td colspan=3><div class="underline"></div></td></tr>
	<tr align=center><td colspan=3><font class=travma>Апов использовано <b>' . (100 - $clsql['cl_up'] - $clsql['cl_buyup']) . '</b>, дополнительные бонусы: <b>+' . (100 - $clsql['cl_up'] - $clsql['cl_buyup']) . '</b> Наблюдательности.</font></td></tr>
	<tr align=left><td colspan=3><div class="underline"></div></td></tr>
	<tr align=left><td width=50%><font class=travma>&nbsp;Сила:</b></font></td><td width=40%><font class=travma><b>&nbsp;' . $clsql['cl_sila'] . '</b></font></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="1"><input class=lbut type=submit value="+1 силы [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;Ловкость:</font></font></td><td ><font class=travma><b>&nbsp;' . $clsql['cl_lovkost'] . '</b></font></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="2"><input class=lbut type=submit value="+1 ловкости [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;Удача:</td><td ><font class=travma><b>&nbsp;' . $clsql['cl_ydacha'] . '</b></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="3"><input class=lbut type=submit value="+1 удачи [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;Здоровье:</td><td ><font class=travma><b>&nbsp;' . $clsql['cl_zdorov'] . '</b></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="4"><input class=lbut type=submit value="+1 здоровья [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;Знания:</font></td><td ><font class=travma><b>&nbsp;' . $clsql['cl_znan'] . '</b></font></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="5"><input class=lbut type=submit value="+1 знаний [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;HP:</font></td><td ><font class=travma><b>&nbsp;' . $clsql['cl_hp'] . '</b></font></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="6"><input class=lbut type=submit value="+25 HP [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=left><td ><font class=travma>&nbsp;MP:</td><td ><font class=travma><b>&nbsp;' . $clsql['cl_mp'] . '</b></td><td><form method=post><input type=hidden name=vcode value="' . vCode() . '"><input type=hidden name=post_id value="1"><input type=hidden name=param value="7"><input class=lbut type=submit value="+10 MP [ ' . (104 - $clsql['cl_up'] - $clsql['cl_buyup']) . ' Изумруда ]"></form></td></tr>
	<tr align=left><td colspan=2><div class="underline"></div></td></tr>
	<tr align=center><td colspan=3><font class=travma>Данные бонусы получают <b>все</b> члены клана.</font></td></tr>
	';
} else {
    echo '<tr align=center><td width=30%><font class=travma>&nbsp;<b>Клановые бонусы отсутствуют.</b></font></td></tr>';
}
echo'
</table>
</FIELDSET>';
?>