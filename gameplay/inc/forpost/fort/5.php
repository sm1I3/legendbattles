<?php
echo'Форт был завоеван <i>'.date('d.m.Y H:i:s',$Fort['owned_stamp']).'</i><br/>
Следующий штурм назначен <b><i>'.($Fort['storm_stamp_changed'] || ($Fort['storm_stamp']-time()<172800) ? 'окончательно' : 'предварительно').'</b> '.date('d.m.Y H:i:s',$Fort['storm_stamp']).'</i><br/>
Заявки на участие принимаются в течении часа до начала боя. Ставка для атакующих на данный момент составляет <b>100 LR.</b><br/>
Бонусы защитников на данный момент: отсутствуют<br/>';
if($Fort['storm_stamp']-time() < 3600 && time() < $Fort['storm_stamp']){
?>
<SCRIPT src="/js/clan.js"></SCRIPT>
<h3 style="padding: 20 0 0 0px">Принимаются заявки на участие в штурме форта. Вы можете участвовать на стороне <?php echo (($Fort['clan'] == $player['clan_id']) ? 'защитников' : 'атакующих' ); ?>.</h3>
<form method="post"><input type="hidden" name="cat" value="5"><input type="submit" name="storm_process" value="Принять участие в штурме" class="lbut" onclick="return confirm('Участие на стороне атакующих стоит 100 LR. Для защитников участие бесплатно.')"></form>

<div style="padding: 10 0 0 0px"></div>
<table width="100%" border="1" class="nickname">
	<tr>
		<td align="center" width="50%"><b>Атакующие</b></td>
		<td align="center" width="50%"><b>Защитники</b></td>
	</tr>
	<tr>
		<td align="center"><?php
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `fort_storm`='1'");
if(mysqli_num_rows($Query) > 0){
	while($row = mysqli_fetch_assoc($Query)){
		echo'<a href="javascript:parent.say_private(\''.$row['login'].'\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;<script>document.write(sh_align('.$row['sklon'].',0)+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'","'.$row['clan_d'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].'/'.$row['u_lvl'].']<a href="ipers.php?'.$row['login'].'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a><br />';
	}
}else{
	echo"<i>пока никого...</i>";
}
		?></td>
		<td align="center"><?php
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `fort_storm`='2'");
if(mysqli_num_rows($Query) > 0){
	while($row = mysqli_fetch_assoc($Query)){
		echo'<a href="javascript:parent.say_private(\''.$row['login'].'\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;<script>document.write(sh_align('.$row['sklon'].',0)+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'","'.$row['clan_d'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].'/'.$row['u_lvl'].']<a href="ipers.php?'.$row['login'].'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a><br />';
	}
}else{
	echo"<i>пока никого...</i>";
}
		?></td>
	</tr>
</table>
<?php
}
?>
