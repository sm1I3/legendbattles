<? require('kernel/before.php');
session_start();
$_SESSION['filter'];
$inf = player();
?>

    <script>
        var user = '<?=$inf['sklon']?> <?=$inf['clan_gif']?> <?=$_SESSION['user']["login"]?>';
        var t;
        //document.onmousedown = function(event) { t_nick(event); };
        var sm = new Array('001', '002', '003', '004', '005', '007', '008', '009', '006', '010', '011', '012', '013', '014', '015', '016', '000', '018', '021', '022', '019', '023', '024', '025', '026', '027', '028', '031', '032', '034', '033', '037', '038', '036', '040', '039', '043', '049', '052', '056', '059', '057', '062', '066', '068', '073', '082', '080', '079', '083', '086', '085', '114', '118', '119', '123', '161', '158', '164', '167', '166', '170', '174', '177', '175', '179', '178', '186', '189', '188', '190', '202', '205', '203', '206', '221', '237', '239', '238', '243', '246', '254', '253', '255', '277', '276', '275', '278', '284', '289', '288', '294', '293', '295', '310', '313', '324', '336', '347', '346', '345', '348', '349', '351', '352', '361', '362', '366', '367', '382', '393', '411', '415', '413', '419', '422', '434', '442', '447', '453', '467', '471', '472', '475', '551', '554', '559', '564', '568', '573', '029', '030', '077', '126', '127', '131', '155', '156', '267', '297', '319', '350', '353', '354', '357', '358', '368', '376', '385', '386', '414', '417', '457', '459', '469', '473', '474', '477', '552', '558', '560', '570', '574', '575', '576', '579', '600', '601', '602', '603', '604', '605', '606', '607', '608', '609', '610', '611', '612', '613', '614', '615', '616', '617', '618', '619', '620', '621', '622', '623', '624', '625', '626', '627', '628', '629', '630', '631', '632', '633', '634', '635', '636', '637', '638', '639', '640', '641', '642', '643', '644', '645', '646', '647', '648', '650', '651', '652', '653', '654', '655', '656', '657', '950', '951', '952', '953', '954', '955', '956', '957', '958', '959', '960');
        var maxsmiles = 3;
        var smilesimgpath = '<IMG border=0 src=http://img.legendbattles.ru/image/chat/smiles/';
        var smilesimgstyle = ' style="cursor:pointer" onclick="ins_smile(\'';

        function add_msg(text) {
            var myRe = /script/ig;
            var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
            var s = "";
            text = text.replace(myRe, 'скрипт');

            var spl = text.split("<BR>");
            for (var k = 0; k < spl.length; k++) {
                var txt = spl[k];
                if (txt.length > 8) {
                    var re = /\<font\s$/;
                    if (re.test(txt)) continue;

                    var i, j = 0;
                    for (i = 0; i < sm.length; i++) {
                        while (txt.indexOf(':' + sm[i] + ':') >= 0) {
                            txt = txt.replace(':' + sm[i] + ':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle + sm[i] + '\')">');
                            if (++j >= maxsmiles) break;
                        }
                        if (j >= maxsmiles) break;
                    }
                    if (txt.indexOf('<SPL>') > 0) {
                        var msgp = txt.split('<SPL>');

                        var j = msgp[1].indexOf('<SPAN>');
                        var i = msgp[1].indexOf('</SPAN>');
                        var user2;
                        user2 = msgp[1].substring(j + 6, i);

                        if (msgp[2] !== '') {
                            msgp[2] = ' ' + msgp[2];
                            if (pr.test(msgp[2])) {
                                msgp[1] = '>>> ' + msgp[1];
                                while (msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                                while (msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                                if (user2 !== '') msgp[1] = msgp[1].replace('<SPAN>', '<SPAN title="%' + user2 + '">');
                                if (msgp[2].indexOf('> ' + user + ':') >= 0) {
                                    if (user2 !== '') msgp[2] = msgp[2].replace(user, '<SPAN title="%' + user2 + '">' + user + '</SPAN>');
                                    msgp[0] = msgp[0].replace('<font class=chattime>', '<font class=prchattime>');
                                }
                            }
                            else {
                                while (msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                                while (msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                                if (msgp[2].indexOf(' ' + user + ':') >= 0) {
                                    if (user2 !== '') msgp[2] = msgp[2].replace(' ' + user, ' <SPAN title="' + user2 + '">' + user + '</SPAN>');
                                    msgp[0] = msgp[0].replace('<font class=chattime>', '<font class=yochattime>');
                                }

                                msgp[2] = '&nbsp;для' + msgp[2];
                            }
                        }
                        txt = msgp.join('');
                    }
                    s += txt + "<BR>";
                }
            }
            e_m = get_by_id('msg');
            e_m.innerHTML += s;
            window.scrollBy(0, 65000);//SmartScroll;//SmartScroll
        }


        function get_by_id(name) {
            if (document.getElementById) return document.getElementById(name);
            else return false;
            //else if (document.all) return document.all[name];
        }
    </script>
<?php
function msg_add($p)
{
    $result = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `chat` WHERE (`login`='" . $p['login'] . "' OR `dlya`='<" . $p['login'] . ">' OR `dlya`='%<" . $p['login'] . ">') AND `login`!='sys' AND `dlya`!='%<mozg>' AND `dlya`!='%<SANTA>' ORDER by `id`;");
    echo "<script>";
    while ($row = mysqli_fetch_assoc($result)) {
        $ctimecolor = "prchattime";
        $msg = $row["msg"];
        $dlya = $row["dlya"];
        $ot = $row["login"];
        $time = date("Y.m.d - H:i:s", $row["time"]);
        $ctimecolor = "clchattime";
        $users = $dlya ? '<SPL><font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font><SPL>' . $dlya . '<SPL>' : '<SPAN>' . $ot . '</SPAN>:';
        echo "\nadd_msg('<font class=" . $ctimecolor . ">&nbsp;" . $time . "&nbsp;</font> " . $users . " " . $msg;
    }
    echo "
	</script>";
}

echo '
<HTML>
<HEAD>
<SCRIPT src="../../../js/slots.js"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
   <tr>
    <td align=center>
		<form method=post>
			Введите ник: <input type=text class=logintextbox6 name=perslogin> <input type=submit class=lbut value="Ok">
		</form>
	</td>
   </tr>
</table>
';
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/bbcodes.inc.php");

$player = player();
if ($_POST['perslogin']) {
    $_GET['id_adm'] = 2;
}
if ($_GET['perslogin'] and !$_POST['perslogin']) {
    $_POST['perslogin'] = $_GET['perslogin'];
}
if ($_POST['perslogin']) {

    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=1'"
                       value="получил уровень"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=2'"
                       value="получил опыт"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=3'"
                       value="изменения в балансе DLR"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=4'"
                       value="изменения в балансе BAKS"/>
            </td>
        </tr>
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=10'"
                       value="покупка в ДЦ"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=11'"
                       value="продажа в ДЦ"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=12'"
                       value="покупка в магазине"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=13'"
                       value="продажа в магазин"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=14'"
                       value="аренда в ДЦ"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=15'"
                       value="рассрочка в ДЦ"/>
            </td>
        </tr>
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=16'"
                       value="перевод другим персонажам (LR)"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=17'"
                       value="перевод другим персонажам (DLR)"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=20'"
                       value="покупка у игрока"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=21'"
                       value="продажа игроку"/>
            </td>
        </tr>
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=22'"
                       value="бонус по рефералке (LR)"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=23'"
                       value="лицензии"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=24'"
                       value="рынок"/>
            </td>
        </tr>
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&bank=1'"
                       value="БАНК И ДЦ"/>
            </td>
        </tr>
        <tr>
            <td align=center>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&id_adm=0'"
                       value="ВСЕ СРАЗУ"/>
                <input type="button" class="lbut"
                       onclick="location='player-actions.php?perslogin=<?php echo $_POST['perslogin']; ?>&chat=1'"
                       value="ЧАТ"/>
            </td>
        </tr>
        <tr>
    </table>
    <?php
    echo '<div align=center>Персонаж <b>' . $_POST['perslogin'] . '</b></div>';
    $filter = '';
    if ($_GET['id_adm'] != '' and $_GET['id_adm'] != '0') {
        $filter = 'AND `type` LIKE \'%@' . $_GET['id_adm'] . '\' ';
    }
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `login`='" . $_POST['perslogin'] . "' LIMIT 1;"));
    if ($_GET['chat'] == 1) {
        //if($pl['clan']!='Life'){
        echo '<table width="60%" border="1" cellspacing="1" cellpadding="0" align=center>';
        echo '<tr><td colspan=3 align=left><div id=msg></div></td></tr>';
        echo '<tr><td colspan=3 align=center>' . msg_add($pl) . '</td></tr></table>';
        //}else{echo'<tr><td colspan=3 align=center>просмотр чата игроков клана LIFE - недоступен</td></tr></table>';}
    } elseif ($_GET['bank'] == 1 and $pl['id']) {
        $bankid = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `bank` WHERE `pl_id`='" . $pl['id'] . "' LIMIT 1;"));
        $vklad = $player['vklad'] != 0 ? explode("|", $pl['vklad']) : $vklad[0] = "";
        $vklad[0] != "" ?
            $message = "Вложеные деньги: " . $vklad[1] . " LR.<br>Деньги к получению: " . $vklad[2] . " LR.<br>Дата получения: " . date("d.m.yг.", $vklad[0])
            : $message = "Игрок не имеет вкладов в банке";

        $vklad_dd = $player['vklad_bank'] != 0 ? explode("|", $pl['vklad_bank']) : $vklad_dd[0] = "";
        $vklad_dd[0] != "" ?
            $message2 = "Вложеные деньги: " . $vklad_dd[1] . " DLR.<br>Деньги к получению: " . $vklad_dd[2] . " DLR.<br>Дата получения: " . date("d.m.yг.", $vklad_dd[0])
            : $message2 = "Игрок не имеет вкладов в ДЦ";

        echo '<table width="60%" border="1" cellspacing="1" cellpadding="0" align=center>
			  <tr>
				<td align=center>Счет в банке: <b>' . ($bankid['num'] ? $bankid['num'] : 'нет') . '</b></td>
				<td align=center>Баланс ЛР (на счету): <b>' . ($bankid['lr'] >= 0 ? $bankid['lr'] : '0') . '</b></td>
				<td align=center>Баланс ДЛР (на счету): <b>' . ($bankid['dlr'] >= 0 ? $bankid['dlr'] : '0') . '</b></td>
				<td align=center><b>' . $message . '</b></td>
				<td align=center>Сейф в банке: <b>' . ($pl['seif'] > time() ? ' до ' . date("d.m.yг.", $pl['seif']) : ' сейф не арендован') . '</b></td>
			   </tr>
				<tr><td align=center colspan=5>Вклад в ДЦ:<br><b>' . $message2 . '</b></td></tr>			   
			   <tr><td align=center colspan=5>Вещи в банке:</td></tr>
			   ';
        $ITEMS = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='" . $pl['id'] . "' AND `invent`.`used`='0' AND `invent`.`clan`='0' AND `invent`.`bank`='1';");
        if (mysqli_num_rows($ITEMS) > 0) {
            echo '
				<table cellpadding=0 cellspacing=0 border=0 width=100% align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=60%>
				';
            if (mysqli_num_rows($ITEMS) > 0) {
                while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
                    if ($ITEM['dd_price'] > 0) {
                        $art = "weaponchart";
                    } else {
                        $art = "weaponch";
                    }
                    $iz = $ITEM['dolg'] - $ITEM['iznos'];
                    $ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'])] += 1;
                    if ($ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'])] == 1) {
                        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='" . $player['id'] . "' and `invent`.`used`='0' and `invent`.`dolg`='" . $ITEM['dolg'] . "' and `invent`.`iznos`='" . $ITEM['iznos'] . "' and `items`.`id`='" . $ITEM['id'] . "' and `invent`.`arenda`='" . $ITEM['arenda'] . "' and `invent`.`rassrok`='" . $ITEM['rassrok'] . "' and `invent`.`bank`='1' ORDER BY `items`.`dd_price`,`items`.`name`;"));
                        echo '
							<tr align=center>
							<td bgcolor=#f9f9f9 align=left width=50%>
							<font class=' . $art . '  style="margin: 0px 0px 0px 20px;"><b>' . $ITEM['name'] . '</b>&nbsp;[&nbsp;' . $ITEM['level'] . '&nbsp;]<a href="http://www.lifeiswar.ru/iteminfo.php?' . $ITEM['name'] . '" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0></a></font><font class=weaponch>' . (($count > 1) ? ' <font color="gray">(<b>' . $count . ' шт.</b>)</font>' : '') . '
							</td>
							</tr>
							';
                    }
                }

            } else {
                echo '<tr align=center><td class=nickname align=center><b>В банке игрока вещей нет</b></td></tr>';
            }
            echo '</table></table>';
        }
        echo '
			   </table>
			   ';
    } elseif ($_GET['dd'] == 1) {

    }

    if (!$_GET['chat'] and !$_GET['bank']) {
        $zapros = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user_actions` WHERE `pl_login`='" . $_POST['perslogin'] . "' " . $filter . " ORDER by `id` DESC;");
        echo '<table width="60%" border="1" cellspacing="1" cellpadding="0" align=center>
			  <tr>
				<td align=center><b>дата</b></td>
				<td align=center><b>ид игрока</b></td>
				<td align=center><b>логин игрока</b></td>
				<td align=center><b>ип игрока</b></td>
				<td align=center><b>лог</b></td>
			   </tr>';
        while ($row = mysqli_fetch_assoc($zapros)) {
            echo '
			 <tr>
				<td align=center>' . $row['time'] . '</td>
				<td align=center>' . $row['pl_id'] . '</td>
				<td align=center>' . $row['pl_login'] . '</td>
				<td align=center>' . $row['pl_ip'] . '</td>
				<td align=center>' . $row['pl_action'] . '</td>
			   </tr>';

        }
        echo '</table><br><br><br>';
    }

}
?>
<? require('kernel/after.php'); ?>