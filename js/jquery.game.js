var TimeSet;
var TimeInt;
var TimeTik;
var PxSize = 0;
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
var constHeight = 72;
var stepHeight = 50;

change_chatsize = function(side) {
	var height = $(window).height();
    if (side == 1)
	{
		fr_size += stepHeight;
		if(fr_size > height - constHeight - 100) fr_size -= stepHeight;
	}
    else if (side == 0) {
        fr_size -= stepHeight;
        if (fr_size < 0) fr_size = 0;
    }

	var mheight = height-fr_size-constHeight;
	if(mheight < 0) mheight = 0;

	$('#main_top').height(mheight);
	$('#chmain').height(fr_size);
	$('#ch_list').height(fr_size);
}

function say_to(login)
{
       var actionlog = window.frames['main_top'].ActionFormUse;
       if((actionlog != null) && (actionlog != ""))
       {
              var login2 = login.replace('%','');
	      window.frames['main_top'].document.all(actionlog).value = login2;
	      window.frames['main_top'].document.all(actionlog).focus();
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
    	             window.frames['ch_buttons'].document.FBT.text.focus ();
    		     if(window.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     window.frames['ch_buttons'].document.FBT.text.value = '%<'+login+'> ' + window.frames['ch_buttons'].document.FBT.text.value;
              }
  	      else
  	      {
    	             window.frames['ch_buttons'].document.FBT.text.focus ();
    		     if(window.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     window.frames['ch_buttons'].document.FBT.text.value = '<'+login+'> '+window.frames['ch_buttons'].document.FBT.text.value;
              }
       }
}

function say_private(login)
{
       var actionlog = window.frames['main_top'].ActionFormUse;
       if((actionlog != null) && (actionlog != ""))
       {
              var login2 = login.replace('%','');
	      window.frames['main_top'].document.all(actionlog).value=login2;
	      window.frames['main_top'].document.all(actionlog).focus();
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
    	             window.frames['ch_buttons'].document.FBT.text.focus();
    		     if(window.frames['ch_buttons'].document.FBT.text.value.length < 255)
    		     window.frames['ch_buttons'].document.FBT.text.value = '%<'+login+'> ' + window.frames['ch_buttons'].document.FBT.text.value;
              }
       }
}

function ch_refresh_a()
{
       if(ChatFyo == 2) window.frames['ch_refr'].location='./ch.php?show=1&fyo=2';
}

function ch_refresh()
{
       if(ChatTimerID >= 0) clearTimeout(ChatTimerID);
       ChatTimerID = setTimeout('ch_refresh()', ChatDelay*1000);
       window.frames['ch_refr'].location='./ch.php?'+Math.random()+'&show=1&fyo='+ChatFyo;
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
       var fb = window.frames['ch_buttons'].document.FBT;
       if(fb)
       {
              lmid = nlmid;
    	      fb.lmid.value = nlmid;
       }
}

function save_scroll_p()
{
       OnlineScrollPosition = window.frames['ch_list'].document.body.scrollTop;
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
       if(!OnlineStop || now) window.frames['ch_list'].location = './ch.php?lo=1';
}

function ch_refresh_clr()
{
       if(ChatClearTimerID >= 0) clearTimeout(ChatClearTimerID);
       ChatClearTimerID = setTimeout ('ch_refresh_clr()', ChatClearDelay*1000);
       var s = window.frames['chmain'].document.all('msg').innerHTML;
       if(s.length > ChatClearSize)
       {
              var j = s.lastIndexOf('<BR>', s.length - ChatClearSize);
    	      window.frames['chmain'].document.all('msg').innerHTML = s.substring(j, s.length);
       }
}

function clr_input()
{
       if(window.frames["ch_buttons"].document.FBT.pactiondo.checked == true) window.frames["ch_buttons"].document.FBT.pactiondo.checked = false;
       if(window.frames["ch_buttons"].document.FBT.text)
       {
              window.frames["ch_buttons"].document.FBT.text.value = '';
   	      window.frames["ch_buttons"].document.FBT.text.focus();
       }
}

function clr_chat()
{
       if(window.frames['chmain'].document.all('msg'))
       {
          window.frames['chmain'].document.all('msg').innerHTML = '';
   	      window.frames["ch_buttons"].document.FBT.text.focus();
       }
	   if(window.frames['chmain'].document.all('msg_trade'))
       {
          window.frames['chmain'].document.all('msg_trade').innerHTML = '';
   	      window.frames["ch_buttons"].document.FBT.text.focus();
       }
}

function change_chatsetup()
{
       if(ChatFyo == 0)
       {
          ChatFyo = 1;
   	      window.frames['ch_buttons'].document.FBT.fyo.value = 1;
   	      window.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_me.gif';
           window.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Показывать только личные сообщения)';
           window.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Показывать только личные сообщения)';
       }
       else if(ChatFyo == 1)
       {
              ChatFyo = 2;
   	      window.frames['ch_buttons'].document.FBT.fyo.value = 2;
    	      ch_stop_refresh();
    	      window.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_none.gif';
           window.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Не показывать сообщения)';
           window.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Не показывать сообщения)';
       }
       else
       {
              ChatFyo = 0;
    	      window.frames['ch_buttons'].document.FBT.fyo.value = 0;
    	      ch_refresh();
    	      window.frames['ch_buttons'].document.FBT.schat.src = 'http://img.legendbattles.ru/image/chat/bb3_all.gif';
           window.frames['ch_buttons'].document.FBT.schat.alt = 'Режим чата (Показывать все сообщения)';
           window.frames['ch_buttons'].document.FBT.schat.title = 'Режим чата (Показывать все сообщения)';
       }
}

function change_chatspeed()
{
       if(ChatTimerID >= 0) clearTimeout (ChatTimerID);
       if(ChatDelay == 10) ChatDelay = 30;
       else if(ChatDelay == 30) ChatDelay = 60;
       else ChatDelay = 10;
       ChatTimerID = setTimeout('ch_refresh()', ChatDelay*1000);
       window.frames['ch_buttons'].document.FBT.spchat.src = 'http://img.legendbattles.ru/image/chat/bb_'+ChatDelay+'.gif';
    window.frames['ch_buttons'].document.FBT.spchat.alt = 'Скорость обновления (раз в ' + ChatDelay + ' секунд)';
}

function change_latrus()
{
       if(latrus == 0)
       {
              latrus = 1;
    	      window.frames['ch_buttons'].document.FBT.lrchat.src = 'http://img.legendbattles.ru/image/chat/bb4_ac.gif';
           window.frames['ch_buttons'].document.FBT.lrchat.alt = 'LAT <-> RUS (Транслит включён)';
       }
       else
       {
              latrus = 0;
       	      window.frames['ch_buttons'].document.FBT.lrchat.src = 'http://img.legendbattles.ru/image/chat/bb4_nc.gif';
           window.frames['ch_buttons'].document.FBT.lrchat.alt = 'LAT <-> RUS (Транслит выключен)';
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

function seeroom(open_room){
       var url_open = '/ch.php?lo=1&r='+open_room;
       seeroomwin = open(url_open,"SeeRoomWindow","width=300, height=500, status=no, toolbar=no, menubar=no, resizable=no, scrollbars=yes");
}

clan_private = function(clanid){
    window.frames['ch_buttons'].document.FBT.text.focus();
    window.frames['ch_buttons'].document.FBT.text.value = '%<'+clanid+'> ' + window.frames['ch_buttons'].document.FBT.text.value;
}

ShowModal = function(){   
    $("#basic-modal-content").modal({
        autoResize:true,
        overlayClose:true,
        onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.data.show();
                dialog.container.fadeIn('fast');
            });
        },
        onClose: function (dialog) {
            dialog.data.fadeOut('fast', function () {
                dialog.container.hide('fast', function () {
                    dialog.overlay.slideUp('fast', function () {
                        $.modal.close();
                    });
                });
            });
        }
    });
}

LoadingBar = function(){
    if(TimeSet > 0){
        TimeSet = TimeSet - TimeTik;
        PxSize += 1;
        document.getElementById("BAR").width = PxSize;
    }else{
        clearInterval(TimeInt);
        $('#Loading').fadeOut(600);
        
    }
}

view_loading = function(){

    $('#Loading').html('<div id="barBgPlace" style="left: ' + ($(window).width() / 2 - 105) + 'px; top: ' + ($(window).height() / 2 - 35) + 'px;"><div id="textPlace">Подождите пожалуйста...</div><div id="barPlace"><table cellpadding="0" cellspacing="0" width="160" border="0"><tr><td width="7"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/ll1.gif" width="7" height="13" border="0"></td><td class="bbg" id="BARTD"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/spacer.gif" width="1" height="13" border="0" id="BAR"></td><td width="7"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/rr1.gif" width="7" height="13" border="0"></td><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/spacer.gif" width="40" height="13" border="0"></td></tr></table></div>' + PNGImage('gameplay/labyrinth/barbg.gif', 'gameplay/labyrinth/barbg.png', 210, 70) + '</div>');
    
    PxSize = 0;
    TimeSet = 1;
    TimeTik = TimeSet/144.5;
    TimeInt = setInterval("LoadingBar()",(1000*TimeTik));
    
    view_frames();
}

view_frames = function(){

    var ViewFrames = '<iframe src="/main.php" id="main_top" name="main_top" vspase="0" scrolling="auto" style="width:100%;height:0px;" frameborder="0"></iframe>';
    ViewFrames += '<iframe src="/ch/resize.html" id="resize" name="resize" vspase="0" scrolling="no" style="width:100%;height:20px;" frameborder="0"></iframe>';
    ViewFrames += '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';
    ViewFrames += '<td width="100%"><iframe src="/ch/msg.php" id="chmain" name="chmain" vspase="0" scrolling="auto" style="width:100%;height:0px;float:left;" frameborder="0"></iframe></td>';
    ViewFrames += '<td width="333"><iframe src="/ch.php?lo=1" id="ch_list" name="ch_list" vspase="0" scrolling="auto" style="width:333px;height:0px;float:right;display:inline;" frameborder="0"></iframe></td>';
    ViewFrames += '</tr></table>';
    ViewFrames += '<iframe src="/ch/but.php" id="ch_buttons" name="ch_buttons" vspase="0" scrolling="no" style="width:100%;height:52px;" frameborder="0"></iframe>';
    ViewFrames += '<iframe src="" id="ch_refr" name="ch_refr" scrolling="no" style="width:100%;height:0px;" frameborder="0"></iframe>';
    
    $('#ViewFrames').html(ViewFrames);
    
    change_chatsize(-1);
}