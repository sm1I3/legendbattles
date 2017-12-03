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
		<img src=http://w2.dwar.ru/info/pictures/image/yarmarka_mag.jpg width=960 height=260 border=0></fieldset></td></tr>
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
				<input type=text size=2 name=max_nv value="<?=(($_SESSION['max_nv']=='0')?'':$_SESSION['max_nv'])?>"><b></b> сортировка по 
				<select name=sorttype class=zayavki>
					<option value=1<?=(($_SESSION['sorttype']=='level')?' SELECTED':'')?>>уровню</option>
					<option value=0<?=(($_SESSION['sorttype']=='price')?' SELECTED':'')?>>стоимости</option>
				</select> 
				<input type=submit value="Ок">
			</form>
		</div>
		<div>
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
		<input type="button" class="lbut" onclick="location='?weapon_category=w4'" value="Клинки" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w7'" value="Посохи" />
		<input type="button" class="lbut" onClick="location='?weapon_category=w20'" value="Щиты" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w19'" value="Доспехи" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w0'" value="Эликсиры" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w70'" value="Мази и прочие" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w29'" value="Свитки" />
		<input type="button" class="lbut" onclick="location='?weapon_category=w71'" value="руны" />
		</td>
</tr>
<tr>	
		<input type="button" class="lbut" onclick="location='?weapon_category=w60'" value="Квестовые Ресурсы" />
	</td>
	</tr>
<tr>
</td></tr>
<tr><td></td></tr>
<tr><td>
<? if(isset($_GET['weapon_category'])){
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE items.dd_price=0 AND market='".$player['loc']."' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `price`<='".$_SESSION["max_nv"]."'":"")." AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
$num = (mysqli_num_rows($ITEMS)); 
if($num>0){
	echo '</table></td></tr></table>'; echo show_shop(0,$ITEMS,$mass);
}
else{?>
<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.</b></font></td></tr>
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


</SCRIPT>