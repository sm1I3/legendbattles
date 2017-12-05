<?
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
$player=player();
if ($player['login'] == 'mozg' or $player['login'] == 'Администрация') {
    $login = varcheck(iconv("UTF-8", "UTF-8", urldecode($_GET['login'])));
	$usr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".$login."' LIMIT 1;"));
	if($usr['id']){
		$add = intval($_GET['dlr']);
		if($add>0){
			$str='';
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `dd`=`dd`+'".$add."' WHERE `id`='".$usr['id']."';")){
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('" . time() . "','sys','<" . mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT `login` FROM `user` WHERE `id`='" . $usr['id'] . "'"), 0) . ">','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Life is War&nbsp;</font> <font color=000000>Вам удачно начислена игровая валюта в размере <b>" . $add . "</b> DLR</font><BR>'+'');") . "');");
                //начисление бабла тому кто пригласил
					$referal=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ref_system` WHERE `ref_id`='".$usr['id']."' LIMIT 1;"));
					if($referal['who_id']){
						$usrb = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".$referal['who_id']."' LIMIT 1;"));
						if($usrb['id']){
							$refparams = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ref_adm` WHERE `id`='1' LIMIT 1;"));
							if($refparams['money_dlr_bonus']>0){			
								$givebonus = round(($add*($refparams['money_dlr_bonus']/100)),2);																
								if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `dd`=`dd`+'".$givebonus."' WHERE `id`='".$usrb['id']."' LIMIT 1;")){
                                    $str = '<br>Рефералу этого пользователя (ник: ' . $usrb['login'] . ') зачислено ' . $refparams['money_dlr_bonus'] . '% от суммы (' . $givebonus . ' DLR).';
                                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Вы получили бонус за пополнение счета рефералом: <b>" . $givebonus . "</b> DLR.</font><BR>'+'');";
									chmsg($ms,$usrb['login']);
									mysqli_query($GLOBALS['db_link'],"UPDATE `ref_system` SET `bonus_dlr`=`bonus_dlr`+'".$givebonus."' WHERE `ref_id`='".$usr['id']."' AND `who_id`='".$usrb['id']."' LIMIT 1;");
								}								
							}
						}
					}
					//end 
				log_write("DLR-add",$player['login'],$add,$usr['login']);
				if($str){log_write("DLR-add-ref",$player['login'],$givebonus,$usrb['login']);}
                echo 'Пользователю ' . $usr['login'] . ' зачислено ' . $add . ' DLR.' . $str;
			}
        } else {
            echo 'DLR должно быть выше 0';
        }
    } else {
        echo 'Пользователь не найден: ' . $login;
    }
}
?>