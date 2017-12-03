
var stxt,dind,bind,fsize,hpf,mpf,fust,flev,temp,thotems,totemtime,totembuff,maxl,split_ar,bs,i,j,t,blocks,utemp,mbox,fight_f,cu,cb,cod,uadd = "",badd = "",ftmp_pic,ftmp,vsod = 0,mc_i,dyn_selected = -1,dyn_div = 0,formDiv,setp = -1;
var tshow_bl = ["4:5:6@7:8:9@10:11@12:13","14:15@16:17@18:19@20:21","22:23@24@25@26","27@28"];
var array_us = ["В голову", "В торс", "В живот", "По ногам"];
var array_bs = ["Голова", "Торс", "Живот", "Ноги"];
var pos_vars = ["Простой", "Прицельный", "Spirit Arrow", "Mind Blast", "Голова", "Голова + торс", "Голова + живот", "Торс", "Торс + живот", "Торс + ноги", "Живот", "Живот + ноги", "Ноги", "Ноги + голова", "Голова", "Голова + торс", "Торс", "Торс + живот", "Живот", "Живот + ноги", "Ноги", "Ноги + голова", "Голова", "Голова + торс", "Торс + живот", "Живот + ноги", "Ноги + голова + живот", "Голова + торс + живот", "Торс + живот + ноги", "Магический Щит", "Радужный Барьер", "Кристальная Сфера", "Восстановление HP", "Восстановление MP", "Ожог", "Прикосновение огня", "Аура огня", "Огненная стрела", "Огненный взрыв", "Руки огня", "Удар пламени", "Огненная волна", "Огненный шар", "Огненная стена", "Огненный ветер", "Жар", "Ореол огня", "Проклятье огня", "Демон огня", "Танец огня", "Метеор", "Огненная спираль", "Огненная хлыст", "Огненный аркан", "Лава", "Уязвимость от огня", "Тело-огонь", "Огненный щит", "Ритуал огня", "Огненный град", "Огненный клинок", "Сопротивление Огню", "Искры", "Огненное дыхание", "Жизнь огня", "Призвать Мефита", "Выжигание жизни", "Сгусток пламени", "Силя огня", "Безумие огня", "Порыв пламени", "Дождь метеоритов", "Врата ада", "Защита пламени", "Смерч огня", "Стойка огня", "Адское тепло", "Пламенная душа", "Инферно", "Жар солнца", "Призвать Феникса", "Призрачный свет", "Пламенное око", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "Вампиризм", "Тьма", "Святой кокон", "Пожертвование", "Смазанный удар", "Сумеречная дверь", "Кривое зеркало Хаоса", "Первичный Хаос", "Свиток Выжигания Маны", "Свиток Светлого Удара", "Свиток Темного Удара", "Свиток Изгнания Из Боя", "Свиток Удар Ярости", "Свиток Излечения Союзника", "Свиток Завершения Боя", "Свиток Женской Злости", "", "Зелье Колкости", "Зелье Загрубелой Кожи", "Зелье Просветления", "Зелье Гения", "Зелье Лечения Отравлений", "Зелье Лечения", "Зелье Иммунитета", "Зелье Силы", "Зелье Защиты От Ожогов", "Зелье Арктических Вьюг", "Зелье Жизни", "Яд", "Зелье Сокрушительных Ударов", "Зелье Стойкости", "Зелье Недосягаемости", "Зелье Блаженства", "Зелье Ловкости", "Зелье Огненного Ореола", "Зелье Метаболизма", "Зелье Медитации", "Зелье Громоотвода", "Зелье Точного Попадания", "Зелье Сильной Спины", "Зелье Невидимости", "Зелье Восстановления Маны", "Зелье Удачи", "Зелье Скорбь Лешего", "Зелье Энергии", "Зелье Боевой Славы", "Зелье Ловких Ударов", "Зелье Спокойствия", "Зелье Мужества", "Зелье Человек-Гора", "Зелье Секрет Волшебника", "Зелье Инквизитора", "Зелье Панциря", "", "", "Восстановление HP", "Фраза в бой", "Секретное Зелье"];
var pos_ochd = [0,0,50,90,35,50,60,30,50,60,30,50,35,80,40,85,40,85,40,85,40,100,45,70,70,70,130,90,90,45,60,90,30,30,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,90,70,90,70,90,70,90,70,100,100,100,70,100,70,70,100,0,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,0,0,30,30,30];
var pos_type = [1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,4,4,3,1,3,1,3,1,1,3,1,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,3,2,3,3,3,3,3,4,4,4,4,4,5,4,4,0,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,0,0,4,6,4];
var pos_mana = [0,0,5,5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,20,40,65,0,0,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
var tshow_ud = [0,1];
var shtra_ud = [0,0,25,75,150,250];
var add_info = [];
var go_place = '';

function addwarr(){
	document.NaemForm.submit();
}

function magic_slots()
{
    param_ow[13] = status_bar(param_ow[1],param_ow[2],param_ow[4],0);
    param_ow[14] = status_bar(param_ow[3],param_ow[4],param_ow[2],0);
    
    d.write('<LINK href="/imgheader/css1.css" rel="STYLESHEET" type="text/css"><TABLE cellpadding=0 cellspacing=0 border=0 width=100%><TR><TD bgcolor=#f2f2f2><IMG src=http://lordiswar.net/image/1x1.gif width=1 height=10></TD></TR></TABLE><TABLE cellpadding=0 cellspacing=0 border=0 width=100%><TR>'+m_html(2,"",5,1,"empty")+'<TD valign=top><TABLE cellpadding=0 cellspacing=0 border=0 width=100%>');
    hpmp(param_ow);
    d.write('<TR>');
    slots_pla(slots_ow[0],param_ow[0],slots_ow[1],slots_ow[2],param_ow[12]);
    
    d.write('</TR></TABLE></TD>'+m_html(2,"",5,1,"empty")+'<TD width="100%" valign=top><TABLE cellpadding="0" cellspacing="0" border="0" width="100%">');
    d.write('<TR><TD bgcolor=#f2f2f2 align=center><IMG src=http://lordiswar.net/image/gameimg/2-3.gif border=0 title="Наёмник [ от 10 до 50 LR ]" align=absmiddle ' + (naemnik ? 'onClick="addwarr()"' : '') + ' style="cursor: pointer"> <IMG src=http://lordiswar.net/image/gameimg/6-3.gif border=0 align=absmiddle onclick="window.open(\'http://legendbattles.ru/logs.php?fid=' + fight_ty[8] + '\',\'\');" title="Лог боя" class=ccursor> <IMG src=http://lordiswar.net/image/gameimg/4-3.gif border=0 title="Обновить" align=absmiddle onclick="location=\'main.php\'" class=ccursor>');
	d.write(''+(naemnik?'<form method=post name=NaemForm style="display:none;"><input type=hidden name=post_id value=97><input type=hidden name=fightlog value="'+fight_ty[8]+'"><input type=hidden name=forlogin value="'+param_ow[0]+'"><input type=hidden name=vcode value="'+fight_pm[4]+'"></form>':'')+'');
 
    if(fight_ty[3])
    {
        d.write((fight_pm[8] > 0 ? ' <IMG src=http://lordiswar.net/image/gameimg/5-3.gif width=56 height=19 border=0 align=absmiddle onclick="location=\'main.php?cenemy=' + fight_pm[9] + '\'" title="Сменить противника (' + fight_pm[8] + ')" class=ccursor></TD></TR>' : '</TD></TR>'));
	param_en[13] = status_bar(param_en[1],param_en[2],param_en[4],(param_en[5] ? 0 : 1));
    	param_en[14] = status_bar(param_en[3],param_en[4],param_en[2],(param_en[5] ? 0 : 1));
       
       	pos_ochd[0] = fight_pm[2];
       	pos_ochd[1] = fight_pm[2] + 20;
       	for(i=0; i<stand_in.length; i++) selpl(0,stand_in[i],i);

       	switch(fight_pm[3])
       	{
            case 0:  bs = 0; break;
            case 40: bs = 1; break;
            case 70: bs = 2; break;
	    case 90: bs = 3; break;
    	}

        d.write(m_html(1, "f2f2f2", 1, 10, "empty") + m_html(1, "cccccc", 1, 1, "empty") + '<TR><TD bgcolor=#f5f5f5 align=center><TABLE cellpadding=5 cellspacing=0 border=0 width=100% align=center><TR><TD align=center width=100%><B>Ограничения маны на магический удар: <FONT color=#229922>5-' + fight_pm[0] + '</FONT><BR>Количество очков действия: ' + fight_pm[1] + '</B><BR><DIV id=steps>Из них использовано: <B>0</B></DIV></TD><TD><IMG src=http://lordiswar.net/image/help/6.gif width=15 height=15 border=0 title="Помощь" align=absmiddle></TD></TR></TABLE></TD></TR>' + m_html(1, "cccccc", 1, 1, "empty"));
    	d.write(magic_c(0,7));   
        d.write('<TR><TD bgcolor=#fafafa align=center>');
        // Форма Выбора удара ID: form_main
		d.write('<div id="form_map" style="display:none;"></div><FORM name=FF action="main.php" method=POST id=form_main><TABLE cellpadding="0" cellspacing="0" border="0" width="100%"><TR><TD width=50%></TD><TD bgcolor=#cccccc align=center><IMG src="http://lordiswar.net/image/1x1.gif" width="1" height="5"></TD><TD width=50%></TD></TR><TR><TD width=50%><TABLE cellpadding="1" cellspacing="0" border="0" width="100%">');

       	for(i=0; i<4; i++)
    	{
            d.write('<TR><TD width=100% align=right><DIV id="du' + i + '"></DIV></TD><TD><SELECT class=fsel name="u' + i + '" id="u' + i + '" onchange="javascript: CountOD()"><OPTION value="n">' + array_us[i] + ' [ удар не выбран ]</OPTION>');
            for(j=0; j<tshow_ud.length; j++){
				d.write('<OPTION value="'+tshow_ud[j]+'">'+pos_vars[tshow_ud[j]]+' [ '+pos_ochd[tshow_ud[j]]+' ]</OPTION>');
			}
            d.write(uadd+'</SELECT></TD><TD><IMG src="http://lordiswar.net/image/1x1.gif" width="3" height="1"></TD></TR>');
    	}
        // Тестируем цель мага
        d.write('<TR><TD width=100% align=right><DIV id="du' + i + '"></DIV></TD><TD><SELECT class=fsel name="u' + i + '" id="u' + i + '" onchange="javascript: CountOD()"><OPTION value="n">Удар перед собой [ 0 ]</OPTION><OPTION value="1">Удар левее [ 25 ]</OPTION><OPTION value="2">Удар правее [ 25 ]</OPTION></SELECT></TD><TD><IMG src="http://lordiswar.net/image/1x1.gif" width="3" height="1"></TD></TR>');
		// end
       	d.write('</TABLE></TD><TD bgcolor=#cccccc></TD><TD width=50% bgcolor=#fafafa><TABLE cellpadding="1" cellspacing="0" border="0" width="100%">');       
       	
     	var sb = tshow_bl[bs].split("@");
    	for(i=0; i<4; i++)
    	{
            d.write('<TR align=center><TD align=center><IMG src="http://lordiswar.net/image/1x1.gif" width="3" height="1"></TD><TD align=center><SELECT class=fsel name="b' + i + '" id="b' + i + '" onchange="javascript: CountOD()"><OPTION value="n">' + array_bs[i] + ' [ блок не выбран ]</OPTION>');
            if(sb[i]) 
            {
                blocks = sb[i].split(":");
            	for(j=0; j<blocks.length; j++){
					if(pos_vars[blocks[j]]){
						d.write('<OPTION value="'+blocks[j]+'">'+pos_vars[blocks[j]]+' [ '+pos_ochd[blocks[j]]+' ]</OPTION>');
					}
				}
            }
            d.write(badd+'</SELECT></TD><TD width=100% align=center><DIV id="db'+i+'"></DIV></TD></TR>');
        }
        // Тестируем отпрыг от мага
        d.write('<TR><TD><IMG src="http://lordiswar.net/image/1x1.gif" width="3" height="1"></TD><TD><SELECT class=fsel name="b' + i + '" id="b' + i + '" onchange="javascript: CountOD()"><OPTION value="n">Стоять на месте [ 0 ]</OPTION><OPTION value="1">Отскочить левее [ 25 ]</OPTION><OPTION value="2">Отскочить правее [ 25 ]</OPTION></SELECT></TD><TD width=100%><DIV id="db' + i + '"></DIV></TD></TR>');
        // end
    	d.write('</TABLE></TD></TR><TR><TD width=50%></TD><TD bgcolor=#cccccc align=center><IMG src="http://lordiswar.net/image/1x1.gif" width="1" height="5"></TD><TD width=50%></TD></TR></TABLE></TD></TR>'+m_html(1,"cccccc",1,1,"empty"));
    	d.write(magic_c(8,15));
        d.write(m_html(1, "f5f5f5", 1, 5, "empty") + '<TR><TD bgcolor=#f5f5f5 align=center><input type=button value=" xoд " name="btx0" class=fbut onclick="javascript: StartAct()"> <input type=button value=автоход name="bt2" class=fbut onclick="javascript: parent.AutoSelectGo()"> <input type=button value=автовыбор name="bt2" class=fbut onclick="javascript: parent.AutoSelect()"> <input type=button value=сбросить name="bt2" class=fbut onclick="RefreshF();ShowMap();"></TD></TR>' + mh_ret(1));
    	view_gr();
    	d.write(m_html(1,"f2f2f2",1,5,"empty"));
    
    	viewl(1);
    
    	d.write('</TABLE></TD></FORM>');
        // Конец формы удара
		d.write(m_html(2,"",5,1,"empty")+'<TD valign=top><TABLE cellpadding=0 cellspacing=0 border=0 width=100%>');
    	hpmp(param_en);
    	d.write('<TR>');
    	slots_pla(slots_en[0],param_en[0],slots_en[1],slots_en[2],param_en[12]);
        d.write('</TR><TR><TD colspan=5><IMG src="http://lordiswar.net/image/1x1.gif" width="1" height="10"></TD></TR><TR><TD colspan=5><TABLE cellpadding="1" cellspacing="1" border="0" width=170 align=center>' + var_init(addpa_en[0], addpa_en[1], 'Мощь') + var_init(addpa_en[2], addpa_en[3], 'Проворность') + var_init(addpa_en[4], addpa_en[5], 'Везение') + var_init(addpa_en[8], addpa_en[9], 'Разум') + var_init(addpa_en[6], addpa_en[7], 'Сноровка') + '</TABLE></TD></TR><TR><TD colspan=5><IMG src="http://lordiswar.net/image/1x1.gif" width="1" height="10"></TD></TR><TR><TD colspan=5><TABLE cellpadding="1" cellspacing="1" border="0" width=170 align=center>' + mf_init(0, addpa_en[14], 'Класс брони') + mf_init(1, addpa_en[10], 'Уловка') + mf_init(1, addpa_en[11], 'Точность') + mf_init(1, addpa_en[12], 'Сокрушение') + mf_init(1, addpa_en[13], 'Стойкость') + mf_init(1, addpa_en[15], 'Пробой брони') + '</TABLE></TD></TR></TABLE></TD>');
    	fight_f = d.FF;
		mc_i = magic_in.length;
		if(param_ow[0] == 'arron'/* || param_ow[0] == 'Arron' || param_ow == 'riddle'*/){
//			buildMap();
		}
    }
    else 
    {
        d.write('</TD></TR>');
        
        switch(fight_ty[4])
        {
            case 3:
	    d.write(mh_ret(2));
                if (!fight_ty[6]) d.write('<TR><TD bgcolor=#f5f5f5 align=center class=nick><font color=#CC0000><B>Ожидаем хода противника</B></font></TD></TR>');
                else d.write('<TR><TD bgcolor=#f5f5f5 align=center><input type=button class=fbut value="Победа по таймауту" onclick="location=\'main.php?post_id=61&act=6&mode=1&gr=' + fight_ty[7] + '&vcode=' + fight_ty[6] + '\'"> <input type=button class=fbut value="Ничья" onclick="location=\'main.php?post_id=61&act=6&mode=2&gr=' + fight_ty[7] + '&vcode=' + fight_ty[6] + '\'"></TD></TR>');
	    d.write(mh_ret(1));
    	    view_gr();
    	    d.write(m_html(1,"f2f2f2",1,5,"empty"));
            viewl(1);
            break;
            case 2:
                // Бой завершен и вывод статистики
            d.write(m_html(1,"f2f2f2",1,10,"empty"));
            if(fexp[4]) 
	    {                                                                                                                                              			
	        var tkeys = '';
		for(j=0; j<10; j++) tkeys += '<input type=button class=fbut value="'+j+'" OnClick="javascript: KeyInsert('+j+');"> ';
            d.write(m_html(1, "cccccc", 1, 1, "empty") + (fexp[6] == 0 ? m_html(1, "f2f2f2", 1, 5, "empty") + '<FORM action=main.php method=GET name=FEND><TR><TD bgcolor=#f2f2f2 align=center class=nick><img src=../func/scod.php?' + fexp[4] + ' width=103 height=40></TD></TR>' + m_html(1, "f2f2f2", 1, 5, "empty") + m_html(1, "cccccc", 1, 1, "empty") + m_html(1, "f5f5f5", 1, 5, "empty") + '<TR><TD bgcolor=#f5f5f5 align=center nowrap class=nick id=fkey><font class=freetxt>Код: </font><input type=text name=code size=4 class=fbut> ' + tkeys + '<input type=button class=fbut value="B" OnClick="javascript: BackKey();"> <input type=hidden name=post_id value=61><input type=hidden name=act value=7><input type=hidden name=fexp value=' + fexp[0] + '><input type=hidden name=fres value=' + fexp[1] + '><input type=hidden name=vcode value=' + fexp[3] + '><input type=hidden name=ftype value=' + fexp[5] + '><input type=submit class=fbut value="Завершить бой"></TD></TR></FORM>' : m_html(1, "f5f5f5", 1, 5, "empty") + '<TR><TD bgcolor=#f5f5f5 align=center nowrap class=nick id=fkey><font color=#CC0000><B>Защита от автобоя [ ещё ' + fexp[6] + ' сек ]</B></font></TD></TR><SCRIPT language="JavaScript">KeyBlock(' + fexp[6] + ');</SCRIPT>'));
    	    }
            else d.write(m_html(1, "cccccc", 1, 1, "empty") + m_html(1, "f5f5f5", 1, 5, "empty") + '<TR><TD bgcolor=#f5f5f5 align=center><input type=button class=fbut value="Завершить бой" onclick="location=\'main.php?post_id=61&get=0&act=7&fexp=' + fexp[0] + '&fres=' + fexp[1] + '&vcode=' + fexp[3] + '&ftype=' + fexp[5] + '&gr=' + fight_ty[7] + '\'"></TD></TR>');
    	    d.write(mh_ret(1));
    	    views(0);
    	    d.write(m_html(1,"f2f2f2",1,5,"empty"));
    	    viewl(0);
            break;
            case 4:
                d.write(mh_ret(2) + '<TR><TD bgcolor=#f5f5f5 align=center class=nick><font color=#CC0000><B>Ожидаем окончания боя</B></font></TD></TR>' + mh_ret(1));
    	    view_gr();
    	    d.write(m_html(1,"f2f2f2",1,5,"empty"));
            viewl(1);
            break;
            case 5:
                d.write(mh_ret(2) + '<TR><TD bgcolor=#f5f5f5 align=center><input type=button class=fbut value="Завершить" onclick="location=\'main.php?post_id=61&act=7&vcode=' + fight_ty[5] + '\'"></TD></TR>' + mh_ret(1));
                break;
        }
    	d.write('</TABLE></TD>'+m_html(2,"",248,1,"empty"));
    }
    d.write(m_html(2,"",5,1,"empty")+'</TR></TABLE>');           
}

function mh_ret(mv)
{
    switch(mv)
    {
        case 1: return (m_html(1,"f5f5f5",1,5,"empty")+m_html(1,"cccccc",1,1,"empty")+m_html(1,"f2f2f2",1,9,"empty")); break;
        case 2: return (m_html(1,"f2f2f2",1,10,"empty")+m_html(1,"cccccc",1,1,"empty")+m_html(1,"f5f5f5",1,5,"empty")); break;
    }
}

function magic_c(st,end)
{
    t = "";
    if(magic_in[st])
    {
	t += m_html(1,"f2f2f2",1,5,"magic_clots-1")+'<TR><TD align=center bgcolor=#f2f2f2 id="magic_clots-2"><TABLE cellpadding="0" cellspacing="0" border="0" width="375"><TR>';
	for(i=st; i<=end; i++)
        {
            if(magic_in[i]) selpl(1,magic_in[i],i);
            else t += '<TD bgcolor="#cccccc" width=46 align=center><IMG src="http://lordiswar.net/image/magic/m.gif" width="44" height="44" border=0></TD>';
            if(i != end) t += '<TD width=1><IMG src="http://lordiswar.net/image/1x1.gif" width="1" height="46"></TD>';
        }
        t += '</TR></TABLE></TD></TR>'+m_html(1,"f2f2f2",1,5,"magic_clots-3")+m_html(1,"cccccc",1,1,"magic_clots-4");
    }
    return t;
}

function selpl(lg,tm,ti)
{
    switch(pos_type[tm])
    {
        case 1: 
        if(lg == 1) t += '<TD bgcolor="#cccccc" id="m'+ti+'" width=46 align=center><IMG src="http://lordiswar.net/image/magic/m'+tm+'.gif" width="44" height="44" border=0 title="'+pos_vars[tm]+'"></TD>'; 
        uadd += '<OPTION value="'+tm+'">'+pos_vars[tm]+' [ '+pos_ochd[tm]+' ]</OPTION>';
        break;
        case 2: 
        if(lg == 1) t += '<TD bgcolor="#cccccc" id="m'+ti+'" width=46 align=center><IMG src="http://lordiswar.net/image/magic/m'+tm+'.gif" width="44" height="44" border=0 title="'+pos_vars[tm]+'"></TD>'; 
        badd += '<OPTION value="'+tm+'">'+pos_vars[tm]+' [ '+pos_ochd[tm]+' ]</OPTION>';
        break;
        case 3: 
	case 4: t += '<TD bgcolor="#cccccc" id="m'+ti+'" width=46 align=center><A href="javascript: magic_slots_check(\'m'+ti+'\')"><IMG src="http://lordiswar.net/image/magic/m'+tm+'.gif" width="44" height="44" border=0 title="'+pos_vars[tm]+'"></A></TD>'; break;
	case 5: 
	case 6: t += '<TD bgcolor="#cccccc" id="m'+ti+'" width=46 align=center><A href="javascript: show_dyn('+ti+')"><IMG src="http://lordiswar.net/image/magic/m'+tm+'.gif" width="44" height="44" border=0 title="'+pos_vars[tm]+'"></A></TD>'; break;
        case 7:
            t += '<TD bgcolor="#000033" id="m' + ti + '" width=30 align=center>' + (param_ow[3] >= pos_mana[magic_in[ti]] ? '<A href="javascript: show_dyn(' + ti + ');"><IMG src="image/magic/m' + tm + '.gif" width="44" height="44" border=0 title="' + pos_vars[tm] + '">' : '<IMG src="image/magic/m' + tm + '.gif" width="44" height="44" border=0 title="Нехватает маны">') + '</A></TD>';
            break;
    }
}

function magic_slots_check(id)
{
    d.getElementById(id).bgColor = (Active(id) ? "#cccccc" : "#cc0000");
    CountOD();
}

function m_html(cs,bgcolor,w,h,eid)
{
    switch(cs)
    {
        case 1: return '<TR><TD bgcolor=#'+bgcolor+((eid) ? ' id="'+eid+'"' : '' )+' align=center><IMG src=http://lordiswar.net/image/1x1.gif width="1" height="'+h+'"></TD></TR>'; break;
        case 2: return '<TD width="'+w+((eid) ? ' id="'+eid+'"' : '' )+'" align=center><IMG src="http://lordiswar.net/image/1x1.gif" width="'+w+'" height="'+h+'"></TD>'; break;
    }
}

function CountOD()
{
    cod = cu = vsod = 0;
    cb = -1;
    //fight_f = d.FF;

    for(i=0; i<mc_i; i++) if(pos_type[magic_in[i]] > 2 && Active('m'+i)) cod += pos_ochd[magic_in[i]];
    for(i=0; i<4; i++)
    {
        fight_f.elements['b'+i].disabled = false;
        fight_f.elements['u'+i].disabled = false;
        FormCheck('u',i);
        FormCheck('b',i);
    }
    if(cb > -1)
    {
        for(i=0; i<4; i++) if(cb != i) fight_f.elements['b'+i].disabled = true;
    }
    
    if(fight_f.elements['u0'].value != "n") fight_f.elements['u3'].disabled = true;
    else if(fight_f.elements['u3'].value != "n") fight_f.elements['u0'].disabled = true;
    
    cod += shtra_ud[cu];
    stxt = shtra_ud[cu] > 0 ? ' [ штраф: <B>' + shtra_ud[cu] + '</B> ]' : '';
    if(cod > fight_pm[1]) vsod = 1;
    d.getElementById('steps').innerHTML = (fight_pm[1] >= cod ? 'Из них использовано: <B>' + cod + '</B>' + stxt : '<FONT color="#cc0000">Из них использовано: <B>' + cod + '</B>' + stxt + ' <B>ПРЕВЫШЕНИЕ!</B></FONT>');
}

function FormCheck(vt,ti)
{
    utemp = fight_f.elements[vt+ti];
    dind = 'd'+vt+ti;
    bind = 'mb'+vt+ti;
       
    if(utemp.value != "n")
    {
	if(vt == 'u') cu++;
	else cb = ti;
        j = parseInt(utemp.value);
        cod += pos_ochd[j]; 
		 if(pos_mana[j] > 0)
        {
            mbox = fight_f.elements[bind];
            if(mbox) mbox.disabled = false; 
            if(!mbox) d.getElementById(dind).innerHTML = '<input type=text size=1 name="'+bind+'" value="'+pos_mana[j]+'" class=mbox>';
        }
        else d.getElementById(dind).innerHTML = '';
    }
    else d.getElementById(dind).innerHTML = '';
}

function RefreshF()
{
    //fight_f = d.FF;
    if(dyn_div) SetToZeroDyn();
    for(i=0; i<mc_i; i++) if(pos_type[magic_in[i]] > 2 && Active('m'+i)) d.getElementById('m'+i).bgColor = '#cccccc';
    for(i=0; i<4; i++)
    {
        fight_f.elements['u'+i].options[0].selected = true;
	fight_f.elements['b'+i].options[0].selected = true;    
    }
    CountOD();
}

function StartAct()
{
    //fight_f = d.FF;
    if(!vsod)
    {
        var input_u = '',input_b = '',input_a = '',tmp = '',l_u = 0,l_b = 0,l_a = 0;    
    	FT('btx0',1);
    	FT('bt2',1);
    
    	for(i=0; i<4; i++)
    	{
            if(fight_f.elements['u'+i].selectedIndex != 0)
            {
                tmp = '';
	    	l_u++;
	    	if(fight_f.elements['mbu'+i]) tmp = fight_f.elements['mbu'+i].value;
	    	input_u += i+'_'+fight_f.elements['u'+i].value+'_'+(tmp ? tmp : 0)+'@';
            	if(tmp) FT('mbu'+i,1);
            }
            if(fight_f.elements['b'+i].selectedIndex != 0) 
            {
			tmp = '';
	    	l_b = 1;
	    	if(fight_f.elements['mbb'+i]) tmp = fight_f.elements['mbb'+i].value; 
	    	input_b = i+'_'+fight_f.elements['b'+i].value+'_'+(tmp ? tmp : 0)+'@';
            	if(tmp) FT('mbb'+i,1);
            }
            FT('u'+i,1);
            FT('b'+i,1);
        }
    
        for(i=0; i<mc_i; i++) if(pos_type[magic_in[i]] > 2 && Active('m'+i)) 
    	{	
            l_a = 1;
	    switch(pos_type[magic_in[i]])
            {
                case 3: input_a += magic_in[i]+'@'; break;
            	case 4: input_a += magic_in[i]+'_'+alchemy[i]+'@'; break;
            	case 5: 
//	    	case 6: input_a += magic_in[i]+'_'+alchemy[i]+'_'+add_info[i]+'@'; break;
//			case 7: input_a += magic_in[i]+'_'+add_info[i]+'_'+pos_mana[magic_in[i]]+'@'; break;
            case 6: input_a += magic_in[i]+'_'+add_info[i]+'_'+alchemy[i]+'_'+pos_mana[magic_in[i]]+'@'; break;
			case 7: input_a += magic_in[i]+'_'+add_info[i]+'_'+alchemy[i]+'_'+pos_mana[magic_in[i]]+'@'; break;
			}
        }
    
        if((l_u && l_a) || (l_b && l_a) || (l_u && l_b) || l_u>1 || (go_place)){ 
			var form_node = d.getElementById('form_main');

			form_node.appendChild(AddElement('post_id','7'));
			form_node.appendChild(AddElement('vcode',fight_pm[4]));
			form_node.appendChild(AddElement('enemy',fight_pm[5]));
			form_node.appendChild(AddElement('enemyid',fight_pm[10]));
			form_node.appendChild(AddElement('group',fight_pm[6]));
			form_node.appendChild(AddElement('inf_bot',fight_pm[7]));
			form_node.appendChild(AddElement('lev_bot',param_en[5]));
			form_node.appendChild(AddElement('go_pos',param_en[5]));
			form_node.appendChild(AddElement('inu',input_u));
			form_node.appendChild(AddElement('inb',input_b));
			form_node.appendChild(AddElement('ina',input_a));
			form_node.appendChild(AddElement('go_place',go_place));
            fight_f.submit();
		}else{
			for(i=0; i<4; i++){
				FT('u'+i,0);
				FT('b'+i,0);
			}
			FT('btx0',0);
			FT('bt2',0);
			CountOD();
		}
	}
}

function AddElement(iname,ivalue)
{
    var input_node = d.createElement("input");
    input_node.setAttribute("type","hidden");
    input_node.setAttribute("name",iname);
    input_node.setAttribute("value",ivalue);
    return input_node;
}

function FT(eid,d)
{
    fight_f.elements[eid].disabled = (d ? true : false);
}

function hpmp(arrt)
{
    fsize = parseInt(arrt[12]) + 55;
    if(arrt[5])
    {
        hpf = Math.round(fsize*parseFloat(arrt[1])/parseInt(arrt[2]));
    	mpf = Math.round(fsize*parseFloat(arrt[3])/parseInt(arrt[4]));
    	fust = Math.round(parseFloat(arrt[11]))+'%';
    	flev = '['+arrt[5]+']';
    }
    else
    {
        hpf = mpf = fsize;
        fust = flev = '';
    }
    thotems = new Array('Час Сфинкса', 'Час Саблезубого тигра', 'Час Мудрого Льва', 'Час Изумрудного Дракона', 'Час Василиска', 'Час Скорпиона', 'Час Ужасающей Рыбы', 'Час мутанта-острозуба', 'Час Небесного кита', 'Час Древнего Ящера', 'Час Ворона Смерти', 'Час Острых Клинков');
	totemtime = new Array('10','20','02','00','22','18','12','04','14','06','08','16');
    totembuff = new Array('+100кб', '+50 оружейника', '+50 странника', 'невидимость', 'тотемное нападение', '+10 удачи и +50% уловки', '+10 ловкости и +50% точности', '+50 ювы', '+15 силы и +150 массы', '+50 наблюдательности', '+50 мф сокрушения и стойкости', '+20% опыта за бой');
    thotems[17] = 'Официальный дилер';
    thotems[35] = 'Мистер m0n';
    thotems[36] = 'Глава Администрации Проекта';
    d.write('<TR><TD colspan=5><div>');
    d.write('<table cellpadding="0" cellspacing="0" border="0"><tr><td width=100%><font class=nick>'+sh_align(parseInt(arrt[6]),0)+sh_sign(arrt[7],arrt[8],arrt[9])+'<B>'+arrt[0]+'</B>'+flev+'</font></a></td><td align="right" class=nick nowrap><B><font color=#009b45>'+fust+'</font></B></td></tr><TR><TD colspan=2><img src="http://lordiswar.net/image/1x1.gif" width=1 height=5></TD></TR></table>');
    d.write('<table cellpadding="0" cellspacing="0" border="0">');
    d.write('<tr><td>' + (arrt[15] != 17 && arrt[15] != 35 && arrt[15] != 36 ? '<img src="http://lordiswar.net/image/magic/totems/t' + arrt[15] + '.gif"' : '<img src="http://lordiswar.net/image/pinfo/t' + arrt[15] + '.gif"') + ' onmouseover="tooltip(this,\'<b>' + thotems[arrt[15]] + ((totemtime[arrt[15]] && totembuff[arrt[15]]) ? '</b><br>Время действия: c ' + totemtime[arrt[15]] + '.00 до ' + (totemtime[arrt[15]] + 2) + '.00<br>Бонус во время действия: ' + totembuff[arrt[15]] : '</b>') + '\')" onmouseout="hide_info(this)" width="37" height="37" border="0"><img src="http://lordiswar.net/image/1x1.gif" width=2 height=1></td><td valign="top">');
    d.write('<div id="lines_container">');
    d.write('<div id="text"><font color="#FFFFFF"><B>'+arrt[13]+'</B></font><br><font color="#FFFFFF"><B>'+arrt[14]+'</B></font></div>');
    d.write('<div id="leftC"><img src="http://lordiswar.net/image/gameplay/fight/left.gif" width="33" height="38" border="0" class="png" style="background: url(\'http://lordiswar.net/image/gameplay/fight/left.gif\');"></div>');
    d.write('<div id="lines">');
    d.write('<table cellpadding="0" cellspacing="0" border="0"><tr><td width="1"><img src="http://lordiswar.net/image/gameplay/fight/hpbg2.gif" width="1" height="12" border="0" title=""></td><td class="hpfull" width="'+hpf+'"></td><td class="hplos" width="'+(fsize-hpf)+'"></td></tr><tr><td colspan="4" bgcolor="#FCFAF3"></td></tr></table>');				
    d.write('<table cellpadding="0" cellspacing="0" border="0"><tr><td width="1"><img src="http://lordiswar.net/image/gameplay/fight/mpbg2.gif" width="1" height="12" border="0" title=""></td><td class="mpfull" width="'+mpf+'"></td><td class="mplos" width="'+(fsize-mpf)+'"></td></tr></table>');
    d.write('</div>');
    d.write('<div id="rightC"><img src="http://lordiswar.net/image/gameplay/fight/right.gif" width="33" height="38" border="0" class="png" style="background: url(\'http://lordiswar.net/image/gameplay/fight/right.gif\');"></div>');
    d.write('</div></td></tr></table></div></TD></TR><TR><TD colspan=5><img src="http://lordiswar.net/image/1x1.gif" width=1 height=5></TD></TR>');
}

function Active(id){
	if(d.getElementById(id).bgColor == "#cc0000"){
		return true;
	}else{
		return false;
	}
}

function add_zero(str,leng){
	for(i=str.length; i<leng; i++) str = '0'+str;
	return str;
}

function status_bar(pstr,pstr1,pstr2,mode){
	if(!mode){
		maxl = pstr1.length > pstr2.length ? pstr1.length : pstr2.length;
		temp = Math.round(parseFloat(pstr));
		return '&nbsp;&nbsp;'+add_zero(temp.toString(),maxl)+'/'+add_zero(pstr1,maxl);
	}else{
		return '&nbsp;&nbsp;???/???';
	}
}

function group_private(gr_num){
	var pr_say = '';
	if(gr_num == 1){
		for(i=0; i<lives_g1.length; i++){
			if(lives_g1[i][0] == 1){
				pr_say += '%<'+lives_g1[i][1]+'> ';
			}
		}
	}else{
		for(i=0; i<lives_g2.length; i++){
			if(lives_g2[i][0] == 1){
				pr_say += '%<'+lives_g2[i][1]+'> ';
			}
		}
	}
	parent.frames['ch_buttons'].FBT.text.focus();
	parent.frames['ch_buttons'].FBT.text.value = pr_say + parent.frames['ch_buttons'].document.forms[0].text.value;
}

function var_init(v1,v2,label){
	v1 = Math.round(v1);
	v2 = Math.round(v2);
	var v = v1 + v2;
	if(v < 1){
		v = 1;
	}
	if(v1){
		return '<tr><td bgcolor=#FCFAF3 width=75% nowrap class=ftxt>&nbsp;'+label+':</td><td bgcolor=#FAFAFA nowrap class=ftxt><b>&nbsp;'+v+'</b> '+(v2 > 0 ? '('+v1+'+<font color=#cc0000>'+v2+'</font>)' : (v2 < 0 ? '('+v1+'<font color=#cc0000>'+v2+'</font>)' : ''))+'&nbsp;</td></tr>';
	}else{
		return '';
	}
}

function mf_init(mftype,mf,label){
	if(mf != 0) return '<tr><td bgcolor=#fafafa width=75% nowrap class=proce>&nbsp;'+label+':</td><td bgcolor=#D16F67 nowrap align=center class=proce><font color=#f2f2f2><b>&nbsp;'+Math.round(mf)+(mftype == 1 ? '%' : '')+'&nbsp;</b></font></td></tr>';
	else return '';
}

function view_gr(){
	d.write('<TR><TD bgcolor=#f2f2f2 align=center class=nick><a href="javascript: group_private(1)"><img src=http://lordiswar.net/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a> ');
	gr_det(lives_g1,1,1);
    d.write(' против <a href="javascript: group_private(2)"><img src=http://lordiswar.net/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a> ');
	gr_det(lives_g2,2,1);
	d.write('</TD></TR>');
}

function CreateDynamicDiv(){
	formDiv = d.createElement("div");
	formDiv.id = "dyn";
	formDiv.style.position = "absolute";
	formDiv.style.left = "26%";
	formDiv.style.right = "26%";
	formDiv.style.top = "144px";
	formDiv.style.width = "48%";
	formDiv.style.height = "90px";
	formDiv.style.zIndex = 3;
	d.body.appendChild(formDiv);
	dyn_div = 1;
}

function DynTemplate(id,num){
	switch(num){
		case 1:
			return '<TABLE cellpadding=5 cellspacing=0 border=0 width=100% height=100%><TR><TD bgcolor=#fafafa><IMG src="http://lordiswar.net/image/magic/m'+magic_in[id]+'.gif" width="44" height="44" border=0></TD><TD bgcolor=#fafafa width=100% class=nick><font color=#dd0000><B>'+pos_vars[magic_in[id]]+'</B></font><BR>';
		break;
		case 2:
			return '<BR><IMG src=http://lordiswar.net/image/1x1.gif width="1" height="5"><BR>';
		break;
	}
}

function DinamicForm(id){
	var cas=pos_type[magic_in[id]];;
	var side=fight_pm[6];
	if(cas==5){
		if(side==2){
			cas=7;
		}
	}
	if(cas==7){
		if(side==2){
			cas=5;
		}
	}
	
	switch(cas){
		case 5:
            formDiv.innerHTML = DynTemplate(id, 1) + '(Ваша команда)<br>Применить для: ' + show_g1_eff(id) + DynTemplate(id, 2) + '<input type=button value=" закрыть окно " class=fbut onclick="javascript: CloseDyn(' + id + ')"></TD></TR></TABLE>';
		break;
		case 6:
            formDiv.innerHTML = DynTemplate(id, 1) + 'Фраза: <input type=text size=60 id="tv' + id + '" class=mbox>' + DynTemplate(id, 2) + '<input type=button value=" запомнить " class=fbut onclick="javascript: SaveDyn(' + id + ',6)"> <input type=button value=" закрыть окно " class=fbut onclick="javascript: CloseDyn(' + id + ')"></TD></TR></TABLE>';
		break;
		case 7:
            formDiv.innerHTML = DynTemplate(id, 1) + '(Команда противника)<br>Применить для: ' + show_g2_eff(id) + DynTemplate(id, 2) + '<input type=button value=" закрыть окно " class=fbut onclick="javascript: CloseDyn(' + id + ')"/TD></TR></TABLE>';
		break;
	}
	for(i=0; i<4; i++){
		fight_f.elements['b'+i].style.visibility = "hidden";
		fight_f.elements['u'+i].style.visibility = "hidden";
	}
	formDiv.style.visibility = "visible";
	dyn_selected = id;
}

function show_dyn(id){
	if(!dyn_div){
		CreateDynamicDiv();
	}
	if(dyn_selected > -1){
		SetToZeroDyn();
	}else if(!Active('m'+id)){
		DinamicForm(id);
	}
	magic_slots_check('m'+id);
}

function show_g1_eff(id){
	var temp_gr = '';
	i = lives_g1.length - 1; 
	for(j=0; j<lives_g1.length; j++){
		switch(lives_g1[j][0]){
			case 1:
				temp_gr += sh_align(lives_g1[j][3])+sh_sign_s(lives_g1[j][4])+'<a href="javascript: SetParams('+j+',1);SaveDyn('+id+',5)"><font color=#0052A6><span id="sp'+j+'">'+lives_g1[j][1]+'</span></font></a>'+(j != i ? ', ' : '');
			break;
			case 3:
				temp_gr += '<b>'+lives_g1[j][1]+'</b>';
			break;
		}
	}
	return temp_gr;
}
function show_g2_eff(id){
	var temp_gr = '';
	i = lives_g2.length - 1; 
	for(j=0; j<lives_g2.length; j++){
		switch(lives_g2[j][0]){
			case 1:
				temp_gr += sh_align(lives_g2[j][3])+sh_sign_s(lives_g2[j][4])+'<a href="javascript: SetParams('+j+',2);SaveDyn('+id+',7);"><font color=#0052A6><span id="sp'+j+'">'+lives_g2[j][1]+'</span></font></a>'+(j != i ? ', ' : '');
			break;
			case 3:
				temp_gr += '<b>'+lives_g2[j][1]+'</b>';
			break;
		}
	}
	return temp_gr;
}
function SetParams(id){
	var plink;
	if(setp > -1){
		plink = d.getElementById("sp"+setp);
		plink.innerHTML = lives_g1[id][1];
	}
	if(setp != id){
		plink = d.getElementById("sp"+id);
		plink.innerHTML = '<b>'+lives_g1[id][1]+'</b>';
		setp = id;
	}
     else setp = -1;
}

function SetToZeroDyn(){
	formDiv.style.visibility = "hidden";
	dyn_selected = -1;
	setp = -1;
	for(i=0; i<4; i++){
		fight_f.elements['b'+i].style.visibility = "visible";
		fight_f.elements['u'+i].style.visibility = "visible";
	}
}

function CloseDyn(id){
	SetToZeroDyn();
	magic_slots_check('m'+id);
}

function SaveDyn(id,dynt){
	switch(dynt){
		case 5: 
			if(setp > -1){
				add_info[id] = lives_g1[setp][7];
			}else{
				magic_slots_check('m'+id);
			}
		break;
		case 6:
			var plink;
			plink = d.getElementById("tv"+id);
			if(plink.value){
				add_info[id] = text_filter(plink.value);
			}else{
				magic_slots_check('m'+id);
			}
		break;
		case 7: 
			if(setp > -1){
				add_info[id] = lives_g2[setp][7];
			}else{
				magic_slots_check('m'+id);
			}
		break;
	}
	SetToZeroDyn();
}

function text_filter(ftext){
	var WrongChar = ["'","@","`","_"]
	ftext = ftext.substring(0,150);
	for(j=0; j<4; j++){
		ftext = ftext.replace(WrongChar[j],"");
	}
	return ftext;
}
function buildMap(){
	d.getElementById('magic_clots-1').style.display = 'none';
	d.getElementById('magic_clots-2').style.display = 'none';
	d.getElementById('magic_clots-3').style.display = 'none';
	d.getElementById('magic_clots-4').style.display = 'none';
	d.getElementById('form_main').style.display = 'none';
	d.getElementById('form_map').style.display = 'block';
	var tempMap = '<table cellpadding="0" cellspacing="0" border="0" width="660" align="center">';
	for( var x = 0; x < 5; x++ ){
		tempMap += '<tr>';
		var ym = param_ow[17][0] - 5
		var yp = param_ow[17][0] + 5;
		if( ym < 0 ){
			yp = yp - ym;
			ym = 0;
		}
		
		if( yp > 14 ){
			ym = ( ym - (yp - 14));
			yp = 14;
		}
		for( var y = ym; y <= yp; y++ ){
			var friend = enemy = 0;
			tempMap += '<td background="http://lordiswar.net/image/gameplay/fight/'+map[0]+'/'+y+'_'+x+'.jpg"'+((go_no.indexOf('|'+y+'_'+x+'|')!=-1) ? ' style="opacity:0.5;"' : '' )+'>';
			for(var j = 0; j < map[1].length; j++){
				switch(map[1][j][0]){
					case 1:
						if(y == map[1][j][8] && x == map[1][j][9]){
							tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/friend.gif"'+((fight_pm[6] == 2) ? ' onclick="ShowUd('+map[1][j][2]+','+map[1][j][10]+');" style="cursor:pointer;"' : '' )+' onmouseover="tooltip(this,\'<font color=#0052A6>'+sh_align(map[1][j][3])+sh_sign_s(map[1][j][4])+'<b>'+map[1][j][1]+'</b></font> ['+map[1][j][5]+'/'+map[1][j][6]+']\')" onmouseout="hide_info(this)" width="60" height="60" />';
							friend = 1;
						}
					break;
					case 3:
						if(y == map[1][j][8] && x == map[1][j][9]){
							tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/friend.gif"'+((fight_pm[6] == 2) ? ' onclick="ShowUd('+map[1][j][2]+','+map[1][j][10]+');" style="cursor:pointer;"' : '' )+' onmouseover="tooltip(this,\'<font color=#0052A6>'+sh_align(map[1][j][3])+sh_sign_s(map[1][j][4])+'<b>'+map[1][j][1]+'</b></font> ['+map[1][j][5]+'/'+map[1][j][6]+']\')" onmouseout="hide_info(this)" width="60" height="60" />';
							friend = 1;
						}
					break;
					case 4:
						if(y == map[1][j][1] && x == map[1][j][2]){
                            tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/friend.gif"' + ((fight_pm[6] == 2) ? ' onclick="ShowUd(' + map[1][j][3] + ',' + map[1][j][4] + ');" style="cursor:pointer;"' : '') + ' onmouseover="tooltip(this,\'<font color=#0052A6><b><i>невидимка</i></b></font>\')" onmouseout="hide_info(this)" width="60" height="60" />';
							friend = 1;
						}
					break;
				}
			}
			for(var j = 0; j < map[2].length; j++){
				switch(map[2][j][0]){
					case 1:
						if(y == map[2][j][8] && x == map[2][j][9]){
							tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/enemy.gif"'+((fight_pm[6] == 1) ? ' onclick="ShowUd('+map[2][j][2]+','+map[2][j][10]+');" style="cursor:pointer;"' : '' )+' onmouseover="tooltip(this,\'<font color=#087C20>'+sh_align(map[2][j][3])+sh_sign_s(map[2][j][4])+'<b>'+map[2][j][1]+'</b></font> ['+map[2][j][5]+'/'+map[2][j][6]+']\')" onmouseout="hide_info(this)" width="60" height="60" />';
							enemy = 1;
						}
					break;
					case 3:
						if(y == map[2][j][8] && x == map[2][j][9]){
							tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/enemy.gif"'+((fight_pm[6] == 1) ? ' onclick="ShowUd('+map[2][j][2]+','+map[2][j][10]+');" style="cursor:pointer;"' : '' )+' onmouseover="tooltip(this,\'<font color=#087C20>'+sh_align(map[2][j][3])+sh_sign_s(map[2][j][4])+'<b>'+map[2][j][1]+'</b></font> ['+map[2][j][5]+'/'+map[2][j][6]+']\')" onmouseout="hide_info(this)" width="60" height="60" />';
							enemy = 1;
						}
					break;
					case 4:
						if(y == map[2][j][1] && x == map[2][j][2]){
                            tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/enemy.gif"' + ((fight_pm[6] == 1) ? ' onclick="ShowUd(' + map[2][j][3] + ',' + map[2][j][4] + ');" style="cursor:pointer;"' : '') + ' onmouseover="tooltip(this,\'<font color=#087C20><b><i>невидимка</i></b></font>\')" onmouseout="hide_info(this)" width="60" height="60" />';
							enemy = 1;
						}
					break;
				}
			}
			
			if(friend == 0 && enemy == 0){
				if( param_ow[17][1] >= x-1 && param_ow[17][1] <= x+1 && param_ow[17][0] >= y-1 && param_ow[17][0] <= y+1 ){
					if(go_no.indexOf('|'+y+'_'+x+'|') == -1){
                        tempMap += '<img src="http://lordiswar.net/image/gameplay/fight/here.gif" onclick="GoToPos(' + y + ',' + x + ');" width="60" height="60" border="0" style="cursor:pointer;" title="Перейти" alt="Перейти" />';
					}else{
                        tempMap += '<img src="http://lordiswar.net/image/1x1.gif" width="60" height="60" title="Недоступно" alt="Недоступно" />';
					}
				}else{
                    tempMap += '<img src="http://lordiswar.net/image/1x1.gif" width="60" height="60" title="Недоступно" alt="Недоступно" />';
				}
			}
			tempMap += '</td>';
		}
		tempMap += '</tr>';
	}
	tempMap += '</table>';
	d.getElementById('form_map').innerHTML = tempMap;
}
function GoToPos(x,y){
	go_place = x+'_'+y;
}

function ShowMap(){
	d.getElementById('magic_clots-1').style.display = 'none';
	d.getElementById('magic_clots-2').style.display = 'none';
	d.getElementById('magic_clots-3').style.display = 'none';
	d.getElementById('magic_clots-4').style.display = 'none';
	d.getElementById('form_main').style.display = 'none';
	d.getElementById('form_map').style.display = 'block';
}

function ShowUd(level,id){
	d.getElementById('magic_clots-1').style.display = 'block';
	d.getElementById('magic_clots-2').style.display = 'block';
	d.getElementById('magic_clots-3').style.display = 'block';
	d.getElementById('magic_clots-4').style.display = 'block';
	d.getElementById('form_main').style.display = 'block';
	d.getElementById('form_map').style.display = 'none';
	param_en[5] = level;
	fight_pm[10] = id;
}