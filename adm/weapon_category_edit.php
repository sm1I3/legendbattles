<?php

require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['category_code']))
    $weapon_category_code = '';
else
    $weapon_category_code = $_GET['category_code'];
    
if (isset($_POST['category_name'])) {
    
    if ($weapon_category_code == '') {
        $query = '
        insert into weapon_categories
        (
            category_code,
            category_name
        ) values (
            "' . mysqli_escape_string($GLOBALS['db_link'], $_POST['category_code']) . '",
            "' . mysqli_escape_string($GLOBALS['db_link'], $_POST['category_name']) . '"
        )'  ;
    } else {
        $query = '
        update weapon_categories set
            category_code = "' . mysqli_escape_string($GLOBALS['db_link'], $_POST['category_code']) . '",
            category_name = "' . mysqli_escape_string($GLOBALS['db_link'], $_POST['category_name']) . '"
        where
            category_code = \'' . mysqli_escape_string($GLOBALS['db_link'], $weapon_category_code) . '\'
        '  ;
    }
    mysqli_query($GLOBALS['db_link'], $query);
    header('Location: weapon_category_list.php');
    
}

if ($weapon_category_code == '') {
    $weapon_category = array(
        'category_code' => '',
        'category_name' => ''
    );
} else {
    $weapon_category = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_categories where category_code = \'' . mysqli_escape_string($GLOBALS['db_link'], $weapon_category_code) . '\'');
    if ($row = mysqli_fetch_assoc($res))
        $weapon_category = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($weapon_category_code == '' ? 'Добавить категорию оружия' : 'Изменить категорию оружия') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Код категории оружия: &nbsp;</td>
  <td><input name="category_code" type="text" class="cms_fieldstyle1" value="<?=$weapon_category['category_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название категории оружия: &nbsp;</td>
  <td><input name="category_name" type="text" class="cms_fieldstyle1" value="<?=$weapon_category['category_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='weapon_category_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>