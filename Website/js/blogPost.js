$(() => {
    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");
    
    setPadding();
});

$(window).on("load", () => {

    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");
});

function initializeFullpage() {
    //Loading fullpage.js library
    new fullpage("#wrapper", {
        licenseKey: "E6347E2E-65754562-9450F523-A2A55F5E",
        anchors: ["post"],
        loopHorizontal: false,
        paddingTop: $("nav").height(),
        menu: "#menu",
        onLeave: (origin, destination) => {
            setPadding();
        },
        afterLoad: (origin, destination) => {
        },
        autoScrolling: false,
        scrollBar: true
    });
}

function setPadding() {
    $("#wrapper").css("padding-top", $("nav").height());
}