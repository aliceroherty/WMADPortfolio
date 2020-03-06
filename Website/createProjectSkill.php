<?php
    include 'includes/dbHelper.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['projectID']) && !empty($_POST['skillID'])) {
            $projectID = $_POST['projectID'];
            $skillID = $_POST['skillID'];

            $dbLink = connect();
            $sql = "INSERT INTO `projectskills`(`ProjectID`, `SkillID`) VALUES (?, ?)";

            if ($cmd = $dbLink->prepare($sql)) {
                $cmd->bind_param("ii", $projectID, $skillID);
                $cmd->execute();
            }
        }
    }
?>