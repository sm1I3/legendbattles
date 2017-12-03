<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
		<script>
			changeForm = function(select,val){
				select.style.background = '#'+(val!='000000'?val:'FFFFFF');
			}
		</script>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='system_messages.php'" value="обновить">
	</td>
   </tr>
</table>
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/bbcodes.inc.php");
//<select class="LogintextBox" name="newchatcolor"></select>

/*foreach($_POST as $keypost=>$valp){ //тестовые сообщения
	echo '<br>post-key:'.$keypost.' | post-val:'.$valp;
}*/
if($_POST['post_id']){
	switch($_POST['post_id']){
		 case 1:
			$mt = addslashes(str_replace(array("\r","\n"), "", $_POST['message_time_new']));
			$mm = addslashes(str_replace(array("\r","\n"), "", $_POST['message_main_new']));
			$ft = $_POST['font_time_new']?$_POST['font_time_new']:'000000';
			$fm = $_POST['font_main_new']?$_POST['font_main_new']:'000000';
			$bt = $_POST['bg_time_new']?($_POST['bg_time_new']=='000000'?'FFFFFF':$_POST['bg_time_new']):'FFFFFF';
			$bm = $_POST['bg_main_new']?($_POST['bg_main_new']=='000000'?'FFFFFF':$_POST['bg_time_new']):'FFFFFF';			
			if(!$_POST['message_id']){
				if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `system_messages` (`font_time`,`message_time`,`bg_time`,`font_main`,`message_main`,`bg_main`) VALUES ('".$ft."','".$mt."','".$bt."','".$fm."','".$mm."','".$bm."');")){
				}else{echo mysqli_error();}
			}else{
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `system_messages` SET `font_time`='".$ft."',`message_time`='".$mt."',`bg_time`='".$bt."',`font_main`='".$fm."',`message_main`='".$mm."',`bg_main`='".$bm."' WHERE `id`='".$_POST['message_id']."';")){
				}else{echo mysqli_error();}
			}
		 break;
	}
}
$messages = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `system_messages`");
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
	<tr><td>	
	<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%><b>Системные сообщения</b></td>
		</tr>';
		while($message = mysqli_fetch_assoc($messages)){
			echo'
			<tr><td>			
			<form method=post>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
			<tr>
				<td width=100%  align=center bgcolor=white >
					id: '.$message['id'].'<br>
					<b>Текст вместо времени чата:</b><br><textarea cols="75" rows="1" width=90% name="message_time_new" value="">' . $message['message_time'] . '</textarea><br>
					Цвет шрифта:<select onChange="changeForm(this,this.value);" class="LogintextBox" name="font_time_new" style="background:#' . $message['font_time'] . '">' . color_opt($message['font_time']) . '</select>
					Цвет фона:<select onChange="changeForm(this,this.value);" class="LogintextBox" name="bg_time_new" style="background:#' . $message['bg_time'] . '">' . color_opt($message['bg_time']) . '</select><br>
					<b>Текст системки:</b><br><textarea cols="175" rows="15" width=90% name="message_main_new" value="">' . $message['message_main'] . '</textarea><br>
					Цвет шрифта:<select onChange="changeForm(this,this.value);" class="LogintextBox" name="font_main_new" style="background:#' . $message['font_main'] . '">' . color_opt($message['font_main']) . '</select>
					Цвет фона:<select onChange="changeForm(this,this.value);" class="LogintextBox" name="bg_main_new" style="background:#' . $message['bg_main'] . '">' . color_opt($message['bg_main']) . '</select><br>
				</td>
			</tr>
			<tr>
				<td width=100% bgcolor=white align=left>
				Просмотр:<br>
					<font class=massm style="'.($message['font_time']?'color:#'.$message['font_time'].';':'').($message['bg_time']?'background:#'.$message['bg_time'].';':'').'">&nbsp;'.$message['message_time'].'&nbsp;</font>
					<font style="'.($message['font_main']?'color:#'.$message['font_main'].';':'').($message['bg_main']?'background:#'.$message['bg_main'].';':'').';">
					&nbsp;'.$message['message_main'].'
					</font>
				</td>
			</tr>
			<tr><td width=100% align=center bgcolor=white >
				<input type=hidden name=post_id value=1>
				<input type=hidden name=message_id value="'.$message['id'].'">
				<input class=lbut type=submit value="Сохранить">
			</td></tr>
			</table>
			</form>
			</td></tr>			
			';
		}
		echo '
		</table>
	</td></tr>';
	echo'
	<tr><td>
	<form method=post>
	<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%><b>Новое сообщение</b></td>
		</tr>';
			echo'
			<tr>
				<td width=100% align=center bgcolor=white >
					<b>Текст вместо времени чата:</b><br><textarea cols="75" rows="1" width=90% name="message_time_new" value=""></textarea><br>
					Цвет шрифта: <select onChange="changeForm(this,this.value);" class="LogintextBox" name="font_time_new">' . color_opt() . '</select>
					Цвет фона: <select onChange="changeForm(this,this.value);" class="LogintextBox" name="bg_time_new">' . color_opt() . '</select><br>
					<b>Текст системки:</b><textarea cols="175" rows="15" width=90% name="message_main_new" value=""></textarea><br>
					Цвет шрифта: <select onChange="changeForm(this,this.value);" class="LogintextBox" name="font_main_new">' . color_opt() . '</select>
					Цвет фона: <select onChange="changeForm(this,this.value);" class="LogintextBox" name="bg_main_new">' . color_opt() . '</select><br>
				</td>
			</tr>
			<tr><td width=100% align=center bgcolor=white>
				<input type=hidden name=post_id value=1>
				<input class=lbut type=submit value="Сохранить">
			</td></tr>			
			';
		echo '
		</table>
	</form></td></tr>';
		
		
		
		
?>