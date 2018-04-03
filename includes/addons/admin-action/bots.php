<?php
if(!empty($_GET['im']) and $_SESSION['user']['pos']==1){
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td valign="top"><img src="http://img.legendbattles.ru/image/1x1.gif" width="10" height="10" /></td>
    <td valign="top" width="100%"><table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><div id="transfer2"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="1" /></div></td>
      </tr>
      <tr>
          <td><a href="/main.php"><img src="http://img.legendbattles.ru/image/gameplay/invent/0.gif" width="44"
                                       height="53" title="Вещи" class="cath" border="0"/></a><a href="#"><img
                          src="http://img.legendbattles.ru/image/gameplay/invent/6.gif" width="41" height="53"
                          title="Эликсиры" class="cath" border="0"/></a><a href="#"><img
                          src="http://img.legendbattles.ru/image/gameplay/invent/1.gif" width="41" height="53"
                          title="Алхимия" class="cath" border="0"/></a><a href="#"><img
                          src="http://img.legendbattles.ru/image/gameplay/invent/2.gif" width="41" height="53"
                          title="Рыбалка" class="cath" border="0"/></a><a href="#"><img
                          src="http://img.legendbattles.ru/image/gameplay/invent/3.gif" width="41" height="53"
                          title="Ресурсы" class="cath" border="0"/></a><img
                      src="http://img.legendbattles.ru/image/gameplay/invent/4.gif" width="41" height="53"
                      title="Руны"/><img src="http://img.legendbattles.ru/image/gameplay/invent/5.gif" width="41"
                                         height="53" title="Магия"/><a href="/main.php?im=7"><img
                          src="http://img.legendbattles.ru/image/gameplay/invent/7.gif" width="41" height="53"
                          title="Журнал заданий"/></a></td>
      </tr>
      <tr>
        <td><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="4" /></td>
      </tr>
      <tr>
        <td bgcolor="#CCCCCC" width="100%"><?php
		switch($_GET['im']){
		case'7':
        echo'<table cellpadding="5" cellspacing="1" border="0" width="100%">';
		$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quest_completed` WHERE `usr_id`='".$player['id']."' and `que_st`='0'");
		if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
         echo' <tr>
            <td bgcolor="#FFFFFF"><img src="http://img.legendbattles.ru/image/gameplay/faces/'.$row['que_face'].'" width="130" height="130" border="0" /></td>
            <td width="100%" class="nickname" bgcolor="#FFFFFF"><font class="travma">Задание:</font><br />
              <b>'.$row['que_name'].'</b><br />
              '.$row['que_desc'].' <br />';
			  if(!empty($row['que_query'])){
                  echo '<b>Ресурсы:</b> ';
					$ResMass = explode("@",$row['que_query']);
					$ResultRes = '';
					for($i=0;$i<count($ResMass);$i++){
						$Ressource = explode(";",$ResMass[$i]);
						$ResultRes .= mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT `name` FROM `items` WHERE `id`='".$Ressource[0]."'"),0).' ('.$Ressource[1].'), ';
					}
					echo substr($ResultRes,0,strlen($ResultRes)-2).'.<br />';  
			  }
            echo ' <font class="travma"><font color="#008800"><b>Время выполнения:</b> ' . date("d.m.Y H.i", $row['que_time_start']) . ' - ' . date("d.m.Y H.i", $row['que_time_finish']) . '</font></font></td>
          </tr>';
		}
		}else{
            echo '<tr><td align="center" bgcolor="#FFFFFF"><font color="#880000"><b>нет активных заданий.</b></font></td></tr>';
		}
        echo'</table>';
		break;
		}
		?></td>
      </tr>
      <tr>
        <td><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3" /></td>
      </tr>
      <tr>
        <td align="right"><script language="JavaScript" type="text/javascript">

document.write(view_t());

</script></td>
      </tr>
    </table></td>
    <td valign="top"><img src="http://img.legendbattles.ru/image/1x1.gif" width="10" height="10" /></td>
  </tr>
  <tr>
    <td colspan="5"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3" /></td>
  </tr>
</table>
<?php
}else{
?>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=10 height=10></td>
<td valign=top width=200>
<table cellpadding=0 cellspacing=0 border=0 width=200>
<tr><td colspan=6></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=200 height=10></td></tr>
<tr>
<SCRIPT language="JavaScript">
slots_<? if($_SESSION['user']['pos']==1){echo "inv";}else{echo "pla";} ?>("<?=$player['obraz']?>","<?=$_SESSION['user']['login']?>","<? slotwiev($player['id'],$_SESSION['user']['pos']);?>",115);
</SCRIPT>

<td width=5 valign=top rowspan=2><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
<td valign=top width=200 rowspan=2>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td>
<div id="liw_table">
  <div id="liw_table_top"></div>
    <div id="liw_table_title">Накопления</div>
  <div id="liw_table_content"><table cellpadding=0 cellspacing=1 border=0 width=100%>
          <tr>
              <td bgcolor=#FCFAF3><font class=nickname><img src=http://img.legendbattles.ru/image/money_all.gif width=16
                                                            height=14 border=0 title='Передать LR' align=absmiddle
                                                            <? if ($player['level'] > 4 and $player['finblock'] < time()){ ?>onClick="transferform('0','0','Игровую валюту','<?= scode() ?>','0','0','0','0')"<? } ?>
                                                            vspace=0>&nbsp;Деньги:</td>
              <td width=100% bgcolor=#fafafa nowrap><font class=nickname><b>&nbsp;<?= $player['nv'] . " LR"; ?></td>
<? if($player['dd']>0){ ?>
          <tr>
              <td bgcolor=#FCFAF3><font class=nickname><img src=http://img.legendbattles.ru/image/money_dea.gif width=16
                                                            height=14 border=0 title='Передать/Обменять DLR'
                                                            onClick="transferform('1','0','Обменять/перевести DLR','<?= scode() ?>','0','0','0','0')"
                                                            vspace=0>&nbsp;DLR:</td>
              <td width=100% bgcolor=#FAfafa nowrap><font class=nickname><b>&nbsp;<?= $player['dd'] . " DLR"; ?></td>
          </tr> <? } ?>
</tr>
<? if($player['baks']>0){ ?>
<tr><td bgcolor=#FCFAF3><font class=nickname><img src=http://img.legendbattles.ru/image/money_dea.gif width=16 height=14 border=0 title='$' vspace=0>&nbsp;<b><font color="orange">$</font></b></td><td width=100% bgcolor=#FAfafa nowrap>&nbsp;<font class=nickname><b><?=$player['baks'];?>&nbsp;$</td></tr> <? }?>
</tr>


</table></div>
  <div id="liw_table_bottom"></div>
</div>
</td></tr>

<?  include($_SERVER["DOCUMENT_ROOT"]."/inc/stats.php");
	include($_SERVER["DOCUMENT_ROOT"]."/inc/modif.php");
	include($_SERVER["DOCUMENT_ROOT"]."/inc/buffs.php");
	include($_SERVER["DOCUMENT_ROOT"]."/inc/exp.php");
	include($_SERVER["DOCUMENT_ROOT"]."/inc/wins.php");
	include($_SERVER["DOCUMENT_ROOT"]."/inc/freestats.php");
	?>



</tr></table></td></tr><tr><td colspan=5 valign=top align=center>

<? if($_SESSION['user']['pos']==1){?>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10></td></tr></table></td></tr>
<tr><td colspan=7 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td>
        <input type=button class=invbut onClick="compl_f('<?= scode() ?>')" value="Запомнить комплект">
        <input type=button class=invbut onClick="javascript: location='main.php?post_id=57&act=3&vcode=<?= scode() ?>'"
               value="Снять все вещи">
 <br>
 <img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10>
</td>
</tr>
<tr><td align=center><div id=complect><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></div></td></tr>
<tr><td width=100%>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td bgcolor=#CCCCCC>
<table cellpadding=5 cellspacing=1 border=0 width=100%>
    <tr>
        <td bgcolor=#F0F0F0 colspan=3 align=center class=freemain><B>Ваши комплекты</B></td>
    </tr>
<SCRIPT language="JavaScript">
<?
$q = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM pcompl WHERE uid=' . AP . $player['id'] . AP . '');
while ($row = mysqli_fetch_assoc($q)) {
echo "compl_view(\"$row[name]\",\"$row[id]\",\"".scode()."\");";
}
?>
</SCRIPT>
</table></td></tr></table></td></tr></table>
<? }?>

</td></tr></table></td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=10></td>
<td valign=top width=100%>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10></td></tr>
<tr><td><div id=transfer><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></div></td></tr>
<? if($_SESSION['user']['pos']==1)
	{include($_SERVER["DOCUMENT_ROOT"]."/inc/inv.php");}
else
{
	include($_SERVER["DOCUMENT_ROOT"]."/inc/mselect.php");
	if(empty($mselect)) $mselect=0;
    switch ($mselect) // $case - имя переменной передаваемой в параметре к скрипту
{
case 0: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/0.php");break;
case 1: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/1.php");break;
case 2: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/2.php");break;
case 3: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/3.php");break;
case 4: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/4.php");break;
case 5: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/5.php");break;
case 6: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/6.php");break;
case 7: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/7.php");break;
case 8: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/8.php");break;
case 9: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/9.php");break;
case 10: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/10.php");break;
case 11: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/11.php");break;
case 15: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/15.php");break;
case 17: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/17.php");break;
case 18: include($_SERVER["DOCUMENT_ROOT"]."/inc/mpr/help.php");break;
        default:
            include($_SERVER["DOCUMENT_ROOT"] . "/index.php"); // если в переменной $mselect не будет передано значение, которое учтено выше, то открывается главная страница
break;
}
}
   ?>

<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td></tr>
<tr><td align=right>
<SCRIPT language="JavaScript">
counterview("free");
</SCRIPT>
</td></tr>
</table></td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=10 height=10></td></tr>
<tr><td colspan=5><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td></tr></table>
<?php
}
?>