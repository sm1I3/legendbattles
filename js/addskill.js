var SkillAr = new Array("10:8:6:4", "8:6:4:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "6:4:4:2", "10:8:6:4", "4:4:2:2", "2:2:2:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "8:6:4:2", "6:4:2:2", "6:4:2:2", "6:4:2:2", "6:4:2:2", "6:4:2:2", "2:2:2:2", "6:4:3:2", "6:4:3:2", "6:4:3:2", "10:8:6:4", "8:6:4:2", "8:6:4:2", "2:2:2:2", "2:2:2:2", "6:4:3:2", "2:2:2:2", "6:4:2:2", "6:4:3:2", "6:4:3:2", "6:4:3:2", "6:4:3:2");

function AddSkill(sk_class) {
    var fr = parseInt(document.saveskill.freeskills.value);
    var frmir = parseInt(document.saveskill.freeskillsmir.value);
    if ((fr > 0 && sk_class < 21) || (frmir > 0 && sk_class > 20)) {
        var sk_class_fin = 'f[' + sk_class + ']';
        var ns = parseInt(document.saveskill[sk_class_fin].value);
        if (ns < 100) {
            var sk_class_div = 'sk' + sk_class;
            var sk_class_hid = 'h' + sk_class;
            var elem = SkillAr[sk_class];
            var elin = elem.split(":");
            var temp = ns / 25;
            var index = Math.floor(temp);
            ns += parseInt(elin[index]);
            var per = document.getElementById("dop" + sk_class);
            if (!per.style.width) per.style.width = 0;
            per.style.width = parseInt(per.style.width) + parseInt(elin[index]) + '%';
            if (ns > 100) ns = 100;
            document.saveskill[sk_class_fin].value = ns;
            document.all(sk_class_div).innerHTML = ns + '/100';
            if (sk_class < 21) {
                fr--;
                document.saveskill.freeskills.value = fr;
            }
            else {
                frmir--;
                document.saveskill.freeskillsmir.value = frmir;
            }
            document.all('skillbum').innerHTML = fr;
            document.all('skillmum').innerHTML = frmir;
        }
    }
}

function RemoveSkill(sk_class) {
    var sk_class_fin = 'f[' + sk_class + ']';
    var sk_class_hid = 'h' + sk_class;
    var sknow = parseInt(document.saveskill[sk_class_fin].value);
    var sksta = parseInt(document.saveskill[sk_class_hid].value);
    if (sknow > sksta) {
        var sk_class_div = 'sk' + sk_class;
        var fr = parseInt(document.saveskill.freeskills.value);
        var frmir = parseInt(document.saveskill.freeskillsmir.value);
        var elem = SkillAr[sk_class];
        var elin = elem.split(":");
        var temp = sknow / 25;
        var index = Math.floor(temp);
        var per = document.getElementById("dop" + sk_class);
        if (!per.style.width) per.style.width = 0;
        if (index > 0 && (sknow - parseInt(elin[index - 1])) < 25 * index && (sknow - parseInt(elin[index]) != 25 * index)) {
            sknow -= parseInt(elin[index - 1]);
            per.style.width = parseInt(per.style.width) - parseInt(elin[index - 1]) + '%';
        }
        else {
            sknow -= parseInt(elin[index]);
            per.style.width = parseInt(per.style.width) - parseInt(elin[index]) + '%';
        }
        document.all(sk_class_div).innerHTML = sknow + '/100';
        document.saveskill[sk_class_fin].value = sknow;
        if (sk_class < 21) {
            fr++;
            document.saveskill.freeskills.value = fr;
        }
        else {
            frmir++;
            document.saveskill.freeskillsmir.value = frmir;
        }
        document.all('skillbum').innerHTML = fr;
        document.all('skillmum').innerHTML = frmir;
    }
}