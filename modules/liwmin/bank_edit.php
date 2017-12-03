<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['bank_id']) || !is_numeric($_GET['bank_id']))
    $bank_id = '';
else
    $bank_id = (int)$_GET['bank_id'];
    
if (isset($_POST['bank_name'])) {
    
    if ($bank_id == '') {
        $query = '
        INSERT INTO bank
        (
            bank_id, bank_name, is_commercial, money, gov_tax, initial_money, 
            shares_total, inner_transaction_fee, outer_transaction_fee, 
            player_account_nv_monthly_fees, player_account_usd_monthly_fees, player_account_dnv_monthly_fees,
            clan_account_nv_monthly_fees, 
            player_account_nv_price, player_account_usd_price, player_account_dnv_price,
            clan_account_nv_price,
            player_cell_nv_price, player_cell_usd_price, clan_cell_nv_price, clan_cell_usd_price,
            player_cell_nv_monthly_fees, player_cell_usd_monthly_fees, clan_cell_nv_monthly_fees, clan_cell_usd_monthly_fees,
            clan_account_dnv_price, clan_account_dnv_monthly_fees
        ) VALUES (
            '.(int)$_POST['bank_id'].', \''.mysql_escape_string($_POST['bank_name']).'\', '.(isset($_POST['is_commercial'])?'1':'0').', '.(float)$_POST['money'].', '.(float)$_POST['gov_tax'].', '.(float)$_POST['initial_money'].',
            '.(int)$_POST['shares_total'].', '.(float)$_POST['inner_transaction_fee'].', '.(float)$_POST['outer_transaction_fee'].',
            '.(float)$_POST['player_account_nv_monthly_fees'].', '.(float)$_POST['player_account_usd_monthly_fees'].', '.(float)$_POST['player_account_dnv_monthly_fees'].',
            '.(float)$_POST['clan_account_nv_monthly_fees'].',
            '.(float)$_POST['player_account_nv_price'].', '.(float)$_POST['player_account_usd_price'].', '.(float)$_POST['player_account_dnv_price'].',
            '.(float)$_POST['clan_account_nv_price'].',
            '.(float)$_POST['player_cell_nv_price'].', '.(int)$_POST['player_cell_usd_price'].', '.(float)$_POST['player_cell_dnv_price'].', '.(float)$_POST['clan_cell_nv_price'].', '.(int)$_POST['clan_cell_usd_price'].', '.(float)$_POST['clan_cell_dnv_price'].',
            '.(float)$_POST['player_cell_nv_monthly_fees'].', '.(int)$_POST['player_cell_usd_monthly_fees'].', '.(float)$_POST['player_cell_dnv_monthly_fees'].', '.(float)$_POST['clan_cell_nv_monthly_fees'].', '.(int)$_POST['clan_cell_usd_monthly_fees'].', '.(float)$_POST['clan_cell_dnv_monthly_fees'].', 
            '.(float)$_POST['clan_account_dnv_price'].', '.(float)$_POST['clan_account_dnv_monthly_fees'].'
        )'  ;
    } else {
        $query = '
        UPDATE bank 
        SET
            bank_id = '.(int)$_POST['bank_id'].',
            bank_name = \''.mysql_real_escape_string($_POST['bank_name']).'\',
            is_commercial = '.(isset($_POST['is_commercial'])?'1':'0').',
            money = '.(float)$_POST['money'].',
            gov_tax = '.(float)$_POST['gov_tax'].',
            initial_money = '.(float)$_POST['initial_money'].',
            shares_total = '.(int)$_POST['shares_total'].',
            inner_transaction_fee = '.(float)$_POST['inner_transaction_fee'].',
            outer_transaction_fee = '.(float)$_POST['outer_transaction_fee'].',
            player_account_nv_monthly_fees = '.(float)$_POST['player_account_nv_monthly_fees'].',
            player_account_usd_monthly_fees = '.(float)$_POST['player_account_usd_monthly_fees'].',
            player_account_dnv_monthly_fees = '.(float)$_POST['player_account_dnv_monthly_fees'].',
            clan_account_nv_monthly_fees = '.(float)$_POST['clan_account_nv_monthly_fees'].',
            player_account_nv_price = '.(float)$_POST['player_account_nv_price'].',
            player_account_usd_price = '.(float)$_POST['player_account_usd_price'].',
            player_account_dnv_price = '.(float)$_POST['player_account_dnv_price'].',
            clan_account_nv_price = '.(float)$_POST['clan_account_nv_price'].',
            player_cell_nv_price = '.(float)$_POST['player_cell_nv_price'].',
            player_cell_usd_price = '.(int)$_POST['player_cell_usd_price'].',
            player_cell_dnv_price = '.(float)$_POST['player_cell_dnv_price'].',
            clan_cell_nv_price = '.(float)$_POST['clan_cell_nv_price'].',
            clan_cell_usd_price = '.(int)$_POST['clan_cell_usd_price'].',
            clan_cell_dnv_price = '.(float)$_POST['clan_cell_dnv_price'].',
            player_cell_nv_monthly_fees = '.(float)$_POST['player_cell_nv_monthly_fees'].',
            player_cell_usd_monthly_fees = '.(int)$_POST['player_cell_usd_monthly_fees'].',
            player_cell_dnv_monthly_fees = '.(float)$_POST['player_cell_dnv_monthly_fees'].',
            clan_cell_nv_monthly_fees = '.(float)$_POST['clan_cell_nv_monthly_fees'].',
            clan_cell_usd_monthly_fees = '.(int)$_POST['clan_cell_usd_monthly_fees'].',
            clan_cell_dnv_monthly_fees = '.(float)$_POST['clan_cell_dnv_monthly_fees'].',
            clan_account_dnv_price = '.(float)$_POST['clan_account_dnv_price'].',
            clan_account_dnv_monthly_fees = '.(float)$_POST['clan_account_dnv_monthly_fees'].'
        WHERE
            bank_id = '.$bank_id.'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: bank_list.php');
    
}

if ($bank_id == '') {
    $bank = array(
        'bank_id' => '',
        'bank_name' => '',
        'is_commercial' => '0',
        'money' => '',
        'gov_tax' => '0',
        'initial_money' => '0',
        'shares_total' => '100',
        'inner_transaction_fee' => '0.01',
        'outer_transaction_fee' => '0.05',
        'player_account_nv_price' => '0',
        'player_account_usd_price' => '0',
        'player_account_dnv_price' => '0',
        'clan_account_nv_price' => '0',
        'player_account_nv_monthly_fees' => '0',
        'player_account_usd_monthly_fees' => '0',
        'player_account_dnv_monthly_fees' => '0',
        'clan_account_nv_monthly_fees' => '0',
        'player_cell_nv_price' => '0',
        'player_cell_usd_price' => '0',
        'player_cell_dnv_price' => '0',
        'clan_cell_nv_price' => '0',
        'clan_cell_usd_price' => '0',
        'clan_cell_dnv_price' => '0',
        'player_cell_nv_monthly_fees' => '0',
        'player_cell_usd_monthly_fees' => '0',
        'player_cell_dnv_monthly_fees' => '0',
        'clan_cell_nv_monthly_fees' => '0',
        'clan_cell_usd_monthly_fees' => '0',
        'clan_cell_dnv_monthly_fees' => '0',
        
    );
} else {
    $bank = array();
    $res = mysql_query('select * from bank where bank_id = '.intval($bank_id));
    if($row = mysql_fetch_assoc($res))
        $bank = $row;
    mysql_free_result($res);
}

?>
<h3><?=($bank_id == ''?'Добавить банк':'Изменить банк')?></h3>

<form name="edit_bank" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">

<tr>
  <td>ID Банка: &nbsp;  </td>
  <td><input name="bank_id" type="text" class="cms_fieldstyle1" value="<?=$bank['bank_id']?>" size="5" maxlength="255" /></td>
</tr>
<tr>
  <td>Имя банка: &nbsp;  </td>
  <td><input name="bank_name" type="text" class="cms_fieldstyle1" value="<?=$bank['bank_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Коммертческий банк: &nbsp;  </td>
  <td><input name="is_commercial" type="checkbox" class="cms_fieldstyle1" value="Y" <?=($bank['is_commercial']==1?'checked':'')?> /></td>
</tr>
<tr>
  <td>Капитал банка: &nbsp;  </td>
  <td><input name="money" type="text" class="cms_fieldstyle1" value="<?=$bank['money']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Процент в пользу государства: &nbsp;  </td>
  <td><input name="gov_tax" type="text" class="cms_fieldstyle1" value="<?=$bank['gov_tax']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Капитализация в акциях: &nbsp;  </td>
  <td><input name="initial_money" type="text" class="cms_fieldstyle1" value="<?=$bank['initial_money']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Количество акций: &nbsp;  </td>
  <td><input name="shares_total" type="text" class="cms_fieldstyle1" value="<?=$bank['shares_total']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Комиссия за тразакцию внутри банка: &nbsp;  </td>
  <td><input name="inner_transaction_fee" type="text" class="cms_fieldstyle1" value="<?=$bank['inner_transaction_fee']?>" size="12" maxlength="255" /></td>
</tr>
<tr>
  <td>Комиссия за транзакцию в другой банк: &nbsp;  </td>
  <td><input name="outer_transaction_fee" type="text" class="cms_fieldstyle1" value="<?=$bank['outer_transaction_fee']?>" size="12" maxlength="255" /></td>
</tr>
</table>
<br />
<b>Счета</b>
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Стоимоть обслуживания NV счёта: &nbsp;  </td>
  <td><input name="player_account_nv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_nv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания Gold счёта: &nbsp;  </td>
  <td><input name="player_account_usd_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_usd_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания DNV счёта: &nbsp;  </td>
  <td><input name="player_account_dnv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_dnv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания кланового NV счёта: &nbsp;  </td>
  <td><input name="clan_account_nv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_account_nv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания кланового DNV счёта: &nbsp;  </td>
  <td><input name="clan_account_dnv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_account_dnv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия NV счёта: &nbsp;  </td>
  <td><input name="player_account_nv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_nv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия Gold счёта: &nbsp;  </td>
  <td><input name="player_account_usd_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_usd_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия DNV счёта: &nbsp;  </td>
  <td><input name="player_account_dnv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_account_dnv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия кланового NV счёта: &nbsp;  </td>
  <td><input name="clan_account_nv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_account_nv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия кланового DNV счёта: &nbsp;  </td>
  <td><input name="clan_account_dnv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_account_dnv_price']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />
<b>Ячейки</b>
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Стоимоть открытия ячейки: &nbsp;  </td>
  <td><input name="player_cell_nv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_nv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия Gold ячейки: &nbsp;  </td>
  <td><input name="player_cell_usd_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_usd_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия DNV ячейки: &nbsp;  </td>
  <td><input name="player_cell_dnv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_dnv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия клановой ячейки: &nbsp;  </td>
  <td><input name="clan_cell_nv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_nv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия клановой Gold ячейки: &nbsp;  </td>
  <td><input name="clan_cell_usd_price" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_usd_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть открытия клановой DNV ячейки: &nbsp;  </td>
  <td><input name="clan_cell_dnv_price" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_dnv_price']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания ячейки: &nbsp;  </td>
  <td><input name="player_cell_nv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_nv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания Gold ячейки: &nbsp;  </td>
  <td><input name="player_cell_usd_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_usd_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания DNV ячейки: &nbsp;  </td>
  <td><input name="player_cell_dnv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['player_cell_dnv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания клановой ячейки: &nbsp;  </td>
  <td><input name="clan_cell_nv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_nv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания клановой Gold ячейки: &nbsp;  </td>
  <td><input name="clan_cell_usd_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_usd_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Стоимоть обслуживания клановой DNV ячейки: &nbsp;  </td>
  <td><input name="clan_cell_dnv_monthly_fees" type="text" class="cms_fieldstyle1" value="<?=$bank['clan_cell_dnv_monthly_fees']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='bank_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>