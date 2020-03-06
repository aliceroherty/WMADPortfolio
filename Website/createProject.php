<?php
    include 'includes/dbHelper.php';
    include 'includes/fileCheck.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['title']) && !empty($_POST['teaser']) && !empty($_POST['description'])) {
            $title = $_POST['title'];
            $teaser = $_POST['teaser'];
            $description = $_POST['description'];
            $githubLink;
            $youtubeLink;

            if (!empty($_POST['youtubeLink'])) {
                $youtubeLink = $_POST['youtubeLink'];
            }
            
            if (!empty($_POST['githubLink'])) {
                $githubLink = $_POST['githubLink'];
            }

            $dbLink = connect();
            $sql = "INSERT INTO `projects`(`Title`, `Description`, `Teaser`, `GithubLink`, `YoutubeLink`) VALUES (?, ?, ?, ?, ?)";

            if ($cmd = $dbLink->prepare($sql)) {
                $cmd->bind_param("sssss", $title, $description, $teaser, $githubLink, $youtubeLink);
                $cmd->execute();
            }

            $id = $dbLink->insert_id;

            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                if($_FILES["file"]["error"][$i] == 0) {
                    $file = $_FILES["file"]["tmp_name"][$i];
                    $file_info = new finfo(FILEINFO_MIME);
        
                    //file_get_contents reads the file to a string
                    $mime_type_long = $file_info->buffer(file_get_contents($file));
        
                    $position = strpos($mime_type_long, ";");
        
                    //using substring to manipulate our mime type string
                    $mime_type = substr($mime_type_long, 0, $position);
        
                    switch ($mime_type) {
                        case 'image/jpeg':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/jpg':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/gif':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/png':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/bmp':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/pjpeg':
                            $image = multipleFileCheck($file, $i);
                        break;
                        case 'image/x-png':
                            $image = multipleFileCheck($file, $i);
                        break;
                        default:
                            //Mime type is not allowed
                        break;
                    }

                    $dbLink = connect();
                    $sql = "INSERT INTO `projectimages`(`Path`, `ProjectID`) VALUES (?, ?)";

                    if ($cmd = $dbLink->prepare($sql)) {
                        $cmd->bind_param("si", $image, $id);
                        $cmd->execute();
                    }
                } else {
                    //File size too large
                }
            }
        }
    }
?>