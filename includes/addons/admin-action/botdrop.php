<?php
?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
  	<td><input type=button class= lbuts onClick="location='?useaction=admin-action&addid=botdrop'" value="��������"></td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/func/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
db_open();
$bots=mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login`,`user`.`level` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`<'9999';");
echo '
<form method="post" action="?useaction=admin-action&addid=botdrop&add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=bot>
<option value="none" '.(($_POST['bot']!='none' and $_POST['bot']!='')?'':'selected=selected').'>�������� ����</option>
';
while($bot = mysqli_fetch_array($bots)){
	echo '<option value="'.$bot['id'].'" '.(($_POST['bot']==$bot['id'])?'selected=selected':'').'>'.$bot['login'].' ['.$bot['level'].']</option>';
}
echo '
</select>
<input class= lbuts type=submit value="�������">
</td></tr>
</table>
</form>
';
$err=1;
if($_POST['bot']!='none'){
	if(!empty($_POST['delete'])){
		$items=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bots_drop` WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;"));
		$additem="";
		switch($_POST['delete_id']){
			case 'items':
				$item=explode("|",$items['items_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");				
			break;
			case 'bottles':
				$item=explode("|",$items['bottle_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");			
			break;
			case 'leather': 
				$item=explode("|",$items['leather_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."' WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;");				
			break;
			case 'prof': 
				$item=explode("|",$items['prof_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `prof_id`='".$additem."' WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;");				
			break;
		}
	}
	if($_GET['save']==1){
		switch($_GET['update']){
			case 'yes': 
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_chance`='".intval($_POST['items_chance'])."',`leather_chance`='".intval($_POST['leather_chance'])."',`bottle_chance`='".intval($_POST['bottle_chance'])."',`money_chance`='".intval($_POST['money_chance'])."',`prof_chance`='".intval($_POST['prof_chance'])."' WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;");
			break;
			case 'no': 
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `bot_drop` (`bot_id`,`bot_login`,`items_chance`,`leather_chance`,`bottle_chance`,`money_chance`,`prof_chance`) VALUES ('".intval($_POST['bot'])."','".$_POST['bot_login']."','".intval($_POST['items_chance'])."','".intval($_POST['leather_chance'])."','".intval($_POST['bottle_chance'])."','".intval($_POST['money_chance'])."','".intval($_POST['prof_chance'])."');");
			break;
		}		
	}
	if($_POST['idit'] and $_POST['dropadd']!='none'){
		$items=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop` WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;"));
		switch($_POST['dropadd']){
			case 1: 
				if($items['items_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."' WHERE  `bot_id`='".$_POST['bot']."' LIMIT 1;");
				}
				else{
					$item=explode("|",$items['items_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['items_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}
			break;
			case 2:
				if($items['leather_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
				}
				else{
					$item=explode("|",$items['leather_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['leather_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}
			break;		
			case 3: 
				if($items['bottle_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
				}
				else{
					$item=explode("|",$items['bottle_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['bottle_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}			
			break;
			case 4: 
				if($items['prof_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `prof_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
				}
				else{
					$item=explode("|",$items['prof_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['prof_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `prof_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}			
			break;
		}
	}
	if($_GET['add']==1){
		$chbot=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop`  WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;"));
		if(!empty($chbot)){
			$chclr="green";$msg="��� ������ � ����!";
			$ich=$chbot['items_chance'];
			$lch=$chbot['leather_chance'];
			$bch=$chbot['bottle_chance'];
			$mch=$chbot['money_chance'];
			$pro=$chbot['prof_chance'];
			$err=0;
		}
		else{
			$chclr="red";$msg="��� �� ������ � ����! ��������� ������ ���� � ������� \"���������\".";
			$ich=10000;
			$lch=10000;
			$bch=10000;
			$mch=10000;
			$pro=10000;
			$err=1;
			echo '
			<table cellpadding=5 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr align=center class=freetxt>
					<td><font color='.$chclr.'><b>'.$msg.'</b></font><br></td>
				</tr>
			</table>
			';
		}
		echo'
		<form method="post" action="?useaction=admin-action&addid=botdrop&add=1&save=1&update='.($err==0?'yes':'no').'">
		<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>��� � �� ����</b></td>
					<td align=center><b>����</b></td>
					<td align=center><b>��������� ����</b></td>
					<td align=center><b>�������</b></td>
					<td align=center><b>������</b></td>
					<td align=center><b>�����������</b></td>
				</tr>';
		$botdrop=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`='".$_POST['bot']."' LIMIT 1;"));
		echo'
		<tr class=freetxt bgcolor=white>
			<td align=center width=30%>
				���: '.$botdrop['login'].'<br>
				��: '.$botdrop['id'].'
			</td>
			<td align=center>
				<b>���� ��������� �����:</b><br> <b>1</b> �� <input type=text class=logintextbox6 name="items_chance" value="'.$ich.'" />
			</td>
			<td align=center>
				<b>���� ��������� ��������� ����</b><br> <b>1</b> �� <input type=text class=logintextbox6 name="leather_chance" value="'.$lch.'" />
			</td>
			<td align=center>
				<b>���� ��������� �������:</b><br> <b>1</b> �� <input type=text class=logintextbox6 name="bottle_chance" value="'.$bch.'" />
			</td>
			<td align=center>
				<b>���� ��������� �����:</b><br> <b>1</b> �� <input type=text class=logintextbox6 name="money_chance" value="'.$mch.'" />
			</td>
			<td align=center>
				<b>���� ��������� ������������:</b><br> <b>1</b> �� <input type=text class=logintextbox6 name="prof_chance" value="'.$pro.'" /><br>
			</td>
		</tr>
		<tr class=freetxt bgcolor=white>
			<td align=center width=100% colspan=5>
			<input class= lbuts type=submit value="���������">
			<input type=hidden name=bot_login value="'.$botdrop['login'].'">
			<input type=hidden name=bot value="'.$_POST['bot'].'">
			</td>
		</tr>	
		</table></form></td></tr></table>';	
		if($err==0){
			echo'
			<form method="post" action="?useaction=admin-action&addid=botdrop&add=1">
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=left class=nickname><td align=center>
			<b>�������� ���� � ����:</b> 
			<select name="type" >
				<option value="" selected="selected">��� ����</option>
				  <option value="w4">����</option>
				  <option value="w1">����</option>
				  <option value="w2">������</option>
				  <option value="w3">��������</option>
				  <option value="w6">�������� � �����</option>
				  <option value="w5">�����������</option>
				  <option value="w7">������</option>
				  <option value="w20">����</option>
				  <option value="w23">�����</option>
				  <option value="w26">�����</option>
				  <option value="w18">��������</option>
				  <option value="w19">�������</option>
				  <option value="w24">��������</option>
				  <option value="w80">������</option>
				  <option value="w21">������</option>
				  <option value="w25">������</option>
				  <option value="w22">������</option>
				  <option value="w28">����������</option>
				  <option value="w90">������</option>
				  <option value="w61">��������</option>
				  <option value="w27">�����</option>
				  <option value="w0">��������</option>
				  <option value="w66">�����</option>
				  <option value="w67">�����</option>
				  <option value="w70">��������� ����</option>
				  <option value="w29">������</option>
				  <option value="w72">���������������� ������</option>
				  <option value="w73">�����������</option>
				 </select>  <input name="smb7" type="submit" class=" lbuts" value="��������� ������" />';
				 $filter2="WHERE master=''";
				 if($smb7){
					if($type==""){
						$filter="";$filter2="WHERE master='' AND dprice=0";
					}
					else $filter="WHERE type='".$type."'";
					$filter2=" AND master=''  AND dprice=0";
				}
				echo'    
				  <select name="idit" >
				  <option value=0';
				if($idit==""){echo " selected=selected";}
				echo'>�������� ���</option>';
				$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` ".$filter." ".$filter2." ORDER BY type,name,level;");
				  while ($row = mysqli_fetch_assoc($it)) {
					echo "<option value=".$row['id']."";if($idit==$row['id']){echo " selected=selected";}echo">".$row['name']." [ ".$row['level']." ]</option>";
				  }
				  echo'
			<input type=hidden name=bot value="'.$_POST['bot'].'">';
			if(!empty($_POST['type'])){
				echo'
				<select name=dropadd>
					<option value=none selected=selected>�������� ���������</option>
					<option value=1>����</option>
					<option value=2>��������� ����</option>
					<option value=3>�������</option>
					<option value=4>�����������</option>
				</select>
				<input class= lbuts type=submit value="�������� � ����">
				';
			}
			echo'
			</td></tr>
			</table>
			</form><br>
			';
			if($chbot['items_id']!='0'){
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>����������� ����:</b></td></tr>';
				$itemsin=explode("|",$chbot['items_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=botdrop&add=1" id="itdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="items">
								<input type=image src=http://image.gamele.ru/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
				echo'
				</table>
				</td></tr>
				</table>';
			}
			if($chbot['bottle_id']!='0'){
				echo'		
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>����������� �����/��������:</b></td></tr>';
				$itemsin=explode("|",$chbot['bottle_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=botdrop&add=1" id="bdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="bottles">
								<input type=image src=http://image.gamele.ru/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'bdel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
								echo'
				</table>
				</td></tr>
				</table>';
			}
			if($chbot['prof_id']!='0'){
				echo'		
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>����������� �����������:</b></td></tr>';
				$itemsin=explode("|",$chbot['prof_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=botdrop&add=1" id="bdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="bottles">
								<input type=image src=http://image.gamele.ru/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'bdel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
								echo'
				</table>
				</td></tr>
				</table>';
			}
			if($chbot['leather_id']!='0'){
				echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>����������� ��������� ����:</b></td></tr>';
				$itemsin=explode("|",$chbot['leather_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=botdrop&add=1" id="ldel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="leather">
								<input type=image src=http://image.gamele.ru/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'ldel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
					
				}
				
								echo'
				</table>
				</td></tr>
				</table>';
			}			
		}		
	}
}
?>