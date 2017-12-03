<div class="money">
    <div class="lr" onClick="transferform('0','0','Игровую валюту','<?= scode() ?>','0','0','0','0')">
		<?=lr($player['nv'])?>
	</div>
	<div class="dlr">
        <?= $player['baks'] ?> <img src="<?= IMG; ?>/razdor/emerald.png" width=14 title="Изумруд" height=14>
        <?= $player['izym'] ?> <img src="<?= IMG; ?>/razdor/emerald2.png" width=14 title="Компенсация" height=14>
	</div>
</div>