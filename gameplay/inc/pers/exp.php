<?php
$exp=explode("|",$player['exp']);
$expn=exp_level($player[level]);
$wins=explode("|",$player['wins']);
if (!$player['reput3']) $player['reput3'] = 0;
?>
<div class="module exp">
	<div class="header">
		���� � ���������
	</div>
	<div class="content">
		<div>
			���� : <span class="cnt"><?=$x=array_sum($exp)?></span>
		</div>
		<div>
			������ : <span class="cnt"><?=$exp[0]?></span>
		</div>
		<div>
			������ : <span class="cnt"><?=$exp[1]?></span>
		</div>
		<div>
			�������� : <span class="cnt"><?=$exp[2]?></span>
		</div>
		<div>
			�� ������ : <span class="cnt"><?=$expn[exp]-$x?></span>
		</div>
		<div>
			������ : <span class="cnt"><?php echo mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quest_tasks` WHERE `task_complete`='1' AND `playerid`='".$player['id']."'")); ?></span>
		</div>
		<div>
			����� ��� �������� : <span class="cnt"><?=$wins[0]?></span>
		</div>
		<div>
			��������� �� ������� : <span class="cnt"><?=$wins[1]?></span>
		</div>
		<div>
			����� ��� ������ : <span class="cnt"><?=$wins[2]?></span>
		</div>
		<div>
			��������� �� ����� : <span class="cnt"><?=$wins[3]?></span>
		</div>
		<div>
			��������� ������ : <span class="cnt"><?=$player['reput']?></span>
		</div>
		<div>
			����� � ������ : <span class="cnt"><?=$player['reput1']?></span>
		</div>
		<div>
			��������� : <span class="cnt"><?=$player['RepsPodvod']?></span>
		</div>
		<div>
			��������� ��� : <span class="cnt"><?=$player['Zlo']?></span>
		</div>
		<div>
			��������� �������� : <span class="cnt"><?=$player['reputdr']?></span>
		</div>
	</div>
</div>