<?php
if($_POST["pupil"]){
	$pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_POST["pupil"])."' and `instructor`='0' and `level`<'10'"));
	if($pl){
		chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>��������� ����������.</b></font> �������� <b>".$player["login"]."</b>[".$player["level"]."/".$player["u_lvl"]."] ���������� ��� ����� ��� ��������. �� ��� �� �������� 10 LR � +50% ����� �� ���. <a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onClick=\"ticher(\'".$player["id"]."\')\"> ������� <font style=\"font-size: 10px;\">>>></font></font></a></font><BR>'+'');",$pl['login']);
		echo"<script>parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>��������� ����������.</b></font> ������ ������ ������.</font><BR>'+'');</script>";
	}
}

$pupil = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `instructor` = '".$player["id"]."'"));

if(@$_GET["deny"]){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `instructor` = '0' WHERE `instructor` = '".$player["id"]."'");
	chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>��������� ����������.</b></font> �������� <b>".$player["login"]."</b>[".$player["level"]."/".$player["u_lvl"]."] ��������� �� ��������.</font><BR>'+'');",$pupil['login']);
	$pupil = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `instructor` = '".$player["id"]."'"));
}

echo'<tr><td align=center>
<font class=proce>
<FIELDSET>
<LEGEND align=center><b><font color="gray">���������</font></b></LEGEND>
 <font class=weaponch>';
if($pupil){
	echo'      <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	    <tr>
		  <td bgcolor="#E0D6BB">
            <table cellpadding="2" cellspacing="1" border="0" width="100%">
			  <tr>
			    <td bgcolor="#FCFAF3" align="center">
				  <font class=proce><font color=#222222>� ��� ���� ������ <b>'.$pupil["level"].'</b>�� ������</font></font>
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class="weaponch">
					<font class=nickname><b>'.$pupil['login'].'</b> ['.$pupil['level'].'/'.$pupil['u_lvl'].'] <a href="/ipers.php?'.$pupil['login'].'" target="_blank"><img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a> <input type=button class=lbut value="���������� �� ��������" onclick="location = \'/main.php?mselect=21&deny=1\'">
				  </font>
				</td>
			  </tr>
			</table>
		  </td>
	    </tr>
      </table>';
}else{
	echo'<form method="post" action="main.php?mselect=21">
      <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	    <tr>
		  <td bgcolor="#E0D6BB">
            <table cellpadding="2" cellspacing="1" border="0" width="100%">
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class=proce><font color=#222222><b>�� ������ �� ��������...</b></font></font>
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" align="center">
				  <input class="lbut" type="text" name="pupil" id="pupil" value="">
				</td>
				<td bgcolor="#FCFAF3" align="center">
				  <input type="submit" class="lbut" value="����� �����������">
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class="weaponch">
					<p>
					  <i class="gray" style="text-align:left;">
						<b class="ma">�������:</b> ���������� ����� ����������� ����� ������ ��������� ���� 10��� ������. ����������� ���������, ������, ���� �������� ������ ���, �� � ������ ����� �������� <b>20 LR</b>, � ������ ������� <b>10 LR</b> � <b>+50% ����� �� ���</b> � �������. ������� ����� ���� ������ ���������. ���� ��� ������ ��������� 10��� ������ �� �������� � ������� <b>500 LR</b>, <b>0.15 $</b> � <b>100 ������� �����</b>!
					  </i>
					</p>
				  </font>
				</td>
			  </tr>
			</table>
		  </td>
	    </tr>
      </table>
    </form>
	<!--<script>ActionFormUse = \'pupil\';</script>-->';
}
echo'<center>�� ��� ������� <b>'.$player['good_pupils_count'].'</b> ����������.<br><i class=ma>�� ������� 5��� �� ������ ������������� �������� �� 2000 LR</i></center>
</font>
</FIELDSET>
</td></tr>';