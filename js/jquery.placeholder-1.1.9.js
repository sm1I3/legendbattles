(function (g) {
    var k = "PLACEHOLDER-INPUT";
    var i = "PLACEHOLDER-LABEL";
    var a = false;
    var f = {labelClass: "placeholder"};
    var m = document.createElement("input");
    if ("placeholder" in m) {
        g.fn.placeholder = g.fn.unplaceholder = function () {
        };
        delete m;
        return
    }
    delete m;
    g(window).resize(c);
    g.fn.placeholder = function (o) {
        e();
        var p = g.extend(f, o);
        this.each(function () {
            var s = Math.random().toString(32).replace(/\./, ""), q = g(this),
                r = g('<label style="position:absolute;display:none;top:0;left:0;"></label>');
            if (!q.attr("placeholder") || q.data(k) === k) {
                return
            }
            if (!q.attr("id")) {
                q.attr("id", "input_" + s)
            }
            r.attr("id", q.attr("id") + "_placeholder").data(k, "#" + q.attr("id")).attr("for", q.attr("id")).addClass(p.labelClass).addClass(p.labelClass + "-for-" + this.tagName.toLowerCase()).addClass(i).text(q.attr("placeholder"));
            q.data(i, "#" + r.attr("id")).data(k, k).addClass(k).after(r);
            h.call(this);
            d.call(this)
        })
    };
    g.fn.unplaceholder = function () {
        this.each(function () {
            var o = g(this), p = g(o.data(i));
            if (o.data(k) !== k) {
                return
            }
            p.remove();
            o.removeData(k).removeData(i).removeClass(k).unbind("change", b)
        })
    };

    function e() {
        if (a) {
            return
        }
        g("form").live("reset", function () {
            g(this).find("." + k).each(d)
        });
        g("." + k).live("keydown", h).live("mousedown", h).live("mouseup", h).live("mouseclick", h).live("focus", h).live("focusin", h).live("blur", d).live("focusout", d).live("change", b);
        g("." + i).live("click", function () {
            g(g(this).data(k)).focus()
        }).live("mouseup", function () {
            g(g(this).data(k)).focus()
        });
        bound = true;
        a = true
    }

    function b() {
        var o = g(this);
        if (!!o.val()) {
            g(o.data(i)).hide();
            return
        }
        if (o.data(k + "FOCUSED") != 1) {
            j(o)
        }
    }

    function h() {
        g(g(this).data(k + "FOCUSED", 1).data(i)).hide()
    }

    function d() {
        var o = this;
        j(g(this).removeData(k + "FOCUSED"));
        setTimeout(function () {
            var p = g(o);
            if (p.data(k + "FOCUSED") != 1) {
                j(p)
            }
        }, 200)
    }

    function j(o, q) {
        var p = g(o.data(i));
        if ((q || p.css("display") == "none") && !o.val()) {
            p.text(o.attr("placeholder")).css("top", o.position().top + "px").css("left", o.position().left + "px").css("display", "block")
        }
    }

    var l;

    function c() {
        if (l) {
            window.clearTimeout(l)
        }
        l = window.setTimeout(n, 50)
    }

    function n() {
        g("." + k).each(function () {
            var o = g(this);
            var p = g(this).data(k + "FOCUSED");
            if (!p) {
                j(o, true)
            }
        })
    }
}(jQuery));