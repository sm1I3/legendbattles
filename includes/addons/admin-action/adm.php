<? 
session_start();
session_register('filter');
$sign = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"select `sign` from `user` where `login`='�������������' LIMIT 1;"));
?>
<HTML>
<HEAD>
<LINK href="/css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>

<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td align=center><input type="button" class="lbut" onClick="location='../../../main.php'" value="���������"></td></tr>
  <tr>
    <td align=center>
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=1'" value="������������ ���������" />
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=4'" value="�������� ���������" />
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=2'" value="���������� � �������" />
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=3'" value="�����" />
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=99'" value="�������� ����� ����������" />
		<input type="button" class="lbut" onclick="location='adm.php?id_adm=7'" value="���� IP" />
	</td>
	</tr>
<tr>	
	<td align=center>
	<input type="button" class="lbut" onclick="location='player_items.php'" value="�������� �����" />
	<input type="button" class="lbut" onclick="location='clan_items.php'" value="������ � �������" />
	<input type="button" class="lbut" onclick="location='tz.php'" value="�� �������" />
	<input type="button" class="lbut" onclick="location='errors.php'" value=" ��������� �� �������" />
	<input type="button" class="lbut" onclick="location='alhim.php'" value="�������� ������������ ��������" />
	<input type="button" class="lbut" onclick="location='custom_rec.php'" value="�������� ������ ��������" />
	<input type="button" class="lbut" onclick="location='bot_drop.php'" value="���� �����" />
	<input type="button" class="lbut" onclick="location='accounts.php'" value="��������" />
	<input type="button" class="lbut" onclick="location='presents.php'" value="�������" />	
	<input type="button" class="lbut" onclick="location='player.php'" value="���������" />	
	<input type="button" class="lbut" onclick="location='labyrinth.php'" value="��������" />
</td>
</tr>
<tr>	
<td align=center>
	<input type="button" class="lbut" onclick="location='ref_system.php'" value="���������" />	
	<input type="button" class="lbut" onclick="location='bot_edit.php'" value="����" />	
	<input type="button" class="lbut" onclick="location='system_messages.php'" value="��������" />
	<input type="button" class="lbut" onclick="location='real_dd_adm.php'" value="������� ������ � ��" />	
	<input type="button" class="lbut" onclick="location='player-actions.php'" value="���� ����������" />
	<input type="button" class="lbut" onclick="location='chests2.php'" value="������� ����" />
	<input type="button" class="lbut" onclick="location='chests.php'" value="C������" />
    <input type="button" class="lbut" onclick="location='curs.php'" value="�����" />
    <input type="button" class="lbut" onclick="location='koldyn.php'" value="������" />	
	<input type="button" class="lbut" onclick="location='tavern.php'" value="�������" />
	<input type="button" class="lbut" onclick="location='panel.php'" value="���� � ����" />
	<input type="button" class="lbut" onclick="location='online.php'" value="������" />
</td>
</tr>
</table>


<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
function varcheck($input){
	if(!is_array($input)){
		if(is_numeric($input))
		{

		#������� ��������� ��� �������, ���� �������� ������ 0
		#�������� ������������� �������� ����������
			$number = intval($input);
			//echo 'numeric';
			return $number;
		}
		else
		{
			#�������� html ����
			$out_string= strip_tags($input);
			#����������� ����������� ������� � HTML ��������.
			$out_string= htmlspecialchars($out_string);
			#���������� ����������� ������� � ������,��������� �� �������� ��������� ����������.
			$out_string= mysqli_real_escape_string($GLOBALS['db_link'],$out_string);
			return $out_string;

		}
	}else{
		foreach($input as $key=>$val){
			$out_string[$key] = varcheck($val);
		}
		return $out_string;
	}
}

db_open();

foreach($_POST as $keypost=>$valp){
	//$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
	$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
	//$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
	$$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
	$$keyses = $vals;
}
if($id_adm==7){
	if($banip){
		$check = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `blocklist` WHERE `ip`='".$banip."' LIMIT 1;"));
		if(!$check['id']){
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `blocklist` (`ip`) VALUES ('".$banip."');");
			echo '<font class=proce>IP: '.$banip.' ������������!</font>';
		}else{echo '<font class=proce>IP: '.$banip.' ��� ������������!</font>';}
	}
	elseif($unbanip){
		$check = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `blocklist` WHERE `ip`='".$unbanip."' LIMIT 1;"));
		if($check['id']){
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `blocklist` WHERE `ip`='".$unbanip."' LIMIT 1;");
			echo '<font class=proce>IP: '.$unbanip.' �������������!</font>';
		}else{echo '<font class=proce>IP: '.$unbanip.' �� ������!</font>';}
	}
	$allblocked = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `blocklist`");
	echo'<br>
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td align=center>
	<form action="adm.php?id_adm=7" method="post">
	<input name="banip" type="text" class="LogintextBox" /><input type=submit value=�������� class=lbut>
	</form><br>
	</td></tr>
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td align=center><b>��������������� ������</b></td></tr>
	';
	while($row = mysqli_fetch_array($allblocked)){
	 echo '<tr><td align=center>
		<form action="adm.php?id_adm=7" method="post">
		<input name="unbanip" type="hidden" value="'.$row['ip'].'" />
		'.$row['ip'].' <input type=submit value=��������� class=lbut>
		</form><br>
		</td></tr>';
	}
	echo'
	</table>
	';
} 
if($id_adm==99){?>
<form action="adm.php?id_adm=99" method="post">
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
	  <option value="w68">���</option>
	  <option value="w69">�������</option>
	  <option value="w70">����</option>
	  <option value="w60">������</option>
	  <option value="w29">������</option>
	  <option value="w71">����</option>
		<option value="w62">�������</option>
		<option value="w30">��������</option>
	  <option value="w100">������� ��� ������</option>
	  <option value="w16">�����</option>
     </select>  <input name="smb7" type="submit" class="lbut" value="��������� ������" /><? $filter2="WHERE master=''"; if($smb7){if($type==""){$filter="";$filter2="WHERE master=''";}else $filter="WHERE type='$type'";$filter2=" AND master=''";}?> 
    
      <select name="idit" >
      <option value=0<? if($idit==""){echo " selected=selected";}?>>�������� ���</option>
  <? $it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM items $filter $filter2 ORDER BY type,name,level;");
	  while ($row = mysqli_fetch_assoc($it)) {
		echo "<option value=$row[id]";if($idit==$row[id]){echo " selected=selected";}echo">$row[name] [ $row[level] ] [ $row[effect] ]</option>";
	  }
	  ?>
  </select> <input type=text class="LoginText" name="forlogin">
  <input name="giveitem" type="submit" class="lbut" value="��������" />
</form>
<form action="adm.php?id_adm=99" method="post">
	<select name="type" >
	<option value="1" selected="selected">�������</option>
	<option value="2">������</option>
	<option value="3">�����</option>
	<option value="4">�����</option>
	<option value="5">����</option>
	<option value="6">�����</option>
	<option value="7">��� �����</option>
	</select>
	<input type=text class="LoginText" name="forlogin">
	<input name="giveall" type="submit" class="lbut" value="��������" />
</form>

<? 
if($giveall and $forlogin!=''){
	switch($type){
		case 1: $where="pl_id='9'";break;
		case 2: $where="pl_id='10'";break;
		case 3: $where="pl_id='17'";break;
		case 4: $where="pl_id='99'";break;
		case 5: $where="pl_id='6666'";break;
		case 6: $where="pl_id='91'";break;
		case 7: $where="pl_id='13876370'";break;
	}
	$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM invent WHERE ".$where." AND used='1';");
	$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE login='".$forlogin."';"));
	if($pl['id']){
		while($row = mysqli_fetch_array($it)){
			echo $row['protype']."<br>";
			mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (protype,pl_id,dolg,price,dd_price) VALUES ('".$row['protype']."','".$pl['id']."','".$row[dolg]."','".$row[price]."','".$row[dd_price]."');");
		}
	}
}
if($giveitem and $forlogin!=''){
	$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM items WHERE id='$idit';"));
	$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE login='$forlogin';"));
	if($it[dd_price]>0){$pr=$it[dd_price];$filt="dd_price";}
	else{$pr=$it[price];$filt="price";}
	$par=explode("|",$it[param]);
	foreach ($par as $value) {
		$stat=explode("@",$value);
		switch($stat[0]){case 2: $dolg=$stat[1];break;}
	}
	mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (protype,pl_id,dolg,$filt) VALUES ('".$it['id']."','".$pl['id']."','".$dolg."','".$pr."');");
}


}  if($id_adm==1){?>
<br>
<form name="additem" method="post" action="adm.php?id_adm=1">
<table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
<tr>
  <td valign="top" bgcolor="#f9f9f9"><div id="img"></div>
        <input type="text" name="gif" value="�������� ��������" onClick="this.value='';">

        </select></td>
  <td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname>
    <select name="type" >
      <option value="w4" selected="selected">����</option>
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
      <option value="w90">�����������</option>
	  <option value="w29">������</option>
	  <option value="w30">��������</option>
	  <option value="w61">��������</option>
      <option value="w0">��������</option>
	  <option value="w66">�����</option>
	  <option value="w67">�����</option>
	  <option value="w68">���</option>
	  <option value="w69">�������</option>
	  <option value="w70">����</option>
	  <option value="w60">������</option>
	  <option value="w71">����</option>
		<option value="w62">�������</option>
	  <option value="w100">������� ��� ������</option>
	  <option value="w16">�����</option>
    </select>
    <input name="name" type="text" value="��������" />
        <select name="block" >
      <option value="0" selected="selected">�� ���</option>
      <option value="40">1 �����</option>
      <option value="70">2 �����</option>
      <option value="90">3 �����</option>
    </select>
    <select name="num_a" >
      <option value="0" selected="selected">�� ������/�������</option>
      <option value="32">+HP/��������/�����/���������</option>
      <option value="33">+MP/�����</option>
	  <option value="1">����</option>
	  <option value="2">�����������</option>
	  <option value="3">�������</option>
	  <option value="4">��������</option>
	  <option value="5">�����</option>
	  <option value="6">��������</option>
	  <option value="7">����</option>
	  <option value="8">�����</option>
	  <option value="9">������ �����</option>
	  <option value="10">������</option>
	  <option value="11">��������</option>
	  <option value="12">����������</option>
	  <option value="13">���������</option>
	  <option value="14">��� �����</option>
	  <option value="15">����������������</option>
	  <option value="34">�������� ��� ����</option>
    </select>
      <select name="acte" >
      <option value="" selected="selected">�� ������/�������</option>
      <option value="magicreform">����� ��/��</option>
	  <option value="zelreform">�������</option>
      <option value="fightmagicform">���������</option>
      <option value="chatsleepform">��������</option>
	  <option value="licensform">�������� ��������</option>
	  <option value="licensform2">�������� �������</option>
	  <option value="doktorreform">������ �������</option>
	  <option value="zelinvis">�����������</option>
	  <option value="BotNapForm">��������</option>
	  <option value="ObnulForm">���������</option>
	  <option value="MaseForm">����</option>
	  <option value="teleport">��������</option>
	  <option value="teleport2">�������� (� �����������)</option>
    </select>
    <br />
<strong>������ ������</strong>
    ��
    <input name="wtor" type="radio" value="1" />
    ���
    <input name="wtor" type="radio" value="0" checked />
    &nbsp; ����: <select name="slot">
		  <option value="0">������ �����</option>
          <option value="1">����</option>
          <option value="2">��������</option>
          <option value="3">������</option>
          <option value="4">����</option>
          <option value="5">���������� �������� �����</option>
          <option value="8">���� ��� �����</option>
          <option value="9">������</option>
          <option value="10">����������</option>
          <option value="11">������</option>
          <option value="12">��������</option>
          <option value="13">���</option>
          <option value="14">������</option>
          <option value="16">�����</option>
          <option value="17">��������</option>
		  <option value="20">����</option>
        </select> ������: <input name="effect" type="text" />
    <br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td><td><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td width=50% bgcolor=#D8CDAF><div align=center><font class=invtitle>��������</div></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>����������</div></td></tr><tr><td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>����</label>
              <input name="price" type="text" value="1" />&nbsp;<label>���� ��</label>&nbsp;<input name="dd_price" type="text" value="0" /><br>
			  ---------------------------------------------------------------<br>
			  &nbsp;<label>�������������� ���� (������ ���� ������ ���, ������ 20-30)</label><br>
			  <select name="damage_mod">
				  <option value="0">��� ����</option>
				  <option value="1">���� �����</option>
				  <option value="2">���� �����</option>
				  <option value="3">���������</option>
				  <option value="4">�������</option>
			  </select>
              &nbsp;<input name="damage_mod_val" type="text" value="" /><br>
			  ---------------------------------------------------------------<br>
			  &nbsp;<label>��������� � ����</label>
			  <select name="fire_immune">
				  <option value="0">���</option>
				  <option value="1">��</option>
			  </select><br>
			  &nbsp;<label>��������� �� ����</label>
			  <select name="ice_immune">
				  <option value="0">���</option>
				  <option value="1">��</option>
			  </select><br>
			  &nbsp;<label>��������� � ����������</label>
			  <select name="vamp_immune">
				  <option value="0">���</option>
				  <option value="1">��</option>
			  </select><br>
			  &nbsp;<label>��������� � ���</label>
			  <select name="poison_immune">
				  <option value="0">���</option>
				  <option value="1">��</option>
			  </select><br>
			  &nbsp;<label>��������� � ���.�����</label>
			  <select name="phys_immune">
				  <option value="0">���</option>
				  <option value="1">��</option>
			  </select><br>
			  ---------------------------------------------------------------<br>
                        <?
		  ?>
              
              </td>
            <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3"><font class=weaponch><b><label>�������:</label>
              <input name="level" type="text" value="" /><br><font class=weaponch><b><label>�����:</label>
              <input name="massa" type="text" value="" /><br>
			  <font class=weaponch><b><label>���� �������� ���� (� ����)<i>0 - ��� �����</i>:</label>
              <input name="srok" type="text" value="" /><br>
			  <?
        for($i=0;$i<=71;$i++){
      switch($i)
{
case 1: $fr="���� (������ 20-30):";break;
case 2: $fr="�������������:";break;
case 3: $fr="��������(3 max ��� ������):";break;
case 4: $fr="��������:";break;
case 5: $fr="������:";break;
case 6: $fr="��������:";break;
case 7: $fr="����������:";break;
case 8: $fr="���������:";break;
case 9: $fr="����� �����:";break;
case 10: $fr="������ �����:";break;
case 11: $fr="������ ������� ������:";break;
case 12: $fr="������ ������� ������:";break;
case 13: $fr="������ ����������� ������:";break;
case 14: $fr="������ ����������� ������:";break;
case 15: $fr="������ ������� ������:";break;
case 16: $fr="������ �������� ������:";break;
case 17: $fr="������ ���������� ������:";break;
case 18: $fr="������ �������� ������:";break;
case 19: $fr="������ �� ������� ������:";break;
case 20: $fr="������ �� ������� ������:";break;
case 21: $fr="������ �� ����������� ������:";break;
case 22: $fr="������ �� ����������� ������:";break;
case 23: $fr="������ �� ������� ������:";break;
case 24: $fr="������ �� �������� ������:";break;
case 25: $fr="������ �� ���������� ������:";break;
case 26: $fr="������ �� �������� ������:";break;
case 27: $fr="��:";break;
case 28: $fr="���� ��������:";break;
case 29: $fr="����:";break;
case 30: $fr="����:";break;
case 31: $fr="�����������:";break;
case 32: $fr="�������:";break;
case 33: $fr="��������:";break;
case 34: $fr="�����:";break;
case 35: $fr="��������:";break;
case 36: $fr="����. ������:";break;
case 37: $fr="����. ��������:";break;
case 38: $fr="����. �������� �������:";break;
case 39: $fr="����. ������:";break;
case 40: $fr="����. ����������� �������:";break;
case 41: $fr="����. ���������� � �������:";break;
case 42: $fr="����. ��������:";break;
case 43: $fr="����. ������������ �������:";break;
case 44: $fr="����. ��������� �������:";break;
case 99: $fr="test���:";break;
case 46: $fr="����� ����:";break;
case 47: $fr="����� �������:";break;
case 48: $fr="����� �����:";break;
case 49: $fr="������������� ����� ����:";break;
case 50: $fr="������������� ����� ����:";break;
case 51: $fr="������������� ����� �������:";break;
case 52: $fr="������������� ����� �����:";break;
case 53: $fr="���������:";break;
case 54: $fr="������������:";break;
case 55: $fr="����������:";break;
case 56: $fr="����������������:";break;
case 57: $fr="��������:";break;
case 58: $fr="��������:";break;
case 59: $fr="�������:";break;
case 60: $fr="�������:";break;
case 61: $fr="��������� ����:";break;
case 62: $fr="�����������:";break;
case 63: $fr="���������:";break;
case 64: $fr="������:";break;
case 65: $fr="�����������:";break;
case 66: $fr="������� �������������� ����:";break;
case 67: $fr="���������:";break;
case 68: $fr="�������:";break;
case 69: $fr="�������� ������� ����:";break;
case 70: $fr="������������:";break;
case 71: $fr="�����������(new):";break;
}
if($fr!="")echo '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=pr['.$i.'] type=text value=""><br>';
}
//���� � �����
echo '<label><font class=weaponch><b>����� ����� (� %)</b></font></label><input name=pr[expbonus] type=text value=""><br>';
echo '<label><font class=weaponch><b>����� �����</b></font></label><input name=pr[massbonus] type=text value=""><br>';
		  ?>
              
              </td>
            <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3"><font class=weaponch><b><label>�������:</label>
              <input name="level" type="text" value="" /><br><font class=weaponch><b><label>�����:</label>
              <input name="massa" type="text" value="" /><br>
			  <font class=weaponch><b><label>���� �������� ���� (� ����)<i>0 - ��� �����</i>:</label>
              <input name="srok" type="text" value="" /><br>
			  <?
		  for($i=28;$i<=74;$i++){
          switch($i)
{
case 28: $fr="���� ��������:";break;
case 29: $fr="";break;
case 30: $fr="����:";break;
case 31: $fr="�����������:";break;
case 32: $fr="�������:";break;
case 33: $fr="��������:";break;
case 34: $fr="�����:";break;
case 35: $fr="��������:";break;
case 36: $fr="����. ������:";break;
case 37: $fr="����. ��������:";break;
case 38: $fr="����. �������� �������:";break;
case 39: $fr="����. ������:";break;
case 40: $fr="����. ����������� �������:";break;
case 41: $fr="����. ���������� � �������:";break;
case 42: $fr="����. ��������:";break;
case 43: $fr="����. ������������ �������:";break;
case 44: $fr="����. ��������� �������:";break;
case 45: $fr="����� ����:";break;
case 46: $fr="����� ����:";break;
case 47: $fr="����� �������:";break;
case 48: $fr="����� �����:";break;
case 49: $fr="";break;
case 50: $fr="";break;
case 51: $fr="";break;
case 52: $fr="";break;
case 53: $fr="���������:";break;
case 54: $fr="������������:";break;
case 55: $fr="����������:";break;
case 56: $fr="����������������:";break;
case 57: $fr="��������:";break;
case 58: $fr="��������:";break;
case 59: $fr="�������:";break;
case 60: $fr="�������:";break;
case 61: $fr="��������� ����:";break;
case 62: $fr="�����������:";break;
case 63: $fr="���������:";break;
case 64: $fr="������:";break;
case 65: $fr="�����������:";break;
case 66: $fr="������� �������������� ����:";break;
case 67: $fr="���������:";break;
case 68: $fr="�������:";break;
case 69: $fr="�������� ������� ����:";break;
case 70: $fr="������������:";break;
case 73: $fr="������:";break;
case 74: $fr="��������:";break;
}
if($fr!="")echo "<label><font class=weaponch><b>$fr</b></font></label><input name=tr[$i] type=text value=\"\"/><br>\n";
}
		  ?>

</td>
    </tr>
   </table></td></tr></table></td></tr>
</table>
  <div align="center">
    <input name="smb1" type="submit" class="lbut" value="���������" />
  </div>
</form>
<div align="center">
<p><br>
  <? }
  
  // ������� ����. ���������.
if($id_adm==2){?><br>
   </form>
<form name="addmark" method="post" action="adm.php?id_adm=2">
<select name="type1" >
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
	  <option value="w30">��������</option>
	  <option value="w66">�����</option>
	  <option value="w67">�����</option>
	  <option value="w68">���</option>
	  <option value="w69">�������</option>
	  <option value="w70">����</option>
	  <option value="w60">������</option>
	  <option value="w29">������</option>
	  <option value="w71">����</option>
	  <option value="w62">�������</option>
	  <option value="w100">������� ��� ������</option>
	  <option value="w16">�����</option>
     </select>  <input name="smb9" type="submit" class="lbut" value="��������� ������" />
	 <? $filter2="WHERE master=''"; if($smb9){if($type1==""){$filter="";$filter2="WHERE master=''";}else $filter="WHERE type='$type1'";$filter2=" AND master=''";}?> 
    
      <select name="id" >
      <option value=0<? if($id==""){echo " selected=selected";}?>>�������� ���</option>
  <? $it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM items $filter $filter2 ORDER BY type,level,name;");
	  while ($row = mysqli_fetch_assoc($it)) {
	  echo "<option value=$row[id]>$row[name] [ $row[level] ]</option>";
	  }
	  ?>
    </select><br><br>
<select name="type" >
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
	  <option value="w29">������</option>
	  <option value="w30">��������</option>
      <option value="w0">��������</option>
	  <option value="w66">�����</option>
	  <option value="w67">�����</option>
	  <option value="w68">���</option>
	  <option value="w69">�������</option>
	  <option value="w70">����</option>
	  <option value="w60">������</option>
	  <option value="w61">��������</option>
	  <option value="w71">����</option>
		<option value="w62">�������</option>
	  <option value="w100">������� ��� ������</option>
</select> <br><br>
<select name="pl" >
      <option value="2">����� ��������</option>
	  <option value="34">��� �������</option>
	  <option value="4">���������</option>
	  <option value="45">����� ����������</option>
	  <option value="48">���������� �������</option>
	  <option value="49">������� ��</option>
	  <option value="50">������� ������</option>
	  <option value="51">������� ��������</option>
	  <option value="112">���������� �����</option>
	  <option value="44">���</option>
	  <option value="111">�������</option>
		<option value="1203">�������</option>
		<option value="1002">�������(�����)</option>
		<option value="1223">�����������</option>
</select> <br><br>
<select name="pl_dd" >
      <option value="1">�������� �����</option>
	  <option value="2">�������� ��������</option>
	  <option value="9">�������� ������� ������</option>
	  <option value="103">�������� �������</option>
	  <option value="104">�������� �������</option>
	  <option value="99">�����</option>
</select> <br><br>

<input name="kol" type="text" value="10" size="7"/>
<input name="smb6" type="submit" class="lbut" value="��������" /><br />
</form>
  <? 
  if($smb6)
  {
	if($id!=0)
	{
		if ($type!='')
		{
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `market` WHERE `id` = '".$id."' AND `market` = '".$pl."';");
			$item=mysqli_query($GLOBALS['db_link'],'SELECT items.id, items.level, items.price, items.type FROM items WHERE items.id ='.AP.$id.AP.' ORDER BY level,price;');
			if($pl!='')
			{
				while ($r = mysqli_fetch_assoc($item))
				{
					if($pl==1203 and $pl_dd!=''){
						mysqli_query($GLOBALS['db_link'],"INSERT INTO `market` (`id`,`market`,`kol`,`ty`,`dilers`) VALUES ('".$id."','".$pl."','".$kol."','".$type."','".$pl_dd."');"); 
					}
					else{mysqli_query($GLOBALS['db_link'],"INSERT INTO `market` (`id`,`market`,`kol`,`ty`,`dilers`) VALUES ('".$id."','".$pl."','".$kol."','".$type."','0');");}
				}
			}
		}
	}
  }
}

   if($id_adm==3){?><br>
 <form name="addmark" method="post" action="adm.php?id_adm=3">
	<select name="id2" >
		<option value=0 selected="selected">��� ����</option>
		<? $it=mysqli_query($GLOBALS['db_link'],"SELECT market.id, items.name ,items.level FROM items INNER JOIN market ON items.id = market.id WHERE master='';");
			while ($row = mysqli_fetch_assoc($it)) {
			echo "<option value=$row[id]>$row[name] [ $row[level] ]</option>";
			}
		?>
	</select>
	<select name="pl" >
      <option value=0 selected="selected">��������</option>
	  <option value=2>����� ��������</option>
	  <option value=34>��� �������</option>
	  <option value=4>���������</option>
    </select>
   <input name="kl" type="text" value="���-��" size="7" />
   <input name="smb3" type="submit" class="lbut" value="���������" /><br />
   </form>
   <?
   if($smb3)
	{
	 if($id2==0)
	  {
	   mysqli_query($GLOBALS['db_link'],'UPDATE market SET kol='.AP.$kl.AP.' WHERE market='.AP.$pl.AP.';');
	  }
	  else
	  {

	   mysqli_query($GLOBALS['db_link'],'UPDATE market SET kol='.AP.$kl.AP.' WHERE market='.AP.$pl.AP.' and id='.AP.$id2.AP.';');
	  }
	echo "<br><span class=prchattime>������� ��������!</span></div>";
	}
///////////////////////////////////////////////////////////////////////  
	?>
	
  <? }
   if($id_adm==4){?>
<form action="adm.php?id_adm=4" method="post">
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
	  <option value="w29">������</option>
	   <option value="w30">��������</option>
      <option value="w0">��������</option>
	  <option value="w66">�����</option>
	  <option value="w67">�����</option>
	  <option value="w68">���</option>
	  <option value="w69">�������</option>
	  <option value="w70">����</option>
	  <option value="w60">������</option>
	  <option value="w61">��������</option>
	  <option value="w71">����</option>
		<option value="w62">�������</option>
	  <option value="w100">������� ��� ������</option>
    </select>  <input name="smb7" type="submit" class="lbut" value="��������� ������" /><? $filter2="WHERE master=''"; if($smb7){if($type==""){$filter="";$filter2="WHERE master=''";}else $filter="WHERE type='$type'";$filter2=" AND master=''";}?> 
    
      <select name="idit" >
      <option value=0<? if($idit==""){echo " selected=selected";}?>>�������� ���</option>
  <? $it=mysqli_query($GLOBALS['db_link'],"SELECT items.id, items.name ,items.level, items.type, items.effect FROM items $filter $filter2 ORDER BY effect,level,name;");
	  while ($row = mysqli_fetch_assoc($it)) {
	  echo "<option value=$row[id]";if($idit==$row[id]){echo " selected=selected";}echo">$row[name] [ $row[level] ] [ $row[effect] ]</option>";
	  }
	  ?>
  </select> <input name="edit" type="submit" class="lbut" value="���������" />
</form>
   <? if($edit){
   $it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM items WHERE id='$idit';"));
   ?>
   <form name="edititem" method="post" action="adm.php?id_adm=4&idit=<?=$idit?>">
<table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
<tr>
  <td valign="top" bgcolor="#f9f9f9"><div id="img"><img src="http://img.legendbattles.ru/image/weapon/<?=$it['gif']?>" title="test" /></div>
    <input type="text" name="gif" value="<?=$it['gif']?>" onClick="this.value='';">
         <?php 

unset($w);
          switch($it[type])
{
case w0: $w[0]=" selected=selected";break;
case w1: $w[1]=" selected=selected";break;
case w2: $w[2]=" selected=selected";break;
case w3: $w[3]=" selected=selected";break;
case w4: $w[4]=" selected=selected";break;
case w6: $w[5]=" selected=selected";break;
case w5: $w[6]=" selected=selected";break;
case w7: $w[7]=" selected=selected";break;
case w20: $w[8]=" selected=selected";break;
case w23: $w[9]=" selected=selected";break;
case w26: $w[10]=" selected=selected";break;
case w18: $w[11]=" selected=selected";break;
case w19: $w[12]=" selected=selected";break;
case w24: $w[13]=" selected=selected";break;
case w80: $w[14]=" selected=selected";break;
case w21: $w[15]=" selected=selected";break;
case w25: $w[16]=" selected=selected";break;
case w22: $w[17]=" selected=selected";break;
case w28: $w[18]=" selected=selected";break;
case w90: $w[19]=" selected=selected";break;
case w29: $w[29]=" selected=selected";break;
case w30: $w[30]=" selected=selected";break;
case w61: $w[61]=" selected=selected";break;
case w66: $w[66]=" selected=selected";break;
case w67: $w[67]=" selected=selected";break;
case w68: $w[68]=" selected=selected";break;
case w69: $w[69]=" selected=selected";break;
case w70: $w[70]=" selected=selected";break;
case w60: $w[60]=" selected=selected";break;
case w71: $w[71]=" selected=selected";break;
case w62: $w[62]=" selected=selected";break;
case w100: $w[100]=" selected=selected";break;
}


?>
</select></td>
  <td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname>
    <select name="type" >
      <option value="w4"<?=$w[4]?>>����</option>
      <option value="w1"<?=$w[1]?>>����</option>
      <option value="w2"<?=$w[2]?>>������</option>
      <option value="w3"<?=$w[3]?>>��������</option>
      <option value="w6"<?=$w[5]?>>�������� � �����</option>
      <option value="w5"<?=$w[6]?>>�����������</option>
      <option value="w7"<?=$w[7]?>>������</option>
      <option value="w20"<?=$w[8]?>>����</option>
      <option value="w23"<?=$w[9]?>>�����</option>
      <option value="w26"<?=$w[10]?>>�����</option>
      <option value="w18"<?=$w[11]?>>��������</option>
      <option value="w19"<?=$w[12]?>>�������</option>
      <option value="w24"<?=$w[13]?>>��������</option>
      <option value="w80"<?=$w[14]?>>������</option>
      <option value="w21"<?=$w[15]?>>������</option>
      <option value="w25"<?=$w[16]?>>������</option>
      <option value="w22"<?=$w[17]?>>������</option>
      <option value="w28"<?=$w[18]?>>����������</option>
      <option value="w90"<?=$w[19]?>>������</option>
	  <option value="w30"<?=$w[30]?>>��������</option>
	  <option value="w29"<?=$w[29]?>>������</option>
      <option value="w0"<?=$w[0]?>>��������</option>
	  <option value="w61"<?=$w[61]?>>��������</option>
	  <option value="w66"<?=$w[66]?>>�����</option>
	  <option value="w67"<?=$w[67]?>>�����</option>
	  <option value="w68"<?=$w[68]?>>���</option>
	  <option value="w69"<?=$w[69]?>>�������</option>
	  <option value="w70"<?=$w[70]?>>����</option>
	  <option value="w60"<?=$w[60]?>>������</option>
	  <option value="w71"<?=$w[71]?>>����</option>
		<option value="w62"<?=$w[62]?>>�������</option>
	  <option value="w100"<?=$w[100]?>>������� ��� ������</option>
    </select>
    <input name="name" type="text" value="<?=$it[name]?>" />
<? unset($w);
     switch($it[block])
{
case 0: $w[0]=" selected=selected";break;
case 40: $w[1]=" selected=selected";break;
case 70: $w[2]=" selected=selected";break;
case 90: $w[3]=" selected=selected";break;
}
    ?>
    <select name="block" >
      <option value="0"<?=$w[0]?>>�� ���</option>
      <option value="40"<?=$w[1]?>>1 �����</option>
      <option value="70"<?=$w[2]?>>2 �����</option>
      <option value="90"<?=$w[3]?>>3 �����</option>
    </select>
    <? unset($w);
switch($it[num_a])
{
case 0: $w[0]=" selected=selected";break;
case 32: $w[32]=" selected=selected";break;
case 33: $w[33]=" selected=selected";break;
case 1: $w[1]=" selected=selected";break;
case 2: $w[2]=" selected=selected";break; 
case 3: $w[3]=" selected=selected";break;
case 4: $w[4]=" selected=selected";break;
case 5: $w[5]=" selected=selected";break;
case 6: $w[6]=" selected=selected";break;
case 7: $w[7]=" selected=selected";break;
case 8:$w[8]=" selected=selected";break;
case 9:$w[9]=" selected=selected";break;
case 10:$w[10]=" selected=selected";break;
case 11:$w[11]=" selected=selected";break;
case 12:$w[12]=" selected=selected";break;
case 13:$w[13]=" selected=selected";break;
case 14:$w[14]=" selected=selected";break;
case 15:$w[15]=" selected=selected";break;
case 34:$w[34]=" selected=selected";break;
}
    ?>
    
    <select name="num_a">
      <option value="0"<?=$w[0]?>>�� ������/�������</option>
      <option value="32"<?=$w[32]?>>+HP/��������/�����/���������</option>
      <option value="33"<?=$w[33]?>>+MP/�����</option>
	  <option value="1"<?=$w[1]?>>����</option>
	  <option value="2"<?=$w[2]?>>�����������</option>
	  <option value="3"<?=$w[3]?>>�������</option>
	  <option value="4"<?=$w[4]?>>��������</option>
	  <option value="5"<?=$w[5]?>>�����</option>
	  <option value="6"<?=$w[6]?>>��������</option>
	  <option value="7"<?=$w[7]?>>����</option>
	  <option value="8"<?=$w[8]?>>�����</option>
	  <option value="9"<?=$w[9]?>>������ �����</option>
	  <option value="10"<?=$w[10]?>>������</option>
	  <option value="11"<?=$w[11]?>>��������</option>
	  <option value="12"<?=$w[12]?>>����������</option>
	  <option value="13"<?=$w[13]?>>���������</option>
	  <option value="14"<?=$w[14]?>>��� �����</option>
	  <option value="15"<?=$w[15]?>>����������������</option>
	  <option value="34"<?=$w[34]?>>�������� ��� ����</option>
    </select>

    <? unset($w);
         switch($it[acte])
{
case "": $w[0]=" selected=selected";break;
case magicreform: $w[1]=" selected=selected";break;
case fightmagicform: $w[2]=" selected=selected";break;
case chatsleepform: $w[3]=" selected=selected";break;
case zelreform: $w[4]=" selected=selected";break;
case licensform: $w[5]=" selected=selected";break;
case licensform2: $w[6]=" selected=selected";break;
case doktorreform: $w[7]=" selected=selected";break;
case zelinvis: $w[8]=" selected=selected";break;
case BotNapForm: $w[9]=" selected=selected";break;
case ObnulForm: $w[10]=" selected=selected";break;
case MaseForm: $w[11]=" selected=selected";break;
case teleport: $w[12]=" selected=selected";break;
case teleport2: $w[13]=" selected=selected";break;
}
    ?>
        <select name="acte" >
      <option value=""<?=$w[0]?>>�� ������/�������</option>
      <option value="magicreform"<?=$w[1]?>>����� ��/��</option>
	   <option value="zelreform"<?=$w[4]?>>�������</option>
      <option value="fightmagicform"<?=$w[2]?>>���������</option>
      <option value="chatsleepform"<?=$w[3]?>>��������</option>
	  <option value="licensform"<?=$w[5]?>>�������� ��������</option>
	  <option value="licensform2"<?=$w[6]?>>�������� �������</option>
	  <option value="doktorreform"<?=$w[7]?>>������ �������</option>
	  <option value="zelinvis"<?=$w[8]?>>�����������</option>
	  <option value="BotNapForm"<?=$w[9]?>>��������</option>
	  <option value="ObnulForm"<?=$w[10]?>>�����</option>
	  <option value="MaseForm"<?=$w[11]?>>����</option>
	  <option value="teleport"<?=$w[12]?>>��������</option>
	  <option value="teleport2"<?=$w[13]?>>�������� (� �����������)</option>	  
    </select>
    <br />
    <? if($it['2w']==1){$w1="checked";}else{$w2="checked";}?>
<strong>������ ������</strong>
    ��
    <input name="wtor" type="radio" value="1" <?=$w1?> />
    ���
    <input name="wtor" type="radio" value="0" <?=$w2?> />
   
    <?
unset($w);
switch($it[slot])
{
case 0: $w[0]=" selected=selected";break;
case 1: $w[1]=" selected=selected";break;
case 2: $w[2]=" selected=selected";break;
case 3: $w[3]=" selected=selected";break;
case 4: $w[4]=" selected=selected";break;
case 5: $w[5]=" selected=selected";break;
case 8: $w[8]=" selected=selected";break;
case 9: $w[9]=" selected=selected";break;
case 10: $w[10]=" selected=selected";break;
case 11: $w[11]=" selected=selected";break;
case 12: $w[12]=" selected=selected";break;
case 13: $w[13]=" selected=selected";break;
case 14: $w[14]=" selected=selected";break;
case 16: $w[16]=" selected=selected";break;
case 17: $w[17]=" selected=selected";break;
case 20: $w[20]=" selected=selected";break;
}
if($it['damage_mod']==0){$dm[0]=" selected=selected";}
else{
	$dmod=explode("@",$it['damage_mod']);
	switch($dmod[0]){
		case 1: $dm[1]=" selected=selected";break;
		case 2: $dm[2]=" selected=selected";break;
		case 3: $dm[3]=" selected=selected";break;
		case 4:	$dm[4]=" selected=selected";break;	
	}	
}
$immunes = explode("|",$it['immunes']);
foreach($immunes as $key=>$val){
	switch($key){
		case 0: //�����
			switch($val){
				case 0: $fire[$val]=" selected=selected";break;
				case 1: $fire[$val]=" selected=selected";break;
			}
		break; 
		case 1: //���
			switch($val){
				case 0: $ice[$val]=" selected=selected";break;
				case 1: $ice[$val]=" selected=selected";break;
			}
		break; 
		case 2://������
			switch($val){
				case 0: $vamp[$val]=" selected=selected";break;
				case 1: $vamp[$val]=" selected=selected";break;
			}		
		break; 
		case 3: //��
			switch($val){
				case 0: $poison[$val]=" selected=selected";break;
				case 1: $poison[$val]=" selected=selected";break;
			}	
		break; 
		case 4: //���. ����
			switch($val){
				case 0: $phys[$val]=" selected=selected";break;
				case 1: $phys[$val]=" selected=selected";break;
			}			
		break; 
	}
}
?>
    
    &nbsp; ����: <select name="slot">
		  <option value="0"<?=$w[0]?>>������ �����</option>	
          <option value="1"<?=$w[1]?>>����</option>
          <option value="2"<?=$w[2]?>>��������</option>
          <option value="3"<?=$w[3]?>>������</option>
          <option value="4"<?=$w[4]?>>����</option>
          <option value="5"<?=$w[5]?>>���������� �������� �����</option>
          <option value="8"<?=$w[8]?>>���� ��� �����</option>
          <option value="9"<?=$w[9]?>>������</option>
          <option value="10"<?=$w[10]?>>����������</option>
          <option value="11"<?=$w[11]?>>������</option>
          <option value="12"<?=$w[12]?>>��������</option>
          <option value="13"<?=$w[13]?>>���</option>
          <option value="14"<?=$w[14]?>>������</option>
          <option value="16"<?=$w[16]?>>�����</option>
          <option value="17"<?=$w[17]?>>��������</option>
		  <option value="20"<?=$w[20]?>>����</option>
        </select> ������: <input name="effect" type="text" value="<?=$it[effect]?>"/>
    <br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td><td><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td width=50% bgcolor=#D8CDAF><div align=center><font class=invtitle>��������</div></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>����������</div></td></tr><tr><td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>����</label>
              <input name="price" type="text" value="<?=$it[price]?>" />&nbsp;<label>���� ��</label>&nbsp;<input name="dd_price" type="text" value="<?=$it[dd_price]?>" /><br>
              ---------------------------------------------------------------<br>
			  &nbsp;<label>�������������� ���� (������ ���� ������ ���, ������ 20-30)</label><br>
			  <select name="damage_mod">
				  <option value="0"<?=$dm[0]?>>��� ����</option>
				  <option value="1"<?=$dm[1]?>>���� �����</option>
				  <option value="2"<?=$dm[2]?>>���� �����</option>
				  <option value="3"<?=$dm[3]?>>���������</option>
				  <option value="4"<?=$dm[4]?>>�������</option>
			  </select>
              &nbsp;<input name="damage_mod_val" type="text" value="<?=$dmod[1]?>" /><br>
			  ---------------------------------------------------------------<br>
			  &nbsp;<label>��������� � ����</label>
			  <select name="fire_immune">
				  <option value="0"<?=$fire[0]?>>���</option>
				  <option value="1"<?=$fire[1]?>>��</option>
			  </select><br>
			  &nbsp;<label>��������� �� ����</label>
			  <select name="ice_immune">
				  <option value="0"<?=$ice[0]?>>���</option>
				  <option value="1"<?=$ice[1]?>>��</option>
			  </select><br>
			  &nbsp;<label>��������� � ����������</label>
			  <select name="vamp_immune">
				  <option value="0"<?=$vamp[0]?>>���</option>
				  <option value="1"<?=$vamp[1]?>>��</option>
			  </select><br>
			  &nbsp;<label>��������� � ���</label>
			  <select name="poison_immune">
				  <option value="0"<?=$poison[0]?>>���</option>
				  <option value="1"<?=$poison[1]?>>��</option>
			  </select><br>
			  &nbsp;<label>��������� � ���.�����</label>
			  <select name="phys_immune">
				  <option value="0"<?=$phys[0]?>>���</option>
				  <option value="1"<?=$phys[1]?>>��</option>
			  </select><br>
			  ---------------------------------------------------------------<br>
                        <?
			  
$param=explode("|",$it[param]);
foreach ($param as $value) { 
$stat=explode("@",$value);
$par[$stat[0]]=$stat[1];} 						
		  for($i=0;$i<=71;$i++){
          switch($i)
{
case 1: $fr="���� (������ 20-30):";break;
case 2: $fr="�������������:";break;
case 3: $fr="��������(3 max ��� ������):";break;
case 4: $fr="��������:";break;
case 5: $fr="������:";break;
case 6: $fr="��������:";break;
case 7: $fr="����������:";break;
case 8: $fr="���������:";break;
case 9: $fr="����� �����:";break;
case 10: $fr="������ �����:";break;
case 11: $fr="������ ������� ������:";break;
case 12: $fr="������ ������� ������:";break;
case 13: $fr="������ ����������� ������:";break;
case 14: $fr="������ ����������� ������:";break;
case 15: $fr="������ ������� ������:";break;
case 16: $fr="������ �������� ������:";break;
case 17: $fr="������ ���������� ������:";break;
case 18: $fr="������ �������� ������:";break;
case 19: $fr="������ �� ������� ������:";break;
case 20: $fr="������ �� ������� ������:";break;
case 21: $fr="������ �� ����������� ������:";break;
case 22: $fr="������ �� ����������� ������:";break;
case 23: $fr="������ �� ������� ������:";break;
case 24: $fr="������ �� �������� ������:";break;
case 25: $fr="������ �� ���������� ������:";break;
case 26: $fr="������ �� �������� ������:";break;
case 27: $fr="��:";break;
case 28: $fr="���� ��������:";break;
case 29: $fr="����:";break;
case 30: $fr="����:";break;
case 31: $fr="�����������:";break;
case 32: $fr="�������:";break;
case 33: $fr="��������:";break;
case 34: $fr="�����:";break;
case 35: $fr="��������:";break;
case 36: $fr="����. ������:";break;
case 37: $fr="����. ��������:";break;
case 38: $fr="����. �������� �������:";break;
case 39: $fr="����. ������:";break;
case 40: $fr="����. ����������� �������:";break;
case 41: $fr="����. ���������� � �������:";break;
case 42: $fr="����. ��������:";break;
case 43: $fr="����. ������������ �������:";break;
case 44: $fr="����. ��������� �������:";break;
case 99: $fr="test���:";break;
case 46: $fr="����� ����:";break;
case 47: $fr="����� �������:";break;
case 48: $fr="����� �����:";break;
case 49: $fr="������������� ����� ����:";break;
case 50: $fr="������������� ����� ����:";break;
case 51: $fr="������������� ����� �������:";break;
case 52: $fr="������������� ����� �����:";break;
case 53: $fr="���������:";break;
case 54: $fr="������������:";break;
case 55: $fr="����������:";break;
case 56: $fr="����������������:";break;
case 57: $fr="��������:";break;
case 58: $fr="��������:";break;
case 59: $fr="�������:";break;
case 60: $fr="�������:";break;
case 61: $fr="��������� ����:";break;
case 62: $fr="�����������:";break;
case 63: $fr="���������:";break;
case 64: $fr="������:";break;
case 65: $fr="�����������:";break;
case 66: $fr="������� �������������� ����:";break;
case 67: $fr="���������:";break;
case 68: $fr="�������:";break;
case 69: $fr="�������� ������� ����:";break;
case 70: $fr="������������:";break;
case 71: $fr="�����������:";break;
}
if($fr!="")echo '<label><font class=weaponch><b>'.$fr.'</b></font></label><input name=pr['.$i.'] type=text value="'.$par[$i].'"/><br>';
}
echo '<label><font class=weaponch><b>����� ����� (� %)</b></font></label><input name=pr[expbonus] type=text value="'.$par['expbonus'].'"><br>';
echo '<label><font class=weaponch><b>����� �����</b></font></label><input name=pr[massbonus] type=text value="'.$par['massbonus'].'"><br>';
		  ?>
              
              </td>
            <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1 height=1></td><td align="right" valign="top" bgcolor="#FCFAF3"><font class=weaponch><b><label>�������:</label>
              <input name="level" type="text" value="<?=$it[level]?>" /><br><font class=weaponch><b><label>�����:</label>
              <input name="massa" type="text" value="<?=$it[massa]?>" /><br>
			  <font class=weaponch><b><label>���� �������� ���� (� ����)<i>0 - ��� �����</i>:</label>
              <input name="srok" type="text" value="<?=$it[srok]?>" /><br>
			  <?
			  
$need=explode("|",$it[need]);
foreach ($need as $value) { 
$stat=explode("@",$value);
$ned[$stat[0]]=$stat[1];}
		  for($i=28;$i<=74;$i++){
          switch($i)
{
case 28: $fr="���� ��������:";break;
case 29: $fr="";break;
case 30: $fr="����:";break;
case 31: $fr="�����������:";break;
case 32: $fr="�������:";break;
case 33: $fr="��������:";break;
case 34: $fr="�����:";break;
case 35: $fr="��������:";break;
case 36: $fr="����. ������:";break;
case 37: $fr="����. ��������:";break;
case 38: $fr="����. �������� �������:";break;
case 39: $fr="����. ������:";break;
case 40: $fr="����. ����������� �������:";break;
case 41: $fr="����. ���������� � �������:";break;
case 42: $fr="����. ��������:";break;
case 43: $fr="����. ������������ �������:";break;
case 44: $fr="����. ��������� �������:";break;
case 45: $fr="����� ����:";break;
case 46: $fr="����� ����:";break;
case 47: $fr="����� �������:";break;
case 48: $fr="����� �����:";break;
case 49: $fr="";break;
case 50: $fr="";break;
case 51: $fr="";break;
case 52: $fr="";break;
case 53: $fr="���������:";break;
case 54: $fr="������������:";break;
case 55: $fr="����������:";break;
case 56: $fr="����������������:";break;
case 57: $fr="��������:";break;
case 58: $fr="��������:";break;
case 59: $fr="�������:";break;
case 60: $fr="�������:";break;
case 61: $fr="��������� ����:";break;
case 62: $fr="�����������:";break;
case 63: $fr="���������:";break;
case 64: $fr="������:";break;
case 65: $fr="�����������:";break;
case 66: $fr="������� �������������� ����:";break;
case 67: $fr="���������:";break;
case 68: $fr="�������:";break;
case 69: $fr="�������� ������� ����:";break;
case 70: $fr="������������:";break;
case 73: $fr="������:";break;
case 74: $fr="��������:";break;
}
if($fr!="")echo "<label><font class=weaponch><b>$fr</b></font></label><input name=tr[$i] type=text value=\"$ned[$i]\"/><br>\n";
}
		  ?>

</td>
    </tr>
   </table></td></tr></table></td></tr>
</table>
  <div align="center">
    <input name="smb4" type="submit" class="lbut" value="���������" /> <input name="smb1" type="submit" class="lbut" value="��������� ��� �����" />
  </div>
</form>
<div align="center">
<p><br>
  <? } }
  
if($smb1){
for($i=1;$i<=71;$i++){
	if($pr[$i]!=""){$par.="$i@$pr[$i]|";}
}
if($pr['expbonus']!=""){$par.="expbonus@$pr[expbonus]|";}
if($pr['massbonus']!=""){$par.="massbonus@$pr[massbonus]|";}

$par=substr_replace($par, '', -1);
if($massa!=""){$need.="71|";}
if($level!=""){$need.="72|";}
for($i=28;$i<=74;$i++){

if($tr[$i]!=""){$need.="$i@$tr[$i]|";}}
$need=substr_replace($need, '', -1);
if($damage_mod==0){$insmod=0;}
elseif($damage_mod_val==0 or $damage_mod_val==''){$insmod=0;}
else{$insmod=$damage_mod."@".$damage_mod_val;}
$immunes_arr = ($fire_immune==1?'1':'0').'|'.($ice_immune==1?'1':'0').'|'.($vamp_immune==1?'1':'0').'|'.($poison_immune==1?'1':'0').'|'.($phys_immune==1?'1':'0');
mysqli_query($GLOBALS['db_link'],'INSERT INTO items (gif,name,block,2w,type,param,need,acte,num_a,level,price,dd_price,massa,slot,effect,srok,damage_mod,immunes) VALUES ('.AP.$gif.AP.','.AP.$name.AP.','.AP.$block.AP.','.AP.$wtor.AP.','.AP.$type.AP.','.AP.$par.AP.','.AP.$need.AP.','.AP.$acte.AP.','.AP.$num_a.AP.','.AP.$level.AP.','.AP.$price.AP.','.AP.$dd_price.AP.','.AP.$massa.AP.','.AP.$slot.AP.','.AP.$effect.AP.','.AP.$insmod.AP.','.AP.$srok.AP.','.AP.$immunes_arr.AP.');');

echo "<br><span class=prchattime>������� ��������!</span></div>";


}
if($smb2){mysqli_query($GLOBALS['db_link'],'INSERT INTO market (id,market,kol,ty) VALUES ('.AP.$id.AP.','.AP.$mark.AP.','.AP.$kol.AP.','.AP.$type.AP.');');
echo "<br><span class=prchattime>������� ��������!</span></div>";}


  if($smb4){
for($i=1;$i<=71;$i++){
if($pr[$i]!=""){$par.="$i@$pr[$i]|";}
}
if($pr['expbonus']!=""){$par.="expbonus@$pr[expbonus]|";}
if($pr['massbonus']!=""){$par.="massbonus@$pr[massbonus]|";}
$par=substr_replace($par, '', -1);
if($massa!=""){$need.="71|";}
if($level!=""){$need.="72|";}
for($i=28;$i<=74;$i++){

if($tr[$i]!=""){$need.="$i@$tr[$i]|";}}
$need=substr_replace($need, '', -1);
if($damage_mod==0){$insmod=0;}
elseif($damage_mod_val==0 or $damage_mod_val==''){$insmod=0;}
else{$insmod=$damage_mod."@".$damage_mod_val;}
$immunes_arr = ($fire_immune==1?'1':'0').'|'.($ice_immune==1?'1':'0').'|'.($vamp_immune==1?'1':'0').'|'.($poison_immune==1?'1':'0').'|'.($phys_immune==1?'1':'0');
mysqli_query($GLOBALS['db_link'],'UPDATE items SET immunes='.AP.$immunes_arr.AP.',gif='.AP.$gif.AP.',name='.AP.$name.AP.',block='.AP.$block.AP.',2w='.AP.$wtor.AP.',type='.AP.$type.AP.',param='.AP.$par.AP.',need='.AP.$need.AP.',acte='.AP.$acte.AP.',num_a='.AP.$num_a.AP.',effect='.AP.$effect.AP.',level='.AP.$level.AP.',price='.AP.$price.AP.',dd_price='.AP.$dd_price.AP.',massa='.AP.$massa.AP.',slot='.AP.$slot.AP.',damage_mod='.AP.$insmod.AP.',srok='.AP.$srok.AP.' WHERE id='.AP.$idit.AP.';');

echo "<br><span class=prchattime>������� ��������!</span></div>";}
?>
    
<script>
function img()
{
n=document.additem; 
var name = n.gif.value;
document.all("img").innerHTML = "<img src=\"http://img.legendbattles.ru/image/weapon/"+name+"\"  />";
}
function img2()
{
n=document.edititem; 
var name = n.gif.value;
document.all("img").innerHTML = "<img src=\"http://img.legendbattles.ru/image/weapon/"+name+"\"  />";
}
</script>
</body>
</html>
