<? 
	if($_GET['adderr']==1){
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `bug_reports` (`text`,`date`,`srok`,`from`) VALUES ('".bbCodes(addslashes(htmlspecialchars($_POST['errtext'])))."','".time()."','".intval($_POST['errtype'])."','".$player['login']."')");
        $message = "Сообщение добавлено.";
	}
	if($_GET['bonus']==1 and $player['compensations']=='1'){
			$player=player();


			
			echo'
			<br>Получено: <b>Не чего не  получил -)</b>
			</td></tr>
			';
			$player['compensations']=0;
	}
	$vcod=scode();
?>
<div class="block info">
	<div class="header">
        <span>Общая информация</span>
	</div>
	<div class="content">	
	<p>
        Принять участие в развитие игрового мира, поделиться своими предложениями и пожеланиями можно <a
                href="http://forum.legendbattles.ru/30/" target=_blank>в специальном разделе на форуме</a>.
	</p>
	<div class="field">
        <label for="ref">Ваша уникальная (реф.) ссылка :</label>
		<input value="http://legendbattles.ru/ref.php?<?=$player['login']?>" style="width:300px" name="ref" type="text">
	<form method=post action="?findpers=1">
		<div class="field">
            <label for="nickname">Поиск персонажей:</label>
			<input type=text name=nickname size=20 maxlength=20>
            <input type=submit value="Ок">
		</div>
<?
	if($_GET['findpers']==1 and $_POST['nickname']!=''){
        if ($player['login'] == 'Администрация') {
		}
		else{
			
			$find=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login` LIKE '%".addslashes(chars($_POST['nickname']))."%';");
			if(mysqli_num_rows($find)>0){
				while($finded = mysqli_fetch_assoc($find)){
					echo '<a href="javascript:parent.say_private(\''.$finded['login'].'\')"><img src="http://img.legendbattles.ru/image/chat/private.gif" width="11" height="12" border="0" align="absmiddle"></a> <b><font class=nickname>'.$finded['login'].' ['.$finded['level'].']</font></b>
					<a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href="ipers.php?'.$finded['login'].'" target="_blank"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 ></a>
					<br>';
				}
			}
			else{
                echo '<p>Персонажей с похожими именами не найдено</p>';
			}
		}
	}
?>
	</form>
	<form method=post action="?kodspers=1&vcode=<?php scode()?>">
		<div class="field">
            <label for="nickname">Вести бонус-код:</label>
			<input type=text name=nickname size=20 maxlength=20>
            <input type=submit value="Ок">
		</div>
<?	$proms = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `promo` WHERE `kol` LIMIT 1;"));
	
	if($_GET['kodspers']==1 and $_POST['nickname']!=''){
	if($proms['kol']>='1' and $player['promo']< 1 ){
		{
			$kods=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `promo` WHERE `kod` LIKE '%".addslashes(chars($_POST['nickname']))."%';");
			if(mysqli_num_rows($kods)>0){
				echo '<tr><td>';
				while($kodsed = mysqli_fetch_assoc($kods)){
                    echo 'Вы активировали бонус-код<br>';
					mysqli_query($GLOBALS['db_link'],"update `promo` set `kol`=`kol`-'1'");
					mysqli_query($GLOBALS['db_link'],"update `user` set `promo`='1' WHERE `id`='".$player['id']."' LIMIT 1;");
                    mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Бонус&nbsp;</font> <font color=000000>&quot;<b>" . $player['login'] . "</b>&quot; активировали бонус-код</font></i><BR>'+'');") . "');");
					mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('3532',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
				}
				echo '</td></tr>';
			}
			else{
                echo '<p>Неверный бонус-код. Попробуйте ещё раз</p>';
			}
		}
	}
	else{
        echo '<p>Лимит исчерпан или вы активировали бонус-код. </p>';
			}
	}
?>
	</form> 
<?
	if($player["level"] < 10 and $player["instructor"]){
		$pupil = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id` = '".$player["instructor"]."'"));
		if(@$_GET["deny"]){
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `instructor` = '0' WHERE `id` = '".$player["id"]."'");
            chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Персонаж <b>" . $player["login"] . "</b>[" . $player["level"] . "/" . $player["u_lvl"] . "] отказался от обучения.</font><BR>'+'');", $pupil['login']);
			$pupil = '';
		}
		if($pupil){
            echo '<p> Вы обучаетесь у персонажа <b>' . $pupil["level"] . '</b>го уровня</p>
				<p><b>' . $pupil['login'] . '</b> [' . $pupil['level'] . '/' . $pupil['u_lvl'] . '] <a href="/ipers.php?' . $pupil['login'] . '" target="_blank"><img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a> <input type=button class=lbut value="Отказаться от обучения" onclick="location = \'/main.php?deny=1\'"></p>';
		}
	}
?>
        <font style="font-size: 13px;">С уважением, команда разработчиков проекта <?= $gamename ?></font>
        <?
        if ($player['login'] == 'alexs' or $player['login'] == 'Администрация') {
		echo "<p>
		<form method=post>
		<input type=hidden name=testid value=1>
		<input type=submit value='Обнулить игрокам Бонус код'>
		</form>	";
		if($_POST['testid']==1){
			mysqli_query($GLOBALS['db_link'],"update `user` set `promo`='0'");	
		}
		echo'</p>';	
		echo "<p>
		<form method=post>
		<input type=hidden name=comid value=1>
		<input type=submit value='Обнулить игрокам Компенсацию'>
		</form>
		";
		if($_POST['comid']==1){
			mysqli_query($GLOBALS['db_link'],"update `user` set `compensations`='1'");	
		}
	echo'</p>';
	}
?>

	</div>
</div>
