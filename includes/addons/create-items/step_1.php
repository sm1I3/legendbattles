<? 
echo'
<link type="text/css" rel="stylesheet" href="../../../../css/game.css"/>
<script language=Javascript src="create_items.js"></script>
<table width=100% height=100% align=center valign=center celpadding=0 cellspacing=0 border=1>
<tr valign=top align=left>
	<td width=1>
	<select name="type" onChange="writeparams(this.value);clearparams(\'2\');">
	  <option value="" selected="selected">Выберите тип</option>
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
      <option value="w90">Поножи</option>
      <option value="w0">Эликсиры</option>
    </select>
	</td>
	<td id="params1" width=250 align=left>
	</td>
	<td id="params2" width=200>
	</td>
	<td id="params3">
	</td>
</tr>
<tr height=100%>
<td colspan=10>
</td>
</tr>
</table>
';
?>