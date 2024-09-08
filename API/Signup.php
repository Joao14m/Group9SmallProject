<?php

    // Get input data
    $inData = getRequestData();

    // Connect to database (placeholder login)
    $conn = new mysqli("localhost", "username", "password", "SmallProject");

    // Check if connection was successful
    if ($conn->connect_error) {
        // Connection failed
        returnWithError($conn->connect_error);
    }
    else {
        // Check if user already exists via username
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->bind_param("s", inData[username]);

        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 1) {
            // Username already exists
            returnWithError("Account already exists");
        }
        else {
            // Create new user
            $stmt = $conn->prepare("INSERT INTO Users (firstName, lastName, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", inData["firstName"], inData["lastName"], inData["username"], inData["password"]);

            $stmt->execute();
        }

        // Finished, close all connections
        $stmt->close();
        $conn->close();
    }

    // Helper functions
    function getRequestData() {
        return json_decode(file_get_contents('php://input'), true);
    }

    function sendResultInfoAsJson($obj) {
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError($err) {
		$retVal = '{"Error":"' . $err . '"}';
		sendResultInfoAsJson($retVal);
	}

?>