<?



?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/gameplay/sp/spakad.jpg width=760 height=255 border=0></fieldset></td></tr>
    <tr>
        <td><img src=/img/image/1x1.gif width=1 height=10><br>
            <div align=center><b><font class=nickname><font color=#dd0000><i>Академия в разработке...</div>
        </td>
    </tr>

</table>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>