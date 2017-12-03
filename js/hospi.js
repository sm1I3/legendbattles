function check_hospi_enter(rnum,sum)
{
    if (rnum == 0) var msg = "Вход в команту отдыха платный (" + sum + " LR)\nВы уверены, что хотите войти?";
    else var msg = "Получение больничной койки стоит " + sum + " LR\nВы уверены, что хотите продолжить?";
       formCheck = confirm(msg);
       if(formCheck) return true;
       return false;
}