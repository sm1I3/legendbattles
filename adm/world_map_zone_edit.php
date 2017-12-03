<?php

require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['zone_code']))
    $zone_code = '';
else
    $zone_code = $_GET['zone_code'];
    
if (isset($_POST['zone_code'])) {
    
    if ($zone_code == '') {
        $query = '
        insert into world_zones
        (
            zone_code,
            zone_name
        ) values (
            \''.mysql_escape_string($_POST['zone_code']).'\',
            \''.mysql_escape_string($_POST['zone_name']).'\'
        )'  ;
    } else {
        $query = '
        update world_zones set
            zone_code = \''.mysql_escape_string($_POST['zone_code']).'\',
            zone_name = \''.mysql_escape_string($_POST['zone_name']).'\'
        where
            zone_code = \''.mysql_escape_string($zone_code).'\'
        '  ;
    }    
    mysql_query($query);
    header('Location: world_map_zone_list.php');
    
}

if ($zone_code == '') {
    $zone = array(
        'zone_code' => '',
        'zone_name' => '',
    );
} else {
    $zone = array();
    $res = mysql_query('select * from world_zones where zone_code = \''.mysql_escape_string($zone_code).'\'');
    if($row = mysql_fetch_assoc($res))
        $zone = $row;
    mysql_free_result($res);
}

?>
    <h3><?= ($zone_code == '' ? 'Добавить зону' : 'Изменить зону') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Код зоны: &nbsp;</td>
  <td><input name="zone_code" type="text" class="cms_fieldstyle1" value="<?=$zone['zone_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название зоны: &nbsp;</td>
  <td><input name="zone_name" type="text" class="cms_fieldstyle1" value="<?=$zone['zone_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='world_map_zone_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>