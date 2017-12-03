<tr>
    <td><font class=proce>
            <font class=proce>
                <FIELDSET>
                    <LEGEND align=center><B><font color=gray>&nbsp;Отчет по входам в игру&nbsp;</font></B></LEGEND>
                    <table cellpadding=0 cellspacing=0 border=0 width=100%>
                        <tr>
                            <td>
                                <table cellpadding=5 cellspacing=0 border=0 width=100%>
                                    <tr>
                                        <td>
                                            <table cellpadding=3 cellspacing=1 border=0 align=center>

                                                <tr>
                                                    <td colspan=4 align=center class=ftit>Отчет по 30 последним заходам
                                                        игрока в игру.
                                                    </td>
                                                </tr>
                                                <? $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM mlog WHERE typ='1' and login='" . $player[login] . "' ORDER BY time DESC LIMIT 0,30;");
                                                $col = array(0 => "FCFAF3", "FCFAF3");
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    if ($row[action] == "err: пароль") $row[action] = "<font color=#FF0000><b>err: пароль</b></font>";
                                                    ?>
                                                    <tr>
                                                        <td class=freetxt nowrap
                                                            bgcolor=#<?= $col[$i] ?>><?= $row['time'] ?></td>
                                                        <td class=freetxt nowrap align=center bgcolor=#<?= $col[$i] ?>>
                                                            <B><?= $row[action] ?></B></td>
                                                        <td class=freetxt align=center
                                                            bgcolor=#<?= $col[$i] ?>><?= $row[ip] ?></td>
                                                        <td class=freetxt bgcolor=#<?= $col[$i] ?>
                                                            align=center><?= $row[brouser] ?></td>
                                                    </tr>
                                                    <? if ($i == 0) {
                                                        $i++;
                                                    } else {
                                                        $i = 0;
                                                    }
                                                } ?></table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                </FIELDSET>
    </td>
</tr>
