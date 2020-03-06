<?php
    include 'includes/dbHelper.php';
    $blogPosts = execute("SELECT * FROM blogposts ORDER BY id DESC");
    $projects = execute("SELECT * FROM projects ORDER BY id DESC");
    $skills = execute("SELECT * FROM skills ORDER BY id DESC");
    //dfvdvdv
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
                        <a class="dropdown-item" href="#deletePosts" data-menuanchor="deletePosts">Delete Post</a>
                        <a class="dropdown-item" href="#updatePosts" data-menuanchor="updatePosts">Update Post</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="portfolioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Portfolio
                    </a>
                    <div class="dropdown-menu" aria-labelledby="portfolioDropdown">
                        <a class="dropdown-item" href="#addProject" data-menuanchor="addProject">Add Project</a>
                        <a class="dropdown-item" href="#addProjectSkills" data-menuanchor="addProjectSkills">Add Project Skills</a>
                        <a class="dropdown-item" href="#deleteProject" data-menuanchor="deleteProject">Delete Project</a>
                        <a class="dropdown-item" href="#updateProject" data-menuanchor="updateProject">Update Project</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="skillsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Skills
                    </a>
                    <div class="dropdown-menu" aria-labelledby="skillsDropdown">
                        <a class="dropdown-item" href="#addSkill" data-menuanchor="addSkill">Add Skill</a>
                        <a class="dropdown-item" href="#deleteSkill" data-menuanchor="deleteSkill">Delete Skill</a>
                        <a class="dropdown-item" href="#updateSkill" data-menuanchor="updateSkill">Update Skill</a>
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
                <form id="addPostForm" class="sectionForm" enctype="multipart/form-data" action="/" method="POST">
                    <input type="text" name="title" placeholder="Title" class="form-control" id="createPostTitle">
                    <textarea name="text" class="form-control" placeholder="Post Text" id="createPostText"></textarea>
                    <div id="createBlogPostImage" class="dropzone">
                        <div class="dz-message" data-dz-message><span>Drop Images or Click Here to Upload</span></div>
                    </div>
                    <button type="submit" id="btnCreatePost">Create</button>
                </form>
            </div>
        </div>
        <div id="deletePostsSection" class="section">
            <div class="sectionContainer">
                <h1>Delete Post</h1>
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
                <h1>Update Post</h1>
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
                                "<div class=\"card blogPost\" onclick=\"buildUpdatePostForm($id)\">
                                    <img class=\"card-img-top\" src=\"$image\" />
                                    <div class=\"card-body blogPostBody\">
                                        <h3 class=\"card-title\">$title</h3>
                                        <hr />
                                        <p class=\"card-text blogPostDate\">$date</p>
                                    </div>
                                </div>";
                            } else {
                                echo 
                                "<div class=\"card blogPost\" onclick=\"buildUpdatePostForm($id)\">
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
        <div id="addProjectSection" class="section">
            <div class="sectionContainer">
                <h1>Add Project</h1>
                <form id="addProjectForm" class="sectionForm" enctype="multipart/form-data" action="/" method="POST">
                    <input type="text" name="title" placeholder="Title" class="form-control" id="createProjectTitle">
                    <input type="text" name="teaser" placeholder="Teaser" class="form-control" id="createProjectTeaser">
                    <input type="text" name="githubLink" placeholder="GitHub Link" class="form-control" id="createProjectGithubLink">
                    <input type="text" name="youtubeLink" placeholder="YouTube Link" class="form-control" id="createProjectYoutubeLink">
                    <textarea name="description" class="form-control" placeholder="Description" id="createProjectDescription"></textarea>
                    <div id="createProjectImages" class="dropzone">
                        <div class="dz-message" data-dz-message><span>Drop Images or Click Here to Upload</span></div>
                    </div>
                    <button type="submit" id="btnCreateProject">Create</button>
                </form>
            </div>
        </div>
        <div id="addProjectSkillsSection" class="section">
            <div class="sectionContainer">
                <h1>Add Project Skills</h1>
                <form id="addProjectSkillsForm" class="sectionForm" method="POST" onSubmit="return false;">
                    <select name="projectID" size="7" class="form-control text-center" id="addProjectSkillProjectID">
                        <?php
                            for ($i = 0; $i < count($projects); $i++) {
                                $name = $projects[$i]->Title;
                                $id = $projects[$i]->ID;
                                echo "<option value=\"$id\">$name</option>";
                            }
                        ?>
                    </select>
                    
                    <select name="skillID" size="7" class="form-control text-center" id="addProjectSkillSkillID">
                        <?php
                            for ($i = 0; $i < count($skills); $i++) {
                                $name = $skills[$i]->Name;
                                $id = $skills[$i]->ID;
                                echo "<option value=\"$id\">$name</option>";
                            }
                        ?>
                    </select>
                    
                    <button id="btnAddProjectSkill">Add</button>
                </form>
            </div>
        </div>
        <div id="deleteProjectSection" class="section">
            <div class="sectionContainer">
                <h1>Delete Project</h1>
                <?php
                    if (count($projects) > 0) {
                        for ($i = 1; $i <= count($projects); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }
    
                            $project = $projects[$i - 1];
                            $id = $project->ID;
                            $title = $project->Title;
                            $teaser = $project->Teaser;
                            $image = getProjectSkillImage($id);
    
                            echo 
                            "<div class=\"card project delete\">
                                <div class=\"card-body projectBody\">
                                    <img class=\"projectIcon img-fluid\" src=\"$image\" alt=\"\" />
                                    <h3 class=\"card-title\">$title</h3>
                                    <hr />
                                    <p class=\"card-text projectTeaser\">$teaser</p>
                                    <i class=\"far fa-times-circle fa-3x\" onclick=\"deleteProject($id)\"></i>
                                </div>
                            </div>";
    
                            if ($i % 3 == 0 || $i == count($projects)) {
                                echo "</div>
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div id="updateProjectSection" class="section">
            <div class="sectionContainer">
                <h1>Update Project</h1>
                <?php
                    if (count($projects) > 0) {
                        for ($i = 1; $i <= count($projects); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }
    
                            $project = $projects[$i - 1];
                            $id = $project->ID;
                            $title = $project->Title;
                            $teaser = $project->Teaser;
                            $image = getProjectSkillImage($id);
    
                            echo 
                            "<div class=\"card project\">
                                <div class=\"card-body projectBody\">
                                    <img class=\"projectIcon img-fluid\" src=\"$image\" alt=\"\" />
                                    <h3 class=\"card-title\">$title</h3>
                                    <hr />
                                    <p class=\"card-text projectTeaser\">$teaser</p>
                                </div>
                            </div>";
    
                            if ($i % 3 == 0 || $i == count($projects)) {
                                echo "</div>
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div id="addSkillSection" class="section">
            <div class="sectionContainer">
                <h1>Add Skill</h1>
                <form id="addSkillForm" class="sectionForm" enctype="multipart/form-data" action="/" method="POST">
                    <input type="text" name="name" placeholder="Name" class="form-control" id="addSkillName">
                    <div id="createSkillImage" class="dropzone">
                        <div class="dz-message" data-dz-message><span>Drop Images or Click Here to Upload</span></div>
                    </div>
                    <button type="submit" id="btnCreateSkill">Create</button>
                </form>
            </div>
        </div>
        <div id="deleteSkillSection" class="section">
            <div class="sectionContainer">
                <h1>Delete Skill</h1>
                <?php
                    if (count($skills) != 0) {
                        for ($i = 1; $i <= count($skills); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }

                            $skill = $skills[$i - 1];
                            $id = $skill->ID;
                            $name = $skill->Name;
                            $image = $skill->ImagePath;

                            echo 
                                "<div class=\"card project skill delete\" onclick=\"deleteSkill($id)\">
                                    <div class=\"card-body projectBody skillBody\">
                                        <img class=\"projectIcon img-fluid\" src=\"$image\" \>
                                        <h3 class=\"card-title skillName\">$name</h3>
                                        <i class=\"far fa-times-circle fa-3x\" onclick=\"deleteSkill($id)\"></i>
                                    </div>
                                </div>";

                            if ($i % 3 == 0 || $i == count($skills)) {
                                echo "</div>
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div id="updateSkillSection" class="section">
            <div class="sectionContainer">
                <h1>Update Skill</h1>
                <?php
                    if (count($skills) != 0) {
                        for ($i = 1; $i <= count($skills); $i++) {
                            if ($i % 3 == 1) {
                                echo "<div class=\"slide\">
                                <div class=\"slideContainer\">";
                            }

                            $skill = $skills[$i - 1];
                            $id = $skill->ID;
                            $name = $skill->Name;
                            $image = $skill->ImagePath;

                            echo 
                                "<div class=\"card project skill\" onclick=\"buildUpdateSkillForm($id)\">
                                    <div class=\"card-body projectBody skillBody\">
                                        <img class=\"projectIcon img-fluid\" src=\"$image\" \>
                                        <h3 class=\"card-title skillName\">$name</h3>
                                    </div>
                                </div>";

                            if ($i % 3 == 0 || $i == count($skills)) {
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