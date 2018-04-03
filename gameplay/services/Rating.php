<?php
//
//include($_SERVER["DOCUMENT_ROOT"]."/system/config.php");
//include(DROOT."/includes/functions.php");
$RatingsName = array(
    'doktor' => 'ДОКТОРОВ',
    'lesorub' => 'ЛЕСОРУБОВ',
    'vor' => 'ВОРОВ',
    'ohotnichestvo' => 'ОХОТНИКОВ',
    'alhimiya' => 'АЛХИМИКОВ',
    'shahta' => 'ШАХТЕРОВ',
    'orujeynik' => 'ОРУЖЕЙНИКОВ',
    'yuvelir' => 'ЮВЕЛИРОВ',
    'rybalka' => 'РЫБАКОВ',
    'priruchenie' => 'ПРИРУЧАТЕЛЕЙ',
    'runolog' => 'РУНОЛОГОВ'
);
/*
<head>
	<meta http-equiv="Content-Language" content="ru">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="StyleSheet" href="/css/mn.css" />
	<title>Рейтинги онлайн игры MysteryLands (Мистические земли) - mystlands.com</title>
	<script language=JavaScript>function user_info(lg) {window.open(\'/ipers.php?\'+encodeURI(lg));}</script>
</head>
<body topmargin=30 leftmargin=30 style="background-image: url(\'/imgs/bgup.gif\'); background-repeat: repeat-x;">*/
?>
<tr>
    <td>
        <font class=proce><font color=#222222>
                <FIELDSET>
                    <LEGEND align=center><B><font color=gray>&nbsp;Рейтинги игроков&nbsp;</font></B></LEGEND>
                    <?
                    echo '
<style>
.fp {
font-family: "Palatino Linotype";
letter-spacing: 0.1pt;
color: #282828;

}
a {
color: #B70000;
text-decoration: none;
outline: none;
}
</style>
	<font size=2 class=fp>
		<div align=center>
			<div class=ramka style="width:420">
				<b>
				<a href="?mselect=25&r=doktor">ДОКТОРА</a> |
				<a href="?mselect=25&r=lesorub">ЛЕСОРУБЫ</a> |
				<a href="?mselect=25&r=vor">ВОРЫ</a> |
				<a href="?mselect=25&r=ohotnichestvo">ОХОТНИКИ</a> |
				<a href="?mselect=25&r=alhimiya">АЛХИМИКИ</a><br>
				<a href="?mselect=25&r=shahta">ШАХТЕРЫ</a> |
				<a href="?mselect=25&r=orujeynik">ОРУЖЕЙНИКИ</a> |
				<a href="?mselect=25&r=yuvelir">ЮВЕЛИРЫ</a> |
				<a href="?mselect=25&r=rybalka">РЫБАКИ</a><br>
				<a href="?mselect=25&r=priruchenie">ПРИРУЧАТЕЛИ</a> |
				<a href="?mselect=25&r=runolog">РУНОЛОГИ</a>
				</b>
			</div>
			<br />';
                    if (!isset($RatingsName[$_GET['r']])) {
                        exit;
                    }
                    echo '<b>
				<u>- РЕЙТИНГ ' . $RatingsName[$_GET['r']] . ' -</u>
			</b>
			<br />
			<font class=fi>last update: 16.10.2013 14:44:56</font>
			<div style=padding:4>
				<table>
					<tr>
						<td width=30>&nbsp;#</td>
						<td width=300>&nbsp;персонаж</td>
						<td colspan=2>&nbsp; очки</td>
					</tr>';
                    $i = 0;
                    //foreach(){
                    $i++;
                    echo '					<tr class=ramka>
						<td>
							<font size=2>&nbsp;' . $i . '</font>
						</td>
						<td>
							<font size=2 style="color:#2B3060"><!-- 602B34 -->
								&nbsp;<img border=0 title="Храм Равновесия (нейтрал)" src="../../img/ico_clan/22.gif" width=15 height=12>
								&nbsp;<img align=baseline title="Поклоняется Нейтральному богу - Фарлану" src="../../img/other/sk_neutral1.gif">
								&nbsp;<b>dim<img border=0 src="../../img/other/i.gif" onClick=javascript:user_info(\'dim\') width=15 height=15 align=absmiddle style=cursor:pointer></b> 
								<sup>29 - Эльф (Монах)</sup>
							</font>
						</td>
						<td width=15 align=center>
							<font size=2>
								<font title="+72" color=#0066FF>
									<b>&uarr;<!-- &darr; --></b>
								</font>
							</font>
						</td>
						<td width=60>
							<font size=2>
								&nbsp;72
							</font>
						</td>
					</tr>';
                    //}
                    echo '				</table>
			</div>
			<hr width=450>
		</font>
		<font color=#3D3E43>рейтинги обновляются каждые 48 часов</font>
	</div>
' ?>
                </fieldset></td>
</tr>
