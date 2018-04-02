<? if ($player['free_stat'] > 0) {
    $mselect = $mselect ?? varcheck($_POST['mselect']) ?? varcheck($_GET['mselect']) ?? ''; ?>
    <tr>
    <td colspan=5>
        <table cellpadding=3 cellspacing=0 border=0 width=100%>
            <FORM id="FSaveStats" action=main.php method=POST><INPUT TYPE=hidden name=post_id value=15><INPUT
                        TYPE=hidden name=act_id value=0><INPUT TYPE=hidden name=vcode value=<?= scode() ?>><INPUT
                        TYPE=hidden id=freestats name=freestats value=<?= $player['free_stat'] ?>><INPUT TYPE=hidden
                                                                                                         id=h0
                                                                                                         value=<?= $plstt[30] ?>><INPUT
                        TYPE=hidden id=f0 name=f0 value=0><INPUT TYPE=hidden id=h1 value=<?= $plstt[31] ?>><INPUT
                        TYPE=hidden id=f1 name=f1 value=0><INPUT TYPE=hidden id=h2 value=<?= $plstt[32] ?>><INPUT
                        TYPE=hidden id=f2 name=f2 value=0><INPUT TYPE=hidden id=h3 value=<?= $plstt[34] ?>><INPUT
                        TYPE=hidden id=f3 name=f3 value=0><INPUT TYPE=hidden id=h4 value=<?= $plstt[33] ?>><INPUT
                        TYPE=hidden id=f4 name=f4 value=0><INPUT TYPE=hidden name=mselect value="<?= $mselect ?>">
                <tr>
                    <td><font class=nickname><b>
                                <div align=center id=frdiv>Новые повышения: <font
                                            color=#006600><?= $player['free_stat'] ?></font></div>
                            </b></font></font></td>
                </tr>
            </FORM>
        </table>
    </td></tr><? } ?>
