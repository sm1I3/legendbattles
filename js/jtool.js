$(document).ready(function () {
    var theWindow = $(window),
        $bg = $("#bg"),
        aspectRatio = $bg.width() / $bg.height(),
        count = 0;


    function resizeBg() {

        if ((theWindow.width() / theWindow.height()) < aspectRatio) {
            $bg
                .removeClass()
                .addClass('bgheight');
        } else {
            $bg
                .removeClass()
                .addClass('bgwidth');
        }

    }

    theWindow.resize(function () {
        resizeBg();
    }).trigger("resize");

    $('#vhod span').click(
        function () {
            if (count == 1) {
                $('#login_box').fadeOut();
                count = 0;
            } else {
                count = 1;
                $('#login_box').fadeIn();
            }

        }
    );
});
 
 
 
