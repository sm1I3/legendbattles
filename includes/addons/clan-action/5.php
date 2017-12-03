<?php
if  ($pers['pair_id']!='none'){

	function locations($loc,$pos){
		if($loc != '28'){
			$location = mysqil_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `loc`,`room`,`city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
		}elseif($loc == '28'){
			$pos = explode('_', $pos);
			$location = mysqil_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `city`,`name` FROM `nature` WHERE `x`='".$pos[0]."' AND `y`='".$pos[1]."' LIMIT 1;"));
			$location['room'] = $location['name'];
		}
		return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
	}
?>
<SCRIPT src="/js/signs.js"></SCRIPT>
<font class=nickname><font color=#222222>
<FIELDSET>
    <LEGEND align=center><B>Альянс</B></LEGEND>
  <table cellpadding=5 cellspacing=0 border=0 width=100%>
    <tr>
      <td><?php
      echo'<table cellpadding="0" cellspacing="2" width="600" align="center">
  <tbody>
';
$i = 0;
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `clan_id` = '".$sign['pair_id']."' ORDER BY `level` DESC");
$i++;
$bgcolor = (($i%2)?'f0f0f0':'ffffff');
while($row = mysqli_fetch_array($query)){
	if($row['last']>time()-300){
		$useronline = '1';
	}else{
		$useronline = '0';
	}
echo'    <tr>
      <td><font class="nickname"><a href="javascript:top.say_private(\''.$row['login'].'\')"><img src="/img/image/chat/private.gif" width="11" height="12" border="0" align="absmiddle"></a>&nbsp;<script>document.write(sh_align("'.$row['sklon'].'")+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].']<a href="ipers.php?'.$row['login'].'" target="_blank"><img src="/img/image/chat/info1.gif" width="11" height="12" border="0" align="absmiddle"></a></font></td>
      <td><font class="nickname">&nbsp;&nbsp;'.$row['clan_d'].'</b></font></td>
      <td nowrap=""><font class="hpfont">&nbsp;&nbsp;'.($useronline?locations($row["loc"],$row["pos"]):'').'</font></td>
    </tr>
';
}
echo'  </tbody>
</table>';
}else{
              echo "<center>У вас нет Альянса</center>";
 }	
	  ?></td>
    </tr>
  </table>
</FIELDSET>
</font></font>
