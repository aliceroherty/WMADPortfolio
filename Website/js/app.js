var slidesResized = false;

$(() => {
    //Hiding Navbar
    hideNav();    

    //Initializing the fullpage.js library
    initializeFullpage();
});

//Adjusting the sections padding when the window is resized
$(window).resize(() => {
    //Setting Padding to compensate for the absolutely positioned navbar
    setPadding();

    //Resizing Slides for Mobile
    resizeSlides();
});

$(window).on("load", () => {
    //Resizing Slides for Mobile
    resizeSlides();

    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");  
    
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

//Closing the hamburger menu when the user clicks a link
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

//A Function to Switch the Number of Cards per Slide from 3 to 1 on Mobile
function resizeSlides() {
    if (window.innerWidth < 992 && !slidesResized) {
        //Remembering active section and slide
        let activeSlideIndex = $('.fp-section.active').find('.slide.active').index();
        var activeSectionIndex = $('.fp-section.active').index();

        //Looping through all Sections
        $(".section").each((index, section) => {
            //Getting the Sections ID
            let sectionID = $(section).attr('id');
            
            //Making Sure the Section has Slides
            if (sectionID != "homeSection" && sectionID != "contactSection" && sectionID != "resumeSection") {
                //Storing Cards
                let cards = $(`#${sectionID} .card`);

                //Removing Slides and their Containers
                $(`#${sectionID} .slide, #${sectionID} .slideContainer`).remove();

                //Looping through Cards
                cards.each((index, card) => {
                    //Rebuilding HTML
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
        initializeFullpage();

        slidesResized = true;
    } else if (window.innerWidth >= 992 && slidesResized) {
        //Saving Active Section and Slide
        let activeSlideIndex = $('.fp-section.active').find('.slide.active').index();
        var activeSectionIndex = $('.fp-section.active').index();

        //Looping through all Sections
        $(".section").each((index, section) => {
            //Getting Section ID
            let sectionID = $(section).attr('id');
            
            //Making sure the section has slides
            if (sectionID != "homeSection" && sectionID != "contactSection" && sectionID != "resumeSection") {
                //Storing Cards
                let cards = $(`#${sectionID} .card`);

                //Removing Slides and their Containers
                $(`#${sectionID} .slide, #${sectionID} .slideContainer`).remove();

                //Looping through all stored cards
                cards.each((index, card) => {
                    //For every three cards add a slide otherwise get the last created slide
                    if ((index + 1) % 3 == 1) {
                        //Create a new slide
                        let slide = $("<div class='slide fp-slide fp-table'>").appendTo(`#${sectionID} .fp-slidesContainer`);
                        let tableCell = $("<div class='fp-tableCell'>").appendTo(slide);
                        slideContainer = $("<div class='slideContainer'>").appendTo(tableCell);
                    } else {
                        //Getting last slide container 
                        slideContainer = $(`#${sectionID} div.slideContainer`).last();
                    }

                    //Add the card to the selected slide
                    $(card).appendTo(slideContainer);
                });
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
                    
                    break;
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
                    
                    break;
                case "resume":
                    
                    break;
            }

            //Fixing Nav Pushing Content Down on Mobile
            if (window.innerWidth < 992) {
                setTimeout(() => {
                    setPadding();
                }, 400);
            } else {
                setPadding();
            }

            //Fixing Button Flying Across Background when not Starting on the Landing Page
            if (destination.anchor != "home") {
                setTimeout(() => {
                    $("#landingPageButton").css("visibility", "hidden");
                }, 500);
            } else {
                $("#landingPageButton").css("visibility", "visible");
            }
        }
    });
}