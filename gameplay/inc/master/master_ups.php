<?
		echo'<tr><td bgcolor=#FCFAF3 width=100% colspan=2 height=1><div align=center>';
echo '<font class=weaponch><a href="javascript: writebuttons(\'mod\',\'' . $ITEM['id_item'] . '\');"><b id="' . $ITEM['id_item'] . 'modb">&nbsp;Модификации</b></a>&nbsp;|&nbsp;<a href="javascript: writebuttons(\'up\',\'' . $ITEM['id_item'] . '\');"><b id="' . $ITEM['id_item'] . 'upb">Апы вещи</b></a>&nbsp;|&nbsp;<a href="javascript: writebuttons(\'cmod\',\'' . $ITEM['id_item'] . '\');"><b id="' . $ITEM['id_item'] . 'cmodb">Сброс апов</b></a></font><br>';
		echo'</div></td></tr><tr>';
//кольца и амулеты
		if(!$_GET['art']){
		if($ITEM['type']=='w25' or $ITEM['type']=='w22'){
			if($pl_st[61]>=25){
			echo '
			  <td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'up" class="invis">
			  <div align=center>
			  <font class=nickname><b>шанс улучшения ' . (($pl_st[61] / 200 * 100) <= 50 ? "<font color=#cc0000>" . ($pl_st[61] / 200 * 100) : "<font color=green>" . ($pl_st[61] / 200 * 100)) . '%</b></font>	  
			  <font class=weaponch><font color=#777777></font></font></div>
			  ';
				  if($ITEM['modified']==0){
						$buttons='';
                      echo '<div align=center>&nbsp;<font class=freetxt>Увеличить случайный модификатор от 10% до 50% от его стандартного значения. Цена: <b>425 LR.</b></font></div><br>';
                      $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить модификатор " onclick="location=\'main.php?up=1&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						if($npar[9]!=''){
                            echo '<div align=center>&nbsp;<font class=freetxt>Увеличить броню от 20% до 50% от ее стандартного значения. Цена: <b>625 Монеты.</b></font></div><br>';
                            $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить броню " onclick="location=\'main.php?up=2&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						}					  
						if($npar[1]!=''){
                            echo '<div align=center>&nbsp;<font class=freetxt>Увеличить урон от 10% до 40% от его стандартного значения. Цена: <b>1000 Монеты.</b></font></div><br>';
                            $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить урон " onclick="location=\'main.php?up=4&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						}
						echo "<div align=center>".$buttons."</div>";
				  } else {
                      echo '<div align=center><b><font color=#cc0000>Вещь уже модифицирована.</font></b></div>';
                  }
			  }
			  else{
				  echo' 
				  <td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'up" class="invis">
				  <div align=center><font class=freetxt>Для апа колец и амулетов требуется навык:<br> <b>Ювелирное дело<font color=#cc0000> 25</font></b>.</div>
				  ';
				}
		  } //оружие
	else if($ITEM['type']=='w1' or $ITEM['type']=='w2' or $ITEM['type']=='w3' or $ITEM['type']=='w4' or $ITEM['type']=='w5' or $ITEM['type']=='w6' or $ITEM['type']=='w7'){
		if($pl_st[63]>=100){
			echo '
		  <td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'up" class="invis">
		  <div align=center>
		  <font class=nickname><b>шанс улучшения ' . (($pl_st[61] / 200 * 100) <= 50 ? "<font color=#cc0000>" . ($pl_st[61] / 200 * 100) : "<font color=green>" . ($pl_st[61] / 200 * 100)) . '%</b></font>	  
		  <font class=weaponch><font color=#777777></font></font></div>';
		  if($ITEM['modified']==0){
						$buttons='';
              echo '<div align=center>&nbsp;<font class=freetxt>Увеличить случайный модификатор от 10% до 50% от его стандартного значения. Цена: <b>425 LR.</b></font></div><br>';
              $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить модификатор " onclick="location=\'main.php?up=1&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						if($npar[9]!=''){
                            echo '<div align=center>&nbsp;<font class=freetxt>Увеличить броню от 20% до 50% от ее стандартного значения. Цена: <b>625 LR.</b></font></div><br>';
                            $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить броню " onclick="location=\'main.php?up=2&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						}					  
						if($npar[1]!=''){
                            echo '<div align=center>&nbsp;<font class=freetxt>Увеличить урон от 10% до 20% от его стандартного значения. Цена: <b>1000 LR.</b></font></div><br>';
                            $buttons .= '&nbsp;<input type=button class=lbut value=" Увеличить урон " onclick="location=\'main.php?up=4&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
						}
						echo "<div align=center>".$buttons."</div>";
			  }
			   else{
					echo' 
				  <div align=left><b><font color=#cc0000>Вещь уже модифицирована.</font></b></div>
				  ';
			  }
		  }
		  else{
			  echo'
			  <td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'up" class="invis">
			  <div align=center><font class=freetxt>Для проведения апов оружия требуется навык:<br> <b>Оружейник<font color=#cc0000> 100</font></b>.</div>
			  ';
			}
	}
	else{
			echo'
			<td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'up" class="invis">
			<div align=center><font class=freetxt>Апы брони недоступны.</div>
			  ';
	}	
	echo '</td>';	
	$buttons='';
	echo'
	<td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'mod" class="invis">';
            echo '<div align=center>&nbsp;<font class=freetxt>Случайная модификация - модифицирует случайные параметры на предмете.<br>(может прибавить или убавить параметры предмета)<br><br><font color=#cc0000>Сбрасывает все <b>модификации</b> и <b>апы</b> предмета, сделанные до этого!</font><br><br>Стоимость случайной модификации для этого предмета: <b>' . lr($ITEM['price']) . '</b></font></div>';
	if($_GET['art']!=1 and $svitok['id_item']){
        //$buttons.='<br><font class=nickname2><b>Использовать свиток 100% <font color=#993399>эпической</font> модификации: </b></font><select onChange="rewritebut(this.value,\''.$ITEM['id_item'].'\',\''.$ITEM['name'].'\',\''.$code.'\',\''.$svitok['id_item'].'\');"><option value=1 selected=selected>Нет</option><option value=2>Да</option></select>';
    }
            $buttons .= '&nbsp;<div name="moddiv_' . $ITEM['id_item'] . '" id="moddiv_' . $ITEM['id_item'] . '"><input type=button  class=lbut value=" Модифицировать [ ' . $ITEM['name'] . ' ] " onclick="location=\'main.php?up=5&v=' . $ITEM['id_item'] . '&sv=0&vcode=' . $code . '\'"></div>';
	echo "<div align=center>".$buttons."</div></td>";
	$buttons='';
	echo'
	<td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'cmod" class="invis">';
            echo '<div align=center>&nbsp;<font class=freetxt>Сброс модификаций - сбрасывает все характеристики предмета на стандартные.<br><br>Стоимость сброса характеристик предмета: <b>1 бронза.</b></font></div>';
            $buttons .= '&nbsp;<input type=button class=lbut value=" Сбросить модификации [ ' . $ITEM['name'] . ' ] " onclick="location=\'main.php?up=666&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
	echo "<div align=center>".$buttons."</div></td>";
	}
	else{
		echo'
		<td bgcolor=#ffffff valign=top width=65% colspan=2 id="'.$ITEM['id_item'].'mod" class="invis">';
        echo '<div align=center>&nbsp;<font class=freetxt>Случайная мобификация - модифицирует случайные параметры на предмете.<br>(может прибавить или убавить параметры предмета)<br><br><font color=#cc0000>Сбрасывает все <b>модификации</b> и <b>апы</b> предмета, сделанные до этого!<br><b>Для артефактов модификация всегда будет <font color=#993399>эпической</font>. Статы не смогут уйти в минус.</b></font><br><br>Стоимость случайной модификации для этого предмета: <b>' . $ITEM['dd_price'] . ' DLR.</b></font></div>';
        $buttons .= '&nbsp;<input type=button class=lbut value=" Модифицировать [ ' . $ITEM['name'] . ' ] " onclick="location=\'main.php?up=5&v=' . $ITEM['id_item'] . '&vcode=' . $code . '\'">';
		echo "<div align=center>".$buttons."</div></td>";
		$buttons='';
	}
	echo"</tr></table></TD></TR></table></td></tr>";
	$code='';
	
?>