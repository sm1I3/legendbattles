<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['branch_code']) || ($_GET['branch_code']==''))
    $branch_code = '';
else
    $branch_code = $_GET['branch_code'];
    
$banks = array();
$res = mysql_query('select * from bank');
while($row = mysql_fetch_assoc($res))
    $banks[$row['bank_id']] = $row['bank_name'];
mysql_free_result($res);
    
if (isset($_POST['branch_name'])) {
    
    if ($branch_code == '') {
        $query = '
        insert into bank_branch
        (
            branch_code,
            bank_id,
            branch_name,
            player_nv_cell_size,
            player_usd_cell_size,
            player_dnv_cell_size,
            clan_nv_cell_size,
            clan_usd_cell_size,
            clan_dnv_cell_size
        ) values (
            \''.mysql_real_escape_string($_POST['branch_code']).'\',
            '.(int)$_POST['bank_id'].',
            \''.mysql_real_escape_string($_POST['branch_name']).'\',
            '.(int)$_POST['player_nv_cell_size'].',
            '.(int)$_POST['player_usd_cell_size'].',
            '.(int)$_POST['player_dnv_cell_size'].',
            '.(int)$_POST['clan_nv_cell_size'].',
            '.(int)$_POST['clan_usd_cell_size'].',
            '.(int)$_POST['clan_dnv_cell_size'].'
        )'  ;
    } else {
        $query = '
        update bank_branch set
            branch_code = \''.mysql_real_escape_string($_POST['branch_code']).'\',
            bank_id = '.(int)$_POST['bank_id'].',
            branch_name = \''.mysql_real_escape_string($_POST['branch_name']).'\',
            player_nv_cell_size = '.(int)$_POST['player_nv_cell_size'].',
            player_usd_cell_size = '.(int)$_POST['player_usd_cell_size'].',
            player_dnv_cell_size = '.(int)$_POST['player_dnv_cell_size'].',
            clan_nv_cell_size = '.(int)$_POST['clan_nv_cell_size'].',
            clan_usd_cell_size = '.(int)$_POST['clan_usd_cell_size'].',
            clan_dnv_cell_size = '.(int)$_POST['clan_dnv_cell_size'].'
        where
            branch_code = \''.$branch_code.'\'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: bank_branch_list.php');
    
}

if ($branch_code == '') {
    $branch = array(
        'branch_code' => '',
        'bank_id' => '',
        'branch_name' => '',
        'player_nv_cell_size' => '',
        'player_usd_cell_size' => '',
        'player_dnv_cell_size' => '',
        'clan_nv_cell_size' => '',
        'clan_usd_cell_size' => '',
        'clan_dnv_cell_size' => '',
    );
} else {
    $branch = array();
    $res = mysql_query('select * from bank_branch where branch_code = \''.mysql_real_escape_string($branch_code).'\'');
    if($row = mysql_fetch_assoc($res))
        $branch = $row;
    mysql_free_result($res);
}

?>
    <h3><?= ($branch_code == '' ? 'Добавить отделение банка' : 'Изменить отделение банка') ?></h3>

<form name="edit_bank" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Код отделения: &nbsp;</td>
  <td><input name="branch_code" type="text" class="cms_fieldstyle1" value="<?=$branch['branch_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Банк: &nbsp;</td>
  <td><?=createSelectFromArray('bank_id', $banks, $branch['bank_id'])?></td>
</tr>
<tr>
    <td>Название отделения: &nbsp;</td>
  <td><input name="branch_name" type="text" class="cms_fieldstyle1" value="<?=$branch['branch_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер ячейки: &nbsp;</td>
  <td><input name="player_nv_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['player_nv_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер Gold ячейки: &nbsp;</td>
  <td><input name="player_usd_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['player_usd_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер DNV ячейки: &nbsp;</td>
  <td><input name="player_dnv_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['player_dnv_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер клановой ячейки: &nbsp;</td>
  <td><input name="clan_nv_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['clan_nv_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер клановой Gold ячейки: &nbsp;</td>
  <td><input name="clan_usd_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['clan_usd_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Размер клановой DNV ячейки: &nbsp;</td>
  <td><input name="clan_dnv_cell_size" type="text" class="cms_fieldstyle1" value="<?=$branch['clan_dnv_cell_size']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='bank_branch_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>