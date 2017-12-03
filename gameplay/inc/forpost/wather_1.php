<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.MetaData.js"></script>
<script type="text/javascript" src="/js/jquery.maphilight.min.js"></script>
<script>
    $(function () {
        $("img[usemap]").maphilight();
    });

    function hilightlinkover(id) {
        $("#loc_" + id).mouseover();
    }

    function hilightlinkout(id) {
        $("#loc_" + id).mouseout();
    }
</script>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
    <tr>
        <td><font class="proce">
                <fieldset>
                    <legend align="center"><b><font color="gray">Вход в Подводное Царство</font></b></legend>
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
                        <tr>
                            <td width="760" height="228" style="position:relative;"
                                background="/img/image/cities/wather_1.jpg" usemap="#links"><img
                                        src="/img/image/1x1.gif" width="760" height="228" border="0" usemap="#links"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </font></td>
    </tr>
</table>
<map name="links" id="links">
    <area shape="poly"
          coords="379,115,397,115,414,113,446,112,445,107,476,108,476,113,504,116,496,96,502,92,498,86,494,85,490,77,490,62,495,61,496,55,492,50,485,44,475,33,466,28,447,21,448,21,448,11,443,2,437,12,437,18,437,23,421,28,412,34,403,43,398,51,391,54,391,59,396,64,397,77,393,83,388,87,385,92,389,95,391,101,386,107"
          href="<?php echo(($UnderWater == true) ? '/main.php?get=3&go=102&vcode=' . scode() : 'javascript:alert(\'Для входа наденьте &quot;Подводный Комплект&quot;\');'); ?>"
          onmouseover="tooltip(this,'<b>Вход в Атлантис</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly" coords="537,211,538,188,549,189,549,211,616,211,617,187,626,187,628,211"
          href="main.php?get=3&go=28&vcode=<?php echo scode(); ?>" onmouseover="tooltip(this,'<b>Уплыть с острова</b>')"
          onmouseout="hide_info(this)"/>
</map>
<SCRIPT language="JavaScript">
    NewLinksView();
</SCRIPT>