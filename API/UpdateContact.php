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
        //Update contact info
        $stmt = $conn->prepare("UPDATE Contacts SET name = ?, email = ?, phone = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $inData["name"], $inData["email"], $inData["phone"], $inData["ID"]);

        $stmt->execute();

        sendResultInfoAsJson('{"message": "Contact updated."}');

        // Close connections
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