<?
echo "
</form>
<script language=Javascript>
function artRename(e){
document.getElementById('artname').value = e;
}
function deleteArt(){
	document.getElementById('post_id').value = 87;
}
</script>
";
$timer = time() - 604800;
mysqli_query($GLOBALS['db_link'], "DELETE FROM art_zayav WHERE cr_time<=" . $timer . ";");
$nar = Array('Рукопашный бой', 'Владение мечами', 'Владение топорами', 'Владение дробящим оружием', 'Владение ножами', 'Владение копьями и метательным оружием', 'Владение тяжёлыми алебардами', 'Владение магическими посохами', 'Владение экзотическим оружием', 'Владение двуручным оружием', 'Владение двумя руками', 'Дополнительные очки действия в бою', 'Магия огня', 'Магия воды', 'Магия воздуха', 'Магия земли', 'Сопротивление магии огня', 'Сопротивление магии воды', 'Сопротивление магии воздуха', 'Сопротивление магии земли', 'Сопротивление повреждениям', 'Воровство', 'Осторожность', 'Скрытность', 'Наблюдательность', 'Торговля', 'Странник', 'Рыболов', 'Лесоруб', 'Ювелирное дело', 'Самолечение', 'Оружейник', 'Доктор', 'Быстрое восстановление маны', 'Лидерство', 'Развитие науки алхимика', 'Развитие горного дела');
$query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM art_zayav " . $filter . ";");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        switch ($row['type']) {
            case '':
                $type = "zero";
                break;
            case 'w1':
                $type = "Меч";
                break;
            case 'w2':
                $type = "Топор";
                break;
            case 'w3':
                $type = "Дробящее";
                break;
            case 'w4':
                $type = "Нож";
                break;
            case 'w5':
                $type = "Метательное";
                break;
            case 'w6':
                $type = "Алебарда";
                break;
            case 'w7':
                $type = "Посох";
                break;
            case 'w18':
                $type = "Кольчуга";
                break;
            case 'w19':
                $type = "Доспех";
                break;
            case 'w20':
                $type = "Щит";
                break;
            case 'w21':
                $type = "Сапоги";
                break;
            case 'w22':
                $type = "Кольцо";
                break;
            case 'w23':
                $type = "Шлем";
                break;
            case 'w24':
                $type = "Перчатки";
                break;
            case 'w25':
                $type = "Кулон";
                break;
            case 'w26':
                $type = "Пояс";
                break;
            case 'w28':
                $type = "Наплечники";
                break;
            case 'w80':
                $type = "Наручи";
                break;
            case 'w90':
                $type = "Наколенники";
                break;
            default:
                $type = "zero";
                break;
        }
        $gamer = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE id=" . $row['pl_id'] . ";"));
        echo "<form method=post><font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Заявка от <a href='http://www.legendbattles.ru/ipers.php?" . $gamer['login'] . "' target='_blank'>" . $gamer['login'] . "</a>&nbsp;[" . $type . "]&nbsp;</font></B></LEGEND>
	<table cellpadding=10 cellspacing=0 border=0 width=100%>
		<tr><td class=nickname2>";
        echo "<b>Название артефакта:</b> <input type=text value=\"" . $row['name'] . "\" onkeyup=\"artRename(this.value);\">&nbsp;&nbsp;" . ($row['compl'] == 0 ? "<input align=right type=submit class=klbut value=\"Создать\" />" : "<font color=gray>артефакт создан</font>") . "&nbsp;";
        echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Тип и цена&nbsp;</font></B></LEGEND>" . $type . "</b><br>Цена: <b>" . $row['price'] . " $</b><br>";
        if ($row['damage'] != 0) {
            echo "Урон: <b>" . $row['damage'] . "</b><br>";
        }
        if ($row['koeff'] != 0) {
            echo "коэффициент: <b>" . $row['koeff'] . "</b><br>";
        }
        if ($row['hp'] != 0) {
            echo "жизнь: <b>" . $row['hp'] . "</b><br>";
        }
        echo "</FIELDSET>";
        //статы
        echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;статы и мф&nbsp;</font></B></LEGEND>";
        if ($row['sila'] != 0) {
            echo "Мощь: <b>" . $row['sila'] . "</b><br>";
        }
        if ($row['lovkost'] != 0) {
            echo "Проворность: <b>" . $row['lovkost'] . "</b><br>";
        }
        if ($row['udacha'] != 0) {
            echo "Везение: <b>" . $row['udacha'] . "</b><br>";
        }
        if ($row['znan'] != 0) {
            echo "Разум: <b>" . $row['znan'] . "</b><br>";
        }
        //мф
        if ($row['ylov'] != 0) {
            echo "уворот: <b>" . $row['ylov'] . "</b><br>";
        }
        if ($row['toch'] != 0) {
            echo "точность: <b>" . $row['toch'] . "</b><br>";
        }
        if ($row['sokr'] != 0) {
            echo "сокрушение: <b>" . $row['sokr'] . "</b><br>";
        }
        if ($row['stoi'] != 0) {
            echo "стойкость: <b>" . $row['stoi'] . "</b><br>";
        }
        echo "</FIELDSET>";
//пробой и броня
        echo "<font class=proce><font color=#222222><FIELDSET name=field_dealers id=field_dealers><LEGEND align=center><B><font color=gray>&nbsp;Броня и пробой брони&nbsp;</font></B></LEGEND>";
        if ($row['armor'] != 0) {
            echo "броня: <b>" . $row['armor'] . "</b><br>";
        }
        if ($row['proboi'] != 0) {
            echo "пробой брони: <b>" . $row['proboi'] . "</b><br>";
        }
        echo "</FIELDSET>";
        $i = 0;
        echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Умения&nbsp;</font></B></LEGEND>";
        if ($row['nav'] != '') {
            $nav = explode("|", $row['nav']);
            while ($i <= 33) {
                if ($nav[$i] != '') {
                    echo $nar[$i] . ": <b>" . $nav[$i] . "</b><br>";
                }
                $i++;
            }
        }
        echo "</FIELDSET>
<input type=hidden id=artname name=artname value=" . $row['name'] . " />
<input type=hidden name=id value=" . $row['id'] . ">
<input type=hidden id=post_id name=post_id value=86 />
<input type=hidden name=vcode value=";
        echo scod();
        echo " />
</form>
";
        echo '	
</td></tr>
</table></FIELDSET><br><br>';
    }
} else {
    echo '<FIELDSET name=field_dealers id=field_dealers>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<font  class=nickname2 style="color:#336699"><b>Заявок не найдено</b></font>
			</td></tr>
		</table>
		</FIELDSET>
		';
}
