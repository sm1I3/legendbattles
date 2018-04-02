<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
include($_SERVER["DOCUMENT_ROOT"].'/includes/ks_antiddos.php');

$ksa = new ks_antiddos();
$ksa->doit(10,10);

// разрешаем 10 хитов за 20 секунд
?><!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="keywords"
          content="браузерная онлайн игра, бесплатные онлайн игры, лучшие онлайн игры, online, game, рпг, рпг игры, скачать игры, mmorpg, mmorpg игра, онлайн рпг, rpg, rpg игры, игры онлайн, офис игры, ролевые онлайн игры, игры бесплатно, бесплатная игра, ММОРПГ, стратегия, фентези, fantasy, online игры, online игра, играть, игры, интернет игры, компьютерные игры, онлайн игры , buhs jykfq,hgu buhs,buhs d gvh,рпг игра legendBattles.ru,"/>
    <meta name="description"
          content="Официальный сайт бесплатной ролевой онлайн игры «LegenBattles». Огромный фэнтезийный мир.Заходи каждый день на сайт «legendBattles.ru» и играй в лучшую рпг игру для получения навыков и побед в игре «legend bat» .Властвуй целым миром legend bat."/>

    <title>Legend Battles — бесплатная онлайн игра | Браузерная MMORPG онлайн игра — одна из старейших бесплатных
        ролевых online игр. Скачать и играть в лучшую многопользовательскую RPG игру онлайн бесплатно.</title>

	<link rel="stylesheet" href="/v2/style/css.php?f=jquery.formstyler|jquery.powertip|main|index">

	<meta name="interkassa-verification" content="dc08e57d698a83818811fd112c9fea59" />
	<script type="text/javascript" language="javascript" src="/v2/js/jquery.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/v2/js/swfobject.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/v2/js/cufon.js" charset="utf-8"></script>

	<script type="text/javascript" language="javascript" src="/v2/fonts/PTSans_400-PTSans_700.font.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/v2/js/jquery.formstyler.min.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/v2/js/jquery.powertip.min.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/v2/js/main.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="/js/signs.js" charset="utf-8"></script>
	<SCRIPT type="text/javascript" src="js/tools/sm2.js"></SCRIPT>
	<script type="text/javascript" language="javascript" src="js/cookie.js"></script>
</head>
<body>
	<div class="b-main-wrapper">
		<div class="b-main">
			<div class="b-mainmenu">
				<a href="/index.php" class="b-mainmenu__item-red b-mainmenu__item-red_first" >
                    <span class="b-mainmenu__item-red-inner" data-font="PTSans">ГЛАВНАЯ</span>
				</a>
					<a href="/password.php" class="b-mainmenu__item-yellow b-mainmenu__item-yellow">
                        <span class="b-mainmenu__item-yellow-inner" data-font="PTSansBlack"><cufon
                                    class="cufon cufon-canvas" alt="Востановления пароля"
                                    style="width: 51px; height: 14px;"><canvas width="57" height="18"
                                                                               style="width: 57px; height: 18px; top: -2px; left: 0px;"></canvas><cufontext>Востановления пароля</cufontext></cufon></span>
				</a>
				<a href="http://forum.legendbattles.ru/" class="b-mainmenu__item-red b-mainmenu__item-red_last" >
                    <span class="b-mainmenu__item-red-inner" data-font="PTSans">ФОРУМ</span>
				</a>
			</div>

			<div class="b-header">
				<a href="#" class="b-logo">
					<img src="/v2/images/locale/ru/images/logo.png" alt="Legend Battles" class="b-logo__img" />
				</a>
			</div>

			<div class="b-column-wrapper clearfix">
				<div class="b-column-left">
					<div class="b-main-frame b-main-frame_left-side">
						<span class="b-main-frame__l"></span>
						<span class="b-main-frame__t"></span>
						<span class="b-main-frame__b"></span>

						<span class="b-main-frame__decor-tl"></span>
						<span class="b-main-frame__decor-tl-2"></span>

						<span class="b-main-frame__decor-bl"></span>

                        <div class="b-main-frame__cont">
							<div class="b-index-decor b-index-decor_right">
								<a href="/world.php" class="b-button-red-large b-button-red-large_enter-game" onclick="return openPopup('#authPopup');">
                                    <span class="b-button-red-large__inner" data-font="PTSans">Войти в игру</span>
								</a>
								<a href="/reg.php" class="b-button-blue-large b-button-blue-large_download" onclick="return openPopup('#regPopup');">
                                    <span class="b-button-blue-large__inner" data-font="PTSans">Регистрация</span>
								</a>
								<script type="text/javascript">
									$(function() {
										var Ratings = {
											section: "users",
											kind: "0",
											type: "rating"
										};

										$('#ratings').find('a.b-button-brown').on('click', function(e) {
											e.preventDefault();
											switch ($(this).data('field')) {
												case 'section':
													Ratings.section = $(this).data('field-value');
													break;
												case 'type':
													Ratings.type = $(this).data('field-value');
													break;
											}
											$('#ratings').find('table.b-ratings__table').hide();
											$('#rating-' + [Ratings.section, Ratings.type, Ratings.kind].join('-')).show();
											$(this).siblings().removeClass('b-button-brown_active');
											$(this).addClass('b-button-brown_active');
										});

										$('#ratings').find('a.b-button-brown-2').on('click', function(e) {
											e.preventDefault();
											Ratings.kind = $(this).data('field-value');
											$('#ratings').find('table.b-ratings__table').hide();
											$('#rating-' + [Ratings.section, Ratings.type, Ratings.kind].join('-')).show();
											$(this).siblings().removeClass('b-button-brown-2_active');
											$(this).addClass('b-button-brown-2_active');
										});

										$('#rating-' + [Ratings.section, Ratings.type, Ratings.kind].join('-')).show();
									});
								</script>

                                <div class="b-common-block" id="ratings">
		<span class="b-common-block__l"></span>
		<span class="b-common-block__r"></span>
		<span class="b-common-block__t b-common-block__t_2"></span>
		<span class="b-common-block__b"></span>

		<span class="b-common-block__bl"></span>
		<span class="b-common-block__br"></span>

		<span class="b-common-block__header-decor-l"></span>
		<span class="b-common-block__header-decor-r"></span>

		<span class="b-common-block__header">
			<span class="b-common-block__header-inner">
                <span data-font="PTSans">Рейтинги</span>
			</span>
		</span>

		<div class="b-common-block__cont">
			<div class="b-common-block__bgl">
				<div class="b-common-block__bgr clearfix">
					<div class="b-ratings">
						<table cellspacing="2" class="b-ratings__table">
							<tbody><?php
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM  `rating_user` ORDER BY `score` DESC LIMIT 10");
$i=0;
echo'<tr>
	<td colspan="2">
		<div class="b-divider-3">
			<div class="b-divider-3__l">
				<div class="b-divider-3__l-inner"></div>
			</div>
			<div class="b-divider-3__c"></div>
			<div class="b-divider-3__r">
				<div class="b-divider-3__r-inner"></div>
			</div>
		</div>
	</td>
</tr>';
while ($row = mysqli_fetch_assoc($Query)){
$i++;
echo'<tr>
	<td class="b-ratings__table__num">
		<b class="text-orange">'.$i.'</b>
	</td>
	<td>
		<table class="b-ratings__table-inner">
			<tbody>
				<tr>
					<td>
						<b class="text-orange">'.$row['user'].'</b>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>';
}
echo'<tr>
	<td colspan="2">
		<div class="b-divider-3">
			<div class="b-divider-3__l">
				<div class="b-divider-3__l-inner"></div>
			</div>
			<div class="b-divider-3__c"></div>
			<div class="b-divider-3__r">
				<div class="b-divider-3__r-inner"></div>
			</div>
		</div>
	</td>
</tr>';
				?></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

                                <div class="b-common-block">
		<span class="b-common-block__l"></span>
		<span class="b-common-block__r"></span>
		<span class="b-common-block__t b-common-block__t_2"></span>
		<span class="b-common-block__b"></span>

		<span class="b-common-block__bl"></span>
		<span class="b-common-block__br"></span>

		<span class="b-common-block__header-decor-l"></span>
		<span class="b-common-block__header-decor-r"></span>

		<span class="b-common-block__header">
			<span class="b-common-block__header-inner">
				<span data-font="PTSans">Сообщества</span>
			</span>
		</span>

		<div class="b-common-block__cont">
			<div class="b-common-block__bgl">
				<div class="b-common-block__bgr clearfix">
					<div class="b-communities text-center">
												<a href="http://www.odnoklassniki.ru/" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_odkl"></i>
						</a>

                        <a href="http://www.facebook.com/" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_fb"></i>
						</a>

                        <a href="http://twitter.com/" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_tw"></i>
						</a>

                        <a href="http://vk.com/public76407285" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_vk"></i>
						</a>

                        <a href="http://my.mail.ru" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_mailru"></i>
						</a>

                        <a href="https://plus.google.com" target="_blank" class="b-communities__link">
							<i class="b-icon-soc-64x64 b-icon-soc-64x64_gp"></i>
						</a>
											</div>
				</div>
			</div>
		</div>
	</div>

                            </div>
						</div>
					</div>
				</div>

                <div class="b-column-right">
					<div class="b-main-frame">
						<span class="b-main-frame__l"></span>
						<span class="b-main-frame__r"></span>
						<span class="b-main-frame__t"></span>
						<span class="b-main-frame__b"></span>

                        <span class="b-main-frame__decor-tr"></span>
						<span class="b-main-frame__decor-tr-2"></span>

                        <span class="b-main-frame__decor-bl"></span>
						<span class="b-main-frame__decor-br"></span>

                        <div class="b-main-frame__cont">
							<div class="b-index-decor b-index-decor_left">
										<script type="text/javascript">
			$(function() {
				var data = [{"id":"1","title":"\u0441\u0443\u0432\u0435\u043d\u0438\u0440","url":"http:\/\/forum.legendbattles.ru","target":"_blank","picture":"","flash":"\/gl.baner.swf","block":"1","stime":"1375189020","etime":"0","pos":"1","server_flags":"1","flags":"1"}];
				var $banners = $('#banners');
				var $switch = $banners.find('.b-banner-switch');
				var $cont = $banners.find('.b-banner-frame__cont');
				var timer;
				var current = 0;

				function bannerCreateMenu() {
					var count = data.length;
					if (count < 2) {
						$switch.hide();
					}
					for (var i = 0; i < data.length; i++) {
						$switch.append(
							$('<a></a>', {"text": i + 1, "href": "#", "class": "b-banner-switch__item"}).on('click', function(e) {
								e.preventDefault();
								bannerSwitch($(this).text());
							})
						);
					}
					$switch.children().first().addClass('b-banner-switch__item_active');
				}

				function bannerSwitch(n) {
					if (!n) {
						n = 1;
					}
					if (!data[n - 1]) {
						return;
					}

					var b = data[n - 1];

                    $switch.find('a.b-banner-switch__item').removeClass('b-banner-switch__item_active');
					$switch.find('a.b-banner-switch__item:eq('+(n * 1 - 1)+')').addClass('b-banner-switch__item_active');

				}

				function bannerRotate() {
					var count = data.length;
					if (count < 2) {
						return;
					}
					current++;
					if (current > count) {
						current = 1;
					}
					bannerSwitch(current);
					timer = setTimeout(bannerRotate, 10000);
				}

				bannerCreateMenu();
				bannerSwitch(current);
				bannerRotate();
			});
		</script>
			<div class="b-submenu">
				<a href="/info/uchebniki" class="b-submenu__item b-submenu__item_newbie" >
					<span class="b-submenu__bg"></span>
					<span class="b-submenu__button">
						<span class="b-submenu__button-inner">Новичкам</span>
					</span>
				</a>
				<a href="http://games.mail.ru/support/legendbattles/" class="b-submenu__item b-submenu__item_support" target="_blank">
					<span class="b-submenu__bg"></span>
					<span class="b-submenu__button">
						<span class="b-submenu__button-inner">Медиа</span>
					</span>
				</a>
				<a href="/info/kommercheskii-sektor/uslugi" class="b-submenu__item b-submenu__item_services" >
					<span class="b-submenu__bg"></span>
					<span class="b-submenu__button">
						<span class="b-submenu__button-inner">Квесты</span>
					</span>
				</a>
				<a href="" class="b-submenu__item b-submenu__item_update" >
					<span class="b-submenu__bg"></span>
					<span class="b-submenu__button">
						<span class="b-submenu__button-inner">Обновления</span>
					</span>
				</a>
					</div>

                                <div class="b-common-block">
		<span class="b-common-block__l"></span>
		<span class="b-common-block__r"></span>
		<span class="b-common-block__t b-common-block__t_2"></span>
		<span class="b-common-block__b"></span>

		<span class="b-common-block__bl"></span>
		<span class="b-common-block__br"></span>

		<span class="b-common-block__header-decor-l"></span>
		<span class="b-common-block__header-decor-r"></span>

		<span class="b-common-block__header">
			<span class="b-common-block__header-inner">
				<span data-font="PTSans">Новости</span>
			</span>
		</span>

		<div class="b-common-block__cont">
			<div class="b-common-block__bgl">
                <div class="b-common-block__bgr clearfix"><?php
/* $Query = mysqli_query($GLOBALS['db_link'],"SELECT DISTINCT `forum_msg`.`topic_id` FROM `forum_msg` WHERE `cat`='15'");
$where = "";
while($row = mysqli_fetch_assoc($Query)){
	$where .=" AND ";
} */

$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `forum_topics` INNER JOIN `forum_msg` ON `forum_topics`.`id` = `forum_msg`.`topic_id` WHERE  `forum_topics`.`cat` = 15  ORDER BY `last_msg` DESC LIMIT 5");
$i = 0;
while($row = mysqli_fetch_assoc($Query)){
$i++;
/*  if($last_topic_id){
	if($last_topic_id == $row["topic_id"]){
		continue;
	}
}
$last_topic_id = $row["topic_id"]; */

echo'					<div class="b-news-item">
						<div class="b-news-item__header clearfix">
							<span class="b-news-item__datetime">
								<span class="b-news-item__datetime-inner">
									<i class="b-icon-32x32 b-icon-32x32_time"></i>'.date("d.m.Y H:i",$row['last_msg']).'</span>
							</span>
							<h2 class="b-news-item__head">
								<a href="http://forum.legendbattles.ru/index.php?act=show_topic&id='.$row["id"].'">'.$row['title'].'</a>
							</h2>
						</div>
						<div class="b-common-typography">'.$row['text'].'</div>
						<div class="b-news-footer">
							<span class="b-news-footer__t"></span>
							<span class="b-news-footer__b"></span>
							<span class="b-news-footer__ct"></span>
							<span class="b-news-footer__cb"></span>
							<span class="b-news-footer__tl"></span>
							<span class="b-news-footer__tr"></span>
							<span class="b-news-footer__bl"></span>
							<span class="b-news-footer__br"></span>
							<div class="b-news-footer__cont clearfix">
								<div class="b-news-footer__more">
									<i class="b-icon-32x32 b-icon-32x32_more"></i>&nbsp;
									<a href="http://forum.legendbattles.ru/index.php?act=show_topic&id=' . $row["id"] . '" class="b-news-footer__more-link"><b>подробнее...</b></a>
								</div>
								<div class="b-news-footer__comments">
									<i class="b-icon-32x32 b-icon-32x32_comment"></i>&nbsp;
									<a href="http://forum.legendbattles.ru/index.php?act=show_topic&id=' . $row["id"] . '" class="b-news-footer__comments-link"><b>комментариев: 0</b></a>
								</div>
							</div>
						</div>
					</div>';
if($i < 7){
echo'					<div class="b-divider-2">
						<div class="b-divider-2__l">
							<div class="b-divider-2__l-inner"></div>
						</div>
						<div class="b-divider-2__r">
							<div class="b-divider-2__r-inner"></div>
						</div>
						<div class="b-divider-2__c"></div>
					</div>';
}
}
?></div>
			</div>
		</div>
	</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="b-footer b-footer_main">
                <div class="b-footer__top"></div>
				<div class="b-footer__bottom">
                    <a href="#" target="_blank" class="b-footer__copyright-block"></a>
					<a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/5.png"></a>
					</span>
					&nbsp;
					<span class="b-footer__copyright-block">
						<tr>
							<td class="tbl-mn_menu-bg"></td>
						</tr>
						<tr>
							<td class="tbl-mn_menu-bottom" align="center" valign="top" height="87">
								<div class="wr"></div>
							</td>
						</tr>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="b-popup-shader"></div>

	<div id="regPopup" class="b-common-popup">
		<div class="b-common-block b-common-block__auth">
			<span class="b-common-block__l"></span>
			<span class="b-common-block__r"></span>
			<span class="b-common-block__t b-common-block__t_2"></span>
			<span class="b-common-block__b"></span>

			<span class="b-common-block__decor-tl"></span>
			<span class="b-common-block__decor-tr"></span>
			<span class="b-common-block__decor-bl"></span>
			<span class="b-common-block__decor-br"></span>

			<span class="b-common-block__decor-tl-2"></span>
			<span class="b-common-block__decor-tr-2"></span>
			<span class="b-common-block__decor-bl-2"></span>
			<span class="b-common-block__decor-br-2"></span>

			<span class="b-common-block__header">
				<span class="b-common-block__header-inner">
					<span data-font="PTSans">Регистрация</span>
				</span>
			</span>

			<span class="b-common-block__close" data-button="close"></span>

			<div class="b-common-block__cont">
				<div class="b-common-block__bgl">
					<div class="b-common-block__bgr clearfix">
						<form name='formRegister' onSubmit='RegFormSubmit();return false;'>
							<table class="b-common-form__table">
								<tr>
									<td class="valign-middle">
										<div class="b-news-footer b-news-footer_soc">
											<span class="b-news-footer__t"></span>
											<span class="b-news-footer__b"></span>

											<span class="b-news-footer__tl"></span>
											<span class="b-news-footer__tr"></span>
											<span class="b-news-footer__bl"></span>
											<span class="b-news-footer__br"></span>

											<div class="b-news-footer__cont clearfix">
                                                <div class="b-common-form__soc" id="regError">Заполните все поля и
                                                    нажмите &quot;Продолжить&quot;
                                                </div>
											</div>
										</div>
									</td>
								</tr>
							</table>
							<table class="b-common-form__table">
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userLmail">Логин:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type="text" name="login" id="login" value="" />
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userSex">Ваш пол:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<select  class="b-common-form__label" name="sex" id="sex">
													<option value="n">Выберите</option>
													<option value="male">-- Мужской</option>
													<option value="female">-- Женский</option>
												</select>
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userEmail">Ваш e-mail:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type="text" name="email" id="email" />
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userBday">Дата рождения:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type='text' name='bday' id='bday' maxlength='16' value=''
                                                       placeholder='дд.мм.гггг'/>
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="text-center">
										<button type="submit" class="b-button-red-5">
                                            <span class="b-button-red-5__inner">Продолжить</span>
										</button>
									</td>
								</tr>
							</table>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div id="authPopup" class="b-common-popup">
		<div class="b-common-block b-common-block__auth">
			<span class="b-common-block__l"></span>
			<span class="b-common-block__r"></span>
			<span class="b-common-block__t b-common-block__t_2"></span>
			<span class="b-common-block__b"></span>

			<span class="b-common-block__decor-tl"></span>
			<span class="b-common-block__decor-tr"></span>
			<span class="b-common-block__decor-bl"></span>
			<span class="b-common-block__decor-br"></span>

			<span class="b-common-block__decor-tl-2"></span>
			<span class="b-common-block__decor-tr-2"></span>
			<span class="b-common-block__decor-bl-2"></span>
			<span class="b-common-block__decor-br-2"></span>

			<span class="b-common-block__header">
				<span class="b-common-block__header-inner">
					<span data-font="PTSans">Авторизация</span>
				</span>
			</span>

			<span class="b-common-block__close" data-button="close"></span>

			<div class="b-common-block__cont">
				<div class="b-common-block__bgl">
					<div class="b-common-block__bgr clearfix">
						<form action="world.php" name="enter" method="post" class="b-auth-form">
							<table class="b-common-form__table">
								<tr>
									<td class="valign-middle">
										<div class="b-news-footer b-news-footer_soc">
											<span class="b-news-footer__t"></span>
											<span class="b-news-footer__b"></span>

											<span class="b-news-footer__tl"></span>
											<span class="b-news-footer__tr"></span>
											<span class="b-news-footer__bl"></span>
											<span class="b-news-footer__br"></span>

											<div class="b-news-footer__cont clearfix">
												<div class="b-common-form__soc">
																									</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
							<table class="b-common-form__table">
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userEmail">Логин:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type="text" name="login" id="userEmail" value="" />
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>
                                        <label class="b-common-form__label" for="userPassword">Пароль:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type="password" name="password" id="userPassword" />
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
                                        <a href="/password.php" class="invert"
                                           onclick="changePopup('#authPopup', '#recoveryPasswordStep1'); return false;"><b>Я
                                                забыл пароль</b></a>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="text-center">
										<button type="submit" class="b-button-red-5">
                                            <span class="b-button-red-5__inner">Начать игру</span>
										</button>
									</td>
								</tr>
							</table>
						</form>

						<div class="b-divider-4"></div>

						<p class="text-center">
                            <b>Если у вас нет логина, зарегистритуйтесь.</b>
						</p>

						<p class="text-center">
							<a href="#" onclick="changePopup('#authPopup', '#regPopup'); return false;" class="b-button-green-5">
                                <span class="b-button-green-5__inner">Зарегистрироваться</span>
							</a>
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div id="recoveryPasswordStep1" class="b-common-popup">
		<div class="b-common-block b-common-block__auth">
			<span class="b-common-block__l"></span>
			<span class="b-common-block__r"></span>
			<span class="b-common-block__t b-common-block__t_2"></span>
			<span class="b-common-block__b"></span>

			<span class="b-common-block__decor-tl"></span>
			<span class="b-common-block__decor-tr"></span>
			<span class="b-common-block__decor-bl"></span>
			<span class="b-common-block__decor-br"></span>

			<span class="b-common-block__decor-tl-2"></span>
			<span class="b-common-block__decor-tr-2"></span>
			<span class="b-common-block__decor-bl-2"></span>
			<span class="b-common-block__decor-br-2"></span>

			<span class="b-common-block__header">
				<span class="b-common-block__header-inner">
					<span data-font="PTSans">Напоминание пароля</span>
				</span>
			</span>

			<span class="b-common-block__close" data-button="close"></span>

			<div class="b-common-block__cont">
				<div class="b-common-block__bgl">
					<div class="b-common-block__bgr clearfix" id="sendPasswordContainer">
						<form action="password.php" method="post" class="b-auth-form" onsubmit="sendPasswordForm(event, this)">
							<input type="hidden" name="ajax" value="1" />
							<table class="b-common-form__table">
								<tr>
									<td>
                                        <label class="b-common-form__label" for="form[email]">Ваш E-mail:</label>
									</td>
									<td>
										<span class="b-common-form__field">
											<span class="b-common-form__field-inner">
												<input type="text" name="form[email]" id="sendPasswordEmail" value="" />
											</span>
										</span>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="text-center">
										<button type="submit" class="b-button-red-5">
											<span class="b-button-red-5__inner">
												Продолжить											</span>
										</button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function sendPasswordForm(e, element) {
			$.Event(e).preventDefault();
			var $this = $(element);
			$.ajax({
				url: $this.attr('action'),
				data: $this.serialize(),
				type: 'POST',
				cache: false,
				success: function(response) {
					$('#sendPasswordContainer').html(response);
				},
				error: function() {
                    alert('Произошла ошибка');
				}
			});
		}
		function sendPasswordPhoneChange() {
			var phone_type_russia = $('#sendPasswordCountryCode').val() == 7;
			phone_type_russia ? $('#sendPasswordPhoneType1').show() : $('#sendPasswordPhoneType1').hide();
			phone_type_russia ? $('#sendPasswordPhoneType2').hide() : $('#sendPasswordPhoneType2').show();
			if (phone_type_russia) {
				$('#sendPasswordPhoneNumber').val('');
				$('#sendPasswordPhoneCode').val('').focus();
			} else {
				$('sendPasswordPhoneNumberExt').val('+'+$('#sendPasswordCountryCode').val()).focus();
			}
		}
	</script>

	<div id="fb-root"></div>

		<script type="text/javascript">
		function change_acc(){
			deleteCookie('sstype'); window.location.replace(window.location.href);
		}
	</script>

</body>
</html>
