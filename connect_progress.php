<?php
    $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "ange"; //REPLACE WITH DB NAME

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}

	
    function executesQuery($query){
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$db = "ange"; //REPLACE WITH DB NAME

		$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    	$results = mysqli_query($conn, $query);
    	// Close the database connection after executing the query
   	 	mysqli_close($conn);

    	return $results;
    }
?>




