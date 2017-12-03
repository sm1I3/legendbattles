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

function getRandomArbitary(min, max)
	{
	  return Math.random() * (max - min) + min;
	}


// скорость прокрутки
var speed = 180
// останавливаем на 1 сек.
var pause = 1000
var timerID = null
var wireRunning = false
var cc = new Array()


cc[0] = "Каждый день с 8 по 17 мая включительно";
cc[1] = "получайте у Мудрого Гаррона по 1 жетону Жетон «Яркое резное пламя»";
cc[2] = "По окончании события вы сможете обменять эти жетоны на ценные призы.";
cc[3] = "Чем больше жетонов вы соберете,";
cc[4] = "тем на большее количество призов сможете расчитывать!";
//cc[5] = "тем на большее количество призов сможете расчитывать!";
//cc[6] = "Желаю мира и добра с любовью Админстрация";

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

           if (currentMessage == 0 && offset == 0){
               // останавливаем функцию =)
                stopWire();
               // закрываем окно.
                close_window();
               // открываем окно
               message_window('success', '', '<a href=?starik=senk>Спасибо</a>', 'cancel', '');

        wireRunning = true
        }
        }
}



</SCRIPT>

<TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr valign=top><td>


<table width=100% cellspacing=0 border=0 cellpadding=0>
<td valign=top>
<div class="block info">
	<div class="header">
	</div>
<img  src='http://w1.dwar.ru/images/data/npcs/wild_crow_npc.jpg' width='190' height='171'>

<?

if ($player["level"]<50)
    echo "Корвус звучно щелкнул клювом.* Никаких распоряжений от Повелительницы драконов еще не поступало. Терпение, воин, терпение! Всему свое время. Ждите";
else if($player["time_prz"]<time())
    echo "Мудрая птица, которую сама Шеара наделила даром красноречия, чтобы старый корвус передавал воителям Легенды ее волю и распоряжения. <a href=?starik=1> Послушать </a>";
else {
    echo "*Корвус звучно щелкнул клювом.* Никаких распоряжений от Повелительницы драконов еще не поступало. Терпение, воин, терпение! Всему свое время. Ждите. приходите через <b>" . tp($player["time_prz"] - time()) . "</b>";
}
/*
if ($player["time_prz"]<time()){
echo "Ќикак путник - посетил менЯ, ну что ж, садись коль пришел. <a href=?starik=1> ‘есть </a>";
}else{
echo "‘тарик устал от вашего вниманиЯ, приходите через <b>".tp($player["time_prz"] - time())."</b>";
}
*/

## …сли персонаж согласилсЯ присесть к старику =)
if ($_GET["starik"] == 1 and $pers["time_prz"]<time() and $player["level"]>=5){
    $secrets = 'Жетоны «Яркое резное пламя»  <br><FORM NAME="wireForm"><input type="text" style="height:45px;" class="but_view" name="wireField" value=" Выслушать" size=100 onFocus="if (!wireRunning) { startWire() }"></FORM>';
}


## Џолучение подарка.
if ($_GET["starik"] == 'senk' and $player["time_prz"]<time() and $player["level"]>=5){
$prz_time = (time()+86400);
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price` ,`curslot` ,`clan` ,`gift` ,`gift_from`) VALUES ('3544',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0',  '0',  '0',  '1',  '".$gfrom."');");
    $res = "Вы обнаружили в подарке <b>Жетон «Яркое резное пламя»</b> !";
    chmsg("top.frames['chmain'].add_msg('<font class=massm>&nbsp;&nbsp;<b>Корвус</b>&nbsp;&nbsp;</font>   <font color=000000><b><font color=#cc0000>Внимание! </font></b>" . $res . ".<BR>'+'');", $player['login']);
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `time_prz`='".$prz_time."' WHERE `id`='".$player["id"]."' LIMIT 1");
echo "<script>location='main.php';</script>";
}

?>





<td width=0 valign=top style="width: 100%;">
<table width=80% cellspacing=0 cellpadding=0  border=0 style="width: 100;">
<tr><td align=center>





</div>
</table></td></table></tr></td></table>
</td></tr></table></TD></TR></TABLE>

<script type="text/javascript">
<? if (isset($secrets) && !empty($secrets)){?>
message_window ('success','','<?=$secrets?>','cancel','')
<? } ?>
</script>