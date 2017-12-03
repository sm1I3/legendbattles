<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>
<div id="back" style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;"></div>
<div style="padding-left:39px; text-align:left; padding-top:0px;" id="draw_pers_info"></div>
<div style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;" id="popup"></div>
<html>
<META content="text/html; charset=windows-1251" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
<script type="text/javascript" src="js/interface/get_windows2.js?"></script>
<LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
<SCRIPT type="text/javascript" src="js/frame_loc.js"></SCRIPT>
<script language="JavaScript" type="text/JavaScript" src="js/png.js"></script>
</HEAD>
<body>

<TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr valign=top><td>


<table width=100% cellspacing=0 border=0 cellpadding=0>
<td valign=top>
<div class="block info">
	<div class="header">
<img  src='http://tltonline.ru/img/user/266249.jpg' width='500' height='362'>
</div>


<td width=0 valign=top style="width: 100%;">
<table width=80% cellspacing=0 cellpadding=0  border=0 style="width: 100;">
<tr><td align=center>

<?
function Dom($level,$count){
	global $player;
	$fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
	if(!empty($levelmin)){
		$Whesr = " AND level>='".$levelmin."' AND level<='".$levelmax."'";
	}else{
		$Whesr = '';
	}
	$tmp1 = explode("|",$level);

    foreach ($tmp1 as $tmp) {
    $e = explode("=",$tmp);
		$bot[$i] = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`hp_all`,`mp_all`,`aura` FROM `user` WHERE `fight`='0' AND `id`='".$e[1]."'"));
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `fight_users` (`id`,`hp`,`mp`,`battle`,`aura`) VALUES ('".$bot[$i]['id']."','".$bot[$i]['hp_all']."','".$bot[$i]['mp_all']."','".$fid."','".$bot[$i]['aura']."');");
	}
	save_hp_roun($player);
	db_query('UPDATE `user` SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `fight_users` (`id`,`hp`,`mp`,`battle`,`side`,`aura`) VALUES ('".$player['id']."','".$player['hp']."','".$player['mp']."','".$fid."','1','".$player['aura']."');");

	$log=',[[0,"'.date("H:i").'"],"Бой между "';
	$LeftTeam=mysqli_query($GLOBALS['db_link'],"SELECT `fight_users`.`side`,`fight_users`.`battle`,`user`.`level`,`user`.`sklon`,`user`.`clan_gif`,`user`.`login`,`user`.`invisible` FROM `fight_users`,`user` WHERE `fight_users`.`id` = `user`.`id` AND `fight_users`.`battle`='".$fid."' AND `fight_users`.`side` = '1'");
	while ($val = mysqli_fetch_assoc($LeftTeam)) {
		if($val['side']=='1'){
			if($val['invisible']<time()){
				$log.=',[1,'.$val['side'].',"'.$val['login'].'",'.$val['level'].','.$val['sklon'].',"'.(($val['clan_gif']!='chaos.gif')?$val['clan_gif']:'').'"],","';
			}else{
				$log.=',[4,'.$val['side'].'],","';
			}
		}
	}
	$log=substr_replace($log, '', -3);
	$log .= '" и "';
	$RightTeam=mysqli_query($GLOBALS['db_link'],"SELECT `fight_users`.`side`,`fight_users`.`battle`,`user`.`level`,`user`.`sklon`,`user`.`clan_gif`,`user`.`login`,`user`.`invisible` FROM `fight_users`,`user` WHERE `fight_users`.`id` = `user`.`id` AND `fight_users`.`battle`='".$fid."' AND `fight_users`.`side` = '2'");
	while ($val = mysqli_fetch_assoc($RightTeam)) {
		if($val['side']=='2'){
			if($val['invisible']<time()){
				$log.=',[1,'.$val['side'].',"'.$val['login'].'",'.$val['level'].','.$val['sklon'].',"'.(($val['clan_gif']!='chaos.gif')?$val['clan_gif']:'').'"],","';
			}else{
				$log.=',[4,'.$val['side'].'],","';
			}
		}
	}
	$log=substr_replace($log, '', -3);
	$log.='" начался (нападение в погребе)."]';
	savelog($log,$fid);
	db_query('UPDATE arena SET vis="0", t2='.AP.time().AP.' WHERE id_battle ='.AP.$fid.AP.'LIMIT 1;');
	mysqli_query($GLOBALS['db_link'],"UPDATE `fight_users` SET `fight` = '2' WHERE `battle` = '".$fid."'");
	db_query('UPDATE user SET fight="2" WHERE `battle`='.AP.$fid.AP);
	save_hp_all($fid);
	$_SESSION["idf"] = $fid;
}

## Считываем персонажа в инсте.
$prizes = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`login`,`level`,`time`,`type`,`ohr` FROM `instant` WHERE uid=".$player["id"]." and type=0 LIMIT 1"));

## Если нет персонажа, добавляем ячеку.
if (!$prizes){
mysqli_query($GLOBALS['db_link'],"INSERT INTO `instant` (`id`,`uid`,`login`,`level`,`time`,`type`,`ohr`) VALUES (NULL,'".$player["id"]."','".$player["login"]."','0','0','0','0')");
echo "<script>location='main.php';</script>";
}




## Если время инстанта обновлено
$prizesTime = $prizes["time"];
if ($prizes["time"]>time()){
	$prizes['time']-=time();
	$ch=floor($prizes['time']/3600);
	$min=floor(($prizes['time']-($ch*3600))/60);
	$sec=floor(($prizes['time']-($ch*3600))%60);
echo "Следующее посещение возможно через: <b id='updateTimer'>".(($ch<10)?'0'.$ch:$ch).":".(($min<10)?'0'.$min:$min).":".(($sec<10)?'0'.$sec:$sec)."</b>";
}
## Если прошел последний ур.
if ($prizes["level"]>=6){
$time_in = time()+21600;
mysqli_query($GLOBALS['db_link'],"UPDATE `instant` SET `level`='0',`time`='".$time_in."' WHERE `uid`='".$player['id']."' and `type`=0");
echo "<script>location='main.php';</script>";
}
?>
<script>
var timer = <?php echo $prizes["time"]; ?>;
function updatePrizesTime(){
    var h,m,s,time;
	time = timer -= 1;
    h = m = 0;
    if(time > 0) h = parseInt(time / 3600);
    time -= 3600 * h;
    if(time > 0) m = parseInt(time / 60);
    time -= 60 * m;
    s = time;
    document.getElementById('updateTimer').innerHTML = (h < 10 ? '0'+h : h)+':'+(m < 10 ? '0'+m : m)+':'+(s < 10 ? '0'+s : s);
}
setInterval(updatePrizesTime, 1000);
</script>
<div class="block info">
	<div class="header">
<form method="post" action="">
<input name="att_dom" type="submit" class=lbut value="Осмотреть погреб" style='width:180px;'>
<? echo "<center>(<b>".$prizes["level"]."</b> уровень)</center>"; ?>
</form>
<? /*<form method="post" action="">
<input name="priroda" type="submit" class=lbut value="Природа" style='width:180px;'>
</from>
*/
?>
</div>
<?
if ($_POST["priroda"]){
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`=28,`pos`='141_130' WHERE `id`='".$player["id"]."' LIMIT 1");
echo "<script>location='main.php';</script>";
}
?>



<?
if(!empty($_POST['att_dom'])) {
if ($player["level"]<10 and $prizes["ohr"] == 0)
$secrets = 'Стражник загородил проход к двери погреба,<br /> Здравствуйте, <b>'.$player["login"].'</b>. <br />Вы слишком малы и не сможете защитится от возможных опасностей в погребе.</b><br /><a href=main.php?vz=ok>Дать взятку (1 WMB).</a> ';
else{
$text = 'Стражник загородил проход ко входу в погреб,<br />Здравствуйте, <b>'.$player["login"].'</b>, ходят слухи, что погреб полон нечистой силой,<br />Мы хотим огорадить жителей от опасностей, которые прячутся там,<br />По этому я настоятельно  рекомендую не входить в погреб...<br />Ну, а в прочем, решать Вам.<br /><b><a href=main.php?target_dom=ok>Я не боюсь какой - то там нечисти.</a><br /><a href=main.php?>Спасибо сэр, я не пойду в погреб.</a></b> ';
}
}
## Взятка =)
if ($_GET["vz"] == 'ok' and $player["level"]<10){
if ($player["nv"]<1)
$secrets = 'Ха-ха, да Вы беднее, чем мои башмаки...';
else{
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-1 WHERE `id`='".$player["id"]."' LIMIT 1");
$secrets = 'Ваша смелость не знает границ, но пройти я Вам не дам, пока не покажете себя в бою! победите моего напарника и сможете пройти! спасибо за монетку <a href=main.php?vz=attack>Напасть на охранника.</a>';
}
}
## Если чувак смелый =)
if ($_GET["vz"] == 'attack' and $prizes["ohr"] == 0 and $player["level"]<10){
mmysqli_query($GLOBALS['db_link'],"UPDATE `instant` SET `ohr`=1 WHERE `uid`='".$player["id"]."' LIMIT 1");
if ($player["sex"] == 'female'){ $sex = 'смелая'; }else{ $sex = 'смельчак';}
$secrets = 'И в правду, '.$sex.' . Мы не деремся со своим сестрами и братьями. Ладно - можешь проходить, если хочешь умереть быстрой смертью. ';
}

## Время до след. боя
$t_fight = 3600;

if(@$_GET['target_dom'] == 'ok') {
if ($player["level"]<=9 and $player["level"]>=37 and $prizes["ohr"] == 0)
$secrets = 'Главный лесничий всегда нас предупреждает, когда к нам приходит новичек..  ( Вход доступен для 10-15 ур.)';
elseif ($player["level"]>=37)
$secrets = 'Главный лесничий всегда нас предупреждает, когда к нам приходит новичек..  ( Вход доступен для 10-15 ур.)';
elseif ($player["hp"]<$player["hp_all"]*0.6)
$secrets = 'Вы слишком слабы, востановитесь.';
elseif ($prizesTime > time())
$secrets = 'Следующее посещение возможно: <b>'.(($ch<10)?'0'.$ch:$ch).":".(($min<10)?'0'.$min:$min).":".(($sec<10)?'0'.$sec:$sec).'</b>.';
//elseif ($player["groups"]<=0)
//$secrets = 'Необходимо быть в группе.';
//elseif ($player["id"]!=10033 and $player["id"]!=12896)
//$secrets = 'ЗАКРЫТО ПО ТЕХ. ПРИЧИНАМ.';
else{

## Вмешиваемся если там уже идет бой
$gds=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `loc`=997 and `groups`='".$player['groups']."' and `battle`>0"));
$arenka = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `arena` WHERE `id_battle`='".$gds["battle"]."' and `vis`=0"));

if($gds["id"] and $arenka["id_battle"]){
//$btls = mysqli_fetch_array(sql('SELECT * FROM `fights` WHERE `id`='.$drug['battle'].''));
##Вмешиваемся в бой
mysqli_query($GLOBALS['db_link'],"INSERT INTO `fight_users` (`id`,`hp`,`mp`,`battle`,`side`) VALUES ('".$player['id']."','".$player['hp']."','".$player['mp']."','".$gds['battle']."','".$gds['side']."');");
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `side`='".$gds["side"]."',`battle`='".$gds["battle"]."',`fight`=2 WHERE `id`='".$player["id"]."'");
save_hp_roun($player);
echo '<script>location="main.php";</script>';
}else{

switch($prizes2['level']){
 case 0:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 1:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 2:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 3:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 4: 
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 5:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 default: echo'<script>alert(\'Погреб пуст..\');</script>'; break;
}
logovo_nap($player,$bot_id,$bot_kolvo); 
echo "<script>location='main.php';</script>";
}



}


}

?>




</div>
</table></td></table></tr></td></table>
</td></tr></table></TD></TR></TABLE>

<script type="text/javascript">
<? if (isset($secrets) && !empty($secrets)): ?>
message_window ('success','','<?=$secrets?>','ok','')
<? endif; ?>
</script>

<script type="text/javascript">
<? if (isset($text) && !empty($text)): ?>
message_window ('success','','<?=$text?>','','')
<? endif; ?>
</script>
</body>
</html>