<?
echo '
 <script language=Javascript src="../../../js/create_art.js"> </script>
 </form>
 <form method=post>	
	<input type="hidden" name="post_id" value="85" />
	<input type="hidden" name="vcode" value="';
echo scod();
echo '" />
		<FIELDSET name=field_dealers id=field_dealers>
		<LEGEND align=center><B>
		<font color=gray>&nbsp;Создание персональных артефактов&nbsp;</font></B></LEGEND>
		<table cellpadding=10 cellspacing=0 border=0 width=100%>
			<tr><td class=nickname2>
			<p><b>
				Выберите тип:
					  <select name="selecttype" onChange="writeparams(this.value);getPrice();">
					  <option value="none" selected="selected">Выберите</option>
					  <option value="w4">Ножи</option>
					  <option value="w1">Мечи</option>
					  <option value="w2">Топоры</option>
					  <option value="w3">Дробящее</option>
					  <option value="w6">Алебарды и копья</option>
					  <option value="w5">Метательное</option>
					  <option value="w7">Посохи</option>
					  <option value="w20">Щиты</option>
					  <option value="w23">Шлемы</option>
					  <option value="w26">Пояса</option>
					  <option value="w18">Кольчуги</option>
					  <option value="w19">Доспехи</option>
					  <option value="w24">Перчатки</option>
					  <option value="w80">Наручи</option>
					  <option value="w21">Сапоги</option>
					  <option value="w25">Кулоны</option>
					  <option value="w22">Кольца</option>
					  <option value="w28">Наплечники</option>
					  <option value="w90">Наколенники</option>
					</select>

					Впишите название:
					<input type=text class=logintextbox id=artname name=artname value="" onkeyup="getPrice();"/>
					<div id=params>';
if ($message != '') {
    echo $message;
}
echo '
					</div>
					<br>
					<div id=dealprice>
					</div>
			</b></p>
		';
echo '</td></tr>	</table></FIELDSET>	
</form>
<BR>
';
?>
