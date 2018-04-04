<?php
require $_SERVER['DOCUMENT_ROOT'] . "/system/config.php";
if (isset($_GET["i"])) { 
 $player=$_GET["i"];
 $row=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id=".intval($player)));
  if ($row["id"]==$id) {
   echo "����������, �� ������ ������ ���!";
 } else
 {
 
 header("Content-type: image/jpeg"); 
 
 function win_uni ($in) { 
   $in = convert_cyr_string($in ,"w","i"); 
   $out = ""; 
   for ($i=0; $i < strlen($in); $i++) { 
     $char = ord($in[$i]); 
     $out .= ($char > 175)?"&#".(1040+($char-176)).";":$in[$i]; 
   } 
   return $out; 
 }
 
 
  $im = @ImageCreateFromJPEG ("userbar.jpg") ; 
  $color = imagecolorallocate($im, 255, 255, 255); 
  $color1 = imagecolorallocate($im, 0, 0, 0); 
 if ($row["level"]>9) { 
 $element1 = $row["level"]; 
  imagettftext($im, 40, 0, 29, 58, $color1, "visitor2.ttf",  $element1); 
 } else {
 $element1 = $row["level"]; 
  imagettftext($im, 40, 0, 36, 58, $color1, "visitor2.ttf",  $element1); 
 
 
 }
 
 
 $element2 = $row["login"]; 
  imagettftext($im, 13, 0, 200, 22, $color1, "SERPENTN.TTF",  $element2); 
	$wins=explode("|",$row['wins']);
 $element3 = $wins[0]; 
  imagettftext($im, 13, 0, 200, 38, $color1, "SERPENTN.TTF",  $element3); 
	$exp=explode("|",$row['exp']);
 $element4 = $exp[0]; 
  imagettftext($im, 13, 0, 200, 55, $color1, "SERPENTN.TTF",  $element4);
     if ($row["access"] == 'admin') $rase = "�����";
 if ($row["rase"]==2) $rase="��������";
  $element4 = win_uni($rase); 
  imagettftext($im, 13, 0, 325, 20, $color1, "ARIAL.TTF",  win_uni($element4)); 
   $register_time    =  $row['bdaypers'];
   $timestamp        = time()-$register_time;
   $times = date( 'H ч: i м: s с ', $timestamp );
   $days  = floor($timestamp / 86400);
   $con_time = $days." д. ".$times; 
  imagettftext($im, 13, 0, 250, 75, $color1, "ARIAL.TTF",  $con_time);
  imagejpeg($im, NULL, 100); 
  imagedestroy($im); 
  
  
  }
  
  } else {
  
  $host=GetEnv("HTTP_HOST");
Header("Location: http://$host");
  }
  