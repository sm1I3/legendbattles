<?
session_start();
$_SESSION['filter'];
$sign = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "select `sign` from `user` where `login`='Администрация' LIMIT 1;"));
?>
<HTML>
<HEAD>
    <LINK href="/css/game.css" rel=STYLESHEET type=text/css>
    <META Http-Equiv=Content-Type Content="text/html; charset=UTF-8">
    <META Http-Equiv=Cache-Control Content=No-Cache>
    <META Http-Equiv=Pragma Content=No-Cache>
    <META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>

<style type="text/css">
    <!--
    .style1 {
        font-size: 18px
    }

    -->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align=center><input type="button" class="lbut" onClick="location='../../../main.php'" value="Вернуться">
        </td>
    </tr>
    <tr>
        <td align=center>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=1'" value="Изготовление предметов"/>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=4'" value="Редактор предметов"/>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=2'" value="Добавление в магазин"/>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=3'" value="Завоз"/>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=99'" value="Передача вещей персонажам"/>
            <input type="button" class="lbut" onclick="location='adm.php?id_adm=7'" value="Блок IP"/>
        </td>
    </tr>
    <tr>
        <td align=center>
            <input type="button" class="lbut" onclick="location='player_items.php'" value="Удаление вещей"/>
            <input type="button" class="lbut" onclick="location='clan_items.php'" value="Работа с КЛАНАМИ"/>
            <input type="button" class="lbut" onclick="location='tz.php'" value="ТЗ админам"/>
            <input type="button" class="lbut" onclick="location='errors.php'" value=" Сообщения об ошибках"/>
            <input type="button" class="lbut" onclick="location='alhim.php'" value="Создание алхимических рецептов"/>
            <input type="button" class="lbut" onclick="location='custom_rec.php'" value="Создание других рецептов"/>
            <input type="button" class="lbut" onclick="location='bot_drop.php'" value="Дроп ботов"/>
            <input type="button" class="lbut" onclick="location='accounts.php'" value="Аккаунты"/>
            <input type="button" class="lbut" onclick="location='presents.php'" value="Подарки"/>
            <input type="button" class="lbut" onclick="location='player.php'" value="Персонажи"/>
            <input type="button" class="lbut" onclick="location='labyrinth.php'" value="Лабиринт"/>
        </td>
    </tr>
    <tr>
        <td align=center>
            <input type="button" class="lbut" onclick="location='ref_system.php'" value="Рефералка"/>
            <input type="button" class="lbut" onclick="location='bot_edit.php'" value="Боты"/>
            <input type="button" class="lbut" onclick="location='system_messages.php'" value="Системки"/>
            <input type="button" class="lbut" onclick="location='real_dd_adm.php'" value="Продажа статов в ДЦ"/>
            <input type="button" class="lbut" onclick="location='player-actions.php'" value="ЛОГИ ПЕРСОНАЖЕЙ"/>
            <input type="button" class="lbut" onclick="location='chests2.php'" value="Сундуки откр"/>
            <input type="button" class="lbut" onclick="location='chests.php'" value="Cундуки"/>
            <input type="button" class="lbut" onclick="location='curs.php'" value="Дилер"/>
            <input type="button" class="lbut" onclick="location='koldyn.php'" value="Колдун"/>
            <input type="button" class="lbut" onclick="location='tavern.php'" value="Таверна"/>
            <input type="button" class="lbut" onclick="location='panel.php'" value="Вход в игру"/>
            <input type="button" class="lbut" onclick="location='online.php'" value="Онлайн"/>
        </td>
    </tr>
</table>


<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
function varcheck($input)
{
    if (sizeof($input) == 0) {
        return null;
    }
    if (!is_array($input)) {
        if (is_numeric($input)) {

            #Функция актуальна при условии, если значение больше 0
            #Получает целочисленное значение переменной
            $number = intval($input);
            //echo 'numeric';
            return $number;
        } else {
            #Вырезаем html теги
            $out_string = strip_tags($input);
            #Преобразует специальные символы в HTML сущности.
            $out_string = htmlspecialchars($out_string);
            #Экранирует специальные символы в строке,принмимая во внимание кодировку соединения.
            mysqli_real_escape_string($GLOBALS['db_link'], $out_string);
            $out_string = str_replace(array('<', '>', "'", '"', ')', '('), array('&lt;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), $out_string);
            $out_string = str_ireplace('%3Cscript', '', $out_string);
            return $out_string;

        }
    } else {
        foreach ($input as $key => $val) {
            $out_string[$key] = varcheck($val);
        }
        return $out_string;
    }
}

$forlogin = $forlogin ?? varcheck($_POST['forlogin']) ?? varcheck($_GET['forlogin']) ?? '';
$id_adm = $id_adm ?? varcheck($_POST['id_adm']) ?? varcheck($_GET['id_adm']) ?? '';
if ($id_adm == 7) {
    $banip = $banip ?? varcheck($_POST['banip']) ?? varcheck($_GET['banip']) ?? '';
    $unbanip = $unbanip ?? varcheck($_POST['unbanip']) ?? varcheck($_GET['unbanip']) ?? '';
    if ($banip) {
        $check = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `blocklist` WHERE `ip`='" . $banip . "' LIMIT 1;"));
        if (!$check['id']) {
            mysqli_query($GLOBALS['db_link'], "INSERT INTO `blocklist` (`ip`) VALUES ('" . $banip . "');");
            echo '<font class=proce>IP: ' . $banip . ' заблокирован!</font>';
        } else {
            echo '<font class=proce>IP: ' . $banip . ' уже заблокирован!</font>';
        }
    } elseif ($unbanip) {
        $check = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `blocklist` WHERE `ip`='" . $unbanip . "' LIMIT 1;"));
        if ($check['id']) {
            mysqli_query($GLOBALS['db_link'], "DELETE FROM `blocklist` WHERE `ip`='" . $unbanip . "' LIMIT 1;");
            echo '<font class=proce>IP: ' . $unbanip . ' разблокирован!</font>';
        } else {
            echo '<font class=proce>IP: ' . $unbanip . ' не найден!</font>';
        }
    }
    $allblocked = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `blocklist`");
    echo '<br>
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td align=center>
	<form action="adm.php?id_adm=7" method="post">
	<input name="banip" type="text" class="LogintextBox" /><input type=submit value=забанить class=lbut>
	</form><br>
	</td></tr>
	<table width="50%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td align=center><b>Заблокированные адреса</b></td></tr>
	';
    while ($row = mysqli_fetch_array($allblocked)) {
        echo '<tr><td align=center>
		<form action="adm.php?id_adm=7" method="post">
		<input name="unbanip" type="hidden" value="' . $row['ip'] . '" />
		' . $row['ip'] . ' <input type=submit value=разбанить class=lbut>
		</form><br>
		</td></tr>';
    }
    echo '
	</table>
	';
}
if ($id_adm == 99) {
    ?>
    <form action="adm.php?id_adm=99" method="post">
        <select name="type">
            <option value="" selected="selected">все типы</option>
            <option value="w4">Ножи</option>
            <option value="w1">Мечи</option>
            <option value="w2">Топоры</option>
            <option value="w3">Дробящее</option>
            <option value="w6">Алебарды и копья</option>
            <option value="w5">Метательное</option>
            <option value="w7">Посохи</option>
            <option value="w20">Щиты</option>
            <option value="w23">Шлемы</option>
            <option value="w26">Пояса</option>
            <option value="w18">Кольчуги</option>
            <option value="w19">Доспехи</option>
            <option value="w24">Перчатки</option>
            <option value="w80">Наручи</option>
            <option value="w21">Сапоги</option>
            <option value="w25">Кулоны</option>
            <option value="w22">Кольца</option>
            <option value="w28">Наплечники</option>
            <option value="w90">Поножи</option>
            <option value="w61">Приманки</option>
            <option value="w0">Эликсиры</option>
            <option value="w66">Травы</option>
            <option value="w67">Шкуры</option>
            <option value="w68">Лес</option>
            <option value="w69">Рыбалка</option>
            <option value="w70">Мази</option>
            <option value="w60">Квесты</option>
            <option value="w29">Свитки</option>
            <option value="w71">Руны</option>
            <option value="w62">Сундуки</option>
            <option value="w30">Лицензии</option>
            <option value="w100">Ресурсы для крафта</option>
            <option value="w16">татем</option>
        </select> <input name="smb7" type="submit" class="lbut"
                         value="Применить фильтр"/><? $filter2 = "WHERE master=''";
        if ($smb7) {
            if ($type == "") {
                $filter = "";
                $filter2 = "WHERE master=''";
            } else $filter = "WHERE type='$type'";
            $filter2 = " AND master=''";
        } ?>

        <select name="idit">
            <option value=0<? if ($idit == "") {
                echo " selected=selected";
            } ?>>Выберите тип
            </option>
            <? $it = mysqli_query($GLOBALS['db_link'], "SELECT * FROM items $filter $filter2 ORDER BY type,name,level;");
            while ($row = mysqli_fetch_assoc($it)) {
                echo "<option value=$row[id]";
                if ($idit == $row['id']) {
                    echo " selected=selected";
                }
                echo ">$row[name] [ $row[level] ] [ $row[effect] ]</option>";
            }
            ?>
        </select> <input type=text class="LoginText" name="forlogin">
        <input name="giveitem" type="submit" class="lbut" value="Передать"/>
    </form>
    <form action="adm.php?id_adm=99" method="post">
        <select name="type">
            <option value="1" selected="selected">Мертвец</option>
            <option value="2">Варвар</option>
            <option value="3">Огонь</option>
            <option value="4">Дикий</option>
            <option value="5">Воме</option>
            <option value="6">Леший</option>
            <option value="7">Для теста</option>
        </select>
        <input type=text class="LoginText" name="forlogin">
        <input name="giveall" type="submit" class="lbut" value="Передать"/>
    </form>

    <?
    $giveall = $giveall ?? varcheck($_POST['giveall']) ?? varcheck($_GET['giveall']) ?? '';
    if ($giveall and $forlogin != '') {
        switch ($type) {
            case 1:
                $where = "pl_id='9'";
                break;
            case 2:
                $where = "pl_id='10'";
                break;
            case 3:
                $where = "pl_id='17'";
                break;
            case 4:
                $where = "pl_id='99'";
                break;
            case 5:
                $where = "pl_id='6666'";
                break;
            case 6:
                $where = "pl_id='91'";
                break;
            case 7:
                $where = "pl_id='13876370'";
                break;
        }
        $it = mysqli_query($GLOBALS['db_link'], "SELECT * FROM invent WHERE " . $where . " AND used='1';");
        $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='" . $forlogin . "';"));
        if ($pl['id']) {
            while ($row = mysqli_fetch_array($it)) {
                echo $row['protype'] . "<br>";
                mysqli_query($GLOBALS['db_link'], "INSERT INTO invent (protype,pl_id,dolg,price,dd_price) VALUES ('" . $row['protype'] . "','" . $pl['id'] . "','" . $row['dolg'] . "','" . $row['price'] . "','" . $row['dd_price'] . "');");
            }
        }
    }
    $giveitem = $giveitem ?? varcheck($_POST['giveitem']) ?? varcheck($_GET['giveitem']) ?? '';
    if ($giveitem and $forlogin != '') {
        $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM items WHERE id='$idit';"));
        $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$forlogin';"));
        if ($it['dd_price'] > 0) {
            $pr = $it['dd_price'];
            $filt = "dd_price";
        } else {
            $pr = $it['price'];
            $filt = "price";
        }
        $par = explode("|", $it['param']);
        foreach ($par as $value) {
            $stat = explode("@", $value);
            switch ($stat[0]) {
                case 2:
                    $dolg = $stat[1];
                    break;
            }
        }
        mysqli_query($GLOBALS['db_link'], "INSERT INTO invent (protype,pl_id,dolg,$filt) VALUES ('" . $it['id'] . "','" . $pl['id'] . "','" . $dolg . "','" . $pr . "');");
    }


}
if ($id_adm == 1){ ?>
<br>
<form name="additem" method="post" action="adm.php?id_adm=1">
    <table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
        <tr>
            <td valign="top" bgcolor="#f9f9f9">
                <div id="img"></div>
                <input type="text" name="gif" value="название картинки" onClick="this.value='';">

                </select></td>
            <td width=100% bgcolor=#ffffff valign=top>
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td bgcolor=#ffffff width=100%><font class=nickname>
                                <select name="type">
                                    <option value="w4" selected="selected">Ножи</option>
                                    <option value="w1">Мечи</option>
                                    <option value="w2">Топоры</option>
                                    <option value="w3">Дробящее</option>
                                    <option value="w6">Алебарды и копья</option>
                                    <option value="w5">Метательное</option>
                                    <option value="w7">Посохи</option>
                                    <option value="w20">Щиты</option>
                                    <option value="w23">Шлемы</option>
                                    <option value="w26">Пояса</option>
                                    <option value="w18">Кольчуги</option>
                                    <option value="w19">Доспехи</option>
                                    <option value="w24">Перчатки</option>
                                    <option value="w80">Наручи</option>
                                    <option value="w21">Сапоги</option>
                                    <option value="w25">Кулоны</option>
                                    <option value="w22">Кольца</option>
                                    <option value="w28">Наплечники</option>
                                    <option value="w90">Наколенники</option>
                                    <option value="w29">Свитки</option>
                                    <option value="w30">Лицензии</option>
                                    <option value="w61">Приманки</option>
                                    <option value="w0">Эликсиры</option>
                                    <option value="w66">Травы</option>
                                    <option value="w67">Шкуры</option>
                                    <option value="w68">Лес</option>
                                    <option value="w69">Рыбалка</option>
                                    <option value="w70">Мази</option>
                                    <option value="w60">Квесты</option>
                                    <option value="w71">Руны</option>
                                    <option value="w62">Сундуки</option>
                                    <option value="w100">Ресурсы для крафта</option>
                                    <option value="w16">татем</option>
                                </select>
                                <input name="name" type="text" value="Название"/>
                                <select name="block">
                                    <option value="0" selected="selected">Не щит</option>
                                    <option value="40">1 точка</option>
                                    <option value="70">2 точки</option>
                                    <option value="90">3 точки</option>
                                </select>
                                <select name="num_a">
                                    <option value="0" selected="selected">Не свиток/элексир</option>
                                    <option value="32">+HP/Приманка/Обнул/Древесина</option>
                                    <option value="33">+MP/Доски</option>
                                    <option value="1">Мощь</option>
                                    <option value="2">Проворность</option>
                                    <option value="3">Везение</option>
                                    <option value="4">Здоровье</option>
                                    <option value="5">Разум</option>
                                    <option value="6">Сноровка</option>
                                    <option value="7">Урон</option>
                                    <option value="8">Броня</option>
                                    <option value="9">Пробой брони</option>
                                    <option value="10">Уворот</option>
                                    <option value="11">Точность</option>
                                    <option value="12">Сокрушение</option>
                                    <option value="13">Стойкость</option>
                                    <option value="14">Арт зелье</option>
                                    <option value="15">Наблюдательность</option>
                                    <option value="34">Приманка для рыбы</option>
                                </select>
                                <select name="acte">
                                    <option value="" selected="selected">Не свиток/элексир</option>
                                    <option value="magicreform">Зелье ХП/МП</option>
                                    <option value="zelreform">Эликсир</option>
                                    <option value="fightmagicform">Нападалка</option>
                                    <option value="chatsleepform">Молчанка</option>
                                    <option value="licensform">Лицензия Торговца</option>
                                    <option value="licensform2">Лицензия Доктора</option>
                                    <option value="doktorreform">Свиток Доктора</option>
                                    <option value="zelinvis">Невидимость</option>
                                    <option value="BotNapForm">Приманка</option>
                                    <option value="ObnulForm">Обнуление</option>
                                    <option value="MaseForm">Мазь</option>
                                    <option value="teleport">Телепорт</option>
                                    <option value="teleport2">Телепорт (с сохранением)</option>
                                </select>
                                <br/>
                                <strong>Второе оружие</strong>
                                да
                                <input name="wtor" type="radio" value="1"/>
                                нет
                                <input name="wtor" type="radio" value="0" checked/>
                                &nbsp; Слот: <select name="slot">
                                    <option value="0">Нельзя одеть</option>
                                    <option value="1">Шлем</option>
                                    <option value="2">Ожерелье</option>
                                    <option value="3">Оружие</option>
                                    <option value="4">Пояс</option>
                                    <option value="5">Содержимое карманов пояса</option>
                                    <option value="8">Слот для сапог</option>
                                    <option value="9">Поножи</option>
                                    <option value="10">Наплечники</option>
                                    <option value="11">Наручи</option>
                                    <option value="12">Перчатки</option>
                                    <option value="13">Щит</option>
                                    <option value="14">Кольцо</option>
                                    <option value="16">Броня</option>
                                    <option value="17">Кольчуга</option>
                                    <option value="20">Руна</option>
                                </select> эффект: <input name="effect" type="text"/>
                                <br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td>
                        <td><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3</td>
                    </tr>
                    <tr>
                        <td colspan=2 width=100%>
                            <table cellpadding=0 cellspacing=0 border=0 width=100%>
                                <tr>
                                    <td width=50% bgcolor=#D8CDAF>
                                        <div align=center><font class=invtitle>свойства</div>
                                    </td>
                                    <td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1
                                                             height=1></td>
                                    <td bgcolor=#D8CDAF width=50%>
                                        <div align=center><font class=invtitle>требования</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>Цена</label>
                                                <input name="price" type="text" value="1"/>&nbsp;<label>Цена
                                                    ДД</label>&nbsp;<input name="dd_price" type="text" value="0"/><br>
                                                ---------------------------------------------------------------<br>
                                                &nbsp;<label>Дополнительный урон (только если выбран мод, пример
                                                    20-30)</label><br>
                                                <select name="damage_mod">
                                                    <option value="0">Без мода</option>
                                                    <option value="1">Урон огнем</option>
                                                    <option value="2">Урон льдом</option>
                                                    <option value="3">Вампиризм</option>
                                                    <option value="4">Лечение</option>
                                                </select>
                                                &nbsp;<input name="damage_mod_val" type="text" value=""/><br>
                                                ---------------------------------------------------------------<br>
                                                &nbsp;<label>Иммунитет к Огню</label>
                                                <select name="fire_immune">
                                                    <option value="0">Нет</option>
                                                    <option value="1">Да</option>
                                                </select><br>
                                                &nbsp;<label>Иммунитет ко Льду</label>
                                                <select name="ice_immune">
                                                    <option value="0">Нет</option>
                                                    <option value="1">Да</option>
                                                </select><br>
                                                &nbsp;<label>Иммунитет к Вампиризму</label>
                                                <select name="vamp_immune">
                                                    <option value="0">Нет</option>
                                                    <option value="1">Да</option>
                                                </select><br>
                                                &nbsp;<label>Иммунитет к Яду</label>
                                                <select name="poison_immune">
                                                    <option value="0">Нет</option>
                                                    <option value="1">Да</option>
                                                </select><br>
                                                &nbsp;<label>Иммунитет к Физ.Урону</label>
                                                <select name="phys_immune">
                                                    <option value="0">Нет</option>
                                                    <option value="1">Да</option>
                                                </select><br>
                                                ---------------------------------------------------------------<br>
                                                <?
                                                ?>

                                    </td>
                                    <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1
                                                             height=1></td>
                                    <td align="right" valign="top" bgcolor="#FCFAF3"><font
                                                class=weaponch><b><label>Уровень:</label>
                                                <input name="level" type="text" value=""/><br><font
                                                        class=weaponch><b><label>Масса:</label>
                                                        <input name="massa" type="text" value=""/><br>
                                                        <font class=weaponch><b><label>Срок годности вещи (в днях)<i>0 -
                                                                        без
                                                                        срока</i>:</label>
                                                                <input name="srok" type="text" value=""/><br>
                                                                <?
                                                                for ($i = 0; $i <= 71; $i++) {
                                                                    switch ($i) {
                                                                        case 1:
                                                                            $fr = "Удар (пример 20-30):";
                                                                            break;
                                                                        case 2:
                                                                            $fr = "Долговечность:";
                                                                            break;
                                                                        case 3:
                                                                            $fr = "Карманов(3 max для поясов):";
                                                                            break;
                                                                        case 4:
                                                                            $fr = "Материал:";
                                                                            break;
                                                                        case 5:
                                                                            $fr = "Уловка:";
                                                                            break;
                                                                        case 6:
                                                                            $fr = "Точность:";
                                                                            break;
                                                                        case 7:
                                                                            $fr = "Сокрушение:";
                                                                            break;
                                                                        case 8:
                                                                            $fr = "Стойкость:";
                                                                            break;
                                                                        case 9:
                                                                            $fr = "Класс брони:";
                                                                            break;
                                                                        case 10:
                                                                            $fr = "Пробой брони:";
                                                                            break;
                                                                        case 11:
                                                                            $fr = "Пробой колющим ударом:";
                                                                            break;
                                                                        case 12:
                                                                            $fr = "Пробой режущим ударом:";
                                                                            break;
                                                                        case 13:
                                                                            $fr = "Пробой проникающим ударом:";
                                                                            break;
                                                                        case 14:
                                                                            $fr = "Пробой пробивающим ударом:";
                                                                            break;
                                                                        case 15:
                                                                            $fr = "Пробой рубящим ударом:";
                                                                            break;
                                                                        case 16:
                                                                            $fr = "Пробой карающим ударом:";
                                                                            break;
                                                                        case 17:
                                                                            $fr = "Пробой отсекающим ударом:";
                                                                            break;
                                                                        case 18:
                                                                            $fr = "Пробой дробящим ударом:";
                                                                            break;
                                                                        case 19:
                                                                            $fr = "Защита от колющих ударов:";
                                                                            break;
                                                                        case 20:
                                                                            $fr = "Защита от режущих ударов:";
                                                                            break;
                                                                        case 21:
                                                                            $fr = "Защита от проникающих ударов:";
                                                                            break;
                                                                        case 22:
                                                                            $fr = "Защита от пробивающих ударов:";
                                                                            break;
                                                                        case 23:
                                                                            $fr = "Защита от рубящих ударов:";
                                                                            break;
                                                                        case 24:
                                                                            $fr = "Защита от карающих ударов:";
                                                                            break;
                                                                        case 25:
                                                                            $fr = "Защита от отсекающих ударов:";
                                                                            break;
                                                                        case 26:
                                                                            $fr = "Защита от дробящих ударов:";
                                                                            break;
                                                                        case 27:
                                                                            $fr = "НР:";
                                                                            break;
                                                                        case 28:
                                                                            $fr = "Очки действия:";
                                                                            break;
                                                                        case 29:
                                                                            $fr = "Мана:";
                                                                            break;
                                                                        case 30:
                                                                            $fr = "Мощь:";
                                                                            break;
                                                                        case 31:
                                                                            $fr = "Проворность:";
                                                                            break;
                                                                        case 32:
                                                                            $fr = "Везение:";
                                                                            break;
                                                                        case 33:
                                                                            $fr = "Здоровье:";
                                                                            break;
                                                                        case 34:
                                                                            $fr = "Разум:";
                                                                            break;
                                                                        case 35:
                                                                            $fr = "Сноровка:";
                                                                            break;
                                                                        case 36:
                                                                            $fr = "Влад. мечами:";
                                                                            break;
                                                                        case 37:
                                                                            $fr = "Влад. топорами:";
                                                                            break;
                                                                        case 38:
                                                                            $fr = "Влад. дробящим оружием:";
                                                                            break;
                                                                        case 39:
                                                                            $fr = "Влад. ножами:";
                                                                            break;
                                                                        case 40:
                                                                            $fr = "Влад. метательным оружием:";
                                                                            break;
                                                                        case 41:
                                                                            $fr = "Влад. алебардами и копьями:";
                                                                            break;
                                                                        case 42:
                                                                            $fr = "Влад. посохами:";
                                                                            break;
                                                                        case 43:
                                                                            $fr = "Влад. экзотическим оружием:";
                                                                            break;
                                                                        case 44:
                                                                            $fr = "Влад. двуручным оружием:";
                                                                            break;
                                                                        case 99:
                                                                            $fr = "testТут:";
                                                                            break;
                                                                        case 46:
                                                                            $fr = "Магия воды:";
                                                                            break;
                                                                        case 47:
                                                                            $fr = "Магия воздуха:";
                                                                            break;
                                                                        case 48:
                                                                            $fr = "Магия земли:";
                                                                            break;
                                                                        case 49:
                                                                            $fr = "Сопротивление магии огня:";
                                                                            break;
                                                                        case 50:
                                                                            $fr = "Сопротивление магии воды:";
                                                                            break;
                                                                        case 51:
                                                                            $fr = "Сопротивление магии воздуха:";
                                                                            break;
                                                                        case 52:
                                                                            $fr = "Сопротивление магии земли:";
                                                                            break;
                                                                        case 53:
                                                                            $fr = "Воровство:";
                                                                            break;
                                                                        case 54:
                                                                            $fr = "Осторожность:";
                                                                            break;
                                                                        case 55:
                                                                            $fr = "Скрытность:";
                                                                            break;
                                                                        case 56:
                                                                            $fr = "Наблюдательность:";
                                                                            break;
                                                                        case 57:
                                                                            $fr = "Торговля:";
                                                                            break;
                                                                        case 58:
                                                                            $fr = "Странник:";
                                                                            break;
                                                                        case 59:
                                                                            $fr = "Рыболов:";
                                                                            break;
                                                                        case 60:
                                                                            $fr = "Лесоруб:";
                                                                            break;
                                                                        case 61:
                                                                            $fr = "Ювелирное дело:";
                                                                            break;
                                                                        case 62:
                                                                            $fr = "Самолечение:";
                                                                            break;
                                                                        case 63:
                                                                            $fr = "Оружейник:";
                                                                            break;
                                                                        case 64:
                                                                            $fr = "Доктор:";
                                                                            break;
                                                                        case 65:
                                                                            $fr = "Самолечение:";
                                                                            break;
                                                                        case 66:
                                                                            $fr = "Быстрое восстановление маны:";
                                                                            break;
                                                                        case 67:
                                                                            $fr = "Лидерство:";
                                                                            break;
                                                                        case 68:
                                                                            $fr = "Алхимия:";
                                                                            break;
                                                                        case 69:
                                                                            $fr = "Развитие горного дела:";
                                                                            break;
                                                                        case 70:
                                                                            $fr = "Травничество:";
                                                                            break;
                                                                        case 71:
                                                                            $fr = "Коэффициент(new):";
                                                                            break;
                                                                    }
                                                                    if ($fr != "") echo '<label><font class=weaponch><b>' . $fr . '</b></font></label><input name=pr[' . $i . '] type=text value=""><br>';
                                                                }
                                                                //опыт и масса
                                                                echo '<label><font class=weaponch><b>Бонус опыта (в %)</b></font></label><input name=pr[expbonus] type=text value=""><br>';
                                                                echo '<label><font class=weaponch><b>Бонус массы</b></font></label><input name=pr[massbonus] type=text value=""><br>';
                                                                ?>

                                    </td>
                                    <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1
                                                             height=1></td>
                                    <td align="right" valign="top" bgcolor="#FCFAF3"><font
                                                class=weaponch><b><label>Уровень:</label>
                                                <input name="level" type="text" value=""/><br><font
                                                        class=weaponch><b><label>Масса:</label>
                                                        <input name="massa" type="text" value=""/><br>
                                                        <font class=weaponch><b><label>Срок годности вещи (в днях)<i>0 -
                                                                        без
                                                                        срока</i>:</label>
                                                                <input name="srok" type="text" value=""/><br>
                                                                <?
                                                                for ($i = 28; $i <= 74; $i++) {
                                                                    switch ($i) {
                                                                        case 28:
                                                                            $fr = "Очки действия:";
                                                                            break;
                                                                        case 29:
                                                                            $fr = "";
                                                                            break;
                                                                        case 30:
                                                                            $fr = "Мощь:";
                                                                            break;
                                                                        case 31:
                                                                            $fr = "Проворность:";
                                                                            break;
                                                                        case 32:
                                                                            $fr = "Везение:";
                                                                            break;
                                                                        case 33:
                                                                            $fr = "Здоровье:";
                                                                            break;
                                                                        case 34:
                                                                            $fr = "Разум:";
                                                                            break;
                                                                        case 35:
                                                                            $fr = "Сноровка:";
                                                                            break;
                                                                        case 36:
                                                                            $fr = "Влад. мечами:";
                                                                            break;
                                                                        case 37:
                                                                            $fr = "Влад. топорами:";
                                                                            break;
                                                                        case 38:
                                                                            $fr = "Влад. дробящим оружием:";
                                                                            break;
                                                                        case 39:
                                                                            $fr = "Влад. ножами:";
                                                                            break;
                                                                        case 40:
                                                                            $fr = "Влад. метательным оружием:";
                                                                            break;
                                                                        case 41:
                                                                            $fr = "Влад. алебардами и копьями:";
                                                                            break;
                                                                        case 42:
                                                                            $fr = "Влад. посохами:";
                                                                            break;
                                                                        case 43:
                                                                            $fr = "Влад. экзотическим оружием:";
                                                                            break;
                                                                        case 44:
                                                                            $fr = "Влад. двуручным оружием:";
                                                                            break;
                                                                        case 45:
                                                                            $fr = "Магия огня:";
                                                                            break;
                                                                        case 46:
                                                                            $fr = "Магия воды:";
                                                                            break;
                                                                        case 47:
                                                                            $fr = "Магия воздуха:";
                                                                            break;
                                                                        case 48:
                                                                            $fr = "Магия земли:";
                                                                            break;
                                                                        case 49:
                                                                            $fr = "";
                                                                            break;
                                                                        case 50:
                                                                            $fr = "";
                                                                            break;
                                                                        case 51:
                                                                            $fr = "";
                                                                            break;
                                                                        case 52:
                                                                            $fr = "";
                                                                            break;
                                                                        case 53:
                                                                            $fr = "Воровство:";
                                                                            break;
                                                                        case 54:
                                                                            $fr = "Осторожность:";
                                                                            break;
                                                                        case 55:
                                                                            $fr = "Скрытность:";
                                                                            break;
                                                                        case 56:
                                                                            $fr = "Наблюдательность:";
                                                                            break;
                                                                        case 57:
                                                                            $fr = "Торговля:";
                                                                            break;
                                                                        case 58:
                                                                            $fr = "Странник:";
                                                                            break;
                                                                        case 59:
                                                                            $fr = "Рыболов:";
                                                                            break;
                                                                        case 60:
                                                                            $fr = "Лесоруб:";
                                                                            break;
                                                                        case 61:
                                                                            $fr = "Ювелирное дело:";
                                                                            break;
                                                                        case 62:
                                                                            $fr = "Самолечение:";
                                                                            break;
                                                                        case 63:
                                                                            $fr = "Оружейник:";
                                                                            break;
                                                                        case 64:
                                                                            $fr = "Доктор:";
                                                                            break;
                                                                        case 65:
                                                                            $fr = "Самолечение:";
                                                                            break;
                                                                        case 66:
                                                                            $fr = "Быстрое восстановление маны:";
                                                                            break;
                                                                        case 67:
                                                                            $fr = "Лидерство:";
                                                                            break;
                                                                        case 68:
                                                                            $fr = "Алхимия:";
                                                                            break;
                                                                        case 69:
                                                                            $fr = "Развитие горного дела:";
                                                                            break;
                                                                        case 70:
                                                                            $fr = "Травничество:";
                                                                            break;
                                                                        case 73:
                                                                            $fr = "Звание:";
                                                                            break;
                                                                        case 74:
                                                                            $fr = "Взломщик:";
                                                                            break;
                                                                    }
                                                                    if ($fr != "") echo "<label><font class=weaponch><b>$fr</b></font></label><input name=tr[$i] type=text value=\"\"/><br>\n";
                                                                }
                                                                ?>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div align="center">
        <input name="smb1" type="submit" class="lbut" value="Сохранить"/>
    </div>
</form>
<div align="center">
    <p><br>
        <? }

        // Рабочий блок. Проверено.
        if ($id_adm == 2){
        ?><br>

    <form name="addmark" method="post" action="adm.php?id_adm=2">
        <select name="type1">
            <option value="" selected="selected">все типы</option>
            <option value="w4">Ножи</option>
            <option value="w1">Мечи</option>
            <option value="w2">Топоры</option>
            <option value="w3">Дробящее</option>
            <option value="w6">Алебарды и копья</option>
            <option value="w5">Метательное</option>
            <option value="w7">Посохи</option>
            <option value="w20">Щиты</option>
            <option value="w23">Шлемы</option>
            <option value="w26">Пояса</option>
            <option value="w18">Кольчуги</option>
            <option value="w19">Доспехи</option>
            <option value="w24">Перчатки</option>
            <option value="w80">Наручи</option>
            <option value="w21">Сапоги</option>
            <option value="w25">Кулоны</option>
            <option value="w22">Кольца</option>
            <option value="w28">Наплечники</option>
            <option value="w90">Поножи</option>
            <option value="w61">Приманки</option>
            <option value="w0">Эликсиры</option>
            <option value="w30">Лицензии</option>
            <option value="w66">Травы</option>
            <option value="w67">Шкуры</option>
            <option value="w68">Лес</option>
            <option value="w69">Рыбалка</option>
            <option value="w70">Мази</option>
            <option value="w60">Квесты</option>
            <option value="w29">Свитки</option>
            <option value="w71">Руны</option>
            <option value="w62">Сундуки</option>
            <option value="w100">Ресурсы для крафта</option>
            <option value="w16">татем</option>
        </select> <input name="smb9" type="submit" class="lbut" value="Применить фильтр"/>
        <? $filter2 = "WHERE master=''";
        $smb9 = $smb9 ?? varcheck($_POST['smb9']) ?? varcheck($_GET['smb9']) ?? '';
        $type1 = $type1 ?? varcheck($_POST['type1']) ?? varcheck($_GET['type1']) ?? '';
        if ($smb9) {
            if ($type1 == "") {
                $filter = "";
                $filter2 = "WHERE master=''";
            } else $filter = "WHERE type='$type1'";
            $filter2 = " AND master=''";
        } ?>

        <select name="id">
            <option value=0<? if ($id == "") {
                echo " selected=selected";
            } ?>>Выберите тип
            </option>
            <? $it = mysqli_query($GLOBALS['db_link'], "SELECT * FROM items $filter $filter2 ORDER BY type,level,name;");
            while ($row = mysqli_fetch_assoc($it)) {
                echo "<option value=$row[id]>$row[name] [ $row[level] ]</option>";
            }
            ?>
        </select><br><br>
        <select name="type">
            <option value="w4">Ножи</option>
            <option value="w1">Мечи</option>
            <option value="w2">Топоры</option>
            <option value="w3">Дробящее</option>
            <option value="w6">Алебарды и копья</option>
            <option value="w5">Метательное</option>
            <option value="w7">Посохи</option>
            <option value="w20">Щиты</option>
            <option value="w23">Шлемы</option>
            <option value="w26">Пояса</option>
            <option value="w18">Кольчуги</option>
            <option value="w19">Доспехи</option>
            <option value="w24">Перчатки</option>
            <option value="w80">Наручи</option>
            <option value="w21">Сапоги</option>
            <option value="w25">Кулоны</option>
            <option value="w22">Кольца</option>
            <option value="w28">Наплечники</option>
            <option value="w90">Поножи</option>
            <option value="w29">Свитки</option>
            <option value="w30">Лицензии</option>
            <option value="w0">Эликсиры</option>
            <option value="w66">Травы</option>
            <option value="w67">Шкуры</option>
            <option value="w68">Лес</option>
            <option value="w69">Рыбалка</option>
            <option value="w70">Мази</option>
            <option value="w60">Квесты</option>
            <option value="w61">Приманки</option>
            <option value="w71">Руны</option>
            <option value="w62">Сундуки</option>
            <option value="w100">Ресурсы для крафта</option>
        </select> <br><br>
        <select name="pl">
            <option value="2">Лавка форпоста</option>
            <option value="34">Дом Дилеров</option>
            <option value="4">Госпиталь</option>
            <option value="45">Лавка Странников</option>
            <option value="48">Новогодняя ярмарка</option>
            <option value="49">Магазин СП</option>
            <option value="50">Магазин Рыбака</option>
            <option value="51">Магазин Лесоруба</option>
            <option value="112">Новогодний базар</option>
            <option value="44">реп</option>
            <option value="111">Арсенал</option>
            <option value="1203">Сундуки</option>
            <option value="1002">Ярмарка(новая)</option>
            <option value="1223">компенсация</option>
        </select> <br><br>
        <select name="pl_dd">
            <option value="1">Комплект горца</option>
            <option value="2">Комплект мертвеца</option>
            <option value="9">Комплект Ледяной Стихии</option>
            <option value="103">Комплект Дракона</option>
            <option value="104">Комплект ведмака</option>
            <option value="99">Зелья</option>
        </select> <br><br>

        <input name="kol" type="text" value="10" size="7"/>
        <input name="smb6" type="submit" class="lbut" value="Добавить"/><br/>
    </form>
    <?
    $smb6 = $smb6 ?? varcheck($_POST['smb6']) ?? varcheck($_GET['smb6']) ?? '';
    if ($smb6) {
        $id = $id ?? varcheck($_POST['id']) ?? varcheck($_GET['id']) ?? '';
        if ($id != 0) {
            if ($type != '') {
                mysqli_query($GLOBALS['db_link'], "DELETE FROM `market` WHERE `id` = '" . $id . "' AND `market` = '" . $pl . "';");
                $item = mysqli_query($GLOBALS['db_link'], 'SELECT items.id, items.level, items.price, items.type FROM items WHERE items.id =' . AP . $id . AP . ' ORDER BY level,price;');
                if ($pl != '') {
                    $kol = $kol ?? varcheck($_POST['kol']) ?? varcheck($_GET['kol']) ?? '';
                    while ($r = mysqli_fetch_assoc($item)) {
                        $pl_dd = $pl_dd ?? varcheck($_POST['pl_dd']) ?? varcheck($_GET['pl_dd']) ?? '';
                        if ($pl == 1203 and $pl_dd != '') {
                            mysqli_query($GLOBALS['db_link'], "INSERT INTO `market` (`id`,`market`,`kol`,`ty`,`dilers`) VALUES ('" . $id . "','" . $pl . "','" . $kol . "','" . $type . "','" . $pl_dd . "');");
                        } else {
                            mysqli_query($GLOBALS['db_link'], "INSERT INTO `market` (`id`,`market`,`kol`,`ty`,`dilers`) VALUES ('" . $id . "','" . $pl . "','" . $kol . "','" . $type . "','0');");
                        }
                    }
                }
            }
        }
    }
    }

    if ($id_adm == 3) {
        ?><br>
        <form name="addmark" method="post" action="adm.php?id_adm=3">
            <select name="id2">
                <option value=0 selected="selected">Все виды</option>
                <? $it = mysqli_query($GLOBALS['db_link'], "SELECT market.id, items.name ,items.level FROM items INNER JOIN market ON items.id = market.id WHERE master='';");
                while ($row = mysqli_fetch_assoc($it)) {
                    echo "<option value=$row[id]>$row[name] [ $row[level] ]</option>";
                }
                ?>
            </select>
            <select name="pl">
                <option value=0 selected="selected">Выберите</option>
                <option value=2>Лавка форпоста</option>
                <option value=34>Дом Дилеров</option>
                <option value=4>Госпиталь</option>
            </select>
            <input name="kl" type="text" value="Кол-во" size="7"/>
            <input name="smb3" type="submit" class="lbut" value="Сохранить"/><br/>
        </form>
        <?
        $smb3 = $smb3 ?? varcheck($_POST['smb3']) ?? varcheck($_GET['smb3']) ?? '';
        if ($smb3) {
            $id2 = $id2 ?? varcheck($_POST['id2']) ?? varcheck($_GET['id2']) ?? '';
            $kl = $kl ?? varcheck($_POST['kl']) ?? varcheck($_GET['kl']) ?? '';
            if ($id2 == 0) {

                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=' . AP . $kl . AP . ' WHERE market=' . AP . $pl . AP . ';');
            } else {

                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=' . AP . $kl . AP . ' WHERE market=' . AP . $pl . AP . ' and id=' . AP . $id2 . AP . ';');
            }
            echo "<br><span class=prchattime>Предмет добавлен!</span></div>";
        }
///////////////////////////////////////////////////////////////////////
        ?>

    <? }
    if ($id_adm == 4){
    ?>
    <form action="adm.php?id_adm=4" method="post">
        <select name="type">
            <option value="" selected="selected">все типы</option>
            <option value="w4">Ножи</option>
            <option value="w1">Мечи</option>
            <option value="w2">Топоры</option>
            <option value="w3">Дробящее</option>
            <option value="w6">Алебарды и копья</option>
            <option value="w5">Метательное</option>
            <option value="w7">Посохи</option>
            <option value="w20">Щиты</option>
            <option value="w23">Шлемы</option>
            <option value="w26">Пояса</option>
            <option value="w18">Кольчуги</option>
            <option value="w19">Доспехи</option>
            <option value="w24">Перчатки</option>
            <option value="w80">Наручи</option>
            <option value="w21">Сапоги</option>
            <option value="w25">Кулоны</option>
            <option value="w22">Кольца</option>
            <option value="w28">Наплечники</option>
            <option value="w90">Поножи</option>
            <option value="w29">Свитки</option>
            <option value="w30">Лицензии</option>
            <option value="w0">Эликсиры</option>
            <option value="w66">Травы</option>
            <option value="w67">Шкуры</option>
            <option value="w68">Лес</option>
            <option value="w69">Рыбалка</option>
            <option value="w70">Мази</option>
            <option value="w60">Квесты</option>
            <option value="w61">Приманки</option>
            <option value="w71">Руны</option>
            <option value="w62">Сундуки</option>
            <option value="w100">Ресурсы для крафта</option>
        </select> <input name="smb7" type="submit" class="lbut"
                         value="Применить фильтр"/><? $filter2 = "WHERE master=''";
        if ($smb7) {
            if ($type == "") {
                $filter = "";
                $filter2 = "WHERE master=''";
            } else $filter = "WHERE type='$type'";
            $filter2 = " AND master=''";
        } ?>

        <select name="idit">
            <option value=0<? if ($idit == "") {
                echo " selected=selected";
            } ?>>Выберите тип
            </option>
            <? $it = mysqli_query($GLOBALS['db_link'], "SELECT items.id, items.name ,items.level, items.type, items.effect FROM items $filter $filter2 ORDER BY effect,level,name;");
            while ($row = mysqli_fetch_assoc($it)) {
                echo "<option value=$row[id]";
                if ($idit == $row['id']) {
                    echo " selected=selected";
                }
                echo ">$row[name] [ $row[level] ] [ $row[effect] ]</option>";
            }
            ?>
        </select> <input name="edit" type="submit" class="lbut" value="Загрузить"/>
    </form>
    <?
    $edit = $edit ?? varcheck($_POST['edit']) ?? varcheck($_GET['edit']) ?? '';
    if ($edit){
    $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM items WHERE id='$idit';"));
    ?>
    <form name="edititem" method="post" action="adm.php?id_adm=4&idit=<?= $idit ?>">
        <table width=100% border=1 cellpadding=3 cellspacing=1 bordercolor="#333333">
            <tr>
                <td valign="top" bgcolor="#f9f9f9">
                    <div id="img"><img src="http://img.legendbattles.ru/image/weapon/<?= $it['gif'] ?>" title="test"/>
                    </div>
                    <input type="text" name="gif" value="<?= $it['gif'] ?>" onClick="this.value='';">
                    <?php

                    unset($w);
                    switch ($it['type']) {
                        case 'w0':
                            $w[0] = " selected=selected";
                            break;
                        case 'w1':
                            $w[1] = " selected=selected";
                            break;
                        case 'w2':
                            $w[2] = " selected=selected";
                            break;
                        case 'w3':
                            $w[3] = " selected=selected";
                            break;
                        case 'w4':
                            $w[4] = " selected=selected";
                            break;
                        case 'w6':
                            $w[5] = " selected=selected";
                            break;
                        case 'w5':
                            $w[6] = " selected=selected";
                            break;
                        case 'w7':
                            $w[7] = " selected=selected";
                            break;
                        case 'w20':
                            $w[8] = " selected=selected";
                            break;
                        case 'w23':
                            $w[9] = " selected=selected";
                            break;
                        case 'w26':
                            $w[10] = " selected=selected";
                            break;
                        case 'w18':
                            $w[11] = " selected=selected";
                            break;
                        case 'w19':
                            $w[12] = " selected=selected";
                            break;
                        case 'w24':
                            $w[13] = " selected=selected";
                            break;
                        case 'w80':
                            $w[14] = " selected=selected";
                            break;
                        case 'w21':
                            $w[15] = " selected=selected";
                            break;
                        case 'w25':
                            $w[16] = " selected=selected";
                            break;
                        case 'w22':
                            $w[17] = " selected=selected";
                            break;
                        case 'w28':
                            $w[18] = " selected=selected";
                            break;
                        case 'w90':
                            $w[19] = " selected=selected";
                            break;
                        case 'w29':
                            $w[29] = " selected=selected";
                            break;
                        case 'w30':
                            $w[30] = " selected=selected";
                            break;
                        case 'w61':
                            $w[61] = " selected=selected";
                            break;
                        case 'w66':
                            $w[66] = " selected=selected";
                            break;
                        case 'w67':
                            $w[67] = " selected=selected";
                            break;
                        case 'w68':
                            $w[68] = " selected=selected";
                            break;
                        case 'w69':
                            $w[69] = " selected=selected";
                            break;
                        case 'w70':
                            $w[70] = " selected=selected";
                            break;
                        case 'w60':
                            $w[60] = " selected=selected";
                            break;
                        case 'w71':
                            $w[71] = " selected=selected";
                            break;
                        case 'w62':
                            $w[62] = " selected=selected";
                            break;
                        case 'w100':
                            $w[100] = " selected=selected";
                            break;
                    }


                    ?>
                    </select></td>
                <td width=100% bgcolor=#ffffff valign=top>
                    <table cellpadding=0 cellspacing=0 border=0 width=100%>
                        <tr>
                            <td bgcolor=#ffffff width=100%><font class=nickname>
                                    <select name="type">
                                        <option value="w4"<?= $w[4] ?>>Ножи</option>
                                        <option value="w1"<?= $w[1] ?>>Мечи</option>
                                        <option value="w2"<?= $w[2] ?>>Топоры</option>
                                        <option value="w3"<?= $w[3] ?>>Дробящее</option>
                                        <option value="w6"<?= $w[5] ?>>Алебарды и копья</option>
                                        <option value="w5"<?= $w[6] ?>>Метательное</option>
                                        <option value="w7"<?= $w[7] ?>>Посохи</option>
                                        <option value="w20"<?= $w[8] ?>>Щиты</option>
                                        <option value="w23"<?= $w[9] ?>>Шлемы</option>
                                        <option value="w26"<?= $w[10] ?>>Пояса</option>
                                        <option value="w18"<?= $w[11] ?>>Кольчуги</option>
                                        <option value="w19"<?= $w[12] ?>>Доспехи</option>
                                        <option value="w24"<?= $w[13] ?>>Перчатки</option>
                                        <option value="w80"<?= $w[14] ?>>Наручи</option>
                                        <option value="w21"<?= $w[15] ?>>Сапоги</option>
                                        <option value="w25"<?= $w[16] ?>>Кулоны</option>
                                        <option value="w22"<?= $w[17] ?>>Кольца</option>
                                        <option value="w28"<?= $w[18] ?>>Наплечники</option>
                                        <option value="w90"<?= $w[19] ?>>Поножи</option>
                                        <option value="w30"<?= $w[30] ?>>Лицензии</option>
                                        <option value="w29"<?= $w[29] ?>>Свитки</option>
                                        <option value="w0"<?= $w[0] ?>>Эликсиры</option>
                                        <option value="w61"<?= $w[61] ?>>Приманки</option>
                                        <option value="w66"<?= $w[66] ?>>Травы</option>
                                        <option value="w67"<?= $w[67] ?>>Шкуры</option>
                                        <option value="w68"<?= $w[68] ?>>Лес</option>
                                        <option value="w69"<?= $w[69] ?>>Рыбалка</option>
                                        <option value="w70"<?= $w[70] ?>>Мази</option>
                                        <option value="w60"<?= $w[60] ?>>Квесты</option>
                                        <option value="w71"<?= $w[71] ?>>Руны</option>
                                        <option value="w62"<?= $w[62] ?>>Сундуки</option>
                                        <option value="w100"<?= $w[100] ?>>Ресурсы для крафта</option>
                                    </select>
                                    <input name="name" type="text" value="<?= $it['name'] ?>"/>
                                    <? unset($w);
                                    switch ($it['block']) {
                                        case 0:
                                            $w[0] = " selected=selected";
                                            break;
                                        case 40:
                                            $w[1] = " selected=selected";
                                            break;
                                        case 70:
                                            $w[2] = " selected=selected";
                                            break;
                                        case 90:
                                            $w[3] = " selected=selected";
                                            break;
                                    }
                                    ?>
                                    <select name="block">
                                        <option value="0"<?= $w[0] ?>>Не щит</option>
                                        <option value="40"<?= $w[1] ?>>1 точка</option>
                                        <option value="70"<?= $w[2] ?>>2 точки</option>
                                        <option value="90"<?= $w[3] ?>>3 точки</option>
                                    </select>
                                    <? unset($w);
                                    switch ($it['num_a']) {
                                        case 0:
                                            $w[0] = " selected=selected";
                                            break;
                                        case 32:
                                            $w[32] = " selected=selected";
                                            break;
                                        case 33:
                                            $w[33] = " selected=selected";
                                            break;
                                        case 1:
                                            $w[1] = " selected=selected";
                                            break;
                                        case 2:
                                            $w[2] = " selected=selected";
                                            break;
                                        case 3:
                                            $w[3] = " selected=selected";
                                            break;
                                        case 4:
                                            $w[4] = " selected=selected";
                                            break;
                                        case 5:
                                            $w[5] = " selected=selected";
                                            break;
                                        case 6:
                                            $w[6] = " selected=selected";
                                            break;
                                        case 7:
                                            $w[7] = " selected=selected";
                                            break;
                                        case 8:
                                            $w[8] = " selected=selected";
                                            break;
                                        case 9:
                                            $w[9] = " selected=selected";
                                            break;
                                        case 10:
                                            $w[10] = " selected=selected";
                                            break;
                                        case 11:
                                            $w[11] = " selected=selected";
                                            break;
                                        case 12:
                                            $w[12] = " selected=selected";
                                            break;
                                        case 13:
                                            $w[13] = " selected=selected";
                                            break;
                                        case 14:
                                            $w[14] = " selected=selected";
                                            break;
                                        case 15:
                                            $w[15] = " selected=selected";
                                            break;
                                        case 34:
                                            $w[34] = " selected=selected";
                                            break;
                                    }
                                    ?>

                                    <select name="num_a">
                                        <option value="0"<?= $w[0] ?>>Не свиток/элексир</option>
                                        <option value="32"<?= $w[32] ?>>+HP/Приманка/Обнул/Древесина</option>
                                        <option value="33"<?= $w[33] ?>>+MP/Доски</option>
                                        <option value="1"<?= $w[1] ?>>Мощь</option>
                                        <option value="2"<?= $w[2] ?>>Проворность</option>
                                        <option value="3"<?= $w[3] ?>>Везение</option>
                                        <option value="4"<?= $w[4] ?>>Здоровье</option>
                                        <option value="5"<?= $w[5] ?>>Разум</option>
                                        <option value="6"<?= $w[6] ?>>Сноровка</option>
                                        <option value="7"<?= $w[7] ?>>Урон</option>
                                        <option value="8"<?= $w[8] ?>>Броня</option>
                                        <option value="9"<?= $w[9] ?>>Пробой брони</option>
                                        <option value="10"<?= $w[10] ?>>Уворот</option>
                                        <option value="11"<?= $w[11] ?>>Точность</option>
                                        <option value="12"<?= $w[12] ?>>Сокрушение</option>
                                        <option value="13"<?= $w[13] ?>>Стойкость</option>
                                        <option value="14"<?= $w[14] ?>>Арт зелье</option>
                                        <option value="15"<?= $w[15] ?>>Наблюдательность</option>
                                        <option value="34"<?= $w[34] ?>>Приманка для рыбы</option>
                                    </select>

                                    <? unset($w);
                                    switch ($it['acte']) {
                                        case "":
                                            $w[0] = " selected=selected";
                                            break;
                                        case 'magicreform':
                                            $w[1] = " selected=selected";
                                            break;
                                        case 'fightmagicform':
                                            $w[2] = " selected=selected";
                                            break;
                                        case 'chatsleepform':
                                            $w[3] = " selected=selected";
                                            break;
                                        case 'zelreform':
                                            $w[4] = " selected=selected";
                                            break;
                                        case 'licensform':
                                            $w[5] = " selected=selected";
                                            break;
                                        case 'licensform2':
                                            $w[6] = " selected=selected";
                                            break;
                                        case 'doktorreform':
                                            $w[7] = " selected=selected";
                                            break;
                                        case 'zelinvis':
                                            $w[8] = " selected=selected";
                                            break;
                                        case 'BotNapForm':
                                            $w[9] = " selected=selected";
                                            break;
                                        case 'ObnulForm':
                                            $w[10] = " selected=selected";
                                            break;
                                        case 'MaseForm':
                                            $w[11] = " selected=selected";
                                            break;
                                        case 'teleport':
                                            $w[12] = " selected=selected";
                                            break;
                                        case 'teleport2':
                                            $w[13] = " selected=selected";
                                            break;
                                    }
                                    ?>
                                    <select name="acte">
                                        <option value=""<?= $w[0] ?>>Не свиток/элексир</option>
                                        <option value="magicreform"<?= $w[1] ?>>Зелье ХП/МП</option>
                                        <option value="zelreform"<?= $w[4] ?>>Эликсир</option>
                                        <option value="fightmagicform"<?= $w[2] ?>>Нападалка</option>
                                        <option value="chatsleepform"<?= $w[3] ?>>Молчанка</option>
                                        <option value="licensform"<?= $w[5] ?>>Лицензия Торговца</option>
                                        <option value="licensform2"<?= $w[6] ?>>Лицензия Доктора</option>
                                        <option value="doktorreform"<?= $w[7] ?>>Свиток Доктора</option>
                                        <option value="zelinvis"<?= $w[8] ?>>Невидимость</option>
                                        <option value="BotNapForm"<?= $w[9] ?>>Приманка</option>
                                        <option value="ObnulForm"<?= $w[10] ?>>Обнул</option>
                                        <option value="MaseForm"<?= $w[11] ?>>Мазь</option>
                                        <option value="teleport"<?= $w[12] ?>>Телепорт</option>
                                        <option value="teleport2"<?= $w[13] ?>>Телепорт (с сохранением)</option>
                                    </select>
                                    <br/>
                                    <? if ($it['2w'] == 1) {
                                        $w1 = "checked";
                                    } else {
                                        $w2 = "checked";
                                    } ?>
                                    <strong>Второе оружие</strong>
                                    да
                                    <input name="wtor" type="radio" value="1" <?= $w1 ?> />
                                    нет
                                    <input name="wtor" type="radio" value="0" <?= $w2 ?> />

                                    <?
                                    unset($w);
                                    switch ($it['slot']) {
                                        case 0:
                                            $w[0] = " selected=selected";
                                            break;
                                        case 1:
                                            $w[1] = " selected=selected";
                                            break;
                                        case 2:
                                            $w[2] = " selected=selected";
                                            break;
                                        case 3:
                                            $w[3] = " selected=selected";
                                            break;
                                        case 4:
                                            $w[4] = " selected=selected";
                                            break;
                                        case 5:
                                            $w[5] = " selected=selected";
                                            break;
                                        case 8:
                                            $w[8] = " selected=selected";
                                            break;
                                        case 9:
                                            $w[9] = " selected=selected";
                                            break;
                                        case 10:
                                            $w[10] = " selected=selected";
                                            break;
                                        case 11:
                                            $w[11] = " selected=selected";
                                            break;
                                        case 12:
                                            $w[12] = " selected=selected";
                                            break;
                                        case 13:
                                            $w[13] = " selected=selected";
                                            break;
                                        case 14:
                                            $w[14] = " selected=selected";
                                            break;
                                        case 16:
                                            $w[16] = " selected=selected";
                                            break;
                                        case 17:
                                            $w[17] = " selected=selected";
                                            break;
                                        case 20:
                                            $w[20] = " selected=selected";
                                            break;
                                    }
                                    if ($it['damage_mod'] == 0) {
                                        $dm[0] = " selected=selected";
                                    } else {
                                        $dmod = explode("@", $it['damage_mod']);
                                        switch ($dmod[0]) {
                                            case 1:
                                                $dm[1] = " selected=selected";
                                                break;
                                            case 2:
                                                $dm[2] = " selected=selected";
                                                break;
                                            case 3:
                                                $dm[3] = " selected=selected";
                                                break;
                                            case 4:
                                                $dm[4] = " selected=selected";
                                                break;
                                        }
                                    }
                                    $immunes = explode("|", $it['immunes']);
                                    foreach ($immunes as $key => $val) {
                                        switch ($key) {
                                            case 0: //огонь
                                                switch ($val) {
                                                    case 0:
                                                        $fire[$val] = " selected=selected";
                                                        break;
                                                    case 1:
                                                        $fire[$val] = " selected=selected";
                                                        break;
                                                }
                                                break;
                                            case 1: //лед
                                                switch ($val) {
                                                    case 0:
                                                        $ice[$val] = " selected=selected";
                                                        break;
                                                    case 1:
                                                        $ice[$val] = " selected=selected";
                                                        break;
                                                }
                                                break;
                                            case 2://вампир
                                                switch ($val) {
                                                    case 0:
                                                        $vamp[$val] = " selected=selected";
                                                        break;
                                                    case 1:
                                                        $vamp[$val] = " selected=selected";
                                                        break;
                                                }
                                                break;
                                            case 3: //яд
                                                switch ($val) {
                                                    case 0:
                                                        $poison[$val] = " selected=selected";
                                                        break;
                                                    case 1:
                                                        $poison[$val] = " selected=selected";
                                                        break;
                                                }
                                                break;
                                            case 4: //физ. урон
                                                switch ($val) {
                                                    case 0:
                                                        $phys[$val] = " selected=selected";
                                                        break;
                                                    case 1:
                                                        $phys[$val] = " selected=selected";
                                                        break;
                                                }
                                                break;
                                        }
                                    }
                                    ?>

                                    &nbsp; Слот: <select name="slot">
                                        <option value="0"<?= $w[0] ?>>Нельзя одеть</option>
                                        <option value="1"<?= $w[1] ?>>Шлем</option>
                                        <option value="2"<?= $w[2] ?>>Ожерелье</option>
                                        <option value="3"<?= $w[3] ?>>Оружие</option>
                                        <option value="4"<?= $w[4] ?>>Пояс</option>
                                        <option value="5"<?= $w[5] ?>>Содержимое карманов пояса</option>
                                        <option value="8"<?= $w[8] ?>>Слот для сапог</option>
                                        <option value="9"<?= $w[9] ?>>Поножи</option>
                                        <option value="10"<?= $w[10] ?>>Наплечники</option>
                                        <option value="11"<?= $w[11] ?>>Наручи</option>
                                        <option value="12"<?= $w[12] ?>>Перчатки</option>
                                        <option value="13"<?= $w[13] ?>>Щит</option>
                                        <option value="14"<?= $w[14] ?>>Кольцо</option>
                                        <option value="16"<?= $w[16] ?>>Броня</option>
                                        <option value="17"<?= $w[17] ?>>Кольчуга</option>
                                        <option value="20"<?= $w[20] ?>>Руна</option>
                                    </select> эффект: <input name="effect" type="text" value="<?= $it['effect'] ?>"/>
                                    <br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td>
                            <td><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3</td>
                        </tr>
                        <tr>
                            <td colspan=2 width=100%>
                                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                                    <tr>
                                        <td width=50% bgcolor=#D8CDAF>
                                            <div align=center><font class=invtitle>свойства</div>
                                        </td>
                                        <td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1
                                                                 height=1></td>
                                        <td bgcolor=#D8CDAF width=50%>
                                            <div align=center><font class=invtitle>требования</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" bgcolor="#FCFAF3"><font class=weaponch><b><label>Цена</label>
                                                    <input name="price" type="text"
                                                           value="<?= $it['price'] ?>"/>&nbsp;<label>Цена
                                                        ДД</label>&nbsp;<input name="dd_price" type="text"
                                                                               value="<?= $it['dd_price'] ?>"/><br>
                                                    ---------------------------------------------------------------<br>
                                                    &nbsp;<label>Дополнительный урон (только если выбран мод, пример
                                                        20-30)</label><br>
                                                    <select name="damage_mod">
                                                        <option value="0"<?= $dm[0] ?>>Без мода</option>
                                                        <option value="1"<?= $dm[1] ?>>Урон огнем</option>
                                                        <option value="2"<?= $dm[2] ?>>Урон льдом</option>
                                                        <option value="3"<?= $dm[3] ?>>Вампиризм</option>
                                                        <option value="4"<?= $dm[4] ?>>Лечение</option>
                                                    </select>
                                                    &nbsp;<input name="damage_mod_val" type="text"
                                                                 value="<?= $dmod[1] ?>"/><br>
                                                    ---------------------------------------------------------------<br>
                                                    &nbsp;<label>Иммунитет к Огню</label>
                                                    <select name="fire_immune">
                                                        <option value="0"<?= $fire[0] ?>>Нет</option>
                                                        <option value="1"<?= $fire[1] ?>>Да</option>
                                                    </select><br>
                                                    &nbsp;<label>Иммунитет ко Льду</label>
                                                    <select name="ice_immune">
                                                        <option value="0"<?= $ice[0] ?>>Нет</option>
                                                        <option value="1"<?= $ice[1] ?>>Да</option>
                                                    </select><br>
                                                    &nbsp;<label>Иммунитет к Вампиризму</label>
                                                    <select name="vamp_immune">
                                                        <option value="0"<?= $vamp[0] ?>>Нет</option>
                                                        <option value="1"<?= $vamp[1] ?>>Да</option>
                                                    </select><br>
                                                    &nbsp;<label>Иммунитет к Яду</label>
                                                    <select name="poison_immune">
                                                        <option value="0"<?= $poison[0] ?>>Нет</option>
                                                        <option value="1"<?= $poison[1] ?>>Да</option>
                                                    </select><br>
                                                    &nbsp;<label>Иммунитет к Физ.Урону</label>
                                                    <select name="phys_immune">
                                                        <option value="0"<?= $phys[0] ?>>Нет</option>
                                                        <option value="1"<?= $phys[1] ?>>Да</option>
                                                    </select><br>
                                                    ---------------------------------------------------------------<br>
                                                    <?

                                                    $param = explode("|", $it['param']);
                                                    foreach ($param as $value) {
                                                        $stat = explode("@", $value);
                                                        $par[$stat[0]] = $stat[1];
                                                    }
                                                    for ($i = 0; $i <= 71; $i++) {
                                                        switch ($i) {
                                                            case 1:
                                                                $fr = "Удар (пример 20-30):";
                                                                break;
                                                            case 2:
                                                                $fr = "Долговечность:";
                                                                break;
                                                            case 3:
                                                                $fr = "Карманов(3 max для поясов):";
                                                                break;
                                                            case 4:
                                                                $fr = "Материал:";
                                                                break;
                                                            case 5:
                                                                $fr = "Уловка:";
                                                                break;
                                                            case 6:
                                                                $fr = "Точность:";
                                                                break;
                                                            case 7:
                                                                $fr = "Сокрушение:";
                                                                break;
                                                            case 8:
                                                                $fr = "Стойкость:";
                                                                break;
                                                            case 9:
                                                                $fr = "Класс брони:";
                                                                break;
                                                            case 10:
                                                                $fr = "Пробой брони:";
                                                                break;
                                                            case 11:
                                                                $fr = "Пробой колющим ударом:";
                                                                break;
                                                            case 12:
                                                                $fr = "Пробой режущим ударом:";
                                                                break;
                                                            case 13:
                                                                $fr = "Пробой проникающим ударом:";
                                                                break;
                                                            case 14:
                                                                $fr = "Пробой пробивающим ударом:";
                                                                break;
                                                            case 15:
                                                                $fr = "Пробой рубящим ударом:";
                                                                break;
                                                            case 16:
                                                                $fr = "Пробой карающим ударом:";
                                                                break;
                                                            case 17:
                                                                $fr = "Пробой отсекающим ударом:";
                                                                break;
                                                            case 18:
                                                                $fr = "Пробой дробящим ударом:";
                                                                break;
                                                            case 19:
                                                                $fr = "Защита от колющих ударов:";
                                                                break;
                                                            case 20:
                                                                $fr = "Защита от режущих ударов:";
                                                                break;
                                                            case 21:
                                                                $fr = "Защита от проникающих ударов:";
                                                                break;
                                                            case 22:
                                                                $fr = "Защита от пробивающих ударов:";
                                                                break;
                                                            case 23:
                                                                $fr = "Защита от рубящих ударов:";
                                                                break;
                                                            case 24:
                                                                $fr = "Защита от карающих ударов:";
                                                                break;
                                                            case 25:
                                                                $fr = "Защита от отсекающих ударов:";
                                                                break;
                                                            case 26:
                                                                $fr = "Защита от дробящих ударов:";
                                                                break;
                                                            case 27:
                                                                $fr = "НР:";
                                                                break;
                                                            case 28:
                                                                $fr = "Очки действия:";
                                                                break;
                                                            case 29:
                                                                $fr = "Мана:";
                                                                break;
                                                            case 30:
                                                                $fr = "Мощь:";
                                                                break;
                                                            case 31:
                                                                $fr = "Проворность:";
                                                                break;
                                                            case 32:
                                                                $fr = "Везение:";
                                                                break;
                                                            case 33:
                                                                $fr = "Здоровье:";
                                                                break;
                                                            case 34:
                                                                $fr = "Разум:";
                                                                break;
                                                            case 35:
                                                                $fr = "Сноровка:";
                                                                break;
                                                            case 36:
                                                                $fr = "Влад. мечами:";
                                                                break;
                                                            case 37:
                                                                $fr = "Влад. топорами:";
                                                                break;
                                                            case 38:
                                                                $fr = "Влад. дробящим оружием:";
                                                                break;
                                                            case 39:
                                                                $fr = "Влад. ножами:";
                                                                break;
                                                            case 40:
                                                                $fr = "Влад. метательным оружием:";
                                                                break;
                                                            case 41:
                                                                $fr = "Влад. алебардами и копьями:";
                                                                break;
                                                            case 42:
                                                                $fr = "Влад. посохами:";
                                                                break;
                                                            case 43:
                                                                $fr = "Влад. экзотическим оружием:";
                                                                break;
                                                            case 44:
                                                                $fr = "Влад. двуручным оружием:";
                                                                break;
                                                            case 99:
                                                                $fr = "testТут:";
                                                                break;
                                                            case 46:
                                                                $fr = "Магия воды:";
                                                                break;
                                                            case 47:
                                                                $fr = "Магия воздуха:";
                                                                break;
                                                            case 48:
                                                                $fr = "Магия земли:";
                                                                break;
                                                            case 49:
                                                                $fr = "Сопротивление магии огня:";
                                                                break;
                                                            case 50:
                                                                $fr = "Сопротивление магии воды:";
                                                                break;
                                                            case 51:
                                                                $fr = "Сопротивление магии воздуха:";
                                                                break;
                                                            case 52:
                                                                $fr = "Сопротивление магии земли:";
                                                                break;
                                                            case 53:
                                                                $fr = "Воровство:";
                                                                break;
                                                            case 54:
                                                                $fr = "Осторожность:";
                                                                break;
                                                            case 55:
                                                                $fr = "Скрытность:";
                                                                break;
                                                            case 56:
                                                                $fr = "Наблюдательность:";
                                                                break;
                                                            case 57:
                                                                $fr = "Торговля:";
                                                                break;
                                                            case 58:
                                                                $fr = "Странник:";
                                                                break;
                                                            case 59:
                                                                $fr = "Рыболов:";
                                                                break;
                                                            case 60:
                                                                $fr = "Лесоруб:";
                                                                break;
                                                            case 61:
                                                                $fr = "Ювелирное дело:";
                                                                break;
                                                            case 62:
                                                                $fr = "Самолечение:";
                                                                break;
                                                            case 63:
                                                                $fr = "Оружейник:";
                                                                break;
                                                            case 64:
                                                                $fr = "Доктор:";
                                                                break;
                                                            case 65:
                                                                $fr = "Самолечение:";
                                                                break;
                                                            case 66:
                                                                $fr = "Быстрое восстановление маны:";
                                                                break;
                                                            case 67:
                                                                $fr = "Лидерство:";
                                                                break;
                                                            case 68:
                                                                $fr = "Алхимия:";
                                                                break;
                                                            case 69:
                                                                $fr = "Развитие горного дела:";
                                                                break;
                                                            case 70:
                                                                $fr = "Травничество:";
                                                                break;
                                                            case 71:
                                                                $fr = "Коэффициент:";
                                                                break;
                                                        }
                                                        if ($fr != "") echo '<label><font class=weaponch><b>' . $fr . '</b></font></label><input name=pr[' . $i . '] type=text value="' . $par[$i] . '"/><br>';
                                                    }
                                                    echo '<label><font class=weaponch><b>Бонус опыта (в %)</b></font></label><input name=pr[expbonus] type=text value="' . $par['expbonus'] . '"><br>';
                                                    echo '<label><font class=weaponch><b>Бонус массы</b></font></label><input name=pr[massbonus] type=text value="' . $par['massbonus'] . '"><br>';
                                                    ?>

                                        </td>
                                        <td bgcolor=#B9A05C><img src=http://img.Fight4Life.ru/image/1x1.gif width=1
                                                                 height=1></td>
                                        <td align="right" valign="top" bgcolor="#FCFAF3"><font
                                                    class=weaponch><b><label>Уровень:</label>
                                                    <input name="level" type="text"
                                                           value="<?= $it['level'] ?>"/><br><font
                                                            class=weaponch><b><label>Масса:</label>
                                                            <input name="massa" type="text"
                                                                   value="<?= $it['massa'] ?>"/><br>
                                                            <font class=weaponch><b><label>Срок годности вещи (в
                                                                        днях)<i>0 - без
                                                                            срока</i>:</label>
                                                                    <input name="srok" type="text"
                                                                           value="<?= $it['srok'] ?>"/><br>
                                                                    <?

                                                                    $need = explode("|", $it['need']);
                                                                    foreach ($need as $value) {
                                                                        $stat = explode("@", $value);
                                                                        $ned[$stat[0]] = $stat[1];
                                                                    }
                                                                    for ($i = 28; $i <= 74; $i++) {
                                                                        switch ($i) {
                                                                            case 28:
                                                                                $fr = "Очки действия:";
                                                                                break;
                                                                            case 29:
                                                                                $fr = "";
                                                                                break;
                                                                            case 30:
                                                                                $fr = "Мощь:";
                                                                                break;
                                                                            case 31:
                                                                                $fr = "Проворность:";
                                                                                break;
                                                                            case 32:
                                                                                $fr = "Везение:";
                                                                                break;
                                                                            case 33:
                                                                                $fr = "Здоровье:";
                                                                                break;
                                                                            case 34:
                                                                                $fr = "Разум:";
                                                                                break;
                                                                            case 35:
                                                                                $fr = "Сноровка:";
                                                                                break;
                                                                            case 36:
                                                                                $fr = "Влад. мечами:";
                                                                                break;
                                                                            case 37:
                                                                                $fr = "Влад. топорами:";
                                                                                break;
                                                                            case 38:
                                                                                $fr = "Влад. дробящим оружием:";
                                                                                break;
                                                                            case 39:
                                                                                $fr = "Влад. ножами:";
                                                                                break;
                                                                            case 40:
                                                                                $fr = "Влад. метательным оружием:";
                                                                                break;
                                                                            case 41:
                                                                                $fr = "Влад. алебардами и копьями:";
                                                                                break;
                                                                            case 42:
                                                                                $fr = "Влад. посохами:";
                                                                                break;
                                                                            case 43:
                                                                                $fr = "Влад. экзотическим оружием:";
                                                                                break;
                                                                            case 44:
                                                                                $fr = "Влад. двуручным оружием:";
                                                                                break;
                                                                            case 45:
                                                                                $fr = "Магия огня:";
                                                                                break;
                                                                            case 46:
                                                                                $fr = "Магия воды:";
                                                                                break;
                                                                            case 47:
                                                                                $fr = "Магия воздуха:";
                                                                                break;
                                                                            case 48:
                                                                                $fr = "Магия земли:";
                                                                                break;
                                                                            case 49:
                                                                                $fr = "";
                                                                                break;
                                                                            case 50:
                                                                                $fr = "";
                                                                                break;
                                                                            case 51:
                                                                                $fr = "";
                                                                                break;
                                                                            case 52:
                                                                                $fr = "";
                                                                                break;
                                                                            case 53:
                                                                                $fr = "Воровство:";
                                                                                break;
                                                                            case 54:
                                                                                $fr = "Осторожность:";
                                                                                break;
                                                                            case 55:
                                                                                $fr = "Скрытность:";
                                                                                break;
                                                                            case 56:
                                                                                $fr = "Наблюдательность:";
                                                                                break;
                                                                            case 57:
                                                                                $fr = "Торговля:";
                                                                                break;
                                                                            case 58:
                                                                                $fr = "Странник:";
                                                                                break;
                                                                            case 59:
                                                                                $fr = "Рыболов:";
                                                                                break;
                                                                            case 60:
                                                                                $fr = "Лесоруб:";
                                                                                break;
                                                                            case 61:
                                                                                $fr = "Ювелирное дело:";
                                                                                break;
                                                                            case 62:
                                                                                $fr = "Самолечение:";
                                                                                break;
                                                                            case 63:
                                                                                $fr = "Оружейник:";
                                                                                break;
                                                                            case 64:
                                                                                $fr = "Доктор:";
                                                                                break;
                                                                            case 65:
                                                                                $fr = "Самолечение:";
                                                                                break;
                                                                            case 66:
                                                                                $fr = "Быстрое восстановление маны:";
                                                                                break;
                                                                            case 67:
                                                                                $fr = "Лидерство:";
                                                                                break;
                                                                            case 68:
                                                                                $fr = "Алхимия:";
                                                                                break;
                                                                            case 69:
                                                                                $fr = "Развитие горного дела:";
                                                                                break;
                                                                            case 70:
                                                                                $fr = "Травничество:";
                                                                                break;
                                                                            case 73:
                                                                                $fr = "Звание:";
                                                                                break;
                                                                            case 74:
                                                                                $fr = "Взломщик:";
                                                                                break;
                                                                        }
                                                                        if ($fr != "") echo "<label><font class=weaponch><b>$fr</b></font></label><input name=tr[$i] type=text value=\"$ned[$i]\"/><br>\n";
                                                                    }
                                                                    ?>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div align="center">
            <input name="smb4" type="submit" class="lbut" value="Сохранить"/> <input name="smb1" type="submit"
                                                                                     class="lbut"
                                                                                     value="Сохранить как новый"/>
        </div>
    </form>
    <div align="center">
        <p><br>
            <? }
            }
            $smb1 = $smb1 ?? varcheck($_POST['smb1']) ?? varcheck($_GET['smb1']) ?? '';
            if ($smb1) {
                for ($i = 1; $i <= 71; $i++) {
                    if ($pr[$i] != "") {
                        $par .= "$i@$pr[$i]|";
                    }
                }
                if ($pr['expbonus'] != "") {
                    $par .= "expbonus@$pr[expbonus]|";
                }
                if ($pr['massbonus'] != "") {
                    $par .= "massbonus@$pr[massbonus]|";
                }

                $par = substr_replace($par, '', -1);
                $massa = $massa ?? varcheck($_POST['massa']) ?? varcheck($_GET['massa']) ?? '';
                $level = $level ?? varcheck($_POST['level']) ?? varcheck($_GET['level']) ?? '';
                $damage_mod = $damage_mod ?? varcheck($_POST['damage_mod']) ?? varcheck($_GET['damage_mod']) ?? '';
                $damage_mod_val = $damage_mod_val ?? varcheck($_POST['damage_mod_val']) ?? varcheck($_GET['damage_mod_val']) ?? '';
                $fire_immune = $fire_immune ?? varcheck($_POST['fire_immune']) ?? varcheck($_GET['fire_immune']) ?? '';
                $ice_immune = $ice_immune ?? varcheck($_POST['ice_immune']) ?? varcheck($_GET['ice_immune']) ?? '';
                $vamp_immune = $vamp_immune ?? varcheck($_POST['vamp_immune']) ?? varcheck($_GET['vamp_immune']) ?? '';
                $poison_immune = $poison_immune ?? varcheck($_POST['poison_immune']) ?? varcheck($_GET['poison_immune']) ?? '';
                $phys_immune = $phys_immune ?? varcheck($_POST['phys_immune']) ?? varcheck($_GET['phys_immune']) ?? '';
                $acte = $acte ?? varcheck($_POST['acte']) ?? varcheck($_GET['acte']) ?? '';
                $num_a = $num_a ?? varcheck($_POST['num_a']) ?? varcheck($_GET['num_a']) ?? '';
                $dd_price = $dd_price ?? varcheck($_POST['dd_price']) ?? varcheck($_GET['dd_price']) ?? '';
                $effect = $effect ?? varcheck($_POST['effect']) ?? varcheck($_GET['effect']) ?? '';
                if ($massa != "") {
                    $need .= "71|";
                }
                if ($level != "") {
                    $need .= "72|";
                }
                for ($i = 28; $i <= 74; $i++) {

                    if ($tr[$i] != "") {
                        $need .= "$i@$tr[$i]|";
                    }
                }
                $need = substr_replace($need, '', -1);
                if ($damage_mod == 0) {
                    $insmod = 0;
                } elseif ($damage_mod_val == 0 or $damage_mod_val == '') {
                    $insmod = 0;
                } else {
                    $insmod = $damage_mod . "@" . $damage_mod_val;
                }
                $immunes_arr = ($fire_immune == 1 ? '1' : '0') . '|' . ($ice_immune == 1 ? '1' : '0') . '|' . ($vamp_immune == 1 ? '1' : '0') . '|' . ($poison_immune == 1 ? '1' : '0') . '|' . ($phys_immune == 1 ? '1' : '0');
                mysqli_query($GLOBALS['db_link'], 'INSERT INTO items (gif,name,block,2w,type,param,need,acte,num_a,level,price,dd_price,massa,slot,effect,srok,damage_mod,immunes) VALUES (' . AP . $gif . AP . ',' . AP . $name . AP . ',' . AP . $block . AP . ',' . AP . $wtor . AP . ',' . AP . $type . AP . ',' . AP . $par . AP . ',' . AP . $need . AP . ',' . AP . $acte . AP . ',' . AP . $num_a . AP . ',' . AP . $level . AP . ',' . AP . $price . AP . ',' . AP . $dd_price . AP . ',' . AP . $massa . AP . ',' . AP . $slot . AP . ',' . AP . $effect . AP . ',' . AP . $insmod . AP . ',' . AP . $srok . AP . ',' . AP . $immunes_arr . AP . ');');

                echo "<br><span class=prchattime>Предмет добавлен!</span></div>";


            }
            $smb2 = $smb2 ?? varcheck($_POST['smb2']) ?? varcheck($_GET['smb2']) ?? '';
            $mark = $mark ?? varcheck($_POST['mark']) ?? varcheck($_GET['mark']) ?? '';
            if ($smb2) {
                mysqli_query($GLOBALS['db_link'], 'INSERT INTO market (id,market,kol,ty) VALUES (' . AP . $id . AP . ',' . AP . $mark . AP . ',' . AP . $kol . AP . ',' . AP . $type . AP . ');');
                echo "<br><span class=prchattime>Предмет добавлен!</span></div>";
            }

            $smb4 = $smb4 ?? varcheck($_POST['smb4']) ?? varcheck($_GET['smb4']) ?? '';
            if ($smb4) {
                for ($i = 1; $i <= 71; $i++) {
                    if ($pr[$i] != "") {
                        $par .= "$i@$pr[$i]|";
                    }
                }
                if ($pr['expbonus'] != "") {
                    $par .= "expbonus@$pr[expbonus]|";
                }
                if ($pr['massbonus'] != "") {
                    $par .= "massbonus@$pr[massbonus]|";
                }
                $par = substr_replace($par, '', -1);
                if ($massa != "") {
                    $need .= "71|";
                }
                if ($level != "") {
                    $need .= "72|";
                }
                for ($i = 28; $i <= 74; $i++) {

                    if ($tr[$i] != "") {
                        $need .= "$i@$tr[$i]|";
                    }
                }
                $need = substr_replace($need, '', -1);
                if ($damage_mod == 0) {
                    $insmod = 0;
                } elseif ($damage_mod_val == 0 or $damage_mod_val == '') {
                    $insmod = 0;
                } else {
                    $insmod = $damage_mod . "@" . $damage_mod_val;
                }
                $immunes_arr = ($fire_immune == 1 ? '1' : '0') . '|' . ($ice_immune == 1 ? '1' : '0') . '|' . ($vamp_immune == 1 ? '1' : '0') . '|' . ($poison_immune == 1 ? '1' : '0') . '|' . ($phys_immune == 1 ? '1' : '0');
                mysqli_query($GLOBALS['db_link'], 'UPDATE items SET immunes=' . AP . $immunes_arr . AP . ',gif=' . AP . $gif . AP . ',name=' . AP . $name . AP . ',block=' . AP . $block . AP . ',2w=' . AP . $wtor . AP . ',type=' . AP . $type . AP . ',param=' . AP . $par . AP . ',need=' . AP . $need . AP . ',acte=' . AP . $acte . AP . ',num_a=' . AP . $num_a . AP . ',effect=' . AP . $effect . AP . ',level=' . AP . $level . AP . ',price=' . AP . $price . AP . ',dd_price=' . AP . $dd_price . AP . ',massa=' . AP . $massa . AP . ',slot=' . AP . $slot . AP . ',damage_mod=' . AP . $insmod . AP . ',srok=' . AP . $srok . AP . ' WHERE id=' . AP . $idit . AP . ';');

                echo "<br><span class=prchattime>Предмет Сохранен!</span></div>";
            }
            ?>

            <script>
                function img() {
                    n = document.additem;
                    var name = n.gif.value;
                    document.all("img").innerHTML = "<img src=\"http://img.legendbattles.ru/image/weapon/" + name + "\"  />";
                }

                function img2() {
                    n = document.edititem;
                    var name = n.gif.value;
                    document.all("img").innerHTML = "<img src=\"http://img.legendbattles.ru/image/weapon/" + name + "\"  />";
                }
            </script>
</body>
</html>
