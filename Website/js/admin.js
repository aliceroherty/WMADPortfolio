Dropzone.autoDiscover = false;

$(() => {
    initializeFullpage();

    setPadding();

    //Loading Blog Post Dropzone
    let dropzone = new Dropzone("#blogPostImage", {
        url: 'createPost.php',
        autoProcessQueue: false,
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        maxFiles: 1,
        init: () => {
            
        },
        accept: (file, done) => {
            done();
        }
    });

    $("#btnCreatePost").click((e) => {
        e.preventDefault();
        e.stopPropagation();

        if (dropzone.getQueuedFiles().length > 0) {
            dropzone.processQueue();
        } else {
            submitForm("createPost.php");
        }
    });

    dropzone.on("sending", function(data, xhr, formData) {
        formData.append("title", $("#title").val());
        formData.append("text", $("#text").val());
    });

    dropzone.on("complete", function(file) {
        $("#title").val("");
        $("#text").val("");
        setTimeout(() => {
            dropzone.removeAllFiles();
        }, 2000);
    });

    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");
});

//Adjusting the sections padding when the window is resized
$(window).resize(() => {

});

$(window).on("load", () => {
    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");
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

function submitForm(url)
{
    formData = new FormData();
    formData.append('title', $("#title").val());
    formData.append('text', $("#text").val());

    $.ajax({
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                $("#title").val("");
                $("#text").val("");
            }
    });
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
        anchors: ["addPost"],
        loopHorizontal: false,
        paddingTop: $("nav").height(),
        menu: "#menu",
        onLeave: (origin, destination) => {
            setPadding();
        },
        afterLoad: (origin, destination) => {
        }
    });
}