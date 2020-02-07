$(() => {
    hideNav();    

    new fullpage("#wrapper", {
        licenseKey: "E6347E2E-65754562-9450F523-A2A55F5E",
        anchors: ["home", "about", "portfolio", "blog", "contact", "resume"],
        loopHorizontal: false,
        paddingTop: $("nav").height(),
        menu: "#menu",
        onLeave: (origin, destination) => {
            if (destination.anchor == "home") {
                hideNav();
            } else {
                showNav();
            }

            switch (destination.anchor) {
                case "home":
                    collapseNav();
                    break;
                case "about":
                    animateCSS("#aboutSection .slideContainer", "fadeInRight")
                    break;
                case "portfolio":
                    animateCSS("#portfolioSection .slideContainer", "fadeInLeft")
                    break;
                case "blog":
                    animateCSS("#blogSection .slideContainer", "fadeInRight")
                    break;
                case "contact":
                    
                case "resume":
                    
                    break;
            }

            switch (origin.anchor) {
                case "home":
                    
                    break;
                case "about":
                    animateCSS("#aboutSection .slideContainer", "fadeOutRight")
                    break;
                case "portfolio":
                    animateCSS("#portfolioSection .slideContainer", "fadeOutLeft")
                    break;
                case "blog":
                    animateCSS("#blogSection .slideContainer", "fadeOutRight")
                    break;
                case "contact":
                    
                case "resume":
                    
                    break;
            }
            setPadding();
        },
        afterLoad: (origin, destination) => {
        }
    });

    particlesJS.load("particles", "./assets/particles-config.json");
});

$(window).resize(() => {
    setPadding();
});

$(window).on("load", () => {
    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");

    animateCSS("#landingPageContainer h1", "bounceInDown");
    animateCSS("#landingPageContainer h3", "bounceInDown");
    $('#landingPageContainer button').addClass('delay-2s');
    animateCSS("#landingPageContainer button", "bounceInUp", () => {
        $('#landingPageContainer button').removeClass('delay-2s');
        animateCSS("#landingPageContainer button", "rubberBand");
    });
});

function setPadding() {
    //If the navbar is not hidden apply padding to all sections except the landing page
    if ($("nav").css("top") != -$("nav").height()) {
        $(".sectionContainer, .fp-slides").css("padding-top", $("nav").height());
    }
    else {
        $(".sectionContainer").css("padding-top", 0);
    }
}

function hideNav() {
    //Hiding the navbar
    $("nav").css("top", -$("nav").height());
}

function showNav() {
    //Showing the navbar
    $("nav").css("top", 0);
}

function collapseNav() {
    $('.collapse').collapse('hide');
}

function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element);
    node.classList.add("animated", animationName);

    function handleAnimationEnd() {
        node.classList.remove("animated", animationName);
        node.removeEventListener("animationend", handleAnimationEnd);

        if (typeof callback === "function") callback();
    }

    node.addEventListener("animationend", handleAnimationEnd);
}