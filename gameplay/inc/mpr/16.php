<? 
if($player['login']=='Администрация'){
	$adm=1;$colspan=3;
	$admtable='
	<table cellpadding="5" cellspacing="1" border="0" width="100%">
	<tr><td colspan="'.$colspan.'" align="center" class="ftxt">
		<b>ГОЛОСОВАНИЕ</b>
	</td></tr>
	<tr><td colspan="'.$colspan.'" align="center" class="nickname" bgcolor="#FCFAF3">
		<font color="#AA0000"><b>Что вы хотите что бы мы сделали в первую очередь?</b></font>
	</td></tr>
	';
}else{$adm=0;$colspan=3;}
$table='
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<tr><td colspan="'.$colspan.'" align="center" class="ftxt">
	<b>ГОЛОСОВАНИЕ</b>
</td></tr>
<tr><td colspan="'.$colspan.'" align="center" class="nickname" bgcolor="#FCFAF3">
	<font color="#AA0000"><b>Какое нововведение важно сделать в первую очередь?</b></font>
</td></tr>';
$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `golos`;");
$sqlu=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `golos_users` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
if(mysqli_num_rows($sql)>0){
	if($sqlu['id']=='' and $player['level']>9){$table.='<form method="post" action="main.php?mselect=16">';}
	else if($adm==1){$table.='<form method="post" action="main.php?mselect=16">';}	
		while ($row = mysqli_fetch_assoc($sql)){
			$table.='
			<tr class=nickname bgcolor=white>
			<td align=center>'.(($sqlu['id']=='' and $player['level']>9)?'<input type="radio" name="aid" value="'.$row['id'].':'.scode().'">':(($adm==1)?'<input type="radio" name="aid" value="'.$row['id'].':'.scode().'">':'&nbsp;')).'</td>
			<td width=80%><b>'.$row['text'].'</b><br><font class=freetxt>'.$row['tinytext'].'</font></td>
			<td bgcolor="#FFFFFF" width="20%" align="center" class="nickname"><b>'.(round($row['sum']*1.5)+5).'</b></td>		
			</tr>';
			$admtable.='
			<tr class=nickname bgcolor=white align=center>		
			<td width=80%>
				<form method="post" action="main.php?mselect=16">
					<textarea cols=100 rows=2 title="Текст голосования" name="gtext">'.$row['text'].'</textarea><br>
					<textarea cols=100 rows=2 title="Текст голосования" name="gtinytext">'.$row['tinytext'].'</textarea>
					<input type=hidden name="id_golos" value='.$row['id'].'>
					<input type=hidden name="post_id" value=105>
					<input type=hidden name="vcode" value="'.scode().'">
					<br>
					<input type=submit class=lbut value="Сохранить">
				</form>
			</td></tr>';
		}
	if($adm==0 and $player['level']>9){	
		$table.='<tr bgcolor=white><td colspan="'.$colspan.'" align="center">'.(($sqlu['id']=='')?'<input type=hidden name=post_id value=102><input type=hidden name=vcode value="'.scode().'"><input type=submit class=lbut value="Добавить голос">':'<font class=freetxt>Ваш голос учтен.</font>').'</td></tr>'.(($sqlu['id']=='')?'</form>':'');
	}
	else if($adm==1){
		$table.='<tr bgcolor=white><td colspan="'.$colspan.'" align="center"><input type=hidden name=post_id value=104><input type=hidden name=vcode value="'.scode().'"><input type=submit class=lbut value="Удалить строку"></td></tr></form>';
	}
	else if($player['level']<=9){
		$table.='<tr bgcolor=white><td colspan="'.$colspan.'" align="center"><font class=freetxt>Ваш уровень не позволяет голосовать.</font></td></tr>';
	}
}
else{
	$table.='<tr bgcolor=white><td colspan="'.$colspan.'" align="center"><font class=freetxt>Нет активных голосований.</font></td></tr>';
}

if($adm==1){	
	$table.='
	<form method="post" action="main.php?mselect=16">
	<tr class=nickname>
		<td align="center" class="ftxt" colspan="'.$colspan.'"><b>АДМИНКА</b></td></tr>		
		<tr class=nickname bgcolor=white>
			<td align=center colspan="'.$colspan.'">
				<textarea cols=100 rows=3 title="Текст голосования" name="gtext">Введите сюда текст голосования</textarea>
				<textarea cols=100 rows=3 title="Текст голосования" name="gtinytext">Введите сюда текст голосования, который будет отображаться маленьким шрифтом</textarea>
				<br>
				<input type=hidden name=post_id value=103><input type=hidden name=vcode value="'.scode().'">
				<input type=submit class=lbut value="Добавить вопрос">
			</td>
		</tr>
	</form>
	'.$admtable;
}
echo'
<tr><td bgcolor=#E0D6BB>
	'.$table.'
</table></td></tr>
';
?>