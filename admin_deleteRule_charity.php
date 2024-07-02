<?php
$ruleId = $_GET['id'];
$con = mysqli_connect("localhost","root","","kinder_class");
$sql = "DELETE FROM rule WHERE id ='$ruleId'";
$result = mysqli_query($con, $sql);
if($result)
{
    echo "<script> alert('Rule deleted.'); location.replace('./admin_home_charity.php') </script>";
}
?>