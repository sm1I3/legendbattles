<?php
require('kernel/before.php');

if (!userHasPermission(32)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['resource_group_id']) || $_GET['resource_group_id'] == '')
    $resource_group_id = '';
else
    $resource_group_id = $_GET['resource_group_id'];
    
if (isset($_POST['resource_group_name'])) 
{
    
    if ($resource_group_id == '') 
    {
        $query = '
        insert into resource_group
        (
            resource_group_id,
            resource_group_name
        ) values (
            \''.mysql_real_escape_string($_POST['resource_group_id']).'\',
            \''.mysql_real_escape_string($_POST['resource_group_name']).'\'
        )'  ;
        if (!mysql_query($query))
            die(mysql_error());
        
        $resource_group_id = intval($_POST['resource_group_id']);
    }
    else 
    {
        $query = '
        update resource_group set
            resource_group_id = \''.mysql_real_escape_string($_POST['resource_group_id']).'\',
            resource_group_name = \''.mysql_real_escape_string($_POST['resource_group_name']).'\'
        where
            resource_group_id = '.intval($resource_group_id).'
        '  ;
        if (!mysql_query($query))
            die(mysql_error());
    }
    
    if (!mysql_query('delete from resource_group_cont where resource_group_id = '.intval($resource_group_id).''))
        die(mysql_error()); 
    
    if (isset($_POST['resource_id']) && is_array($_POST['resource_id']))
    foreach($_POST['resource_id'] as $k => $resource_id) {
        if (!mysql_query('insert into resource_group_cont (
                            resource_group_id, resource_id, resource_type, count, restore_time
                          ) values (
                            '.(int)$resource_group_id.', '.(int)$resource_id.', '.(int)$_POST['resource_type'][$k].', '.(int)$_POST['count'][$k].', '.(int)$_POST['restore_time'][$k].'
                          )'))
            die(mysql_error()); 
    }
    
    header('Location: resource_group_list.php');
    
}

$group_resources = '';
$row_id = 0;

// list of res types
$resource_types = array();
$res = mysql_query('select * from resource_types');
while($row = mysql_fetch_assoc($res))
    $resource_types[$row['resource_type_id']] = $row['resource_type_name'];
mysql_free_result($res);

$type_resources = array();

// list of resources
$resources = array();
$res = mysql_query('select * from restore_resources');
while($row = mysql_fetch_assoc($res))
{
    $resources[$row['resource_id']] = $row['resource_name'];
    if (!isset($type_resources[$row['resource_type']]))
        $type_resources[$row['resource_type']] = array();
    $type_resources[$row['resource_type']][] = $row['resource_id'];
}
mysql_free_result($res);

$tr = array();
foreach($type_resources as $r => $t)
{
    $tr[$r] = '['.implode(',', $type_resources[$r]).'];';
}

function filter($resources, $type, $type_res)
{
    $r = array();
    foreach($resources as $id=>$res)
    {
        if (in_array($id, $type_res[$type]) !== false)
        {
            $r[$id] = $res;
        }
    }
    return $r;
}

if ($resource_group_id == '') 
{
    $resource_group = array(
        'resource_group_id' => '',
        'resource_group_name' => ''
    );
} 
else 
{
    $resource_group = array();
    $res = mysql_query('select * from resource_group where resource_group_id = '.intval($resource_group_id).'');
    if($row = mysql_fetch_assoc($res))
        $resource_group = $row;
    mysql_free_result($res);
    
    $res = mysql_query('select * from resource_group_cont where resource_group_id = '.intval($resource_group_id).' ');
    while($row = mysql_fetch_assoc($res)) {
        $group_resources .= '
        <tr id="tr_resource_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_resource_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('resource_id['.$row_id.']', filter($resources, $row['resource_type'], $type_resources), $row['resource_id'], 'id="resource_id_'.$row_id.'"').'</td>
          <td align="left" class="cms_middle">'.createSelectFromArray('resource_type['.$row_id.']', $resource_types, $row['resource_type'], 'onchange="filter('.$row_id.',this.options[this.selectedIndex].value);"').'</td>
          <td align="left" class="cms_middle"><input type="text" name="count['.$row_id.']" value="'.$row['count'].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="restore_time['.$row_id.']" value="'.$row['restore_time'].'" /></td>
        </tr>
        ';
    }
}

?>
<h3><?=($resource_group_id == ''?'Добавить группу ресурсов':'Изменить группу ресурсов')?></h3>
<script src="jscript/resource_group.js" language="javascript"></script>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('resources', $resources)?>
<?=createJsArray('resource_types', $resource_types)?>
var type_res = new Array();
<?foreach($tr as $t => $r) { ?>
    type_res[<?=$t?>] = <?=$r?>
<?}?>

function filter(row, type)
{
    sel = document.getElementById('resource_id_'+row);
    sel.options.length = 1;
    for(var res in resources)
    {
        if (type_res[type].indexOf( parseInt(res) ) >= 0)
            sel.options[sel.options.length] = new Option(resources[res], res);
    }
}
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>ID группы: &nbsp;  </td>
  <td><input name="resource_group_id" type="text" class="cms_fieldstyle1" value="<?=$resource_group['resource_group_id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название группы: &nbsp;  </td>
  <td><input name="resource_group_name" type="text" class="cms_fieldstyle1" value="<?=$resource_group['resource_group_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />

Товары:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_resources" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Ресурс</td>
        <td class="cms_cap3">Тип</td>
        <td class="cms_cap3">Кол-во</td>
        <td class="cms_cap3">Время восстановления</td>
    </tr>
    <?=$group_resources?>
</table>
<a onclick="addItem_res_item('table_resources', 'tr_resource_', 'resource[]', resources, '', ''); return false;" href="#">Добавить ресурс</a><br />
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='resource_group_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>