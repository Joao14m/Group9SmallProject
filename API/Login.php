<?php
    
    // Get Input Data
    $inData = getRequestInfo();

    // Setting variables
    $id = 0;
    $firstName = "";
    $lastName = "";

    // Connecting with the database 
    $conn = new mysqli("localhost", "MasterUser", "smallproject", "SmallProject");

    // Check connection 
    if($conn -> connect_error){
        returnWithError($conn->connect_error); // Connection failed
    } else {
        // Gets the user
        $stmt = $conn->prepare("SELECT ID, firstName, lastName FROM Users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $inData["username"], $inData["password"]);

        // Execution
        $stmt->execute();
        $result = $stmt->get_result();

        // Return info if user is found or not found
        if($row = $result->fetch_assoc()){
            returnWithInfo($row['firstName'], $row['lastName'], $row['ID']);
        } else {
            returnWithError("Not found");
        }

        // Closing Connections
        $stmt->close();
        $conn->close();
    }  

    // Helper Functions
    function getRequestInfo(){
        return json_decode(file_get_contents('php://input'), true);
    }

    function sendResultInfoAsJson($obj){
        header('Content-type: application/json');
        echo $obj;
    }

    function returnWithError($err){
        $retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
    }

    function returnWithInfo($firstName, $lastName, $id){
        $retValue = '{"id":' . $id . ',"firstName":"' . $firstName . '","lastName":"' . $lastName . '","error":""}';
		sendResultInfoAsJson( $retValue );
    }

?>