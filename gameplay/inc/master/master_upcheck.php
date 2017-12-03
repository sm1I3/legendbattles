<?
	switch(intval($_GET["up"])){
        case 1: //увеличение модификатора
		$mod='';	
		$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`='".intval($_GET['v'])."';"));
		$mods=explode("|",$itm['mod']);
		foreach ($mods as $value){
			$modstat=explode("@",$value);
			$modpar[$modstat[0]]=$modstat[1];
		}
		$nparam=explode("|",$itm['param']);   
		foreach ($nparam as $value) {
			$nstat=explode("@",$value);
			$npar[$nstat[0]]=$nstat[1];		
		}
		$stt=Array(1=>5,6,7,8);
            $sttn = Array(1 => 'Уловка', 'Точность', 'Сокрушение', 'Стойкость');
		$i=0;
		while($i == 0){
			$rand=rand(1,4);	
			if($npar[$stt[$rand]]!=''){
				$pr=$npar[$stt[$rand]]*(rand(1,5)/10);
				$ms=$sttn[$rand]." <b>+".$pr."%</b>";
				for($b=0;$b<=71;$b++){
					$mod.= ($modpar[$b]!='' ? ($b==$stt[$rand] ? $b."@".($modpar[$b]+$pr)."|" : $b."@".$modpar[$b]."|") : ($b==$stt[$rand] ? $b."@".$pr."|" : ""));
					$i++;
				}
			}
		}
		$mod=substr_replace($mod, '', -1);
		 if($player['nv']>=450){
			 if($itm['type']=='w25' or $itm['type']=='w22'){
				if(rand(0,100)<=($pl_st[61]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '<br></font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1',invent.mod_color='".$up."' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
				}
				else{
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!</font>");</script>');
				}
				mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-450 WHERE user.id='".$player['id']."' LIMIT 1;");
			}
			else if($itm['type']=='w1' or $itm['type']=='w2' or $itm['type']=='w3' or $itm['type']=='w4' or $itm['type']=='w5' or $itm['type']=='w6' or $itm['type']=='w7'){
				if(rand(0,100)<=($pl_st[63]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '</font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1',invent.mod_color='".$up."' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
				}
				else{
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!<br></font>");</script>');
				}
				mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-450 WHERE user.id='".$player['id']."' LIMIT 1;");
			}
		} else {
             echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
         }
	break;
        case 2: //увеличение брони
		$mod='';
		$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`='".intval($_GET['v'])."';"));
		if($itm['modified']==0){
			$mods=explode("|",$itm['mod']);
			foreach ($mods as $value){
				$modstat=explode("@",$value);
				$modpar[$modstat[0]]=$modstat[1];
			}
			$nparam=explode("|",$itm['param']);   
			foreach ($nparam as $value) {
				$nstat=explode("@",$value);
				$npar[$nstat[0]]=$nstat[1];		
			}
				if($npar[9]!=''){
					$pr=round($npar[9]*(rand(2,5)/10))+1;
                    $ms = "Броня <b>+" . $pr . "</b>";
					for($b=0;$b<=71;$b++){
						$mod.= ($modpar[$b]!='' ? ($b==9 ? $b."@".($modpar[$b]+$pr)."|" : $b."@".$modpar[$b]."|") : ($b==9 ? $b."@".$pr."|" : ""));
						$i++;
					}
				}
			$mod=substr_replace($mod, '', -1);

			 if($player['nv']>=625){
			 if($itm['type']=='w25' or $itm['type']=='w22'){
				if(rand(0,100)<=($pl_st[61]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '<br></font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-625 WHERE user.id='".$player['id']."' LIMIT 1;");
				}
				else{
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-625 WHERE user.id='".$player['id']."' LIMIT 1;");
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!</font>");</script>');
				}
			}
			else if($itm['type']=='w1' or $itm['type']=='w2' or $itm['type']=='w3' or $itm['type']=='w4' or $itm['type']=='w5' or $itm['type']=='w6' or $itm['type']=='w7'){
				if(rand(0,100)<=($pl_st[63]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '</font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-625 WHERE user.id='".$player['id']."' LIMIT 1;");
				}
				else{
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-625 WHERE user.id='".$player['id']."' LIMIT 1;");
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!</font>");</script>');
				}
			}
             } else {
                 echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
             }
		}
	break;
        case 4: //увеличение урона
		$mod='';
		$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`='".intval($_GET['v'])."';"));
		if($itm['modified']==0){
			$mods=explode("|",$itm['mod']);
			foreach ($mods as $value){
				$modstat=explode("@",$value);
				$modpar[$modstat[0]]=$modstat[1];
			}
			$nparam=explode("|",$itm['param']);   
			foreach ($nparam as $value) {
				$nstat=explode("@",$value);
				$npar[$nstat[0]]=$nstat[1];		
			}
				if($npar[1]!=''){
					$dmg=explode("-",$npar[1]);
					$pr[0]=round($dmg[0]*(rand(1,2)/10))+1;
					$pr[1]=round($dmg[1]*(rand(1,2)/10))+1;
                    $ms = "Урон увеличен на <b>" . $pr[0] . "-" . $pr[1] . "</b>";
					if($modpar[1]!=''){
						$moddmg=explode("-",$modpar[1]);
					}
					else{
						$moddmg[0]=0;
						$moddmg[1]=0;					
					}				
					for($b=0;$b<=71;$b++){
						$mod.= ($modpar[$b]!='' ? ($b==1 ? $b."@".($moddmg[0]+$pr[0])."-".($moddmg[1]+$pr[1])."||" : $b."@".$modpar[$b]."||") : ($b==1 ? $b."@".$pr[0]."-".$pr[1]."||" : ""));
						$i++;
					}
				}
			$mod=substr_replace($mod, '', -1);

			 if($player['nv']>=1000){
			 if($itm['type']=='w25' or $itm['type']=='w22'){
				if(rand(0,100)<=($pl_st[61]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '<br></font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-1000 WHERE user.id='".$player['id']."' LIMIT 1;");
				}
				else{
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-1000 WHERE user.id='".$player['id']."' LIMIT 1;");
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!</font>");</script>');
				}
			}
			else if($itm['type']=='w1' or $itm['type']=='w2' or $itm['type']=='w3' or $itm['type']=='w4' or $itm['type']=='w5' or $itm['type']=='w6' or $itm['type']=='w7'){
				if(rand(0,100)<=($pl_st[63]/200*100)){
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>успешна!<br>' . $ms . '</font>");</script>');
					mysqli_query($GLOBALS['db_link'],"UPDATE invent SET invent.mod='".$mod."',invent.modified='1' WHERE id_item='".intval($_GET['v'])."' AND pl_id='".$player['id']."' LIMIT 1;");
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-1000 WHERE user.id='".$player['id']."' LIMIT 1;");
				}
				else{
					mysqli_query($GLOBALS['db_link'],"UPDATE user SET user.nv=user.nv-1000 WHERE user.id='".$player['id']."' LIMIT 1;");
                    echo('<script language="JavaScript">message("Модификация предмета<br><font color=bb0000>провалилась!</font>");</script>');
				}
			}
             } else {
                 echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
             }
		}
	break;
        case 5: //случайный мод
	   $sk='kgTvx2WrEZ';
	   $itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `items`.`color`='0' AND `items`.`dd_price`='0' AND `items`.`up`='0' AND `invent`.`id_item`=".intval($_GET['v'])." ".$filt.";"));
	   $nparam=explode("|",$itm['param']);
	   if(bots_array($player,1)==12){$player['sign']=$sk;}
	   foreach ($nparam as $value) {
			$nstat=explode("@",$value);
			$npar[$nstat[0]]=$nstat[1];		
		}
		$mod='';
            //рассчет качества "апа", 700 - зеленый, 24 - синий, 1 - фиолет
		$upsup=rand(0,1000);
		$upsup<=700 ? $up=1 : ($upsup<=995 ? $up=2 : $up=3);
		if($svitok['id_item'] and $svitok['id_item']==intval($_GET['sv'])){
			$epicup=1;
		}else{$epicup=0;}
		if($up==3 and $epicup==1){
			it_break($svitok['id_item']);
		}
		if($player['login']=='z7' or $itm['dd_price']>0 or $epicup==1 or $player['sign']==$sk){$up=3;$epicup=1;}
		if($itm['dd_price']>0){$epicup=1;$up=3;}
            //if($player['login']=='администрация'){$up=3;}
		if($up==1){
			$randstat=rand(30,34);
			$i=30;
			while($i <= $randstat){
				$i!=33 ? ($npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]),round($npar[$i]+$npar[$i]))-$npar[$i] : $npar[$i]='') : $npar[$i]=rand(-2,2);
				$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				$i++;
			}
			$randmodif=rand(5,10);
			$i=5;
			while($i <= $randmodif){
				$npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]),round($npar[$i]+$npar[$i]/2))-$npar[$i] : $npar[$i]='';
				$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				$i++;
			}
		}
		if($up==2){
			$randstat=rand(30,34);
			$i=30;
			while($i <= $randstat){
				$i!=33 ? ($npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]/2),round($npar[$i]+$npar[$i]*2))-$npar[$i] : $npar[$i]='') : $npar[$i]=rand(-2,3);
				$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				$i++;
			}
			$randmodif=rand(5,10);
			$i=5;
			while($i <= $randmodif){
				$npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]/2),round($npar[$i]+$npar[$i]))-$npar[$i] : $npar[$i]='';
				$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				$i++;
			}
		}
		if($up==3){
			$randstat=34;
			$i=30;
			while($i <= $randstat){
				if($epicup!=1){
					$i!=33 ? ($npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]/2),round($npar[$i]*2.5))-$npar[$i] : $npar[$i]='') : $npar[$i]=rand(-2,4);
					$i!=33 ? $mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "") : '';
				}else{
					$i!=33 ? ($npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]*1.1),round($npar[$i]*2.5))-$npar[$i] : $npar[$i]='') : $npar[$i]=rand(-2,4);
					$i!=33 ? $mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "") : '';	
				}
				$i++;
			}
			$randmodif=10;
			$i=5;
			while($i <= $randmodif){
				if($epicup!=1){
					$npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]-$npar[$i]/2),round($npar[$i]*2.5))-$npar[$i] : $npar[$i]='';
					$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				}else{
					$npar[$i]!='' ? $npar[$i]=rand(round($npar[$i]*1.1),round($npar[$i]*2.5))-$npar[$i] : $npar[$i]='';
					$mod.= ($npar[$i]!='' ? $i."@".$npar[$i]."|" : "");
				}
				$i++;
			}
		}
			$mod=substr_replace($mod, '', -1);
			if($player['nv']>=$itm['price'] and !$itm['dd_price']){
                echo('<script language="JavaScript">message("' . ($up == 1 ? "Улучшенная" : ($up == 2 ? "Редкая" : "Эпическая")) . ' модификация <br><font color=bb0000>успешна</font>!");</script>');
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `invent`.`mod`='".$mod."',`invent`.`modified`='0',`invent`.`mod_color`='".$up."' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `user`.`nv`=`user`.`nv`-'".$itm['price']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
			}
			elseif($player['dd']>=$itm['dd_price'] and $itm['dd_price']>0){
                echo('<script language="JavaScript">message("' . ($up == 1 ? "Улучшенная" : ($up == 2 ? "Редкая" : "Эпическая")) . ' модификация <br><font color=bb0000>успешна</font>!");</script>');
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `invent`.`mod`='".$mod."',`invent`.`modified`='0',`invent`.`mod_color`='".$up."' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `user`.`dd`=`user`.`dd`-'".$itm['dd_price']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
			} else {
                echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
            }

	break;
        case 6: //ремонт
		$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`='".intval($_GET['v'])."' $filt;"));
		if($player['nv']>=$itm['iznos']){
            echo('<script language="JavaScript">message("Починка предмета<br><font color=bb0000>успешна</font>!");</script>');
			mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `iznos`='0' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `user`.`nv`=`user`.`nv`-'".$itm['iznos']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
		} else {
            echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
        }
	break;
        case 666: //сброс модов
		$itm=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `items`.`color`='0' AND `items`.`up`='0' AND `invent`.`dd_price`='0' AND `invent`.`id_item`=".intval($_GET['v'])." ".$filt.";"));
		
		if($player['nv']>=100){
			mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `invent`.`mod`='',`invent`.`modified`='0',`invent`.`mod_color`='0' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET `user`.`nv`=`user`.`nv`-'100' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
            echo('<script language="JavaScript">message("Все модификации<br><font color=bb0000>сброшены</font>!");</script>');
        } else {
            echo('<script language="JavaScript">message("<font color=bb0000>Недостаточно средств</font>!");</script>');
        }
	break;
}
?>