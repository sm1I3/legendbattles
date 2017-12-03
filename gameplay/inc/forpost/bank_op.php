<?


?>
<?
$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bank` WHERE `id`='".$player['id']."' AND `num`='". $_SESSION['chet']."' AND `pass`='".$_SESSION['chet']."';");
$chet=mysqli_fetch_assoc($sql);


?>
<FIELDSET><LEGEND><B>Управление счетом</B> </LEGEND>
<TABLE>
<TR><TD valign=top>
<TABLE>
<TR><TD>Номер счета</td> <TD colspan=2>
        <? inschet($_SESSION['user']['id']); ?>
</td></tr>
<TR><TD>Пароль</td><td> <INPUT style='width:90;' type=password value="" name=pass></td><TD style='padding: 0, 0, 3, 5'><img border=0 SRC="http://img.combats.com/i/misc/klav_transparent.gif" style='cursor: hand' onClick="KeypadShow(1, 'F2', 'pass', 'keypad2');"></TD></tr>
<TR><TD colspan=3 align=center><INPUT TYPE=submit value="Войти" name=enter></td></tr>
</TABLE>
</TD>
<TD><div id="keypad2" align=center style="display: none;"></div></TD></TR>
</TABLE>
</FIELDSET>
</TD></TR></TABLE>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>