<?php
    include 'includes/dbHelper.php';
    $blogPosts = execute("SELECT * FROM blogposts");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Alice Roherty's Portfolio</title>
    <style>
        /*Getting rid of Flash of Unstyled Content*/
        html {
            visibility: hidden;
            opacity: 0;

            /*Getting rid of flash of scroll bar before fullpage is initialized*/
            overflow: hidden;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="./lib/fullpage.min.css" />
    <link rel="stylesheet" type="text/css" href="./lib/animate.css" />
    <link rel="stylesheet" type="text/css" href="./lib/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./lib/dropzone.css" />
    <link rel="stylesheet" type="text/css" href="styles/admin.css" />

    <script src="https://kit.fontawesome.com/bfea4cb977.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-0 pb-0" id="menu">
        <a class="navbar-brand align-items-center" href="#home">
            <img src="assets/Logo.png" alt="Logo" class="d-inline-block align-center" id="logo" />
            Alice Roherty
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#addPost" data-menuanchor="addPost">Add Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="particles"></div>
    <div id="wrapper">
        <div id="addPostSection" class="section">
            <div class="sectionContainer">
                <h1>Add Post</h1>
                <form enctype="multipart/form-data" class="sectionForm" action="/" method="POST">
                    <input type="text" name="title" placeholder="Title" class="form-control" id="title">
                    <textarea name="text" class="form-control" placeholder="Post Text" id="text"></textarea>
                    <div id="blogPostImage" class="dropzone">
                        <div class="dz-message" data-dz-message><span>Drop Files or Click Here to Upload</span></div>
                    </div>
                    <button type="submit" id="btnCreatePost">Create</button>
                </form>
            </div>
        </div>
    </div>

    <script src="lib/fullpage.min.js"></script>
    <script src="lib/particles.js"></script>
    <script src="lib/jquery-3.4.1.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
    <script src="lib/dropzone.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>