<div style="text-align:center;font-weight:bold;">Благословений доступно: <?php echo $Fort['bless']; ?></div>
Здесь владельцы форта смогут за LR получать различные временные благословения<!--, а так же восстанавливать жизни, ману и усталость-->. Получить благословение можно не чаще одного раза в сутки для одного игрока, длительность благословения - 5 часов.
<div style="font-weight:bold;">Возможные благословения:</div>
<form method="post">
<?php
$GetBless = explode('/',$Fort['bless']);
if($GetBless[1] > 7){
    echo '<input type="radio" name="bless" value="1" class="check">Ускорение регенерации маны на 30%<br>
<input type="radio" name="bless" value="2" class="check">Ускорение регенерации жизней на 30%<br>
<input type="radio" name="bless" value="3" class="check">Ускорение поиска и добычи ресурсов на 10%<br>
<input type="radio" name="bless" value="4" class="check">Ускорение передвижения по природе на 20%<br>';
}else{
    echo '<input type="radio" name="bless" value="1" class="check">Ускорение регенерации маны на 15%<br>
<input type="radio" name="bless" value="2" class="check">Ускорение регенерации жизней на 15%<br>
<input type="radio" name="bless" value="3" class="check">Ускорение поиска и добычи ресурсов на 5%<br>
<input type="radio" name="bless" value="4" class="check">Ускорение передвижения по природе на 10%<br>';
}
?>
<input type="hidden" name="cat" value="3" />
    <input type="submit" name="process" value="Активировать" class="lbut">
</form>
