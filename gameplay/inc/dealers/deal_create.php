<?
 echo'
 <script language=Javascript src="../../../js/create_art.js"> </script>
 </form>
 <form method=post>	
	<input type="hidden" name="post_id" value="85" />
	<input type="hidden" name="vcode" value="';echo scod();echo'" />
		<FIELDSET name=field_dealers id=field_dealers>
		<LEGEND align=center><B>
		<font color=gray>&nbsp;�������� ������������ ����������&nbsp;</font></B></LEGEND>
		<table cellpadding=10 cellspacing=0 border=0 width=100%>
			<tr><td class=nickname2>
			<p><b>
				�������� ���:
					  <select name="selecttype" onChange="writeparams(this.value);getPrice();">
					  <option value="none" selected="selected">��������</option>
					  <option value="w4">����</option>
					  <option value="w1">����</option>
					  <option value="w2">������</option>
					  <option value="w3">��������</option>
					  <option value="w6">�������� � �����</option>
					  <option value="w5">�����������</option>
					  <option value="w7">������</option>
					  <option value="w20">����</option>
					  <option value="w23">�����</option>
					  <option value="w26">�����</option>
					  <option value="w18">��������</option>
					  <option value="w19">�������</option>
					  <option value="w24">��������</option>
					  <option value="w80">������</option>
					  <option value="w21">������</option>
					  <option value="w25">������</option>
					  <option value="w22">������</option>
					  <option value="w28">����������</option>
					  <option value="w90">�����������</option>
					</select>

					������� ��������:
					<input type=text class=logintextbox id=artname name=artname value="" onkeyup="getPrice();"/>
					<div id=params>';
					if($message!=''){
					echo $message;
					}
					echo'
					</div>
					<br>
					<div id=dealprice>
					</div>
			</b></p>
		';
echo'</td></tr>	</table></FIELDSET>	
</form>
<BR>
';
?>
