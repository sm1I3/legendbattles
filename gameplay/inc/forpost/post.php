<?


?><table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><img src="/img/image/1x1.gif" width="1" height="10" /></td>
  </tr>
  <tr>
    <td><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src="/img/image/gameplay/post/post_city1.jpg" width="760" height="255" border="0" /></fieldset></td>
  </tr>
  <tr>
    <td><img src="/img/image/1x1.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="100%">
      <tr>
        <td align="center" width="25%" bgcolor="f5f5f5"><font class="zaya"><b><a href="main.php?post_actions=1">Подарить открытку</a></b></font></td>
        <td align="center" width="25%" bgcolor="f5f5f5"><font class="zaya"><b><a href="main.php?post_actions=2">Отправить деньги/вещи</a></b></font></td>
        <td align="center" width="25%" bgcolor="f5f5f5"><font class="zaya"><b><a href="main.php?post_actions=3">Телеграф</a></b></font></td>
        <td align="center" width="25%" bgcolor="f5f5f5"><font class="zaya"><b><a href="main.php?post_actions=4">Переписка</a></b></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#ffffff"><img src="/img/image/1x1.gif" width="1" height="3" /></td>
  </tr>
  <tr>
    <td><table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
      <tr>
        <td bgcolor="#e0e0e0"><?php
	echo'<form method="get" action="">
          <table cellpadding="3" cellspacing="1" border="0" width="100%">
            <tr>
              <td bgcolor="#ffffff" colspan="2">
                  <input type="hidden" name="get_id" value="34" />
                  <input type="hidden" name="post_actions" value="'.intval($_GET['post_actions']).'" />';
if($_SESSION['gamesession']['post_user'] == ''){
				 echo'<input type="hidden" name="post_action" value="1" />
                  <input type="hidden" name="vcode" value="'.scode().'" />
				  <br /><div align="center">
                  <table cellpadding="0" cellspacing="0" border="0" width="45%">
                    <tr>
                      <td bgcolor="#B9A05C"><table cellpadding="3" cellspacing="1" border="0" width="100%">
                        <tr>
                          <td width="100%" bgcolor="#FCFAF3"><font class="nickname"><b>';
switch($_GET['post_actions']){
	case'1':
		echo'Подарить открытку';
	break;
	case'2':
		echo'Отправить деньги/вещи';
	break;
	case'3':
		echo'Отправить сообщение';
	break;
	case'4':
		echo'Переписка';
	break;
	default:
		echo'Отправить деньги/вещи';
	break;
}
echo'</b></font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FCFAF3"><font class="nickname"><b>Кому:</b></font>
                            <input type="text" name="fornickname" class="LogintextBox"  maxlength="25" />
                            <input type="submit" value="Выбрать" class="lbut" /></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></form>
                </div><br />';
}else{
echo'<input type="hidden" name="post_action" value="2" />
                  <input type="hidden" name="vcode" value="'.scode().'" /><br /><table border=0 cellspacing=1 cellpadding=0 width=90% align=center><tr><td><font class=nickname>';
switch($_GET['post_actions']){
	case'1':
		echo'Посылка открытки персонажу';
	break;
	case'2':
		echo'Передача вещей или денег персонажу';
	break;
	case'3':
		echo'Передача сообщений персонажу';
	break;
	case'4':
		echo'Переписка с персонажем';
	break;
	default:
		echo'Передача вещей или денег персонажу';
	break;
}
echo' <b>'.$_SESSION['gamesession']['post_user'].'</b><a href=/ipers.php?'.$_SESSION['gamesession']['post_user'].' target=_blank><img src=/img/image/chat/info.gif width=11 height=12 border=0></a>
  <input class=invbut type=submit value=Сменить>
  <br>
  <font class=freetxt>Если в течении 7 дней не удалось отправить вещи, то они возвращаются обратно отправителю.</font>
  <hr size=1 color=#cccccc>
  </font></td></tr></table></form>';

switch($_GET['post_actions']){
	case'1':
		echo'<center>Посылка открытки персонажу<br />В разработке</center>';
	break;
	case'2':
		echo'<center>Передача вещей или денег персонажу<br />В разработке</center>';
	break;
	case'3':
		echo'<table border=0 cellspacing=1 cellpadding=0 width=90% align=center><tr><td><form action="" method=GET><input type=hidden name=get_id value=34><input type=hidden name=post_actions value=3><input type=hidden name=post_action value=4><input type=hidden name=vcode value='.scode().'><font class=nickname>Передача сообщения (150 символов): <input name=message type=text class=LogintextBox4 maxlength="150">&nbsp&nbsp<input class=invbut type=submit value="Отправить (10 LR)"></font></form></td></tr></table>';
	break;
	case'4':
		echo'<center>Переписка с персонажем<br />В разработке</center>';
	break;
	default:
		echo'<center>Передача вещей или денег персонажу<br />В разработке</center>';
	break;
}
}
				echo'</td>
            </tr>
          </table>';

?></td>
      </tr>
    </table></td>
  </tr>
</table>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>
