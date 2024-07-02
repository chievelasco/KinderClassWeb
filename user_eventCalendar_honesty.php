<?php 
    require_once('connect.php') ?> 
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="mainstyle.css"> -->
    <link rel="stylesheet" href="style_main.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: auto;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        a {
            color: #fff;
        }
        .background {
            background-color: #e9f8ff;
        }
        .fc {
            border-color: #fff;
        }
        .btn-group {
            background: #fff;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root{
        --color-default:#297582;
        --color-second:#277699;
        --color-white:#fff;
        --color-body:#E9F8FF;
        --color-light:#e0e0e0;
        --color-orange:#E9B384;
        --dark-body: #4d4c5a;
        --dark-main: #141529;
        --dark-second: #79788c;
        --dark-hover: #323048;
        --dark-text: #f8fbff;
        --light-body: #f3f8fe;
        --light-main: #fdfdfd;
        --light-second: #c3c2c8;
        --light-hover: #edf0f5;
        --light-text: #151426;
        --blue: #007497;
        --white: #fff;
        --shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body{
        --bg-body: var(--light-body);
        --bg-main: var(--light-main);
        --bg-second: var(--light-second);
        --color-hover: var(--light-hover);
        --color-txt: var(--light-text);
        font-family: var(--font-family);
        background-color: var(--bg-body);
        }
        .fc .fc-toolbar-title{
            font-size:18px;
        }
        .fc-prev-button{
            background-color:#277699;
            border:none;
            border-radius: 10px;
            width: 20px;
            padding:2px 2px;
        }
        .fc-next-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
            width: 20px;
            padding:2px 2px;
        }
        .fc-today-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
            padding:5px 5px;
        }
        .btn-primary:disabled{
            background-color:#277699;
            border:none;
            border-radius:10px;
            padding:5px 5px;
        }
        .fc-dayGridMonth-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
            padding:5px 5px;
            font-size:14px;
        }
        .fc-dayGridWeek-button {
            background-color:#277699;
            border:none;
            border-radius:10px;
            padding:5px 5px;
        }
        .fc-list-button {
            background-color:#277699;
            border:none;
            border-radius:10px;
            padding:5px 5px;
        }
        .btn-primary.active{
            background-color:#277699;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        }
        .btn-primary:focus {
            background-color:#277699;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        }
        .btn-primary:hover {
            background-color:#297582;
        }
        .btn[type="submit"]{
            background-color:#277699;
            border:none;
            border-radius:20px;
        }
        .btn[type="submit"]:hover{
            background-color:#277699;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        }
        .btn[type="reset"]{
            background-color:#277699;
            border:none;
            border-radius:20px;
            color:#f3f8fe;
        }
        .btn[type="reset"]:hover{
            background-color:#277699;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        }

        input[type="text"]#title{
            border: 1px solid var(--color-default);
            border-radius: 10px;
        }
        textarea #description{
            border: 1px solid var(--color-default);
            border-radius: 10px;
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            opacity: 8;
            width: 10%;
            left:35%
        }
        input[type="datetime-local"]#start_datetime{
            border: 1px solid var(--color-default);
            border-radius: 10px;
        }
        input[type="datetime-local"]#end_datetime{
            border: 1px solid var(--color-default);
            border-radius: 10px;
        }
        
        .btn[type="button"]#edit{
            background-color:#277699;
            border:none;
            border-radius:20px;
        }
        .btn[type="button"]#edit:hover{
            background-color:#297582;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        } */



    </style>
</head>

<body class="background">
<div class="topbar">
    <span> <?php echo $pfname ?> </span>
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
        <a href="user_home_honesty.php" >
          <!--<i class="fa fa-home"></i>-->
          <span>Home</span>
        </a>
      </li>
      <li>
        <a href="user_performanceTracker_honesty.php" >
          <!--<i class="fa fa-book"></i>-->
          <span>Performance Tracker</span>
        </a>
      </li>
      <li>
        <a href="user_eventCalendar_honesty.php" class="active">
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
    <div class="container py-5" id="page-container">

            <div class="col-md-9" style="margin-left:auto;margin-right:auto;">
                <div id="calendar"></div>
            </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
        <?php 
        $schedules = $conn->query("SELECT * FROM `schedule_list` WHERE section='Honesty' ");
        $sched_res = [];
        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }
        ?>
        <?php 
        if(isset($conn)) $conn->close();
        ?>
    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
    <script 
        src="./js/script.js">
    </script>
</body>

</html>