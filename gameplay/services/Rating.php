<?php 
//session_start();
//include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
//include(DROOT."/includes/functions.php");
$RatingsName = array(
	'doktor'=>'��������',
	'lesorub'=>'���������',
	'vor'=>'�����',
	'ohotnichestvo'=>'���������',
	'alhimiya'=>'���������',
	'shahta'=>'��������',
	'orujeynik'=>'�����������',
	'yuvelir'=>'��������',
	'rybalka'=>'�������',
	'priruchenie'=>'������������',
	'runolog'=>'���������'
);
/*
<head>
	<meta http-equiv="Content-Language" content="ru">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<link type="text/css" rel="StyleSheet" href="/css/mn.css" />
	<title>�������� ������ ���� MysteryLands (����������� �����) - mystlands.com</title>
	<script language=JavaScript>function user_info(lg) {window.open(\'/ipers.php?\'+encodeURI(lg));}</script>
</head>
<body topmargin=30 leftmargin=30 style="background-image: url(\'/imgs/bgup.gif\'); background-repeat: repeat-x;">*/
?>
<tr><td>
<font class=proce><font color=#222222>
<FIELDSET>
<LEGEND align=center><B><font color=gray>&nbsp;�������� �������&nbsp;</font></B></LEGEND>
<?
echo'
<style>
.fp {
font-family: "Palatino Linotype";
letter-spacing: 0.1pt;
color: #282828;

}
a {
color: #B70000;
text-decoration: none;
outline: none;
}
</style>
	<font size=2 class=fp>
		<div align=center>
			<div class=ramka style="width:420">
				<b>
				<a href="?mselect=25&r=doktor">�������</a> |
				<a href="?mselect=25&r=lesorub">��������</a> |
				<a href="?mselect=25&r=vor">����</a> |
				<a href="?mselect=25&r=ohotnichestvo">��������</a> |
				<a href="?mselect=25&r=alhimiya">��������</a><br>
				<a href="?mselect=25&r=shahta">�������</a> |
				<a href="?mselect=25&r=orujeynik">����������</a> |
				<a href="?mselect=25&r=yuvelir">�������</a> |
				<a href="?mselect=25&r=rybalka">������</a><br>
				<a href="?mselect=25&r=priruchenie">�����������</a> |
				<a href="?mselect=25&r=runolog">��������</a>
				</b>
			</div>
			<br />';
if(!isset($RatingsName[$_GET['r']])){
	exit;
}
			echo'<b>
				<u>- ������� '.$RatingsName[$_GET['r']].' -</u>
			</b>
			<br />
			<font class=fi>last update: 16.10.2013 14:44:56</font>
			<div style=padding:4>
				<table>
					<tr>
						<td width=30>&nbsp;#</td>
						<td width=300>&nbsp;��������</td>
						<td colspan=2>&nbsp; ����</td>
					</tr>';
$i = 0;
//foreach(){
$i++;
echo'					<tr class=ramka>
						<td>
							<font size=2>&nbsp;'.$i.'</font>
						</td>
						<td>
							<font size=2 style="color:#2B3060"><!-- 602B34 -->
								&nbsp;<img border=0 title="���� ���������� (�������)" src="../../img/ico_clan/22.gif" width=15 height=12>
								&nbsp;<img align=baseline title="����������� ������������ ���� - �������" src="../../img/other/sk_neutral1.gif">
								&nbsp;<b>dim<img border=0 src="../../img/other/i.gif" onClick=javascript:user_info(\'dim\') width=15 height=15 align=absmiddle style=cursor:pointer></b> 
								<sup>29 - ���� (�����)</sup>
							</font>
						</td>
						<td width=15 align=center>
							<font size=2>
								<font title="+72" color=#0066FF>
									<b>&uarr;<!-- &darr; --></b>
								</font>
							</font>
						</td>
						<td width=60>
							<font size=2>
								&nbsp;72
							</font>
						</td>
					</tr>';
//}
echo'				</table>
			</div>
			<hr width=450>
		</font>
		<font color=#3D3E43>�������� ����������� ������ 48 �����</font>
	</div>
'?>
</fieldset></td></tr>
