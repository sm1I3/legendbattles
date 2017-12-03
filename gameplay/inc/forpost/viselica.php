<?php


$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));
echo'
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<tr><td><fieldset><legend align="center"><b><font color="gray">'.$locname['loc'].'</font></b></legend><img src=/img/image/gameplay/hvi/hvi_city1.jpg width=760 height=255 border=0></fieldset></td></tr>
<tr><td>
<font class=proce>
<FIELDSET>
<LEGEND align=center><B><font color=gray>&nbsp;Виселица&nbsp;</font></B></LEGEND>
<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=0 cellspacing=2 border=0 width=100%>
<tr><td><div align=center><font class=nickname>';
if($_GET['viselica']==1 and !empty($_POST['login'])){
	$usertodie=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".addslashes($_POST['login'])."' AND `clan_id`!='Life' LIMIT 1;");
	if(mysqli_num_rows($usertodie)){
		if($player['nv']>=5000){
			if($player['level']>=25){
				$usr=mysqli_fetch_assoc($usertodie);
				$vis="1|".(time()+3600);
				$par.="33/-100@".(time()+3600)."@3|";
				$old=test_affect($usr['affect']);
				$newaff="".$par."".$old."";
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `viselica`='".$vis."',`loc`='4',`pos`='8_4',`affect`='".$newaff."' WHERE `id`='".$usr['id']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'5000' WHERE `login`='".$player['login']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `used`='0' WHERE `pl_id`='".$usr['id']."';");
				calcstat($usr['id']);				
				$ret=substr($ret,0,strlen($ret)-2);
				$ret=substr($ret,2);
				$msg[1]="Персонажа <b>".$usr['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$usr['login']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$usr['login']."\');\" ></a>&nbsp;пытались повесить по заказу <b>".$player['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$player['login']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$player['login']."\');\" ></a>! К сожалению он сорвался с виселицы и сломал себе пару костей...";
				$msg[2]="<b>".$usr['login']."&nbsp;<font color=#CC0000>Получил тяжелые увечья и был отправлен в больницу на неизвестный срок!</font></b>";
				echo "<b>".$usr['login']."</b>&nbsp;<b><font color=#CC0000>Повешен!</font></b>";
				$ms[1]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b>&nbsp;".$msg[1]."<BR>'+'');";
				$ms[2]="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b>&nbsp;".$msg[2]."<BR>'+'');";
				chmsg($ms[1],'');
				chmsg($ms[2],'');
				chmsg($redirect,$usr['login']);
			}
			else{
				echo 'Казни доступны только с 25 уровня!<br>';
				$msg="Вы кто?! Малы ещё гражданин, права не имеете, достигните 25 уровня и приходите заказывайте!";
				$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b>&nbsp;".$msg."<BR>'+'');";
				chmsg($ms,$player['login']);
			}
		}
		else{
			echo 'Недостаточно средств!<br>';
		}
	}
	else{
		echo 'Персонажа <b>'.$_POST['login']."</b> не существует!<br>";
	}
}
echo'
<br>
<b>
<i>
Добрый день, путник.<br>  Что, понравилась виселица?<br>
Эээ, куда лезешь! Высунь голову из петли, это не игрушки! Так-то лучше. Пойди сюда. <br>
Ведь не зря ты сюда пришел, так? Обидели тебя или просто жаждешь чужой смерти? Хотя это не важно.<br> <br> 
Заплати  и ты будешь наблюдать, как твоего врага будет раскачивать ветерок…<br>...туда-сюда…туда-сюда…</font><br> <br>
';
if($player['level']<25){
echo "Вы кто?! Малы ещё гражданин, права не имеете, достигните 25 уровня и приходите заказывайте!</i>";
}
else{
echo'
</i>
<form method=post action="?viselica=1">
<input type=hidden name=vcode value='.scode().'>
<font class=nickname>Имя: <input type=text name=login class=logintextbox6>
<input type=submit class=lbut value="Повесить [50 Серебра ]"></font>
</form>';
}
echo'
<br>
<font class=freetxt style="color:#dd0000">Примечание: после виселицы персонаж получает осложненную травму, а так же не может совершать никаких действий в течении 1 часов.<br>
<font class=nickname><i>Вы обращались в Мэрию с жалобой ?! как? Вам не помогли, вы по адресу...</i></font>
</div></td></tr>
</table></td></tr></table></FIELDSET></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=3></td></tr>
</table>';
?>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>