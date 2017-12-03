<?php
$res = mysqli_query($GLOBALS['db_link'], "SELECT * FROM module_slot_free WHERE user_id = " . $player['id'] . " AND day = '" . date("Y-m-d") . "'");
$roulette = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `module_slot_status` WHERE `roulette_id` = '1'"));
$is_free = $rEnables = true;
if (mysqli_num_rows($res) > 0) {
    $is_free = false;
}
if ($player['baks'] < 0.2) {
    $rEnables = false;
}
?>
<tr>
    <td width=100%>
        <div class="block info">
            <div class="header">
                <span>Слот-машина</span>
            </div>
<tr>
    <td align="center">
        <SCRIPT src="/js/ajax.js"></SCRIPT>
        <SCRIPT src="/js/roulette.js"></SCRIPT>
        <script>
            var actions = ["<?php echo scode(); ?>", "<?php echo scode(); ?>"];
        </script>
        <table class="tbl1" width="100%" border="0">
            <tr>
                <td>
                    <center>Последний выигрыш Джекпота в размере <b><?php echo $roulette['last_winner_amount']; ?>
                            Изумруд</b> принадлежит игроку
                        «<b><?php echo $roulette['last_winner_name']; ?></b>» <?php echo $roulette['last_winner_datetime'] ? date("d.m.Y", $roulette['last_winner_datetime']) : ''; ?>
                    </center>
                </td>
            </tr>
        </table>
        <table class="tbl1" width="100%" border="0">
            <tr>
                <td>
                    <center><font color=red>Внимание!</font> Играть бесплатно можно раз в 24 часа, дальше ход стоит 0.2
                        Изумруд
                    </center>
                </td>
            </tr>
        </table>
        <br>
        <center>
            <object
                    classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    codebase="https://fpdownload.adobe.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
                    width="608" height="381">
                <param name="movie"
                       value="/modules/roulette.swf?jackpot=<?php echo $roulette['jackpot_amount']; ?>+$&is_free=<?php echo $is_free ? 1 : 0; ?>"/>
                <param name="wmode" value="opaque"/>
                <param name="allowScriptAccess" value="always"/>
                <param name="jackpot" value="<?php echo $roulette['jackpot_amount']; ?>+Изумруд"/>
                <param name="is_free" value="<?php echo $is_free ? 1 : 0; ?>"/>
                <param name="enabled" value="<?php echo $rEnables ? 1 : 0; ?>"/>
                <param name="paid_text" value="0.2 Изумруд"/>
                <param name="quality" value="high"/>
                <embed src="/modules/roulette.swf?jackpot=<?php echo $roulette['jackpot_amount']; ?>+$&is_free=<?php echo $is_free ? 1 : 0; ?>&paid_text=0.2+DLR&enabled=<?php echo $rEnables ? 1 : 0; ?>"
                       quality="high" bgcolor="#ffffff" width="608" height="381" wmode="opaque"
                       type="application/x-shockwave-flash"
                       pluginspage="https://get.adobe.com/ru/flashplayer">
                </embed>
            </object>
            <br>
            <br>
            <input type="button" name="variants" onclick="jQuery('#roulette_variants').toggle('slow');"
                   value="Показать таблицу комбинаций" class="lbut"/>
            <div id="roulette_variants" style="display: none;">
                <br>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - 50 LR</td>
                        <td width="50">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - Обычный расходник</td>
                    </tr>
                    <tr>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - 500 LR</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - Хороший расходник</td>
                    </tr>
                    <tr>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/money_icon.png"/>&nbsp;
                        </td>
                        <td> - 10000 LR</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/scrollpotion_icon.png"/>&nbsp;
                        </td>
                        <td> - Дорогой расходник</td>
                    </tr>
                    <tr>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/dnv_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/dnv_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - 25 $</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/art.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/art.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/1x1.gif" width="57" height="57"/>&nbsp;
                        </td>
                        <td> - Уникальный раритет (на 10 дней)</td>
                    </tr>
                    <tr>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/dnv_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/dnv_icon.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/dnv_icon.png"/>&nbsp;
                        </td>
                        <td> - 75 $</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img src="//img.legendbattles.ru/image/gameplay/roulette/art.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/art.png"/>&nbsp;<img
                                    src="//img.legendbattles.ru/image/gameplay/roulette/art.png"/>&nbsp;
                        </td>
                        <td> - Уникальный артефакт (на 5 дней)</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="middle" colspan="5" align="center">
                            <table>
                                <tr>
                                    <td>
                                        <img src="//img.legendbattles.ru/image/gameplay/roulette/nl_icon.png"/>&nbsp;<img
                                                src="//img.legendbattles.ru/image/gameplay/roulette/nl_icon.png"/>&nbsp;<img
                                                src="//img.legendbattles.ru/image/gameplay/roulette/nl_icon.png"/>&nbsp;
                                    </td>
                                    <td> - <b>Джек-Пот</b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

        </center>
        </fieldset>
    </td>
</tr>