var pngAlpha = 1;
var ua = navigator.userAgent.toLowerCase();

this.isIE = ((ua.indexOf('msie') != -1) && !(ua.indexOf('opera') != -1) && (ua.indexOf('webtv') == -1));
this.versionMinor = parseFloat(navigator.appVersion);
this.versionMajor = parseInt(navigator.appVersion);

if (this.isIE && this.versionMinor >= 4) this.versionMinor = parseFloat(ua.substring(ua.indexOf('msie ') + 5));
if (this.isIE && parseInt(this.versionMinor) < 7) pngAlpha = 0;

function PNGImage(img, png, w, h) {
    if (!pngAlpha) return '<img src="/img/image/' + img + '" width="' + w + '" height="' + h + '" border="0" style="FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'/img/image/' + png + '\')">';
    else return '<img src="/img/image/' + img + '" width="' + w + '" height="' + h + '" border="0" style="background-image: url(\'/img/image/' + png + '\');">';
}