<? 
require('kernel/before.php'); 

$init_files_folder = dirname(__FILE__).'/../map';
$day_map_folder = dirname(__FILE__).'/../map/day';
$night_map_folder = dirname(__FILE__).'/../map/night';
$small_map_folder = dirname(__FILE__).'/../map/small';

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
?>
<h3>Загрузка и обновление</h3>
<br />
<?
$dir = dirname(__FILE__).'/map';

$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M');

$start_x = 802;
$start_y = 935;

if (isset($_POST['action']) && $_POST['action'] == 'upload')
{
    $folder = strtoupper($_POST['number']);
    if (is_numeric($folder))
    {
        $folder = (int)$folder;
        if ($folder < 10)
            $sfolder = '00'.$folder;
        elseif ($folder < 100)
            $sfolder = '0'.$folder;
        else
            $sfolder = $folder;
    }
    else
        $sfolder = $folder;
        
    $ffolder = $init_files_folder.'/'.$sfolder;

    if (!is_dir($ffolder))
        mkdir($ffolder, 0753, true);
        
    if (is_dir($ffolder))
    {
        if (is_uploaded_file($_FILES['day_file']['tmp_name']))
        {
            if (move_uploaded_file($_FILES['day_file']['tmp_name'], $ffolder.'/Map_'.$folder.'d.jpg'))
                echo 'Day file has been uploaded successfuly<br />';
            else
                echo 'Error while uploadign day file<br />';
        }
        
        if (is_uploaded_file($_FILES['night_file']['tmp_name']))
        {
            if (move_uploaded_file($_FILES['night_file']['tmp_name'], $ffolder.'/Map_'.$folder.'n.jpg'))
                echo 'Night file has been uploaded successfuly<br />';
            else
                echo 'Error while uploadign night file<br />';
        }
    }
    
}


if (isset($_POST['action']) && $_POST['action'] == 'generate')
{
    
    set_time_limit(3*60*60);
    
    if (isset($_POST['time']) && $_POST['time'] == 'day')
        $daynight = array('d');
    elseif (isset($_POST['time']) && $_POST['time'] == 'night')
        $daynight = array('n'); 
    else
        $daynight = array('d', 'n'); 
        
    foreach($daynight as $dn)
    {
        
        if ($dn == 'd')
            $dnf = 'day'; 
        else
            $dnf = 'night';

        for ($y=0; $y<=12; $y++)
        for ($x=1; $x<=11; $x++)
        {
            
            $folder = $y*10 + $x;
            if ($x == 11)
                $folder = $sfolder = $letters[$y];
            elseif ($folder < 10)
                $sfolder = '00'.$folder;
            elseif ($folder < 100) 
                $sfolder = '0'.$folder;
            else
                $sfolder = $folder;
                
            if (isset($_POST['folder'][$sfolder]) && is_dir($init_files_folder.'/'.$sfolder) && file_exists($init_files_folder.'/'.$sfolder.'/Map_'.$folder.$dn.'.jpg'))
            {
                $img = imagecreatefromjpeg($init_files_folder.'/'.$sfolder.'/Map_'.$folder.$dn.'.jpg');
                
                for ($xi=0; $xi<30; $xi++)
                for ($yi=0; $yi<19; $yi++)
                {
                    $timg = imagecreatetruecolor(100, 100);
                    imagecopy($timg, $img, 0, 0, ($xi*100), ($yi*100), 100, 100);
                    
                    $newx = $start_x + ($x-1)*30 + $xi;
                    $newy = $start_y + $y*19 + $yi;
                        
                    if ($dn == 'd')
                    {
                        if (!is_dir($day_map_folder.'/'.$newy))
                            mkdir($day_map_folder.'/'.$newy, 0753, true);
                        imagejpeg($timg, $day_map_folder.'/'.$newy.'/'.$newx.'_'.$newy.'.jpg', 87);
                    }
                    else
                    {
                        if (!is_dir($night_map_folder.'/'.$newy))
                            mkdir($night_map_folder.'/'.$newy, 0753, true);
                        imagejpeg($timg, $night_map_folder.'/'.$newy.'/'.$newx.'_'.$newy.'.jpg', 87);
                    }
                    
                    if ($dn == 'd')
                    {
                        $rimg = imagecreatetruecolor(50, 50);
                        imagecopyresized($rimg, $timg, 0, 0, 0, 0, 50, 50, 100, 100);
                        
                        if (!is_dir($small_map_folder.'/'.$newy))
                            mkdir($small_map_folder.'/'.$newy, 0753, true);
                        
                        imagejpeg($rimg, $small_map_folder.'/'.$newy.'/'.$newx.'_'.$newy.'.jpg', 50);
                        imagedestroy($rimg);
                    }
                    imagedestroy($timg);
                }
                imagedestroy($img);
            }
            
        }
    }
    
    echo '<br /><br />Done ('.$newx.', '.$newy.').<br /><br />';
    
}
?>

<form name="generate" method="post" action="">
<div id="checkbox_map">
<?
for ($y=0; $y<=12; $y++)
{
    for ($x=1; $x<=11; $x++)
    {
        
        $folder = $y*10 + $x;
        if ($x == 11)
            $folder = $sfolder = $letters[$y];
        elseif ($folder < 10)
            $sfolder = '00'.$folder;
        elseif ($folder < 100) 
            $sfolder = '0'.$folder;
        else
            $sfolder = $folder;
            
        echo '<input type="checkbox" name="folder['.$sfolder.']" id="folder_'.$sfolder.'" value="Y" /><label for="folder_'.$sfolder.'">'.$sfolder.'</label>&nbsp;';
    }
    echo '<br />';
}
?>
</div><br />
<script language="javascript">
function selectAll()
{
    var e=document.getElementById('checkbox_map').getElementsByTagName('input');
    for(var i=0;i<e.length;i++)
    {
        if (e[i].type == 'checkbox')
            e[i].checked = true;
    }
}

function unselectAll()
{
    var e=document.getElementById('checkbox_map').getElementsByTagName('input');
    for(var i=0;i<e.length;i++)
    {
        if (e[i].type == 'checkbox')
            e[i].checked = false;
    }
}
    
</script>
<input type="button" name="check_all" value="Select All" onclick="selectAll();" />
<input type="button" name="uncheck_all" value="Unselect All" onclick="unselectAll();" /><br />
<br />
<input type="radio" name="time" value="all" checked="checked">All<br />
<input type="radio" name="time" value="day">Day<br />
<input type="radio" name="time" value="night">Night<br /><br />

<input type="hidden" name="action" value="generate" />
<input type="submit" name="generate" value="Generate" />
</form>
<br /><br /><br />


<h3>Загрузка файлов карты</h3>
<form name="upload" method="post" action="" enctype="multipart/form-data">
День: <input type="file" name="day_file" /><br />
Ночь: <input type="file" name="night_file" /><br />
<br />
Номер файла: <input type="text" name="number" value=""><br />
<br />
<input type="hidden" name="action" value="upload" />
<input type="submit" name="upload" value="Upload" />
</form>

<? require('kernel/after.php'); ?>