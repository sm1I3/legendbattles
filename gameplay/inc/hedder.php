<?
$player = player();
//function
function check_battle_users($id, $user)
{
    $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM arena WHERE id_battle='" . $id . "'"));
    if ($row["id_battle"] == '') {
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET battle='0' WHERE id='" . $user . "'");
        $msg = 0;
    } else {
        $msg = 1;
    }
    return $msg;
}

//end function
if ($player['battle'] <> 0) {
    if (check_battle_users($player['battle'], $player['id']) == 0) {
        check_battle_users($player['battle'], $player['id']);
        $player['battle'] == 0;
    }
}
$locs = array('28', '80', '81', '50', '22', '101', '103', '104', '102', '500', '1224', '8', '501', '1000', '1001', '51');
if ($player['pos'] != '12_9' and !$player['prison'] and $player['login'] != 'ЂдминистрациЯ' and !in_array($player['loc'], $locs)) {
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='28' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
    $redirect = "parent.frames['main_top'].location='main.php';";
    echo "<script>" . $redirect . "</script>";
}

//  Подводный мир
$UnderWater = false;
if ($player['loc'] >= 101 and $player['loc'] <= 104) {
    $NeedItemsArr = array(2786, 2787, 2788, 2789, 2791, 2792, 2793, 2794, 3158);
    for ($i = 0; $i < count($NeedItemsArr); $i++) {
        if (mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent` WHERE `pl_id`='" . $player['id'] . "' and `protype`='" . $NeedItemsArr[$i] . "' and `used`='1'")) > 0) {
            $TempWater[] = true;
        }
    }
    if (count($TempWater) == count($NeedItemsArr)) {
        $UnderWater = true;
    }
    if ($UnderWater == false) {
        if ($player['loc'] > 101) {
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='101' WHERE `id`='" . $player['id'] . "'");
            echo "<script>top.frames['main_top'].location='main.php';</script>";
        }
    }
}
//
$clan_p = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM clans WHERE clan_id='" . $player['clan_id'] . "'"));
$img = array('1x1', 'darks', 'lights', 'sumers', 'chaoss', 'light', 'dark', 'sumer', 'chaos', 'angel');
$name = array('', '?ети “ьмы', '?ети —вета', '?ети —умерек', '?ети ’аоса', '»стинный —вет', '»стинна¤ “ьма', 'Ќейтральные —умерки', 'јбсолютный ’аос', 'јнгел');
$vis = explode("|", $player['viselica']);
$ret = ret_id($player['loc'], $player['pos']);
$pris = explode("|", $player['prison']);
$travm = explode("@", $player['affect']);
$userprem = explode("|", $player['premium']);
if ($userprem[1] < time()) {
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET premium='1|0',forum_smiles='1' WHERE id='" . $player['id'] . "';");
    $userprem[0] = 1;
}
$prsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM premium_info WHERE id='" . $userprem[0] . "';"));
$otherbonus = explode("|", $player['otherbonus']);
$massbonus = '';
foreach ($otherbonus as $val) {
    $row = explode("@", $val);
    if ($row[0] == 'massbonus') {
        if ($row[1] > 1) {
            $massbonus = $row[1];
        } else {
            $massbonus = 0;
        }
    }
}

$mass = ($plstt[30] * 4) + ($plstt[33] * 8) + $plstt[72] + $prsql['mass'] + $massbonus;

if ($player['wait'] > time() or $plstt[71] > $mass or $pris[0] > time() or $vis[1] > time()) {
    $dis = 1;
} else {
    $dis = 0;
}
?>
<HTML>
<HEAD>
    <link rel="stylesheet" href="css/css.php?f=game|stl|core|introjs.min">
    <META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
    <META Http-Equiv=Cache-Control Content=No-Cache>
    <META Http-Equiv=Pragma Content=No-Cache>
    <META Http-Equiv=Expires Content=0>
    <SCRIPT src="/js/timer_town.js"></SCRIPT>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/scroll.js"></script>
    <script type="text/javascript" src="/js/signs.js"></script>
    <? if ($_SESSION['user']['pos'] == 1) { ?>
        <SCRIPT src="./js/compl.js"></SCRIPT>
        <SCRIPT src="/js/selling.js"></SCRIPT><? } ?>
    <script src="/js/overlib.js"></script>
    <SCRIPT src="/js/counter.js"></SCRIPT>
    <SCRIPT src="/js/ft_v01.js?v1"></SCRIPT>
    <SCRIPT src="/js/t_v01.js"></SCRIPT>
    <SCRIPT src="/js/png.js"></SCRIPT>
    <SCRIPT src="/js/hp.js"></SCRIPT>
    <? if ($_SESSION['user']['pos'] < 2) { ?>
        <SCRIPT src="/js/slots.js?v1"></SCRIPT>
        <SCRIPT src="/js/transfer.js"></SCRIPT>
        <SCRIPT src="/js/effects_v03.js"></SCRIPT>
    <? if ($player['free_stat'] > 0){ ?>
        <SCRIPT src="/js/addstat.js"></SCRIPT><? } ?>
        <SCRIPT src="/js/svitok.js?v2"></SCRIPT>
    <? } ?>
    <?php
    if (mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT `quest` FROM `loc` WHERE `id`='" . $player['loc'] . "'"), 0) and $_SESSION['user']['pos'] > 1) {
        echo '<SCRIPT src="/js/ajax.js"></SCRIPT>
<SCRIPT src="/js/quest.js"></SCRIPT>
<SCRIPT src="/js/nl_windows_mess_v01.js"></SCRIPT>';
        $QuestButton = 1;
    }
    ?>
    <script type="text/javascript" src="/js/intro.js?v1"></script>
    <script type="text/javascript">
        $(function () {
            if (window.PIE) {
                $('.rounded').each(function () {
                    PIE.attach(this);
                });
            }
        });
    </script>

</HEAD>

<BODY>
<SCRIPT src="./js/stooltip.js"></SCRIPT>
<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>
<div id="header">
    <? if ($vis[1] > time()) { ?>
        <div class="hurt">
            <b>’Яжелые увечьЯ!</b> Ќевозможно совершать никаких действий
            еще: <?= date("Hч. iм. sс.", ($vis[1] - time())) ?>
        </div>
    <? } ?>
    <div class="TopBar">
        <div class="TopBar_left">
            <div class="LEM fontSize_11px bold color_111">
				<span class="MyName">
				<center>
				<? if ($player['clan_id'] != 'none') { ?>
                    <img src='img/image/signs/<?= $img[$clan_p['clan_sclon']] ?>.gif'
                         <?= (($clan_p['clan_sclon']) ? "title='" . $name[$clan_p['clan_sclon']] . "' " : "") ?>width=15
                         height=12 align=absmiddle border=0>
                    <img src="img/image/signs/<?= $clan_p['clan_gif'] ?>" width="15" height="12" align="absmiddle"
                         title="<?= $clan_p['clan_name'] ?> (<?= $player['clan_d'] ?>)"/>
                <? } ?> <span style="font-weight: normal;"><?= $_SESSION['user']['login'] ?> [<?= $player['level'] ?>
                        ]</span>
				</center>
				</span>
                <div class="LEM_bg fontSize_10px color_fff">
                    <div class="Health mainTooltip" id="Health" style="background-position:-0px 0px;">???</div>
                    <div class="Mana mainTooltip" id="Mana" style="background-position:-0px -13px;">???</div>
                </div>
            </div>
        </div>
        <div class="TopBar_right">
            <?
            if ($player['loc'] == 28) {
                if ($ret[0] != 0 and $dis == 0 and $_SESSION['user']['pos'] > 1) {
                    ?>
                    <a href="main.php?get=3&go=<?= $ret[0] ?>&vcode=<?= scode() ?>"
                       class="MovementMenu mainTooltip"></a>
                    <?
                } ?>
                <a href="<?= (($_SESSION['user']['pos'] > 1) ? '#' : 'main.php?get=3&go=' . $player['loc'] . '&vcode=' . scode()) ?>"
                   class="MovementMenu mainTooltip"></a>
            <? } else if ($player['loc'] == '80' or $player['loc'] == '81' or $player['loc'] == '49' or $player['loc'] == '50' or $player['loc'] == '51' or $player['loc'] == '1001' or $player['loc'] == '22' or $player['loc'] == '101') {
                if ($ret[0] != 0 and $dis == 0 and $_SESSION['user']['pos'] > 1) {
                    ?>
                    <a href="main.php?get=3&go=<?= $ret[0] ?>&vcode=<?= scode() ?>"
                       class="MovementMenu mainTooltip"></a>
                <? }
            } else if ($player['loc'] != 32 and $player['loc'] != 501) {
                if ($player['level'] > 4) {
                    ?>
                    <a href="<?= (($_SESSION['user']['pos'] == 2 or $player['battle'] != 0 or $dis == 1) ? '#' : 'main.php?get=2&go=' . $ret[0] . '&vcode=' . scode() . '" onmouseover="tooltip(this,\'' . $ret[1] . '\')" onmouseout="hide_info(this)') ?>"
                       class="MovementMenu mainTooltip"></a>
                <? }
            }
            if ($_SESSION['user']['pos'] < 2 and $ret[4] == 0) {
                ?>
                <a href="main.php?get=3&vcode=<?= scode() ?>" class="MovementMenu mainTooltip"></a>
            <? } ?>
            <div class="hours" style="float: right;margin-top:1px;margin-right: 121px;"><img
                        src="img/razdor/emerald.png" width="14" height="14" title="+1 Изумруд"></div>
            <div class="lines" style="float: right;">
                <div class="dlr" style="margin-top: 8px;margin-right: 3px;">
                    <div class="line" id="dlrline"
                         style="width:<?= (3600 - ($player['onlineBouns'] - time())) / 36 ?>%"></div>
                    <div class="cnt" id="dlrcnt">
                        Еще <?= ((($player['onlineBouns'] - time()) >= 3600) ? "60:00" : date("i:s", ($player['onlineBouns'] - time()))) ?></div>
                    <div class="hrs" id="hrs"><? for ($i = 1; $i <= 10; $i++) { ?>
                            <div class="hr<?= (($i <= $player['onlineHour']) ? ' active' : '') ?>"></div>
                        <? } ?></div>
                </div>
            </div>
            <script>
                var bouns = <?=$player['onlineBouns']?>;
                setInterval(function () {
                    var tt = bouns * 1000 - (new Date()),
                        time = new Date(tt),
                        seconds = time.getSeconds(),
                        minutes = time.getMinutes();
                    if (seconds < 10) seconds = '0' + seconds;
                    if (seconds || minutes) {
                        document.getElementById("dlrcnt").innerHTML = 'Еще ' + minutes + ':' + seconds;
                        document.getElementById("dlrline").style.width = Math.floor((3600 - tt / 1000) / 36) + "%";
                    }
                }, 1000);
            </script>
        </div>
        <div class="TopBar_center">
            <ul class="MainMenu">
                <li class="CharacterMenu">
                    <a href="<?= (($player['battle'] != 0) ? '#' : 'main.php?get=0&vcode=' . scode()) ?>"
                       id="CharacterMenu" class="mainTooltip" onmouseover="tooltip(this,'<b>Персонаж</b>');"
                       onmouseout="hide_info(this);"></a>
                </li>
                <li class="InventoryMenu">
                    <a href="<?= (($_SESSION['user']['pos'] == 1 or $player['battle'] != 0) ? '#' : 'main.php?get=1&vcode=' . scode() . (($_SESSION['user']['pos'] == 0 and $player['NewGameSteps'] == 0) ? '&new-steps=2' : '')) ?>"
                       id="InventoryMenu" class="mainTooltip" onmouseover="tooltip(this,'<b>Инвентарь</b>');"
                       onmouseout="hide_info(this);"></a>
                </li>
                <li class="FightingMenu">
                    <a href="#" id="FightingMenu" class="mainTooltip" onmouseover="tooltip(this,'<b>Поединки</b>');"
                       onmouseout="hide_info(this);"></a>
                </li>
                <li class="ClanMenu">
                    <a <? if ($player['clan_id'] != 'none') { ?> href="core2.php?useaction=clan-action" <? } ?>
                            id="ClanMenu" class="mainTooltip" onmouseover="tooltip(this,'<b>Клан</b>');"
                            onmouseout="hide_info(this);"></a>
                </li>
                <li class="InfoMenu">
                    <a href="javascript:QActive('<?= scode() ?>');" id="InfoMenu" class="mainTooltip"
                       onmouseover="tooltip(this,'<b>Квесты</b>');" onmouseout="hide_info(this);"></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<br>
<?= save_hp() ?>
<div id="back" style="position: absolute; display: none; left: 0; top: 0; width: 100%; z-index: 0;"></div>
<div style="display:none; position:absolute; z-index:50;" id="popup"></div>
<div style="padding-left:0px; text-align:left; padding-top:0px;" id="draw_pers_info"></div>
<div style="height:50px;width:100%"></div>