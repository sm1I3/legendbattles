<?php
$buffs = explode("|", $player['buffs']);
$buffcount = '';
$b = 0;

foreach ($buffs as $value) {
    $buff = explode("@", $value);
    if ($buff[2]) {
        $buffcount[$buff[0]] += $buff[1];
        $nt = time();
        $ch[$buff[0]] = floor(($buff[2] - $nt) / 3600);
        $min[$buff[0]] = floor((($buff[2] - $nt) - ($ch[$buff[0]] * 3600)) / 60);
        $times[$buff[0]] = $ch[$buff[0]] . "ч. " . $min[$buff[0]] . "м.";
        $names = array('', 'Сила', 'Ловкость', 'Везение', 'Живучесть', 'Разум', 'Защита', 'Удар', 'КБ', 'Пробой брони', 'Уловка', 'Точность', 'Сокрушение', 'Стойкость', 'Ангел', 'Наблюдательность', 'Странник');
        $imgs = array('', '101', '102', '103', '104', '105', '999', '111', '110', '112', '106', '107', '108', '109', '100', '113', '10');
        $buffname[$buff[0]] = '<img src="/img/image/pinfo/eff_' . $imgs[$buff[0]] . '.gif" width="29" height="29" onmouseover="tooltip(this,\'<table cellpadding=0 cellspacing=0 border=0  align=center class=nickname><tr><td align=center><b>' . $names[$buff[0]] . ':&nbsp;+' . $buffcount[$buff[0]] . '</b></td></tr><tr><td align=center>еще ' . $times[$buff[0]] . '</td></tr></table>\')" onmouseout="hide_info(this)">';
        $b++;
    }
}
?>
<div class="module buffs">
    <div class="header">
        Эффекты и Зелья
        <a href="javascript:parent.helpwin(\'legendbattles.ru/help.php?buffs=1\')" target="_blank">
            <img src=/img/image/info.gif width=6 height=12 border=0 title="Помощь" valign=top>
        </a>
    </div>
    <div class="content">
        Зелий выпито <font color=green><?= $b ?></font>/<font color=#cc0000>5</font>
        <div>
            <?
            for ($i = 1; $i <= 16; $i++) {
                if ($buffname[$i])
                    echo $buffname[$i];
            }
            ?><?
            echo '<table cellpadding=0 cellspacing=0 border=0 align=center>
	<center id="TravmPl"></center><script language="JavaScript">
var cureff = [';
            if (affect($player['affect'], 4) != '') {
                $s = affect($player['affect'], 4);
                echo substr($s, 0, strlen($s) - 1);
            }
            echo '];
effects_view("TravmPl");
</script>
</table>
		</div>
		<div>';
            ?><?
            if (affect($player['affect'], 0) != '') {
                $traw = affect($player['affect'], 1);
                $traw = substr($traw, 0, strlen($traw) - 1);
                $trw = explode("|", $traw);
                $i = 0;
                foreach ($trw as $val) {
                    $par = explode("@", $val);
                    $i++;
                    echo $i == 1 ? '&nbsp;' : '';
                    echo '<img src="/img/image/pinfo/eff_' . $par[0] . '.gif" width="29" height="29" onmouseover="tooltip(this,\'<table cellpadding=0 cellspacing=0 border=0  align=center class=nickname><tr><td align=center><b>' . $par[1] . '</b></td></tr><tr><td align=center>еще ' . $par[2] . '</td></tr></table>\')" onmouseout="hide_info(this)">&nbsp;';
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("img.slot").parent().append("<img src='/img/image/ld3.gif' id='buffs'>");

        $("#buffs").live('click', function () {
            $(".module.buffs").toggle();
        });
    });
</script>