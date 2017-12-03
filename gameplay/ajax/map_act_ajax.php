<?php
#GLOBALS OFF
header('Content-type: text/html; charset=windows-1251');
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
list($pers['x'], $pers['y']) = explode('_', $pers['pos']);

if(in_array($_GET['vcode'],$_SESSION['vcodes'])){
	if($_GET['act'] == '1'){
		if($pers['ustal']>time()){$ustal=$pers['ustal']-round((($pers['ustal']-time())/100)*3);}
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `wait`='".(time()+50)."',`ustal`='".$ustal."' WHERE `id` = '".$pers['id']."'");
        echo 'MESS@["Вы выпили водички и легли отдохнуть.<br>Половину усталости как рукой сняло.","",50]';
	}
	elseif($_GET['act'] == '2'){
		if(date("H") < 7){
//			echo'MESS@["Вход воспрещён, ожидайте утра. Град охрана Баруса.",0,0]';	
            echo 'MESS@["Вход воспрещён, ожидайте утра.",0,0]';
		}
	}
}else{
	echo'ERR';
//MESS@["Соединение с сервером утеряно. Просьба выполнить повторный вход в игру с главной страницы.",0,0]
}
/*

AL@["Все прошло успешно."]@[40,[[994,999,"bd0a0235babedf9adcb787734b71edd7"],[995,998,"d028c3ac1a1909a17e26af5d13367f43"],[994,998,"75c0e9f22ad3701fdfb86505490140bc"],[994,1000,"eca4637fc5fd390002566b260017182a"],[996,998,"2b400161e43d1109e9e59a06351f8de8"]]]@[["ogl","Оглядеться","7c660f3b8a1cb381a857767175aea123",[]],["fis","Рыбалка","003d6d6332a7053a230829b942f26678",[]],["dri","Пить","5a57dafd5c8c9fe253d8c33d42c7ad58",[]]]@[0,[3,60]]@[]

AL@["Все прошло успешно."]@[[994,999,"65f5843085cbb93301c51a5e59b979f8"],[995,998,"a4ac97434dc320aaebad6e7a8d26ebd3"],[994,998,"7c08cffeb69d87407d3ad0e90e2f44d0"],[994,1000,"2b7a7c8d307b4537ce3e9f7f5c47eafb"],[996,998,"40079fde0c098b9ce35b43a900d257b5"]]@[["inf","Ваш персонаж","44a977aa4bb7d3f40f6713488d2bdeca",[]],["inv","Инвентарь","03d1c6adc137dada07fb449d26243aef",[]],["ogl","Оглядеться","b9d2d4fb69c604f18f7de059a27f1aac",[]],["fis","Рыбалка","f299982e1c0133590f7538870524c02a",[]],["dri","Пить","f95633916ecaa037f2e8776314fababf",[]]]@[40,"night",""]
*/
?>