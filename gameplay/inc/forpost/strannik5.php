<?php
foreach ($_POST as $keypost => $val) {
    $_POST[$keypost] = varcheck($val);
}
foreach ($_GET as $keyget => $val) {
    $_GET[$keyget] = varcheck($val);
}
/* СОРТИРОВКА */
if (!empty($_POST['min_lev']) or !empty($_POST['max_lev']) or !empty($_POST['max_nv']) or !empty($_POST['sorttype'])) {
    $_SESSION['min_lev'] = intval($_POST['min_lev']);
    $_SESSION['max_lev'] = intval($_POST['max_lev']);
    $_SESSION['max_nv'] = intval($_POST['max_nv']);
    if ($_POST['sorttype'] == '0') {
        $_SESSION['sorttype'] = 'price';
    } elseif ($_POST['sorttype'] == '1') {
        $_SESSION['sorttype'] = 'level';
    } else {
        $_SESSION['sorttype'] = 'price';
    }
}
if (empty($_SESSION['min_lev'])) {
    $_SESSION['min_lev'] = '0';
}
if (empty($_SESSION['max_lev'])) {
    $_SESSION['max_lev'] = '35';
}
if (empty($_SESSION['sorttype'])) {
    $_SESSION['sorttype'] = 'level';
}
/* КАТЕГОРИИ */
if (isset($_GET['weapon_category'])) {
    $_SESSION['mark'] = $_GET['weapon_category'];
}
if ($_SESSION['mark'] != '') {
    $_GET['weapon_category'] = $_SESSION['mark'];
}
?>
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if ($msg) {
    echo "<SCRIPT>MessBoxDiv('" . $msg . "',0,0,0,0);</SCRIPT>";
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
    <tr>
        <td><img src=/img/image/1x1.gif width=1 height=10><br></td>
    </tr>
    <tr>
        <td>
            <table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
                <tr>
                    <td><? $locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `loc` WHERE `id`='" . $player['loc'] . "' LIMIT 1;")); ?>
                        <fieldset>
                            <legend align="center"><b><font color="gray"><?= $locname['loc']; ?></font></b></legend>
                            <img src=http://w2.dwar.ru/info/pictures/image/yarmarka_mag.jpg width=960 height=260
                                 border=0></fieldset>
                    </td>
                </tr>
                <!---->
                <tr>
                    <td bgcolor=#f5f5f5><?php
                        echo '<form method=post><div align=center><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=min_lev class=zayavki>';
                        for ($i = 0; $i <= 35; $i++) {
                            echo '<option value=' . $i . (($_SESSION['min_lev'] == $i) ? ' SELECTED' : '') . '>' . $i . '</option>';
                        }
                        echo '</select> до <select name=max_lev class=zayavki>';
                        for ($i = 0; $i <= 35; $i++) {
                            echo '<option value=' . $i . (($_SESSION['max_lev'] == $i) ? ' SELECTED' : '') . '>' . $i . '</option>';
                        }
                        echo '</select> не дороже <input type=text size=2 name=max_nv value="' . (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) . '" class=LogintextBox6><b> </b> сортировка по <select name=sorttype class=zayavki><option value=1' . (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') . '>уровню</option><option value=0' . (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') . '>стоимости</option></select> <input type=submit value=" ok " class=lbut></font></div></form>';
                        ?>
                    </

                    style

                    >
                    <
                    table width

                    =
                    "100%"
                    border

                    =
                    "0"
                    cellspacing

                    =
                    "0"
                    cellpadding

                    =
                    "0"
                    >
                    < tr >
                    < td align

                    =
                    center >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onclick

                    =
                    "location='?weapon_category=w4'"
                    value

                    =
                    "Оружие"
                    /
                    >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onClick

                    =
                    "location='?weapon_category=w20'"
                    value

                    =
                    "Щиты"
                    /
                    >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onclick

                    =
                    "location='?weapon_category=w19'"
                    value

                    =
                    "Доспехи"
                    /
                    >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onclick

                    =
                    "location='?weapon_category=w999'"
                    value

                    =
                    "Эликсиры"
                    /
                    >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onclick

                    =
                    "location='?weapon_category=w70'"
                    value

                    =
                    "Мази"
                    /
                    >
                    < input type

                    =
                    "button"
                    class

                    =
                    "lbut"
                    onclick

                    =
                    "location='?weapon_category=w29'"
                    value

                    =
                    "Свитки"
                    /
                    >
                    <

                    /
                    td >
                    <

                    /
                    tr >
                    < tr >
                    <

                    /
                    td > <

                    /
                    tr >
                    < tr > < td > <

                    /
                    td > <

                    /
                    tr > < tr > < td ><? if (isset($weapon_category)) {
if($weapon_category=='all'){
	$querywep=" AND type!='w0' AND type!='w29' AND type!='w30' AND type!='w66'";
}
else {$querywep=" AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."'";}
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE market='".$player['loc']."' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `price`<='".$_SESSION["max_nv"]."'":"")." ".$querywep." ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
$num = (mysqli_num_rows($ITEMS));
                        if ($num > 0) {
                            ?> < table cellpadding

                            =
                            0
                            cellspacing

                            =
                            0
                            border

                            =
                            0
                            width

                            =
                            100
                            %
                            > < tr > < td bgcolor

                            =
                            #e0e0e0 > < table cellpadding

                            =
                            3
                            cellspacing

                            =
                            1
                            border

                            =
                            0
                            width

                            =
                            100
                            %
                            > < tr > < td colspan

                            =
                            2
                            bgcolor

                            =
                            #F9f9f9 > < div align

                            =
                            center > < font class

                            =
                            inv > < b > У Вас с собой <?= $player['nv'] ?> и вещей массой: <?= $plstt[71] ?> Максимальный вес:

                            <?= $mass ?>
                            <
                            /
                            b > <

                            /
                            div > <

                            /
                            td > <

                            /
                            tr ><?
$freemass=$plstt[71];
while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
$par=explode("|",$ITEM['param']);
    $need = explode("|", $ITEM['need']);
$bt=0;$tr_b='';$m=1;
foreach ($need as $value) {
$treb=explode("@",$value);
    if ($treb[0] == 72) $treb[1] = $ITEM['level'];
    if ($treb[0] == 71) {
        $treb[1] = $ITEM['massa'];
        $plstt[71] = $mass - $freemass;
    }
if($treb[0]!=28){if($plstt[$treb[0]]<$treb[1]){$treb[1]="<font color=#cc0000>$treb[1]</font>";if($treb[0]==71){$m=0
;}}}
switch($treb[0])
{
    case 28:
        $tr_b .= "&nbsp;Очки действия: <b>$treb[1]</b><br>";
        break;
    case 30:
        $tr_b .= "&nbsp;Cила: <b>$treb[1]</b><br>";
        break;
    case 31:
        $tr_b .= "&nbsp;Ловкость: <b>$treb[1]</b><br>";
        break;
    case 32:
        $tr_b .= "&nbsp;Удача: <b>$treb[1]</b><br>";
        break;
    case 33:
        $tr_b .= "&nbsp;Здоровье: <b>$treb[1]</b><br>";
        break;
    case 34:
        $tr_b .= "&nbsp;Знания: <b>$treb[1]</b><br>";
        break;
    case 35:
        $tr_b .= "&nbsp;Сноровка: <b>$treb[1]</b><br>";
        break;
    case 36:
        $tr_b .= "&nbsp;Владение мечами: <b>$treb[1]</b><br>";
        break;
    case 37:
        $tr_b .= "&nbsp;Владение топорами: <b>$treb[1]</b><br>";
        break;
    case 38:
        $tr_b .= "&nbsp;Владение дробящим оружием: <b>$treb[1]</b><br>";
        break;
    case 39:
        $tr_b .= "&nbsp;Владение ножами: <b>$treb[1]</b><br>";
        break;
    case 40:
        $tr_b .= "&nbsp;Владение метательным оружием: <b>$treb[1]</b><br>";
        break;
    case 41:
        $tr_b .= "&nbsp;Владение алебардами и копьями: <b>$treb[1]</b><br>";
        break;
    case 42:
        $tr_b .= "&nbsp;Владение посохами: <b>$treb[1]</b><br>";
        break;
    case 43:
        $tr_b .= "&nbsp;Владение экзотическим оружием: <b>$treb[1]</b><br>";
        break;
    case 44:
        $tr_b .= "&nbsp;Владение двуручным оружием: <b>$treb[1]</b><br>";
        break;
    case 45:
        $tr_b .= "&nbsp;Магия огня: <b>$treb[1]</b><br>";
        break;
    case 46:
        $tr_b .= "&nbsp;Магия воды: <b>$treb[1]</b><br>";
        break;
    case 47:
        $tr_b .= "&nbsp;Магия воздуха: <b>$treb[1]</b><br>";
        break;
    case 48:
        $tr_b .= "&nbsp;Магия земли: <b>$treb[1]</b><br>";
        break;
    case 53:
        $tr_b .= "&nbsp;Воровство: <b>$treb[1]</b><br>";
        break;
    case 54:
        $tr_b .= "&nbsp;Осторожность: <b>$treb[1]</b><br>";
        break;
    case 55:
        $tr_b .= "&nbsp;Скрытность: <b>$treb[1]</b><br>";
        break;
    case 56:
        $tr_b .= "&nbsp;Наблюдательность: <b>$treb[1]</b><br>";
        break;
    case 57:
        $tr_b .= "&nbsp;Торговля: <b>$treb[1]</b><br>";
        break;
    case 58:
        $tr_b .= "&nbsp;Странник: <b>$treb[1]</b><br>";
        break;
    case 59:
        $tr_b .= "&nbsp;Рыболов: <b>$treb[1]</b><br>";
        break;
    case 60:
        $tr_b .= "&nbsp;Лесоруб: <b>$treb[1]</b><br>";
        break;
    case 61:
        $tr_b .= "&nbsp;Ювелирное дело: <b>$treb[1]</b><br>";
        break;
    case 62:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 63:
        $tr_b .= "&nbsp;Оружейник: <b>$treb[1]</b><br>";
        break;
    case 64:
        $tr_b .= "&nbsp;Доктор: <b>$treb[1]</b><br>";
        break;
    case 65:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 66:
        $tr_b .= "&nbsp;Быстрое восстановление маны: <b>$treb[1]</b><br>";
        break;
    case 67:
        $tr_b .= "&nbsp;Лидерство: <b>$treb[1]</b><br>";
        break;
    case 68:
        $tr_b .= "&nbsp;Алхимия: <b>$treb[1]</b><br>";
        break;
    case 69:
        $tr_b .= "&nbsp;Развитие горного дела: <b>$treb[1]</b><br>";
        break;
    case 70:
        $tr_b .= "&nbsp;Травничество: <b>$treb[1]</b><br>";
        break;
    case 71:
        $tr_b .= "&nbsp;Масса: <b>$treb[1]</b><br>";
        break;
    case 72:
        $tr_b .= "&nbsp;Уровень: <b>$treb[1]</b><br>";
        break;
}
}
    ?> < tr > < td bgcolor

    =
    #f9f9f9 > < div align

    =
    center > < img src

    =
    /img/ image /weapon/<?= $ITEM['gif'] ?> border

    =
    0
    > <

    /
    div > <

    /
    td > < td width

    =
    100
    %
    bgcolor

    =
    #ffffff valign

    =
    top > < table cellpadding

    =
    0
    cellspacing

    =
    0
    border

    =
    0
    width

    =
    100
    %
    > < tr > < td bgcolor

    =
    #ffffff width

    =
    100
    %
    > < font class

    =
    nickname > < b ><?
if($ITEM['dd_price']==0){
	if($player['nv']>=$ITEM['price'] AND $ITEM['kol']>0 and $m!=0){
        echo '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="купить">';
	}
}
else{
	if($player['baks']>=$ITEM['dd_price'] AND $ITEM['kol']>0 and $m!=0){
        echo '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="купить (' . $ITEM['dd_price'] . '$)"><br>';
	}
}
    ?> & nbsp<?= $ITEM['name'] ?><

    /
    b > < font class

    =
    weaponch >

    (
    количество:

    <?= (($ITEM['kol'] > 0) ? '<font color=green>' . $ITEM['kol'] . '</font>' : '<font color=red>' . $ITEM['kol'] . '</font>') ?>
    )
    <
    br > < img src

    =
    /img/ image

    /
    1
    x1.gif width

    =
    1
    height

    =
    3
    > <

    /
    td > < td > < br > < img src

    =
    /img/ image

    /
    1
    x1.gif width

    =
    1
    height

    =
    3
    <
    /
    td > <

    /
    tr > < tr > < td colspan

    =
    2
    width

    =
    100
    %
    > < table cellpadding

    =
    0
    cellspacing

    =
    0
    border

    =
    0
    width

    =
    100
    %
    > < tr > < td bgcolor

    =
    #D8CDAF width

    =
    50
    %
    > < div align

    =
    center > < font class

    =
    invtitle > свойства<

    /
    div > <

    /
    td > < td bgcolor

    =
    #B9A05C > < img src

    =
    /img/ image

    /
    1
    x1.gif width

    =
    1
    height

    =
    1
    > <

    /
    td > < td bgcolor

    =
    #D8CDAF width

    =
    50
    %
    > < div align

    =
    center > < font class

    =
    invtitle > требования<

    /
    div > <

    /
    td > <

    /
    tr > < tr > < td bgcolor

    =
    #FCFAF3 >
    < font class

    =
    weaponch > & nbsp

    ;
    Цена:

    <
    b ><?
if($ITEM['dd_price']==0){
 if($ITEM['price']>$player['nv']){echo "<font color=#cc0000>$ITEM[price] LR</font>";}else{echo $ITEM['price']." LR";}
}
else{
if($ITEM['dd_price']>$player['baks']){echo '<font color=#cc0000>'.$ITEM['dd_price'].' $</font>';}else{echo ''.$ITEM['dd_price'].' $';}
}
    ?> <

    /
    b > < br ><? if ($ITEM['slot'] == 16) echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
    blocks($ITEM['block']);
foreach ($par as $value) {
$stat=explode("@",$value);
if($stat[1]>0){$plus = "+";}else{$plus ="";}
switch($stat[0])
{
    case 0:
        echo "Гравировка: <b>$stat[1]</b><br>";
        break;
    case 1:
        echo "Удар: <b>$stat[1]</b><br>";
        break;
    case 2:
        echo "Долговечность: <b>$stat[1]/$stat[1]</b><br>";
        break;
    case 3:
        echo "Карманов: <b>$stat[1]</b><br>";
        break;
    case 4:
        echo "Материал: <b>$stat[1]</b><br>";
        break;
    case 5:
        echo "Уловка: $plus<b>$stat[1]%</b><br>";
        break;
    case 6:
        echo "Точность: $plus<b>$stat[1]%</b><br>";
        break;
    case 7:
        echo "Сокрушение: $plus<b>$stat[1]%</b><br>";
        break;
    case 8:
        echo "Стойкость: $plus<b>$stat[1]%</b><br>";
        break;
    case 9:
        echo "Класс брони: <b>$stat[1]</b><br>";
        break;
    case 10:
        echo "Пробой брони: $plus<b>$stat[1]%</b><br>";
        break;
    case 27:
        echo "НР: $plus<b>$stat[1]</b><br>";
        break;
    case 28:
        echo "Очки действия: $plus<b>$stat[1]</b><br>";
        break;
    case 29:
        echo "Мана: $plus<b>$stat[1]</b><br>";
        break;
    case 30:
        echo "Cила: $plus<b>$stat[1]</b><br>";
        break;
    case 31:
        echo "Ловкость: $plus<b>$stat[1]</b><br>";
        break;
    case 32:
        echo "Удача: $plus<b>$stat[1]</b><br>";
        break;
    case 33:
        echo "Здоровье: $plus<b>$stat[1]</b><br>";
        break;
    case 34:
        echo "Знания: $plus<b>$stat[1]</b><br>";
        break;
    case 35:
        echo "Сноровка: $plus<b>$stat[1]</b><br>";
        break;
    case 36:
        echo "Владение мечами: $plus<b>$stat[1]%</b><br>";
        break;
    case 37:
        echo "Владение топорами: $plus<b>$stat[1]%</b><br>";
        break;
    case 38:
        echo "Владение дробящим оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 39:
        echo "Владение ножами: $plus<b>$stat[1]%</b><br>";
        break;
    case 40:
        echo "Владение метательным оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 41:
        echo "Владение алебардами и копьями: $plus<b>$stat[1]%</b><br>";
        break;
    case 42:
        echo "Владение посохами: $plus<b>$stat[1]%</b><br>";
        break;
    case 43:
        echo "Владение экзотическим оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 44:
        echo "Владение двуручным оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 45:
        echo "Магия огня: $plus<b>$stat[1]%</b><br>";
        break;
    case 46:
        echo "Магия воды: $plus<b>$stat[1]%</b><br>";
        break;
    case 47:
        echo "Магия воздуха: $plus<b>$stat[1]%</b><br>";
        break;
    case 48:
        echo "Магия земли: $plus<b>$stat[1]%</b><br>";
        break;
    case 49:
        echo "Сопротивление магии огня: $plus<b>$stat[1]%</b><br>";
        break;
    case 50:
        echo "Сопротивление магии воды: $plus<b>$stat[1]%</b><br>";
        break;
    case 51:
        echo "Сопротивление магии воздуха: $plus<b>$stat[1]%</b><br>";
        break;
    case 52:
        echo "Сопротивление магии земли: $plus<b>$stat[1]%</b><br>";
        break;
    case 53:
        echo "Воровство: $plus<b>$stat[1]%</b><br>";
        break;
    case 54:
        echo "Осторожность: $plus<b>$stat[1]%</b><br>";
        break;
    case 55:
        echo "Скрытность: $plus<b>$stat[1]%</b><br>";
        break;
    case 56:
        echo "Наблюдательность: $plus<b>$stat[1]%</b><br>";
        break;
    case 57:
        echo "Торговля: $plus<b>$stat[1]%</b><br>";
        break;
    case 58:
        echo "Странник: $plus<b>$stat[1]%</b><br>";
        break;
    case 59:
        echo "Рыболов: $plus<b>$stat[1]%</b><br>";
        break;
    case 60:
        echo "Лесоруб: $plus<b>$stat[1]%</b><br>";
        break;
    case 61:
        echo "Ювелирное дело: $plus<b>$stat[1]%</b><br>";
        break;
    case 62:
        echo "Самолечение: $plus<b>$stat[1]%</b><br>";
        break;
    case 63:
        echo "Оружейник: $plus<b>$stat[1]%</b><br>";
        break;
    case 64:
        echo "Доктор: $plus<b>$stat[1]%</b><br>";
        break;
    case 65:
        echo "Самолечение: $plus<b>$stat[1]%</b><br>";
        break;
    case 66:
        echo "Быстрое восстановление маны: $plus<b>$stat[1]%</b><br>";
        break;
    case 67:
        echo "Лидерство: $plus<b>$stat[1]%</b><br>";
        break;
    case 68:
        echo "Алхимия: $plus<b>$stat[1]%</b><br>";
        break;
    case 69:
        echo "Развитие горного дела: $plus<b>$stat[1]%</b><br>";
        break;
    case 70:
        echo "Травничество: $plus<b>$stat[1]%</b><br>";
        break;
}
}
    ?> <

    /
    td > < td bgcolor

    =
    #B9A05C > < img src

    =
    /img/ image

    /
    1
    x1.gif width

    =
    1
    height

    =
    1
    > <

    /
    td > < td bgcolor

    =
    #FCFAF3 >
    < font class

    =
    weaponch ><?
    echo $tr_b ?> <

    /
    font >
    <

    /
    td > <

    /
    tr > <

    /
    table > <

    /
    td > <

    /
    tr > <

    /
    table > <

    /
    td > <

    /
    tr ><? }
                        } else {
                            ?> < table cellpadding

                            =
                            5
                            cellspacing

                            =
                            1
                            border

                            =
                            0
                            width

                            =
                            100
                            %
                            > < tr > < td bgcolor

                            =
                            #F5F5F5 align

                            =
                            center colspan

                            =
                            2
                            > < font class

                            =
                            inv > < b > Нет товаров в данной категории.<

                            /
                            b > <

                            /
                            font > <

                            /
                            td > <

                            /
                            tr ><? } ?> <

                        /
                        table ><? }

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
    	}
		}
	}

                    ?> <

                    /
                    td > <

                    /
                    tr >
                    <

                    /
                    table >
                    <

                    /
                    td > <

                    /
                    tr >
                    <

                    /
                    table >
                    < SCRIPT language

                    =
                    'JavaScript'
                    >

                    NewLinksView
                    (
                    )
                    ;
                    <
                    /
                    SCRIPT >