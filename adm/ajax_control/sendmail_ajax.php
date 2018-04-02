<?php
header('Content-type: text/html; charset=utf-8');
require('./../kernel/config.php');
require('./../kernel/functions.php');

if (isset($_GET['message_id']))
    $message_id = (int)$_GET['message_id'];
else
    exit(json_encode(array('status'=>'error')));


// Главный запрос
$topic_counts = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user_subscribers"));

$getPage = intval($_GET['p']);
$page = (intval($getPage)-1)*30;
$cPage = ceil($topic_counts/30);

if($page > (($topic_counts/30)*30))
	$page = ceil(($topic_counts/30)*30);

if($getPage > $cPage)
	exit(json_encode(array('status'=>'success')));

$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM module_subscribe WHERE id = ' . intval($message_id));
if ($row = mysqli_fetch_assoc($res))
	$message = $row;
mysqli_free_result($res);
$res = mysqli_query($GLOBALS['db_link'], "SELECT * FROM user_subscribers LIMIT " . (($page < 0) ? 0 : $page) . ",30");
while ($row = mysqli_fetch_assoc($res)) {
	$Headers  = "From: Legendbattles.ru<news@legendbattles.ru>\n";
    $Headers .= "Content-Type: text/html; charset=utf-8\n";
	@mail($row['email'], $message['theame'], BbToHtml(nl2br($message['message'])), $Headers);
}
mysqli_free_result($res);
if($cPage == $getPage)
	exit(json_encode(array('status'=>'success')));
else
	exit(json_encode(array('status'=>'progress','thispage'=>$getPage,'maxpage'=>$cPage)));