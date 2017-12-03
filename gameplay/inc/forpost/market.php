
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
$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));
?>
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
?>
<div class="block market">
	<div class="header">
		<span><?=$locname['loc'];?></span>
	</div>
	<div class="content" style="text-align:center">
		<img src=/img/image/cities/city/lavka_shop_2.jpg width=760 height=255 border=0 align=center>
		<div>
			<form method=post>
                <b>Фильтр: </b>уровень от
				<select name=min_lev class=zayavki>
<?for($i=0;$i<=33;$i++){?>
					<option value=<?=$i.(($_SESSION['min_lev']==$i)?' SELECTED':'')?>><?=$i?></option>
<?}?>
                </select> до
				<select name=max_lev class=zayavki>
<?for($i=0;$i<=33;$i++){?>
					<option value=<?=$i.(($_SESSION['max_lev']==$i)?' SELECTED':'')?>><?=$i?></option>
<?}?>
                </select> не дороже
                <input type=text size=2 name=max_nv
                       value="<?= (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) ?>"><b>LR</b> сортировка по
				<select name=sorttype class=zayavki>
                    <option value=1<?= (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') ?>>уровню</option>
                    <option value=0<?= (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') ?>>стоимости</option>
				</select>
                <input type=submit value="Ок">
			</form>
		</div>
		<div>
            <input type=image src=/img/image/gameplay/shop/knife.gif onClick="location='?weapon_category=w4'"
                   title="Ножи" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/sword.gif onClick="location='?weapon_category=w1'"
                   title="Мечи" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/axe.gif onClick="location='?weapon_category=w2'"
                   title="Топоры" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/crushing.gif onClick="location='?weapon_category=w3'"
                   title="Дробящие" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/spears_helbeards.gif onClick="location='?weapon_category=w6'"
                   title="Алебарды и двуручное" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/missle.gif onClick="location='?weapon_category=w5'"
                   title="Копья и метательное" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/wand.gif onClick="location='?weapon_category=w7'"
                   title="Посохи" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/shield.gif onClick="location='?weapon_category=w20'"
                   title="Щиты" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/helm.gif onClick="location='?weapon_category=w23'"
                   title="Шлемы" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/belt.gif onClick="location='?weapon_category=w26'"
                   title="Пояса" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/armor_light.gif onClick="location='?weapon_category=w18'"
                   title="Кольчуги" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/armor_hard.gif onClick="location='?weapon_category=w19'"
                   title="Доспехи" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/gloves.gif onClick="location='?weapon_category=w24'"
                   title="Перчатки" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/armlet.gif onClick="location='?weapon_category=w80'"
                   title="Наручи" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/boots.gif onClick="location='?weapon_category=w21'"
                   title="Сапоги" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/amulet.gif onClick="location='?weapon_category=w25'"
                   title="Кулоны" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/ring.gif onClick="location='?weapon_category=w22'"
                   title="Кольца" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/spaudler.gif onClick="location='?weapon_category=w28'"
                   title="Наплечники" width=40 height=50>
            <input type=image src=/img/image/gameplay/shop/knee_guard.gif onClick="location='?weapon_category=w90'"
                   title="Поножи" width=40 height=50>
		</div>
	</div>
</div>
<? if(isset($_GET['weapon_category'])){
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE items.dd_price=0 AND market='".$player['loc']."' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `price`<='".$_SESSION["max_nv"]."'":"")." AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
$num = (mysqli_num_rows($ITEMS)); 
if($num>0){
	echo '</table></td></tr></table>'; echo show_shop(0,$ITEMS,$mass);
}
else{?>
    <table cellpadding=5 cellspacing=1 border=0 width=100%>
    <tr>
    <tr>
        <td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.</b></font></td>
    </tr>
<? }?>
</table>
<? }?>
</td></tr>
</table>
</td></tr>
</table>

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