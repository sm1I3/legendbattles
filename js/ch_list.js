document.onmousedown = t_nick;
var align_ar = ["0", "radio.gif;Dj на радио", "lights.gif;Дети Света", "sumers.gif;Дети Сумерек", "chaoss.gif;Дети Хаоса", "light.gif;Истинный Свет", "dark.gif;Истинная Тьма", "sumer.gif;Нейтральные Сумерки", "chaos.gif;Абсолютный Хаос", "angel.gif;Ангел"];
var doblest_ar = ['0;Стажер', '1;Солдaт', '2;Боeц', '3;Воин', '4;Элитный воин', '5;Чeмпион', '6;Глaдиaтор', '7;Полководeц', '8;Мaстeр войны', '9;Гeрой', '10;Военный эксперт', '11;Магистр войны', '12;Вершитель', '14;Высший магистр', '13;Повелитель'];

function t_nick ()
{
  parent.is_ctrl = window.event.ctrlKey;
  parent.is_alt = window.event.altKey;
}

admWindow = function(login){	
    parent.$('#basic-modal-content').html('<iframe src="/includes/addons/admin-action/player.php?loginp='+login+'&load=1" id="useaction" name="useaction" scrolling="auto" style="width:'+(screen.width-100)+'px;height:'+(screen.height-300)+'px;" frameborder="0"></iframe>');
    parent.ShowModal();
}

function ch_clear_ignor (nick)
{
  while (nick.indexOf ('=') >= 0) nick = nick.replace ('=', '%3D');
  while (nick.indexOf ('+') >= 0) nick = nick.replace ('+', '%2B');
  while (nick.indexOf ('#') >= 0) nick = nick.replace ('#', '%23');
  while (nick.indexOf (' ') >= 0) nick = nick.replace (' ', '%20');
  parent.frames['ch_list'].location='./ch.php?lo=1&a=ign&s=0&u='+nick;
}
  
function reverse_alpha_sort (el1,el2)
{
  if (el1>el2) { return -1 }
  else if (el1<el2) { return 1 }
  else { return 0 }
}

function qsort_str(arr,first,last) {
 if (first<last) {
  point=arr[first].split(":")[0];
  i=first;
  j=last;
  while (i<j) {
   while ((arr[i].split(":")[0]<=point) && (i<last)) i++;
   while ((arr[j].split(":")[0]>=point) && (j>first)) j--;
   if (i<j) {
    temp=arr[i];
    arr[i]=arr[j];
    arr[j]=temp;
   }
  }
  temp=arr[first];
  arr[first]=arr[j];
  arr[j]=temp;
  qsort_str(arr,first,j-1);
  qsort_str(arr,j+1,last);
 }
}

function qsort_int(arr,first,last,h) {
 if (first<last) {
  point=parseInt(arr[first].split(":")[2]);
  i=first;
  j=last;
  while (i<j) {
   while ((h*parseInt(arr[i].split(":")[2])<=h*point) && (i<last)) i++;
   while ((h*parseInt(arr[j].split(":")[2])>=h*point) && (j>first)) j--;
   if (i<j) {
    temp=arr[i];
    arr[i]=arr[j];
    arr[j]=temp;
   }
  }
  temp=arr[first];
  arr[first]=arr[j];
  arr[j]=temp;
  qsort_int(arr,first,j-1,h);
  qsort_int(arr,j+1,last,h);
 }
}

function chatlist_build (sort_type)
{
  if (sort_type=='a_z') ChatListU.sort ();
  else if (sort_type=='z_a') ChatListU.sort (reverse_alpha_sort);
  else {

   if (sort_type=='0_35') {
    qsort_int(ChatListU,0,ChatListU.length-1,1);
   }
   else if (sort_type=='35_0') {
    qsort_int(ChatListU,0,ChatListU.length-1,-1);
   }

   f=0;
   fl=parseInt(ChatListU[f].split(":")[2]);
   for (i=1;i<ChatListU.length;i++) {
    n=i;
    nl=parseInt(ChatListU[i].split(":")[2]);
    if (fl!=nl) {
     qsort_str(ChatListU,f,n-1);
     f=n;
     fl=parseInt(ChatListU[f].split(":")[2]);
    }
    if (n==ChatListU.length-1) {
     qsort_str(ChatListU,f,n);
    }
   }
  }

  var ss;
  var sleeps;
  var nn_sec;
  var str_array;
  var sign_array;
  var altadd;

  for(var cou = 0; cou < ChatListU.length; cou++)
  {
    str_array = ChatListU[cou].split(":");

    var ss='';
    var sleeps='';
    var altadd='';
    var ign = '';
    var inj = '';
    var psg = '';
    var align = '';
		var doblest = '';

    nn_sec = str_array[1];
    var login = str_array[1];
    while (nn_sec.indexOf('+')>=0) nn_sec = nn_sec.replace('+','%2B');
    if (login.indexOf ('<i>') > -1)
    {
      login = login.replace ('<i>', '');
      login = login.replace ('</i>', '');
      nn_sec = nn_sec.replace ('<i>', '');
      nn_sec = nn_sec.replace ('</i>', '');
    }

    if (str_array[3].length>1)
    {
      sign_array = str_array[3].split(";");
      if(sign_array[2].length>1)
        altadd=" ("+sign_array[2]+")";
      ss = "<img src=http://img.legendbattles.ru/image/signs/"+sign_array[0]+" width=15 height=12 align=absmiddle title=\""+sign_array[1]+altadd+"\">&nbsp;";
    }
	//
    if(str_array[4]!='0'){ var molch,minut,hour,sec; molch='';
	hour=parseInt(str_array[4]/3600);minut=parseInt((str_array[4]-(hour*3600))/60); sec=str_array[4]-((hour*3600)+(minut*60));
        if (hour > 0) molch = hour + " ч. ";
        if (minut > 0) molch += minut + " мин. и ";
        molch += sec + " сек.";
        sleeps = "<img src=http://img.legendbattles.ru/image/signs/molch.gif width=10 height=10 border=0 title=\"Персонаж будет молчать еще " + molch + "\" align=absmiddle>";
    }
    if (str_array[5] == '1')
        ign = "<a href=\"javascript:ch_clear_ignor('" + login + "');\"><img src=http://img.legendbattles.ru/image/signs/ignor/3.gif width=15 height=12 border=0 title=\"Снять игнорирование\"></a>";
    if (str_array[6] != '0')
      inj = "<img src=http://img.legendbattles.ru/image/chat/tr4.gif width=10 height=10 border=0 title=\""+str_array[6]+"\" align=absmiddle>";

     if (str_array[7] != '0')
     {
         var dilers = new Array('', 'Дилер', 'Дилер', '', '', '', '', '', '', '', '', 'Помощник дилера');
       psg = "<img src=http://img.legendbattles.ru/image/signs/d_sm_"+str_array[7]+".gif width=15 height=12 align=absmiddle border=0 title=\""+dilers[str_array[7]]+"\">&nbsp;";
     }
     if (str_array[8] != '')
     { 
       sign_array = align_ar[str_array[8]].split(";");
       if(sign_array==0){align = "<img src=http://img.legendbattles.ru/image/signs/1x1.gif width=15 height=12 align=absmiddle border=0 >";}else{
	   align = "<img src=http://img.legendbattles.ru/image/signs/"+sign_array[0]+" width=15 height=12 align=absmiddle border=0 title=\""+sign_array[1]+"\">";}
     }
		 if (str_array[9] != '')
     { 
		 doblest_array = doblest_ar[str_array[13]].split(";");
	   doblest = "<img src=http://img.legendbattles.ru/image/signs/rank/rank"+doblest_array[0]+".gif width=15 height=12 align=absmiddle border=0 title=\""+doblest_array[1]+"\">";
     }
     else if (str_array[7] == '')
     align = "<img src=http://img.legendbattles.ru/image/1x1.gif width=16 height=16 align=absmiddle border=0 title=\"\">&nbsp";
     lvl_array = str_array[2].split(";");
      document.write("<img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=0><a href=\"javascript:parent.say_private('" + login + "')\"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;" + psg + " <a href=\"/clan_info.php?" + nn_sec + "\" target=_blank>" + align + ss + doblest + "<a href=\"javascript:parent.say_to('" + login + "')\"><font class=nickname " + (str_array[14] ? 'style="color : #' + str_array[14] + '; font-size : 12px;"' : '') + "><b>" + str_array[1] + "</b></a></font><font class=nickname>[" + lvl_array[0] + "]</font> " + ((str_array[12] > 0) ? '<img src=http://w1.dwar.ru/images/axe.png width=11 height=12 border=0 title="Палач ' + str_array[12] + ' ур." align=absmiddle>' : '') + "" + ((str_array[10] > 0) ? '<img src=http://img.legendbattles.ru/image/signs/key_quest.png width=11 height=12 border=0 title="Взломщик ' + str_array[10] + ' ур." align=absmiddle>' : '') + "" + (str_array[11] != 'не женат' && str_array[11] != 'не замужем' && str_array[11] != '' ? '<img src=http://img.legendbattles.ru/image/rings.gif width=11 height=12 border=0 title="На ' + str_array[11] + '" align=absmiddle>' : '') + " <a href=\"/ipers.php?" + nn_sec + "\" target=_blank><img src=http://img.legendbattles.ru/image/chat/info" + (str_array[9] == '4' ? '1' : '') + ".gif width=11 height=12 border=0 align=absmiddle></a>" + sleeps + "&nbsp;" + ign + "&nbsp;" + inj + "&nbsp;" + "<br><img border=0 width=90%  height=1 src=http://img.legendbattles.ru/image/1x1_2.gif><br />");
  }
}