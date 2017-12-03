<?php
if($player['clan_id'] != $Fort['clan']){
	header("Location: /main.php");
}
if(isset($_GET['upgrade'])){
	$PriceArray = array(
		'teleport'=>array("5","1000","5000"),
		'change'=>array("5","2000","6000"),
		'bless'=>array("1","5000","15000"),
		'market'=>array("1","5000","15000")
	);
	if(!empty($PriceArray[$_GET['upgrade']])){
		$GetCapacity = explode('/',$Fort[$_GET['upgrade']]);
		$GetPrice = ($GetCapacity[1] - $PriceArray[$_GET['upgrade']][0])*$PriceArray[$_GET['upgrade']][1] + $PriceArray[$_GET['upgrade']][2];
		if($player['nv'] >= $GetPrice){
			mysqli_query($GLOBALS['db_link'],"UPDATE `forts` SET `".$_GET['upgrade']."`='".($GetCapacity[1]+1)."/".($GetCapacity[1]+1)."' WHERE `id`='".$Fort['id']."'");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$GetPrice."' WHERE `id`='".$player['id']."'");
			list($player['x'], $player['y']) = explode('_', $player['pos']);
			$Fort = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `forts` WHERE `x`='".$player['x']."' and `y`='".$player['y']."'"));

		}
	}
	
}
//посчитаем текущую цену улучшения телепорта
$teleport_capacity = explode('/',$Fort['teleport']);
$teleport_price = ($teleport_capacity[1] - 5)*1000 + 5000;

//посчитаем текущую цену улучшения обменника
$change_capacity = explode('/',$Fort['change']);
$change_price = ($change_capacity[1] - 5)*2000 + 6000;

//посчитаем текущую цену улучшения благословений
$bless_capacity = explode('/',$Fort['bless']);
$bless_price = ($bless_capacity[1] - 1)*5000 + 15000;

//посчитаем текущую цену улучшения лавки
$market_capacity = explode('/',$Fort['market']);
$market_price = ($market_capacity[1] - 1)*5000 + 15000;

echo'<table width="100%" border="1" class="nickname">
	<tr>
		<td align="center"><b>Услуга</b></td>
		<td align="center"><b>Текущая емкость в сутки</b></td>
		<td align="center"><b>Из них доступно чужакам</b></td>
		<td align="center"><b>Цена для чужаков</b></td>
	</tr>
	<tr>
		<td>Портал</td>
		<td>'.(($teleport_capacity[1] < 10) ? $teleport_capacity[1].'&nbsp;&nbsp;' : $teleport_capacity[1] ).'&nbsp;&nbsp;&nbsp; [<a href="?addid=7&upgrade=teleport" onclick="return confirm(\'Улучшение емкости порталов на 1 в сутки стоит '.$teleport_price.' LR. В качестве бонуса текущая суточная емкость будет полностью восстановлена. Производим улучшение?\')">увеличить - '.$teleport_price.' LR.</a>]</td>
		<td align="center"><b>0</b></td>
		<td><input class="lbut" type="text" size="3" style="width: 100%;" disabled></td>
	</tr>
	<tr>
		<td>Обмен ресурсов</td>
		<td>'.(($change_capacity[1] < 10) ? $change_capacity[1].'&nbsp;&nbsp;' : $change_capacity[1] ).'&nbsp;&nbsp;&nbsp; [<a href="?addid=7&upgrade=change" onclick="return confirm(\'Улучшение емкости обменника ресурсов на 1 в сутки стоит '.$change_price.' LR. В качестве бонуса текущая суточная емкость будет полностью восстановлена. Производим улучшение?\')">увеличить - '.$change_price.' LR.</a>]</td>
		<td align="center"><b>0</b></td>
		<td><input class="lbut" type="text" size="3" style="width: 100%;" disabled></td>
	</tr>
	<tr>
		<td>Благословение</td>
		<td>'.(($bless_capacity[1] < 10) ? $bless_capacity[1].'&nbsp;&nbsp;' : $bless_capacity[1] ).'&nbsp;&nbsp;&nbsp; [<a href="?addid=7&upgrade=bless" onclick="return confirm(\'Улучшение количества благословений на 1 в сутки стоит '.$bless_price.' LR. В качестве бонуса текущая суточная емкость будет полностью восстановлена. Производим улучшение?\')">увеличить - '.$bless_price.' LR.</a>]</td>
		<td align="center"><b>0</b></td>
		<td><input class="lbut" type="text" size="3" style="width: 100%;" disabled></td>
	</tr>
	<tr>
		<td>Лавка</td>
		<td>'.(($market_capacity[1] < 10) ? $market_capacity[1].'&nbsp;&nbsp;' : $market_capacity[1] ).'&nbsp;&nbsp;&nbsp; [<a href="?addid=7&upgrade=market" onclick="return confirm(\'Улучшение емкости лавки тотемов на 1 в сутки стоит '.$market_price.' LR. В качестве бонуса текущая суточная емкость будет полностью восстановлена. Производим улучшение?\')">увеличить - '.$market_price.' LR.</a>]</td>
		<td align="center"><b>0</b></td>
		<td><input class="lbut" type="text" size="3" style="width: 100%;" disabled></td>
	</tr>
</table>';

