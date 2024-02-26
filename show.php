
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HewaHosp</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.bundle.js"></script>
 <script src="js/script.js"></script>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <?php
// Include your database connection code here
include "database_reg.php";

// Function to get the count of employees in a specific department
function getDepartmentCount($department) {
    global $conn;
    $query = "SELECT COUNT(*) as count FROM employees WHERE department = '$department'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Define the departments
$departments = [
    'ADMIN' => 'text-success',
    'doctor' => 'text-purple',
    'laboratory' => 'text-info'
];

// Generate HTML for each department
foreach ($departments as $departmentName => $textColor) {
    $count = getDepartmentCount($departmentName);
    echo '<div class="col-lg-4 col-md-12">';
    echo '<div class="white-box analytics-info">';
    echo '<h3 class="box-title">' . $departmentName . '</h3>';
    echo '<ul class="list-inline two-part d-flex align-items-center mb-0">';
    echo '<li>';
    echo '<div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>';
    echo '</div>';
    echo '</li>';
    echo '<li class="ms-auto"><span class="counter ' . $textColor . '">' . $count . '</span></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
}
?>


</body>
</html>