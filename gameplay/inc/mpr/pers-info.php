<div class="block pers-info">
	<div class="header">
		<span>���������� � ���������</span>
	</div>
	<div class="content">
		<form action="main.php?mselect=pers-info" method=POST>
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=5>
			<input type=hidden name=de value=800>
			<input type=hidden name=vcode value=<?=scode()?>>
			<div class="field">
				<label for="newname">���� ���: </label>
				<input type=text name=newname size=30 maxlength=50 value="<?=$player[name]?>">
			</div>
			<div class="field">
				<label for="bday">���� ��������: </label>
				<input type="text" name="bday" disabled value="<?=$player[bday]?>">
				<div class="info">
					������� ������� ��������� �������� ��� � ���� ��������.<br>��� ������ ��� ����� ���������� ��� �������������� �����.
				</div>
			</div>
			<div class="field">
				<label for="newcountry">������: </label>
				<input type=text name=newcountry size=30 maxlength=50 value="<?=$player[country]?>">
			</div>
			<div class="field">
				<label for="newcity">�����: </label>
				<input type=text name=newcity size=30 maxlength=50 value="<?=$player[city]?>">
				<div class="info">
					����� ��������� ��������� �������� ������. ��� ����� ��� ���������� ��� �������������� �����, ��� ��������� ���� � ������ �������, � �� ������� ���������� � �������������� ������ � ����� ��������������.
				</div>
			</div>
			<div class="field">
				<label for="newaddon">�������������: </label>
				<textarea cols=61 rows=10 name=newaddon><?=$player[addon]?></textarea>
				<div class="info">
					�������������� ���������� � ��� (�������� ����������). ������������� ����������� �������� ���� ����������, ������� ����� ��������� ��� ����� ��������������� ������ (���� � ������ �����, ������, ����, ��������� ���� � ��� �����). ������������ ����� ��������� - 800 ��������.
				</div>
			</div>
			<div class="field">
				<label for="newabout">� ����: </label>
				<textarea cols=61 rows=10 name=newabout><?=deCodes($player[about])?></textarea>
				<div class="info">
					����������, ��������� ��� ������ ���������� ����. ������������ ����� ��������� - 800 ��������.
				</div>
			</div>
			<div class="save">
				<input type="submit" value="���������">
			</div>
		</form>
		<div class="clear"></div>
	</div>
</div>