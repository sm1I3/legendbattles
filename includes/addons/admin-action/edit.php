<?php
$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items`"));

$GetItems = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='".preg_replace('/[^w0-9]/','',$_GET["wca"])."'");

echo'<table cellpadding="3" cellspacing="2" border="0" align="center" width="760">
  <tr>
    <td align="center"><a href="?useaction=admin-action&addid=edit&wca=w4"><img src="http://img.legendbattles.ru/image/gameplay/shop/knife.gif" width="44" height="53" title="����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w1"><img src="http://img.legendbattles.ru/image/gameplay/shop/sword.gif" width="41" height="53" title="����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w2"><img src="http://img.legendbattles.ru/image/gameplay/shop/axe.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w3"><img src="http://img.legendbattles.ru/image/gameplay/shop/crushing.gif" width="41" height="53" title="��������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w6"><img src="http://img.legendbattles.ru/image/gameplay/shop/spears_helbeards.gif" width="41" height="53" title="�������� � �����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w7"><img src="http://img.legendbattles.ru/image/gameplay/shop/wand.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w20"><img src="http://img.legendbattles.ru/image/gameplay/shop/shield.gif" width="41" height="53" title="����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w18"><img src="http://img.legendbattles.ru/image/gameplay/shop/armor_light.gif" width="41" height="53" title="��������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w19"><img src="http://img.legendbattles.ru/image/gameplay/shop/armor_hard.gif" width="41" height="53" title="�������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w23"><img src="http://img.legendbattles.ru/image/gameplay/shop/helm.gif" width="41" height="53" title="�����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w21"><img src="http://img.legendbattles.ru/image/gameplay/shop/boots.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w26"><img src="http://img.legendbattles.ru/image/gameplay/shop/belt.gif" width="44" height="53" title="�����" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w24"><img src="http://img.legendbattles.ru/image/gameplay/shop/gloves.gif" width="41" height="53" title="��������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w80"><img src="http://img.legendbattles.ru/image/gameplay/shop/armlet.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w25"><img src="http://img.legendbattles.ru/image/gameplay/shop/amulet.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w22"><img src="http://img.legendbattles.ru/image/gameplay/shop/ring.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w28"><img src="http://img.legendbattles.ru/image/gameplay/shop/spaudler.gif" width="41" height="53" title="����������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w90"><img src="http://img.legendbattles.ru/image/gameplay/shop/knee_guard.gif" width="41" height="53" title="������" class="cath" border="0" /></a><a href="?useaction=admin-action&addid=edit&wca=w0"><img src="http://img.legendbattles.ru/image/gameplay/shop/zel.gif" width="41" height="53" title="�����" class="cath" border="0" /></a></td>
  </tr>
  <tr>
    <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td bgcolor="#e0e0e0"><table cellpadding="3" cellspacing="1" border="0" width="100%">
		  <tr>
		    <td colspan="2" bgcolor="#F9f9f9"><table cellpadding="3" cellspacing="2" border="0" width="100%">
		     <tr>
               <td bgcolor="#F9f9f9" width="50%"><div align="center"><font class="inv"><a href="">�������� ���� ����</a></font></div></td>
		       <td bgcolor="#F9f9f9" width="50%"><div align="center"><font class="inv"><a href="">�������� �������� �����</a></font></div></td>
			 </tr>
			</table></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#F9f9f9"><div align="center"><font class="inv"><a href="�������� ����"> � ���� ������� <b>'.mysqli_num_rows($GetItems).'</b> �� <b>'.$count.'</b> �����.</font></div></td>
          </tr>';
		  while($row = mysqli_fetch_assoc($GetItems)){
			  $par=explode("|",$row['param']);
			  $need=explode("|",$row['need']);
			  $bt=0;$tr_b='';$m=1;
			  foreach ($need as $value) {
				  $treb=explode("@",$value);
				  if($treb[0]==72)$treb[1]=$row['level'];
				  if($treb[0]==71){
					  $treb[1]=$row['massa'];
					  $plstt[71]=$mass-$freemass;
				  }
				  
switch($treb[0])
{
case 28: $tr_b.="&nbsp;&nbsp;���� ��������: <b>$treb[1]</b><br>";break;
case 30: $tr_b.="&nbsp;&nbsp;����: <b>$treb[1]</b><br>";break;
case 31: $tr_b.="&nbsp;&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 32: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
case 33: $tr_b.="&nbsp;&nbsp;��������: <b>$treb[1]</b><br>";break;
case 34: $tr_b.="&nbsp;&nbsp;�����: <b>$treb[1]</b><br>";break;
case 35: $tr_b.="&nbsp;&nbsp;��������: <b>$treb[1]</b><br>";break;
case 36: $tr_b.="&nbsp;&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
case 37: $tr_b.="&nbsp;&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
case 38: $tr_b.="&nbsp;&nbsp;�������� �������� �������: <b>$treb[1]</b><br>";break;
case 39: $tr_b.="&nbsp;&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
case 40: $tr_b.="&nbsp;&nbsp;�������� ����������� �������: <b>$treb[1]</b><br>";break;
case 41: $tr_b.="&nbsp;&nbsp;�������� ���������� � �������: <b>$treb[1]</b><br>";break;
case 42: $tr_b.="&nbsp;&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
case 43: $tr_b.="&nbsp;&nbsp;�������� ������������ �������: <b>$treb[1]</b><br>";break;
case 44: $tr_b.="&nbsp;&nbsp;�������� ��������� �������: <b>$treb[1]</b><br>";break;
case 45: $tr_b.="&nbsp;&nbsp;����� ����: <b>$treb[1]</b><br>";break;
case 46: $tr_b.="&nbsp;&nbsp;����� ����: <b>$treb[1]</b><br>";break;
case 47: $tr_b.="&nbsp;&nbsp;����� �������: <b>$treb[1]</b><br>";break;
case 48: $tr_b.="&nbsp;&nbsp;����� �����: <b>$treb[1]</b><br>";break;
case 53: $tr_b.="&nbsp;&nbsp;���������: <b>$treb[1]</b><br>";break;
case 54: $tr_b.="&nbsp;&nbsp;������������: <b>$treb[1]</b><br>";break;
case 55: $tr_b.="&nbsp;&nbsp;����������: <b>$treb[1]</b><br>";break;
case 56: $tr_b.="&nbsp;&nbsp;����������������: <b>$treb[1]</b><br>";break;
case 57: $tr_b.="&nbsp;&nbsp;��������: <b>$treb[1]</b><br>";break;
case 58: $tr_b.="&nbsp;&nbsp;��������: <b>$treb[1]</b><br>";break;
case 59: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
case 60: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
case 61: $tr_b.="&nbsp;&nbsp;��������� ����: <b>$treb[1]</b><br>";break;
case 62: $tr_b.="&nbsp;&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 63: $tr_b.="&nbsp;&nbsp;���������: <b>$treb[1]</b><br>";break;
case 64: $tr_b.="&nbsp;&nbsp;������: <b>$treb[1]</b><br>";break;
case 65: $tr_b.="&nbsp;&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 66: $tr_b.="&nbsp;&nbsp;������� �������������� ����: <b>$treb[1]</b><br>";break;
case 67: $tr_b.="&nbsp;&nbsp;���������: <b>$treb[1]</b><br>";break;
case 68: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
case 69: $tr_b.="&nbsp;&nbsp;�������� ������� ����: <b>$treb[1]</b><br>";break;
case 70: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
case 71: $tr_b.="&nbsp;&nbsp;�����: <b>$treb[1]</b><br>";break;
case 72: $tr_b.="&nbsp;&nbsp;�������: <b>$treb[1]</b><br>";break;
}
}

echo'  <tr>
    <td bgcolor="#f9f9f9"><div align="center"><img src="http://img.legendbattles.ru/image/weapon/'.$row['gif'].'" border="0" /><br />
      <img src="http://img.legendbattles.ru/image/1x1.gif" width="62" height="1" /></td>
    <td width="100%" bgcolor="#ffffff" valign="top"><table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td bgcolor="#ffffff" width="100%"><font class=nickname><b> '.$row['name'].' </b></font><br />
          <img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3" /></td>
        <td><br />
          <img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3&lt;/td" /></td>
      </tr>
      <tr>
        <td colspan="2" width="100%"><table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr>
            <td bgcolor="#D8CDAF" width="50%"><div align="center"><font class=invtitle>��������</font></div></td>
            <td bgcolor="#B9A05C"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="1" /></td>
            <td bgcolor="#D8CDAF" width="50%"><div align="center"><font class=invtitle>����������</font></div></td>
          </tr>
          <tr>
            <td bgcolor="#FCFAF3"><font class=weaponch>'.(($row['slot']==16)?'&nbsp;<b><font color=#cc0000>����� ������� �� ��������</font></b><br>':'').blocks($row['block']).'&nbsp;����: <b>'.$row['price'].' RB'.(($row['dprice'])?' | '.$row['dprice'].' HR':'').'</b><br />';
foreach ($par as $value) {
$stat=explode("@",$value);
if($stat[1]>0){$plus = "+";}else{$plus ="";}
switch($stat[0])
{
case 0: echo "&nbsp;����������: <b>$stat[1]</b><br>"; break;
case 1: echo "&nbsp;����: <b>$stat[1]</b><br>";break;
case 2: echo "&nbsp;�������������: <b>$stat[1]/$stat[1]</b><br>";break;
case 3: echo "&nbsp;��������: <b>$stat[1]</b><br>";break;
case 4: echo "&nbsp;��������: <b>$stat[1]</b><br>";break;
case 5: echo "&nbsp;������: $plus<b>$stat[1]%</b><br>";break;
case 6: echo "&nbsp;��������: $plus<b>$stat[1]%</b><br>";break;
case 7: echo "&nbsp;����������: $plus<b>$stat[1]%</b><br>";break;
case 8: echo "&nbsp;���������: $plus<b>$stat[1]%</b><br>";break;
case 9: echo "&nbsp;����� �����: <b>$stat[1]</b><br>";break;
case 10: echo "&nbsp;������ �����: $plus<b>$stat[1]%</b><br>";break;
case 11: echo "&nbsp;������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 12: echo "&nbsp;������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 13: echo "&nbsp;������ ����������� ������: $plus<b>$stat[1]%</b><br>";break;
case 14: echo "&nbsp;������ ����������� ������: $plus<b>$stat[1]%</b><br>";break;
case 15: echo "&nbsp;������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 16: echo "&nbsp;������ �������� ������: $plus<b>$stat[1]%</b><br>";break;
case 17: echo "&nbsp;������ ���������� ������: $plus<b>$stat[1]%</b><br>";break;
case 18: echo "&nbsp;������ �������� ������: $plus<b>$stat[1]%</b><br>";break;
case 19: echo "&nbsp;������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 20: echo "&nbsp;������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 21: echo "&nbsp;������ �� ����������� ������: $plus<b>$stat[1]</b><br>";break;
case 22: echo "&nbsp;������ �� ����������� ������: $plus<b>$stat[1]</b><br>";break;
case 23: echo "&nbsp;������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 24: echo "&nbsp;������ �� �������� ������: $plus<b>$stat[1]</b><br>";break;
case 25: echo "&nbsp;������ �� ���������� ������: $plus<b>$stat[1]</b><br>";break;
case 26: echo "&nbsp;������ �� �������� ������: $plus<b>$stat[1]</b><br>";break;
case 27: echo "&nbsp;��: $plus<b>$stat[1]</b><br>";break;
case 28: echo "&nbsp;���� ��������: $plus<b>$stat[1]</b><br>";break;
case 29: echo "&nbsp;����: $plus<b>$stat[1]</b><br>";break;
case 30: echo "&nbsp;����: $plus<b>$stat[1]</b><br>";break;
case 31: echo "&nbsp;�����������: $plus<b>$stat[1]</b><br>";break;
case 32: echo "&nbsp;�������: $plus<b>$stat[1]</b><br>";break;
case 33: echo "&nbsp;��������: $plus<b>$stat[1]</b><br>";break;
case 34: echo "&nbsp;�����: $plus<b>$stat[1]</b><br>";break;
case 35: echo "&nbsp;��������: $plus<b>$stat[1]</b><br>";break;
case 36: echo "&nbsp;�������� ������: $plus<b>$stat[1]%</b><br>";break;
case 37: echo "&nbsp;�������� ��������: $plus<b>$stat[1]%</b><br>";break;
case 38: echo "&nbsp;�������� �������� �������: $plus<b>$stat[1]%</b><br>";break;
case 39: echo "&nbsp;�������� ������: $plus<b>$stat[1]%</b><br>";break;
case 40: echo "&nbsp;�������� ����������� �������: $plus<b>$stat[1]%</b><br>";break;
case 41: echo "&nbsp;�������� ���������� � �������: $plus<b>$stat[1]%</b><br>";break;
case 42: echo "&nbsp;�������� ��������: $plus<b>$stat[1]%</b><br>";break;
case 43: echo "&nbsp;�������� ������������ �������: $plus<b>$stat[1]%</b><br>";break;
case 44: echo "&nbsp;�������� ��������� �������: $plus<b>$stat[1]%</b><br>";break;
case 45: echo "&nbsp;����� ����: $plus<b>$stat[1]%</b><br>";break;
case 46: echo "&nbsp;����� ����: $plus<b>$stat[1]%</b><br>";break;
case 47: echo "&nbsp;����� �������: $plus<b>$stat[1]%</b><br>";break;
case 48: echo "&nbsp;����� �����: $plus<b>$stat[1]%</b><br>";break;
case 49: echo "&nbsp;������������� ����� ����: $plus<b>$stat[1]%</b><br>";break;
case 50: echo "&nbsp;������������� ����� ����: $plus<b>$stat[1]%</b><br>";break;
case 51: echo "&nbsp;������������� ����� �������: $plus<b>$stat[1]%</b><br>";break;
case 52: echo "&nbsp;������������� ����� �����: $plus<b>$stat[1]%</b><br>";break;
case 53: echo "&nbsp;���������: $plus<b>$stat[1]%</b><br>";break;
case 54: echo "&nbsp;������������: $plus<b>$stat[1]%</b><br>";break;
case 55: echo "&nbsp;����������: $plus<b>$stat[1]%</b><br>";break;
case 56: echo "&nbsp;����������������: $plus<b>$stat[1]%</b><br>";break;
case 57: echo "&nbsp;��������: $plus<b>$stat[1]%</b><br>";break;
case 58: echo "&nbsp;��������: $plus<b>$stat[1]%</b><br>";break;
case 59: echo "&nbsp;�������: $plus<b>$stat[1]%</b><br>";break;
case 60: echo "&nbsp;�������: $plus<b>$stat[1]%</b><br>";break;
case 61: echo "&nbsp;��������� ����: $plus<b>$stat[1]%</b><br>";break;
case 62: echo "&nbsp;�����������: $plus<b>$stat[1]%</b><br>";break;
case 63: echo "&nbsp;���������: $plus<b>$stat[1]%</b><br>";break;
case 64: echo "&nbsp;������: $plus<b>$stat[1]%</b><br>";break;
case 65: echo "&nbsp;�����������: $plus<b>$stat[1]%</b><br>";break;
case 66: echo "&nbsp;������� �������������� ����: $plus<b>$stat[1]%</b><br>";break;
case 67: echo "&nbsp;���������: $plus<b>$stat[1]%</b><br>";break;
case 68: echo "&nbsp;�������: $plus<b>$stat[1]%</b><br>";break;
case 69: echo "&nbsp;�������� ������� ����: $plus<b>$stat[1]%</b><br>";break;
case 70: echo "&nbsp;�������: $plus<b>$stat[1]%</b><br>";break;
}
}
			echo'</font></td>
            <td bgcolor="#B9A05C"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="1" /></td>
            <td bgcolor="#FCFAF3"><font class=weaponch>'.$tr_b.'</font></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>';
		  }
        echo'</table></td>
      </tr>
    </table></td>
  </tr>
</table>';
function blocks($bl){
	if($bl!=""){
		switch($bl){
			case 40:
				return"&nbsp;<b><font color=#cc0000>���������� 1-�� �����</font></b><br>";
			break;
			case 70:
				return"&nbsp;<b><font color=#cc0000>���������� 2-� �����</font></b><br>";
			break;
			case 90:
				return"&nbsp;<b><font color=#cc0000>���������� 3-� �����</font></b><br>";
			break;
		}
	}
}
?>