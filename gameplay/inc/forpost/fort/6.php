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
echo'��������� ����� �������� �� <b>'.date('d.m.Y H:i',$Fort['storm_stamp']).'</b>.';
if(!$Fort['storm_stamp_changed'] and ($Fort['storm_stamp']-time() > 172800)){
	echo'��� � ���� ����� �������:
<form method="post">
<input type="radio" name="day" value="less" class="check"><i>�� ���� ������</i> - ���������<br/>
<input type="radio" name="day" value="more" class="check"><i>�� ���� �����</i> - ���������<br/>
<hr>
'.((date('H',$Fort['storm_stamp'])!='12') ? '<input type="radio" name="time" value="12" class="check"><i>� 12 �����</i> - 500 LR.<br/>' : '' ).'
'.((date('H',$Fort['storm_stamp'])!='17') ? '<input type="radio" name="time" value="17" class="check"><i>� 17 �����</i> - 500 LR.<br/>' : '' ).'
'.((date('H',$Fort['storm_stamp'])!='22') ? '<input type="radio" name="time" value="22" class="check"><i>� 22 ����</i> - 500 LR.<br/>' : '' ).'
<input type="submit" name="change_storm" value="�������� ����/�����" onclick="return confirm(\'��������! ������ ���� � ����� ����������� ������ ����� ������ ���� ���! ����� ������??\')" class="lbut">
</form>';
}else{
	echo'��������� ���� � ������� ������ ������ ����������.';
}
echo'<div style="padding: 10 0 0 0px">
<hr>
��� �� � ������� �� ���� �������� ����� ����������� ��������� ����� � ����� �������� ������ ��� ������ - ������ �� �����, �����, ����...</div>';
