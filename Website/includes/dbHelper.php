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
?>