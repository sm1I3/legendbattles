<? require('kernel/before.php');
session_start();session_register('filter');?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>

<? 
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

echo '
<form method="post" action="player_items.php?load=1">
<br><span class="logintext"> ������� �����: </span><input name="loginp" type="text" class="LogintextBox" />
<input name="load" type="submit" value="���������" class="lbut"/>
</form>';
if($_GET['load']==1 and $_POST['loginp']!=''){
	$val_loginp=varcheck($_POST['loginp']);
	$plid=mysql_fetch_assoc(mysql_query("SELECT `user`.`id` FROM `user` WHERE `login`='".$val_loginp."' LIMIT 1;"));	
	if($_POST['delete']){
		if($_POST['delete']!='all'){
		$val_delete=varcheck($_POST['delete']);
	
			mysql_query("DELETE FROM `invent` WHERE `id_item`='".$val_delete."' AND `pl_id`='".$plid['id']."' LIMIT 1;");
		}
		else{
			mysql_query("DELETE FROM `invent` WHERE `pl_id`='".$plid['id']."';");
		}
	}
	$allitems=mysql_query("SELECT * FROM `invent` WHERE `pl_id`='".$plid['id']."';");
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>���� ��������� <b>'.$_POST['loginp'].'</b>:</b></td></tr>';
					while($row = mysql_fetch_assoc($allitems)){
						$name=mysql_fetch_assoc(mysql_query("SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$row['protype']."' LIMIT 1;"));
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="player_items.php?load=1" id="itdel_'.$row['id_item'].'">
							[id_item: '.$row['id_item'].'] '.(($row['used'] > 0)?'<b>[�����]</b>':'').' '.(($row['auction'] > 0)?'<b>[�� ��������]</b>':'').' '.$name['name'].' '.($row['mod_color']?'[���]':'').' - ['.($row['clan']?'���� � ����� �����':($row['gift_from']?'���� �����-�� ���� � ����� ����� ��� ��� ��������, �������: '.$row['gift_from']:'')).']							
								<input type=hidden name=loginp value="'.$_POST['loginp'].'">
								<input type=hidden name=delete value="'.$row['id_item'].'">
								<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_'.$row['id_item'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
					if(mysql_num_rows($allitems)>0){
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="player_items.php?load=1" id="itdel_all">
							<b><font color=red>���������!!!</font>  ������� ��� ����  </b>							
								<input type=hidden name=loginp value="'.$_POST['loginp'].'">
								<input type=hidden name=delete value="all">
								<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_all\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
					else{
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<b color=red>� ��������� ��� �����</b>
							</td>
						</tr>';
					}					
				echo'
				</table>
				</td></tr>
				</table>';

}
?>
<? require('kernel/after.php'); ?>