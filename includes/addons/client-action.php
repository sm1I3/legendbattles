<?php
if(!empty($_POST)){
	$player['ABClient'] = intval($_POST['attack'])."|".intval($_POST['blocks'])."|".intval($_POST['mana'])."|".$_POST['heals']."|".$_POST['prim'];
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `ABClient`='".$player['ABClient']."' WHERE `id`='".$player['id']."'");
    echo "<script>parent.jAlert('Настойки сохранены.');</script>";
}
$AutoBot = explode("|",$player['ABClient']);
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <link href="/css/game.css" rel="stylesheet" type="text/css">
  <link href="/css/NewDesign.css" rel="stylesheet" type="text/css">
  <meta content="text/html; charset=UTF-8" http-equiv="Content-type">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">
</head>

<style>
input[type="checkbox"] {
    display: none;
}
input[type="checkbox"] + label{
	display: inline-block;
	width: 44px;
	height: 44px;
	background-image: url(/img/image/magic/m320.gif);
}
input[type="checkbox"]:checked + label{
	outline: 1px solid #1e5180;
	background-image: url(/img/image/magic/m320.gif);
}
</style>

<body bgcolor="#FFFFFF" topmargin="0" bottommargin="0" marginwidth="0" marginheight="0" leftmargin="0" rightmargin="0" link="#336699" alink="#336699" vlink="#336699">
<div style="width:100%;height:11px;background:url(\'/imgs/linebg.gif\') 0px 0px;"></div>
<table cellpadding="4" cellspacing="0" border="0" width="100%">
  <tr>
    <td bgcolor="#e2e2e2" width="50%">
      <font class="nickname">
        <b>Настройки Web-клиента</b>
      </font>
    </td>
    <td bgcolor="#e2e2e2" width="50%">
      <div class="menu">
        <a href="#" onClick="parent.$.modal.close();">
          <div class="menu-back" id="menu-back"></div>
        </a>
      </div>
    </td>
  </tr>
</table>
<div style="width:100%;height:11px;background:url(\'/imgs/linebg.gif\') 0px 11px;"></div>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
  <tr>
    <td><table cellpadding="0" cellspacing="2" border="0" width="100%" align="center">
      <tr>
        <td bgcolor="#CCCCCC"><table cellpadding="0" cellspacing="1" width="100%" border="0">
          <tr>
            <td bgcolor="'.(($_GET['addid'] == '1')?'#FFFFFF':'#F0F0F0').'" width="33%">
              <div align="center">
                <a href="?useaction=client-action'.(($_GET['addid'] == '1')?'':'&addid=1').'">
                  <font class="nickname">
                    <b>' . (($_GET['addid'] == '1') ? 'Управление' : 'Настройки') . '</b>
                  </font>
                </a>
              </div>
            </td>
            <td bgcolor="'.(($_GET['addid'] == '2')?'#FFFFFF':'#F0F0F0').'" width="34%">
              <div align="center">
                <a href="?useaction=client-action&addid=2">
                  <font class="nickname">
                    <b>Реклама</b>
                  </font>
                </a>
              </div>
            </td>
            <td bgcolor="'.(($_GET['addid'] == '3')?'#FFFFFF':'#F0F0F0').'" width="33%">
              <div align="center">
                <a href="?useaction=client-action&addid=3">
                  <font class="nickname">
                    <b>Другое</b>
                  </font>
                </a>
              </div>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="10" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF">';
				switch($_GET['addid']){
					case 1:
						echo'  <font class="freemain">
    <form action="" method="post">
	<table cellpadding="1" cellspacing="0" border="0" width="100%">
	<tr>
	<td>
      <fieldset>
        <legend><b>Удары</b></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="1"' . (($AutoBot[0] == 1) ? ' checked="checked"' : '') . ' /> Простой</font></td>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="4"' . (($AutoBot[0] == 4) ? ' checked="checked"' : '') . ' /> 2 простых</font></td>
			<td width="40%"><font class="freemain"><input type="radio" name="attack" value="6"' . (($AutoBot[0] == 6) ? ' checked="checked"' : '') . ' /> 2 прицельных+простой</font></td>
		  </tr>
		  <tr>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="2"' . (($AutoBot[0] == 2) ? ' checked="checked"' : '') . ' /> Прицельный</font></td>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="5"' . (($AutoBot[0] == 5) ? ' checked="checked"' : '') . ' /> 2 прицельных</font></td>
			<td width="40%"><font class="freemain"><input type="radio" name="attack" value="3"' . (($AutoBot[0] == 3) ? ' checked="checked"' : '') . ' /> Прицельный+простой</font></td>
		  </tr>
		</table>
	  </fieldset>
	  <fieldset>
        <legend><b>Магические удары</b></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="7"'.(($AutoBot[0] == 7)?' checked="checked"':'').' /> Spirit Arrow</font></td>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="10"'.(($AutoBot[0] == 10)?' checked="checked"':'').' /> 2 Spirit Arrow</font></td>
			<td width="40%"><font class="freemain"><input type="radio" name="attack" value="12"'.(($AutoBot[0] == 12)?' checked="checked"':'').' /> 2 Mind Blast+Spirit Arrow</font></td>
		  </tr>
		  <tr>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="8"'.(($AutoBot[0] == 8)?' checked="checked"':'').' /> Mind Blast</font></td>
			<td width="30%"><font class="freemain"><input type="radio" name="attack" value="11"'.(($AutoBot[0] == 11)?' checked="checked"':'').' /> 2 Mind Blast</font></td>
			<td width="40%"><font class="freemain"><input type="radio" name="attack" value="9"'.(($AutoBot[0] == 9)?' checked="checked"':'').' /> Mind Blast+Spirit Arrow</font></td>
		  </tr>
		</table>
			<div align="center">
			<font class="freemain">Использовать</font>
			<select name="mana">
				<option '.(($AutoBot[2] == 5)?' selected':'').'>5</option>
				<option '.(($AutoBot[2] == 10)?' selected':'').'>10</option>
				<option '.(($AutoBot[2] == 15)?' selected':'').'>15</option>
				<option '.(($AutoBot[2] == 20)?' selected':'').'>20</option>
				<option '.(($AutoBot[2] == 25)?' selected':'').'>25</option>
				<option '.(($AutoBot[2] == 30)?' selected':'').'>30</option>
				<option '.(($AutoBot[2] == 35)?' selected':'').'>35</option>
				<option '.(($AutoBot[2] == 40)?' selected':'').'>40</option>
				<option '.(($AutoBot[2] == 45)?' selected':'').'>45</option>
				<option '.(($AutoBot[2] == 50)?' selected':'').'>50</option>
				<option '.(($AutoBot[2] == 55)?' selected':'').'>55</option>
				<option '.(($AutoBot[2] == 60)?' selected':'').'>60</option>
				<option '.(($AutoBot[2] == 65)?' selected':'').'>65</option>
				<option '.(($AutoBot[2] == 70)?' selected':'').'>70</option>
				<option '.(($AutoBot[2] == 75)?' selected':'').'>75</option>
				<option '.(($AutoBot[2] == 80)?' selected':'').'>80</option>
				<option '.(($AutoBot[2] == 85)?' selected':'').'>85</option>
				<option '.(($AutoBot[2] == 90)?' selected':'').'>90</option>
				<option '.(($AutoBot[2] == 95)?' selected':'').'>95</option>
				<option '.(($AutoBot[2] == 100)?' selected':'').'>100</option>
				<option '.(($AutoBot[2] == 105)?' selected':'').'>105</option>
				<option '.(($AutoBot[2] == 110)?' selected':'').'>110</option>
				<option '.(($AutoBot[2] == 115)?' selected':'').'>115</option>
				<option '.(($AutoBot[2] == 120)?' selected':'').'>120</option>
				<option '.(($AutoBot[2] == 125)?' selected':'').'>125</option>
				<option '.(($AutoBot[2] == 130)?' selected':'').'>130</option>
				<option '.(($AutoBot[2] == 135)?' selected':'').'>135</option>
				<option '.(($AutoBot[2] == 140)?' selected':'').'>140</option>
				<option '.(($AutoBot[2] == 145)?' selected':'').'>145</option>
				<option '.(($AutoBot[2] == 150)?' selected':'').'>150</option>
				<option '.(($AutoBot[2] == 155)?' selected':'').'>155</option>
				<option '.(($AutoBot[2] == 160)?' selected':'').'>160</option>
				<option '.(($AutoBot[2] == 165)?' selected':'').'>165</option>
				<option '.(($AutoBot[2] == 170)?' selected':'').'>170</option>
				<option '.(($AutoBot[2] == 175)?' selected':'').'>175</option>
				<option '.(($AutoBot[2] == 180)?' selected':'').'>180</option>
				<option '.(($AutoBot[2] == 185)?' selected':'').'>185</option>
				<option '.(($AutoBot[2] == 190)?' selected':'').'>190</option>
				<option '.(($AutoBot[2] == 195)?' selected':'').'>195</option>
				<option '.(($AutoBot[2] == 200)?' selected':'').'>200</option>
			</select>
			<font class="freemain"> маны на удар</font>
			</div>
	  </fieldset>
	  <fieldset>
        <legend><b>Блоки</b></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
			<td width="33%"><font class="freemain"><input type="radio" name="blocks" value="3"' . (($AutoBot[1] == 3) ? ' checked="checked"' : '') . ' /> Блок со щитом</font></td>
			<td width="34%"><font class="freemain"><input type="radio" name="blocks" value="2"' . (($AutoBot[1] == 2) ? ' checked="checked"' : '') . ' /> Блок двух точек</font></td>
			<td width="33%"><font class="freemain"><input type="radio" name="blocks" value="1"' . (($AutoBot[1] == 1) ? ' checked="checked"' : '') . ' /> Блок одной точки</font></td>
		  </tr>
		  <tr>
			<td width="33%"><font class="freemain"><input type="radio" name="blocks" value="0"' . (($AutoBot[1] == 0) ? ' checked="checked"' : '') . ' /> Без блоков</font></td>
			<td width="34%">&nbsp;</td>
			<td width="33%">&nbsp;</td>
		  </tr>
		</table>
	  </fieldset>
	  <fieldset>
        <legend><b>Прочее</b></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
			<td width="33%"><input type="checkbox" class="heals" id="heals" name="heals" '.(($AutoBot[3] == "on")?' checked':'').'><label for="heals"></label></td>
			<td width="33%"><input type="checkbox" class="prim" id="prim" name="prim" '.(($AutoBot[4] == "on")?' checked':'').'><label for="prim"></label></td>
		  </tr>
		</table>
	  </fieldset>
	</td>
	</tr>
	</table>
	  <center>
        <input type="submit" class="lbut" value="Сохранить" border="0" />
      </center>
	</form>
  </font>';
  case 2:
  echo'  <font class="freemain">
    <form action="" method="post">
	<table cellpadding="1" cellspacing="0" border="0" width="100%">
	<tr>
	<td>
      <fieldset>
        <legend><b>Текст рекламы</b></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
		<td><p><textarea rows="10" cols="115" name="text"></textarea></p></td>
		  </tr>
		  <tr>
		  <td><input type="radio" id="brek"></input><label for="brek">Выделять рекламу</label></td>
		  </tr>
		</table>
	  </fieldset>
	</td>
	</tr>
	</table>
	  <center>
        <input type="submit" class="lbut" value="Сохранить" border="0" />
      </center>
	</form>
  </font>';
					break;
					default:
					echo'<font class="freetxt">
                  <div align="center">
				    <script type="text/javascript">
					  function cheangeAb(){
					    if(parent.ab == true){
						  parent.ab = false;
						  document.getElementById(\'ABColors\').color = \'#CC0000\';
						}else if(parent.ab == false){
						  parent.ab = true;
						  document.getElementById(\'ABColors\').color = \'#00CC00\';
						}
					  }
					  document.write(\'<a href="javascript:cheangeAb();"><font color="\'+((parent.ab == true)?\'#00CC00\':\'#CC0000\')+\'" id="ABColors"><b>Автобой</b></font></a>\');
					</script>
                  </div>
                </font>';
				echo'<br><font class="freetxt">
                  <div align="center">
				    <script type="text/javascript">
					  function cheangeRek(){
					    if(parent.rek == true){
						  parent.rek = false;
						  document.getElementById(\'RekColors\').color = \'#CC0000\';
						}else if(parent.rek == false){
						  parent.rek = true;
						  document.getElementById(\'RekColors\').color = \'#00CC00\';
						}
					  }
					  document.write(\'<a href="javascript:cheangeRek();"><font color="\'+((parent.rek == true)?\'#00CC00\':\'#CC0000\')+\'" id="RekColors"><b>Автореклама</b></font></a>\');
					</script>
                  </div>
                </font>';
					break;
				}
				echo'</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>';