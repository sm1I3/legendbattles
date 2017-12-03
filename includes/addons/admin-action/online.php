<tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="5" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" cellpadding="5" cellspacing="0">
<?php
	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
        return (($g) ? $g . ' <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=http://img.legendbattles.ru/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=http://img.legendbattles.ru/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
	}
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
$all = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `last`>'".(time()-300)."'");
echo "<tr><td>логин</td><td>уровень</td><td>клан</td><td>молчанка</td><td>травма</td><td>Деньги</td><td>DLR</td><td>Валюта</td><td>склонность</td><td>клиент</td></tr>";
$s = '';

while ($row = mysqli_fetch_assoc($all)) {
	if(effects($row['affect'],0)!=''){
		$traw=effects($row['affect'],0);
	}else{
		$traw=0;
	}
	$s .= '<th><tr>';
	$s .= '<td>'.$row['login'].'<a href="/ipers.php?'.$row['login'].'" target="_blank"><img src="http://img.legendbattles.ru/image/chat/ico_info.gif" width="13" height="13" border="0" align="absmiddle"></a></td>';
	$s .= '<td>'.$row['level'].'</td>';
	if($row['clan_id']!='chaos' and $row['clan_id']!='none'){
		$s .= '<td><img src="http://img.legendbattles.ru//image/signs/'.$row['clan_gif'].'" title="'.$row['clan'].' ('.$row['clan_d'].')"> </td>';
	}else{
		$s .= '<td>0</td>';
	}
	$min = floor(($row['sleep']-time())/60);
	$sec = ($row['sleep']-time())-$min*60;
    $s .= '<td>' . (($row['sleep'] > time()) ? '<img src="http://img.legendbattles.ru/image/signs/molch.gif" title="Персонаж будет молчать еще ' . $min . ' мин. и ' . $sec . ' сек.e"></td>' : '0</td>');
    $s .= '<td>' . ($traw ? '<img src="http://img.legendbattles.ru/image/chat/tr4.gif" title="' . $traw . '"></td>' : '0</td>'); // Травмы - надо придумать доков
	$s .= '<td>'.lr($row['nv']?$row['nv'].'</td>':'0</td>');
	$s .= '<td>'.($row['dd']?$row['dd'].'</td>':'0</td>');
	$s .= '<td>'.($row['baks']?$row['baks'].'</td>':'0</td>');
	$s .= '<td>'.($row['sklon']?$row['sklon'].'</td>':'0</td>');
	$s .= '<td>'.($row['ip']?$row['ip'].'</td>':'0</td>');
	$s .= "\n </tr></th>";
}
echo '';
mysqli_free_result($all);
echo  substr($s,0,strlen($s)-1);
?>