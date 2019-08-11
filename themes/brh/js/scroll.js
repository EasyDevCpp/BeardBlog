// Scrolling
/*
$(function() {
    $("a[href*=\\#]")
        .stop()
        .click(function() {
            if (
                location.pathname.replace(/^\//, "") ===
                    this.pathname.replace(/^\//, "") &&
                location.hostname === this.hostname
            ) {
                var UD_HASH = this.hash;
                var UD_ZIEL = $(this.hash);
                if (UD_ZIEL.length) {
                    var UD_ABSTAND_TOP = UD_ZIEL.offset().top;
                    $("html,body").animate(
                        { scrollTop: UD_ABSTAND_TOP },
                        1000,
                        function() {
                            window.location.hash = UD_HASH;
                        }
                    );
                    return false;
                }
            }
        });
});
*/
$(document).ready(function(){
    $("a").on('click', function(event) {
        if (this.hash !== "") {
            //event.preventDefault();
            var hash = this.hash;
  
            $('html, body').animate(
                { scrollTop: $(hash).offset().top },
                1000, 
                function() {
                    window.location.hash = hash;
                }
            );
        }
    });
});

// Highlight

$(document).ready(function() {
    var UD_MENU_ELEMENTS = $("nav ul li a");

    var UD_AKTUELL = 0;
    var UD_OBJEKT_TOP;

    var UD_OBJEKT = $(UD_MENU_ELEMENTS[0]);
    UD_OBJEKT.addClass("nav-elements-active");

    $(window).scroll(function() {
        for (var i = 0; i < UD_MENU_ELEMENTS.length; i++) {
            var UD_LINK = $(UD_MENU_ELEMENTS[i]).attr("href");

            if ($(UD_LINK).length) {
                UD_OBJEKT_TOP = $(UD_LINK).offset().top;
            }

            var UD_SCROLL_TOP = $(window).scrollTop();
            var UD_DIF = Math.abs(UD_SCROLL_TOP - UD_OBJEKT_TOP);

            if (i === 0) {
                UD_AKTUELL = UD_DIF;
                UD_OBJEKT = $(UD_MENU_ELEMENTS[i]);
                $("nav ul li a").removeClass("nav-elements-active");
                UD_OBJEKT.addClass("nav-elements-active");
            } else {
                if (UD_DIF < UD_AKTUELL || UD_DIF === UD_AKTUELL) {
                    UD_AKTUELL = UD_DIF;
                    UD_OBJEKT = $(UD_MENU_ELEMENTS[i]);
                    $("nav ul li a").removeClass("nav-elements-active");
                    UD_OBJEKT.addClass("nav-elements-active");
                }
            }
        }
    });
});

// Our Work
var ow_opacity = 1.0;
var ow_fade_state = 0;
var ow_fade_done = false;

function our_work(page) {
    if(ow_fade_state == 0) {
        if (ow_opacity >= 0) {
            ow_opacity -= .1;
            setTimeout(function() { our_work(page) }, 38);
        } else {
            ow_fade_state = 1;
            ow_fade_done  = true;
            our_work(page);
        }
    } else if(ow_fade_state == 1) {
        if (ow_opacity < 1) {
            ow_opacity += .1;
            setTimeout(function() { our_work(page) }, 38);
        } else {
            ow_fade_state = 0;
        }
    }
    document.getElementById('our-work-text').style.opacity = ow_opacity;
    if(ow_fade_done) {
        if(page == 1) {
            document.getElementById("our-work-text").innerHTML = "<p>1. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p>";
        } else if(page == 2) {
            document.getElementById("our-work-text").innerHTML = "<p>2. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p>";
        } else if(page == 3) {
            document.getElementById("our-work-text").innerHTML = "<p>3. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p>";
        } else if(page == 4) {
            document.getElementById("our-work-text").innerHTML = "<p>4. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p><p><a href=\"?site=1&page=blog\" class=\"btn btn-dark btn-med shadow-sm\"><i class=\"fas fa-newspaper\"></i> Besuch unseren Blog</a></p>";
        } else if(page == 5) {
            document.getElementById("our-work-text").innerHTML = "<p>5. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p>";
        }
        ow_fade_done = false;
    }
}

// Our Team
/*
var ot_opacity = 1.0;
var ot_fade_state = 0;
var ot_fade_done = false;

function our_team(page) {
    if(ot_fade_state == 0) {
        if (ot_opacity >= 0) {
            ot_opacity -= .1;
            setTimeout(function() { our_team(page) }, 38);
        } else {
            ot_fade_state = 1;
            ot_fade_done  = true;
            our_team(page);
        }
    } else if(ot_fade_state == 1) {
        if (ot_opacity < 1) {
            ot_opacity += .1;
            setTimeout(function() { our_team(page) }, 38);
        } else {
            ot_fade_state = 0;
        }
    }
    document.getElementById('our-team-text').style.opacity = ot_opacity;
    if(ot_fade_done) {
        var html_content = "";
        if(page == 1) {
            document.getElementById("our-team-text").innerHTML = "";
            html_content += "<div class=\"team-table\">";
            html_content += "\t<div class=\"team-col-1\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_6_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Finchen</strong></p>";
            html_content += "\t\t\t\t<p><i>Team Leader</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Marion Born</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "\t<div class=\"team-col-2\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_6_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Finchen</strong></p>";
            html_content += "\t\t\t\t<p><i>Team Leader</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Marion Born</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "\t<div class=\"team-col-3\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_6_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Finchen</strong></p>";
            html_content += "\t\t\t\t<p><i>Team Leader</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Marion Born</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "</div>";
            document.getElementById("our-team-text").insertAdjacentHTML('beforeend', html_content);
        } else if(page == 2) {
            document.getElementById("our-team-text").innerHTML = "";
            html_content += "<div class=\"team-table\">";
            html_content += "\t<div class=\"team-col-1\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_28_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Markus Krause</strong></p>";
            html_content += "\t\t\t\t<p><i>1. Vorsitzender</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Manni</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "\t<div class=\"team-col-2\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_28_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Markus Krause</strong></p>";
            html_content += "\t\t\t\t<p><i>1. Vorsitzender</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Manni</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "\t<div class=\"team-col-3\">";
            html_content += "\t\t<div class=\"name-table\">";
            html_content += "\t\t\t<div class=\"name-col-1\">";
            html_content += "\t\t\t\t<img src=\"media/pic_28_small.jpg\" height=\"180\" width=\"180\" class=\"img-rounded shadow-sm\" />";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-2\">";
            html_content += "\t\t\t\t<p><strong>Markus Krause</strong></p>";
            html_content += "\t\t\t\t<p><i>1. Vorsitzender</i></p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t\t<div class=\"name-col-3\">";
            html_content += "\t\t\t\t<p>Manni</p>";
            html_content += "\t\t\t</div>";
            html_content += "\t\t</div>";
            html_content += "\t</div>";
            html_content += "</div>";
            document.getElementById("our-team-text").insertAdjacentHTML('beforeend', html_content);
        } else if(page == 3) {
            document.getElementById("our-team-text").innerHTML = "";
        }
        ot_fade_done = false;
    }
}
*/