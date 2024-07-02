<?php
session_start();


if (!isset($_SESSION['loggedin'])) {
  header("Location: index.php");
  exit();
}

include "connect1.php";

$userId = $_SESSION["username"];

$query = "SELECT * FROM reg_info WHERE studID_number = '$userId'";
$result = mysqli_query($conn, $query) or die("Error in query: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($result) or die("No user found with the given ID.");

$pfname = $row['parent_fullname'];
$section = $row['section'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Responsive Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style_main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .home-section{
      position: relative;
      background-color: var(--color-body);
      min-height: 100vh;
      top:0;
      left:0;
      width: 100%;
      transition: all .5s ease;
      z-index: 2;
    }
  </style>
</head>
<body>
  <div class="topbar">
    <span> <?php echo $pfname ?> </span>
      <ul>
        <li>
          <a href="logout2.php" onclick=" return confirm('Are You sure you want to logout?');">
            <i class="fa fa-sign-out" id="log_out"></i>
          </a>
            <!-- <a href="logout.php">
              <i class="fa fa-sign-out" id="log_out"></i>
            </a> -->
          </li>
      </ul>
  </div>
  <div class="navbottom ">
    <div class="logocon">
      <a href="#"><img src="https://i.ibb.co/808b6z7/kinder-class-logo-2.png" alt="logo"></a>
    </div>
    <div class="toggle">
      <a href="#"><i class="fa fa-navicon" id=""></i></a>
    </div>
    <ul class="navmenu">
      <li>
        <a href="user_home_honesty.php" class="active">
          <!--<i class="fa fa-home"></i>-->
          <span>Home</span>
        </a>
      </li>
      <li>
        <a href="user_performanceTracker_honesty.php">
          <!--<i class="fa fa-book"></i>-->
          <span>Performance Tracker</span>
        </a>
      </li>
      <li>
        <a href="user_eventCalendar_honesty.php">
          <!--<i class="fa fa-calendar"></i>-->
          <span>Events Calendar</span>
        </a>
      </li>
      <li>
        <a href="user_profile_setting_honesty.php">
          <!--<i class="fa fa-gear"></i>-->
          <span>Profile Settings</span>
        </a>
      </li>
    </ul>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
      $(function() {
        $(".toggle").on("click", function(){
          if($(".navmenu").hasClass("active")){
            $(".navmenu").removeClass("active");
            $(this).find("a").html("<i class='fa fa-navicon' id=''>");
          } else {
            $(".navmenu").addClass("active");
            $(this).find("a").html("<i class='fa fa-close' id=''>");
          }
        })
    })
  </script>

  <section class="home-section">
    <div class="text">Home - Honesty</div>
    <div class="grid auto-fit">
      <div class="container">
        <h2>WELCOME!</h2>
        <p>This website will serve as your communication
          channel to the adviser of your child.</p>
      </div>

      <div class="container2">
        <h3>Home Learning Rules</h3>
        <?php
          $conn = mysqli_connect("localhost","root","","kinder_class");
          $rulequery = "SELECT * FROM rule WHERE section='Honesty'
          ORDER BY rule_num ASC";
          $result =mysqli_query ($conn,$rulequery);;
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <li> <?php echo $row["rule_num"]?>. <?php echo $row["rule"]?></li>
        <?php
          }
        ?>
      </div>
    </div>
    
    <div class="grid2 auto-fit">
      <div class="container3">
        <h3>Class Schedule</h3>
        <h4>Monday to Friday</h4>
        
        <div class="sched-data">
          <table class=schedTb>
            <thead>
              <tr>
                <td><span>Time</span></td>
                <td><span>Block of Time</span></td>
              </tr>
            </thead>
            <?php
              $conn3 = mysqli_connect("localhost","root","","kinder_class");
              $schedquery = "SELECT * FROM class_schedule WHERE section='Honesty'
              ORDER BY id ASC";
              $result2 =mysqli_query ($conn3,$schedquery);;

              while ($row = mysqli_fetch_assoc($result2)) {
            ?>

            <tbody>
              <td><?php echo $row["startTime"]?> - <?php echo $row["endTime"]?></td>
              <td><?php echo $row["newSched"]?></td>
            </tbody>
            <?php
              }
            ?>
          
          </table>
        </div>
      </div>
      
      <div class="container4">
        <h3>Contact Information</h3>
        <p>In case you have personal concerns regarding your child, you may
          contact me on the following accounts:
        </p>
        <?php
          $conn3 = mysqli_connect("localhost","root","","kinder_class");
          $schedquery = "SELECT * FROM contacts WHERE section='Honesty'
          ORDER BY id ASC";
          $result2 =mysqli_query ($conn3,$schedquery);;

          while ($row = mysqli_fetch_assoc($result2)) {
        ?>
        <li><i class="fa fa-<?php echo $row["contactType"]?>"> <?php echo $row["contactInfo"]?></i></li>
        <?php
          }
        ?>
        
      </div>
    </div>
  </section>
  <!-- Scripts -->
  <script src="scripts.js"></script>
</body>
</html>