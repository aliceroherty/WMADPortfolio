Dropzone.autoDiscover = false;
var slidesResized = false;

$(() => {
    initializeFullpage();

    //Loading background particle effect
    particlesJS.load("particles", "./assets/particles-config.json");

    setPadding();

    resizeSlides();

    let dropzone = new Dropzone("#createBlogPostImage", {
        url: 'createPost.php',
        autoProcessQueue: false,
        addRemoveLinks: true,
        acceptedFiles: "image/*",
        maxFiles: 1,
        accept: (file, done) => {
            done();
        }
    });

    $("#btnCreatePost").click((e) => {
        e.preventDefault();
        e.stopPropagation();
        if (dropzone.getQueuedFiles().length > 0) {
            dropzone.processQueue();
        }
        else {
            formData = new FormData();
            formData.append('title', $("#createPostTitle").val());
            formData.append('text', $("#createPostText").val());

            $.ajax({
                    url: "createPost.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){
                        $("#createPostTitle").val("");
                        $("#createPostText").val("");
                        dropzone.removeAllFiles();
                        location.reload(true);
                    }
            });
        }
    });

    dropzone.on("sending", function (data, xhr, formData) {
        formData.append("title", $("#createPostTitle").val());
        formData.append("text", $("#createPostText").val());
    });

    dropzone.on("complete", function (file) {
        $("#createPostTitle").val("");
        $("#createPostText").val("");
        setTimeout(() => {
            dropzone.removeAllFiles();
            location.reload(true);
        }, 2000);
    });
});

//Adjusting the sections padding when the window is resized
$(window).resize(() => {
    resizeSlides();
});

$(window).on("load", () => {
    //Getting rid of Flash of Unstyled Content
    $("html").css("visibility", "visible");
    $("html").css("opacity", "1");
});

function deletePost(id) {
    //Making Ajax Request to deletePost.php
    $.post("deletePost.php", {id: id}, () => {
        //Refreshing Page to show the changes
        location.reload(true);
    });
}

function buildUpdateForm(id) {
    //Using ajax to retrieve a JSON object representing the post to be updated
    $.getJSON(`getPostInfo.php?id=${id}`, (blogPost) => {
        //Getting rid of the slides currently in the update posts section
        $("#updatePostsSection .slide").remove();

        //Building a form in place of the slides
        let section = $("#updatePostsSection .sectionContainer");
        let form = $("<div id='updatePostForm' class='sectionForm' action='updatePost.php' method='POST'></div>");
        let titleInput = $(`<input type='text' name='title' placeholder='Title' id='updatePostTitle' class='form-control' value='${blogPost.Title}'>`);
        let textInput = $(`<textarea name='text' class='form-control' placeholder='Post Text' id='updatePostText'>${blogPost.Text}</textarea>`);
        let dropzone = $("<div id='updateBlogPostImage' class='dropzone'><div class='dz-message' data-dz-message><span>Drop Images or Click Here to Upload</span></div></div>");
        let updateButton = $("<button type='submit' id='btnUpdatePost'>Update</button>");
        section.append(form);
        form.append(titleInput);
        form.append(textInput);
        form.append(dropzone);
        form.append(updateButton);

        //Reappling active class to update posts section
        $("#updatePostsSection").addClass("active");

        //Reinitializing Fullpage.js
        fullpage_api.destroy("all");
        initializeFullpage();

        //Initializing Dropzone
        dropzone = new Dropzone("#updateBlogPostImage", {
            url: `updatePost.php?id=${id}`,
            autoProcessQueue: false,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            maxFiles: 1,
            accept: (file, done) => {
                done();
            }
        });
    
        $("#btnUpdatePost").click((e) => {
            e.preventDefault();
            e.stopPropagation();
            if (dropzone.getQueuedFiles().length > 0) {
                dropzone.processQueue();
            }
            else {
                formData = new FormData();
                formData.append('title', $("#updatePostTitle").val());
                formData.append('text', $("#updatePostText").val());

                $.ajax({
                        url: `updatePost.php?id=${id}`,
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data){
                            $("#updatePostTitle").val("");
                            $("#updatePostText").val("");
                            dropzone.removeAllFiles();
                            location.reload(true);
                        }
                });
            }
        });
    
        dropzone.on("sending", function (data, xhr, formData) {
            formData.append("title", $("#updatePostTitle").val());
            formData.append("text", $("#updatePostText").val());
        });
        
        dropzone.on("complete", function (file) {
            $("#updatePostTitle").val("");
            $("#updatePostText").val("");
            setTimeout(() => {
                dropzone.removeAllFiles();
                location.reload(true);
            }, 2000);
        });

        $("#updatePostsSection h1").css("margin", "1% 0 0.5% 0");
    });
}

function setPadding() {
    //If the navbar is not hidden apply padding to all sections except the landing page
    if ($("nav").css("top") != -$("nav").height()) {
        $(".sectionContainer, .fp-slides").css("padding-top", $("nav").height());
    }
    else {
        $(".sectionContainer").css("padding-top", 0);
    }
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
        anchors: ["addPost", "deletePosts", "updatePosts"],
        loopHorizontal: false,
        paddingTop: $("nav").height(),
        menu: "#menu",
        onLeave: (origin, destination) => {
            setPadding();

            switch (destination.anchor) {
                case "addPost":
                $("#blogDropdown").css("color", "#44ADE2");
                break;
                case "deletePosts":

                break;
                case "updatePosts":

                break;
            }
        },
        afterLoad: (origin, destination) => {
        }
    });
}