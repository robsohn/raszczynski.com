 $(document).ready(function() {

    var interval = 3000;
    var slideshow = setInterval("next()", interval);
    var isSlideshow = 1;

    $("#next").click(function() {
        clearInterval(slideshow);
        $("#pause").html("play slideshow").removeClass("started").addClass("paused");
        isSlideshow = 0;
        next();
        return false;
    });

    $("#previous").click(function() {
        clearInterval(slideshow);
        $("#pause").html("play slideshow").removeClass("started").addClass("paused");
        isSlideshow = 0;
        previous();
        return false;
    });

    $("#pause").click(function() {
        if (isSlideshow == 1) {
            clearInterval(slideshow);
            $(this).html("play slideshow").removeClass("started").addClass("paused");
            isSlideshow = 0;
        } else {
            next();
            slideshow = setInterval("next()", interval);
            $(this).html("pause slideshow").removeClass("paused").addClass("started");
            isSlideshow = 1;
        }
        return false;
    });
});

/* NEXT & PREVIOUS work from last (newest) to first (oldest) image */
function next() {
    var current = $("#slideshow img.active");

    if (! current.length) {
        current =  $("#slideshow img:last");
    }

    var next = current.prev("img");

    if (! next.length) {
        var next = $("#slideshow img:last");
    }

    transition(current, next);
}

function previous() {
    var current = $("#slideshow img.active");

    if (! current.length) {
        current =  $("#slideshow img:first");
    }

    var next = current.next("img");

    if (! next.length) {
        next = $("#slideshow img:first");
    }

    transition(current, next);
}

function transition(current, next) {
    current.addClass("last-active");

    next.css({opacity: 0.0}).addClass("active").animate({opacity: 1.0}, 500, function() {
        current.removeClass("active last-active");
    });
}
