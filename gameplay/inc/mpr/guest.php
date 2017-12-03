<?php
			echo'<table cellpadding="5" cellspacing="1" border="0" width="100%">';
			$Query = mysqli_query($GLOBALS['db_link'], "SELECT quest_tasks.task_start,quest_tasks.task_time,quest_tasks.task_description,quest_tasks.task_hide,quest_list.quest_serilize FROM quest_list,quest_tasks WHERE quest_list.quest_id=quest_tasks.quest_id AND quest_tasks.task_complete=0 AND quest_tasks.task_hide=0 AND quest_tasks.playerid=".$player['id']."");
			if ( mysqli_num_rows( $Query ) > 0 ){
				$yes = 0;
				while ( $journ = mysqli_fetch_row( $Query ) ){
					if ( $timenow < $journ[1] && !$journ[3] ){
						++$yes;
						$que = unserialize( $journ[4] );
						print "<tr><td bgcolor=\"#FFFFFF\"><img src=\"http://img.legendbattles.ru/image/gameplay/faces/".$que[0][1]."\" width=\"130\" height=\"130\" border=\"0\"></td><td width=100% class=\"nickname\" bgcolor=\"#FFFFFF\"><font class=\"travma\">Задание:</font><BR><B>".$que[0][0]."</B><BR>".$journ[2]."<BR><font class=\"travma\"><font color=#008800><B>Время выполнения:</B> ".date( "d.m.Y H:i", $journ[0] )." - ".date( "d.m.Y H:i", $journ[1] )."</font></font></td></tr>";
					}
				}
			}
			if( !$yes ) {
				echo "<tr><td bgcolor=#F5F5F5 align=center><font class=inv><b>Нет активных заданий</b></font></td></tr>";
			}
			echo'</table>';?>