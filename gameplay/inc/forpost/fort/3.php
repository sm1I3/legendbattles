<div style="text-align:center;font-weight:bold;">������������� ��������: <?php echo $Fort['bless']; ?></div>
����� ��������� ����� ������ �� LR �������� ��������� ��������� �������������<!--, � ��� �� ��������������� �����, ���� � ���������-->. �������� ������������� ����� �� ���� ������ ���� � ����� ��� ������ ������, ������������ ������������� - 5 �����.
<div style="font-weight:bold;">��������� �������������:</div>
<form method="post">
<?php
$GetBless = explode('/',$Fort['bless']);
if($GetBless[1] > 7){
echo'<input type="radio" name="bless" value="1" class="check">��������� ����������� ���� �� 30%<br>
<input type="radio" name="bless" value="2" class="check">��������� ����������� ������ �� 30%<br>
<input type="radio" name="bless" value="3" class="check">��������� ������ � ������ �������� �� 10%<br>
<input type="radio" name="bless" value="4" class="check">��������� ������������ �� ������� �� 20%<br>';
}else{
echo'<input type="radio" name="bless" value="1" class="check">��������� ����������� ���� �� 15%<br>
<input type="radio" name="bless" value="2" class="check">��������� ����������� ������ �� 15%<br>
<input type="radio" name="bless" value="3" class="check">��������� ������ � ������ �������� �� 5%<br>
<input type="radio" name="bless" value="4" class="check">��������� ������������ �� ������� �� 10%<br>';
}
?>
<input type="hidden" name="cat" value="3" />
<input type="submit" name="process" value="������������" class="lbut">
</form>
