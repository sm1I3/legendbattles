<script type="text/javascript" src="js/infos.js?"></script>
<script>
    function give_birja(id, kolvo, price) {
        inner = '<form action=main.php method=get id=give_birja><input type=hidden name=mselect value=rialto><input type=hidden name=kolvo value=' + kolvo + '><input type=hidden name=give_birja value=' + id + '><table width=100% cellpadding=7><tr><td width=10>&nbsp;</td><td valign=top>Цена: <b>' + price + ' Бронзы</b><br>Кол-во: <b>' + kolvo + ' Изумруда</b></td></tr></table></FORM>';
        message_window('confirm', 'Покупка <b>&laquo;DLR&raquo;</b>', inner, 'accept|cancel', 'click|d.getElementById(\'give_birja\').submit();')
}
</script>
<form name="addbirja" action="main.php?mselect=rialto" method="POST">
<tr><td>
<font class=proce>
<FIELDSET>
    <LEGEND align=center><B><font color=gray>&nbsp;ЕЩЁ не работает &nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=75% align=center>
    <tr align=center>
        <td align=center>ЕЩЁ не работает:
    </tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=75% class=freemain align=center>
    <tr>
        <td class="tbl l b">Покупка Изумруд за LR с 14-го уровня
        <td>Выводится 20 самых выгодных предложений</td>
    </tr>
    <tr>
        <td class="tbl l b">Минимальная сумма для продажи: 3 Изумруд</td>
        <td> Максимальная сумма для продажи: 100 Изумруд</td>
    </tr>
    <tr>
        <td class="tbl l b">Минимальный курс: 2000 LR</td>
        <td> Максимальный курс: 5000 LR</td>
    </tr>
    <tr>
        <td class="tbl l b">Налог с продажи: 3%
        <td>Количество ставок: 1</td>
    </tr>
    <tr>
        <td class="tbl l b">&nbsp;Продать: Изумруд&nbsp;&nbsp;<input type=text class=guest name="gold_birja"
                                                                     title="Введите нужную сумму (ровное число) продаваемых DLR">
        </td>
    </tr>
    <tr>
        <td class="tbl l b">&nbsp;Курс: LR&nbsp;&nbsp;<input type=text class=guest name="silver_birja"
                                                             title="Введите курс LR за 1 DLR"></td>
    </tr>
<input type=hidden name="mselect" value="rialto">
    <tr>
        <td class="tbl l b"><input type=submit class=lbut value="Выставить на продажу" name="addbirja"></td>
    </tr>
</td>
</tr>
</table>
</form>




<?
################### Made by LastDays #########################

//echo "<b>ID:".$player["id"].", LOGIN:".$player["login"]." </b>";
## Продажа DLR, на биржу. ( от 3 до 30) DLR.
if (!empty($_POST['addbirja'])){
$bcount = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `dlr_birja` WHERE `uid`='".$player["id"]."';"));
$gold_sale = ereg_replace("[^0-9]", "", $_POST['gold_birja']);
$silver_sale = ereg_replace("[^0-9]", "", $_POST['silver_birja']);
## Проверяем кол-во ставок продавца.
if ($bcount>=1)
    $err_bg = '<strong>Выставлять на продажу больше 1-й ставки нельзя.</strong>';
## Проверяем формат
elseif (!preg_match("/^[0-9\-_ ]*$/",$gold_sale))
    $err_bg = '<strong>Неверный формат кол-ва введённого Вами DLR на продажу</strong>';
## Проверяем формат
elseif (!preg_match("/^[0-9\-_ ]*$/",$silver_sale))
    $err_bg = '<strong>Неверный формат кол-ва введённого Вами курса за 1 DLR</strong>';
## Хватает ли LR?
elseif ($player["baks"]<($gold_sale))
    $err_bg = '<strong>Не хватает DLR.</strong>';
## Подходящие ли уровень?.
elseif ($player["level"]<4)
    $err_bg = '<b><font color=#99000>Вы малы уровнем</font></b> ';
## Не меньше ли 3 продаваемых DLR?
elseif ($gold_sale<3)
    $err_bg = '<strong>Минимальная сумма для продажи 3 DLR.</strong>';
## Не больше ли 30 продаваемых DLR?
elseif ($gold_sale>100)
    $err_bg = '<strong>Максимальная сумма для продажи 100 DLR.</strong>';
## Не меньше ли 2000т курс DLR?
elseif ($silver_sale<2000)
    $err_bg = '<strong>Минимальный курс 2000 LR.</strong>';
## Не больше ли 5000 курс DLR?
elseif ($silver_sale>5000)
    $err_bg = '<strong>Максимальный курс 5000 LR.</strong>';
    else { ## Если всё хорошо, то хорошо что хорошо :))
        echo '<strong>Вы сдали на биржу <b>' . $gold_sale . ' DLR</b> по курсу <b>' . $silver_sale . 'LR</b></strong>';
## Апдейтим юзера
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-".$gold_sale." WHERE `id`='".$player["id"]."' LIMIT 1;");
## Апдейтим биржу
mysqli_query($GLOBALS['db_link'],"INSERT INTO `dlr_birja`(`id`,`uid`,`lr`,`dlr`,`user`) VALUES (NULL, '".$player["id"]."', '".$silver_sale."', '".$gold_sale."','".$player["login"]."');");
echo "<script>location='main.php?mselect=9';</script>";
}
}

## Покупка DLR, на бирже. ( от 3 до 100) DLR.
if (!empty($_GET['give_birja']) and !empty($_GET["kolvo"]) and $_GET["kolvo"] >= 3 and $_GET["kolvo"] <= 100) {## Проверяем, что покупаем.
$val_give_birja=varcheck($_GET['give_birja']);$bgive = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `id`='".$val_give_birja."' ;"));
## Проверяем, не хозин ли ставки покупатель
if ($player["id"]==$bgive["uid"])
    $err_bg = '<b>Зачем покупать свою же ставку?</b> ';
## Если не существует.
elseif (!$bgive)
    $err_bg = '<b><font color=#99000>Хм, что Вы пытаетесь купить ? все животные в конюшне...</font></b> ';
## Подходящие ли уровень?.
elseif ($player["level"]<14)
    $err_bg = '<b><font color=#99000>Вы малы уровнем</font></b> ';
## Хватает ли денег?
elseif ($player["nv"]<($bgive["lr"]*$bgive["dlr"]))
    $err_bg = '<strong>Не хватает LR.</strong>';
    else { ## Если всё хорошо, то хорошо что хорошо :))
## Коэф. налога
$gold_koef = 0.97; ## 10%
## Информируем о покупке покупателя.
        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font><font color=000000><font color=#000000><b>Системная информация.</b></font> Вы купили <b>" . $bgive["dlr"] . " Изумруд</b> за <b>" . $bgive["lr"] * $bgive["dlr"] . " Бронзы</b> <BR>'+'');";
chmsg($ms,$_SESSION['user'][login]);
## Апдейтим покупателя
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$bgive["lr"]*$bgive["dlr"]."',`baks`=`baks`+".$bgive["dlr"]." WHERE `id`='".$player["id"]."' LIMIT 1;");
## Апдейтим продавца
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".($bgive["lr"]*$bgive["dlr"])*$gold_koef."' WHERE `id`='".$bgive["uid"]."' LIMIT 1;");
## Информируем продавца.
        $mss = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font><font color=000000><font color=#000000><b>Системная информация.</b></font><strong> У вас купили: <b>" . $bgive["dlr"] . "</b> Изумруд , начислено на счет: <b>" . ($bgive["lr"] * $bgive["dlr"]) * $gold_koef . "</b> Бронзы, налог: 3% <BR>'+'');";
chmsg($mss,$bgive[user]);
## Апдейтим биржу
$val_give_birja=varcheck($_GET['give_birja']);
mysqli_query($GLOBALS['db_link'],"DELETE FROM `dlr_birja` WHERE `id`=".$val_give_birja." LIMIT 1");
echo "<script>location='main.php?mselect=9';</script>";
}
}
## Смотрим DLR, находящийся на продаже в бирже.
	$gold = mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr` FROM `dlr_birja` WHERE id>0 ORDER BY `lr` ASC LIMIT 20");
## Выводим.
	echo "<table cellspacing=4 cellpadding=1 width=650 bgcolor=#F0F0F0 class=freemain >
	   <td width=50>Сумма Изумруда</td>
	   <td width=100>Курс </td>
	   <td width=80>Общая сумма Бронзы</td>
	   <td width=70>Действие</td></tr></table>";

## МОЯ ЗАЯВКА
$un_count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `dlr_birja` WHERE `uid`='".$player["id"]."';"));
if ($un_count>=1){
echo '<table cellspacing=4 cellpadding=1 width=650 bgcolor=#990000><tr align=center>
<td width=50><b><font color=#FFFFFF>Ваша ставка</font></b></td>
<td width=100><b>&nbsp;</b></td>
<td width=80><b>&nbsp;</b></td>
<td width=70><form name="unselect" action="main.php?mselect=9" method="POST"><input type=hidden name="mselect" value="9"><input type=submit class=lbut value="Удалить" name="unselect"></form></td></tr></table>';
}
## ВЫВОД ВСЕХ ЗАЯВОК.
    while($gg = mysqli_fetch_assoc($gold))
	{
        echo "<table cellspacing=4 cellpadding=1 width=650><tr align=center>
        <td width=50><b>".$gg["dlr"]."</b></td>
        <td width=100><b>".$gg["lr"]."</b></td>
        <td width=80><b>".$gg["lr"]*$gg["dlr"]."</b></td>
        <td width=70><input type='button' class='lbut' value='Оплатить'  onclick='give_birja(" . $gg["id"] . "," . $gg["dlr"] . "," . $gg["dlr"] * $gg["lr"] . ");'></td></tr></table>";

	}
?>
<?
if (!empty($_POST['unselect'])){
$unselect = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `uid`='".$player["id"]."' LIMIT 1;"));
## Проверяем кол-во лотов продавца.
if ($un_count<1)
    $err_bg = '<strong>У вас нет ставки на бирже.</strong>';
else { ## Если всё хорошо, то хорошо что хорошо :))
$gold_koef = 0.90; ## 10%
    $msst = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font><font color=000000><font color=#000000><b>Системная информация.</b></font><strong> Вы сняли с продажи <b>" . $unselect["dlr"] * $gold_koef . " Изумруда</b>, налог: 10% <BR>'+'');";
chmsg($msst,$_SESSION['user'][login]);
## Апдейтим юзера
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`+".($unselect["dlr"]*$gold_koef)." WHERE `id`='".$player["id"]."' LIMIT 1;");
## Апдейтим биржу
mysqli_query($GLOBALS['db_link'],"DELETE FROM `dlr_birja` WHERE uid=".$player["id"]." LIMIT 1");
echo "<script>location='main.php?mselect=9';</script>";
}
}
?>
<script type="text/javascript">
<? if (isset($err_bg) && !empty($err_bg)){ ?>
message_window ('success','','<?=$err_bg?>','ok','')
<? } ?>
</script>
<tr>
    <td align=center><b><font class=weaponch style="color:#dd0000">Комиссия при удалении заявки составляет 10% от
                суммы.</font></b>
</tr></td>
</table></FIELDSET>
