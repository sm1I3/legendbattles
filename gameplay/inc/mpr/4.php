<tr><td>
<font class=proce>
<FIELDSET>
	<LEGEND align=center>
		<B>
			<font color=gray>&nbsp;������������&nbsp;</font>
		</B>
	</LEGEND>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
		<tr>
			<td>
				<font class=freemain>
					<b>
						<font color=#777777>������� E-mail: <?=$player[email]?></font>
					</b
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=6>
			</td>
		</tr><?php
if($player[finblock]<time()){
?><tr>
			<td>
				<form action="main.php?mselect=4" method="POST">
					<input type=hidden name=vcode value="<?=scod()?>">
					<input type=hidden name=post_id value=49>
					<input type=hidden name=act value=1>
					<font class=freemain>
						<b>
							<font color=#336699>
								����� E-mail: <input type=text name=newmail size=30 class=LogintextBox4 maxlength=50>
								<input type=image src=http://img.legendbattles.ru/image/change.gif width=72 height=15 border=0>
							</font>
						</b>
					</font>
					<font class=freetxt>
						<br />����� ����� e-mail �������� �� ����� ��������� �������� � ���������, ����������, ������ � ���������� �������� � ������� 24 �����. ����� ������ ����� ������� ������ ����� 48 ����� ����� ����� e-mail.<br /><br />
					</font>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form action="main.php?mselect=4" method="POST">
					<input type=hidden name=vcode value="<?=scod()?>">
					<input type=hidden name=post_id value=49>
					<input type=hidden name=act value=2>
					<font class=freemain>
						<b>
							<font color=#336699>
								������ ������: <input type=password name=opass size=15 class=LogintextBox5 maxlength=50>
								�����: <input type=password name=npass size=15 class=LogintextBox5 maxlength=50>
								������: <input type=password name=vpass size=15 class=LogintextBox5 maxlength=50>
								<input type=image src=http://img.legendbattles.ru/image/change.gif width=72 height=15 border=0 ><?=$msg?>
							</font>
						</b>
					</font>
					<font class=freetxt>
						<br />
						<b>
							����������� ����� ������ 4 �������.
						</b>
						<br />
						����� ����� ������ �������� �� ����� ��������� �������� � ���������, ����������, ������ � ���������� �������� � ������� 24 �����. ����� e-mail ����� ������� ������ ����� 48 ����� ����� ����� ������.<br /><br />
					</font>
				</form>
			</td>
		</tr><?php
	if($player['flash'] == '0'){
?><tr>
			<td>
				<form action="main.php?mselect=4" method=POST>
					<input type=hidden name=vcode value="<?=scod()?>">
					<input type=hidden name=post_id value=49>
					<input type=hidden name=act value=3>
					<font class=freemain>
						<b>
							<font color=#336699>������ ������</font>
						</b>
					</font>
					<font class=freetxt>
						<br />��������������� �������� ������ ��� ����� � ������� ����. ������������ ������ ����������. <br />
						<b>��� ��������� ����������� �������� ������, ������� �������� �� ������.</b>
						<br />
						<input type=checkbox name=emailc value=1 CHECKED> ����� ������ �� ��� E-mail.<br />
						<input type=radio name=pa_long value=5 CHECKED> <b>������� �������</b> (5 ����) 
						<input type=radio name=pa_long value=10> <b>������� �������</b> (10 ����) 
						<input type=submit value="����������" class=lbut>
				</form>
			</td>
		</tr><?php
	}
}else{
?><tr>
			<td>
				<font class=nickname>
					<font color=#cc0000>
						<b>�� �� ������ ������ ������ � email!</b>
					</font>
				</font>
			</td>
		</tr><?php
}
?></table>

<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=3 cellspacing=1 border=0 align=center>
<tr><td colspan=4 align=center class=ftit>����� �� 30 ��������� ������� ������ � ����.</td></tr>
<?  $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mlog WHERE typ='1' and login='".$player[login]."' ORDER BY time DESC LIMIT 0,30;");
$col=array(0=>"FCFAF3","FCFAF3");$i=0;
while ($row = mysqli_fetch_assoc($sql)) {
if($row[action]=="err: ������")$row[action]="<font color=#FF0000><b>err: ������</b></font>";
?>
<tr><td class=freetxt nowrap bgcolor=#<?=$col[$i]?>><?=$row['time']?></td><td class=freetxt nowrap align=center bgcolor=#<?=$col[$i]?>><B><?=$row[action]?></B></td><td class=freetxt align=center bgcolor=#<?=$col[$i]?>><?=$row[ip]?></td><td class=freetxt bgcolor=#<?=$col[$i]?> align=center><?=$row[brouser]?></td></tr>
<? if($i==0){$i++;}else{$i=0;}}?></table>
</td></tr></table>
</FIELDSET></td></tr>
