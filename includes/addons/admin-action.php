<? session_start();?>
<HTML>
<HEAD>
<LINK href="/css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<?php
if($_GET['addid'] == 'm0neditor'){
?>
<script>
document.write('<div id="darker" style="display:none;"><table cellspacing="0" cellpadding="0" width="300" style="position:relative;width:300px;left:50%;top:50%;margin-left:-150px;margin-top:-105px;">  <tr>    <td style="width:18px;height:18px;"><div style="position:absolute; width:30px; height:30px; background:url(http://img.w.wenl.ru/image/closebox.png) no-repeat;right:0px;top:0px;cursor:pointer;" onclick="ShowForm();">&nbsp;</div><img src="http://img.w.wenl.ru/image/FormUp/left_top.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/top.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/right_top.png" width="18" height="18"></td>  </tr>  <tr>    <td style="width:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/left.png\');"></td>    <td style="background-image:url(\'http://img.w.wenl.ru/image/FormUp/bg.png\');" align="center"><div id="ContentError"></div></td>    <td style="width:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/right.png\');"></td>  </tr>  <tr>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/left_bottom.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/bottom.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/right_bottom.png" width="18" height="18"></td>  </tr></table></div>');
</script>
<?php
}else{
	echo'<SCRIPT src="./js/FormUp_v01.js"></SCRIPT>';
}
?>
<SCRIPT LANGUAGE="JavaScript" src="/js/signs.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="/ch/ch_list_v2.js"></SCRIPT>
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
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=1'" value="������������ ���������" />
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=4'" value="�������� ���������" />
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=2'" value="���������� � �������" />
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=3'" value="�����" />
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=99'" value="�������� ����� ����������" />
		<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/adm.php?id_adm=7'" value="���� IP" />
	</td>
	</tr>
<tr>	
	<td align=center>
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/player_items.php'" value="�������� �����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/clan_items.php'" value="������ � �������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/tz.php'" value="�� �������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/errors.php'" value=" ��������� �� �������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/alhim.php'" value="�������� ������������ ��������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/custom_rec.php'" value="�������� ������ ��������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/bot_drop.php'" value="���� �����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/accounts.php'" value="��������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/presents.php'" value="�������" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/unground.php'" value="�������" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/player.php'" value="���������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/labyrinth.php'" value="��������" />
</td>
</tr>
<tr>	
<td align=center>
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/ref_system.php'" value="���������" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/bot_edit.php'" value="����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/system_messages.php'" value="��������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/real_dd_adm.php'" value="������� ������ � ��" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/player-actions.php'" value="���� ����������" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/chests.php'" value="�������" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/chests2.php'" value="������� ����" />	
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/curs.php'" value="�����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/koldyn.php'" value="������" />
	<input  type="button" class="lbut"onclick="location='/core2.php?useaction=admin-action&addid=tavern'" value="�������"
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/panel.php'" value="���� � ����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/mail.php'" value="�����" />
	<input type="button" class="lbut" onclick="location='/includes/addons/admin-action/online.php'" value="������" />
</td>
</tr>
</table>
<tr>
        <td><table width=100% cellpadding=1 cellspacing=0>
          <tr>
            <td bgcolor=#CCCCCC><table width=100% cellpadding=10 cellspacing=0>
              <tr>
                <td bgcolor=#FFFFFF><?php
				if(is_file(DROOT."/includes/addons/admin-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php"))
					include(DROOT."/includes/addons/admin-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php");
				else
					echo"<font class=freetxt><div align=center><font color=#cc0000><b>�������� ������</b></font></div></font>";
				?></td>
              </tr>
            </table>
</body>
</html>	