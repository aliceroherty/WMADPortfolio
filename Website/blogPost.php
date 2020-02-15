<?php
    $id = $_GET['id'];
    $blogPost;

    if (empty($id) || !is_int($id)) {
        //Return bad request
    } else {
        //Fetch Blog Post with ID
        include 'includes/dbHelper.php';

        $sql = "SELECT * FROM `blogposts` WHERE ID = $id";
        $blogPost = execute($sql)[0];
    }

    if (empty($blogPost)) {
        //Return bad request
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        echo $blogPost;
    ?></title>
</head>
<body>
    <?php
        echo "$blogPost->Title";
    ?>
</body>
</html>