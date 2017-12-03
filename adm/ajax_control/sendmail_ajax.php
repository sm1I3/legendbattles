<?php
header('Content-type: text/html; charset=windows-1251');
require('./../kernel/config.php');
require('./../kernel/functions.php');

if (isset($_GET['message_id']))
    $message_id = (int)$_GET['message_id'];
else
    exit(json_encode(array('status'=>'error')));


// Главный запрос
$topic_counts = mysql_num_rows(mysql_query("SELECT * FROM user_subscribers"));

$getPage = intval($_GET['p']);
$page = (intval($getPage)-1)*30;
$cPage = ceil($topic_counts/30);

if($page > (($topic_counts/30)*30))
	$page = ceil(($topic_counts/30)*30);

if($getPage > $cPage)
	exit(json_encode(array('status'=>'success')));

$res = mysql_query('SELECT * FROM module_subscribe WHERE id = ' . intval($message_id));
if($row = mysql_fetch_assoc($res))
	$message = $row;
mysql_free_result($res);
$res = mysql_query("SELECT * FROM user_subscribers LIMIT " . (($page < 0) ? 0 : $page) . ",30");
while($row = mysql_fetch_assoc($res)){
	$Headers  = "From: Legendbattles.ru<news@legendbattles.ru>\n";
	$Headers .= "Content-Type: text/html; charset=windows-1251\n";
	@mail($row['email'], $message['theame'], BbToHtml(nl2br($message['message'])), $Headers);
}
mysql_free_result($res);
if($cPage == $getPage)
	exit(json_encode(array('status'=>'success')));
else
	exit(json_encode(array('status'=>'progress','thispage'=>$getPage,'maxpage'=>$cPage)));