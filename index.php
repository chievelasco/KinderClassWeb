<?php
session_start();
if(isset($_GET['logout'])){($_GET['logout']==1);
session_destroy();
}?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KinderClass Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font awesome icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="style_landpage.css">
    </head>
    <body>

        <!-- header -->
        <header>
            <nav class = "navbar">
                <div class = "container">
                <a href = "landpage.html" class = "navbar-brand">KinderClass</a>
                <div class = "navbar-nav">
                    <a href = "about.html">about</a>
                </div>
                </div>
            </nav>      
        </header>

        <div class="banner">
            <div class="content">
                <h1>KinderClass</h1>
                <p>This website will help you to monitor your child's academic performance.</p> 

                <a href="admin_login.php"><button type="button">ADMIN</button></a>
                <a href="parent_login.php"><button type="button">PARENT</button></a>
            </div>
        
        </div>
    </body>
</html>