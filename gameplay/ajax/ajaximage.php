<?php
#GLOBALS OFF
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
}
$pers = GetUser($_SESSION['user']['login']);

if($pers['clan_id'] != 'Life'){
    exit('У вас не доступа.');
}

$GetPers = GetUserFID($_POST['userid'],true); 

$valid_formats = array("gif","jpg","jpeg");

$ErrorScript = 0;

$msg = '';
header("Content-type: text/html; charset=windows-1251");
if(!empty($_FILES)){
	$resi = getimagesize($_FILES['photoimg']['tmp_name']);
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
	$checkext = explode(".", $name);
	if($checkext[2]){
		$ErrorScript = 1;
		echo"Ошибка формата файла!";
		exit;
	}
	
	if($ErrorScript == 0){
		list($txt, $ext) = explode(".", $name);
	}
	
	if(!strlen($name)){
		echo"Пожалуйста выбирите изображение!<br />";
		exit;
		$ErrorScript = 1;
	}
		
	if(!in_array($ext,$valid_formats) and $ErrorScript == 0){
		echo"Формат не подходит.";
		exit;
		$ErrorScript = 1;
	}
	
	if($size>(1024*1024) and $ErrorScript == 0){
		echo "Размер файла больше одного мб.<br />";
		exit;
		$ErrorScript = 1;
	}
	
	if(($resi[0] != 115 or $resi[1] != 255) and $ErrorScript == 0) {
		echo"Размер картинки должен быть (115x255)<br />";
		exit;
		$ErrorScript = 1;
	}
	if($ErrorScript == 0){ // Залили значить праздник ;)
		$NameHash = substr(md5(time().$GetPers['id']), 0, -24);
		$actual_image_name = $NameHash.".jpg";
		$tmp = $_FILES['photoimg']['tmp_name'];
		
		//Обрабатываем рисунок и рисуем на нем сверху
		$image = $tmp; 
		$watermark = imagecreatefromgif($_SERVER['DOCUMENT_ROOT'] . '/tmp/watermark.gif');   
		$watermark_width = imagesx($watermark);
		$watermark_height = imagesy($watermark);  
		$image_path = $image;
		switch($_FILES['photoimg']['type']){
			case'image/gif':
				$image = imagecreatefromgif($image_path);
			break;
			case'image/jpeg':
				$image = imagecreatefromjpeg($image_path);
			break;
		}
		if ($image === false) {
		    return false;
		}
		$SecSize = getimagesize($image_path);
		$dest_x = $SecSize[0] - $watermark_width - 5;
		$dest_y = $SecSize[1] - $watermark_height - 5;
		imagealphablending($image, true);
		imagealphablending($watermark, true);
		imagecopy($image,$watermark,$dest_x,$dest_y,0,0,$watermark_width,$watermark_height);
		switch($_FILES['photoimg']['type']){
			case'image/gif':
				imagegif($image,$_SERVER['DOCUMENT_ROOT'] . "/tmp/".$actual_image_name);
			break;
			case'image/jpeg':
				imagejpeg($image,$_SERVER['DOCUMENT_ROOT'] . "/tmp/".$actual_image_name);
			break;
		}
		imagedestroy($image);
		imagedestroy($watermark);  
		$msg['ok'] = "Ok Go to cURL >>>";
	}
	if(!empty($msg['ok'])){
		$data = array('image' =>'@'.$_SERVER['DOCUMENT_ROOT'] . "/tmp/".$actual_image_name.';type='.$_FILES['photoimg']['type']);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://legendbattles.ru/ajaximg/upload.php');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($ch);
		if ($response == false || curl_errno($ch) || curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200){	
		    echo"Произошла ошибка при загрузке образа, повторите попытку позже.";
		    exit;
		}
		if($response == true){
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `obraz`='".$actual_image_name."' WHERE `id`='".$GetPers['id']."'");
		}
	}
}
