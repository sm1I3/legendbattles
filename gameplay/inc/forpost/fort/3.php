<div style="text-align:center;font-weight:bold;">Ѕлагословений доступно: <?php echo $Fort['bless']; ?></div>
«десь владельцы форта смогут за LR получать различные временные благословени€<!--, а так же восстанавливать жизни, ману и усталость-->. ѕолучить благословение можно не чаще одного раза в сутки дл€ одного игрока, длительность благословени€ - 5 часов.
<div style="font-weight:bold;">¬озможные благословени€:</div>
<form method="post">
<?php
$GetBless = explode('/',$Fort['bless']);
if($GetBless[1] > 7){
echo'<input type="radio" name="bless" value="1" class="check">”скорение регенерации маны на 30%<br>
<input type="radio" name="bless" value="2" class="check">”скорение регенерации жизней на 30%<br>
<input type="radio" name="bless" value="3" class="check">”скорение поиска и добычи ресурсов на 10%<br>
<input type="radio" name="bless" value="4" class="check">”скорение передвижени€ по природе на 20%<br>';
}else{
echo'<input type="radio" name="bless" value="1" class="check">”скорение регенерации маны на 15%<br>
<input type="radio" name="bless" value="2" class="check">”скорение регенерации жизней на 15%<br>
<input type="radio" name="bless" value="3" class="check">”скорение поиска и добычи ресурсов на 5%<br>
<input type="radio" name="bless" value="4" class="check">”скорение передвижени€ по природе на 10%<br>';
}
?>
<input type="hidden" name="cat" value="3" />
<input type="submit" name="process" value="јктивировать" class="lbut">
</form>
