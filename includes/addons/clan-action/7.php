<?php
	if($sign['pair_id'] == 'c8' or $sign['pair_id'] == 'c10'){
		$sign['pair_id'] = 'none';
	}
$GetClanItems = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE 
(`cl_id` = '".$sign['clan_id']."'".(($sign['pair_id']!='none')?" or `cl_id` = '".$sign['pair_id']."'":'').")
".(($_GET["wca"])?" and `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["wca"])."'":"").";");

$GetYouItems = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE 
`pl_id` = '".$pers['id']."' and 
`items`.`droptype`='0' and 
`used` = '0' and 
`cl_id` = ''
".(($_GET["wca"])?" and `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["wca"])."'":"").";");

echo'<SCRIPT src="./js/clan_items.js"></SCRIPT><table cellpadding="3" cellspacing="2" border="0" width="100%">
  <tr>
    <td colspan="5" bgcolor="#E3EDEF"><font class="freemain"><font color="#3564A5"><b>
      <div align="center">СПИСОК ВЕЩЕЙ КЛАНА</div>
    </b></font></font></td>
  </tr>';
$access = explode("|",$pers['clan_accesses']);
if(mysqli_num_rows($GetClanItems)>0 and in_array('1',$access)){
	echo'<tr><td bgcolor=#D8CDAF><div align=center><font class=invtitle>название вещи</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>у кого</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>износ</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>статус</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>действия</font></div></td></tr>';
	$i = 0;
	while($ShowItems = mysqli_fetch_assoc($GetClanItems)){
		$i++;
		$bgcolor = (($i%2)?'f0f0f0':'ffffff');
		$WhoItem = GetUserFID($ShowItems['pl_id'],1);
		echo'<tr><td bgcolor=#'.$bgcolor.'><font class=nickname>'.$i.'. <b style="cursor:default;" onmouseover="tooltip(this,ShowInfo(\''.$ShowItems['ItemName'].'\',\''.$ShowItems['img'].'\',\''.$ShowItems['price'].'\',\''.$ShowItems['slot'].'\',\''.$ShowItems['block'].'\',\''.$ShowItems['hand'].'\',\''.preg_replace('/@/',':',$ShowItems['i_param']).'\',\''.preg_replace('/@/',':',$ShowItems['i_need']).'\',\''.$ShowItems['massa'].'\',\''.$ShowItems['level'].'\'))" onmouseout="hide_info(this)">'.$ShowItems['ItemName'].'</b></font></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>'.$WhoItem['login'].'</b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>Долговечность:</b> '.(($ShowItems['dolg'])?($ShowItems['dolg']-$ShowItems['iznos']).'/'.$ShowItems['dolg']:'вечная').'</font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>'.(($ShowItems['used'])?'<font color=#dd0000>занят</font>':'<font color=#00A80C>свободен</font>').'</b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center>'.(($ShowItems['used'])?(($WhoItem['last']<(time()-300))?((in_array('2',$access))?'<input type=button class=invbut onClick="location=\'?get_id=29&uid='.$ShowItems['id_item'].'&plid='.$ShowItems['pl_id'].'&vcode='.vCode().'&clan_act=5&useaction=clan-action&addid=3'.(($_GET["wca"])?'&wca='.preg_replace('/[^w0-9]/','',$_GET["wca"]):'').'\'"  value="Снять вещь">':'&nbsp;'):'&nbsp;'):(($ShowItems['pl_id']!=$pers['id'])?'<input type=button class=invbut onClick="location=\'?get_id=29&uid='.$ShowItems['id_item'].'&plid='.$ShowItems['pl_id'].'&vcode='.vCode().'&clan_act=4&useaction=clan-action&addid=3'.(($_GET["wca"])?'&wca='.preg_replace('/[^w0-9]/','',$_GET["wca"]):'').'\'" value="Взять из казны">':'&nbsp;')).'</div></td></tr>';	
	}
}else{
	if(!in_array('1',$access)){
		echo'<tr><td colspan="5"><div align="center"><font class="nickname"><font color="#dd0000"><b>Нет доступа к казне</b></font></font></div></td></tr>';
	}else{
		echo'<tr><td colspan="5"><div align="center"><font class="nickname"><font color="#dd0000"><b>Нет доступных вещей</b></font></font></div></td></tr>';
	}
}
echo'<tr>
    <td colspan="5" bgcolor="#E3EDEF"><font class="freemain"><font color="#3564A5"><b>
      <div align="center">СПИСОК ВАШИХ ВЕЩЕЙ</div>
    </b></font></font></td>
  </tr>';
$i = 0;
while($ShowItems = mysqli_fetch_assoc($GetYouItems)){
	$i++;
	$bgcolor = (($i%2)?'f0f0f0':'ffffff');
	if($_SESSION['user'][inv]!=''){$sq="and `type`='".$_SESSION['user']['inv']."'";}else{$sq='';}
	echo'<tr><td bgcolor=#'.$bgcolor.'><font class=nickname><b style="cursor:default;" onmouseover="tooltip(this,ShowInfo(\''.$ShowItems['ItemName'].'\',\''.$ShowItems['img'].'\',\''.$ShowItems['price'].'\',\''.$ShowItems['slot'].'\',\''.$ShowItems['block'].'\',\''.$ShowItems['hand'].'\',\''.preg_replace('/@/',':',$ShowItems['i_param']).'\',\''.preg_replace('/@/',':',$ShowItems['i_need']).'\',\''.$ShowItems['massa'].'\',\''.$ShowItems['level'].'\'))" onmouseout="hide_info(this)">'.$ShowItems['ItemName'].'</b></font></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>'.GetUserFID($ShowItems['pl_id']).'</b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>Долговечность:</b> '.(($ShowItems['dolg'])?($ShowItems['dolg']-$ShowItems['iznos']).'/'.$ShowItems['dolg']:'вечная').'</font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b><font color=#00A80C>свободен</font></b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><input type=button class=invbut onClick="location=\'?get_id=18&uid='.$ShowItems['id_item'].'&vcode='.vCode().'&useaction=clan-action&addid=3'.(($_GET["wca"])?'&wca='.preg_replace('/[^w0-9]/','',$_GET["wca"]):'').'\'" value="Пожертвовать"></div></td></tr>';	
}
?>