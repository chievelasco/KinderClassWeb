<?php
session_start();


include "connect1.php";


$userId = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

$progressQuery = "SELECT week, percent, remark FROM progress WHERE studID_number = ?";
$progressStmt = mysqli_prepare($conn, $progressQuery);
mysqli_stmt_bind_param($progressStmt, "s", $userId);
mysqli_stmt_execute($progressStmt);
$progressResult = mysqli_stmt_get_result($progressStmt);

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
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <style>
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
    .remarks_container {
      width: auto;
      height: 100px;
      text-align: left;
      margin-left: 15px;
      margin-top: 15px;
      box-sizing: border-box;
      background: #fff;
      border-style: solid;
      border-color: #297582;
      margin-right: 15px;
    }
    .remarks_container h5 {
      font-size: 15px;
      color: #000;
      margin-left: 5px;
      font-weight: normal;
    }
    .remarks_container h5 span {
      font-size: 15px;
      color: #000;
      margin-left: 5px;
      font-weight: bold;
    }
    .weekly_pt {
      margin-top: 20px;
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
        <a href="user_home_charity.php" >
          <i class="fa fa-home"></i>
          <span class="link_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="user_performanceTracker_charity.php" class="active">
          <i class="fa fa-book"></i>
          <span class="link_name">Performance Tracker</span>
        </a>
        <span class="tooltip">Performance Tracker</span>
      </li>
      <li>
        <a href="user_eventCalendar_charity.php">
          <i class="fa fa-calendar"></i>
          <span class="link_name">Events Calendar</span>
        </a>
        <span class="tooltip">Events Calendar</span>
      </li>
      <li>
        <a href="user_profile_setting_charity.php">
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
    <div class="text">Performance Tracker - Charity</div>
    <?php
                if (mysqli_num_rows($progressResult) > 0) {
                  while ($progressRow = mysqli_fetch_assoc($progressResult)) {
                    $week = $progressRow['week'];
                    $progressPercent = $progressRow['percent'];
                    $remarks = $progressRow['remark'];

                    ?>
    <!-- SELECT QUERY FOR FILES -->
    <?php
          $conn = mysqli_connect("localhost","root","","kinder_class");

          $sql2 = "SELECT id, weekNum, file_t, file_w, file_a 
                    FROM files
                    WHERE weekNum='$week' AND section = 'charity' ;";
          $result2 = mysqli_query($conn, $sql2);
          while($fetch = mysqli_fetch_assoc($result2))
          {
            echo "";

        ?>
    <div class="weekly_container">

          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <h2>  <?php echo "WEEK" . $week ?> </h2>
            <div class="progressRate" style="width: <?php echo $progressPercent; ?>%;">
              <?php echo $progressPercent; ?>%
            </div>

            <div class="weekly_pt">
              <div class="exercises_pt">
                <div class="exercises_container">
                  <a href="./<?php echo $fetch['file_t'] ?>" target="_blank" rel="noopener noreferrer">
                    <h3>Topic</h3>
                  </a>
                </div>
              </div>

              <div class="exercises_pt">
                <div class="exercises_container">
                  <a href="./<?php echo $fetch['file_w'] ?>" target="_blank" rel="noopener noreferrer">
                    <h3>Worksheets</h3>
                  </a>
                </div>
              </div>

              <div class="exercises_pt">
                <div class="exercises_container">
                  <a href="./<?php echo $fetch['file_a'] ?>" target="_blank" rel="noopener noreferrer" style="">
                    <h3>Activities</h3>
                  </a>
                </div>
              </div>    
            </div>

            <div class="remarks">
              <div class="remarks_container">
                <h5><span>Remarks:</span> <br> <?php echo $remarks ?> </h5>
              </div>
              <input type="hidden" name="charity" value="Charity">
            </div>
      </form>

    </div>
    <?php
            "";
                } 
          ?>
      <?php
              }
            } else {
              echo "No Grades Input";
            }
            ?>
  </section>
  <script src="scripts.js"></script>
</body>

</html>