<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
header('Content-type: text/html; charset=windows-1251');

if(!empty($_POST)){
	// ��������� �����
	$_POST["reg-user"] = addslashes(trim((iconv("UTF-8","Windows-1251",urldecode($_POST["reg-user"]))?iconv("UTF-8","Windows-1251",urldecode($_POST["reg-user"])):urldecode($_POST["reg-user"]))));
	// ������ ��������
	if (empty($_POST["reg-user"]) or strlen($_POST["reg-user"]) < 4 or strlen($_POST["reg-user"]) > 21){
		exit('ERR@1');// �������� ����� ������
	}
	if(testchr($_POST["reg-user"])){
		exit('ERR@2'); // ���������� �������� �������
	}
	if(GetUser($_POST["reg-user"])){
		exit('ERR@3'); // ������������ ��� ���������������
	}
	preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i",$_POST['reg-email']) or die('ERR@4'); // �������� E-Mail
	preg_match("/^([0-2][0-9]|[3][0-1]).([0][0-9]|[1][0-2]).[0-9]{4}$/",$_POST['reg-bday']) or die('ERR@5'); // ���
	if($_POST['reg-sexuser'] !='male' and $_POST['reg-sexuser'] !='female'){ // ��� � ��� �������� �������� ;)
		exit('ERR@6');
	}
	// ���� ��� ��������� �� ��� ������������ ���������
	$UserPassword = generate_password(rand(6,8));
	$val_bdate=varcheck($_POST['reg-bday']);
	// ���� ����
	send_mail($_POST['reg-email'],'����������� ������ ������������','������������, '.$_POST['reg-user'].'!<br><br>�� ������� ������������������ � ������� Legend Battles.<br />��� ���� ������� ������:<br />�����: <b>'.$_POST['reg-user'].'</b><br />������: <b>'.$UserPassword.'</b><br /><br /><br />� ���������� �����������,<br />������������� ���� Legend Battles.<br />www.LegendBattles.ru<br /><br />');
	// ��������� ������� � ����
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `user` (`login`,`pass`,`email`,`bday`,`sex`,`thotem`,`bdaypers`,`obraz`,`ip`) VALUES ('".$_POST['reg-user']."','".md5($UserPassword)."','".$_POST['reg-email']."','".$val_bdate."','".$_POST['reg-sexuser']."','".rand(0,11)."','".time()."','".$_POST['reg-sexuser'].".gif"."','".getIP()."')");
	// ���� ���� �������� �������� ������ ->>>>
	if($_SESSION['referal_id'] and $_SESSION['referal']){
		$ReferalID = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`login` FROM `user` WHERE `id`='".mysqli_insert_id($GLOBALS['db_link'])."' LIMIT 1;"));
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `ref_system` (`who_id`,`who_login`,`ref_id`,`ref_login`,`time`) VALUES ('".$_SESSION['referal_id']."','".$_SESSION['referal']."','".$ReferalID['id']."','".$ReferalID['login']."','".time()."');");
	}
	// ������� ��� ��� ��, � ��������� ����
	exit('OK@' . $UserPassword);
}