<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        //Fetch Blog Post with id
        include 'includes/dbHelper.php';

        $conn = connect();

        $sql = "SELECT * FROM `projects` WHERE ID = ?";

        $project;

        if ($cmd = $conn->prepare($sql)) {
            include_once 'includes/models.php';
            $cmd->bind_param("i", $id);
            $cmd->execute();
            $cmd->bind_result($id, $title, $description, $teaser, $githubLink, $youtubeLink);
            $cmd->fetch();
            $project = new Project($id, $title, $description, $teaser, $githubLink, $youtubeLink);
        }

        if (empty($project)) {
            include_once 'includes/redirect.php';
            redirect_to('index.php');
        } else {
            $images = array();
            $sql = "SELECT Path FROM `projectimages` WHERE ProjectID = ?";

            $dbLink = connect();

            if ($stmt = $dbLink->prepare($sql)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($path);

                while ($stmt->fetch()) {
                    array_push($images, $path);
                }
            }

            if (count($images) == 0) {
                include_once 'includes/redirect.php';
                redirect_to('index.php');
            } else {
                $skills = array();
                $skillsConn = connect();
                $sql = "SELECT skills.Name FROM projectskills INNER JOIN skills ON projectskills.SkillID = skills.ID AND projectskills.ProjectID = ?";
                if ($getSkills = $skillsConn->prepare($sql)) {
                    $projectID = $project->getId();
                    $getSkills->bind_param("i", $projectID);
                    $getSkills->execute();
                    $getSkills->bind_result($name);

                    while ($getSkills->fetch()) {
                        array_push($skills, $name);
                    }
                }

                if (count($skills) == 0) {
                    include_once 'includes/redirect.php';
                    redirect_to('index.php');
                }
            }
        }
    } else {
        include_once 'includes/redirect.php';
        redirect_to("index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Project</title>
    <style>
        /*Getting rid of Flash of Unstyled Content*/
        html {
            visibility: hidden;
            opacity: 0;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="./lib/animate.css" />
    <link rel="stylesheet" type="text/css" href="./lib/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="styles/project.css" />
    <script src="lib/particles.js" defer></script>
    <script src="lib/jquery-3.4.1.min.js" defer></script>
    <script src="lib/bootstrap.min.js" defer></script>
    <script src="js/project.js" defer></script>
    <script src="https://kit.fontawesome.com/bfea4cb977.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-0 pb-0 fixed-top" id="menu">
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
                    <a class="nav-link active" href="index.php#portfolio" data-menuanchor="portfolio">Portfolio</a>
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
        <div id="project">
            <div id="carouselContainer" class="mx-auto carousel">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                            for ($i = 0; $i < count($images); $i++) {
                                if ($i == 0) {
                                    echo "<li data-target=\"#carousel\" data-slide-to=\"$i\" class=\"active\"></li>";
                                } else {
                                    echo "<li data-target=\"#carousel\" data-slide-to=\"$i\"></li>";
                                }
                            }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                            for ($i = 0; $i < count($images); $i++) {
                                $path = $images[$i];
                                $slideNum = $i + 1;

                                if ($i == 0) {
                                    echo 
                                    "<div class=\"carousel-item active\">
                                        <img class=\"d-block w-100\" src=\"$path\" alt=\"Slide $slideNum\">
                                    </div>";
                                } else {
                                    echo 
                                    "<div class=\"carousel-item\">
                                        <img class=\"d-block w-100\" src=\"$path\" alt=\"Slide $slideNum\">
                                    </div>";
                                }
                            }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <h1><?php echo $project->getTitle(); ?></h1>
            <hr/>
            <div id="infoContainer">
                <div id="skillsContainer">
                    <h2>Skills:</h2>
                    <ul>
                        <?php
                            for ($i = 0; $i < count($skills); $i++) {
                                $skillName = $skills[$i];
                                echo "<li>$skillName</li>";
                            }
                        ?>
                    </ul>
                </div>
                <div id="iconContainer">
                    <?php
                        $githubLink = $project->getGithubLink();
                        $youtubeLink = $project->getYoutubeLink();

                        if (!empty($githubLink)) {
                            echo "<i class=\"fab fa-github\" onclick=\"window.open('$githubLink')\"></i>";
                        }

                        if (!empty($youtubeLink)) {
                            echo "<i class=\"fab fa-youtube\" onclick=\"window.open('$youtubeLink')\"></i>";
                        }
                    ?>
                    
                    
                </div>
            </div>
            <hr/>
            <?php
                echo $project->getDescription();
            ?>
        </div>
    </div>
</body>
</html>