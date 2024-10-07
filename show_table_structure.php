<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve database and table names from the form submission
    $combo1 = $_POST["course"];
    $combo2 = $_POST["Selected_Value"];
    // Combine them to form the table name.
    $table_name = $combo1 . '_' . $combo2;
    $database = "co_po";
    
    // Connect to MySQL (replace these values with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the selected table is 'cource_co'
       // Fetch rows from cource_co where class = 'Cs3202_Assignment-1'
       $query = "SELECT class as `Enrollment no`, co1, co2, co3, co4, co5, co6 FROM course_co WHERE class = :table_name";
            $statement = $conn->prepare($query);
            $statement->bindParam(':table_name', $table_name, PDO::PARAM_STR);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Check if any rows are found
            if (count($rows) > 0) {
                // Identify columns with null or zero values
                $columnsWithNullZero = array();
                foreach ($rows as $row) {
                    foreach ($row as $key => $value) {
                        if ($value === null || $value === 0) {
                            $columnsWithNullZero[$key] = true;
                        }
                    }
                }

                // Display the table structure
                echo "<h2><style>
                body {
                    color: white;
                }
            </style>Table Structure for $combo1 and $combo2</h2>";
                echo "<table border='1'><tr>";
                foreach ($rows[0] as $key => $value) {
                    // Only display columns without null or zero values
                    if (!isset($columnsWithNullZero[$key])) {
                        echo "<th>$key</th>";
                    }
                }
                echo "</tr>";

                // Skip displaying row data

                echo "</table>";
                echo"<br>";
                echo "<h5>Please make the column Name Same as shown above</h5>";
            } else {
                echo "<p><style>
                body {
                    color: white;
                }
            </style>Please Contact Teacher Cordinator for CO Insersion</p>";
            }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
