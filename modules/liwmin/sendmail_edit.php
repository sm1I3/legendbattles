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
            \''.mysql_escape_string($_POST['theame']).'\',
            \''.mysql_escape_string(BbToHtml($_POST['message'])).'\'
        )'  ;
    } else {
        $query = '
        update module_subscribe set
            theame = \''.mysql_escape_string($_POST['theame']).'\',
            message = \''.mysql_escape_string(BbToHtml($_POST['message'])).'\'
        where
            id = '.intval($message_id).'
        '  ;
    }    
    mysql_query($query);
	$sendId = (($message_id == '') ? mysql_insert_id() : intval($message_id) );
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
    $res = mysql_query('select * from module_subscribe where id = '.intval($message_id));
    if($row = mysql_fetch_assoc($res))
        $message = $row;
    mysql_free_result($res);
}

?>
<h3><?=($message_id == ''?'�������� ���������':'�������� ���������')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>���� ���������: &nbsp;  </td>
  <td>
    <input name="theame" style="width:500px;" value="<?=_htext($message['theame'])?>">
  </td>
<tr>
</tr>
  <td><span class="cms_star">*</span>����� ���������: &nbsp;  </td>
  <td>
    <textarea name="message" style="width:500px;height:350px;"><?=_htext(HtmlToBb($message['message']))?></textarea>
  </td>
</tr>
</table>

<p></p>
  <input name="submit" type="submit" class="cms_button1" value="���������" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.edit_resource.action = 'sendmail_edit.php?<?=($message_id == ''?'':'message_id='.$message_id.'&')?>sender=true';document.edit_resource.submit(); return false;" class="cms_button1" value="���������" />
  <input name="cancel" type="submit" onclick="document.location='mass_message_list.php'; return false;" class="cms_button1" value="������" />
<p><span class="cms_star">*</span> - ������������ ���� </p>
</form>
<? require('kernel/after.php'); ?>