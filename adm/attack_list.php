<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_attack_id']) && $_GET['delete_attack_id']!='' && is_numeric($_GET['delete_attack_id'])) 
{
    $attack_id = (int)$_GET['delete_attack_id'];
    mysql_query('delete from attack_list where attack_id = '.intval($attack_id));
    header('Location: attack_list.php');
}

$attack_type_array = array(
    0 => 'Стандартный',
    1 => 'Абилити / свитки / зелья',
    2 => 'Магия огня',
    3 => 'Магия земли',
    4 => 'Магия воды',
    5 => 'Магия воздуха',
);

$attack_action_type_array = array(
    1 => 'Удар',
    2 => 'Блок',
    3 => 'Зелье',
    4 => 'Магия',
    5 => 'Абилити',
    6 => 'Свитки',
    7 => 'Расширенный',
);

$abilities = '';
$res = mysql_query('select * from attack_list order by attack_id asc'); 
while ($row = mysql_fetch_assoc($res))
{
    $abilities .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот удар?\');" href="attack_list.php?delete_attack_id=' . $row['attack_id'] . '" title="Удалить удар"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="attack_edit.php?attack_id=' . $row['attack_id'] . '" title="Изменить удар"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['attack_id'].'</td>
      <td align="left" class="cms_middle">'.$attack_type_array[$row['type']].'</td>
      <td align="left" class="cms_middle">'.$attack_action_type_array[$row['action_type']].'</td>
      <td align="left" class="cms_middle"><a href="attack_edit.php?attack_id=' . $row['attack_id'] . '" title="Изменить удар">' . _htext($row['name']) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Список ударов</h3>
<div class="cms_ind">
<br />
    Удары: <br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
<tr>
    <td class="cms_cap2 normal"> Удалить</td>
    <td class="cms_cap2 normal"> Изменить</td>

    <td class="cms_cap2">ID удара</td>
    <td class="cms_cap2">Тип</td>
    <td class="cms_cap2">Тип действия</td>
    <td class="cms_cap2">Название удара</td>
</tr>

<?=$abilities?>

</table>
<br />
</div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить удар"/><a href="attack_edit.php" title="Добавить удар">Добавить
    удар</a> &nbsp;<br/>
<br />
    <a href="attack_import.php" title="Импорт конфига">Импорт</a><br/>
<br />
<br />
<form name="generate" action="" method="post">
    <input type="submit" name="generate" value="Генератор ударов"/>
</form>
<? 
if (isset($_POST['generate'])) {
    
    $config = $configjs = '';
    
    $rows = array();
    $res = mysql_query('select max(attack_id) as max_id from attack_list WHERE is_active = 1');
    $row = mysql_fetch_assoc($res);
    $max_id = $row['max_id'];
    mysql_free_result($res);
    
    $js_pos_vars = $js_pos_ochd = $js_pos_type = $js_pos_mana = array();
    
    $ci = 0;
    $res = mysql_query('select * from attack_list WHERE is_active = 1 ORDER BY attack_id ASC');
    while($row = mysql_fetch_assoc($res))
    {
        while ($row['attack_id'] > $ci)
        {
            $config .= "\n";
            $js_pos_vars[$ci] = '""';
            $js_pos_ochd[$ci] = '0';
            $js_pos_type[$ci] = '0';
            $js_pos_mana[$ci] = '0';
            $ci++;
        }
        
        $t = explode('|', $row['params']);
        $js_pos_vars[$row['attack_id']] = '"'.$row['name'].'"';
        if (isset($t[0]))
            $js_pos_ochd[$row['attack_id']] = (int)$t[0];
        else
            $js_pos_ochd[$row['attack_id']] = '0';
            
        $js_pos_type[$row['attack_id']] = (isset($row['pos_type'])?$row['pos_type']:'0');
        
        if ($row['action_type'] == 1 || $row['action_type'] == 2 || $row['action_type'] == 4)
        {
            if (isset($t[1]))
                $js_pos_mana[$row['attack_id']] = (int)$t[1];
            else
                $js_pos_mana[$row['attack_id']] = '0';
        } else
            $js_pos_mana[$row['attack_id']] = '0';
            
        $config .= $row['type'].'|'.($row['display_name']==1?$row['name']:'').'|'.$row['action_type'].'|'.$row['params']."\n";
        $ci++;
    }
    mysql_free_result($res);
    
        
    $configjs .= 'var pos_vars = ['.implode(',', $js_pos_vars).'];'."\n";
    $configjs .= 'var pos_ochd = ['.implode(',', $js_pos_ochd).'];'."\n";
    $configjs .= 'var pos_type = ['.implode(',', $js_pos_type).'];'."\n";
    $configjs .= 'var pos_mana = ['.implode(',', $js_pos_mana).'];'."\n";
    
    
    echo '<textarea cols="100" rows="35">'._htext(substr($config, 0, -1)).'</textarea>
    <br />
    <textarea cols="100" rows="35">'._htext($configjs).'</textarea>
    ';
    
}
?>

<? require('kernel/after.php'); ?>