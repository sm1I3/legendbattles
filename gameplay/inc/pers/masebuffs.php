<?php
$plmases = explode("|", $player['masebonus']);
foreach ($plmases as $val) {
    $mase = explode("@", $val);
    if ($mase[1] >= time() and $mase[0]) {
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
$tmparams = itemparams(0, $ITEM);
$params = $tmparams[0];
?>
<div class="module mase">
    <div class="header">
        Мази и прочее
        <a href="javascript:parent.helpwin(\'legendbattles.ru/help.php?mases=1\')" target="_blank">
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