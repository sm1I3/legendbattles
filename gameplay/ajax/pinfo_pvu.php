<?php
#GLOBALS OFF
include($_SERVER["DOCUMENT_ROOT"] . "/system/config.php");
include(DROOT."/includes/functions.php");

$WatchUser = GetUser();
//if(in_array($_GET['hash'],$_SESSION['PVUcode'])){
//	unset($_SESSION['PVUcode']);
	switch($_GET['see']){
        case'1'://Отчет безопасности
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'2'://Передача RB
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_2` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'4'://Передача/Подарок вещей
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_4` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'8'://Сдача в гос
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_8` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'16'://Выкидывание вещей
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_16` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'32'://Продажа/Покупка вешей
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_32` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'64'://Сдача в казну
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_64` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
//			echo'OK::1::'.pinfo_PVU().'::Date|IP|ItemLevel|Price|ProchMin|ProchMax|1|c1.gif|ClanName|ItemName::';
		break;
        case'128'://Переводы RB (счета)
            // Очень скоро
		break;
        case'256'://Счета/Сейф (Операции)
            // Очень скоро
		break;
        case'512'://Депозиты/Ссуды/Кредиты
            // Очень скоро
		break;
        case'1024'://Подарки
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1024` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'2048'://Лицензии
            // Очень скоро
		break;
        case'4096'://Входы с одного компьютера
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			$ip='';	
			$login='';
			while($row = mysqli_fetch_assoc($query)){
				if($ip != $row['ip']){
					$ip=$row['ip'];
                    $oneip = mysqli_query($GLOBALS['db_link'], "SELECT * FROM mlog WHERE login!='" . $pers['login'] . "' AND ip='" . $ip . "';");
					$oneip = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1` WHERE `uid` != '".$_GET['puid']."' and `ip` = '".$ip."'");
					if(mysqli_num_rows($oneip)>0){
						while($newrow = mysqli_fetch_assoc($oneip)){
							$User_Get = GetUserFID($newrow['uid'],1);
							$User_Get['prison'] = explode("|",$User_Get['prison']);
							$Block = (($User_Get['block'])?'2':(($User_Get['prison'][0]>time())?'1':''));
							$result .= date("Y-m-d H:i:s",$row['time_unix']).'|'.$Block.'|'.$newrow['ip'].'|'.$User_Get['login'].'|'.$newrow['Browser'].'::';
						}
					}
				}
			}
			echo $result;
		break;
        case'8192'://Молчанки/Тюрьма/Блок
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_8192` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'16384'://Проверки на чистоту
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_16384` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
        case'32768'://Семьи/кланы (Движение)
            // Очень скоро
		break;
        case'65536'://Семьи/кланы (Списания)
            // Очень скоро
		break;
        case'131072'://Пароль/Flash/E-mail (Смена)
            // Очень скоро
		break;
        case'262144'://Подозрительные бои
            // Очень скоро
		break;
        case'1048576'://Лечение/нападения/абилити
            // Очень скоро
		break;
        case'2097152'://Модификация вещей
            // Очень скоро
		break;
        case'4194304'://Получение уровней
            // Очень скоро
		break;
        case'8388608'://RB/Вещи (Боты)
            // Очень скоро
		break;
	}
//}