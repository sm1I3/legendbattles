<SCRIPT src="./js/addperk.js"></SCRIPT>
<? if($player[perk]==''){$player[perk]="|||||||||||||||||||||||||||||";}
$perk=explode("|",$player[perk]);foreach($perk as $key=>$val){if($val=='')$perk[$key]=0;}
$perk_name = array("�������� � �����","������ ����","����������", "������� �����", "�������", "������ ����������", "���������", "������ ����", "������ ��������", "������ ��������", "������ �����", "������ ������", "������", "�����", "��������", "���������� ����", "���������� ���", "���������� ������", "��������� �����", "��������������", "���������� ����", "���������", "���� �������", "���� ������", "��� ����", "��� �������", "��� �����", "��� ����", "������������� ����� ����", "������������� ����� ����", "������������� ����� �������", "������������� ����� �����", "�����������");
?>
<div class="block perks">
	<div class="header">
		<span>������ � ���������</span>
	</div>
	<div class="content">
		<FORM action=main.php?mselect=perk name=saveperk method=POST>
<? foreach ($perk_name as $key => $val) {?>
			<div class="perk">
<? if($perk[$key]==0 and $player[nav]>0){?>
				<a href="javascript: AddPerk('<?=$key?>');">+</a>
				<a href="javascript: RemovePerk('<?=$key?>');">-</a>
<?}?> 
				<?=$val?>
				<span class="cnt" id=p<?=$key?>><? if($perk[$key]==0){echo "���";}else{echo "<b>��</b>";}?></span>
				<input type=hidden name=f[<?=$key?>] value=<?=$perk[$key]?>>
			</div>
<?}?>
		
<? if($player[nav]>0){?>
			<div class="save">
				<input type="submit" value="���������">
			</div>
<?}?>
			<div id=frpediv>��������� ����� ������: <?=$player[nav]?></div>
			<INPUT TYPE=hidden name=vcode value=<?=scode()?>>
			<INPUT TYPE=hidden name=post_id value=17>
			<INPUT TYPE=hidden name=currnav value=<?=$player[nav]?>>
		</FORM>
	</div>
</div>