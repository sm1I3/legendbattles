<?
echo'
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<tr><td bgcolor=#ffffff><img src=/img/image/gameplay/hvi/hvi_city1.jpg width=760 height=255 border=0></td></tr>
<tr><td>
<font class=proce>
<FIELDSET>
<LEGEND align=center><B><font color=gray>&nbsp;Гильотина&nbsp;</font></B></LEGEND>
<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=0 cellspacing=2 border=0 width=100%>
<tr><td><div align=center><font class=nickname>';
if($_GET['gil']==1 and !empty($_POST['login'])){
	$usertodie=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".addslashes($_POST['login'])."' AND `clan_id`!='Life' LIMIT 1;");
	if(mysqli_num_rows($usertodie)){
		if($player['baks']>=25){
				$usr=mysqli_fetch_assoc($usertodie);
            $prison = (time() + 18000) . "|Спасен от казни на гильотине.";
				$par.="33/-100@".(time()+18000)."@3|";
				$old=test_affect($usr['affect']);
				$newaff="".$par."".$old."";
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `prison`='".$prison."',`loc`='33',`pos`='8_4',`affect`='".$newaff."' WHERE `id`='".$usr['id']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-'25' WHERE `login`='".$player['login']."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `used`='0' WHERE `pl_id`='".$usr['id']."';");
				calcstat($usr['id']);				
				$ret=substr($ret,0,strlen($ret)-2);
				$ret=substr($ret,2);
            $msg[1] = "Персонажу <b>" . $usr['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $usr['login'] . "\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $usr['login'] . "\');\" ></a>&nbsp;пытались отрубить голову! Но с помощью вмешательства Инквизиции мера наказания <b>" . $usr['login'] . "</b> была изменена на тюремное заключение...";
            $msg[2] = "<b>" . $usr['login'] . "&nbsp;<font color=#CC0000>Отправлен в тюрьму на 5 часов!</font></b>";
            echo "<b>" . $usr['login'] . "</b>&nbsp;<b><font color=#CC0000>Казнен!</font></b>";
            $ms[1] = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b>&nbsp;" . $msg[1] . "<BR>'+'');";
            $ms[2] = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b>&nbsp;" . $msg[2] . "<BR>'+'');";
				chmsg($ms[1],'');
				chmsg($ms[2],'');
				chmsg($redirect,$usr['login']);
		}
		else{
            echo 'Недостаточно средств!<br>';
		}
	}
	else{
        echo 'Персонажа <b>' . $_POST['login'] . "</b> не существует!<br>";
	}
}
echo'
<br>
<b>
<i>
Эй не трожь! Лезвия такие острые, что разрубают перо.<br>
 Что? Не знаешь что это такое? Это гильотина.<br><br>
 Правитель установил её…хм…для того, чтобы наказывать изменников…или для развлечения…<br>
 Видел когда-нибудь кого-то казнят? Нет? Счастливчик. Такого никому не пожелаешь…Или пожелаешь? <br>
 По приказу всевышнего, всего за 25 изумруда голова твоего неприятеля покатится, оставляя за собой алую дорогу!<br><br>
 Ну что? Мне подготовить  для твоего врага место на кладбище? <br><br>

';
echo'
</i>
<form method=post action="?gil=1">
<input type=hidden name=vcode value='.scode().'>
<font class=nickname>Имя: <input type=text name=login class=logintextbox6>
<input type=submit class=lbut value="Отрубить голову [25 Изумруд]"> (анонимность гарантируется)</font>
</form>';
echo'
<br>
<font class=freetxt style="color:#dd0000">Примечание: <font color=blue>Вы здесь от Инквизиции?</font> После гильотины персонаж получает травму, а так же не может совершать никаких действий в течении 5 часов.<br>
<font class=nickname><i>Вы обращались в Мэрию с жалобой ?! как? Вам не помогли, вы по адресу...</i></font>
</div></td></tr>
</table></td></tr></table></FIELDSET></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=3></td></tr>
</table>';
?>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>