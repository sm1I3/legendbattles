var QuestStep = 0;
var QuestDialogLeng = 0;
var ND = false;
var LD, DD;
var QCODE = '';
var QuestD, QuestP;

function New_StepByStep(cr) {
    QuestStep += cr;
    d.getElementById('QuestDia').innerHTML = QuestD[QuestStep];
    d.getElementById('QuestNav').innerHTML = DialogNav();
}

function New_DialogNav() {
    var navt = '';
    QuestP[1] = eval(QuestP[1]);
    for (var i = 0; i < QuestP[1].length; i++) {
        QuestP[1][i] = QuestP[1][i].split(":");
        if (QuestP[1][i][0] == 'goto') {
            navt += '<b onClick="AjaxGet(\'new_quest_ajax.php?act=1&qid=' + QuestP[1][i][1] + '\');" style="cursor:pointer;">' + QuestP[1][i][2] + '</b><br />';
        } else if (QuestP[1][i][0] == 'start') {
            navt += '<b onClick="AjaxGet(\'new_quest_ajax.php?act=2&qid=' + QuestP[1][i][1] + '\');" style="cursor:pointer;">' + QuestP[1][i][2] + '</b><br />';
        } else {
            navt += '<b style="cursor:pointer;">' + QuestP[1][i][2] + '</b><br />';
        }

    }
    return (navt ? navt : '');
}

function New_CreateDialogDiv() {
    ND = d.createElement('div');
    ND.id = 'darker';

    var userAgent = navigator.userAgent.toLowerCase();
    if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox') != -1) ND.className = 'TB_overlayMacFFBGHack';
    else ND.className = 'TB_overlayBG';

    d.body.appendChild(ND);

    ND = d.createElement('div');
    ND.id = 'block_uni';
    ND.className = 'png';
    d.body.appendChild(ND);
}

function New_RemoveDialogDiv() {
    d.body.removeChild(LD);
    d.body.removeChild(DD);
    ND = false;
}

function New_QuestReady() {
    if (ND === false) {
        CreateDialogDiv();
        LD = d.getElementById('block_uni');
        DD = d.getElementById('darker');
        DD.style.display = 'block';
    }

    QuestD = eval(arr_res[1]);
    QuestP = eval(arr_res[2]);

    QuestStep = 0;
    QuestDialogLeng = QuestD.length - 1;

    LD.innerHTML = '<table border="0" cellpadding="0" cellspacing="0" class="block"><tr><td height="326" width="56" rowspan="3" class="block_l png"></td><td height="35" class="block_t png"></td><td class="block_r png" width="4" rowspan="3"></td></tr><tr><td class="block_bg" width="688" height="262"><table style="margin:0px auto 0 70px; width:595px;" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td class="text"><a class="block_close" href="javascript: RemoveDialogDiv();"><img src="http://img.legendbattles.ru/image/1x1.gif" width="18" height="18" border=0></a><div id="QuestDia">' + QuestD[0] + '</div></td>' + (QuestP[0] ? '<td class="ava"><div><div class="ava_img"><img src="http://img.legendbattles.ru/image/gameplay/faces/' + QuestP[0] + '.jpg" width="130" height="130" border="0"></div><div class="ava_border png"></div></div></td>' : '') + '</tr><tr><td colspan="2" class="buttons"><div id="QuestNav">' + New_DialogNav() + '</div></td></tr></table></td></tr><tr><td height="29" class="block_b png">&nbsp;</td></tr></table>';
}

function New_QSel(QID) {
    AjaxGet('new_quest_ajax.php?act=1&vcode=' + QCODE + '&qid=' + QID + '&r=' + Math.random());
}

function New_QActive(qid, vcode) {
    AjaxGet('new_quest_ajax.php?act=1&qid=' + qid + '&vcode=' + vcode + '&r=' + Math.random());
}