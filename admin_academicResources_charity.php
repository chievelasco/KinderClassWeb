<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: index.php");
  exit();
}
include "connect.php";
$admin = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Performance Tracker</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_adminAR.css">
    <link rel="stylesheet" href="style2.css">
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
      <?php
       include "connect1.php";
       $query = "SELECT * FROM admin_login WHERE admin_ID = 2";
        $result = mysqli_query($conn, $query) or die("Error in query: " . mysqli_error($conn));
        $row = mysqli_fetch_assoc($result) or die("No user found with the given ID.");

        $section2 = $row['section'];
      ?>
    <div class="sidebar">
      <div class="logo_details">
        <i class="fa fa-navicon" id="btn"></i>
      </div>
      <img src="https://i.ibb.co/9gPHTr8/kinder-class-logo-1.png" class="website-logo">
      <ul class="nav-list">
        <li>
          <a href="admin_home_charity.php">
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
      <div class="text">Academic Resources - <?php echo $section2 ?> </div> 
      
      <!-- PHP|INSERT QUERY FOR Upload Files -->
        <?php
            if(isset($_POST['btn_save']))
            {
              $con = mysqli_connect("localhost","root","","kinder_class");
            
              $weekNum = $_POST["weekNum"];
              $charity = $_POST["charity"];
              $topics_tmp = $_FILES["choosefile_topics"]["tmp_name"];
              $wsheets_tmp = $_FILES["choosefile_worksheets"]["tmp_name"];
              $eact_tmp = $_FILES["choosefile_eactivities"]["tmp_name"];

              $uploadDir = "files/";
              $topics = $uploadDir . basename($_FILES["choosefile_topics"]["name"]);
              $wsheets = $uploadDir . basename($_FILES["choosefile_worksheets"]["name"]);
              $eact = $uploadDir . basename($_FILES["choosefile_eactivities"]["name"]);
      
              move_uploaded_file($topics_tmp, $topics);
              move_uploaded_file($wsheets_tmp, $wsheets);
              move_uploaded_file($eact_tmp, $eact);                  
              
              $sql = "INSERT INTO files (weekNum, section, file_t, file_w, file_a) 
              VALUES ('$weekNum', '$charity', '$topics', '$wsheets', '$eact')";
                  if (mysqli_query($con, $sql)) {
                    echo "<script> alert('Uploaded Successfully!'); location.replace('./admin_academicResources_charity.php') </script>";
                  } else {
                        echo "Error updating record: " . mysqli_error($con);
                    }
            }
          ?>
          <!--MODAL-->
          <button class="addweek_button" onclick="document.getElementById('addweek_modal').style.display='block'" style="width:auto;">+</button>
            <div id="addweek_modal" class="addweek_modal">
              <form action="admin_academicResources_charity.php" method="post" class="addweek_modal_content animate" enctype="multipart/form-data">
                <span onclick="document.getElementById('addweek_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
                <h3>Week Number</h3><input type="text" class="form_control" name="weekNum"  id="">
                      <h4>Topic</h4>
                      <input class="form-control" type="file" name="choosefile_topics"  id="">
                      <h4>Workseet</h4>
                      <input class="form-control" type="file" name="choosefile_worksheets"  id=""/>
                      <h4>Activities</h4>
                      <input class="form-control" type="file" name="choosefile_eactivities"  id="">
                      <input type="hidden" name="charity" value="Charity">
                      <div class="col-6 m-auto ">
                        <button type="submit" name="btn_save" class="btn_save">
                          Submit
                        </button>
                      </div>
              </form>
            </div>             
            <script>
              // Get the modal
              var modal = document.getElementById('addweek_modal');                
              // When the user clicks anywhere outside of the modal, close it
              window.onclick = function(event) {
                  if (event.target == addweek_modal) {
                    addweek_modal.style.display = "none";
                  }
              }
            </script>

        <?php
          $conn = mysqli_connect("localhost","root","","kinder_class");
              
          $sql2 = "SELECT * FROM files WHERE section = 'Charity' ORDER BY weekNum DESC;";
          $result2 = mysqli_query($conn, $sql2);
          while($fetch = mysqli_fetch_assoc($result2))
          {
            echo "";

        ?>
        <div class="weekly_container">
          <h2>Week <?php echo $fetch['weekNum'] ?></h2>
          <div class="weekly_pt">
            <div class="exercises_pt">
              <div class="exercises_container"><a href="./<?php echo $fetch['file_t'] ?>" target="_blank" rel="noopener noreferrer"><h3>Topic</h3></a>
              </div>
            </div>
            <div class="exercises_pt">
              <div class="exercises_container"><a href="./<?php echo $fetch['file_w'] ?>" target="_blank" rel="noopener noreferrer"><h3>Worksheets</h3></a>
              </div>
            </div>
            <div class="exercises_pt">
              <div class="exercises_container"><a href="./<?php echo $fetch['file_a'] ?>" target="_blank" rel="noopener noreferrer"><h3>Activities</h3></a>
              </div>
            </div>
          </div>
         
          <button class="pt_btn_edit"><a href="admin_editFile_charity.php?id=<?php echo $fetch['id'] ?>">Edit</a></button>
          <button class="pt_btn_delete"><a href="admin_deleteFile_charity.php?id=<?php echo $fetch['id'] ?>">Delete</a></button>
        </div>
          <?php
            "";
                } 
          ?>
    </section>
    <!-- Scripts -->
    <script src="script.js"></script>
  </body>
</html>