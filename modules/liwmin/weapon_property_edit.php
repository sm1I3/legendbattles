<?php

require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['property_code']))
    $weapon_property_code = '';
else
    $weapon_property_code = $_GET['property_code'];
    
$property_types = array(
    1 => 'Основные требования',
    2 => 'Требования умений',
    3 => 'Основные хар-ки',
    4 => 'Дополнительные умения'
);
    
if (isset($_POST['property_name'])) {
    
    if ($weapon_property_code == '') {
        $query = '
        insert into weapon_properties
        (
            property_code,
            property_type,
            property_name
        ) values (
            \''.mysql_escape_string($_POST['property_code']).'\',
            '.(int)$_POST['property_type'].',
            \''.mysql_escape_string($_POST['property_name']).'\'
        )'  ;
    } else {
        $query = '
        update weapon_properties set
            property_code = \''.mysql_escape_string($_POST['property_code']).'\',
            property_type = '.(int)$_POST['property_type'].',
            property_name = \''.mysql_escape_string($_POST['property_name']).'\'
        where
            property_code = \''.mysql_escape_string($weapon_property_code).'\'
        '  ;
    }    
    mysql_query($query);
    header('Location: weapon_property_list.php');
    
}

if ($weapon_property_code == '') {
    $weapon_property = array(
        'property_code' => '',
        'property_type' => '',
        'property_name' => ''
    );
} else {
    $weapon_category = array();
    $res = mysql_query('select * from weapon_properties where property_code = \''.mysql_escape_string($weapon_property_code).'\'');
    if($row = mysql_fetch_assoc($res))
        $weapon_property = $row;
    mysql_free_result($res);
}

?>
<h3><?=($weapon_property_code == ''?'Добавить параметр оружия':'Изменить параметр оружия')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Код параметра оружия: &nbsp;  </td>
  <td><input name="property_code" type="text" class="cms_fieldstyle1" value="<?=$weapon_property['property_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Тип параметра оружия: &nbsp;  </td>
  <td><?=createSelectFromArray('property_type', $property_types, $weapon_property['property_type'])?></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название параметра оружия: &nbsp;  </td>
  <td><input name="property_name" type="text" class="cms_fieldstyle1" value="<?=$weapon_property['property_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='weapon_property_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>