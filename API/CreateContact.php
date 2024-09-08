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
        // Create new contact
        $stmt = $conn->prepare("INSERT INTO Contacts (name, email, phone) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", inData["name"], inData["email"], inData["phone"]);

        $stmt->execute();

        //Finished, close connections
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