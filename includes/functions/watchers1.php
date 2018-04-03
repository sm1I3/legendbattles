<?php

$WatchUser = GetUser($_SESSION['user']['login']);

$access = explode("|",accesses($WatchUser['id'],'pvu',1));
if (@$_POST["autobot"] and in_array('1',$access)) 
autobot($pers,$WatchUser,intval($_POST["autobot"]));
if (@$_POST["molch"] and in_array('1',$access)) 
molch($pers,$WatchUser,intval($_POST["molch"]),$_POST["reason1"]);
if (@$_GET['clan_go_out'] and ($WatchUser['login'] == 'Администрация'))
clango($pers,$WatchUser);
if (@$_POST["fmolch"] and in_array('1',$access)) 
fmolch($pers,$WatchUser,intval($_POST["fmolch"]),$_POST["freason1"]);
if (@$_POST["prisontime"] and in_array('2',$access)) 
prison($pers,$WatchUser,intval($_POST["prisontime"]),$_POST["prison"]);
if (@$_POST["block"] or @$_POST["blockt"] and in_array('4',$access)) 
block($pers,$WatchUser,intval($_POST["blockt"]),$_POST["block"]);
if (@$_POST['verif'] and in_array('16',$access))
verification($pers,$WatchUser,intval($_POST["verif"]),$_POST["verifr"]);
if (@$_GET['wear_out'] and ($WatchUser['login'] == 'Администрация'))
wear_out($pers,$WatchUser);
if (@$_GET['mprision'] and ($WatchUser['login'] == 'Администрация'))
mprision($pers,$WatchUser);
if (@$_POST['editor'] and accesses($WatchUser['id'],'editor'))
editor($pers,$WatchUser,$_POST);
if (@$_GET['give_buttons'] and ($WatchUser['login'] == 'Администрация')) {
    givebut($pers, $WatchUser, $_GET['give_buttons']);
}



function clango($persto,$perswho){
	$persto = GetUser($_GET["p"]);
    echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> исключен из клана (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan`='0',`clan_id`='none',`clan_gif`='',`sklon`='0',`clan_d`='',`clan_accesses`='0' WHERE `id`='".$persto['id']."'");
}

//инфа о действиях перса
if (@$_POST['pactions'] and in_array('1',$access)) {
    if ($pers['login'] != 'mozg' and $pers['login'] != 'Администрация') {
		view_act($pers);
	} else {
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Вы не можете просматривать информацию об этом персонаже!";
    }
}
function view_act($pers){
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM mlog WHERE login='" . $pers['login'] . "' AND action!='вход в игру' AND action!='WARNING' AND action!='newpass' ORDER BY action;");
	echo'<table width=80% align=center border=1 cellpadding=5 cellspacing=0>
	<tr>
	<td><font class=weaponch>Время</td>
	<td><font class=weaponch>IP</td>
	<td><font class=weaponch>Действие</td>
	<td><font class=weaponch>Вещь</td>
	<td><font class=weaponch>Сумма</td>
	<td><font class=weaponch>Куда продано \ У кого куплено</td>
	</tr>
	';	
	while($row = mysqli_fetch_assoc($sql)){
			$act="";
        switch ($row['action']) {
                case 'selldprise':
                    $act = "Продажа в ДЦ";
                    break;
                case 'transfer':
                    $act = "Передача Валюты";
                    break;
                case 'err: пароль':
                    $act = "ошибка ввода пароля";
                    break;
                case 'sell':
                    $act = "Продажа";
                    break;
                case 'buy':
                    $act = "Покупка";
                    break;
			}
        if ($row['action'] == "buy" and $row['tologin'] == "market") {
        }
			else{
				echo"<tr>";
                echo "<td><font class=weaponch>" . $row['time'] . "</td>";
                echo "<td><font class=weaponch>" . $row['ip'] . "</td>";
                if ($act == "") {
                    echo "<td><font class=weaponch>" . $row['action'] . "</td>";
                }
				else{echo"<td><font class=weaponch>".$act."</td>";}
                if ($row['id_item'] != '') {
                    echo "<td><font class=weaponch>" . $row['id_item'] . "</td>";
                } else {
                    echo "<td>&nbsp;</td>";
                }
                if ($row['sum'] != '') {
                    echo "<td><font class=weaponch>" . $row['sum'] . "</td>";
                } else {
                    echo "<td>&nbsp;</td>";
                }
                if ($row['tologin'] != '') {
                    echo "<td><font class=weaponch>" . $row['tologin'] . "</td>";
                } else {
                    echo "<td>&nbsp;</td>";
                }
				echo"</tr>";
			}			
	}
	
}

//заходы с одного ип
if (@$_POST['pip'] and in_array('1',$access)) {
    if ($pers['login'] != 'mozg' and $pers['login'] != 'Администрация' and $pers['clan'] != 'Life') {
		view_ip($pers);
	} else {
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Вы не можете просматривать информацию об этом персонаже!";
    }
}
function view_ip($pers){
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM mlog WHERE login='" . $pers['login'] . "' ORDER BY ip;");
	echo'<table width=80% align=center border=1 cellpadding=5 cellspacing=0>
	<tr>
	<td><font class=weaponch>IP</td>
	<td><font class=weaponch>Логин</td>
	</tr>
	';
	$ip='';	
	$login='';
	while($row = mysqli_fetch_assoc($sql)){
        if ($ip != $row['ip']) {
            $ip = $row['ip'];
            $oneip = mysqli_query($GLOBALS['db_link'], "SELECT * FROM mlog WHERE login!='" . $pers['login'] . "' AND ip='" . $ip . "';");
			if(mysqli_num_rows($oneip)>0){
				while($newrow = mysqli_fetch_assoc($oneip)){
                    if ($login != $newrow['login'] and $newrow['login'] != 'Администрация' and $newrow['login'] != 'Администрация' and $newrow['login'] != 'z7' and $newrow['login'] != 'ReadOnly' and $newrow['login'] != 'NINTENDO' and $newrow['login'] != '') {
                        $login = $newrow['login'];
						echo"<tr>";
                        echo "<td><font class=weaponch>" . $newrow['ip'] . "</td>";
                        echo '<td><font class=weaponch>' . $newrow['login'] . '<a href="ipers.php?' . $newrow['login'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a></td>';
						echo"</tr>";
					}
				}
			}
		}
	}
	echo"</table>";
}

function molch($persto,$perswho,$duration,$reason){
	if ($duration>-1){
        if ($duration == 5) {
            $timemolch = '<b>5</b> минут';
            $log = '0|5|';
        }
        if ($duration == 10) {
            $timemolch = '<b>10</b> минут';
            $log = '0|10|';
        }
        if ($duration == 15) {
            $timemolch = '<b>15</b> минут';
            $log = '0|15|';
        }
        if ($duration == 30) {
            $timemolch = '<b>30</b> минут';
            $log = '0|30|';
        }
        if ($duration == 60) {
            $timemolch = '<b>1</b> час';
            $log = '1|1|';
        }
        if ($duration == 180) {
            $timemolch = '<b>3</b> часa';
            $log = '1|3|';
        }
        if ($duration == 360) {
            $timemolch = '<b>6</b> часов';
            $log = '1|6|';
        }
        if ($duration == 1440) {
            $timemolch = '<b>24</b> часа';
            $log = '2|1|';
        }
        if ($reason != '') {
            $chreason = "Причина: <font color=#CC0000>" . $reason . "</font>.";
        }
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> наложено заклятие молчания сроком на " . $timemolch . ". " . $chreason . " (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\ ></a>)" . $duration . "</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `sleep`='".(time()+$duration*60)."' WHERE `login`='".$persto['login']."' LIMIT 1;");
        //chmsg("<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>".$persto['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$persto['login']."\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$persto['login']."\');\" ></a> наложено заклятие молчания сроком на ".$timemolch.". ".$chreason." (<b>".$perswho['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$perswho['login']."\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$perswho['login']."\');\" ></a>)</font>");
		pvu_logs($persto['id'],"8192","|0|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|".$log.$reason);
	}else{
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a> снял заклятие молчания с персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a>.</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `sleep`='0' WHERE `login`='".$persto['login']."' LIMIT 1;");
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a> снял заклятие молчания с персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a>.</font>");
		pvu_logs($persto['id'],"8192","|1|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|".$reason);
	}
}
function autobot($persto,$perswho,$duration){
	if ($duration>-1){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `lastbattle`='".(time()+$duration*60)."' WHERE `login`='".$persto['login']."' LIMIT 1;");
	}
	else{
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `lastbattle`='".(time()+300)."' WHERE `login`='".$persto['login']."' LIMIT 1;");
	}
}

function fmolch($persto,$perswho,$duration,$reason){
	if ($duration>-1){
        if ($duration == 60) {
            $timemolch = '<b>1</b> час';
            $log = '1|1|';
        }
        if ($duration == 360) {
            $timemolch = '<b>6</b> часов';
            $log = '1|6|';
        }
        if ($duration == 1440) {
            $timemolch = '<b>24</b> часа';
            $log = '2|1|';
        }
        if ($duration == 10080) {
            $timemolch = '<b>1</b> Неделю';
            $log = '3|1|';
        }
        if ($duration == 259200) {
            $timemolch = '<b>6</b> Месяцев';
            $log = '4|6|';
        }
        if ($duration == 525600) {
            $timemolch = '<b>1</b> год';
            $log = '4|12|';
        }
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> лишается права общения на форуме на " . $timemolch . " (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `forum_lastmsg`='".(time()+$duration*60)."' WHERE `login`='".$persto['login']."' LIMIT 1;");
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> лишается права общения на форуме на " . $timemolch . " (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>");
		pvu_logs($persto['id'],"8192","|2|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|".$log.$reason);
	}else{
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a> снял запрет форумного молчания с персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a>.</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `forum_lastmsg`='0' WHERE `login`='".$persto['login']."' LIMIT 1;");
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a> снял запрет форумного молчания с персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a>.</font>");
		pvu_logs($persto['id'],"8192","|3|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|".$reason);
	}
}
function prison($persto,$perswho,$duration,$reason){
	if ($duration>0){
		if ($duration==1){$log = '2|1|';}
		if ($duration==3){$log = '2|3|';}
		if ($duration==7){$log = '3|1|';}
		if ($duration==14){$log = '3|2|';}
		if ($duration==30){$log = '4|1|';}
		if ($duration==60){$log = '4|2|';}
		if ($duration==365){$log = '4|12|';}
		$duration *= 86400;
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> отправлен в тюрьму (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `prison`='".($duration+time())."|".$reason."',`mov`='1',`loc`='33' WHERE `login`='".$persto['login']."' LIMIT 1;");
		mysqli_query($GLOBALS['db_link'],"UPDATE invent SET used=0 WHERE pl_id=".$persto['id'].";");
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> отправлен в тюрьму (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>");
		pvu_logs($persto['id'],"8192","|4|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|".$log.$reason);
	}else{
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> выпущен  из тюрьмы (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> выпущен  из тюрьмы (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>");
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `prison`='0' WHERE `login`='".$persto['login']."' LIMIT 1;");
		pvu_logs($persto['id'],"8192","|5|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|".$reason);
	}
}
function block($persto,$perswho,$duration,$reason){
	if ($duration!=2){
        if (empty($reason)) {
            $reason = "Так надо";
        }
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;НА персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> наложено заклятие смерти. Пусть земля тебе будет пухом. (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `block`='".$reason."' WHERE login='".$persto['login']."' LIMIT 1;");
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;НА персонажа <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> наложено заклятие смерти. Пусть земля тебе будет пухом. (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>");
		pvu_logs($persto['id'],"8192","|7|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|".$reason);
	}else{
        echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto["login"] . "</b> оживлён! (<b>" . $perswho["login"] . "</b>)</font>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `block`='' WHERE `login`='".$persto['login']."' LIMIT 1;");	
		pvu_logs($persto['id'],"8192","|8|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|".$reason);	
	}
}
function mprision($persto,$perswho){
    echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> телепортирован в тюрьму (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `mov`='1',`loc`='33',`pos`='8_4' WHERE `login`='".$persto['login']."' LIMIT 1;");
	pvu_logs($persto['id'],"8192","|6|".$perswho['clan_d']."|".$perswho['clan']."|".$perswho['login']."|0|0|");	
}

function verification($persto,$perswho,$duration,$reason){
	switch($duration){
		case'1':
			mysqli_query($GLOBALS['db_link'],"UPDATE `verification` SET `status` = '1',`vTime` = '".(time()+604800)."' WHERE `uid` = '".$persto['id']."'");
			//mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `verification` = '".(time()+604800)."' WHERE `id` = '".$persto['id']."'");
            echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> Прошел проверку (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
            chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Проверка пройдена. (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>", $persto['login']);
            //mysqli_query($GLOBALS['db_link'],"INSERT INTO `pvu_logs`.`logs_16384` (`uid`,`time_unix`,`time_norm`,`reason`,`ip`) VALUES ('".$persto['id']."','".time()."','".date("Y-m-d H:i:s",time())."','|0|".getIP()."|ХЗ|".$perswho['login']."|".$reason."','".getIP()."');");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan_check`='1',`clan_reason`='' WHERE `login`='".$persto['login']."' LIMIT 1;");	
		break;
		case'2':
			mysqli_query($GLOBALS['db_link'],"UPDATE `verification` SET `status` = '2' WHERE `uid` = '".$persto['id']."'");
            echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> Прошел проверку (Условно) (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
            chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Проверка пройдена (условно). (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>", $persto['login']);
            //mysqli_query($GLOBALS['db_link'],"INSERT INTO `pvu_logs`.`logs_16384` (`uid`,`time_unix`,`time_norm`,`reason`,`ip`) VALUES ('".$persto['id']."','".time()."','".date("Y-m-d H:i:s",time())."','|1|".getIP()."|ХЗ|".$perswho['login']."|".$reason."','".getIP()."');");
		break;
		case'3':
            echo "<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>" . $persto['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $persto['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $persto['login'] . "\');\" ></a> Не прошел проверку (<b>" . $perswho['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $perswho['login'] . "\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $perswho['login'] . "\');\" ></a>).</font>";
            //mysqli_query($GLOBALS['db_link'],"INSERT INTO `pvu_logs`.`logs_16384` (`uid`,`time_unix`,`time_norm`,`reason`,`ip`) VALUES ('".$persto['id']."','".time()."','".date("Y-m-d H:i:s",time())."','|2|".getIP()."|ХЗ|".$perswho['login']."|".$reason."','".getIP()."');");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan_check`='0',`clan_reason`='".$reason."' WHERE `login`='".$persto['login']."' LIMIT 1;");
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `verification` WHERE `uid` = '".$persto['id']."' LIMIT 1;");			
		break;
	}
}
function wear_out($persto,$perswho){
	mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `used`='0' WHERE `pl_id`='".$persto['id']."';");
}

function editor($persto,$perswho,$post){
	$q = '';
	foreach($post as $key=>$val){
			$key = str_replace (" ","",$key);
			$val = str_replace("'","",$val);
			$q .= "`".$key."`='".$val."',";
	}
	$q = substr($q,0,strlen($q)-1);
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET ".$q." WHERE id='".$persto['id']."' LIMIT 1;");
	echo"Edit Ok";
}

function givebut($persto,$perswho,$id){
	switch($id){
		case 1: 
			if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `accesses` WHERE `uid` = '".$persto['id']."' LIMIT 1;"))==0){
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `accesses` (`uid`,`pvu`) VALUES ('".$persto['id']."','1|2|4|16');")  or DIE(mysqli_error());
                echo 'кнопки выданы';
            } else {
                echo 'кнопки уже есть';
            }
			
		break;
		case 2:
            echo 'кнопки убраны';
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `accesses` WHERE `uid`='".$persto['id']."' LIMIT 1;") or DIE(mysqli_error());
		break;
		case 3:
            echo 'доступ дан';
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `forum_accesses`='1|32|64|128|256|2048|4096|8192|32768|65536' WHERE `id`='".$persto['id']."' LIMIT 1;");
		break;
		case 4:
            echo 'доступ убран';
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `forum_accesses`=DEFAULT WHERE `id`='".$persto['id']."' LIMIT 1;");
		break;
		case 5:
			if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `accesses` WHERE `uid` = '".$persto['id']."' LIMIT 1;"))==0){
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `accesses` (`uid`,`pvu`,`bots`,`clans`,`out`,`editor`,`dealer`) VALUES ('".$persto['id']."','1|2|4|8|16|32|64|128|256','1','1','1','1','1');")  or DIE(mysqli_error());
                echo 'кнопки выданы';
			}else{
                echo 'кнопки выданы';
				mysqli_query($GLOBALS['db_link'],"UPDATE `accesses` SET  `pvu`='1|2|4|8|16|32|64|128|256',`bots`='1',`out`='1',`clans`='1',`editor`='1',`dealer`='1' WHERE `uid`='".$persto['id']."' LIMIT 1;");
			}
            echo ', доступ дан';
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `forum_accesses`='1|32|64|128|256|512|1024|2048|4096|8192|32768|65536' WHERE `id`='".$persto['id']."' LIMIT 1;");
		break;
	}
}
