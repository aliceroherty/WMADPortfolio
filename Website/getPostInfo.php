<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        //Fetch Blog Post with ID
        include 'includes/dbHelper.php';

        $sql = "SELECT * FROM `blogposts` WHERE ID = $id";
        $results = execute($sql);

        if (count($results) != 0) {
            $blogPost = $results[0];
            echo json_encode($blogPost);
        }
    }
?>