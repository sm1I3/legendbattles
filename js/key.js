var KeyStatus = 0;
var curTimeFor;
var curTimeInt;
var Mine = 0;

function KeyAct()
{
       if(KeyStatus == 0) KeyOpen();
       else KeyClose();
}

function KeyOpen()
{
       var ci;
       var bhtml = '';
       var keys = new Array(0,1,2,3,4,5,6,7,8,9);
       for(ci=0; ci<10; ci++) bhtml += '<input type=button class=addza value="'+keys[ci]+'" OnClick="javascript: KeyInsert('+keys[ci]+');"> ';
       bhtml += '<input type=button class=addza value="B" OnClick="javascript: BackKey();">';
       document.all("key").innerHTML = bhtml + '<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10>';
       document.all("key").style.visibility = "visible";
       KeyStatus = 1;
}

function KeyClose()
{
       document.all("key").style.visibility = "hidden";
       document.all("key").innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
       KeyStatus = 0;
}

function KeyInsert(number)
{
       document.FEND.code.value += number;      
}

function BackKey()
{
       var str = document.FEND.code.value;
       var leng = str.length;
       document.FEND.code.value = str.substring(0,leng-1);      
}

function KeyBlock(tfor)
{
       curTimeFor = tfor;
       curTimeInt = setInterval("KeyClock()",1000);
}

function MineKeyBlock(tfor)
{
       Mine = 1;
       KeyBlock(tfor);
}

function PKeyBlock(tfor,tblock)
{
       Mine = tblock;
       KeyBlock(tfor); 
}

function KeyClock()
{
       var ttxt;
       if(curTimeFor > 0)
       {
              switch(Mine)
              {
                     case 0: ttxt = 'автобоя'; break;
                     case 1: ttxt = 'автокопа'; break;
                     case 2: ttxt = 'авторыбалки'; break;
              }
	      document.all("key").innerHTML = 'Защита от '+ttxt+' [ ещё '+curTimeFor+' сек ]';
	      curTimeFor = curTimeFor - 1;
       }
       else
       {
              clearInterval(curTimeInt);
	      window.location = "main.php";
       }
}