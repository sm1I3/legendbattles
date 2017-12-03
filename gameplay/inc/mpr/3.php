<?php
if ($player['sex'] == "male") {
    $sex2 = "mal";
    $av = 100;
} else {
    $sex2 = "fem";
    $av = 150;
}
$col = explode("|", $player['obr_col']);
?>
<tr>
    <td>
        <form action=main.php?mselect=3 method=POST><input type=hidden name=post_id value=9>
            <font class=proce>
                <FIELDSET>
                    <LEGEND align=center><B><font color=gray>&nbsp;Настройка персонажа&nbsp;</font></B></LEGEND>
                    <table cellpadding=5 cellspacing=0 border=0 width=100%>
                        <tr>
                            <td>
                                <table cellpadding=0 cellspacing=2 border=0 width=100%>
                                    <?php echo '<tr>
            <td><font class=freemain><b><font color=#336699>Автообновление фрейма(раз в 60 секунд)</font></b></font></td>
            <td><div align=right>
              <select name=rframe class=LogintextBox6>
                <option value="0"' . (($player['rframe'] == 0) ? ' selected="selected"' : '') . '>Выключено</option>
                <option value="1"' . (($player['rframe'] == 1) ? ' selected="selected"' : '') . '>Включено</option>
              </select>
            </div></td>
          </tr>'; ?>
                                    <tr>
                                        <td><font class=freemain><b><font color=#336699>Сортировка списка чата</td>
                                        <td>
                                            <div align=right><select name=inf_sort class=LogintextBox6>
                                                    <option value=a_z <? if ($player[filt] == 'a_z') echo " SELECTED"; ?>>
                                                        a-z
                                                    </option>
                                                    <option value=z_a <? if ($player[filt] == 'z_a') echo " SELECTED"; ?>>
                                                        z-a
                                                    </option>
                                                    <option value=0_35 <? if ($player[filt] == '0_35') echo " SELECTED"; ?>>
                                                        0-35
                                                    </option>
                                                    <option value=35_0<? if ($player[filt] == '35_0') echo " SELECTED"; ?>>
                                                        35-0
                                                    </option>
                                                </select></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><font class=freemain><b><font color=#777777>Цвет сообщений в чате</b></font>
                                        </td>
                                        <td>
                                            <div align=right><font class=freemain><b>Текущий цвет: </font><font
                                                        style="background: #<?= $player[chcolor] ?>"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></font>
                                                <select class=LogintextBox name=newchatcolor>
                                                    <option value=000000 SELECTED style="BACKGROUND: #000000"></option>
                                                    <option value=FF3366 style="background: #FF3366"></option>
                                                    <option value=CC0033 style="background: #CC0033"></option>
                                                    <option value=FF3399 style="background: #FF3399"></option>
                                                    <option value=CC0066 style="background: #CC0066"></option>
                                                    <option value=FF6699 style="background: #FF6699"></option>
                                                    <option value=CC3366 style="background: #CC3366"></option>
                                                    <option value=990033 style="background: #990033"></option>
                                                    <option value=FF6633 style="background: #FF6633"></option>
                                                    <option value=CC3300 style="background: #CC3300"></option>
                                                    <option value=FF3300 style="background: #FF3300"></option>
                                                    <option value=FF6600 style="background: #FF6600"></option>
                                                    <option value=FF9966 style="background: #FF9966"></option>
                                                    <option value=CC6633 style="background: #CC6633"></option>
                                                    <option value=993300 style="background: #993300"></option>
                                                    <option value=FF9933 style="background: #FF9933"></option>
                                                    <option value=CC6600 style="background: #CC6600"></option>
                                                    <option value=FF9900 style="background: #FF9900"></option>
                                                    <option value=FF99CC style="background: #FF99CC"></option>
                                                    <option value=CC6699 style="background: #CC6699"></option>
                                                    <option value=993366 style="background: #993366"></option>
                                                    <option value=660033 style="background: #660033"></option>
                                                    <option value=FF66CC style="background: #FF66CC"></option>
                                                    <option value=CC3399 style="background: #CC3399"></option>
                                                    <option value=990066 style="background: #990066"></option>
                                                    <option value=FF33CC style="background: #FF33CC"></option>
                                                    <option value=CC0099 style="background: #CC0099"></option>
                                                    <option value=FF00CC style="background: #FF00CC"></option>
                                                    <option value=FF0099 style="background: #FF0099"></option>
                                                    <option value=FF0066 style="background: #FF0066"></option>
                                                    <option value=FF0033 style="background: #FF0033"></option>
                                                    <option value=FF0000 style="background: #FF0000"></option>
                                                    <option value=FF3333 style="background: #FF3333"></option>
                                                    <option value=CC0000 style="background: #CC0000"></option>
                                                    <option value=FF6666 style="background: #FF6666"></option>
                                                    <option value=CC3333 style="background: #CC3333"></option>
                                                    <option value=990000 style="background: #990000"></option>
                                                    <option value=FF9999 style="background: #FF9999"></option>
                                                    <option value=CC6666 style="background: #CC6666"></option>
                                                    <option value=993333 style="background: #993333"></option>
                                                    <option value=660000 style="background: #660000"></option>
                                                    <option value=CC9999 style="background: #CC9999"></option>
                                                    <option value=996666 style="background: #996666"></option>
                                                    <option value=663333 style="background: #663333"></option>
                                                    <option value=FFCC99 style="background: #FFCC99"></option>
                                                    <option value=CC9966 style="background: #CC9966"></option>
                                                    <option value=996633 style="background: #996633"></option>
                                                    <option value=663300 style="background: #663300"></option>
                                                    <option value=FFCC66 style="background: #FFCC66"></option>
                                                    <option value=CC9933 style="background: #CC9933"></option>
                                                    <option value=996600 style="background: #996600"></option>
                                                    <option value=FFCC33 style="background: #FFCC33"></option>
                                                    <option value=CC9900 style="background: #CC9900"></option>
                                                    <option value=FFCC00 style="background: #FFCC00"></option>
                                                    <option value=CC99FF style="background: #CC99FF"></option>
                                                    <option value=9966CC style="background: #9966CC"></option>
                                                    <option value=9966FF style="background: #9966FF"></option>
                                                    <option value=FFCCFF style="background: #FFCCFF"></option>
                                                    <option value=CC99CC style="background: #CC99CC"></option>
                                                    <option value=996699 style="background: #996699"></option>
                                                    <option value=663366 style="background: #663366"></option>
                                                    <option value=FF99FF style="background: #FF99FF"></option>
                                                    <option value=CC66CC style="background: #CC66CC"></option>
                                                    <option value=CC33CC style="background: #CC33CC"></option>
                                                    <option value=CC00CC style="background: #CC00CC"></option>
                                                    <option value=6666CC style="background: #6666CC"></option>
                                                    <option value=3333CC style="background: #3333CC"></option>
                                                    <option value=000099 style="background: #000099"></option>
                                                    <option value=000066 style="background: #000066"></option>
                                                    <option value=0000CC style="background: #0000CC"></option>
                                                    <option value=0000FF style="background: #0000FF"></option>
                                                    <option value=336633 style="background: #336633"></option>
                                                    <option value=339933 style="background: #339933"></option>
                                                    <option value=669966 style="background: #669966"></option>
                                                    <option value=009900 style="background: #009900"></option>
                                                    <option value=006600 style="background: #006600"></option>
                                                    <option value=00CC00 style="background: #00CC00"></option>
                                                    <option value=3300FF style="background: #3300FF"></option>
                                                    <option value=00CCCC style="background: #00CCCC"></option>
                                                    <option value=009999 style="background: #009999"></option>
                                                    <option value=33CCCC style="background: #33CCCC"></option>
                                                    <option value=006666 style="background: #006666"></option>
                                                    <option value=336699 style="background: #336699"></option>
                                                    <option value=003366 style="background: #003366"></option>
                                                    <option value=003399 style="background: #003399"></option>
                                                    <option value=0033CC style="background: #0033CC"></option>
                                                    <option value=3366FF style="background: #3366FF"></option>
                                                    <option value=336600 style="background: #336600"></option>
                                                    <option value=339900 style="background: #339900"></option>
                                                    <option value=33CC00 style="background: #33CC00"></option>
                                                    <option value=00CC33 style="background: #00CC33"></option>
                                                    <option value=00CCFF style="background: #00CCFF"></option>
                                                    <option value=33CCFF style="background: #33CCFF"></option>
                                                    <option value=0066CC style="background: #0066CC"></option>
                                                    <option value=6600FF style="background: #6600FF"></option>
                                                </select></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><input type=hidden name=vcode value=<?= scod() ?>><input
                                                    type=image src=http://img.legendbattles.ru/image/save.gif width=73
                                                    height=15 border=0></td>
                                    </tr></form>
        <?php
        if ($col[0] > 0){
        ?>
    <tr>
        <td colspan=2>
            <form action="main.php?mselect=3" method="POST">
                <input type=hidden name=post_id value=10>
                <input type=hidden name=act_id value=1>
                <input type=hidden name=vcode value=<?= scod() ?>>
                <table cellpadding=5 cellspacing=0 border=0 align=center>
                    <tr>
                        <td bgcolor=#CCCCCC>
                            <table cellpadding=5 cellspacing=0 border=0 align=center>
                                <?php
                                if ($player['sex'] == "male") {
                                    echo '<tr>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/100.jpg width=80 height=80 border=0><br><input type=radio name=ava value=100></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/101.jpg width=80 height=80 border=0><br><input type=radio name=ava value=101></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/102.jpg width=80 height=80 border=0><br><input type=radio name=ava value=102></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/103.jpg width=80 height=80 border=0><br><input type=radio name=ava value=103></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/104.jpg width=80 height=80 border=0><br><input type=radio name=ava value=104></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/105.jpg width=80 height=80 border=0><br><input type=radio name=ava value=105></td>
</tr>
<tr>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/106.jpg width=80 height=80 border=0><br><input type=radio name=ava value=106></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/107.jpg width=80 height=80 border=0><br><input type=radio name=ava value=107></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/108.jpg width=80 height=80 border=0><br><input type=radio name=ava value=108></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/109.jpg width=80 height=80 border=0><br><input type=radio name=ava value=109></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/110.jpg width=80 height=80 border=0><br><input type=radio name=ava value=110></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/111.jpg width=80 height=80 border=0><br><input type=radio name=ava value=111></td>
</tr>
<tr>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/112.jpg width=80 height=80 border=0><br><input type=radio name=ava value=112></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/113.jpg width=80 height=80 border=0><br><input type=radio name=ava value=113></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/114.jpg width=80 height=80 border=0><br><input type=radio name=ava value=114></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/115.jpg width=80 height=80 border=0><br><input type=radio name=ava value=115></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/116.jpg width=80 height=80 border=0><br><input type=radio name=ava value=116></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/117.jpg width=80 height=80 border=0><br><input type=radio name=ava value=117></td>
</tr>';
                                } else {
                                    echo '<tr>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/150.jpg width=80 height=80 border=0><br><input type=radio name=ava value=100></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/151.jpg width=80 height=80 border=0><br><input type=radio name=ava value=101></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/152.jpg width=80 height=80 border=0><br><input type=radio name=ava value=102></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/153.jpg width=80 height=80 border=0><br><input type=radio name=ava value=103></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/154.jpg width=80 height=80 border=0><br><input type=radio name=ava value=104></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/155.jpg width=80 height=80 border=0><br><input type=radio name=ava value=105></td>
</tr>
<tr>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/156.jpg width=80 height=80 border=0><br><input type=radio name=ava value=106></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/157.jpg width=80 height=80 border=0><br><input type=radio name=ava value=107></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/158.jpg width=80 height=80 border=0><br><input type=radio name=ava value=108></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/159.jpg width=80 height=80 border=0><br><input type=radio name=ava value=109></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/160.jpg width=80 height=80 border=0><br><input type=radio name=ava value=110></td>
<td align=center><img src=http://img.legendbattles.ru/image/forum/avatars/161.jpg width=80 height=80 border=0><br><input type=radio name=ava value=111></td>
</tr>';
                                }
                                ?>
                                <tr>
                                    <td colspan=6 align=center><input type=image
                                                                      src=http://img.legendbattles.ru/image/changeim.gif
                                                                      width=106 height=15 border=0></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
        </td>
    </tr></form>
<? } if ($col[1] > 0){ ?>
<td colspan=2>
    <form action=main.php?mselect=3 method=POST><input type=hidden name=post_id value=10><input type=hidden name=act_id
                                                                                                value=2><input
                type=hidden name=vcode value=<?= scod() ?>>
        <table cellpadding=15 cellspacing=0 border=0 align=center>
            <tr>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_0.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=0>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_1.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=1>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_2.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=2>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_3.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_4.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=4>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_5.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=5>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_6.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=6>
                    </div>
                </td>
                <td>
                    <div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?= $player['sex'] ?>_7.gif
                                           width=115 height=255 border=0><br><input type=radio name=selectob value=7>
                    </div>
                </td>
            </tr>
            <? /*
 <tr><td><div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?=$player['sex']?>_8.gif width=115 height=255 border=0><br><input type=radio name=selectob value=8></div></td>
 <td><div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?=$player['sex']?>_9.gif width=115 height=255 border=0><br><input type=radio name=selectob value=9></div></td>
 <td><div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?=$player['sex']?>_10.gif width=115 height=255 border=0><br><input type=radio name=selectob value=10></div></td>
 <td><div align=center><img src=http://img.legendbattles.ru/image/obrazy/<?=$player['sex']?>_11.gif width=115 height=255 border=0><br><input type=radio name=selectob value=11></div></td></tr>
 */ ?>
            <tr>
                <td colspan=4>
                    <div align=center><input type=image src=http://img.legendbattles.ru/image/changeim.gif width=106
                                             height=15 border=0></div>
                </td>
            </tr>
        </table>
</td></tr></form>
<?php
}
?></table></td></tr></table></FIELDSET></td></tr>
