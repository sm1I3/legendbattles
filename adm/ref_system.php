<?php require('kernel/before.php');
session_start();
?>
<HTML>
<HEAD>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<?
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

/*foreach($_POST as $keypost=>$valp){ //�������� ���������
	echo '<br>post-key:'.$keypost.' | post-val:'.$valp;
}*/

//��������� ������
switch($_POST['post_id']){
	case 1: //���������� �������� ���������� 
		for($i=5;$i<=20;$i+=5){
			if($i==20){$i='all';}
			$bonus_arr[$i] = 'LR@'.(intval($_POST['LR'.$i])>0?intval($_POST['LR'.$i]):'0').'|'.'DLR@'.(intval($_POST['DLR'.$i])>0?intval($_POST['DLR'.$i]):'0').'|';
			switch(intval($_POST['ACCTYPE'.$i])){
				case 0: $bonus_arr[$i] .= 'ACCTYPE@0|'; break;
				case 2: $bonus_arr[$i] .= 'ACCTYPE@2|'; break;
				case 3: $bonus_arr[$i] .= 'ACCTYPE@3|'; break;
				case 4: $bonus_arr[$i] .= 'ACCTYPE@4|'; break;
			}
			$bonus_arr[$i] .= 'ACCTIME@'.(intval($_POST['ACCTIME'.$i])>0?intval($_POST['ACCTIME'.$i]):'0');
			//echo '<br>test '.$i.': '.$bonus_arr[$i];
			if($i=='all'){$i=20;}
		}
		$money_bonus = intval($_POST['money_bonus']);
		$money_dlr_bonus = intval($_POST['money_dlr_bonus']);
		mysql_query("
		UPDATE `ref_adm` SET 
			`money_bonus`='".($money_bonus>0?$money_bonus:'0')."',  
			`money_dlr_bonus`='".($money_dlr_bonus>0?$money_dlr_bonus:'0')."', 
			`bonus_5`='".$bonus_arr[5]."',
			`bonus_10`='".$bonus_arr[10]."',
			`bonus_15`='".$bonus_arr[15]."',
			`bonus_all`='".$bonus_arr['all']."'
		WHERE `id`='1'
		LIMIT 1;
		");	
	break;
	case 2: //��������� ����
		$id=intval($_POST['idit']);
		switch($_POST['ref_col']){
			 case 'all': $col=$_POST['ref_col']; break;
			 case 'ref': $col=$_POST['ref_col']; break;
			 case 5: $col=$_POST['ref_col']; break;
			 case 10: $col=$_POST['ref_col']; break;
			 case 15: $col=$_POST['ref_col']; break;
			 default:  $col='15'; break;break;
		}
		if($id){
			$items=mysql_fetch_assoc(mysql_query("SELECT `ref_adm`.`items_".$col."` FROM `ref_adm` LIMIT 1;"));
			if($items['items_'.$col]==''){$items['items_'.$col]='||||';}
			if($items['items_'.$col]=='||||'){
				$additem=$id."|";
				mysql_query("UPDATE `ref_adm` SET `items_".$col."`='".$additem."' WHERE  `id`='1' LIMIT 1;");
			}
			else{
				$item=explode("|",$items['items_'.$col]);
				if(in_array($id,$item)==false){
					$additem=$items['items_'.$col].$id."|";
					mysql_query("UPDATE `ref_adm` SET `items_".$col."`='".$additem."' WHERE  `id`='1' LIMIT 1;");
				}
			}
		}
	break;
	case 3:
		$id=intval($_POST['delete']);
		switch($_POST['items_val']){
			 case 'all': $col=$_POST['items_val']; break;
			 case 'ref': $col=$_POST['items_val']; break;
			 case 5: $col=$_POST['items_val']; break;
			 case 10: $col=$_POST['items_val']; break;
			 case 15: $col=$_POST['items_val']; break;
			 default:  $col=''; break;break;
		}
		if($id and $col){
			$items=mysql_fetch_assoc(mysql_query("SELECT `ref_adm`.`items_".$col."` FROM `ref_adm` LIMIT 1;"));
			$additem="";
			$item=explode("|",$items['items_'.$col]);
			foreach($item as $val){
				if($val!='' and $val!=$id){
					$additem.=$val."|";
				}
			}
			if($additem==""){$additem='||||';}
			mysql_query("UPDATE `ref_adm` SET `items_".$col."`='".$additem."'  WHERE `id`='1'  LIMIT 1;");				
		}	
	break;	
}
//
	$ref = mysql_fetch_assoc(mysql_query("SELECT * FROM `ref_adm` WHERE `id`='1' LIMIT 1;"));
	$bonus['all'] = explode("|",$ref['bonus_all']);	
	$bonus[5] = explode("|",$ref['bonus_5']);
	$bonus[10] = explode("|",$ref['bonus_10']);
	$bonus[15] = explode("|",$ref['bonus_15']);
	$LR='';$DLR='';$ACCTYPE='';$ACCTIME='';$w='';
	for($i=5;$i<=20;$i+=5){
		if($i==20){$i='all';}
		foreach($bonus[$i] as $val){
			$par = explode("@",$val);
			switch($par[0]){
				case 'LR': $LR['bonus_'.$i] = $par[1]; break;
				case 'DLR': $DLR['bonus_'.$i] = $par[1]; break;
				case 'ACCTYPE': 
					$ACCTYPE['bonus_'.$i] = $par[1];
					$w['bonus_'.$i][$par[1]] = " selected=selected";
				break;
				case 'ACCTIME': $ACCTIME['bonus_'.$i] = $par[1]; break;
			}
		}
		if($i=='all'){$i=20;}
	}
	
		echo'
		<form method="post">
			<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=20%><b>����� �� ��������� ������ ���������</b></td>
					<td align=center width=20%><b>����� �� 5 ���������</b></td>
					<td align=center width=20%><b>����� �� 10 ���������</b></td>
					<td align=center width=20%><b>����� �� 15 ���������</b></td>
				</tr>';
				echo'
				<tr class=freetxt bgcolor=white>
				<td align=center width=20%>
					<b>�����:</b> <input type=text class=logintextbox7 name="money_bonus" value="'.$ref['money_bonus'].'" />%<br>
					�� ���������� LR �� �������<br>
					<font class=proce>�������� ��������� ��� ��������� ��������� ������.</font><br>
					<b>����� DLR:</b> <input type=text class=logintextbox7 name="money_dlr_bonus" value="'.$ref['money_dlr_bonus'].'" />%
				</td>';
				for($i=5;$i<=15;$i+=5){
				echo'<td align=center  width=20%>
					<b>�������:</b>
					<select name="ACCTYPE'.$i.'">
						<option value=0'.$w['bonus_'.$i][0].'>���</option>
						<option value=2'.$w['bonus_'.$i][2].'>SILVER</option>
						<option value=3'.$w['bonus_'.$i][3].'>GOLD</option>
						<option value=4'.$w['bonus_'.$i][4].'>VIP</option>
					</select>
					<b>����� �������� (����):</b> <input type=text class=logintextbox7 name="ACCTIME'.$i.'" value="'.$ACCTIME['bonus_'.$i].'" />
					----------------------------------------------------<br>
					<b>DLR:</b> <input type=text class=logintextbox7 name="DLR'.$i.'" value="'.$DLR['bonus_'.$i].'" />
					<b>LR:</b> <input type=text class=logintextbox8 name="LR'.$i.'" value="'.$LR['bonus_'.$i].'" /><br>
					<font class=proce>�������� ����� 1 ��� �� ������� "���� ��������".</font>					
				</td>';
				}
				$i='all';
				echo'
			</tr>
			<tr class=nickname bgcolor=#EAEAEA>
				<td colspan=4 align=center>
					<b>����� �� ������� ��������</b>
				</td>
			</tr>
			<tr class=freetxt bgcolor=white>
				<td align=center width=100% colspan=4>
						<b>�������:</b>
						<select name="ACCTYPE'.$i.'">
							<option value=0'.$w['bonus_'.$i][0].'>���</option>
							<option value=2'.$w['bonus_'.$i][2].'>SILVER</option>
							<option value=3'.$w['bonus_'.$i][3].'>GOLD</option>
							<option value=4'.$w['bonus_'.$i][4].'>VIP</option>
						</select> | 
						<b>����� �������� (����):</b> <input type=text class=logintextbox7 name="ACCTIME'.$i.'" value="'.$ACCTIME['bonus_'.$i].'" /> | 
						<b>DLR:</b> <input type=text class=logintextbox7 name="DLR'.$i.'" value="'.$DLR['bonus_'.$i].'" /> | 
						<b>LR:</b> <input type=text class=logintextbox8 name="LR'.$i.'" value="'.$LR['bonus_'.$i].'" /><br>
						<font class=proce>�������� ����� 1 ��� �� ������� "���� ��������".</font>					
				</td>
			</tr>
			<tr class=freetxt bgcolor=white>
				<td align=center width=100% colspan=4>
					<input type=hidden name=post_id value="1">
					<input class=lbut type=submit value="���������">
				</td>
			</tr>	
			</table>
		</form></td></tr></table>';	
		echo'
			<form method="post" action="ref_system.php">
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=left class=nickname><td align=center>
			<b>�������� �������� ����:</b> 
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
				  <option value="w69">�������</option>
				  <option value="w70">����</option>
				  <option value="w29">������</option>
				  <option value="w60">������</option>
				 </select>  <input name="smb7" type="submit" class="lbut" value="��������� ������" />';
				 $filter2="WHERE master=''";
				 if($smb7){
					if($type==""){
						$filter="";$filter2="WHERE master='' AND dd_price=0";
					}
					else $filter="WHERE type='".$type."'";
					$filter2=" AND master=''  AND dd_price=0";
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
				  echo '</select>';
			if(!empty($_POST['type'])){
				echo'
				<select name=ref_col>
					<option value=all selected=selected>�� ������� ��������</option>
					<option value=5>�� 5 ���������</option>
					<option value=10>�� 10 ���������</option>
					<option value=15>�� 15 ���������</option>
					<option value=ref>��� ��������</option>
				</select>
				<input type=hidden name=post_id value=2>
				<input class=lbut type=submit value="�������� �������� ����"><br><font class=proce>�������� ����� 1 ��� �� ������� "���� ��������".</font>
				';
			}
			echo'
			</td></tr>
			</table>
			</form><br>
			';
			for($i=5;$i<=25;$i+=5){
				if($i==20){$i='all';}
				if($i==25){$i='ref';}
				if($ref['items_'.$i]==''){$ref['items_'.$i]='||||';}
				if($ref['items_'.$i]!='||||'){
					echo'
					<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
					<tr><td>
					<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
					<tr align=center class=nickname><td><b>���� � ������� '.($i=='all'?'�� ������� ��������:':($i=='ref'?'�������� (����� ����� ���� - 30 ����)':'�� '.$i.' ���������:')).'</b></td></tr>';
					$itemsin=explode("|",$ref['items_'.$i]);
					foreach($itemsin as $val){
						if($val!=''){
							$name=mysql_fetch_assoc(mysql_query("SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
							echo '
							<tr class=freetxt bgcolor=white>							
								<td>
								<form method="post" id="itdel_'.$name['id'].'">
								'.$name['name'].'							
									<input type=hidden name="delete" value="'.$name['id'].'">
									<input type=hidden name="post_id" value="3">
									<input type=hidden name="items_val" value="'.$i.'">
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
				if($i=='all'){$i=20;}
				if($i=='ref'){$i=25;}
			}
?>
<? require('kernel/after.php'); ?>