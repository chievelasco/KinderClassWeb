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
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .progressbar-rate{
      display: flex;
      justify-content: center;
      background-image: repeating-linear-gradient(to left, #FFD89C, #F1C27B, #E9B384);
      box-shadow: 0 5px 5px -6px #FFD89C, 0 3px 7px #F1C27B;
      border-radius: 20px;
      color: #fff;
      font-size: 15px;
      height: 100%;
      width: 0;
      transition: 1s ease 0.3s;
    }
    .website-logo{
      width: 50px;
      display: flex;
      align-items: center;
      position: relative;
      transition: all .5s ease;
    }
    .sidebar.open .website-logo{
      width: 200px;
      display: flex;
      align-items: center;
      position: relative;
      margin-top: -95px;
      transition: all .5s ease;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo_details">
      <i class="fa fa-navicon" id="btn"></i>
    </div>
    <img src="https://i.ibb.co/9gPHTr8/kinder-class-logo-1.png" class="website-logo">
    <ul class="nav-list">
      <li>
        <a href="user_home_honesty.php" class="active">
          <i class="fa fa-home"></i>
          <span class="link_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="user_performanceTracker_honesty.php">
          <i class="fa fa-book"></i>
          <span class="link_name">Performance Tracker</span>
        </a>
        <span class="tooltip">Performance Tracker</span>
      </li>
      <li>
        <a href="user_eventCalendar_honesty.php">
          <i class="fa fa-calendar"></i>
          <span class="link_name">Events Calendar</span>
        </a>
        <span class="tooltip">Events Calendar</span>
      </li>
      <li>
        <a href="user_profile_setting_honesty.php">
          <i class="fa fa-gear"></i>
          <span class="link_name">Profile Settings</span>
        </a>
        <span class="tooltip">Profile Settings</span>
      </li>
      <li class="profile">
        <div class="profile_details">
          <div class="profile_content">
            <div class="name"><?php echo $pfname ?></div>
            <div class="designation"> Parent</div>
          </div>
        </div>
        <a id="log_out" href="logout.php">
          <i class="fa fa-sign-out"></i>
        </a>
      </li>
    </ul>
  </div>

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