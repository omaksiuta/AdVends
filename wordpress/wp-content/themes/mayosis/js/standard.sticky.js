(function($) {
 $(window).scroll(function() {
        "use strict";
        if ($(this).scrollTop() > 1) {
           $('#header').addClass('sticky');
        $('#header').addClass('fadeInDown');
        } else {
             $('#header').removeClass('sticky');
        $('#header').removeClass('fadeInDown');
        }
    });

})(jQuery)