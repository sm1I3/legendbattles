<?php require('kernel/before.php');?>
<HTML>
<HEAD>
<SCRIPT src="../../../js/stooltip.js?v11"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>

<?
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
db_open();
	if(!empty($_POST)){
		$GetUser = GetUser($_POST['nickname']);
		$_POST['valute'] = floatval($_POST['valute']);
		if(!empty($GetUser) and $_POST['valute'] > 0){
			echo"<center>�� ������ ��������� ��������� <b>".$GetUser['login']."</b> ������� ������ � ������� <b>".($_POST['valute'])."</b> ������� (�).</center>";
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`+'".round($_POST['valute'], 2)."' WHERE `id`='".$GetUser['id']."'");
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `payments` (`uid`, `time_unix`, `time_norm`, `tpay`, `count`, `dealer`) VALUES ('".$GetUser['id']."', '".time()."', '".date("Y-m-d")."',  'DealerPay','".($_POST['valute'])."','".$pers['id']."');");
			chmsg("<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������� ����������</font></b>:</font>&nbsp;��� ������ ��������� ������� ������ � ������� <b>".($_POST['valute'])." </b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 </b> ������� (�). (<b>����</b>).</font>",$GetUser['login']);
		}
		elseif($_POST['nickname']=='����' and $_POST['valute'] > 0){
			echo"<center>�� ������ ��������� ���� ������� ������ � ������� <b>".($_POST['valute'])."</b> �������.</center>";
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`+'".round($_POST['valute'], 2)."' WHERE `id`>0 and `type`!=3");
			chmsg("<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������� ����������</font></b>:</font>&nbsp;��� ������ ��������� ������� ������ � ������� <b>".($_POST['valute'])." </b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 </b> ������� (�). (<b>����</b>).</font>",$GetUser['login']);
		}
	}
	if($_POST['method'] == 'bday'){
		$GetUser = GetUser($_POST['nickname']);
		if(!empty($GetUser) and ($_POST['bday'] != "n" or $_POST['bmouth'] != "n" or $_POST['byear'] != "n")){
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `bday`='".(intval($_POST['bday']).".".intval($_POST['bmonth']).".".intval($_POST['byear']))."',`baks`=baks-30 WHERE `id`='".$GetUser['id']."'");
			echo"<center>�� ������ �������� ���� �������� ��������� ��������� <b>".$GetUser['login']."</b>.</center>";
			chmsg("<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������� ����������</font></b>:</font>&nbsp;���� ���� �������� ���� �������� � &quot;".$GetUser['bday']."&quot; �� &quot;".(intval($_POST['bday']).".".intval($_POST['bmonth']).".".intval($_POST['byear']))."&quot; � ������ ����� ���� ������� <b>30</b></b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 </b> ������� (�). (<b>����</b>).</font>",$GetUser['login']);
		}
	}
	if($_POST['method'] == 'otkat'){
		$GetUser = GetUser($_POST['nickname']);
		if(!empty($GetUser)){
		echo"<center>�� ������ c������ <b>".($_POST['OtkatCount'])."</b> ������� � <b>".$GetUser['login']."</b>.</center>";
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`='".($GetUser['baks']-$_POST['OtkatCount'])."' WHERE `id`='".$GetUser['id']."'");
		chmsg("<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>��������� ����������</font></b>:</font>&nbsp;� ������ ����� ������ ������� ������� ������ � ������� <b>".($_POST['OtkatCount'])."</b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 </b> ������� (�). (<b>����</b>).</font></b>�� �������: <b>".$_POST['OtkatDesc']."</b></font>",$GetUser['login']);
		}
	}
?>
<style>
.interchange_currency { border-color: #D8CDAF; border-width: 1px; border-style: solid; background: #FCFAF3; color: #FCFAF3; }
.interchange_header { background: #D8CDAF; }
</style>
<form method="post" action="">
  <table border='0' cellspacing='0' cellpadding='0' class='interchange_currency' align="center">
    <tr class='interchange_header' align='center'>
      <td><a href='http://valuta-ukraina.info/convert-valut' style='text-decoration:none; display:none;' id='interchange_link'></a><span class='invtitle'>��������� ����� ������</span></td>
    </tr>
    <tr align='center' valign='top'>
      <td><span id='interchange_echo_kurs_insert_html'></span>
        <script language='JavaScript' src='http://valuta-ukraina.info/xml/script3.js' type="text/javascript"></script>
        <script>
		var interchange_echo_kurs_str_hidden_kurs = new String("<input type='hidden' value='8.491138' id='interchange_echo_kurs_AUD'><input type='hidden' value='12.778857' id='interchange_echo_kurs_GBP'><input type='hidden' value='1.504294' id='interchange_echo_kurs_DKK'><input type='hidden' value='11.198113' id='interchange_echo_kurs_EUR'><input type='hidden' value='0.053953' id='interchange_echo_kurs_KZT'><input type='hidden' value='15.899635' id='interchange_echo_kurs_LVL'><input type='hidden' value='0.684351' id='interchange_echo_kurs_MDL'><input type='hidden' value='2.579022' id='interchange_echo_kurs_PLN'><input type='hidden' value='6.378874' id='interchange_echo_kurs_SGD'><input type='hidden' value='4.515732' id='interchange_echo_kurs_TRL'><input type='hidden' value='0.0370553' id='interchange_echo_kurs_HUF'><input type='hidden' value='0.450937' id='interchange_echo_kurs_CZK'><input type='hidden' value='9.169011' id='interchange_echo_kurs_CHF'><input type='hidden' value='0.1052553' id='interchange_echo_kurs_JPY'><input type='hidden' value='10.137247' id='interchange_echo_kurs_AZM'><input type='hidden' value='0.00093' id='interchange_echo_kurs_BYR'><input type='hidden' value='7.977' id='interchange_echo_kurs_USD'><input type='hidden' value='0.038614' id='interchange_echo_kurs_ISK'><input type='hidden' value='8.019273' id='interchange_echo_kurs_CAD'><input type='hidden' value='3.243198' id='interchange_echo_kurs_LTL'><input type='hidden' value='1.462658' id='interchange_echo_kurs_NOK'><input type='hidden' value='0.26377' id='interchange_echo_kurs_RUB'><input type='hidden' value='12.690771' id='interchange_echo_kurs_XDR'><input type='hidden' value='2.798947' id='interchange_echo_kurs_TMM'><input type='hidden' value='0.004528' id='interchange_echo_kurs_UZS'><input type='hidden' value='1.240376' id='interchange_echo_kurs_SEK'><input type='hidden' value='1.254213' id='interchange_echo_kurs_CNY'><input type='hidden' value='1' id='interchange_echo_kurs_UAH'>");var interchange_echo_kurs_str_select = "<table border=0 cellpadding=2 cellspacing=2 width='100%' class='interchange_currency' style='border: none;'><tr align='right'><td><select id='interchange_echo_kurs_select_valuta_start' onChange='interchange_echo_kurs_fcn_otvet()' class='interchange_informer'><option value='AUD'>������������� ������ (AUD)</option><option value='GBP'>���� ���������� (GBP)</option><option value='DKK'>������� ����� (DKK)</option><option value='EUR'>���� (EUR)</option><option value='KZT'>��������� ����� (KZT)</option><option value='LVL'>��������� ��� (LVL)</option><option value='MDL'>���������� ��� (MDL)</option><option value='PLN'>�������� ������ (PLN)</option><option value='SGD'>������������ ������ (SGD)</option><option value='TRL'>�������� ���� (TRL)</option><option value='HUF'>���������� ������ (HUF)</option><option value='CZK'>������� ����� (CZK)</option><option value='CHF'>����������� ����� (CHF)</option><option value='JPY'>�������� ���� (JPY)</option><option value='AZM'>��������������� ����� (AZM)</option><option value='BYR'>����������� ����� (BYR)</option><option value='USD'>������������ ������ (USD)</option><option value='ISK'>���������� ����� (ISK)</option><option value='CAD'>��������� ������ (CAD)</option><option value='LTL'>���������� ��� (LTL)</option><option value='NOK'>���������� ����� (NOK)</option><option value='RUB'>���������� ����� (RUB)</option><option value='XDR'>��-�� ��� ��� (XDR)</option><option value='TMM'>����������� ����� (TMM)</option><option value='UZS'>��������� ��� (UZS)</option><option value='SEK'>�������� ����� (SEK)</option><option value='CNY'>��������� ���� (CNY)</option><option value='UAH' selected>���������� ������ (UAH)</option></select><td>����� <input type='text' class='interchange_informer' size=5 id='interchange_echo_kurs_text' value=0 onKeyUp='interchange_echo_kurs_fcn_otvet()'><td><img src='http://valuta-ukraina.info/img/UAH.gif' id='img_start_money'><td> | </td><td align=right><select id='interchange_echo_kurs_select_valuta_end' onChange='interchange_echo_kurs_fcn_otvet()' class='interchange_informer'><option value='AUD'>������������� ������ (AUD)</option><option value='GBP'>���� ���������� (GBP)</option><option value='DKK'>������� ����� (DKK)</option><option value='EUR'>���� (EUR)</option><option value='KZT'>��������� ����� (KZT)</option><option value='LVL'>��������� ��� (LVL)</option><option value='MDL'>���������� ��� (MDL)</option><option value='PLN'>�������� ������ (PLN)</option><option value='SGD'>������������ ������ (SGD)</option><option value='TRL'>�������� ���� (TRL)</option><option value='HUF'>���������� ������ (HUF)</option><option value='CZK'>������� ����� (CZK)</option><option value='CHF'>����������� ����� (CHF)</option><option value='JPY'>�������� ���� (JPY)</option><option value='AZM'>��������������� ����� (AZM)</option><option value='BYR'>����������� ����� (BYR)</option><option value='USD' selected>������������ ������ (USD)</option><option value='ISK'>���������� ����� (ISK)</option><option value='CAD'>��������� ������ (CAD)</option><option value='LTL'>���������� ��� (LTL)</option><option value='NOK'>���������� ����� (NOK)</option><option value='RUB'>���������� ����� (RUB)</option><option value='XDR'>��-�� ��� ��� (XDR)</option><option value='TMM'>����������� ����� (TMM)</option><option value='UZS'>��������� ��� (UZS)</option><option value='SEK'>�������� ����� (SEK)</option><option value='CNY'>��������� ���� (CNY)</option><option value='UAH'>���������� ������ (UAH)</option></select><td>����� <input type='text' class='interchange_informer' size=5 id='interchange_echo_kurs_insert_otvet' value=0><td><img src='http://valuta-ukraina.info/img/USD.gif' id='img_end_money'></table>";

tmplink = document.getElementById('interchange_link').href;
reg_str = new RegExp("^http://valuta-ukraina.info/", "i");
arr_val = reg_str.exec(tmplink);
if (arr_val && arr_val['index']==0)
{
	function interchange_echo_kurs_fcn_otvet()
	{
		document.getElementById('interchange_echo_kurs_insert_otvet').value = Math.round(100 * document.getElementById('interchange_echo_kurs_' + document.getElementById('interchange_echo_kurs_select_valuta_start').value + '').value / document.getElementById('interchange_echo_kurs_' +document.getElementById('interchange_echo_kurs_select_valuta_end').value +'').value * document.getElementById('interchange_echo_kurs_text').value) / 100;
		document.getElementById('img_start_money').src = "http://valuta-ukraina.info/img/" + document.getElementById('interchange_echo_kurs_select_valuta_start').value +".gif";
		document.getElementById('img_end_money').src = "http://valuta-ukraina.info/img/" + document.getElementById('interchange_echo_kurs_select_valuta_end').value +".gif";
	}
	
	document.getElementById('interchange_echo_kurs_insert_html').innerHTML = '' + interchange_echo_kurs_str_hidden_kurs + interchange_echo_kurs_str_select;
}
else
{
document.getElementById('interchange_echo_kurs_insert_html').innerHTML = '<p style="color: red;">������� ��� ����������! ������ � ��������� ����� ������������ �������� HREF (�� ������ ���� ����� = <b>"http://valuta-ukraina.info/"</b>)</p>';
}
		</script>
        <script>
	  var a = document.getElementById('interchange_echo_kurs_select_valuta_end');
	  a.innerHTML = '<option value="USD" selected="selected">�������</option>';
	  interchange_echo_kurs_fcn_otvet();
	  document.getElementById('interchange_echo_kurs_insert_otvet').name = "valute";
      </script><input name="nickname"  class="lbut" type="text"  onBlur="if (value == '') {value='����'}" onFocus="if (value == '����') {value = ''}" value="����"><input type="hidden" name="valute_type" id="valute_type" value="USD" /><input onclick="SelectValute();" type="submit" class="lbut" value="������" /><input type="hidden" name="method" value="valute" /></td>
    </tr>
  </table>
</form>
<?php
{
?>
<form method="post" action="">
  <table cellpadding="3" cellspacing="1" width="40%" border="0" style="background:#D8CDAF;" align="center">
    <tr>
      <td bgcolor="#D8CDAF"><div align=center><font class=invtitle>����� ���� ��������</font></div></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3" align="center"><select name="bday" class="LogintextBox6">
                <option value="n" selected="selected"></option>
<?php
for($i=1;$i<32;$i++){
	echo"                <option value=\"".$i."\"> ".(($i>9)?$i:'0'.$i)." </option>\n";
}
?>
              </select>
              <select name="bmonth" class="LogintextBox6">
                <option value="n" selected="selected"></option>
<?php
for($i=1;$i<13;$i++){
	echo"                <option value=\"".$i."\"> ".(($i>9)?$i:'0'.$i)." </option>\n";
}
?>
              </select>
              <select name="byear" class="LogintextBox6">
                <option value="n" selected="selected"></option>
<?php
for($i=1950;$i<=(date("Y")-7);$i++){
	echo"                <option value=\"".$i."\"> ".$i." </option>\n";
}
?>
              </select></td>
    </tr>
    <tr>
      <td bgcolor="#FCFAF3" align="center"><input name="nickname"  class="lbut" type="text"  onBlur="if (value == '') {value='����'}" onFocus="if (value == '����') {value = ''}" value="����"><input type="hidden" name="method" value="bday" /><input type="submit" class="lbut" value="��������" /></td>
    </tr>
  </table>
</form>
<?php
}

{
?>
<form method="post" action="">
  <table cellpadding="3" cellspacing="1" width="40%" border="0" style="background:#D8CDAF;" align="center">
    <tr>
      <td bgcolor="#D8CDAF"><div align=center><font class=invtitle>�������� ��������</font></div></td>
    </tr>
    <tr><td bgcolor="#FCFAF3" align="center"><input name="nickname" class="lbut" type="text" onBlur="if (value == '') {value='����'}" onFocus="if (value == '����') {value = ''}" value="����"><input type="text" class="lbut" name="OtkatCount" onBlur="if (value == '') {value='�������'}" onFocus="if (value == '�������') {value = ''}" value="�������"><input type="text" class="lbut" name="OtkatDesc" onBlur="if (value == '') {value='������'}" onFocus="if (value == '������') {value = ''}" value="������"></td>
    </tr>
      <td bgcolor="#FCFAF3" align="center"><input type="submit" class="lbut" value="������" /><input type="hidden" name="method" value="otkat" /></td>
    </tr>
  </table>
</form>
<?php
}
?>
<? require('kernel/after.php'); ?>