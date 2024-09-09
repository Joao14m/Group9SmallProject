<?php

    // Get input data
    $inData = getRequestData();

    $con = new mysqli("localhost", "username", "password", "SmallProject");

    if($conn->connect_error){
        returnWithError($conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("DELETE FROM Contacts WHERE name = ? AND email = ? AND phone = ?");
        $stmt->bind_param("sss", $inData["name"], $inData["email"], $inData["phone"]);

        $stmt->execute();

        if($stms->affected_rows > 0){
            sendResultInfoAsJson('{"message": "Contact deleted."}');
        } else {
            returnWithError("No contact found.");
        }

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