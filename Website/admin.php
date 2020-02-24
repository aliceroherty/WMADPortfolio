<?php
include 'includes/dbHelper.php';
$blogPosts = execute("SELECT * FROM blogposts ORDER BY id DESC");
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="blogDropdown">
                        <a class="dropdown-item" href="#addPost" data-menuanchor="addPost">Add Post</a>
                        <a class="dropdown-item" href="#deletePosts" data-menuanchor="deletePosts">Delete Posts</a>
                        <a class="dropdown-item" href="#updatePosts" data-menuanchor="updatePosts">Update Posts</a>
                    </div>
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
        <div id="deletePostsSection" class="section">
            <div class="sectionContainer">
                <h1>Delete Posts</h1>
                <?php
                    if (count($blogPosts) > 0) {
                        for ($i = 1; $i <= count($blogPosts); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }
    
                            $post = $blogPosts[$i - 1];
                            $id = $post->ID;
                            $title = $post->Title;
                            $date = $post->Date;
                            $image = $post->ImagePath;
                            $text = $post->Text;
    
                            if (!empty($image)) {
                                echo 
                                "<div class=\"card blogPost delete\" >
                                    <img class=\"card-img-top img\" src=\"$image\" />
                                    <div class=\"card-body blogPostBody\">
                                        <h3 class=\"card-title\">$title</h3>
                                        <hr />
                                        <p class=\"card-text blogPostDate\">$date</p>
                                    </div>
                                    <i class=\"far fa-times-circle fa-3x\" onclick=\"deletePost($id)\"></i>
                                </div>";
                            } else {
                                echo 
                                "<div class=\"card blogPost delete\">
                                    <img class=\"card-img-top img\" src=\"assets/default.jpg\" />
                                    <div class=\"card-body blogPostBody\">
                                        <h3 class=\"card-title\">$title</h3>
                                        <hr />
                                        <p class=\"card-text blogPostDate\">$date</p>
                                    </div>
                                    <i class=\"far fa-times-circle fa-3x\" onclick=\"deletePost($id)\"></i>
                                </div>";
                            }
    
                            if ($i % 3 == 0 || $i == count($blogPosts)) {
                                echo "</div>
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div id="updatePostsSection" class="section">
            <div class="sectionContainer">
                <h1>Update Posts</h1>
                <?php
                    if (count($blogPosts) > 0) {
                        for ($i = 1; $i <= count($blogPosts); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }
    
                            $post = $blogPosts[$i - 1];
                            $id = $post->ID;
                            $title = $post->Title;
                            $date = $post->Date;
                            $image = $post->ImagePath;
                            $text = $post->Text;
    
                            if (!empty($image)) {
                                echo 
                                "<div class=\"card blogPost\" onclick=\"location.href='/updatePost.php?id=$id'\">
                                    <img class=\"card-img-top\" src=\"$image\" />
                                    <div class=\"card-body blogPostBody\">
                                        <h3 class=\"card-title\">$title</h3>
                                        <hr />
                                        <p class=\"card-text blogPostDate\">$date</p>
                                    </div>
                                </div>";
                            } else {
                                echo 
                                "<div class=\"card blogPost\" onclick=\"location.href='/updatePost.php?id=$id'\">
                                    <img class=\"card-img-top\" src=\"assets/default.jpg\" />
                                    <div class=\"card-body blogPostBody\">
                                        <h3 class=\"card-title\">$title</h3>
                                        <hr />
                                        <p class=\"card-text blogPostDate\">$date</p>
                                    </div>
                                </div>";
                            }
    
                            if ($i % 3 == 0 || $i == count($blogPosts)) {
                                echo "</div>
                                </div>";
                            }
                        }
                    }
                ?>
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