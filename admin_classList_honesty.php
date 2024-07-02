<?php
session_start();


include "connect.php";

$query = "SELECT * FROM reg_info WHERE section = 'Honesty'";
$results = mysqli_query($conn, $query);

if ($results) {
  while ($row = mysqli_fetch_assoc($results)) {
    $firstName = $row['stud_fname'];
    $mname = $row['stud_mname'];
    $surname = $row['stud_lname'];
    $idnumber = $row['studID_number'];
    $section = $row['section'];

    if (isset($_POST["save_btn"])) {
      $studentId = $_POST["student_id"];
      $item = $_POST["inputItem"];
      $score = $_POST["inputScore"];
      $week = $_POST["inputWeek"];
      $average = $score / $item * 100;
      $remarks = $_POST["inputRemarks"];



      $checkQuery = "SELECT * FROM progress WHERE studID_number = '$studentId' AND week = '$week'";
      $checkResult = mysqli_query($conn, $checkQuery);

      if (mysqli_num_rows($checkResult) > 0) {
        $nameQuery = "SELECT stud_fname, stud_lname FROM reg_info WHERE studID_number = '$studentId'";
        $nameResult = mysqli_query($conn, $nameQuery);

        if ($nameRow = mysqli_fetch_assoc($nameResult)) {
          $firstName = $nameRow['stud_fname'];
          $surname = $nameRow['stud_lname'];

          $updateQuery = "UPDATE progress SET percent='$average', item='$item', score='$score', stud_fname='$firstName', stud_lname='$surname', remark='$remarks'
                            WHERE studID_number = '$studentId' AND week = '$week'";
          $results = executesQuery($updateQuery);
        } else {

          echo "Error: Student ID not found in reg_info";
        }
      } else {
        $nameQuery = "SELECT stud_fname, stud_lname FROM reg_info WHERE studID_number = '$studentId'";
        $nameResult = mysqli_query($conn, $nameQuery);

        if ($nameRow = mysqli_fetch_assoc($nameResult)) {
          $firstName = $nameRow['stud_fname'];
          $surname = $nameRow['stud_lname'];
          $insertQuery = "INSERT INTO progress (studID_number, percent, item, score, week, stud_fname, stud_lname, remark)
                        VALUES ('$studentId', '$average', '$item', '$score', '$week', '$firstName', '$surname', '$remarks')";
          $results = executesQuery($insertQuery);
        }

      }
      $_SESSION["username"] = $studentId;

      header("Location: admin_classList_honesty.php");
      exit();
    }

  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>KinderClass Classlist</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style4.css">
  <link rel="stylesheet" href="style_main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .progressbar-rate {
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


    .inputWeek {
      display: flex;
      width: 50%;
      justify-content: space-evenly;
      width: 200px;
      height: 30px;
      border-radius: 15px;
      border: 2px solid #41444B;
      margin: auto;
      padding-left: 15px;
      padding: 15px;
      background-color: #f9f9f9;
    }

    textarea {
      width: 100%;
      height: 100px;
      padding: 12px 20px;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      background-color: #f8f8f8;
      font-size: 16px;
      resize: none;
    }
  </style>
</head>

<body>
<div class="topbar">
        <span> <?php echo $section ?> -Admin </span>
          <ul>
            <li>
                <a href="logout.php">
                  <i class="fa fa-sign-out" id="log_out"></i>
                </a>
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
            <a href="admin_home_honesty.php">
              <!--<i class="fa fa-home"></i>-->
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="admin_classList_honesty.php" class="active">
              <!--<i class="fa fa-book"></i>-->
              <span>Classlist</span>
            </a>
          </li>
                <li>
            <a href="admin_academicResources_honesty.php">
              <!--<i class="fa fa-book"></i>-->
              <span>Academic Resources</span>
            </a>
          </li>
          <li>
            <a href="admin_eventCalendar_honesty.php">
              <!--<i class="fa fa-calendar"></i>-->
              <span>Events Calendar</span>
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
  
  <section class="class_list-section">
  <?php $query = "SELECT * FROM admin_login WHERE admin_ID = 1";
    $result = mysqli_query($conn, $query) or die("Error in query: " . mysqli_error($conn));
    $row = mysqli_fetch_assoc($result) or die("No user found with the given ID.");

    $section1 = $row['section'];
    ?>
    <div class="text">Class List - <?php echo $section1 ?> </div>
    <div class="grid auto-fit">

      <?php

      $query = "SELECT * FROM reg_info WHERE section = 'Honesty' ";
      $results = mysqli_query($conn, $query);
      if ($results) {
        while ($row = mysqli_fetch_assoc($results)) {
          $firstName = $row['stud_fname'];
          $mname = $row['stud_mname'];
          $surname = $row['stud_lname'];
          $idnumber = $row['studID_number'];
          $pfname = $row['parent_fullname'];
          $address = $row['address'];
          $contact = $row['contact_number'];
          $bday = $row['bday'];
          $none = $row['none'];
          $asthma = $row['asthma'];
          $eyesight = $row['eyesight'];
          $epilepsy = $row['epilepsy'];
          $allergy = $row['allergy'];
          $heart = $row['heart'];
          $pulmonary = $row['pulmonary'];

          $conditions = [];

          if ($none == 'yes' || $none == 'Yes') {
            $conditions[] = 'No health conditions specified';
          } else {
            if ($asthma == 'yes' || $asthma == 'Yes') {
              $conditions[] = 'Asthma';
            }
            if ($eyesight == 'yes' || $eyesight == 'Yes') {
              $conditions[] = 'Eyesight';
            }
            if ($epilepsy == 'yes' || $epilepsy == 'Yes') {
              $conditions[] = 'Epilepsy';
            }
            if ($allergy != 'None') {
              $allergyType = $allergy;
              $conditions[] = "Allergy: $allergyType";
            }
            if ($heart != 'None') {
              $heartCondition = $heart;
              $conditions[] = "Heart: $heartCondition";
            }
            if ($pulmonary != 'None') {
              $pulmonaryCondition = $pulmonary;
              $conditions[] = "Pulmonary: $pulmonaryCondition";
            }
          }
          $studID_number = $row['studID_number'];

          
          $imageQuery = "SELECT image FROM profile WHERE studID_number = '$studID_number'";
          $imageResult = mysqli_query($conn, $imageQuery);
  
          if ($imageRow = mysqli_fetch_assoc($imageResult)) {
              
              $imageUrl = 'profile/' . $imageRow['image'];
          } else {
              
              $imageUrl = 'https://i.pinimg.com/564x/d9/d8/8e/d9d88e3d1f74e2b8ced3df051cecb81d.jpg'; 
          }
          ?>
          

          <div class="container">
            <img src="<?php echo $imageUrl; ?>" alt="<?php echo $studID_number; ?> Image">
            <h4>
              <?php echo $firstName . " " . $mname . " " . $surname; ?>
            </h4>
            </h4>
            <p>
              <?php echo $idnumber ?>
            </p>
            <div class="performance">
              <div class="progressbar-container">
                <div class="progressbar">
                  <div class="progressbar-rate">
                  </div>
                </div>
              </div>

              <button id="calcBtn" class="calcBtn" name="calcBtn">Grade Calculator</button>
              <div class="calcmodal" id="calc-modal" name="calcmodal">
                <div class="calcmodal-content">
                  <div class="calcmodal-header">
                    <span class="close-calc">&times;</span>
                    <h2>Grade Calculator</h2>
                    <div class="calcmodal-body">
                      <h4>Weekly Performance Rate</h4>
                      <div class="progress-container">
                        <div class="progress-rate">
                        </div>
                      </div>
                      <div class="input-container">
                        <form method="POST">
                          <input type="hidden" name="student_id" value="<?php echo $idnumber; ?>">
                          <div>
                            <h5>Week</h5>
                            <input type="number" class="inputWeek" name="inputWeek" id="inputWeek">
                          </div>
                          <div>
                            <h5>Total Score</h5>
                            <input type="number" name="inputScore" class="inputScore" id="inputScore">
                          </div>
                          <div>
                            <h5>Number of Items</h5>
                            <input type="number" class="inputItem" name="inputItem" id="inputItem">
                          </div>
                          <div>
                            <h5>Remarks</h5>
                            <textarea name="inputRemarks" id="inputRemarks" name="inputRemarks" cols="30"
                              rows="10"></textarea>
                          </div>
                      </div>
                      <button class="progress-btn" id="progress-btn" type="button">Calculate</button>

                      <button class="save-btn" id="save-btn" name="save_btn" type="submit">Save</button>
                      </form>
                    </div>
                  </div>

                </div>
              </div>

            </div>
            <button id="myBtn" class="myBtn" name="myBtn">View Profile</button>
            <div class="modal" id="my-modal" name="modal">
              <div class="modal-content">
                <div class="modal-header">
                  <span class="close">&times;</span>
                  <h2>Profile Information</h2>
                </div>
                <div class="modal-body">
                  <h4>Parents Information</h4>
                  <li><span>Full Name: </span>
                    <?php echo $pfname ?>
                  </li>
                  <li><span>Full Address: </span>
                    <?php echo $address ?>
                  </li>
                  <li><span>Contact Number: </span>
                    <?php echo $contact ?>
                  </li>

                  <h4>Students Information</h4>
                  <li><span>Birthday: </span>
                    <?php echo $bday ?>
                  </li>
                  <li><span>Health Condition: </span>
                    <?php
                    if (!empty($conditions)) {
                      echo '<ul>';
                      foreach ($conditions as $condition) {
                        echo '<li>' . $condition . '</li>';
                      }
                      echo '</ul>';
                    } else {
                      echo '<li>No health conditions specified.</li>';
                    } ?>
                  </li>
                </div>
                <div class="modal-footer">
                  <h3>Kinder-Class 2023</h3>
                </div>
              </div>
            </div>

          </div>
          <?php
        }
      }
      ?>
    </div>
  </section>

  <div class="container" id="add-container" style="display: none;">
    <img src="https://i.pinimg.com/564x/fc/7a/1a/fc7a1aee0e1dd7f4acfe8b3347ac27c9.jpg">
    <h4>
      <input type="text" id="first-name" class="name-input" placeholder="First Name">
      <input type="text" id="middle-name" class="name-input" placeholder="Middle Name">
      <input type="text" id="last-name" class="name-input" placeholder="Last Name">
    </h4>
    <p id="student-id" class="student-info"></p>
    <div class="performance">
      <div class="progressbar-container">
        <div class="progressbar">
          <div class="progressbar-rate"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="script1.js"></script>
  <!-- <script src="scripts.js"></script> -->


</body>

</html>