<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: index.php");
  exit();
}

include "connect.php";

$admin = $_SESSION["username"];
$query = "SELECT * FROM admin_login WHERE email = '$admin'";
$result = mysqli_query($conn, $query) or die("Error in query: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($result) or die("No user found with the given account.");
$section = $row['section'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="style22.css">
  
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </style>
</head>
<body>
  <div class="topnav" id="myTopnav">
    <a class="active"><img src="https://i.ibb.co/808b6z7/kinder-class-logo-2.png" class="website-logo"><a>
    <a href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>

  <div style="padding-left:16px">
    <h2>Responsive Topnav Example</h2>
    <p>Resize the browser window to see how it works.</p>
  </div>

  <script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
  </script>

</body>
</html>