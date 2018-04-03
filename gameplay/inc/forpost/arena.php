<LINK href="./css/frame.css" rel="STYLESHEET" type="text/css">
<SCRIPT src="./js/arena.js"></SCRIPT>
<SCRIPT src="./js/signs.js"></SCRIPT>
<SCRIPT src="./js/logs.js"></SCRIPT>

<?
$room = array ("6"=>0,"7"=>1,"8"=>2,"9"=>3,"10"=>4,"11"=>5,"12"=>6,"13"=>7,"14"=>8,"15"=>9);
if (isset($_GET['sh'])) {
    $_SESSION['user']['sh'] = $_GET['sh'];
}
if (isset($_GET['ft'])) {
    $_SESSION['user']['ft'] = $_GET['ft'];
}
if ($_SESSION['user']['sh'] == '') {
    $_SESSION['user']['sh'] = 1;
}
if ($player['battle'] != 0) $msg = "Ожидание начала боя!";
if ($_SESSION['user']['sh'] == 1 and $_SESSION['user']['ft'] != 1) {
    $fir = "(((arena.style)='" . $_SESSION['user']['ft'] . "') AND ((arena.vis)='1') AND ((arena.downl)<='$player[level]') AND ((arena.upl)>='$player[level]')) OR (((arena.style)='" . $_SESSION['user']['ft'] . "') AND ((arena.vis)='1') AND ((arena.arena)='$player[loc]') AND ((arena.downr)<='$player[level]') AND ((arena.upr)>='$player[level]'))";
} else if ($_SESSION['user']['sh'] == 1 and $_SESSION['user']['ft'] == 1) {
    $fir = "style='" . $_SESSION['user']['ft'] . "' AND upl='$player[level]' AND vis='1' AND arena='$player[loc]'";
} else {
    $fir = "style='" . $_SESSION['user']['ft'] . "' and vis='1' AND arena='$player[loc]'";
}
if ($_SESSION['user']['ft'] == 3 and $player['level'] < 5) {
    $msg = "В жертвенных боях можно участвовать только с 5 левела!";
}
if ($_SESSION['user']['ft'] == 4) {
    $msg = "Статистика пока не доступна";
}
$locname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));
echo '
<div class="block info">
	<div class="header">
		<span>'.$locname['loc'].'</span>
	</div>
<tr align=center><td align=center>
<table cellpadding=0 cellspacing=1 border=0 align=center width=760 >
<tr><td>&nbsp;</td><td align=center width=760><img src=/img/image/cities/city/arena.jpg width=760 height=255 border=0></td><td>&nbsp;</td></tr>
<tr align=center><td colspan=3 align=center><center>';
?>

<SCRIPT language="JavaScript">
var d = document;
var arpar = ["<?=$player['login']?>",<?=$player['level']?>, 0, "none", "<?=$player['clan']?>", "", 2, "main",<?=$_SESSION['user']['ft'];?>, 0,<?=$player['battle'];?>, 0, "<?=$msg?>",<?=$_SESSION['user']['sh']?>, 0,<?=$room[$player['loc']]?>, "", "n",<?=time()?>, "", "<?=date("d.m.y");?>", "0"];
var inshp = [0,0,0,0,0,0];
var vcode = ["<?=scode()?>","<?=scode()?>","<?=scode()?>","<?=scode()?>","<?=scode()?>","<?=scode()?>"];
var crcount = [<?=ar_rooms();?>];
var data = [<? 
$ARENA_SQL = mysqli_query($GLOBALS['db_link'],"SELECT * FROM arena WHERE $fir;");

$num=mysqli_num_rows($ARENA_SQL);
while ($row = mysqli_fetch_assoc($ARENA_SQL)) {
if($row['time_start']<time()){updatebatt($row['id_battle']);continue;}
    if ($_SESSION['user']['ft'] != 1) {
        if ($row['kol1'] + $row['kol2'] == testarena($row['id_battle'])) {
            startbat($row['id_battle'], 1);
        }
    }
echo "[".$row['id_battle'].",".$row['type'].",\"".$row['time']."\",".$row['time_start'].",".$row['timeout'].",".$row['travma'].",".$row['downl'].",".$row['upl'].",0,\"\",".$row['ok1'].",".$row['kol1'].",".$row['downr'].",".$row['upr'].",0,\"\",".$row['ok2'].",".$row['kol2'].",0,0,0,0,[";

$BATT_SQL = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE battle='".$row['id_battle']."'");
$a='';$b='';$ar='';$b1=" ";
while ($pla = mysqli_fetch_assoc($BATT_SQL)) {
    if ($_SESSION['user']['ft'] == 3) {
if($pla['side']==1){$a .= "$ar"."[]";$ar=",";
}else{$b .= "$b1"."[]";$b1=",";}}
    if ($_SESSION['user']['ft'] != 3) {
if($pla['side']==1){$a .= "$ar"."[1,\"".$pla['login']."\",".$pla['level'].",\"$pla[clan_gif]\",$pla[sklon]]";$ar=",";
}else{$b .= "$b1"."[1,\"".$pla['login']."\",".$pla['level'].",\"$pla[clan_gif]\",$pla[sklon]]";$b1=",";}}
}
echo "$a],[$b]]"; 
if ($num>1){$num--;echo ",";}
}?>];
<? if(isset($del)) echo "arpar[12]='$del';";?>
view_arena();
</SCRIPT>
<?
echo '</div>';
?>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>