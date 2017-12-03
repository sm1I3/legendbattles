<font class="nickname"><font color="#222222">
<div class="block info">
	<div class="header">
		<span>Документы Клана</span>
	</div>
  <table cellpadding="5" cellspacing="0" border="0" width="100%">
    <tr>
      <td><font class="freemain">
<?php
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clan_documents` WHERE `clan_id`='".$sign['clan_id']."' ORDER BY `date` DESC");
$result = '';
if(mysqli_num_rows($query)>0){
	$result .= (($msg)?'<center><font color="#FF0000">'.$msg.'</font></center><br />':'');
	while($row = mysqli_fetch_assoc($query)){
		$result .= '<font color="#3564A5"><b><font color="#dd0000">'.date("d.m.Y H:i:s",$row['date']).'</font> '.$row['title'].'</b>'.(($pers['clan_status'] == 9)?'&nbsp;<a href="?useaction=clan-action&addid=4&get_id=29&clan_act=3&doc_id='.$row['id'].'&vcode='.vCode().'"><img src="/img/image/del.gif" alt="Уничтожить документ" title="Уничтожить документ"></a>':'').'</font><br />'.$row['msg'].'<br /><br />';
	}
	echo substr($result,0,strlen($result)-6);
}else{
	echo'<center>Не найдено ни одного документа</center>';
}
?></font></td>
    </tr>
  </table>
</div>
</font></font>
<?php
if($pers['clan_status'] == 9){
echo'<form method="post" action=""><table cellpadding="0" cellspacing="0" width="400" align="center" border="0">
  <input type="hidden" name="post_id" value="16" />
  <input type="hidden" name="clan_act" value="1" />
  <input type="hidden" name="vcode" value="'.vCode().'" />
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>Создать документ</span>
	</div><table cellpadding="3" cellspacing="0" width="100%" border="0">
      <tr>
        <td><font class="freemain"><b><font color="#336699">Заголовок:</font></b></font></td>
        <td width="100%"><input type="text" name="doc_title" size="30" class="LogintextBox4" maxlength="255" value="" style="width:99%;" /></td>
      </tr>
      <tr>
        <td colspan="2"><font class="freemain"><b><font color="#336699">Сообщение: </font></b></font></td>
      </tr>
      <tr>
        <td colspan="2"><textarea class="LogintextBox6" cols="61" rows="10" name="doc_subj" style="width: 99%;"></textarea></td>
      </tr>
      <tr><td colspan="2" align="center"><input type="submit" class="lbut" value="Создать" />
</td></tr>
    </table></div></td>
  </tr>
</table></form>';
}
?>