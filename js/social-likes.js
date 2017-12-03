/*! Social Likes v2.0.7 by Artem Sapegin - http://sapegin.github.com/social-likes - Licensed MIT */
(function(e) {
    typeof define == "function" && define.amd ? define(["jquery"], e) : e(jQuery)
})(function(e) {
    "use strict";
    function s(e) {
        this.container = e,
        this.init()
    }
    function o(t, n) {
        this.widget = t,
        this.options = e.extend({},
        n),
        this.detectService(),
        this.service && this.init()
    }
    function u(e, t) {
        return a(e, t, encodeURIComponent)
    }
    function a(e, t, n) {
        return e.replace(/\{([^\}]+)\}/g,
        function(e, r) {
            return r in t ? n ? n(t[r]) : t[r] : e
        })
    }
    function f(e, n) {
        var r = t + e;
        return r + " " + r + "_" + n
    }
    function l(t) {
        function r(o) {
            if (o.type === "keydown" && o.which !== 27 || e(o.target).closest(t).length) return;
            t.fadeOut(n),
            i.off(s, r)
        }
        var i = e(document),
        s = "click touchstart keydown";
        i.on(s, r)
    }
    function c(e, t) {
        if (document.documentElement.getBoundingClientRect) {
            var r = parseInt(e.css("left"), 10),
            i = parseInt(e.css("top"), 10);
            e.css("visibility", "hidden").show();
            var s = e[0].getBoundingClientRect();
            s.left < t ? e.css("left", t - s.left + r) : s.right > window.innerWidth - t && e.css("left", window.innerWidth - s.right - t + r),
            s.top < t ? e.css("top", t - s.top + i) : s.bottom > window.innerHeight - t && e.css("top", window.innerHeight - s.bottom - t + i),
            e.hide().css("visibility", "visible")
        }
        e.fadeIn(n)
    }
    var t = "social-likes__",
    n = "fast",
    r = {
        facebook: {
            counterUrl: "https://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url=%22legendbattles.ru%22+OR+url=%22yandex.com%22+OR+url=%22google.com%22&callback=?",
            convertNumber: function(e) {
                return (e.data[0].total_count+e.data[1].total_count)
            },
            popupUrl: "http://www.facebook.com/sharer/sharer.php?u={url}",
            popupWidth: 600,
            popupHeight: 500
        },
        twitter: {
            counterUrl: "/modules/socials/twitter.php?callback=?",
            convertNumber: function(e) {
                return e.count
            },
            popupUrl: "http://twitter.com/intent/tweet?url={url}&text={title}",
            popupWidth: 600,
            popupHeight: 450,
            click: function() {
                return /[\.:\-–—]\s*$/.test(this.options.pageTitle) || (this.options.pageTitle += ":"),
                !0
            }
        },
        mailru: {
            counterUrl: "https://connect.mail.ru/share_count?url_list={url}&callback=1&func=?",
            convertNumber: function(e) {
                for (var t in e) if (e.hasOwnProperty(t)) return e[t].shares
            },
            popupUrl: "http://connect.mail.ru/share?share_url={url}&title={title}",
            popupWidth: 550,
            popupHeight: 360
        },
        vkontakte: {
            counterUrl: "https://vk.com/share.php?act=count&url={url}&index={index}",
            counter: function(t, n) {
                var i = r.vkontakte;
                i._ || (i._ = [], window.VK || (window.VK = {}), window.VK.Share = {
                    count: function(e, t) {
                        i._[e].resolve(t)
                    }
                });
                var s = i._.length;
                i._.push(n),
                e.ajax({
                    url: u(t, {
                        index: s
                    }),
                    dataType: "jsonp"
                })
            },
            popupUrl: "http://vk.com/share.php?url={url}&title={title}",
            popupWidth: 550,
            popupHeight: 330
        },
        odnoklassniki: {
            counterUrl: "/modules/socials/ok.php?callback=?",
            counter: function(t, n) {
                var i = r.odnoklassniki;
                i._ || (i._ = [], window.ODKL || (window.ODKL = {}), window.ODKL.updateCount = function(e, t) {
                    i._[e].resolve(t)
                });
                var s = i._.length;
                i._.push(n),
                e.ajax({
                    url: u(t, {
                        index: s
                    }),
                    dataType: "jsonp"
                })
            },
            popupUrl: "http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl={url}",
            popupWidth: 550,
            popupHeight: 360
        },
        plusone: {
            popupUrl: "https://plus.google.com/share?url={url}",
            popupWidth: 700,
            popupHeight: 500
        },
        livejournal: {
            click: function(t) {
                var n = this._livejournalForm;
                if (!n) {
                    var r = this.options.pageHtml.replace(/&/g, "&amp;").replace(/"/g, "&quot;");
                    n = e(a('<form action="http://www.livejournal.com/update.bml" method="post" target="_blank" accept-charset="UTF-8"><input type="hidden" name="mode" value="full"><input type="hidden" name="subject" value="{title}"><input type="hidden" name="event" value="{html}"></form>', {
                        title: this.options.pageTitle,
                        html: r
                    })),
                    this.widget.append(n),
                    this._livejournalForm = n
                }
                n.submit()
            }
        },
        pinterest: {
            counterUrl: "http://api.pinterest.com/v1/urls/count.json?url={url}&callback=?",
            convertNumber: function(e) {
                return e.count
            },
            popupUrl: "http://pinterest.com/pin/create/button/?url={url}&description={title}",
            popupWidth: 630,
            popupHeight: 270
        }
    },
    i = {
        promises: {},
        fetch: function(t, n, s) {
            i.promises[t] || (i.promises[t] = {});
            var o = i.promises[t];
            if (o[n]) return o[n];
            var a = e.extend({},
            r[t], s),
            f = e.Deferred(),
            l = a.counterUrl && u(a.counterUrl, {
                url: n
            });
            return e.isFunction(a.counter) ? a.counter(l, f) : a.counterUrl && e.getJSON(l).done(function(t) {
                try {
                    var n = t;
                    e.isFunction(a.convertNumber) && (n = a.convertNumber(t)),
                    f.resolve(n)
                } catch(r) {
                    f.reject(r)
                }
            }),
            o[n] = f.promise(),
            o[n]
        }
    };
    e.fn.socialLikes = function() {
        return this.each(function() {
            new s(e(this))
        })
    },
    s.prototype = {
        optionsMap: {
            pageUrl: {
                attr: "url",
                defaultValue: function() {
                    return "http://www.legendbattles.ru/"
                }
            },
            pageTitle: {
                attr: "title",
                defaultValue: function() {
                    return document.title
                }
            },
            pageHtml: {
                attr: "html",
                defaultValue: function() {
                    return '<a href="' + this.options.pageUrl + '">' + this.options.pageTitle + "</a>"
                }
            },
            pageCounters: {
                attr: "counters",
                defaultValue: "yes",
                convert: function(e) {
                    return e === "yes"
                }
            }
        },
        init: function() {
            this.readOptions(),
            this.single = this.container.hasClass("social-likes_single"),
            this.initUserButtons(),
            this.single && (this.makeSingleButton(), this.container.on("counter.social-likes", e.proxy(this.updateCounter, this)));
            var t = this.options;
            this.container.find("li").each(function() {
                new o(e(this), t)
            })
        },
        readOptions: function() {
            this.options = {};
            for (var t in this.optionsMap) {
                var n = this.optionsMap[t];
                this.options[t] = this.container.data(n.attr) || (e.isFunction(n.defaultValue) ? e.proxy(n.defaultValue, this)() : n.defaultValue),
                e.isFunction(n.convert) && (this.options[t] = n.convert(this.options[t]))
            }
        },
        initUserButtons: function() { ! this.userButtonInited && window.socialLikesButtons && e.extend(r, socialLikesButtons),
            this.userButtonInited = !0
        },
        makeSingleButton: function() {
            var r = this.container;
            r.addClass("social-likes_vertical"),
            r.wrap(e("<div>", {
                "class": "social-likes_single-w"
            }));
            var i = r.parent(),
            s = parseInt(r.css("left"), 10),
            o = parseInt(r.css("top"), 10);
            r.hide();
            var u = e("<div>", {
                "class": f("button", "single"),
                text: r.data("single-title") || "Share"
            });
            u.prepend(e("<span>", {
                "class": f("icon", "single")
            })),
            i.append(u);
            var a = e("<li>", {
                "class": t + "close",
                html: "&times;"
            });
            r.append(a),
            this.number = 0,
            u.click(function() {
                return r.css({
                    left: s,
                    top: o
                }),
                c(r, 20),
                l(r),
                !1
            }),
            a.click(function() {
                r.fadeOut(n)
            }),
            this.wrapper = i
        },
        updateCounter: function(e, t) {
            if (!t) return;
            this.number += t,
            this.getCounterElem().text(this.number)
        },
        getCounterElem: function() {
            var n = this.wrapper.find("." + t + "counter_single");
            return n.length || (n = e("<span>", {
                "class": f("counter", "single")
            }), this.wrapper.append(n)),
            n
        }
    },
    o.prototype = {
        init: function() {
            this.detectParams(),
            this.initHtml();
            if (this.options.pageCounters) if (this.options.counterNumber) this.updateCounter(this.options.counterNumber);
            else {
                var t = this.options.counterUrl ? {
                    counterUrl: this.options.counterUrl
                }: {};
                i.fetch(this.service, this.options.pageUrl, t).done(e.proxy(this.updateCounter, this))
            }
        },
        detectService: function() {
            var t = this.widget[0].classList || this.widget[0].className.split(" ");
            for (var n = 0; n < t.length; n++) {
                var i = t[n];
                if (r[i]) {
                    this.service = i,
                    e.extend(this.options, r[i]);
                    return
                }
            }
        },
        detectParams: function() {
            var e = this.widget.data("counter");
            if (e) {
                var t = parseInt(e, 10);
                isNaN(t) ? this.options.counterUrl = e: this.options.counterNumber = t
            }
            var n = this.widget.data("title");
            n && (this.options.pageTitle = n);
            var r = this.widget.data("url");
            r && (this.options.pageUrl = r)
        },
        initHtml: function() {
            var t = this.options,
            n = this.widget,
            r = !!t.clickUrl;
            n.removeClass(this.service),
            n.addClass(this.getElementClassNames("widget"));
            var i = n.find("a");
            i.length && this.cloneDataAttrs(i, n);
            var s = e(r ? "<a>": "<span>", {
                "class": this.getElementClassNames("button"),
                text: n.text()
            });
            if (r) {
                var o = u(t.clickUrl, {
                    url: t.pageUrl,
                    title: t.pageTitle
                });
                s.attr("href", o)
            } else s.click(e.proxy(this.click, this));
            s.prepend(e("<span>", {
                "class": this.getElementClassNames("icon")
            })),
            n.empty().append(s),
            this.button = s
        },
        cloneDataAttrs: function(e, t) {
            var n = e.data();
            for (var r in n) n.hasOwnProperty(r) && t.data(r, n[r])
        },
        getElementClassNames: function(e) {
            return f(e, this.service)
        },
        updateCounter: function(t) {
            t = parseInt(t, 10);
            if (!t) return;
            var n = e("<span>", {
                "class": this.getElementClassNames("counter"),
                text: t
            });
            this.widget.append(n),
            this.widget.trigger("counter.social-likes", t)
        },
        click: function(t) {
            var n = this.options,
            r = !0;
            e.isFunction(n.click) && (r = n.click.call(this, t));
            if (r) {
                var i = u(n.popupUrl, {
                    url: n.pageUrl,
                    title: n.pageTitle
                });
                i = this.addAdditionalParamsToUrl(i),
                this.openPopup(i, {
                    width: n.popupWidth,
                    height: n.popupHeight
                })
            }
            return ! 1
        },
        addAdditionalParamsToUrl: function(t) {
            var n = e.param(this.widget.data());
            if (!n) return t;
            var r = t.indexOf("?") === -1 ? "?": "&";
            return t + r + n
        },
        openPopup: function(e, t) {
            var n = Math.round(screen.width / 2 - t.width / 2),
            r = 0;
            screen.height > t.height && (r = Math.round(screen.height / 3 - t.height / 2));
            var i = window.open(e, "sl_" + this.service, "left=" + n + ",top=" + r + "," + "width=" + t.width + ",height=" + t.height + ",personalbar=0,toolbar=0,scrollbars=1,resizable=1");
            i ? i.focus() : location.href = e
        }
    },
    e(function() {
        e(".social-likes").socialLikes()
    })
});