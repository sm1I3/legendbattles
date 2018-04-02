<?php
$exp = explode("|", $player['exp']);
$expn = exp_level($player['level']);
$wins = explode("|", $player['wins']);
if (!$player['reput3']) $player['reput3'] = 0;
?>
<div class="module exp">
    <div class="header">
        Опыт и Репутация
    </div>
    <div class="content">
        <div>
            Опыт : <span class="cnt"><?= $x = array_sum($exp) ?></span>
        </div>
        <div>
            Боевой : <span class="cnt"><?= $exp[0] ?></span>
        </div>
        <div>
            Мирный : <span class="cnt"><?= $exp[1] ?></span>
        </div>
        <div>
            Доблесть : <span class="cnt"><?= $exp[2] ?></span>
        </div>
        <div>
            До уровня : <span class="cnt"><?= $expn['exp'] - $x ?></span>
        </div>
        <div>
            Квесты : <span
                    class="cnt"><?php echo mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `quest_tasks` WHERE `task_complete`='1' AND `playerid`='" . $player['id'] . "'")); ?></span>
        </div>
        <div>
            Побед над игроками : <span class="cnt"><?= $wins[0] ?></span>
        </div>
        <div>
            Поражений от игроков : <span class="cnt"><?= $wins[1] ?></span>
        </div>
        <div>
            Побед над ботами : <span class="cnt"><?= $wins[2] ?></span>
        </div>
        <div>
            Поражений от ботов : <span class="cnt"><?= $wins[3] ?></span>
        </div>
        <div>
            Репутация Города : <span class="cnt"><?= $player['reput'] ?></span>
        </div>
        <div>
            Борцы с Хаосом : <span class="cnt"><?= $player['reput1'] ?></span>
        </div>
        <div>
            Флаундины : <span class="cnt"><?= $player['RepsPodvod'] ?></span>
        </div>
        <div>
            Вершители Зла : <span class="cnt"><?= $player['Zlo'] ?></span>
        </div>
        <div>
            Вершители Драконов : <span class="cnt"><?= $player['reputdr'] ?></span>
        </div>
    </div>
</div>