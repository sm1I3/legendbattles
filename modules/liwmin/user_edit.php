<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id']))
    $user_id = '';
else
    $user_id = (int)$_GET['user_id'];
    
$permissions = array(
    1 => 'Администратор',
    2 => 'Добавление квестов',
    4 => 'Подтверждение квестов',
    8 => 'Добавление лабиринтов',
    16 => 'Подтверждение лабиринтов',
    32 => 'Ресурсы',
    64 => 'Инструменты',
    128 => 'Рецепты',
    256 => 'Список оружия',
    512 => 'Шаблоны ботов',
    1024 => 'Список ботов',
    2048 => 'Общая карта',
    4096 => 'Карта ботов',
    8192 => 'Карта растений',
    16384 => 'Места',
    32768 => 'Шахты',
    65536 => 'Оплаты',
    131072 => 'Подарки',
    262144 => 'Конструктор дома дилеров',
);

$err = array();

if ($user_id == '') {
    $user['login'] = '';
    $user['permission'] = array();
} else {
    $user = array();
    $res = mysql_query('select * from user where id = '.intval($user_id));
    if($row = mysql_fetch_assoc($res))
        $user = $row;
    mysql_free_result($res);
    $user['login'] = $row['login'];
    $user['permission'] = array();
    foreach($permissions as $code=>$value)
        if ($row['permission'] & $code)
            $user['permission'][$code] = 'Y';
} 
    
if (isset($_POST['login'])) {
    
    if (trim($_POST['login']) == '') $err[] = 'Поле \'Логин\' обязательно для заполнения.';
    
    if (sizeof($err) == 0) {
    
        $permission_number = 0;
        foreach($permissions as $code=>$value)
            if (isset($_POST['permission'][$code]) && $_POST['permission'][$code]=='Y')
                $permission_number |= $code;
        
        $query = '
        update user set
            permissions = '.$permission_number.'
        where
            id = '.intval($user_id).'
        '  ;
        mysql_query($query);
        header('Location: user_list.php');
    }
    
} else {
    $_POST['login'] = $user['login'];     
    $_POST['permission'] = $user['permission'];
}


?>
<h3><?=($user_id == ''?'Добавить админа':'Редактировать админа')?></h3>
<?=errorToHtml($err)?>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Логин: &nbsp;  </td>
  <td><input name="login" type="text" class="cms_fieldstyle1" value="<?=$_POST['login']?>" size="30" maxlength="20" /></td>
</tr>
</table>
Права доступа:<br />
<table border="0" cellpadding="0" cellspacing="1">
<? foreach($permissions as $code=>$name) { ?>
<tr>
  <td><input type="checkbox" name="permission[<?=$code?>]" id="permission_<?=$code?>" value="Y" <?=(isset($_POST['permission'][$code]) && $_POST['permission'][$code]=='Y'?'checked="checked"':'')?> /></td>
  <td><label for="permission_<?=$code?>"><?=$name?></label></td>
</tr>
<? } ?>
</table>
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='user_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>
