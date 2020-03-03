<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        
        include 'includes/dbHelper.php';
        $conn = connect();

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

        $delete = "DELETE FROM blogposts WHERE ID = ?";

        if ($cmd = $conn->prepare($delete)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
        }
    }
?>