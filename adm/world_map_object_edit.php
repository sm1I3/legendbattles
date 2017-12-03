<?php

require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$object_type_array = Array(
    0 => '��� ������',
    1 => '�������',
    2 => '�����',
    3 => '�������',
    4 => '�����',
);

if (!isset($_GET['object_code']))
    $object_code = '';
else
    $object_code = $_GET['object_code'];
    
$zones = array();
$res = mysql_query('select * from world_zones');
while($row = mysql_fetch_assoc($res))
    $zones[$row['zone_code']] = $row['zone_name'];
mysql_free_result($res);

$object_array = array();
$res = mysql_query('select * from world_objects');
while($row = mysql_fetch_assoc($res))
    $object_array[$row['object_code']] = $row['object_name'].' ('.$row['object_code'].')';
mysql_free_result($res);
    
if (isset($_POST['object_code'])) 
{
    if ($_POST['parent_code_map'] != '')
        $parent_code = $_POST['parent_code_map'];
    elseif ($_POST['parent_code'] != '')
        $parent_code = $_POST['parent_code'];
    else
        $parent_code = '';
    
    if ($object_code == '') {
        $query = '
        insert into world_objects
        (
            object_code,
            object_module,
            parent_code,
            zone_code,
            object_name,
            object_type,
            object_params
        ) values (
        \''.mysql_real_escape_string($_POST['object_code']).'\',
        \''.mysql_real_escape_string($_POST['object_module']).'\',
        '.($parent_code!=''?'\''.mysql_real_escape_string($parent_code).'\'':'NULL').',
        \''.mysql_real_escape_string($_POST['zone_code']).'\',
        \''.mysql_real_escape_string($_POST['object_name']).'\',
        '.(int)$_POST['object_type'].',
        \'\'
        )'  ;
    } else {
        $query = '
        update world_objects set
            object_code = \''.mysql_real_escape_string($_POST['object_code']).'\',
            object_module = \''.mysql_real_escape_string($_POST['object_module']).'\',
            parent_code = '.($parent_code!=''?'\''.mysql_real_escape_string($parent_code).'\'':'NULL').',
            zone_code = \''.mysql_real_escape_string($_POST['zone_code']).'\',
            object_type = '.(int)$_POST['object_type'].',
            object_name = \''.mysql_real_escape_string($_POST['object_name']).'\'
        where
            object_code = \''.mysql_real_escape_string($object_code).'\'
        '  ;
    }    
    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: '.$_SESSION['pages']['world_map_object_list']);
    
}

if ($object_code == '') {
    $object = array(
        'object_code' => '',
        'object_module' => '',
        'object_name' => '',
    );
} else {
    $object = array();
    $res = mysql_query('select * from world_objects where object_code = \''.mysql_real_escape_string($object_code).'\'');
    if($row = mysql_fetch_assoc($res))
        $object = $row;
    mysql_free_result($res);
}

?>
<h3><?=($object_code == ''?'�������� ������':'�������� ������')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>��� �������: &nbsp;  </td>
  <td><input name="object_code" type="text" class="cms_fieldstyle1" value="<?=$object['object_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>�������� �������: &nbsp;  </td>
  <td><input name="object_name" type="text" class="cms_fieldstyle1" value="<?=$object['object_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>������: &nbsp;  </td>
  <td><input name="object_module" type="text" class="cms_fieldstyle1" value="<?=$object['object_module']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>����: &nbsp;  </td>
  <td><?=createSelectFromArray('zone_code', $zones, $object['zone_code'])?></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td><span class="cms_star">*</span>���. ������: &nbsp;  </td>
  <td>
        <?=createSelectFromArray('parent_code', $object_array, (isset($object['parent_code'])?$object['parent_code']:''))?><br />
        <input type="text" name="parent_code_map" value="<?=(isset($object['parent_code']) && isset($object_array[$object['parent_code']])?'': (isset($object['parent_code'])?$object['parent_code']:''))?>" />
  </td>
</tr>
<tr>
  <td><span class="cms_star">*</span>��� ������������� �������: &nbsp;  </td>
  <td><?=createSelectFromArray('object_type', $object_type_array, (isset($object['object_type'])?$object['object_type']:''))?></td>
</tr>

</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="���������" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='<?=$_SESSION['pages']['world_map_object_list']?>'; return false;" class="cms_button1" value="������" />
<p><span class="cms_star">*</span> - ������������ ���� </p>
</form>
<? require('kernel/after.php'); ?>