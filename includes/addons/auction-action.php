<HEAD>
<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
<META Http-Equiv="Cache-Control" Content="no-cache">
<meta http-equiv="PRAGMA" content="no-cache">
<META Http-Equiv="Expires" Content="0">
<script type="text/javascript" language="javascript" src="/js/v1_tooltip.js"></script>
<script type="text/javascript" language="javascript" src="/js/FormUp_v01.js"></script>
<script type="text/javascript" language="javascript" src="/js/itemsInfo.js"></script>
</HEAD>
<body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699>
	<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>
	<div id="header">
<table cellpadding=4 cellspacing=0 border=0 width=100%>
  <tr>
    <td>
      <font class=nickname>
        <b>Скупка и продажа вещей</b>
      </font>
    </td>
    <td>
      <div align=right>
        <script language="JavaScript">
          document.write("<a href='javascript:top.exit_redir();'>");
        </script>
      </div>
    </td>
  </tr>
</table></div>
<br><br>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="2">
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="1" cellspacing="1" width="100%" border="0">
          <tr>
            <td bgcolor="#<?php echo (($_GET['addid'] == 'lots' or $_GET['addid'] == '')?'FFFFFF':'F0F0F0'); ?>" width="25%"><div align="center"><a href="?useaction=auction-action&addid=lots" class="nickname"><font class="nickname"><b>Аукцион</b></font></a></div></td>
			<td bgcolor="#<?php echo (($_GET['addid'] == 'mylots')?'FFFFFF':'F0F0F0'); ?>" width="25%"><div align="center"><a href="?useaction=auction-action&addid=mylots" class="nickname"><font class="nickname"><b>Мои лоты</b></font></a></div></td>
			<td bgcolor="#<?php echo (($_GET['addid'] == 'newlots')?'FFFFFF':'F0F0F0'); ?>" width="25%"><div align="center"><a href="?useaction=auction-action&addid=newlots" class="nickname"><font class="nickname"><b>Новый лот</b></font></a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="5" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF"><?php
				$_GET['addid'] = (($_GET['addid']) ? $_GET['addid'] : 'lots' );
				if(is_file( DROOT . "/includes/addons/auction-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php")){
					include( DROOT . "/includes/addons/auction-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php");
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
