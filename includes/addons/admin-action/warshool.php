<?php
if($_GET['StartTrane']){
	if($player['level'] < 3){
		TraneAttack($player,array(1,2));
	}	
}


if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
echo'<table cellpadding="0" cellspacing="5" border="0" align="center" width="50%">
		</div>    <td>
<div class="block info">
	<div class="header">
	</style>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
	</div>
        <table cellpadding="0" cellspacing="5" border="0" align="center" width="50%">
          <tr>
        <td bgcolor="#ffffff"><img src="http://img.legendbattles.ru/image/gameplay/school/vsch_city1.jpg" width="900" height="300" border="0" /></td>
      </tr>
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="100%">
          <tr>';
            if($player['hp']<$player['hp_all']*0.6){
				echo'<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>�� ������� ��������� ��� ����!</font></font></b></div></td>';
			}elseif($player['level'] < 2){
				echo'<td width="100%" bgcolor="#f5f5f5" colspan="3"><div align="center">���������� ������ �� ����� � ��� � ����� ��� ������ ��������.<br /><font color=#6600FF>�� ������ ���,��� �� ������ �������� ,�������� � ����� �������  <tr>
	<table cellpadding="0" cellspacing="0" border="0" align="center" width="50%">
			<a class="bbutton" id="skill" HREF="main.php?get=3&go=160&vcode='.scode().'" COORDS="'.$coord[10].'" title="����� ������">&nbsp;</a>
              � ������ ����� &quot;<a href="main.php?StartTrane=1"><font class="zaya"><b>������ ������������� ���</b></font></a>&quot; � �� �������� � ���, �� ��� ������ ���� ������ � ����� ����������.</div></td>';
          }else{
				echo'<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>�� ��� ������� ������� ���� ������������� � �����.!</font></font></b></div></td>';
		  }
		  echo'</table></td>
      </tr>
    </table></td>
  </tr>
</table>';
?>
