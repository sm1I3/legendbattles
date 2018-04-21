<?php
$SyncArray = array("vkontakte", "odnoklassniki", "mailru", "facebook", "twitter", "google", "yandex", "livejournal", "openid", "lastfm", "linkedin", "liveid", "soundcloud", "steam", "flickr", "youtube", "vimeo", "webmoney", "foursquare", "tumblr", "googleplus");
$SocialIcons = array("vkontakte" => "35", "odnoklassniki" => "70", "mailru" => "105", "facebook" => "140", "twitter" => "175", "google" => "210", "yandex" => "245", "livejournal" => "280", "openid" => "315", "flickr" => "385", "lastfm" => "420", "linkedin" => "455", "liveid" => "490", "soundcloud" => "525", "steam" => "560", "vimeo" => "595", "webmoney" => "630", "youtube" => "665", "foursquare" => "700", "tumblr" => "735", "googleplus" => "770");
?>
<tr>
    <td width=100%>
        <FIELDSET>
            <LEGEND align=center><B><font color=gray>&nbsp;Сообщества&nbsp;</font></B></LEGEND>
            <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
            <table cellpadding=0 cellspacing=0 border=0 width=100%>
                <tr>
                    <td>
                        <?php
                        $Query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `ulogin` WHERE `userid`='" . $player['id'] . "'");
                        echo '<font class=proce><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Социальные профили&nbsp;</font></B></LEGEND><div align="center" id="SocialsLists">';
                        if (mysqli_num_rows($Query) > 0) {
                            echo '<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=3 cellspacing=1 border=0 align=center width=100%>';
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($Query)) {
                                $i++;
                                $bgcolor = (($i % 2) ? 'EFEFEF' : 'FFFFFF');
                                echo '<tr>
			  <td class="freetxt" width="32" height="32" bgcolor="#' . $bgcolor . '" style="background:url(https://ulogin.ru/img/panel7.png) no-repeat 0 -' . $SocialIcons[$row['network']] . 'px;"><img src="https://img.legendbattles.ru/image/1x1.gif" width="32" height="32" /></td>
			  <td class="freetxt" align="center" valign="middle" bgcolor="#' . $bgcolor . '"><a href="' . $row['profile'] . '" target="_blank">' . $row['profile_names'] . '</a></td>
			  <td class="freetxt" align="center" valign="middle" bgcolor="#' . $bgcolor . '"><a href="javascript:SocialDelete(' . $row['id'] . ');"><font color="red">удалить</font></a></td>
			</tr>';
                            }
                            echo '</table></td></tr></table>';
                        } else {
                            echo 'нет привязанных аккаунтов';
                        }
                        echo '</div></FIELDSET>';

                        foreach ($SyncArray as $Socials) {
                            if (!+$GLOBALS['DBLink']->query("SELECT `network` FROM `ulogin` WHERE `userid`= ? AND `network`= ?", array($player['id'], $Socials))->fetchColumn(0)) {
                                $ShowSocial[] = $Socials;
                            }
                        }
                        if (count($ShowSocial) > 0) {
                            echo '<FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Добавить профиль&nbsp;</font></B></LEGEND><script src="//ulogin.ru/js/ulogin.js"></script><div align="center" id="SocialProfiles">';
                            for ($i = 0; $i < count($ShowSocial); $i++) {
                                $SocialPrints[intval($i / 7)][] = $ShowSocial[$i];
                            }
                            for ($i = 0; $i <= intval(count($ShowSocial) / 7); $i++) {
                                echo '<div id="uLogin[' . $i . ']" data-ulogin="verify=1;display=panel;fields=first_name,last_name,email,nickname,photo,bdate,sex,city,country;providers=' . implode(",", $SocialPrints[$i]) . ';hidden=;redirect_uri=;callback=ucall"></div><img src=https://img.legendbattles.ru/image/1x1.gif width=1 height=7>';
                            }
                            echo '</div></FIELDSET>';
                        }
                        ?></font>
                        <script>
                            function ucall(token) {
                                $.ajax({
                                    url: '/gameplay/ajax/ajax_social.php?action=SocialAdd&token=' + token + '&host=' + encodeURIComponent(location.hostname),
                                    cache: false
                                }).done(function (InnerHTML) {
                                    $("#SocialsLists").html(InnerHTML);
                                });
                                $.ajax({
                                    url: '/gameplay/ajax/ajax_social.php?action=SocialUpdateList',
                                    cache: false
                                }).done(function (InnerHTML) {
                                    $("#SocialProfiles").html(InnerHTML);
                                });
                            }

                            function SocialDelete(id) {
                                $.ajax({
                                    url: '/gameplay/ajax/ajax_social.php?action=SocialDelete&SocID=' + id,
                                    cache: false
                                }).done(function (InnerHTML) {
                                    $("#SocialsLists").html(InnerHTML);
                                });
                                $.ajax({
                                    url: '/gameplay/ajax/ajax_social.php?action=SocialUpdateList',
                                    cache: false
                                }).done(function (InnerHTML) {
                                    $("#SocialProfiles").html(InnerHTML);
                                });
                            }
                        </script>
                    </td>
                </tr>
            </table>
        </FIELDSET>
    </td>
</tr>

