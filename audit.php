<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUDITLOG</title>
    <link rel="icon" href="icon/icon1.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <style>
        .scrollable-col-8 {
            max-height: 100vh; /* Set col-8 to take up 100% of viewport height */
            overflow-y: auto; /* Enable vertical scrolling */
        }
    </style>
</head>

<body>
    <main class="table">
        <div class="container"   >
            <div class="row" >
                <div class="col-md-12">
                    <!-- <section class="table_header">
                        <h1 class="text-center">AUDITLOG</h1>
                        <div class="container p-0 d-flex justify-content-right align-items-center">
                           
                          
                        </div>
                    </section> -->
                    <!-- <button class="btn btn-danger mt-0 mb-4" onclick="goBack()">
                                <span style="color: white;">Back</span>
                            </button>
                    <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script> -->
                    <div class="row">
                        <div class="col-md-4">
                            <section class="table_body">
                                <table class="table table-responsive" id="dataTable">
                                    <thead >
                                        <tr class="table_header">
                                            <th style="font-size:14px;" >Full Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("database_reg.php");

                                        $sql = "SELECT DISTINCT id, fullname FROM auditlog";
                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td><a href="javascript:void(0);" class="user-link" data-name="' . urlencode($row['fullname']) . '" data-id="' . $row['id'] . '">' . $row['fullname'] . '</a></td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }

                                        mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <div class="col-md-8">
    <section class="details_section scrollable-col-8">
        <?php
        include("database_reg.php");

        // Check if a name and ID are clicked
        if (isset($_GET['name']) && isset($_GET['id'])) {
            $clickedName = urldecode($_GET['name']);
            $clickedId = $_GET['id'];

            $sql = "SELECT id, email, department, phonenumber, date_time FROM auditlog WHERE fullname = ? AND id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "si", $clickedName, $clickedId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        ?>
                <div class="table-responsive">
                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>CONTACT</th>
                                <th>EMAIL</th>
                                <th>DEPARTMENT</th>
                                <th>ACCESS TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $clickedName . '</td>'; // Assuming you want to display the clicked name
                                echo '<td>' . $row['phonenumber'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['department'] . '</td>';
                                echo '<td>' . $row['date_time'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                if ($result) {
                    echo '<div class="user-details mt-4">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<table class="table">';
                        echo '<tr><th colspan="2">User Details</th></tr>';
                        echo '<tr><td>Email:</td><td>' . $row['email'] . '</td></tr>';
                        echo '<tr><td>Department:</td><td>' . $row['department'] . '</td></tr>';
                        echo '<tr><td>Date/Time:</td><td>' . $row['date_time'] . '</td></tr>';
                        echo '</table>';
                    }
                    echo '</div>';
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>
    </section>
</div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Add an event listener to all elements with the class "user-link"
        document.querySelectorAll('.user-link').forEach(function(element) {
            element.addEventListener('click', function() {
                // Redirect to the same page with the name and ID as query parameters
                window.location.href = '?name=' + this.getAttribute('data-name') + '&id=' + this.getAttribute('data-id');
            });
        });
    </script>

</body>

</html>
