<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['ability_id']) || !is_numeric($_GET['ability_id']))
    $ability_id = '';
else
    $ability_id = (int)$_GET['ability_id'];
    
if (isset($_POST['ability_id'])) 
{
    if ($ability_id == '') 
    {
        $query = '
        insert into ability_list
        (
            ability_id,
            ability_name
        ) values (
            '.intval($ability_id).',
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['ability_name']) . '\'
        )'  ;
    } 
    else 
    {
        $query = '
        update ability_list set
            ability_id = '.intval($ability_id).',
            ability_name = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['ability_name']) . '\'
        where
            ability_id = '.intval($ability_id).'
        '  ;
    }
    mysqli_query($GLOBALS['db_link'], $query);
    header('Location: ability_list.php');
    
}

if ((string)$ability_id == '') 
{
    $ability = array(
        'ability_id' => '',
        'ability_name' => ''
    );
} 
else 
{
    $ability = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from ability_list where ability_id = ' . intval($ability_id));
    if ($row = mysqli_fetch_assoc($res))
        $ability = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($ability_id == '' ? 'Добавить умение' : 'Изменить умение') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>ID Умения: &nbsp;</td>
  <td><input name="ability_id" type="text" class="cms_fieldstyle1" value="<?=$ability['ability_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название умения: &nbsp;</td>
  <td><input name="ability_name" type="text" class="cms_fieldstyle1" value="<?=$ability['ability_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='ability_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>