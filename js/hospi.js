function check_hospi_enter(rnum,sum)
{
       if(rnum == 0) var msg = "���� � ������� ������ ������� ("+sum+" LR)\n�� �������, ��� ������ �����?";
       else var msg = "��������� ���������� ����� ����� "+sum+" LR\n�� �������, ��� ������ ����������?";
       formCheck = confirm(msg);
       if(formCheck) return true;
       return false;
}