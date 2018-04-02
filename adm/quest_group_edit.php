<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['quest_group_id']) || !is_numeric($_GET['quest_group_id']))
    $quest_group_id = '';
else
    $quest_group_id = (int)$_GET['quest_group_id'];
    
if (isset($_POST['quest_group_name'])) 
{
    
    if ($quest_group_id == '') 
    {
        $query = '
        insert into quest_groups
        (
            quest_group_id,
            quest_group_name
        ) values (
            '.(int)$_POST['quest_group_id'].',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['quest_group_name']) . '\'
        )'  ;
    } else {
        $query = '
        update quest_groups set
            quest_group_id = '.(int)$_POST['quest_group_id'].',
            quest_group_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['quest_group_name']) . '\'
        where
            quest_group_id = '.intval($category_id).'
        '  ;
    }
    mysqli_query($GLOBALS['db_link'], $query);
    header('Location: quest_group_list.php');
    
}

if ((string)$quest_group_id == '') 
{
    $category = array(
        'quest_group_id' => '',
        'quest_group_name' => '',
    );
} 
else 
{
    $category = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from quest_groups where quest_group_id = ' . intval($quest_group_id));
    if ($row = mysqli_fetch_assoc($res))
    {
        $category['quest_group_id'] = $row['quest_group_id'];
        $category['quest_group_name'] = $row['quest_group_name'];
    }

    mysqli_free_result($res);
}

?>
    <h3><?= ($quest_group_id == '' ? 'Добавить категорию' : 'Изменить категорию') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>ID Категории: &nbsp;</td>
  <td><input name="quest_group_id" type="text" class="cms_fieldstyle1" value="<?=$category['quest_group_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название категории: &nbsp;</td>
  <td><input name="quest_group_name" type="text" class="cms_fieldstyle1" value="<?=$category['quest_group_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='quest_group_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>