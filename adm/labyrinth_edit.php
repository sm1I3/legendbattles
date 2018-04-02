<?php
require('kernel/before.php');

if (!userHasPermission(8)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['lab_id']) || !is_numeric($_GET['lab_id']))
    $lab_id = '';
else
    $lab_id = (int)$_GET['lab_id'];
    
date_default_timezone_set('Europe/Moscow');
    
if (isset($_POST['labyrinth_name'])) 
{
    
    if ($lab_id == '') 
    {
        
        if ((int)$_POST['width'] < 5) $_POST['width'] = 5;
        if ((int)$_POST['height'] < 5) $_POST['height'] = 5;
        
        $lab_array = array();
        $lab_params = array();
        $lab_objects = array();
        
        for ($i=0; $i<(int)$_POST['height']; $i++)
            for ($j=0; $j<(int)$_POST['width']; $j++)
                $lab_array[$i][$j] = 0;
                    
        $start_array = array(0, 0, 3);
        
        $tmp_arr = array(
            0 => $lab_array,
            1 => $start_array,
            2 => $lab_params,
            3 => $lab_objects,
        );
        
        $serialized = serialize($tmp_arr);
        
        $query = '
        insert into labyrinth_list 
        (
            labyrinth_name,
            labyrinth_serialized
        ) values (
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['labyrinth_name']) . '\',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $serialized) . '\'
        )';

        mysqli_query($GLOBALS['db_link'], $query);

        $lab_id = mysqli_insert_id($GLOBALS['db_link']);
        header('Location: labyrinth_design.php?lab_id='.$lab_id);
    } 
    else 
    {
        $query = '
        update labyrinth_list set
            labyrinth_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['labyrinth_name']) . '\'
        where
            labyrinth_id = '.(int)$lab_id.'
            '.(!userHasPermission(8)?' and is_confirmed = \'N\'':'').'
        '  ;
        mysqli_query($GLOBALS['db_link'], $query);
        header('Location: labyrinth_list.php');
    }    
    
    
}


if ($lab_id == '') {
    $labyrinth = array(
        'labyrinth_name' => '',
    );
    $is_confirmed = 'N';
} else {
    $labyrinth = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from labyrinth_list where labyrinth_id = ' . (int)$lab_id);
    if ($row = mysqli_fetch_assoc($res))
        $labyrinth = $row;
    $is_confirmed = $labyrinth['is_confirmed'];
    mysqli_free_result($res);
}

?>
    <h3><?= ($lab_id == '' ? 'Добавить лабиринт' : 'Параметры лабиринта') ?></h3>

    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Название лабиринта: &nbsp;</td>
  <td><input name="labyrinth_name" type="text" class="cms_fieldstyle1" value="<?=$labyrinth['labyrinth_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<? if ($lab_id == '') { ?>
<br />
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span> Ширина лабиринта (в ячейках): &nbsp;</td>
  <td><input name="width" type="text" class="cms_fieldstyle1" value="25" size="10" maxlength="5" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span> Высота лабиринта (в ячейках): &nbsp;</td>
  <td><input name="height" type="text" class="cms_fieldstyle1" value="14" size="10" maxlength="5" /></td>
</tr>
</table>
<? } ?>
    
    
<p></p>
<script src="jscript/validation.js" language="javascript"></script>
<script language="javascript">
function validate(frm) {
  var value = '';
  var errFlag = new Array();
  var _qfGroups = {};
  _qfMsg = '';
  
 
  value = frm.elements['labyrinth_name'].value;
  if (value == '' && !errFlag['labyrinth_name']) {
    errFlag['labyrinth_name'] = true;
      _qfMsg = _qfMsg + '\n - Поле \'Название лабиринта\' обязательно для заполнения!';
  }
  
  <? if ($lab_id == '') { ?> 
  
      value = frm.elements['width'].value;
      if (value == '' && !errFlag['width']) {
        errFlag['width'] = true;
          _qfMsg = _qfMsg + '\n - Поле \'Ширина лабиринта\' обязательно для заполнения!';
      }
      
      value = frm.elements['width'].value;
      if (!isPositiveInteger(value) && !errFlag['width']) {
        errFlag['width'] = true;
          _qfMsg = _qfMsg + '\n - Поле \'Ширина лабиринта\' должно содержать положительное целое число!';
      }
      
      value = frm.elements['height'].value;
      if (value == '' && !errFlag['height']) {
        errFlag['height'] = true;
          _qfMsg = _qfMsg + '\n - Поле \'Высота лабиринта\' обязательно для заполнения!';
      }
      
      value = frm.elements['height'].value;
      if (!isPositiveInteger(value) && !errFlag['height']) {
        errFlag['height'] = true;
          _qfMsg = _qfMsg + '\n - Поле \'Высота лабиринта\' должно содержать положительное целое число!';
      }
      
  <? } ?>
  

  if (_qfMsg != '') {
      _qfMsg = 'Введена неверная информация.' + _qfMsg;
      _qfMsg = _qfMsg + '\nПожалуйста исправьте эти поля.';
    alert(_qfMsg);
    return false;
  }
  return true;
}

</script>
    <input name="submit" onclick="return validate(this.form);" type="submit" class="cms_button1" value="Сохранить"
           style="width: 150px" <?= (!userHasPermission(8) && $is_confirmed == 'Y' ? 'disabled="disabled"' : '') ?> />
    <input name="cancel" type="submit" onclick="document.location='labyrinth_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>