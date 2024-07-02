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
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="style_main.css">
  
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
        <a href="admin_home_honesty.php" class="active">
          <!--<i class="fa fa-home"></i>-->
          <span>Home</span>
        </a>
      </li>
      <li>
        <a href="admin_classList_honesty.php">
          <!--<i class="fa fa-book"></i>-->
          <span>Class List</span>
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

  <section class="home-section">
      <div class="text">Home - Honesty</div>
      <div class="grid auto-fit">
          <div class="container">
            <h2>WELCOME!</h2>
            <p>This website will serve as your communication
              channel to the adviser of your child.</p>
          </div>

          <!-- START OF RULES CONTAINER -->
          <!-- INSERT QUERY FOR RULES -->
          <?php

              if (isset($_POST["insertRule"])) {
                  $con = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");

                  $newRule = $_POST["newRule"];
                  $numRule = $_POST["numRule"];
                  
                  $insertquery = "INSERT INTO rule (rule, rule_num, section) 
                  VALUES ('$newRule', '$numRule', '$section')";
                    if (mysqli_query($con,$insertquery)) {
                      echo '<script type="text/javascript">alert("Added Successfully!");</script>';
                      
                    } else {
                      echo "Error updating record: " . mysqli_error($con);
                    }
              }
            ?>

          <div id="addRuleModal" class="modal">
            <form action="" method="post" class="modal-content">
              <span onclick="document.getElementById('addRuleModal').style.display='none'" class="closeR" title="Close Modal">&times;</span>
                  <h2>Insert New Rule</h2>
                  <label for="newActivity">Rule:</label>
                  <input type="number" id="" name="numRule" placeholder="Number">
                  <input type="text" id="" name="newRule" placeholder="Enter new rule">
                  <div class="col-6 m-auto "><button type="submit" name="insertRule" class="insertRule" id="insertRule">Add</button></div>
            </form>
          </div>

          <div class="container2">
            <button id="addRuleBtn" class="home_button" onclick="document.getElementById('addRuleModal').style.display='block'" style="width:auto;width:auto;float:right;font-size:15px;">
            <a><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-plus"></i></a>
            </button>
            <h3>Home Learning Rules</h3>
            <div class="functions">
            </div>
                <!-- SELECT QUERY FOR RULES -->
                <?php
                    $conn = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");
                    $rulequery = "SELECT * FROM rule WHERE section='Honesty'
                    ORDER BY rule_num ASC";
                    $result =mysqli_query ($conn,$rulequery);

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <ol class="ruleLst" id="ruleLst">
              <?php echo $row["rule_num"]?>. <?php echo $row["rule"]?>.
              <button id="editRuleBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_editRule_honesty.php?id=<?php echo $row ['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-edit"></i></a></button> 
              <button id="deleteRuleBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_deleteRule_honesty.php?id=<?php echo $row['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-trash-o"></i></a></button> 
            </ol>
              <!-- WHILE LOOP CLOSING BRACKET -->
                  <?php
                }
              ?>
          </div>
          <!-- END OF RULES CONTAINER -->
        </div>

        <div class="grid2 auto-fit">
          <!-- START OF SCHEDULE CONTAINER -->
          <!-- INSERT QUERY FOR Schedule -->
          <?php
            // INSERT QUERY
            if (isset($_POST["insertSched"])) {
               $conn2 = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");

                $startTime = $_POST["startTime"];
                $endTime = $_POST["endTime"];
                $newSched = $_POST["newSched"];

                $insertquery2 = "INSERT INTO class_schedule (startTime, endTime, newSched, section) 
                VALUES ('$startTime', '$endTime', '$newSched','$section')";
                  if (mysqli_query ($conn2,$insertquery2)) {
                    echo '<script type="text/javascript">alert("Added Successfully!");</script>';
                    
                  } else {
                    echo "Error updating record: " . mysqli_error($conn2);
                  }
            }
            ?>

          <div id="addSchedModal" class="modal">
            <form action="" method="post" class="modal-content">
              <span onclick="document.getElementById('addSchedModal').style.display='none'" class="closeR" title="Close Modal">&times;</span>
                <h2>Insert New Schedule</h2>
                <label for="newActivity">Start:</label>
                <input type="time" id="startTime" name="startTime" >
                <label for="newActivity">End:</label>
                <input type="time" id="endTime" name="endTime" >
                <br>
                <label for="duration">Schedule:</label>
                <input type="text" id="newSched" name="newSched" placeholder="Enter schedule">
                <br>
                  <div class="col-6 m-auto "><button type="submit" name="insertSched" class="insertSched" id="insertSched">Add</button></div>
            </form>
          </div>

          <div class="container3">
            <button id="addSchedBtn" class="home_button" onclick="document.getElementById('addSchedModal').style.display='block'" style="width:auto;width:auto;float:right;font-size:15px;">
              <a><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-plus"></i></a>
            </button>
            <h3>Class Schedule</h3>
            <h4>Monday to Friday</h4>
            <div class="functions">
            </div>
            <div class="sched-data">
              <table class=schedTb>
                <thead>
                  <tr>
                    <td><span>Time</span></td>
                    <td><span>Subject</span></td>
                  </tr>
                </thead>
                 <!-- SELECT QUERY FOR SCHEDULE -->
                 <?php
                    $conn3 = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");
                    $schedquery = "SELECT * FROM class_schedule WHERE section='Honesty'
                    ORDER BY id ASC";
                    $result2 =mysqli_query ($conn3,$schedquery);;

                    while ($row = mysqli_fetch_assoc($result2)) {
                  ?>
                  <tbody>
                      <td><?php echo $row["startTime"]?> - <?php echo $row["endTime"]?></td>
                      <td><?php echo $row["newSched"]?></td>
                      <td>
                      <button id="editSchedBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_editSched_honesty.php?id=<?php echo $row ['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-edit"></i></a></button> 
                      <button id="deleteSchedBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_deleteSched_honesty.php?id=<?php echo $row['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-trash-o"></i></a></button> 
                      </td>
                  </tbody>
                      <!-- WHILE LOOP CLOSING BRACKET -->
                      <?php
                     }
                      ?>
              </table>
            </div>
            <!-- END OF SCHEDULE CONTAINER -->
          </div>
            <!-- START OF CONTACT CONTAINER -->
            <?php
            // INSERT QUERY
            if (isset($_POST["insertContact"])) {
                $con = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");

                $contactType = $_POST["contactType"];
                $contactInfo = $_POST["contactInfo"];

                $insertquery3 = "INSERT INTO contacts (contactType, contactInfo, section) 
                VALUES ('$contactType', '$contactInfo', '$section')";
                  if (mysqli_query($con,$insertquery3)) {
                    echo '<script type="text/javascript">alert("Added Successfully!");</script>';
                    
                  } else {
                    echo "Error updating record: " . mysqli_error($con);
                  }
            }
            ?>

            <div id="addContactModal" class="modal">
            <form action="" method="post" class="modal-content">
              <span onclick="document.getElementById('addContactModal').style.display='none'" class="closeR" title="Close Modal">&times;</span>
                  <h2>Insert Contact</h2>
                    <select name="contactType" id="contactType" style="font-size:18px; font-family:'Poppins';width:auto;height:auto;color:#297582;border-radius:10px;padding:10px;border:1px solid #297582;"required>
                        <option selected>Choose Contact type</option>
                        <option value="facebook">Facebook</option>
                        <option value="envelope">Email|Gmail</option>
                        <option value="phone">Phone</option>
                        <option value="mobile">Mobile</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="instagram">Instagram</option>
                        <options value="twitter">Twitter</option>
                        <option value="google">Google</option>.
                    </select>
                    <br>
                  <input type="text" id="" name="contactInfo" placeholder="Enter contact">
                  <div class="col-6 m-auto "><button type="submit" name="insertContact" class="insertContact" id="insertContact">Add</button></div>
            </form>
            </div>


          <div class="container4">
            <button id="addContactBtn" class="home_button" onclick="document.getElementById('addContactModal').style.display='block'" style="width:auto;width:auto;float:right;font-size:15px;">
              <a><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-plus"></i></a>
            </button>
            <h3>Contact Information</h3>
            <p>In case you have personal concerns regarding your child, you may
              contact me on the following accounts:
            </p>
                 <!-- SELECT QUERY FOR CONTACT -->
                  <?php
                    $conn3 = mysqli_connect("localhost","vzxmybji_kinder","aaaaa","vzxmybji_kinder");
                    $schedquery = "SELECT * FROM contacts WHERE section='Honesty'
                    ORDER BY id ASC";
                    $result2 =mysqli_query ($conn3,$schedquery);;

                    while ($row = mysqli_fetch_assoc($result2)) {
                  ?>
                      <ol class="contactLst" id="ruleLst">
                      <i class="fa fa-<?php echo $row["contactType"]?>"> <?php echo $row["contactInfo"]?></i>
                      <button id="editContactBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_editContact_honesty.php?id=<?php echo $row ['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-edit"></i></a></button> 
                      <button id="deleteContactBtn" class="home_button" style="width:auto;float:right;font-size:15px;"><a href="admin_deleteContact_honesty.php?id=<?php echo $row['id'] ?>"><i style="font-size:20px;float:right;margin-right:5px;color:#fff;" class="fa fa-trash-o"></i></a></button> 
                      </ol>
                  <!-- WHILE LOOP CLOSING BRACKET -->
                  <?php
                     }
                  ?>
          </div>
      </div>
  </section>
  <!-- Scripts -->
  <script src="script.js"></script>

</body>
</html>