<? if($player['umen']==''){$player['umen']="||||||||||||||||||||||||||||||||||||";}
$pt=allparam($player);
$um=explode("|",$player['umen']);
foreach($um as $key=>$val){	
	if($key>=1 and $key<=9){		
		$ptkey=$key+35;
		if($val==''){$um[$key]=0;}
		if($pt[$ptkey]==''){$umt[$key]='000';$um[$key]=0;}
		else if($pt[$ptkey] < 10){$umt[$key] = '00'.$pt[$ptkey];}
		else if($pt[$ptkey] < 100){$umt[$key] = '0'.$pt[$ptkey];}
		else{$umt[$key]=$pt[$ptkey];}
	}
	else if($key>=21 and $key<=23){	
		$ptkey=$key+32;	
		if($val==''){$um[$key]=0;}
		if($pt[$ptkey]==''){$umt[$key]='000';$um[$key]=0;}
		else if($pt[$ptkey] < 10){$umt[$key] = '00'.$pt[$ptkey];}
		else if($pt[$ptkey] < 100){$umt[$key] = '0'.$pt[$ptkey];}
		else{$umt[$key]=$pt[$ptkey];}
	}
	else if($key>=25 and $key<=26){		
		$ptkey=$key+32;	
		if($val==''){$um[$key]=0;}
		if($pt[$ptkey]==''){$umt[$key]='000';$um[$key]=0;}
		else if($pt[$ptkey] < 10){$umt[$key] = '00'.$pt[$ptkey];}
		else if($pt[$ptkey] < 100){$umt[$key] = '0'.$pt[$ptkey];}
		else{$umt[$key]=$pt[$ptkey];}
	}
	else if($key>=27 and $key<=33){	
		$ptkey=$key+32;	
		if($ptkey==65){$ptkey+=1;}
		if($val==''){$um[$key]=0;}
		if($pt[$ptkey]==''){$umt[$key]='000';$um[$key]=0;}
		else if($pt[$ptkey] < 10){$umt[$key] = '00'.$pt[$ptkey];}
		else if($pt[$ptkey] < 100){$umt[$key] = '0'.$pt[$ptkey];}
		else{$umt[$key]=$pt[$ptkey];}
	}
	else{
		if($val==''){$umt[$key]='000';$um[$key]=0;}
		else if($val < 10){$umt[$key] = '00'.$val;}
		else if($val < 100){$umt[$key] = '0'.$val;}
		else $umt[$key] =$val;
	}
}
if($player['nablud']==''){$nablud='000';}
else if($player['nablud'] < 10){$nablud = '00'.$player['nablud'];}
else if($player['nablud'] < 100){$nablud = '0'.$player['nablud'];}
else {$nablud=$player['nablud'];}

?>
<tr><td>
<font class=proce><font color=#222222>
<tr><td width=760>
  <div class="inside">
  <div style="margin: 10px;">
<table class="tbl1" width="760" border="0" align="left">
    <tr>
        <th colspan="4" align="center">Развитие умений</th>
    </tr>
<tr>
<td align="center">
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td bgcolor=#E0D6BB>
        <? if (($player['fr_bum'] + $player['fr_mum']) > 0) { ?>
            <SCRIPT src="./js/addskill.js"></SCRIPT><? } ?>
<table cellpadding=2 cellspacing=1 border=0 width=100%><FORM action=main.php name=saveskill method=POST>
        <tr>
            <td bgcolor=#FCFAF3 colspan=2>
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td width=100%>
                            <div align=center><font class=proce><font color=#222222><b>Боевые умения</div>
                        </td>
                        <td><a href="javascript:top.helpwin('forum.legendbattles.ru/14/1/502/1/')"><img
                                        src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0
                                        title="Помощь" align=absmiddle></a></td>
                    </tr>
                </table>
            </td>
            <td bgcolor=#FCFAF3 colspan=2>
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td width=100%>
                            <div align=center><font class=proce><font color=#222222><b>Мирные умения</div>
                        </td>
                        <td><a href="javascript:top.helpwin('forum.legendbattles.ru/14/1/502/1/')"><img
                                        src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0
                                        title="Помощь" align=absmiddle></a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[0] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('0');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('0');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Рукопашный бой</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
<div align=center id=sk0>[<?=$umt[0]?>/100]</div></td><INPUT TYPE=hidden name=h0 value=<?=$um[0]?>><INPUT TYPE=hidden name=f[0] value=<?=$um[0]?>>

<td bgcolor=#FCFAF3><font class=proce><font color=#555555>
            <!-- Воровство -->
            <? if ($um[21] < 100 and $player['fr_mum'] > 0) { ?>
<a href="javascript: AddSkill('21');" style="text-decoration: none">
<font style="text-decoration: none"><img src="http://img.legendbattles.ru/image/+.gif"></a> <a href="javascript: RemoveSkill('21');" style="text-decoration: none">
        <font style="text-decoration: none"><img src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
    echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
} ?> <font color=green>•</font> Воровство</td>
            <!-- Воровство -->
<td bgcolor=#FCFAF3><font class=proce><font color=#555555><div align=center id=sk21>[<?=$umt[21]?>/100]</div></td>
            <INPUT TYPE=hidden name=h21 value=<?= $um[21] ?>><INPUT TYPE=hidden name=f[21] value=<?= $um[21] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[1] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('1');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('1');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение мечами</td>
<td bgcolor=#FCFAF3><font class=proce><font color=#555555><div align=center id=sk1>[<?=$umt[1]?>/100]</div></td><INPUT TYPE=hidden name=h1 value=<?=$um[1]?>><INPUT TYPE=hidden name=f[1] value=<?=$um[1]?>>
<td bgcolor=#FCFAF3><font class=proce><font color=#555555>
            <!-- Осторожность -->
            <? if ($um[22] < 100 and $player['fr_mum'] > 0) { ?>
<a href="javascript: AddSkill('22');" style="text-decoration: none">
<font style="text-decoration: none"><img src="http://img.legendbattles.ru/image/+.gif"></a> <a href="javascript: RemoveSkill('22');" style="text-decoration: none">
        <font style="text-decoration: none"><img src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
    echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
} ?> <font color=green>•</font> Осторожность</td>
            <!-- Осторожность -->
<td bgcolor=#FCFAF3><font class=proce><font color=#555555><div align=center id=sk22>[<?=$umt[22]?>/100]</div></td>
            <INPUT TYPE=hidden name=h22 value=<?= $um[22] ?>><INPUT TYPE=hidden name=f[22] value=<?= $um[22] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[2] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('2');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('2');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение топорами</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk2>[<?= $umt[2] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h2 value=<?= $um[2] ?>><INPUT TYPE=hidden name=f[2] value=<?= $um[2] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[23] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('23');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('23');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Скрытность</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk23>[<?= $umt[23] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h23 value=<?= $um[23] ?>><INPUT TYPE=hidden name=f[23] value=<?= $um[23] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[3] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('3');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('3');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение дробящим оружием</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk3>[<?= $umt[3] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h3 value=<?= $um[3] ?>><INPUT TYPE=hidden name=f[3] value=<?= $um[3] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[24] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('24');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('24');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Наблюдательность</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk24>[<?= $nablud ?>/100]</div></td>
            <INPUT TYPE=hidden name=h24 value=<?= $um[24] ?>><INPUT TYPE=hidden name=f[24] value=<?= $um[24] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[4] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('4');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('4');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение ножами</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk4>[<?= $umt[4] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h4 value=<?= $um[4] ?>><INPUT TYPE=hidden name=f[4] value=<?= $um[4] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[25] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('25');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('25');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Торговля</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk25>[<?= $umt[25] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h25 value=<?= $um[25] ?>><INPUT TYPE=hidden name=f[25] value=<?= $um[25] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[5] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('5');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('5');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение копьями и метательным оружием</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk5>[<?= $umt[5] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h5 value=<?= $um[5] ?>><INPUT TYPE=hidden name=f[5] value=<?= $um[5] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[26] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('26');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('26');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Странник</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk26>[<?= $umt[26] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h26 value=<?= $um[26] ?>><INPUT TYPE=hidden name=f[26] value=<?= $um[26] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[6] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('6');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('6');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение тяжёлыми алебардами</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk6>[<?= $umt[6] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h6 value=<?= $um[6] ?>><INPUT TYPE=hidden name=f[6] value=<?= $um[6] ?>>


<td bgcolor=#FCFAF3 colspan=2><div align=center id=sk27></div></td><INPUT TYPE=hidden name=h27 value=<?=$um[27]?>><INPUT TYPE=hidden name=f[27] value=<?=$um[27]?>></tr>

</tr>


        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[7] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('7');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('7');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение магическими посохами</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk7>[<?= $umt[7] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h7 value=<?= $um[7] ?>><INPUT TYPE=hidden name=f[7] value=<?= $um[7] ?>>


<td bgcolor=#FCFAF3 colspan=2><font class=proce><font color=#555555><div align=center id=sk28></div></td><INPUT TYPE=hidden name=h28 value=<?=$um[28]?>><INPUT TYPE=hidden name=f[28] value=<?=$um[28]?>></tr>


        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[8] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('8');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('8');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение экзотическим оружием</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk8>[<?= $umt[8] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h8 value=<?= $um[8] ?>><INPUT TYPE=hidden name=f[8] value=<?= $um[8] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[29] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('29');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('29');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Ювелирное дело</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk29>[<?= $umt[29] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h29 value=<?= $um[29] ?>><INPUT TYPE=hidden name=f[29] value=<?= $um[29] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[9] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('9');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('9');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение двуручным оружием</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk9>[<?= $umt[9] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h9 value=<?= $um[9] ?>><INPUT TYPE=hidden name=f[9] value=<?= $um[9] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[30] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('30');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('30');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Самолечение</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk30>[<?= $umt[30] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h30 value=<?= $um[30] ?>><INPUT TYPE=hidden name=f[30] value=<?= $um[30] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[10] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('10');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('10');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Владение двумя руками</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk10>[<?= $umt[10] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h10 value=<?= $um[10] ?>><INPUT TYPE=hidden name=f[10] value=<?= $um[10] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[31] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('31');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('31');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Оружейник</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk31>[<?= $umt[31] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h31 value=<?= $um[31] ?>><INPUT TYPE=hidden name=f[31] value=<?= $um[31] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[11] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('11');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('11');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Дополнительные очки действия в бою</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk11>[<?= $umt[11] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h11 value=<?= $um[11] ?>><INPUT TYPE=hidden name=f[11] value=<?= $um[11] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[32] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('32');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('32');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Доктор</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk32>[<?= $umt[32] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h32 value=<?= $um[32] ?>><INPUT TYPE=hidden name=f[32] value=<?= $um[32] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3 colspan=2>
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td width=100%>
                            <div align=center><font class=proce><font color=#222222><b>Сопротивления</div>
                        </td>
                        <td><a href="javascript:top.helpwin('forum.legendbattles.ru/14/1/502/1/')"><img
                                        src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0
                                        title="Помощь" align=absmiddle></a></td>
                    </tr>
                </table>
            </td>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[33] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('33');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('33');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Быстрое восстановление маны</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk33>[<?= $umt[33] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h33 value=<?= $um[33] ?>><INPUT TYPE=hidden name=f[33] value=<?= $um[33] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[16] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('16');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('16');" style="text-decoration: none">
                                <font style="text-decoration: none"><img src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Сопротивление магии огня</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk16>[<?= $umt[16] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h16 value=<?= $um[16] ?>><INPUT TYPE=hidden name=f[16] value=<?= $um[16] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[34] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('34');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('34');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Лидерство</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk34>[<?= $umt[34] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h34 value=<?= $um[34] ?>><INPUT TYPE=hidden name=f[34] value=<?= $um[34] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[17] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('17');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('17');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Сопротивление магии воды</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk17>[<?= $umt[17] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h17 value=<?= $um[17] ?>><INPUT TYPE=hidden name=f[17] value=<?= $um[17] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[35] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('35');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('35');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Развитие науки алхимика</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk35>[<?= $umt[35] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h35 value=<?= $um[35] ?>><INPUT TYPE=hidden name=f[35] value=<?= $um[35] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[18] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('18');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('18');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Сопротивление магии воздуха</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk18>[<?= $umt[18] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h18 value=<?= $um[18] ?>><INPUT TYPE=hidden name=f[18] value=<?= $um[18] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[36] < 100 and $player['fr_mum'] > 0) { ?>
                            <a href="javascript: AddSkill('36');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('36');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Развитие горного дела</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk36>[<?= $umt[36] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h36 value=<?= $um[36] ?>><INPUT TYPE=hidden name=f[36] value=<?= $um[36] ?>></tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[19] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('19');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('19');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Сопротивление магии земли</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk19>[<?= $umt[19] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h19 value=<?= $um[19] ?>><INPUT TYPE=hidden name=f[19] value=<?= $um[19] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555><img src=http://img.legendbattles.ru/image/1x1.gif
                                                                           width=22 height=9 align=absmiddle border=0>
                        <font color=green>•</font> Алхимия</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center>
                            [<?= (($pt[68] < 10) ? '00' . $pt[68] : (($pt[68] < 100) ? '0' . $pt[68] : $pt[68])) ?>]
                        </div></td>
        </tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[20] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('20');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('20');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Сопротивление повреждениям (снижение урона по персонажу)</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk20>[<?= $umt[20] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h20 value=<?= $um[20] ?>><INPUT TYPE=hidden name=f[20] value=<?= $um[20] ?>>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555><img src=http://img.legendbattles.ru/image/1x1.gif
                                                                           width=22 height=9 align=absmiddle border=0>
                        <font color=green>•</font> Травничество</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center>
                            [<?= (($pt[70] < 10) ? '00' . $pt[70] : (($pt[70] < 100) ? '0' . $pt[70] : $pt[70])) ?>]
                        </div></td>
        </tr>
        <tr>
            <td bgcolor=#FCFAF3 colspan=2>
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                        <td width=100%>
                            <div align=center><font class=proce><font color=#222222><b>Магические умения</div>
                        </td>
                        <td><a href="javascript:top.helpwin('forum.legendbattles.ru/14/1/502/1/')"><img
                                        src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0
                                        title="Помощь" align=absmiddle></a></td>
                    </tr>
                </table>
            </td>

            <td bgcolor=#FCFAF3><font class=proce><font color=#555555><img src=http://img.legendbattles.ru/image/1x1.gif
                                                                           width=22 height=9 align=absmiddle border=0>
                        <font color=green>•</font> Лесоруб</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
<div align=center>[<?=(($pt[60]<10)?'00'.$pt[60]:(($pt[60]<100)?'0'.$pt[60]:$pt[60]))?>]</div></td>

</tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[12] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('12');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('12');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Магия огня</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk12>[<?= $umt[12] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h12 value=<?= $um[12] ?>><INPUT TYPE=hidden name=f[12] value=<?= $um[12] ?>>

            <td bgcolor=#FCFAF3><font class=proce><font color=#555555><img src=http://img.legendbattles.ru/image/1x1.gif
                                                                           width=22 height=9 align=absmiddle border=0>
                        <font color=green>•</font> Рыболов</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
<div align=center>[<?=(($pt[59]<10)?'00'.$pt[59]:(($pt[59]<100)?'0'.$pt[59]:$pt[59]))?>]</div></td>

        </tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[13] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('13');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('13');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=green>•</font> Магия воды</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk13>[<?= $umt[13] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h13 value=<?= $um[13] ?>><INPUT TYPE=hidden name=f[13] value=<?= $um[13] ?>>

            <td bgcolor=#FCFAF3><font class=proce><font color=#555555><img src=http://img.legendbattles.ru/image/1x1.gif
                                                                           width=22 height=9 align=absmiddle border=0>
                        <font color=green>•</font> Взломщик</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
<div align=center>[<?php echo $player['vzlomshik_nav']; ?>]</div></td>

        </tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[14] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('14');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('14');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Магия воздуха</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk14>[<?= $umt[14] ?>/100]</div></td>
            <INPUT TYPE=hidden name=h14 value=<?= $um[14] ?>><INPUT TYPE=hidden name=f[14] value=<?= $um[14] ?>>
            <td bgcolor=#FCFAF3 colspan=2></td>
        </tr>
        <tr>
            <td bgcolor=#FCFAF3><font class=proce><font
                            color=#555555><? if ($um[15] < 100 and $player['fr_bum'] > 0) { ?>
                            <a href="javascript: AddSkill('15');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/+.gif"></a> <a
                                    href="javascript: RemoveSkill('15');" style="text-decoration: none"><font
                                        style="text-decoration: none"><img
                                            src="http://img.legendbattles.ru/image/-.gif"></a><? } else {
                            echo "<img src=http://img.legendbattles.ru/image/1x1.gif width=22 height=9 align=absmiddle border=0>";
                        } ?> <font color=red>•</font> Магия земли</td>
            <td bgcolor=#FCFAF3><font class=proce><font color=#555555>
                        <div align=center id=sk15>[<?= $umt[15] ?>/100]</div></td>

<INPUT TYPE=hidden name=h15 value=<?=$um[15]?>><INPUT TYPE=hidden name=f[15] value=<?=$um[15]?>><td bgcolor=#FCFAF3 colspan=2>
                <? if ($player['fr_mum'] > 0 or $player['fr_bum'] > 0) { ?>
                    <div align=center><a href="javascript: document.saveskill.submit();"><font class=freemain><font
                                        color=#3564A5><b>Сохранить</a></div><? } ?></td>
        </tr>
        <? if ($player['fr_mum'] > 0 or $player['fr_bum'] > 0) { ?>
            <tr>
            <td colspan=4><font class=proce><font color=#222222>
                        <div align=center id=frskdiv><a
                                    href="javascript:top.helpwin('forum.legendbattles.ru/14/1/502/1/')"><img
                                        src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0
                                        title="Помощь" align=absmiddle></a>
                            &nbsp;<b>Увеличение боевых, магических умений, сопротивления: <?= $player['fr_bum'] ?>
                                единиц<br> Увеличение мирных умений: <?= $player['fr_mum'] ?> единиц</b></div></td>
            </tr><? } ?>
        <INPUT TYPE=hidden name=vcode value="<?= scode() ?>"><INPUT TYPE=hidden name=post_id value="16"><INPUT
                TYPE=hidden name=freeskills value="<?= $player['fr_bum'] ?>"><INPUT TYPE=hidden name=maxfsk
                                                                                    value="<?= $player['fr_bum'] ?>">
        <INPUT TYPE=hidden name=freeskillsmir value="<?= $player['fr_mum'] ?>"><INPUT TYPE=hidden name=mselect
                                                                                      value="1"><INPUT TYPE=hidden
                                                                                                       name=maxfskm
                                                                                                       value="<?= $player['fr_mum'] ?>">
    </FORM>
</table>
</td></tr></table></FIELDSET>
</td></tr>