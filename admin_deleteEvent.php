<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: index.php");
  exit();
}
include "connect.php";

$section = $_SESSION["admin-section"];

?>
<?php 
require_once('connect.php');
if(!isset($_GET['id'])){
    echo "<script> alert('Undefined Schedule ID.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Event Deleted.'); location.replace('./admin_eventCalendar_$section.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>