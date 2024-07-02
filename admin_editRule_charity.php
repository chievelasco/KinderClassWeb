
<?php
session_start();
include "connect2.php";

      // Redirect to index.php if $_GET['id'] is not present in the URL
      // if(!isset($_GET['id'])){
      //   header("Location: index.php");
      // }

      $ruleId = $_GET['id'];
      $query = "SELECT * FROM rule WHERE id='$ruleId'";
      $result1 =  mysqli_query($conn, $query);

      ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kinder Class</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="style2.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo_details">
      <i class="fa fa-navicon" id="btn">
      </i>
    </div>
    <img src="https://i.ibb.co/9gPHTr8/kinder-class-logo-1.png" class="website-logo"> 
    <ul class="nav-list">
      <li>
        <a href="admin_home_charity.php" class="active">
          <i class="fa fa-home"></i>
          <span class="link_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="admin_classList_charity.php">
          <i class="fa fa-address-book"></i>
          <span class="link_name">Class List -' '<?php echo $section ?></span>
        </a>
        <span class="tooltip">Class List</span>
      </li>
      <li>
        <a href="admin_academicResources_charity.php">
          <i class="fa fa-book"></i>
          <span class="link_name">Academic Resources</span>
        </a>
        <span class="tooltip">Academic Resources</span>
      </li> 
      <li>
        <a href="admin_eventCalendar_charity.php">
          <i class="fa fa-calendar"></i>
          <span class="link_name">Events Calendar</span>
        </a>
        <span class="tooltip">Events Calendar</span>
      </li>
      <!-- <li>
        <a href="#">
          <i class="fa fa-gear"></i>
          <span class="link_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
      </li> -->
      <li class="profile">
        <div class="profile_details">
          <div class="profile_content">
            <div class="name"><?php echo $section ?></div>
            <div class="designation"> - Admin</div>
          </div>
        </div>
        <a id="log_out" href="logout.php">
          <i class="fa fa-sign-out"></i>
        </a>
      </li>
    </ul>
  </div>

  <section class="home-section">
      <div class="text">Home - Charity</div>
        <div class="grid auto-fit">

          <!-- MODAL FOR EDIT -->
          <?php
          // <!-- EDIT QUERY FOR RULES -->
              if ($result1) {
                $row = mysqli_fetch_assoc($result1);
                $ruleId = $row["id"];
                $numRule = $row["rule_num"];
                $newRule = $row["rule"];


                if (isset($_POST["insertEditRule"])) {
                  $numRule = $_POST["numRule"] ;
                  $newRule = $_POST["newRule"] ;

                  $updatequery = "UPDATE rule 
                                  SET rule='$newRule', rule_num='$numRule'
                                  WHERE id='$ruleId'";
                    if (mysqli_query($conn, $updatequery)) {
                      echo "<script> alert('Update Successfully!'); location.replace('./admin_home_charity.php') </script>";
                      
                  } else {
                      echo "Error updating record: " . mysqli_error($conn);
                  }
                }
              }

          ?>
            <form action=" " method="post" class="editRuleContainer">
                  <h2>Edit Rule</h2>
                  <label for="newActivity">Rule:</label>
                  <input type="number" id="" name="numRule" value="<?php echo $numRule?>">
                  <input type="text" id="" name="newRule" value="<?php echo $newRule ?>">
                  <div class="col-6 m-auto ">
                    <button type="submit" name="insertEditRule" class="insertEditRule"><a href="admin_home_charity.php">Save</a></button>
                    <button type="submit" name="insertEditRule" class="insertEditRule"><a href="admin_home_charity.php">Cancel</a></button>
                  </div>
            </form>

          <?php
    
    ?>
          <!-- END OF RULES CONTAINER -->
        </div>
  </section>
  <!-- Scripts -->
  <script src="script.js"></script>
</body>
</html>