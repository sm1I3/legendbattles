<div class="block secure">
	<div class="header">
		<span>Безопасность</span>
	</div>
	<div class="content">
		<div class="field">
			<label>Текущий E-mail:</label>
			<span style="line-height:28px"><?=$player[email]?></span>
		</div>
<?if($player[finblock]<time()){?>
		<form action="main.php?mselect=secure" method="POST">
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=1>
			<div class="field">
				<label for="newmail">Новый E-mail:</label>
				<input type=text name=newmail size=30 maxlength=50>
				<div class="info">
					После смены e-mail персонаж не может проводить операции с финансами, передавать, дарить и выкидывать предметы в течение 24 часов. Также пароль можно сменить только через 48 часов после смены e-mail.
				</div>
			</div>
		</form>
		<form action="main.php?mselect=secure" method="POST">
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=2>
			<div class="field">
				<label for="opass">Старый пароль: </label>
				<input type=password name=opass size=15 maxlength=50>
			</div>
			<div class="field">
				<label for="npass">Новый: </label>
				<input type=password name=npass size=15 maxlength=50>
				<div class="info">
					Минимальная длина пароля 4 символа.
				</div>
			</div>
			<div class="field">
				<label for="vpass">Повтор: </label>
				<input type=password name=vpass size=15 maxlength=50>
				<div class="info">
					После смены пароля персонаж не может проводить операции с финансами, передавать, дарить и выкидывать предметы в течение 24 часов. Также e-mail можно сменить только через 48 часов после смены пароля.
				</div>
			</div>
			<div class="save">
				<input type="submit" value="Сохранить">
			</div>
			<?=$msg?>
		</form>
<?if($player['flash'] == '0'){?>
		<form action="main.php?mselect=secure" method=POST>
			<input type=hidden name=vcode value="<?=scode()?>">
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=3>
			<div class="field">
				<label for="pa_long">Второй пароль</label>
				<input type=checkbox name=emailc value=1 CHECKED> Копия пароля на Ваш E-mail.<br />
				<input type=radio name=pa_long value=5 CHECKED> <b>простой уровень</b> (5 цифр) 
				<input type=radio name=pa_long value=9> <b>сложный уровень</b> (9 цифр) 
				<div class="info">
					Устанавливается цифровой пароль для ввода с помощью мыши. Восстановить пароль невозможно. <br />
					<b>ПРИ УСТАНОВКЕ ОБЯЗАТЕЛЬНО ЗАПИШИТЕ ПАРОЛЬ, КОТОРЫЙ ПОЯВИТСЯ НА ЭКРАНЕ.</b>
				</div>
			</div>
			<div class="save">
				<input type=submit value="установить">
			</div>
		</form>
<?}
} else {?>
		<div>Вы не можете менять пароль и email!</div>
<?}?>
		<div class="header">Отчет по 30 последним заходам игрока в игру.</div>
		<table width=100% class="otch">
<?  $sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM mlog WHERE typ='1' and login='".$player[login]."' ORDER BY time DESC LIMIT 0,30;");
$col=array(0=>"FCFAF3","FCFAF3");$i=0;
while ($row = mysqli_fetch_assoc($sql)) {
if($row[action]=="err: пароль")$row[action]="<font color=#FF0000><b>err: пароль</b></font>";
?>
			<tr>
				<td>
					<?=$row['time']?>
				</td>
				<td>
					<B><?=$row[action]?></B>
				</td>
				<td>
					<?=$row[ip]?>
				</td>
				<td>
					<?=$row[brouser]?>
				</td>
			</tr>
<? if($i==0){$i++;}else{$i=0;}}?>
		</table>
	</div>
</div>