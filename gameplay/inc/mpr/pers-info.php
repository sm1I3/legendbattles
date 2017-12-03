<div class="block pers-info">
	<div class="header">
		<span>Информация о персонаже</span>
	</div>
	<div class="content">
		<form action="main.php?mselect=pers-info" method=POST>
			<input type=hidden name=post_id value=49>
			<input type=hidden name=act value=5>
			<input type=hidden name=de value=800>
			<input type=hidden name=vcode value=<?=scode()?>>
			<div class="field">
				<label for="newname">Ваше имя: </label>
				<input type=text name=newname size=30 maxlength=50 value="<?=$player[name]?>">
			</div>
			<div class="field">
				<label for="bday">Дата рождения: </label>
				<input type="text" name="bday" disabled value="<?=$player[bday]?>">
				<div class="info">
					Большая просьба указывать реальные имя и дату рождения.<br>Эти данные Вам могут пригодится для восстановления героя.
				</div>
			</div>
			<div class="field">
				<label for="newcountry">Страна: </label>
				<input type=text name=newcountry size=30 maxlength=50 value="<?=$player[country]?>">
			</div>
			<div class="field">
				<label for="newcity">Город: </label>
				<input type=text name=newcity size=30 maxlength=50 value="<?=$player[city]?>">
				<div class="info">
					Также требуется указывать реальные данные. Они могут Вам пригодится для восстановления героя, для адаптации игры к Вашему региону, и не вызвать подозрений у представителей власти о Вашем местоположении.
				</div>
			</div>
			<div class="field">
				<label for="newaddon">Дополнительно: </label>
				<textarea cols=61 rows=10 name=newaddon><?=$player[addon]?></textarea>
				<div class="info">
					Дополнительная информация о Вас (закрытая информация). Администрация рекомендует заносить сюда информацию, которая может оправдать Вас перед представителями власти (игра с одного клуба, сестра, брат, локальная сеть и так далее). Максимальная длина сообщения - 800 символов.
				</div>
			</div>
			<div class="field">
				<label for="newabout">О себе: </label>
				<textarea cols=61 rows=10 name=newabout><?=deCodes($player[about])?></textarea>
				<div class="info">
					Информация, доступная для других участников игры. Максимальная длина сообщения - 800 символов.
				</div>
			</div>
			<div class="save">
				<input type="submit" value="Сохранить">
			</div>
		</form>
		<div class="clear"></div>
	</div>
</div>