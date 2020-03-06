<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        
        include 'includes/dbHelper.php';
        $conn = connect();

        $selectImagePath = "SELECT Path FROM projectimages WHERE ProjectID = ?";

        if ($cmd = $conn->prepare($selectImagePath)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
            $cmd->bind_result($imagePath);

            while ($cmd->fetch()) {
                unlink($imagePath);
            }
            
            $cmd->close();
        }

        $deleteImages = "DELETE FROM projectimages WHERE ProjectID = ?";

        if ($cmd = $conn->prepare($deleteImages)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
        }

        $deleteSkills = "DELETE FROM projectskills WHERE ProjectID = ?";

        if ($cmd = $conn->prepare($deleteSkills)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
        }

        $deleteProject = "DELETE FROM projects WHERE ID = ?";

        if ($cmd = $conn->prepare($deleteProject)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
        }
    }
?>