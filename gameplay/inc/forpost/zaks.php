<?
foreach ($_POST as $keypost => $val) {
    $_POST[$keypost] = varcheck($val);
}
foreach ($_GET as $keyget => $val) {
    $_GET[$keyget] = varcheck($val);
}
?>
<?php
if (!empty($_POST['semija'])) {
    mysqli_query($GLOBALS['db_link'], "INSERT INTO zaks (male,female,status) VALUES ('" . $_POST['male'] . "','" . $_POST['female'] . "','0')");
    $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;&nbsp;</font> <font color=000000><b>Свидетельство о заявке на заключение брака</b></font><BR>'+'');";
    chmsg($ms, $_POST['male']);
    $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;&nbsp;</font> <font color=000000><b>Свидетельство о заявке на заключение брака</b></font><BR>'+'');";
    chmsg($ms, $_POST['female']);
    echo "Заявка на обвенчание подана успешно! ";
}

if (!empty($_POST['razvod'])) {
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `semija` = 'не женат' WHERE `login` = '" . $_POST['male'] . "'");
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `semija` = 'не замужем' WHERE `login` = '" . $_POST['female'] . "'");
    mysqli_query($GLOBALS['db_link'], "DELETE FROM zaks WHERE male='" . $_POST['male'] . "' AND female='" . $_POST['female'] . "'");
    $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;&nbsp;</font> <font class=massm>&nbsp;&nbsp;<b>Развелись</b>&nbsp;&nbsp;</font>: Распался брак   " . $_POST['male'] . " и " . $_POST['female'] . ".<BR>'+'');";
    chmsg($ms);
    echo "Развод прошол успешно! ";
}
if ($player['login'] == 'Администрация' AND $_POST['status']) {
    mysqli_query($GLOBALS['db_link'], "UPDATE zaks SET status='" . $_POST['status'] . "' WHERE id='" . $_POST['id'] . "'");
    $zk = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM zaks WHERE id='" . $_POST['id'] . "'"));
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `semija` = '" . (($_POST['status'] == 0) ?: $zk['female']) . "' WHERE `login` = '" . $zk['male'] . "'");
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `semija` = '" . (($_POST['status'] == 0) ?: $zk['male']) . "' WHERE `login` = '" . $zk['female'] . "'");
    $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;&nbsp;</font> <font class=massm>&nbsp;&nbsp;<b>Поздравляем молодоженов</b>&nbsp;&nbsp;</font>: <img src=/img/image/chat/smiles/smiles_267.gif >  " . $zk['male'] . " взял замуж " . $zk['female'] . ".</font><img src=/img/image/rings.gif ><BR>'+'');";
    chmsg($ms);
    echo "Активно";
}
?>
<center>
    <table class=tbl1 border=0 align=center width=760>
        <tr>
            <th colspan=4 align=center>Дворец Бракосочетаний
        <tr>
            <td><img src=/img/image/gameplay/other/mar_city1.jpg width=760 height=255 border=0></td>
        </tr>
        </th></tr>
        <tr>
            <td><img src=/img/image/1x1.gif width=1 height=10></td>
        </tr>
    </table>

    <table class=tbl1 border=0 align=center width=760>
        <tr>
            <th colspan=4 align=center>Женится
        <tr>
            <td>
                <center>
                    <form method="post" action="">
                        Имя мужа <input type="text" name="male" value=""/>
                        Имя жены<input type="text" name="female" value=""/>
                        <input type="submit" name="semija" value="Обвенчать"/>
                    </form>
    </table>
    <?php
    if ($player['login'] == 'Администрация'){
    $zaks = mysqli_query($GLOBALS['db_link'], "SELECT * FROM zaks");
    ?>
    <table class=tbl1 border=0 align=center width=760>
        <tr>
            <th colspan=4 align=center>Развести
        <tr>
            <td>
                <center>
                    <form method="post" action="">
                        Имя мужа <input type="text" name="male" value=""/>
                        Имя жены<input type="text" name="female" value=""/>
                        <input type="submit" name="razvod" value="Развестись"/>
                    </form>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table class=tbl1 border=0 align=center width=760>
        <tr>
            <th colspan=4 align=center>Активация
        <tr>
            <td>
                <table width=100%>
                    <? while ($zk = mysqli_fetch_assoc($zaks)) {
                        ?>
                        <tr>
                            <td>Жених: <font color=green><?= $zk['male'] ?></td>
                            <td>Жена: <font color=green><?= $zk['female'] ?></td>
                            <td>
                                <form action="" method="POST"><input type="hidden" name="id"
                                                                     value="<?= $zk['id'] ?>"><select name="status">
                                        <option value="0">Ожидает подтверждения</option>
                                        <option value="1"<?= (($zk['status'] == 1) ? ' selected' : '') ?>>Активна
                                        </option>
                                    </select>
                            </td>
                            <td><input type="submit" value="Сохранить"></form></td>
                        </tr>
                        <?php
                    } ?>
                </table>
                </FIELDSET><? } ?></i></font></font></b></div></td>
        </tr>
        <tr>
            <td><img src=http://image.neverlands.ru/1x1.gif width=1 height=3></td>
        </tr>
        <tr>
            <td>
                <div align=right>
                    <SCRIPT language="JavaScript">
                        document.write(view_t());
                    </SCRIPT>
                </div>
            </td>
        </tr>
    </table>