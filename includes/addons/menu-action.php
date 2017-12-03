<HEAD><LINK href=../css/game.css rel=STYLESHEET type=text/css><LINK href=../css/stl.css rel=STYLESHEET type=text/css><LINK href=../css/stl.css rel=STYLESHEET type=text/css><meta content="text/html; charset=windows-1251" http-equiv=Content-type><META Http-Equiv=Cache-Control Content=no-cache><meta http-equiv=PRAGMA content=NO-CACHE><META Http-Equiv=Expires Content=0></HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699>
<SCRIPT src="./js/stooltip.js?v11"></SCRIPT>
</style>
  <div class="TopBar">
		<div class="TopBar_left">
			<div class="LEM fontSize_11px bold color_111">
				<span class="MyName">

				</span>
				<div class="color_fff">
				</div>
			</div>
		</div>
		<div class="TopBar_right">
<a href="main.php?get=2&amp;go=1&amp;vcode=52569c045dc348f12dfc4c85000ad832" class="MovementMenu mainTooltip" onmouseover="tooltip(this,'<b>Перемещение</b>');" onmouseout="hide_info(this);"></a>
			<div class="hours" style="float: right;margin-top:1px;margin-right: 121px;"><img src="http://img.legendbattles.ru/razdor/emerald.png" width="14" height="14" title="+1 Изумруд"></div>
			<div class="lines" style="float: right;">
				<div class="dlr" style="margin-top: 8px;margin-right: 3px;">
					<div class="line" id="dlrline" style="width:<?=(3600-($player['onlineBouns']-time()))/36?>%"></div>
					<div class="cnt" id="dlrcnt">Еще <?=((($player['onlineBouns']-time())>=3600)?"60:00":date("i:s",($player['onlineBouns']-time())))?></div>
					<div class="hrs" id="hrs"><? for ($i=1;$i<=10;$i++) {?>
					<div class="hr<?=(($i<=$player['onlineHour'])?' active':'')?>"></div>
<?}?></div>
				</div>
			</div>
						<script>
				var bouns = <?=$player['onlineBouns']?>;
				setInterval(function() {
					var tt = bouns*1000-(new Date()),
					time = new Date(tt),
					seconds = time.getSeconds(),
					minutes = time.getMinutes();
					if (seconds<10) seconds = '0'+seconds;
					if (seconds || minutes) {
						document.getElementById("dlrcnt").innerHTML = 'Еще '+minutes+':'+seconds;
						document.getElementById("dlrline").style.width = Math.floor((3600-tt/1000)/36)+"%";
					}
				}, 1000);
			</script>
		</div>
			<div class="TopBar_center">
			<ul class="MainMenu">
				<li class="CharacterMenu">
					<a href="<?=(($player['battle']!=0)?'#':'main.php?get=0&vcode='.scode())?>" id="CharacterMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Персонаж</b>\');" onmouseout="hide_info(this);"></a>
				</li>
				<li class="InventoryMenu">
					<a href="<?=(($_SESSION['user']['pos']==1 or $player['battle']!=0)?'#':'main.php?get=1&vcode='.scode().(($_SESSION['user']['pos'] == 0 and $player['NewGameSteps'] == 0)?'&new-steps=2':''))?>" id="InventoryMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Инвентарь</b>\');" onmouseout="hide_info(this);"></a>
				</li>
				<li class="FightingMenu">
					<a href="#" id="FightingMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Поединки</b>\');" onmouseout="hide_info(this);"></a>
				</li>
				<li class="ClanMenu">
					<a <?if($player['clan_id']!='none'){?> href="core2.php?useaction=clan-action" <?}?> id="ClanMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b> Клан</b>\');" onmouseout="hide_info(this);" ></a>
				</li>
				<li class="InfoMenu">
					<a href="javascript:QActive('<?=scode()?>');" id="InfoMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b> Квесты</b>\');" onmouseout="hide_info(this);"></a>
				</li>
			</ul>
		</div>
		</div>
	</div><br>
<?=save_hp()?>
<table width=90% cellpadding=10 cellspacing=0 align=center>
  <tr>
    <td><table cellpadding=0 cellspacing=2 border=0 width=100% align=center>
      <tr>
        <td bgcolor=#cccccc><table cellpadding=0 cellspacing=1 width=100% border=0>
          <tr>
            <td bgcolor=<?php echo (($_GET['addid'] == '1')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=1><font class=nickname><b>Шахматы</b></font></a></div></td>
			<td bgcolor=<?php echo (($_GET['addid'] == '2')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=2><font class=nickname><b>Обмен шахматами</b></font></a></div></td>
			<td bgcolor=<?php echo (($_GET['addid'] == '3')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=3><font class=nickname><b>Ларцы</b></font></a></div></td>
				</td>
	</tr>
<tr>
		    <td bgcolor=<?php echo (($_GET['addid'] == '4')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=4><font class=nickname><b>Кладоискатели</b></font></a></div></td>
			<td bgcolor=<?php echo (($_GET['addid'] == '5')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=5><font class=nickname><b>Руны</b></font></a></div></td>
			<td bgcolor=<?php echo (($_GET['addid'] == '7')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=7><font class=nickname><b>Взлом Сундуков</b></font></a></div></td> 
				</td>
	</tr>
<tr>			
            <td bgcolor=<?php echo (($_GET['addid'] == '8')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=8><font class=nickname><b>Покраска яиц</b></font></a></div></td>
            <td bgcolor=<?php echo (($_GET['addid'] == '9')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=9><font class=nickname><b>Магические скрижали</b></font></a></div></td>
            <td bgcolor=<?php echo (($_GET['addid'] == '10')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=10><font class=nickname><b>Сундуки репутации</b></font></a></div></td>	
							</td>
	</tr>
<tr>
           <td bgcolor=<?php echo (($_GET['addid'] == '11')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=11><font class=nickname><b>9 Мая</b></font></a></div></td>
		   <td bgcolor=<?php echo (($_GET['addid'] == '15')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=15><font class=nickname><b>Хаос</b></font></a></div></td></tr>
		   							</td>
	</tr>
<tr>
		   <td bgcolor=<?php echo (($_GET['addid'] == '17')?'#FFFFFF':'#F0F0F0'); ?> width=33%><div align=center><a href=?useaction=menu-action&addid=17><font class=nickname><b>Новый Год</b></font></a></div></td></tr>
        </table></td>
      </tr>
      <tr>
        <td><table width=100% cellpadding=1 cellspacing=0>
          <tr>
            <td bgcolor=#CCCCCC><table width=100% cellpadding=10 cellspacing=0>
              <tr>
                <td bgcolor=#FFFFFF><?php
if(empty($_GET['addid'])){
//
}elseif($_GET['addid'] == '1'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft.php"); 
}elseif($_GET['addid'] == '2'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft2.php");
}elseif($_GET['addid'] == '3'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft3.php");
}elseif($_GET['addid'] == '4'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft4.php");
}elseif($_GET['addid'] == '5'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft5.php");
}elseif($_GET['addid'] == '7'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft7.php");
}elseif($_GET['addid'] == '6'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft6.php");
}elseif($_GET['addid'] == '8'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft8.php");
}elseif($_GET['addid'] == '9'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft9.php");
}elseif($_GET['addid'] == '10'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft10.php");
}elseif($_GET['addid'] == '11'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft11.php");
}elseif($_GET['addid'] == '15'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft15.php");
}elseif($_GET['addid'] == '17'){
include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/pers/craft17.php");
}
?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>