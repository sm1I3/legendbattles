<?php require('kernel/before.php');?>
<? session_start();session_register('filter');?>
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
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
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

$Newchests2 = mysql_query("SELECT * FROM `items` WHERE `chests`='2';");
while($row = mysql_fetch_array($Newchests2)){
	if(mysql_num_rows(mysql_query("SELECT * FROM `chests2` WHERE `cid`='".$row['id']."'")) == 0){
		mysql_query("INSERT INTO `chests2` (`cid`, `name`) VALUES ('".$row['id']."', '".$row['name']."');");
	}
}
$chests2 = mysql_query("SELECT * FROM `chests2`;");
echo '
<form method="post" action="?useaction=admin-action&addid=chests2&add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=present>
<option value="none" '.(($_POST['present']!='none' and $_POST['present']!='')?'':'selected=selected').'>�������� ������</option>
';
while($present = mysql_fetch_array($chests2)){
	if(mysql_num_rows(mysql_query("SELECT * FROM `items` WHERE `chests`='2' and `id`='".$present['cid']."'")) > 0){
		echo '<option value="'.$present['id'].'" '.(($_POST['present']==$present['id'])?'selected=selected':'').'>'.$present['name'].'</option>';
	}else{
		mysql_query("DELETE FROM `chests2` WHERE `cid`='".$present['cid']."'");
	}
}
echo '
</select>
<input class=lbut type=submit value="�������">
</td></tr>
</table>
</form>
';
$err=0;
if($_POST['present']!='none' and !empty($_POST['present'])){
	if(!empty($_POST['delete'])){
		$items=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."' LIMIT 1;"));
		$additem="";
		switch($_POST['delete_id']){
			case 'items':
				$item=explode("|",$items['items']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysql_query("UPDATE `chests2` SET `items`='".$additem."'  WHERE `id`='".$_POST['present']."'  LIMIT 1;");				
			break;
		}
	}
	if($_POST['idit']){
		$items=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."' LIMIT 1;"));
		if($items['items']=='0'){
			$additem=intval($_POST['idit'])."|";
			mysql_query("UPDATE `chests2` SET `items`='".$additem."' WHERE  `id`='".$_POST['present']."' LIMIT 1;");
		}
		else{
			$item=explode("|",$items['items']);
			if(in_array(intval($_POST['idit']),$item)==false){
				$additem=$items['items'].intval($_POST['idit'])."|";
				mysql_query("UPDATE `chests2` SET `items`='".$additem."'  WHERE `id`='".$_POST['present']."'  LIMIT 1;");
			}
		}
	}
	if($_GET['add']==1){
	$present=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."';"));
	echo'
			<form method="post" action="?useaction=admin-action&addid=chests2&add=1&save=1">
			<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
					<tr class=nickname bgcolor=#EAEAEA>
						<td align=center width=30%><b>���</b></td>
					</tr>';
			echo'
			<tr class=freetxt bgcolor=white>
				<td align=center width=30%>
					���: <input type=text class=logintextbox6 name="present_name" value="'.$present['name'].'" /><br>
					��: '.$present['cid'].'
				</td>
			</tr>
			<tr class=freetxt bgcolor=white>
				<td align=center width=100% colspan=5>
				<input class=lbut type=submit value="���������">
				<input type=hidden name=present value="'.$_POST['present'].'">
				</td>
			</tr>	
			</table></form></td></tr></table>';
	}
	if($err==0){	
			echo'
			<form method="post" action="?useaction=admin-action&addid=chests2&add=1">
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=left class=nickname><td align=center>
			<b>�������� ���� � ������:</b> 
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
				  <option value="w0">��������</option>
				  <option value="w66">�����</option>
				  <option value="w67">�����</option>
				  <option value="w60">������</option>
			      <option value="w29">������</option>
					<option value="w71">����</option>
				  <option value="w70">����</option>
				  <option value="w100">�������</option>
				 </select>  <input name="smb7" type="submit" class="lbut" value="��������� ������" />';
				 $filter2="WHERE master=''";
				 if($smb7){
					if($type==""){
						$filter="";$filter2="WHERE master=''";
					}
					else $filter="WHERE type='".$type."'";
					$filter2=" AND master=''";
				}
				echo'    
				  <select name="idit" >
				  <option value=0';
				if($idit==""){echo " selected=selected";}
				echo'>�������� ���</option>';
				$it=mysql_query("SELECT * FROM `items` ".$filter." ".$filter2." ORDER BY type,name,level;");
				  while ($row = mysql_fetch_assoc($it)) {
					echo "<option value=".$row['id']."";if($idit==$row['id']){echo " selected=selected";}echo">".$row['name']." [ ".$row['level']." ]</option>";
				  }
				  echo'
			<input type=hidden name=present value="'.$_POST['present'].'">
			<input class=lbut type=submit value="�������� � ����">
			</td></tr>
			</table>
			</form><br>
			';
			if($present['items']!='0'){
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>����������� ����:</b></td></tr>';
				$itemsin=explode("|",$present['items']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysql_fetch_array(mysql_query("SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo'
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=chests2&add=1" id="itdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=present value="'.$_POST['present'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="items">
								<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_'.$name['id'].'\').submit()" value="x" />
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
?>
<? require('kernel/after.php'); ?>