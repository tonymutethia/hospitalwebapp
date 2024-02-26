<?php
include "database_reg.php";
session_start(); // Start the session
?>

<script>
    

    // Set browser information to the hidden field
    document.getElementById('browserInfo').value = getBrowserInfo();

    // Function to get browser information
    function getBrowserInfo() {
        return navigator.userAgent;
    }

    // Set browser information to the hidden field
document.getElementById('browserInfo').value = getBrowserInfo();

// Function to get live location
function getLiveLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const location = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                document.getElementById('liveLocation').value = JSON.stringify(location);
            },
            function (error) {
                console.error('Error getting location:', error);
            }
        );
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
}

// Fetch live location when the page loads
window.onload = function () {
    getLiveLocation();
};
</script>

<?php
if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check if the email ends with @gmail.com
    if (strtolower(substr($email, -10)) !== "@gmail.com") {
        $_SESSION['error'] = "Invalid email format. Please enter a valid Gmail address.";
    } else {
        $query = "SELECT * FROM employees WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $user = mysqli_fetch_assoc($result);

            if ($user !== null) {
                // Check if 'action1' is null
                if ($user['action1'] === null || $user['action1'] === 'NOT ASSIGNED' || $user['action1'] ==='Not approved') {
                    $_SESSION['error1'] = "Wait for approval";
                } else{

                // Check if 'action1' is 'disable'
                if ($user['action1'] === 'disable') {
                    $_SESSION['error2'] = "You have been disabled. Please contact the administrator.";
                } else {
                    // Store user information in the session
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_firstname'] = $user['firstname'];
                    $_SESSION['user_image'] = $user['image'];
                    $_SESSION['user_lastname'] = $user['lastname'];
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['department'] = $user['department'];
                    $_SESSION['action1'] = $user['action1'];
                    $_SESSION['phonenumber'] = $user['phonenumber'];
                    $_SESSION['password'] = $user['password'];

                    $fullname = $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'];
                   
                    // Get the current timestamp
                    $login_time = date("Y-m-d H:i:s");

                    // Store login time in a session variable
                    $_SESSION['login_time'] = $login_time;
  // Store browser info in the session
$_SESSION['browser_info'] = $_POST['browserInfo'];

// Store live location in the session
$_SESSION['live_location'] = $_POST['liveLocation'];

// Update the auditlog query to include browser info and live location
$sql = "INSERT INTO auditlog (id, fullname, email, phonenumber, department, date_time, browser_info, live_location) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("ssssssss", $_SESSION['id'], $fullname, $_SESSION['user_email'], $_SESSION['phonenumber'], $_SESSION['department'], $_SESSION['login_time'], $_SESSION['browser_info'], $_SESSION['live_location']);

// Fetch browser info and live location from POST data
$browserInfo = mysqli_real_escape_string($conn, $_POST['browserInfo']);
$liveLocation = mysqli_real_escape_string($conn, $_POST['liveLocation']);


                    // Execute the statement
                    if ($stmt->execute()) {
                        // Redirect based on department
                        switch ($user['action1']) {
                            case 'doctor':
                                header("Location: /hospitalweb/dashboard1/doctor.php");
                                break;
                            case 'nurse':
                                header("Location: /hospitalweb/dashboard1/nurse.php");
                                break;
                            case 'laboratory':
                                header("Location: /hospitalweb/dashboard1/laboratory.php");
                                break;
                            case 'reception':
                                header("Location: /hospitalweb/dashboard1/reception.php");
                                break;
                            case 'pharmacy':
                                header("Location: /hospitalweb/dashboard1/pharmacy.php");
                                break;
                            case 'humanresource':
                                header("Location: /hospitalweb/dashboard1/hr.php");
                                break;
                            case 'finance':
                                header("Location: /hospitalweb/dashboard1/finance.php");
                                break;
                            case 'it':
                                header("Location: /hospitalweb/dashboard1/dashboard.php");
                                break;
                            case 'adminstaff':
                                header("Location: /hospitalweb/dashboard1/admin.php");
                                break;
                                case 'POS':
                                    header("Location: /hospitalweb/dashboard1/POS.php");
                                    break;
                            // // Add more cases as needed
                            // default:
                            //     header("Location: /hospitalweb/dashboard1/dashboard.php");
                            //     break;
                        }
                        exit();
                    } else {
                        // Error occurred
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }

                    // Close the statement
                    $stmt->close();
                }
            }
            } else {
                $_SESSION['error'] = "Email or password doesn't match";
                if (!isset($_SESSION['login_attempts'])) {
                    $_SESSION['login_attempts'] = 1;
                } else {
                    $_SESSION['login_attempts']++;
                }

                if ($_SESSION['login_attempts'] >= 7) {
                    $_SESSION['is_suspended'] = 1;
                    $_SESSION['error'] = "Account suspended due to multiple failed login attempts";
                    unset($_SESSION['login_attempts']);
                }
            }
        } else {
            $_SESSION['error'] = "Error executing the query";
        }
    }
}

if (isset($conn)) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body style="background-color: wheat;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h2>Login</h2>
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                   
                    <div class='alert alert-danger small'><?php echo $_SESSION['error'];?></div>
                   
                    <?php
                     unset($_SESSION['error']); 

                    ?> <!-- Clear the error after displaying -->
                <?php endif; ?>
                <?php if (isset($_SESSION['error1'])): ?>
                   
                   <div class='alert alert-primary small'><?php echo $_SESSION['error1'];?></div>
                  
                   <?php
                    unset($_SESSION['error1']); 

                   ?> <!-- Clear the error after displaying -->
               <?php endif; ?>
               <?php if (isset($_SESSION['error2'])): ?>
                   
                   <div class='alert alert-success small'><?php echo $_SESSION['error2'];?></div>
                  
                   <?php
                    unset($_SESSION['error2']); 

                   ?> <!-- Clear the error after displaying -->
               <?php endif; ?>
                <form action="" method="POST" onsubmit="return validateForm();">
                  <!-- Existing form fields -->
    <input type="hidden" id="browserInfo" name="browserInfo" value="">
    <input type="hidden" id="liveLocation" name="liveLocation" value="">
    <!-- Other form fields -->
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" id="email" name="email" oninput="this.value = this.value.toLowerCase(); liveCheckEmail();"  placeholder="Email">
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-sm"><a href="forgotpassword.php">Forgot Password?</a></p>
                        <a href="register.php" style="color: red;">Register?</a>
                    </div>
                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-primary w-100" name="submit">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <!-- ... Previous HTML and PHP code ... -->

    <script>
        document.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                const inputs = document.querySelectorAll("input[type='text'], input[type='email'], input[type='tel'], input[type='password']");
                const index = Array.from(inputs).findIndex(input => document.activeElement === input);

                if (index >= 0 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else if (index === inputs.length - 1) {
                    const form = document.getElementById("loginForm");
                    form.submit();
                }
            }
        });
    </script>


<!-- ... Remaining HTML and PHP code ... -->

    <div>
        <p class="text-center mx-auto" style="color:darkblue">&copy; <?php echo date("Y"); ?> by Antony. All rights reserved.</p>
    </div>
   

</body>
</html>
