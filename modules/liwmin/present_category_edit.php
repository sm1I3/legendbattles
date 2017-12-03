<?php
require('kernel/before.php');

if (!userHasPermission(131072)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['category_id']) || !is_numeric($_GET['category_id']))
    $category_id = '';
else
    $category_id = (int)$_GET['category_id'];
    
if (isset($_POST['category_id'])) {
    
    if ($category_id == '') 
    {
        $query = '
        insert into present_category
        (
            pr_cat_id,
            pr_cat_title,
            pr_cat_start,
            pr_cat_end
        ) values (
            '.(int)$_POST['category_id'].',
            \''.mysql_escape_string($_POST['category_name']).'\',
            '.strtotime($_POST['category_start']).',
            '.strtotime($_POST['category_end']).'
        )'  ;
    } else {
        $query = '
        update present_category set
            pr_cat_id = '.(int)$_POST['category_id'].',
            pr_cat_title = \''.mysql_escape_string($_POST['category_name']).'\',
            pr_cat_start = '.strtotime($_POST['category_start']).',
            pr_cat_end = '.strtotime($_POST['category_end']).'
        where
            pr_cat_id = '.intval($category_id).'
        '  ;
    }    
    mysql_query($query);
    header('Location: present_category_list.php');
    
}

if ((string)$category_id == '') {
    $category = array(
        'category_id' => '',
        'category_name' => '',
        'category_start' => date('Y-m-d H:i:s'),
        'category_end' => date('Y-m-d H:i:s', strtotime('+1 month')),
    );
} else {
    $category = array();
    $res = mysql_query('select * from present_category where pr_cat_id = '.intval($category_id));
    if($row = mysql_fetch_assoc($res))
    {
        $category['category_id'] = $row['pr_cat_id'];
        $category['category_name'] = $row['pr_cat_title'];
        $category['category_start'] = date('Y-m-d H:i:s', $row['pr_cat_start']);
        $category['category_end'] = date('Y-m-d H:i:s', $row['pr_cat_end']);
    }
    
    mysql_free_result($res);
}

?>
<h3><?=($category_id == ''?'Добавить категорию':'Изменить категорию')?></h3>

<script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="windows-1251"></script> 
<script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="windows-1251"></script>     
<script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="windows-1251"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>ID Категории: &nbsp;  </td>
  <td><input name="category_id" type="text" class="cms_fieldstyle1" value="<?=$category['category_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название категории: &nbsp;  </td>
  <td><input name="category_name" type="text" class="cms_fieldstyle1" value="<?=$category['category_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Начало действия: &nbsp;  </td>
  <td>
    <input name="category_start" id="date_from" type="text" class="cms_fieldstyle1" value="<?=$category['category_start']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_from",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_from",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
  <td>Окончание действия: &nbsp;  </td>
  <td>
    <input name="category_end" id="date_to" type="text" class="cms_fieldstyle1" value="<?=$category['category_end']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kjkjdnakjdnakwnjkd2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_to",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "kjkjdnakjdnakwnjkd2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_to",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='present_category_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>