<?php
$userprem=explode("|",$player['premium']);
$prsql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `premium_info` WHERE `id`='".$userprem[0]."';"));
$otherbonus = explode("|",$player['otherbonus']);
$massbonus='';
foreach($otherbonus as $val){
	$row = explode("@",$val);
	if($row[0]=='massbonus'){
		if($row[1]>1){
			$massbonus=$row[1];
		}
		else{
			$massbonus=0;
		}
	}
}
$mass=($plstt[30]*4)+($plstt[33]*8)+$plstt[72]+$prsql['mass']+$massbonus;
switch (intval($_GET['act'])){
	case 1:
	$lic=tradelic($player[licens],1);
	$val_id=varcheck($_GET['id']);
	$ITEM=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype` = `items`.`id` WHERE `invent`.`id_item`='".$val_id."' LIMIT 1;"));
	$frmass=$mass-$plstt[71];
	?>
<HEAD><LINK href="/css/game.css" rel=STYLESHEET type=text/css><meta content="text/html; charset=windows-1251" http-equiv=Content-type><META Http-Equiv=Cache-Control Content=no-cache><meta http-equiv=PRAGMA content=NO-CACHE><META Http-Equiv=Expires Content=0></HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699>
<div style="width:100%;height:11px;background:url('/imgs/linebg.gif') 0px 0px;"></div>
<table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e2e2e2><font class=nickname><b>Покупка вещей</b></font></td><td bgcolor=#e2e2e2 align="right"><input type=button class=lbut onclick="parent.$.modal.close();location='main.php?post_id=1&act=2&login=<?=$login?>&vcode=<?=scode()?>'" value="Отказаться"></td><td bgcolor=#e2e2e2><div align=right><script language="JavaScript">
<!-- 
document.write("<a href='javascript:parent.exit_redir();'>");
// -->
</script>
<noscript><a href=exit.php target=_top></noscript><img src=/img/image/exit.png align=absmiddle width=15 height=15 border=0></a></div></td></tr></table>
<div style="width:100%;height:11px;background:url('/imgs/linebg.gif') 0px 11px;"></div>
<table width=90% cellpadding=10 cellspacing=0 align=center>
		   <tr><td><table width=100% cellpadding=0 cellspacing=3 align=center><tr><td width=100% bgcolor=#ffffff valign=top><table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b> <font color=#cc0000>Купить вещь у <?=$login?> за <?=$forprice?> Золото?</font><br><br>
		   <?php if($frmass>=$ITEM[massa] and $player[nv]>=$forprice){
				echo "<input type=button class=invbut onclick=\"parent.$.modal.close();location='main.php?post_id=1&act=1&price=".$forprice."&uid=".$_GET['uid']."&id=".$ITEM['id_item']."&login=".$_GET['login']."&vcode=".scode()."'\" value=\"купить\">&nbsp;";
			}
	break;
	case 2:
		$lic=tradelic($player[licens],1);
		$val_id=varcheck($_GET['id']);
		$val_uid=varcheck($_GET['uid']);
		$ITEM = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype` = `items`.`id` WHERE `invent`.`protype`='".$val_id."' AND `pl_id`='".$val_uid."' AND `invent`.`used`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0';");
		$col=mysqli_num_rows($ITEM);
		$ITEM=mysqli_fetch_assoc($ITEM);
		$frmass=$mass-$plstt[71];
		$forprice=$_GET['forprice']*$col;
		?>
		
		   <HEAD><LINK href=../css/game.css rel=STYLESHEET type=text/css><meta content="text/html; charset=windows-1251" http-equiv=Content-type><META Http-Equiv=Cache-Control Content=no-cache><meta http-equiv=PRAGMA content=NO-CACHE><META Http-Equiv=Expires Content=0></HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699><table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FCFAF3><font class=nickname><b>Покупка вещей</b></font></td><td bgcolor=#FCFAF3><div align=center><input type=button class=lbut onclick="location='main.php?post_id=1&act=2&login=<?=$login?>&vcode=<?=scode()?>'" value="Отказаться от покупки"></div></td><td bgcolor=#FCFAF3><div align=right>
		   <script language="JavaScript">
		   <!--
		   document.write("<a href='javascript:parent.exit_redir();'>");
		   // -->
		   </script>
		   <noscript><a href=exit.php target=_top></noscript><img src=/img/image/exit.gif align=absmiddle width=15 height=15 border=0></a></div></td></tr></table><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#Ffffff><img src=/img/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#F3ECD7><img src=/img/image/1x1.gif width=1 height=2></td></tr></table><table width=90% cellpadding=10 cellspacing=0 align=center>
		   <tr><td><table width=100% cellpadding=0 cellspacing=3 align=center><tr><td width=100% bgcolor=#ffffff valign=top><table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b> <font color=#cc0000>Купить вещь у <?=$_GET['login']?> за <?=$forprice?> LR?</font><br><br>
		   <? if($frmass>=$ITEM[massa] and $player[nv]>=$forprice){
				echo "<input type=button class=invbut onclick=\"location='main.php?post_id=1&act=3&price=".$forprice."&uid=".$_GET['uid']."&id=".$ITEM['protype']."&login=".$_GET['login']."&vcode=".scode()."'\" value=\"купить все\">&nbsp;";
			}
	break;
}
		?>  <?
							if($ITEM[mod_color]==0)
							  {
							?>
								<font class=nickname><b><?=($col?$col." х ":'').$ITEM[name].($ITEM[modified]==1 ? " [ап]" : "")?></b><br>
							<?}
							  else
							  {
  								 if($ITEM[mod_color]==1)
								 {?>
								    <font class=nickname><b><font color=#006600><?=($col?$col." х ":'').$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?></font></b><br>
								 <?}
								 if($ITEM[mod_color]==2)
								 {?>
								    <font class=nickname color=#4ABB58><b><font color=#3333CC><?=($col?$col." х ":'').$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?></font></b><br>
								 <?}
	                             if($ITEM[mod_color]==3)
								 {?>
								    <font class=nickname color=#AF51B5><b><font color=#993399><?=($col?$col." х ":'').$ITEM[name]."</font> [мод]".($ITEM[modified]==1 ? " [ап]" : "")?></font></b><br>
								 <?}
	    					  }
							?></b> <? if($frmass<$ITEM[massa]){echo "<b><font class=nickname><font color=#cc0000> Нет места в инвентаре</font></font></b>";}?>
	   
	   </td><td><br><img src=/img/image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%>
   <?    
$bt=0;$tr_b='';$par_i='';$pararr ='';$m=0;
$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
$tr_b = $pararr[1][0]; $iz = $pararr[2];//требования
$bt = $pararr[1][1]; //доступность кнопок
$par_i = $pararr[0]; //параметры
?>
       
       <table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>свойства</font></div></td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=16></td><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>требования</font></div></td></tr><tr><td bgcolor=#FCFAF3><img src=/img/image/1x1.gif width=5 height=1></td><td bgcolor=#FCFAF3 width=50%>
<? if($ITEM[slot]==16) echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
blocks($ITEM[block]);?>
<font class=weaponch>Цена: <b><?=$ITEM[price]?> Меди</b><br><?
echo $par_i;
?></font></td><td bgcolor=#FCFAF3><img src=/img/image/1x1.gif width=5 height=1></td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><img src=/img/image/1x1.gif width=5 height=1></td><td bgcolor=#FCFAF3 width=50%>
<? if($ITEM[gift]!="" and $ITEM[gift]!="0" and $ITEM[gift]!="1"){echo "<img src=/img/image/gift/gift1.gif width=15 height=15 border=0 align=absmiddle title='$ITEM[gift]'> <font class=weaponch><b>$ITEM[gift]</b><br></font>"; }?>

<font class=weaponch>
<?
$tr_b.=$ITEM['arenda']>0?'<br><font class=weaponch><b><font color=#cc0000>Вещь арендована до '.date("d.m.y (H:i:s)",$ITEM['arenda']).'</font>'
:
($ITEM['rassrok']>0?
'<br><font class=weaponch><b><font color=#cc0000>Вещь приобретена в рассрочку.
<br>Долг по оплате: '.($ITEM['dd_price']-$dd['dd_price']).'$
<br>Оплата до '.date("d.m.y (H:i:s)",$ITEM['rassrok']).'</font>'
:
'');
$tr_b.=(($ITEM['death']!=0)?'<br><font class=weaponch><b><font color=#cc0000>Вещь испортится: '.date("d.m.y",$ITEM['death']).'</font>':'');
echo $tr_b;
?>
</font></td><td bgcolor=#FCFAF3><img src=/img/image/1x1.gif width=5 height=1></td></tr></table>


<?php
function blocks($bl){
    if($bl!="") {
        switch($bl){
            case 40: echo "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>"; break;
            case 70: echo "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>"; break;
            case 90: echo "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>"; break;
        }
    }
}