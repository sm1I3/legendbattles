<?php
if ($pers['clan_id'] == 'Life' or $pers['clan_id'] == 'Служители порядка' or $pers['clan_id'] == 'Верховная Инквизиция' or $pers['clan_id'] == 'Мэрия города') {
$build = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `locations` WHERE `id` = '".$pers['loc']."'"));
echo'
<HTML>
<HEAD>
<META Http-Equiv="Content-Type" Content="text/html; charset=UTF-8">
<META Http-Equiv="Cache-Control" Content="No-Cache">
<META Http-Equiv="Pragma" Content="No-Cache">
<META Http-Equiv="Expires" Content="0">
<LINK href="/css/frame.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/NewDesign.css" rel="STYLESHEET" type="text/css">
<!--[if lt IE 7]>
<LINK href="/css/iepng.css" rel="STYLESHEET" type="text/css">
<![endif]-->
<SCRIPT src="/js/building_v03.js?v1"></SCRIPT>
<SCRIPT src="/js/ajax.js"></SCRIPT>
<SCRIPT src="/js/signs.js"></SCRIPT>
<SCRIPT src="/js/hpmp.js"></SCRIPT>
<SCRIPT src="/js/t_v01.js"></SCRIPT>
<SCRIPT src="/js/basic.js"></SCRIPT>
<SCRIPT src="/js/hpv_v01.js?v22032013bymozg"></SCRIPT>
<SCRIPT src="/js/items.js"></SCRIPT>
<SCRIPT src="/js/quest.js"></SCRIPT>
<SCRIPT src="/js/stooltip.js?v11"></SCRIPT>
<SCRIPT src="/js/FormUp_v01.js"></SCRIPT>
</HEAD>
<BODY>

<SCRIPT language="JavaScript">
';
if($pers['fcolor_time']>time() or $pers['fcolor_time']==0){
	$nickclr = $pers['fcolor'];
}else{$nickclr='000000';}
echo "var fcolor = ['".$nickclr."',''];";
echo'
var inshp = ['.InsHP().'];
var vcode = [[1,"'.vCode().'"],[1,"'.vCode().'"],[1,"'.vCode().'"]];
var build = ["'.$pers['login'].'","'.$pers['level'].'/'.$pers['u_lvl'].'",'.$pers['sklon'].',"'.$pers['clan_gif'].'","'.$pers['clan'].'","'.$pers['clan_d'].'",'.$build['but'].',"main","'.$build['disbut'].'","'.$build['textid'].'",0,0,"'.(($build['quest'])?vCode():'').'"];
var hpv = ['.$pers['id'].','.$pers['clan_accesses'].'];
var ajaxp = ["'.vCode().'"];
view_hpv();
</SCRIPT>
';
echo'
</BODY>
</HTML>';
}
else{
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`='1',`pos`='8_4' WHERE `id`='".$pers['id']."' LIMIT 1;");
	$redirect="parent.frames['main_top'].location='main.php';";
	echo "<script>".$redirect."</script>";
}
?>