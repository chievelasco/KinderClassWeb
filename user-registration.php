<?php
session_start();
session_destroy();
session_start();

include "connect1.php";

if (isset($_POST["submit-logs"])) {

  $fName = $_POST["student-firstname"];
  $mInitial = $_POST["student-minitial"];
  $lName = $_POST["student-lastname"];
  $studID = $_POST["student-id"];
  $bday = $_POST["birthday"];
  $section = $_POST["stud-section"];
  $gender = $_POST["stud-gender"];
  $pfName = $_POST["parent-firstname"];
  $add = $_POST["address"];
  $relation = $_POST["relationship"];
  $contact = $_POST["contact-no"];
  $occu = $_POST["occupation"];
  $pass = $_POST["password"];
  $conpass = $_POST["confirm-password"];
  $none = isset($_POST["health-condi-none"]) ? 'Yes' : 'No';
  $asthma = isset($_POST["health-condi-asthma"]) ? 'Yes' : 'No';
  $eyesight = isset($_POST["health-condi-eyesight"]) ? 'Yes' : 'No';
  $epilepsy = isset($_POST["health-condi-epilepsy"]) ? 'Yes' : 'No';
  $allergy = !empty($_POST["health-condi-allergy"]) ? $_POST["health-condi-allergy"] : 'None';
  $heart = !empty($_POST["health-condi-heart"]) ? $_POST["health-condi-heart"] : 'None';
  $pulmonary = !empty($_POST["health-condi-pulmonary"]) ? $_POST["health-condi-pulmonary"] : 'None';
  $others = !empty($_POST["health-condi-others"]) ? $_POST["health-condi-others"] : 'None';

  $insertquery = "INSERT INTO reg_info (stud_fname, stud_mname, stud_lname, studID_number, bday, section, gender, none, asthma, eyesight, epilepsy, allergy, heart, pulmonary, others, parent_fullname, address, contact_number, password, confirm_pass, occupation, relation) 
  VALUES ('$fName', '$mInitial', '$lName', '$studID', '$bday', '$section', '$gender', '$none', '$asthma', '$eyesight', '$epilepsy', '$allergy', '$heart', '$pulmonary', '$others', '$pfName', '$add', '$contact', '$pass' , '$conpass', '$occu' , '$relation')";
  $results = executesQuery($insertquery);
  header("Location: index.php");
}
if (isset($_POST["submit-logs"])) {
  $fName = $_POST["student-firstname"];
  $lName = $_POST["student-lastname"];
  $studID = $_POST["student-id"];
  $insertquery ="INSERT INTO progress (stud_fname, stud_lname,studID_number)
  VALUES ('$fName', '$lName', '$studID')";
  $results = executesQuery($insertquery);
  header("Location: parent_login.php");
}
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Sign Up</title>
</head>

<style>
  body {
    margin: 0;
    padding: 0;
    background-color: #62969F;
    font-family: sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .avatar {
    width: 110px;
    height: 110px;
    position: absolute;
    left: 41%;
    top: -2%;
  }

  h1 {
    margin: 0;
    padding: 0 0 20px;
    text-align: left;
    font-size: 18px;
    margin-top: 50px;
    color: #fff;
    font-weight: bold;
  }

  h2 {
    margin: 0;
    padding: 0 0 10px;
    text-align: left;
    font-size: 18px;
    margin-top: 20px;
    color: #fff;
    font-weight: bold;
  }

  .col-12 p {
    font-size: 15px;
    color: #fff;
    margin-top: 8px;
  }

  .col-12 span {
    color: #FFD9CE;
    font-style: italic;
  }

  .col-12 label {
    margin-left: 8px;
    color: #fff;
  }

  .col-12 .form-check4,
  .form-check5,
  .form-check6,
  .form-check8 {
    box-sizing: border-box;
    margin: 5px;
  }

  .btn {
    color: #fff;
    background: #297582;
    border: none;
    margin-top: 10px;
  }

  .btn:hover {
    background: #3bafda !important;
    color: #fff;
  }
  .form-control, .form-select {
    margin-top: 8px;
  }
</style>

<body>
  <div class="container-fluid">
    <div class="col-lg-12">
      <img src="https://i.ibb.co/vLvDRJ7/logo-2-1.png" class="avatar">
      <h1>Student Information</h1>
      <form class="row g-12" method="POST" id="form1">
        <div class="col-md-4">
          <label for="student-fname" class="student-firstname"></label>
          <input type="text" class="form-control" id="stud-fname" name="student-firstname" placeholder="First Name"
            required>
        </div>
        <div class="col-md-4">
          <label for="student-nitial" class="student-middleinitial"></label>
          <input type="text" class="form-control" id="stud-mname" name="student-minitial" placeholder="Middle Initial">
        </div>
        <div class="col-md-4">
          <label for="student-lname" class="student-lastname"></label>
          <input type="text" class="form-control" id="stud-lname" name="student-lastname" placeholder="Last Name"
            required>
        </div>
        <div class="col-3">
          <label for="stud-ID" class="student-ID"></label>
          <input type="text" class="form-control" id="stud-id" name="student-id" placeholder="Student ID Number"
            required>
        </div>
        <div class="col-md-3">
          <label for="bday" class="Bday"></label>
          <input type="date" class="form-control" id="bday" name="birthday" placeholder="DD/MM/YYYY" required>
        </div>
        <div class="col-md-3">
          <label for="section" class="Section"></label>
          <select id="section" class="form-select" name="stud-section" required>
            <option selected>Choose Section</option>
            <option>Charity</option>
            <option>Honesty</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="gender" class="Gender"></label>
          <select id="gender" class="form-select" name="stud-gender" required>
            <option selected>Choose Gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="col-12">
          <label for="health-condi" class="Health-condition"></label>
          <p>Please select your child's health condition: <span>(select all necessary)</span></p>
          <input type="checkbox" name="health-condi-none" id="health1" class="form-check7">
          <label for="No">None</label>
          <input type="checkbox" name="health-condi-asthma" id="health" class="form-check1">
          <label for="asthma">Asthma</label>
          <input type="checkbox" name="health-condi-eyesight" id="health" class="form-check2">
          <label for="eyesight">Poor Eyesight</label>
          <input type="checkbox" name="health-condi-epilepsy" id="health" class="form-check3">
          <label for="epilepsy">Epilepsy</label><br>

          <label for="allergy">Allergy <span>(e.g. peanuts, shellfish, milk)</span>:</label>
          <input type="text" name="health-condi-allergy" id="health" class="form-check4"> <br>

          <label for="heart">Heart Disease <span>(e.g. congenital, pericardial)</span>:</label>
          <input type="text" name="health-condi-heart" id="health" class="form-check5"> <br>

          <label for="pulmonary">Pulmonary Disease <span>(e.g. bronchitis, pneumonia)</span>:</label>
          <input type="text" name="health-condi-pulmonary" id="health" class="form-check6"> <br>

          <label for="others">Others (specify):</label>
          <input type="text" name="health-condi-others" id="health" class="form-check8"> <br>
        </div>
        <div class="col-12">
          <h2>Parents</h2>
          </nav>
        </div>
        <div class="col-12">
          <label for="student-firstname" class="form-label"></label>
          <input type="text" class="form-control" id="parent-fname" name="parent-firstname" placeholder="Full Name"
            required>
        </div>
        <div class="col-12">
          <label for="address" class="form-label"></label>
          <input type="text" class="form-control" id="add" name="address" placeholder="Complete Address" required>

        </div>
        <div class="col-md-4">
          <label for="relation" class="form-label"></label>
          <input type="text" class="form-control" id="relation" name="relationship"
            placeholder="Relation to the student" required>
        </div>
        <div class="col-md-4">
          <label for="contact" class="form-label"></label>
          <input type="text" class="form-control" id="contact" name="contact-no" placeholder="Contact Number" required>
        </div>
        <div class="col-md-4">
          <label for="occ" class="form-label"></label>
          <input type="text" class="form-control" id="occ" name="occupation" placeholder="Occupation" required>
        </div>

        <div class="col-md-6">
          <label for="pass" class="form-label"></label>
          <input type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
        </div>
        <div class="col-md-6">
          <label for="confirm-pass" class="form-label"></label>
          <input type="password" class="form-control" id="confirm-pass" name="confirm-password"
            placeholder="Confirm Password" required>
        </div>

        <div class="col-12">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <button type="submit" class="btn btn-success" name="submit-logs">Sign In</button>
            </ul>
          </nav>

        </div>
      </form>
    </div>
  </div>
  </div>
  <!-- Add this script after the existing script in your HTML file -->
<!-- Add this script after the existing script in your HTML file -->
<script>
  const form1 = document.getElementById("form1");
  const noneCheckbox = document.getElementById("health1");
  const otherCheckboxes = document.querySelectorAll('.form-check1, .form-check2, .form-check3, .form-check4, .form-check5, .form-check6, .form-check8');
  const next = document.getElementById("btnNext");
  noneCheckbox.addEventListener("change", function () {
    const disableOthers = noneCheckbox.checked;

    otherCheckboxes.forEach(checkbox => {
      checkbox.disabled = disableOthers;
      if (disableOthers) {
        checkbox.checked = false;
      }
    });
  });
</script>
