<?php
function locations($loc,$pos){
	if($loc != '28'){
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`, `loc`, `room`, `city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
		return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
	}
	else{
		list($x, $y) = explode('_', $pos);
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$x."' and `y`='".$y."' LIMIT 1;"));
		return $location['city']." [".(($location['name'])?$location['name']:'неизвестно')."]";
	}	
}
$clanid = $pers['clan_id'];
echo'
<SCRIPT src="/js/clan.js"></SCRIPT>
<table table border=0 cellpadding=0 cellspacing=0 bordercolor=#e0e0e0 align=center class="smallhead" width=100% bgcolor=#e0e0e0>
<tr><td colspan=9 class=nickname bgcolor=white>
<font class=nickname><b><a href="javascript:clan_private(\'' . $clanid . '\"";
$access = explode("|",$pers['clan_accesses']);
echo"clan_init(".$pers['id'].",".$sign['clan_sclon'].",'".$sign['clan_gif']."','".(in_array('2',$access)?vCode():'')."','".(in_array('4',$access)?vCode():'')."','".(in_array('8',$access)?vCode():'')."');\n";
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `clan_id` = '".$sign['clan_id']."' ORDER BY `level` DESC");
while($row = mysqli_fetch_assoc($query)){
	if($row['last']>time()-300){
		$useronline = '1';
	}else{
		$useronline = '0';
	}
	
	echo "clan_sostav(".$useronline.",'".$row['login']."',".$row['level'].",".$row['clan_status'].",'".$row['clan_d']."','".($useronline?locations($row["loc"],$row["pos"]):'')."',".$row['id'].",'".($row['fight']?$row['battle']:'')."');\n";	
}
?>
</SCRIPT>
</table>
</td></tr>
</table>
<?php
if(in_array('8',$access) or $pers['clan_status'] >= '8'){
echo'<form method="post">
  <font class="nickname">
  <hr size="1" color="#CCCCCC" />
  <b>Принять<br />
  <font color="#aa0000">Имя персонажа:</font></b></font>
  <input type="hidden" name="useaction" value="clan-action" />
  <input type="hidden" name="addid" value="1" />
  <input type="hidden" name="post_id" value="47" />
  <input type="hidden" name="clan_act" value="1" />
  <input type="hidden" name="vcode" value="'.vCode().'" />
  <input type="text" name="fnick" class="LogintextBox" />
  <input type="submit" class="lbut" value="Принять [ 1000 Бронзы ]" />
</form>';
}
?>