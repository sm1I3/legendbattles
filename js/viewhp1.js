var interv;

function ins_HP() {
    interv = setInterval("cha_HP()", 1000);
    if (inshp[0] < 0) inshp[0] = 0;
    if (inshp[3] < 7) inshp[3] = 7;
}

function cha_HP() {
    if (inshp[0] < 0) inshp[0] = 0;
    if (inshp[0] > inshp[1]) inshp[0] = inshp[1];
    if (inshp[2] > inshp[3]) inshp[2] = inshp[3];
    if (inshp[0] >= inshp[1] && inshp[2] >= inshp[3]) clearInterval(interv);

    s_hp_f = Math.round(122 * (inshp[0] / inshp[1]));
    s_ma_f = Math.round(122 * (inshp[2] / inshp[3]));

    $('#Health').css("background-position", "-" + (122 - s_hp_f) + "px 0px")
        .text(Math.round(inshp[0]) + "|" + inshp[1]);
    $('#Mana').css("background-position", "-" + (122 - s_ma_f) + "px -13px")
        .text(Math.round(inshp[2]) + "|" + inshp[3]);
    /*
        d.getElementById('leftp').style.width = s_hp_f+'%';
        d.getElementById('leftm').style.width = s_ma_f+'%';
        d.getElementById("hpcnt").innerHTML = Math.round(inshp[0])+" / "+inshp[1];
        d.getElementById("manacnt").innerHTML = Math.round(inshp[2])+" / "+inshp[3];
    */
    inshp[0] += inshp[1] / inshp[4];
    inshp[2] += inshp[3] / inshp[5];
}