<?
$ogon = ($pl_st[45] / 50);
$led = ($pl_st[46] / 50);
$ogont = ($tg_st[54] / 50);
$ledt = ($tg_st[55] / 50);
if ($pl_st[101] != 0 and $tg['hp'] > 0 and $immunes[0] == 1) {
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" не получил$tsex[1] урон от огня, потому что имеет " . $immunes_arr[0] . " [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" не получил$tsex[1] урон от огня, потому что имеет " . $immunes_arr[0] . " [???/???].\"";
    }
} elseif ($pl_st[101] != 0 and $tg['hp'] > 0) {
    $moddps = explode("-", $pl_st[101]);
    $dps = round((rand($moddps[0], $moddps[1]) * ($pl_st[73] / 100 + 1 + $ogon)) / ($tg_st[99] / 250 + $tg_st[73] / 200 + 1 + $ogont));
    $clr = "B00000";
    if ($tg['hp'] <= $dps) {
        $exp[1] += $tg['hp'];
        $tg['hp'] = 0;
        $exp[6] += 1;
    } else {
        $tg['hp'] -= $dps;
        $exp[1] += $dps;
    }
    $exp[0] += $dps;
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" получил$tsex[1] урон от огня на <B><font color=#$clr>-$dps</font></B> [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" получил$tsex[1] урон от огня на <B><font color=#$clr>-$dps</font></B> [???/???].\"";
    }
}
if ($immunes[1] == 1 and $pl_st[102] != 0 and $tg['hp'] > 0) {
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" не получил$tsex[1] урон от льда, потому что имеет " . $immunes_arr[1] . " [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" не получил$tsex[1] урон от льда, потому что имеет " . $immunes_arr[1] . " [???/???].\"";
    }
} elseif ($pl_st[102] != 0 and $tg['hp'] > 0) {
    $moddps = explode("-", $pl_st[102]);
    $dps = round((rand($moddps[0], $moddps[1]) * ($pl_st[73] / 100 + 1 + $led)) / ($tg_st[99] / 250 + $tg_st[73] / 200 + 1 + $ledt));
    $clr = "000099";
    if ($tg['hp'] <= $dps) {
        $exp[1] += $tg['hp'];
        $tg['hp'] = 0;
        $exp[6] += 1;
    } else {
        $tg['hp'] -= $dps;
        $exp[1] += $dps;
    }
    $exp[0] += $dps;
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" получил$tsex[1] урон от льда на <B><font color=#$clr>-$dps</font></B> [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" получил$tsex[1] урон от льда на <B><font color=#$clr>-$dps</font></B> [???/???].\"";
    }
}
if ($immunes[2] == 1 and $pl_st[103] != 0 and $tg['hp'] > 0) {
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" не получил$tsex[1] урон от вампиризма, потому что имеет " . $immunes_arr[2] . " [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" не получил$tsex[1] урон от вампиризма, потому что имеет " . $immunes_arr[2] . " [???/???].\"";
    }
} elseif ($pl_st[103] != 0 and $tg['hp'] > 0) {
    $moddps = explode("-", $pl_st[103]);
    $dps = round(rand($moddps[0], $moddps[1]) * ($pl_st[73] / 100 + 1 + $kl));
    $clr = "6633CC";
    if ($tg['hp'] <= $dps) {
        $exp[1] += $tg['hp'];
        $tg['hp'] = 0;
        $exp[6] += 1;
    } else {
        $tg['hp'] -= $dps;
        $exp[1] += $dps;
    }
    $exp[0] += $dps;
    if ($tg['invisible'] < time()) {
        $log .= ",$logtg,\" получил$tsex[1] урон от вампиризма на <B><font color=#$clr>-$dps</font></B> [$tg[hp]/$tg[hp_all]].\"";
    } else {
        $log .= ",$logtg,\" получил$tsex[1] урон от вампиризма на <B><font color=#$clr>-$dps</font></B> [???/???].\"";
    }
    if ($dps) {
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET heal=heal+'" . $dps . "' WHERE id='" . $player['id'] . "' LIMIT 1;");
    }
}
if ($pl_st[104] != 0) {
    $moddps = explode("-", $pl_st[104]);
    $dps = round(rand($moddps[0], $moddps[1]));
    if ($dps) {
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET heal=heal+'" . $dps . "' WHERE id='" . $player['id'] . "' LIMIT 1;");
    }
}

