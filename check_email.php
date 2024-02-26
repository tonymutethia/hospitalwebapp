<?php
include "database_reg.php"; // Include your database connection file

if (isset($_POST["email"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $checkQuery = "SELECT * FROM employees WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Email already exists
        echo "<div class='alert alert-danger small'>Email already in use.</div>";
        echo "<script>document.getElementById('submit-btn').disabled = true;</script>";
    } else {
        // Email does not 
        echo "<script>document.getElementById('submit-btn').disabled = false;</script>";
    }
}

mysqli_close($conn);
?>
