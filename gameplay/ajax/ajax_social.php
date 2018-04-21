<?php
#GLOBALS OFF
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

header('Content-type: text/html; charset=UTF-8');
$pers = GetUser($_SESSION['user']['login']);
$SyncArray = array("vkontakte","odnoklassniki","mailru","facebook","twitter","google","yandex","livejournal","openid","lastfm","linkedin","liveid","soundcloud","steam","flickr","youtube","vimeo","webmoney","foursquare","tumblr","googleplus");
$SocialIcons = array("vkontakte"=>"35","odnoklassniki"=>"70","mailru"=>"105","facebook"=>"140","twitter"=>"175","google"=>"210","yandex"=>"245","livejournal"=>"280","openid"=>"315","flickr"=>"385","lastfm"=>"420","linkedin"=>"455","liveid"=>"490","soundcloud"=>"525","steam"=>"560","vimeo"=>"595","webmoney"=>"630","youtube"=>"665","foursquare"=>"700","tumblr"=>"735","googleplus"=>"770");

if($pers){
	switch($_GET['action']){
        case'SocialAdd':// Добавляем социальный профиль
			$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_GET['token'] . '&host=' . $_SERVER['HTTP_HOST']);
			$uLoginGet = json_decode($s, true);
			if(empty($uLoginGet['error'])){
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `ulogin` (`userid`,`network`,`profile`,`profile_names`,`identity`) VALUES ('" . $pers['id'] . "','" . $uLoginGet['network'] . "','" . mysqli_real_escape_string($GLOBALS['db_link'], $uLoginGet['profile']) . "','" . mysqli_real_escape_string($GLOBALS['db_link'], iconv("UTF-8", "UTF-8", $uLoginGet['first_name'])) . " " . mysqli_real_escape_string($GLOBALS['db_link'], iconv("UTF-8", "UTF-8", $uLoginGet['last_name'])) . "','" . mysqli_real_escape_string($GLOBALS['db_link'], $uLoginGet['identity']) . "');");
				$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ulogin` WHERE `userid`='".$pers['id']."'");
				if(mysqli_num_rows($Query)>0){
					$i = 0;
					echo'<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=3 cellspacing=1 border=0 align=center width=100%>';
					while($row = mysqli_fetch_assoc($Query)){
						$i++;
						$bgcolor = (($i%2)?'EFEFEF':'FFFFFF');
						echo'<tr>
						  <td class="freetxt" width="32" height="32" bgcolor="#'.$bgcolor.'" style="background:url(https://ulogin.ru/img/panel7.png) no-repeat 0 -'.$SocialIcons[$row['network']].'px;"><img src="http://img.legendbattles.ru/image/1x1.gif" width="32" height="32" /></td>
						  <td class="freetxt" align="center" valign="middle" bgcolor="#'.$bgcolor.'"><a href="'.$row['profile'].'" target="_blank">'.$row['profile_names'].'</a></td>
						  <td class="freetxt" align="center" valign="middle" bgcolor="#' . $bgcolor . '"><a href="javascript:SocialDelete(' . $row['id'] . ');"><font color="red">удалить</font></a></td>
						</tr>';
					}
					echo'</table></td></tr></table>';
				}
			}
		break;
        case'SocialDelete':// Удаляем социальный профиль
			$uLoginGet = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ulogin` WHERE `userid`='".$pers['id']."' and `id`='".intval($_GET['SocID'])."'"));
			if($uLoginGet){
				mysqli_query($GLOBALS['db_link'],"DELETE FROM `ulogin` WHERE `id` = '".$uLoginGet['id']."'");
				$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ulogin` WHERE `userid`='".$pers['id']."'");
				if(mysqli_num_rows($Query)>0){
					$i = 0;
					echo'<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=3 cellspacing=1 border=0 align=center width=100%>';
					while($row = mysqli_fetch_assoc($Query)){
						$i++;
						$bgcolor = (($i%2)?'EFEFEF':'FFFFFF');
						echo'<tr>
						  <td class="freetxt" width="32" height="32" bgcolor="#'.$bgcolor.'" style="background:url(https://ulogin.ru/img/panel7.png) no-repeat 0 -'.$SocialIcons[$row['network']].'px;"><img src="http://img.legendbattles.ru/image/1x1.gif" width="32" height="32" /></td>
						  <td class="freetxt" align="center" valign="middle" bgcolor="#'.$bgcolor.'"><a href="'.$row['profile'].'" target="_blank">'.$row['profile_names'].'</a></td>
						  <td class="freetxt" align="center" valign="middle" bgcolor="#' . $bgcolor . '"><a href="javascript:SocialDelete(' . $row['id'] . ');"><font color="red">удалить</font></a></td>
						</tr>';
					}
					echo'</table></td></tr></table>';
				}else{
                    echo 'нет привязанных аккаунтов';
				}
			}
		break;
        case'SocialUpdateList':// AJAX обновление списка профилей
			foreach($SyncArray as $Socials){
				if(!mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT `network` FROM `ulogin` WHERE `userid`='".$pers['id']."' and `network`='".$Socials."'"),0)){
					$ShowSocial[] = $Socials;
				}
			}
			if(count($ShowSocial)>0){
				for( $i = 0; $i < count($ShowSocial); $i++ ){
					$SocialPrints[intval($i/7)][] = $ShowSocial[$i];
				}
				for( $i = 0; $i <= intval(count($ShowSocial)/7); $i++ ){
					echo'<div id="uLogin['.$i.']" data-ulogin="verify=1;display=panel;fields=first_name,last_name,email,nickname,photo,bdate,sex,city,country;providers='.implode(",",$SocialPrints[$i]).';hidden=;redirect_uri=;callback=ucall"></div><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=7>';
				}
			}
		break;
	}
}