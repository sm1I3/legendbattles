var fr_size = 240;
var is_ctrl = 0;
var is_alt = 0;
var ChatTimerID = -1;
var ChatDelay = 12;
var ChatFyo = 0;
var lmid = -1;
var latrus = 0;
var OnlineDelay = 60;
var OnlineTimerOn = -1;
var OnlineStop = 1;
var OnlineScrollPosition = 0;
var ChatClearTimerID = -1;
var ChatClearDelay = 600;
var ChatClearSize = 12228;

function change_chatsize(side)
{
       if(side == 1) fr_size += 60;
       else if(side == 0)
       {
              fr_size -= 60;
    	      if(fr_size < 0) fr_size = 0;
       }
       document.all("mainframes").rows = "*,20,1,"+fr_size+",1,52,0";
}

function say_to(login)
{
       var actionlog = parent.frames['main_top'].ActionFormUse;
       if((actionlog != null) && (actionlog != ""))
       {
              var login2 = login.replace('%','');
	      parent.frames['main_top'].document.all(actionlog).value = login2;
	      parent.frames['main_top'].document.all(actionlog).focus();
       }
       else
       {
              if(is_ctrl)
  	      {
    	             while(login.indexOf(' ') >=0) login = login.replace (' ', '%20');
    		     while(login.indexOf('+') >=0) login = login.replace ('+', '%2B');
    		     while(login.indexOf('#') >=0) login = login.replace ('#', '%23');
    		     while(login.indexOf('=') >=0) login = login.replace ('=', '%3D');
    		     window.open('./ipers.php?'+login, '_blank');
              }
  	      else if(is_alt && (login.indexOf ('%') < 0))
  	      {
    	             parent.frames['ch_buttons'].document.FBT.text.focus ();
    		     if(parent.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     parent.frames['ch_buttons'].document.FBT.text.value = '%<'+login+'> ' + parent.frames['ch_buttons'].document.FBT.text.value;
              }
  	      else
  	      {
    	             parent.frames['ch_buttons'].document.FBT.text.focus ();
    		     if(parent.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     parent.frames['ch_buttons'].document.FBT.text.value = '<'+login+'> '+parent.frames['ch_buttons'].document.FBT.text.value;
              }
       }
}

function say_private(login)
{
       var actionlog = parent.frames['main_top'].ActionFormUse;
       if((actionlog != null) && (actionlog != ""))
       {
              var login2 = login.replace('%','');
	      parent.frames['main_top'].document.all(actionlog).value=login2;
	      parent.frames['main_top'].document.all(actionlog).focus();
       }
       else
       {
              if(is_ctrl)
  	      {
    	             while(login.indexOf(' ') >=0) login = login.replace (' ', '%20');
    		     while(login.indexOf('+') >=0) login = login.replace ('+', '%2B');
    		     while(login.indexOf('#') >=0) login = login.replace ('#', '%23');
    		     while(login.indexOf('=') >=0) login = login.replace ('=', '%3D');
    		     window.open('./ipers.php?'+login, '_blank');
              }
  	      else
  	      {
    	             parent.frames['ch_buttons'].document.FBT.text.focus();
    		     if(parent.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     parent.frames['ch_buttons'].document.FBT.text.value = '%<'+login+'> ' + parent.frames['ch_buttons'].document.FBT.text.value;
              }
       }
}

function ch_refresh_a()
{
       if(ChatFyo == 2) parent.frames['ch_refr'].location='./ch.php?show=1&fyo=2';
}

function ch_refresh()
{
       if(ChatTimerID >= 0) clearTimeout(ChatTimerID);
       ChatTimerID = setTimeout('ch_refresh()', ChatDelay*1000);
       parent.frames['ch_refr'].location='./ch.php?'+Math.random()+'&show=1&fyo='+ChatFyo;
}

function ch_stop_refresh()
{
       if(ChatTimerID >= 0) clearTimeout (ChatTimerID);
       ChatTimerID = -1;
}

function ch_refresh_n()
{
       if(ChatTimerID >= 0) clearTimeout (ChatTimerID);
       ChatTimerID = setTimeout('ch_refresh()', ChatDelay*1000);
}

function set_lmid(nlmid)
{
       if(nlmid == '')
       nlmid = -1;
       var fb = parent.frames['ch_buttons'].document.FBT;
       if(fb)
       {
              lmid = nlmid;
    	      fb.lmid.value = nlmid;
       }
}

function save_scroll_p()
{
       OnlineScrollPosition = parent.frames['ch_list'].document.body.scrollTop;
}
  
function reload(now)
{
       if(!OnlineStop && (OnlineTimerOn < 0 || now))
       {
              var tm = now ? 2000 : OnlineDelay*1000;
    	      OnlineTimerOn = setTimeout('online_reload('+now+')', tm);
       }
}

function online_reload(now)
{
       if(OnlineTimerOn >= 0)
       {
              clearTimeout(OnlineTimerOn);
    	      if(!OnlineStop) OnlineTimerOn = setTimeout ('online_reload(0)', OnlineDelay * 1000);
    	      else OnlineTimerOn = -1;
       }
       if(!OnlineStop || now) parent.frames['ch_list'].location = './ch.php?lo=1';
}

function ch_refresh_clr()
{
       if(ChatClearTimerID >= 0) clearTimeout(ChatClearTimerID);
       ChatClearTimerID = setTimeout ('ch_refresh_clr()', ChatClearDelay*1000);
       var s = parent.frames['chmain'].document.all('msg').innerHTML;
       if(s.length > ChatClearSize)
       {
              var j = s.lastIndexOf('<BR>', s.length - ChatClearSize);
    	      parent.frames['chmain'].document.all('msg').innerHTML = s.substring(j, s.length);
       }
}

function clr_input()
{
       if(parent.frames["ch_buttons"].document.FBT.pactiondo.checked == true) parent.frames["ch_buttons"].document.FBT.pactiondo.checked = false;
       if(parent.frames["ch_buttons"].document.FBT.text)
       {
              parent.frames["ch_buttons"].document.FBT.text.value = '';
   	      parent.frames["ch_buttons"].document.FBT.text.focus();
       }
}

function clr_chat()
{
       if(parent.frames['chmain'].document.all('msg'))
       {
          parent.frames['chmain'].document.all('msg').innerHTML = '';
   	      parent.frames["ch_buttons"].document.FBT.text.focus();
       }
	   if(parent.frames['chmain'].document.all('msg_trade'))
       {
          parent.frames['chmain'].document.all('msg_trade').innerHTML = '';
   	      parent.frames["ch_buttons"].document.FBT.text.focus();
       }
}

function change_chatsetup()
{
       if(ChatFyo == 0)
       {
          ChatFyo = 1;
   	      parent.frames['ch_buttons'].document.FBT.fyo.value = 1;
   	      parent.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_me.gif';
           parent.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Показывать только личные сообщения)';
           parent.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Показывать только личные сообщения)';
       }
       else if(ChatFyo == 1)
       {
              ChatFyo = 2;
   	      parent.frames['ch_buttons'].document.FBT.fyo.value = 2;
    	      ch_stop_refresh();
    	      parent.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_none.gif';
           parent.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Не показывать сообщения)';
           parent.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Не показывать сообщения)';
       }
       else
       {
              ChatFyo = 0;
    	      parent.frames['ch_buttons'].document.FBT.fyo.value = 0;
    	      ch_refresh();
    	      parent.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_all.gif';
           parent.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Показывать все сообщения)';
           parent.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Показывать все сообщения)';
       }
}

function change_chatspeed()
{
       if(ChatTimerID >= 0) clearTimeout (ChatTimerID);
       if(ChatDelay == 10) ChatDelay = 30;
       else if(ChatDelay == 30) ChatDelay = 60;
       else ChatDelay = 10;
       ChatTimerID = setTimeout('ch_refresh()', ChatDelay*1000);
       parent.frames['ch_buttons'].document.FBT.spchat.src = 'http://img.legendbattles.ru/image/chat/bb_'+ChatDelay+'.gif';
    parent.frames['ch_buttons'].document.FBT.spchat.alt = 'Скорость обновления (раз в ' + ChatDelay + ' секунд)';
}

function change_latrus()
{
       if(latrus == 0)
       {
              latrus = 1;
    	      parent.frames['ch_buttons'].document.FBT.lrchat.src = 'http://img.legendbattles.ru/image/chat/bb4_ac.gif';
           parent.frames['ch_buttons'].document.FBT.lrchat.alt = 'LAT <-> RUS (Транслит включён)';
       }
       else
       {
              latrus = 0;
       	      parent.frames['ch_buttons'].document.FBT.lrchat.src = 'http://img.legendbattles.ru/image/chat/bb4_nc.gif';
           parent.frames['ch_buttons'].document.FBT.lrchat.alt = 'LAT <-> RUS (Транслит выключен)';
       }
}

function start()
{
       ChatTimerID = setTimeout('ch_refresh()', 1000);
       OnlineTimerOn = setTimeout('online_reload(true)', 0);
       ChatClearTimerID = setTimeout('ch_refresh_clr()', ChatClearDelay*1000);
}

function exit_confirm()
{
    return confirm('Вы действительно хотите покинуть игру?');
}

function delete_confirm(wnametxt)
{
    return confirm('Вы действительно хотите выбросить "' + wnametxt + '"?');
}

function exit_redir()
{
       if(exit_confirm()) location = 'index.php';
}

function DeleteTrue(wname)
{
       if(delete_confirm(wname)) return true;
}

function delete_confirm_NG(wnametxt)
{
    return confirm('Открыть и удалить "' + wnametxt + '"? Подарок может сожержать полезные предметы, бонусы, или не содержать ничего.');
}

function DeleteTrueNG(wname)
{
       if(delete_confirm_NG(wname)) return true;
}

function ClanConfirm(wnametxt)
{
    return confirm('Положить в казну "' + wnametxt + '"?');
}

function ClanKaznaTrue(wname)
{
       if(ClanConfirm(wname)) return true;
}

function helpwin(open_page)
{
       url_open = 'http://www.'+open_page;
       viewwin = open(url_open,"helpWindow","width=1024, height=768, status=no, toolbar=no, menubar=no, resizable=yes, scrollbars=yes");
}

function seeroom(open_room)
{
       var url_open = './ch.php?lo=1&r='+open_room;
       seeroomwin = open(url_open,"SeeRoomWindow","width=300, height=500, status=no, toolbar=no, menubar=no, resizable=no, scrollbars=yes");
}

function clan_private(clanid)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       parent.frames['ch_buttons'].document.FBT.text.value = '%<'+clanid+'> ' + parent.frames['ch_buttons'].document.FBT.text.value;

}

function view_frames()
{
       document.write('<frameset rows="*,20,1,240,1,52,0" FRAMEBORDER=0 FRAMESPACING=0 BORDER=0 id=mainframes>');
       document.write('<frame src="./main.php" name=main_top scrolling=YES>');
       document.write('<frame src="./ch/resize.html" name=resize scrolling=NO NoResize>');
       document.write('<frame src="./ch/temp.html" name=temp_f scrolling=NO NoResize>');
       document.write('<frameset cols="*,300" FRAMEBORDER=1 FRAMESPACING=0 BORDER=1 BORDERCOLOR=white>');
       document.write('<frame src="./ch/msg.php" name=chmain scrolling=YES MARGINWIDTH=2 MARGINHEIGHT=2>');
       document.write('<frame src="./ch.php?lo=1" name=ch_list scrolling=YES FRAMEBORDER=0 BORDER=0 FRAMESPACING=0 MARGINWIDTH=3 MARGINHEIGHT=0>');
       document.write('</frameset>');
       document.write('<frame src="./ch/tempw.html" name=temp_s scrolling=NO noResize>');
       document.write('<frame src="./ch/but.php" name=ch_buttons scrolling=NO noResize>');
       document.write('<FRAME target="_top" name=ch_refr src="./ch/refr.html" noResize scrolling="no">');
       document.write('</frameset>');
}