<?php
$id = $_GET['id'];
$con = mysqli_connect("localhost","root","","kinder_class");
$sql = "DELETE FROM files WHERE id ='$id'";
$result = mysqli_query($con, $sql);
if($result)
{
    echo "<script> alert('File Deleted.'); location.replace('./admin_academicResources_honesty.php') </script>";
}
?>