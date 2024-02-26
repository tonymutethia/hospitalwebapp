<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="container background-color:red;">
    <?php
    
// Include the database connection file
include "database_reg.php";

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = strtolower($_POST["email"]); // Convert email to lowercase
    $phonenumber = $_POST["phonenumber"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $departments = $_POST["departments"];
    //image concatenate 
    $image = $_FILES["image"]["name"]; 
     $rand = rand(100,2000);
    $image_name = $rand.''.$image;

    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder ='uploaded_img/'.$image_name;
    
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        // Handle upload error
        echo 'Error uploading file. Please try again.';
        
        // You may want to redirect the user back to the registration form or take appropriate action.
        exit;
    }
    $max_file_size = 5 * 1024 * 1024; // 5 MB (adjust as needed)

    if ($image_size > $max_file_size) {
        echo 'File size exceeds the allowed limit. Please choose a smaller file.';
        exit;
    }
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Add more if needed
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);
    
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo 'Invalid file extension. Please upload a valid image file.';
        exit;
    }
        
    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM employees WHERE email = '$email'";
    $resultEmail = mysqli_query($conn, $checkEmailQuery);

    // Check if the password is already in use
    $checkphonenumberQuery = "SELECT * FROM employees WHERE phonenumber = '$phonenumber'";
    $resultphonenumber = mysqli_query($conn, $checkphonenumberQuery);

    if (mysqli_num_rows($resultEmail) > 0) {
        echo "<p class='alert alert-danger'>Email already exists. Choose a different email.</p>";
    } elseif (mysqli_num_rows($resultphonenumber) > 0) {
        echo "<p class='alert alert-danger'>phonenumber is already in use.</p>";
    } else {
        // Continue with the existing logic for password length check and database insertion
        // ...

        // Create the target directory if it doesn't exist
        if (!is_dir('uploaded_img')) {
            mkdir('uploaded_img', 0777, true);
        }


           
      
       
        // Insert data into the database
        $sql = "INSERT INTO employees (firstname, lastname, email, phonenumber, password, gender, department, image) 
                VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$password', '$gender', '$departments', '$image_name')";

        if (mysqli_query($conn, $sql)) {
            move_uploaded_file($image_tmp_name, $image_folder);

                // Inside your registration process
// After successfully inserting a new user into the database
$newUserId = mysqli_insert_id($conn); // Assuming you're using MySQLi
$query = "UPDATE employees SET seen_by_admin = 0 WHERE id = $newUserId";
mysqli_query($conn, $query);

            echo "<p class='alert alert-success'>Registered successfully.</p>";
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>




        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '').toUpperCase();" placeholder="First Name">
                <?php
                if (isset($_POST["submit"]) && empty($firstname)) {
                    echo "<div class='alert alert-danger small'>First Name is required</div>";
                }
                ?>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="lastname" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '').toUpperCase();" placeholder="Last Name">
                <?php
                if (isset($_POST["submit"]) && empty($lastname)) {
                    echo "<div class='alert alert-danger small'>Last Name is required</div>";
                }
                ?>
            </div>

            <div class="form-group">
                <span id="check-email"></span>
                <input type="email" class="form-control" name="email" id="email" oninput="this.value = this.value.toLowerCase(); liveCheckEmail(); checkEmail();" placeholder="Email">

                <?php
                if (isset($_POST["submit"]) && empty($email)) {
                    echo "<div class='alert alert-danger small'>Enter Email</div>";
                }
                ?>
            </div>

            <div class="form-group">
                <input type="tel" class="form-control" name="phonenumber" oninput="this.value = this.value.replace(/\D/g, '').substring(0, 10);" placeholder="Phone Number">
                <?php
                if (isset($_POST["submit"])) {
                    $phonenumber = $_POST["phonenumber"];
                    if (empty($phonenumber) || strlen($phonenumber) !== 10) {
                        echo "<div class='alert alert-danger small'>Please enter a 10-digit phone number</div>";
                    }
                }
                ?>
            </div>
            <?php
include "database_reg.php";

$query = "SELECT departments FROM departments";
$result = $conn->query($query);

if (!$result) {
    die("Error in query: " . $conn->error);
}

?>
<div class="form-group">
    <label for="departments">Select Department:</label>
    <select class="form-control" id="departments" name="departments">
        <?php
        while ($row = $result->fetch_assoc()) {
            $departments = $row["departments"];
            echo "<option value=\"$departments\">$departments</option>";
        }
        ?>
    </select>
</div>

<?php
$conn->close();
?>


            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <?php
                if (isset($_POST["submit"])) {
                    $password = $_POST["password"];

                    if (empty($password)) {
                        echo "<div class='alert alert-danger small'>Password is required</div>";
                    } elseif (isset($error)) {
                        echo "<div class='alert alert-danger small'>$error</div>";
                    }
                }
                ?>
            </div>

            <div class="form-group mb-1">
                <label class="font-weight-bold">Profile Picture:</label>
                <input type="file" class="form-control-file" name="image" accept="image/jpg, image/png, image/jpeg">
            </div>

            <label class="font-weight-bold mb-2 mx-5">Gender: </label>

            <div class="form-check form-check-inline p-0">
                <input   class="form-check-input" type="radio" name="gender" id="maleGender" value="Male">
                <label class="form-check-label" for="maleGender">Male</label>
            </div>

            <div class="form-check form-check-inline p-4">
                <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female">
                <label class="form-check-label" for="femaleGender">Female</label>
            </div>

            <div class="text-center" style="max-width: 600px; margin: 0 auto;">
                <button type="submit" class="btn btn-primary w-100 flex-fixed" id="submit" name="submit">Submit</button>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <div><a  style="color: blue; font-weight: bold;" href="login.php">Login</a></div>
            </div>

            <p class="text-center mx-md-center" style="color: red;">&copy; <?php echo date("Y"); ?> by Antony. All rights reserved.</p>
        </form>
    </div>

    <script>
      function liveCheckEmail() {
        const emailInput = document.getElementById("email");
        let inputValue = emailInput.value.toLowerCase();

        // Check if the email contains ".com"
        const indexOfDotCom = inputValue.indexOf(".com");
        if (indexOfDotCom !== -1) {
            // Modify the input value to include only the part before ".com"
            emailInput.value = inputValue.substring(0, indexOfDotCom + 4);
        }
    }

        document.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                const inputs = document.querySelectorAll("input[type='text'], input[type='email'], input[type='tel'], input[type='password']");
                const index = Array.from(inputs).findIndex(input => document.activeElement === input);

                if (index >= 0 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else if (index === inputs.length - 1) {
                    const form = document.querySelector("form");
                    form.submit();
                }
            }
        });

        function checkEmail() {
            // Get the entered email value
            var email = $("#email").val();

            // Perform AJAX request to check if the email exists
            $.ajax({
                type: "POST",
                url: "check_email.php", // Replace with the actual PHP file that handles the email check
                data: {
                    email: email
                },
                success: function (response) {
                    // Display the response in the check-email span
                    $("#check-email").html(response);
                }
            });
        }
    </script>
</body>

</html>
