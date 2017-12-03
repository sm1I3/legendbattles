$ = function (id) {
    return document.getElementById(id);
}

FormPopUp = function (id) {
    if ($(id).style.display == 'none') {
        $(id).style.display = 'block';
    } else if ($(id).style.display == 'block') {
        $(id).style.display = 'none';
    }
}

document.write('<div id="darker" style="display:none;"><table cellspacing="0" cellpadding="0" width="300" style="position:relative; width:300px; top:150px; margin:0 auto;">  <tr>    <td style="width:18px;height:18px;"><div style="position:absolute; width:30px; height:30px; background:url(https://img.lifeiswar.ru/image/closebox.png) no-repeat;right:0px;top:0px;cursor:pointer;" onclick="FormPopUp(\'darker\');">&nbsp;</div><img src="https://img.lifeiswar.ru/image/FormUp/left_parent.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'https://img.lifeiswar.ru/image/FormUp/parent.png\');"></td>    <td style="width:18px;height:18px;"><img src="https://img.lifeiswar.ru/image/FormUp/right_parent.png" width="18" height="18"></td>  </tr>  <tr>    <td style="width:18px;background-image:url(\'https://img.lifeiswar.ru/image/FormUp/left.png\');"></td>    <td style="background-image:url(\'https://img.lifeiswar.ru/image/FormUp/bg.png\');" align="center"><div id="ContentPopUp"><img src="https://img.lifeiswar.ru/image/loader.gif"></div></td>    <td style="width:18px;background-image:url(\'https://img.lifeiswar.ru/image/FormUp/right.png\');"></td>  </tr>  <tr>    <td style="width:18px;height:18px;"><img src="https://img.lifeiswar.ru/image/FormUp/left_bottom.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'https://img.lifeiswar.ru/image/FormUp/bottom.png\');"></td>    <td style="width:18px;height:18px;"><img src="https://img.lifeiswar.ru/image/FormUp/right_bottom.png" width="18" height="18"></td>  </tr></table></div>');