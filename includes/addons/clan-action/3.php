<table cellpadding=0 cellspacing=0 border=0 align=center width=100%>
<tr><td><img src=/img/image/1x1.gif width=1 height=10><br></td></tr>
<tr><td>
<table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
<tr><td align=center><?=$msg; if($msg!=''){echo "<br>";}?>
        <input type=submit class=lbut title="all" value="Все вещи"
               onClick="location='?useaction=clan-action&addid=3&weapon_category=all'"/>
</td></tr>
<tr><td align=center>
        <input type=image src=/img/image/gameplay/shop/knife.gif
               onClick="location='?useaction=clan-action&addid=3&weapon_category=w4&fullinf=<?= $_GET['fullinf'] ?>'"
               title="Ножи" width=40 height=50><input type=image src=/img/image/gameplay/shop/sword.gif
                                                      onClick="location='?useaction=clan-action&addid=3&weapon_category=w1&fullinf=<?= $_GET['fullinf'] ?>'"
                                                      title="Мечи" width=40 height=50><input type=image
                                                                                             src=/img/image/gameplay/shop/axe.gif
                                                                                             onClick="location='?useaction=clan-action&addid=3&weapon_category=w2&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                             title="Топоры" width=40
                                                                                             height=50><input type=image
                                                                                                              src=/img/image/gameplay/shop/crushing.gif
                                                                                                              onClick="location='?useaction=clan-action&addid=3&weapon_category=w3&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                                              title="Дробящие"
                                                                                                              width=40
                                                                                                              height=50><input
                type=image src=/img/image/gameplay/shop/spears_helbeards.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w6&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Алебарды и копья" width=40 height=50><input type=image src=/img/image/gameplay/shop/missle.gif
                                                                   onClick="location='?useaction=clan-action&addid=3&weapon_category=w5&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                   title="Метательное" width=40 height=50><input
                type=image src=/img/image/gameplay/shop/wand.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w7&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Посохи" width=40 height=50><input type=image src=/img/image/gameplay/shop/shield.gif
                                                         onClick="location='?useaction=clan-action&addid=3&weapon_category=w20&fullinf=<?= $_GET['fullinf'] ?>'"
                                                         title="Щиты" width=40 height=50><input type=image
                                                                                                src=/img/image/gameplay/shop/helm.gif
                                                                                                onClick="location='?useaction=clan-action&addid=3&weapon_category=w23&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                                title="Шлемы" width=40
                                                                                                height=50><input
                type=image src=/img/image/gameplay/shop/belt.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w26&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Пояса" width=40 height=50><input type=image src=/img/image/gameplay/shop/armor_light.gif
                                                        onClick="location='?useaction=clan-action&addid=3&weapon_category=w18&fullinf=<?= $_GET['fullinf'] ?>'"
                                                        title="Кольчуги" width=40 height=50><input type=image
                                                                                                   src=/img/image/gameplay/shop/armor_hard.gif
                                                                                                   onClick="location='?useaction=clan-action&addid=3&weapon_category=w19&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                                   title="Доспехи"
                                                                                                   width=40
                                                                                                   height=50><input
                type=image src=/img/image/gameplay/shop/gloves.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w24&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Перчатки" width=40 height=50><input type=image src=/img/image/gameplay/shop/armlet.gif
                                                           onClick="location='?useaction=clan-action&addid=3&weapon_category=w80&fullinf=<?= $_GET['fullinf'] ?>'"
                                                           title="Наручи" width=40 height=50><input type=image
                                                                                                    src=/img/image/gameplay/shop/boots.gif
                                                                                                    onClick="location='?useaction=clan-action&addid=3&weapon_category=w21&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                                    title="Сапоги"
                                                                                                    width=40
                                                                                                    height=50><input
                type=image src=/img/image/gameplay/shop/amulet.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w25&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Кулоны" width=40 height=50><input type=image src=/img/image/gameplay/shop/ring.gif
                                                         onClick="location='?useaction=clan-action&addid=3&weapon_category=w22&fullinf=<?= $_GET['fullinf'] ?>'"
                                                         title="Кольца" width=40 height=50><input type=image
                                                                                                  src=/img/image/gameplay/shop/spaudler.gif
                                                                                                  onClick="location='?useaction=clan-action&addid=3&weapon_category=w28&fullinf=<?= $_GET['fullinf'] ?>'"
                                                                                                  title="Наплечники"
                                                                                                  width=40
                                                                                                  height=50><input
                type=image src=/img/image/gameplay/shop/knee_guard.gif
                onClick="location='?useaction=clan-action&addid=3&weapon_category=w90&fullinf=<?= $_GET['fullinf'] ?>'"
                title="Поножи" width=40 height=50><input type=image src=/img/image/gameplay/shop/zel.gif
                                                         onClick="location='?useaction=clan-action&addid=3&weapon_category=w0&fullinf=<?= $_GET['fullinf'] ?>'"
                                                         title="Зелья" width=40 height=50><input type=image
                                                                                                 src=/img/image/gameplay/invent/cat/b1.gif
                                                                                                 onClick="location='?useaction=clan-action&addid=3&weapon_category=<?= $_GET['weapon_category'] ?>&fullinf=<? if ($_GET['fullinf'] == 0) {
                                                                                                     echo 1;
                                                                                                 } else {
                                                                                                     echo 0;
                                                                                                 } ?>'"
                                                                                                 title="Полная/сокращенная информация о предметах"
                                                                                                 width=40 height=50>
</td></tr>
<tr><td></td></tr>
<tr><td>
<?
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
  
function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
        case 40:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>";
            break;
        case 70:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>";
            break;
        case 90:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>";
            break;
    	}
		}
}
if(isset($_GET['weapon_category'])){
echo'
<SCRIPT src="/js/clan.js"></SCRIPT>
<table table border=0 cellpadding=0 cellspacing=0 bordercolor=#e0e0e0 align=center class="smallhead" width=100% bgcolor=#e0e0e0 width=100%>
<tr><td colspan=10 class=nickname bgcolor=white><img src=/img/image/1x1.gif width=1 height=2></td></tr>
<tr><td colspan=10 bgcolor=#E0D6BB><img src=/img/image/1x1.gif width=1 height=1></td></tr>
<tr><td width=100% colspan=10>
<table border=0 cellpadding=2 cellspacing=1 bordercolor=red align=center class="smallhead" width=100%>
<tr align=center bgcolor=#EAEAEA>
	<td align=left class=nickname  width=50%>
		<font class=nickname align=left style="margin: 0px 0px 0px 20px;" color=gray>Вещь
	</font></td>
	<td align=left class=nickname width=30%>
		<font class=nickname align=left style="margin: 0px 0px 0px 20px;" color=gray>Персонаж
	</font></td>
	<td align=center class=nickname colspan=2 width=20%>
	<font class=nickname align=center color=gray>Опции
	</td>
</tr>
';
if($_GET['weapon_category']=='all'){
	$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT clan_kazna.*,items.* FROM items INNER JOIN clan_kazna ON items.id = clan_kazna.protype WHERE clan_id='".$pers['clan_id']."';");
}
else{
$val_weapon_category=varcheck($_GET['weapon_category']);
	$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT clan_kazna.*,items.* FROM items INNER JOIN clan_kazna ON items.id = clan_kazna.protype WHERE clan_id='".$pers['clan_id']."' AND items.type='".$val_weapon_category."';");
}
while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
	$ITEMID=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `id_item`='".$ITEM['id_item']."' LIMIT 1;"));
	if($ITEMID['id_item']){
	$itemuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT clan_kazna.*,user.* FROM user INNER JOIN clan_kazna ON user.id = clan_kazna.pl_id WHERE id_item='".$ITEM['id_item']."'"));
	$itemused = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM invent WHERE id_item='".$ITEM['id_item']."';"));
	if($itemuser['last']>time()-300){
		$useronline = '1';
	}else{
		$useronline = '0';
	}
	echo'<tr align=center height=1>';
if($_GET['fullinf']==1){
echo'<td bgcolor=#f9f9f9 align=center width=50%><font class=inv>';
include(DROOT."/includes/addons/clan-action/vall.php");
}
else{
if($ITEM['dd_price']>0){$art="weaponchart";}else{$art="weaponch";}
echo'
<td bgcolor=#f9f9f9 align=left width=50%><form method="post" align=left valign=middle name="RemoveItem">
<font class=' . $art . '  style="margin: 0px 0px 0px 20px;"><b>' . $ITEM['name'] . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=/img/chat/info.gif width=11 height=12 border=0></a></font><font class=weaponch>
';
if($pers['clan_status']==9 and $ITEM['dd_price']==0){
	if($itemused['used']==0){
		echo'
			<input type="hidden" name="useaction" value="clan-action" />
			<input type="hidden" name="idit" value="'.$ITEM['id_item'].'" />
			<input type="hidden" name="idpl" value="'.$ITEM['pl_id'].'" />
			<input type="hidden" name="idnewpl" value="'.$pers['id'].'" />
			<input type="hidden" name="post_id" value="15" />
			<input type="hidden" name="clan_act" value="3" />
			<input type="hidden" name="vcode" value="'.vCode().'" />
			<input type=image src=/img/image/del.gif  title="Удалить вещь из казны" onClick="javascript: document.RemoveItem.submit();"/>
		';
	}
}
echo'
</form><br>
</td>';
}	
		echo'
		<td bgcolor=#F5F5F5 align=left width=30% align=left><font class=inv style="margin: 0px 0px 0px 20px;"><b>' . $itemuser['login'] . '</b>&nbsp;[' . $itemuser['level'] . ']</font><a href="ipers.php?' . $itemuser['login'] . '" target=_blank><img src=/img/chat/info.gif width=11 height=12 border=0></a></td>
		<td bgcolor=#F5F5F5 align=center valign=middle width=10%>';
		$placcess = explode("|",$pers['clan_accesses']);
		$itemuseracc = explode("|",$itemuser['clan_accesses']);
		if($placcess[0]==1){
			if($itemuser['login']!=$pers['login']){
				if($useronline==0){
					if($itemused['used']==1){
						if($itemuseracc[1]==0 or $placcess[1]==2){
							echo'<form method="post" align=center valign=middle>
								<input type="hidden" name="useaction" value="clan-action" />
								<input type="hidden" name="idit" value="'.$ITEM['id_item'].'" />
								<input type="hidden" name="idpl" value="'.$ITEM['pl_id'].'" />
								<input type="hidden" name="post_id" value="13" />
								<input type="hidden" name="clan_act" value="3" />
								<input type="hidden" name="vcode" value="'.vCode().'" />
								<input type=submit class=klbut title="СНЯТЬ" value="СНЯТЬ" />
								</form>
								';
							} else {
                            echo '<b><a class="weaponchuse" href="#" title="Вы не можете снимать вещи с этого персонажа">СНЯТЬ</a></b>';
                        }
						} else {
                        echo '<b><a class="weaponchdis" href="#" title="Предмет не используется">СНЯТЬ</a></b>';
                    }
					} else {
                    echo '<b><a class="weaponchdis" href="#" title="Пользователь онлайн">СНЯТЬ</a></b>';
                }
			} else {
                echo '<b><a class="weaponchdis" href="#" title="Предмет уже у вас">СНЯТЬ</a></b>';
            }
        } else {
            echo '<b><a class=weaponchdis href="#" title="Не хватает прав">СНЯТЬ</a></b>';
        }
		echo '</td><td bgcolor=#F5F5F5 align=center valign=middle width=10%>';
		if($placcess[0]==1){
			if($itemuser['login']!=$pers['login']){
				if($itemused['used']==0){
					if($itemuseracc[1]==0 or $placcess[1]==2){
						echo'<form method="post" align=center valign=middle>
						<input type="hidden" name="useaction" value="clan-action" />
						<input type="hidden" name="idit" value="'.$ITEM['id_item'].'" />
						<input type="hidden" name="idpl" value="'.$ITEM['pl_id'].'" />
						<input type="hidden" name="idnewpl" value="'.$pers['id'].'" />
						<input type="hidden" name="post_id" value="14" />
						<input type="hidden" name="clan_act" value="3" />
						<input type="hidden" name="vcode" value="'.vCode().'" />
						<input type=submit class=klbut title="ЗАБРАТЬ" value="ЗАБРАТЬ"/>
						</form>
						';
					} else {
                        echo '<b><a class="weaponchuse" href="#" title="Вы не можете забирать вещи с этого персонажа">ЗАБРАТЬ</a></b>';
                    }
				} else {
                    echo '<b><a class="weaponchuse" href="#" title="Предмет используется">ЗАБРАТЬ</a></b>';
                }
			} else {
                echo '<b><a class="weaponchdis" href="#" title="Предмет уже у вас">ЗАБРАТЬ</a></b>';
            }
        } else {
            echo '<b><a class=weaponchdis href="#" title="Не хватает прав">ЗАБРАТЬ</a></b>';
        }
		
		echo'
		</td>
		</tr>';
		}
}
}
echo"</table></td></tr></table>";


function locations($loc,$pos){
    $pers = player();
	if($pers['loc'] != '28'){
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`, `loc`, `room`, `city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
	}
	return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
}
$clanid = $pers['clan_id'];
echo'
</td></tr>
</table>
';
?>
