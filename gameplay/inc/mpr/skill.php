<? if($player['umen']==''){$player['umen']="||||||||||||||||||||||||||||||||||||";}
$pt=allparam($player);
$um=explode("|",$player['umen']);
foreach($um as $key=>$val){	
	if($key>=1 and $key<=9){		
		$ptkey=$key+35;
	    $umt[$key]=$pt[$ptkey];
	}
	else if(($key>=21 and $key<=23) || ($key>=27 and $key<=33) || ($key>=25 and $key<=26)){	
		$ptkey=$key+32;	
	}
	else
		$ptkey = $key;
	if($ptkey==65){$ptkey+=1;}
	if(!$val){$um[$key]=0;}
	if ($ptkey == $key) {
		$umt[$key] = $val;
	}
	else {
		$umt[$key]=$pt[$ptkey];
	}
	if (!$umt[$key])
		$umt[$key] = 0;
}
$nablud=$player['nablud'];

$skills = array(
	0 => "���������� ���",
	1 => "�������� ������",
	2 => "�������� ��������",
	3 => "�������� �������� �������",
	4 => "�������� ������",
	5 => "�������� ������� � ����������� �������", 
	6 => "�������� �������� ����������", 
	7 => "�������� ����������� ��������", 
	8 => "�������� ������������ �������", 
	9 => "�������� ��������� �������", 
	10 => "�������� ����� ������", 
	11 => "�������������� ���� �������� � ���", 
	12 => "����� ����", 
	13 => "����� ����", 
	14 => "����� �������", 
	15 => "����� �����", 
	16 => "������������� ����� ����", 
	17 => "������������� ����� ����", 
	18 => "������������� ����� �������", 
	19 => "������������� ����� �����", 
	20 => "������������� ������������",
	21 => "���������",
	22 => "������������", 
	23 => "����������", 
	24 => "����������������", 
	25 => "��������", 
	26 => "��������",
	27 => "����� ���� ����",
	28 => "����� ���� �����",
	29 => "��������� ����", 
	30 => "�����������", 
	31 => "���������", 
	32 => "������", 
	33 => "������� �������������� ����"
);
	
$profs = array(
	68 => "�������",
	70 => "������������",
	60 => "�������",
	59 => "�������"
);
?>
<div class="block skill">
	<div class="header">
		<span>
			�������� ������
		</span>
	</div>
	<div class="content">
		<SCRIPT src="/js/addskill.js"></SCRIPT>
		<FORM action="main.php?mselect=skill" name=saveskill method=POST>
<?foreach ($skills as $key => $value) {
	$per = (($key==24)?$nablud:$umt[$key]);
	if ($per > 100) 
		$per = 100;?>
			<div class="sk">
				<div class="lines">
					<div class="line" style="width:<?=$per?>%"></div>
					<div class="dopline" id="dop<?=$key?>"></div>
				</div>
				<div class="text">
<?if((($key==24)?$nablud:$umt[$key])<100 and (($player[fr_mum]>0 && $key>=21) || ($player[fr_bum]>0 && $key<=21))){?>
					<a href="javascript: AddSkill('<?=$key?>');">+</a> <a href="javascript: RemoveSkill('<?=$key?>');">-</a>
<?}?>
					<span class="name"><?=$value?></span> <span class="cnt" id="sk<?=$key?>"><?=(($key==24)?$nablud:$umt[$key])?>/100</span>
					<INPUT TYPE=hidden name=h<?=$key?> value=<?=$um[$key]?>>
					<INPUT TYPE=hidden name=f[<?=$key?>] value=<?=$um[$key]?>>
				</div>
			</div>
<?}
if($player[fr_mum]>0 or $player[fr_bum]>0){?>
			<div class="save">
				<input type="submit" value="���������">
			</div>
			<div align=center id=frskdiv>
				���������� ������, ���������� ������, �������������: <span id="skillbum"><?=$player[fr_bum]?></span> ������<br>
				���������� ������ ������: <span id="skillmum"><?=$player[fr_mum]?></span> ������
			</div>
<?}?>
			<INPUT TYPE=hidden name=vcode value="<?=scode()?>">
			<INPUT TYPE=hidden name=post_id value="16">
			<INPUT TYPE=hidden name=freeskills value="<?=$player[fr_bum]?>">
			<INPUT TYPE=hidden name=freeskillsmir value="<?=$player[fr_mum]?>">
			<INPUT TYPE=hidden name=mselect value="1">
		</FORM><br>
			</div>
		</div>
	</div>
</div>