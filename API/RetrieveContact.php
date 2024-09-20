<?php 
    
    // Get input data
    $inData = getRequestInfo();

    // Setting the variables
    $searchResults = "";
    $phoneList = "";
    $emailList = "";
    $idList = "";
    $searchCount = 0;

    // Connect to the database
    $conn = new mysqli("localhost", "MasterUser", "smallproject", "SmallProject");

    // Check if connection was successful
    if($conn->connect_error){
        returnWithError($conn->connect_error); // Failed connection
    } else {
        // Search the contact 
        $stmt = $conn->prepare("SELECT * FROM Contacts WHERE name LIKE ? AND user_ID = ?");

        // Search pattern 
        $contactName = "%" . $inData["search"] . "%";
        $stmt->bind_param("ss", $contactName, $inData["user_ID"]);

        // Execute SQL
        $stmt->execute();
        $result = $stmt->get_result();

        // Finding the user/users
        while($row = $result->fetch_assoc()){
            if($searchCount > 0){
                $searchResults .= ",";
                $phoneList .= ",";
                $emailList .= ",";
                $idList .= ",";
            }
            $searchCount++;
            $searchResults .='"' . $row["name"] . '"';
            $phoneList .='"' . $row["phone"] . '"';
            $emailList .='"' . $row["email"] . '"';
            $idList .='"' . $row["ID"] . '"';
        }

        // User was not found
        if($searchCount == 0){
            returnWithError("No Records Found");
        } else {
            returnWithInfo($idList, $searchResults, $emailList, $phoneList);
        }

        // Close connections
        $stmt->close();
        $conn->close();
        
    }

    // Helper Functions
    function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo($idList, $searchResults, $emailList, $phoneList)
	{
		$retValue = '{"id":[' . $idList . '],"name":[' . $searchResults . '], "email":[' . $emailList . '] ,"phone":[' . $phoneList . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>