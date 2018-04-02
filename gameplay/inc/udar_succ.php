<?
$psil = $pl_st[30];
$plovk = $pl_st[31];
$puda = $pl_st[32];
if ($psil > $plovk and $psil > $puda) {
    $bonus = 1;
} else if ($plovk > $psil and $plovk > $puda) {
    $bonus = 2;
} else if ($puda > $psil and $puda > $plovk) {
    $bonus = 3;
} else {
    $bonus = 0;
}
$ksil = 1;
switch ($bonus) {
    case 0:
        break;
    case 1:
        $ksil = 2;
        break;
    case 2:
        $pl_st[10] += $pl_st[31] / 3;
        break;
    case 3:
        break;
}
$pl_damag = explode("-", $pl_st[1]);
$pl_damag[0] = ($pl_st[73] / 100 + 1) * ($pl_damag[0] + $pl_st[73] * 2) * $ksil;
$pl_damag[1] = ($pl_st[73] / 100 + 1) * ($pl_damag[1] + $pl_st[73] * 3) * $ksil;
$pl_damag = rand($pl_damag[0], $pl_damag[1]);
$mage = 0;
switch ($ud[1]) {
    case 0:
        $damage = 1 + $pl_damag * $s;
        break; //простой
    case 1:
        $damage = 1 + $pl_damag * 1.3 * $s;
        break; //усиленный
    case 2:
        $damage = ($ud[2] * ($pl_st[34] / 250 + 1)) * ($pl_st[73] / 100 + 1) * $s * 0.7 + $pl_damag / 4;
        $ms[0] = " «Spirit Arrow»";
        $ms[1] = " магическим";
        $mage = 1;
        break;//спирит
    case 3:
        $damage = ($ud[2] * ($pl_st[34] / 250 + 1)) * ($pl_st[73] / 100 + 1) * $s + $pl_damag / 4;
        $ms[0] = " «Mind Blast»";
        $ms[1] = " магическим";
        $mage = 1;
        break;//минд бласт
}

$sokr = 3 + ($pl_st[32] * 4 + $pl_st[7]) * ($pl_st[73] / 100 + 1) - ($tg_st[33] * 9 + $tg_st[8] + $tg_st[32]) * ($tg_st[73] / 100 + 1);
//echo "$pl_st[34]<br>";
if ($sokr > 94) {
    $sokr = 94;
} else if ($sokr < 6) {
    $sokr = 6;
}
if (random($sokr) == 1) {
    $ms[5] = "критическим $ms[1] ударом\",[6,$ud[0]],\"$ms[0] поразил$psex[1]\"";
    $damage = $damage + $pl_st[32];
    if ($bonus == 3) {
        $damage = $damage * rand(22, 28) / 10;
    } else {
        $damage = $damage * rand(15, 18) / 10;
    }
    $color = "CC0000";
    $ms[6] = " критическим";
} else {
    $ms[5] = "поразил$psex[1]$ms[1] ударом\",[6,$ud[0]],\"$ms[0] \"";
    $color = "000000";
}
$damage = $damage / ($tg_st[99] / 250 + $tg_st[73] / 200 + 1);
if ($pl_st[10] == 0) {
    $pl_st[10] = 1;
}
$tg_st[9] = $tg_st[9] + $tg_st[31] * 1.5;
$pl_st[10] = $pl_st[10] + $pl_st[31] * 0.3;
if ($mage == 0) {
    if ($tg_st[9] > $pl_st[10]) {
        $damage = $damage / ($tg_st[9] / $pl_st[10]);
    }
}
$damage = round($damage);
if ($damage < 1) {
    $damage = 1;
}

if ($tg['hp'] == 0) {
    $log .= ",$logpl,\" нанес$psex[1] контрольный$ms[1] удар\",[6,$ud[0]],\"$ms[0] по трупу\",$logtg,\".\"";
} else {
    $immunes = explode("|", $tg['immunes']);
    $immunes_arr = array(
        0 => '<b><font color=#993399>Иммунитет к огню.</b></font>',
        1 => '<b><font color=#993399>Иммунитет к льду.</b></font>',
        2 => '<b><font color=#993399>Иммунитет к вампиризму.</b></font>',
        3 => '<b><font color=#993399>Иммунитет к яду.</b></font>',
        4 => '<b><font color=#993399>Иммунитет к физическому урону.</b></font>'
    );
    if ($immunes[4] == 1) {
        if ($tg['invisible'] < time()) {
            $log .= ",$logtg,\" не получил$tsex[1] урон от удара, потому что имеет $immunes_arr[4][$tg[hp]/$tg[hp_all]].\"";
        } else {
            $log .= ",$logtg,\" не получил$tsex[1] урон от удара, потому что имеет $immunes_arr[4][???/???].\"";
        }
    } else {
        if ($tg['hp'] <= $damage) {
            $exp[1] += $tg['hp'];
            $tg['hp'] = 0;
            $exp[6] += 1;
        } else {
            $tg['hp'] -= $damage;
            $exp[1] += $damage;
        }
        $exp[0] += $damage;
        if ($s == 1) {
            if ($tg['invisible'] < time()) {
                $log .= ",$logpl,\" $ms[5] ,$logtg,\" на <B><font color=#$color>-$damage</font></B> [$tg[hp]/$tg[hp_all]].\"";
            } else {
                $log .= ",$logpl,\" $ms[5] ,$logtg,\" на <B><font color=#$color>-$damage</font></B> [???/???].\"";
            }
        } else {
            if ($tg['invisible'] < time()) {
                $log .= ",$logpl,\" пробил$psex[1] $ms[3]$ms[1]$ms[6] ударом\",[6,$ud[0]],\"$ms[0] и поразил$psex[1]\",$logtg,\" на <B><font color=#$color>-$damage</font></B> [$tg[hp]/$tg[hp_all]].\"";
            } else {
                $log .= ",$logpl,\" пробил$psex[1] $ms[3]$ms[1]$ms[6] ударом\",[6,$ud[0]],\"$ms[0] и поразил$psex[1]\",$logtg,\" на <B><font color=#$color>-$damage</font></B> [???/???].\"";
            }

        }
    }
    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/dmod_succ.php");
}
unset($cblock);

