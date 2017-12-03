<?php
	$npar='';
	$nparam=explode("|",$ITEM['param']);   
	foreach ($nparam as $value) {
		$nstat=explode("@",$value);
		$npar[$nstat[0]]=$nstat[1];		
	}
	$code=scode();
	//вывод статов вещи
	echo'	
	<TR><TD>
		<table cellpadding=0 cellspacing=0 border=0 width=100%  bgcolor=#cccccc>
		<tr><td >
		<table cellpadding=5 cellspacing=1 border=0 width=100% #FCFAF3>';
				
		//$dd = mysql_fetch_assoc(mysql_query("SELECT `invent`.`dd_price` FROM `invent` WHERE `id_item`='".$ITEM['id_item']."' LIMIT 1;"));
		 //торговая лицензия персонажа
			 if($player[level]<5){$licen=1;}
			 else{$licen=tradelic($player['licens'],1);}
		 //
		$par=explode("|",$ITEM['param']);
		$mod=explode("|",$ITEM['mod']);
		$need=explode("|",$ITEM['need']);
		$vcod=scode();
		$iz=$ITEM[dolg]-$ITEM[iznos];
		$izn = round(($iz/($ITEM[dolg]/100))*0.62);
		$pro = 62-$izn;
			if($ITEM[dd_price]>0){
				$licen=0.8;
				$price_dd=round($ITEM[dd_price]*$licen*$iz/$ITEM[dolg]);
			}
			else if($ITEM[gift]==1){
				$licen=0.4;
				$price=round($ITEM[price]*$licen*$iz/$ITEM[dolg]);
				if($price<1){$price=1;}
			}
			else{
				$price=round($ITEM[price]*$licen*$iz/$ITEM[dolg]);
				if($price<1){$price=1;}
			}	
		$bt=0;
		$tr_b='';
		foreach ($need as $value) {
			$treb=explode("@",$value);
			include($_SERVER["DOCUMENT_ROOT"].'/gameplay/inc/sp_treb.php');
		}


		?>
		<tr><td bgcolor=#F5F5F5 width=1%>
		<div align=center><img src=http://img.legendbattles.ru/image/weapon/<?=$ITEM[gif]?> border=0><br><img src=http://img.legendbattles.ru/image/1x1.gif width=62 height=1><br><img <? echo ($iz <= $ITEM[dolg]/4 ? "src=http://img.legendbattles.ru/image/solidst.gif" : ($iz <= $ITEM[dolg]/2 ? "src=http://img.legendbattles.ru/image/solidst.gif" : "src=http://img.legendbattles.ru/image/solidst.gif" )) ?> width="<?=($izn+1)?>" height=3 border=0 title="Долговечность: <?="$iz/$ITEM[dolg]"?>"><img src=http://img.legendbattles.ru/image/nosolidst.gif width="<?=$pro?>" height=3 border=0 title="Долговечность: <?="$iz/$ITEM[dolg]"?>"></div></td><td width=100% bgcolor=#FFFFFF valign=top>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			 <tr><td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr>
						<? if($opt[0]==0){?>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>Параметры и свойства</font></div></td>
							<td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=16></td>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#cc0000>Требования</font></div></td>
					</tr>
					<tr><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
					<?
									if($ITEM[mod_color]==0)
									  {
									?>
										<td bgcolor=#FCFAF3 width=50%><font class=nickname><b><?=$ITEM[name].($ITEM[modified]==1 ? " [ап]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' шт.</b>)</font>':''); ?></b><br>
									<?}
									  else
									  {
										 if($ITEM[mod_color]==1)
										 {?>
											<td bgcolor=#FCFAF3 width=50%><font class=nickname><b><font color=#006600><?=$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' шт.</b>)</font>':''); ?></font></b><br>
										 <?}
										 if($ITEM[mod_color]==2)
										 {?>
											<td bgcolor=#FCFAF3 width=50%><font class=nickname color=#4ABB58><b><font color=#3333CC><?=$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' шт.</b>)</font>':''); ?></font></b><br>
										 <?}
										 if($ITEM[mod_color]==3)
										 {?>
											<td bgcolor=#FCFAF3 width=50%><font class=nickname color=#AF51B5><b><font color=#993399><?=$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' шт.</b>)</font>':''); ?></font></b><br>
										 <?}
									  }
									?>
		<? if($ITEM[slot]==16) echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
		blocks($ITEM[block]);?>

		<? if($ITEM[dd_price]>0) { ?> <font class=weaponch>Цена: <b><?=$ITEM[dd_price]?> $</b><br> <? } else { ?>
		<font class=weaponch>Цена: <b><?=lr($ITEM['price'])?></b><br> <? } ?>

		<?
		$modstat='';
		foreach ($mod as $value){
			$modstats=explode("@",$value);
			$modstat[$modstats[0]]=$modstats[1];
		}
		foreach ($par as $value){
			$stat=explode("@",$value);
			include($_SERVER["DOCUMENT_ROOT"].'/gameplay/inc/sp_stat.php');
		}
		$dmod=explode("@",$ITEM['damage_mod']);
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/sp_dmods.php");
		?></font></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
		<td bgcolor=#FCFAF3 width=50%>
		<? if($ITEM[gift]==1 and empty($ITEM[gift_from])){echo '<font class=weaponch><img src="http://img.legendbattles.ru/image/gift/gift1.gif"/>&nbsp;Подарок!</font><br><br>'; }
		 else {if($ITEM[gift]==1 and $ITEM[gift_from]!=''){echo '<font class=weaponch><img src="http://img.legendbattles.ru/image/gift/gift1.gif"/>&nbsp;Подарок от <b>'.$ITEM[gift_from].'</b>!</font><br><br>'; }}
		 ?>

		
		</font></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><? }else{ ?><font class=nickname><b><?=$ITEM[name]?></b><? echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' шт.</b>)</font>':''); }?></font></tr></table></td></tr></table></td></tr>
		<? 
		//вывод статов вещи закончен		
?>
