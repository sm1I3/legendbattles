<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/common.php");
foreach($_POST as $keypost=>$valp){
     //$valp = varcheck($valp);
     $_POST[$keypost] = $valp;
     $$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
    // $valg = varcheck($valg);
     $_GET[$keyget] = $valg;
     $$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
     $$keyses = $vals;
}
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
	<TITLE>legendbat� | ����� - ����� � ���� ����������...</TITLE>
	<LINK href="/css/mapinfo.css" rel="STYLESHEET" type="text/css">
	<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
	<SCRIPT LANGUAGE="JavaScript" SRC="./js/game.js"></SCRIPT>
	<SCRIPT  LANGUAGE="JavaScript" src="./js/ft_v01.js"></SCRIPT>
	<SCRIPT  LANGUAGE="JavaScript" src="./js/png.js"></SCRIPT>
	<META Http-Equiv=CONTENT-TYPE Content="text/html; charset=windows-1251">
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
			<tr align=center><td align=right width=49%><a href="?map=1&info=1" style="color:black;"><b>����<b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=2" style="color:green;"><b>�����</b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=3" style="color:brown;"><b>����</b></a></td><td width=2%> | </td><td width=49% align=left><a href="?map=1&info=4" style="color:blue;"><b>����</b></a></td></tr>
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
									$boss="<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;���� </b> 6 ������</font>";
									echo'<tr><td valign=top align=center><a href="ipers.php?Ҹ���� ���" target="_blank"><b class=boss>'.$boss.'</b></td></tr>';
								}
								if($b==9){
									$boss="<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;���� </b> 9 ������</font>";
									echo'<tr><td valign=top align=center><a href="ipers.php?���������� ��������" target="_blank"><b class=boss>'.$boss.'</b></td></tr>';
								}
								if($b==12){
									$boss="<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;���� </b> 12 ������</font>";
									echo'<tr><td valign=top align=center><a href="ipers.php?����� ������" target="_blank"><b class=boss>'.$boss.'</b></a></td></tr>';
								}
								if($b==20){
									$boss="<font style=\"color: red;font-weight: bold;background:white;\"><b color=red>&nbsp;���� </b> 20 ������</font>";
									echo'<tr><td valign=top align=center><a href="ipers.php?����� �� ������" target="_blank"><b class=boss>'.$boss.'</b></a></td></tr>';
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
<div align=center>
<font class=weaponchdis align=center> �  ������� �legendbat LLC. inc.�, Copyright  2012-2015 | ��� ����� ��������.</font>
</div>
</body>
</HTML>

