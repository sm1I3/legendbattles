<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['message_id']) || !is_numeric($_GET['message_id']))
    $message_id = '';
else
    $message_id = (int)$_GET['message_id'];
    
if (isset($_POST['message']) and isset($_POST['theame'])) {
    
    if ($message_id == '') {
        $query = '
        insert into module_subscribe
        (
            theame,
            message
        ) values (
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['theame']) . '\',
            \'' . mysqli_escape_string($GLOBALS['db_link'], BbToHtml($_POST['message'])) . '\'
        )'  ;
    } else {
        $query = '
        update module_subscribe set
            theame = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['theame']) . '\',
            message = \'' . mysqli_escape_string($GLOBALS['db_link'], BbToHtml($_POST['message'])) . '\'
        where
            id = '.intval($message_id).'
        '  ;
    }
    mysqli_query($GLOBALS['db_link'], $query);
    $sendId = (($message_id == '') ? mysqli_insert_id($GLOBALS['db_link']) : intval($message_id));
	if (isset($_GET['sender']))
		header('Location: sendmail_sender.php?message_id=' . $sendId);
	else
		header('Location: sendmail_list.php');
}

if ((string)$message_id == '') {
    $message = array(
		'theame' => '',
        'message' => ''
    );
} else {
    $ability = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from module_subscribe where id = ' . intval($message_id));
    if ($row = mysqli_fetch_assoc($res))
        $message = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($message_id == '' ? 'Добавить сообщение' : 'Изменить сообщение') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Тема сообщения: &nbsp;</td>
  <td>
    <input name="theame" style="width:500px;" value="<?=_htext($message['theame'])?>">
  </td>
<tr>
</tr>
    <td><span class="cms_star">*</span>Текст сообщения: &nbsp;</td>
  <td>
    <textarea name="message" style="width:500px;height:350px;"><?=_htext(HtmlToBb($message['message']))?></textarea>
  </td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.edit_resource.action = 'sendmail_edit.php?<?= ($message_id == '' ? '' : 'message_id=' . $message_id . '&') ?>sender=true';document.edit_resource.submit(); return false;"
           class="cms_button1" value="Разослать"/>
    <input name="cancel" type="submit" onclick="document.location='mass_message_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>