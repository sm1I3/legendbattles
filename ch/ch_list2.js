document.onmousedown = t_nick;
var align_ar = ["0", "darks.gif;Дети Тьмы", "lights.gif;Дети Света", "sumers.gif;Дети Сумерек", "chaoss.gif;Дети Хаоса", "light.gif;Истинный Свет", "dark.gif;Истинная Тьма", "sumer.gif;Нейтральные Сумерки", "chaos.gif;Абсолютный Хаос", "angel.gif;Ангел"];

function t_nick() {
    parent.is_ctrl = window.event.ctrlKey;
    parent.is_alt = window.event.altKey;
}


function ch_clear_ignor(nick) {
    while (nick.indexOf('=') >= 0) nick = nick.replace('=', '%3D');
    while (nick.indexOf('+') >= 0) nick = nick.replace('+', '%2B');
    while (nick.indexOf('#') >= 0) nick = nick.replace('#', '%23');
    while (nick.indexOf(' ') >= 0) nick = nick.replace(' ', '%20');
    parent.frames['ch_list'].location = './ch.php?lo=1&a=ign&s=0&u=' + nick;
}

function reverse_alpha_sort(el1, el2) {
    if (el1 > el2) {
        return -1
    }
    else if (el1 < el2) {
        return 1
    }
    else {
        return 0
    }
}

function qsort_str(arr, first, last) {
    if (first < last) {
        point = arr[first].split(":")[0];
        i = first;
        j = last;
        while (i < j) {
            while ((arr[i].split(":")[0] <= point) && (i < last)) i++;
            while ((arr[j].split(":")[0] >= point) && (j > first)) j--;
            if (i < j) {
                temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }
        }
        temp = arr[first];
        arr[first] = arr[j];
        arr[j] = temp;
        qsort_str(arr, first, j - 1);
        qsort_str(arr, j + 1, last);
    }
}

function qsort_int(arr, first, last, h) {
    if (first < last) {
        point = parseInt(arr[first].split(":")[2]);
        i = first;
        j = last;
        while (i < j) {
            while ((h * parseInt(arr[i].split(":")[2]) <= h * point) && (i < last)) i++;
            while ((h * parseInt(arr[j].split(":")[2]) >= h * point) && (j > first)) j--;
            if (i < j) {
                temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }
        }
        temp = arr[first];
        arr[first] = arr[j];
        arr[j] = temp;
        qsort_int(arr, first, j - 1, h);
        qsort_int(arr, j + 1, last, h);
    }
}

function chatlist_build(sort_type) {
    if (sort_type == 'a_z') ChatListU.sort();
    else if (sort_type == 'z_a') ChatListU.sort(reverse_alpha_sort);
    else {

        if (sort_type == '0_35') {
            qsort_int(ChatListU, 0, ChatListU.length - 1, 1);
        }
        else if (sort_type == '35_0') {
            qsort_int(ChatListU, 0, ChatListU.length - 1, -1);
        }

        f = 0;
        fl = parseInt(ChatListU[f].split(":")[2]);
        for (i = 1; i < ChatListU.length; i++) {
            n = i;
            nl = parseInt(ChatListU[i].split(":")[2]);
            if (fl != nl) {
                qsort_str(ChatListU, f, n - 1);
                f = n;
                fl = parseInt(ChatListU[f].split(":")[2]);
            }
            if (n == ChatListU.length - 1) {
                qsort_str(ChatListU, f, n);
            }
        }
    }

    var ss;
    var sleeps;
    var nn_sec;
    var str_array;
    var sign_array;
    var altadd;

    for (var cou = 0; cou < ChatListU.length; cou++) {
        str_array = ChatListU[cou].split(":");

        var ss = '';
        var sleeps = '';
        var altadd = '';
        var ign = '';
        var inj = '';
        var psg = '';
        var align = '';

        nn_sec = str_array[1];
        var login = str_array[1];
        while (nn_sec.indexOf('+') >= 0) nn_sec = nn_sec.replace('+', '%2B');
        if (login.indexOf('<i>') > -1) {
            login = login.replace('<i>', '');
            login = login.replace('</i>', '');
            nn_sec = nn_sec.replace('<i>', '');
            nn_sec = nn_sec.replace('</i>', '');
        }

        if (str_array[3].length > 1) {
            sign_array = str_array[3].split(";");
            if (sign_array[2].length > 1)
                altadd = " (" + sign_array[2] + ")";
            ss = "<img src=https://img.lifeiswar.ru/image/signs/" + sign_array[0] + " width=15 height=12 align=absmiddle title=\"" + sign_array[1] + altadd + "\">&nbsp;";
        }

        //проверяем админские функции у игрока
        if (str_array[11] != '0') {
            var admbutton = '<img src="https://img.lifeiswar.ru/image/ld.gif" title="админка по текущим действиям" style="cursor: hand;" onClick="admWindow(\'' + str_array[1] + '\');">';
            admbutton += '&nbsp;<a href="javascript: parent.frames[\'main_top\'].location=\'main.php?post_id=114&tologin=' + str_array[1] + '&vcode=' + str_array[12] + '\'" style="text-decoration: none;">[t]</a>';
        }
        //
        if (str_array[4] != '0') {
            var molch, minut, hour, sec;
            molch = '';
            hour = parseInt(str_array[4] / 3600);
            minut = parseInt((str_array[4] - (hour * 3600)) / 60);
            sec = str_array[4] - ((hour * 3600) + (minut * 60));
            if (hour > 0) molch = hour + " ч. ";
            if (minut > 0) molch += minut + " мин. и ";
            molch += sec + " сек.";
            sleeps = "<img src=https://img.lifeiswar.ru/image/signs/molch.gif width=19 height=13 border=0 title=\"Персонаж будет молчать еще " + molch + "\" align=absmiddle>";
        }
        if (str_array[5] == '1')
            ign = "<a href=\"javascript:ch_clear_ignor('" + login + "');\"><img src=https://img.lifeiswar.ru/image/signs/ignor/3.gif width=15 height=12 border=0 title=\"Снять игнорирование\"></a>";
        if (str_array[6] != '0')
            inj = "<img src=https://img.lifeiswar.ru/image/chat/tr4.gif width=15 height=12 border=0 title=\"" + str_array[6] + "\" align=absmiddle>";

        if (str_array[7] != '0') {
            var dilers = new Array('', 'Дилер', 'Дилер', '', '', '', '', '', '', '', '', 'Помощник дилера');
            psg = "<img src=https://img.lifeiswar.ru/image/signs/d_sm_" + str_array[7] + ".gif width=15 height=12 align=absmiddle border=0 title=\"" + dilers[str_array[7]] + "\">&nbsp;";
        }
        if (str_array[8] != '') {
            sign_array = align_ar[str_array[8]].split(";");
            if (sign_array == 0) {
                align = "<img src=https://img.lifeiswar.ru/image/signs/1x1.gif width=15 height=12 align=absmiddle border=0 >";
            } else {
                align = "<img src=https://img.lifeiswar.ru/image/signs/" + sign_array[0] + " width=15 height=12 align=absmiddle border=0 title=\"" + sign_array[1] + "\">";
            }
        }
        else if (str_array[7] == '0')
            align = "<img src=https://img.lifeiswar.ru/image/1x1.gif width=15 height=12 align=absmiddle border=0 title=\"\">&nbsp";
        lvl_array = str_array[2].split(";");
        document.write("<img src=https://img.lifeiswar.ru/image/1x1.gif width=5 height=0><a href=\"javascript:parent.say_private('" + login + "')\"><img src=https://img.lifeiswar.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;" + psg + align + ss + "<a href=\"javascript:parent.say_to('" + login + "')\"><font class=nickname " + (str_array[13] ? 'style="color : #' + str_array[13] + '; font-size : 12px;"' : '') + "><b>" + str_array[1] + "</b></a></font><font class=nickname>[" + lvl_array[0] + "]</font><a href=\"/ipers.php?" + nn_sec + "\" target=_blank><img src=https://img.lifeiswar.ru/image/chat/info" + (str_array[9] == '4' ? '1' : '') + ".gif width=11 height=12 border=0 align=absmiddle></a>" + sleeps + "&nbsp;" + ign + "&nbsp;" + inj + "&nbsp;" + (str_array[11] != '0' ? admbutton : '') + "<br><img border=0 width=90%  height=1 src=https://img.lifeiswar.ru/image/1x1_2.gif><br />");
    }
}