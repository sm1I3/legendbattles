<div style="text-align:center;font-weight:bold;padding: 0 0 20 0px">�������� �������: <?php echo $Fort['market']; ?></div>

<!-- BEGIN empty_block -->
� ��������� ����� � ������� ��� �������. ��� ������� ��� �������, � ����� ���� �� ���������. ����-�... :)
<!-- END empty_block -->

<!-- BEGIN have_articles_block -->
    <table class=tab_no style="width:auto;">
    <!-- BEGIN items_list -->
        <tr>
            <td colspan=2 style="padding:0 4 0 6px; vertical-align:middle;" bgcolor="#DFCC88"><b>{name}</b></td>
        </tr>
        <tr>
            <td style="padding:0 10 20 0px;"><div style="padding:3 3 3 3px;">
				<img src='{STATIC_IMAGES_PATH}/images/wear/{image}'></div>
            </td>
             <td style="padding:5 0 20 0px;">
                    <b>����������</b>: {requirments_pretty}
                    <div style="padding:0 0 1 0px;"><b>��������:</b> {properties_pretty}</div>
					<div style="padding:0 0 1 0px;"><b>���:</b> {weight}</div>
					<div style="padding:0 0 1 0px;"><b>�������������:</b> {durability_max}</div>
					<div style="padding:0 0 1 0px;"><b>����:</b> {price} ���. <a href="?buy={key}" onclick="return confirm('������������� �������� {name} �� {price} ���.?');">������</a></div>
            </td>
        </tr>
    <!-- END items_list -->
    </table>
<!-- END have_articles_block -->
