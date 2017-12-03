<?
foreach($_POST as $keypost=>$val){$_POST[$keypost] = varcheck($val);}
foreach($_GET as $keyget=>$val){$_GET[$keyget] = varcheck($val);}// AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' 
if(isset($_GET['weapon_category'])){
	$_SESSION['mark']=$_GET['weapon_category'];
}
if($_SESSION['mark']!=''){
	$_GET['weapon_category']=$_SESSION['mark'];
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<tr><td align=center><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/gameplay/workshop.jpg width=760 height=255 border=0></fieldset><div id="wind" style="position:absolute; visibility: hidden; z-index:1000;left: 50%; top: 155px;margin-left: -137px;"></div></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=1></td></tr>
<tr><td bgcolor=#e0e0e0><table cellpadding=0 cellspacing=1 border=0 width=100%>
            <tr>
                <td colspan=2 bgcolor=#F9f9f9>
                    <div align=center><font class=inv><b> У Вас с собой <?= lr($player[nv]) ?> и вещей
                                массой: <?= $plstt[71] ?> Максимальный вес: <?= $mass ?></b></div>
                </td>
            </tr>
<tr>
    <td width=100% align=center bgcolor=#F9f9f9><a href="?art=0"><?= (!$_GET['art'] ? '<b>' : '') ?>модификация простых
            предметов<?= (!$_GET['art'] ? '</b>' : '') ?></a></td>
	
</tr>
<tr><td bgcolor=#ffffff colspan=2><table cellpadding=0 cellspacing=6 border=0 align=center width=100%>
<?
//выводим элементы нужного типа
	echo'
            <script>
			function message(msg)
			{
	 			top.frames[\'main_top\'].document.getElementById("wind").innerHTML=\'<form method=post action=main.php><div id="bgt" align=center><table width="275"  height="121" border="0" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td align="center" valign="middle" bgcolor="#f5f5f5" class="nickname"><b>\'+msg+\'</b><div><img src="/img/image/1x1.gif" width="1" height="5"></div><input type="submit" class="hbutton" value="   ОК   " onclick="hide_w()"></td></tr></table></div></div></form>\';
	 			top.frames[\'main_top\'].document.getElementById("wind").style.visibility = "visible";
			}
			function hide_w()
           	{
           		var m = top.frames[\'main_top\'].document.getElementById("wind");
				m.style.visibility = "hidden";
			}
		</script>
    ';
	echo'
	<script>
	writebuttons = function(e,a){
		switch(e){
			case \'mod\':
				document.getElementById(a+\'mod\').className = "";
				document.getElementById(a+\'modb\').className = "cc0000";
				document.getElementById(a+\'cmodb\').className = "";
				document.getElementById(a+\'upb\').className = "";
				document.getElementById(a+\'up\').className = "invis";
				document.getElementById(a+\'cmod\').className = "invis";
			break;
			case \'up\':
				document.getElementById(a+\'up\').className = "";
				document.getElementById(a+\'upb\').className = "cc0000";
				document.getElementById(a+\'modb\').className = "";
				document.getElementById(a+\'mod\').className = "invis";
				document.getElementById(a+\'cmod\').className = "invis";
				document.getElementById(a+\'cmodb\').className = "";
			break;
			case \'cmod\':
				document.getElementById(a+\'upb\').className = "";
				document.getElementById(a+\'modb\').className = "";
				document.getElementById(a+\'cmod\').className = "";
				document.getElementById(a+\'cmodb\').className = "cc0000";
				document.getElementById(a+\'mod\').className = "invis";
				document.getElementById(a+\'up\').className = "invis";
			break;
		}
	}
	</script>
	'; ?>
	<tr><td>
            <input type=image src=/img/image/gameplay/shop/knife.gif onClick="location='?weapon_category=w4'"
                   title="Ножи" width=40 height=50><input type=image src=/img/image/gameplay/shop/sword.gif
                                                          onClick="location='?weapon_category=w1'" title="Мечи" width=40
                                                          height=50><input type=image
                                                                           src=/img/image/gameplay/shop/axe.gif
                                                                           onClick="location='?weapon_category=w2'"
                                                                           title="Топоры" width=40 height=50><input
                    type=image src=/img/image/gameplay/shop/crushing.gif onClick="location='?weapon_category=w3'"
                    title="Дробящие" width=40 height=50><input type=image
                                                               src=/img/image/gameplay/shop/spears_helbeards.gif
                                                               onClick="location='?weapon_category=w6'"
                                                               title="Алебарды и двуручное" width=40 height=50><input
                    type=image src=/img/image/gameplay/shop/missle.gif onClick="location='?weapon_category=w5'"
                    title="Копья и метательное" width=40 height=50><input type=image
                                                                          src=/img/image/gameplay/shop/wand.gif
                                                                          onClick="location='?weapon_category=w7'"
                                                                          title="Посохи" width=40 height=50><input
                    type=image src=/img/image/gameplay/shop/shield.gif onClick="location='?weapon_category=w20'"
                    title="Щиты" width=40 height=50><input type=image src=/img/image/gameplay/shop/helm.gif
                                                           onClick="location='?weapon_category=w23'" title="Шлемы"
                                                           width=40 height=50><input type=image
                                                                                     src=/img/image/gameplay/shop/belt.gif
                                                                                     onClick="location='?weapon_category=w26'"
                                                                                     title="Пояса" width=40
                                                                                     height=50><input type=image
                                                                                                      src=/img/image/gameplay/shop/armor_light.gif
                                                                                                      onClick="location='?weapon_category=w18'"
                                                                                                      title="Кольчуги"
                                                                                                      width=40
                                                                                                      height=50><input
                    type=image src=/img/image/gameplay/shop/armor_hard.gif onClick="location='?weapon_category=w19'"
                    title="Доспехи" width=40 height=50><input type=image src=/img/image/gameplay/shop/gloves.gif
                                                              onClick="location='?weapon_category=w24'" title="Перчатки"
                                                              width=40 height=50><input type=image
                                                                                        src=/img/image/gameplay/shop/armlet.gif
                                                                                        onClick="location='?weapon_category=w80'"
                                                                                        title="Наручи" width=40
                                                                                        height=50><input type=image
                                                                                                         src=/img/image/gameplay/shop/boots.gif
                                                                                                         onClick="location='?weapon_category=w21'"
                                                                                                         title="Сапоги"
                                                                                                         width=40
                                                                                                         height=50><input
                    type=image src=/img/image/gameplay/shop/amulet.gif onClick="location='?weapon_category=w25'"
                    title="Кулоны" width=40 height=50><input type=image src=/img/image/gameplay/shop/ring.gif
                                                             onClick="location='?weapon_category=w22'" title="Кольца"
                                                             width=40 height=50><input type=image
                                                                                       src=/img/image/gameplay/shop/spaudler.gif
                                                                                       onClick="location='?weapon_category=w28'"
                                                                                       title="Наплечники" width=40
                                                                                       height=50><input type=image
                                                                                                        src=/img/image/gameplay/shop/knee_guard.gif
                                                                                                        onClick="location='?weapon_category=w90'"
                                                                                                        title="Поножи"
                                                                                                        width=40
                                                                                                        height=50>
</td></tr>
	
<?php	//
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
    	}}
		
	}
	$pl_st=allparam($player);
	$filt="AND `items`.`type`!='w0' AND `items`.`type`!='w61' AND `items`.`type`!='w29' AND `items`.`type`!='w30' AND `items`.`type`!='w66' AND `items`.`type`!='w69'  AND `items`.`type`!='w68'";   
	$it=mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player[id]."' and `used`='0' and `auction`='0' and `items`.`dd_price`='0' AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ".$filt.";");
	while ($ITEM = mysqli_fetch_assoc($it)){
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/master/master_items".".php");
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/master/master_ups".".php");
	}
echo'
</td></tr>';
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/master/master_upcheck".".php");	
?>
</SCRIPT>