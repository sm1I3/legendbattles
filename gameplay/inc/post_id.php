<?

$plstt=allparam($player);
settype($post_id,"integer");
if(isset($_POST['opass']) and isset($_POST['npass']) and isset($_POST['vpass']) and $_POST['post_id']==49){
	$tmpopass=$_POST['opass'];
	$tmpvpass=$_POST['vpass'];
	$tmpnpass=$_POST['npass'];
}
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
	$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
	$$keyget = $valg;
}
foreach($_SESSION as $keyses=>$vals){
	$$keyses = $vals;
}

if(isset($_POST['opass']) and isset($_POST['npass']) and isset($_POST['vpass']) and $_POST['post_id']==49){
	$_POST['opass'] = $tmpopass;
	$_POST['vpass'] = $tmpvpass;
	$_POST['npass'] = $tmpnpass;
	$opass = $tmpopass;
	$vpass = $tmpvpass;
	$npass = $tmpnpass;
}
$sk='kgTvx2WrEZ';
function cutStr($str,$sCount,$cutParam){
	if(strlen($str) > $sCount){   // ���� ���-�� �������� ������ ���������  $scount
		$str = substr($str,0,$sCount).$cutParam;  // �������� ������ �� ������� $scount � ������ ��������� $cutParam
	}
	return $str;// ���������� ���������
}
function getnamebyid($id){
	$plname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`login`,`user`.`id` FROM `user` WHERE `id`='".$id."' LIMIT 1;"));
	return $plname['login'];
}

switch($post_id){
	case 0: 
		$fornickname=trim($_POST['fornickname']);
		if($fornickname!=$player['login']){
			$forprice= (intval($_POST['gold'])) * 10000 + (intval($_POST['silver'])) * 100 + (intval($_POST['bronze']));
			$fornickname=chars($fornickname);
			$selluid=intval($_POST['selluid']);
			$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`login`,`user`.`last`,`user`.`loc`,`user`.`pos`,`user`.`fight` FROM `user` WHERE `login`='".$fornickname."' LIMIT 1;"));
			if($pl['loc']==$player['loc'] and $pl['pos']==$player['pos'] and $pl['fight']==0){
			if($fornickname!='' and $forprice>0){
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `sellprice`='".$forprice."' WHERE `id_item`='".$selluid."' LIMIT 1;");
				$ms = "parent.frames['main_top'].location='main.php?useaction=trade&act=1&uid=".$player['id']."&id=".$selluid."&forprice=".$forprice."&login=".$player['login']."';";
                $ms = "parent.$('#basic-modal-content').html('<iframe src=\"/main.php?useaction=trade&act=1&uid=".$player['id']."&id=".$selluid."&forprice=".$forprice."&login=".$player['login']."\" id=\"useaction\" name=\"useaction\" scrolling=\"auto\" style=\"width:600px;height:400px;\" frameborder=\"0\"></iframe>');parent.ShowModal();";
				chmsg($ms,$fornickname);
				$msg='<b><font class=proce>�������� �������������</font></b>';}
			}else{
                $msg='<b><font class=proce>������ ����������! �������� ����������� ���� � ���!</font></b>';
            }
			unset($pl);
		}
	break;	
	case 1: 
		$id=intval($id);
		$uid=intval($uid);	
		$login=chars($login);
		$col=intval($col);		
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buy.php");
	break;
	case 2: include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/complect.php");break;
	case 3: 
		mysqli_query($GLOBALS['db_link'],"DELETE FROM `pcompl` WHERE `id`='".$_GET['key']."' and `uid`='".$player['id']."';");
		$msg='<b><font class=proce>�������� ������!</font></b>';
	break;
	case 4: include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/complect.php");break;
	case 5:
		if(intval($macount)<=$player[mp] and intval($macount)>0){
			save_hp();$nma=ceil(($player[hp_all]-$player[hp])/2);
			if(intval($macount)>=$nma){
				if(intval($macount)<=$player[mp]){$mp=$nma;}
				else{$mp=$player[mp];}
			}else{
				if(intval($macount)<=$player[mp]){$mp=intval($macount);}
				else{$mp=$player[mp];}
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET hp=hp+".($mp*2).", mp=mp-".$mp." WHERE id='".$player[id]."';");calchp();
		}
	break;
	case 7:
		if($enemy == '3'){
			require($_SERVER["DOCUMENT_ROOT"].'/gameplay/inc/calc_bat.php');
			mysqli_query($GLOBALS['db_link'],"UPDATE `arena` SET `t2`='".time()."', `t1`='0' WHERE `id_battle`='".$player['battle']."';");
		}else{
			mysqli_query($GLOBALS['db_link'],"UPDATE `arena` SET `t2`='".time()."', `t1`='".$player['side']."' WHERE `id_battle`='".$player['battle']."';");
			mysqli_query($GLOBALS['db_link'],"LOCK TABLES fight READ, fight WRITE;");
			$s=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `fight` WHERE `battle`='".$player['battle']."' AND `eid`='".$player['id']."' AND `uid`='".$enemyid."' LIMIT 1;"));
			if(!$s){
				mysqli_query($GLOBALS['db_link'],'INSERT INTO `fight` (uid,eid,battle,ud,bl,mag,side) VALUES ('.AP.$player['id'].AP.', '.AP.$enemyid.AP.', '.AP.$player['battle'].AP.', '.AP.$inu.AP.', '.AP.$inb.AP.', '.AP.$ina.AP.', '.AP.$group.AP.');');
				mysqli_query($GLOBALS['db_link'],"UNLOCK TABLES;");
			}else{
				require($_SERVER["DOCUMENT_ROOT"].'/gameplay/inc/calc_bat.php');
				mysqli_query($GLOBALS['db_link'],'DELETE FROM fight WHERE id='.AP.$s['id'].AP.'');
			}
		}
	break;
	case 9:
	  $rframe = array("0","1");
		$sort = array("a_z","z_a","0_35","35_0");
		$color = array("000000","FF3366","CC0033","FF3399","CC0066","FF6699","CC3366","990033","FF6633","CC3300","FF3300","FF6600","FF9966","CC6633","993300","FF9933","CC6600","FF9900","FF99CC","CC6699","993366","660033","FF66CC","CC3399","990066","FF33CC","CC0099","FF00CC","FF0099","FF0066","FF0033","FF0000","FF3333","CC0000","FF6666","CC3333","990000","FF9999","CC6666","993333","660000","CC9999","996666","663333","FFCC99","CC9966","996633","663300","FFCC66","CC9933","996600","FFCC33","CC9900","FFCC00","CC99FF","9966CC","9966FF","FFCCFF","CC99CC","996699","663366","FF99FF","CC66CC","CC33CC","CC00CC","6666CC","3333CC","000099","000066","0000CC","0000FF","336633","339933","669966","009900","006600","00CC00","3300FF","00CCCC","009999","33CCCC","006666","336699","003366","003399","0033CC","3366FF","336600","339900","33CC00","00CC33","00CCFF","33CCFF","0066CC","6600FF");
		if(!in_array($_POST['inf_sort'],$sort)){
			$_POST['inf_sort'] = 'a_z';
		}
		if(!in_array($_POST['newchatcolor'],$color)){
			$_POST['newchatcolor'] = '000000';
		}
			if(!in_array($_POST['rframe'],$rframe)){
		$_POST['rframe'] = '0';
	}
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET  `rframe`='".$_POST['rframe']."', `filt`='".$_POST['inf_sort']."',`chcolor`='".$_POST['newchatcolor']."' WHERE `id`='".$player['id']."' LIMIT 1;");
	break;
	case 10:
		$col=explode("|",$player['obr_col']);
		if($player['sex']=="male"){$sex2="male";}else{$sex2="fem";}
		if($act_id==1 and $ava!=''){$col[0]-=1; $col=$col[0]."|".$col[1]; mysqli_query($GLOBALS['db_link'],'UPDATE user SET f_obraz='.AP.$ava.AP.', obr_col='.AP.$col.AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');}
		if($act_id==2 and $selectob!=''){
			$col[1]-=1; $col=$col[0]."|".$col[1];
		if($selectob<12){
			$ava=$player['sex']."_$selectob.gif";
		}
		else{
			$ava=$player['sex']."_0".".gif";} mysqli_query($GLOBALS['db_link'],'UPDATE user SET obraz='.AP.$ava.AP.', obr_col='.AP.$col.AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');
		}
	break;
	case 11:
		$dditem=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$player['id'].'" AND `id_item`="'.$_GET['uid'].'" LIMIT 1;'));
		if($dditem['id_item']){
			$wn=$dditem['name'];
			$prot=$dditem['protype'];
			settype($act,"integer");
			$licen=tradelic($player['licens'],1);
			$iz='';
			switch($act){
				case 1:
						$iz=(($dditem['dolg']-$dditem['iznos'])/$dditem['dolg']);
						if($dditem['clan']==0){
							if($dditem['dd_price']>0 and $dditem['arenda']==0 and $dditem['rassrok']==0 and $dditem['gift']==0){
								$licen=0.8;
								$sum=round(($dditem['dd_price']*$licen*$iz),2);
								include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/selldprice.php");
							}
							else{
								if($player['level']<5){$licen=1;}
								if($dditem['gift']==1){$licen=0.4;}
								$sum=round($dditem['price']*$licen*$iz);
								if($sum<1){$sum=1;}
								include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/sell.php");
							}					
						}
						else{$msg="<b><font class=proce>�� �� ������ ��������� �������� ����!</font></b>";}

				break;
				case 2:
					if($player['clan_id']!='none' and $dditem['clan']==0){
						include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/intoclan.php");
					}
					else{$msg="<b><font class=proce>�� �� �������� � ����� ��� ��� ���� ��� � �����!</font></b>";}
				break;
				case 3:
					settype($prot, "int");
					$forsell=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`protype`='".$prot."'   AND `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0'");
					$sum=0;
					$numrow=mysqli_num_rows($forsell);
					if($numrow>0){
						while($row = mysqli_fetch_array($forsell)){
							$iz='';
							$iz=(($row[dolg]-$row[iznos])/$row[dolg]);
							if($row['dd_price']==0 or $row['dd_price']==''){
								if($player['level']<5){$licen=1;}
								if($row['gift']==1){$licen=0.4;}
								$price=round($row['price']*$licen*$iz);
								if($price<1){$price=1;}
								$sum+=$price;
							}					
						}
						mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' AND `protype`='".$prot."' AND `clan`='0' AND `used`='0' AND `bank`='0';");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".$sum."' WHERE `id`='".$player['id']."' LIMIT 1;");
						$msg="<b><font class=proceb><b>�������:</b><br><font class=proce> ".$wn." (".$numrow." ��.) �� ".lr($sum)."!</font></b>";
						$typetolog = '0'; $abouttolog = '0';  # ���������� ��� �����: ������ ������ 0
						$typetolog .= '@13';  
						$abouttolog .= '@<b>'.$dditem['name'].'</b> ('.$numrow.' ��.). �� ����: <b>'.lr($sum).'</b>.';
						player_actions($player['id'],$typetolog,$abouttolog);
						log_write("sell",$wn." ($numrow)",$sum,"market");
					}
				break;
				default: echo "<script type='text/javascript'> parent.location.href = 'http://leg/'; </script>";break;
			}	
		}
	break;
	case 12: 
		if(in_array($_POST['vcode'],$_SESSION['secur'])){
			switch($_POST['act']){
				case 1: 
					switch($_POST['set']){
						case 1: $msg=$_POST['set'];break;
						case 2: $msg=$_POST['set'];break;
					}				
				break;
				case 2: break;
				case 3: break;
				case 4: break;		
			}
		}
	break;
	case 13: mysqli_query($GLOBALS['db_link'],'UPDATE invent SET used=0 WHERE id_item='.AP.$uid.AP.' AND pl_id='.AP.$pl.AP.' LIMIT 1');break;
	case 14: mysqli_query($GLOBALS['db_link'],'UPDATE invent SET used=0,pl_id='.AP.$newpl.AP.' WHERE id_item='.AP.$uid.AP.' AND pl_id='.AP.$pl.AP.' LIMIT 1');break;
	case 15:
		$f0=round(intval($f0));
		$f1=round(intval($f1));
		$f2=round(intval($f2));
		$f3=round(intval($f3));
		$f4=round(intval($f4));
		if($f0>=0 and $f1>=0 and $f2>=0 and $f3>=0 and $f4>=0){
			$fr=$f0+$f1+$f2+$f3+$f4;
			if(($player['free_stat']-$fr) >= 0){
				save_hp(); 
				mysqli_query($GLOBALS['db_link'],'UPDATE user SET sila=sila+'.AP.$f0.AP.', lovk=lovk+'.AP.$f1.AP.',uda4a=uda4a+'.AP.$f2.AP.',znan=znan+'.AP.$f3.AP.',zdorov=zdorov+'.AP.$f4.AP.', free_stat=free_stat-'.AP.$fr.AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');calchp();
			}
		}
	break;
	case 16:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/nav.php");
	break;
	case 17:
		save_hp();
		ksort ($f); 
		$i=0;
		$z=0;
		$fail=0;
		$pl_nav=explode("|",$player[perk]);
		foreach($f as $key=>$val){
			if($val<0 or $val<$pl_nav[$key]){$val=0;$fail=1;}
			if($val==0){$f[$key]='';}
			else {$f[$key]=1;$i++;}
		}
		foreach($pl_nav as $value){
			if($value==1){$i--;}
		}
		if($i<=$player[nav] and $fail==0){
			$currnav=$player[nav]-$i;
			$perk=implode("|",$f);
			mysqli_query($GLOBALS['db_link'],'UPDATE user SET perk='.AP.$perk.AP.', nav='.AP.$currnav.AP.' WHERE id='.AP.$player['id'].AP.'LIMIT 1;');calchp();
		}
	break;
	case 19:
		switch($act){
			case 1:				
				if($_SESSION[user]['ft']==1){$gsma=99;$batstart=9999999999;}else{$batstart=time()+($fwait*60);}
				if($_SESSION[user]['ft']==3){if($fall==1){$lev=array(0,35);}else{$lev=gethaot($player['level']);}$gsma=$gfma=$lev[1];$gfmi=$gsmi=$lev[0];$gfco=$gsco=99;} 
				if($gfma<$gfmi){$edit=$gfmi-$gfma; $gfma=$gfma+$edit; $gfmi=$gfmi-$edit;}
				if($gsma<$gsmi){$edit=$gsmi-$gsma; $gsma=$gsma+$edit; $gsmi=$gsmi-$edit;}	
				if($gfco=="0" or $gfco==''){$gfco="1";}
				if($gsco=="0" or $gsco==''){$gsco="1";}
				if($player['level']>$gfma){$gfma=$player['level'];}
				if($player['level']<$gfmi){$gfmi=$player['level'];}
				switch(intval($ftime)){
					case 1:  $ftm=120;break; //2 min
					case 2:	 $ftm=180;break; //3 min
					case 3:  $ftm=240;break; //4 min
					case 4:  $ftm=300;break; //5 min
					default: $ftm=300;break;
				}
				switch(intval($ftrvm)){
					case 1:  $ftrm=10;break; //10%
					case 2:	 $ftrm=30;break; //30%
					case 3:  $ftrm=50;break; //50%
					case 4:  $ftrm=80;break; //80%
					default: $ftrm=80;break;
				}
				$fid=newbattle($_SESSION[user]['ft'],$player['loc'],$fkind,$batstart,$ftm,$ftrm,$gfmi,$gfma,$gfco,$gsmi,$gsma,$gsco,1,0);
				mysqli_query($GLOBALS['db_link'],"UPDATE user SET battle='".$fid."',side=1 WHERE login='".$_SESSION[user]['login']."' LIMIT 1;");
			break;
			case 2:
				if($pza){
					$bid=explode(":",$pza);mysqli_query($GLOBALS['db_link'],"LOCK TABLES arena READ, fight arena;");
					if(testarena($bid[1])!=0){
						if($_SESSION[user]['ft']==3){
							$cp1=mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT user.side FROM user WHERE side='1' AND battle='".$bid[1]."';"));
							$cp2=mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT user.side FROM user WHERE side='2' AND battle='".$bid[1]."';"));
							if($cp1>$cp2){$bid[0]=2;}
						}
						$ok=mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM arena WHERE ok$bid[0]<kol$bid[0] AND id_battle='".$bid[1]."';"));
						if($ok>0){
							mysqli_query($GLOBALS['db_link'],'UPDATE arena SET ok'.$bid[0].'=ok'.$bid[0].'+1 WHERE  id_battle='.AP.$bid[1].AP.'LIMIT 1;');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$bid[1].AP.',side='.AP.$bid[0].AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');
							if($_SESSION[user]['ft']==1){sumbat($bid[1],"parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;<b>".$_SESSION[user][login]."</b> ������ ���� ������! </font><BR>'+'');$redirect",1);}
							else{sumbat($bid[1],"$redirect",0);}
						}
						mysqli_query($GLOBALS['db_link'],"UNLOCK TABLES;");
					}
				}
			break;
			default: echo "<script type='text/javascript'> parent.location.href = 'http://d0009394.atservers.net/'; </script>";break;
		}
	break;
	case 20:
		$cut="...";
		$prtext=chars(str_replace ("%", "",$prtext));
		$prtext=cutStr($prtext,40,$cut);
		$prnick=chars($prnick);
		$prnick=trim($prnick);
		$pod=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id='".intval($pid)."' LIMIT 1;"));
		if($pod['price']<=$player['dd']  and $pod['price']>0 and $pod['id']>=117 and $pod['id']<=120){
			if($pid!='' and $prnick!=$player['login']){
				$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT user.id,user.login FROM user WHERE login='".$prnick."' LIMIT 1;"));
				if($pl[id]!='')	{
					if(!$pranon){$message="$prtext ($player[login])";}else{$message="$prtext";}
						mysqli_query($GLOBALS['db_link'],'UPDATE user SET dd=dd-'.AP.$pod[price].AP.' WHERE id='.AP.$player['id'].AP.';');
						mysqli_query($GLOBALS['db_link'],'INSERT INTO podarki(id,podarok,srok,message)VALUES('.AP.$pl[id].AP.', '.AP.$pid.AP.', '.AP.(time()+$pod[srok]).AP.', '.AP.$message.AP.');');
						$chprtext="������� �� �������:&nbsp;<font color=#CC0000><b> $prtext</b></font>";
						$chatms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b>&nbsp;��� ������ ������� �� <b>(".($pranon?'��������':$player['login']).")</b>!&nbsp;$chprtext</font></font><BR>'+'');";chmsg($chatms,$prnick);
				}
				else{$msg="<br><div align=center><b><font class=proce>�������� $prnick �� ������!</font></b></div>";}
			}
			else{$msg="<br><div align=center><b><font class=proce>������ ������ ������� ����!</font></b></div>";}
		}elseif($pod['price']>0 and $pod['price']<=$player['nv']  and $pod['DD']!=1){
			if($pid!='' and $prnick!=$player['login']){
				$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT user.id,user.login FROM user WHERE login='".$prnick."' LIMIT 1;"));
				if($pl[id]!='')	{
					if(!$pranon){$message="$prtext ($player[login])";}else{$message="$prtext";}
						mysqli_query($GLOBALS['db_link'],'UPDATE user SET nv=nv-'.AP.$pod[price].AP.' WHERE id='.AP.$player['id'].AP.';');
						mysqli_query($GLOBALS['db_link'],'INSERT INTO podarki(id,podarok,srok,message)VALUES('.AP.$pl[id].AP.', '.AP.$pid.AP.', '.AP.(time()+$pod[srok]).AP.', '.AP.$message.AP.');');
						$chprtext="������� �� �������:&nbsp;<font color=#CC0000><b> $prtext</b></font>";
						$chatms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b>&nbsp;��� ������ ������� �� <b>(".($pranon?'��������':$player['login']).")</b>!&nbsp;$chprtext</font></font><BR>'+'');";chmsg($chatms,$prnick);
				}
				else{$msg="<br><div align=center><b><font class=proce>�������� $prnick �� ������!</font></b></div>";}
			}
			else{$msg="<br><div align=center><b><font class=proce>������ ������ ������� ����!</font></b></div>";}
		}else{$msg="<br><div align=center><b><font class=proce>��������� �����!</font></b></div>";}
	break;
	case 21:
		$cut="...";
		$prtext=chars(str_replace ("%", "",$prtext));
		$prtext=cutStr($prtext,40,$cut);
		$prnick=chars($prnick);
		$prnick=trim($prnick);
		$pod=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM mark_pod WHERE id='".intval($pid)."' LIMIT 1;"));
		if($pod['id']>=9996 and $pod['id']<=9999){
			if($pod['price']<$player['baks'])
			{
				if($pid!='' and $prnick!=$player['login']){
					$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT user.id,user.login FROM user WHERE login='".$prnick."' LIMIT 1;"));
					if($pl[id]!='')	{
						if(!$pranon){$message="$prtext ($player[login])";}else{$message="$prtext";}
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.AP.$pod[price].AP.' WHERE id='.AP.$player['id'].AP.';');
							mysqli_query($GLOBALS['db_link'],'INSERT INTO podarki(id,podarok,srok,message)VALUES('.AP.$pl[id].AP.', '.AP.$pid.AP.', '.AP.(time()+$pod[srok]).AP.', '.AP.$message.AP.');');
							$chprtext="������� �� �������:&nbsp;<font color=#CC0000><b> $prtext</b></font>";
							$chatms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b>&nbsp;��� ������ ������� �� <b>$player[login]</b>!&nbsp;$chprtext</font></font><BR>'+'');";chmsg($chatms,$prnick);
					}
				else{$msg="<br><div align=center><b><font class=proce>�������� $prnick �� ������!</font></b></div>";}
				}
			else{$msg="<br><div align=center><b><font class=proce>������ ������ ������� ����!</font></b></div>";}
			}
			else
			{$msg="<br><div align=center><b><font class=proce>��������� �����!</font></b></div>";}
		}
		elseif($pod['DD']==1){
			if($pod['price']<$player['dd'])
			{
				if($pid!='' and $prnick!=$player['login']){
					$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT user.id,user.login FROM user WHERE login='".$prnick."' LIMIT 1;"));
					if($pl[id]!='')	{
						if(!$pranon){$message="$prtext ($player[login])";}else{$message="$prtext";}
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET dd=dd-'.AP.$pod[price].AP.' WHERE id='.AP.$player['id'].AP.';');
							mysqli_query($GLOBALS['db_link'],'INSERT INTO podarki(id,podarok,srok,message)VALUES('.AP.$pl[id].AP.', '.AP.$pid.AP.', '.AP.(time()+$pod[srok]).AP.', '.AP.$message.AP.');');
							$chprtext="������� �� �������:&nbsp;<font color=#CC0000><b> $prtext</b></font>";
							$chatms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b>&nbsp;��� ������ ������� �� <b>$player[login]</b>!&nbsp;$chprtext</font></font><BR>'+'');";chmsg($chatms,$prnick);
					}
				else{$msg="<br><div align=center><b><font class=proce>�������� $prnick �� ������!</font></b></div>";}
				}
			else{$msg="<br><div align=center><b><font class=proce>������ ������ ������� ����!</font></b></div>";}
			}
			else
			{$msg="<br><div align=center><b><font class=proce>��������� �����!</font></b></div>";}
		}
	break;
	case 22: $sum = intval($_POST['gold']) * 10000 + intval($_POST['silver']) * 100 + intval($_POST['bronze']); $fornickname=trim($fornickname);if($fornickname!='' and intval($sum)>0){if($player['login']!=$fornickname){$ret=transfer($transferuid,$fornickname,$player[loc],$transfernametxt,$player[login],intval($sum),$ttext);$msg=$ret[msg];}else{$msg="<b><font class=proce>�� �� ������ ���������� ����!</font></b><br>";}}break;
	case 23: $fornickname=trim($fornickname);if($player['login']!=$fornickname){$ret=gift($presentuid,$fornickname,$player[loc],$presentnametxt,$player[login],$presentnv);$msg=$ret[msg];}else{$msg="<b><font class=proce>�� �� ������ �������� ����!</font></b><br>";}break;
	case 24: $fornickname=trim($fornickname);if($fornickname!='' and intval($sum)>0){$ret=transfer($transferuid,$fornickname,$player[loc],$transfernametxt,$player[login],intval($sum));$msg=$ret[msg];}break;
	case 25: 
		$sum=round(intval($sum));
		if($sum>=1 and $player['baks']>=round($sum)){
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-'".round($sum)."' WHERE `id`='".$player['id']."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".(round($sum)*250000)."' WHERE `id`='".$player['id']."' LIMIT 1;")){
				$msg="<font class=proce><b>�� �������� ".round($sum)."$ �� ".lr(round($sum)*250000).".</b></font>";
			}
			else{$msg="<font class=proceg><b>������ ��� ������.</b></font>";}
		}
		else{$msg="<font class=proceg><b>������ ��� ������ (�������� �����).</b></font>";}
	break;
	case 26: 
		$fornickname=trim($fornickname);
		$magicreuid=trim($magicreuid);		
		$ret=mute($fornickname,$player['login'],$magicreuid,$player['id']);
		$msg=$ret[msg];
	break;
	case 49:
		if(!preg_match("/^[a-zA-Z0-9\._-]+@[a-z0-9\.-_]+\.[a-z]{2,4}$/",$newmail)){
			$msg = "<span class=\"redtitle_st\"><strong>  ������! ��������� Email!</strong></span><BR>";
		}else{
			if($act==1){
				log_write("newmail",$player['email']."=>".$newmail,0);
				mysqli_query($GLOBALS['db_link'],'UPDATE user SET email='.AP.$newmail.AP.',finblock='.AP.(time()+86400).AP.' WHERE id='.AP.$player['id'].AP.'LIMIT 1;');
			}
		}
		if($act==2){
			if($player[pass]==md5($opass)){
				if($npass==$vpass){
					if(strlen($npass)<4){
						$msg="<br><b><font class=proce>������! ������� ��������!</font></b>";
					}else{
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pass`='".md5($_POST['npass'])."'".(($player['level'] >= 5) ? ",`finblock`='".(time()+86400)."'" : '' )." WHERE `id`='".$player['id']."' LIMIT 1;");
						$msg="<br><b><font class=proce>OK</font></font></b>";
						log_write("newpass","md5:(".$player['pass'].") ".$opass."=>".$npass,0);
                			}
				}else{
					$msg="<br><b><font class=proce>������! ������ �� ���������!</font></b>";
				}
			}else{
				$msg="<br><b><font class=proce>������! �������� ������ ������!</font></b>";
			}
		}
		if($act==3){
			$Password = '';
			switch($_POST['pa_long']){
				case'5':
					$Password = rand(10000,99999);	
				break;
				case'9':
					$Password = rand(100000000,999999999);
				break;
			}
			if($_POST['emailc']){
				send_mail($player['email'],'��� ������ ������','������������, '.$player['login'].'!<br><br>�� ���������� ������ ������ � ������� Legend battles.<br />��� ���� ������� ������:<br />�����: <b>'.$player['login'].'</b><br />������: <b>******</b><br />������ ������: <b>'.$Password.'</b><br /><br /><br />� ���������� �����������,<br />������������� ���� Legend battles.<br />www.legendbattles.ru<br /><br />');
			}
			echo"<script>alert('��� ������ ������: \"".$Password."\"!".(($_POST['emailc']) ? ' ����� ���������� ��� �� E-mail' : '' )."');</script>";
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `flash`='".$Password."' WHERE `id`='".$player['id']."' LIMIT 1;");
			log_write("flashpass",$Password,0);
			$player['flash'] = $Password;
		}
		if($act==5){
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET name='".chars($newname)."', country='".chars($newcountry)."', city='".chars($newcity)."', icq='".chars($newicq)."', url='".chars($url)."', addon='".chars($newaddon)."', about='".bbCodes($newabout)."' WHERE login='".$_SESSION[user]['login']."' LIMIT 1;");
		}
	break;	
	case 34:
		if($bank_act==2){
			if($player[nv]<5){$msg="<div align=center><b><font class=proce>��������� �����.</font></b></div>";}
			else{
				if($bpsw!='' and $bpsw==$bpsw1){
					mysqli_query($GLOBALS['db_link'],'INSERT INTO bank (id,pass,email)VALUES('.AP.$player[id].AP.', '.AP.$bpsw.AP.', '.AP.$bmail.AP.');');$msg="<div align=center><b><font class=proce>���� ������.</font></b></div>";mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv-5 WHERE `id` = '".$player['id']."'");}
				else{$msg="<div align=center><b><font class=proce>������ � ������!</font></b></div>";}
			}
		}
		if($bank_act==3){
			$ch=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE num='".intval($bill_num)."' LIMIT 1;"));
			if($ch[pass]==$bill_psw){$msg='';}
			else{$msg="<div align=center><b><font class=proce>�������� ������.</font></b></div>";}
		}
	break;
	case 43: $fornickname=trim($fornickname);$ret=zelinvis($magicreuid,$fornickname,$player[loc]);$msg=$ret[msg];break;
	case 44:
		$doksv=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT invent.*,  items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE pl_id="'.$player['id'].'" AND id_item="'.$uid.'" LIMIT 1;'));
		$ret=doktor($doksv,$player['login'],$player[loc]);
		$msg=$ret[msg];	
	break;
	case 45:
/*
		if($player['login']=='m0ne'){
			$_POST['fornickname'] = htmlspecialchars($_POST['fornickname']);
			$pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_POST['fornickname'])."'"));
			$pl_st = allparam($pl);
			if(empty($pl)){
				$msg = '<b><font class="nickname"><font color="#CC0000">��������� &quot;'.$_POST['fornickname'].'&quot; ������������!</font></b><br>';
			}else if($pl['last'] < (time()-300)){
				$msg = '<b><font class="nickname"><font color="#CC0000">��������� &quot;'.$_POST['fornickname'].'&quot; ��� � ����!</font></b><br>';
			}else if($player['loc']!=$pl['loc']){
				$msg = '<b><font class="nickname"><font color="#CC0000">��������� &quot;'.$_POST['fornickname'].'&quot; ��� � ���� �������!</font></b><br>';
			}else if($pl['fight'] > 0){
				$msg = '<b><font class="nickname"><font color="#CC0000">��������! �������� &quot;'.$_POST['fornickname'].'&quot; � ���!</font></b><br>';
			}else if(mysq_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `effects` WHERE `uid`='".$player['id']."' AND `eff_id`>'5'"))>4){
				$msg = '<b><font class="nickname"><font color="#CC0000">�� ������ ������������ ���������� �����!</font></b><br>';
			}else{
				$it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `id_item`='".intval($_POST['magicreuid'])."' AND `pl_id`='".$player['id']."' AND `acte`='zelreform'"));
				if(!empty($it)){
					if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `effects` (`uid`,`eff_id`,`effects`,`side_effects`,`time`,`side_time`) VALUES ('".$player['id']."','".$it['eff_id']."','".$it['effects']."','".$it['side_effects']."','".($it['eftime']+time())."','".(($it['efside_time']>0)?$it['efside_time']+time():'0')."');")){
						$msg = '<b><font class="nickname"><font color="#CC0000">�� ������ ��������� &quot;'.$it['name'].'&quot;!</font></b><br>';
						if($player['login'] != $pl['login']){
							chmsg("parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;�������� <b>".$player['login']."</b>  �������� � ��� <b>&quot;".$it['name']."&quot;.</b></font><BR>'+'');",$pl['login']);
						}
						calcstat($pl['id']);
						it_break($it['id_item']);
					}
				}
			}
		}else{
			$msg = "<b><font class=proce>���������� �������, ������������ ���� ������� �������� ����������!</font></b><br>";
		}
*/		
		$fornickname=trim($fornickname);
		$ret=zelused($magicreuid,$fornickname,$player[loc]);
		$msg=$ret[msg];
		
	break;
	case 46: $fornickname=trim($fornickname);$ret=used($magicreuid,$fornickname,$player[loc]);$msg=$ret[msg];break;
	case 47:
		$fornickname=trim($fornickname);
		$doksv=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT invent.*,  items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE pl_id="'.$player['id'].'" AND id_item="'.$magicreuid.'" LIMIT 1;'));
		$ret=doktor($doksv,$fornickname,$player[loc]);
		$msg=$ret[msg];	
	break;	
	case 48:
		$act=0;
		$licens=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT invent.*,  items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE pl_id="'.$player['id'].'" AND id_item="'.$uid.'" and (type="w30" or type="w29") LIMIT 1;'));
		if($licens['acte']=='licensform'){$act=1;}
		else if ($licens['acte']=='licensform2'){$act=2;}
		else if ($licens['acte']=='invisform'){$act=3;}
		else if ($licens['acte']=='teleport'){$act=4;}
		else if ($licens['acte']=='teleport2'){$act=5;}
		else if ($player['sign']==$sk){$act=6;}
		switch($act){
			case 0: break;
			case 1: $ret=addlic($player,$licens,1);$msg=$ret[msg];
			break;
			case 2: $ret=addlic($player,$licens,2);$msg=$ret[msg];
			break;
			case 3:
				if($player['invisible']>time()){
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `invisible`='".($player['invisible']+$licens['effect'])."' WHERE `id`='".$player['id']."'");
					it_break($licens['id_item']);
				}elseif($player['invisible']<time()){
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `invisible`='".($licens['effect']+time())."' WHERE `id`='".$player['id']."'");
					it_break($licens['id_item']);
				}
				$msg='<b><font class=proce>����� ������� ��� �����, �� ������� ���������� � �������.</font></b>';
			break;
			case 4:
				$msg="�� ������� ��������������� � �����.";
				it_break($licens['id_item']);
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`='1',`pos`='8_4' WHERE `id`='".$player['id']."'");
			break;
			case 5:
				$msg="�� ������� ��������������� � �����. ������ ���������� ���������. ��� ������ �� ������ �� ������ ���������� �� ������ ������������.";
				it_break($licens['id_item']);
				$_SESSION['user']['oldpos'] = $player['pos'];
				$_SESSION['user']['oldloc'] = $player['loc'];
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`='1',`pos`='8_4' WHERE `id`='".$player['id']."'");
				echo '<script>'.$redirect.'</script>';
			break;
			case 6:
				$msg="�� ������� ��������������� � �����. ������ ���������� ���������. ��� ������ �� ������ �� ������ ���������� �� ������ ������������.";
				$_SESSION['user']['oldpos'] = $player['pos'];
				$_SESSION['user']['oldloc'] = $player['loc'];
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`='1',`pos`='8_4' WHERE `id`='".$player['id']."'");
				echo '<script>'.$redirect.'</script>';
			break;
		}	
	break;
	case 50: 
		$item=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$player['id'].'" AND `id_item`="'.$uid.'" LIMIT 1;'));
		if($item['id_item']){mysqli_query($GLOBALS['db_link'],'DELETE FROM `invent` WHERE `id_item`="'.$item['id_item'].'" and `pl_id`="'.$player['id'].'"  and `invent`.`bank`="0" and `invent`.`clan`="0" LIMIT 1;');}
	break;
	case 53: 
		$item=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$player['id'].'" AND `id_item`="'.$uid.'" LIMIT 1;'));
		if($item['protype']){mysqli_query($GLOBALS['db_link'],'DELETE FROM `invent` WHERE `protype`="'.$item['protype'].'" and `pl_id`="'.$player['id'].'" and `invent`.`bank`="0" and `invent`.`clan`="0";');}
	break;
	case 51: mysqli_query($GLOBALS['db_link'],'DELETE FROM podarki WHERE podarok='.AP.$wn.AP.' and id='.AP.$uid.AP.'');break;
	case 52:
		if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `podarki` WHERE `podarok`='".$wn."' and `id`='".$player['id']."' LIMIT 1;")){
			if($wn>116 and $wn<121){
				#$nv=2014;
				#mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+$nv WHERE id='".$player['id']."';");
				#$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b></font>&nbsp;�� �������� �������: <b>2014 LR</b>.</font><BR>'+'');";chmsg($ms,$player['login']);		
			}			
			$items=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `mark_pod` WHERE `id`='".$wn."' LIMIT 1;"));
			if($items['items_id']!=0){
			$item=explode("|",$items['items_id']);
				foreach($item as $val){
					if($val!=''){
							$itemsql=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
							$par=explode("|",$itemsql['param']);
							foreach ($par as $value) {
								$stat=explode("@",$value);
								switch($stat[0]){case 2: $dolg=$stat[1];break;}
							}
							if($wn<=108 or $wn>=121){$death=(time()+(86400*30));}
							else{$death=0;}
							if(mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`,`death`) VALUES ('".$itemsql['id']."','".$player['id']."','".$dolg."','".$itemsql['price']."','1','legendbattles.ru',".$death.");")){
								$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b></font>&nbsp;�� �������� �������: <b>".$itemsql['name']."</b>.</font><BR>'+'');";chmsg($ms,$player['login']);
							}
					}
				}
			}
			if($items['dlr']>0){
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `dd`=`dd`+'".$items['dlr']."' WHERE `id`='".$player['id']."' LIMIT 1;")){
					$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b></font>&nbsp;�� �������� �������: <b>".$items['dlr']." DLR</b>.</font><BR>'+'');";chmsg($ms,$player['login']);
				}
			}
			if($items['lr']>0){
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".$items['lr']."' WHERE `id`='".$player['id']."' LIMIT 1;")){
					$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������!</font></b></font>&nbsp;�� �������� �������: <b>".$items['lr']." LR</b>.</font><BR>'+'');";chmsg($ms,$player['login']);
				}
			}
			$itemsacc = explode("|",$items['account']);
			if($itemsacc[0]>1){
				# ��������� �������
				$acc = explode("|",$player['premium']);
				if($acc[0]>1){
					if($acc[1]<time()){
						$timer = time()+(86400*$itemsacc[1]); # $itemsacc[1] ����
						$acc[0]=$items['account'];
					}else{
						$timer = $acc[1]+(86400*$itemsacc[1]); # $itemsacc[1] ���� � �������� ������� ��������
					} 
					$premium = $acc[0]."|".$timer;
				}else{
					if($acc[1]<time()){
						$timer = time()+(86400*$itemsacc[1]); # $itemsacc[1] ����
						$acc[0]=$items['account'];
					}else{
						$timer = $acc[1]+(86400*$itemsacc[1]); # $itemsacc[1] ���� � �������� ������� ��������
					} 
					$premium = $items['account']."|".$timer;
				}
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `premium`='".$premium."' WHERE `id`='".$player['id']."' LIMIT 1;");					
			}
		}		
	break;
	case 57: include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dressup.php");break;
	case 61:
		switch($act){
			case 1:
				if(testarena($player['battle'])==1){
				mysqli_query($GLOBALS['db_link'],'DELETE FROM arena WHERE id_battle='.AP.$player['battle'].AP.'');										
				mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.'0'.AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');}
			break;
			case 2:
				sumbat($player['battle'],"parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������� <b>".$_SESSION[user][login]."</b> ������� ���� ������! </font><BR>'+'');$redirect",1);
				mysqli_query($GLOBALS['db_link'],'UPDATE arena SET ok2='.AP.'0'.AP.' WHERE id_battle ='.AP.$player['battle'].AP.'LIMIT 1;');
				mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.'0'.AP.' WHERE login='.AP.$_SESSION[user]['login'].AP.'LIMIT 1;');
			break;
			case 3:
				sumbat($player['battle'],"parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������� <b>".$_SESSION[user][login]."</b> ��������� �� ��������! </font><BR>'+'');$redirect",1);
				mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.'0'.AP.' WHERE battle='.AP.$player['battle'].AP.'and login !='.AP.$_SESSION[user]['login'].AP.';');
				mysqli_query($GLOBALS['db_link'],'UPDATE arena SET ok2='.AP.'0'.AP.' WHERE id_battle ='.AP.$player['battle'].AP.'LIMIT 1;');
			break;
			case 4:
				sumbat($player['battle'],"$redirect",1);startbat($player['battle'],1);echo "<script>parent.frames['main_top'].location='main.php';</script>";
			break;
			case 6:
				if($mode==1){
					$win[0]=$player['side'];
					$win[1]=$player['level'];
					$win[999]=1;
				}else{
					$win[0]=3;
					$win[1]=$player['level'];
					$win[999]=0;
				}
				endbat($player['battle'],$win);
				mysqli_query($GLOBALS['db_link'],"UPDATE `arena` SET `vis`='3' WHERE `id_battle`='".$player['battle']."';");
			break;
			//�������� ����� 
			case 7:
				$exp=explode("|",$player['exp']);$exp[0]+=$player[dmg];
				$pldoblest = 0;
				if($player['DoblestFight'] == 1){
					$exp[2]+=intval($player['dmg']*0.25);
					$pldoblest = intval($player['dmg']*0.25);
				}
//				mysqli_query($GLOBALS['db_link'],'UPDATE user SET exp='.AP.implode("|", $exp).AP.', dmg = default, battle='.AP.'0'.AP.', fight='.AP.'0'.AP.' WHERE id='.AP.$player['id'].AP.';');
				//if($player['palac']>0) { mysqli_query($GLOBALS['db_link'],"update `user` set `palac_exr`=`palac_exr`+'1'WHERE `id`='".$player['id']."' AND `id`<'9999' LIMIT 1;"); }
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `experience`='".$exp[0]."',`exp`='".implode("|", $exp)."',`dmg`='0,0,0,0,0,0,0,0,0,0,0',`battle`='0',`fight`='0',`DoblestFight`='0' WHERE `id`='".$player['id']."';");
				calchp();
				$ple=$player['dmg'];	
				if($ple>0){
					# ����� � ��� ��� ��� ���������
						$old = $player['dmg'];
						if(bots_array($player,1)==12){							
							$player['dmg']=rand(1,$player['dmg']);
						}
						$typetolog = '0'; $abouttolog = '0'; # ���������� ��� �����: ������ ������ 0
						$typetolog .= '@2'; $abouttolog .= '@'.$player['dmg']; # ������� ����				
						player_actions($player['id'],$typetolog,$abouttolog);
						$player['dmg'] = $old;
					# 
					chlevel($exp,$player[level],$player[id]);
					$ms="parent.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font> <a onclick=\"window.open(\'../logs/".$player['battle']."\',\'\');\" title=\"��������\">  <font color=red>��������</font></a> �������. �������� <font color=#CC0000>�������</font> �����: <b><font color=#CC0000>$ple</font></b>. �������� <font color=#004BBB>��������</font> �����:  <b><font color=#004BBB>".($pldoblest)."</font></b>.</font><BR>'+'');";chmsg($ms,$_SESSION[user]['login']);
				}
			break;
			}
		mysqli_query($GLOBALS['db_link'],'DELETE FROM fight WHERE battle ='.AP.$player['battle'].AP.'');
	break;
	case 62:
		$fornickname=trim($fornickname);
		settype($magicreuid,"int");
		$dditem=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' AND `id_item`='".$magicreuid."' LIMIT 1;"));
		$ret=PlayerAttack($fornickname,$magicreuid,$dditem['effect'],$dditem['num_a']);
		$msg=$ret['msg'];
	break;
	case 63:
		$fornickname=trim($fornickname);
		$ret=PlayerAttack($fornickname,0,80,0);
		$msg=$ret[msg];
	break;
	case 66:
		include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/acc_check".".php");
	break;
	case 67:
		if($player['baks']>=7){
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `obnul`=`obnul`+'1',`baks`=`baks`-'7' WHERE `id`='".$player['id']."' LIMIT 1;");
			echo"<script>parent.jAlert('�� ������ ���������.');</script>";
		}
	break;
	case 68:
		if($player['baks']>=100){
			switch($_POST['sklon']){
				case 5: $sc=5; break;
				case 6: $sc=6; break;
				case 7: $sc=7; break;
				case 8: $sc=8; break;
				default: $sc=$player['sklon'];break;
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET sklon='".$sc."',baks=baks-100 WHERE id='".$player['id']."';");
		}
	break;
	case 80:
		switch($player['loc']){
			case 80: $pd=1;break;
			case 81: $pd=2;break;
		}
		$podq=mysqli_query($GLOBALS['db_link'],"SELECT * FROM podzem WHERE pl_id=".$player['id']." AND pod_id=".intval($pd).";");
		while($row = mysqli_fetch_array($podq)){
			if($row['end_time']<=time()){
				BotAttackPod($player,intval($pd));
			}
		}
	break;
	case 85:
		include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/cr_check".".php");
	break;
	case 86:		
		include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/autocr".".php");
	break;
	case 87:		
		mysqli_query($GLOBALS['db_link'],"DELETE FROM art_zayav WHERE id=".intval($_POST['id']).";");
	break;
	case 88:
		$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM credit WHERE uid='".$player['id']."';");
		switch(intval($_POST['act'])){
			case 1:				
				if(mysqli_num_rows($sql)==0 and !empty($_POST['srok']) and !empty($_POST['sum'])){
					switch(intval($_POST['sum'])){
						case 0: $sum=$player['level']*0; $prsum=0; $plat=0; break;
						case 1: $sum=round($player['level']*100);  break;
						case 2: $sum=round($player['level']*200);  break;
						case 3: $sum=round($player['level']*300);  break;
						case 4: $sum=round($player['level']*400);  break;
						default: $sum=round($player['level']*100);  break;
					}
					switch (intval($_POST['srok'])){
						case 0: $time=0; break;
						case 1: $time=time()+604800; $prsum=round($sum*1.1); $plat=$prsum; $next=time()+604800; break;
						case 2: $time=time()+1209600; $prsum=round($sum*1.2);  $plat=round($prsum/2); $next=time()+604800; break;
						case 3: $time=time()+2419200; $prsum=round($sum*1.4);  $plat=round($prsum/4); $next=time()+604800; break;
						case 4: $time=time()+4838400; $prsum=round($sum*1.8);  $plat=round($prsum/8); $next=time()+604800; break;
						default: $time=time()+604800; $prsum=round($sum*1.1); $plat=$prsum; $next=time()+604800; break;
					}
					mysqli_query($GLOBALS['db_link'],"INSERT INTO credit (uid,srok,next,sum,proc_sum,plat) VALUES (".$player['id'].",".$time.",".$next.",".$sum.",".$prsum.",".$plat.");");
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".$sum." WHERE id=".$player['id'].";");
					$message="������ ������� ��������";
				}
				else{
					$message="������ ��� ���������� �������.";		
				}
			break;
			case 2: 
				$csql=mysqli_fetch_array($sql);
				if($player['nv']>=$csql['plat']){
					$sum=$csql['plat']+$csql['sum_payed'];
					if($sum==$csql['proc_sum']){						
						mysqli_query($GLOBALS['db_link'],"DELETE FROM credit WHERE uid=".$player['id'].";");
						$message="������ �������� ".lr($csql['plat'])." �������� �������. ������ �������.";
					}
					else{
						$time=$csql['next']+604800;
						mysqli_query($GLOBALS['db_link'],"UPDATE credit SET sum_payed=".$sum.",next=".$time." WHERE uid=".$player['id'].";");
						$message="������ �������� ".lr($csql['plat'])." �������� �������.";
					}
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv-".$csql['plat']." WHERE id=".$player['id'].";");					
				}
				else{
					$message='������������ �������';
				}				
			break;
			case 3: 
				$csql=mysqli_fetch_array($sql);
				$sum=$csql['proc_sum']-$csql['sum_payed'];	
				if($player['nv']>=$sum){							
					mysqli_query($GLOBALS['db_link'],"DELETE FROM credit WHERE uid=".$player['id'].";");
					$message="������ �������� ".lr($sum)." �������� �������. ������ �������.";
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv-".$sum." WHERE id=".$player['id'].";");
				}
				else{
					$message='������������ �������';
				}
			break;
			case 4:
				!empty($_POST['time']) ? $ptime=intval($_POST['time']) : $ptime=0;
				$query="";
				$err=0;
				switch($ptime){
					case 0: $time=0; $nv=0; $dd=0; $txt=""; break;
					case 1: $time=time()+(604800*1); $nv=250; $txt="���� ������� ��������� �� 1 ������"; break;
					case 2: $time=time()+(604800*4); $nv=900; $txt="���� ������� ��������� �� 4 ������"; break;
					case 3: $time=time()+(604800*8); $nv=1600; $txt="���� ������� ��������� �� 8 ������"; break;
					case 4: $time=time()+(604800*36); $nv=0; $dd=2; $txt="���� ������� ��������� �� 36 ������"; break;
				}
				$query=$ptime!=0 ? "UPDATE user SET seif=".$time.",".($dd==0 ? ($player['nv']>=$nv ? "nv=nv-".$nv : $err=1) : ($player['dd']>=$dd ? "dd=dd-".$dd : $err=1))." WHERE id=".$player['id'] : "";
				if($err==0){
					mysqli_query($GLOBALS['db_link'],"".$query."");
					$message=$txt;
				}
				else{
					$message='������������ �������';
				}
			break;
			case 5:
				$id_item=intval($_POST['item']);
				mysqli_query($GLOBALS['db_link'],"UPDATE invent SET bank='1' WHERE id_item='".$id_item."' AND pl_id='".$player['id']."';");
				$message="<font class=nickname>��� ������ �������!</font>";				
			break;
			case 6:
				$id_item=intval($_POST['item']);
				mysqli_query($GLOBALS['db_link'],"UPDATE invent SET bank='0' WHERE id_item='".$id_item."' AND pl_id='".$player['id']."';");
				$message="<font class=nickname>��� ������ �������!</font>";				
			break;
			case 7:
				$id_item=intval($_POST['item']);
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `bank`='1' WHERE `protype`='".$id_item."' AND pl_id='".$player['id']."';");
				$message="<font class=nickname>��� ������ �������!</font>";				
			break;
			case 8:
				$id_item=intval($_POST['item']);
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `bank`='0' WHERE `protype`='".$id_item."' AND pl_id='".$player['id']."';");
				$message="<font class=nickname>��� ������ �������!</font>";				
			break;
		}	
	break;
	case 89:
		mysqli_query($GLOBALS['db_link'],"UPDATE invent SET bank='0' WHERE pl_id='".$player['id']."';");
		$message="�� ������� ��� ���� �� �����.";	
	break;
	case 90:
		mysqli_query($GLOBALS['db_link'],"UPDATE invent SET bank='1' WHERE pl_id='".$player['id']."' AND clan='0';");
		$message="�� �������� ���� � ����.";	
	break;
	case 91:
		if(!empty($_POST['sum']) and !empty($_POST['type'])){
			$sum=intval($_POST['sum']);
			$type=intval($_POST['type']);
			$str="";
			if($player['nv']>=$sum and $sum>0){
				switch($type){
					case 0: $str=0; break;
					case 1: $str=(time()+86400*5)."|".$sum."|".round($sum/100*5+$sum); break;
					case 2: $str=(time()+86400*10)."|".$sum."|".round($sum/100*1.1*10+$sum); break;
					case 3: $str=(time()+86400*30)."|".$sum."|".round($sum/100*1.2*30+$sum); break;
					default: $str=(time()+86400*5)."|".$sum."|".round($sum/100*5+$sum); break;
				}
				mysqli_query($GLOBALS['db_link'],"UPDATE user SET vklad='".$str."',nv=nv-".$sum." WHERE id=".$player['id']." LIMIT 1;");
				$message="�� ������� ������� ����� � ���� �� ����� ".lr($sum).".";
			}
			else{
				$message='������������ �������';
			}
		}
	break;
	case 92:
			$vklad = $player['vklad']!=0 ? explode("|",$player['vklad']) : $vklad[0]="";
			$vklad[0]!=""  ? ($vklad[0]>time() ? mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".$vklad[1].",vklad=0 WHERE id=".$player['id']." LIMIT 1;") : mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".$vklad[2].",vklad=0 WHERE id=".$player['id']." LIMIT 1;")) : $message="�� �� ������ �������";
			$message="������� �������� ������ �� ������";
	break;
	case 93:		
		switch(intval($_POST['act'])){
			case 1:
				$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE pl_id=".$player['id'].";");
				if(mysqli_num_rows($sql)==0){					
					$num=time().$session_id;
					mysqli_query($GLOBALS['db_link'],"INSERT INTO bank (num,pass,pl_id) VALUES ('".intval($num)."','".md5($_POST['pass'])."','".$player['id']."');");
					$message="������: ".$_POST['pass']."<br> ����� �����: ".$num."<br>������� ��������� ��� ������, ��� ����� ������ ������ � ����� �� �����������������!";
				}
			break;
			case 2:
				$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE clan_id='".$player['clan_id']."';");
				if(mysqli_num_rows($sql)==0){					
					$num=time().$session_id;
					mysqli_query($GLOBALS['db_link'],"INSERT INTO bank (num,pass,clan_id) VALUES ('".intval($num)."','".md5($_POST['pass'])."','".$player['clan_id']."');");
					$message="������: ".$_POST['pass']."<br> ����� �����: ".$num."<br>������� ��������� ��� ������, ��� ����� ������ ������ � ����� �� �����������������!";
				}
			break;
		}
	break;
	case 94:
						$typetolog = '0'; $abouttolog = '0';  # ���������� ��� �����: ������ ������ 0

			$wsuid = intval($wsuid);
			$IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `market`.*, `items`.*
			FROM `market` LEFT JOIN `items` ON `market`.`id` = `items`.`id`
			WHERE `kol`>'0' AND `items`.`dd_price`>'0' AND `items`.`id`='".$wsuid."' and `items`.`type`!='w61' and `items`.`type`!='w0' and `items`.`type`!='w66' and `items`.`type`!='w69' and `items`.`type`!='w68' and `items`.`type`!='w29' LIMIT 1;"));
			if($IT!=''){
				switch(intval($_GET['act'])){
					case 1:
						$arenda=time()+86400*10;
						if($player['baks']>=round($IT['dd_price']*3/50+3)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,arenda) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]*3/50+3).AP.','.AP.$arenda.AP.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']*3/50+3).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ���������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]*3/50+3),"market");
							$typetolog .= '@14';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]*3/50+3).'</b> �������. [10 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 2:
						$arenda=time()+86400*20;
						if($player['baks']>=round($IT['dd_price']*3/35+4)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,arenda) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]*3/35+4).AP.','.$arenda.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']*3/35+4).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ���������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]*3/35+4),"market");
							$typetolog .= '@14';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]*3/35+4).'</b> �������. [20 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 3:
						$arenda=time()+86400*30;
						if($player['baks']>=round($IT['dd_price']*3/20+5)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,arenda) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]*3/20+5).AP.','.$arenda.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']*3/20+5).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ���������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]*3/20+5),"market");
							$typetolog .= '@14';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]*3/20+5).'</b> �������. [30 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 4:
						$arenda=time()+86400*3;
						if($player['baks']>=round($IT['dd_price']*3/110+1)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,arenda) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]*3/110+1).AP.','.$arenda.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']*3/110+1).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ���������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]*3/110+1),"market");
							$typetolog .= '@14';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]*3/110+1).'</b> �������. [3 ���]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 5:
						$arenda=time()+86400*7;
						if($player['baks']>=round($IT['dd_price']*3/80+2)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,arenda) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]*3/80+2).AP.','.$arenda.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']*3/80+2).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ���������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]*3/80+2),"market");
							$typetolog .= '@14';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]*3/80+2).'</b> �������. [7 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
				}
				if($typetolog!='0' and $abouttolog!='0'){
					player_actions($player['id'],$typetolog,$abouttolog);
				}				
			}
	break;
	case 95:
		$typetolog = '0'; $abouttolog = '0';  # ���������� ��� �����: ������ ������ 0
		$wsuid = intval($wsuid);
		$IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
		FROM market LEFT JOIN items ON market.id = items.id
		WHERE kol>0 AND items.dd_price>0 AND items.id=".$wsuid." AND items.type!='w61' AND items.type!='w0' LIMIT 1;"));
		if($IT!=''){
				switch(intval($_GET['act'])){
					case 1:
						$rassrok=time()+86400*30;
						if($player['baks']>=round($IT['dd_price']/2+1)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,rassrok) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]/2+1).AP.','.AP.$rassrok.AP.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']/2+1).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ����� � ��������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]/2+1),"market");
							$typetolog .= '@15';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]/2+1).'</b> �������. [30 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 2:
						$rassrok=time()+86400*60;
						if($player['baks']>=round($IT['dd_price']/3+1)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,rassrok) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]/3+1).AP.','.$rassrok.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']/3+1).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ����� � ��������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]/3+1),"market");
							$typetolog .= '@15';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]/3+1).'</b> �������. [60 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
					case 3:
						$rassrok=time()+86400*90;
						if($player['baks']>=round($IT['dd_price']/4+1)){
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}}
							mysqli_query($GLOBALS['db_link'],'INSERT INTO invent (protype,pl_id,dolg,dd_price,rassrok) VALUES ('.AP.$IT[id].AP.','.AP.$player[id].AP.','.AP.$dolg.AP.','.AP.round($IT[dd_price]/4+1).AP.','.$rassrok.');');
							mysqli_query($GLOBALS['db_link'],'UPDATE user SET baks=baks-'.round($IT['dd_price']/4+1).' WHERE id='.AP.$player[id].AP.'LIMIT 1;');
							$msg="<b><font class=proce>�� ������ ����� � ��������� \"$IT[name]\"!</font></b>"; log_write("buy",$IT[name],round($IT[dd_price]/4+1),"market");
							$typetolog .= '@15';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> . �� ����: <b>'.round($IT[dd_price]/4+1).'</b> �������. [90 ����]';
						}
						else{$msg="<b><font class=proce>��������� �����!</font></b>"; }
					break;
			}
				if($typetolog!='0' and $abouttolog!='0'){
					player_actions($player['id'],$typetolog,$abouttolog);
				}	
		}
	break;
	case 96:
		$wsuid = intval($wsuid);
		$ITEM = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT invent.*,  items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE pl_id=".$player['id']." and invent.used='0' AND invent.bank='0' and invent.id_item = ".$wsuid." LIMIT 1;"));
		$dd = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT invent.dd_price FROM invent WHERE id_item=".$ITEM['id_item']." LIMIT 1;"));
		if($ITEM!=''){
			if($player['baks']>=($ITEM['dd_price']-$dd['dd_price'])){
				mysqli_query($GLOBALS['db_link'],"UPDATE invent SET rassrok=0,dd_price=".$ITEM['dd_price']." WHERE id_item=".$wsuid." and pl_id=".$player['id']." LIMIT 1");
				mysqli_query($GLOBALS['db_link'],"UPDATE user SET baks=baks-".($ITEM['dd_price']-$dd['dd_price'])." WHERE id=".$player['id'].";");
				$msg='������ ����������� �������';
			}
		}
	break;
	case 97:
		$naemnik="0|".(time()+120);
		if($player['level']<=9){
			$nvm = 10;
		}
		elseif($player['level']<=15){
			$nvm = 25;
		}
		elseif($player['level']>15){
			$nvm = 50;
		}
		if($player['nv']>=$nvm){
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `naemnik`='".$naemnik."',`nv`=`nv`-'".$nvm."' WHERE `login`='".$player['login']."';");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;legendbattles.ru&nbsp;</font> <font color=000000>����� <b> ".$player['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$player['login']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://d0009394.atservers.net/ipers.php?".$player['login']."\');\" ></a>  ������ ������� ��� ������  � <a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onclick=\"window.open(\'../logs.php?fid=".$_POST['fightlog']."\',\'\');\" title=\"��� ���\">���.<a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onClick=\"naemnik(\'".$_POST['forlogin']."\')\"> ������ � ���. <font style=\"font-size: 10px;\">>>></font></font></a></font><BR>'+'');")."');");
		}
	break;
	case 98:
		$forlogin=chars($_GET['forlogin']);
		$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE login='".$forlogin."';"));
		$naemnik=explode("|",$pl['naemnik']);
		if($naemnik[0]==0){
			NaemAttack($forlogin);
		}		
	break;
	case 99:
		if(!empty($_POST['sum']) and !empty($_POST['type1']) and !empty($_POST['type2'])){
			$sum=intval($_POST['sum']);
			$type1=intval($_POST['type1']);
			$type2=intval($_POST['type2']);
			$str="";
			if($sum<1){$sum=1;}
			switch($type1){
				case 1:
					if($player['baks']>=$sum and $sum>0){
					switch($type2){
						case 0: $str=0; $sum=0; break;
						case 1: $sum > 500?$sum=500:'';$str=(time()+86400*25)."|".$sum."|".round($sum/100*0.5*25+$sum); break;
						case 2: $sum > 1000?$sum=1000:'';$str=(time()+86400*50)."|".$sum."|".round($sum/100*0.9*50+$sum); break;
						default: $sum > 500?$sum=500:'';$str=(time()+86400*25)."|".$sum."|".round($sum/100*0.5*25+$sum); break;
					}
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET vklad_bank='".$str."',baks=baks-".$sum." WHERE id=".$player['id']." LIMIT 1;");
					$message="�� ������� ������� ����� � ���� �� ����� ".$sum." �������.";
					}
					else{
						$message='������������ �������';
					}
				break;
				case 2:
					if($player['dd']>=$sum and $sum>0){
					switch($type2){
						case 0: $str=0; $sum=0; break;
						case 1: $sum > 300?$sum=300:'';$str=(time()+86400*30)."|".$sum."|".round($sum/100*0.5*30+$sum); break;
						case 2: $sum > 1000?$sum=1000:'';$str=(time()+86400*60)."|".$sum."|".round($sum/100*0.8*60+$sum); break;
						default: $sum > 300?$sum=300:'';$str=(time()+86400*30)."|".$sum."|".round($sum/100*0.5*30+$sum); break;
					}
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET vklad_bank='".$str."',baks=baks-".$sum." WHERE id=".$player['id']." LIMIT 1;");
					$message="�� ������� ������� ����� � ���� �� ����� ".$sum." �������.";
					}
					else{
						$message='������������ �������';
					}
				break;
			}
		}
	break;
	case 100:
			$vklad = $player['vklad_bank']!=0 ? explode("|",$player['vklad_bank']) : $vklad[0]="";
			$vklad[0]!=""  ? ($vklad[0]>time() ? mysqli_query($GLOBALS['db_link'],"UPDATE user SET baks=baks+".$vklad[1].",vklad_bank=0 WHERE id=".$player['id']." LIMIT 1;") : mysqli_query($GLOBALS['db_link'],"UPDATE user SET baks=baks+".$vklad[2].",vklad_bank=0 WHERE id=".$player['id']." LIMIT 1;")) : $message="�� �� ������ �������";
			$message="������� �������� ������ �� ������";
	break;
	case 101: 
		$fornickname=trim($_POST['fornickname']);
		if($fornickname!=$player['login']){
			$forprice= (intval($_POST['gold'])) * 10000 + (intval($_POST['silver'])) * 100 + (intval($_POST['bronze']));
			$fornickname=chars($fornickname);
			$selluid=intval($_POST['selluid']);
			$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`login`,`user`.`last`,`user`.`loc`,`user`.`pos`,`user`.`fight` FROM `user` WHERE `login`='".$fornickname."' LIMIT 1;"));
			if($pl['loc']==$player['loc'] and $pl['pos']==$player['pos'] and $pl['fight']==0){
			if($fornickname!='' and $forprice>0){
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `sellprice`='".$forprice."' WHERE `protype`='".$selluid."' AND `pl_id`='".$player['id']."';");
				$ms="parent.frames['main_top'].location='main.php?useaction=trade&act=2&uid=".$player['id']."&id=".$selluid."&forprice=".$forprice."&login=".$player['login']."';";
				chmsg($ms,$fornickname);
				$msg='<b><font class=proce>�������� �������������</font></font></b>';}
			}
			else{$msg='<b><font class=proce>������ ����������! �������� ����������� ���� � ���!</font></b>';}
			unset($pl);
		}
	break;
	case 106:
		if($_GET['act'] and $player['present']==0 and in_array($_GET['vcode'],$_SESSION['secur']) or $player['login']=='mozg'){
			# ��������� �������
			$acc = explode("|",$player['premium']);
			if($acc[0]>2){
				if($acc[1]<time()){$timer = time()+(86400*14);$acc[0]=$items['account'];} # 14 ����
				else{$timer = $acc[1]+(86400*14);} # 14 ���� � �������� ������� ��������
				$premium = $acc[0]."|".$timer;
			}else{
				if($acc[1]<time()){$timer = time()+(86400*14);} # 14 ����
				else{$timer = $acc[1]+(86400*14);} # 14 ���� � �������� ������� ��������
				$premium = "3|".$timer;
			}
			$deathtime=time()+(7776000);
			# ���� �������� ��� �����			
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`,`clan`,`death`) VALUES ('2068','".$player['id']."','500','2014','1','legendbattles.ru!<br><font color=red>����������� � ���������� �������!</font><br>�������, ��� �� � ����','1','".$deathtime."');");
			# ���������� �����
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`,`clan`,`death`) VALUES ('2648','".$player['id']."','350','90','1','legendbattles.ru!<br><font color=red>����������� � ���������� �������!</font><br>�������, ��� �� � ����','1','".$deathtime."');");
			# ���� ����� � �������
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`+'20',`dd`=`dd`+'14',`nv`=`nv`+'2014',`present`='1',`premium`='".$premium."' WHERE `id`='".$player['id']."' LIMIT 1;");
			# �������
			$ms[1]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;�� �������� ������� �� <b>����� ���</b>!</font><BR>'+'');";
			$ms[2]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>20$</b>!</font><BR>'+'');";
			$ms[3]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>14 DLR</b>!</font><BR>'+'');";
			$ms[4]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>2014 LR</b>!</font><BR>'+'');";
			$ms[5]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>�������� ��� �����</b>!</font><BR>'+'');";
			$ms[6]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>���������� �����</b>!</font><BR>'+'');";
			$ms[7]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>����� ����� 10%</b>!</font><BR>'+'');";
			$ms[8]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>��������!</font></b> &nbsp;��������: <b>Gold ������� �� 14 ����</b>! (���� � ��� ��� Basic ��� Silver ������� - �� ��� ��������� � Gold � ������� �� 14 ����, VIP � Platinum �������� ���� �������� �� 14 ����)</font><BR>'+'');";
			foreach($ms as $k=>$v){
				chmsg($ms[$k],$player['login']);		
			}			
		}
	break;
	case 107:
		$dditem=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$player['id'].'" AND `id_item`="'.intval($_POST['uid']).'" LIMIT 1;'));
		if($dditem['id'] and $dditem['acte']=="ObnulForm"){
			obnul_pl_sv($player);
			it_break($dditem['id_item']);
		}
	break;
	case 108:
		switch(intval($_GET['act'])){
			case 1:
				$col = intval($_GET['col']);
				if($col<1){$col=1;}
				$timer = 1;//round(($_GET['t']/1000),0);
				$timer2 = 2;//round(($_GET['t2']/1000),0);
				if($timer2 < $timer){$msg="�������� ������ �����������";}
				else{
					$pt=explode("|",$pers['st']);
					$les=$player['les']+$pt[60];
					$plles = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `items`.`type`='w68' AND `items`.`effect`>'0' AND `items`.`num_a`='' AND `items`.`slot`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0' AND `invent`.`protype`='".intval($_GET['uid'])."' LIMIT ".$col.";");
					$num=mysqli_num_rows($plles);
					if($num>0){
						$pllesarr = mysqli_fetch_array($plles);
						$rndtrav = round(($pers['les']/20)+2);
						if($rndtrav>5){$rndtrav=5;}					
						$dercount = 0;
						$chipscount = 0;
						for($i=0;$i<$num;$i++){
							$rand=rand(1,$rndtrav);
							$dercount += $rand;
							$chipscount += 5-$rand;
							
						}					
						$allgrass = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `items`.`type`='w68' AND `items`.`slot`='0'  AND `items`.`effect`='1' AND `items`.`num_a`='32' LIMIT 1;"));
						$allgrass2 = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `items`.`type`='w68' AND `items`.`slot`='0'  AND `items`.`effect`='2' AND `items`.`num_a`='32' LIMIT 1;"));
						if($allgrass['id'] and $allgrass2['id']){
							if($allgrass['dd_price']>0){$pr=$allgrass['dd_price'];$filt="`dd_price`";}
							else{$pr=$allgrass['price'];$filt="`price`";}
							$par=explode("|",$allgrass['param']);
							foreach ($par as $value) {
								$stat=explode("@",$value);
								switch($stat[0]){case 2: $dolg=$stat[1];break;}
							}
							for($i=0; $i<$dercount;$i++){
								$insert.="('".$allgrass['id']."','".$player['id']."','".$dolg."','".$pr."','0','".(time()+604800)."'),";
							}
							if($allgrass2['dd_price']>0){$pr=$allgrass2['dd_price'];$filt="`dd_price`";}
							else{$pr=$allgrass2['price'];$filt="`price`";}
							$par=explode("|",$allgrass2['param']);
							foreach ($par as $value) {
								$stat=explode("@",$value);
								switch($stat[0]){case 2: $dolg=$stat[1];break;}
							}
							for($i=0; $i<$chipscount;$i++){
								$insert.="('".$allgrass2['id']."','".$player['id']."','".$dolg."','".$pr."','0','".(time()+604800)."'),";
							}
							$insert=substr($insert,0,strlen($insert)-1);
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,".$filt.",`mod_color`,`death`) VALUES ".$insert.";");
							mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' AND `protype`='".intval($_GET['uid'])."' AND `clan`='0' AND `used`='0' AND `bank`='0' LIMIT ".$col.";");
							$msg="<font class=proceb><b>������������:</b></font><font class=proce><br>".$pllesarr['name']."</b> (".$num." ��.)</font><br><font class=proceb><b>���������:</b></font><br><font class=proceg>".$allgrass['name']." (".$dercount." ��.)".($chipscount?"<br>".$allgrass2['name']." (".$chipscount." ��.)":"")."</font></b>";
						}
					}
				}
			break;
		}		
	break;
	case 109:
		$typetolog = '0'; $abouttolog = '0'; # ���������� ��� �����: ������ ������ 0
		switch(intval($_POST['act'])){
			case 1: 
				$palatka = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `rinok_palatki` WHERE `id`='".intval($_POST['palatka'])."' LIMIT 1;"));
				if($palatka['id']){
					if(intval($_POST['mesto'])>0 and intval($_POST['mesto'])<=6){
						$mesto = 'owner_'.intval($_POST['mesto']);
						if(!$palatka[$mesto]){
							$msg='test';
							$err=0;
							for($i=1;$i<=6;$i++){
								$check = explode("@",$palatka['owner_'.$i]);
								if($check[0]==$player['id']){$err=1;}
							}
							if(!$err){
								switch(intval($_POST['time'])){
									 case 1: $arr = $player['id'].'@'.(time()+86400*30); $val='nv';break;
									 case 2: $arr = $player['id'].'@'.(time()+(86400*30*12)+(86400*5)); $val='dd';break;
									 default: $arr = $player['id'].'@'.(time()+86400*30); $val='nv'; break;
								}
								$err=1;
								switch($val){
									case 'nv': if($player['nv']>=1200){$err=0;}else{$err=1;}break;
									case 'dd': if($player['dd']>=15){$err=0;}else{$err=1;}break;
								}								
								if(!$err){	
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `rinok_palatki` SET `".$mesto."`='".$arr."' WHERE `id`='".$palatka['id']."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET ".($val=='nv'?"`nv`=`nv`-'1200'":"`dd`=`dd`-'15'")." WHERE `login`='".$player['login']."' LIMIT 1;")){
										$msg="<font class=proceb>�� ��������� ����� �� �����:</font><br><font class=proceg>������� �".$palatka['id'].".<br>�������� ����� �".intval($_POST['mesto']).".<br>����: ".($val=='nv'?'30 ����':'365 ����')."</font>";
										$typetolog .= '@24'; $abouttolog .= '@'.$msg;
										player_actions($player['id'],$typetolog,$abouttolog);										
									}
									else{$msg="<font class=proce>��������� ������!<br>���������� � �������������.</font>";}
								}
								else{$msg="<font class=proce>������������ �������.</font>";}
							}
							else{$msg="<font class=proce>� ��� ��� ������� ����� � ������ �������.</font>";}
						}
						else{$msg="<font class=proce>�������� ����� ��� ������!</font>";}
					}
					else{$msg="<font class=proce>�������� ����� ��������� �����.</font>";}
				}
				else{$msg="<font class=proce>������� �� �������.</font>";}
			break;
			case 2:
				$msg = '<form method=post><input type=hidden name=vcode value="'.scode().'" /><input type=hidden name=post_id value="109" /><input type=hidden name=act value="3" /><input type=hidden name=palatka value="'.intval($_POST['palatka']).'" /><input type=hidden name=palatka_type value="'.intval($_POST['palatka_type']).'" />';
				switch(intval($_POST['palatka_type'])){
					case 1: $filter = " AND `items`.`type`!='w61' and `items`.`type`!='w66' and `items`.`type`!='w69'  and `items`.`type`!='w68' and `items`.`type`!='w29' and `items`.`type`!='w0' and `items`.`type`!='w30' "; $filter2 = "AND `items`.`price`>=50"; break;
					case 2: $filter = " AND (`items`.`type`='w61' or `items`.`type`='w66' or `items`.`type`='w69' or `items`.`type`='w68' or `items`.`type`='w0') "; $filter2 = "AND `items`.`price`<=500"; break;
					default: $filter = " AND `items`.`type`!='w61' and `items`.`type`!='w66' and `items`.`type`!='w69'  and `items`.`type`!='w68' and `items`.`type`!='w29' and `items`.`type`!='w0' and `items`.`type`!='w30' "; $filter2 = "AND `items`.`price`>=50"; break;
				}
				$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0' AND (`arenda`>='".time()."' OR `arenda`='0') AND `items`.`dd_price`='0' ".$filter2." AND `invent`.`iznos`='0' AND `items`.`auc_cats`='0' ".$filter.";");
				$num = (mysqli_num_rows($ITEMS));
				if($num>0){
					$msg .= '<select name=itemid>';
					while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
						if($ITEM['grav']){$ITEM['name'] = $ITEM['name']." (".$ITEM['grav'].")";}
						$par=explode("|",$ITEM['param']);
						$mod=explode("|",$ITEM['mod']);
						$need=explode("|",$ITEM['need']);
						$vcod=scode();
						$iz=$ITEM[dolg]-$ITEM[iznos];
						$izn = round(($iz/($ITEM[dolg]/100))*0.62);
						$bt=0;
						$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] += 1;
						if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] == 1){
							$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`mod`='".$ITEM['mod']."' and `invent`.`clan`='".$ITEM['clan']."' and `invent`.`grav`='".$ITEM['grav']."' and `invent`.`bank`='0' $sq $sq2;"));
							if($ITEM['mod_color']==0){
								$msg .= '<option value="'.$ITEM['id_item'].'">';
								$msg .= $ITEM['name'].($ITEM['modified']==1 ? " [��]" : "");
							}
							elseif($ITEM['mod_color']==1){
								$msg .= '<option value="'.$ITEM['id_item'].'" style="background:#006600;"><b>';
								$msg .= $ITEM['name']."</font> [���]".($ITEM['modified']==1 ? " [��]" : "")."</b>";
							}
							elseif($ITEM['mod_color']==2){
								$msg .= '<option value="'.$ITEM['id_item'].'" style="background:#3333CC;"><b>';
								$msg .= $ITEM['name']."</font> [���]".($ITEM['modified']==1 ? " [��]" : "");
							}
							elseif($ITEM['mod_color']==3){
								$msg .= '<option value="'.$ITEM['id_item'].'" style="background:#AF51B5;"><b>';
								$msg .= $ITEM['name']."</font> [���]".($ITEM['modified']==1 ? " [��]" : "");
							}
							$msg .= '</option>';
						}
					}					
					$msg .= '</select>';
					$msg .= "<br><input type=text name=price class=logintextbox6 value=���� >";
					if(intval($_POST['palatka_type'])==2){
						$msg .= "<select name=count><option value=1 selected> 1 ��</option><option value=2>10 ��</option><option value=3>25 ��</option></select>";
					}
					$msg .= "<br><input type=submit class=lbut value=��������� ���� �� �������></form>";
				}
				else{$msg="<font class=proce>� ��� ������ ��������� �� �������.</font>";}
			break;
			case 3:
				if(intval($_POST['itemid']) and intval($_POST['palatka'])<=30 and intval($_POST['price'])>0 and ((intval($_POST['palatka_type'])==1 and intval($_POST['palatka'])>0) or (intval($_POST['palatka_type'])==2  and intval($_POST['palatka'])==0))){
					$err = 1;
					switch(intval($_POST['palatka_type'])){
						case 1: $filter = " AND `items`.`type`!='w61' and `items`.`type`!='w66' and `items`.`type`!='w69'  and `items`.`type`!='w68' and `items`.`type`!='w29' and `items`.`type`!='w0' and `items`.`type`!='w30' "; $filter2 = "AND `items`.`price`>=50"; break;
						case 2: $filter = " AND (`items`.`type`='w61' or `items`.`type`='w66' or `items`.`type`='w69' or `items`.`type`='w68' or `items`.`type`='w0') "; $filter2 = "AND `items`.`price`<=500"; break;
						default: $filter = " AND `items`.`type`!='w61' and `items`.`type`!='w66' and `items`.`type`!='w69'  and `items`.`type`!='w68' and `items`.`type`!='w29' and `items`.`type`!='w0' and `items`.`type`!='w30' "; $filter2 = "AND `items`.`price`>=50"; break;
					}
					if(intval($_POST['palatka_type'])==2  and intval($_POST['palatka'])==0){
						$palatka=0; $err=0;
					}
					else{
						$palatka = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `rinok_palatki` WHERE `id`='".intval($_POST['palatka'])."' LIMIT 1;"));
						for($i=1;$i<=6;$i++){$owner = explode("@",$palatka['owner_'.$i]);
						if($owner[0]==$player['id'] and $owner[1]>time()){$err=0;}}
					}
					if($err==0){
						$ITEM = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`id_item`='".intval($_POST['itemid'])."' and `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0' AND (`arenda`>='".time()."' OR `arenda`='0') AND `items`.`dd_price`='0' ".$filter." ".$filter2." AND `invent`.`iznos`='0' LIMIT 1;"));
						if($ITEM['id_item']){
							if(intval($_POST['price'])>$ITEM['price']){
								switch(intval($_POST['count'])){
									case 1: $cnt = 1; break;
									case 2: $cnt = 10; break;
									case 3: $cnt = 25; break;
									default: $cnt = 1; break;
								}
								$insert ='';
								$filt = '';
								if($cnt>1){
									$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' and `invent`.`protype`='".$ITEM['protype']."' AND `invent`.`bank`='0'  AND `invent`.`clan`='0' AND (`arenda`>='".time()."' OR `arenda`='0') AND `items`.`dd_price`='0' ".$filter." ".$filter2."  AND `invent`.`iznos`='0' LIMIT ".$cnt.";");
									$num = mysqli_num_rows($ITEMS);									
									for($i=0;$i<$num;$i++){
										$IT = mysqli_fetch_array($ITEMS);
										$filt .= " `id_item`='".$IT['id_item']."' or";
										if($IT['id_item']){
											$insert .= "('".$IT['id_item']."','".$IT['protype']."','".$IT['pl_id']."','".$IT['mod']."','".$IT['mod_color']."','".$IT['modified']."','".$IT['used']."','".$IT['iznos']."','".$IT['dolg']."','".$IT['price']."','".$IT['dd_price']."','".$IT['curslot']."','".$IT['clan']."','".$IT['bank']."','".$IT['arenda']."','".$IT['rassrok']."','".$IT['death']."','".$IT['grav']."','".intval($_POST['price'])."','".$IT['gift']."','".$IT['gift_from']."','".intval($_POST['palatka'])."','".intval($_POST['palatka_type'])."' ),";
										}	
									}
									$filt=substr($filt,0,strlen($filt)-2);
									$insert=substr($insert,0,strlen($insert)-1);
								}
								else{
									$num = 1;
									$insert .= "('".$ITEM['id_item']."','".$ITEM['protype']."','".$ITEM['pl_id']."','".$ITEM['mod']."','".$ITEM['mod_color']."','".$ITEM['modified']."','".$ITEM['used']."','".$ITEM['iznos']."','".$ITEM['dolg']."','".$ITEM['price']."','".$ITEM['dd_price']."','".$ITEM['curslot']."','".$ITEM['clan']."','".$ITEM['bank']."','".$ITEM['arenda']."','".$ITEM['rassrok']."','".$ITEM['death']."','".$ITEM['grav']."','".intval($_POST['price'])."','".$ITEM['gift']."','".$ITEM['gift_from']."','".intval($_POST['palatka'])."','".intval($_POST['palatka_type'])."' )";
								}
								if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `rinok` (`id_item` ,  `protype` ,  `pl_id` ,  `mod` ,  `mod_color` ,  `modified` ,  `used` ,  `iznos` ,  `dolg` ,  `price` ,  `dd_price` ,  `curslot` ,  `clan` ,  `bank` ,  `arenda` ,  `rassrok` ,  `death` ,  `grav` ,  `sellprice` ,  `gift` ,  `gift_from` ,  `palatka` ,  `palatka_type` ) VALUES ".$insert." ")){
									mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' ".($num>1?"AND ( ".$filt." )":"AND  `id_item`='".$ITEM['id_item']."'")." LIMIT ".$num.";");
									$msg="<font class=proceg>�� ������� ��������� ";
									if($ITEM[mod_color]==0){$msg .= "<b>".$ITEM[name].($ITEM[modified]==1 ? " [��]" : "")."</b>";}
									else
									  {
										 if($ITEM[mod_color]==1){$msg .= "<font color=#006600>".$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")."</font></b>";}
										 if($ITEM[mod_color]==2){$msg .= "<font color=#4ABB58>".$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")."</font></b>";}
										 if($ITEM[mod_color]==3){$msg .= "<font color=#993399>".$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")."</font></b>";}
									  }
									if($num>1){$msg.=" ".$num."��.";}									 
									$msg.=" �� ���� ".intval($_POST['price'])." LR".($num>1?" �� ��":"").".</font>";
									$typetolog .= '@24'; $abouttolog .= '@'.$msg;	
									player_actions($player['id'],$typetolog,$abouttolog);
								}
								else{$msg="<font class=proce>��������� ������!<br>���������� � �������������.</font> ";}
							}
							else{$msg="<font class=proce>���� ������� �� ������ ���� ���� � ��������� ����.</font>";}
						}
						else{$msg="<font class=proce>���� �� �������.</font>";}
					}
					else{$msg="<font class=proce>� ��� ��� ��������� ����� � ���� �������.</font>";}
				}
			break;
		}
	break;
	case 110:
		$typetolog = '0'; $abouttolog = '0';  # ���������� ��� �����: ������ ������ 0
		switch(intval($_GET['act'])){
			case 1:
				$ITEM=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.* FROM `rinok` INNER JOIN `items` ON `rinok`.`protype` = `items`.`id` WHERE `rinok`.`id_item`='".intval($_GET['uid'])."' LIMIT 1;"));
				if($ITEM['id_item']){
					if(intval($_GET['col'])<=0 or !intval($_GET['col'])){$cnt=1;}
					else{$cnt = intval($_GET['col']);}
					if($cnt>1){						
						$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.* FROM `items` INNER JOIN `rinok` ON `items`.`id` = `rinok`.`protype` WHERE `rinok`.`protype`='".$ITEM['protype']."' AND `rinok`.`sellprice`='".$ITEM['sellprice']."'  AND `rinok`.`pl_id`='".$ITEM['pl_id']."' LIMIT ".$cnt.";");
						$num = mysqli_num_rows($ITEMS);									
							for($i=0;$i<$num;$i++){
								$IT = mysqli_fetch_array($ITEMS);
								$filt .= " `id_item`='".$IT['id_item']."' or";
								if($IT['id_item']){
									$insert .= "('".$IT['id_item']."','".$IT['protype']."','".$player['id']."','".$IT['mod']."','".$IT['mod_color']."','".$IT['modified']."','".$IT['used']."','".$IT['iznos']."','".$IT['dolg']."','".$IT['price']."','".$IT['dd_price']."','".$IT['curslot']."','".$IT['clan']."','".$IT['bank']."','".$IT['arenda']."','".$IT['rassrok']."','".$IT['death']."','".$IT['grav']."','".(0)."','".$IT['gift']."','".$IT['gift_from']."'),";
								}	
							}
							$filt=substr($filt,0,strlen($filt)-2);
						$insert=substr($insert,0,strlen($insert)-1);
					}
					else{
						$num = 1;
						$insert .= "('".$ITEM['id_item']."','".$ITEM['protype']."','".$player['id']."','".$ITEM['mod']."','".$ITEM['mod_color']."','".$ITEM['modified']."','".$ITEM['used']."','".$ITEM['iznos']."','".$ITEM['dolg']."','".$ITEM['price']."','".$ITEM['dd_price']."','".$ITEM['curslot']."','".$ITEM['clan']."','".$ITEM['bank']."','".$ITEM['arenda']."','".$ITEM['rassrok']."','".$ITEM['death']."','".$ITEM['grav']."','".(0)."','".$ITEM['gift']."','".$ITEM['gift_from']."')";
					}
					if($player['nv']>=($ITEM['sellprice']*$num)){
						if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`id_item` ,  `protype` ,  `pl_id` ,  `mod` ,  `mod_color` ,  `modified` ,  `used` ,  `iznos` ,  `dolg` ,  `price` ,  `dd_price` ,  `curslot` ,  `clan` ,  `bank` ,  `arenda` ,  `rassrok` ,  `death` ,  `grav` ,  `sellprice` ,  `gift` ,  `gift_from`) VALUES ".$insert." ") and mysqli_query($GLOBALS['db_link'],"DELETE FROM `rinok` WHERE ".($num>1?" ( ".$filt." )":" `id_item`='".$ITEM['id_item']."'")." LIMIT ".$num.";")){
							$komiss = (round($ITEM['sellprice']/100)*5);
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".(($ITEM['sellprice']-$komiss)*$num)."' WHERE `id`='".$ITEM['pl_id']."' LIMIT 1;");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".($ITEM['sellprice']*$num)."' WHERE `id`='".$player['id']."' LIMIT 1;");
							$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> � ��� ��������� <b>".$ITEM['name'].($num>1?" ".$num." ��.":"")." �� ����� �� ���� ".(($ITEM['sellprice']-$komiss)*$num)." LR.</b>! �������� � �������: ".$komiss." LR. (5% �� ����)</b></font><BR>'+'');$redirect";
							$login=getnamebyid($ITEM['pl_id']);
							chmsg($ms,$login);
							log_write("buybazar",$ITEM['name']." (��� ����: ".$ITEM['price'].") ���-��: ".$num."��.",($ITEM['sellprice']*$num),getnamebyid($ITEM['pl_id']));
							$msg="<b><font class=proceb>�� ������ ������:<br><font class=proceg> ".$ITEM['name'].($num>1?" ".$num." ��.":"")."</font><br></font></b>";
							$typetolog .= '@24';  
							$abouttolog .= '@ ������� <b>'.$ITEM['name'].'</b> ('.$num.' ��.). �� ����: <b>'.($ITEM['sellprice']*$num).'</b> LR. <b>[�����]</b>';
							player_actions($player['id'],$typetolog,$abouttolog);
						}
						else{$msg="<font class=proce>��������� ������!<br>���������� � �������������.</font>";}
					}
					else{$msg="<font class=proce>������������ �����.</font>";}
				}
			break;
			case 2:
				$ITEM=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.* FROM `rinok` INNER JOIN `items` ON `rinok`.`protype` = `items`.`id` WHERE `rinok`.`id_item`='".intval($_GET['uid'])."' AND `rinok`.`pl_id`='".$player['id']."' LIMIT 1;"));
				if($ITEM['id_item']){
						$komiss = (round($ITEM['sellprice']/100)*5);
						if($player['nv']>=$komiss){
							if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`id_item` ,  `protype` ,  `pl_id` ,  `mod` ,  `mod_color` ,  `modified` ,  `used` ,  `iznos` ,  `dolg` ,  `price` ,  `dd_price` ,  `curslot` ,  `clan` ,  `bank` ,  `arenda` ,  `rassrok` ,  `death` ,  `grav` ,  `sellprice` ,  `gift` ,  `gift_from`) VALUES ('".$ITEM['id_item']."','".$ITEM['protype']."','".$player['id']."','".$ITEM['mod']."','".$ITEM['mod_color']."','".$ITEM['modified']."','".$ITEM['used']."','".$ITEM['iznos']."','".$ITEM['dolg']."','".$ITEM['price']."','".$ITEM['dd_price']."','".$ITEM['curslot']."','".$ITEM['clan']."','".$ITEM['bank']."','".$ITEM['arenda']."','".$ITEM['rassrok']."','".$ITEM['death']."','".$ITEM['grav']."','".(0)."','".$ITEM['gift']."','".$ITEM['gift_from']."')") and mysqli_query($GLOBALS['db_link'],"DELETE FROM `rinok` WHERE `id_item`='".$ITEM['id_item']."' AND `pl_id`='".$player['id']."' LIMIT 1;")){
								mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$komiss."' WHERE `id`='".$player['id']."' LIMIT 1;");
								$msg="<b><font class=proceb>��� �� ����� �������:<br><font class=proceg> ".$ITEM['name']." </font><br>��������: ".$komiss." LR.</font></b><br><font class=proce>(5% �� ����)</font>";
								$typetolog .= '@24'; $abouttolog .= '@'.$msg;
								player_actions($player['id'],$typetolog,$abouttolog);								
							}
							else{$msg="<font class=proce>��������� ������!<br>���������� � �������������.</font>";}
						}else{$msg="<font class=proce>������������ ������� ��� ������ ��������.</font>";}

				}
			break;
			case 3:
				$stopbuy=0;
				$col = intval($_GET['col']);
				$id_item = intval($_GET['uid']);
				//����������
				if($col<1 or $col==''){$col=1;}
				if($id_item<=0){$stopbuy=1;}
				if($stopbuy==0){
					$IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
						FROM market LEFT JOIN items ON market.id = items.id
						WHERE market.kol>='".$col."' AND items.dd_price=0 AND items.id='".$id_item."' AND market.market='".$player['loc']."' LIMIT 1;"
					));
					if($IT['id']){
						$pr=explode("|",$IT[param]);
						foreach ($pr as $value) {
						$stat=explode("@",$value);
						switch($stat[0]){case 2: $dolg=$stat[1];break;}}
						if($player['nv']>=($IT['price']*$col)){
							$insert="";
							for($i=0;$i<$col;$i++){
								$insert.="('".$IT['id']."','".$player['id']."','".$dolg."','".$IT['price']."'),";
							}
							$insert=substr($insert,0,strlen($insert)-1);
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES ".$insert.";");
							mysqli_query($GLOBALS['db_link'],"UPDATE `market` SET `kol`=`kol`-'".$col."' WHERE id='".$IT['id']."' AND market='".$player['loc']."';");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".($IT['price']*$col)."' WHERE `id`='".$player['id']."' LIMIT 1;");
							$msg="<b><font class=proce>�� ������ ������:<br><font class=proceg> ".$IT['name']." </font><br> � ���������� ".$col." ��.</font></b>";
							log_write("buy",$IT['name'].'(����������: '.$col.' ��)',$IT['price']*$col,"market");
							$typetolog .= '@12';  
							$abouttolog .= '@<b>'.$IT['name'].'</b> ('.$col.' ��.). �� ����: <b>'.($IT['price']*$col).'</b> LR.';
							player_actions($player['id'],$typetolog,$abouttolog);
						}
						else{
							$msg="<font class=proce>�������� �����.</font>";
						}
					}
					else{$msg="<font class=proce>������� �� ������ ��� ��������� ���������� ��������� ����������� � ��������.</font>";}
				}

			break;
			case 4:
				if($player['login'] == 'alexs' or $player['login'] == '�������������'){	
					$stopbuy=0;
					$pr = intval($_GET['pr']);
					$id_item = intval($_GET['uid']);
					//����������
					if($col<1 or $col==''){$col=1;}
					if($id_item<=0){$stopbuy=1;}
					if($stopbuy==0){
						$IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
							FROM market LEFT JOIN items ON market.id = items.id
							WHERE items.dd_price>0 AND items.id='".$id_item."' AND market.market='".$player['loc']."' LIMIT 1;"
						));
						if($IT['id']){
							if(mysqli_query($GLOBALS['db_link'],"UPDATE items SET dd_price='".$pr."' WHERE id='".$IT['id']."' LIMIT 1;")){
								$msg="<b><font class=proce>�� �������� ����:<br><font class=proceg> ".$IT['name']." </font><br> �� ".$pr." DLR.</font></b>";
							}
							else{$msg="<font class=proce>������ �� ������.</font>";}
						}
						else{$msg="<font class=proce>������� �� ������";}
					}
					else{$msg="<font class=proce>����������� ������.</font>";}
				}
				else{$msg="<font class=proce>��� �������</font>";}
			break;
			case 5:
				if($player['login'] == 'alexs' or $player['login'] == '�������������'){	
					$stopbuy=0;
					$pr = intval($_GET['pr']);
					$id_item = intval($_GET['uid']);
					//����������
					if($col<1 or $col==''){$col=1;}
					if($id_item<=0){$stopbuy=1;}
					if($stopbuy==0){
						$IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
							FROM market LEFT JOIN items ON market.id = items.id
							WHERE items.dd_price=0 AND items.id='".$id_item."' AND market.market='".$player['loc']."' LIMIT 1;"
						));
						if($IT['id']){
							if(mysqli_query($GLOBALS['db_link'],"UPDATE items SET price='".$pr."' WHERE id='".$IT['id']."' LIMIT 1;")){
								$msg="<b><font class=proce>�� �������� ����:<br><font class=proceg> ".$IT['name']." </font><br> �� ".$pr." LR.</font></b>";
							}
							else{$msg="<font class=proce>������ �� ������.</font>";}
						}
						else{$msg="<font class=proce>������� �� ������";}
					}
					else{$msg="<font class=proce>����������� ������.</font>";}
				}
				else{$msg="<font class=proce>��� �������</font>";}
			break;
		}
	break;
	case 111:
		if($player['login'] == 'alexs' or $player['login'] == '�������������'){mysqli_query($GLOBALS['db_link'],"DELETE FROM `market` WHERE `id`='".intval($_GET['wsuid'])."' AND `market`='".intval($_GET['market'])."' LIMIT 1;");$msg="���� �������.";}
	break;
	case 112:
		$pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".intval($_GET['uid'])."' and `level`>'9' and `nv`>'19'"));
		if($pl){
			if($player['instructor'] == 0){
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'20' WHERE `id`='".$pl['id']."'");
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `instructor`='".$pl['id']."',`nv`=`nv`+'10' WHERE `id`='".$player['id']."'");
				chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>��������� ����������.</b></font> �������� <b>".$player["login"]."</b>[".$player["level"]."/".$player["u_lvl"]."] ������ ��� ������.</font><BR>'+'');",$pl['login']);
				echo"<script>parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>��������� ����������.</b></font> �������� <b>".$pl["login"]."</b>[".$pl["level"]."/".$pl["u_lvl"]."] ������ ��� ���������.</font><BR>'+'');</script>";
			}
		}
	break;
	case 113:
		$fornickname=trim($fornickname);
		$ret=maseused($magicreuid,$fornickname,$player[loc]);
		$msg=$ret[msg];
	break;
	case 114:
		if($player['login'] == 'alexs' or $player['login'] == '�������������'){	
			$str = "SELECT * FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['tologin'])."' LIMIT 1;";
				$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],$str));
					if($check['id']){
						$str="";
						if($check['loc']==28){
							$str = "UPDATE `user` SET `loc`='28',`pos`='".$check['pos']."' WHERE `id`='".$player['id']."'";
						}else{
							$str = "UPDATE `user` SET `loc`='".$check['loc']."',`pos`='8_4' WHERE `id`='".$player['id']."'";
						}
						mysqli_query($GLOBALS['db_link'],$str);
						$msg='<font class=proce><b>�� ������� ��������������� � ��������� <font class=nickname>'.$check['login'].'</font></b></font><script>'.$redirect.'</script><br>';
					}
		}
	break;
	case 115:
	$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.`iznos`,  `items`.`id` FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`='".intval($_GET['uid'])."' AND `items`.`type`!='w0'  AND `items`.`type`!='w29' AND `items`.`type`!='w61'  AND `items`.`type`!='w66'  AND `items`.`type`!='w67' AND `items`.`type`!='w68' AND `items`.`type`!='w69' "));
		if($player['nv']>=$itm['iznos']){
			mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `iznos`='0', `dolg`=`dolg`-1 WHERE `id_item`='".intval($_GET['uid'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `user`.`nv`=`user`.`nv`-'".$itm['iznos']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
		}
	break;
    case 116: 
		$id=intval($id);
		$uid=intval($uid);	
		$login=chars($login);
		$col=intval($col);		
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buysneg.php");
	break;
	case 117: 
		$id=intval($id);
		$uid=intval($uid);	
		$login=chars($login);
		$col=intval($col);		
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buyrep.php");
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buyrep1.php");
	break;
		case 1223: 
		$id=intval($id);
		$uid=intval($uid);	
		$login=chars($login);
		$col=intval($col);		
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buykom.php");
		//include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/buykom1.php");
	break;
	case 118:
		if($player['login'] == 'alexs' or $player['login'] == '�������������'){
			$getEvent = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `events_battle` WHERE `event_name` = 'heavenlydragon'"));
			if($getEvent['fight'] > 0){
				mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='".$getEvent['fight']."',`side`='1',`fight`='2' WHERE `login`='".$player['login']."' LIMIT 1;");			
				mysqli_query($GLOBALS['db_link'], "UPDATE `arena` SET `kol1`=`kol1`+'1' WHERE `id_battle`='".$getEvent['fight']."' LIMIT 1;");
				sumbat($pl['battle'], "$redirect", 0);
				$logpl = '[1,1,"' . $player['login'] . '",' . $player['level'] . ',' . $player['sklon'] . ',"' . $player['clan_gif'] . '"]';
				$income = ',[[0,"' . date("H:i") . '"],' . $logpl . '," <b> ������' . (($player['sex'] == 'male') ? '��' : '���' ) . ' � ���.</b>"]';
				savelog($income, $getEvent['fight']);
			}else{
				mysqli_query($GLOBALS['db_link'], "UPDATE `events_battle` SET `fight`='" . TraneAttack($player, array(276), true) . "' WHERE `event_name` = 'heavenlydragon'");
			}
		}
	break;
		case 119: 
		$kate = array('1','2','3','4','5');
		$kate1 = array('sila','lovk','uda4a','zdorov','znan');
		$kate2 = array('����','��������','�����','��������','������');
		for ($i=0;$i<=10;$i++)
		switch($_REQUEST['act']){
		case $kate[$i]:// ����
		$bonus=rand(1,5);
		mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' and `id_item`='".intval($_GET['uid'])."' LIMIT 1;");
    mysqli_query($GLOBALS['db_link'],"update `user` set `$kate1[$i]`=`$kate1[$i]`+'".$bonus."' WHERE `id`='".$player['id']."' LIMIT 1;");
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;�������� $kate2[$i].&nbsp;</font> ".$player['login']." ������� $kate2[$i] +".$bonus."<BR>'+'');")."');");
	  break;
		}
			break;
		case 15987:// �������
		switch($_REQUEST['act']){
			case 1:// ����������
				$GetSunduk = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`id_item`='".intval($_GET['uid'])."' AND `items`.`chests`='1';"));
				if($GetSunduk['sunduk_open'] == 0){
					if($player['vzlomshik_nav'] >= $plstt[74]){
							$usea1 = array('100','250','500','780','1080','2080','3780','4780','5780','15780');
							$usea2 = array('2','3','4','5','6','7','8','9','10','11');
		          for ($i=0;$i<=10;$i++)
						switch($player['vzlomshik_exp']){
							case $usea1[$i]:
								mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `vzlomshik_nav`='$usea2[$i]' WHERE `id`='".$player['id']."'");
								echo"<script>parent.jAlert('������� ����� ������� ���������.');</script>";
							break;
						}
						mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `sunduk_open`='1' WHERE `id_item`='".$GetSunduk['id_item']."'");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `vzlomshik_exp`=`vzlomshik_exp`+'1' WHERE `id`='".$player['id']."'");
						echo"<script>parent.jAlert('������ ������� �������.');</script>";
					}
				}
			break;
			case 2:// ���������
				$GetSunduk = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`id_item`='".intval($_GET['uid'])."' AND `items`.`chests`='1';"));
				if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' and `id_item`='".$GetSunduk['id_item']."' LIMIT 1;")){
					$items = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `chests` WHERE `cid`='".intval($GetSunduk['protype'])."'"));
					if(!empty($items['items'])){
						$item = explode("|",$items['items']);
//						echo (count($item)-1)." << ".$items['items'];
//						echo $item[(count($item)-2)];
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".$items['lr']."' WHERE `id`='".$player['id']."'");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `reput`=`reput`+'".$items['reput']."' WHERE `id`='".$player['id']."'");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `RepsPodvod`=`RepsPodvod`+'".$items['RepsPodvod']."' WHERE `id`='".$player['id']."'");
						$itemsql=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$item[rand(0,count($item)-2)]."' LIMIT 1;"));
						$par = explode("|",$itemsql['param']);
						foreach ($par as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}
						}
						if($itemsql['dd_price'] > 0){
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg_system('<font class=massm>&nbsp;Legend Battles&nbsp;</font> <font color=red>������ ���� �� ���������, <b>".$player['login']."</b> ��������� &quot;".$itemsql['name'].".</font><BR>'+'');")."');");
						}
						if(mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price`) VALUES ('".$itemsql['id']."','".$player['id']."','".$dolg."','".$itemsql['price']."');")){
							echo"<script>top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#000000>������ �������... �� ������� .".$GetSunduk['name']."</b></font><BR>'+'');</script>";
							if($items['lr']>0) {echo"<script>top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� ���������� ������: <b>".lr($items['lr'])."</b>.</font>'+'');</script>";}
							if($items['reput']>0) {echo"<script>top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� �������� ��������� <b>".$items['reput']."</b>.</font><BR>'+'');</script>";}
							if($items['RepsPodvod']>0) {echo"<script>top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� �������� ���������1 <b>".$items['RepsPodvod']."</b>.</font><BR>'+'');</script>";}
							echo"<script>top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#000000>�� ��� �� ����������: <font color=#CC0000> <b>".$itemsql['name']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$itemsql['name']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://d0009394.atservers.net/iteminfo.php?".$itemsql['name']."\');\" ></b>.</font><BR>'+'');</script>";
						}
					}
				}
			break;
			case 3:// ���������
				$GetSunduk = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`id_item`='".intval($_GET['uid'])."' AND `items`.`chests`='2';"));
				if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$player['id']."' and `id_item`='".$GetSunduk['id_item']."' LIMIT 1;")){
					$items = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `chests2` WHERE `cid`='".intval($GetSunduk['protype'])."'"));
					if(!empty($items['items'])){
						$item = explode("|",$items['items']);
//						echo (count($item)-1)." << ".$items['items'];
//						echo $item[(count($item)-2)];
            mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".$items['lr']."' WHERE `id`='".$player['id']."'");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `reput`=`reput`+'".$items['reput']."' WHERE `id`='".$player['id']."'");
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `RepsPodvod`=`RepsPodvod`+'".$items['RepsPodvod']."' WHERE `id`='".$player['id']."'");
						$itemsql=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$item[rand(0,count($item)-2)]."' LIMIT 1;"));
						$par = explode("|",$itemsql['param']);
						foreach ($par as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){case 2: $dolg=$stat[1];break;}
						}
						if($itemsql['dd_price'] > 0){
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Legend Battles&nbsp;</font> <font color=red>������ ���� �� ���������, <b>".$player['login']."</b> ��������� &quot;".$itemsql['name'].".</font><BR>'+'');")."');");
						}
						if(mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price`) VALUES ('".$itemsql['id']."','".$player['id']."','".$dolg."','".$itemsql['price']."');")){
							echo"<script>top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#000000>������ �������... �� ������� .".$GetSunduk['name']."</b></font><BR>'+'');</script>";
							if($items['lr']>0) {echo"<script>top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� ���������� ������: ������ <b>".lr($items['lr'])."</b>.</font>'+'');</script>";}
							if($items['reput']>0) {echo"<script>top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� �������� ��������� <b>".$items['reput']."</b>.</font><BR>'+'');</script>";}
							if($items['RepsPodvod']>0) {echo"<script>top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b>�� �������� ���������1 <b>".$items['RepsPodvod']."</b>.</font><BR>'+'');</script>";}
							echo"<script>top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#000000>�� ��� �� ����������: <font color=#CC0000> <b>".$itemsql['name']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$itemsql['name']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://leg/iteminfo.php?".$itemsql['name']."\');\" ></b>.</font><BR>'+'');</script>";
						}
					}
				}
			break;
		}
	break;
	default: echo "<script type='text/javascript'> parent.location.href = 'http://leg/'; </script>";break;
}
?>
