<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Establish a database connection (similar to what you did for populating the course codes).
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "co_po"; // Your database name
    $conn = new mysqli($servername, $username, $password, $dbname);
    print_r($_POST);
    // Check for connection errors and handle them.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the selected values from combo1 and combo2.// Combine them to form the table name.
    $table_name =$_POST["sub"];
   
    // Loop through the COs, assuming the names match your input fields.
    // Get the value entered for each CO.
    $co1 = $_POST["co1"]??'NULL';
    $co2 = $_POST["co2"]??'NULL';
    $co3 = $_POST["co3"]??'NULL';
    $co4 = $_POST["co4"]??'NULL';
    $co5 = $_POST["co5"]??'NULL';
    $co6 = $_POST["co6"]??'NULL';

    // Validate and sanitize the input data.
    // You should implement appropriate validation and sanitation methods here.

    // Insert the data into the database.
    $sql = "INSERT INTO course_co (class, CO1, Co2, Co3, CO4, Co5, CO6) VALUES ('$table_name', '$co1', '$co2', '$co3', '$co4', '$co5', '$co6')";

    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            function showMessage() {
                alert("The Data Has Been Inserted Successfully");
            }
            showMessage(); // Call the function when the page loads
            // You can also redirect after showing the pop-up if needed
            window.location.href = "http://localhost/sih/index.html";
        </script>
        <?php  }else {
        // Handle errors if the query fails.
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
