<?php
#GLOBALS OFF
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include(DROOT."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
     $valp = varcheck($valp);
     $_POST[$keypost] = $valp;
     //$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
     $valg = varcheck($valg);
     $_GET[$keyget] = $valg;
    // $$keyget = $valg;

}

$WatchUser = GetUser();
//if(in_array($_GET['hash'],$_SESSION['PVUcode'])){
//	unset($_SESSION['PVUcode']);
	switch($_GET['see']){
		case'1'://����� ������������
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'2'://�������� RB
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_2` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'4'://��������/������� �����
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_4` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'8'://����� � ���
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_8` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'16'://����������� �����
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_16` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'32'://�������/������� �����
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_32` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'64'://����� � �����
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_64` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
//			echo'OK::1::'.pinfo_PVU().'::Date|IP|ItemLevel|Price|ProchMin|ProchMax|1|c1.gif|ClanName|ItemName::';
		break;
		case'128'://�������� RB (�����)
			// ����� �����
		break;
		case'256'://�����/���� (��������)
			// ����� �����
		break;
		case'512'://��������/�����/�������
			// ����� �����
		break;
		case'1024'://�������
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1024` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'2048'://��������
			// ����� �����
		break;
		case'4096'://����� � ������ ����������
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_1` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			$ip='';	
			$login='';
			while($row = mysqli_fetch_assoc($query)){
				if($ip != $row['ip']){
					$ip=$row['ip'];
					$oneip=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mlog WHERE login!='".$pers[login]."' AND ip='".$ip."';");
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
		case'8192'://��������/������/����
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_8192` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'16384'://�������� �� �������
			$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `pvu_logs`.`logs_16384` WHERE `uid`='".$_GET['puid']."' and `time_norm`>='".$_GET['date_f']."' and `time_norm`<='".$_GET['date_t']."' ORDER BY `id` DESC");
			$result = 'OK::1::'.pinfo_PVU().'::';
			while($row = mysqli_fetch_assoc($query)){
				$result .= date("Y-m-d H:i:s",$row['time_unix']).$row['reason'].'::';
			}
			echo $result;
		break;
		case'32768'://�����/����� (��������)
			// ����� �����
		break;
		case'65536'://�����/����� (��������)
			// ����� �����
		break;
		case'131072'://������/Flash/E-mail (�����)
			// ����� �����
		break;
		case'262144'://�������������� ���
			// ����� �����
		break;
		case'1048576'://�������/���������/�������
			// ����� �����
		break;
		case'2097152'://����������� �����
			// ����� �����
		break;
		case'4194304'://��������� �������
			// ����� �����
		break;
		case'8388608'://RB/���� (����)
			// ����� �����
		break;
	}
//}