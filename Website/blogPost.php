<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        //Fetch Blog Post with ID
        include 'includes/dbHelper.php';

        $sql = "SELECT * FROM `blogposts` WHERE ID = $id";
        $results = execute($sql);

        if (count($results) == 0) {
            include 'includes/redirect.php';
            redirect_to('index.php');
        } else {
            $blogPost = $results[0];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>

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
    <link rel="stylesheet" type="text/css" href="styles/blogPost.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-0 pb-0" id="menu">
        <a class="navbar-brand align-items-center" href="index.php#home">
            <img src="assets/Logo.png" alt="Logo" class="d-inline-block align-center" id="logo" />
            Alice Roherty
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php#home" data-menuanchor="home">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about" data-menuanchor="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#portfolio" data-menuanchor="portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#blog" data-menuanchor="blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact" data-menuanchor="contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#resume" data-menuanchor="resume">Resume</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="particles"></div>

    <div id="wrapper">
        <h1><?php echo $blogPost->Title?></h1>
    </div>
    
    <script src="lib/fullpage.min.js"></script>
    <script src="lib/particles.js"></script>
    <script src="lib/jquery-3.4.1.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
    <script src="js/blogPost.js"></script>
</body>
</html>