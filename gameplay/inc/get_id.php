<?
/*if($get_id==99){mysqli_query($GLOBALS['db_link'],"LOCK TABLES user READ, user WRITE;");
if($wfight==1){
if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0){
$fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND level<4 AND type=3  ORDER by rand() LIMIT 2;');
save_hp_roun($player);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');startbat($fid,2);}else{$msg="<b><font class=nickname><font color=#cc0000>Все тренировочные места заняты!</font></font></b>";}}
if($wfight==3){
if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0){
$fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND level<6 AND level>2 AND type=3  ORDER by rand() LIMIT 3;');
save_hp_roun($player);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');startbat($fid,2);}else{$msg="<b><font class=nickname><font color=#cc0000>Все тренировочные места заняты!</font></font></b>";}}
if($wfight==2)
{
if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0){
$fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3  AND level>3 ORDER by rand() LIMIT 10;');
save_hp_roun($player);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');startbat($fid,2);}else{$msg="<b><font class=nickname><font color=#cc0000>Все тренировочные места заняты!</font></font></b>";}}
}
if($wfight==4){
if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0){
$fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND level<3 AND type=3  ORDER by rand() LIMIT 1;');
save_hp_roun($player);
mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');startbat($fid,2);}else{$msg="<b><font class=nickname><font color=#cc0000>Все тренировочные места заняты!</font></font></b>";}}
*/
if($get_id==15){
$plstt=allparam($player);
if($player[ustal]<time())
{
	$player[ustal]=time();
}
$ust=$player[ustal]+(150/($plstt[58]/200+1));
if($gti==0 or $gti=='')
{
	$gti=0;
}
else
{
	$gti=time()+($gti/(1+$plstt[58]/200));
}
list($x, $y ) = split("_", $player[pos], 2);
if($x=1005 && $y=1001)
{
	mysqli_query($GLOBALS['db_link'],'UPDATE user SET pos="8_4" WHERE id='.AP.$player['id'].AP.' LIMIT 1;');
}

mysqli_query($GLOBALS['db_link'],'UPDATE user SET ustal='.AP.$ust.AP.',pos='.AP.$gx."_".$gy.AP.', wait='.AP.$gti.AP.' WHERE id='.AP.$player['id'].AP.' LIMIT 1;');

echo "<script>parent.frames['ch_list'].location='ch.php?lo=1'</script>";
}
if($get_id==98){mysqli_query($GLOBALS['db_link'],"UNLOCK TABLES;");
  if($player['nv']>0)
  {
	if($type==1)
	{
	   if($player['hp']<$player['hp_all'])
	   {
	      $new_nv=$player['nv']-1;
	      $hps=$player['hp_all']/$player['hps'];
	      $chp=time()+(($player['hp_all']-$player['hp']-100)/$hps);
	      mysqli_query($GLOBALS['db_link'],'UPDATE user SET chp='.AP.$chp.AP.',nv='.AP.$new_nv.AP.' WHERE id='.AP.$player['id'].AP.' LIMIT 1;');
	   }
	}
	else
	{
	  if($player['mp']<$player['mp_all'])
	  {
		 $new_nv=$player['nv']-1;
	     $mps=$player['mp_all']/$player['mps'];
	     $cmp=time()+(($player['mp_all']-$player['mp']-100)/$mps);
	     mysqli_query($GLOBALS['db_link'],'UPDATE user SET cmp='.AP.$cmp.AP.',nv='.AP.$new_nv.AP.'  WHERE id='.AP.$player['id'].AP.' LIMIT 1;');
	  }
	}
  }
  else
  {
    $msg = "<b><font class=nickname><font color=#cc0000>Не хватает средств!</font></font></b>";
  }
}

if($get_id==77)
{
    mysqli_query($GLOBALS['db_link'],"LOCK TABLES user READ, user WRITE;");
        if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0)
        {
            $fid=newbattle(2,$player['loc'],1,time(),300,10,0,0,0,0,0,0,0,1);
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3  ORDER by rand() LIMIT 1;');
            save_hp_roun($player);
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');
            startbat($fid,2);
        }

}


if($get_id==42){mysqli_query($GLOBALS['db_link'],"LOCK TABLES unground READ, unground WRITE;");
$num=mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM unground WHERE x='$cx' and y='$cy';"));
if($act==1 and $num!=0){mysqli_query($GLOBALS['db_link'],'UPDATE user SET pos='.AP.$cx."_".$cy.AP.', wait='.AP.(time()+$mtime).AP.' WHERE id='.AP.$player['id'].AP.' LIMIT 1;');}
if($act==2 and $num==0){mysqli_query($GLOBALS['db_link'],'UPDATE user SET pos='.AP.$cx."_".$cy.AP.', nv=nv+1, wait='.AP.(time()+$mtime).AP.' WHERE id='.AP.$player['id'].AP.' LIMIT 1;');mysqli_query($GLOBALS['db_link'],'INSERT INTO unground (coord,x,y,image) VALUES ('.AP.$cx."_".$cy.AP.','.AP.$cx.AP.','.AP.$cy.AP.','.AP.rand(1,4).AP.');');}mysqli_query($GLOBALS['db_link'],"UNLOCK TABLES;");}

if($get_id==14 and $player[obnul]>0){obnul_pl($player);echo"<script>parent.jAlert('Ваши статы обнулились.');</script>";}
if($get_id==11 and $player[obnul]>0){mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `thotem`='".((intval($_REQUEST['ch_tot']) > 11) ? 0 : intval($_REQUEST['ch_tot']))."',`obnul`=`obnul`-'1' WHERE `id`='".$player[id]."' LIMIT 1;");}
if($_GET['get_id'] == '34'){
	$msg = '';
	switch($_GET['post_action']){
		case'1':
			if(!empty($_GET['fornickname'])){
				$GetUser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['fornickname'])."'"));
				if($GetUser['login'] == $player['login']){
					$msg = '<div align=center><font class=nickname><font color=#dd0000><b>Нельзя производить почтовые операции с самим собой.</b></font></font></div>';	
				}
				if(empty($GetUser['login'])){
					$msg = '<div align=center><font class=nickname><font color=#dd0000><b>Игрок не найден.</b></font></font></div>';	
				}
				if(empty($msg)){
					$_SESSION['gamesession']['post_user'] = $GetUser['login'];
					$_SESSION['gamesession']['post_id'] = $GetUser['id'];
				}
				unset($GetUser);
			}
		break;
		case'2':
			if(!empty($_SESSION['gamesession']['post_user'])){
				$_SESSION['gamesession']['post_user'] = '';
				$_SESSION['gamesession']['post_id'] = '';
			}
		break;
		case'4':
			if(!empty($_GET['message'])){
				$GetUser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".$_SESSION['gamesession']['post_id']."'"));
				if($player['nv']>=10){
					if($GetUser['last']>time()-300){
						chmsg("parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>Телеграмма:</font></b>&nbsp;".htmlspecialchars(strip_tags($_GET['message'], ''))." (<b>".$player['login']."</b>)</font></font><BR>'+'');",$GetUser['login']);
						$msg = '<div align=center><font class=nickname><font color=#dd0000><b>Телеграмма доставленна.</b></font></font></div>';	
					}else{
						mysqli_query($GLOBALS['db_link'],"INSERT INTO `post` (`type`,`to_user`,`fr_user`,`messange`,`status`,`time`) VALUES ('3','".$GetUser['id']."','".$player['login']."','parent.frames[\'chmain\'].add_msg(\'<font class=chattime>&nbsp;".date("d.m.Y H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>Телеграмма:</font></b>&nbsp;".htmlspecialchars(strip_tags($_GET['message'], ''))." (<b>".$player['login']."</b>)</font></font><BR>\'+\'\');','0','".time()."');");
						$msg = '<div align=center><font class=nickname><font color=#dd0000><b>Персонаж '.$GetUser['login'].' вне мира, как только мы его увидем, мы сразу ему сообщим.</b></font></font></div>';	
					}
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv` = nv-10 WHERE `id`='".$player['id']."'");
				}else{
					$msg = '<div align=center><font class=nickname><font color=#dd0000><b>Недостаточно средств.</b></font></font></div>';	
				}
			}
		break;
	}
	echo $msg;
}
?>