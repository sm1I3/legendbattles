<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['bot_template_id']) || !is_numeric($_GET['bot_template_id']))
    $bot_template_id = '';
else
    $bot_template_id = (int)$_GET['bot_template_id'];
    
if (isset($_POST['nickname'])) {
    
    if ($bot_template_id == '') {
        $query = '
        insert into e_players_bots_templates
        (
            bot_template_id,
            nickname,
            shortnn,
            password,
            image,
            intsex,
            nowcity,
            nowplace,
            nowstatus,
            inf_name,
            inf_country,
            inf_city,
            inf_url,
            inf_infoabout
        ) values (
        '.(int)$_POST['bot_template_id'].',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nickname']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['shortnn']) . '\',
        \'a771143db1ae5cd42c9b9b947c2a701f\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['image']) . '\',
        '.(int)$_POST['intsex'].',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowcity']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowplace']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowstatus']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_name']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_country']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_city']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_url']) . '\',
        \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_infoabout']) . '\'
        )'  ;
    } else {
        $query = '
        update e_players_bots_templates set
            bot_template_id = '.(int)$_POST['bot_template_id'].',
            nickname = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nickname']) . '\',
            shortnn = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['shortnn']) . '\',
            image = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['image']) . '\',
            intsex = '.(int)($_POST['intsex']).',
            nowcity = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowcity']) . '\',
            nowplace = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowplace']) . '\',
            nowstatus = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['nowstatus']) . '\',
            inf_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_name']) . '\',
            inf_country = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_country']) . '\',
            inf_city = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_city']) . '\',
            inf_url = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['inf_url']) . '\',
            inf_infoabout = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['int_infoabout']) . '\'
        where
            bot_template_id = '.$bot_template_id.'
        '  ;
    }
    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
    header('Location: bot_template_list.php');
    
}

if ($bot_template_id == '') 
{
    $bot_template = array(
        'bot_template_id' => '',
        'nickname' => '',
        'shortnn' => '',
        'image' => '',
        'intsex' => '0',
        'nowcity' => 'map',
        'nowplace' => 'm_0_0',
        'nowstatus' => 'map',
    );
} 
else 
{
    $bot_template = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from e_players_bots_templates where bot_template_id = ' . intval($bot_template_id));
    if ($row = mysqli_fetch_assoc($res))
        $bot_template = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($bot_template_id == '' ? 'Добавить шаблон бота' : 'Изменить шаблон бота') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID Шаблона: &nbsp;</td>
  <td><input name="bot_template_id" type="text" class="cms_fieldstyle1" value="<?=$bot_template['bot_template_id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Имя бота: &nbsp;</td>
  <td><input name="nickname" type="text" class="cms_fieldstyle1" value="<?=$bot_template['nickname']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Короткое имя: &nbsp;</td>
  <td><input name="shortnn" type="text" class="cms_fieldstyle1" value="<?=$bot_template['shortnn']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Картинка: &nbsp;</td>
  <td><input name="image" type="text" class="cms_fieldstyle1" value="<?=$bot_template['image']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Пол: &nbsp;</td>
  <td><input name="intsex" type="text" class="cms_fieldstyle1" value="<?=$bot_template['intsex']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Текущий город: &nbsp;</td>
  <td><input name="nowcity" type="text" class="cms_fieldstyle1" value="<?=$bot_template['nowcity']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Текущее место: &nbsp;</td>
  <td><input name="nowplace" type="text" class="cms_fieldstyle1" value="<?=$bot_template['nowplace']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Текущий статус: &nbsp;</td>
  <td><input name="nowstatus" type="text" class="cms_fieldstyle1" value="<?=$bot_template['nowstatus']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Имя: &nbsp;</td>
  <td><input name="inf_name" type="text" class="cms_fieldstyle1" value="<?=$bot_template['inf_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Страна: &nbsp;</td>
  <td><input name="inf_country" type="text" class="cms_fieldstyle1" value="<?=$bot_template['inf_country']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Город: &nbsp;</td>
  <td><input name="inf_city" type="text" class="cms_fieldstyle1" value="<?=$bot_template['inf_city']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Домашняя страница: &nbsp;</td>
  <td><input name="inf_url" type="text" class="cms_fieldstyle1" value="<?=$bot_template['inf_url']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>О себе: &nbsp;</td>
  <td><input name="inf_infoabout" type="text" class="cms_fieldstyle1" value="<?=$bot_template['inf_infoabout']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='bot_template_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>