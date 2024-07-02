<?php
session_start();

include "connect2.php";

$id= $_GET['id'];
$query = "SELECT * FROM files WHERE id='$id' ";


$results = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kinder Class</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Link Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style_adminAR.css">
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
      <i class="fa fa-navicon" id="btn"></i>
    </div>
    <img src="https://i.ibb.co/9gPHTr8/kinder-class-logo-1.png" class="website-logo">
    <ul class="nav-list">

      <li>
        <a href="admin_home_charity.php" >
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
        <a href="admin_academicResources_charity.php" class="active">
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
    <div class="text">Edit Week Files - Charity</div>
      <?php
      if ($results) {
        $row = mysqli_fetch_assoc($results);
        $weekNum = $row["weekNum"];
        $id = $row["id"];
        $topics_files = $row["file_t"];
        $worksheets_files = $row["file_w"];
        $eactivities_files = $row["file_a"];

        if (isset($_POST["btn_save"])) {
          $weekNum = isset($_POST["weekNum"]) ? $_POST["weekNum"] : '';
          $id = isset($_POST["id"]) ? $_POST["id"] : '';

          
          $topics_tmp = $_FILES["choosefile_topics"]["tmp_name"];
          $wsheets_tmp = $_FILES["choosefile_worksheets"]["tmp_name"];
          $eact_tmp = $_FILES["choosefile_eactivities"]["tmp_name"];

        
          $uploadDir = "uploads/";

          $topics = $uploadDir . basename($_FILES["choosefile_topics"]["name"]);
          $wsheets = $uploadDir . basename($_FILES["choosefile_worksheets"]["name"]);
          $eact = $uploadDir . basename($_FILES["choosefile_eactivities"]["name"]);

          move_uploaded_file($topics_tmp, $topics);
          move_uploaded_file($wsheets_tmp, $wsheets);
          move_uploaded_file($eact_tmp, $eact);


          $query = "UPDATE files 
                    SET file_t='$topics', file_w='$wsheets', file_a='$eact', weekNum='$weekNum'
                    WHERE id='$id'";

          if (mysqli_query($conn, $query)) {
            echo "<script> alert('File updated successfully..'); location.replace('./admin_academicResources_charity.php') </script>";
          } else {
              echo "Error updating record: " . mysqli_error($conn);
          }
        }
      }
      ?>
      <form action="" method="post" class="addweek_modal_content" enctype="multipart/form-data">
        <!-- <input type="text" name="id" value="<?php echo $id; ?>"> -->
        <h3>Week Number</h3><input type="text" class="form_control" name="weekNum" value="<?php echo $weekNum; ?>" id="">
        <h4>Topic</h4>
        <input class="form-control" type="file" name="choosefile_topics" id="">
        <h4>Worksheet</h4>
        <input class="form-control" type="file" name="choosefile_worksheets" id="">
        <h4>Activities</h4>
        <input class="form-control" type="file" name="choosefile_eactivities" id="">
        <div class="col-6 m-auto ">
          <button type="submit" name="btn_save" class="btn_save">
            Save
          </button>
          <button  class="btn_save">
            <a href="admin_academicResources_charity.php" style="text-decoration:none; color:#fff;">Cancel</a>
          </button>

        </div>
      </form>


      <?php
          ?>

    </div>
  </section>
  <!-- Scripts -->
  <script src="script.js"></script>
</body>

</html>