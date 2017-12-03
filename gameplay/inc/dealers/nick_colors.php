		<script>
			changeForm = function(select,val){
				select.style.background = '#'+val;
				document.getElementById('loginfont').style.color = '#'+val;
			}
			
			checkMoney = function(val,baks){
				switch(val){
					case '1': document.getElementById('buttons_color').innerHTML = '<font class=proce>Выберите тип получения цвета.</font>'; break;
					case '2': 
						if(baks>=9){
							document.getElementById('buttons_color').innerHTML = '<input type=submit class=lbut value="Арендовать на 30 дней [ 9 Изумруд ]">';
						}else{
							document.getElementById('buttons_color').innerHTML = '<input type=button class=lbut value="недостаточно средств" DISABLED>';
						}
					break;
					case '3': 
						if(baks>=99){
							document.getElementById('buttons_color').innerHTML = '<input type=submit class=lbut value="Купить навсегда [ 99 Изумруд ]">'; 
						}else{
							document.getElementById('buttons_color').innerHTML = '<input type=button class=lbut value="недостаточно средств" DISABLED>';
						}						
					break;
				}
			}
		</script>
<?
		echo '
		<font class=proce><font color=#222222>
		<FIELDSET style="background: white;" name="field_dealers" id="field_dealers">
		<LEGEND align=center style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"><b> <font color=gray>У Вас с собой '.$player['baks'].' Изумруд</font> </b></LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<form method=post name=colorform id=colorform action="?d_swi=10">
					<input type=hidden name=colorchange value=1>
					<font  class=nickname2 style="color:#666699"><b>Выберите цвет ника:	
						<select class="LogintextBox" name="font_nick" style="background:none" onChange="changeForm(this,this.value);">'.color_opt('000000',1).'</select></b>
					</font>				
				';
				echo'
					<select name="buytype" class="LogintextBox" onChange="checkMoney(this.value,'.$player['baks'].');">
						<option value=1 selected=selected>Выберите тип</option>
						<option value=2>Аренда</option>
						<option value=3>Покупка</option>
					</select>';
					echo'
						<br><font  class=nickname2 style="color:#666699"><b>Просмотр:</font> <font name=loginfont id=loginfont class=nickname><b>'.$player['login'].'</b></font><br>
						<div id=buttons_color>
							<font class=proce>Выберите тип получения цвета.</font>
						</div>
					';						
				echo'
				</form>
			</td></tr>
		</table>
		</FIELDSET>
		';
?>
