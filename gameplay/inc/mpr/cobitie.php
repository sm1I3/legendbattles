<div class="block skill">
	<div class="header">
		<span>
      ������ ������ �������
		</span>
	</div>
<html>
    <head>
        <title>JavaScript �������� � ������ ������� � ������� | ������ ������ OX2</title>
    </head>
    <body>
        <script type="text/javascript">
            /**
            * ������� ��������/���������� ���� 
            * @author ox2.ru ������ ������
            **/
            function showHide(element_id) {
                //���� ������� � id-������ element_id ����������
                if (document.getElementById(element_id)) { 
                    //���������� ������ �� ������� � ���������� obj
                    var obj = document.getElementById(element_id); 
                    //���� css-�������� display �� block, ��: 
                    if (obj.style.display != "block") { 
                        obj.style.display = "block"; //���������� �������
                    }
                    else obj.style.display = "none"; //�������� �������
                }
                //���� ������� � id-������ element_id �� ������, �� ������� ���������
                else alert("������� � id: " + element_id + " �� ������!"); 
            }   
        </script>
 
<!-- ��� ����� ��������� ������� showHide, � �������� �������� 
        id-���� �������� ������� ����� ��������/������ -->
	<div class="block skill">
        <a href="javascript:void(0)" onclick="showHide('block_id')"><table class="coll w100 p6h p2v brd2-all" border="0">
<tbody>
<tr class="bg_l">
<td class="brd2-top b toggleDescription" nowrap="nowrap">�������� �����</td>
<td class="brd2-top b track " align="center"></td>
</tr>
</tbody>
</table></a><br/><br/>
        <div id="block_id" style="display: none;">
            <br/>
            <br/>
            �����....
        </div>
 
       </body>
</html>