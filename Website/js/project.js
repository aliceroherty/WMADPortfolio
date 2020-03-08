$(() => {
    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");
    
    setPadding();
});

$(window).on("load", () => {

    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");

    //Making body height same as page height
    $("html, body").css("height", $(document).height());

    if ($("#iconContainer").children().length == 1) {
        $("#iconContainer").css("justify-content", "flex-end");
    }

    animateCSS("#project", "bounceInDown");
});

$(window).resize(() => {
    setPadding();
});

function setPadding() {
    $("body, #wrapper").css("padding-top", $("nav").height());
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