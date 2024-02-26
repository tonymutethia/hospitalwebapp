<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="stylestable.css">
    <script src="/jquery-3.6.4.min.js"></script>
</head>
<body>
    <main class="table">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <!-- <section class="table_header">
                        <h1>Registered employees</h1>
                        <div class="container p-0 d-flex justify-content-right align-items-center">
                            <button class="btn btn-danger">
                                <a style="color: white;" href="../home.php">Back</a>
                            </button>
                        </div>
                    </section> -->
                    <section class="table_body">
                        <div class="table-container">
                            <!-- <div class="mb-3">
                                <label for="searchInput" class="form-label">Search:</label>
                                <input type="text" class="form-control color-red" id="searchInput" placeholder="Search...">
                            </div> -->
                            <table class="table table-responsive" id="dataTable">
                                <thead>
                                    <tr class="table_header">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Department assigned</th>
                                        <th>Password</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("database_reg.php"); // Include your database connection code

                                    // SQL query to select specific columns from the 'employees' table
                                    $sql = "SELECT id, firstname, lastname, email, phonenumber, action1, password, gender FROM employees";

                                    // Execute the SQL query
                                    $result = mysqli_query($conn, $sql);

                                    // Check if the query was successful
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['action1'] !== null && $row['action1'] !== 'disable' &&  $row['action1'] !== 'NULL' &&  $row['action1'] !== 'NOT ASSIGNED') {
                                                echo '<tr>';
                                                echo '<td>' . $row['firstname'] . '</td>';
                                                echo '<td>' . $row['lastname'] . '</td>';
                                                echo '<td>' . $row['email'] . '</td>';
                                                echo '<td>' . $row['phonenumber'] . '</td>';
                                                echo '<td>' . $row['action1'] . '</td>';
                                                echo '<td>' . $row['password'] . '</td>';
                                                echo '<td>' . $row['gender'] . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }

                                    // Close the database connection
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- Add the search script -->
        <script>
            $(document).ready(function () {
    console.log('Document is ready!');
    
    $('#searchInput').on('input', function () {
        console.log('Input changed!');
        // Your existing search code
    });

    // Trigger search on Enter key press
    $('#searchInput').keypress(function (e) {
        console.log('Key pressed:', e.which);
        if (e.which === 13) {
            $(this).trigger('input');
        }
    });
});

        </script>
    </main>
</body>
</html>
