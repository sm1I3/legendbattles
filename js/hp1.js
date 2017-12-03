var curHP, maxHP, intHP, curMA, maxMA, intMA, interv;

function ins_HP(curh, maxh, curm, maxm, hp_int, ma_int) {
    intHP = hp_int;
    intMA = ma_int;
    interv = setInterval("cha_HP()", 750);
    if (curm < 0) curm = 0;
    if (maxm <= 0) maxm = 7;
    curHP = curh;
    curMA = curm;
    maxHP = maxh;
    maxMA = maxm;
    cha_HP();
}

function cha_HP() {
    if (curHP > maxHP) curHP = maxHP;
    if (curMA > maxMA) curMA = maxMA;
    if (curHP >= maxHP && curMA >= maxMA) clearInterval(interv);
    s_hp_f = Math.round(122 * (curHP / maxHP));
    s_ma_f = Math.round(122 * (curMA / maxMA));
    $('#Health').css("background-position", "-" + (122 - s_hp_f) + "px 0px")
        .text(Math.round(curHP) + "|" + maxHP);
    $('#Mana').css("background-position", "-" + (122 - s_ma_f) + "px -13px")
        .text(Math.round(curMA) + "|" + maxMA);
    curHP = curHP + (maxHP / intHP);
    curMA = curMA + (maxMA / intMA);
}
