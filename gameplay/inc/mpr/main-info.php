<? 
	if($_GET['adderr']==1){
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `bug_reports` (`text`,`date`,`srok`,`from`) VALUES ('".bbCodes(addslashes(htmlspecialchars($_POST['errtext'])))."','".time()."','".intval($_POST['errtype'])."','".$player['login']."')");
		$message="��������� ���������.";
	}
	if($_GET['bonus']==1 and $player['compensations']=='1'){
			$player=player();

			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3091',  '".$player['id']."',  '0',  '0',  '1500',  '1500',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3320',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2321',  '".$player['id']."',  '0',  '0',  '10',  '2500',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3455',  '".$player['id']."',  '0',  '0',  '1',  '1500',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3283',  '".$player['id']."',  '0',  '0',  '1',  '2000',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3283',  '".$player['id']."',  '0',  '0',  '1',  '2000',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3283',  '".$player['id']."',  '0',  '0',  '1',  '2000',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3283',  '".$player['id']."',  '0',  '0',  '1',  '2000',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3283',  '".$player['id']."',  '0',  '0',  '1',  '2000',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3443',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3444',  '".$player['id']."',  '0',  '0',  '10',  '1',  '0');");
      mysqli_query($GLOBALS['db_link'],"update `user` set `compensations`='0' WHERE `id`='".$player['id']."' LIMIT 1;");
			
			echo'
			<br>��������: <b>��������(���.������)</b>
			<br>��������: <b>���� (����������))</b>
			<br>��������: <b>������� ���������������� </b>
			<br>��������: <b>���������� ������ ��� �������� ����</b>
			<br>��������: <b>��������� ����� (5 ��)</b>
			<br>��������: <b>����� �������������� 2200 �� (1 ��)</b>
			<br>��������: <b>������� ���� ����������� (1 ��)</b>
			</td></tr>
			';
			$player['compensations']=0;
	}
$bday=explode(".",$player['bday']);
echo'<tr>
<td>
<fieldset>
  <legend><font color="#f0f0f0"><b>���������� ���������</b></font></legend>
  <img src="http://image.legendbattles.ru/signs/totems/'.$player['thotem'].'.gif" width="120" height="120" align="right" border="0" hspace="10" />
  <form action="main.php?mselect=4" method="post">
    <table cellpadding="5" cellspacing="0" border="0" width="100%">
      <tr>
        <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr>
            <td><font class="freemain"><b><font color="#336699">���� ���:</font></b></font></td>
            <td><input type="text" name="newname" size="30" class="LogintextBox4" maxlength="50" value="'.$player['name'].'" />
              <font class="freetxt"><font color="#cc0000"> * </font></font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">���� ��������: </font></b></font></td>
            <td>
              <select name="select" disabled="disabled" class="LogintextBox6">
                <option>'.$bday[0].'</option>
              </select>
              <select name="select" disabled="disabled" class="LogintextBox6">
                <option>'.$bday[1].'</option>
              </select>
              <select name="select" disabled="disabled" class="LogintextBox6">
                <option>'.$bday[2].'</option>
              </select></td>
          </tr>
          <tr>
            <td colspan="2"><font class="freetxt">������� ������� ��������� �������� ��� � ���� ��������.<br />
              ��� ������ ��� ����� ���������� ��� �������������� �����.<br />
              <br />
            </font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">������: </font></b></font></td>
            <td><input type="text" name="newcountry" size="30" class="LogintextBox4" maxlength="50" value="'.$player['country'].'" />
              <font class="freetxt"><font color="#cc0000"> * </font></font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">�����: </font></b></font></td>
            <td><input type="text" name="newcity" size="30" class="LogintextBox4" maxlength="50" value="'.$player['city'].'" />
              <font class="freetxt"><font color="#cc0000"> * </font></font></td>
          </tr>
          <tr>
            <td colspan="2"><font class="freetxt">����� ��������� ��������� �������� ������. ��� ����� ��� ���������� ��� �������������� �����, ��� ��������� ���� � ������ �������, � �� ������� ���������� � �������������� ������ � ����� ��������������.<br />
              <br />
            </font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">����� ICQ: </font></b></font></td>
            <td><input type="text" name="newicq" size="30" class="LogintextBox4" maxlength="50" value="'.$player['icq'].'" /></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">URL: </font></b></font></td>
            <td><input type="text" name="url" size="30" class="LogintextBox4" maxlength="40" value="'.$player['url'].'" /></td>
          </tr>
          <tr>
            <td colspan="2"><font class="freetxt">���� ����� �� ���������� ��� ����������. ��� �������� ���������� ��� ������ ���������� ���� � ������ ������ ��� ����������� ����� ������������� Guild of Honor � ����.<br />
              <br />
            </font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">�������������: </font></b></font></td>
            <td><textarea class="LogintextBox6" cols="61" rows="10" name="newaddon">'.$player['addon'].'</textarea></td>
          </tr>
          <tr>
            <td colspan="2"><font class="freetxt">�������������� ���������� � ��� (�������� ����������). ������������� ����������� �������� ���� ����������, ������� ����� ��������� ��� ����� ��������������� ������ (���� � ������ �����, ������, ����, ��������� ���� � ��� �����). ������������ ����� ��������� - 800 ��������.<br />
              <br />
            </font></td>
          </tr>
          <tr>
            <td><font class="freemain"><b><font color="#336699">� ����: </font></b></font></td>
            <td><textarea class="LogintextBox6" cols="61" rows="10" name="newabout">'.deCodes($player["about"]).'</textarea></td>
          </tr>
          <tr>
            <td colspan="2"><font class="freetxt">����������, ��������� ��� ������ ���������� ����. ������������ ����� ��������� - 800 ��������.<br />
              <br />
            </font></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" class="lbut" value="���������" border="0" />
              <input type="hidden" name="post_id" value="49" />
              <input type="hidden" name="act" value="5" />
              <input type="hidden" name="de" value="800" />
              <input type="hidden" name="vcode" value="'.scode().'" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </form>
</fieldset>
</td>
</tr>';
?>