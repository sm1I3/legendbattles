<?php
if($player['clan_id'] != $Fort['clan']){
	header("Location: /main.php");
}
/*
$Fort['storm_stamp'] = mktime(
	22,0,0,
	date('m',$Fort['storm_stamp']),
	10,
	date('Y',$Fort['storm_stamp'])
);
mysqli_query($GLOBALS['db_link'],"UPDATE `forts` SET `storm_stamp`='".$Fort['storm_stamp']."',`storm_stamp_changed`='1' WHERE `id`='".$Fort['id']."'");
*/
if($_POST['change_storm']){
	if(!$Fort['storm_stamp_changed']){
		if($_POST['day']=='less'){
			$Fort['storm_stamp'] = mktime(
				date('H',$Fort['storm_stamp']),0,0,
				date('m',$Fort['storm_stamp']),
				date('d',$Fort['storm_stamp'])-1,
				date('Y',$Fort['storm_stamp'])
			);
		}elseif($_POST['day']=='more'){
			$Fort['storm_stamp'] = mktime(
				date('H',$Fort['storm_stamp']),0,0,
				date('m',$Fort['storm_stamp']),
				date('d',$Fort['storm_stamp'])+1,
				date('Y',$Fort['storm_stamp'])
			);
		}
		if($_POST['time']=='12' && $player['nv']>=500){
			$Fort['storm_stamp'] = mktime(
				12,0,0,
				date('m',$Fort['storm_stamp']),
				date('d',$Fort['storm_stamp']),
				date('Y',$Fort['storm_stamp'])
			);
		}elseif($_POST['time']=='17' && $player['nv']>=500){
			$Fort['storm_stamp'] = mktime(
				17,0,0,
				date('m',$Fort['storm_stamp']),
				date('d',$Fort['storm_stamp']),
				date('Y',$Fort['storm_stamp'])
			);
		}elseif($_POST['time']=='22' && $player['nv']>=500){
			$Fort['storm_stamp'] = mktime(
				22,0,0,
				date('m',$Fort['storm_stamp']),
				date('d',$Fort['storm_stamp']),
				date('Y',$Fort['storm_stamp'])
			);
		}
		if(mysqli_query($GLOBALS['db_link'],"UPDATE `forts` SET `storm_stamp`='".$Fort['storm_stamp']."',`storm_stamp_changed`='1' WHERE `id`='".$Fort['id']."'")){
			if(intval($_POST['time']) && $player['nv']>=500){
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'500' WHERE `id`='".$player['id']."'");
			}
			$Fort['storm_stamp_changed'] = 1;
		}
	}
}
echo 'Следующий штурм назначен на <b>' . date('d.m.Y H:i', $Fort['storm_stamp']) . '</b>.';
if(!$Fort['storm_stamp_changed'] and ($Fort['storm_stamp']-time() > 172800)){
    echo 'Что с этим можно сделать:
<form method="post">
<input type="radio" name="day" value="less" class="check"><i>На день раньше</i> - бесплатно<br/>
<input type="radio" name="day" value="more" class="check"><i>На день позже</i> - бесплатно<br/>
<hr>
' . ((date('H', $Fort['storm_stamp']) != '12') ? '<input type="radio" name="time" value="12" class="check"><i>В 12 часов</i> - 500 LR.<br/>' : '') . '
' . ((date('H', $Fort['storm_stamp']) != '17') ? '<input type="radio" name="time" value="17" class="check"><i>В 17 часов</i> - 500 LR.<br/>' : '') . '
' . ((date('H', $Fort['storm_stamp']) != '22') ? '<input type="radio" name="time" value="22" class="check"><i>В 22 часа</i> - 500 LR.<br/>' : '') . '
<input type="submit" name="change_storm" value="Изменить дату/время" onclick="return confirm(\'Внимание! Менять дату и время конкретного штурма можно только один раз! Точно меняем??\')" class="lbut">
</form>';
}else{
    echo 'Изменение даты и времени штурма больше невозможно.';
}
echo'<div style="padding: 10 0 0 0px">
<hr>
Так же в будущем на этой странице будут возможности отстройки форта в части усиления защиты при штурме - бонусы на жизни, броню, удар...</div>';
