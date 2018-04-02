<?


?>
<SCRIPT type="text/javascript" src="js/panel.js"></SCRIPT>
<SCRIPT src="./js/wtime.js"></SCRIPT>
<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>

<div id="back" style="position: absolute; display: none; left: 0; top: 0; width: 100%; z-index: 50;"></div>
<div style="display:none; position:absolute; z-index:100;" id="popup"></div>
<div style="padding-left:39px; text-align:left; padding-top:10px;" id="draw_pers_info"></div>
<div id=waiter></div>


<html>
<META content="text/html; charset=utf-8" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
    <LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
    <SCRIPT type="text/javascript" src="js/interface/get_windows.js"></SCRIPT>
    <SCRIPT LANGUAGE='JavaScript' SRC='js/mine.js'></SCRIPT>
    <SCRIPT LANGUAGE='JavaScript' SRC='js/naturen.js'></SCRIPT>
</HEAD>
<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px; visibility:visible;"
     id="center"></div>
<div style="position:absolute; left:-2px; top:-2px; z-index: 65300; width:0px; height:0px;display:none;"
     id="info"></div>
<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>
<div style="position:absolute; left:0px; top:0px; z-index: 65100; width:100%; height:100%; display:none; text-align:center;"
     id="center2" class=news>&nbsp;
</div>
<div style="position:absolute; left:0px; top:0px; z-index: 65200; width:100%; height:100%; display:none; text-align:center;"
     id="center3" class=news>&nbsp;
</div>


<?
error_reporting(0);
## Айди шахты. Айди создается при вступлении в шахту.
$MINE_ID = $player["level"];
$tr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"] + 1) . " and y=" . $player["miney"] . " and mine=" . $MINE_ID . ""));
$tl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"] - 1) . " and y=" . $player["miney"] . " and mine=" . $MINE_ID . ""));
$td = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"]) . " and y=" . ($player["miney"] + 1) . " and mine=" . $MINE_ID . ""));
$tu = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"]) . " and y=" . ($player["miney"] - 1) . " and mine=" . $MINE_ID . ""));
$t = time();
$timep = floor((10) - ($player["sp7"] / 100)); ##180 Время на раскопку туннеля.
$tper = 15; ## 15 Станд. время перехода по туннелю.
$no_make = 0; ## Запрета нет. Добывать можно.

if ($_GET["minego"] and $player["wait"] <= $t) {
    $res = mysqli_query($GLOBALS['db_link'], "SELECT * FROM resources ORDER BY RAND()");
    $r1 = mysqli_fetch_assoc($res);
    $r2 = mysqli_fetch_assoc($res);
    $r3 = mysqli_fetch_assoc($res);
    ## Рандуем кол-во ресурсов, для апдейта их в бд.
    $kr1 = floor(rand(4, 10) * sqrt($player["sp7"]) / $r1["price"]) + 2;
    $kr2 = floor(rand(4, 10) * sqrt($player["sp7"]) / $r2["price"]) + 2;
    $kr3 = floor(rand(4, 10) * sqrt($player["sp7"]) / $r3["price"]) + 2;
    //echo "<script>parent.chat_frame['list'].location='ch.php'</script>";
    ## Переход налево.
    if ($_GET["minego"] == 'left') {
        $player["minex"] = $player["minex"] - 1;
        $player["miney"] = $player["miney"];
        ## Если нет прохода, заполняем его ресурсами.
        if (!$tl["mine"]) mysqli_query($GLOBALS['db_link'], "INSERT INTO `mine` (`x`,`y`,`time_ready`,`r1id`,`r2id`,`r3id`,`r1k`,`r2k`,`r3k`,`mine`,`countp`)	VALUES ('" . ($player["minex"]) . "','" . ($player["miney"]) . "','" . ($t + $timep) . "','" . $r1["image"] . "','" . $r2["image"] . "','" . $r3["image"] . "','" . $kr1 . "','" . $kr2 . "','" . $kr3 . "','" . $MINE_ID . "','1');");
        elseif ($tl["time_ready"] > $t)
            ## Если есть, обновляем.
            mysqli_query($GLOBALS['db_link'], "UPDATE mine SET time_ready=" . ($t + ($tl["time_ready"] - $t) * ($tl["countp"] - 1) / $tl["countp"]) . ",countp=countp+1 WHERE x='" . ($player["minex"]) . "' and y='" . ($player["miney"]) . "' and mine=" . $MINE_ID . "");
    }
    ## Переход направо.
    if ($_GET["minego"] == 'right') {
        $player["minex"] = $player["minex"] + 1;
        $player["miney"] = $player["miney"];
        ## Если нет прохода, заполняем его ресурсами.
        if (!$tr["mine"]) mysqli_query($GLOBALS['db_link'], "INSERT INTO `mine` (`x`,`y`,`time_ready`,`r1id`,`r2id`,`r3id`,`r1k`,`r2k`,`r3k`,`mine`,`countp`) VALUES ('" . ($player["minex"]) . "','" . ($player["miney"]) . "','" . ($t + $timep) . "','" . $r1["image"] . "','" . $r2["image"] . "','" . $r3["image"] . "','" . $kr1 . "','" . $kr2 . "','" . $kr3 . "','" . $MINE_ID . "','1');");
        elseif ($tr["time_ready"] > $t)
            ## Если есть, обновляем.
            mysqli_query($GLOBALS['db_link'], "UPDATE mine SET time_ready=" . ($t + ($tr["time_ready"] - $t) * ($tr["countp"] - 1) / $tr["countp"]) . ",countp=countp+1 WHERE x='" . ($player["minex"]) . "' and y='" . ($player["miney"]) . "' and mine=" . $MINE_ID . "");
    }
    ## Переход вверх.
    if ($_GET["minego"] == 'up') {
        $player["minex"] = $player["minex"];
        $player["miney"] = $player["miney"] - 1;
        ## Если нет прохода, заполняем его ресурсами.
        if (!$tu["mine"]) mysqli_query($GLOBALS['db_link'], "INSERT INTO `mine` (`x`,`y`,`time_ready`,`r1id`,`r2id`,`r3id`,`r1k`,`r2k`,`r3k`,`mine`,`countp`) VALUES ('" . ($player["minex"]) . "','" . ($player["miney"]) . "','" . ($t + $timep) . "','" . $r1["image"] . "','" . $r2["image"] . "','" . $r3["image"] . "','" . $kr1 . "','" . $kr2 . "','" . $kr3 . "','" . $MINE_ID . "','1');");
        elseif ($tu["time_ready"] > $t)
            ## Если есть, обновляем.
            mysqli_query($GLOBALS['db_link'], "UPDATE mine SET time_ready=" . ($t + ($tu["time_ready"] - $t) * ($tu["countp"] - 1) / $tu["countp"]) . ",countp=countp+1 WHERE x='" . ($player["minex"]) . "' and y='" . ($player["miney"]) . "' and mine=" . $MINE_ID . "");
    }
    ## Переход вниз.
    if ($_GET["minego"] == 'down') {
        $player["minex"] = $player["minex"];
        $player["miney"] = $player["miney"] + 1;
        ## Если нет прохода, заполняем его ресурсами.
        if (!$td["mine"]) mysqli_query($GLOBALS['db_link'], "INSERT INTO `mine` (`x`,`y`,`time_ready`,`r1id`,`r2id`,`r3id`,`r1k`,`r2k`,`r3k`,`mine`,`countp`) VALUES ('" . ($player["minex"]) . "','" . ($player["miney"]) . "','" . ($t + $timep) . "','" . $r1["image"] . "','" . $r2["image"] . "','" . $r3["image"] . "','" . $kr1 . "','" . $kr2 . "','" . $kr3 . "','" . $MINE_ID . "','1');");
        elseif ($td["time_ready"] > $t)
            ## Если есть, обновляем.
            mysqli_query($GLOBALS['db_link'], "UPDATE mine SET time_ready=" . ($t + ($td["time_ready"] - $t) * ($td["countp"] - 1) / $td["countp"]) . ",countp=countp+1 WHERE x='" . ($player["minex"]) . "' and y='" . ($player["miney"]) . "' and mine=" . $MINE_ID . "");
    }
    ## Опдейтим юзеру координаты шахты и время перехода.
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET minex=" . $player["minex"] . ",miney=" . $player["miney"] . ",wait=" . ($t + $tper) . " WHERE id=" . $player["id"] . "");

    $player["wait"] = $t + $tper;
    $tr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"] + 1) . " and y=" . $player["miney"] . " and mine=" . $MINE_ID . ""));
    $tl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"] - 1) . " and y=" . $player["miney"] . " and mine=" . $MINE_ID . ""));
    $td = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"]) . " and y=" . ($player["miney"] + 1) . " and mine=" . $MINE_ID . ""));
    $tu = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . ($player["minex"]) . " and y=" . ($player["miney"] - 1) . " and mine=" . $MINE_ID . ""));
}
$tunnel = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM mine WHERE x=" . $player["minex"] . " and y=" . $player["miney"] . " and mine=" . $MINE_ID . ""));


## Проверяем надета ли кирка.
//*$inst = mysqli_query($GLOBALS['db_link'],"SELECT id,udmin,udmax,durability,price FROM wp WHERE uidp=".$player["uid"]." and weared=1 and p_type=5");
$inst = 1;
## Если нет кирки, запрещаем добычу.
if (!$inst["id"]) $no_make = 1;
## Добываем ресурсы.
if ($_GET["beginr"] and !$no_make and $player["wait"] < $t)//* and $player["tire"]<100
{
    echo "РЕСУРСЫ";
    //include($_SERVER["DOCUMENT_ROOT"]."/resource.php");
    //*$inst = mysqli_query($GLOBALS['db_link'],"SELECT id,udmin,udmax,durability FROM wp WHERE uidp=".$player["uid"]." and weared=1 and p_type=5");
    $inst = 1;
}
############################################
//echo "<br /> cursor test view";
$cursor = '';
//echo "<br /> cursor test view2";
## Отладка.
//echo " &nbsp;&nbsp;&nbsp;&nbsp; Право:".$tr["mine"]."Лево:".$tl["mine"]."Вверх:".$tu["mine"]." Вниз:".$td["mine"]."";
## Переход, если есть квадрат - переходим, если нет квадрата - копаем.
if (empty($tr["mine"]) or $tr["time_ready"] > $t) $cltr = 'class=fader onclick="go_confirm(\'right\')"'; else $cltr = 'onclick="location=\'main.php?minego=right\'"';
if (empty($tl["mine"]) or $tl["time_ready"] > $t) $cltl = 'class=fader onclick="go_confirm(\'left\')"'; else $cltl = 'onclick="location=\'main.php?minego=left\'"';
if (empty($tu["mine"]) or $tu["time_ready"] > $t) $cltu = 'class=fader onclick="go_confirm(\'up\')"'; else $cltu = 'onclick="location=\'main.php?minego=up\'"';
if (empty($td["mine"]) or $td["time_ready"] > $t) $cltd = 'class=fader onclick="go_confirm(\'down\')"'; else $cltd = 'onclick="location=\'main.php?minego=down\'"';
## Координаты персонажа в шахте.
$x = $player["minex"];
$y = $player["miney"];
$cells_around = mysqli_query($GLOBALS['db_link'], "SELECT x,y,time_ready FROM mine WHERE x>=" . ($player["minex"] - 3) . " and x<=" . ($player["minex"] + 3) . " and y>=" . ($player["miney"] - 2) . " and y<=" . ($player["miney"] + 2) . " and mine=" . $MINE_ID . "");
$maked_str = Array();
while ($cc = mysqli_fetch_assoc($cells_around))
    if ($cc["time_ready"] < $t)
        $maked_str[$cc["x"]][$cc["y"]] = 'move_yes'; ## Куда можно ходить.
    else
        $maked_str[$cc["x"]][$cc["y"]] = 'move_no'; ## FFFBD6. DDD555
$cursor .= '<b>Ваше местоположение [' . ($player["minex"]) . ' : ' . $player["miney"] . ']</b>';
if ($x == 0 and $y == 0) $mcell = '<b>0</b>'; else $mcell = '&nbsp;';
$cursor = $cursor . '<center><table border="1" width="280" cellspacing="0" cellpadding="0" height="200" class=return_win style="border:1px solid #0A8900;">
	<tr>                                    <!--1-->
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 1][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 1][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 2][$y - 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 3][$y - 2] . '">&nbsp;</td>
	</tr>
	<tr>                                   <!--2-->
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 3][$y - 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y - 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 1][$y - 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x][$y - 1] . '">
		<img border="0" src="images/battle/up.gif" width="10" height="14" style="cursor:pointer" ' . $cltu . '></td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 1][$y - 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 2][$y - 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 3][$y - 1] . '">&nbsp;</td>
	</tr>
	<tr>                                    <!--3-->
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 3][$y] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 1][$y] . '"><img border="0" src="images/battle/l.gif" style="cursor:pointer" width="14" height="10" ' . $cltl . '></td>
		<td align="center" width=38 height=38 style="border:2px solid #d60000;" class=move_pers>&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 1][$y] . '"><img border="0" src="images/battle/r.gif" style="cursor:pointer" width="14" height="10" ' . $cltr . '></td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 2][$y] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 3][$y] . '">&nbsp;</td>
	</tr>
	<tr>                                      <!--4-->
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 3][$y + 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y + 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 1][$y + 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x][$y + 1] . '">
		<img border="0" src="images/battle/down.gif" width="10" height="14" style="cursor:pointer" ' . $cltd . '></td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 1][$y + 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 2][$y + 1] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 3][$y + 1] . '">&nbsp;</td>
	</tr>
	<tr>                                        <!--5-->
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 3][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 2][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x - 1][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 1][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 2][$y + 2] . '">&nbsp;</td>
		<td align="center" width=40 height=40 class="' . $maked_str[$x + 3][$y + 2] . '">&nbsp;</td>
	</tr>
    </table></center>';
echo "<br /> cursor test view3";
## Показываем время ( переход, доыбча)
$t = $t;
if ($t < $player["wait"] or $tunnel["time_ready"] > $t) {
    if ($t < $tunnel["time_ready"]) {
        $player["wait"] = $tunnel["time_ready"];
        $cursor .= "<div align=center id=wtime>Выполняется действие...</div><br><div align=center><img src=\"/img/image/gameplay/72R5.gif\"></div><SCRIPT language=\"JavaScript\">wtime(" . ($player['wait'] - time()) . ");</SCRIPT>";//"<div id=wtime>Выполняется действие...</div><script>wtime(".mtrunc($player["wait"]-$t).");</script>";
    } else {
        $cursor .= "<div align=center id=wtime>Выполняется действие...</div><br><div align=center><img src=\"/img/image/gameplay/72R5.gif\"></div><SCRIPT language=\"JavaScript\">wtime(" . ($player['wait'] - time()) . ");</SCRIPT>";//"<div id=wtime>Выполняется действие...</div><script>wtime(".mtrunc($player["wait"]-$t).");</script>";
        $no_make = 1;  ## ЗапрещаемА добыча) при необходимости включить.
    }
}
## Показываем ресурсы, если ресурс доступен по умению горное дело.
## 1 ячейка с ресурсом
if ($tunnel["r1id"]) $r1 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM resources WHERE image='" . $tunnel["r1id"] . "' and umen<=" . $player["sp7"] . ""));
$r1["k"] = $tunnel["r1k"];
## 2 ячейка с ресурсом
if ($tunnel["r2id"]) $r2 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM resources WHERE image='" . $tunnel["r2id"] . "' and umen<=" . $player["sp7"] . ""));
$r2["k"] = $tunnel["r2k"];
## 3 ячейка с ресурсом
if ($tunnel["r3id"]) $r3 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM resources WHERE image='" . $tunnel["r3id"] . "' and umen<=" . $player["sp7"] . ""));
$r3["k"] = $tunnel["r3k"];
## Запрещаем добычу, если усталость 100%.
//* if ($player["tire"]>99) $no_make = 1;
## Показываем надейные ресурсы в шахте.
$resources = '';
//if ($inst) $resources .= '<center>Долговечность кирки: <b>'.$inst["durability"].'</b>
//<br>Горное дело: <b>sp7 '.floor($player["sp7"]).'</b>
//<br>Добыча камней: <b>sp13 '.floor($player["sp13"]).'</b></center>';
## 1 ячейка с ресурсом
if ($r1["image"]) //* and mtrunc($r1["k"])
{
    if (!$no_make)
        $begin = '<input class=hbutton type=button value="Начать добычу" onclick="location=\'main.php?beginr=' . $r1["image"] . '\'">';
    else $begin = '';
    $resources .= '<table border=0 width=100%>';
    $resources .= '<tr>';
    $resources .= '<td align=center width=60><img src=images/weapons/resources/' . $r1["image"] . '.gif></td>';
    $resources .= '<td class=items><font class=user><b>[' . $r1["name"] . ']</b></font>';
    $resources .= '<br> Цена: <b>' . $r1["price"] . ' <img src=images/mon2.gif></b><br> Обнаружено: <b>' . $r1["k"] . '</b>&nbsp;единиц<br>' . $begin . '</td>';
    $resources .= '</tr>';
    $resources .= '</tr>';
    $resources .= '</table>';
}
## 2 ячейка с ресурсом
if ($r2["image"]) //* and mtrunc($r2["k"])
{
    if (!$no_make) $begin = '<input class=hbutton type=button value="начать добычу" onclick="location=\'main.php?beginr=' . $r2["image"] . '\'">'; else $begin = '';
    $resources .= '<table border=0 width=100%>';
    $resources .= '<tr>';
    $resources .= '<td align=center width=60><img src=images/weapons/resources/' . $r2["image"] . '.gif></td>';
    $resources .= '<td class=items><font class=user><b>[' . $r2["name"] . ']</b></font>';
    $resources .= '<br> Цена: <b>' . $r2["price"] . ' <img src=images/mon2.gif></b><br> Обнаружено: <b>' . $r2["k"] . '</b>&nbsp;единиц<br>' . $begin . '</td>';
    $resources .= '</tr>';
    $resources .= '</table>';
}
## 3 ячейка с ресурсом
if ($r3["image"]) //* and mtrunc($r3["k"])
{
    if (!$no_make) $begin = '<input class=hbutton type=button value="Начать добычу" onclick="location=\'main.php?beginr=' . $r3["image"] . '\'">'; else $begin = '';
    $resources .= '<table border=0 width=100%>';
    $resources .= '<tr>';
    $resources .= '<td align=center width=60><img src=images/weapons/resources/' . $r3["image"] . '.gif></td>';
    $resources .= '<td class=items><font class=user><b>[' . $r3["name"] . ']</b></font>';
    $resources .= '<br> Цена: <b>' . $r3["price"] . ' <img src=images/mon2.gif></b><br> Обнаружено: <b>' . $r3["k"] . '</b>&nbsp;единиц<br>' . $begin . '</td>';
    $resources .= '</tr>';
    $resources .= '</table>';
}
if (!$resources) $resources .= 'Не обнаружено.';

// echo "test view frames";
?>

<table width=100% cellspacing=0 cellpadding=0 border=0>

    <!--<div align=center class=but width=300 valign=top style="background-image:url('/img/images/locations/mine<?php echo(date("i") % 5 + 1); ?>.jpg');background-repeat:no-repeat;">-->
    <div id=mainbox></div>

    <td align=center valign=top>

        <?
        /****
         * $_MINE = 0;
         * $tme = time();
         * $tmp1 = mysqli_query($GLOBALS['db_link'],"SELECT esttime FROM p_auras WHERE uid=".$player["uid"]." and special=14");
         * while($p1 = mysqli_fetch_assoc($tmp1,mysqli_ASSOC))
         * if ($p1["esttime"]>tme())
         * $_MINE = ($p1["esttime"]-$tme);
         * $_UMINE = 0;
         * $tmp2 = sql("SELECT esttime FROM p_auras WHERE uid=".$player["uid"]." and special=15");
         * while($p2 = mysqli_fetch_assoc($tmp2,mysqli_ASSOC))
         * $_UMINE = ($p2["esttime"]-$tme);
         *
         *
         *
         * ## Входим в шахту.
         * if (@$_GET["gomine"] and $_MINE and !$_UMINE and $player["waiter"]<=$tme)
         * {
         * //*set_vars("minex=0,miney=0,waiter=".(tme()+20).",loc=43",$player["uid"]);
         * echo "<script>parent.chat_frame['list'].location='ch.php'</script>";
         * echo "<script>parent.top_frame.location='main.php';</script>";
         * }
         ****/
        ?>
        <?

        if ($x == 0 and $y == 0) {
//echo "<script>d.write(form_main_left);d.write(form_title('Действие'));d.write(form_main_right);</script>";
            echo "<input type=button class=hbutton onclick=\"location='main.php?outmine=1'\" value='Подняться из шахты' style='width:100%'>";
//echo "<script>d.write(form_main_bottom);</script>";
        }
        ?>


        <?
        ## Показываем найденые ресурсы
        echo $resources;
        echo $cursor;
        ?>
        <?
        //*if ($_MINE and !$_UMINE)
        //*echo "<center class=but>Лицензия на добычу ресурсов закончиться через: ".tp($_MINE).".</center>";
        ?>
    </td>
    </tr>
</table> <!--id=inf_from_php-->
<!--<div  id=inf_from_php style="position:absolute;display:none;"><?= $cursor; ?></div>-->
</html></TR></TABLE>

<script type="text/javascript">
    <? if (isset($m_mine) && !empty($m_mine)): ?>
    message_window('confirm', '', '<?=$m_mine?>', 'ereage', '')
    <? endif; ?>
</script>


<script>
    build_mine();

    function go_confirm(where) {
        if (confirm("Туннель завален , вы хотите раскопать новый туннель?"))
            location = 'main.php?minego=' + where;
    }
</script>
<SCRIPT language='JavaScript'>
    NewLinksView();
</SCRIPT>
