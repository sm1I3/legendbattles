<div class="block secure">
	<div class="header">
		<span>������������</span>
	</div>
	<div class="content">
		<div class="field">
			<label>������� E-mail:</label>
			<span style="line-height:28px"><?=$player[email]?></span>
		</div>
<?if($player[finblock]<time()){?>
		<form action="main.php?mselect=secure" method="POST">
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=1>
			<div class="field">
				<label for="newmail">����� E-mail:</label>
				<input type=text name=newmail size=30 maxlength=50>
				<div class="info">
					����� ����� e-mail �������� �� ����� ��������� �������� � ���������, ����������, ������ � ���������� �������� � ������� 24 �����. ����� ������ ����� ������� ������ ����� 48 ����� ����� ����� e-mail.
				</div>
			</div>
		</form>
		<form action="main.php?mselect=secure" method="POST">
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=2>
			<div class="field">
				<label for="opass">������ ������: </label>
				<input type=password name=opass size=15 maxlength=50>
			</div>
			<div class="field">
				<label for="npass">�����: </label>
				<input type=password name=npass size=15 maxlength=50>
				<div class="info">
					����������� ����� ������ 4 �������.
				</div>
			</div>
			<div class="field">
				<label for="vpass">������: </label>
				<input type=password name=vpass size=15 maxlength=50>
				<div class="info">
					����� ����� ������ �������� �� ����� ��������� �������� � ���������, ����������, ������ � ���������� �������� � ������� 24 �����. ����� e-mail ����� ������� ������ ����� 48 ����� ����� ����� ������.
				</div>
			</div>
			<div class="save">
				<input type="submit" value="���������">
			</div>
			<?=$msg?>
		</form>
<?if($player['flash'] == '0'){?>
		<form action="main.php?mselect=secure" method=POST>
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=3>
			<div class="field">
				<label for="pa_long">������ ������</label>
				<input type=checkbox name=emailc value=1 CHECKED> ����� ������ �� ��� E-mail.<br />
				<input type=radio name=pa_long value=5 CHECKED> <b>������� �������</b> (5 ����) 
				<input type=radio name=pa_long value=9> <b>������� �������</b> (9 ����) 
				<div class="info">
					��������������� �������� ������ ��� ����� � ������� ����. ������������ ������ ����������. <br />
					<b>��� ��������� ����������� �������� ������, ������� �������� �� ������.</b>
				</div>
			</div>
			<div class="save">
				<input type=submit value="����������">
			</div>
		</form>
<?}
} else {?>
		<div>�� �� ������ ������ ������ � email!</div>
<?}?>
		<div class="header">����� �� 30 ��������� ������� ������ � ����.</div>
		<table width=100% class="otch">
<?  $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mlog WHERE typ='1' and login='".$player[login]."' ORDER BY time DESC LIMIT 0,30;");
$col=array(0=>"FCFAF3","FCFAF3");$i=0;
while ($row = mysqli_fetch_assoc($sql)) {
if($row[action]=="err: ������")$row[action]="<font color=#FF0000><b>err: ������</b></font>";
?>
			<tr>
				<td>
					<?=$row['time']?>
				</td>
				<td>
					<B><?=$row[action]?></B>
				</td>
				<td>
					<?=$row[ip]?>
				</td>
				<td>
					<?=$row[brouser]?>
				</td>
			</tr>
<? if($i==0){$i++;}else{$i=0;}}?>
		</table>
	</div>
</div>