<?php


include($_SERVER["DOCUMENT_ROOT"].'/includes/ks_antiddos.php');

$ksa = new ks_antiddos();
$ksa->doit(10,10);






foreach($_POST as $keypost=>$valp){
     //$valp = varcheck($valp);
     $_POST[$keypost] = $valp;
     $$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
    // $valg = varcheck($valg);
     $_GET[$keyget] = $valg;
     $$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
     $$keyses = $vals;
}
echo'<table cellpadding=0 cellspacing=0 border=0 width=800 align=center><tr>';
if($clear==1){
	session_start(  );
	$_SESSION = array(  );
	unset( $_COOKIE[session_name(  )] );
	session_destroy(  );
	setcookie( 'Hash' );
	setcookie( 'UID' );
	setcookie( 'Puid' );
	}
if($login==1){
	print '<HTML><HEAD><LINK href=./css/error.css rel=STYLESHEET type=text/css><META content="text/html; charset=windows-1251" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><center><font color=#dd0000>�������� ����� ��� ������.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><div align=center><a href=http://legendbattles.ru/ target=_top class=menu>������� ��������</a>.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($error==1){
echo'<HTML><HEAD><LINK href="./css/error.css" rel=STYLESHEET type=text/css><META content="text/html; charset=windows-1251" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><font color=#dd0000>��������! ����� ������ �������.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><b>��������� �������:</b><br><b>1.</b> ������ ���������� � ��������. <a href=/ target=_top class=menu>legendbattles.ru</a><br><b>2.</b> ������� ����� � ������ ���� ��������. (�������� ������� ������)<br><b>3.</b> ������� ������� � �������� ����� � ������� �����<br><b>4.</b> �������� ���� cookies. <a href=clear.php target=_top class=menu>��������</a><br><b>5.</b> ��������� ���� ����� � ���� �� ����������.<br><br><div align=center>������� ����� � <a href=/ target=_top class=menu>������� ��������</a> ��� ���.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($clear==1){
	session_start(  );
	$_SESSION = array(  );
	unset( $_COOKIE[session_name(  )] );
	session_destroy(  );
	setcookie( 'Hash' );
	setcookie( 'UID' );
	setcookie( 'Puid' );
	print '<HTML><HEAD><LINK href=./css/error.css rel=STYLESHEET type=text/css><META content="text/html; charset=windows-1251" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><font color=#dd0000>��������! ������� ���� ���������.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><div align=center>������� ����� � <a href=http://legendbattles.ru/ target=_top class=menu>������� ��������</a> ��� ���.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($stats==1){
echo'
<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">������ �������� ������ ������������� ���������</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>1 ����</b> = 0.4 ���.�����, 1.5 ���� �����, ������ �� ���� ����� � ������ �����. <u>���� ���� <b>������</b> �������� � ����� - ���� ������������� � 2 ����.</u><br><b>1 ��������</b> = 3% �� �������, 4% �� ��������, 1.5��, 0.33% ������ �����. <u>���� ����������� <b>������</b> ���� � ����� - ����� ������ ����� ��� +0.5% �� ������ ���� (����������� �� �����������)</u><br><b>1 �����</b> = 4% �� ����������, 2 ����� ��� ����������� �����, 2% �� ��������, 1% �� ���������. <u>���� ������� <b>������</b> �������� � ���� - ����������� ���� ������������� � 2 ����.</u><br><b>1 ��������</b> = 9% �� ���������, 5 �����<br><b>1 �����</b> = 7 ���� , ���������� ����������� ����� ��������� �� 0.6%, 3% �� �������� <u>���������� ����� ��������� ���������� ����� ����������</u><br><b>1% ������������</b> = +1% ����� �� ���, -0.32% ����� �� ���������, ���������� ����� ������ ���������� � ������� ����������� ���� �� 1%, ���������� ���.����� �� 2, ���������� ���� ����� �� 3, ���������� ������ ����� ��������� �� 1% (������: ��� �� ������� 1000% � ����� 10% - �� ������� � ������� ����� ��������� ��� 1100%). <b>������ ������� �������� �������� 1% ������������.</b><br><br><b>��� ��������� �� ����� ����� � ���������� � ���������, �� ��� ��������� � �������� ��� � �������� � ���.</b><br><br>������������ ���� ����������: 80%<br>����������� ���� ����������: 6%<br>������������ ���� ������������ �����: 94%<br>����������� ���� ������������ �����: 6%<br><br><b>��:</b><br><br><b>��������</b> - ��������� ���� ���������� ����������<br><b>������</b> - ����������� ���� ����������<br><b>���������</b> - ��������� ���� �������� ����������� ����<br><b>����������</b> - ����������� ���� ������� ����������� ����<br><b>������� �����</b> - ��������� ���������� ����<br><b>������ �����</b> - ��������� ������������ ����� �����<br><br>��� �� �������� 1 � 1:<br> �� ���� 100% �������� ������ 100% ������ ������ ���� ���������� �� ������������ (6%). ��� �� � � ����������� ������ ���������.<br>���� �������� ��������� ���� ����� ������ ����-����, �� ���������, ��� ���� ��������� �� ������ ��, �� ��� � ����� ����������.<br></font></td></tr></tbody></table><p></p><br></td>
';
}
if($money==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">���������� � �������� ���������</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>LR</b> - �������� ������ ���������, ������������ ��� ��������� ����� ��������, �������� � ���������.<br><b>DLR</b> - ��������� ������, ������������� �� �������� ������ ��� �� LR � ������ ������� (� ������ ����� DLR). ����� ��� ������� ������ ���������� � ����������� � ���� ��������� (��). ����� ���� �������� ������ �������.<br><b>$</b> - ����� �������� ��� ������ ������ ��������� ������ (�������� DLR ������ ���������). �������� ������ ��� ��������� � ���� ���������. �� ����� ���� �������� ������ �������.<br></font></td></tr></tbody></table></td>';
}
if($buffs==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">������� �������� ����� � �� ��������</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>��������� ����� ����� � ����� ���������:</b><br>1. ����� �������������� - 5,15,25,50,75 � ������<br>2. ����� ������ ������ - 5,15,25,50,75 � ��������<br>3. ����� �������������� ������ - 5,15,25,50,75 � ����������<br>4. ����� ������ - 5,15,25,50,75 � ���������<br><br><b>��������� ����� ����� � ��� ���������:</b><br>1. ����� �������������� - 175,255 � ������<br>2. ����� ������ ������ - 175,255 � ��������<br>3. ����� �������������� ������ - 175,255 � ����������<br>4. ����� ������ - 175,255 � ���������</font></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><br><b>��� ����� ��������� 1 ���</b><br><br>������ ����� &lt;�������� �����&gt; = +5 � �����.<br>������ ����� ����� = +7 � �����.<br>������ ����� ����� = +50 � ��.<br>������ ����� ������ = +25 � ������ �����.<br>����� ���������������� = +15 � ������ "����������������".<br>����� ������ = +10% � ���������� ����� (�����, ��, ��, ������) � +10% � ����� ���������. (������������ ����� ������ ������ 1 ������ ������ �����)<br><br><br></font></td></tr></tbody></table></td>';
}
if($fish==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><div align=center><img src="http://img.legendbattles.ru/image/ribalka1.jpg"></div></td>';
}
if($taimer==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%">
<div class="content" style="text-align:center">
		<div>
            	<p class="main_text_aboutthegame">
                <font color=#003399><b>� ���� ���������� �������� �������</b>
                </p>
                <p class="main_text_aboutthegame">
				<font color=#CC0033><b>"������� ������������� ������� LegendBattles"</b>
				<font color=#003399><b>��� ���������� ����������� ������������ �������� <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14> </b>
               </p>
<center><a href="http://img.prntscr.com/img?url=http://i.imgur.com/L9T71jU.png" rel="lightbox" title="����������" onFocus="this.blur();"><img 
src="http://img.prntscr.com/img?url=http://i.imgur.com/L9T71jU.png" width="954" height="274" 
style="cursor:pointer;"></a></center>
				<p class="main_text_aboutthegame">
                <font color=#003399><b>��������.</b>
				</p>
				<p class="main_text_aboutthegame">
				������ ��� ��� ����� ��������� �������,������� ������� �� ���������� � ����.
				</p>
				��������! �� ���������� � ���� ��� ����� 1 �. 
				</p>
				��������! �� ���������� � ���� ��� ����� 2 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 3 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 4 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 5 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 6 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 7 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 8 �.
				</p>
				��������! �� ���������� � ���� ��� ����� 9 �.
				</p>
				� �� 10 ��� � ����� ��� ����� ����� ���������
				</p>
				 Legend Battles : �������� ������������� ���������� � ���� 10 �����. �� ��� ���������� �� �������� ����� 1 <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14> �������.
				</p>
				<center><strong>��� ������� ��� ������ ����� , �� ������� ���������� ���� �������������� ��������� � ��� ���������</strong></center>
<center><a href="http://i.imgur.com/Oh6yTMS.png" rel="lightbox" title="����������." onFocus="this.blur();"><img 
src="http://i.imgur.com/Oh6yTMS.png" width="694" height="361"></a></center>
                </p>
<center><strong>������ ��� �����</strong></center>
<br></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	</tr>	
		<td bgcolor="#FFFFFF"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3"></td>
	</tr>
	<tr>
<div style="background-color:#cacaca; width:100%;" align="center"><a class="button_register" 
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div></td>';
}
echo'</tr>';