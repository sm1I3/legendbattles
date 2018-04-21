<?php
include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/pers/buffs.php");
global $od;
$plmases = explode("|", $player['masebonus']);
foreach ($plmases as $val) {
    $mase = explode("@", $val);
    if ($mase[1] >= time() and $mase[0]) {
        $maseit = $_POST['maseit'] ?? $_GET['maseit'] ?? '';
        if ($maseit == '') {
            $maseit = "`id`='" . $mase[0] . "'";
        } else {
            $maseit .= " OR `id`='" . $mase[0] . "'";
        }
        $newmase .= $mase[0] . '@' . $mase[1] . ($mase[2] ? '@' . $mase[2] : '') . '|';
    }
}
$newmase = substr($newmase, 0, strlen($newmase) - 1);
$buffs = explode("|", $newmase);
foreach ($buffs as $value) {
    $buff = explode("@", $value);
    $buff[1] -= time();
    $ch[$buff[0]] = floor($buff[1] / 3600);
    $min[$buff[0]] = floor(($buff[1] - ($ch[$buff[0]] * 3600)) / 60);
    $time[$buff[0]] = $ch[$buff[0]] . "ч." . $min[$buff[0]] . "м.";
}
$mysql2 = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE " . $maseit . " ;");
$itemcount = 0;
while ($row = mysqli_fetch_assoc($mysql2)) {
    $itemnames[$itemcount] = $row['name'];
    $itemids[$itemcount] = $row['id'];
    $itemgifs[$itemcount] = $row['gif'];
    $itemcount++;
    $modstat = '';
    $item = explode("|", $row['param']);
    $mod = explode("|", $row['mod']);
    if ($row['type'] == 'w20') {
        $bl = $row['block'];
        $tw = $row['type'];
    }
    if ($row['slot'] > 0 and $row['type'] != 'w20') {
        $it = explode("|", $row['need']);
        foreach ($it as $val) {
            $need = explode("@", $val);
            if ($need[0] == 28 and $need[1] > $od) {
                $od = $need[1];
                $tw = $row['type'];
            }
        }
    }
    foreach ($item as $value) {
        $k = 1;
        $stat = explode("@", $value);
        //echo '<br>test: '.$value.' afterexplode >> '.$stat[0].' | '.$stat[1];;
        if (in_array($stat[0], $t) and $stat[0] != 'expbonus' and $stat[0] != 'massbonus') {
            $par[$stat[0]] = '';
            continue;
        }
        if ($stat[0] == 1) {
            $tmp = explode("-", $stat[1]);
            $tw = $_POST['tw'] ?? $_GET['tw'] ?? '';
            switch ($tw) {
                case 'w1':
                    $k = ($um[10] / 300 + $um[1] / 150) + 1;
                    break;
                case 'w2':
                    $k = ($um[10] / 300 + $um[2] / 150) + 1;
                    break;
                case 'w3':
                    $k = ($um[10] / 300 + $um[3] / 150) + 1;
                    break;
                case 'w4':
                    $k = ($um[10] / 300 + $um[4] / 150) + 1;
                    break;
                case 'w5':
                    $k = ($um[10] / 300 + $um[5] / 150) + 1;
                    break;
                case 'w6':
                    $k = ($um[10] / 300 + $um[6] / 150) + 1;
                    break;
                case 'w7':
                    $k = ($um[10] / 300 + $um[7] / 150) + 1;
                    break;
                case 'w20':
                    $k = $um[10] / 300 + 1;
                    break;
            }
            $tmp[0] = round($tmp[0] * $k);
            $tmp[1] = round($tmp[1] * $k);
            $tmp1 = explode("-", $par[1]);
            $modstat[1] != '' ? $tmp2 = explode("-", $modstat[1]) : $tmp2 = '';
            $tmp[0] += $tmp1[0] + $tmp2[0];
            $tmp[1] += $tmp1[1] + $tmp2[1];
            if ($tmp) {
                $par[1] = implode("-", $tmp);
            } else {
                $par[1] = '';
            }
            continue;
        }
        $par[$stat[0]] += ($stat[1] + $modstat[$stat[0]]);
        /*if($stat[0]=='expbonus'){
            echo '<br> tstmase: '.$stat[0].'@'.$stat[1];
        }*/
    }
    if ($row['damage_mod'] != 0) {
        $dmod = explode("@", $row['damage_mod']);
        $dmoddmg = explode("-", $dmod[1]);
        $damage_mod[$dmod[0]][0] += $dmoddmg[0];
        $damage_mod[$dmod[0]][1] += $dmoddmg[1];
    }
}
for ($dm = 1; $dm <= 4; $dm++) {
    $moddmg[$dm] = implode("-", $damage_mod[$dm]);
    $dmgmod .= (($damage_mod[$dm] == '') ? '' : $dm . "@" . $moddmg[$dm] . "|");
}
$dmgmod = substr($dmgmod, 0, strlen($dmgmod) - 1);
$fpar = '';
foreach ($par as $key => $val) {
    $fpar .= $key . '@' . $val . '|';
}
$fpar = substr($fpar, 0, strlen($fpar) - 1);
$ITEM['param'] = $fpar;
$ITEM['damage_mod'] = $dmgmod;
$ITEM['masebuffs'] = 1;
$tmparams = itemparams(0, $ITEM, $player, $plst);
$params = $tmparams[0];
?>
<div class="module mase">
    <div class="header">
        Мази и прочее
        <a href="javascript:parent.helpwin('legendbattles.ru/help.php?mases=1')" target="_blank">
            <img src=/img/image/info.gif width=6 height=12 border=0 title="Помощь" valign=top>
        </a>
    </div>
    <div class="content">
        Мазей использовано <font color=green><?= $itemcount ?></font>/<font color=#cc0000>5</font>
        <div>
            <? for ($b = 0; $b < $itemcount; $b++) {
                echo '<img src="/img/image/weapon/' . $itemgifs[$b] . '" width="29" height="29" onmouseover="tooltip(this,\'<table cellpadding=0 cellspacing=0 border=0  align=center class=nickname><tr><td align=center><b>' . $itemnames[$b] . '</b></td></tr><tr><td align=center>еще ' . $time[$itemids[$b]] . '</td></tr>\')" onmouseout="hide_info(this)">&nbsp;';
            } ?>
        </div>
        <div <?= ($itemcount ? '' : 'style="display:none";') ?>>
            <font color="#996633">Все бонусы</font>
            <div><?= $params ?></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("img.slot").parent().append("<img src='/img/image/ld3.gif' id='mase'>");

        $("#mase").live('click', function () {
            $(".module.mase").toggle();
        });
    });
</script>
<div id="first-column">
    <div id="transfer"></div>
    <div class="money">
        <div class="lr" onClick="transferform('0','0','Игровую валюту','<?= scode() ?>','0','0','0','0')">
            <?= lr($player['nv']) ?>
        </div>
        <div class="dlr">
            <?= $player['baks'] ?> <img src="img/razdor/emerald.png" width=14 title="Изумруд" height=14>
            <?= $player['izym'] ?> <img src="img/razdor/emerald2.png" width=14 title="Компенсация" height=14>
            <?= $player['sneg'] ?> <img src="img/image/weapon/snow.png" width=14 title="Волшебная снежинка" height=14>
        </div>
    </div>
    <SCRIPT language="JavaScript">
        slots_inv("<?=$player['obraz']?>", "<?=$_SESSION['user']['login']?>", "<? slotwiev($player['id'], $_SESSION['user']['pos']);?>", 115);
    </SCRIPT>

    <? if ($player['semija'] != '') { ?>
        <div id="zaks">
            <?
            if ($player['semija'] != 'не замужем') {
                if ($player['semija'] != 'не женат') {
                    ?>
                    В браке на
                <? }
            } ?>
            <b><i>&nbsp;<?= $player['semija'] ?>     <? if ($player['semija'] != 'не замужем') { ?><? if ($player['semija'] != 'не женат') { ?>
                        <img src=img/image/rings.gif><?
                    } ?><?
                    } ?></i></b>
        </div>
        <?
    }
    if ($player['useaction'] == 1) {
        ?>
        <div class="module comp">
            <div class="header">
                Ваши комплекты
            </div>
            <div class="content">
                <SCRIPT language="JavaScript">
                    <?
                    $q = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM pcompl WHERE uid=' . AP . $player['id'] . AP . '');
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo "compl_view(\"$row[name]\",\"$row[id]\",\"" . scode() . "\");";
                    }
                    ?>
                </SCRIPT>
                <input type=button class=invbut onClick="compl_f('<?= scode() ?>')" value="Запомнить комплект">
                <input type=button class=invbut
                       onClick="javascript: location='main.php?post_id=57&act=3&vcode=<?= scode() ?>'"
                       value="Снять все вещи">
                <div id="complect"></div>
            </div>
        </div>
        <?
    }
    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/pers/exp.php");
    ?>
</div>

<div id="second-column">
    <?php
    $trw = affect($player['affect'], 3, true);
    foreach ($trw as $key => $val) {
        $plst[$key] += $val;
    }
    foreach (explode("|", $player['perk']) as $key => $val) {
        if ($val == '') {
            $val = 0;
        }
        $perk[$key] = $val;
    }
    $st[1] = $player['sila'] + ($perk[7] * 2);
    $st[2] = $player['lovk'] + ($perk[9] * 2);
    $st[3] = $player['uda4a'] + ($perk[10] * 2);
    $st[4] = $player['zdorov'] + ($perk[8] * 2);
    $st[5] = $player['znan'] + ($perk[11] * 2);
    foreach ($st as $key => $val) {
        if ($val <= 0) $st[$key] = 0;
    }
    $stats = array('Сила', 'Ловкость', 'Везение', 'Живучесть', 'Разум');
    ?>
    <div class="module stats">
        <div class="header">
            Статы
            <a href="javascript:parent.helpwin('legendbattles.ru/help.php?stats=1')" target="_blank">
                <img src=img/image/info.gif width=6 height=12 border=0 title="Помощь" valign=top>
            </a>
        </div>
        <div class="content">
            <? for ($i = 0; $i <= 4; $i++) { ?>
                <div>
                    <img src="img/images/stats/st<?= $i ?>.jpg"/> <?= $stats[$i] ?>: <span class="cnt"
                                                                                           id="st<?= $i ?>"><?= $plstt[30 + $i] ?></span>
                    <? if ($plst[30 + $i]) { ?>
                        ( <?= $st[1 + $i] ?> + <span class="extra"><?= $plst[30 + $i] ?></span> )
                    <? }
                    if ($player['free_stat'] > 0) {
                        ?>
                        <input type=image src="img/image/+.gif" name="sub" onClick="javascript: AddStats(<?= $i ?>);">
                        <input type=image src="img/image/-.gif" name="sub" onClick="javascript: RemStats(<?= $i ?>);">
                    <? } ?>
                </div>
            <? } ?>
            <? if ($player['free_stat'] > 0) { ?>
                <tr>
                    <td colspan=5 class=freemain>
                        <div align=center><a href="javascript: SaveStats();">Сохранить</a></div>
                    </td>
                </tr>
                <?
                include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/freestats.php");
                ?>
            <? } ?>
        </div>
    </div>
    <?
    list($uronMax, $uronMin) = explode("-", $plst[1]);
    ?>
    <div class="module modif">
        <div class="header">
            Модификаторы
            <a href="javascript:parent.helpwin('legendbattles.ru/help.php?stats=1')" target="_blank">
                <img src=/img/image/info.gif width=6 height=12 border=0 title="Помощь" valign=top>
            </a>
        </div>
        <div class="content">
            <div>
                Утомление : <span class="cnt"><? if ($player['ustal'] < time()) {
                        echo 0;
                    } else {
                        echo round(($player['ustal'] - time()) / (150 / ($plstt[58] / 200 + 1)));
                    } ?>%</span>
            </div>
            <div>
                Урон : <span class="cnt"><?= round($uronMin, 0) ?>-<?= round($uronMax, 0) ?></span>
            </div>
            <? if ($plst[9]) { ?>
                <div>
                    Уровень брони : <span class="cnt"><?= ($plst[9] + ($perk[32] * 30)) ?></span>
                </div>
            <? } ?>
            <? if ($plstt[28]) { ?>
                <div>
                    Очки действия (об) : <span class="cnt"><?= $plstt[28] ?></span>
                </div>
            <? } ?>
            <? if ($player['od'] > 0) { ?>
                <div>
                    Очки действия (уд) : <span class="cnt"><?= $player['od'] ?></span>
                </div>
            <? } ?>
            <? if ($plst[5]) { ?>
                <div>
                    Уловка : <span class="cnt"><?= ($plst[5] + ($perk[19] * 30)) ?>%</span>
                </div>
            <? } ?>
            <? if ($plst[6]) { ?>
                <div>
                    Точность : <span class="cnt"><?= ($plst[6] + ($perk[0] * 30)) ?>%</span>
                </div>
            <? } ?>
            <? if ($plst[7]) { ?>
                <div>
                    Сокрушение : <span class="cnt"><?= ($plst[7] + ($perk[5] * 30)) ?>%</span>
                </div>
            <? } ?>
            <? if ($plst[8]) { ?>
                <div>
                    Стойкость : <span class="cnt"><?= ($plst[8] + ($perk[15] * 30)) ?>%</span>
                </div>
            <? } ?>
            <? if ($plst[10]) { ?>
                <div>
                    Пробой брони : <span class="cnt"><?= $plst[10] ?>%</span>
                </div>
            <? } ?>
            <? if ($plstt[99] != 0 and $plstt[99] != '') { ?>
                <div>
                    Снижение урона : <span class="cnt"><?= round(100 - 100 / ($plstt[99] / 250 + 1)) ?>%</span>
                </div>
            <? } ?>
            <? if ($plst[71]) { ?>
                <div>
                    Коэффициент : <span class="cnt"><?= $plst[71] ?>%</span>
                </div>
            <? } ?>
        </div>
    </div>
    <div class="module clan">
        <div class="header">
            Клановые бонусы
        </div>
        <div class="content">
            <? if ($player['clan_id'] != 'none') {
                $clsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM clans WHERE clan_id='" . $player['clan_id'] . "';"));
                echo '
	<div>Сила : <span class="cnt">' . $clsql['cl_sila'] . '</span></div>
	<div>Ловкость:<span class="cnt">' . $clsql['cl_lovkost'] . '</span></div>
	<div>Везение:<span class="cnt">' . $clsql['cl_ydacha'] . '</span></div>
	<div>Живучесть:<span class="cnt">' . $clsql['cl_zdorov'] . '</span></div>
	<div>Разум:<span class="cnt">' . $clsql['cl_znan'] . '</span></div>
	<div>HP:<span class="cnt">' . $clsql['cl_hp'] . '</span></div>
	<div>MP:<span class="cnt">' . $clsql['cl_mp'] . '</span></div>
	';
            } else { ?>
                Клановые бонусы отсутствуют.
            <? } ?>
        </div>
    </div>
    <?
    list($uronMax, $uronMin) = explode("-", $plst[1]);
    if ($player['damage_mods']) {
        ?>
        <div class="module mag">
            <div class="header">
                Магический урон
            </div>
            <div class="content">
                <?
                $dmodarr = array(1 => '&nbsp;Урон огнем', 2 => '&nbsp;Урон льдом', 3 => '&nbsp;Вампиризм', 4 => '&nbsp;Лечение');
                $dmgm = explode("|", $player['damage_mods']);
                foreach ($dmgm as $val) {
                    $dmod = explode("@", $val);
                    if ($dmod[0] != '' and $dmod[1] != '') {
                        list($ModMax, $ModMin) = explode("-", $dmod[1]);
                        if (round($ModMax, 0) > 0) {
                            echo '<div>' . $dmodarr[$dmod[0]] . ' : <span class="cnt">' . round($ModMin, 0) . '-' . round($ModMax, 0) . '</span></div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    <? } ?>
    <?
    list($uronMax, $uronMin) = explode("-", $plst[1]);
    ?>
    <div class="module modif">
        <div class="header">
            Профессии
        </div>
        <div class="content">
            <? if ($plstt[70] != 0 and $plstt[70] != '') { ?>
                <div>
                    Травничество : <span class="cnt"><?= ($plst[70] + ($player['trav'])) ?></span>
                </div>
            <? } ?>
            <? if ($plstt[68]) { ?>
                <div>
                    Алхимия : <span class="cnt"><?= ($plst[68] + ($player['alhim'])) ?></span>
                </div>
            <? } ?>
            <? if ($plstt[68]) { ?>
                <div>
                    Лесоруб : <span class="cnt"><?= ($plst[60] + ($player['les'])) ?></span>
                </div>
            <? } ?>
            <? if ($plstt[59]) { ?>
                <div>
                    Рыболов : <span class="cnt"><?= ($plst[59] + ($player['fish_skill'])) ?></span>
                </div>
            <? } ?>
            <? if ($plstt[75] != 0 and $plstt[75] != '') { ?>
                <div>
                    Колдун : <span class="cnt"><?= ($plst[75] + ($player['koldyn'])) ?></span>
                </div>
            <? } ?>
            <? if ($player['vzlomshik_nav'] > 0) { ?>
                <div>
                    Взломщик : <span class="cnt"
                                     onmouseover="tooltip(this,'Взломанных сундуков: <b><?php echo $player['vzlomshik_exp']; ?> </b>')"
                                     onmouseout="hide_info(this)"><?= $player['vzlomshik_nav'] ?></span>
                </div>
            <? } ?>
            <? if ($plstt[55] != 0 and $plstt[55] != '') { ?>
                <div>
                    Палач : <span class="cnt"><?= ($plst[55] + ($player['palac'])) ?></span>
                </div>
            <? } ?>
        </div>
    </div>
</div>
<div id="third-column">
    <?
    if ($_SESSION['user']['pos'] == 1) {
        include("gameplay/inc/pers/inv.php");
    } else {
        include("gameplay/inc/mselect.php");
        $_GET['mselect'] = isset($_GET['mselect']) ? htmlspecialchars(addslashes($_GET['mselect'])) : "0";//main-info
        include("gameplay/inc/mpr/" . $_GET['mselect'] . ".php");
    }
    ?>

    <SCRIPT language="JavaScript">
        counterview("free");
    </SCRIPT>
</div>