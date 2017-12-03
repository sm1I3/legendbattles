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
    1 => '�������������',
    2 => '���������� �������',
    4 => '������������� �������',
    8 => '���������� ����������',
    16 => '������������� ����������',
    32 => '�������',
    64 => '�����������',
    128 => '�������',
    256 => '������ ������',
    512 => '������� �����',
    1024 => '������ �����',
    2048 => '����� �����',
    4096 => '����� �����',
    8192 => '����� ��������',
    16384 => '�����',
    32768 => '�����',
    65536 => '������',
    131072 => '�������',
    262144 => '����������� ���� �������',
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
    
    if (trim($_POST['login']) == '') $err[] = '���� \'�����\' ����������� ��� ����������.';
    
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
<h3><?=($user_id == ''?'�������� ������':'������������� ������')?></h3>
<?=errorToHtml($err)?>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>�����: &nbsp;  </td>
  <td><input name="login" type="text" class="cms_fieldstyle1" value="<?=$_POST['login']?>" size="30" maxlength="20" /></td>
</tr>
</table>
����� �������:<br />
<table border="0" cellpadding="0" cellspacing="1">
<? foreach($permissions as $code=>$name) { ?>
<tr>
  <td><input type="checkbox" name="permission[<?=$code?>]" id="permission_<?=$code?>" value="Y" <?=(isset($_POST['permission'][$code]) && $_POST['permission'][$code]=='Y'?'checked="checked"':'')?> /></td>
  <td><label for="permission_<?=$code?>"><?=$name?></label></td>
</tr>
<? } ?>
</table>
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="���������" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='user_list.php'; return false;" class="cms_button1" value="������" />
<p><span class="cms_star">*</span> - ������������ ���� </p>
</form>
<? require('kernel/after.php'); ?>
