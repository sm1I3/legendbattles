<?php
if($_POST["pupil"]){
	$pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".mysqli_real_escape_string($GLOBALS['db_link'],$_POST["pupil"])."' and `instructor`='0' and `level`<'10'"));
	if($pl){
		chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Персонаж <b>".$player["login"]."</b>[".$player["level"]."/".$player["u_lvl"]."] предлагает вам стать его учеником. За это вы получите 10 LR и +50% опыта за бои. <a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onClick=\"ticher(\'".$player["id"]."\')\"> Учиться <font style=\"font-size: 10px;\">>>></font></font></a></font><BR>'+'');",$pl['login']);
		echo"<script>parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Заявка удачно подана.</font><BR>'+'');</script>";
	}
}

$pupil = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `instructor` = '".$player["id"]."'"));

if(@$_GET["deny"]){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `instructor` = '0' WHERE `instructor` = '".$player["id"]."'");
	chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Персонаж <b>".$player["login"]."</b>[".$player["level"]."/".$player["u_lvl"]."] отказался от обучения.</font><BR>'+'');",$pupil['login']);
	$pupil = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `instructor` = '".$player["id"]."'"));
}

echo'<tr><td align=center>
<font class=proce>
<FIELDSET>
<LEGEND align=center><b><font color="gray">Наставник</font></b></LEGEND>
 <font class=weaponch>';
if($pupil){
	echo'      <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	    <tr>
		  <td bgcolor="#E0D6BB">
            <table cellpadding="2" cellspacing="1" border="0" width="100%">
			  <tr>
			    <td bgcolor="#FCFAF3" align="center">
				  <font class=proce><font color=#222222>У вас есть ученик <b>'.$pupil["level"].'</b>го уровня</font></font>
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class="weaponch">
					<font class=nickname><b>'.$pupil['login'].'</b> ['.$pupil['level'].'/'.$pupil['u_lvl'].'] <a href="/ipers.php?'.$pupil['login'].'" target="_blank"><img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a> <input type=button class=lbut value="Отказаться от обучения" onclick="location = \'/main.php?mselect=21&deny=1\'">
				  </font>
				</td>
			  </tr>
			</table>
		  </td>
	    </tr>
      </table>';
}else{
	echo'<form method="post" action="main.php?mselect=21">
      <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	    <tr>
		  <td bgcolor="#E0D6BB">
            <table cellpadding="2" cellspacing="1" border="0" width="100%">
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class=proce><font color=#222222><b>Вы никого не обучаете...</b></font></font>
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" align="center">
				  <input class="lbut" type="text" name="pupil" id="pupil" value="">
				</td>
				<td bgcolor="#FCFAF3" align="center">
				  <input type="submit" class="lbut" value="Стать наставником">
				</td>
			  </tr>
			  <tr>
			    <td bgcolor="#FCFAF3" colspan="2" align="center">
				  <font class="weaponch">
					<p>
					  <i class="gray" style="text-align:left;">
						<b class="ma">Справка:</b> Предложить стать наставником можно любому персонажу ниже 10ого уровня. Предложение бесплатно, однако, если персонаж примет его, то с вашего счёта спишется <b>20 LR</b>, а ученик получит <b>10 LR</b> и <b>+50% опыта за бои</b> в награду. Обучать можно лишь одного персонажа. Если ваш ученик достигнет 10ого уровня вы получите в награду <b>500 LR</b>, <b>0.15 $</b> и <b>100 Мирного опыта</b>!
					  </i>
					</p>
				  </font>
				</td>
			  </tr>
			</table>
		  </td>
	    </tr>
      </table>
    </form>
	<!--<script>ActionFormUse = \'pupil\';</script>-->';
}
echo'<center>Вы уже обучили <b>'.$player['good_pupils_count'].'</b> персонажей.<br><i class=ma>За каждого 5ого вы будете дополнительно получать по 2000 LR</i></center>
</font>
</FIELDSET>
</td></tr>';