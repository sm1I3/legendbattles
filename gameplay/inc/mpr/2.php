<SCRIPT src="./js/addperk.js"></SCRIPT>
<? if($player[perk]==''){$player[perk]="|||||||||||||||||||||||||||||";}
$perk=explode("|",$player[perk]);foreach($perk as $key=>$val){if($val=='')$perk[$key]=0;}

?>

<tr><td>
<font class=proce><font color=#222222>
<FIELDSET>
    <LEGEND align=center><B><font color=gray>&nbsp;Навыки и призвания&nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td    bgcolor=#E0D6BB>
<table cellpadding=2 cellspacing=1 border=0 width=100%>
<FORM action=main.php?mselect=2 name=saveperk method=POST><tr><td colspan=4 bgcolor=#FCFAF3>
            <table cellpadding=0 cellspacing=0 border=0 width=100%>
                <tr>
                    <td width=100%><font class=proce><font color=#222222>
                                <div align=center><b>Ваши игровые навыки</b></div>
                            </font></font></td>
                    <td><a href="javascript:parent.helpwin('forum.lifeiswar.ru/14/1/502/1/')"><img
                                    src=https://img.lifeiswar.ru/image/help/6.gif width=15 height=15 border=0
                                    title="Помощь" align=absmiddle></a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[0] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('0');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('0');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Зоркость в крови</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p0><? if ($perk[0] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[0] value=<?= $perk[0] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[1] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('1');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('1');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Горное дело</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p1><? if ($perk[1] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[1] value=<?= $perk[1] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[2] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('2');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('2');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Натуралист</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p2><? if ($perk[2] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[2] value=<?= $perk[2] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[3] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('3');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('3');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Сильная спина</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p3><? if ($perk[3] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[3] value=<?= $perk[3] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[4] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('4');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('4');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Призрак</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p4><? if ($perk[4] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[4] value=<?= $perk[4] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[5] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('5');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('5');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Прилив адреналина</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p5><? if ($perk[5] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[5] value=<?= $perk[5] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[6] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('6');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('6');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Понимание</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p6><? if ($perk[6] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[6] value=<?= $perk[6] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[7] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('7');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('7');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Больше силы</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p7><? if ($perk[7] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[7] value=<?= $perk[7] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[8] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('8');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('8');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Больше здоровья</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p8><? if ($perk[8] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[8] value=<?= $perk[8] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[9] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('9');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('9');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Больше ловкости</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p9><? if ($perk[9] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[9] value=<?= $perk[9] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[10] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('10');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('10');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Больше удачи</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p10><? if ($perk[10] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[10] value=<?= $perk[10] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[11] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('11');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('11');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Больше знаний</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p11><? if ($perk[11] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[11] value=<?= $perk[11] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[12] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('12');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('12');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Бросок</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p12><? if ($perk[12] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[12] value=<?= $perk[12] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[13] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('13');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('13');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Игрок</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p13><? if ($perk[13] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[13] value=<?= $perk[13] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[14] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('14');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('14');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Анатомия</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p14><? if ($perk[14] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[14] value=<?= $perk[14] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[15] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('15');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('15');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Устойчивый боец</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p15><? if ($perk[15] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[15] value=<?= $perk[15] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[16] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('16');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('16');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Рукопашный бой</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p16><? if ($perk[16] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[16] value=<?= $perk[16] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[17] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('17');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('17');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Безмолвная смерть</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p17><? if ($perk[17] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[17] value=<?= $perk[17] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[18] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('18');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('18');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Продление жизни</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p18><? if ($perk[18] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[18] value=<?= $perk[18] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[19] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('19');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('19');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Изворотливость</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p19><? if ($perk[19] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[19] value=<?= $perk[19] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[20] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('20');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('20');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Пожиратель змей</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p20><? if ($perk[20] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[20] value=<?= $perk[20] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[21] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('21');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('21');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Карманник</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p21><? if ($perk[21] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[21] value=<?= $perk[21] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[22] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('22');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('22');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Дитя природы</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p22><? if ($perk[22] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[22] value=<?= $perk[22] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[23] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('23');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('23');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Дитя города</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p23><? if ($perk[23] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[23] value=<?= $perk[23] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[24] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('24');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('24');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Маг Воды</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p24><? if ($perk[24] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[24] value=<?= $perk[24] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[25] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('25');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('25');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Маг Воздуха</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p25><? if ($perk[25] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[25] value=<?= $perk[25] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[26] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('26');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('26');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Маг Земли</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p26><? if ($perk[26] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[26] value=<?= $perk[26] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[27] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('27');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('27');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Маг Огня</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p27><? if ($perk[27] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[27] value=<?= $perk[27] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[28] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('28');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('28');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Сопротивление магии огня</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p28><? if ($perk[28] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[28] value=<?= $perk[28] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[29] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('29');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('29');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Сопротивление магии воды</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p29><? if ($perk[29] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[29] value=<?= $perk[29] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[30] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('30');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('30');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Сопротивление магии воздуха</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p30><? if ($perk[30] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[30] value=<?= $perk[30] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[31] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('31');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('31');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=red>•</font> Сопротивление магии земли</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p31><? if ($perk[31] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[31] value=<?= $perk[31] ?>></tr>
    <tr>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($perk[32] == 0 and $player[nav] > 0) { ?><a
                            href="javascript: AddPerk('32');" style="text-decoration: none"><font
                                style="text-decoration: none"><img src="https://img.lifeiswar.ru/image/+.gif"></a> <a
                            href="javascript: RemovePerk('32');" style="text-decoration: none"><font
                                style="text-decoration: none"><img
                                    src="https://img.lifeiswar.ru/image/-.gif"></a><? } else {
                        echo "<img src=https://img.lifeiswar.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                    } ?> <font color=green>•</font> Толстокожий</td>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                    <div align=center id=p32><? if ($perk[32] == 0) {
                            echo "нет";
                        } else {
                            echo "<b>да</b>";
                        } ?></div></td>
        <input type=hidden name=f[32] value=<?= $perk[32] ?>>
        <td bgcolor=#FCFAF3><font class=proce><font color=#555555><? if ($player[nav] > 0){ ?>
                    <div align=center><a href="javascript: document.saveperk.submit();"><font class=freemain><font
                                        color=#3564A5><b>Сохранить</a></div><? } ?></td>
        <td bgcolor=#FCFAF3></td>
    </tr>
    <tr>
        <td colspan=4><font class=proce><font color=#222222><b>
                        <div align=center id=frpediv>Возможные новые навыки: <?= $player[nav] ?></div>
                    </b></font></font></td>
    </tr>
    <INPUT TYPE=hidden name=vcode value=<?= scode() ?>><INPUT TYPE=hidden name=post_id value=17><INPUT TYPE=hidden
                                                                                                       name=currnav
                                                                                                       value=<?= $player[nav] ?>>
</FORM>
</table>
    </td>
</tr>
</td></tr></table></FIELDSET>
</td></tr>
