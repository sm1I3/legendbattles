<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['resource_type_id']) || !is_numeric($_GET['resource_type_id']))
    $resource_type_id = '';
else
    $resource_type_id = (int)$_GET['resource_type_id'];
    
if (isset($_POST['resource_type_name'])) {
    
    if ($resource_type_id == '') {
        $query = '
        insert into resource_types
        (
            resource_type_id,
            resource_type_name
        ) values (
            '.(int)$_POST['resource_type_id'].',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['resource_type_name']) . '\'
        )'  ;
    } else {
        $query = '
        update resource_types set
            resource_type_id = '.(int)$_POST['resource_type_id'].',
            resource_type_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['resource_type_name']) . '\'
        where
            resource_type_id = '.intval($resource_type_id).'
        '  ;
    }
    mysqli_query($GLOBALS['db_link'], $query);
    header('Location: resource_type_list.php');
    
}

if ($resource_type_id == '') {
    $resource_type = array(
        'resource_type_id' => '',
        'resource_type_name' => ''
    );
} else {
    $resource_type = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from resource_types where resource_type_id = ' . intval($resource_type_id));
    if ($row = mysqli_fetch_assoc($res))
        $resource_type = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($resource_type_id == '' ? 'Добавить тип ресурс' : 'Изменить тип ресурс') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID типа ресурса: &nbsp;</td>
  <td><input name="resource_type_id" type="text" class="cms_fieldstyle1" value="<?=$resource_type['resource_type_id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Название типа ресурса: &nbsp;</td>
  <td><input name="resource_type_name" type="text" class="cms_fieldstyle1" value="<?=$resource_type['resource_type_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='resource_type_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>