<?php
$contactId = $_GET['id'];
$con = mysqli_connect("localhost","root","","kinder_class");
$sql = "DELETE FROM contacts WHERE id ='$contactId'";
$result = mysqli_query($con, $sql);
if($result)
{
    echo "<script> alert('Contact deleted.'); location.replace('./admin_home_charity.php') </script>";
}
?>