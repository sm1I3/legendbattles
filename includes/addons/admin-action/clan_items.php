<? session_start();session_register('filter');?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<SCRIPT src="../../../js/jquery.min.js"></SCRIPT>
<SCRIPT src="../../../js/FormUp_v01.js"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
				<script>
					showELE = function(e){
						parent.$("#main_top").contents().find(".options").show(1);
                        parent.$("#main_top").contents().find("#optionsdiv").html('<input type=button class=lbut onClick="hideELE(\'options\');" value="Скрыть Доп.Настройки">');
					}
					hideELE = function(e){
						parent.$("#main_top").contents().find(".options").hide(1);
                        parent.$("#main_top").contents().find("#optionsdiv").html('<input type=button class=lbut onClick="showELE(\'options\');" value="Доп.Настройки">');
					}
				</script>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='clan_items.php'" value="обновить">
	</td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
	$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
	$$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
	$$keyses = $vals;
}
db_open();
$player=player();
if($_GET['clan']){
	$_POST['clan']=$_GET['clan'];
}
## выгоняем из клана
if($_GET['get_id'] == '29' and in_array($_GET['vcode'],$_SESSION['secur'])){
	$_GET['plid'] = intval($_GET['plid']);
	$cuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`clan_id`,`login`,`level` FROM `user` WHERE `id`='".$_GET['plid']."'"));
	if($_GET['clan_act'] == '2' and $cuser['id']){
		$_POST['clan'] = $cuser['clan_id'];
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan`='0',`clan_id`='none',`clan_gif`='',`sklon`='0',`clan_d`='',`clan_accesses`='0' WHERE `id`='".$cuser['id']."'");
	}
}
##

## принимаем в клан
if($_POST['post_id']=='47' and in_array($_POST['vcode'],$_SESSION['secur'])){
	$cuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`clan_id`,`clan_check`,`login`,`level` FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_POST['fnick'])."'"));
	$clan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans` WHERE `clan_id` = '".$_POST['clan']."'"));
	$warn = '0';
	if($warn == 0 and $clan['clan_id']){
		mysqli_query($GLOBALS['db_link'],"DELETE FROM `verification` WHERE `uid` = '".$cuser['id']."' LIMIT 1;");	
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan`='".$clan['clan_name']."',`clan_id`='".$clan['clan_id']."',`clan_gif`='".$clan['clan_gif']."',`sklon`='".$clan['clan_sclon']."',`clan_check`='0',`clan_status`='0' WHERE `id`='".$cuser['id']."'");
	}
}
##

## создаем клан перед запросом на кланы
if($_GET['addclan']==1){
	if($_POST['clan_name']){
		if($_POST['clan_image']){
			$str = "INSERT INTO `clans` (`clan_id`,`clan_name`,`clan_gif`,`clan_sclon`) VALUES ('".$_POST['clan_name']."','".$_POST['clan_name']."','".$_POST['clan_image']."','".($_POST['clan_sklon']?$_POST['clan_sklon']:0)."')";
			mysqli_query($GLOBALS['db_link'],$str);
			echo'
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=center><td>
			<font class=proceg><b>Клан создан!</b>
			<br><b>Имя:</b> ' . $_POST['clan_name'] . '
			<br><b>Склонность:</b>';
			switch($_POST['clan_sklon']){
				case 0: echo "<img src='http://img.legendbattles.ru/image/signs/1x1.gif' width=15 height=12 align=absmiddle border=0>";break;
                case 1:
                    echo "<img src='http://img.legendbattles.ru/image/signs/darks.gif' width='15' height='12' title='Дети Тьмы' align='absmiddle'/>";
                    break;
                case 2:
                    echo "<img src='http://img.legendbattles.ru/image/signs/lights.gif' width='15' height='12' title='Дети Света' align='absmiddle'/>";
                    break;
                case 3:
                    echo "<img src='http://img.legendbattles.ru/image/signs/sumers.gif' width='15' height='12' title='Дети Сумерек' align='absmiddle'/>";
                    break;
                case 4:
                    echo "<img src='http://img.legendbattles.ru/image/signs/chaoss.gif' width='15' height='12' title='Дети Хаоса' align='absmiddle'/>";
                    break;
                case 5:
                    echo "<img src='http://img.legendbattles.ru/image/signs/light.gif' width='15' height='12' title='Истинный Свет' align='absmiddle'/>";
                    break;
                case 6:
                    echo "<img src='http://img.legendbattles.ru/image/signs/dark.gif' width='15' height='12' title='Истинная Тьма' align='absmiddle'/>";
                    break;
                case 7:
                    echo "<img src='http://img.legendbattles.ru/image/signs/sumer.gif' width='15' height='12' title='Нейтральные Сумерки' align='absmiddle'/>";
                    break;
                case 8:
                    echo "<img src='http://img.legendbattles.ru/image/signs/chaos.gif' width='15' height='12' title='Абсолютный Хаос' align='absmiddle'/>";
                    break;
                case 9:
                    echo "<img src='http://img.legendbattles.ru/image/signs/angel.gif' width='15' height='12' title='Ангел' align='absmiddle'/>";
                    break;
			}
            echo "<br><b>Иконка:</b> <img src='http://img.legendbattles.ru/image/signs/" . $_POST['clan_image'] . "' width='15' height='12' title='" . $_POST['clan_image'] . "' align='absmiddle'/>
			</font></td></tr></table>";
        } else {
            echo '<font class=proce><b>Клан не создан - не задана иконка клана!</b></font>';
        }
    } else {
        echo '<font class=proce><b>Клан не создан - не задано имя!</b></font>';
    }
}elseif($_GET['addclan']==2){
		if($_POST['clan']!='' and $_POST['clan']!='none'){
			$str = "UPDATE `clans` SET `clan_id`='".$_POST['clan_name']."',`clan_name`='".$_POST['clan_name']."',`clan_gif`='".$_POST['clan_image']."',`clan_sclon`='".($_POST['clan_sklon']?$_POST['clan_sklon']:'0')."' WHERE `clan_id`='".$_POST['clan']."';";
			mysqli_query($GLOBALS['db_link'],$str);
			$str = "UPDATE `user` SET `clan`='".$_POST['clan_name']."',`clan_id`='".$_POST['clan_name']."',`clan_gif`='".$_POST['clan_image']."',`sklon`='".($_POST['clan_sklon']?$_POST['clan_sklon']:'0')."' WHERE `clan_id`='".$_POST['clan']."' and `clan`='".$_POST['clan']."';";
			mysqli_query($GLOBALS['db_link'],$str);
			$_POST['clan']=$_POST['clan_name'];
		}
}
##

$clans=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans`;");
echo '
<form method="post" action="clan_items.php?add=1&weapon_category=none&vision=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=clan>
<option value="0" ' . (($_POST['clan'] != '0' and $_POST['clan'] != '') ? '' : 'selected=selected') . '>Выберите клан</option>
';
while($clan = mysqli_fetch_assoc($clans)){
	echo '<option value="'.$clan['clan_id'].'" '.(($_POST['clan']==$clan['clan_id'])?'selected=selected':'').'>'.$clan['clan_name'].'</option>';
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
## создаем клан

echo '
<form method="post" action="clan_items.php?createclan=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<input class=lbut type=submit value="Создать">
</td></tr>
</table>
</form>
';


if($_GET['createclan']==1){
		echo'
		<form method="post" action="clan_items.php?addclan=1">
		<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>Название клана</b></td>
					<td align=center><b>Склонность клана</b></td>
					<td align=center><b>Иконка клана</b></td>
				</tr>
				<tr class=freetxt bgcolor=white>
					<td align=center width=30%>
						Имя: <input type=text class=logintextbox name="clan_name" value="" />
					</td>
					<td align=left>
						<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
						';
						$tr=0;
						for($i=0;$i<=9;$i++){
							if($tr==0){echo '<tr>';}
							$tr++;
								switch($i){
                                    case 0:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " checked />нет</td>";
                                        break;
                                    case 1:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Дети Тьмы <img src='http://img.legendbattles.ru/image/signs/darks.gif' width='15' height='12' title='Дети Тьмы' align='absmiddle'/></td>";
                                        break;
                                    case 2:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Дети Света <img src='http://img.legendbattles.ru/image/signs/lights.gif' width='15' height='12' title='Дети Света' align='absmiddle'/></td>";
                                        break;
                                    case 3:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Дети Сумерек <img src='http://img.legendbattles.ru/image/signs/sumers.gif' width='15' height='12' title='Дети Сумерек' align='absmiddle'/></td>";
                                        break;
                                    case 4:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Дети Хаоса <img src='http://img.legendbattles.ru/image/signs/chaoss.gif' width='15' height='12' title='Дети Хаоса' align='absmiddle'/></td>";
                                        break;
                                    case 5:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Истинный Свет <img src='http://img.legendbattles.ru/image/signs/light.gif' width='15' height='12' title='Истинный Свет' align='absmiddle'/></td>";
                                        break;
                                    case 6:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Истинная Тьма <img src='http://img.legendbattles.ru/image/signs/dark.gif' width='15' height='12' title='Истинная Тьма' align='absmiddle'/></td>";
                                        break;
                                    case 7:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Нейтральные Сумерки <img src='http://img.legendbattles.ru/image/signs/sumer.gif' width='15' height='12' title='Нейтральные Сумерки' align='absmiddle'/></td>";
                                        break;
                                    case 8:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Абсолютный Хаос <img src='http://img.legendbattles.ru/image/signs/chaos.gif' width='15' height='12' title='Абсолютный Хаос' align='absmiddle'/></td>";
                                        break;
                                    case 9:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " />Ангел <img src='http://img.legendbattles.ru/image/signs/angel.gif' width='15' height='12' title='Ангел' align='absmiddle'/></td>";
                                        break;
								}
							if($tr==2){echo '</tr>';$tr=0;}	
						}
					echo'</table>	
					</td>
					<td align=center>
						<b>Иконка:</b><input type=text class=logintextbox6 name="clan_image" value="" />
						<br>Сначала заливаем сюда:<br> <b>http://img.legendbattles.ru/image/signs/</b><br> а в поле пишем название.
					</td>
				</tr>
				<tr align=center><td colspan=3>
					<input class=lbut type=submit value="Создать">
				</td></tr>
				</table</form></td></tr></table>
				';
				

}
##
if($_POST['clan']){
$sign = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans` WHERE `clan_id` = '".$_POST['clan']."'"));
echo'
		<br><div align=center name="optionsdiv" id="optionsdiv"><input type=button class=lbut onClick="showELE(\'options\');" value="Доп.Настройки"></div>
		<form method="post" action="clan_items.php?addclan=2&clan='.$_POST['clan'].'" >
		<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center class="options">
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>Название клана</b></td>
					<td align=center><b>Склонность клана</b></td>
					<td align=center><b>Иконка клана</b></td>
				</tr>
				<tr class=freetxt bgcolor=white>
					<td align=center width=30%>
						Имя: <input type=text class=logintextbox name="clan_name" value="' . $sign['clan_id'] . '" />
					</td>
					<td align=left>
						<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
						';
						$tr=0;
						for($i=0;$i<=9;$i++){
							if($tr==0){echo '<tr>';}
							$tr++;
								switch($i){
                                    case 0:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />нет</td>";
                                        break;
                                    case 1:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Дети Тьмы <img src='http://img.legendbattles.ru/image/signs/darks.gif' width='15' height='12' title='Дети Тьмы' align='absmiddle'/></td>";
                                        break;
                                    case 2:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Дети Света <img src='http://img.legendbattles.ru/image/signs/lights.gif' width='15' height='12' title='Дети Света' align='absmiddle'/></td>";
                                        break;
                                    case 3:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Дети Сумерек <img src='http://img.legendbattles.ru/image/signs/sumers.gif' width='15' height='12' title='Дети Сумерек' align='absmiddle'/></td>";
                                        break;
                                    case 4:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Дети Хаоса <img src='http://img.legendbattles.ru/image/signs/chaoss.gif' width='15' height='12' title='Дети Хаоса' align='absmiddle'/></td>";
                                        break;
                                    case 5:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Истинный Свет <img src='http://img.legendbattles.ru/image/signs/light.gif' width='15' height='12' title='Истинный Свет' align='absmiddle'/></td>";
                                        break;
                                    case 6:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Истинная Тьма <img src='http://img.legendbattles.ru/image/signs/dark.gif' width='15' height='12' title='Истинная Тьма' align='absmiddle'/></td>";
                                        break;
                                    case 7:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Нейтральные Сумерки <img src='http://img.legendbattles.ru/image/signs/sumer.gif' width='15' height='12' title='Нейтральные Сумерки' align='absmiddle'/></td>";
                                        break;
                                    case 8:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Абсолютный Хаос <img src='http://img.legendbattles.ru/image/signs/chaos.gif' width='15' height='12' title='Абсолютный Хаос' align='absmiddle'/></td>";
                                        break;
                                    case 9:
                                        echo "<td><input type=radio name=clan_sklon value=" . $i . " " . ($sign['clan_sclon'] == $i ? 'checked' : '') . " />Ангел <img src='http://img.legendbattles.ru/image/signs/angel.gif' width='15' height='12' title='Ангел' align='absmiddle'/></td>";
                                        break;
								}
							if($tr==2){echo '</tr>';$tr=0;}	
						}
					echo'</table>	
					</td>
					<td align=center>
						<b>Иконка:</b><input type=text class=logintextbox6 name="clan_image" value="' . $sign['clan_gif'] . '" />
						<br>Сначала заливаем сюда:<br> <b>http://img.legendbattles.ru/image/signs/</b><br> а в поле пишем название.
					</td>
				</tr>
				<tr align=center><td colspan=3>
					<input class=lbut type=submit value="Сохранить">
				</td></tr>
				</table</form></td></tr></table></td></tr></table>
				';

if($_GET['vision']==''){$_GET['vision']=1;}

function locations_clan($loc,$pos){
	if($loc != '28'){
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`, `loc`, `room`, `city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
		return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
	}
	else{
		list($x, $y) = explode('_', $pos);
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$x."' and `y`='".$y."' LIMIT 1;"));
        return $location['city'] . " [" . (($location['name']) ? $location['name'] : 'неизвестно') . "]";
	}	
}
$clanid = $_POST['clan'];
?>
<table table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=65% bgcolor=#e0e0e0>
    <tr>
        <td style="background: #<?php echo(($_GET['vision'] == 1) ? '464451' : 'F0F0F0'); ?>" width="25%">
            <div align="center"><a href="?clan=<?= $_POST['clan'] ?>&vision=1" class="nickname"><font class="nickname"
                                                                                                      style="color: #<?php echo(($_GET['vision'] == 1) ? 'EEEEEE' : '000000'); ?>"><b>Состав <?= $_POST['clan'] ?></b></font></a>
            </div>
        </td>
        <td style="background: #<?php echo(($_GET['vision'] == 2) ? '464451' : 'F0F0F0'); ?>" width="25%">
            <div align="center"><a href="?clan=<?= $_POST['clan'] ?>&vision=2" class="nickname"><font class=nickname
                                                                                                      style="color: #<?php echo(($_GET['vision'] == 2) ? 'EEEEEE' : '000000'); ?>"><b>Казна</b></font></a>
            </div>
        </td>
    </tr>
</table>

<?
if($_GET['vision']==1){
echo'
<SCRIPT src="../../../js/ajax_adm.js"></SCRIPT>
<SCRIPT src="../../../js/clan_adm.js"></SCRIPT>
<table table border=0 cellpadding=0 cellspacing=0 bordercolor=#e0e0e0 align=center class="smallhead" width=65% bgcolor=#e0e0e0>
<tr><td colspan=9 class=nickname bgcolor=white>
<font class=nickname><b><a href="javascript:clan_private(\'' . $clanid . '\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a></font>&nbsp;<font color=#336699>Всему составу</font></b><br>
</td></tr>
<tr><td colspan=10 class=nickname bgcolor=white><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr>
<tr><td colspan=10 bgcolor=#E0D6BB><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>
<tr><td width=100% colspan=10>
<table border=0 cellpadding=2 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
<tr align=center bgcolor=#EAEAEA>
	<td align=left class=nickname>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=nickname align=center color=gray>ник
	</font></td>
	<td align=left class=nickname>
		&nbsp;&nbsp;<font class=nickname align=center color=gray>должность
	</font></td>
	<td align=center class=nickname>
		<font class=nickname align=center color=gray>статус
	</td>
	<td align=left class=nickname>
		&nbsp;&nbsp;<font class=nickname align=center color=gray>местоположение
	</td>
	<td align=center class=nickname>
	<font class=nickname align=center color=gray>опции
	</td>
</tr>
<SCRIPT>
';

function sclonch($id){
	$sclon=array("0","darks.gif","lights.gif","sumers.gif","chaoss.gif","light.gif","dark.gif","sumer.gif","chaos.gif","angel.gif");
    $desc = array("0", "Дети Тьмы", "Дети Света", "Дети Сумерек", "Дети Хаоса", "Истинный Свет", "Истинная Тьма", "Нейтральные Сумерки", "Абсолютный Хаос", "Ангел");
	if($id!='0'){
		return "<img src=http://img.legendbattles.ru/image/signs/".$sclon[$id]." width=15 height=12 border=0 align=absmiddle title='".$desc[$id]."'>";
	}
}
$access = explode("|","1|2|4|8");
echo"clan_init(".$player['id'].",".$sign['clan_sclon'].",'".$sign['clan_gif']."','".scode()."','".scode()."','".scode()."');\n";
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `clan_id` = '".$sign['clan_id']."' ORDER BY `level` DESC");
while($row = mysqli_fetch_assoc($query)){
	if($row['last']>time()-300){
		$useronline = '1';
	}else{
		$useronline = '0';
	}
	
	echo "clan_sostav(".$useronline.",'".$row['login']."',".$row['level'].",".$row['clan_status'].",'".$row['clan_d']."','".($useronline?locations_clan($row["loc"],$row["pos"]):'')."',".$row['id'].",'".($row['fight']?$row['battle']:'')."');\n";	
}

echo'
</SCRIPT>
<tr><td>';
if(in_array('8',$access)){
echo'<form method="post">
  <font class="nickname">
  <hr size="1" color="#CCCCCC" />
  <b>Принять<br />
  <font color="#aa0000">Имя персонажа:</font></b></font>
  <input type="hidden" name="useaction" value="clan-action" />
  <input type="hidden" name="addid" value="1" />
  <input type="hidden" name="post_id" value="47" />
  <input type="hidden" name="clan_act" value="1" />
  <input type="hidden" name="clan" value="'.$_POST['clan'].'" />
  <input type="hidden" name="vcode" value="'.scode().'" />
  <input type="text" name="fnick" class="LogintextBox" />
  <input type="submit" class="lbut" value="Принять" />
</form>';
}
echo'</td></tr>
</table>
</td></tr>
</table>
';

?>

<table cellpadding=0 cellspacing=0 border=0 align=center width=100%>
<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10><br></td></tr>
<tr><td align=center>
<table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
<tr><td align=center><?=$msg; if($msg!=''){echo "<br>";}?>
</td></tr>
<tr><td></td></tr>
<tr><td>
<?
}
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

if($_GET['vision']==2){
	if(isset($_GET['invf'])){
		$_SESSION['user']['inv']=$_GET['invf'];
	}
	if($_GET['all']==1){
		$_SESSION['user']['inv']='';
	}
	if($_GET['weapon_category']=='none'){
		$_SESSION['user']['inv']='none';
	}
	echo'<br>
	<table table border=0 cellpadding=0 cellspacing=0 bordercolor=#e0e0e0 align=center class="smallhead" width=65% bgcolor=#e0e0e0 width=100%>
	<tr bgcolor=white><td align="center">
		<a href="?clan=' . $_POST['clan'] . '&vision=2&all=1"><img src="http://img.legendbattles.ru/image/gameplay/invent/0.gif" width="44" height="53" title="Все вещи" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w70"><img src="http://img.legendbattles.ru/image/gameplay/invent/6.gif" width="41" height="53" title="Мази" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w66"><img src="http://img.legendbattles.ru/image/gameplay/invent/1.gif" width="41" height="53" title="Алхимия" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w69"><img src="http://img.legendbattles.ru/image/gameplay/invent/2.gif" width="41" height="53" title="Рыбалка" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&im=3"><img src="http://img.legendbattles.ru/image/gameplay/invent/3.gif" width="41" height="53" title="Ресурсы" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w71"><img src="http://img.legendbattles.ru/image/gameplay/invent/4.gif" width="41" height="53" title="Руны" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&im=5"><img src="http://img.legendbattles.ru/image/gameplay/invent/5.gif" width="41" height="53" title="Магия" class="cath" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&im=7"><img src="http://img.legendbattles.ru/image/gameplay/invent/7.gif" width="41" height="53" title="Журнал заданий" border="0" /></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w60"><img src=http://img.legendbattles.ru/image/gameplay/invent/23.gif width=41 height=53 title="Квестовые предметы" border="0"></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w61"><img src=http://img.legendbattles.ru/image/gameplay/invent/8.gif width=41 height=53 title="Приманки"  border="0"></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w29"><img src=http://img.legendbattles.ru/image/gameplay/invent/svit.gif width=41 height=53 title="Свитки" border="0"></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w30"><img src=http://img.legendbattles.ru/image/gameplay/invent/10.gif width=41 height=53 title="Лицензии" border="0"></a>
		<a href="javascript:alert(\'У вас нет трофейных вещей\');"><img src=http://img.legendbattles.ru/image/gameplay/invent/db.gif width=41 height=53 title="Трофейные вещи" border="0"></a>
		</td></tr></td></tr><tr bgcolor=white><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=4></td></tr><tr bgcolor=white><td align="center"><a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w4"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/0.gif width=44 height=53 title="Ножи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w1"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/1.gif width=41 height=53 title="Мечи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w2"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/2.gif width=41 height=53 title="Топоры" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w3"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/3.gif width=41 height=53 title="Дробящие" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w6"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/4.gif width=41 height=53 title="Алебарды и двуручное" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w5"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/18.gif width=41 height=53 title="Копья" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w7"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/6.gif width=41 height=53 title="Посохи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w20"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/7.gif width=41 height=53 title="Щиты" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w18"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/10.gif width=41 height=53 title="Кольчуги" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w19"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/11.gif width=41 height=53 title="Доспехи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w23"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/8.gif width=41 height=53 title="Шлемы" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w21"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/14.gif width=41 height=53 title="Сапоги" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w77"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/mgb.gif width=41 height=53 title="Магические книги" class=cath border=0></a>
		</td></tr><tr bgcolor=white><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=4></td></tr><tr bgcolor=white><td align="center"><a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w26"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/9.gif width=44 height=53 title="Пояса" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w24"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/12.gif width=41 height=53 title="Перчатки" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w80"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/13.gif width=41 height=53 title="Наручи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w25"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/15.gif width=41 height=53 title="Кулоны" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w22"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/16.gif width=41 height=53 title="Кольца" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w28"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/17.gif width=41 height=53 title="Наплечники" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w90"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/19.gif width=41 height=53 title="Поножи" class=cath border=0></a>
		<a href="?clan=' . $_POST['clan'] . '&vision=2&invf=w0"><img src=http://img.legendbattles.ru/image/gameplay/invent/cat/21.gif width=41 height=53 title="Зелья" class=cath border=0></a>
		<br><a href="?clan=' . $_POST['clan'] . '&vision=2&all=1&onlyart=1"><b><u>Показать только артефакты</u></b></a><br><br>
		</td></tr></table>';

	echo'
	<table table border=0 cellpadding=0 cellspacing=0 bordercolor=#e0e0e0 align=center class="smallhead" width=65% bgcolor=#e0e0e0 width=100%>
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
	if($_GET['delete']){
	   switch($_GET['delete']){
		case 1:
		$val_iditem=varcheck($_POST['iditem']);
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `clan_kazna` WHERE `id_item`='".$val_iditem."' LIMIT 1;")){
                echo 'удаление из казны: <font color=green><b>OK</b></font><br>';
            } else {
                echo 'удаление из казны: <font color=red><b>ERROR</b></font><br>';
            }
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `id_item`='".$val_iditem."' LIMIT 1;")){
                echo 'удаление из инвентаря: <font color=green><b>OK</b></font><br>';
            } else {
                echo 'удаление из инвентаря: <font color=red><b>ERROR</b></font><br>';
            }
		break;
		case 2:
		$val_iditem=varcheck($_POST['iditem']);
		$val_clan=varcheck($_POST['clan']);
			$lider=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id` FROM `user` WHERE `clan_id`='".$val_clan."' AND `clan_status`='9' LIMIT 1;"));
			if($lider['id']){
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `clan_kazna` SET `pl_id`='".$lider['id']."' WHERE `id_item`='".$val_iditem."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `pl_id`='".$lider['id']."',`used`='0' WHERE `id_item`='".$val_iditem."' LIMIT 1;")){
                    echo 'передача лидеру: <font color=green><b>OK</b></font><br>';
                } else {
                    echo 'передача лидеру: <font color=red><b>ERROR</b></font>. ошибка при передаче<br>';
                }
            } else {
                echo 'передача лидеру: <font color=red><b>ERROR</b></font>. лидер клана не найден<br>';
            }
		break;
		case 3:
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `clan_kazna` WHERE `id_item`='".$_POST['iditem']."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `clan`='0',`used`='0' WHERE `id_item`='".$_POST['iditem']."' LIMIT 1;")){
                echo 'удаление из казны: <font color=green><b>OK</b></font><br>';
            } else {
                echo 'удаление из казны: <font color=red><b>ERROR</b></font><br>';
            }
		break;
		case 4:
		$val_iditem=varcheck($_POST['iditem']);
		$val_newlogin=varcheck($_POST['newlogin']);
			$newpl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login` FROM `user` WHERE `login`='".$val_newlogin."' LIMIT 1;"));
			if($newpl['id']){
				if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `clan_kazna` WHERE `id_item`='".$val_iditem."' LIMIT 1;")){
                    echo 'удаление из казны: <font color=green><b>OK</b></font><br>';
                } else {
                    echo 'удаление из казны: <font color=red><b>ERROR</b></font><br>';
                }
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `pl_id`='".$newpl['id']."',`clan`='0',`gift`='0',`gift_from`='',`used`='0' WHERE `id_item`='".$val_iditem."' LIMIT 1;")){
                    echo 'передача игроку: <font color=green><b>OK</b></font><br>';
                } else {
                    echo 'передача игроку: <font color=red><b>ERROR</b></font><br>';
                }
			}
		break;
	   }
	}
		
		$val_clan=varcheck($_POST['clan']);
if($_SESSION['user']['inv']!='none'){
		if($_SESSION['user']['inv']!=''){
			$sq="and `type`='".$_SESSION['user']['inv']."'";
		}else{$sq='';}
		if($_GET['onlyart']==1){
			$sq=" and `items`.`dd_price`>'0'";
		}
		$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT clan_kazna.*,items.* FROM items INNER JOIN clan_kazna ON items.id = clan_kazna.protype WHERE clan_id='".$val_clan."' $sq;");
		while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
		$ITEMID=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `id_item`='".$ITEM['id_item']."' LIMIT 1;"));
		if($ITEMID['id_item']){
			$itemuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT clan_kazna.*,user.* FROM user INNER JOIN clan_kazna ON user.id = clan_kazna.pl_id WHERE id_item='".$ITEM['id_item']."'"));
			if($itemuser['last']>time()-300){
				$useronline = '1';
			}else{
				$useronline = '0';
			}	
			
		echo'<tr align=center height=1>';
		if($ITEM['dd_price']>0){$art="weaponchart";}else{$art="weaponch";}
		echo'
		<td bgcolor=#f9f9f9 align=left width=50%>
		';
		if($ITEMID['mod_color']==0) {
            echo '<font class=' . $art . '  style="margin: 0px 0px 0px 20px;"><b>' . $ITEM['name'] . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="http://www.lifeiswar.ru/iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a>';
		}
		else{
			if($ITEMID['mod_color']==1){
                echo '<font class=' . $art . ' style="margin: 0px 0px 0px 20px;color:#006600;"><b>' . $ITEM['name'] . ' [мод] ' . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="http://www.lifeiswar.ru/iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a>';
                ' [мод]' . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</font>';
			}	
			if($ITEMID['mod_color']==2){
                echo '<font class=' . $art . ' style="margin: 0px 0px 0px 20px;color:#4ABB58;"><b>' . $ITEM['name'] . ' [мод] ' . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="http://www.lifeiswar.ru/iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a>';
                '<font color=#4ABB58> [мод]' . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</font>';
			}
			if($ITEMID['mod_color']==3){
                echo '<font class=' . $art . ' style="margin: 0px 0px 0px 20px;color:#993399 ;"><b>' . $ITEM['name'] . ' [мод] ' . ($ITEMID['modified'] == 1 ? " [ап]" : "") . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="http://www.lifeiswar.ru/iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a>';
			}
		}
		echo'
		</font><font class=weaponch>
		<br>
		</td>
		</form>
				<td bgcolor=#F5F5F5 align=left width=30% align=left><font class=inv style="margin: 0px 0px 0px 20px;"><b>' . $itemuser['login'] . '</b>&nbsp;[' . $itemuser['level'] . ']</font><a href="http://www.lifeiswar.ru/ipers.php?' . $itemuser['login'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a></font><br><font class=inv style="margin: 0px 0px 0px 20px;">Положил в казну: ' . ($ITEMID['gift_from'] ? (mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT user.login FROM user WHERE login='" . $ITEMID['gift_from'] . "' LIMIT 1;")) ? '<b>' . $ITEMID['gift_from'] . '</b></font><a href="http://www.lifeiswar.ru/ipers.php?' . $ITEMID['gift_from'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a> 
				<form method=POST action="clan_items.php?add=1&weapon_category=all&delete=4&vision=2">
				<input type=hidden name=iditem value="'.$ITEM['id_item'].'">
				<input type=hidden name=clan value="'.$_POST['clan'].'">
				<input type=hidden name=newlogin value="'.$ITEMID['gift_from'].'">
				<font class=inv style="margin: 0px 0px 0px 20px;"><input type=submit class=submit value="Вернуть дарителю"></font>
				</form>
				'
                : 'Даритель не найден в базе') : 'Даритель не найден в базе') . '</td>
				<td bgcolor=#F5F5F5 align=center valign=middle width=40%>
				<form method=POST action="clan_items.php?add=1&weapon_category=all&delete=1&vision=2">
					<input type=hidden name=iditem value="'.$ITEM['id_item'].'">
					<input type=hidden name=clan value="'.$_POST['clan'].'">
					<input type=submit class=lbut value="удалить (полностью)">
				</form>
				<hr size=1 color=#e0e0e0>
				<form method=POST action="clan_items.php?add=1&weapon_category=all&delete=2&vision=2">
					<input type=hidden name=iditem value="'.$ITEM['id_item'].'">
					<input type=hidden name=clan value="'.$_POST['clan'].'">
					<input type=submit class=lbut value="передать главе клана"><br>
				</form>	
				<hr size=1 color=#e0e0e0>
				<form method=POST action="clan_items.php?add=1&weapon_category=all&delete=3&vision=2">
					<input type=hidden name=iditem value="'.$ITEM['id_item'].'">
					<input type=hidden name=clan value="'.$_POST['clan'].'">
					<input type=submit class=lbut value="удалить (из казны, оставить на том где одето)">
				</form>
				<hr size=1 color=#e0e0e0>
				<form method=POST action="clan_items.php?add=1&weapon_category=all&delete=4&vision=2">
					<input type=hidden name=iditem value="'.$ITEM['id_item'].'">
					<input type=hidden name=clan value="'.$_POST['clan'].'">
					<font class=inv style="margin: 0px 0px 0px 20px;"><b>Ник: <input type=text class="LoginTextBox6" name="newlogin"></b></font>
					<input type=submit class=lbut value="передать персонажу (удалить из казны и передать)"><br>
				</form>	

				</td>
				</tr>';
				}
		}			
}
	echo"</table></td></tr></table>";
	echo'
	</td></tr>
	</table>
	';
	}
	echo'
				<script>
						parent.$("#main_top").contents().find(".options").hide(1);
				</script>
	';
}
?>


</body>