<div style="text-align:center;font-weight:bold;">������� ��������: <?php echo $Fort['change']; ?></div>
<!-- BEGIN have_resource -->
<form method="post">
<table class="tab_no">
<tr><td width="50%">
��� ������:<br/>
<!-- BEGIN resource_list -->
<input type="checkbox" value="{item_id}" name="res_ids[]" onclick="check(this);"> {item_name} x5<br/>
<!-- END resource_list -->
</td>
<td id="target_container" width="50%">
�� ��� ������:<br/>
</td>
</table>
<div style="padding: 10 0 0 0px"><input type="submit" name="process" value="��������" class="btn"></div>
</form>
<!-- END have_resource -->

<!-- BEGIN havent_resource -->
��� ������ ����� �������� �� ������, ���������� ����� ��� ������� 5 ���������� ��������.
<!-- END havent_resource --><?php echo time()+60*60*24*7;
