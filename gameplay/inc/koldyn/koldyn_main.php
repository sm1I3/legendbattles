<?php
//1 - ������� ��������
//2 - ������� ������� ������� ������������� ������ ������
//3 - ������ �� ��������� �����, �������� � ���������� �������� ������� ����� ����������
//4 - ����� ���������� ������������ ��������
//5 - ������� ��� ��������� ���������� ���������
//5.1 - ������ ���������� �������� �� �� (���, ��������)
//5.2 - ������ � �� �� ���������� ������ ��������� � ������
//5.3 - ����� ������ � ���� ������� ��� ������������
//6 - ��������� ���� �� � ������ �����-�� ������� ������, �������� ���������� ��� ����� ������� ������
//6.1 - ���� �� �������� ������ ���� �� � ���� ����� ������, ���� ��� - ������ "������", ���� �� - ������ "�������"
//7 - �������� �����

if($_GET['buy']==1 and intval($_POST['rid'])!=""){include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/koldyn/koldyn_buy".".php");}
if($_GET['create']==1 and intval($_POST['rid'])!=""){include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/koldyn/koldyn_create".".php");}
$player = player();	
$pt=allparam($player);
echo'
<font class=proce><font color=#222222>
<FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;��������� �������&nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=50% colspan=2><b>������</b></td>
			<td align=center width=50%><b>��������</b></td>	
		</tr>';

	$recipes = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `koldyn` WHERE `nav`<='".$pt[75]."' ORDER BY `nav`"); //2 - ������� ������� ������� ������������� ������ ������
	$grassit = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE (`type`='w66' OR `type`='w69' OR `type`='70') AND `slot`='0';");
	while ($grow = mysqli_fetch_assoc($grassit)){
		$plcol[$grow['id']] = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.`id_item`,`invent`.`bank` FROM `invent` WHERE `protype`='".$grow['id']."' AND `pl_id`='".$player['id']."' AND `bank`='0';"));
	}
	while ($row = mysqli_fetch_assoc($recipes)){
			$rec_inf = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`gif`,`items`.`param` FROM `items` WHERE `items`.`id`='".$row['protype']."' LIMIT 1;"));  //3 - ������ �� ��������� �����, �������� � ���������� �������� ������� ����� ����������
			$rec_inf['dolg']="";
			$par=explode("|",$rec_inf['param']);
			foreach($par as $value){$param=explode("@",$value);switch($param[0]){case 2: $rec_inf['dolg']=$param[1];break;}} 
			$reg = explode("|",$row['reagents']);	
			//4 - ����� ���������� ������������ ��������
			echo '
			<tr class=nickname bgcolor=white>
			<td align=center rowspan=2>
				<img src="http://img.legendbattles.ru/image/weapon/'.$rec_inf['gif'].'" onmouseover="tooltip(this,\'<b>'.$rec_inf['name'].'</b><br><b><font color=#336699>�������� �� ����������� ��� ��������� ��������� ���������� � ��������.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://www.legendbattles.ru/iteminfo.php?'.$rec_inf['name'].'\');" style="cursor:pointer;" align=absmiddle>
			</td>
			<td align=center rowspan=2>
				<b>'.$rec_inf['name'].'</b><br>�������������: '.$rec_inf['dolg'].'/'.$rec_inf['dolg'].'<br>���������� ����������� �������: <b>'.$row['col'].'</b> ��.
			</td>
			<td align=center>';
			$i=0;
			foreach ($reg as $val){			 
				//5
				$i++;
				$reagent=explode("@",$val);				
				$regit = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`gif` FROM `items` WHERE `items`.`id`='".$reagent[0]."' LIMIT 1;")); //5.1				
				echo '<img src="http://img.legendbattles.ru/image/weapon/'.$regit['gif'].'" width="35" height="35" onmouseover="tooltip(this,\'<b>'.$regit['name'].'</b><br>���������� ��� ��������: <b>'.$reagent[1].'</b><br>� �������: <b>'.(($plcol[$reagent[0]]<$reagent[1])?'<font color=red>'.$plcol[$reagent[0]].'</font>':'<font color=green>'.$plcol[$reagent[0]].'</font>').'</b><br><b><font color=#336699>�������� �� ����������� ��� ��������� ��������� ���������� � ��������.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://www.legendbattles.ru/iteminfo.php?'.$regit['name'].'\');" style="cursor:pointer;">&nbsp;&nbsp;';//5.3
				if($i==7){echo "<br>";$i=0;}
			}
			if($player['koldyn_rec']=="0"){$koldyn_rec="||||";}else{$koldyn_rec=explode("|",$player['koldyn_rec']);}
			echo'</td></tr>
			<tr class=nickname bgcolor=white><td align=center>
			'.((in_array($row['id'],$koldyn_rec))
			?
			'<form method=post action="main.php?hospi_sel=6&create=1"><input type="submit" class="lbut" value="�������" /><input type=hidden name=rid value="'.$row['id'].'"/></form>'
			:
			'<form method=post action="main.php?hospi_sel=6&buy=1"><button type="submit">������ ������ [ '.lr($row['price']).' ]</button><input type=hidden name=rid value="'.$row['id'].'"/></form>').'
			</td>
			</tr>
			';//6.1
	}
	echo'</table></td></tr></table></FIELDSET>';
	//===================================================
?>