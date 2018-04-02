<?php
require('kernel/config.php');

$errors = '';

if (isset($_GET['logout']))
    unset($_SESSION['USER']);

if (!isset($_POST['user_login']))
{
    $_POST['user_login'] = '';
}
else {
    $login = mysqli_escape_string($GLOBALS['db_link'], $_POST['user_login']);
    $password = md5($_POST['user_password']);

    $res = mysqli_query($GLOBALS['db_link'], 'select * from user where login = \'' . $login . '\' and pass = \'' . $password . '\'');
    if ($row = mysqli_fetch_assoc($res)) 
    {
        $_SESSION['USER'] = array(
            'user_login' => $row['login'],
            'user_permissions' => $row['permissions'],
            'user_id' => $row['id']
        );
        header('Location: index.php');
    } else
        $errors = 'Неверный логин или пароль.';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="files/styles.css" type="text/css" />
    <title>Система управления</title>
</head>
<body> 
    <script language="JavaScript">
        function validate_form(frm)
        {
            var value = '';
            var errFlag = new Array();
            var _qfGroups = {};
            _qfMsg = '';

            value = frm.elements['user_login'].value;
            if (value == '' && !errFlag['user_login']) {
                errFlag['user_login'] = true;
                _qfMsg = _qfMsg + '\n - Field \'Login\' is mandatory.';
            }

            value = frm.elements['user_password'].value;
            if (value == '' && !errFlag['user_password']) {
                errFlag['user_password'] = true;
                _qfMsg = _qfMsg + '\n - Field \'Password\' is mandatory.';
            }

            if (_qfMsg != '') {
                _qfMsg = '' + _qfMsg;
                _qfMsg = _qfMsg + '\n';
                alert(_qfMsg);
                return false;
            }
            return true; 
        }
    </script>
    <table cellspacing="0" cellpadding="0" width="100%" border="0">
        <tbody>
            <tr>
                <td align="left" style="background-image:url(images/cms_bgsystemnote.gif); background-repeat: repeat-x ">  <img src="images/spacer.gif" alt="" width="745" height="83" /> </td>
            </tr>
        </tbody>
    </table>
    <span class="cms_nonCssBrowsers">
    </span>
    <div id="cms_mainArea">        
        <table cellspacing="0" cellpadding="5" border="0">
            <tbody>
                <tr>
                    <td valign="top" width="200">
                        <img style="padding-top: 15px" height="51" src="images/spacer.gif" width="333" border="0" />
                    </td>
                    <td valign="top" width="100%">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" width="100%">
                                    <?=$errors?>
                                        <h1>Панель управления</h1>
                                        <noscript>
                                            <h2 style="color:#FF0000">Please, enable JavaScript in your browser.</h2>
                                            <p><b>How do I enable JavaScript in my browser? </b></p>
                                            <p>In order to work with current interface, you will need to have JavaScript 
                                                enabled in your browser. To do so, please follow the instructions below: </p>
                                            <p><strong>Internet Explorer (6.0+)</strong></p>
                                            <ol>
                                                <li>Select 'Tools' from the top menu</li>
                                                <li>Choose 'Internet Options'</li>
                                                <li>Click on the 'Security' tab</li>
                                                <li>Click on 'Custom Level'</li>
                                                <li>Scroll down until you see section labled 'Scripting'</li>
                                                <li>Under 'Active Scripting', select 'Enable' and click OK </li>
                                            </ol>
                                            <p><strong>Netscape Navigator (4.8)</strong></p>
                                            <ol>
                                                <li>Select 'Edit' from the top menu</li>
                                                <li>Choose 'Preferences'</li>
                                                <li>Choose 'Advanced'</li>
                                                <li>Choose 'Scripts &amp; Plugins'</li>
                                                <li>Select the 'Enable JavaScript' checkbox and click OK </li>
                                            </ol>
                                            <p>strong>Mozilla Firefox (1.0)</strong></p>
                                            <ol>
                                                <li>Select 'Tools' from the top menu</li>
                                                <li>Choose 'Options'</li>
                                                <li>Choose 'Web Features' from the left navigation</li>
                                                <li>Select the checkbox next to 'Enable JavaScript' and click OK </li>
                                            </ol>
                                            <p><strong>Mozilla Firefox (1.5+)</strong></p>
                                            <ol>
                                                <li>Select 'Tools' from the top menu</li>
                                                <li>Choose 'Options'</li>
                                                <li>Choose 'Content' from the top navigation</li>
                                                <li>Select the checkbox next to 'Enable JavaScript' and click OK </li>
                                            </ol>
                                            <p><strong>Apple Safari (1.0)</strong></p>
                                            <ol>
                                                <li>Select 'Safari' from the top menu</li>
                                                <li>Choose 'Preferences'</li>
                                                <li>Choose 'Security'</li>
                                                <li>Select the checkbox next to 'Enable JavaScript' </li>
                                            </ol>
                                            <p>Please keep in mind that upgrading your browser or installing new security 
                                                software or security patches may affect your JavaScript settings. It is a good 
                                                idea to double-check that JavaScript is still enabled. Additionally, if your JavaScript setting is set to 
                                                'Prompt', you may encounter a warning about downloading potentially dangerous 
                                                scripts from a website.</p>
                                            <p>If you are still experiencing problems viewing this message after ensuring that 
                                                JavaScript is enabled in your browser, please check if you have any personal firewall or security software installed.</p>
                                        </noscript>
                                        <div style="display:none;visibility:hidden;" id="loginformdiv">
                                            <form name="login" method="post" action="">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>Логин:<br/></td>
                                                        <td><input name="user_login" maxlength="255" type="text" class="cms_fieldstyle1" value="<?=htmlspecialchars($_POST['user_login'])?>" size="34" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Пароль:&nbsp;</td>
                                                        <td><input name="user_password" maxlength="40" type="password" class="cms_fieldstyle1" value="" size="34" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="40">&nbsp;</td>
                                                        <td><input type="submit" name="submit" value="Вход"
                                                                   class="cms_button1"
                                                                   onclick="return validate_form(this.form);"/></td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div id="cms_pageFooter">&nbsp;
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script language="javascript">if((ds=document.getElementById("loginformdiv"))){ ds.style.display="block"; ds.style.visibility="visible"; }</script>
</body>
</html>
