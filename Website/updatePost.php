<?php
    include 'includes/dbHelper.php';
    include 'includes/fileCheck.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_GET['id'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $id = $_GET['id'];
            global $image;

            if($_FILES["file"]["error"] == 0) {
                $file = $_FILES["file"]["tmp_name"];
                $file_info = new finfo(FILEINFO_MIME);
    
                //file_get_contents reads the file to a string
                $mime_type_long = $file_info->buffer(file_get_contents($file));
    
                $position = strpos($mime_type_long, ";");
    
                //using substring to manipulate our mime type string
                $mime_type = substr($mime_type_long, 0, $position);
    
                switch ($mime_type) {
                    case 'image/jpeg':
                        $image = fileCheck($file);
                    break;
                    case 'image/jpg':
                        $image = fileCheck($file);
                    break;
                    case 'image/gif':
                        $image = fileCheck($file);
                    break;
                    case 'image/png':
                        $image = fileCheck($file);
                    break;
                    case 'image/bmp':
                        $image = fileCheck($file);
                    break;
                    case 'image/pjpeg':
                        $image = fileCheck($file);
                    break;
                    case 'image/x-png':
                        $image = fileCheck($file);
                    break;
                    default:
                        //Mime type is not allowed
                    break;
                }

                $dbLink = connect();
                $sql = "UPDATE `blogposts` SET `Title`=?, `Text`=?, `ImagePath`=? WHERE ID = ?";

                if ($cmd = $dbLink->prepare($sql)) {
                    $cmd->bind_param("sssi", $title, $text, $image, $id);
                    $cmd->execute();
                    $cmd->close();
                }

                $dbLink->close();
            } else if ($_FILES["file"]["error"] == 4) {
                //No File Was Uploaded
                $image = null;

                //Getting rid of stored image
                $selectImagePath = "SELECT ImagePath FROM blogposts WHERE ID = ?";

                if ($cmd = $conn->prepare($selectImagePath)) {
                    $cmd->bind_param("i", $id);
                    $cmd->execute();
                    $cmd->bind_result($imagePath);
                    $cmd->fetch();
                    $cmd->close();
                }

                if (isset($imagePath) && $imagePath != "") {
                    unlink($imagePath);
                }

                //Updating DB Record
                $dbLink = connect();
                $sql = "UPDATE `blogposts` SET `Title`=?, `Text`=?, `ImagePath`=? WHERE ID = ?";

                if ($cmd = $dbLink->prepare($sql)) {
                    $cmd->bind_param("sssi", $title, $text, $image, $id);
                    $cmd->execute();
                    $cmd->close();
                }

                $dbLink->close();
            }
        }
    }
?>