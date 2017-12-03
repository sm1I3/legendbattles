<?php
/* СОРТИРОВКА */
if(!empty($_POST['min_lev']) or !empty($_POST['max_lev']) or !empty($_POST['max_nv']) or !empty($_POST['sorttype'])){
	$_SESSION['min_lev'] = intval($_POST['min_lev']);
	$_SESSION['max_lev'] = intval($_POST['max_lev']);
	$_SESSION['max_nv'] = intval($_POST['max_nv']);
	if($_POST['sorttype'] == '0'){
		$_SESSION['sorttype'] = 'price';
	}elseif($_POST['sorttype'] == '1'){
		$_SESSION['sorttype'] = 'level';
	}else{
		$_SESSION['sorttype'] = 'price';
	}
}
if(empty($_SESSION['min_lev'])){
	$_SESSION['min_lev'] = '0';
}
if(empty($_SESSION['max_lev'])){
	$_SESSION['max_lev'] = '33';
}
if(empty($_SESSION['sorttype'])){
	$_SESSION['sorttype'] = 'level';
}
/* КАТЕГОРИИ */
if(isset($_GET['weapon_category'])){
	$_SESSION['mark']=$_GET['weapon_category'];
}
if($_SESSION['mark']!=''){
	$_GET['weapon_category']=$_SESSION['mark'];
}
?>
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10>
<br></td></tr>
<tr><td>

<table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
<tr align=center><td align=center><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/shops/Alar.png width=760 height=255 border=0 align=center></fieldset></td></tr>
<!----><tr><td bgcolor=#f5f5f5><?php
            echo '<form method=post><div align=center><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=min_lev class=zayavki>';
for($i=0;$i<=33;$i++){
	echo'<option value='.$i.(($_SESSION['min_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
}
            echo '</select> до <select name=max_lev class=zayavki>';
for($i=0;$i<=33;$i++){
	echo'<option value='.$i.(($_SESSION['max_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
}
            echo '</select> не дороже <input type=text size=2 name=max_nv value="' . (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) . '" class=LogintextBox6><b>LR</b> сортировка по <select name=sorttype class=zayavki><option value=1' . (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') . '>уровню</option><option value=0' . (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') . '>стоимости</option></select> <input type=submit value=" ok " class=lbut></font></div></form>';
?></td></tr><tr><td bgcolor=#CCCCCC width=100%><img src=/img/image/1x1.gif width=1 height=1 width=40 height=50></td></tr>
<tr><td>
        <input type=image src=/img/image/gameplay/shop/ddf.png onClick="location='?weapon_category=w62'" title="Сундуки"
               width=40 height=50>
</table></td></tr></table>
<? if(isset($_GET['weapon_category'])){
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE  market='".$player['loc']."' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `price`<='".$_SESSION["max_nv"]."'":"")."  AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
$num = (mysqli_num_rows($ITEMS)); 
if($num>0){
	echo '</table></td></tr></table>'; echo show_shop(0,$ITEMS,$mass);
}
else{?>
    <table cellpadding=5 cellspacing=1 border=0 width=100%>
    <tr>
        <td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.</b></font></td>
    </tr>
<? }?>
</table>

<? }
function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
        case 40:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>";
            break;
        case 70:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>";
            break;
        case 90:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>";
            break;
    	}}}
?>
</td></tr>
</table>
</td></tr>
</table>
</fieldset>

<SCRIPT src="./js/t_v01.js"></SCRIPT> 
<SCRIPT src="./js/stooltip.js?v11"></SCRIPT> 
<SCRIPT language='JavaScript'>
			
			//var i=0;
			//var frame = window.parent.frames[0].document;
			//var content = frame.contents().find("#tt")
			//parent.$("#main_top").load(function(){
			//for(var r=1;r<='.$r.';r++){
				//parent.$("#t"+r+"").css({height: parent.$("#r"+r+"").height()});
				//if(parent.frames["main_top"].$("tr#test_1")){
					//alert(frame.$("tr#test_1").width());
				//}
			//}
			//});

NewLinksView();
</SCRIPT>