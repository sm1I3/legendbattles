<?php
require('kernel/before.php');

if (!userHasPermission(131072)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_present_id']) && $_GET['delete_present_id']!='' && is_numeric($_GET['delete_present_id'])) {
    $present_id = (int)$_GET['delete_present_id'];
    mysql_query('delete from mark_pod where id = '.intval($present_id));
    header('Location: mark_pod.php');
}

if (isset($_GET['present_category']) && $_GET['present_category'] != '')
    $present_category = $_GET['present_category'];
else
    $present_category = '';
    
$categories = array();
$res = mysql_query('select * from mark_pod order by name asc');
while($row = mysql_fetch_assoc($res))
    $categories[$row['id']] = $row['name'];
mysql_free_result($res);

$images = '';
$i = 0;
$res = mysql_query('select * from mark_pod
    '.($present_category!=''?'where id = '.(int)($present_category).'':'').'
    ORDER BY dlr DESC, price DESC
    '); 
while ($row = mysql_fetch_assoc($res))
{
   $i++;
    $images.='
    <td align="center" class="cms_middle" style="padding-top: 5px;">
        <a href="present_edit.php?present_id=' . $row['id'] . '" title="Изменить">
            <img src="/image/presents/f'.$row['id'].'.gif" style="border: 0px;" /><br />
            '.(intval($row['dlr']) != '0' ? $row['dlr'].' DNV' : $row['price'].' LR').'<br />
            Категория: ' . $categories[$row['pr_cat_id']] . '</a>
            (<a href="present_edit.php?copy_present_id=' . $row['id'] . '" title="Копировать">Копировать</a>)
    </td>
    ';
    if ($i % 6 == 0)
        $images .= '</tr><tr>';
}

$_SESSION['pages']['mark_pod'] = $_SERVER['REQUEST_URI']; 

?>
    <h3>Подарки</h3>
<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Категория:</td>
    <td>
        <?=createSelectFromArray('present_category', $categories, (isset($_GET['present_category'])?$_GET['present_category']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].present_category.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div class="cms_ind">
<br />
    Подарки: <br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <?=$images?>
</table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить подарок"/><a href="present_edit.php" title="Добавить подарок">Добавить
    подарок</a> &nbsp;<br/>
 <br />

<? 
require('kernel/after.php'); 
?>