<?php
// mZer0ne Domain verification
session_start();
header('Content-type: text/html; charset=windows-1251');
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

$pers = GetUser($_SESSION['user']['login']);

function BuildBut($array){
	foreach($array as $pars){
		$requests = '';
		for($i=0;$i<count($pars);$i++){
			$requests .= '"'.$pars[$i].'",'; 
		}
		$return[] = '['.substr($requests,0,strlen($requests)-1).']';
	}
	return implode(",",$return);
}
	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
        return (($g) ? $g . ' <img src=/img/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=/img/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
	}

function ConvertParams($params){
	$params = explode("@",$params);
	foreach($params as $pars){
		$pars = explode("|",$pars);
		$array[] = $pars;
	}
	return BuildBut($array);
}

$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `tavern` WHERE `type`='" . intval($_GET['type']) . "'");
$response = '1';
while($row = mysqli_fetch_assoc($Query)){
    $response .= '@' . $row['id'] . '|' . $row['count'] . '|' . $row['img'] . '|' . $row['name'] . '|' . lr($row['price']) . "|['" . $row['name'] . "'," . ConvertParams((($row['LI'] > 0) ? "LI|" . $row['LI'] . "@" : 'LI@') . $row['effects']) . "]|[[" . (($row['count'] > 0 && $pers['nv'] >= $row['price']) ? "'fr_but','Выпить',1" : "'fr_but_dis','Выпить',0") . "],[" . (($row['count'] > 0 && $pers['nv'] >= $row['price']) ? BuildBut(array(array('get_id', '41'), array('id', $row['id']), array('vcode', vCode()))) : '') . "]]";
}
exit($response);