<? session_start();session_register('filter');

?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<SCRIPT src="../../../js/stooltip.js?v11"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<div id="tooltip"></div>
		<input type=button class=lbut onClick="location='adm.php'" value="���������">
		<input type="button" class="lbut" onclick="location='custom_rec.php?create=1'" value="�������� �������" />
		<input type="button" class="lbut" onclick="location='custom_rec.php?look=1'" value="�������� ��������" />
		<!--input type="button" class="lbut" onclick="location='custom_rec.php?look=2'" value="�������� �������" /-->
	</td>
   </tr>
</table>
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
db_open();
if($create==1){
	$itm="";
	if($_POST['idit']!=0){
		$itm=$_POST['idit'].((intval($_POST['col'])=='')?"@1":"@".intval($_POST['col'])).($_GET['items']?"|".$_GET['items']:"");
	}
	else{
		$itm=($_GET['items']?$_GET['items']:"");
	}	
	echo'
	<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td>
	<form action="custom_rec.php?create=1&items='.$itm.'" method="post">
	<select name="idit" onmouseover="tooltip(this,\'<b>�������� ������� � �������� ��� � ������</b>\')" onmouseout="hide_info(this)">
	<option value="0" selected=selected>��������</option>';
	$filter=itemfilter2();
	$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE (`type`='w66' OR `type`='w67' OR `type`='w68' OR `type`='w69' OR `type`='w70'  OR `type`='w100') AND `master`='' ORDER BY type,name,level;");
	 while ($row = mysqli_fetch_assoc($it)) {
		echo "<option value=\"$row[id]@$row[name]@$row[price]\">$row[name] [ $row[level] ]</option>";
	 }
	echo'
	<input type=hidden name=itemr value="'.$_POST['itemr'].'">
	<input type=hidden name=colr value="'.$_POST['colr'].'">
	<input type=hidden name=pricer value="'.$_POST['pricer'].'">
	<input type=hidden name=navr value="'.$_POST['navr'].'">
	<input type=text name=col onBlur="if (value == \'\') {value=\'����������\'}" onFocus="if (value == \'����������\') {value =\'\'}" value="����������" onmouseover="tooltip(this,\'<b>������� ����������</b><br>�� ���������: 1\')" onmouseout="hide_info(this)">
	<input name="setitem" type="submit" class="lbut" value="�������� � ������" /></form>
	';
	if($itm!=""){		
		$i=0;
		$gospr='';
		$item=explode("|",$itm);
		foreach($item as $value){
			$param=explode("@",$value);
			$recipe[$param[0]]+=$param[3];
			$gospr[$param[0]]+=($param[2]*$param[3]);
			$fullrec[$param[0]]=$param[0]."@".$recipe[$param[0]]."@".$param[1];
		}
		sort($gospr);
		sort($fullrec);
		$forbd="";
		echo '<br><b>������:</b><br>';
		while (list($key,$val) = each($fullrec)) {
			$forp=explode("@",$val);
			if(	$forp[1] > 0 ){
				$forbd.=$forp[0]."@".$forp[1]."|";			
				echo $forp[2]." (<b>".$forp[1]." ��</b>.)<br>"; 
			}			
		}
		while (list($key,$val) = each($gospr)) {
			if($val>0){
				$gosprice += $val;
			}
		}
		echo "<br>��� ���� ���������: ".$gosprice;
		$forbd=substr($forbd,0,strlen($forbd)-1);
		//echo $forbd;	
		echo '
		<br>
		<b>��� ���������� ��� ������ ������ ��������� (���� ��� ������ ���� � ����):</b>
		<form action="custom_rec.php?recipe=1" method="post">
		<select name="idit" onmouseover="tooltip(this,\'<b>�������� �����, ������� ����� ������� �� �������</b>\')" onmouseout="hide_info(this)">
		<option value="0" '.($_POST['itemr']?'':'selected=selected').'>��������</option>';
		$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE (`type`='w70' OR `type`='w71' OR `type`='w100') AND `master`='' AND `dd_price`='0' ORDER BY type,name,level;");
		while ($row = mysqli_fetch_assoc($it)) {
			echo "<option value=\"$row[id]@$row[name]\" ".(($_POST['itemr']==$row['id'])?'selected=selected':'').">$row[name] [ $row[level] ]</option>";
		}
		echo'
		<input type=text name=col onBlur="if (value == \'\') {value=\'����������\'}" onFocus="if (value == \'����������\') {value =\'\'}" value="'.($_POST['colr']?$_POST['colr']:'����������').'" onmouseover="tooltip(this,\'<b>������� ���������� ����� ������� ��������� ��� ��������</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (�� ���������: 5)</font>
		<br><input type=text name=price onBlur="if (value == \'\') {value=\'���� �������\'}" onFocus="if (value == \'���� �������\') {value =\'\'}" value="'.($_POST['pricer']?$_POST['pricer']:'���� �������').'" onmouseover="tooltip(this,\'<b>������� ���� �������</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (�� ���������: 100 LR)</font>	
		<br><br><b>�������� ���� ��������:</b> <font class=travma style="color: gray; font-size: 9px;">'.($gosprice?'( ������������� ����: '.round(($gosprice*2)/5).' LR )':'').'</font>		
		<br><input type=text name=newitprice onBlur="if (value == \'\') {value=\'�������� ���� ��������\'}" onFocus="if (value == \'�������� ���� ��������\') {value =\'\'}" value="'.($_POST['newitprice']?$_POST['newitprice']:'�������� ���� ��������').'" onmouseover="tooltip(this,\'<b>������� ����� ���� ��������</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (�� ���������: �� ��������)</font>
		<br><input type=hidden name=nav onBlur="if (value == \'\') {value=\'����� �������\'}" onFocus="if (value == \'����� �������\') {value =\'\'}" value="'.($_POST['navr']?$_POST['navr']:'����� �������').'" onmouseover="tooltip(this,\'<b>������� ����������� ����� ������� ��� ������������� � ������� ������� �������</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"><!-- (�� ���������: 1) --></font>
		<input type=hidden name=recipe value="'.(($forbd=="")?"0":$forbd).'">	
		<br><input name="setitem" type="submit" class="lbut" value="�������� ������ � ����" /></form>
		<br><font class=travma style="color: red;"><b>&nbsp;��������: </font></b><font class=travma>�������� �� ��������� �������� ���, �� ������������ �������� ���� "-200" � ���� ��� ����������. ���� ������ �� ��� ���� ��� ���������� � ���� - �� ����� ������� �����.
		
		';
	}
	echo'
	</td>
	</tr>
	</table>	
	';
	
}
if($_GET['recipe']==1){
	if($_POST['idit']=="0"){
		echo '�� ������� ���� ��� ��������';
	}
	else if($_POST['recipe']=="0"){
		echo '�� ��������� �� ������ �����������';
	}
	else{
		$item=explode("@",$_POST['idit']);
		if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `custom_rec` WHERE `protype`='".$item[0]."';"))>0){
			mysqli_query($GLOBALS['db_link'],"UPDATE `custom_rec` SET `reagents`='".$_POST['recipe']."',`col`='".((intval($_POST['col'])=="")?"5":intval($_POST['col']))."',`nav`='".((intval($_POST['nav'])=="")?"1":intval($_POST['nav']))."',`price`='".((intval($_POST['price'])=="")?"100":intval($_POST['price']))."' WHERE `protype`='".$item[0]."';");
			if(intval($_POST['newitprice'])>0){
				mysqli_query($GLOBALS['db_link'],"UPDATE `items` SET `price`='".intval($_POST['newitprice'])."' WHERE `id`='".$item[0]."' LIMIT 1;");
				echo '���� �������� � ID:'.$item[0].' �������� �� '.intval($_POST['newitprice']);
			}
		}
		else{
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `custom_rec` (protype,name,reagents,col,nav,price) VALUES ('".$item[0]."','".$item[1]."','".$_POST['recipe']."','".((intval($_POST['col'])=="")?"5":intval($_POST['col']))."','".((intval($_POST['nav'])=="")?"1":intval($_POST['nav']))."','".((intval($_POST['price'])=="")?"100":intval($_POST['price']))."')");
			if(intval($_POST['newitprice'])>0){
				mysqli_query($GLOBALS['db_link'],"UPDATE `items` SET `price`='".intval($_POST['newitprice'])."' WHERE `id`='".$item[0]."' LIMIT 1;");
				echo '���� �������� [ ID: <b>'.$item[0].'<b> | NAME: <b>'.$item[1].'</b> ] �������� �� '.intval($_POST['newitprice']);
			}
			//echo 'test2';
		}
	}
}
if($_GET['look']==1){
if($_POST['delete']){
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `custom_rec` WHERE `id`='".$_POST['delete']."' LIMIT 1;");
}
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=10%><b>ID</b><br><font class=travma style="color: gray; font-size: 9px;">�� ������� � ����</font></td>
			<td align=center width=50%><b>��� ��������</b><br><font class=travma style="color: gray; font-size: 9px;">������� ������� �������</font></td>
			<td align=center width=10%><b>ID ��������</b><br><font class=travma style="color: gray; font-size: 9px;">�� �������� � ����</font></td>
			<td align=center width=20%><b>��������</b><br><font class=travma style="color: gray; font-size: 9px;">�������� (����������)</font></td>
			<td align=center width=10%><b>����������</b><br><font class=travma style="color: gray; font-size: 9px;">������� ����� �������</font></td>
			<td align=center width=10%><b>�����</b><br><font class=travma style="color: gray; font-size: 9px;">����������� ��� ��������</font></td>
			<td align=center width=10%><b>����</b><br><font class=travma style="color: gray; font-size: 9px;">���� �������</font></td>
			<td align=center width=10%><b>��������</b><br><font class=travma style="color: gray; font-size: 9px;">������������� ��� �������</font></td>
		</tr>
		
		';
	$recipes=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `custom_rec`");
	while ($row = mysqli_fetch_assoc($recipes)){
			$reg=explode("|",$row['reagents']);			
			echo '<tr class=nickname bgcolor=white>
			<td align=center>'.$row['id'].'</td>
			<td align=center>'.$row['name'].'</td>
			<td align=center>'.$row['protype'].'</td>
			<td align=center>';
			$itm="";
			foreach ($reg as $val){
				$reagent=explode("@",$val);
				$regit=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`price` FROM `items` WHERE `items`.`id`='".$reagent[0]."';"));
				echo "<b>".$regit['name']."</b> (".$reagent[1].")<br>";
				$itm.=$reagent[0]."@".$regit['name']."@".$regit['price']."@".$reagent[1]."|";
			}
			$itm=substr($itm,0,strlen($itm)-1);
			echo'</td>
			<td align=center>'.$row['col'].'</td>
			<td align=center>'.$row['nav'].'</td>
			<td align=center>'.$row['price'].'</td>	
			<td align=center>
			<form action="custom_rec.php?create=1&items='.$itm.'" method="post">
			<input type=hidden name=itemr value="'.$row['protype'].'">
			<input type=hidden name=colr value="'.$row['col'].'">
			<input type=hidden name=pricer value="'.$row['price'].'">
			<input type=hidden name=navr value="'.$row['nav'].'">
			<input type="submit" class="lbut" value="�������������" />
			</form>
			<form action="custom_rec.php?look=1" method="post">
			<input type=hidden name=delete value="'.$row['id'].'">
			<input type="submit" class="lbut" value="�������" />
			</form>
			</td>				
			';

	}
	echo'</table></td></tr></table>';	
}
if($_GET['look']==2){
require_once($_SERVER["DOCUMENT_ROOT"]."/func/sql_func.php");
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=10%><b>�����</b><br><font class=travma style="color: gray; font-size: 9px;">���</font></td>
			<td align=center width=50%><b>����� �������</b><br><font class=travma style="color: gray; font-size: 9px;">� ������</font></td>
			<td align=center width=50%><b>�������</b><br><font class=travma style="color: gray; font-size: 9px;">(�� ��������)</font></td>
		</tr>
		
		';
	$players=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `custom_rec`>'1'");
	while ($row = mysqli_fetch_assoc($players)){
			$pt=allparam($row);
			echo '<tr class=nickname bgcolor=white>
			<td align=center>'.$row['login'].'</td>
			<td align=center>�������: '.$row['alhim'].' ('.$pt[68].' � ������)<br>������������: '.$row['trav'].' ('.$pt[70].' � ������)</td><td>';
			$rec=explode("|",$row['alhim_rec']);
			foreach ($rec as $val){
				$recipe = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `custom_rec`.`name` FROM `custom_rec` WHERE `id`='".$val."' LIMIT 1;"));
				if($recipe!=""){
					echo $recipe['name']."<br>";
				}
			}
			echo "</td>";

	}
	echo'</table></td></tr></table>';	
}
echo'
</body>
</html>';

?>
