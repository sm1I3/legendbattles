<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
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
db_open();
$pers = player();

list($pers['x'], $pers['y']) = explode('_', $pers['pos']);

if($_GET['create']=='yes'){
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `labyrinth` (`x`,`y`) VALUES ('".$pers['x']."','".$pers['y']."');");
}

if($_GET['delete']=='yes'){
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `labyrinth` WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'");
}

if(!empty($_GET['gox']) and !empty($_GET['goy'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET `pos`='".intval($_GET['gox'])."_".intval($_GET['goy'])."' WHERE `id`='".$pers['id']."'");
	$pers['pos'] = intval($_GET['gox'])."_".intval($_GET['goy']);
	list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
}
if(!empty($_POST['formname'])){
	switch($_POST['formname']){
		case'type':
			mysqli_query($GLOBALS['db_link'],"UPDATE `labyrinth` SET `L_img`='".intval($_POST['params'])."' WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'");
		break;
		case'color':
			mysqli_query($GLOBALS['db_link'],"UPDATE `labyrinth` SET `L_view`='".intval($_POST['params'])."' WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'");
		break;
		case'portal':
			mysqli_query($GLOBALS['db_link'],"UPDATE `labyrinth` SET `d_to`='".intval($_POST['tp_x'])."_".intval($_POST['tp_y'])."' WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'");
		break;
	}	
}
echo'<HTML>
<HEAD>
<LINK href="/css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location=\'/core2.php?useaction=admin-action\'" value="Вернуться">
	</td>
   </tr>
</table>';

$HisLoc = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `labyrinth` WHERE `x`='".($pers['x'])."' and `y`='".($pers['y'])."'"));

echo'<table cellpadding=0 cellspacing=0 border=1 align=center width=100%><tr><td align=center><table cellpadding=0 cellspacing=0 border=1 align=center width="100%"><tr><td align="center">Местоположение</td></tr><tr><td align="center">X: <b>'.$pers['x'].'</b> Y: <b>'.$pers['y'].'</b></td></tr></table><br /><table cellpadding=0 cellspacing=0 border=1 align=center width="100%"><tr><td align="center">Клетка</td></tr><tr><td align="center"><input type="button" class=lbut onClick="location=\''.(($HisLoc)?'?delete=yes':'?create=yes').'\'" value="'.(($HisLoc)?'Удалить':'Создать').'" /></td></tr></table></td><td width=560><script>
var d = document;
var other = ["","","L_grill_","L_lever_","L_door_","L_key_","L_guard_","L_chest_","L_portal_","L_laz_","L_water_","L_exit_","L_bg_"];
var corid = ["L_turn_","L_end_","L_tun_","L_3way_","L_4way"];       
var dir = [0,0,0,0];
var Lpic;
var sum;
var param = [';
$Cord = '';
for($y=($pers['y']-4); $y<=($pers['y']+4); $y++){
	$Cordx = '';
	for($x=($pers['x']-8); $x<=($pers['x']+8); $x++){
		$MiniMap = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `labyrinth` WHERE `x`='".($x)."' and `y`='".($y)."'"));
		$Cordx .= '['.(($MiniMap['L_img'])?$MiniMap['L_img']:0).','.(($MiniMap['L_img'] == 4 || $MiniMap['L_img'] == 5)?$MiniMap['L_view']:0).','.$x.','.$y.'],';
	}
	$Cord .= '['.substr($Cordx,0,strlen($Cordx)-1).'],';
}
echo substr($Cord,0,strlen($Cord)-1);
echo']
d.write(\'<table cellpadding=0 cellspacing=0 border=1 align=center>\');
			for(y=1; y<8; y++)
			{
				d.write(\'<tr>\');
				for(x=1; x<15; x++)
				{	
					if(param[y][x][0])
					{
						
						dir[0] = param[y - 1][x][0] > 0 ? 1 : 0; // forward
						dir[1] = param[y + 1][x][0] > 0 ? 1 : 0; // back
						dir[2] = param[y][x - 1][0] > 0 ? 1 : 0; // left
						dir[3] = param[y][x + 1][0] > 0 ? 1 : 0; // right
						sum = dir[0] + dir[1] + dir[2] + dir[3];
						switch(sum)
						{
							case 1: Lpic = dir[0] ? \'1\' : (dir[1] ? \'2\' : (dir[3] ? \'3\' : \'4\')); break;
							case 2:
							
							if(dir[0] && dir[1]) Lpic = \'1\';
							else if(dir[2] && dir[3]) Lpic = \'2\';
							else 
							{
								if(dir[0] && dir[3]) Lpic = \'4\';
								else if(dir[0] && dir[2]) Lpic = \'3\';
								else if(dir[1] && dir[2]) Lpic = \'2\';
								else Lpic = \'1\';
								sum = 0;
							}
							
							break;
							case 3:
							
      						if(dir[2] && dir[3])
			        		{
			        			if(dir[0]) Lpic = \'1\';
			        			else Lpic = \'2\';
				        	}
				        	else
				        	{
			        			if(dir[2]) Lpic = \'3\';
			        			else Lpic = \'4\';
				        	}
					        	
							break;
							case 4: Lpic = \'\'; break;
						}
						Lpic = (param[y][x][0] == 1 ? corid[sum] : other[param[y][x][0]])+Lpic;
						if(param[y][x][0] == 4 || param[y][x][0]==5) Lpic += \'_\'+param[y][x][1];
					}
					else Lpic = \'L_bg\';
					
					d.write(\'<td background="http://img.legendbattles.ru/image/gameplay/labyrinth/\'+Lpic+\'.jpg" width=38 height=38><a href="?gox=\'+param[y][x][2]+\'&goy=\'+param[y][x][3]+\'">\'+((x != 8 || y != 4) ? \'<img src="http://img.legendbattles.ru/image/1x1.gif" width=38 height=38>\' : \'<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/arrow.gif" width=38 height=38>\')+\'</td>\');
				}
				d.write(\'</tr>\');
			} 
			d.write(\'</table>\');
</script></td><td align=center>

<table cellpadding=0 cellspacing=0 border=1 align=center width="100%"><tr><td align="center">Тип Клетки</td></tr><tr><td align="center"><form method="POST" action="labyrinth.php"><select name="params"><option>- - -</option><option value=1'.(($HisLoc['L_img']=='1')?' selected':'').'>Дорога</option><option value=2'.(($HisLoc['L_img']=='2')?' selected':'').'>Решетка</option><option value=3'.(($HisLoc['L_img']=='3')?' selected':'').'>Рычаг</option><option value=4'.(($HisLoc['L_img']=='4')?' selected':'').'>Дверь</option><option value=5'.(($HisLoc['L_img']=='5')?' selected':'').'>Ключ</option><option value=6'.(($HisLoc['L_img']=='6')?' selected':'').'>NPC</option><option value=7'.(($HisLoc['L_img']=='7')?' selected':'').'>Сундук</option><option value=8'.(($HisLoc['L_img']=='8')?' selected':'').'>Телепорт</option><option value=9'.(($HisLoc['L_img']=='9')?' selected':'').'>Лаз</option><option value=10'.(($HisLoc['L_img']=='10')?' selected':'').'>Вода</option><option value=11'.(($HisLoc['L_img']=='11')?' selected':'').'>Выход</option></select><input type="submit" value="Ok" /><input type="hidden" name="formname" value="type" /></form></td></tr></table><br />';
if($HisLoc['L_img'] == 4 or $HisLoc['L_img'] == 5){
	echo'<table cellpadding=0 cellspacing=0 border=1 align=center width="100%"><tr><td align="center">Если дверь или ключ...
</td></tr><tr><td align="center"><form method="POST" action="labyrinth.php"><select name="params"><option>- - -</option><option value=0'.(($HisLoc['L_view']=='0')?' selected':'').'>Золотой</option><option value=1'.(($HisLoc['L_view']=='1')?' selected':'').'>Бронз.</option><option value=2'.(($HisLoc['L_view']=='2')?' selected':'').'>Сереб.</option><option value=3'.(($HisLoc['L_view']=='3')?' selected':'').'>NPC (синий)</option></select><input type="submit" value="Ok" /><input type="hidden" name="formname" value="color" /></form></td></tr></table><br />';
}
if($HisLoc['L_img'] == 3 or $HisLoc['L_img'] == 8 or $HisLoc['L_img'] == 9){
	list($dTo['x'],$dTo['y']) = explode('_', $HisLoc['d_to']);
	echo'<table cellpadding=0 cellspacing=0 border=1 align=center width="100%"><tr><td align="center">Телепорт или Механизм</td></tr><tr><td align="center"><form method="POST" action="labyrinth.php">X: <input type="text" name="tp_x" value="'.$dTo['x'].'"><br />Y: <input type="text" name="tp_y" value="'.$dTo['y'].'"><br /><input type="submit" value="Ok" /><input type="hidden" name="formname" value="portal" /></form></td></tr></table>';
}
echo'</td></tr></table></body>
</html>';
