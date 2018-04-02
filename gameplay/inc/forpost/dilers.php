<?
if (isset($_GET['weapon_category'])) {
    $_SESSION['mark'] = $_GET['weapon_category'];
}
if ($_SESSION['mark'] != '') {
    $_GET['weapon_category'] = $_SESSION['mark'];
}
?>
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
?>

<SCRIPT src="./js/hpr.js"></SCRIPT>
<SCRIPT src="./js/stooltip.js?v11"></SCRIPT>
<table cellpadding=0 cellspacing=0 border=0 align=center width=100% style="background: url('/img/image/back_top.jpg') top center repeat-x, url('/img/image/back.jpg');">
<tr><td>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10><div id=transfer></div></td></tr>
<tr><td><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><div class="block info">
	<div class="header">
		<span><?=$locname['loc'];?></span>
	</div><img src=/img/image/gameplay/hdi/hdi_city1.jpg width=760 height=255 border=0>
</td></tr>
<tr><td>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
 <tr>
 <td>
  <table cellpadding=1 cellspacing=0 border=0 align=center width=100% >
   <tr>
    <td>
	 <?
     if ($player['login'] == 'alexs' or $player['login'] == 'Администрация') {
				echo '
				<font class=proce><font color=#222222>
				<FIELDSET style="background: white;">
				<table cellpadding=0 cellspacing=0 border=0 width=100% >
					<tr><td>
						<b><a href="?d_swi=999"><font class=nickname2 style="color:#993388">Просмотр исполненных заявок игроков</font></a></b><br>
						<b><a href="?d_swi=998"><font class=nickname2 style="color:#993388">Просмотр заявок игроков</font></a></b><br>
						<b><a href="?d_swi=904" class=nickname2><font  color=#993388>Вклады</font></a><br>
						<b><a href="?d_swi=1000" class=nickname2><font  color=#993388>Работа с образами</font></a><br>
						<b><a href="?d_swi=905" class=nickname2><font  color=#993388>Арендованные вещи</font></a>
					</td></tr>
				</table>
				</FIELDSET>
				';
				}
	 ?>
	 	
<? if($_SESSION['user']['pos']==1){include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/forpost/dealers.php");}
else{include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/d_swi.php");}
?>

    </td>
   </tr>
  </table>
 </td>
 </tr>
</table>

<?
echo '
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>
';
?>
