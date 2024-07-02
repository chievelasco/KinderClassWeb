<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ange"; // REPLACE WITH DB NAME

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

if (!$conn) {
    die("Connection Failed. " . mysqli_connect_error());
    echo "can't connect to the database";
}

function executeQuery($query)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ange"; // REPLACE WITH DB NAME

    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);

    $results = mysqli_query($conn, $query);
    // Close the database connection after executing the query
    mysqli_close($conn);

    return $results;
}
?>
