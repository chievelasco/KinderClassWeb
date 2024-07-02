<?php 
    session_start();

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include "connect.php";

    $error = ""; 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-log"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]); 
        $password = mysqli_real_escape_string($conn, $_POST["password"]); 

        $query = "SELECT * FROM reg_info WHERE studID_number = '$username' AND password = '$password'";
        $results = executeQuery($query);
        
        if(mysqli_num_rows($results) > 0) {
            $row = mysqli_fetch_assoc($results);
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;

            $section = $row["section"];

  
            if ($section == "Honesty") {
                header("Location: user_home_honesty.php");
            } elseif ($section == "Charity") {
                header("Location: user_home_charity.php");
            } else {
               
                header("Location: parent_login.php");
            }
        } else {
            $error = "Wrong username or password!";
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <title>Login</title>

        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #62969F;
                font-family: sans-serif;
            }
            .login-box {
                width: 480px;
                height: 390px;
                background: #fff;
                top: 50%;
                left: 50%;
                position: absolute;
                transform: translate(-50%, -50%);
                box-sizing: border-box;
                padding: 70px 30px;
            }
            .avatar {
                width: 250px;
                height: 250px;
                position: absolute;
                left: 25%;
                top: -10%;
            }
            h1 {
                margin: 0;
                padding: 0 0 20px;
                text-align: center;
                font-size: 15px;
                margin-top: 70px;
                color: #297582;
                margin-left: 10px;
            }
            .login-box p {
                margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .login-box input {
                width: 100%;
                margin-bottom: 20px;
                
            }
            .login-box input[type="text"], input[type="password"] {
                border: none;
                border-bottom: 1px solid #fff;
                background: #D9D9D9;
                outline: none;
                height: 40px;
                width: 300px;
                color: #545454;
                font-size: 16px;
                border-radius: 10px;
                padding-left: 20px;
                padding-right: 20px;
                margin-left: 60px;
            }
            .login-box button {
                border: none;
                outline: none;
                height: 35px;
                width: 100px;
                background: #1c8adb;
                font-size: 18px;
                border-radius: 10px;
               margin-bottom: 10px;
                margin-left: 160px;
                color: #fff;
            }
            .login-box button:hover {
                cursor: pointer;
                background: #39dc79;
                color: #000;
            }
            .login-box a {
                text-decoration: none;
                font-size: 14px;
                color: #62969F;
                
                
            }
            .login-box p span {
                font-size: 12px;
                text-decoration: none;
                color: gray;
                margin-left: 70px;
            }
            .login-box a:hover {
                color: #39dc79;
            }
            .invalid-feedback{
                margin-top: 0;
                margin-bottom: 0;
                margin: 0;
                padding: 0 0 20px;
                text-align: center;
                font-size: 16px;
                color: #C80815;
                margin-left: 10px;
                font-style:none;
                font-weight:0;

            }


        </style>

    </head>
    <body>
        <div class="login-box">
        <form method="POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <img src="https://i.ibb.co/vLvDRJ7/logo-2-1.png" class="avatar">
                <h1>Login</h1> 
                <p class="invalid-feedback"><?php echo $error; ?></p>
                <!--<p>Student ID Number</p> -->
                <input type="text" name="username" id="username" placeholder=" Student ID Number" required>
                <!-- <p>Password</p> -->
                <input type="password" name="password" id="password" placeholder=" Password" required>
                 
                <button class="submit-log" type="submit" name="submit-log" id="submit-log">Login</button><br>
                <p><span>Don't have an account?</span> <a href="user-registration.php">Register Here</a></p>
            </form>
        </div>
        
    </body>
</html>