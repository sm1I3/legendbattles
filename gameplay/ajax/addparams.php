<?
header('Content-type: text/html; charset=windows-1251');
session_start();
/*			switch($tp){
				case 1: $str = "`param`='".$par_new."'"; break;
				case 2: $str = "`param_timed`='".$par_new."',`param_time`='".(time()+2592000)."'"; break;
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_bonus` SET ".$str." WHERE `pl_id`='".$player['id']."' LIMIT 1;");
			switch($tp){
				case 1: $str = "(`pl_id`,`param`) VALUES ('".$player['id']."','".$par."')"; break;
				case 2: $str = "(`pl_id`,`param_timed`,`param_time`) VALUES ('".$player['id']."','".$par_new."','".(time()+2592000)."')"; break;
			}
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `real_dd_bonus` ".$str.";");	
			
			
*/	
include "./includes/common.php";
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
$pers = GetUser($_SESSION['user']['login']);
$_GET['string'] = iconv("UTF-8","Windows-1251",urldecode($_GET['string']));
$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$pers['id']."' LIMIT 1;"));
$_GET['type'] = intval($_GET['type']);
$hash = md5($_GET['type'].$_SESSION['user']['login'].$_GET['params'].$_GET['sum'].$pers['dd']);
if($_GET['type']==1){$hashBD = $getstatsusr['tmp_hash'];}
else{$hashBD = $getstatsusr['tmp_time_hash'];}
if($hash==$hashBD){
	$str="";
	switch($_GET['type']){
		case 1: $str = "`param`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['params'])."'"; break;
		case 2: 
			if($getstatsusr['param_time']>time()){
				$str = "`param_timed`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['params'])."'";
			}else{
				$str = "`param_timed`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['params'])."',`param_time`='".(time()+2592000)."'";
			}
		 break;		
	}
	if($str){
		if($pers['baks']>=$_GET['sum'] and $_GET['sum']>0 and is_numeric($_GET['sum'])){
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_bonus` SET ".$str." WHERE `pl_id`='".$pers['id']."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-'".$_GET['sum']."' WHERE `id`='".$pers['id']."' LIMIT 1;")){
				echo '�� ������� ��������:<br>'.$_GET['string'].'<br>���������:&nbsp;'.$_GET['sum'].'$';
			}else{echo '������ (id: ddparams-3).&nbsp;���������� ��� ���.&nbsp;���� ����������:&nbsp; �������� ��������� �������������.';}
		}else{echo '������������ �����.<br>(������ ������������ � $).<br>��������� ��������� DLR �� $.&nbsp;���������� ��� ���';}
	}else{echo '������!<br>���������� ��� ���.';}
}else{
echo '������!<br>���������� ��� ���.';
}































?>