(function($) {
    'use strict';

    function cartWidget() {
        winWidth = jQuery(window).width(), winWidth > 599 || jQuery(".cart-btn").click(function() {
            jQuery(this).parent(".cart-widget").hasClass("cw-active") ? (jQuery(this).parent(".cart-widget").removeClass("cw-active"), jQuery("body").css({
                overflow: "auto"
            })) : (jQuery(this).parent(".cart-widget").addClass("cw-active"), jQuery("body").css({
                overflow: "hidden"
            }))
        })
    }
    $(document).ready(function() {
        "use strict";
        $(window).scroll(function() {
            $(this).scrollTop() > 50 ? $("#back-to-top").fadeIn() : $("#back-to-top").fadeOut()
        }), $("#back-to-top").click(function() {
            return $("#back-to-top").tooltip("hide"), $("body,html").animate({
                scrollTop: 0
            }, 800), !1
        }), $("#back-to-top").tooltip("show")
    }), $("ul.dropdown-menu [data-toggle=dropdown]").on("click", function(e) {
        "use strict";
        e.preventDefault(), e.stopPropagation(), $(this).parent().addClass("open"), $(this).parent().find("ul").parent().find("li.dropdown").addClass("open")
    }), $(document).ready(function() {
        "use strict";
        $("#quote-carousel").carousel({
            pause: !0,
            interval: 4e3
        })
    }),
        function() {
            'use strict';
            var e = $('.edd_price_options input[type="radio"]');
            e.click(function() {
                e.each(function() {
                    $(this).closest(".edd_price_options ul li").toggleClass("item-selected active", this.checked).removeClass("active")
                })
            })
        }(), $(".statistic-counter").each(function() {
        $(this).prop("Counter", 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5e3,
            easing: "swing",
            step: function(e) {
                $(this).text(Math.ceil(e))
            }
        })
    }), $("#menu-close").click(function(e) {
        e.preventDefault(), $("#sidebar-wrapper").toggleClass("active")
    }), $("#menu-toggle").click(function(e) {
        e.preventDefault(), $("#sidebar-wrapper").toggleClass("active")
    }), $(function() {
        "use strict";
        $("input,textarea").focus(function() {
            $(this).data("placeholder", $(this).attr("placeholder")).attr("placeholder", "")
        }).blur(function() {
            $(this).attr("placeholder", $(this).data("placeholder"))
        })
    }),
        function(e) {
            "use strict";
            e('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
                    var t = e(this.hash);
                    if ((t = t.length ? t : e("[name=" + this.hash.slice(1) + "]")).length) return e("html, body").animate({
                        scrollTop: t.offset().top - 54
                    }, 1e3, "easeInOutExpo"), !1
                }
            }), e(".js-scroll-trigger").click(function() {
                e(".navbar-collapse").collapse("hide")
            }), e("body").scrollspy({
                target: "#mainNav",
                offset: 54
            })
        }(jQuery), $(function() {
        $('[data-toggle="tooltip"]').tooltip(), $(".side-nav .collapse").on("hide.bs.collapse", function() {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down")
        }), $(".side-nav .collapse").on("show.bs.collapse", function() {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right")
        })
    });
    var videosSection = [],
        videoSDiv = ".parallax-container video",
        videoVimeoS = "iframe.vimeo-player-section";

    function videoSection() {
        videosSection = [], $(videoSDiv).mediaelementplayer({
            features: ["volume"],
            pauseOtherPlayers: !1,
            loop: !0,
            startVolume: 0,
            success: function(e, t) {
                e.addEventListener("play", function(t) {
                    $(e).closest(".parallax-container").find(".parallax-container-poster").remove()
                }), videosSection.push(e), e.pause(), e.load(), e.addEventListener("loadeddata", function(t) {
                    videoSectionSize(e), e.play()
                })
            },
            error: function(e) {
                $(e).closest(".mejs-container").remove()
            }
        })
    }

    function videoSectionSize(e) {
        'use strict';
        var t = $(e);
        t.attr("style", "");
        var a = t.width(),
            i = t.height(),
            o = t.closest(".parallax-container-inner").width(),
            n = a / o,
            s = i / t.closest(".parallax-container-inner").height(),
            r = Math.min(n, s),
            l = a / r,
            c = -Math.abs((l - o) / 2);
        t.attr("style", "height: auto !important; width: " + l + "px !important; left: " + c + "px !important; top: 0px !important;")
    }

    function videoSectionVimeo() {
        'use strict';
        $("iframe.vimeo-player-section").each(function() {
            var e, t = $(this),
                a = t.parent().width(),
                i = t.parent().height();
            if (t.data("vimeo-ratio") ? e = t.attr("data-vimeo-ratio") : (e = t.data("height") / t.data("width"), t.attr("data-vimeo-ratio", e)), t.removeAttr("height width"), a * e >= i) t.height(a * e).width("100%").css("margin-top", -(a * e - i) / 2).css("margin-left", 0);
            else {
                var o = -(i / e - a) / 2;
                t.height(i).width(i / e).css("margin-left", o).css("margin-top", 0)
            }
        }), $.getScript("//f.vimeocdn.com/js/froogaloop2.min.js", function() {
            $("iframe.vimeo-player-section").each(function() {
                var e = $(this);
                e.attr("src", e.attr("src"));
                var t = $f(this);
                t.addEvent("ready", function() {
                    t.api("setVolume", 0), t.api("play")
                })
            })
        }), $(window).on("statechangecomplete", function() {
            $("iframe.vimeo-player-section").each(function() {
                var e = $f(this);
                e.addEvent("ready", function() {
                    e.api("setVolume", 0), e.api("play")
                })
            })
        })
    }
    $(window).resize(function() {
        $(videoSDiv).each(function() {
            videoSectionSize($(this))
        }), videoSectionVimeo()
    });
    var toSCvideo = ".to-sc-video-holder video";

    function to_sc_video() {
        'use strict';
        $(toSCvideo).mediaelementplayer({
            features: ["fullscreen", "playpause", "current", "progress", "duration", "volume"],
            videoVolume: "vertical",
            pauseOtherPlayers: !1,
            startVolume: .8,
            success: function(e, t) {
                e.addEventListener("ended", function(e) {
                    $(e.target).closest(".to-sc-video-holder").find(" .mejs-poster").show()
                })
            },
            error: function(e) {
                $(e).closest(".mejs-container").remove()
            }
        })
    }
    $(".paratrue iframe").each(function() {
        11 == ie && parseInt($(this).parent().height()) > 1e3 && $(this).closest(".parallax-container").removeClass("paratrue")
    });
    var divPosition = -1;

    function parallaxImgDiv() {
        'use strict';
        if (divPosition == $(document).scrollTop()) return scroll(parallaxImgDiv), !1;
        if (!1 === touchDevice && !0 === css3) {
            var e = $(window).height();
            $(".paratrue").each(function() {
                var t = $(this),
                    a = $(document).scrollTop(),
                    i = t.offset().top,
                    o = t.outerHeight(!0),
                    n = i - e;
                if (a >= n && a <= i + e) {
                    var s = 50 / (e + o),
                        r = Math.abs(a - n) * s * -1;
                    t.find(".parallax-container-inner").css("-" + pre + "-transform", "translate3d(0px, " + r + "%, 0px)")
                }
            })
        }
        scroll(parallaxImgDiv)
    }

    function(e) {
        e(document).ready(function() {
            e("#mayosis-sidemenu li.has-sub>a").on("click", function() {
                e(this).removeAttr("href");
                var t = e(this).parent("li");
                t.hasClass("open") ? (t.removeClass("open"), t.find("li").removeClass("open"), t.find("ul").slideUp()) : (t.addClass("open"), t.children("ul").slideDown(), t.siblings("li").children("ul").slideUp(), t.siblings("li").removeClass("open"), t.siblings("li").find("li").removeClass("open"), t.siblings("li").find("ul").slideUp())
            }), e("#mayosis-sidemenu>ul>li.has-sub>a").append('<span class="holder"></span>')
        })
    }(jQuery)
    $(function() {
        'use strict';
        $('a[href="#searchoverlay"]').on("click", function(event) {
            event.preventDefault();
            $("#searchoverlay").addClass("open");
            $('#searchoverlay > form > input[type="search"]').focus()
        });
        $("#searchoverlay, #searchoverlay button.close").on("click keyup", function(event) {
            if (event.target == this || event.target.className == "close" || event.keyCode == 27) {
                $(this).removeClass("open")
            }
        })
    });

    function openNav() {
        'use strict';
        document.getElementById("myNav").style.width = "100%"
    }

    function closeNav() {
        'use strict';
        document.getElementById("myNav").style.width = "0%"
    }
    $(document).ready(function() {
        'use strict';
        $('#mayosis-sidebarCollapse').on('click', function() {
            $('#mayosis-sidebar').toggleClass('active')
        })
    });
    (function($) {
        'use strict';
        $(window).on('load', function() {
            if ($(".load-mayosis").length > 0) {
                $(".load-mayosis").fadeOut("slow")
            }
        })
    })(jQuery)
    $(window).scroll(function() {
        "use strict";
        if ($(this).scrollTop() > 1) {
            $('header').addClass("fixedheader")
        } else {
            $('header').removeClass("fixedheader")
        }
    });
    $('.burger, .overlaymobile').click(function() {
        $('.burger').toggleClass('clicked');
        $('.overlaymobile').toggleClass('show');
        $('.mobile--nav-menu').toggleClass('show');
        $('body').toggleClass('overflow')
    })
})(jQuery)

var jq = jQuery.noConflict();
jq(document).ready(function() {
    "use strict";
    $(".gallery1").vitGallery({
        debag: !0,
        thumbnailMargin: 15,
        fullscreen: !0
    }), $(".gallery2").vitGallery({
        controls: "points",
        transition: "slide-blur",
        autoplay: !1,
        fullscreen: !0,
        thumnailAnimationSpeed: 500,
        animateSpeed: 500
    })
});

var jqiso = jQuery.noConflict();
jqiso(document).ready(function() {
    "use strict";
    var selectedClass = "";
    $(".fil-cat").click(function(){
        selectedClass = $(this).attr("data-rel");
        $("#isotope-filter").fadeTo(100, 0.1);
        $("#isotope-filter a.tile").not("."+selectedClass).fadeOut().removeClass('scale-anm');
        setTimeout(function() {
            $("."+selectedClass).fadeIn().addClass('scale-anm');
            $("#isotope-filter").fadeTo(300, 1);
        }, 300);

    });
});

var jqfilter = jQuery.noConflict();
jqfilter(document).ready(function() {
    $('.grid--filter--main span').click(function () {
        $('.active').not($(this)).removeClass('active');
        $(this).toggleClass('active');
    });
});
