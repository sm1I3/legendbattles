<?
echo'
<tr>
<td>
<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10>
</td>
</tr>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td><FIELDSET name=field_dealers id=field_dealers><LEGEND align=center><b> <font color=gray>У Вас с собой ' . $player[baks] . ' Изумруд</font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100%></form>
';
$vklad = $player['vklad_bank']!=0 ? explode("|",$player['vklad_bank']) : $vklad[1]="";
		if($vklad[0]!=""){
			echo '			
			<font class=proce><font color=#222222>
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr><td align=center class=nickname2>
					Вложенная сумма: ' . $vklad[1] . '<br>
					Дата начисления процентов: ' . date("d.m.yг.", $vklad[0]) . '<br>
					Сумма получения с учетом процентов: ' . $vklad[2] . '<br>
					</td></tr>
					<tr><td align=center class=nickname2>
					<br><b>Возможные действия:</b><br>
					'.(
					$vklad[0]>time() ?
                        'Забрать вклад можно будет ' . date("d.m.yг.", $vklad[0])
					:
					'
					<form method=POST>
					<input type=hidden name=post_id value=100>
					<input type="hidden" name="vcode" value="'.scode().'" />
					<input type=submit class=lbut value=" Забрать вклад ' . $vklad[2] . ' " ></form>	'
					).
					'
				</td></tr>
			</table>
			</FIELDSET>
			';
		}
else{
echo '<script language=Javascript src="../../../js/vklad_deal.js"> </script>
<script>
	var pl_lvl,scode;
	mon_baks= '.$player['baks'].';
	mon_dd= '.$player['dd'].';
</script>
';
echo'<FIELDSET>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<select onChange="writevklad(this.value);" >
					<option value=0 selected>Выберите тип ячейки</option>
					<option value=1 >Platinum (<b>$</b>)</option>
					<option value=2 >Gold (<b>DLR</b>)</option>
				</select>	
			<font id="vk_type1"></font>	
			<input id="vk_sum" type="hidden" onblur="if (value == \'\') {value=\' Введите сумму вклада \' }" onfocus="if (value == \' Введите сумму вклада \') {value = \'\'}" value=" Введите сумму вклада " onkeyup="chvk();" />			
			</td>
			</tr>
			<tr><td align=center>
				<form method=POST>
					<input type="hidden" name="vcode" value="'.scode().'" />
					<input type=hidden name="sum" id="vk_sum_hid" value="0">
					<input type=hidden name="type1" id="vk_type1_hid" value="0">
					<input type=hidden name="type2" id="vk_type2_hid" value="0">
					<font class=freetxt><div id="vk_uslov">Выберите тип вклада.</div></font>
				</form>	
			</td></tr>
		</table>
	</FIELDSET>
';
}
?>
