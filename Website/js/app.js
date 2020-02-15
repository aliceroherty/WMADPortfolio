var slidesResized = false;

$(() => {
    hideNav();    
    initializeFullpage();

    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");
});

//Adjusting the sections padding when the window is resized
$(window).resize(() => {
    setPadding();
    resizeSlides();
});

$(window).on("load", () => {

    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");

    //Landing Page Animations
    animateCSS("#landingPageContainer h1", "bounceInDown");
    animateCSS("#landingPageContainer h3", "bounceInDown");

    $('#landingPageContainer button').addClass('delay-2s');
    animateCSS("#landingPageContainer button", "bounceInUp", () => {
        $('#landingPageContainer button').removeClass('delay-2s');
        animateCSS("#landingPageContainer button", "rubberBand");
    });
});

$(".nav-link").click(() => {
    collapseNav();
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
    //Collapsing the Bootstrap Hamburger Menu
    $('.collapse').collapse('hide');
}

function resizeSlides() {
    if (window.innerWidth < 992 && !slidesResized) {
        /*//Remembering active section and slide
        let activeSlideIndex = $('.fp-section.active').find('.slide.active').index();
        var activeSectionIndex = $('.fp-section.active').index();

        $(".section").each((index, section) => {
            let sectionID = $(section).attr('id');
            
            if (sectionID != "homeSection" && sectionID != "contactSection" && sectionID != "resumeSection") {
                let cards = $(`#${sectionID} .card`);

                //Removing Slides and their Containers
                $(`#${sectionID} .slide, .slideContainer`).remove();

                cards.each((index, card) => {
                    let slide = $("<div class='slide fp-slide fp-table'>").appendTo(`#${sectionID} .fp-slidesContainer`);
                    let tableCell = $("<div class='fp-tableCell'>").appendTo(slide);
                    let slideContainer = $("<div class='slideContainer'>").appendTo(tableCell);
                    $(card).appendTo(slideContainer);
                });
            }
        });

        //Applying Active Classes
        if (activeSlideIndex > -1) {
            $(".slide").eq(activeSlideIndex).addClass("active");
        }

        if (activeSectionIndex > -1) {
            $('.section').eq(activeSectionIndex).addClass('active');
        }

        //Reinitializing Fullpage.js
        fullpage_api.destroy("all");
        initializeFullpage();*/
        //Remembering active section and slide
        let activeSlideIndex = $('.fp-section.active').find('.slide.active').index();
        var activeSectionIndex = $('.fp-section.active').index();
        
        let blogPosts = $(".blogPost");

        $("#blogSection .slide, .slideContainer").remove();

        blogPosts.each((index, blogPost) => {
            let slide = $("<div class='slide fp-slide fp-table'>").appendTo("#blogSection .fp-slidesContainer");
            let tableCell = $("<div class='fp-tableCell'>").appendTo(slide);
            let slideContainer = $("<div class='slideContainer'>").appendTo(tableCell);
            slideContainer.append(blogPost);
        });

        //applying active classes
        if (activeSlideIndex > -1) {
            $(".slide").eq(activeSlideIndex).addClass("active");
        }

        if (activeSectionIndex > -1) {
            $('.section').eq(activeSectionIndex).addClass('active');
        }

        //Reinitializing Fullpage.js
        fullpage_api.destroy("all");
        initializeFullpage();
        
        slidesResized = true;
    } else if (window.innerWidth >= 992 && slidesResized) {
        //Return to three cards per slide
        let activeSlideIndex = $('.fp-section.active').find('.slide.active').index();
        var activeSectionIndex = $('.fp-section.active').index();
        
        let blogPosts = $(".blogPost");

        $("#blogSection .slide, .slideContainer").remove();

        blogPosts.each((index, blogPost) => {
            if ((index + 1) % 3 == 1) {
                //insert opening tags
            }

            //Insert blog post
            let slide = $("<div class='slide fp-slide fp-table'>").appendTo("#blogSection .fp-slidesContainer");
            let tableCell = $("<div class='fp-tableCell'>").appendTo(slide);
            let slideContainer = $("<div class='slideContainer'>").appendTo(tableCell);
            slideContainer.append(blogPost);

            if ((index + 1) % 3 == 0 || (index + 1) == blogPosts.length) {
                //Insert ending tags
            }
        });

        //applying active classes
        if (activeSlideIndex > -1) {
            $(".slide").eq(activeSlideIndex).addClass("active");
        }

        if (activeSectionIndex > -1) {
            $('.section').eq(activeSectionIndex).addClass('active');
        }

        //Reinitializing Fullpage.js
        fullpage_api.destroy("all");
        initializeFullpage();
        
        slidesResized = false;
    }
}

//Animate.css helper function for applying their animations
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

function initializeFullpage() {
    //Loading fullpage.js library
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
                    animateCSS("#aboutSection .fp-slide.active", "fadeInRight")
                    break;
                case "portfolio":
                    animateCSS("#portfolioSection .fp-slide.active", "fadeInLeft")
                    break;
                case "blog":
                    animateCSS("#blogSection .fp-slide.active", "fadeInRight")
                    break;
                case "contact":
                    
                case "resume":
                    
                    break;
            }

            switch (origin.anchor) {
                case "home":
                    
                    break;
                case "about":
                    animateCSS("#aboutSection .fp-slide.active", "fadeOutRight")
                    break;
                case "portfolio":
                    animateCSS("#portfolioSection .fp-slide.active", "fadeOutLeft")
                    break;
                case "blog":
                    animateCSS("#blogSection .fp-slide.active", "fadeOutRight")
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
}