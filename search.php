<?php
include("database_reg.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = mysqli_real_escape_string($conn, $_POST['query']);

    $sql = "SELECT id, firstname, lastname, email, phonenumber, department, password, gender, action1 FROM employees WHERE 
            LOWER(firstname) LIKE '%$searchQuery%' OR
            LOWER(lastname) LIKE '%$searchQuery%' OR
            LOWER(email) LIKE '%$searchQuery%' OR
            LOWER(phonenumber) LIKE '%$searchQuery%' OR
            LOWER(department) LIKE '%$searchQuery%' OR
            LOWER(password) LIKE '%$searchQuery%' OR
            LOWER(gender) LIKE '%$searchQuery%' OR
            LOWER(action1) LIKE '%$searchQuery%'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['firstname'] . '</td>';
            echo '<td>' . $row['lastname'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phonenumber'] . '</td>';
            echo '<td>' . $row['department'] . '</td>';
            echo '<td>' . $row['password'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo '<td>
                     <select name="actions[' . $row['id'] . ']">
                         <option value="doctor" ' . ($row['action1'] == 'doctor' ? 'selected' : '') . '>Doctor</option>
                         <option value="nurse" ' . ($row['action1'] == 'nurse' ? 'selected' : '') . '>Nurse</option>
                         <!-- Add other options as needed -->
                     </select>
                 </td>';
            echo '<td><input type="submit" value="Update" style="background-color:green;"></td>';
            echo '</tr>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
