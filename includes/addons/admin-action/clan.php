<SCRIPT src="./js/nl_stooltip.js?v11"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="/js/signs.js"></SCRIPT>
<div id="tooltip"></div>
<?php
if(accesses($pers['id'],'clans')){
	function sclonch($id){
		$sclon=array("0","darks.gif","lights.gif","sumers.gif","chaoss.gif","light.gif","dark.gif","sumer.gif","chaos.gif","angel.gif");
		$desc=array("0","Дети Тьмы","Дети Света","Дети Сумерек","Дети Хаоса","Истинный Свет","Истинная Тьма","Нейтральные Сумерки","Абсолютный Хаос","Ангел");
		if($id!='0'){
			return "<img src=http://img.legendbattles.ru/image/signs/".$sclon[$id]." width=15 height=12 border=0 align=absmiddle title='".$desc[$id]."'> ";
		}
	}
	function locations($loc,$pos){
		if($loc != '28'){
			$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `loc`,`room`,`city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
		}elseif($loc == '28'){
			$pos = explode('_', $pos);
			$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `city`,`name` FROM `nature` WHERE `x`='".$pos[0]."' AND `y`='".$pos[1]."' LIMIT 1;"));
			$location['room'] = $location['name'];
		}
		return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
	}
	if(empty($_GET['menu'])){
	if(!empty($_POST)){
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `clans` (`clan_id`, `clan_sclon`, `clan_gif`, `clan_name`) VALUES ('".preg_replace('/[^c0-9]/','',$_POST['clan_id'])."', '".intval($_POST['clan_sclon'])."', '".preg_replace('/[^c0-9]/','',$_POST['clan_id']).".gif', '".preg_replace('/[^0-9a-zA-Zа-яА-Я_ -=]/','',$_POST['clan_name'])."');");
		
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan`='".preg_replace('/[^0-9a-zA-Zа-яА-Я_ -=]/','',$_POST['clan_name'])."',`clan_id`='".preg_replace('/[^c0-9]/','',$_POST['clan_id'])."',`clan_gif`='".preg_replace('/[^c0-9]/','',$_POST['clan_id']).".gif',`sklon`='".intval($_POST['clan_sclon'])."',`clan_d`='Глава клана',`clan_accesses`='1|2|4|8',`clan_status`='9' WHERE `login`='".preg_replace('/[^0-9a-zA-Zа-яА-Я_ -=]/','',$_POST['glav_name'])."'");
	}
	$cl = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans`");
	echo'<table cellpadding="3" cellspacing="2" border="0" width="100%">';
	$i = 1;
	echo'<tr><td bgcolor=#D8CDAF align=center>&nbsp;</td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>Клан</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>Состав</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>Казна</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>Документы</font></div></td></tr>';
	$i = 0;
	while($c = mysqli_fetch_assoc($cl)){
		$i++;
		$bgcolor = (($i%2)?'f0f0f0':'ffffff');
		echo'<tr><td bgcolor=#'.$bgcolor.' align=center><font class=nickname><b>'.$i.'</b></font></td><td bgcolor=#'.$bgcolor.'><font class=weaponch><b>'.sclonch($c["clan_sclon"]).'<img src=http://img.legendbattles.ru/image/signs/'.$c["clan_gif"].'> '.$c["clan_name"].'</b> [ <b>'.$c['clan_gif'].'</b> ]</font></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><a href="?useaction=admin-action&addid=clan&menu=list&clanid='.$c['clan_gif'].'">Состав</a></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid='.$c['clan_gif'].'">Казна</a></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><a href="?useaction=admin-action&addid=clan&menu=docs&clanid='.$c['clan_gif'].'">Документы</a></font></div></td></tr>';	
	}
	echo'</table>';
echo'<form method="post" action="">
  <table cellpadding="3" cellspacing="1" width="70%" border="0" style="background:#D8CDAF;" align="center">
    <tr>
      <td bgcolor="#D8CDAF" colspan="2"><div align=center><font class=invtitle>Регистрация клана</font></div></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3"><font class=weaponch><b>ID Клана:</b></font></td>
      <td bgcolor="#FCFAF3"><input type="text" name="clan_id" class="lbut" /></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3"><font class=weaponch><b>Имя Клана:</b></font></td>
      <td bgcolor="#FCFAF3"><input type="text" name="clan_name" class="lbut" /></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3"><font class=weaponch><b>Склонность клана:</b></font></td>
      <td bgcolor="#FCFAF3"><select name="clan_sclon" class="lbut">
        <option value="0">Без склоности</option>
        <option value="1">Дети Тьмы</option>
        <option value="2">Дети Света</option>
        <option value="3">Дети Сумерек</option>
        <option value="4">Дети Хаоса</option>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3"><font class=weaponch><b>Глава клана:</b></font></td>
      <td bgcolor="#FCFAF3"><input type="text" name="glav_name" class="lbut" /></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3" align="center" colspan="2"><input type="submit" class="lbut" value="Регистрация" /></td>
    </tr>
  </table>
</form>';
	}elseif($_GET['menu']=='list'){
	echo'<table cellpadding="0" cellspacing="2" width="80%" align="center">
  <tbody>
';
$i = 0;
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `clan_gif` = '".preg_replace('/[^a-zA-Z0-9.]/','',$_GET['clanid'])."' ORDER BY `level` DESC");
$i++;
$bgcolor = (($i%2)?'f0f0f0':'ffffff');
while($row = mysqli_fetch_assoc($query)){
	if($row['last']>time()-300){
		$useronline = '1';
	}else{
		$useronline = '0';
	}
echo'    <tr>
      <td><font class="nickname"><a href="javascript:parent.say_private(\''.$row['login'].'\')"><img src="http://img.legendbattles.ru/image/chat/private.gif" width="11" height="12" border="0" align="absmiddle"></a>&nbsp;<script>document.write(sh_align("'.$row['sklon'].'")+sh_sign("'.$row['clan_gif'].'","'.$row['clan'].'"));</script> <b>'.$row['login'].'</b>['.$row['level'].']<a href="ipers.php?'.$row['login'].'" target="_blank"><img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a></font></td>
      <td><font class="nickname">&nbsp;&nbsp;'.$row['clan_d'].'</b></font></td>
      <td nowrap=""><font class="hpfont">&nbsp;&nbsp;'.($useronline?locations($row["loc"],$row["pos"]):'').'</font></td>
    </tr>
';
}
echo'  </tbody>
</table>';	
	}elseif($_GET['menu']=='kazna'){
		$GetClanItems = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE 
`cl_id` = '".preg_replace('/[^a-zA-Z0-9]/','',$_GET['clanid'])."'
".(($_GET["wca"])?" and `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["wca"])."'":"").";");

echo'<SCRIPT src="./js/clan_items.js"></SCRIPT><table cellpadding="3" cellspacing="2" border="0" width="100%">
  <tr>
    <td colspan="5"><div align="center"><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w4"><img src="http://image.neverlands.ru/gameplay/invent/cat/0.gif" width="44" height="53" alt="Ножи" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w1"><img src="http://image.neverlands.ru/gameplay/invent/cat/1.gif" width="41" height="53" alt="Мечи" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w2"><img src="http://image.neverlands.ru/gameplay/invent/cat/2.gif" width="41" height="53" alt="Топоры" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w3"><img src="http://image.neverlands.ru/gameplay/invent/cat/3.gif" width="41" height="53" alt="Дробящие" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w6"><img src="http://image.neverlands.ru/gameplay/invent/cat/4.gif" width="41" height="53" alt="Алебарды и копья" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w7"><img src="http://image.neverlands.ru/gameplay/invent/cat/6.gif" width="41" height="53" alt="Посохи" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w20"><img src="http://image.neverlands.ru/gameplay/invent/cat/7.gif" width="41" height="53" alt="Щиты" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w18"><img src="http://image.neverlands.ru/gameplay/invent/cat/10.gif" width="41" height="53" alt="Кольчуги" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w19"><img src="http://image.neverlands.ru/gameplay/invent/cat/11.gif" width="41" height="53" alt="Доспехи" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w23"><img src="http://image.neverlands.ru/gameplay/invent/cat/8.gif" width="41" height="53" alt="Шлемы" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w21"><img src="http://image.neverlands.ru/gameplay/invent/cat/14.gif" width="41" height="53" alt="Сапоги" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w26"><img src="http://image.neverlands.ru/gameplay/invent/cat/9i.gif" width="44" height="53" alt="Пояса" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w24"><img src="http://image.neverlands.ru/gameplay/invent/cat/12.gif" width="41" height="53" alt="Перчатки" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w80"><img src="http://image.neverlands.ru/gameplay/invent/cat/13.gif" width="41" height="53" alt="Наручи" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w25"><img src="http://image.neverlands.ru/gameplay/invent/cat/15.gif" width="41" height="53" alt="Кулоны" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w22"><img src="http://image.neverlands.ru/gameplay/invent/cat/16.gif" width="41" height="53" alt="Кольца" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w28"><img src="http://image.neverlands.ru/gameplay/invent/cat/17.gif" width="41" height="53" alt="Свитки" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w27"><img src="http://image.neverlands.ru/gameplay/invent/cat/21.gif" width="41" height="53" alt="Зелья" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=clan&menu=kazna&clanid=chaos&?wca=w85"><img src="http://image.neverlands.ru/gameplay/invent/cat/85.gif" width="41" height="53" alt="Сумки лекаря" class="cath" border="0" /></a><a href="?wfo=1"><img src="http://image.neverlands.ru/gameplay/invent/cat/b3.gif" width="41" height="53" alt="Сбросить фильтр" class="cath" border="0" /></a></div></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#E3EDEF"><font class="freemain"><font color="#3564A5"><b>
      <div align="center">СПИСОК ВЕЩЕЙ КЛАНА</div>
    </b></font></font></td>
  </tr>';
$access = explode("|",$pers['clan_accesses']);
if(mysqli_num_rows($GetClanItems)>0){
	echo'<tr><td bgcolor=#D8CDAF><div align=center><font class=invtitle>название вещи</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>у кого</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>износ</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>статус</font></div></td><td bgcolor=#D8CDAF><div align=center><font class=invtitle>действия</font></div></td></tr>';
	$i = 0;
	while($ShowItems = mysqli_fetch_assoc($GetClanItems)){
		$i++;
		$bgcolor = (($i%2)?'f0f0f0':'ffffff');
		$WhoItem = GetUserFID($ShowItems['pl_id'],1);
		echo'<tr><td bgcolor=#'.$bgcolor.'><font class=nickname>'.$i.'. <b style="cursor:default;" onmouseover="tooltip(this,ShowInfo(\''.$ShowItems['ItemName'].'\',\''.$ShowItems['img'].'\',\''.$ShowItems['price'].'\',\''.$ShowItems['slot'].'\',\''.$ShowItems['block'].'\',\''.$ShowItems['hand'].'\',\''.preg_replace('/@/',':',$ShowItems['i_param']).'\',\''.preg_replace('/@/',':',$ShowItems['i_need']).'\',\''.$ShowItems['massa'].'\',\''.$ShowItems['level'].'\'))" onmouseout="hide_info(this)">'.$ShowItems['ItemName'].'</b></font></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>'.$WhoItem['login'].'</b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>Долговечность:</b> '.(($ShowItems['dolg'])?($ShowItems['dolg']-$ShowItems['iznos']).'/'.$ShowItems['dolg']:'вечная').'</font></div></td><td bgcolor=#'.$bgcolor.'><div align=center><font class=weaponch><b>'.(($ShowItems['used'])?'<font color=#dd0000>занят</font>':'<font color=#00A80C>свободен</font>').'</b></font></div></td><td bgcolor=#'.$bgcolor.'><div align=center>'.(($ShowItems['used'])?(($WhoItem['last']<(time()-300))?'<input type=button class=invbut onClick="location=\'?get_id=29&uid='.$ShowItems['id_item'].'&plid='.$ShowItems['pl_id'].'&vcode='.vCode().'&clan_act=5&useaction=clan-action&addid=3'.(($_GET["wca"])?'&wca='.preg_replace('/[^w0-9]/','',$_GET["wca"]):'').'\'"  value="Снять">':'&nbsp;'):'').(($ShowItems['used']==0)?'<input type=button class=invbut onClick="location=\'?get_id=29&uid='.$ShowItems['id_item'].'&plid='.$ShowItems['pl_id'].'&vcode='.vCode().'&clan_act=5&useaction=clan-action&addid=3'.(($_GET["wca"])?'&wca='.preg_replace('/[^w0-9]/','',$_GET["wca"]):'').'\'"  value="Удалить">':'').'</div></td></tr>';	
	}
}else{
	echo'<tr><td colspan="5"><div align="center"><font class="nickname"><font color="#dd0000"><b>Нет доступных вещей</b></font></font></div></td></tr>';
}

echo'</table>';
	}
}else{
	echo"<center><b>Нет Доступа</b></center>";	
}

?>
