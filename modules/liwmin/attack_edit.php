<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['attack_id']) || !is_numeric($_GET['attack_id']))
    $attack_id = '';
else
    $attack_id = (int)$_GET['attack_id'];
    
    
$fields = array(
    1 => array(
        array('��', 'i'),
        array('��� ����', 'i'),
        array('���� ����', 'i'),
        array('����������� ����������', 'i'),
        array('����������� �������������', 'f'),
        array('����������� ������', 'f'),
        array('��� ����', 'f'),
        array('���� ����', 'f'),
        array('��� ����', 'b', '', array(1 => array(9,10,11))),
        array('������', 'i', '', '', false),
        array('����������� �����', 'i', '', '', false),
        array('��� ����� �� �������', 'i', '', '', false),
    ),
    2 => array(
        array('��', 'i'),
        array('MP', 'i'),
        array('��� �����', 'so', array(0=>'���������� �����', 1=>'��������'), array(1 => array(3,4,5,6))),
        array('������', 'b', '', '', false),
        array('����', 'b', '', '', false),
        array('���', 'b', '', '', false),
        array('����', 'b', '', '', false),
        array('���� ���', 'b'),
        array('������������� �����', 'f'),
        array('������������� ��� �����', 'f'),
        array('�������� ����� (����)', 'f'),
        array('�������� ����������� ����� (����)', 'f'),
        array('��������� (�����)', 'i'),
    ),
    3 => array(
        array('��', 'i'),
    ),
    4 => array(
        array('��', 'i'),
        array('��� ����', 'i'),
        array('���� ����', 'i'),
    ),
    5 => array(
        array('��', 'i'),
    ),
    6 => array(
        array('��', 'i'),
    ),
    7 => array(
        array('��', 'i'),
    ),
);
    
if (isset($_POST['attack_id'])) 
{
    $at = (int)$_POST['action_type'];
    $params = array();
    
    for($i=0; $i<sizeof($fields[$at]); $i++)
    {
        switch($fields[$at][$i][1])
        {
            case 'b':
                $params[$i] = (isset($_POST['field'][$at][$i])?1:0);
            break;
            case 'i':
                $params[$i] = (int)($_POST['field'][$at][$i]);
            case 's':
                $params[$i] = ($_POST['field'][$at][$i]);
            break;
            case 'so':
                $params[$i] = ($_POST['field'][$at][$i]=='other'?$_POST['otherfiled_'.$at.'_'.$i]:$_POST['field'][$at][$i]);
            break;
            case 'f':
                $params[$i] = (float)($_POST['field'][$at][$i]);
            break;
            case 't':
                $params[$i] = $_POST['field'][$at][$i];
            break;
            default:
                $params[$i] = '';
            break;
        }
    }
    
    if ((string)$attack_id == '') {
        $query = '
        insert into attack_list
        (
            attack_id,
            is_active,
            name,
            display_name,
            type,
            action_type,
            pos_type,
            params
        ) values (
            '.intval($_POST['attack_id']).',
            '.(isset($_POST['is_active']) ? 1 : 0).',
            \''.mysql_real_escape_string($_POST['name']).'\',
            '.(isset($_POST['display_name']) ? 1 : 0).',
            '.intval($_POST['type']).',
            '.intval($at).',
            '.intval($_POST['pos_type']).',
            \''.mysql_real_escape_string(implode('|', $params)).'\'
        )'  ;
    } else {
        $query = '
        update attack_list set
            attack_id = '.intval($_POST['attack_id']).',
            is_active = '.(isset($_POST['is_active']) ? 1 : 0).',
            name = \''.mysql_real_escape_string($_POST['name']).'\',
            display_name = '.(isset($_POST['display_name']) ? 1 : 0).',
            type = '.intval($_POST['type']).',
            action_type = '.intval($at).',
            pos_type = '.intval($_POST['pos_type']).',
            params = \''.mysql_real_escape_string(implode('|', $params)).'\'
        where
            attack_id = '.intval($attack_id).'
        '  ;
    }    
    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: attack_list.php');
    
}

if ((string)$attack_id == '') 
{
    $attack = array(
        'attack_id' => '',
        'is_active' => 1,
        'type' => 0,
        'action_type' => 0,
        'name' => '',
        'display_name' => 1,
        'pos_type' => '',
    );
    $aparams = array();
} 
else 
{
    $attack = array();
    $res = mysql_query('select * from attack_list where attack_id = '.intval($attack_id));
    if($row = mysql_fetch_assoc($res))
        $attack = $row;
    mysql_free_result($res);
    $aparams = explode('|', $attack['params']);
}

$attack_type_array = array(
    0 => '�����������',
    1 => '������� / ������ / �����',
    2 => '����� ����',
    3 => '����� �����',
    4 => '����� ����',
    5 => '����� �������',
);

$attack_action_type_array = array(
    1 => '����',
    2 => '����',
    3 => '�����',
    4 => '�����',
    5 => '�������',
    6 => '������',
    7 => '�����������',
);

$attack_type_actions = array(
    0 => array(1,2,3),
    1 => array(5,6,3,7),
    2 => array(4),
    3 => array(4),
    4 => array(4),
    5 => array(4),
);

?>
<h3><?=($attack_id == ''?'�������� ����':'�������� ����')?></h3>

<script language="javascript">
var now_type = <?=$attack['action_type']?>;
<?=createJsArray('attack_types', $attack_type_array)?>
<?=createJsArray('action_types', $attack_action_type_array)?>
<?=createJsHArray('type_actions' ,$attack_type_actions)?>

function switchType(type)
{
    var at = el('action_type');
    at.options.length = 0;
    at.options[at.options.length] = new Option("(Please select)", "");
    if (type != '')
    {
        for(var i=0; i<type_actions[type].length; i++)
        {
            j = type_actions[type][i];
            at.options[at.options.length] = new Option(action_types[j], j);
        }
        if (type_actions[type].length == 1)
        {
            at.options.selectedIndex = 1;
            switchActionType(at.options[at.options.selectedIndex].value);
            return true;
        }
        
    }
    switchActionType('');
    return true;
}

function switchActionType(type)
{
    if (now_type!='')
        el('fields_'+now_type).style.display = 'none';
    if (type!='')
        el('fields_'+type).style.display = 'block';
    now_type = type;
    
    changePos();
}

var allow_pos_type = true;

function changePos()
{
    if (!allow_pos_type)
        return false;
        
    elt = el('type');
    t = elt.options[elt.selectedIndex].value;
    elat = el('action_type');
    at = elat.options[elat.selectedIndex].value;
    
    gv = '';
    
    if (t == '0' && at == '1') gv = '1';
    if (t == '0' && at == '2') gv = '2';
    if (t == '0' && at == '3') gv = '4';
    if (t == '1' && at == '3') gv = '4';
    if (t == '1' && at == '5') gv = '3';
    if (t == '1' && at == '6') gv = '4';
    if (t == '2' || t == '3' || t == '4' || t == '5') gv = '3';
    if (at == '7') gv = '';
    
    el('pos_type').value = gv;
}
</script>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>ID �����: &nbsp;  </td>
  <td><input name="attack_id" type="text" class="cms_fieldstyle1" value="<?=$attack['attack_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>��������: &nbsp;  </td>
  <td><input name="is_active" type="checkbox" <?=($attack['is_active']==0?'':'checked="checked"')?> /></td>
</tr>
<tr>
  <td>�������� �����: &nbsp;  </td>
  <td><input name="name" type="text" class="cms_fieldstyle1" value="<?=$attack['name']?>" size="30" maxlength="255" /><input name="display_name" id="display_name" type="checkbox" <?=($attack['display_name']==0?'':'checked="checked"')?> /><label for="display_name">���������� ��������</label></td>
</tr>
<tr>
  <td>���: &nbsp;  </td>
  <td><?=createSelectFromArray('type', $attack_type_array, $attack['type'], 'id="type" onchange="switchType(this.options[this.selectedIndex].value);"')?></td>
</tr>
<tr>
  <td>��� ��������: &nbsp;  </td>
  <td><?=createSelectFromArray('action_type', array(), $attack['action_type'], 'id="action_type" onchange="switchActionType(this.options[this.selectedIndex].value);"')?></td>
</tr>
<tr>
  <td>Pos type: &nbsp;  </td>
  <td><input name="pos_type" id="pos_type" type="text" class="cms_fieldstyle1" value="<?=$attack['pos_type']?>" size="30" maxlength="255" onkeydown="allow_pos_type = false;" /></td>
</tr>
</table>
<br />
<b>��� ����:</b><br />

<?
$jsact = '';
for($at=1; $at<=sizeof($fields); $at++)
{
    echo '<div id="fields_'.$at.'" style="display: '.($attack['action_type']==$at?'block':'none').';"><table border="0" cellpadding="0" cellspacing="1">';
    for($i=0; $i<sizeof($fields[$at]); $i++)
    if (is_array($fields[$at][$i]))
    {
        if (isset($fields[$at][$i][4]) && $fields[$at][$i][4] === false)
            $visible = false;
        else
            $visible = true;
            
        if (isset($fields[$at][$i][3]) && is_array($fields[$at][$i][3]))
        {
            foreach($fields[$at][$i][3] as $num => $arr)
            {
                $t = '';
                foreach($arr as $n)
                {
                    if ($fields[$at][$i][1] == 'b')
                        $t .= 'el(\'felm_'.$at.'_'.$n.'\').style.display = ((this.checked?1:0) == '.$num.')?\'\':\'none\';';
                    elseif ($fields[$at][$i][1] == 's' || $fields[$at][$i][1] == 'so')
                        $t .= 'el(\'felm_'.$at.'_'.$n.'\').style.display = (this.options[this.selectedIndex].value == '.$num.')?\'\':\'none\';';
                }
                    
                if ($fields[$at][$i][1] == 'b')
                {
                    $action = 'onclick="'.$t.'"';
                    $jsact .= 'el(\'field_'.$at.'_'.$i.'\').onclick();'."\n";
                }
                if ($fields[$at][$i][1] == 's' || $fields[$at][$i][1] == 'so')
                {
                    $action = 'onchange="'.$t.'"';
                    $jsact .= 'el(\'field_'.$at.'_'.$i.'\').onchange();'."\n";
                }
                    
            }
        }
        else
            $action = '';
            
        echo '<tr style="display: '.($visible?'':'none').'" id="felm_'.$at.'_'.$i.'"><td>'.$fields[$at][$i][0].': &nbsp;  </td><td>';
        switch($fields[$at][$i][1])
        {
                
            case 'b':
                echo '<input type="checkbox" name="field['.$at.']['.$i.']" id="field_'.$at.'_'.$i.'" '.($attack['action_type']==$at && isset($aparams[$i]) && $aparams[$i]==1?'checked="checked"':'').' value="1" style="" '.$action.' />';
            break;
            case 'i':
            case 'f':
            case 't':
                echo '<input type="text" name="field['.$at.']['.$i.']" id="field_'.$at.'_'.$i.'" value="'.($attack['action_type']==$at && isset($aparams[$i])?$aparams[$i]:'').'" '.$action.' />';
            break;
            case 's':
                echo '<select name="field['.$at.']['.$i.']" id="field_'.$at.'_'.$i.'" '.$action.'>';
                foreach($fields[$at][$i][2] as $k=>$v)
                    echo '<option value="'.$k.'" '.($attack['action_type']==$at && isset($aparams[$i]) && $aparams[$i]==$k?'selected':'').'>'.$v.'</option>';
                echo '</select>';
            break;
            case 'so':
                $nact = 'el(\'otherfiled_'.$at.'_'.$i.'\').style.display = (this.selectedIndex == this.options.length-1?\'\':\'none\');';
                if ($action != '')
                    $action = substr($action, 0, -1).' '.$nact.'"';
                else
                    $action = 'onchange="'.$nact.'"';
                echo '<select name="field['.$at.']['.$i.']" id="field_'.$at.'_'.$i.'" '.$action.'>';
                foreach($fields[$at][$i][2] as $k=>$v)
                    echo '<option value="'.$k.'" '.($attack['action_type']==$at && isset($aparams[$i]) && $aparams[$i]==$k?'selected':'').'>'.$v.'</option>';
                
                echo '<option value="other" '.($attack['action_type']==$at && !isset($fields[$at][$i][2][$aparams[$i]]) ?'selected':'').'>������...</option>';
                
                echo '</select>';
                echo '<input type="text" name="otherfiled_'.$at.'_'.$i.'" id="otherfiled_'.$at.'_'.$i.'" value="'.(isset($aparams[$i])?$aparams[$i]:'').'" style="display: none;" />';
            break;
        }
        echo '</td></tr>';
    }
    
    echo '</table></div>';
}

?>

<script language="javascript">
allow_pos_type = false;
switchType('<?=$attack['type']?>');
at = el('action_type');
for(i=0; i<at.options.length; i++)
    if (at.options[i].value == '<?=$attack['action_type']?>') 
        at.selectedIndex = i;

switchActionType('<?=$attack['action_type']?>');
allow_pos_type = true;
<?= $jsact ?>
</script>
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="���������" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='attack_list.php'; return false;" class="cms_button1" value="������" />
<p><span class="cms_star">*</span> - ������������ ���� </p>
</form>
<? require('kernel/after.php'); ?>