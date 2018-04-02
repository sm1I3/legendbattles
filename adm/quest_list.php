<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_quest_id']) && $_GET['delete_quest_id']!='' && is_numeric($_GET['delete_quest_id'])) {
    $quest_id = (int)$_GET['delete_quest_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from quest_list where quest_id = ' . intval($quest_id) . ' AND is_confirmed = \'N\'');
    header('Location: quest_list.php');
}

if (isset($_GET['accept_confirm']) && $_GET['accept_confirm']!='' && is_numeric($_GET['accept_confirm']) && userHasPermission(4)) {
    $quest_id = (int)$_GET['accept_confirm'];
    mysqli_query($GLOBALS['db_link'], 'update quest_list set is_confirmed = \'Y\' where quest_id = ' . intval($quest_id));
    header('Location: quest_list.php');
}

if (isset($_GET['decline_confirm']) && $_GET['decline_confirm']!='' && is_numeric($_GET['decline_confirm']) && userHasPermission(4)) {
    $quest_id = (int)$_GET['decline_confirm'];
    mysqli_query($GLOBALS['db_link'], 'update quest_list set is_confirmed = \'N\' where quest_id = ' . intval($quest_id));
    header('Location: quest_list.php');
}

if (isset($_GET['is_confirmed']) && $_GET['is_confirmed'] != '')
    $is_confirmed = htmlspecialchars($_GET['is_confirmed']);
else
    $is_confirmed = '';
    
if (isset($_GET['quest_group_id']) && $_GET['quest_group_id'] != '')
    $quest_group_id = intval($_GET['quest_group_id']);
else
    $quest_group_id = '';
    
$quest_groups = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from quest_groups');
while ($row = mysqli_fetch_assoc($res))
    $quest_groups[$row['quest_group_id']] = $row['quest_group_name'];

$quests = '';
$res = mysqli_query($GLOBALS['db_link'], '
    SELECT 
        * 
    FROM 
        quest_list 
    WHERE
        1 > 0
    ' . ($is_confirmed != '' ? ' AND is_confirmed = \'' . mysqli_escape_string($GLOBALS['db_link'], $is_confirmed) . '\'' : '') . '
    '.($quest_group_id!='' ? ' AND quest_group_id = '.intval($quest_group_id).'' : '').'
    ORDER BY 
        quest_id
');

while ($row = mysqli_fetch_assoc($res))
{
    $arr = unserialize($row['quest_serilize']);
    
    if (!userHasPermission(4))
        $confirm_str = '';
    else {
        if ($row['is_confirmed']!='Y')
            $confirm_str = ' (<a href="quest_list.php?accept_confirm=' . $row['quest_id'] . '">Подтвердить</a>)';
        else
            $confirm_str = ' (<a href="quest_list.php?decline_confirm=' . $row['quest_id'] . '">Отменить подтверждение</a>)';
    }
    
    $quests.='
    <tr>
      <td class="cms_middle" align="center">' . ($row['is_confirmed'] != 'Y' ? '<a onclick="return confirm(\'Вы уверены что хотите удалить этот квест?\');" href="quest_list.php?delete_quest_id=' . $row['quest_id'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a>' : '&nbsp;') . '</td>
      <td class="cms_middle" align="center"><a href="quest_edit.php?quest_id=' . $row['quest_id'] . '" title="Изменить"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="quest_edit.php?clone_quest_id=' . $row['quest_id'] . '" title="Изменить"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['quest_id'].'</td>
      <td align="center" class="cms_middle"><img src="images/cms_icons/'.($row['is_confirmed']=='Y'?'cms_checked.gif':'cms_checkbox.gif').'" />'.$confirm_str.'</td>
      <td align="left" class="cms_middle"><a href="quest_edit.php?quest_id=' . $row['quest_id'] . '" title="Изменить">' . _htext($arr[0][0]) . '</a></td>
      <td align="left" class="cms_middle">'._htext($arr[0][5]).'</td>
    </tr>
    ';
}

$_SESSION['cp_pages']['quest_list'] = $_SERVER['REQUEST_URI'];

?>
    <h3>Список квестов</h3>

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Подтверждение:</td>
    <td>
        <?= createSelectFromArray('is_confirmed', array('' => 'Все', 'Y' => 'Только подтверждённые', 'N' => 'Только неподтверждённые'), (isset($_GET['is_confirmed']) ? $_GET['is_confirmed'] : ''), '', false) ?>
    </td>
  </tr>
  <tr>
      <td>Группа:</td>
    <td>
        <?= createSelectFromArray('quest_group_id', $quest_groups, (isset($_GET['quest_group_id']) ? $_GET['quest_group_id'] : ''), '', 'Все') ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].is_confirmed.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div id="results">
    <div class="cms_ind">
    <br />
        Квесты: <br/>
     <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
        <tr >
            <td class="cms_cap2 normal"> Удалить</td>
            <td class="cms_cap2 normal"> Изменить</td>
            <td class="cms_cap2 normal"> Клонировать</td>

            <td class="cms_cap2">ID Квеста</td>
            <td class="cms_cap2">Подтвержден</td>
            <td class="cms_cap2">Название квеста</td>
            <td class="cms_cap2">Комментарий</td>
        </tr>
        
        <?=$quests?>
        
        </table>
        <br />
     </div>
</div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить квест"/><a href="quest_edit.php" title="Добавить квест">Добавить
    квест</a> &nbsp;<br/>
<br />

<? require('kernel/after.php'); ?>