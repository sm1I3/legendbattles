<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

require($_SERVER["DOCUMENT_ROOT"] . "/system/config.php");
if($_GET['mone']){
	for($x=0;$x<=19;$x++){
		for($y=0;$y<=11;$y++){
			$result = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$x."' and `y`='".$y."'"));
			echo'"'.$x.':'.$y.'":'.(($result) ? 1 : 0).','."\n";
		}
	}
	exit;
}

else{
	echo'<HTML><HEAD>
	<TITLE>legendbat™ | Карта - Жизнь в мире сильнейших...</TITLE>
	<LINK href="/css/mapinfo.css" rel="STYLESHEET" type="text/css">
	<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
	<SCRIPT LANGUAGE="JavaScript" SRC="./js/game.js"></SCRIPT>
	<SCRIPT  LANGUAGE="JavaScript" src="./js/ft_v01.js"></SCRIPT>
	<SCRIPT  LANGUAGE="JavaScript" src="./js/png.js"></SCRIPT>
	<META Http-Equiv=CONTENT-TYPE Content="text/html; charset=utf-8">
	<META Http-Equiv=PRAGMA Content="NO-CACHE">
	<META Http-Equiv=CACHE-CONTROL Content="NO-CACHE, NO-STORE">
	<META Http-Equiv=EXPIRES Content="0">
	</HEAD>
	<body>';
	$allmap = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature`;");
	while($r = mysqli_fetch_assoc($allmap)){
		$naturexy[] = $r['x'].'@'.$r['y'];
	}
	echo'
			<table border=0 cellpadding="1" cellspacing="0" align="center" width=100 height=20>
			<tr align=center><td align=right width=49%><a href="?map=1&info=1" style="color:black;"><b>Боты<b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=2" style="color:green;"><b>Травы</b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=3" style="color:brown;"><b>Леса</b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=4" style="color:blue;"><b>Рыба</b></a></td></tr>
			</table>
			<table border=1 cellpadding="0" cellspacing="0" align="center" width=2250 height=900>
			<tr>
			';
			$fx=1;
			$fy=1;
			while($fx<=22 and $fy<=20){
				$kvnumber="".$fx."-".$fy."";
				if(in_array(($fx.'@'.$fy),$naturexy)){echo'<td background="/img//image/wmap/map/day/'.$fy.'/'.$fx.'_'.$fy.'.gif" valign=top height="100" width="100">';}
				else{echo'<td background="/img//image/wmap/map/night/'.$fy.'/'.$fx.'_'.$fy.'.gif" valign=top height="100" width="100">';}
				echo '
				<table border="0" cellpadding="0" cellspacing="0" width=100% height=100% style="background:none">';
				if($_GET['info']==1){
					$bot=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT SQL_CACHE * FROM `nature_bots` WHERE `x`=".$fx." AND `y`=".$fy.";"));
					if($bot['x']==$fx and $bot['y']==$fy and ($fx+$fy)!=0){
						echo'<tr><td valign=top align=right><b class=levelbot>'.$bot['lvlmin'].'-'.$bot['lvlmax'].'</b></td></tr>';
						if($bot['lvlmax']>=6){
							$b=$bot['lvlmin'];
							$c=$bot['lvlmax'];
							while($b<=$c){
								if($b==6){
                                    $boss = "<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;БОСС </b> 6 уровня</font>";
                                    echo '<tr><td valign=top align=center><a href="ipers.php?Тёмный Огр" target="_blank"><b class=boss>' . $boss . '</b></td></tr>';
								}
								if($b==9){
                                    $boss = "<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;БОСС </b> 9 уровня</font>";
                                    echo '<tr><td valign=top align=center><a href="ipers.php?Восставший Командир" target="_blank"><b class=boss>' . $boss . '</b></td></tr>';
								}
								if($b==12){
                                    $boss = "<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;БОСС </b> 12 уровня</font>";
                                    echo '<tr><td valign=top align=center><a href="ipers.php?Дикий Варвар" target="_blank"><b class=boss>' . $boss . '</b></a></td></tr>';
								}
								if($b==20){
                                    $boss = "<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;БОСС </b> 20 уровня</font>";
                                    echo '<tr><td valign=top align=center><a href="ipers.php?Горец из Атинии" target="_blank"><b class=boss>' . $boss . '</b></a></td></tr>';
								}
								$b++;
							}
						}
					}
				}
				if($_GET['info']==2){
					$grasssql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_grass` WHERE `x`='".$fx."' AND `y`='".$fy."' LIMIT 1;"));
					if($grasssql){
					$grass = explode("|",$grasssql['grass']);
					$tr=0;
					foreach ($grass as $val){
						$tr++;
						$grn=explode("@",$val);
						$allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$grn[0]."' LIMIT 1;"));
						echo'<tr><td valign=top align=center><a href="iteminfo.php?'.$allgrass['name'].'" target="_blank"><b class=boss>'.$allgrass['name'].'</b></a></td></tr>';
						if($tr>7){break;}
					}	
					}		
					
				}
				if($_GET['info']==3){
					$grasssql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_les` WHERE `x`='".$fx."' AND `y`='".$fy."' LIMIT 1;"));
					if($grasssql){
					$grass = explode("|",$grasssql['grass']);
					$tr=0;
					foreach ($grass as $val){
						$tr++;
						$grn=explode("@",$val);
						$allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$grn[0]."' LIMIT 1;"));
						echo'<tr><td valign=top align=center><a href="iteminfo.php?'.$allgrass['name'].'" target="_blank"><b class=boss>'.$allgrass['name'].'</b></a></td></tr>';
						if($tr>7){break;}
					}	
					}		
					
				}
				if($_GET['info']==4){
					$grasssql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_fish` WHERE `x`='".$fx."' AND `y`='".$fy."' LIMIT 1;"));
					if($grasssql){
					$grass = explode("|",$grasssql['grass']);
					$tr=0;
					foreach ($grass as $val){
						$tr++;
						$grn=explode("@",$val);
						$allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$grn[0]."' LIMIT 1;"));
						echo'<tr><td valign=top align=center><a href="iteminfo.php?'.$allgrass['name'].'" target="_blank"><b class=boss>'.$allgrass['name'].'</b></a></td></tr>';
						if($tr>7){break;}
					}	
					}		
					
				}
				echo'<tr><td valign=bottom align=left><b class=kletka>&nbsp;'.$kvnumber.'&nbsp;</b></td></tr></table></td>';
				$fx++;
				if($fx>22){$fx=1;$fy++;echo'</tr>';}
			}
}
?>
</table>
<!--suppress ALL -->
<div align=center>
    <font class=weaponchdis align=center> © Команда «legendbat LLC. inc.», Copyright 2012-2015 | Все права
        защищены.</font>
</div>
</body>
</HTML>

