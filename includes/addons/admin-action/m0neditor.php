<?php

	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
		return (($g)?$g.' <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������>  ':'').(($s)?$s.' <img src=http://img.legendbattles.ru/image/silver.png width=14 height=14 valign=middle title=�������> ':'').(($b)?$b.' <img src=http://img.legendbattles.ru/image/bronze.png width=14 height=14 valign=middle title=������> ':'');
	}
// mZer0ne Domain verification
if(getenv("HTTP_HOST") != 'legendbattles.ru')
	exit('Invalid License: &copy; <a href="http://dapf.us/members/mzer0ne.1341/" target="_blank">mZer0ne</b>');
// Source
$SvParams = array(
	'DECODE'=>array("LI"=>"72","HP"=>"73","MP"=>"74","US"=>"75","R_ST"=>"76","R_MF"=>"77","RB_ST"=>"78","RB_MF"=>"79"),
	'ENCODE'=>array("72"=>"LI","73"=>"HP","74"=>"MP","75"=>"US","76"=>"R_ST","77"=>"R_MF","78"=>"RB_ST","79"=>"RB_MF")
);
$ItemsParams = array(
	'DECODE'=>array("expbonus"=>"72","massbonus"=>"73"),
	'ENCODE'=>array("72"=>"expbonus","73"=>"massbonus")
);
// �������� ����� ���� � ���������
if($_GET['type'] == 'items'){ // ����
	if(!empty($_POST)){
		// ������������ �����
		$Effects = explode("|", $_POST['param']);
		$ParamFirst = '';
		foreach($Effects as $Effect){
			$Params = explode("@", $Effect);
			$ParamFirst .= ($ItemsParams['ENCODE'][$Params[0]] ? $ItemsParams['ENCODE'][$Params[0]] : $Params[0]) . "@" . $Params[1] . "|";
		}
		$GetItem['param'] = substr($ParamFirst,0,strlen($ParamFirst)-1);
		$update = '';
		foreach($_POST as $key=>$val){
			$update .= "`".$key."`='".$val."',";
		}
		if(mysql_query("UPDATE `items` SET " . substr($update,0,strlen($update)-1) . " WHERE `id`='".intval($_GET['id'])."'")){
			echo"<script>parent.jAlert('��������� ���������.');</script>";
		}		
	}
	$Editor = 'items';
	$GetItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".intval($_GET['id'])."'"));
	
	// ������������ �����
	$Effects = explode("|", $GetItem['param']);
	$ParamFirst = '';
	foreach($Effects as $Effect){
		$Params = explode("@", $Effect);
		$ParamFirst .= ($ItemsParams['DECODE'][$Params[0]] ? $ItemsParams['DECODE'][$Params[0]] : $Params[0]) . "@" . $Params[1] . "|";
	}
	$GetItem['param'] = substr($ParamFirst,0,strlen($ParamFirst)-1);
}else if($_GET['type'] == 'tavern'){ // �������
	if(!empty($_POST)){
		// �������� ������� � �������
		$Effects = explode("|", $_POST['param']);
		$EncodeParams = '';
		foreach($Effects as $Effect){
			$Params = explode("@", $Effect);
			if($Params[0] == '78' or $Params[0] == '79'){
				$tmpParams = explode("-", $Params[1]);
				$EncodeParams .= $SvParams['ENCODE'][$Params[0]]."|".$tmpParams[0]."|".intval($_POST['time'])."|".$tmpParams[1]."|1@";
			}else if($Params[0] == '73' or $Params[0] == '74' or $Params[0] == '75'){
				$EncodeParams .= ($SvParams['ENCODE'][$Params[0]] ? $SvParams['ENCODE'][$Params[0]] : $Params[0]) . "|" . $Params[1] . "@";
			}else{
				$EncodeParams .= ($SvParams['ENCODE'][$Params[0]] ? $SvParams['ENCODE'][$Params[0]] : $Params[0]) . "|" . $Params[1] . "|".intval($_POST['time'])."@";
			}
		}
		if($_POST['need'] != ''){
			$Effects = explode("|", $_POST['need']);
			$EncodeParams .= "EFF|".intval($_POST['time'])."@";
			foreach($Effects as $Effect){
				$Params = explode("@", $Effect);
				if($Params[0] == '78' or $Params[0] == '79'){
					$tmpParams = explode("-", $Params[1]);
					$EncodeParams .= $SvParams['ENCODE'][$Params[0]]."|".$tmpParams[0]."|".intval($_POST['time'])."|".$tmpParams[1]."|-1@";
				}else if($Params[0] == '73' or $Params[0] == '74' or $Params[0] == '75'){
					$EncodeParams .= ($SvParams['ENCODE'][$Params[0]] ? $SvParams['ENCODE'][$Params[0]] : $Params[0]) . "|" . $Params[1] . "@";
				}else{
					$EncodeParams .= ($SvParams['ENCODE'][$Params[0]] ? $SvParams['ENCODE'][$Params[0]] : $Params[0]) . "|" . $Params[1] . "|".intval($_POST['time'])."@";
				}
			}
		}
		$_POST['effects'] = substr($EncodeParams,0,strlen($EncodeParams)-1);
		
		unset($_POST['param'], $_POST['need'], $_POST['time']);
	
		$update = '';
		foreach($_POST as $key=>$val){
			$update .= "`".$key."`='".$val."',";
		}
		if(mysqli_query($GLOBALS['db_link'],"UPDATE `tavern` SET " . substr($update,0,strlen($update)-1) . " WHERE `id`='".intval($_GET['id'])."'")){
			echo"<script>parent.jAlert('��������� ���������.');</script>";
		}
	}
	
	$Editor = 'tavern';
	$GetItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `tavern` WHERE `id`='".intval($_GET['id'])."'"));
	
	// ��������� �������
	$Effects = explode("@", $GetItem['effects']);
	$ParamFirst = $ParamSecond = '';
	$EffectTime = 0;
	$Step = 0;
	foreach($Effects as $Effect){
		$Params = explode("|", $Effect);
		if($Step == 0 and $Params[0] != 'EFF'){
			if($Params[0] == 'RB_ST' or $Params[0] == 'RB_MF'){
				$ParamFirst .= ($SvParams['DECODE'][$Params[0]] ? $SvParams['DECODE'][$Params[0]] : $Params[0]) . '@' . $Params[1] . '-' . $Params[3] . '|';
			}else{
				$ParamFirst .= ($SvParams['DECODE'][$Params[0]] ? $SvParams['DECODE'][$Params[0]] : $Params[0]) . '@' . $Params[1] . '|';
			}
		}else if($Step == 1){
			if($Params[0] == 'RB_ST' or $Params[0] == 'RB_MF'){
				$ParamSecond .= ($SvParams['DECODE'][$Params[0]] ? $SvParams['DECODE'][$Params[0]] : $Params[0]) . '@' . $Params[1] . '-' . $Params[3] . '|';
			}else{
				$ParamSecond .= ($SvParams['DECODE'][$Params[0]] ? $SvParams['DECODE'][$Params[0]] : $Params[0]) . '@' . $Params[1] . '|';
			}
		}
		$EffectTime = $Params[2] ? $Params[2] : $EffectTime;
		if($Params[0] == 'EFF'){
			$Step = 1;
		}
	}
	// ��������� ����������
	$GetItem['need'] = substr($ParamSecond,0,strlen($ParamSecond)-1);
	$GetItem['param'] = substr($ParamFirst,0,strlen($ParamFirst)-1);
	$GetItem['dd_price'] = $GetItem['count'];
	$GetItem['gif'] = $GetItem['img'];
	$GetItem['level'] = $GetItem['LI'];
	$GetItem['massa'] = $EffectTime;
}

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<script language="JavaScript" src="/js/editor/'.$Editor.'.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="/css/meditor.css" />
</head>
<body>
<script type="text/javascript">
var params = ["'.$GetItem['name'].'","'.$GetItem['gif'].'","'.lr($GetItem['price']).'","'.$GetItem['dd_price'].'","'.$GetItem['type'].'","'.$GetItem['slot'].'","'.$GetItem['level'].'","'.$GetItem['massa'].'","'.$GetItem['param'].'","'.$GetItem['need'].'","'.$GetItem['block'].'"];
';
if($_GET['type'] == 'items'){
	echo'var all_params = [[["0","����������",""],["1","����",""],["2","�������������",""],["3","��������",""],["4","��������",""],["5","������",""],["6","��������",""],["7","����������",""],["8","���������",""],["9","����� �����",""],["10","������ �����",""],["11","������ ������� ������","%"],["12","������ ������� ������","%"],["13","������ ����������� ������","%"],["14","������ ����������� ������","%"],["15","������ ������� ������","%"],["16","������ �������� ������","%"],["17","������ ���������� ������","%"],["18","������ �������� ������","%"],["19","������ �� ������� ������",""],["20","������ �� ������� ������",""],["21","������ �� ����������� ������",""],["22","������ �� ����������� ������",""],["23","������ �� ������� ������",""],["24","������ �� �������� ������",""],["25","������ �� ���������� ������",""],["26","������ �� �������� ������",""],["27","��",""],["28","���� ��������",""],["29","����",""],["30","����",""],["31","�����������",""],["32","�������",""],["33","��������",""],["34","�����",""],["35","��������",""],["36","�������� ������","%"],["37","�������� ��������","%"],["38","�������� �������� �������","%"],["39","�������� ������","%"],["40","�������� ����������� �������","%"],["41","�������� ���������� � �������","%"],["42","�������� ��������","%"],["43","�������� ������������ �������","%"],["44","�������� ��������� �������","%"],["45","����� ����","%"],["46","����� ����","%"],["47","����� �������","%"],["48","����� �����","%"],["49","������������� ����� ����","%"],["50","������������� ����� ����","%"],["51","������������� ����� �������","%"],["52","������������� ����� �����","%"],["53","���������","%"],["54","������������","%"],["55","����������","%"],["56","����������������","%"],["57","��������","%"],["58","��������","%"],["59","�������","%"],["60","�������","%"],["61","��������� ����","%"],["62","�����������","%"],["63","���������","%"],["64","������","%"],["65","�����������","%"],["66","������� �������������� ����","%"],["67","���������","%"],["68","�������","%"],["69","�������� ������� ����","%"],["70","������������","%"],["71","�����������","%"],["72","����� �����","%"],["73","����� �����",""]],[["28","���� ��������"],[""],["30","����"],["31","�����������"],["32","�������"],["33","��������"],["34","�����"],["35","��������"],["36","�������� ������"],["37","�������� ��������"],["38","�������� �������� �������"],["39","�������� ������"],["40","�������� ����������� �������"],["41","�������� ���������� � �������"],["42","�������� ��������"],["43","�������� ������������ �������"],["44","�������� ��������� �������"],["45","����� ����"],["46","����� ����"],["47","����� �������"],["48","����� �����"],[""],[""],[""],[""],["53","���������"],["54","������������"],["55","����������"],["56","����������������"],["57","��������"],["58","��������"],["59","�������"],["60","�������"],["61","��������� ����"],["62","�����������"],["63","���������"],["64","������"],["65","�����������"],["66","������� �������������� ����"],["67","���������"],["68","�������"],["69","�������� ������� ����"],["70","������������"]]];';
}else if($_GET['type'] == 'tavern'){
	echo'var all_params = [[[""],["1","����",""],["2","�������������",""],["3","��������",""],["4","��������",""],["5","������",""],["6","��������",""],["7","����������",""],["8","���������",""],["9","����� �����",""],["10","������ �����",""],["11","������ ������� ������","%"],["12","������ ������� ������","%"],["13","������ ����������� ������","%"],["14","������ ����������� ������","%"],["15","������ ������� ������","%"],["16","������ �������� ������","%"],["17","������ ���������� ������","%"],["18","������ �������� ������","%"],["19","������ �� ������� ������",""],["20","������ �� ������� ������",""],["21","������ �� ����������� ������",""],["22","������ �� ����������� ������",""],["23","������ �� ������� ������",""],["24","������ �� �������� ������",""],["25","������ �� ���������� ������",""],["26","������ �� �������� ������",""],["27","��",""],["28","���� ��������",""],["29","����",""],["30","����",""],["31","�����������",""],["32","�������",""],["33","��������",""],["34","�����",""],["35","��������",""],["36","�������� ������","%"],["37","�������� ��������","%"],["38","�������� �������� �������","%"],["39","�������� ������","%"],["40","�������� ����������� �������","%"],["41","�������� ���������� � �������","%"],["42","�������� ��������","%"],["43","�������� ������������ �������","%"],["44","�������� ��������� �������","%"],["45","����� ����","%"],["46","����� ����","%"],["47","����� �������","%"],["48","����� �����","%"],["49","������������� ����� ����","%"],["50","������������� ����� ����","%"],["51","������������� ����� �������","%"],["52","������������� ����� �����","%"],["53","���������","%"],["54","������������","%"],["55","����������","%"],["56","����������������","%"],["57","��������","%"],["58","��������","%"],["59","�������","%"],["60","�������","%"],["61","��������� ����","%"],["62","�����������","%"],["63","���������","%"],["64","������","%"],["65","�����������","%"],["66","������� �������������� ����","%"],["67","���������","%"],["68","�������","%"],["69","�������� ������� ����","%"],["70","������������","%"],["71","�����������","%"],["72","�����",""],["73","�������������� HP",""],["74","�������������� MP",""],["75","���������",""],["76","��������� ����",""],["77","��������� ��",""],["78","��������� ����(��-��)",""],["79","��������� ��(��-��)",""]],[[""],["1","����",""],["2","�������������",""],["3","��������",""],["4","��������",""],["5","������",""],["6","��������",""],["7","����������",""],["8","���������",""],["9","����� �����",""],["10","������ �����",""],["11","������ ������� ������","%"],["12","������ ������� ������","%"],["13","������ ����������� ������","%"],["14","������ ����������� ������","%"],["15","������ ������� ������","%"],["16","������ �������� ������","%"],["17","������ ���������� ������","%"],["18","������ �������� ������","%"],["19","������ �� ������� ������",""],["20","������ �� ������� ������",""],["21","������ �� ����������� ������",""],["22","������ �� ����������� ������",""],["23","������ �� ������� ������",""],["24","������ �� �������� ������",""],["25","������ �� ���������� ������",""],["26","������ �� �������� ������",""],["27","��",""],["28","���� ��������",""],["29","����",""],["30","����",""],["31","�����������",""],["32","�������",""],["33","��������",""],["34","�����",""],["35","��������",""],["36","�������� ������","%"],["37","�������� ��������","%"],["38","�������� �������� �������","%"],["39","�������� ������","%"],["40","�������� ����������� �������","%"],["41","�������� ���������� � �������","%"],["42","�������� ��������","%"],["43","�������� ������������ �������","%"],["44","�������� ��������� �������","%"],["45","����� ����","%"],["46","����� ����","%"],["47","����� �������","%"],["48","����� �����","%"],["49","������������� ����� ����","%"],["50","������������� ����� ����","%"],["51","������������� ����� �������","%"],["52","������������� ����� �����","%"],["53","���������","%"],["54","������������","%"],["55","����������","%"],["56","����������������","%"],["57","��������","%"],["58","��������","%"],["59","�������","%"],["60","�������","%"],["61","��������� ����","%"],["62","�����������","%"],["63","���������","%"],["64","������","%"],["65","�����������","%"],["66","������� �������������� ����","%"],["67","���������","%"],["68","�������","%"],["69","�������� ������� ����","%"],["70","������������","%"],["71","�����������","%"],["72","�����",""],["73","�������������� HP",""],["74","�������������� MP",""],["75","���������",""],["76","��������� ����",""],["77","��������� ��",""],["78","��������� ����(��-��)",""],["79","��������� ��(��-��)",""]]];';
}
echo'
ShowEditor();
$("adminMenu").style.display = "none";
$("mainTable").style.width = "100%";
</script>
</body>
</html>';