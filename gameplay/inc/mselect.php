<? 
$pris=explode("|",$player['prison']);
if($pris[0]>time()){
	mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `used`='0' WHERE `pl_id`='".$player['id']."';");
}
calcstat($player['id']);
testcompl();
$m = array('skill','perk','settings','gifts','secure','pers-info','pay','9','33','kazino'); 
$m1 = array('������','������','���������','������� � ��������','������ ������������','� ���','������� � ��������','����� ��������','��','�����'); 
$m2 = array('������','������','���������','�������','������������','������','�������','����� ��������','��','�����'); 
$m3 = array('menu12','menu8','menu9','menu10','menu7','menu3','menu2','emerald','slot','kosti'); 
?>
<div class="nav">
	<a href="http://forum.legendbattles.ru" title="�����" target="_blank">�����</a>
	<a href="?mselect=teach" title="������">������</a>
	<a href="?mselect=achiev" title="����������">����������</a>
	<a href="?mselect=referal" title="���� �������� - ��������� � ������">��������</a>
	<a href="?mselect=guest" title="������ �������">������ �������</a>
	<a href="/maps.php" title="�����" target="_blank">�����</a>
	<a href="?mselect=obmen" title="����� ������">����� ������ <img src=img/razdor/emerald.png width=14 height=14></a>
	<a href="?mselect=33" title="����">����</a>

</div>
<div class="abil">
<?
for ($i=0;$i<=7;$i++) {
?>
	<div>
		<a href="?mselect=<?=$m[$i]?>" title="<?=$m1[$i]?>">
			<img src="img/razdor/<?=$m3[$i]?>.png" width="35" height="35">
			<span><?=$m2[$i]?></span>
		</a>
	</div>
	<?
}
?>
</div>