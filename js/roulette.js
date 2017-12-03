var pg_id = 4;
var rmessage = '';
var sreturn = '';

function start_roulette(type) {
    var vcode = '';
    switch (type) {
        case 'free':
            vcode = actions[0];
            break;
        case '1dnv':
            vcode = actions[1];
            break;
        default:
            vcode = '';
    }
    sreturn = '0,0,0,0,';

    AjaxGetSync('roulette_ajax.php?action=' + type + '&vcode=' + vcode + '&r=' + Math.random() + '', function (data) {
        var arr = data.split('@');
        if (arr[0] == 'OK') {
            rmessage = arr[1];
            sreturn = '1,' + arr[2] + ',' + arr[3] + ',' + arr[4] + ',' + parseFloat(arr[8]).toFixed(2) + ' $,' + arr[9];
            document.getElementById('user_deamoney').innerHTML = '&nbsp;' + arr[5] + '&nbsp;';
            if (arr[6] >= 1 && arr[6] <= 3)
                document.getElementById('user_nv').innerHTML = '&nbsp;' + arr[7] + ' LR';
            if (arr[6] == 7 || arr[6] == 8 || arr[6] == 11)
                document.getElementById('user_goldmoney').innerHTML = '&nbsp;' + arr[7] + '&nbsp;';
            return sreturn;
        } else {
            MessBoxDiv('' + arr[1]);
            sreturn = '0,0,0,0,0,0';
        }
    });
    return sreturn;
}

function show_roulette_message() {
    MessBoxDiv(rmessage);
}