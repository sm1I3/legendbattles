
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
 d.write('<tr><td bgcolor=#F5F5F5><div align=center><img src=image/weapon/'+inv[i][8]+' border=0><br><img src=http://img.legendbattles.ru/image/1x1.gif width=62 height=1><br><img src=http://img.legendbattles.ru/image/solidst.gif width='+izn+' height=2 border=0 title="�������������: '+iz+'/'+inv[i][4]+'"><img src=http://img.legendbattles.ru/image/nosolidst.gif width='+pro+' height=2 border=0 title="�������������: '+iz+'/'+inv[i][4]+'"></div></td><td width=100% bgcolor=#FFFFFF valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF width=100%><div id=but'+i+'><div><td valign=center><div id=del'+i+'></div>');

d.write('<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>��������</font></div></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=16></td><td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#000000>����������</font></div></td></tr><tr><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#FCFAF3 width=50%><font class=nickname><b>'+inv[i][9]+'</b><br>');
if(inv[i][20]==16) d.write('<font class=weaponch><b><font color=#cc0000>����� ������� �� ��������</font></b><br>');
blocks(inv[i][10]);
if(inv[i][5]!=0)d.write('<font class=weaponch>����: <b>'+inv[i][5]+' LR</b><br>');
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
if(bt==0 && inv[i][20]!=0){but+='<input type=button class=invbut onclick="location=\'main.php?post_id=57&act=1&wid='+inv[i][0]+'&vcode='+inv[i][19]+'\'" value="������"/> ';}

if(inv[0][3]==1 && inv[0][4]==0){but+='<input type=button class=invbut onclick="javascript: if(confirm(\'�� ����� ������ ������� <'+inv[i][9]+'> �� '+price+' LR?\')) { location=\'main.php?post_id=8&uid='+inv[i][0]+'&wpr='+inv[i][5]+'&sum='+price+'&vcode='+inv[i][19]+'&wcs='+inv[i][3]+'&wms='+inv[i][4]+'&wn='+inv[i][9]+'&prot='+inv[i][1]+'\' }" value="������� �� '+price+' LR"> ';}

if(bt==0 && inv[i][14]!=0){but+='<input type=button class=invbut onclick="'+inv[i][9]+'(\''+inv[i][0]+'\',\''+login+'\',\''+inv[i][9]+'\',\''+inv[i][19]+'\')" value="������������"> ';}

if(inv[i][7]=='' && inv[0][4]==0){but+='<input type=button class=invbut onClick="transferform(\''+inv[i][0]+'\',\'0\',\''+inv[i][9]+'\',\''+inv[i][19]+'\',\''+inv[i][5]+'\',\'10\',\'60\',\'60\')" value="��������"> <input type=button class=invbut onClick="presentform(\''+inv[i][0]+'\',\''+inv[i][9]+'\',\''+inv[i][19]+'\',\'10\',\''+inv[i][5]+'\',\'0\',\'0\')" value="��������"> <input type=button class=invbut onclick="sellingform(\''+inv[i][0]+'\',\''+inv[i][9]+'\',\''+inv[i][19]+'\',\''+inv[i][5]+'\',\''+inv[i][18]+'\',\''+inv[0][1]+'\')" value="�������">';}
but+='<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td>';
document.all("but"+i+"").innerHTML=but;
if(inv[0][4]==0){document.all("del"+i+"").innerHTML='<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javascript: if(top.DeleteTrue(\''+inv[i][9]+'\')) { location=\'main.php?post_id=50&uid='+inv[i][2]+'&wpr=359&wmas=10&wcs=60&wms=60&vcode='+inv[i][19]+'&wn='+inv[i][0]+'\' }" value="x" >';}
}}

function blocks(bl){
	if(bl!="") {
	switch(bl)
       	{
            case 40: d.write('<font class=weaponch><b><font color=#cc0000>���������� 1-�� �����</font></b><br>'); break;
            case 70: d.write('<font class=weaponch><b><font color=#cc0000>���������� 2-� �����</font></b><br>'); break;
	    	case 90: d.write('<font class=weaponch><b><font color=#cc0000>���������� 3-� �����</font></b><br>'); break;
    	}      }   }
		
function nd(v){
switch(v[0])
{
case 28: d.write("���� ��������: <b>"+v[1]+"</b><br>");break;
case 30: d.write("C���: <b>"+v[1]+"</b><br>");break;
case 31: d.write("��������: <b>"+v[1]+"</b><br>");break;
case 32: d.write("�����: <b>"+v[1]+"</b><br>");break;
case 33: d.write("��������: <b>"+v[1]+"</b><br>");break;
case 34: d.write("������: <b>"+v[1]+"</b><br>");break;
case 35: d.write("��������: <b>"+v[1]+"</b><br>");break;
case 36: d.write("�������� ������: <b>"+v[1]+"</b><br>");break;
case 37: d.write("�������� ��������: <b>"+v[1]+"</b><br>");break;
case 38: d.write("�������� �������� �������: <b>"+v[1]+"</b><br>");break;
case 39: d.write("�������� ������: <b>"+v[1]+"</b><br>");break;
case 40: d.write("�������� ����������� �������: <b>"+v[1]+"</b><br>");break;
case 41: d.write("�������� ���������� � �������: <b>"+v[1]+"</b><br>");break;
case 42: d.write("�������� ��������: <b>"+v[1]+"</b><br>");break;
case 43: d.write("�������� ������������ �������: <b>"+v[1]+"</b><br>");break;
case 44: d.write("�������� ��������� �������: <b>"+v[1]+"</b><br>");break;
case 45: d.write("����� ����: <b>"+v[1]+"</b><br>");break;
case 46: d.write("����� ����: <b>"+v[1]+"</b><br>");break;
case 47: d.write("����� �������: <b>"+v[1]+"</b><br>");break;
case 48: d.write("����� �����: <b>"+v[1]+"</b><br>");break;
case 53: d.write("���������: <b>"+v[1]+"</b><br>");break;
case 54: d.write("������������: <b>"+v[1]+"</b><br>");break;
case 55: d.write("����������: <b>"+v[1]+"</b><br>");break;
case 56: d.write("����������������: <b>"+v[1]+"</b><br>");break;
case 57: d.write("��������: <b>"+v[1]+"</b><br>");break;
case 58: d.write("��������: <b>"+v[1]+"</b><br>");break;
case 59: d.write("�������: <b>"+v[1]+"</b><br>");break;
case 60: d.write("�������: <b>"+v[1]+"</b><br>");break;
case 61: d.write("��������� ����: <b>"+v[1]+"</b><br>");break;
case 62: d.write("�����������: <b>"+v[1]+"</b><br>");break;
case 63: d.write("���������: <b>"+v[1]+"</b><br>");break;
case 64: d.write("������: <b>"+v[1]+"</b><br>");break;
case 65: d.write("�����������: <b>"+v[1]+"</b><br>");break;
case 66: d.write("������� �������������� ����: <b>"+v[1]+"</b><br>");break;
case 67: d.write("���������: <b>"+v[1]+"</b><br>");break;
case 68: d.write("�������: <b>"+v[1]+"</b><br>");break;
case 69: d.write("�������� ������� ����: <b>"+v[1]+"</b><br>");break;
case 70: d.write("������������: <b>"+v[1]+"</b><br>");break;
case 71: d.write("�����: <b>"+v[1]+"</b><br>");break;
case 72: d.write("�������: <b>"+v[1]+"</b><br>");break;
}}
		
function stat(v){

if(v[1]>0){plus = "+";}else{plus ="";}
switch(v[0])
{
case 0: temp = '����������: <b>'+v[1]+'</b><br>'; break;
case 1: temp = '����: <b>'+v[1]+'</b><br>';break;
case 2: temp = '�������������: <b>'+v[1]+'</b><br>';break;
case 3: temp = '��������: <b>'+v[1]+'</b><br>';break;
case 4: temp = '��������: <b>'+v[1]+'</b><br>';break;
case 5: temp = '������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 6: temp = '��������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 7: temp = '����������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 8: temp = '���������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 9: temp = '����� �����: <b>'+v[1]+'</b><br>';break;
case 10: temp = '������ �����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 11: temp = '������ ������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 12: temp = '������ ������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 13: temp = '������ ����������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 14: temp = '������ ����������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 15: temp = '������ ������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 16: temp = '������ �������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 17: temp = '������ ���������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 18: temp = '������ �������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 19: temp = '������ �� ������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 20: temp = '������ �� ������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 21: temp = '������ �� ����������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 22: temp = '������ �� ����������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 23: temp = '������ �� ������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 24: temp = '������ �� �������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 25: temp = '������ �� ���������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 26: temp = '������ �� �������� ������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 27: temp = '��: '+plus+'<b>'+v[1]+'</b><br>';break;
case 28: temp = '���� ��������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 29: temp = '����: '+plus+'<b>'+v[1]+'</b><br>';break;
case 30: temp = 'C���: '+plus+'<b>'+v[1]+'</b><br>';break;
case 31: temp = '��������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 32: temp = '�����: '+plus+'<b>'+v[1]+'</b><br>';break;
case 33: temp = '��������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 34: temp = '������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 35: temp = '��������: '+plus+'<b>'+v[1]+'</b><br>';break;
case 36: temp = '�������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 37: temp = '�������� ��������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 38: temp = '�������� �������� �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 39: temp = '�������� ������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 40: temp = '�������� ����������� �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 41: temp = '�������� ���������� � �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 42: temp = '�������� ��������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 43: temp = '�������� ������������ �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 44: temp = '�������� ��������� �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 45: temp = '����� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 46: temp = '����� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 47: temp = '����� �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 48: temp = '����� �����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 49: temp = '������������� ����� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 50: temp = '������������� ����� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 51: temp = '������������� ����� �������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 52: temp = '������������� ����� �����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 53: temp = '���������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 54: temp = '������������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 55: temp = '����������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 56: temp = '����������������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 57: temp = '��������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 58: temp = '��������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 59: temp = '�������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 60: temp = '�������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 61: temp = '��������� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 62: temp = '�����������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 63: temp = '���������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 64: temp = '������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 65: temp = '�����������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 66: temp = '������� �������������� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 67: temp = '���������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 68: temp = '�������: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 69: temp = '�������� ������� ����: '+plus+'<b>'+v[1]+'%</b><br>';break;
case 70: temp = '������������: '+plus+'<b>'+v[1]+'%</b><br>';break;
}
return temp;
}