<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New employees</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
    <!-- <link rel="stylesheet" href="stylestable.css"> -->
    <script src="js/jquery-3.7.1.min.js"></script>
</head>
<body>
<main class="table">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <!-- <section class="table_header">
                    <h1>New employees</h1>
                    <div class="container p-0  d-flex justify-content-right align-items-center">
                        <button class="btn btn-danger">
                            <a style="color: white;" href="../home.php">Back</a>
                        </button>
                    </div>
                </section> -->
                <!-- <div class="mb-3">
                                <label for="searchInput" class="form-label">Search:</label>
                                <input type="text" class="form-control color-red" id="searchInput" placeholder="Search...">
                              </div> -->
                <section class="table_body">
                <table class="table table-responsive" id="dataTable">
                    <?php
                    include("database_reg.php");

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        foreach ($_POST['actions'] as $Id => $action) {
                            $Id = mysqli_real_escape_string($conn, $Id);
                            $action = mysqli_real_escape_string($conn, $action);
                            $updateQuery = "UPDATE employees SET action1 = '$action' WHERE id = $Id";
                            mysqli_query($conn, $updateQuery);
                            
                            
                            if($user['action1'] ='NOT ASSIGNED' || $user['action1'] ='disable'){

                                $query = "UPDATE employees SET seen_by_admin = 1 WHERE seen_by_admin = 0";
                                mysqli_query($conn, $query);

                            }


       


                        }
                    }

                    $sql = "SELECT id, firstname, lastname, email, phonenumber, department, password, gender, action1 FROM employees";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo '<div class="table-container">';
                       
                        echo '<form method="POST" action="">';
                        echo '<div class="table_body">';
                        echo '<table class="table table-responsive"   id="dataTable">';
                        echo '<thead>
                                <tr class="table_header">
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Password</th>
                                    <th>Gender</th>
                                    <th style="color:red;">Action</th>
                                    <th>Update</th>
                                </tr>
                              </thead>';
                        echo '<tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['action1'] == 'NOT ASSIGNED' || $row['action1'] == 'disable'){
                            echo '<tr>';
                            echo '<td>' . $row['firstname'] . '</td>';
                            echo '<td>' . $row['lastname'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['phonenumber'] . '</td>';
                            echo '<td>' . $row['department'] . '</td>';
                            echo '<td>' . $row['password'] . '</td>';
                            echo '<td>' . $row['gender'] . '</td>';
                            echo '<td>
                    <select name="actions[' . $row['id'] . ']">';

            // Manually add "NOT ASSIGNED" and "Disable" options
            $options = array('NOT ASSIGNED', 'disable');

            // Display manually added options
            foreach ($options as $option) {
                echo '<option value="' . $option . '" ' . ($row['action1'] == $option ? 'selected' : '') . '>' . $option . '</option>';
            }

            // Fetch options from the database
            $query = "SELECT departments FROM departments";
            $deptResult = mysqli_query($conn, $query);

            // Display options fetched from the database
            while ($department = mysqli_fetch_assoc($deptResult)) {
                $value = $department['departments'];
                $label = ucfirst($value); // Optionally capitalize the first letter
                echo '<option value="' . $value . '" ' . ($row['action1'] == $value ? 'selected' : '') . '>' . $label . '</option>';
            }

            echo '</select>
                  </td>';
                    
                    echo '<td><input  type="submit" value="ASSIGN" style="background-color:green;";></td>';
                        
                            echo '</tr>';
                            }
                        }

                        echo '</tbody>';
                        
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                    ?>
                    </table>
                </section>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            var searchQuery = $(this).val().toLowerCase();

            // Filter the table rows based on the search query
            $('#dataTable tbody > tr').each(function () {
                var rowData = $(this).text().toLowerCase();
                if (rowData.includes(searchQuery)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        var debounceTimer;
$('#searchInput').on('input', function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
        var searchQuery = $('#searchInput').val().toLowerCase();
        // Your search logic here
    }, 300); // Adjust the delay as needed (in milliseconds)
});


        // Trigger search on Enter key press
        $('#searchInput').keypress(function (e) {
            if (e.which === 13) {
                $(this).trigger('input');
            }
        });
    });

   
</script>
</body>
</html>
