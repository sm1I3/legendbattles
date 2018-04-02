<?php

echo'<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e0e0e0><table cellpadding=3 cellspacing=1 border=0 width=100%>';
$par=explode("|",$ITEM['param']);
$need=explode("|",$ITEM['need']);
$bt=0;$tr_b='';$m=1;
foreach ($need as $value) {
$treb=explode("@",$value);
if($treb[0]==72){$treb[1]=$ITEM['level'];}
if($treb[0]==71){$treb[1]=$ITEM['massa'];}
if($treb[0]!=28){if($treb[0]==71){$m=0;}}
switch($treb[0])
{
    case 28:
        $tr_b .= "&nbsp;Очки действия: <b>$treb[1]</b><br>";
        break;
    case 30:
        $tr_b .= "&nbsp;Мощь: <b>$treb[1]</b><br>";
        break;
    case 31:
        $tr_b .= "&nbsp;Проворность: <b>$treb[1]</b><br>";
        break;
    case 32:
        $tr_b .= "&nbsp;Везение: <b>$treb[1]</b><br>";
        break;
    case 33:
        $tr_b .= "&nbsp;Здоровье: <b>$treb[1]</b><br>";
        break;
    case 34:
        $tr_b .= "&nbsp;Разум: <b>$treb[1]</b><br>";
        break;
    case 35:
        $tr_b .= "&nbsp;Сноровка: <b>$treb[1]</b><br>";
        break;
    case 36:
        $tr_b .= "&nbsp;Владение мечами: <b>$treb[1]</b><br>";
        break;
    case 37:
        $tr_b .= "&nbsp;Владение топорами: <b>$treb[1]</b><br>";
        break;
    case 38:
        $tr_b .= "&nbsp;Владение дробящим оружием: <b>$treb[1]</b><br>";
        break;
    case 39:
        $tr_b .= "&nbsp;Владение ножами: <b>$treb[1]</b><br>";
        break;
    case 40:
        $tr_b .= "&nbsp;Владение метательным оружием: <b>$treb[1]</b><br>";
        break;
    case 41:
        $tr_b .= "&nbsp;Владение алебардами и копьями: <b>$treb[1]</b><br>";
        break;
    case 42:
        $tr_b .= "&nbsp;Владение посохами: <b>$treb[1]</b><br>";
        break;
    case 43:
        $tr_b .= "&nbsp;Владение экзотическим оружием: <b>$treb[1]</b><br>";
        break;
    case 44:
        $tr_b .= "&nbsp;Владение двуручным оружием: <b>$treb[1]</b><br>";
        break;
    case 45:
        $tr_b .= "&nbsp;Магия огня: <b>$treb[1]</b><br>";
        break;
    case 46:
        $tr_b .= "&nbsp;Магия воды: <b>$treb[1]</b><br>";
        break;
    case 47:
        $tr_b .= "&nbsp;Магия воздуха: <b>$treb[1]</b><br>";
        break;
    case 48:
        $tr_b .= "&nbsp;Магия земли: <b>$treb[1]</b><br>";
        break;
    case 53:
        $tr_b .= "&nbsp;Воровство: <b>$treb[1]</b><br>";
        break;
    case 54:
        $tr_b .= "&nbsp;Осторожность: <b>$treb[1]</b><br>";
        break;
    case 55:
        $tr_b .= "&nbsp;Скрытность: <b>$treb[1]</b><br>";
        break;
    case 56:
        $tr_b .= "&nbsp;Наблюдательность: <b>$treb[1]</b><br>";
        break;
    case 57:
        $tr_b .= "&nbsp;Торговля: <b>$treb[1]</b><br>";
        break;
    case 58:
        $tr_b .= "&nbsp;Странник: <b>$treb[1]</b><br>";
        break;
    case 59:
        $tr_b .= "&nbsp;Рыболов: <b>$treb[1]</b><br>";
        break;
    case 60:
        $tr_b .= "&nbsp;Лесоруб: <b>$treb[1]</b><br>";
        break;
    case 61:
        $tr_b .= "&nbsp;Ювелирное дело: <b>$treb[1]</b><br>";
        break;
    case 62:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 63:
        $tr_b .= "&nbsp;Оружейник: <b>$treb[1]</b><br>";
        break;
    case 64:
        $tr_b .= "&nbsp;Доктор: <b>$treb[1]</b><br>";
        break;
    case 65:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 66:
        $tr_b .= "&nbsp;Быстрое восстановление маны: <b>$treb[1]</b><br>";
        break;
    case 67:
        $tr_b .= "&nbsp;Лидерство: <b>$treb[1]</b><br>";
        break;
    case 68:
        $tr_b .= "&nbsp;Алхимия: <b>$treb[1]</b><br>";
        break;
    case 69:
        $tr_b .= "&nbsp;Развитие горного дела: <b>$treb[1]</b><br>";
        break;
    case 70:
        $tr_b .= "&nbsp;Рыбалка: <b>$treb[1]</b><br>";
        break;
    case 71:
        $tr_b .= "&nbsp;Масса: <b>$treb[1]</b><br>";
        break;
    case 72:
        $tr_b .= "&nbsp;Уровень: <b>$treb[1]</b><br>";
        break;
}
}
echo'
<tr>
<td bgcolor=#f9f9f9>
	<div align=center>
		<img src=/img/image/weapon/'.$ITEM['gif'].' border=0>
	</div>
</td>
<td width=100% bgcolor=#ffffff valign=top>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
		<tr>
			<td bgcolor=#ffffff width=100%>
				<font class=weaponch><b>'.$ITEM['name'].'</b><font class=weaponch><br>
				<img src=/img/image/1x1.gif width=1 height=3></td><td><br><img src=/img/image/1x1.gif width=1 height=3
			</td>
		</tr>
		<tr>
			<td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>свойства</div></td><td bgcolor=#B9A05C>
					<img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>требования</div>
				</td></tr>
<tr><td bgcolor=#FCFAF3><font class=weaponch>&nbsp;Цена: <b>' . $ITEM['price'] . ' Бронзы</b><br>';
if ($ITEM['slot'] == 16) {
    echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
}
blocks($ITEM['block']);
foreach ($par as $value) {
$stat=explode("@",$value);
if($stat[1]>0){$plus = "+";}else{$plus ="";}
switch($stat[0])
{
    case 0:
        echo "Гравировка: <b>$stat[1]</b><br>";
        break;
    case 1:
        echo "Удар: <b>$stat[1]</b><br>";
        break;
    case 2:
        echo "Долговечность: <b>$stat[1]/$stat[1]</b><br>";
        break;
    case 3:
        echo "Карманов: <b>$stat[1]</b><br>";
        break;
    case 4:
        echo "Материал: <b>$stat[1]</b><br>";
        break;
    case 5:
        echo "Уловка: $plus<b>$stat[1]%</b><br>";
        break;
    case 6:
        echo "Точность: $plus<b>$stat[1]%</b><br>";
        break;
    case 7:
        echo "Сокрушение: $plus<b>$stat[1]%</b><br>";
        break;
    case 8:
        echo "Стойкость: $plus<b>$stat[1]%</b><br>";
        break;
    case 9:
        echo "Класс брони: <b>$stat[1]</b><br>";
        break;
    case 10:
        echo "Пробой брони: $plus<b>$stat[1]%</b><br>";
        break;
    case 11:
        echo "Пробой колющим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 12:
        echo "Пробой режущим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 13:
        echo "Пробой проникающим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 14:
        echo "Пробой пробивающим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 15:
        echo "Пробой рубящим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 16:
        echo "Пробой карающим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 17:
        echo "Пробой отсекающим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 18:
        echo "Пробой дробящим ударом: $plus<b>$stat[1]%</b><br>";
        break;
    case 19:
        echo "Защита от колющих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 20:
        echo "Защита от режущих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 21:
        echo "Защита от проникающих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 22:
        echo "Защита от пробивающих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 23:
        echo "Защита от рубящих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 24:
        echo "Защита от карающих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 25:
        echo "Защита от отсекающих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 26:
        echo "Защита от дробящих ударов: $plus<b>$stat[1]</b><br>";
        break;
    case 27:
        echo "НР: $plus<b>$stat[1]</b><br>";
        break;
    case 28:
        echo "Очки действия: $plus<b>$stat[1]</b><br>";
        break;
    case 29:
        echo "Мана: $plus<b>$stat[1]</b><br>";
        break;
    case 30:
        echo "Мощь: $plus<b>$stat[1]</b><br>";
        break;
    case 31:
        echo "Проворность: $plus<b>$stat[1]</b><br>";
        break;
    case 32:
        echo "Везение: $plus<b>$stat[1]</b><br>";
        break;
    case 33:
        echo "Здоровье: $plus<b>$stat[1]</b><br>";
        break;
    case 34:
        echo "Разум: $plus<b>$stat[1]</b><br>";
        break;
    case 35:
        echo "Сноровка: $plus<b>$stat[1]</b><br>";
        break;
    case 36:
        echo "Владение мечами: $plus<b>$stat[1]%</b><br>";
        break;
    case 37:
        echo "Владение топорами: $plus<b>$stat[1]%</b><br>";
        break;
    case 38:
        echo "Владение дробящим оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 39:
        echo "Владение ножами: $plus<b>$stat[1]%</b><br>";
        break;
    case 40:
        echo "Владение метательным оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 41:
        echo "Владение алебардами и копьями: $plus<b>$stat[1]%</b><br>";
        break;
    case 42:
        echo "Владение посохами: $plus<b>$stat[1]%</b><br>";
        break;
    case 43:
        echo "Владение экзотическим оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 44:
        echo "Владение двуручным оружием: $plus<b>$stat[1]%</b><br>";
        break;
    case 45:
        echo "Магия огня: $plus<b>$stat[1]%</b><br>";
        break;
    case 46:
        echo "Магия воды: $plus<b>$stat[1]%</b><br>";
        break;
    case 47:
        echo "Магия воздуха: $plus<b>$stat[1]%</b><br>";
        break;
    case 48:
        echo "Магия земли: $plus<b>$stat[1]%</b><br>";
        break;
    case 49:
        echo "Сопротивление магии огня: $plus<b>$stat[1]%</b><br>";
        break;
    case 50:
        echo "Сопротивление магии воды: $plus<b>$stat[1]%</b><br>";
        break;
    case 51:
        echo "Сопротивление магии воздуха: $plus<b>$stat[1]%</b><br>";
        break;
    case 52:
        echo "Сопротивление магии земли: $plus<b>$stat[1]%</b><br>";
        break;
    case 53:
        echo "Воровство: $plus<b>$stat[1]%</b><br>";
        break;
    case 54:
        echo "Осторожность: $plus<b>$stat[1]%</b><br>";
        break;
    case 55:
        echo "Скрытность: $plus<b>$stat[1]%</b><br>";
        break;
    case 56:
        echo "Наблюдательность: $plus<b>$stat[1]%</b><br>";
        break;
    case 57:
        echo "Торговля: $plus<b>$stat[1]%</b><br>";
        break;
    case 58:
        echo "Странник: $plus<b>$stat[1]%</b><br>";
        break;
    case 59:
        echo "Рыболов: $plus<b>$stat[1]%</b><br>";
        break;
    case 60:
        echo "Лесоруб: $plus<b>$stat[1]%</b><br>";
        break;
    case 61:
        echo "Ювелирное дело: $plus<b>$stat[1]%</b><br>";
        break;
    case 62:
        echo "Самолечение: $plus<b>$stat[1]%</b><br>";
        break;
    case 63:
        echo "Оружейник: $plus<b>$stat[1]%</b><br>";
        break;
    case 64:
        echo "Доктор: $plus<b>$stat[1]%</b><br>";
        break;
    case 65:
        echo "Самолечение: $plus<b>$stat[1]%</b><br>";
        break;
    case 66:
        echo "Быстрое восстановление маны: $plus<b>$stat[1]%</b><br>";
        break;
    case 67:
        echo "Лидерство: $plus<b>$stat[1]%</b><br>";
        break;
    case 68:
        echo "Алхимия: $plus<b>$stat[1]%</b><br>";
        break;
    case 69:
        echo "Развитие горного дела: $plus<b>$stat[1]%</b><br>";
        break;
    case 70:
        echo "Рыбалка: $plus<b>$stat[1]%</b><br>";
        break;
}
}
echo'</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>'.$tr_b.'</font></td></tr></table></td></tr></table></td></tr></table>';
echo'</td></tr></table></td>';

