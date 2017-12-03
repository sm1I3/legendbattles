
d = document;
function items(){
var login=inv[0][0];
for(i=2; i<inv.length; i++)
     {//d.write(inv[i][0]);
	 var iz=(inv[i][4]-inv[i][3]);
	 var izn = Math.round((iz/(inv[i][4]/100))*0.62); 
	 var pro = 62-izn;
	 var par = inv[i][12].split("|");
     var need = inv[i][13].split("|");
	 var licen = 0.6;
	 if(inv[i][7]!=''){licen=0.4;}
	price=Math.round(((inv[i][5]*licen)/inv[i][4])*iz);
         d.write('<tr><td bgcolor=#F5F5F5><div align=center><img src=image/weapon/' + inv[i][8] + ' border=0><br><img src=http://img.legendbattles.ru/image/1x1.gif width=62 height=1><br><img src=http://img.legendbattles.ru/image/solidst.gif width=' + izn + ' height=2 border=0 title="Долговечность: ' + iz + '/' + inv[i][4] + '"><img src=http://img.legendbattles.ru/image/nosolidst.gif width=' + pro + ' height=2 border=0 title="Долговечность: ' + iz + '/' + inv[i][4] + '"></div></td><td width=100% bgcolor=#FFFFFF valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF width=100%><div id=but' + i + '><div><td valign=center><div id=del' + i + '></div>');

         d.write('<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>свойства</font></div></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=16></td><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>требования</font></div></td></tr><tr><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#FCFAF3 width=50%><font class=nickname><b>' + inv[i][9] + '</b><br>');
         if (inv[i][20] == 16) d.write('<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>');
blocks(inv[i][10]);
         if (inv[i][5] != 0) d.write('<font class=weaponch>Цена: <b>' + inv[i][5] + ' LR</b><br>');
for(pr=0; pr<par.length; pr++){
st=par[pr].split("@");
st[0]=Math.round(st[0]);
if(st[0]==2)st[1]=iz+'/'+inv[i][4];
d.write(stat(st));
}
d.write('</td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#FCFAF3 width=50%><font class=weaponch>');
var bt=0;
for(pr=0; pr<need.length; pr++){
st=need[pr].split("@");
st[0]=Math.round(st[0]);
if(st[0]==72)st[1]=inv[i][17];
if(st[0]==71){st[1]=inv[i][18];if(inv[0][2]<st[1]){st[1]="<font color=#cc0000>"+st[1]+"</font>";}}
if(st[0]!=28){if(inv[1][st[0]]<st[1]){st[1]="<font color=#cc0000>"+st[1]+"</font>";bt+=1;}}
nd(st);}
d.write('</font></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td></tr></table></td></tr></table></td></tr>');
var but=' ';
         if (bt == 0 && inv[i][20] != 0) {
             but += '<input type=button class=invbut onclick="location=\'main.php?post_id=57&act=1&wid=' + inv[i][0] + '&vcode=' + inv[i][19] + '\'" value="Надеть"/> ';
         }

         if (inv[0][3] == 1 && inv[0][4] == 0) {
             but += '<input type=button class=invbut onclick="javascript: if(confirm(\'Вы точно хотите продать <' + inv[i][9] + '> за ' + price + ' LR?\')) { location=\'main.php?post_id=8&uid=' + inv[i][0] + '&wpr=' + inv[i][5] + '&sum=' + price + '&vcode=' + inv[i][19] + '&wcs=' + inv[i][3] + '&wms=' + inv[i][4] + '&wn=' + inv[i][9] + '&prot=' + inv[i][1] + '\' }" value="Продать за ' + price + ' LR"> ';
         }

         if (bt == 0 && inv[i][14] != 0) {
             but += '<input type=button class=invbut onclick="' + inv[i][9] + '(\'' + inv[i][0] + '\',\'' + login + '\',\'' + inv[i][9] + '\',\'' + inv[i][19] + '\')" value="Использовать"> ';
         }

         if (inv[i][7] == '' && inv[0][4] == 0) {
             but += '<input type=button class=invbut onClick="transferform(\'' + inv[i][0] + '\',\'0\',\'' + inv[i][9] + '\',\'' + inv[i][19] + '\',\'' + inv[i][5] + '\',\'10\',\'60\',\'60\')" value="Передать"> <input type=button class=invbut onClick="presentform(\'' + inv[i][0] + '\',\'' + inv[i][9] + '\',\'' + inv[i][19] + '\',\'10\',\'' + inv[i][5] + '\',\'0\',\'0\')" value="Подарить"> <input type=button class=invbut onclick="sellingform(\'' + inv[i][0] + '\',\'' + inv[i][9] + '\',\'' + inv[i][19] + '\',\'' + inv[i][5] + '\',\'' + inv[i][18] + '\',\'' + inv[0][1] + '\')" value="Продать">';
         }
but+='<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td>';
document.all("but"+i+"").innerHTML=but;
if(inv[0][4]==0){document.all("del"+i+"").innerHTML='<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javascript: if(top.DeleteTrue(\''+inv[i][9]+'\')) { location=\'main.php?post_id=50&uid='+inv[i][2]+'&wpr=359&wmas=10&wcs=60&wms=60&vcode='+inv[i][19]+'&wn='+inv[i][0]+'\' }" value="x" >';}
}}

function blocks(bl){
	if(bl!="") {
	switch(bl)
       	{
        case 40:
            d.write('<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>');
            break;
        case 70:
            d.write('<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>');
            break;
        case 90:
            d.write('<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>');
            break;
    	}      }   }
		
function nd(v){
switch(v[0])
{
    case 28:
        d.write("Очки действия: <b>" + v[1] + "</b><br>");
        break;
    case 30:
        d.write("Cила: <b>" + v[1] + "</b><br>");
        break;
    case 31:
        d.write("Ловкость: <b>" + v[1] + "</b><br>");
        break;
    case 32:
        d.write("Удача: <b>" + v[1] + "</b><br>");
        break;
    case 33:
        d.write("Здоровье: <b>" + v[1] + "</b><br>");
        break;
    case 34:
        d.write("Знания: <b>" + v[1] + "</b><br>");
        break;
    case 35:
        d.write("Сноровка: <b>" + v[1] + "</b><br>");
        break;
    case 36:
        d.write("Владение мечами: <b>" + v[1] + "</b><br>");
        break;
    case 37:
        d.write("Владение топорами: <b>" + v[1] + "</b><br>");
        break;
    case 38:
        d.write("Владение дробящим оружием: <b>" + v[1] + "</b><br>");
        break;
    case 39:
        d.write("Владение ножами: <b>" + v[1] + "</b><br>");
        break;
    case 40:
        d.write("Владение метательным оружием: <b>" + v[1] + "</b><br>");
        break;
    case 41:
        d.write("Владение алебардами и копьями: <b>" + v[1] + "</b><br>");
        break;
    case 42:
        d.write("Владение посохами: <b>" + v[1] + "</b><br>");
        break;
    case 43:
        d.write("Владение экзотическим оружием: <b>" + v[1] + "</b><br>");
        break;
    case 44:
        d.write("Владение двуручным оружием: <b>" + v[1] + "</b><br>");
        break;
    case 45:
        d.write("Магия огня: <b>" + v[1] + "</b><br>");
        break;
    case 46:
        d.write("Магия воды: <b>" + v[1] + "</b><br>");
        break;
    case 47:
        d.write("Магия воздуха: <b>" + v[1] + "</b><br>");
        break;
    case 48:
        d.write("Магия земли: <b>" + v[1] + "</b><br>");
        break;
    case 53:
        d.write("Воровство: <b>" + v[1] + "</b><br>");
        break;
    case 54:
        d.write("Осторожность: <b>" + v[1] + "</b><br>");
        break;
    case 55:
        d.write("Скрытность: <b>" + v[1] + "</b><br>");
        break;
    case 56:
        d.write("Наблюдательность: <b>" + v[1] + "</b><br>");
        break;
    case 57:
        d.write("Торговля: <b>" + v[1] + "</b><br>");
        break;
    case 58:
        d.write("Странник: <b>" + v[1] + "</b><br>");
        break;
    case 59:
        d.write("Рыболов: <b>" + v[1] + "</b><br>");
        break;
    case 60:
        d.write("Лесоруб: <b>" + v[1] + "</b><br>");
        break;
    case 61:
        d.write("Ювелирное дело: <b>" + v[1] + "</b><br>");
        break;
    case 62:
        d.write("Самолечение: <b>" + v[1] + "</b><br>");
        break;
    case 63:
        d.write("Оружейник: <b>" + v[1] + "</b><br>");
        break;
    case 64:
        d.write("Доктор: <b>" + v[1] + "</b><br>");
        break;
    case 65:
        d.write("Самолечение: <b>" + v[1] + "</b><br>");
        break;
    case 66:
        d.write("Быстрое восстановление маны: <b>" + v[1] + "</b><br>");
        break;
    case 67:
        d.write("Лидерство: <b>" + v[1] + "</b><br>");
        break;
    case 68:
        d.write("Алхимия: <b>" + v[1] + "</b><br>");
        break;
    case 69:
        d.write("Развитие горного дела: <b>" + v[1] + "</b><br>");
        break;
    case 70:
        d.write("Травничество: <b>" + v[1] + "</b><br>");
        break;
    case 71:
        d.write("Масса: <b>" + v[1] + "</b><br>");
        break;
    case 72:
        d.write("Уровень: <b>" + v[1] + "</b><br>");
        break;
}}
		
function stat(v){

if(v[1]>0){plus = "+";}else{plus ="";}
switch(v[0])
{
    case 0:
        temp = 'Гравировка: <b>' + v[1] + '</b><br>';
        break;
    case 1:
        temp = 'Удар: <b>' + v[1] + '</b><br>';
        break;
    case 2:
        temp = 'Долговечность: <b>' + v[1] + '</b><br>';
        break;
    case 3:
        temp = 'Карманов: <b>' + v[1] + '</b><br>';
        break;
    case 4:
        temp = 'Материал: <b>' + v[1] + '</b><br>';
        break;
    case 5:
        temp = 'Уловка: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 6:
        temp = 'Точность: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 7:
        temp = 'Сокрушение: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 8:
        temp = 'Стойкость: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 9:
        temp = 'Класс брони: <b>' + v[1] + '</b><br>';
        break;
    case 10:
        temp = 'Пробой брони: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 11:
        temp = 'Пробой колющим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 12:
        temp = 'Пробой режущим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 13:
        temp = 'Пробой проникающим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 14:
        temp = 'Пробой пробивающим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 15:
        temp = 'Пробой рубящим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 16:
        temp = 'Пробой карающим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 17:
        temp = 'Пробой отсекающим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 18:
        temp = 'Пробой дробящим ударом: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 19:
        temp = 'Защита от колющих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 20:
        temp = 'Защита от режущих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 21:
        temp = 'Защита от проникающих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 22:
        temp = 'Защита от пробивающих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 23:
        temp = 'Защита от рубящих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 24:
        temp = 'Защита от карающих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 25:
        temp = 'Защита от отсекающих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 26:
        temp = 'Защита от дробящих ударов: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 27:
        temp = 'НР: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 28:
        temp = 'Очки действия: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 29:
        temp = 'Мана: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 30:
        temp = 'Cила: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 31:
        temp = 'Ловкость: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 32:
        temp = 'Удача: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 33:
        temp = 'Здоровье: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 34:
        temp = 'Знания: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 35:
        temp = 'Сноровка: ' + plus + '<b>' + v[1] + '</b><br>';
        break;
    case 36:
        temp = 'Владение мечами: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 37:
        temp = 'Владение топорами: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 38:
        temp = 'Владение дробящим оружием: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 39:
        temp = 'Владение ножами: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 40:
        temp = 'Владение метательным оружием: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 41:
        temp = 'Владение алебардами и копьями: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 42:
        temp = 'Владение посохами: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 43:
        temp = 'Владение экзотическим оружием: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 44:
        temp = 'Владение двуручным оружием: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 45:
        temp = 'Магия огня: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 46:
        temp = 'Магия воды: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 47:
        temp = 'Магия воздуха: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 48:
        temp = 'Магия земли: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 49:
        temp = 'Сопротивление магии огня: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 50:
        temp = 'Сопротивление магии воды: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 51:
        temp = 'Сопротивление магии воздуха: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 52:
        temp = 'Сопротивление магии земли: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 53:
        temp = 'Воровство: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 54:
        temp = 'Осторожность: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 55:
        temp = 'Скрытность: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 56:
        temp = 'Наблюдательность: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 57:
        temp = 'Торговля: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 58:
        temp = 'Странник: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 59:
        temp = 'Рыболов: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 60:
        temp = 'Лесоруб: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 61:
        temp = 'Ювелирное дело: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 62:
        temp = 'Самолечение: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 63:
        temp = 'Оружейник: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 64:
        temp = 'Доктор: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 65:
        temp = 'Самолечение: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 66:
        temp = 'Быстрое восстановление маны: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 67:
        temp = 'Лидерство: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 68:
        temp = 'Алхимия: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 69:
        temp = 'Развитие горного дела: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
    case 70:
        temp = 'Травничество: ' + plus + '<b>' + v[1] + '%</b><br>';
        break;
}
return temp;
}