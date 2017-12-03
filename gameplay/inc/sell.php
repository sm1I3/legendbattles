<?
mysqli_query($GLOBALS['db_link'],'DELETE FROM invent WHERE id_item='.AP.$uid.AP.' LIMIT 1;');
mysqli_query($GLOBALS['db_link'],'UPDATE user SET nv=nv+'.AP.$sum.AP.' WHERE id='.AP.$player['id'].AP.'LIMIT 1;');
mysqli_query($GLOBALS['db_link'],'UPDATE market SET kol=kol+1 WHERE id='.AP.$prot.AP.' and market='.AP.$player['loc'].AP.' LIMIT 1;');
$msg="<b><font class=proce>Вы удачно продали <font class=proceg>".$wn."</font> за ".lr($sum)."</font></b>";
						$typetolog = '0'; $abouttolog = '0';  # переменные для логов: первая всегда 0
						$typetolog .= '@13';  
						$abouttolog .= '@<b>'.$wn.'</b> ('.$numrow.' шт.). По цене: <b>'.$sum.'</b> LR.';
						player_actions($player['id'],$typetolog,$abouttolog);
pvu_logs($player['id'],"8","|".getIP()."|".(($dditem['gift'])?$dditem['gift']:'Не подарок')."|".$dditem['price']."|".$sum."|".($dditem['dolg']-$dditem['iznos'])."|".$dditem['dolg']."|0|".$dditem['name']);