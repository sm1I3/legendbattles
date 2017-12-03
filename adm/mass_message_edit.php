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
    
if (isset($_POST['msg_text'])) {
    
    if ($message_id == '') {
        $query = '
        insert into mass_msg
        (
            msg_text
        ) values (
            \''.mysql_escape_string($_POST['msg_text']).'\'
        )'  ;
    } else {
        $query = '
        update mass_msg set
            msg_text = \''.mysql_escape_string($_POST['msg_text']).'\'
        where
            msg_id = '.intval($message_id).'
        '  ;
    }    
    mysql_query($query);
    header('Location: mass_message_list.php');
    
}

if ((string)$message_id == '') {
    $message = array(
        'msg_text' => ''
    );
} else {
    $ability = array();
    $res = mysql_query('select * from mass_msg where msg_id = '.intval($message_id));
    if($row = mysql_fetch_assoc($res))
        $message = $row;
    mysql_free_result($res);
}

?>
<h3><?=($message_id == ''?'Добавить сообщение':'Изменить сообщение')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Текст сообщения: &nbsp;  </td>
  <td>
    <textarea name="msg_text" cols="50" rows="4"><?=_htext($message['msg_text'])?></textarea>
  </td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='mass_message_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>