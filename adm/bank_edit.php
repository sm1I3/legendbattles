<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id']))
    $id = '';
else
    $id = (int)$_GET['id'];
    
if (isset($_POST['num'])) {
    
    if ($id == '') {
        $query = '
        INSERT INTO bank
        (
            id, num, lr, dlr, pass
        ) VALUES (
            '.(int)$_POST['id'].', \''.mysql_escape_string($_POST['num']).'\', '.(float)$_POST['lr'].', '.(float)$_POST['dlr'].', \''.mysql_escape_string($_POST['pass']).'\'
        )'  ;
    } else {
        $query = '
        UPDATE bank 
        SET
            id = '.(int)$_POST['id'].',
            num = \''.mysql_real_escape_string($_POST['num']).'\',
            lr = '.(float)$_POST['lr'].',
            dlr = '.(float)$_POST['dlr'].',
						pass = \''.mysql_real_escape_string($_POST['pass']).'\'
        WHERE
            id = '.$id.'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: bank_list.php');
    
}

if ($id == '') {
    $bank = array(
        'id' => '',
        'num' => '',
        'lr' => '',
        'dlr' => '',
				'pass' => '',        
    );
} else {
    $bank = array();
    $res = mysql_query('select * from bank where id = '.intval($id));
    if($row = mysql_fetch_assoc($res))
        $bank = $row;
    mysql_free_result($res);
}

?>
<h3><?=($id == ''?'Добавить банк':'Изменить банк')?></h3>

<form name="edit_bank" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">

<tr>
  <td>ID Банка: &nbsp;  </td>
  <td><input name="id" type="text" class="cms_fieldstyle1" value="<?=$bank['id']?>" size="5" maxlength="255" /></td>
</tr>
<tr>
  <td>Имя банка: &nbsp;  </td>
  <td><input name="num" type="text" class="cms_fieldstyle1" value="<?=$bank['num']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Валюта: &nbsp;  </td>
  <td><input name="lr" type="text" class="cms_fieldstyle1" value="<?=$bank['lr']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Изумруды: &nbsp;  </td>
  <td><input name="dlr" type="text" class="cms_fieldstyle1" value="<?=$bank['dlr']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Пороль: &nbsp;  </td>
  <td><input name="pass" type="text" class="cms_fieldstyle1" value="<?=$bank['pass']?>" size="40" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='bank_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>