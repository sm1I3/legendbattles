<?php


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
        <td>
            <img src=/img/image/1x1.gif width=1 height=10>

            <br></td>
    </tr>
    <tr>
        <td>
            <table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
                <tr>
                    <td colspan=4><? $locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `loc` WHERE `id`='" . $player['loc'] . "' LIMIT 1;")); ?>
                        <fieldset>
                            <legend align="center"><b><font color="gray"><?= $locname['loc']; ?></font></b></legend>
                            <img src=/img/image/gameplay/lesorubka.jpg width=760 height=255 border=0></fieldset>
                    </td>
                </tr>
                <!---->
                <tr>
                    <td bgcolor=#f5f5f5 colspan=4><?php
                        echo '<form method=post><div align=center><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=min_lev class=zayavki>';
                        for ($i = 0; $i <= 35; $i++) {
                            echo '<option value=' . $i . (($_SESSION['min_lev'] == $i) ? ' SELECTED' : '') . '>' . $i . '</option>';
                        }
                        echo '</select> до <select name=max_lev class=zayavki>';
                        for ($i = 0; $i <= 35; $i++) {
                            echo '<option value=' . $i . (($_SESSION['max_lev'] == $i) ? ' SELECTED' : '') . '>' . $i . '</option>';
                        }
                        echo '</select> не дороже <input type=text size=2 name=max_nv value="' . (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) . '" class=LogintextBox6><b> LR</b> сортировка по <select name=sorttype class=zayavki><option value=1' . (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') . '>уровню</option><option value=0' . (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') . '>стоимости</option></select> <input type=submit value=" ok " class=lbut></font></div></form>';
                        ?></td>
                </tr>
                <tr>
                    <td bgcolor=#CCCCCC width=100% colspan=4><img src=/img/image/1x1.gif width=1 height=1 width=40
                                                                  height=50></td>
                </tr><!---->

                <tr>
                    <td width="34%" bgcolor="#f5f5f5" align="center"><a href="#"
                                                                        onClick="location='?weapon_category=snast'"
                                                                        title=""><font class="zaya"><b>Лавка
                                    инструментов</b></font></a></td>
                    <td width="33%" bgcolor="#f5f5f5" align="center"><a href="#"
                                                                        onClick="location='?weapon_category=sellles'"
                                                                        title=""><font class="zaya"><b>Переработка
                                    руды</b></font></a></td>
                    <td width="33%" bgcolor="#f5f5f5" align="center"><a href="#"
                                                                        onClick="location='?weapon_category=sellder'"
                                                                        title=""><font class="zaya"><b>Переработка
                                    металла</b></font></a>
                    <td width="33%" bgcolor="#f5f5f5" align="center"><a href="#"
                                                                        onClick="location='?weapon_category=sell'"
                                                                        title=""><font class="zaya"><b>Сдать
                                    материалы</b></font></a>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <? if (isset($_GET['weapon_category'])){
                        switch ($_GET['weapon_category']) {
                            case 'snast':
                                $querywep = " AND type='w70' AND slot='3'";
                                break;
                        }
                        $ITEMS = mysqli_query($GLOBALS['db_link'], "SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE market='" . $player['loc'] . "' AND `level`>='" . $_SESSION["min_lev"] . "' AND `level`<='" . $_SESSION["max_lev"] . "'" . (($_SESSION["max_nv"] > '0') ? " AND `price`<='" . $_SESSION["max_nv"] . "'" : "") . " " . $querywep . " ORDER BY `items`.`" . $_SESSION['sorttype'] . "` ASC");
                        $num = (mysqli_num_rows($ITEMS));
                        if ($num > 0 and $_GET['weapon_category'] == 'priman'){
                        ?>
                        <table cellpadding=0 cellspacing=0 border=0 width=100%>
                            <tr>
                                <td bgcolor=#e0e0e0>
                                    <table cellpadding=3 cellspacing=1 border=0 width=100%>
                                        <tr>
                                            <td colspan=4 bgcolor=#F9f9f9>
                                                <div align=center><font class=inv><b> У Вас с собой <?= $player[nv] ?> и
                                                            вещей массой: <?= $plstt[71] ?> Максимальный
                                                            вес: <?= $mass ?></b></div>
                                            </td>
                                        </tr>
                                        <?
                                        $freemass = $plstt[71];
                                        $i = 0;
                                        while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
                                            $par = explode("|", $ITEM['param']);
                                            $need = explode("|", $ITEM['need']);
                                            $bt = 0;
                                            $tr_b = '';
                                            $m = 1;
                                            foreach ($need as $value) {
                                                $treb = explode("@", $value);
                                                if ($treb[0] == 72) $treb[1] = $ITEM['level'];
                                                if ($treb[0] == 71) {
                                                    $treb[1] = $ITEM['massa'];
                                                    $plstt[71] = $mass - $freemass;
                                                }
                                                if ($treb[0] != 28) {
                                                    if ($plstt[$treb[0]] < $treb[1]) {
                                                        $treb[1] = "<font color=#cc0000>$treb[1]</font>";
                                                        if ($treb[0] == 71) {
                                                            $m = 0;
                                                        }
                                                    }
                                                }
                                            }
                                            if ($i == 4) {
                                                echo '</tr>';
                                                $i = 0;
                                            }
                                            if ($i == 0) {
                                                echo '<tr>';
                                            }
                                            $i++;
                                            echo '<td bgcolor=#f9f9f9>
		<div align=center><b>' . $ITEM['name'] . '</b><br><font class=weaponch>(количество: ' . (($ITEM['kol'] > 0) ? '<font color=green>' . $ITEM['kol'] . '</font>' : '<font color=red>' . $ITEM['kol'] . '</font>') . ')</div>
		<div align=center><img src=/img/image/weapon/' . $ITEM['gif'] . ' border=0></div>
		<div align=center>
		<font class=weaponch>&nbsp;Цена: <b>';
                                            if ($ITEM['dd_price'] == 0) {
                                                if ($ITEM['price'] > $player['nv']) {
                                                    echo "<font color=#cc0000>" . $ITEM['price'] . " LR</font>";
                                                } else {
                                                    echo $ITEM['price'] . " LR";
                                                }
                                            } else {
                                                if ($ITEM['dd_price'] > $player['baks']) {
                                                    echo '<font color=#cc0000>' . $ITEM['dd_price'] . ' $</font>';
                                                } else {
                                                    echo '' . $ITEM['dd_price'] . ' $';
                                                }
                                            }
                                            echo '
		</div>
		<div align=center>';
                                            if ($ITEM['slot'] == '0' and $ITEM['num_a'] != '') {
                                                $klevsql = mysqli_query($GLOBALS['db_link'], "SELECT `items`.`name` FROM `items` WHERE `type`='w69' AND `effect`='" . $ITEM['effect'] . "' AND `slot`='0' AND `num_a`='';");
                                                if (mysqli_num_rows($klevsql) > 0) {
                                                    $klev = "";
                                                    while ($row = mysqli_fetch_assoc($klevsql)) {
                                                        $klev .= $row['name'] . ", ";
                                                    }
                                                    $klev = substr($klev, 0, strlen($klev) - 2);
                                                    echo 'Клюет: ' . $klev . ".";

                                                } else {
                                                    echo 'Клюет: <font color=red>ничего.</font>';
                                                }
                                            }
                                            echo '</div>
		<div align=center>';
                                            if ($ITEM['dd_price'] == 0) {
                                                if ($player['nv'] >= $ITEM['price'] AND $ITEM['kol'] > 0 and $m != 0) {
                                                    echo '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="купить 1 шт">';
                                                }
                                                if ($player['nv'] >= $ITEM['price'] * 10 AND $ITEM['kol'] > 10 and $m != 0) {
                                                    echo '<br><input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&col=10&vcode=' . scode() . '\'" value="купить 10 шт">';
                                                }
                                                if ($player['nv'] >= $ITEM['price'] * 50 AND $ITEM['kol'] > 50 and $m != 0) {
                                                    echo '<br><input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&col=50&vcode=' . scode() . '\'" value="купить 50 шт">';
                                                }
                                            } else {
                                                if ($player['baks'] >= $ITEM['dd_price'] AND $ITEM['kol'] > 0 and $m != 0) {
                                                    echo '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="купить (' . $ITEM[dd_price] . '$)"><br>';
                                                }
                                            }
                                            echo '</div>
		</td>';
                                        }
                                        for ($b = $i; $b < 4; $b++) {
                                            echo '<td bgcolor=#f9f9f9 width=25%>&nbsp;</td>';
                                        }
                                        echo '<tr>';
                                        }
                                        elseif ($num > 0 and $_GET['weapon_category'] == 'snast') {
                                            echo '</table></td></tr></table>';
                                            echo show_shop(0, $ITEMS, $mass);
                                        } elseif ($_GET['weapon_category'] == 'sellles') {
                                            $inputs = "<input type=button class=lbut ";
                                            $inpute = "/> ";
                                            echo '<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td bgcolor=#e0e0e0>
	<table cellpadding=3 cellspacing=1 border=0 width=100%>
	<tr><td colspan=4 bgcolor=#F9f9f9>
	<div align=center><font class=inv><b> У Вас с собой ' . $player['nv'] . ' LR и вещей массой: ' . $plstt[71] . ' Максимальный вес: ' . $mass . '</b></div></td></tr>';
                                            $fishsql = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='" . $player['id'] . "' AND `items`.`type`='w70' AND `items`.`effect`>'0' AND `items`.`num_a`='' AND `items`.`slot`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0';");
                                            if (mysqli_num_rows($fishsql) > 0) {
                                                $i = 0;
                                                while ($ITEM = mysqli_fetch_assoc($fishsql)) {
                                                    $ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] += 1;
                                                    if ($ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] == 1) {
                                                        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $player['id'] . "' and `invent`.`used`='0' and `dolg`='" . $ITEM['dolg'] . "' and `iznos`='" . $ITEM['iznos'] . "' and `items`.`id`='" . $ITEM['id'] . "' and `invent`.`arenda`='" . $ITEM['arenda'] . "' and `invent`.`rassrok`='" . $ITEM['rassrok'] . "' and `invent`.`mod`='" . $ITEM['mod'] . "' and `invent`.`clan`='" . $ITEM['clan'] . "' and `invent`.`grav`='" . $ITEM['grav'] . "' and `invent`.`bank`='0'"));
                                                        $buttons = "Кол-во:<input type=text class=logintextbox7 id=" . $ITEM['protype'] . " value=1 " . $inpute . "<br>" . $inputs . "onclick=\"javascript: if(confirm('Вы точно хотите переработать все " . $ITEM['name'] . "?')) {MessBoxDiv('<font color=#006600><b>" . $ITEM['name'] . "</b></font>',180," . $ITEM['protype'] . ",'" . scode() . "'," . $count . ");}\" value=\"Переработать\"  " . $inpute;
                                                        if ($i == 4) {
                                                            echo '</tr>';
                                                            $i = 0;
                                                        }
                                                        if ($i == 0) {
                                                            echo '<tr>';
                                                        }
                                                        $i++;
                                                        echo '<td bgcolor=#f9f9f9 width=25%>
					<div align=center><b>' . $ITEM['name'] . '</b><br><font class=weaponch>(количество: ' . (($count > 1) ? '<font color=green>' . $count . '</font>' : '<font color=red>' . $count . '</font>') . ')</div>
					<div align=center><img src=/img/image/weapon/' . $ITEM['gif'] . ' border=0></div>
					<div align=center>' . $buttons . '</div>
					</td>';
                                                    }
                                                }
                                            }
                                        } elseif ($_GET['weapon_category'] == 'sellder') {
                                            echo '<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>В разработке.</b></font></td></tr>';
                                            /*$inputs="<input type=button class=invbut ";
                                            $inpute="/> ";
                                            echo '<table cellpadding=0 cellspacing=0 border=0 width=100%>
                                            <tr><td bgcolor=#e0e0e0>
                                            <table cellpadding=3 cellspacing=1 border=0 width=100%>
                                            <tr><td colspan=4 bgcolor=#F9f9f9>
                                            <div align=center><font class=inv><b> У Вас с собой '.$player['nv'].' LR и вещей массой: '.$plstt[71].' Максимальный вес: '.$mass.'</b></div></td></tr>';
                                            $fishsql = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `items`.`type`='w70' AND `items`.`effect`='' AND `items`.`num_a`='32' AND `items`.`slot`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0';");
                                            if(mysqli_num_rows($fishsql)>0){
                                                $i=0;
                                                while($ITEM = mysqli_fetch_assoc($fishsql)){
                                                        $ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] += 1;
                                                        if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] == 1){
                                                            $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`mod`='".$ITEM['mod']."' and `invent`.`clan`='".$ITEM['clan']."' and `invent`.`grav`='".$ITEM['grav']."' and `invent`.`bank`='0'"));
                                                            $buttons=$inputs."onclick=\"javascript: if(confirm('Вы точно хотите сдать все ".$ITEM['name']." в лавку?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=3&vcode=".scode()."'}\" value=\"Переработать\"  ".$inpute;
                                                            if($i==4){echo '</tr>';$i=0;}
                                                            if($i==0){echo '<tr>';}
                                                            $i++;
                                                            echo'<td bgcolor=#f9f9f9>
                                                            <div align=center><b>'.$ITEM['name'].'</b><br><font class=weaponch>(количество: '.(($count>1)?'<font color=green>'.$count.'</font>':'<font color=red>'.$count.'</font>').')</div>
                                                            <div align=center><img src=/img/image/weapon/'.$ITEM['gif'].' border=0></div>
                                                            <div align=center>'.$buttons.'</div>
                                                            </td>';
                                                        }
                                                }
                                            }*/
                                        } elseif (isset($_GET['weapon_category']) and $_GET['weapon_category'] == 'sell') {
                                            $inputs = "<input type=button class=invbut ";
                                            $inpute = "/> ";
                                            echo '<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td bgcolor=#e0e0e0>
	<table cellpadding=3 cellspacing=1 border=0 width=100%>
	<tr><td colspan=4 bgcolor=#F9f9f9>
	<div align=center><font class=inv><b> У Вас с собой ' . $player['nv'] . ' LR и вещей массой: ' . $plstt[71] . ' Максимальный вес: ' . $mass . '</b></div></td></tr>';
                                            $fishsql = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='" . $player['id'] . "' AND `items`.`type`='w70' AND `items`.`num_a`='32' AND `items`.`slot`='0' AND `invent`.`bank`='0' AND `invent`.`clan`='0';");
                                            if (mysqli_num_rows($fishsql) > 0) {
                                                $i = 0;
                                                while ($ITEM = mysqli_fetch_assoc($fishsql)) {
                                                    $ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] += 1;
                                                    if ($ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] == 1) {
                                                        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $player['id'] . "' and `invent`.`used`='0' and `dolg`='" . $ITEM['dolg'] . "' and `iznos`='" . $ITEM['iznos'] . "' and `items`.`id`='" . $ITEM['id'] . "' and `invent`.`arenda`='" . $ITEM['arenda'] . "' and `invent`.`rassrok`='" . $ITEM['rassrok'] . "' and `invent`.`mod`='" . $ITEM['mod'] . "' and `invent`.`clan`='" . $ITEM['clan'] . "' and `invent`.`grav`='" . $ITEM['grav'] . "' and `invent`.`bank`='0'"));
                                                        $buttons = $inputs . "onclick=\"javascript: if(confirm('Вы точно хотите сдать все " . $ITEM['name'] . " в лавку?')) {location='main.php?post_id=11&uid=" . $ITEM['id_item'] . "&act=3&vcode=" . scode() . "'}\" value=\"Сдать лесозаготовки в лавку\"  " . $inpute;
                                                        if ($i == 4) {
                                                            echo '</tr>';
                                                            $i = 0;
                                                        }
                                                        if ($i == 0) {
                                                            echo '<tr>';
                                                        }
                                                        $i++;
                                                        echo '<td bgcolor=#f9f9f9>
					<div align=center><b>' . $ITEM['name'] . '</b><br><font class=weaponch>(количество: ' . (($count > 1) ? '<font color=green>' . $count . '</font>' : '<font color=red>' . $count . '</font>') . ')</div>
					<div align=center><img src=/img/image/weapon/' . $ITEM['gif'] . ' border=0></div>
					<div align=center>' . $buttons . '</div>
					</td>';
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                        ?>
                                        <table cellpadding=5 cellspacing=1 border=0 width=100%>
                                            <tr>
                                                <td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет
                                                            товаров в данной категории.</b></font></td>
                                            </tr>
                                            <? } ?>
                                        </table>

                                        <? }


                                        function blocks($bl)
                                        {
                                            if ($bl != "") {
                                                switch ($bl) {
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

                                        ?>
                                        </td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <SCRIPT language='JavaScript'>
                            NewLinksView();
                        </SCRIPT>