<SCRIPT SRC="./js/hospi.js"></SCRIPT>
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
            <div class="block info">
                <div class="header">
                    <span>Госпиталь</span>
                </div>
                <img src=/img/image/gameplay/hospital/hospital_city1_0.jpg width=760 height=255 border=0>
                <table cellpadding=2 cellspacing=1 border=0 align=center width=100%>
                    <tr>
                        <td width=16% bgcolor=#f5f5f5>
                            <div align=center><a href=main.php?hospi_sel=1><font class=zaya><b>Еда</b></font></a></div>
                        </td>
                        <td width=16% bgcolor=#f5f5f5>
                            <div align=center><a href=main.php?hospi_sel=3><font class=zaya><b>Алхимия</b></font></a>
                            </div>
                        </td>
                        <td width=16% bgcolor=#f5f5f5>
                            <div align=center><a href=main.php?hospi_sel=6><font class=zaya><b>Колдун</b></font></a>
                            </div>
                        </td>
                        <td width=16% bgcolor=#f5f5f5>
                            <div align=center><a href=main.php?hospi_sel=4><font class=zaya><b>Другие рецепты</b></font></a>
                            </div>
                    </tr>
                </table>
        </td>
    </tr>
</table>
</td></tr>
</table>

<?
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
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
    <tr>
        <td>
            <table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
                <tr>
                    <td>
                        <? if ($hospi_sel == 2){
                        $player = player();
                        $plstt = allparam($player);
                        if ($player['nv'] > 0){
                        ?>
                        <br>
                    <td width=50% bgcolor=#f5f5f5>
                        <div align=center><a href=main.php?get_id=98&type=1&vcode=<?= scod() ?>><font class=zaya><b>Восстановить
                                        100HP за 1LR</b></font></a></div>
                        <br>
                    <td width=50% bgcolor=#f5f5f5>
                        <div align=center><a href=main.php?get_id=98&type=2&vcode=<?= scod() ?>><font class=zaya><b>Восстановить
                                        100MP за 1LR</b></font></a></div>
                        <br>
                        <?
                        }
                        else
                        {
                        ?>
                    <td width=50%>
                        <div align=center><a <font color=#cc0000 class=zaya><b>Не хватает средств!</b></font></a></div>
                        <?
                        }
                        } ?>

                        <? if ($_GET['hospi_sel'] == 1) {
                            $ITEMS = mysqli_query($GLOBALS['db_link'], "SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE kol>0 AND market=$player[loc] AND type='w0';");
                            $num = 0;//(mysqli_num_rows($ITEMS));
                            if ($num > 0) {
                                echo '</table></td></tr></table>';
                                echo show_shop(0, $ITEMS, $mass);
                            } else {
                                ?>
                                <table cellpadding=5 cellspacing=1 border=0 width=100%>
                                <tr>
                                    <td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной
                                                категории.</b></font></td>
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
                        <?
                        //Алхимия

                        if ($_GET['hospi_sel'] == 3) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_main" . ".php");
                        }
                        if ($_GET['hospi_sel'] == 4) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_rec" . ".php");
                        }
                        if ($_GET['hospi_sel'] == 5) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/ident_resource" . ".php");
                        }

                        //Колдун

                        if ($_GET['hospi_sel'] == 6) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/koldyn/koldyn_main" . ".php");
                        }
                        if ($_GET['hospi_sel'] == 7) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_rec2" . ".php");
                        }
                        if ($_GET['hospi_sel'] == 8) {
                            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/ident_resource2" . ".php");
                        }

                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<SCRIPT language='JavaScript'>
    NewLinksView();
</SCRIPT>