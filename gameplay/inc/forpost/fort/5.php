<?php
echo'���� ��� �������� <i>'.date('d.m.Y H:i:s',$Fort['owned_stamp']).'</i><br/>
��������� ����� �������� <b><i>'.($Fort['storm_stamp_changed'] || ($Fort['storm_stamp']-time()<172800) ? '������������' : '��������������').'</b> '.date('d.m.Y H:i:s',$Fort['storm_stamp']).'</i><br/>
������ �� ������� ����������� � ������� ���� �� ������ ���. ������ ��� ��������� �� ������ ������ ���������� <b>100 LR.</b><br/>
������ ���������� �� ������ ������: �����������<br/>';
if($Fort['storm_stamp']-time() < 3600 && time() < $Fort['storm_stamp']){
?>
<SCRIPT src="/js/clan.js"></SCRIPT>
<h3 style="padding: 20 0 0 0px">����������� ������ �� ������� � ������ �����. �� ������ ����������� �� ������� <?php echo (($Fort['clan'] == $player['clan_id']) ? '����������' : '���������' ); ?>.</h3>
<form method="post"><input type="hidden" name="cat" value="5"><input type="submit" name="storm_process" value="������� ������� � ������" class="lbut" onclick="return confirm('������� �� ������� ��������� ����� 100 LR. ��� ���������� ������� ���������.')"></form>

<div style="padding: 10 0 0 0px"></div>
<table width="100%" border="1" class="nickname">
	<tr>
		<td align="center" width="50%"><b>���������</b></td>
		<td align="center" width="50%"><b>���������</b></td>
	</tr>
	<tr>
		<td align="center"><?php
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `fort_storm`='1'");
if(mysqli_num_rows($Query) > 0){
	while($row = mysqli_fetch_assoc($Query)){
		echo'<a href="javascript:parent.say_private(\''.$row['login'].'\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;<script>document.write(sh_align('.$row['sklon'].',0)+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'","'.$row['clan_d'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].'/'.$row['u_lvl'].']<a href="ipers.php?'.$row['login'].'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a><br />';
	}
}else{
	echo"<i>���� ������...</i>";
}
		?></td>
		<td align="center"><?php
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `fort_storm`='2'");
if(mysqli_num_rows($Query) > 0){
	while($row = mysqli_fetch_assoc($Query)){
		echo'<a href="javascript:parent.say_private(\''.$row['login'].'\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;<script>document.write(sh_align('.$row['sklon'].',0)+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'","'.$row['clan_d'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].'/'.$row['u_lvl'].']<a href="ipers.php?'.$row['login'].'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a><br />';
	}
}else{
	echo"<i>���� ������...</i>";
}
		?></td>
	</tr>
</table>
<?php
}
?>
