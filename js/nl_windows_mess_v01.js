var d = document;
var classn = false;
var MESSD = false;
var MDARK = false;
var TMSEC = 0;
var timeLeft = 0;
var GlobalM = false;

function RetClass()
{
    var userAgent = navigator.userAgent.toLowerCase();
    if(userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) classn = 'TB_overlayMacFFBGHack';
    else classn = 'TB_overlayBG';
    return classn;    
}

function MessBoxDiv(mess)
{
    if(!MESSD)
    {
        MDARK = document.createElement('div');
        MDARK.id = 'darker';
        MDARK.className = (classn ? classn : RetClass());
        MDARK.style.display = 'block';
        document.body.appendChild(MDARK);
        
        MESSD = document.createElement('div');
        MESSD.className = 'png';
        MESSD.id = 'static_window';
        MESSD.style.top = (getMidWin() - 91)+'px';
        MESSD.innerHTML = '<div class="ws_top png"></div><div class="ws_right png"></div><div class="ws_bottom png"></div><div class="ws_middle"><a href="javascript: MessBoxDivClose();" class="circ"></a><div class="text" id="mess_box_d">'+mess+'</div><a class="cl_but" href="javascript: MessBoxDivClose();"></a></div>';
        document.body.appendChild(MESSD);        
    }    
}

function MessBoxDivClose()
{
    if(TMSEC) clearInterval(TMSEC);
    document.body.removeChild(MESSD);
    document.body.removeChild(MDARK);
    MDARK = false;
    MESSD = false;    
}

function getBodyScrollTop()
{
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}

function getMidWin()
{
    var wheight = typeof( window.innerHeight ) == 'number' ? window.innerHeight : browserHeight = document.documentElement.clientHeight;
    return (wheight / 2 + getBodyScrollTop());
}

function timeCheck()
{
    timeLeft -= 1000;
    if(timeLeft <= 0)
    {
        MessBoxDivClose();
    }
    else
    {
        d.getElementById('mess_box_d').innerHTML = GlobalM+' '+timeFormat(timeLeft / 1000);
    }    
}

function timeStarting(mess,tinit)
{
    GlobalM = mess;
    MessBoxDiv(mess+' '+timeFormat(tinit));
    timeLeft = tinit * 1000;
    TMSEC = setInterval('timeCheck()',1000);
}

function timeFormat(leftsec)
{
    var fstr;
    var hour = Math.floor(leftsec / 3600);
    if(hour < 10) fstr = '0' + hour.toString();
    else fstr = hour.toString();
    fstr += ':';
    leftsec -= 3600*hour;
    var min = Math.floor(leftsec / 60);
    if(min < 10) fstr += '0' + min.toString();
    else fstr += min.toString();
    fstr += ':';
    var sec = leftsec - min*60;
    if(sec < 10) fstr += '0' + sec.toString();
    else fstr += sec.toString();
    return fstr;
}