<? require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
db_open(); 

$conf = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `serv_connect` WHERE `serv` LIMIT 1;"));

if(!empty($_REQUEST['pan'])){
	switch($_REQUEST['pan']){
						case 1:
	  $serv = array("0","1");
			if(!in_array($_POST['serv'],$serv)){
		$_POST['serv'] = '0';
	}
		mysqli_query($GLOBALS['db_link'],"UPDATE `serv_connect` SET  `serv`='".$_POST['serv']."' LIMIT 1;");
	break;	
	}
}
?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='/core2.php?useaction=admin-action'" value="Вернуться">
        <input type=button class=lbut onClick="location='chests2.php'" value="обновить">
	</td>
   </tr>
</table>
<LEGEND align=center><B><font color=gray>&nbsp;Админка&nbsp;</font></B></LEGEND>
<table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=0 cellspacing=2 border=0 width=100%>
<?php 
echo'<tr>
            <td><font class=freemain><b><font color=#336699>Вход в игру   </font></b>Вход в  игру сейчас </font></td>
            <td><div align=center>
              <select name=serv class=LogintextBox6>
                <option value="0"' . (($conf['serv'] == 0) ? ' selected="selected"' : '') . '>Выключено</option>
                <option value="1"' . (($conf['serv'] == 1) ? ' selected="selected"' : '') . '>Включено</option>
              </select>
            </div></td>
          </tr>'; 
					?>					
<tr><td colspan=2><input type=hidden name=vcode value=<?=scod()?>><input type=image src=http://img.LegendBattles.ru/image/save.gif width=73 height=15 border=0></td></tr></form>



