<?php

    // Get input data
    $inData = getRequestData();

    // Connect to database
    $conn = new mysqli("localhost", "MasterUser", "smallproject", "SmallProject");

    // Check if connection was successful
    if ($conn->connect_error) {
        // Connection failed
        returnWithError($conn->connect_error);
    }
    else {
        // Create new contact
        $stmt = $conn->prepare("INSERT INTO Contacts (user_ID, name, email, phone) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("isss", $inData["user_ID"] , $inData["name"], $inData["email"], $inData["phone"]);

        $stmt->execute();

        sendResultInfoAsJson('{"message": "Contact created."}');

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