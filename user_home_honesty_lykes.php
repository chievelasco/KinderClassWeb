<!DOCTYPE html>
<html lang="en">
<head>
  <title>Responsive Sidebar</title>
  <link rel="stylesheet" href="style_main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="top-bar">
    <span> Account Name </span>
    <ul>
    <li>
        <a href="logout.php">
        <i class="fa fa-sign-out" id="log_out"></i>
        </a>
      </li>
    </ul>
  </div>
  <nav>
    <div class="logo">
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
        <a href="eventCalendar.php">
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
  </nav>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
      $(function() {
        $(".toggle").on("click", function(){
          if($(".menu").hasClass("active")){
            $(".menu").removeClass("active");
            $(this).find("a").html("<i class='fa fa-navicon' id=''>");
          } else {
            $(".menu").addClass("active");
            $(this).find("a").html("<i class='fa fa-close' id=''>");
          }
        })
    })
  </script>
</body>
</html>