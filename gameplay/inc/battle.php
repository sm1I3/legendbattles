<HTML>
<HEAD>
    <LINK href="./css/fight.css?<?php echo time(); ?>" rel="STYLESHEET" type="text/css">
    <link href="./css/system.css?1366816309" rel="stylesheet" type="text/css">
    <META Http-Equiv="Content-Type" Content="text/html; charset=utf-8">
    <META Http-Equiv="Cache-Control" Content="No-Cache">
    <META Http-Equiv="Pragma" Content="No-Cache">
    <META Http-Equiv="Expires" Content="0">
    <SCRIPT src="./js/counter.js"></SCRIPT>
    <SCRIPT src="./js/slots.js"></SCRIPT>
    <SCRIPT src="./js/fight.js?<?php echo time(); ?>"></SCRIPT>
    <!--<SCRIPT src="./js/viewFight.js?<?php echo time(); ?>"></SCRIPT>-->
    <SCRIPT src="./js/signs.js"></SCRIPT>
    <SCRIPT src="./js/logs.js?<?php echo time(); ?>"></SCRIPT>
    <SCRIPT src="./js/fkey.js"></SCRIPT>
    <SCRIPT src="./js/stooltip.js?v11"></SCRIPT>
</HEAD>
<BODY bgcolor="#FFFFFF" onload="parent.AutoFight();">
<div id="tooltip"></div>
<SCRIPT language="JavaScript">
    <?php
    $randomize = $randomize ?? varcheck($_POST['randomize']) ?? varcheck($_GET['randomize']) ?? '';
    $AutoBot = explode("|", $player['ABClient']);
    if ($player['side'] == 1) {
        $side = 2;
    } else {
        $side = 1;
    }
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT arena.id_battle, arena.t1, arena.t2, arena.vis, arena.type, arena.timeout, arena.travma, user.side, user.id, user.sklon, user.clan_gif, user.level, user.login, user.hp, user.hp_all, user.dmg, user.type, user.invisible, user.fcolor, user.fcolor_time, user.pos_fight FROM (arena LEFT JOIN user ON arena.id_battle = user.battle) WHERE (((arena.id_battle) = '$player[battle]'))");
    if (mysqli_num_rows($sql) > 0) {
        while ($p = mysqli_fetch_assoc($sql)) {
            if ($p['t2'] < (time() - $p['timeout']) and $p['t1'] = $player['side']) {
                $vc = scode();
            } else {
                $vc = '';
            }
            if ($p['vis'] == 3) {
                $vis = 3;
            }
            if ($p['id'] == $player['id']) {
                $dmg = $p['dmg'];
            }

            if ($p['side'] == 1 and $p['hp'] > 0) {
                if (isset($livg1)) {
                    $z = ",";
                }
                // карта
                list($p['fight_x'], $p['fight_y']) = explode('_', $p['pos_fight']);
                if ($p['invisible'] < time()) {
                    $team1 .= $z . "[$p[type],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\",$p[hp],$p[hp_all],$p[id],$p[fight_x],$p[fight_y],$p[id]]";
                } else {
                    $team1 .= $z . "[4,$p[fight_x],$p[fight_y],$p[level],$p[id]]";
                }
                // бой между
                if ($p['type'] == 1) {
                    if ($p['invisible'] < time()) {
                        $livg1 .= $z . "[$p[type],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\",$p[hp],$p[hp_all],$p[id]]";
                    } else {
                        $livg1 .= $z . "[4]";
                    }
                } else {
                    $livg1 .= $z . "[$p[type],\"$p[login]\",$p[hp],$p[hp_all],$p[id]]";
                }
            } else if ($p['side'] == 2 and $p['hp'] > 0) {
                if (isset($livg2)) {
                    $z2 = ",";
                }
                // карта
                list($p['fight_x'], $p['fight_y']) = explode('_', $p['pos_fight']);
                if ($p['invisible'] < time()) {
                    $team2 .= $z2 . "[$p[type],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\",$p[hp],$p[hp_all],$p[id],$p[fight_x],$p[fight_y],$p[id]]";
                } else {
                    $team2 .= $z2 . "[4,$p[fight_x],$p[fight_y],$p[level],$p[id]]";
                }
                // бой между
                if ($p['type'] == 1) {
                    if ($p['invisible'] < time()) {
                        $livg2 .= $z2 . "[$p[type],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\",$p[hp],$p[hp_all],$p[id]]";
                    } else {
                        $livg2 .= $z2 . "[4]";
                    }
                } else {
                    $livg2 .= $z2 . "[$p[type],\"$p[login]\",$p[hp],$p[hp_all],$p[id]]";
                }
            }
            if (!isset($fight)) {
                $fight = "$p[type],$p[timeout],$p[travma]";
            }
        }
    }

    if ($vis == 3) {
        $bat = 0;
        $ty = 2;
        $l = 1;
    } else {
        if ($player['hp'] > 0) {
            if (mysqli_num_rows($sql) > 0) {
                $bat = 1;
                $ty = 0;
                $en = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT user.* FROM user LEFT JOIN fight ON user.id = fight.eid WHERE user.battle='$player[battle]' AND user.side='$side' AND user.hp>0 AND fight.eid Is Null ORDER BY rand() LIMIT 1;"));
                $tmpeninv = str_replace(" [Ћидер]", "", $en['login']);
                $eninv = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$tmpeninv' AND id<9999 LIMIT 1;"));
                $en_st = explode("|", $en['st']);
                for ($i = 5; $i <= 36; $i++) {
                    if ($en_st[$i] == '') $en_st[$i] = 0;
                }
                if (!isset($en['id'])) {
                    $bat = 0;
                    $ty = 3;
                    $_SESSION['user']['wait'] = 1;
                } else {
                    $_SESSION['user']['wait'] = 0;
                    if ($en['invisible'] > time()) {
                        $p_en = "\"?????\",999999,999999,999999,999999,\"?\",\"0\",\"none\",\"\",\"\",\"2\",\"100\",\"115\",\"\",\"\",0,1";
                    } else {
                        $p_en = "\"$en[login]\",$en[hp],$en[hp_all],$en[mp],$en[mp_all],\"$en[level]\",\"$en[sklon]\",\"$en[clan_gif]\",\"$en[clan]\",\"$en[clan_d]\",\"2\",\"100\",\"115\",\"\",\"\",$en[thotem],1";
                    }
                }
            } else {
                $bat = 0;
                $ty = 5;
                $end = scode();
            }
        } else {
            $bat = 0;
            $ty = 4;
            $end = '';
        }
    }
    $expp = exp_level($player['level']);
    $naemnik = explode("|", $player['naemnik']);
    $naimbut = ($naemnik[1] < time() ? 1 : 0);
    list($player['fight_x'], $player['fight_y']) = explode('_', $player['pos_fight']);
    ?>
    var naemnik = <?=$naimbut?>;
    var fight_ty = [<?=$fight?>,<?=$bat;?>,<?=$ty;?>, "<?=$end?>", "<?=$vc?>", "<?=$expp['ex']?>", "<?=$player['battle'];?>"];
    var param_ow = ["<?=$player['login'];?>", "<?=$player['hp'];?>", "<?=$player['hp_all'];?>", "<?=$player['mp'];?>", "<?=$player['mp_all'];?>", "<?=$player['level'];?>", "<?=$player['sklon'];?>", "<?=$player['clan_gif'];?>", "<?=$player['clan'];?>", "<?=$player['clan_d'];?>", "1", "100", "115", "", "",<?=$player['thotem'];?>, [<?php echo $AutoBot[0]; ?>,<?php echo $AutoBot[1]; ?>], [<?php echo $player['fight_x']; ?>,<?php echo $player['fight_y']; ?>]];
    var slots_ow = ["<?=$player['obraz']?>", "<? $magic = slotwiev($player['id'], 0);?>"];
    var lives_g1 = [<?=$livg1?>];
    var lives_g2 = [<?=$livg2?>];
    var map = ["map1", [<?php echo $team1; ?>], [<?php echo $team2; ?>], "<?php echo scode(); ?>"]
    var fight_pm = [<?=$expp['ma']?>,<?=$plstt[28]?>,<?=$player['od']?>,<?=$player['bl']?>, "<?=scode()?>",<?=$en['type'];?>,<?=$player['side']?>, 3, 0, "",<?=$en['id'];?>];
    <?php
    if($bat != 0){
    $magic = explode("|", $magic);
    if ($player['znan'] > 2 and $player['mp'] > 0) {
        $magic_in .= "320,";
        $alchemy .= "0,";
    }
    foreach ($magic as $val) {
        $st = explode("@", $val);
        $magic_in .= "$st[1],";
        $alchemy .= "$st[0],";
    }
    ?>
    var alchemy = [<?=substr_replace($alchemy, '', -1);?>];
    var magic_in = [<?=substr_replace($magic_in, '', -1);?>];
    var stand_in = [2, 3, 29, 30, 31];
    var param_en = [<?=$p_en;?>];
    <?php
    if($en['invisible'] > time()){
    ?>
    var slots_en = ["male_0.gif", "<?php echo slotwiev(0, 0);?>"];
    var addpa_en = ["1,0,1,0,1,0,1,0,1,1,1,1,1,1,1,1"];
    <?php
    }else{
    ?>
    var slots_en = ["<?=$en['obraz'];?>", "<? if ($en['type'] == 1) {
        slotwiev($en['id'], 0);
    } else {
        if ($en['addon'] == 99) {
            echo '1';
            slotwiev($player['id'], 0);
        } else {
            botslot($eninv['id'], 0);
        }
    }?>"];
    var addpa_en = [<?="$en[sila],$en_st[30],$en[lovk],$en_st[31],$en[uda4a],$en_st[32],$en[mudr],$en_st[35],$en[znan],$en_st[34],$en_st[5],$en_st[6],$en_st[7],$en_st[8],$en_st[9],$en_st[10]"?>];
    <?php
    }
    }
    if($l == 1) {
    echo "var list = [";
    echo Show_Stat($player['battle']);
    echo "];\n";
    ?>
    var fexp = ["<?=$player['dmg']?>", "15", "<?=$player['id']?>", "<?=scode()?>", "<?=$randomize?>", "",<? if ($player['wait'] > time()) {
        print $player['wait'] - time();
    } else {
        print 0;
    }?>, 0]; <?
    }else{
    ?>
    var stats = [<?=$player['dmg']?>];<? }

    echo 'var logs = [';
    echo Show_Log($player['battle'], 10);
    echo '];';
    ?>
    magic_slots();
</SCRIPT>
</BODY>
</HTML>