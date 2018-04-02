<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>
<div id="back" style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;"></div>
<div style="padding-left:39px; text-align:left; padding-top:0px;" id="draw_pers_info"></div>
<div style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;" id="popup"></div>
<html>
<META content="text/html; charset=utf-8" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
    <script type="text/javascript" src="js/interface/get_windows2.js?"></script>
    <LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
</HEAD>
<body>
<script LANGUAGE="JavaScript">

    function getRandomArbitary(min, max) {
        return Math.random() * (max - min) + min;
    }


    // скорость прокрутки
    var speed = 70
    // останавливаем на 1 сек.
    var pause = 1100
    var timerID = null
    var wireRunning = false
    var cc = new Array()


    cc[0] = "Дорогие друзья";
    cc[1] = "Хочу поздравить вас.";
    cc[2] = "С наступающим годом обезьяны,";
    cc[3] = "сердечно хочу пожелать всего самого лучшего";
    cc[4] = "Пусть этот год исполнит все ваши  мечты";

    var currentMessage = 0
    var offset = 0

    // останавливаем вывод сообщений
    function stopWire() {
        if (wireRunning)
            clearTimeout(timerID)
        wireRunning = false

    }

    // стартуем
    function startWire() {
        stopWire()
        showWire()
    }

    function showWire() {
        var text = cc[currentMessage]
        if (offset < text.length) {
            if (text.charAt(offset) == " ")
                offset++
            var partialMessage = text.substring(0, offset + 1)
            document.wireForm.wireField.value = partialMessage
            offset++
            timerID = setTimeout("showWire()", speed)
            wireRunning = true
            ///alert(1);
        } else {
            offset = 0
            currentMessage++
            if (currentMessage == cc.length)
                currentMessage = 0
            timerID = setTimeout("showWire()", pause)

            if (currentMessage == 0 && offset == 0) {
                // останавливаем функцию =)
                stopWire();
                // закрываем окно.
                close_window();
                // открываем окно
                message_window('success', '', 'Теперь можешь взять свой подарок - и ступай, мне отдыхать пора. <a href=?starik=senk><img src="http://smayly.ru/gallery/anime/FeiXin/41.gif"></a>', 'cancel', '');

                wireRunning = true
            }
        }
    }


</SCRIPT>

<TABLE cellpadding=0 cellspacing=0 width=100%>
    <TR>
        <TD>
            <table cellpadding=0 cellspacing=0 border=0 align=center width=760>
                <tr valign=top>
                    <td>


                        <table width=100% cellspacing=0 border=0 cellpadding=0>
                            <td valign=top>
                                <tr>
                                    <td>
                                        <div class="block info">
                                            <div class="header">
                                                <span>Лесной эльдрик</span>
                                            </div>
                                            <img src='https://w1.dwar.ru/info/pictures/image/eldrik.jpg' width='190'
                                                 height='171'>
                                            <? if ($player["level"] < 5)
                                            echo "Лесной эльдрик - приходи как подрастешь (Необходимо быть 5-м уровнем и выше) ";
                                            else if ($player["time_prz"] < time())
                                            echo "Согласно поверьям, у каждого лесного дерева есть крошечный воздушный хранитель - эльдрик, который пр¤четс¤ от любопытных глаз простых смертных в дупле или среди ветвистых корней.  рылатый малютка не покидает уютное жилище, забот¤сь и оберегая дерево до тех пор, покуда оно не засохнет.. <a href=?starik=1> Послушать </a>";
                                            else {
                                            echo "Лесной эльдрик я устала от вашего внимания, приходите через <b>" . tp($player["time_prz"] - time()) . "</b>"; ?>
                                        </div>
                                </tr>
                        </table>
                        </font></td>
                </tr>
            </table>
            <?
            }
            /*
            if ($player["time_prz"]<time()){
            echo "Никак путник - посетил меня, ну что ж, садись коль пришел. <a href=?starik=1> Сесть </a>";
            }else{
            echo "Старик устал от вашего внимания, приходите через <b>".tp($player["time_prz"] - time())."</b>";
            }
            */

            ## Если персонаж согласился присесть к старику =)
            if ($_GET["starik"] == 1 and $pers["time_prz"] < time() and $player["level"] >= 5) {
                $secrets = 'Поздравлением с 2016 года<br><FORM NAME="wireForm"><input type="text" style="height:45px;" class="but_view" name="wireField" value=" Выслушать Поздравление " size=100 onFocus="if (!wireRunning) { startWire() }"></FORM>';
            }


            ## Получение подарка.
            if ($_GET["starik"] == 'senk' and $player["time_prz"] < time() and $player["level"] >= 5) {
                $prz_time = (time() + 8640000000);
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2570',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '" . $player['id'] . "',  '0',  '0',  '1',  '1',  '0');");
                $res = "Вы обнаружили в подарке <b>Волшебная снежинка(50 шт) Бутылка Шампанского</b> !";
                chmsg("top.frames['chmain'].add_msg('<font class=massm>&nbsp;&nbsp;<b>Ћесной эльдрик</b>&nbsp;&nbsp;</font>   <font color=000000><b><font color=#cc0000>¬нимание! </font></b>" . $res . ".<BR>'+'');", $player['login']);
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `time_prz`='" . $prz_time . "' WHERE `id`='" . $player["id"] . "' LIMIT 1");
                echo "<script>location='main.php';</script>";
            }

            ?>


        <td width=0 valign=top style="width: 100%;">
            <table width=80% cellspacing=0 cellpadding=0 border=0 style="width: 100;">
                <tr>
                    <td align=center>


                    </td>
            </table>
        </td>
</table>
</body>
</html></table>
</td></tr></table></TD></TR></TABLE>

<script type="text/javascript">
    <? if (isset($secrets) && !empty($secrets)){?>
    message_window('success', '', '<?=$secrets?>', 'cancel', '')
    <? } ?>
</script>