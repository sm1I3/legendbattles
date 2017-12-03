<?php
require('kernel/before.php');

if (!userHasPermission(32)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['resource_id']) || !is_numeric($_GET['resource_id']))
    $resource_id = '';
else
    $resource_id = (int)$_GET['resource_id'];
    
if (isset($_POST['resource_name'])) {
    
    if ($resource_id == '') {
        $query = '
        insert into restore_resources
        (
            resource_name,
            resource_type,
            resource_cost,
            resource_store,
            resource_requirement,
            resource_change,
            resource_last,
            resource_temp,
            resource_components,
            resource_ready,
            resource_life
        ) values (
            "'.mysql_escape_string($_POST['resource_name']).'",
            '.(int)$_POST['resource_type'].',
            '.(float)$_POST['resource_cost'].',
            '.(float)$_POST['resource_store'].',
            '.(int)$_POST['resource_requirement'].',
            '.(float)$_POST['resource_change'].',
            '.(int)$_POST['resource_last'].',
            '.(int)$_POST['resource_temp'].',
            '.(float)$_POST['resource_components'].',
            '.(float)$_POST['resource_ready'].',
            '.(int)$_POST['resource_life'].'
        )'  ;
        
        mysql_query($query);
        $resource_id = mysql_insert_id();
        
        $query = '
        insert into mem_restore_resources
        (
            resource_id,
            resource_type,
            resource_name,
            resource_cost
        ) values (
            '.$resource_id.',
            '.(int)$_POST['resource_type'].',
            "'.mysql_escape_string($_POST['resource_name']).'",
            '.(float)$_POST['resource_cost'].'
        )';
        
        mysql_query($query); 
        
    } else {
        $query = '
        update restore_resources set
            resource_name = "'.mysql_escape_string($_POST['resource_name']).'",
            resource_type = '.(int)$_POST['resource_type'].',
            resource_cost = '.(float)$_POST['resource_cost'].',
            resource_store = '.(float)$_POST['resource_store'].',
            resource_requirement = '.(int)$_POST['resource_requirement'].',
            resource_change = '.(float)$_POST['resource_change'].',
            resource_last = '.(int)$_POST['resource_last'].',
            resource_temp = '.(int)$_POST['resource_temp'].',
            resource_components = '.(float)$_POST['resource_components'].',
            resource_ready = '.(float)$_POST['resource_ready'].',
            resource_life = '.(int)$_POST['resource_life'].'
        where
            resource_id = '.intval($resource_id).'
        ';
        mysql_query($query);
        
        $query = '
        update mem_restore_resources set
            resource_name = "'.mysql_escape_string($_POST['resource_name']).'",
            resource_type = '.(int)$_POST['resource_type'].',
            resource_cost = '.(float)$_POST['resource_cost'].'
        where
            resource_id = '.intval($resource_id).'
        ';
        
        mysql_query($query); 
    }    
    
    header('Location: '.$_SESSION['pages']['resource_list']);
    
}

if ($resource_id == '') {
    $resource = array(
        'resource_name' => '',
        'resource_type' => '',
        'resource_cost' => '0.00',
        'resource_store' => '0.00',
        'resource_requirement' => '',
        'resource_change' => '',
        'resource_last' => '',
        'resource_temp' => '',
        'resource_components' => '0',
        'resource_ready' => '0',
        'resource_life' => '3'
    );
} else {
    $resource = array();
    $res = mysql_query('select * from restore_resources where resource_id = '.intval($resource_id));
    if($row = mysql_fetch_assoc($res))
        $resource = $row;
    mysql_free_result($res);
}

$resource_types = array();
$res = mysql_query('select * from resource_types');
while($row = mysql_fetch_assoc($res))
    $resource_types[$row['resource_type_id']] = $row['resource_type_name'];
mysql_free_result($res);

?>
<h3><?=($resource_id == ''?'Добавить ресурс':'Изменить ресурс')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Название ресурса: &nbsp;  </td>
  <td><input name="resource_name" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_name']?>" size="30" maxlength="255" /></td>
</tr>
<? if ($resource_id != '') { ?>
<tr>
  <td valign="top">Картинка: &nbsp;  </td>
  <td><img src="http://image.neverlands.ru/resources/<?=$resource_id?>.gif" /></td>
</tr>
<? } ?>
<tr>
  <td>Тип ресурса: &nbsp;  </td>
  <td><?=createSelectFromArray('resource_type', $resource_types, $resource['resource_type'])?></td>
</tr>
<tr>
  <td>Стоимость: &nbsp;  </td>
  <td><input name="resource_cost" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_cost']?>" size="10" maxlength="255" /></td>
</tr>
<? //TODO: Translate Resources ?>
<tr>
  <td>Resource Store: &nbsp;  </td>
  <td><input name="resource_store" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_store']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Requirement: &nbsp;  </td>
  <td><input name="resource_requirement" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_requirement']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Change: &nbsp;  </td>
  <td><input name="resource_change" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_change']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Last: &nbsp;  </td>
  <td><input name="resource_last" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_last']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Temp: &nbsp;  </td>
  <td><input name="resource_temp" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_temp']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Components: &nbsp;  </td>
  <td><input name="resource_components" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_components']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Ready: &nbsp;  </td>
  <td><input name="resource_ready" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_ready']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Resource Life: &nbsp;  </td>
  <td><input name="resource_life" type="text" class="cms_fieldstyle1" value="<?=$resource['resource_life']?>" size="10" maxlength="255" /></td>
</tr>
</table>

    
    
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='<?=$_SESSION['pages']['resource_list']?>'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>