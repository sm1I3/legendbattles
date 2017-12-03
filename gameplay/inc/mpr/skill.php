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
    0 => "Рукопашный бой",
    1 => "Владение мечами",
    2 => "Владение топорами",
    3 => "Владение дробящим оружием",
    4 => "Владение ножами",
    5 => "Владение копьями и метательным оружием",
    6 => "Владение тяжелыми алебардами",
    7 => "Владение магическими посохами",
    8 => "Владение экзотическим оружием",
    9 => "Владение двуручным оружием",
    10 => "Владение двумя руками",
    11 => "Дополнительные очки действия в бою",
    12 => "Магия огня",
    13 => "Магия воды",
    14 => "Магия воздуха",
    15 => "Магия земли",
    16 => "Сопротивление магии огня",
    17 => "Сопротивление магии воды",
    18 => "Сопротивление магии воздуха",
    19 => "Сопротивление магии земли",
    20 => "Сопротивление повреждениям",
    21 => "Воровство",
    22 => "Осторожность",
    23 => "Скрытность",
    24 => "Наблюдательность",
    25 => "Торговля",
    26 => "Странник",
    27 => "Книга маги огня",
    28 => "Книга маги земли",
    29 => "Ювелирное дело",
    30 => "Самолечение",
    31 => "Оружейник",
    32 => "Доктор",
    33 => "Быстрое восстановление маны"
);
	
$profs = array(
    68 => "Алхимия",
    70 => "Травничество",
    60 => "Лесоруб",
    59 => "Рыболов"
);
?>
<div class="block skill">
	<div class="header">
		<span>
			Развитие умений
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
                <input type="submit" value="Сохранить">
			</div>
			<div align=center id=frskdiv>
                Увеличение боевых, магических умений, сопротивления: <span id="skillbum"><?= $player[fr_bum] ?></span>
                единиц<br>
                Увеличение мирных умений: <span id="skillmum"><?= $player[fr_mum] ?></span> единиц
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