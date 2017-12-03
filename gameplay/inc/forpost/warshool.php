
<?php
if($_GET['StartTrane']){
	if($player['level'] < 8){
		TraneAttack($player,array(1));
	}	
}
if($_GET['StartTrane2']){
	if($player['level'] < 8){
		TraneAttack($player,array(2,2));
	}	
}
if($_GET['StartTrane3']){
	if($player['level'] < 8){
		TraneAttack($player,array(6,6,6));
	}	
}
if($_GET['StartTrane4']){
	if($player['level'] < 8){
		TraneAttack($player,array(45,45,45,45));
	}	
}
if($_GET['StartTrane5']){
	if($player['level'] < 8){
		TraneAttack($player,array(20,20,20,20,20));
	}	
}

if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
echo'<table cellpadding="0" cellspacing="0" border="0" align="center" width="50%">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
	</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="50%">
          <tr>
        <td bgcolor="#ffffff"><img src="/img/image/gameplay/school/vsch_city1.jpg" width="900" height="300" border="0" /></td>
      </tr>
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="50%">
          <tr>';
            if($player['hp']<$player['hp_all']*0.0){
				echo'<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>Вы слишком ослаблены для боев!</font></font></b></div></td>';
			}elseif($player['level'] < 8){
				echo'<table cellpadding="2" cellspacing="1" border="0" align="center" width="50%">				
				<td align="center"><img src="http://order.ereality.ru/images/articles/monstovl_01.png"><br><a href="main.php?StartTrane=1"><input class="button3" type="submit" value="Напасть"></a></td>
				<td align="center"><img src="http://order.ereality.ru/images/articles/monstovl_02.png"><br><a href="main.php?StartTrane2=2"><input class="button3" type="submit" value="Напасть"></a></td>
				<td align="center"><img src="http://order.ereality.ru/images/articles/monstovl_03.png"><br><a href="main.php?StartTrane3=3"><input class="button3" type="submit" value="Напасть"></a></td>
				<td align="center"><img src="http://order.ereality.ru/images/articles/monstovl_04.png"><br><a href="main.php?StartTrane4=4"><input class="button3" type="submit" value="Напасть"></a></td>
				<td align="center"><img src="http://order.ereality.ru/images/articles/monstovl_06.png"><br><a href="main.php?StartTrane5=5"><input class="button3" type="submit" value="Напасть"></a></td>';
          }else{
				echo'<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>Вы уже слишком большой чтоб тренироваться в школе.!</font></font></b></div></td>';
		  }
		  echo'</table></td>
      </tr>
    </table></td>
  </tr>
</table>';
?>
