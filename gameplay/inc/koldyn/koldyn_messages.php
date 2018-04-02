<?
echo '
<table border=0 cellpadding=4 cellspacing=1 align=center class="smallhead" width=100%>
<tr class=nickname align=center>
<td align=center width=100%>';
switch($message){
 case 1:
     echo "Вы научились создавать " . $chrecipe['name'] . ".";
 break;
 case 2:
     echo 'Недостаточно навыка для покупки рецепта.';
 break;
  case 3:
      echo 'Нехватает денег для покупки рецепта.';
 break;
 case 4:
     echo 'Этот рецепт уже приобретен.';
 break;
 case 5:
     echo 'Вы успешно создали <b>' . $IT['name'] . '</b> ' . $chrecipe['col'] . 'шт.</font>';
	$calcup=($pt[75]-$chrecipe['nav'])+3;
	if(rand(1,$calcup)==$calcup){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `koldyn`=`koldyn`+'1' WHERE `id`='".$player['id']."'");
        echo '<br><b>Ваш навык колдуна повысился на <font color=red>+1</font>.</b>';
	}
 break;
 case 6:
     echo ' <font color=red><b>Недостаточно реагентов</b></font><br>' . $regmiss;
 break;
 case 7:
     echo 'Предмет не найден в базе';
 break;
 case 8:
     echo 'Сначала нужно приобрести рецепт.';
 break;
}
echo'</td></tr></table>';
