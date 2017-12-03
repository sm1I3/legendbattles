<?php
// Source
if($_GET['get_id'] == '41'){
	$getId = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `tavern` WHERE `id`='" . intval($_GET['id']) . "'"));
	$javaQuery = '';
	if($getId){
		if($getId['count'] > 0){
            $Effects = explode("@", $getId['effects']); // Список эффектов
            $ArrStats = array(30, 31, 32, 33, 34); // Рандомные статы
            $ArrMf = array(5, 6, 7, 8, 9); // Рандомные МФ
			$ParamFirst = $ParamSecond = '';
			$updHPMP = false;
			$EffectTime = 0;
			$Step = 0;
			foreach($Effects as $Effect){
				$Params = explode("|", $Effect);
				if($Step == 0 and $Params[0] != 'EFF'){
					if($Params[0] == 'R_ST'){
						$ParamFirst .= $ArrStats[rand(0, count($ArrStats)-1)] . '/' . $Params[1] . ';';
					}else if($Params[0] == 'R_MF'){
						$ParamFirst .= $ArrMf[rand(0, count($ArrMf)-1)] . '/' . $Params[1] . ';';
					}else if($Params[0] == 'RB_ST'){
						$ParamFirst .= $ArrStats[rand(0, count($ArrStats)-1)] . '/' . rand($Params[1], $Params[3]) . ';';
					}else if($Params[0] == 'RB_MF'){
						$ParamFirst .= $ArrMf[rand(0, count($ArrMf)-1)] . '/' . rand($Params[1], $Params[3]) . ';';
					}else if($Params[0] == 'HP'){
						$pers['hp'] += $Params[1];
						$updHPMP = true;
					}else if($Params[0] == 'MP'){
						$pers['mp'] += $Params[1];
						$updHPMP = true;
					}else{
						$ParamFirst .= $Params[0] . '/' . $Params[1] . ';';
						$EffectTime = $EffectTime == 0 ? $Params[2] : $EffectTime;
					}
				}else if($Step == 1){
					if($Params[0] == 'R_ST'){
						$ParamSecond .= $ArrStats[rand(0, count($ArrStats)-1)] . '/-' . $Params[1] . ';';
					}else if($Params[0] == 'R_MF'){
						$ParamSecond .= $ArrMf[rand(0, count($ArrMf)-1)] . '/-' . $Params[1] . ';';
					}else if($Params[0] == 'RB_ST'){
						$ParamSecond .= $ArrStats[rand(0, count($ArrStats)-1)] . '/-' . rand($Params[1], $Params[3]) . ';';
					}else if($Params[0] == 'RB_MF'){
						$ParamSecond .= $ArrMf[rand(0, count($ArrMf)-1)] . '/-' . rand($Params[1], $Params[3]) . ';';
					}else{
						$ParamSecond .= $Params[0] . '/-' . $Params[1] . ';';
						$EffectTime = $EffectTime == 0 ? $Params[2] : $EffectTime;
					}
				}
				if($Params[0] == 'EFF'){
					$Step = 1;
				}
			}
			if($updHPMP == true){
				if($pers['hp']>$pers['hp_all']){
					$pers['hp']=$pers['hp_all'];
				}
				if($pers['mp']>$pers['mp_all']){
					$pers['mp']=$pers['mp_all'];
				}
				$hps=$pers['hp_all']/$pers['hps'];
				$mps=$pers['mp_all']/$pers['mps'];
				$chp=time()+(($pers['hp_all']-$pers['hp'])/$hps);
				$cmp=time()+(($pers['mp_all']-$pers['mp'])/$mps);
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `hp`='".$pers['hp']."', `mp`='".$pers['mp']."', `chp`='".$chp."', `cmp`='".$cmp."' WHERE `id`='".$pers['id']."'");
			}
			if($ParamFirst){
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `affect`='" . $pers['affect'] . substr($ParamFirst,0,strlen($ParamFirst)-1) . "@" . (time()+($EffectTime*60)) . "@".$getId['id']."|' WHERE `id`='" . $pers['id'] . "'");
			}
			if($ParamSecond){
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `tavern_eff` (`effId`, `userId`, `updateTime`, `params`) VALUES ('" . $getId['id'] . "', '" . $pers['id'] . "', '" . (time()+($EffectTime*60)) . "', '" . substr($ParamSecond,0,strlen($ParamSecond)-1) . '@' .(time()+(($EffectTime*60)*2)) . "@".$getId['id']."');");
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$getId['price']."' WHERE `id`='" . $pers['id'] . "'");
			mysqli_query($GLOBALS['db_link'],"UPDATE `tavern` SET `count`=`count`-'1' WHERE `id`='" . $getId['id'] . "'");
            echo "<script>parent.jAlert('Вы использовали &quot;" . $getId['name'] . "&quot;');</script>";
			$javaQuery = 'TavernaShow('.$getId['type'].');';
		}
	}
}
$build = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `locations` WHERE `id` = '".$pers['loc']."'"));
$VersJS = 'v1';
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
<META Http-Equiv="Content-Type" Content="text/html; charset=windows-1251">
<META Http-Equiv="Cache-Control" Content="No-Cache">
<META Http-Equiv="Pragma" Content="No-Cache">
<META Http-Equiv="Expires" Content="0">
<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/frame.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<LINK href="/css/stl.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<LINK href="/css/NewDesign.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<!--[if lt IE 7]>
<LINK href="/css/iepng.css" rel="STYLESHEET" type="text/css">
<![endif]-->
<SCRIPT src="/js/building_v03.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/ajax.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/signs.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/hpmp.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/t_v01.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/basic.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/taverna_v02.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/items.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/quest.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/stooltip.js?'.$VersJS.'"></SCRIPT>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/scroll.js"></script>
</HEAD>
<BODY>
<SCRIPT language="JavaScript">';
if($pers['fcolor_time']>time() or $pers['fcolor_time']==0){
	$nickclr = $pers['fcolor'];
}else{$nickclr='000000';}
echo "var fcolor = ['".$nickclr."',''];";
echo'
var inshp = ['.InsHP().'];
var vcode = [[1,"'.vCode().'"],[1,"'.vCode().'"],[1,"'.vCode().'"]];
var build = ["'.$pers['login'].'","'.$pers['level'].'/'.$pers['u_lvl'].'",'.$pers['sklon'].',"'.$pers['clan_gif'].'","'.$pers['clan'].'","'.$pers['clan_d'].'",'.$build['but'].',"main","'.$build['disbut'].'","'.$build['textid'].'",0,0,"'.(($build['quest'])?vCode():'').'"];
var taverna = ['.$pers['nv'].',"'.vCode().'"];
view_taverna();
'.($javaQuery ? $javaQuery : '').'
</SCRIPT>

</BODY>
</HTML>';