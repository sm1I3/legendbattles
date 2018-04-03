<?
require($_SERVER['DOCUMENT_ROOT'] . '/system/config.php');

if (!isset($_SESSION['USER']) || !isset($_SESSION['USER']['user_id']) || $_SESSION['USER']['user_id'] == '') {
    header('Location: login.php');
    die();
}
date_default_timezone_set('Europe/Moscow');
require('functions.php');

$recs_per_page = 50;

ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="files/styles.css" type="text/css" />
    <title>Система управления legendbattles.ru</title>
</head>

<body class="cms_BODY">
<script src="jscript/kernel.js" language="javascript"></script>
<script src="jscript/menu.js" language="javascript"></script>
<table id="cms_top" cellspacing="0" cellpadding="0" width="100%" border="0" style=" background-image:url(images/cms_bgtop.jpg); background-repeat:repeat-x">
  <tbody>
    <tr>
      <td width="348" height="51" align="left" nowrap="nowrap"><a href="index.php" title="Redline Management System"><img src="images/spacer.gif" width="348" height="51" border="0" /></a></td>
        <td align="left" nowrap="nowrap"><a href="login.php?logout=yes" title="Close">Выход</a> <span
                    class="cms_topvln"><?= $_SESSION['USER']['user_login'] ?></span></td>
    </tr>
  </tbody>
</table>
<table width="100%" height="100%" border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" height="100%" style="background:url(images/leftbg.gif) top right; background-repeat:repeat-y; background-color: #E2E2E2">
        <div id="cms_leftmenu">
            <? require('menu.php'); ?>
         </div></td>
      
      <td valign="top" width="100%" height="100%">
        <div id="cms_content">