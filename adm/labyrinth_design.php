<?php
require('kernel/before.php');
$img_folder = 'images/labyrinth/';

if (!userHasPermission(4)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['lab_id']) && is_numeric($_GET['lab_id']))
    $lab_id = (int)$_GET['lab_id'];
else
    $lab_id = '';


// list of all weapon categories
$weapon_categories_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_categories');
while ($row = mysqli_fetch_assoc($res))
    $weapon_categories_array[$row['category_code']] = $row['category_name'];
mysqli_free_result($res);

function encodeChestJson($array)
{
    $tarr = array(
        'money_type' => (isset($array['MONEY'][0]) ? $array['MONEY'][0] : ''),
        'money_value' => (isset($array['MONEY'][1]) ? $array['MONEY'][1] : ''),
        'exp_type' => (isset($array['EXP'][0]) ? $array['EXP'][0] : ''),
        'exp_value' => (isset($array['EXP'][1]) ? $array['EXP'][1] : ''),
        'win' => (isset($array['WIN']) ? $array['WIN'] : '0'),
    );
    $i = 0;
    if (isset($array['WEA']) && is_array($array['WEA']) && sizeof($array['WEA']) > 0)
        foreach ($array['WEA'] as $id => $wea) {
            $i++;
            $tarr['wea' . $i] = $wea[0];
            $tarr['wea' . $i . 'time'] = $wea[1];
            $tarr['_____namewea' . $i] = $array['WEA_NAMES'][$id];
        }

    $str = '';
    if (is_array($tarr))
        foreach ($tarr as $k => $v) {
            $str .= $k . ':' . $v . '|';
        }

    if (strlen($str) > 0)
        $str = substr($str, 0, -1);

    return ($str);
}

if (isset($_POST['val'])) {
    $lab_array = array();
    $lab_params = array();
    $lab_objects = array();

    foreach ($_POST['val'] as $x => $arr) {
        foreach ($arr as $y => $val) {
            $lab_array[$x][$y] = $val;
            if ($val == 3)
                $lab_params[$x][$y] = array($_POST['param1'][$x][$y], $_POST['param2'][$x][$y]);
            elseif ($val == 4 || $val == 5)
                $lab_params[$x][$y] = array($_POST['param1'][$x][$y]);
            elseif ($val == 8)
                $lab_params[$x][$y] = array($_POST['param1'][$x][$y], $_POST['param2'][$x][$y], $_POST['param3'][$x][$y]);
            elseif ($val == 7) {
                $json = $_POST['param5'][$x][$y];

                // de
                //$out = json_decode($json, true);
                $tarr = explode('|', $json);
                $out = array();
                foreach ($tarr as $ar) {
                    $t = explode(':', $ar);
                    if (isset($t[0]) && $t[0] != '')
                        $out[$t[0]] = $t[1];
                }

                $arr = array();
                if ($out['money_value'] != '' && is_numeric($out['money_value']))
                    $arr['MONEY'] = array($out['money_type'], $out['money_value']);
                if ($out['exp_value'] != '' && is_numeric($out['exp_value']))
                    $arr['EXP'] = array($out['exp_type'], $out['exp_value']);

                $arr['WIN'] = ($out['win'] == '1') ? 1 : 0;

                for ($i = 1; $i <= 5; $i++) {
                    if (isset($out['wea' . $i]) && $out['wea' . $i] != '') {
                        $arr['WEA'][] = array($out['wea' . $i], $out['wea' . $i . 'time']);
                        $arr['WEA_NAMES'][] = $out['_____namewea' . $i];
                    }
                }

                $lab_params[$x][$y] = $arr;
            }

            if ($_POST['object'][$x][$y] != '')
                $lab_objects[$x][$y] = array($_POST['object'][$x][$y], 0);
        }
    }

    $start_array = array($_POST['start_x'], $_POST['start_y'], $_POST['start_dir']);

    $tmp_arr = array(
        0 => $lab_array,
        1 => $start_array,
        2 => $lab_params,
        3 => $lab_objects,
    );


    $serialized = serialize($tmp_arr);

    if ($lab_id != '') {

        $query = '
        update 
            labyrinth_list 
        set 
            labyrinth_serialized = \'' . mysqli_escape_string($GLOBALS['db_link'], $serialized) . '\'
        where 
            labyrinth_id = ' . (int)$lab_id . '
            ' . (!userHasPermission(8) ? ' and is_confirmed = \'N\'' : '') . ' 
        ';

    }

    mysqli_query($GLOBALS['db_link'], $query);

    header('Location: labyrinth_list.php');
}
$lab_arr = null;
if ($lab_id != '') {

    $res = mysqli_query($GLOBALS['db_link'], 'select * from labyrinth_list where labyrinth_id = ' . (int)$lab_id);
    $row = mysqli_fetch_assoc($res);

    $is_confirmed = $row['is_confirmed'];
    $tarr = unserialize($row['labyrinth_serialized']);

    $lab_arr = $tarr[0];

    $lab_height = sizeof($lab_arr);
    $lab_width = sizeof($lab_arr[0]);

    $start_x = $tarr[1][1];
    $start_y = $tarr[1][0];
    $start_dir = $tarr[1][2];

    $lab_params = $tarr[2];

    $lab_objects = $tarr[3];
} else {
    header('Location: labyrinth_list.php');
}

$labyrinth = array();

$lab_table_html = '';
for ($i = 0; $i < $lab_height; $i++) {
    $lab_table_html .= '<tr>';
    for ($j = 0; $j < $lab_width; $j++) {

        // if cell is a chest then need to encode json from array
        if ($lab_arr[$i][$j] == 7) {
            $lab_params[$i][$j][4] = encodeChestJson($lab_params[$i][$j]);
            //dump($lab_params[$i][$j][4]);
        }


        $lab_table_html .= '
        <td style="border-left: 1px solid black; border-top: 1px solid black;">
            <div onclick="labClick(' . $i . ', ' . $j . '); return false;" oncontextmenu="labRightClick(' . $i . ', ' . $j . ', event); return false;" id="div_' . $i . '_' . $j . '" style="width: 38px; height: 38px;">
                <img id="img_' . $i . '_' . $j . '" src="' . $img_folder . 'spacer.gif" width="38" height="38">
                <input type="hidden" name="val[' . $i . '][' . $j . ']" id="val_' . $i . '_' . $j . '" value="' . $lab_arr[$i][$j] . '" />
                <input type="hidden" name="param1[' . $i . '][' . $j . ']" id="param1_' . $i . '_' . $j . '" value="' . (isset($lab_params[$i][$j][0]) ? $lab_params[$i][$j][0] : '') . '" />
                <input type="hidden" name="param2[' . $i . '][' . $j . ']" id="param2_' . $i . '_' . $j . '" value="' . (isset($lab_params[$i][$j][1]) ? $lab_params[$i][$j][1] : '') . '" />
                <input type="hidden" name="param3[' . $i . '][' . $j . ']" id="param3_' . $i . '_' . $j . '" value="' . (isset($lab_params[$i][$j][2]) ? $lab_params[$i][$j][2] : '') . '" />
                <input type="hidden" name="param4[' . $i . '][' . $j . ']" id="param4_' . $i . '_' . $j . '" value="' . (isset($lab_params[$i][$j][3]) ? $lab_params[$i][$j][3] : '') . '" />
                <input type="hidden" name="param5[' . $i . '][' . $j . ']" id="param5_' . $i . '_' . $j . '" value="' . (isset($lab_params[$i][$j][4]) ? _htext($lab_params[$i][$j][4]) : '') . '" />
                <input type="hidden" name="object[' . $i . '][' . $j . ']" id="object_' . $i . '_' . $j . '" value="' . (isset($lab_objects[$i][$j][0]) ? $lab_objects[$i][$j][0] : '') . '" />
            </div>
        </td>';

    }
    $lab_table_html .= '</tr>';
}

?>
    <script language="javascript" src="jscript/json.js" charset="utf-8"></script>
    <link rel="stylesheet" href="files/modalwindow.css" type="text/css"/>
    <script src="jscript/ajax.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/modal_window.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/controls/weapon_control.js" language="javascript" charset="utf-8"></script>
    <script language="javascript" src="jscript/labyrinth_v01.js" charset="utf-8"></script>
    <script language="javascript">
        var lab_width = <?=$lab_width?>;
        var lab_height = <?=$lab_height?>;
        var start_x = <?=(int)$start_x?>;
        var start_y = <?=(int)$start_y?>;
        var start_dir = <?=(int)$start_dir?>;
        <?=createJsArray('weapon_categories', $weapon_categories_array)?>
    </script>

    <h3>Редактирование лабиринта</h3>
    <form name="edit_labyrinth" action="" method="POST">
        <input type="hidden" name="start_x" value="<?= (int)$start_y ?>" id="start_x"/>
        <input type="hidden" name="start_y" value="<?= (int)$start_x ?>" id="start_y"/>
        <input type="hidden" name="start_dir" value="<?= (int)$start_dir ?>" id="start_dir"/>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center">
                                <div class="lab_instrument">
                                    Курсор<br/>
                                    <img id="img_instr_none" style="border: 2px solid orange; cursor: pointer;"
                                         onclick="setInstrument(-1); return false;" src="<?= $img_folder ?>spacer.gif"
                                         width="38" height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Стена<br/>
                                    <img id="img_instr_0" onclick="setInstrument(0); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>wall.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Дорога<br/>
                                    <img id="img_instr_1" onclick="setInstrument(1); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>way_rl.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Решетка<br/>
                                    <img id="img_instr_2" onclick="setInstrument(2); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>grill_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Рычаг<br/>
                                    <img id="img_instr_3" onclick="setInstrument(3); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>lever_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Золотая дверь<br/>
                                    <img id="img_instr_41" onclick="setInstrument(41); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>door_gold_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Серебр. дверь<br/>
                                    <img id="img_instr_42" onclick="setInstrument(42); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>door_silver_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Бронз. дверь<br/>
                                    <img id="img_instr_43" onclick="setInstrument(43); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>door_bronze_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Дверь стража<br/>
                                    <img id="img_instr_44" onclick="setInstrument(44); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>door_blue_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Золотой ключ<br/>
                                    <img id="img_instr_51" onclick="setInstrument(51); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>key_gold_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Сереб. ключ<br/>
                                    <img id="img_instr_52" onclick="setInstrument(52); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>key_silver_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Борнз. ключ<br/>
                                    <img id="img_instr_53" onclick="setInstrument(53); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>key_bronze_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Ключ стража<br/>
                                    <img id="img_instr_54" onclick="setInstrument(54); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>key_blue_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td rowspan="2">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div class="lab_instrument">
                                    Страж<br/>
                                    <img id="img_instr_6" onclick="setInstrument(6); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>guard_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Сундук<br/>
                                    <img id="img_instr_7" onclick="setInstrument(7); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>chest_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Портал<br/>
                                    <img id="img_instr_8" onclick="setInstrument(8); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>portal_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Лаз<br/>
                                    <img id="img_instr_9" onclick="setInstrument(9); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>laz_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Источник<br/>
                                    <img id="img_instr_10" onclick="setInstrument(10); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>water_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Выход<br/>
                                    <img id="img_instr_11" onclick="setInstrument(11); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>exit_t.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Точка старта<br/>
                                    <img id="img_instr_100" onclick="setInstrument(100); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>arrow_t.gif" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Карта 1<br/>
                                    <img id="img_obj_0" onclick="setObjectInsert(0); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>map_1.gif" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Карта 2<br/>
                                    <img id="img_obj_1" onclick="setObjectInsert(1); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>map_2.gif" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Карта 3<br/>
                                    <img id="img_obj_2" onclick="setObjectInsert(2); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>map_3.gif" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Карта 4<br/>
                                    <img id="img_obj_3" onclick="setObjectInsert(3); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>map_4.gif" width="38"
                                         height="38"/>
                                </div>
                            </td>
                            <td align="center">
                                <div class="lab_instrument">
                                    Ластик<br/>
                                    <img id="img_obj_-1" onclick="setObjectInsert(-1); return false;"
                                         style="cursor: pointer;" src="<?= $img_folder ?>eraser.jpg" width="38"
                                         height="38"/>
                                </div>
                            </td>
                        </tr>
                    </table>
                    Точка старта: <b><span
                                id="start_point_coords"><?= $start_x . ';' . $start_y . ';' . $start_dir ?></span></b>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="labyrinth_message" class="lab_message"></div>
                    <table id="labyrinth_table" border="0" cellpadding="0" cellspacing="0"
                           style="border-right: 1px solid black; border-bottom: 1px solid black; cursor: pointer;">
                        <?= $lab_table_html ?>
                    </table>
                </td>
                <td valign="top">
                    <div align="left" class="lab_properties" id="lab_properties" style="display: none;">
                        <div id="lab_properties_content">

                        </div>
                        <input type="button" name="prop_save" onclick="propSave(); return false;" value="Save"/>&nbsp;&nbsp;
                        <input type="button" name="prop_cancel" onclick="propCancel(); return false;" value="Cancel"/>
                    </div>
                </td>
            </tr>
        </table>
        <p></p><br/>
        <input name="submit" type="submit" class="cms_button1" value="Сохранить"
               style="width: 150px" <?= (!userHasPermission(8) && $is_confirmed == 'Y' ? 'disabled="disabled"' : '') ?> />
        <input name="cancel" type="submit" onclick="document.location='labyrinth_list.php'; return false;"
               class="cms_button1" value="Отмена"/><br/>
        <br/>
    </form>
    <script language="javascript">
        drawLabyrinth(-1, -1);
    </script>
    <div id="chest_properties" style="display: none;">
        <table>
            <tr>
                <td nowrap="nowrap">Тип денег: <select name="money_type">
                        <option value="0">NV</option>
                        <option value="1">$</option>
                        <option value="2">Bonus</option>
                    </select></td>
                <td nowrap="nowrap">Кол-во денег: <input type="text" name="money_value" size="5"/></td>
            </tr>
            <tr>
                <td nowrap="nowrap">Тип опыта: <select name="exp_type">
                        <option value="0">Мирный</option>
                        <option value="1">Боевой</option>
                    </select></td>
                <td nowrap="nowrap">Кол-во опыта: <input type="text" name="exp_value" size="5"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="checkbox" name="win" value="Y"/>Завершить</td>
            </tr>
            <tr>
                <td colspan="2">Оружия:</td>
            </tr>
            <tr>
                <td colspan="2" nowrap="nowrap">
                    <table>
                        <tr>
                            <td>
                                <?= createWeaponControl('wea1', 'uid', '', '') ?>
                            </td>
                            <td>
                                <input type="text" name="wea1time" size="2"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" nowrap="nowrap">
                    <table>
                        <tr>
                            <td>
                                <?= createWeaponControl('wea2', 'uid', '', '') ?>
                            </td>
                            <td>
                                <input type="text" name="wea2time" size="2"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" nowrap="nowrap">
                    <table>
                        <tr>
                            <td>
                                <?= createWeaponControl('wea3', 'uid', '', '') ?>
                            </td>
                            <td>
                                <input type="text" name="wea3time" size="2"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
<? require('kernel/after.php'); ?>