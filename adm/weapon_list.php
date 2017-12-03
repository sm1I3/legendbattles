<?php
require('kernel/before.php');

if (!userHasPermission(256)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_w_uid']) && $_GET['delete_w_uid']!='' && is_numeric($_GET['delete_w_uid'])) {
    $w_uid = (int)$_GET['delete_w_uid'];
    mysql_query('delete from weapons_template where w_uid = '.intval($w_uid));
    header('Location: '.$_SESSION['pages']['weapon_list']);
}

if (isset($_GET['w_category']) && $_GET['w_category'] != '')
    $w_category = $_GET['w_category'];
else
    $w_category = '';

// PAGE NAVIGATOR
$query = 'select count(*) from weapons_template '.($w_category!=''?'where w_category = \''.mysql_escape_string($w_category).'\'':'');
$res = mysql_query($query);
$row = mysql_fetch_row($res);
$records_count = $row[0];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];
    
if ($cur_page > $pages_count) $cur_page = $pages_count;
if ($cur_page <= 0) $cur_page = 1;
// END PAGE NAVIGATOR

if (isset($_GET['add_to_inventory']) && $_GET['add_to_inventory'] != '')
{
     $res = mysql_query('SELECT * FROM weapons_template WHERE w_uid = '.intval($_GET['add_to_inventory']));
     if ($row = mysql_fetch_assoc($res))
     {
         unset($row['w_uid']);
         unset($row['w_n_um_27']);
         unset($row['w_n_um_29']);
         unset($row['w_n_um_31']);
         unset($row['w_n_um_39']);
         unset($row['w_n_um_40']);
         unset($row['w_add_um_39']);
         unset($row['w_add_um_40']);
         $row['w_gra'] = '';
         $row['nickname'] = '';
         $row['w_material'] = '';
         $string_fields = array('nickname', 'w_name', 'w_image', 'w_category', 'w_id', 'w_gra', 'w_n_clan', 'w_material', 'w_present');
         
         $query = 'INSERT INTO e_weapons_selled ('.implode(', ', array_keys($row)).') VALUES (';
         $values = array();
         foreach($row as $key => $val)
            if (in_array($key, $string_fields))
                $values[] = "'".mysql_real_escape_string($val)."'";
            else
                $values[] = floatval($val);
         
         $query .= implode(', ', $values).')';
         
         if (!mysql_query($query))
            echo mysql_error();
         else
             header('Location: weapon_list.php?w_category=' . (isset($_GET['w_category']) ? $_GET['w_category'] : '') . '&page=' . $cur_page . '&message=Успешно добавлено');
     }
}

if (isset($_GET['add_to_shop']) && $_GET['add_to_shop'] != '')
{
     $res = mysql_query('SELECT * FROM weapons_template WHERE w_uid = '.intval($_GET['add_to_shop']));
     if ($row = mysql_fetch_assoc($res))
     {
         unset($row['w_uid']);
         unset($row['w_n_um_27']);
         unset($row['w_n_um_29']);
         unset($row['w_n_um_31']);
         unset($row['w_n_um_36']);
         unset($row['w_n_um_37']);
         unset($row['w_n_um_39']);
         unset($row['w_n_um_40']);
         unset($row['w_add_um_36']);
         unset($row['w_add_um_37']);
         unset($row['w_add_um_39']);
         unset($row['w_add_um_40']);
         $row['w_count'] = 0;
         $row['w_city_id'] = 'city1';
         $row['w_shop_id'] = 'shop_1';
         $string_fields = array('w_city_id', 'w_shop_id', 'w_name', 'w_image', 'w_category', 'w_id', 'w_material', 'w_about');
         
         $query = 'INSERT INTO e_weapons_sh ('.implode(', ', array_keys($row)).') VALUES (';
         $values = array();
         foreach($row as $key => $val)
            if (in_array($key, $string_fields))
                $values[] = "'".mysql_real_escape_string($val)."'";
            else
                $values[] = floatval($val);
         
         $query .= implode(', ', $values).')';
         
         if (!mysql_query($query))
            echo mysql_error();
         else
             header('Location: weapon_list.php?w_category=' . (isset($_GET['w_category']) ? $_GET['w_category'] : '') . '&page=' . $cur_page . '&message=Успешно добавлено');
     }
}
    
$weapon_categories = array();
$res = mysql_query('select * from weapon_categories');
while($row = mysql_fetch_assoc($res))
    $weapon_categories[$row['category_code']] = $row['category_name'];
mysql_free_result($res);

$query = 'select * from weapons_template '.
        ($w_category!=''?'where w_category = \''.mysql_escape_string($w_category).'\'':'').
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);


$resources = '';
$res = mysql_query($query); 
while ($row = mysql_fetch_assoc($res))
{
    $resources.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить это оружие?\');" href="weapon_list.php?delete_w_uid=' . $row['w_uid'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="weapon_edit.php?w_uid=' . $row['w_uid'] . '" title="Изменить"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="weapon_edit.php?clone_w_uid=' . $row['w_uid'] . '" title="Копировать"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['w_uid'].'</td>
      <td align="left" class="cms_middle">' . (isset($weapon_categories[$row['w_category']]) ? $weapon_categories[$row['w_category']] : '-- Не определено --') . '</td>
      <td align="left" class="cms_middle"><a href="weapon_edit.php?w_uid=' . $row['w_uid'] . '" title="Изменить">' . _htext($row['w_name']) . '</a></td>
      <td align="left" class="cms_middle">'._htext($row['w_price']).'</td>
      <td align="left" class="cms_middle">'.$row['w_id'].'</td>
      <td align="center" class="cms_middle"><a href="weapon_list.php?w_category=' . (isset($_GET['w_category']) ? $_GET['w_category'] : '') . '&page=' . $cur_page . '&add_to_inventory=' . $row['w_uid'] . '" title="Добавить в инвентарь"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="center" class="cms_middle"><a href="weapon_list.php?w_category=' . (isset($_GET['w_category']) ? $_GET['w_category'] : '') . '&page=' . $cur_page . '&add_to_shop=' . $row['w_uid'] . '" title="Добавить в магазин"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
    </tr>
    ';
}

$_SESSION['pages']['weapon_list'] = $_SERVER['REQUEST_URI'];

?>
    <h3>Список оружия</h3>
<? if (isset($_GET['message'])) echo messageToHtml($_GET['message']); ?>
<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Категория оружия:</td>
    <td>
        <?=createSelectFromArray('w_category', $weapon_categories, (isset($_GET['w_category'])?$_GET['w_category']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].w_category.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div id="results">
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Оружия') ?></div>

    <div class="cms_ind">
        <br />
        Ресурсы: <br/>
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2 normal"> Удалить</td>
                <td class="cms_cap2 normal"> Изменить</td>
                <td class="cms_cap2 normal"> Копировать</td>

                <td class="cms_cap2"><a href="<?= sortby('w_uid') ?>">UID Оружия</a></td>
                <td class="cms_cap2">Категория оружия</td>
                <td class="cms_cap2"><a href="<?= sortby('w_name') ?>">Название оружия</a></td>
                <td class="cms_cap2"><a href="<?= sortby('w_price') ?>">Цена оружия</a></td>
                <td class="cms_cap2"><a href="<?= sortby('w_id') ?>">Идентификатор</a></td>
                <td class="cms_cap2 normal"> В инвентарь</td>
                <td class="cms_cap2 normal"> В магазин</td>
            </tr>
            <?=$resources?>   
         </table>
         <br />
    </div>
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Ресурсы') ?></div>
</div>
 
 <br />
    <img src="images/cms_icons/cms_add.gif" alt="Добавить оружие"/><a href="weapon_edit.php" title="Добавить оружие">Добавить
    оружие</a> &nbsp;
 <br />

<? require('kernel/after.php'); ?>