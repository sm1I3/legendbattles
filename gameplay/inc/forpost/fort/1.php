<div style="text-align:center;font-weight:bold;">Порталов доступно: <?php echo $Fort['teleport']; ?></div>
<div style="font-weight:bold;">Возможные направления телепортации:</div>
<form method="post">
<input type="radio" name="target" value="1" class="check">Остров Камини - Портал (цена: 10 LR.)<br>
<input type="radio" name="target" value="2" class="check">Атиния - Портал (цена: 10 LR)<br>
<input type="radio" name="target" value="3" class="check">Атиния - Подземелья Арвакон (цена: 100 LR)<br>
<input type="radio" name="target" value="4" class="check">Атиния - Храм Мудрейших (цена: 100 LR)<br>
<input type="hidden" name="cat" value="1">
<input type="submit" name="process" value="Телепортироваться" class="lbut">
</form>
