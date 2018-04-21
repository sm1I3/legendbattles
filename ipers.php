<?php
require $_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php";

function lr($lr)
{
    $b = $lr % 100;
    $s = intval(($lr % 10000) / 100);
    $g = intval($lr / 10000);
    return (($g) ? $g . ' <img src=img/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=img/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
}

if ($_GET['Ajax'] == 'yes') {
    if (strlen($_GET['q']) > 0) {

        $_GET['q'] = mysqli_real_escape_string($GLOBALS['db_link'], $_GET['q']);


        $GetUsers = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `login` LIKE '" . preg_replace("/[^a-zA-Zа-яА-Я0-9 _-]/", "", iconv("UTF-8", "utf-8", mysqli_real_escape_string($GLOBALS['db_link'], $_GET['q']))) . "%' ORDER BY `level` DESC LIMIT 7;");
        if (mysqli_num_rows($GetUsers) > 0) {
            while ($Row = mysqli_fetch_assoc($GetUsers)) {
                echo mysqli_real_escape_string($GLOBALS['db_link'], $Row['login']) . "\r\n";
            }
        }
    }
    exit;
}

$WatchUser = GetUser($_SESSION['user']['login']);

$FilesVersion = time();

if ($_POST['newnick']) {
    echo "<script type='text/javascript'> parent.location.href = '?" . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['newnick']) . "'; </script>";
}
if (!empty($_GET['info'])) {
    exit(header("Location: /ipers.php?" . (iconv("UTF-8", "utf-8", urldecode($_GET['info'])) ? iconv("UTF-8", "utf-8", urldecode($_GET['info'])) : urldecode($_GET['info']))));
}
if (!empty($_GET['userid'])) {
    $userid = $userid ?? varcheck($_POST['userid']) ?? varcheck($_GET['userid']) ?? '';
    exit(header("Location: /ipers.php?" . GetUserFID(intval($userid))));
}
if (empty($_GET["p"])) {
    $_GET["p"] = $_SERVER['QUERY_STRING'];
}
$pers = GetUser(varcheck($_GET["p"]));

if (!$pers['id']) {
    $_GET["p"] = urldecode($_GET["p"]);
    $_GET["p"] = preg_replace("/'/", "", $_GET["p"]);
    $pers = GetUser($_GET["p"]);
    if (!$pers['id']) {
        $pers = GetUser(urldecode($_GET["p"]));
        if (!$pers['id']) {
            $pers = GetUser(iconv("UTF-8", "utf-8", urldecode($_GET["p"])));
        }
    }
}

if (in_array($pers['login'], array("Администрация", "alexs", "J-V-C", "Starik"))) {
    if (empty($_GET['no_watch'])) {
        $_GET['bigObraz'] = true;
    }
}
if (!empty($pers['id']) and !empty($pers['login'])) {

    $prem = explode("|", $pers['premium']);
    $nst = explode("|", $pers['st']);
    $ust = 100 - round(($pers['ustal'] - time()) / (150 / ($nst[58] / 200 + 1)));
    if ($ust > 100) {
        $ust = 100;
    }
    for ($i = 5; $i <= 40; $i++) {
        if ($nst[$i] == '') {
            $nst[$i] = 0;
        }
    }

    foreach (explode("|", $pers['perk']) as $key => $val) {
        $perk[$key] = ($val ? $val : 0);
    }

    function LeftTime($time)
    {
        $day = floor($time / 86400);
        $ch = floor(($time - ($day * 86400)) / 3600);
        $min = floor(($time - (($ch * 3600) + ($day * 86400))) / 60);
        $sec = floor(($time - (($min * 60) + ($ch * 3600) + ($day * 86400))) % 60);
        return (($ch < 10) ? "0" . $ch : $ch) . ":" . (($min < 10) ? "0" . $min : $min) . ":" . (($sec < 10) ? "0" . $sec : $sec);
    }

    list($pers['y'], $pers['x']) = explode('_', $pers['pos']);
    if ($pers['loc'] != '28') {
        $location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `loc`,`room`,`city` FROM `loc` WHERE `id`='" . $pers['loc'] . "' LIMIT 1;"));
    } elseif ($pers['loc'] == '28') {
        $location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `city`,`name` FROM `nature` WHERE `x`='" . $pers['x'] . "' AND `y`='" . $pers['y'] . "' LIMIT 1;"));
        $location['room'] = $location['name'];
    }
    /* Data Base */
    $thotems = array('0' => 'Час Сфинкса', '1' => 'Час Саблезубого тигра', '2' => 'Час Мудрого Льва', '3' => 'Час Изумрудного Дракона', '4' => 'Час Василиска', '5' => 'Час Скорпиона', '6' => 'Час Ужасающей Рыбы', '7' => 'Час мутанта-острозуба', '8' => 'Час Небесного кита', '9' => 'Час Древнего Ящера', '10' => 'Час Ворона Смерти', '11' => 'Час Острых Клинков', '15' => 'Хеллоуин', '17' => 'Официальный дилер', '35' => 'Зам Администрации', '36' => 'Глава Администрации Проекта');
    $totemtime = Array('10', '20', '02', '00', '22', '18', '12', '04', '14', '06', '08', '16');
    $totembuff = Array('+100кб', '+50 оружейника', '+50 странника', 'невидимость', 'тотемное нападение', '+10 удачи и +50% уловки', '+10 ловкости и +50% точности', '+50 ювы', '+15 силы и +150 массы', '+50 наблюдательности', '+50 мф сокрушения и стойкости', '+20% опыта за бой');
    $sl_free = array('1' => 'sl_l_0.gif', 'sl_l_1.gif', 'sl_l_2.gif', 'sl_l_3.gif', 'sl_l_4.gif', 'sl_l_4.gif', 'sl_l_4.gif', 'sl_l_5.gif', 'sl_l_7.gif', 'sl_r_4.gif', 'sl_r_2.gif', 'sl_r_3.gif', 'sl_l_2.gif', 'sl_r_5.gif', 'sl_r_5.gif', 'sl_r_6.gif', 'sl_r_6.gif', 'sl_r_0.gif', 'sl_r_1.gif', 'rune_001.gif', 'rune_001.gif', 'rune_001.gif', 'rune_001.gif');
    $sl_nam = array('1' => 'Слот для шлема', 'Слот для ожерелья', 'Слот для оружия', 'Слот для пояса', 'Слот для содержимого пояса', 'Слот для содержимого пояса', 'Слот для содержимого пояса', 'Слот для сапог', 'Слот для поножей', 'Слот для наплечников', 'Слот для наручей', 'Слот для перчаток', 'Слот для оружия/щита', 'Слот для кольца', 'Слот для кольца', 'Слот для брони', 'Слот для брони', 'Слот для лука', 'Слот для содержимого кошелька', 'Слот для руны', 'Слот для руны', 'Слот для руны', 'Слот для руны');
    /* End Data Base */

    if (accesses($WatchUser['id'], 'pvu') and empty($_GET["no_watch"])) {
        exit('<title>' . (($pers['login']) ? $pers['login'] . ' - информация персонажа бесплатной браузерной онлайн игры legendbattles.' : 'Персонаж не найден.') . '</title><frameset rows="*,25" FRAMEBORDER=0 FRAMESPACING=2 BORDER=0 id="frmset"><frame src="/ipers.php?p=' . $pers["login"] . '&no_watch=yes" scrolling=auto FRAMEBORDER=0 BORDER=0 FRAMESPACING=0 MARGINWIDTH=0 MARGINHEIGHT=0 style="border-bottom-width: 2px; border-bottom-style: solid; border-bottom-color: #666666"><frame src="/ipers.php?p=' . $pers["login"] . '&no_watch=yes&watch_menu=yes" scrolling=yes FRAMEBORDER=0 BORDER=0 FRAMESPACING=0 MARGINWIDTH=0 MARGINHEIGHT=0></frameset>');
    }

    if (empty($pers['id']) and empty($_GET['watch_menu'])) {
        echo '<HTML><HEAD><title>Персонаж не найден.</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><LINK href="http://www.legendbattles.ru/css/error.css?v' . $FilesVersion . '" rel=STYLESHEET type=text/css><META content="text/html; charset=utf-8" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr>
  <td bgcolor=#FFFFFF><b><font color=#dd0000>Внимание! Персонаж не найден.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><b>Возможные причины:</b><br><b>1.</b> Вы ошиблись при вводе логина<br><b>2.</b> Проверьте расскладку клавиатуры<br><br><div align=center><form name=LoginForm method=post>Введите имя <input type=text class="LogintextBox2" style="text-align:center;" name=newnick onSubmit="javascript:  document.LoginForm.submit();" onBlur="if (value == \'\') {value=\'персонажа\'}" onFocus="if (value == \'персонажа\') {value =\'\'}" value="персонажа" title="Введите имя персонажа и нажмите &quot;Enter&quot;"> еще раз.</form></div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
    } elseif (!empty($_GET['bigObraz'])) {
        echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ENhttp://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<title>' . $pers['login'] . ' - информация персонажа бесплатной браузерной онлайн игры LegendBattles.</title> 
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/> 
<meta http-equiv=\"pragma\" Content=\"no-cache\"> 
<meta http-equiv=\"cache-control\" content=\"no-cache, no-store\"> 
<meta http-equiv=\"expires\" content=\"0\"> 
<meta name=\"description\" content=\"Информация персонажа бесплатной ролевой онлайн игры «legendbattles». Огромный фэнтезийный мир!\"> 
<LINK href=\"http://www.legendbattles.ru/css/game.css?' . $FilesVersion . '\" rel=STYLESHEET type=text/css>

<link href=\"http://www.legendbattles.ru/css/pinfo_v01.css?".$FilesVersion."\" rel=\"stylesheet\" type=\"text/css\"> 
<link href=\"http://www.legendbattles.ru/css/system.css?".$FilesVersion."\" rel=\"stylesheet\" type=\"text/css\"> 
<!--[if lt IE 7]>
<link href=\"./css/iepng.css?".$FilesVersion."\" rel=\"stylesheet\" type=\"text/css\">
<![endif]-->
</head>
<body>
<HEAD><LINK href=http://www.legendbattles.ru/css/game.css rel=STYLESHEET type=text/css><LINK href=http://www.legendbattles.ru/css/stl.css rel=STYLESHEET type=text/css><meta content="text/html; charset=utf-8" http-equiv=Content-type><META Http-Equiv=Cache-Control Content=no-cache><meta http-equiv=PRAGMA content=NO-CACHE><META Http-Equiv=Expires Content=0></HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699>
</style>
  <tr>
  <table cellpadding="0" cellspacing="0" border="0" align="center" width="800">
		</div>    <td>
<div class="block info">
	<div class="header">
		<span>' . $pers['login'] . '</span>
		</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
   <center> <embed  width="490" height="440" align="center" src="http://dwar.ru/images/data/user_pic/ka3aX_darkglow.swf" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
	<div class="header">
	</div>
	<div class="content">
	Проблема выбора между добром и злом стара, как мир. Без осознания сути добра и зла невозможно понять ни сущности нашего мира, ни роли каждого из нас в этом мире. Без этого теряют всякий смысл такие понятия, как совесть, честь, мораль, нравственность, духовность, истина, справедливость, свобода, греховность, праведность, порядочность, святость...
	<a href="?p=' . $pers['login'] . '&no_watch=yes"><center><font color=#dd0000>Перейти к игровой информации >>></a></center>
		</table>
	</div>
</div>
</body> 
</html>';
    } elseif (empty($_GET['watch_menu'])) {
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//ENhttp://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"> 
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\"> 
<head> 
<title>" . $pers['login'] . " - информация персонажа бесплатной браузерной онлайн игры legendbattles.</title> 
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/> 
<meta http-equiv=\"pragma\" Content=\"no-cache\"> 
<meta http-equiv=\"cache-control\" content=\"no-cache, no-store\"> 
<meta http-equiv=\"expires\" content=\"0\"> 
<meta name=\"description\" content=\"Информация персонажа бесплатной ролевой онлайн игры «legendbattles». Огромный фэнтезийный мир!\"> 
<LINK href=\"http://www.legendbattles.ru/css/game.css?'.$FilesVersion.'\" rel=STYLESHEET type=text/css>
<link href=\"http://www.legendbattles.ru/css/pinfo_v01.css?" . $FilesVersion . "\" rel=\"stylesheet\" type=\"text/css\"> 
<link href=\"http://www.legendbattles.ru/css/system.css?" . $FilesVersion . "\" rel=\"stylesheet\" type=\"text/css\"> 
<!--[if lt IE 7]>
<link href=\"./css/iepng.css?" . $FilesVersion . "\" rel=\"stylesheet\" type=\"text/css\">
<![endif]-->\n";

        if (accesses($WatchUser['id'], 'pvu')) {
            echo '<link href="http://www.legendbattles.ru/css/nl_calendar.css?' . $FilesVersion . '" rel="stylesheet" type="text/css">
<SCRIPT src="http://www.legendbattles.ru/js/ajax.js?' . $FilesVersion . '"></SCRIPT>
<SCRIPT src="http://www.legendbattles.ru/js/nl_pinfo_pvu.js?' . $FilesVersion . '"></SCRIPT>
<SCRIPT src="http://www.legendbattles.ru/js/nl_calendar.js?' . $FilesVersion . '"></SCRIPT>
';
        }
        echo "
<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.legendbattles.ru/css/social-likes.css?" . $FilesVersion . "\" media=\"screen\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.legendbattles.ru/css/themes/smodal.css\">
<script type=\"text/javascript\" src=\"http://www.legendbattles.ru/js/jquery-1.7.2.min.js?" . $FilesVersion . "\"></script>
<script type=\"text/javascript\" src=\"http://www.legendbattles.ru/js/social-likes.js?" . $FilesVersion . "\"></script>
<SCRIPT src=\"http://www.legendbattles.ru/js/pinfo_v02.js?" . $FilesVersion . "\"></SCRIPT> 
<SCRIPT src=\"http://www.legendbattles.ru/js/t_v01.js?" . $FilesVersion . "\"></SCRIPT> 
<SCRIPT src=\"http://www.legendbattles.ru/js/stooltip.js?" . $FilesVersion . "\"></SCRIPT>
<SCRIPT src=\"http://www.legendbattles.ru/js/jquery-1.7.2.min.js?" . $FilesVersion . "\"></SCRIPT>
<SCRIPT src=\"http://www.legendbattles.ru/js/jquery.autocomplete.js?" . $FilesVersion . "\"></SCRIPT>
<script type=\"text/javascript\" src=\"http://www.legendbattles.ru/js/jquery.cookie.js\"></script>
";
        echo '
<LINK href="http://www.legendbattles.ru/css/stl.css" rel="STYLESHEET" type="text/css">
<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
';
        if (accesses($WatchUser['id'], 'pvu')) {
            echo '<script type="text/javascript" src="/js/jquery.form.js"></script>';
            echo '
<link rel="stylesheet" type="text/css" href="http://www.legendbattles.ru/css/themes/smodal.css">
<script type="text/javascript" src="http://www.legendbattles.ru/js/jquery.smodal.js"></script>
<script type="text/javascript" src="http://www.legendbattles.ru/js/jquery.game.js"></script>';
        }

        $rt = ($pers['rating_1'] * 1 + $pers['rating_2'] * 2 + $pers['rating_3'] * 3 + $pers['rating_4'] * 4 + $pers['rating_5'] * 5) / ($pers['rating_1'] + $pers['rating_2'] + $pers['rating_3'] + $pers['rating_4'] + $pers['rating_5']);
        ?>
        <link href="http://www.legendbattles.ru/rating_sys/css/rating.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            $(document).ready(function () {
                total_reiting = <?
                $res = round($rt, 1);
                if (!is_nan($res))
                    echo $res;
                else
                    echo 0;
                ?>;
                id_arc = '<? echo htmlspecialchars($pers['login'])?>';
                id_brc = '<?=$_SESSION['user']['login']?>';
                var star_widht = total_reiting * 17;
                $('#raiting_votes').width(star_widht);
                $('#raiting_info b').append('<font color=#d77d31>' + total_reiting + '</font>');
                //     he_voted = $.cookie.get('article_' + id_arc + '_' + id_brc); // проверяем есть ли кука?
//he_voted = null;
                he_voted = null;
                if (he_voted == null) {
                    $('#raiting').hover(function () {
                            $('#raiting_votes, #raiting_hover').toggle();
                        },
                        function () {
                            $('#raiting_votes, #raiting_hover').toggle();
                        });
                    var margin_doc = $("#raiting").offset();
                    $("#raiting").mousemove(function (e) {
                        var widht_votes = e.pageX - margin_doc.left;
                        if (widht_votes == 0) widht_votes = 1;
                        user_votes = Math.ceil(widht_votes / 17);
                        $('#raiting_hover').width(user_votes * 17);
                    });
// отправка
                    $('#raiting').click(function () {
                        $('#raiting_info b, #raiting_info img').toggle();
                        $.get(
                            "/rating_sys/raiting.php",
                            {id_arc: id_arc, user_votes: user_votes},
                            function (data) {
                                $("#raiting_info b").html(data);
                                $('#raiting_votes').width((total_reiting + user_votes) * 17 / 2);
                                $('#raiting_info b, #raiting_info img').toggle();
                                //              $.cookie.set('article_' + id_arc + '_' + id_brc, 123, {hoursToLive: 48}); // создаем куку
                                $("#raiting").unbind();
                                $('#raiting_hover').hide();
                            }
                        )
                    });
                }
            });
        </script>

        <?
        echo "
<script type=\"text/javascript\">
var B, Browser = B = (function() {
    var uA = navigator.userAgent.toLowerCase();
    var version = ((uA.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1] || \"\").split(\".\");
    for (var i = 0; i < version.length; i++) {
        version[i] = parseInt(version[i], 10)
    }
    var versionNumber = 0;
    for (i = 0; i < version.length; i++) {
        versionNumber += Math.pow(10, 3 * (0 - i)) * version[i]
    }
    version = versionNumber;
    var B = {
        mobileSafari: (/apple.*mobile.*safari/).test(uA) ? version: NaN,
        iPad: !!(/ipad/).test(uA) && !!(/applewebkit/).test(uA) && parseFloat(uA.substring(uA.indexOf(\"os \") + \"os \".length, uA.indexOf(\" like mac os x\")).split(\"_\").join(\".\")),
        iPhone: !!(/iphone/).test(uA) && !!(/applewebkit/).test(uA) && parseFloat(uA.substring(uA.indexOf(\"os \") + \"os \".length, uA.indexOf(\" like mac os x\")).split(\"_\").join(\".\"))
    };
    B.iPhone = B.iPhone || B.android;
    return B
})();
function addBrowserNametoBody() {
    var body = document.body;
    body.className += \" \" + SC.Platform.Browser.toLowerCase();
    if (SC.Platform.isWindows) {
        body.className += \" windows\"
    } else {
        if (SC.Platform.isMac) {
            body.className += \" mac\"
        }
    }
}
showRadialBackground = false;
showRadialBackground = true;
</script>
</head> 
<body>";
        if (!empty($_GET['admin_move']) and ($WatchUser['login'] == 'Администрация')) {
            echo '<script language="JavaScript">
parent.window.opener.parent.frames[\'main_top\'].location = \'/main.php\';
parent.window.opener.parent.frames[\'ch_list\'].location = \'/ch.php?lo=1\';
</script>';
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='" . mysqli_real_escape_string($GLOBALS['db_link'], $pers['loc']) . "',`pos`='" . $pers['pos'] . "' WHERE `id`='" . $WatchUser['id'] . "'");
        }
        echo '
<style>
.transp{
	background: transparent !important;
}
img{
vertical-align:middle;
}
body{
';
## ники добавлять в одинарных кавычках через запятую ;
        $viplist = array('alexs', 'Админ', 'Администрация');
        if (!in_array($pers['login'], $viplist)) {
            echo "
	color : #222222
	";
        } else {
            echo "	
	color : #222222
	";
        }
        echo '
}
</style>
';
        echo "<SCRIPT language=\"JavaScript\">
$(document).ready(function() {
	$('#FormLists').autocomplete('/ipers.php', {
		extraParams:{
			'Ajax':'yes',
			'r':Math.random()
		}
	});
});
var presents = [";
        $presents = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `podarki` WHERE `id`='" . htmlspecialchars($pers['id']) . "';");
        $present = '';
        while ($row = mysqli_fetch_assoc($presents)) {
            $present .= '[\'f' . $row['podarok'] . '\',\'' . $row['message'] . '\'],';
        }
        if ($pers['clan_id'] == 'none') {
            $pers['clan_d'] = 'Вольный';
        }
        echo substr($present, 0, strlen($present) - 1);
        echo "];
var hpmp = [" . floor($pers['hp']) . "," . $pers['hp_all'] . "," . floor($pers['mp']) . "," . $pers['mp_all'] . "," . $ust . "];
var params = [['" . $pers['login'] . "'," . $pers['sklon'] . ",'" . (($pers['clan_id'] == 'chaos' or $pers['clan_id'] == 'none') ? 'none' : $pers['clan_gif']) . "','" . $pers['level'] . "/" . $pers['u_lvl'] . "','" . $pers['obraz'] . "','" . $location['city'] . "@" . (($location['room']) ? $location['room'] : $location['loc']) . (($WatchUser['login'] == 'Администрация') ? '<br />(<a href="?p=' . $_GET["p"] . '&no_watch=yes&admin_move=yes"><font color="red">' . $pers['x'] . ':' . $pers['y'] . '</font></a>)' : '') . "'," . (($pers['last'] < time() - 300) ? '0' : (($pers['invisible'] > time()) ? '0' : '1')) . "," . $pers['battle'] . ",'" . (($pers['clan_id'] == 'chaos') ? '' : $pers['clan']) . "','" . $pers['clan_d'] . "','Барус','" . date("d.m.Y", $pers['bdaypers']) . "','" . $pers['semija'] . "'],[['Сила'," . ($perk['7'] ? $pers['sila'] + 2 : $pers['sila']) . "," . $nst['30'] . "],['Ловкость'," . ($perk['9'] ? $pers['lovk'] + 2 : $pers['lovk']) . "," . $nst['31'] . "],['Везение'," . ($perk['10'] ? $pers['uda4a'] + 2 : $pers['uda4a']) . "," . $nst['32'] . "],['Разум'," . ($perk['11'] ? $pers['znan'] + 2 : $pers['znan']) . "," . $nst['34'] . "],['Здоровье'," . ($perk['8'] ? $pers['zdorov'] + 2 : $pers['zdorov']) . "," . $nst['33'] . "],['Сноровка'," . $pers['mudr'] . ",0]],[['Класс брони'," . ($perk['32'] ? $nst['9'] + 30 : $nst['9']) . "],['Уловка'," . ($perk['19'] ? $nst['5'] + 30 : $nst['5']) . "],['Точность'," . ($perk['0'] ? $nst['6'] + 30 : $nst['6']) . "],['Сокрушение'," . ($perk['5'] ? $nst['7'] + 30 : $nst['7']) . "],['Стойкость'," . ($perk['15'] ? $nst['8'] + 30 : $nst['8']) . "],['Пробой брони'," . $nst['10'] . "]]];\n";
        $slot = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . addslashes($pers['id']) . "' AND `used`='1' ORDER BY `invent`.`curslot`;");
        while ($row = mysqli_fetch_assoc($slot)) {
            if ($row['grav']) {
                $row['name'] = $row['name'] . " (" . $row['grav'] . ")";
            }
            $it = explode("|", $row['param']);
            switch ($row['mod_color']) {
                case 0:
                    $color = "";
                    $ecolor = "";
                    break;
                case 1:
                    $color = "<font color=#006600>";
                    $ecolor = "</font>";
                    break;
                case 2:
                    $color = "<font color=#3333CC>";
                    $ecolor = "</font>";
                    break;
                case 3:
                    $color = "<font color=#993399>";
                    $ecolor = "</font>";
                    break;
            }
            $modstat = '';
            $mod = explode("|", $row['mod']);
            foreach ($mod as $value) {
                $modstats = explode("@", $value);
                $modstat[$modstats[0]] = $modstats[1];
            }
            $par = '';
            foreach ($it as $value) {
                $stat = explode("@", $value);
                switch ($stat[0]) {
                    case 0:
                        $par[0] = $stat[1];
                        break;
                    case 1:
                        $tmp = '';
                        if ($modstat[1] != '') {
                            $tmp = explode("-", $modstat[1]);
                        }
                        $udar = explode("-", $stat[1]);
                        $par[1] = "|" . ($udar[0] + $tmp[0]) . "|" . ($udar[1] + $tmp[1]);
                        break;
                    case 9:
                        $par[2] = "|" . ($stat[1] + $modstat[9]);
                        break;
                    case 10:
                        $par[3] = "|" . $stat[1];
                        break;
                    case 27:
                        $par[4] = "|" . $stat[1];
                        break;
                    case 29:
                        $par[5] = "|" . $stat[1] . "|0";
                        break;
                }
                if ($row['dd_price'] > 0 and $row['dd_price'] < 500) {
                    $par[0] = 1;
                } elseif ($row['dd_price'] > 500) {
                    $par[0] = 2;
                } else {
                    $par[0] = 0;
                }
                $par[0] = ($par[0] ? $par[0] : 0);
                $par[1] = ($par[1] ? $par[1] : '|0|0');
                $par[2] = ($par[2] ? $par[2] : '|0');
                $par[3] = ($par[3] ? $par[3] : '|0');
                $par[4] = ($par[4] ? $par[4] : '|0');
                $par[5] = ($par[5] ? $par[5] : '|0|0');
            }
            switch ($row['mod_color']) {
                case 0:
                    $rnn = "<b>" . $row['name'] . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b>";
                    break;
                case 1:
                    $rnn = "<b><font color=#006600>" . $row['name'] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                    break;
                case 2:
                    $rnn = "<b><font color=#3333CC>" . $row['name'] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                    break;
                case 3:
                    $rnn = "<b><font color=#AF51B5>" . $row['name'] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                    break;
            }
            $sl_free[$row['curslot']] = $row['gif'];
            if ($sl_nam[$row['curslot']] != $row['name']) {
                $sl_nam[$row['curslot']] = $rnn . ":" . $par[0] . $par[1] . $par[2] . $par[3] . $par[4] . $par[5];
            }

        }
        echo "var slots = ['" . $sl_free[1] . ":" . $sl_nam[1] . "@" . $sl_free[2] . ":" . $sl_nam[2] . "@" . $sl_free[3] . ":" . $sl_nam[3] . "@" . $sl_free[4] . ":" . $sl_nam[4] . "@" . $sl_free[5] . ":" . $sl_nam[5] . "@" . $sl_free[6] . ":" . $sl_nam[6] . "@" . $sl_free[7] . ":" . $sl_nam[7] . "@" . $sl_free[8] . ":" . $sl_nam[8] . "@" . $sl_free[9] . ":" . $sl_nam[9] . "@" . $sl_free[10] . ":" . $sl_nam[10] . "@" . $sl_free[11] . ":" . $sl_nam[11] . "@" . $sl_free[12] . ":" . $sl_nam[12] . "@" . $sl_free[13] . ":" . $sl_nam[13] . "@" . $sl_free[14] . ":" . $sl_nam[14] . "@" . $sl_free[15] . ":" . $sl_nam[15] . "@" . (($sl_free[16] != 'sl_r_6.gif') ? $sl_free[16] : $sl_free[17]) . ":" . (($sl_nam[16] != 'Слот для брони') ? $sl_nam[16] : $sl_nam[17]) . "@" . $sl_free[17] . ":" . $sl_nam[17] . "@" . $sl_free[18] . ":" . $sl_nam[18] . "@" . $sl_free[19] . ":" . $sl_nam[19] . "@" . $sl_free[20] . ":" . $sl_nam[20] . "@" . $sl_free[21] . ":" . $sl_nam[21] . "@" . $sl_free[22] . ":" . $sl_nam[22] . "@" . $sl_free[23] . ":" . $sl_nam[23] . "@'];";

        $achievements = explode("|", $pers['achievements']);
        echo "var achievements = ['" . htmlspecialchars($achievements[0]) . "','" . htmlspecialchars($achievements[1]) . "','" . htmlspecialchars($achievements[2]) . "','" . htmlspecialchars($achievements[3]) . "','" . htmlspecialchars($achievements[4]) . "','" . htmlspecialchars($achievements[5]) . "','" . htmlspecialchars($achievements[6]) . "','" . htmlspecialchars($achievements[7]) . "','" . htmlspecialchars($achievements[8]) . "','" . htmlspecialchars($achievements[9]) . "','" . htmlspecialchars($achievements[10]) . "','" . htmlspecialchars($achievements[11]) . "','" . htmlspecialchars($achievements[12]) . "','" . htmlspecialchars($achievements[13]) . "','" . htmlspecialchars($achievements[14]) . "','" . htmlspecialchars($achievements[15]) . "','" . htmlspecialchars($achievements[16]) . "','" . htmlspecialchars($achievements[17]) . "','" . htmlspecialchars($achievements[18]) . "','" . htmlspecialchars($achievements[19]) . "','" . htmlspecialchars($achievements[20]) . "','" . htmlspecialchars($achievements[21]) . "','" . htmlspecialchars($achievements[22]) . "','" . htmlspecialchars($achievements[23]) . "','" . htmlspecialchars($achievements[24]) . "','" . htmlspecialchars($achievements[25]) . "','" . htmlspecialchars($achievements[26]) . "','" . htmlspecialchars($achievements[27]) . "'];";

        if (effects($pers['affect'], 0) != '') {
            $traw = effects($pers['affect'], 1);
        } else {
            $traw = 0;
        }
//эффекты зелий
        $buffs = explode("|", $pers['buffs']);
        $buffcount = '';
        foreach ($buffs as $value) {
            $buff = explode("@", $value);
            $buffcount[$buff[0]] += $buff[1];
            $buff[2] -= time();
            $ch[$buff[0]] = floor($buff[2] / 3600);
            $min[$buff[0]] = floor(($buff[2] - ($ch[$buff[0]] * 3600)) / 60);
            $time[$buff[0]] = $ch[$buff[0]] . "ч." . $min[$buff[0]] . "м.";
            switch ($buff[0]) {
                case 1:
                    $buffname[$buff[0]] = "[101,'<b>Мощь</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//Мощь
                case 2:
                    $buffname[$buff[0]] = "[102,'<b>Проворность</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//Проворность
                case 3:
                    $buffname[$buff[0]] = "[103,'<b>Везение</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//Везение
                case 4:
                    $buffname[$buff[0]] = "[104,'<b>Здоровье</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//здоровье
                case 5:
                    $buffname[$buff[0]] = "[105,'<b>Разум</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//Разум
                case 6:
                    $buffname[$buff[0]] = "[999,'<b>Сноровка</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//сноровка
                case 7:
                    $buffname[$buff[0]] = "[111,'<b>Удар</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//удар
                case 8:
                    $buffname[$buff[0]] = "[110,'<b>КБ</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//кб
                case 9:
                    $buffname[$buff[0]] = "[112,'<b>Пробой брони</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//пробой брони
                case 10:
                    $buffname[$buff[0]] = "[106,'<b>Уловка</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//уловка
                case 11:
                    $buffname[$buff[0]] = "[107,'<b>Точность</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//точность
                case 12:
                    $buffname[$buff[0]] = "[108,'<b>Сокрушение</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//сокрушение
                case 13:
                    $buffname[$buff[0]] = "[109,'<b>Стойкость</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//стойкость
                case 14:
                    $buffname[$buff[0]] = "[100,'<b>Ангел</b> +" . $buffcount[$buff[0]] . "% (еще " . $time[$buff[0]] . ")'],";
                    break;//арт зелье
                case 15:
                    $buffname[$buff[0]] = "[113,'<b>Наблюдательность</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//зелье наблюдательности
                case 16:
                    $buffname[$buff[0]] = "[10,'<b>Странник</b> +" . $buffcount[$buff[0]] . " (еще " . $time[$buff[0]] . ")'],";
                    break;//странник

            }
        }
//Статистика
        $wins = explode("|", $pers['wins']);
        $xx = 0;
        while ($xx <= 4) {
            $wins[$xx] = (($wins[$xx] != '' and $wins[$xx] > 0) ? $wins[$xx] : 0);
            $xx++;
        }
        echo "var warstats = ['" . $wins[0] . "','" . $wins[1] . "','" . $wins[2] . "','" . $wins[3] . "','" . mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `quest_tasks` WHERE `task_complete`='1' AND `playerid`='" . $pers['id'] . "'")) . "'];";
//
//опыт
        $exp = explode("|", $pers['exp']);
        $xyz = array_sum($exp);
        echo "var exp = ['" . htmlspecialchars($xyz) . "','" . htmlspecialchars($exp[0]) . "','" . htmlspecialchars($exp[1]) . "','" . htmlspecialchars($exp[2]) . "'];";
        if ($pers['fcolor_time'] > time() or $pers['fcolor_time'] == 0) {
            $nickclr = $pers['fcolor'];
        } else {
            $nickclr = '666';
        }
        echo "var fcolor = ['" . $nickclr . "',''];";
//
        echo "
var hacker = " . $pers['vzlomshik_nav'] . ";
var hacker = " . $pers['palac'] . ";
var ability = [[" . $pers['thotem'] . ",'" . $thotems[$pers['thotem']] . "'" . ($totemtime[$pers['thotem']] ? ",'Время действия: c " . $totemtime[$pers['thotem']] . ".00 до " . ($totemtime[$pers['thotem']] + 2) . ".00','Бонус во время действия: " . $totembuff[$pers['thotem']] . "'" : '') . "]" . (accesses($pers['id'], 'dealer') ? ((accesses($pers['id'], 'dealer', 1) != 3) ? ",[17,'Официальный дилер']" : "") : "") . "];
var effects = [";
        $effects = '';
        $pers['prison'] = explode("|", $pers['prison']);
        $effects .= (($pers['block']) ? '[15,\'<b>Блок</b> (' . $pers['block'] . ')\'],' : '');
        $effects .= (($pers['prison'][0] > time()) ? '[16,\'<b>Тюрьма</b> (' . $pers['prison'][1] . ')\'],' : '');
        $effects .= (($pers['sleep'] > time()) ? '[17,\'<b>Заклинание молчания</b> (еще ' . LeftTime($pers['sleep'] - time()) . ')\'],' : '');
        $effects .= (($pers['forum_lastmsg'] > time()) ? '[18,\'<b>Форумная молчанка</b> (еще ' . LeftTime($pers['forum_lastmsg'] - time()) . ')\'],' : '');
        $i = 1;
        while ($i <= 16) {
            $effects .= (($buffname[$i] != '') ? $buffname[$i] : '');
            $i++;
        }
        $effects .= (($traw) ? $traw : '');
        echo substr($effects, 0, strlen($effects) - 1);
        echo "];\n";
        if (accesses($WatchUser['id'], 'pvu')) {
            if ($pers['login'] == 'Администрация' or $pers['clan_id'] == 'Life' or $pers['sign'] == 'kgTvx2WrEZ') {
                $pers['ip'] = '0.0.0.0';
                $pers['lastip'] = '0.0.0.0';
            }
            if ($WatchUser['login'] == 'Админ' or $WatchUser['login'] == 'Администрация' or $WatchUser['login'] == 'alexs' or $WatchUser['clan_id'] == 'Life') {
                echo "var info = ['" . $pers['name'] . "','" . $pers['country'] . "','" . $pers['city'] . "'," . (($pers['sex'] == 'male') ? '0' : '1') . ",'" . $pers['url'] . "','<a href=mailto:" . $pers['email'] . ">" . $pers['email'] . "</a>','" . $pers['bday'] . "','" . $pers['icq'] . "','" . $pers['id'] . "','" . (($pers['ip'] != $pers['lastip']) ? '<a href="http://ip2geolocation.com/?ip=' . $pers['lastip'] . '" target="_blank">' . $pers['lastip'] . '</a> > <a href="http://ip2geolocation.com/?ip=' . $pers['ip'] . '" target="_blank">' . $pers['ip'] . '</a>' : '<a href="http://ip2geolocation.com/?ip=' . $pers['ip'] . '" target="_blank">' . $pers['ip'] . '</a>') . "','" . date("d.m.Y H:i:s", $pers['last'] ? $pers['last'] : 0) . "',[" . $pers['id'] . ",0,'123'],'" . lr($pers['nv'], 2) . "','" . round($pers['baks'], 2) . " <img src=http://www.legendbattles.ru/img/razdor/emerald.png width=14 height=14 valign=middle title=Изумруд>',1,'" . $pers['bprise'] . "'];\n";
            } else {
                echo "var info = ['" . $pers['name'] . "','" . $pers['country'] . "','" . $pers['city'] . "'," . (($pers['sex'] == 'male') ? '0' : '1') . ",'" . $pers['url'] . "','<a href=mailto:" . $pers['email'] . ">" . $pers['email'] . "</a>','" . $pers['bday'] . "','" . $pers['icq'] . "','" . $pers['id'] . "','" . (($pers['ip'] != $pers['lastip']) ? '<a href="http://ip2geolocation.com/?ip=' . $pers['lastip'] . '" target="_blank">' . $pers['lastip'] . '</a> > <a href="http://ip2geolocation.com/?ip=' . $pers['ip'] . '" target="_blank">' . $pers['ip'] . '</a>' : '<a href="http://ip2geolocation.com/?ip=' . $pers['ip'] . '" target="_blank">' . $pers['ip'] . '</a>') . "','" . date("d.m.Y H:i:s", $pers['last'] ? $pers['last'] : 0) . "',[" . $pers['id'] . ",0,'123'],'" . lr($pers['nv'], 2) . "','недоступно','недоступно','" . $pers['bprise'] . "'];\n";
            }
        } else {
            echo "var info = ['" . $pers['name'] . "','" . $pers['country'] . "','" . $pers['city'] . "'," . (($pers['sex'] == 'male') ? '0' : '1') . ",'" . $pers['url'] . "','','','" . $pers['icq'] . "','','','" . date("d.m.Y H:i:s", $pers['last'] ? $pers['last'] : 0) . "',[],''];\n";
        }
        echo "var premium = " . htmlspecialchars($prem[0]) . ";\n";
        echo "view_pinfo_top();
</SCRIPT>
" . str_replace("\n", "<br/>", $pers['about']) . "</div></td><td class=\"right_middle\"></td></tr><tr><td class=\"left_bot\"></td><td class=\"center_bot\"></td>
<td class=\"right_bot\"></td></tr></table>";
        if (accesses($WatchUser['id'], 'pvu')) {
            echo '<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"></div></td><td class="center_top"><div class="top_name_right">Дополнительно</div></td><td class="right_top"></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;"><div class="text" style="width:100%;">';
            echo str_replace("\n", "<br/>", $pers['addon']);
            echo "</div></td><td class=\"right_middle\"></td></tr><tr><td class=\"left_bot\"></td><td class=\"center_bot\"></td><td class=\"right_bot\"></td></tr></table>";
        }


        echo "
</div>
<SCRIPT language=\"JavaScript\"> 
view_pinfo_bottom();
</SCRIPT> 
<script type=\"text/javascript\" src=\"http://www.legendbattles.ru/js/canvas.js?" . $FilesVersion . "\"></script>
<div id='basic-modal-content'>
</div>
</body> 
</html>";
    }
    if ($_GET['watch_menu'] == 'yes' and accesses($WatchUser['id'], 'pvu')) {
        echo '<HEAD><LINK =href"http://www.legendbattles.ru/css/game.css?' . $FilesVersion . '" rel=STYLESHEET type=text/css><LINK href="http://www.legendbattles.ru/ch/chat.css?' . $FilesVersion . '" rel=STYLESHEET type=text/css><meta content="text/html; charset=utf-8" http-equiv=Content-type><META Http-Equiv=Cache-Control Content=no-cache><meta http-equiv=PRAGMA content=NO-CACHE><META Http-Equiv=Expires Content=0><SCRIPT src="http://www.legendbattles.ru/js/ajax.js?' . $FilesVersion . '"></SCRIPT>
<SCRIPT src="http://www.legendbattles.ru/js/pvu_menu.js?' . $FilesVersion . '"></SCRIPT>
</HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699><table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FCFAF3 align=center><font class=nickname><b>Панель Представителей Власти</b>' . ($_GET['popup'] ? '' : ' <a href="javascript:ShowHide_wtch()" id="wtch">[Показать]</a>') . '</font></td></tr></table><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#Ffffff><img src=http://www.legendbattles.ru/img/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#B9A05C><img src=http://www.legendbattles.ru/img/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#F3ECD7><img src=http://www.legendbattles.ru/img/image/1x1.gif width=1 height=2></td></tr></table>
<div align="center">';
        include(DROOT . "/includes/functions/watchers.php");
        echo '</div>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="2">
      <tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="5" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF" align="center"><script>
				var fdata = [' . accesses($WatchUser['id'], 'pvu', 1) . ',\'' . $pers['login'] . '\'];
				var fbut = \'' . $WatchUser['login'] . '\';
				ViewPage();
				</script></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
';
    }

}
echo 13456789;
?>