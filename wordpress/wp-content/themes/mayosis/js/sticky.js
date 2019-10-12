/*************************************************************
Smart Sticky
*************************************************************/
(function() {
    var header = new Headroom(document.querySelector("#header"), {
         tolerance: 0,
        offset : 0,
        classes: {
          initial : "headroom",
        // when scrolling up
        pinned : "headroom--pinned",
        // when scrolling down
        unpinned : "headroom--unpinned"
        }
    });
    header.init();
}());


(function() {
    var header = new Headroom(document.querySelector("#mobileheader"), {
        tolerance: 0,
        offset : 0,
        classes: {
          initial : "headroom",
        // when scrolling up
        pinned : "headroom--pinned",
        // when scrolling down
        unpinned : "headroom--unpinned"
        }
    });
    header.init();
}());