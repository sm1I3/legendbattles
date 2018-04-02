<?php 
require('kernel/before.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
?>

<script>
var user = '<?=$inf[sklon]?> <?=$inf[clan_gif]?> <?=$_SESSION['user']["login"]?>';
var t;
//document.onmousedown = function(event) { t_nick(event); };
var sm = new Array('001','002','003','004','005','007','008','009','006','010','011','012','013','014','015','016','000','018','021','022','019','023','024','025','026','027','028','031','032','034','033','037','038','036','040','039','043','049','052','056','059','057','062','066','068','073','082','080','079','083','086','085','114','118','119','123','161','158','164','167','166','170','174','177','175','179','178','186','189','188','190','202','205','203','206','221','237','239','238','243','246','254','253','255','277','276','275','278','284','289','288','294','293','295','310','313','324','336','347','346','345','348','349','351','352','361','362','366','367','382','393','411','415','413','419','422','434','442','447','453','467','471','472','475','551','554','559','564','568','573','029','030','077','126','127','131','155','156','267','297','319','350','353','354','357','358','368','376','385','386','414','417','457','459','469','473','474','477','552','558','560','570','574','575','576','579','600','601','602','603','604','605','606','607','608','609','610','611','612','613','614','615','616','617','618','619','620','621','622','623','624','625','626','627','628','629','630','631','632','633','634','635','636','637','638','639','640','641','642','643','644','645','646','647','648','650','651','652','653','654','655','656','657','950','951','952','953','954','955','956','957','958','959','960');
var maxsmiles = 3;
var smilesimgpath='<IMG border=0 src=http://img.legendbattles.ru/image/chat/smiles/';
var smilesimgstyle = ' style="cursor:pointer" onclick="ins_smile(\'';

function add_msg(text)
{
    var myRe = /script/ig;       
    var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
    var s = "";
    text = text.replace(myRe, 'скрипт');

    var spl = text.split("<BR>");
    for(var k=0; k<spl.length; k++)
    {
        var txt = spl[k];
        if(txt.length > 8)
        {
            var re = /\<font\s$/;
            if(re.test(txt)) continue;

            var i,j=0;
            for(i=0; i < sm.length; i++)
            {
                while(txt.indexOf(':'+sm[i]+':') >= 0)
                {
                    txt = txt.replace(':'+sm[i]+':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle+sm[i]+'\')">');
                    if (++j >= maxsmiles) break;
                }
                if(j >= maxsmiles) break;
            }
            if(txt.indexOf('<SPL>') > 0)
            {
                var msgp = txt.split('<SPL>');

                var j = msgp[1].indexOf('<SPAN>');
                var i = msgp[1].indexOf('</SPAN>');
                var user2;
                user2 = msgp[1].substring(j+6,i);

                if(msgp[2] !== '')
                {
                    msgp[2] = ' '+msgp[2];
                    if(pr.test (msgp[2]))
                    {
                        msgp[1] = '>>> '+msgp[1];
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                        while(msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                        if(user2 !== '') msgp[1] = msgp[1].replace('<SPAN>','<SPAN title="%'+user2+'">');
                        if(msgp[2].indexOf ('> '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(user,'<SPAN title="%'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=prchattime>');
                        }
                    }
                    else
                    {
                        while(msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                        if(msgp[2].indexOf (' '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(' '+user,' <SPAN title="'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=yochattime>');
                        }

                        msgp[2] = '&nbsp;для' + msgp[2];
                    }
                }
                txt = msgp.join('');
            }
            s += txt + "<BR>";
        }
    }
    e_m = get_by_id ('msg');
    e_m.innerHTML += s;
	window.scrollBy(0,65000);//SmartScroll;//SmartScroll
}


function get_by_id(name)
{
    if (document.getElementById) return document.getElementById(name);
    else return false;
  //else if (document.all) return document.all[name];
}
</script>
<?
function msg_add($p){
    $result = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `chat` WHERE (`login`='" . $p['login'] . "' OR `dlya`='<" . $p['login'] . ">' OR `dlya`='%<" . $p['login'] . ">') AND `login`!='sys' AND `dlya`!='%<mozg>' AND `dlya`!='%<SANTA>' ORDER by `id`;");
	echo "<script>";
    while ($row = mysqli_fetch_assoc($result)) {
		$ctimecolor="prchattime";
		$msg=$row["msg"];
		$dlya=$row["dlya"];
		$ot=$row["login"];
		$time=date("Y.m.d - H:i:s",$row["time"]); 
		$ctimecolor="clchattime";		
		$users=$dlya?'<SPL><font style="color: #'.$row['ot_color'].'"><SPAN>'.$ot.'</SPAN></font><SPL>'.$dlya.'<SPL>':'<SPAN>'.$ot.'</SPAN>:';
		echo "\nadd_msg('<font class=".$ctimecolor.">&nbsp;".$time."&nbsp;</font> ".$users." ".$msg;
	}
	echo "
	</script>";
}
?>
<link href="../../../css/game.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0">Прямое редактирование</li>
      <li class="TabbedPanelsTab" tabindex="0">Молчанки</li>
      <li class="TabbedPanelsTab" tabindex="0">Перевод NV</li>
      <li class="TabbedPanelsTab" tabindex="0">Исцеление</li>
      <li class="TabbedPanelsTab" tabindex="0">Установка образа</li>
      <li class="TabbedPanelsTab" tabindex="0">Обнуление</li>
      <li class="TabbedPanelsTab" tabindex="0">В тюрьму</li>
      <li class="TabbedPanelsTab" tabindex="0">БЛОК</li>
      <li class="TabbedPanelsTab" tabindex="0">Сообщение всем</li>
      <li class="TabbedPanelsTab" tabindex="0">Пересчет статов</li>
      <li class="TabbedPanelsTab" tabindex="0">казна</li>
      <li class="TabbedPanelsTab" tabindex="0">Пересчет статов для перса</li>
      <li class="TabbedPanelsTab" tabindex="0">Пересчет коэффа на артах</li>
    
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><table width="100%" border="0" cellspacing="0" cellpadding="0"><form action="player.php" method="post"><?
if($load){$i=0;
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$loginp' LIMIT 1;"));
	if($pl!=''){
		foreach($pl as $key=>$val){
			if($i==0){echo "<tr>";}
			$i++;
			echo "<td align=right>$key: <input name=pr[$key] type=text value='$val'></td>";
			if($i==3)
			{echo "</tr>";$i=0;}
		}
		echo'</tr>';
        /*echo'<tr><td colspan=3 align=center>ЧАТ игрока</td></tr>';
        if($pl['clan']!='Life'){
            echo'<tr><td colspan=3 align=left><div id=msg></div></td></tr>';
            echo'<tr><td colspan=3 align=center>'.msg_add($pl).'</td></tr>';
        }else{echo'<tr><td colspan=3 align=center>просмотр чата игроков клана LIFE - недоступен</td></tr>';}*/
	}
}

if($save){$i=0;
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE id='$idp' LIMIT 1;"));
if($pl!=''){
foreach($pr as $key=>$val){if($pr[$key]!=$pl[$key]){$str[]=" $key='$val'";}}
if(isset($str)){$str=implode(",",$str);
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET $str WHERE id='$idp' LIMIT 1;");
}
}$pl='';}
?>
                <? if ($pl == '') { ?><br><span class="logintext"> Введите логин: </span><input name="loginp"
                                                                                                type="text"
                                                                                                class="LogintextBox"/>
                    <input name="load" type="submit" value="Загрузить" class="lbut"/><? } else {
                    echo "<input name=idp type=hidden value=\"$pl[id]\" /> <input name=save type=submit value=Записать /> <input name=close type=submit value=\" x \" />";
                } ?></form>
</table></div>
    <div class="TabbedPanelsContent">
<form action="player.php" method="post">
    <span class="logintext">Логин:</span>
    <input name="login" type="text" class="LogintextBox" />

    <span class="logintext">Время:</span>
    <select name="time" class="LogintextBox6">
        <option value="300|5 мин" selected>5 мин</option>
        <option value="600|10 мин">10 мин</option>
        <option value="900|15 мин">15 мин</option>
        <option value="1800|30 мин">30 мин</option>
        <option value="3600|1 час">1 час</option>
        <option value="10800|3 часа">3 часа</option>
        <option value="86400|24 часа">24 часа</option>
</select>
    <input name="molch" type="submit" class="lbut" value="   Заткнуть  "/>
    <input name="nomolch" type="submit" class="lbut" value="   Снять молчанку  "/>
<? if($molch){
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login' LIMIT 1;"));
if($pl[login]!=''){
$time=explode("|",$time);
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET sleep=" . (time() + $time[0]) . " WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>$pl[login]</b> заклятие молчания сроком на <b>$time[1]</b> (Хранитель Игры).</font><BR>'+'');";
    chmsg($ms, '');
}
}
if($nomolch){
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login' LIMIT 1;"));
if($pl[login]!=''){
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET sleep='0' WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>Хранитель Игры</b> снял заклятие молчания с персонажа <b>$pl[login]</b>.</font><BR>'+'');";
    chmsg($ms, '');
}
}
?>        
</form>
    </div>
<div class="TabbedPanelsContent"><form action="player.php" method="post">
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/> <span
                class="logintext">Сумма:</span> <input name="NV" type="text" value="0" class="LogintextBox2"/>
        <input name="gmoney" type="submit" value="   Дать NV  " class="lbut"/>
<? if($gmoney){
    if ($NV != 0 and $login != '') {
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv=nv+$NV WHERE login='$login' LIMIT 1;");
if($NV>0){
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Получены <b>$NV NV</b> от <b>Хранителя Игры!</b></font><BR>'+'');";
    chmsg($ms, $login);
}
}
}
echo $login['id'];
?>        
</form></div>
<div class="TabbedPanelsContent"><form action="player.php" method="post">
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/>
        <input name="free" type="submit" value="   Снять все аффекты  " class="lbut"/>
<? if($free and $login!=''){
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='',viselica='' WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>Хранитель Игры</b> исцелил Вас от травм и развеял все чары.</font><BR>'+'');";
    chmsg($ms, $login);
}
?>        
</form>        </div>
<div class="TabbedPanelsContent"><form action="player.php" method="post" name="obraz">
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/>
<select name="gif" onChange="img();" class="LogintextBox2">
    <option selected="selected">Выберите</option>
          <?php 
if ($handle = opendir('http://img.legendbattles.ru/image/obrazy')) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";
    while (false !== ($file = readdir($handle))) { 
       if($i>=2){
	    echo "<option value=".$file.">$file</option>";
		}
		$i++;
    }
    closedir($handle);
}
?>
    </select>
        <input name="obr" type="submit" value="   Установить образ  " class="lbut"/>
<? if($obr and $login!=''){
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET obraz='$gif' WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>Хранитель Игры</b> установил Вам новый образ.</font><BR>'+'');";
    chmsg($ms, $login);
}?>
<div id="img"></div>
</form></div>
<div class="TabbedPanelsContent"><form action="player.php" method="post">
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/>
        <input name="obn" type="submit" value="   обнулить  " class="lbut"/></form>
    <br><br/>

<? if($obn){
	if($login!=''){
        $player = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='" . $login . "';"));
		obnul_pl($player);
	}
	else{
        $alluser = mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE type=1 AND id>9999;");
        while ($row = mysqli_fetch_assoc($alluser)) {
		obnul_pl($row);
	}
}

    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>Хранитель Игры</b> обнулил вашего персонажа.</font><BR>'+'');";
    chmsg($ms, $login);
} ?></div>

<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/> <span
                class="logintext">Время в днях: </span> <input name="time" type="text" value="0" class="LogintextBox2"/>
        <span class="logintext">Причина: </span> <input name="prich" type="text" maxlength="50" class="LogintextBox"/>
        <input name="prison" type="submit" value="   В тюрьму  " class="lbut"/>
        <input name="noprison" type="submit" value="   Выпустить  " class="lbut"/></form>
    <br><br>
<? if($prison){
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login' LIMIT 1;"));
if($time!=0 and $pl[login]!=''){
$tim=time()+($time*86400)."|$prich";
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET prison='$tim', mov='1',loc='33', pos='8_4' WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Персонаж <b>$pl[login]</b> отправлен в тюрьму (Хранитель Игры).</font><BR>'+'');$redirect";
    chmsg($ms, '');
}
}
if ($noprison and $login != '') {
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET prison='0' WHERE login='$login' LIMIT 1;");
}
?></div>


<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <span class="logintext">Логин:</span> <input name="login" type="text" class="LogintextBox"/> <span
                class="logintext">Причина: </span> <input name="prich" type="text" maxlength="50" class="LogintextBox"/>
        <input name="block" type="submit" value="   Блокировать  " class="lbut"/>
        <input name="unblock" type="submit" value="   Разблокировать  " class="lbut"/></form>
    <br><br>
<? if($block){
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login' LIMIT 1;"));
if($pl[login]!=''){
    if ($prich == '') {
        $prich = "Так надо";
    }
mysqli_query($GLOBALS['db_link'],"UPDATE user SET block='$prich' WHERE login='$login' LIMIT 1;");
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;НА персонажа <b>$pl[login]</b> наложено заклятие смерти. Пусть земля тебе будет пухом. (Хранитель Игры).</font><BR>'+'');$quit";
    chmsg($ms, $login);
    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;НА персонажа <b>$pl[login]</b> наложено заклятие смерти. Пусть земля тебе будет пухом. (Хранитель Игры).</font><BR>'+'');";
    chmsg($ms, '');
}}
if ($unblock and $login != '') {
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET block='' WHERE login='$login' LIMIT 1;");
}
?>
</div>

<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <span class="logintext">Сообщение:</span> <input name="message" type="text" length=1000 class="LogintextBox"/>
        <input name="textmessage" type="submit" value="   Отправить  " class="lbut"/></form>
    <br><br>
<?php
if($_POST['textmessage']){
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=#000000><b><font color=#FF0000>Внимание!</font></b> " . $_POST['message'] . "</font><BR>'+'');") . "');");
//    $ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp; $message </font><BR>'+'');";
//    chmsg($ms,'');
}
?>
</div>
      <!-- статы -->
<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <input name="stats" type="submit" value=" статы " class="lbut"/></form>
    <br><br>
<? if($stats){
    $users = mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE type=1");
    while ($row = mysqli_fetch_assoc($users)) {
	calcstat($row[id]);
}
}
?>

</div>
<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <input name="clans" type="submit" value=" чистка казны " class="lbut"/></form>
    <br><br>
<?
 if($clans){
     $sql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM clan_kazna WHERE clan_id='biohazard';");
     while ($row = mysqli_fetch_assoc($sql)) {
         $invsql = mysqli_query($GLOBALS['db_link'], "DELETE FROM invent WHERE id_item=" . $row[id_item] . ";");
         mysqli_query($GLOBALS['db_link'], "DELETE FROM clan_kazna WHERE id_item=" . $row[id_item] . ";");
		}
	}

/*
 if($clans){
	$sql=mysqli_query($GLOBALS['db_link'],"SELECT items.*,invent.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE master!='';");
	while($row = mysqli_fetch_assoc($sql)){
		mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".$row['price']." WHERE id=".$row['pl_id']."");
		mysqli_query($GLOBALS['db_link'],"DELETE FROM invent WHERE protype=".$row['protype'].";");
		mysqli_query($GLOBALS['db_link'],"DELETE FROM items WHERE id=".$row['protype'].";");
	}
}
*/
?>


  </div>
      <!-- статы перса -->
<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <span class="logintext">Логин:</span><input name="login" type="text" class="LogintextBox"/>
        <input name="statsp" type="submit" value=" статы " class="lbut"/>
</form><br><br>
<? if($statsp){
    $user = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='" . $login . "';"));
calcstat($user[id]);
}
?>
</div>
      <!-- коэфф артов -->
<div class="TabbedPanelsContent"><form action="player.php" method="post"><br>
        <input name="koeffart" type="submit" value=" пересчитать " class="lbut"/>
</form><br><br>
<?
if($koeffart){/*
	$artitems=mysqli_query($GLOBALS['db_link'],"SELECT * FROM items WHERE dd_price>0;");
	while ($row = mysqli_fetch_assoc($artitems)){
		calc_koeff($row);
	}*/
}
?>
</div>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>

<?

function calc_koeff($item){
	$newpar='';
	$koeff=0;
	$newkoeff=round($item['dd_price']/100);
	if($newkoeff>7){$newkoeff=7;}
	$par=explode("|",$item['param']);
	foreach($par as $key=>$val){
		if($par[$key]==''){$newpar.="";}
		else{
			$stat=explode("@",$val);
			if($stat[0]==71){
				$stat[1]=$newkoeff;
				$koeff=1;
			}
			$stat=implode("@",$stat);
			if($newpar==""){$newpar.="$stat";}
			else {$newpar.="|$stat";}
		}
	}
	if($koeff==0){$newpar.="|71@$newkoeff";}
    //$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;<b>$newpar</b> $item[name].</font><BR>'+'');";chmsg($ms,'');
    mysqli_query($GLOBALS['db_link'], "UPDATE items SET param='" . $newpar . "',master='' WHERE id=" . $item['id'] . ";");
}
function obnul($login){
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login' LIMIT 1;"));
switch($pl[level]){
case 0: $a=array(1=>15,1,2,10);break;
case 1: $a=array(1=>18,2,5,14);break;
case 2: $a=array(1=>21,2,9,19);break;
case 3: $a=array(1=>24,2,13,24);break;
case 4: $a=array(1=>29,3,18,28);break;
case 5: $a=array(1=>34,3,23,33);break;
case 6: $a=array(1=>39,3,29,39);break;
case 7: $a=array(1=>49,3,36,45);break;
case 8: $a=array(1=>56,4,44,52);break;
case 9: $a=array(1=>71,4,53,60);break;
case 10: $a=array(1=>78,5,65,70);break;
case 11: $a=array(1=>90,5,70,75);break;
case 12: $a=array(1=>100,6,85,85);break;
case 13: $a=array(1=>112,7,111,105);break;
case 14: $a=array(1=>127,7,126,120);break;
case 15: $a=array(1=>139,8,138,135);break;
case 16: $a=array(1=>154,9,153,155);break;
case 17: $a=array(1=>169,10,168,175);break;}

    mysqli_query($GLOBALS['db_link'], "UPDATE user SET sila=default,lovk=default,uda4a=default,zdorov=default,znan=default,mudr=default,obr_col=default,od=default,bl=default,free_stat=$a[1],hp=default,hp_all=default,mp=default,mp_all=default,hps=default,mps=default,chp=0,cmp=0,st='',umen='',perk='',fr_bum=$a[4],fr_mum=$a[3],nav=$a[2] WHERE id='$pl[id]' LIMIT 1;");
    mysqli_query($GLOBALS['db_link'], "UPDATE invent SET used=0 WHERE pl_id='$pl[id]';");
}




/*$exp=array(1=>15,1,2,10);
echo "case 0: ".'$a='."(1=>".$exp[1].",".$exp[2].",".$exp[3].",".$exp[4].");break;<br>";
for($i=0;$i<=16;$i++){$arr=exp_level($i);echo "case ".($i+1).": ".'$a='."(1=>".($exp[1]+=$arr[frs]).",".($exp[2]+=$arr[nav]).",".($exp[3]+=$arr[mum]).",".($exp[4]+=$arr[bum]).");break;<br>";}*/
?>
<script>
function img()
{
n=document.obraz; 
var name = n.gif.value;
document.all("img").innerHTML = "<img src=\"http://img.legendbattles.ru/image/obrazy/"+name+"\"  />";
}
    </script>
<? require('kernel/after.php'); ?>