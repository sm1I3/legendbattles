<HEAD>
    <LINK href="./css/game.css" rel=STYLESHEET type=text/css>
    <meta content="text/html; charset=UTF-8" http-equiv=Content-type>
    <META Http-Equiv=Cache-Control Content=no-cache>
    <meta http-equiv=PRAGMA content=NO-CACHE>
    <META Http-Equiv=Expires Content=0>
    <SCRIPT src="/js/ajax.js"></SCRIPT>
    <SCRIPT src="./js/FormUp_v01.js"></SCRIPT>
</HEAD>
<body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699
      alink=#336699 vlink=#336699>
<table cellpadding=4 cellspacing=0 border=0 width=100%>
    <tr>
        <td bgcolor=#FCFAF3><font class=nickname><b>Панель Администрирования</b></font></td>
        <td bgcolor=#FCFAF3>
            <div align=center><input type=button class=lbut onClick="location='main.php'"
                                     value="Вернуться к основному окну"></div>
        </td>
        <td bgcolor=#FCFAF3>
            <div align=right>
                <script language="JavaScript">
                    <!--
                    document.write("<a href='javascript:parent.exit_redir();'>");
                    // -->
                </script>
                <noscript><a href=exit.php target=_top></noscript>
                <img src=http://img.legendbattles.ru/image/exit.gif align=absmiddle width=15 height=15 border=0></a>
            </div>
        </td>
    </tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
    <tr>
        <td bgcolor=#Ffffff><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td>
    </tr>
    <tr>
        <td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td>
    </tr>
    <tr>
        <td bgcolor=#F3ECD7><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td>
    </tr>
</table>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
    <tr>
        <td>
            <table width="100%" cellpadding="0" cellspacing="2">
                <tr>
                    <td>
                        <table width="100%" cellpadding="1" cellspacing="0">
                            <tr>
                                <td bgcolor="#CCCCCC">
                                    <table width="100%" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td bgcolor="#FFFFFF"><?php
                                                if (is_file(DROOT . "/includes/addons/admin-action/" . preg_replace('/[^a-zA-Z]/', '', $_GET['addid']) . ".php")) {
                                                    include(DROOT . "/includes/addons/admin-action/" . preg_replace('/[^a-zA-Z]/', '', $_GET['addid']) . ".php");
                                                }
                                                ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
