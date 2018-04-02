<div class="block presents">
	<div class="header">
        <span>Подарки и открытки</span>
	</div>
	<div class="content">
        <? $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podarki WHERE id='" . $player['id'] . "';");
if(mysqli_num_rows($sql)>0){
$i=0;
while ($r = mysqli_fetch_assoc($sql)) {
$vcod=scode();
//if($r['podarok']<9996){
//echo "<img src=/img/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]. Действителен до: ".date("d.m.Y",$r['srok'])."\" onClick=\"javascript: if(parent.DeleteTrue('Подарок')) { location='main.php?post_id=51&uid=$player[id]&wn=$r[podarok]&vcode=$vcod' }\">";
//}
//else 
$opencheck=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `mark_pod`.`open`,`mark_pod`.`id` FROM `mark_pod` WHERE `id`='".$r['podarok']."' LIMIT 1;"));
if($opencheck['open']=='1'){
    echo "<img src=/img/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]\" style=\"cursor:pointer;\" onClick=\"javascript: if(parent.DeleteTrueNG('Подарок')) { location='main.php?post_id=52&uid=$player[id]&wn=$r[podarok]&vcode=$vcod&ul=$player[login]' }\">";
}
else{
	echo "<img src=/img/image/presents/f$r[podarok].gif width=80 height=80 title=\"$r[message]\">";
}
$i++;
if($i==11){echo "<br>";$i=0;}
}
} else {
    ?>
    <div style="text-align:center">У Вас нет подарков и открыток</div><? } ?>
	</div>
</div>