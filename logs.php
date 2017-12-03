<?php
include($_SERVER["DOCUMENT_ROOT"].'/includes/ks_antiddos.php');

$ksa = new ks_antiddos();
$ksa->doit(20,20);

session_start();
function savelog($log,$bat){
	$fp = fopen ($_SERVER["DOCUMENT_ROOT"]."/logs/".$bat.".txt","a");
	fwrite($fp,$log."\n");
	fclose($fp);
}
function show_log($id,$start,$mcount){
	$lines = file($_SERVER["DOCUMENT_ROOT"]."/logs/".$id.".txt");
	$num = count($lines);
	$res='';
	for($i=$start;$i<($start + $mcount);$i++){
		$res .= $lines[$i];
	}
	return $res;
}
if(is_file($_SERVER["DOCUMENT_ROOT"]."/logs/".intval($_GET['fid']).".txt")){
	$lines = file($_SERVER["DOCUMENT_ROOT"]."/logs/".intval($_GET['fid']).".txt");
}
$num = ceil(count($lines)/10);
if(!isset($_GET['p']) or $_GET['p']==1){$p1=0;$_GET['p']=1;}else{$p1=$_GET['p']*10-11;}
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<HEAD>
<TITLE>Ћог бо€ - ∆изнь сильнейших.. »информация браузерной онлайн игры legendbattles </TITLE>
<LINK href="/css/logs.css" rel="STYLESHEET" type="text/css">
<META Http-Equiv="Content-Type" Content="text/html; charset=windows-1251">
<META Http-Equiv="Cache-Control" Content="No-Cache">
<META Http-Equiv="Pragma" Content="No-Cache">
<META Http-Equiv="Expires" Content="0">
<SCRIPT src="/js/signs.js"></SCRIPT>
<SCRIPT src="/js/vlogs.js"></SCRIPT>
<SCRIPT src="/js/png.js"></SCRIPT>
<SCRIPT src="/js/top.js"></SCRIPT>
<SCRIPT src="/js/ft_v01.js"></SCRIPT>
</HEAD>
</head>
<body>
<SCRIPT language="JavaScript">
var d = document;
';
if(!isset($_GET['stat'])){ 
	echo'var logs = [';
	if(is_file($_SERVER["DOCUMENT_ROOT"]."/logs/".intval($_GET['fid']).".txt")){
		echo show_log(intval($_GET['fid']),$p1,10);
	}
	echo'];';
}
echo'var params = ['.$num.','.($_GET['stat']+1).','.intval($_GET['fid']).','.$p.',1];
var show = '.($_GET['stat']+1).';
var off = '.((is_file($_SERVER["DOCUMENT_ROOT"]."/stats/".intval($_GET['fid']).".txt"))?'1':'0').';
';
	echo'var lives_g1 = ['.$livg1.'];
var lives_g2 = ['.$livg2.'];';

echo'
viewlog();
</SCRIPT>
</body>
</html>
';
?>