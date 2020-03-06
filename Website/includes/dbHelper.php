<?php
    function connect() {
        $conn = new mysqli('localhost', 'site', 'IkzDjF8tj3FsgVxE', 'portfolio');

        if ($conn->connect_errno) {
            printf("Unable to Connect to Database: %s", $conn->connect_errno);
            exit();
        }

        if (!$conn) {
            die("Connection Failed: " . $conn->error());
        }

        return $conn;
    }

    function execute($query) {
        $conn = connect();
        $result = $conn->query($query);

        $results = array();

        while ($row = $result->fetch_object()) {
            array_push($results, $row);
        }

        $conn->close();

        return $results;
    }

    function getProjectSkillImage($id) {
        $conn = connect();

        $selectSkillID = "SELECT SkillID FROM projectskills WHERE ProjectID = ? LIMIT 1";

        if ($cmd = $conn->prepare($selectSkillID)) {
            $cmd->bind_param("i", $id);
            $cmd->execute();
            $cmd->bind_result($skillID);
            $cmd->fetch();
            $cmd->close();
        }

        $selectImagePath = "SELECT ImagePath FROM skills WHERE ID = ?";

        if ($cmd = $conn->prepare($selectImagePath)) {
            $cmd->bind_param("i", $skillID);
            $cmd->execute();
            $cmd->bind_result($imagePath);
            $cmd->fetch();
            $cmd->close();
        }

        return $imagePath;
    }
?>