
<?php
    include("database_reg.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<script>
        window.addEventListener('contextmenu', function (e) {
            e.preventDefault(); // Prevent the default right-click menu
        });
    </script>
<body style="background-color:aliceblue" >
<div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:90vh;">
            <div class="col-md-5">
                <div id="centered-div">
                <div class="row " style="background-color:aquamarine;" >
    <form action="register.php" method="post" onsubmit="return validateForm()" >

    <div class="row mb-6 mt-4">
    <div class="col-sm-10 mx-4">
      <input  required ="text" class="form-control"  oninput="this.value = this.value.toUpperCase();" id="firstname" name="firstname" placeholder="First Name" title="please enter the first name">
    </div>
  </div>

  <div class="row mb-3 mt-4">
    <div class="col-sm-10 mx-4">
      <input required type="text" class="form-control" id="lastname" name="lastname" oninput="this.value = this.value.toUpperCase();" placeholder="Last Name" title="please enter the last name">
    </div>
  </div>
    
  
  <!-- <div class="row mb-3 mt-4">
    <div class="col-sm-10 mx-4">
        <input required type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" pattern="\d{10}" title="Please enter a 10-digit phone number (e.g., 0712345678)">
        
    </div>
</div> -->


<div class="row mb-3 mt-4">
    <div class="col-sm-10 mx-4">
        <input required type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" pattern="\d{10}" inputmode="numeric" title="Please enter a 10-digit phone number (e.g., 0712345678)">
    </div>
</div>



<div class="row mb-3 mt-4">
    <div class="col-sm-10 mx-4">
        <input required type="email" class="form-control" id="email" name="email" placeholder="Email" oninput="this.value = this.value.toLowerCase();" title="Please enter your email">
    </div>
</div>

  <div class="row mb-3">
    
    <div class="col-sm-10 mx-4">
      <input required type="password" class="form-control" id="password" name="password" placeholder="password" title="please enter your password">
    </div>
  </div>
  

  <label class="font-weight-bold mb-2  mx-5">Gender: </label>

<div class="form-check form-check-inline p-0">
    <input required class="form-check-input" type="radio" name="gender" id="maleGender" value="Male">
    <label class="form-check-label" for="maleGender">Male</label>
</div>

<div class="form-check form-check-inline p-4">
    <input required class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female">
    <label class="form-check-label" for="femaleGender">Female</label>
</div>
  
 <div class="text-center mb-4">
 <form action="login.php" method="post">
  <button type="submit" class="btn btn-primary w-50">submit</button> 
 </form>
</div>
<div class="container d-flex justify-content-center align-items-center">
  <button class="btn btn-danger m-2">
    <a style="color: white;" href="home.php">Back</a>
  </button>
</div>


</div>
<p class="text:center;" >&copy; <?php echo date("Y"); ?> by antony . All rights reserved.</p>
<?  php echo date("D,M,Y")?>
  
</form>
                    <!-- Your content goes here -->
                </div>
            </div>
        </div>
    </div>

    </div>



   


</body>
</html>
<?php

 // Retrieve data from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];

// SQL query to insert data
$sql = "INSERT INTO patients (firstname, lastname, phonenumber, email, password, gender) 
        VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$password', '$gender')";

if ($conn->query($sql) === TRUE) {
  echo "Record inserted successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}     

    mysqli_close($conn);
?>


