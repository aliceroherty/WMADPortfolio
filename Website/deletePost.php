<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        
        include 'includes/dbHelper.php';
        $conn = connect();
        $sql = "DELETE FROM blogposts WHERE ID = ?";

        if ($cmd = $conn->prepare($sql)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
        }
    }
?>