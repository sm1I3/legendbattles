<tr><td><font class=proce><font color=#222222><FIELDSET><LEGEND><B>&nbsp;����������&nbsp;</B></LEGEND>
<script src="/js/achievements.js"></script>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/inc/achievements.php'); ?>

<?
$wins=explode("|",$player['wins']);
if($player['umen']==''){$player['umen']="||||||||||||||||||||||||||||||||||||";}
$um=explode("|",$player['umen']);
$checkAchieve=explode("|",$player['achievements']);
$json = json_encode($um);
$json2 = json_encode($wins);
$regDate = $player['reg_date'];
$currentDate = date('y-m-d H:m:s');
$gameDate = date_diffe($regDate, $currentDate) ;
$gameDate = floor($gameDate/31536000);
$json3 = json_encode($gameDate);
$lesnik = $player['les'];
$fisher = $player['fish_skill'];
$travnik = $player['trav'];
$alchemist = $player['alhim'];
$json4 = json_encode($lesnik);
$json5 = json_encode($travnik);
$json6 = json_encode($alchemist);
$json7 = json_encode($fisher);
$student = $player['good_pupils_count'];
$json8 = json_encode($student);



$achs = array(
	array(
		1=>'���������',
		2=>'������� �� ��������',
		3=>'������ �����'),
	array(
		11=>'���������',
		12=>'����� ������',
		13=>'����������',
		14=>'��������'),
	array(
		4=>'������� ������',
		5=>'���������',
		6=>'�������',
		7=>'������ �������',
    8=>'������� ������',		
		9=>'�������������'),
	array(
		20=>'�������',
		30=>'�������',
		40=>'�����',
		50=>'�����',
    60=>'������',		
		80=>'������',	
		100=>'�������',
		150=>'������'
	)
);
$rim = array('I','II','III','IV','V','VI','VII','VIII','IX','X');
$nagrada = array(1000,2000,3000,4000,5000,6000,7000,8000,9000,10000);

?>
<script> var um = <?=$json?>; 
var wins = <?=$json2?>; 
var gameDate = <?=$json3?>;
var lesnik = <?=$json4?>;
var travnik = <?=$json5?>;
var alchemist = <?=$json6?>;
var fisher = <?=$json7?>;
var student = <?=$json8?>;</script>

<table cellpadding="2" cellspacing="1" width="95%" align="center" style="border:1px solid #e2e2e2;"><tr><td bgcolor="#e2e2e2" align="center">
<input type="button" class="lbut" value="������ ����������" onclick="table1_onclick()"/>
<input type="button" class="lbut" value="������� ����������" onclick="table2_onclick()" />
<input type="button" class="lbut" value="������ ����������" onclick="table3_onclick()" />
<input type="button" class="lbut" value="������ ����������" onclick="table4_onclick()" />
</td></tr>
<tr><td>
<?
foreach ($achs as $key => $ach_t) {
?>
<table id="table<?=$key+1?>_p" align="center"<?=(($key!=0)?'style="display:none"':'')?>>
<?
foreach ($ach_t as $key1 => $ach) {
?>
<tr>
<?
for ($i=1;$i<=10;$i++) {
?>
<td>
	<div>
		<img id="<?=$key1?>_<?=$i?>" class="img_progress" style="float: left; width: 56px; height: 56px; background: url(http://legendbattles.ru/achievement/<?=$key1?>/a_<?=$key1?>_<?=$i?>.gif);" width="56" height="56" onmouseover="tooltip(this,'<b><?=$ach?> <?=$rim[$i-1]?></b><br>��������: 0 / 1000<br>�������: <?=$nagrada[$i-1]?> �����, 2000 NV')" onmouseout="hide_info(this)" />
	</div>
</td>
<?
}
?>
</tr>
<?
}
?>
</table>
<?
}
?>

<div id="floatTip"></div>
<?php
checkAchievements($um, $wins, $checkAchieve, $gameDate, $travnik, $fisher, $lesnik, $alchemist, $student); ?>
<script>doneAchieve(um, wins, gameDate, travnik, fisher, lesnik, alchemist, student);</script>
