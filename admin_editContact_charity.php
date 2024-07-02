<?php
session_start();
include "connect2.php";
      $contactId = $_GET['id'];
      $query = "SELECT * FROM contacts WHERE id='$contactId'";
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
      <a href="admin_eventCalendar.php">
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
              $contactId = $row["id"];
              $contactType = $row["contactType"];
              $contactInfo = $row["contactInfo"];

              if (isset($_POST["insertEditContact"])) {
                $contactType = $_POST["contactType"] ;
                $contactInfo = $_POST["contactInfo"] ;

                $updatequery = "UPDATE contacts
                                SET contactType='$contactType', contactInfo='$contactInfo'
                                WHERE id='$contactId'";
                  if (mysqli_query($conn, $updatequery)) {
                    echo "<script> alert('Update Successfully!'); location.replace('./admin_home_charity.php') </script>";
                    
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
              }
            }

        ?>
          <form action=" " method="post" class="editContactContainer">
            <h2>Edit Contact</h2>
                <select name="contactType" id="contactType" style="font-size:18px; font-family:'Poppins';width:auto;height:auto;color:#297582;border-radius:10px;padding:10px;border:1px solid #297582;" value="<?php echo $contactType?>"required>
                      <option value="<?php echo $contactType?>" selected><?php echo $contactType?></option> 
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
                <input type="text" id="" name="contactInfo" value="<?php echo $contactInfo?>">
                  <div class="col-6 m-auto ">
                    <button type="submit" name="insertEditContact" class="insertEditContact"><a href="admin_home_charity.php" style="color: #297582;">Save</a></button>
                    <button  class="insertEditContact"><a href="admin_home_charity.php" style="color: #297582;">Cancel</a></button>
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