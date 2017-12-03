var BG = {};
BG.BackgroundView = function() {
    showRadialBackground && this.init()
},
BG.BackgroundView.prototype = {
    BG_COLOR: "#111114",
    width: null,
    height: null,
    srcs: null,
    tag: "img",
    zIndex: -1,
    fade: !1,
    append: function() {
        var e = this._container = document.createElement("div");
        e.className = "background-container",
        e.appendChild(this._element),
        document.body.appendChild(e),
        document.body.style.background = this.BG_COLOR
    },
    init: function() {
        var e = this._element = document.createElement(this.tag);
        this.preloadImages(),
        this.initialRendering && this.initialRendering(),
        this.initialCSS()
    },
    initialCSS: function() {
        var e = this._element,
        t = e.style;
        t.position = "absolute",
        t.zIndex = this.zIndex,
        t.left = t.top = "50%",
        t.marginLeft = Math.round(this.width / -2) + "px",
        t.marginTop = Math.round(this.height / -2) + "px",
        t.width = this.width + "px",
        t.height = this.height + "px",
        this.fade ? (t.webkitTransform = "translate3d(0,0,0)", CW.Anim.setOpacity(e, 0)) : B.msie <= 8 || (t.display = "none"),
        this.customCSS && this.customCSS(e)
    },
    preloadImages: function() {
        var e = this.srcs,
        t = this._assets = {},
        n, r = this;
        this._srcCount = 0;
        var i = function() {
            r.imageDidLoad(this)
        };
        for (var s in e) {
            if (!e.hasOwnProperty(s)) continue;
            this._srcCount++,
            n = this.mainSrc === s ? this._element: new Image,
            n.onload = i,
            n.key = s,
            n.src = n._src_ = e[s],
            t[s] = n
        }
        if (B.msie <= 8) for (s in t) {
            if (!t.hasOwnProperty(s)) continue;
            i.apply(t[s])
        }
    },
    imageDidLoad: function(e) { (this.assets || (this.assets = {}))[e.key] = e,
        this._srcCount--,
        this._srcCount === 0 && this.allImagesDidLoad()
    },
    allImagesDidLoad: function() {
        this.willBecomeVisible && this.willBecomeVisible();
        if (this.fade) return CW.Anim.Fader.create({
            element: this._element,
            owner: this,
            to: 1,
            duration: B.msie ? 0 : 1e3,
            killGPULayer: function() {
                this.element.style.webkitTransform = ""
            }.listens("finish"),
            tellDone: function() {
                this.owner.didBecomeVisible && this.owner.didBecomeVisible()
            }.listens("finish")
        }).start();
        this._element.style.display = "",
        this.didBecomeVisible && this.didBecomeVisible()
    },
    didBecomeVisible: function() {
        this.append()
    }
},
function() {
    var e, t, n = "/imgs/bg.jpg",
    //r = "/imgs/bg_radial.png",
	//r = "/imgs/back_parent.jpg",
    i = 1805,
    s = $(document).height();
    if (B.iPhone || B.iPad) window.devicePixelRatio === 2 ? n = "/imgs/ios_bg_tile_2x.jpg" : n = "/imgs/ios_bg_tile_1x.jpg",
    B.iPhone3 ? (i = 722, s = 554) : B.iPad ? (i = 1444, s = 1108) : B.iPhone4 && (i = 1444, s = 1108);
    for (t in e = {
        width: i,
        height: s,
        fade: !1,
        srcs: {
            tile: n,
            radial: r
        },
        customCSS: function(e) {
            e.style.background = "url(" + this.srcs.tile + ")"
        },
        mainSrc: "radial"
    }) e.hasOwnProperty(t) && (BG.BackgroundView.prototype[t] = e[t])
} (),
window.bg = new BG.BackgroundView;