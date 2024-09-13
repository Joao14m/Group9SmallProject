<?php

    // Get input data
    $inData = getRequestData();

    // Connect to the database
    $conn = new mysqli("localhost", "MasterUser", "smallproject", "SmallProject");

    // Check connection
    if($conn->connect_error){
        returnWithError($conn->connect_error); // Connection failed
    }
    else {
        // Delete contact
        $stmt = $conn->prepare("DELETE FROM Contacts WHERE name = '?' AND email = '?' AND phone = '?' AND user_ID = ?");
        $stmt->bind_param("sssi", $inData["name"], $inData["email"], $inData["phone"], $inData["user_ID"]);

        $stmt->execute();

        // Check if contact was delete or it does not exist
        if($stmt->affected_rows > 0){
            sendResultInfoAsJson('{"message": "Contact deleted."}');
        } else {
            returnWithError("No contact found.");
        }

        // Closing connections
        $stmt->close();
        $conn->close();
    }

    function getRequestData(){
        return json_decode(file_get_contents('php://input'), true);
    }

    function sendResultInfoAsJson($obj){
        header('Content-type: application/json');
        echo $obj;
    }

    function returnWithError($err){
        $retVal = '{"Error":"' . $err . '"}';
        sendResultInfoAsJson($retVal);
    }

?>