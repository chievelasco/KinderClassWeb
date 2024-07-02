<?php require_once('connect.php') ?>
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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
        button {
            background-color: #E9B384;
            border: none;
            color: #fff;
            font-size: 14px;
            padding: 7px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            border-radius: 10px;
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
        --color-orange:#FFD9CE;
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
        .fc-prev-button{
            background-color:#277699;
            border:none;
            border-radius: 10px;
        }
        .fc-next-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
        }
        .fc-today-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
        }
        .btn-primary:disabled{
            background-color:#277699;
            border:none;
            border-radius:10px;
        }
        .fc-dayGridMonth-button{
            background-color:#277699;
            border:none;
            border-radius:10px;
        }
        .fc-dayGridWeek-button {
            background-color:#277699;
            border:none;
            border-radius:10px;
        }
        .fc-list-button {
            background-color:#277699;
            border:none;
            border-radius:10px;
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
            /* filter: invert(100%) sepia(0%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%); */
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
        
        /*Navbar */
        .website-logo,
        .navbar-brand
        {
            width: 50px;
            display: flex;
            transition: all .5s ease;
            margin-right:30px;
        }
        .navbar>.container{
            justify-content: left;
        }
        .back-btn{
            margin-right:250px;
            background-color:#297582;
        }

        /*Modal */
        .btn[type="button"]#edit{
            background-color:#277699;
            border:none;
            border-radius:20px;
        }
        .btn[type="button"]#edit:hover{
            background-color:#297582;
            border: 2px solid #323048;
            box-shadow: 0 0 0 0.25rem rgba(49,132,253,.5);
        }



    </style>
</head>

<body class="background">
    <nav class="navbar navbar-expand-lg" style="background-color:#297582;" id="topNavBar">
        <div class="container">
        <a href="admin_home_honesty.php"><button class="back-btn" ><h5><i class="fa fa-home"></i>  Back to Home</h5></button></a>

            <img src="https://i.ibb.co/9gPHTr8/kinder-class-logo-1.png" class="website-logo">
            <a class="navbar-brand" href="admin_home.php">
            <h3>Events Calendar</h3>
            </a>

            <div>
                <!-- <b class="text-light">Kinder Class</b> -->
            </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient text-light" style="background-color:#277699;">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="admin_saveEvent.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-close"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
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
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>