<?php
    function fileCheck($file) {
        $img_info_array = getimagesize($file);

        if ($img_info_array !== false) {
            $uploadDirectory = 'uploads/';
            $fileName = basename($_FILES["file"]["name"]);
            $uploadFile = $uploadDirectory . $fileName;

            if (file_exists($uploadFile)) {
                if ($dotPosition = strpos($fileName, ".")) {
                    $name = substr($fileName, 0, $dotPosition);
                    $extension = substr($fileName, $dotPosition);
                } else {
                    $name = $fileName;
                }

                $newPath = $uploadFile;
                $newName = $fileName;
                $counter = 0;

                while (file_exists($newPath)) {
                    $newName = $name . "_" . $counter . $extension;
                    $newPath = $uploadDirectory . $newName;
                    $counter++;
                }

                move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);

                return $newPath;
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile);
            }
        }

        return $uploadFile;
    }
    
    function multipleFileCheck($file, $index) {
        $img_info_array = getimagesize($file);

        if ($img_info_array !== false) {
            $uploadDirectory = 'uploads/';
            $fileName = basename($_FILES["file"]["name"][$index]);
            $uploadFile = $uploadDirectory . $fileName;

            if (file_exists($uploadFile)) {
                if ($dotPosition = strpos($fileName, ".")) {
                    $name = substr($fileName, 0, $dotPosition);
                    $extension = substr($fileName, $dotPosition);
                } else {
                    $name = $fileName;
                }

                $newPath = $uploadFile;
                $newName = $fileName;
                $counter = 0;

                while (file_exists($newPath)) {
                    $newName = $name . "_" . $counter . $extension;
                    $newPath = $uploadDirectory . $newName;
                    $counter++;
                }

                move_uploaded_file($_FILES["file"]["tmp_name"][$index], $newPath);

                return $newPath;
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"][$index], $uploadFile);
            }
        }

        return $uploadFile;
    }
?>