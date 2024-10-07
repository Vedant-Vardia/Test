<?php
require 'dbconfig.php';
require 'spreadsheert/vendor/autoload.php'; // Include the PhpSpreadsheet autoload file
ini_set('display_errors', 1);
use PhpOffice\PhpSpreadsheet\IOFactory;
if (isset($_FILES['file']['name']) &&$_SERVER["REQUEST_METHOD"] == "POST") {

    $table_name =$_POST["sub"];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    // Check if the file is an Excel file
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    if (in_array($fileExt, ['xls', 'xlsx'])) {
        // Load the spreadsheet file
        $spreadsheet = IOFactory::load($fileTmpName);
        $sheet = $spreadsheet->getActiveSheet();
        // Flag to skip the first row
        $skipFirstRow = true;

        // Get the columns from the first row
        $columns = [];
        foreach ($sheet->getRowIterator() as $row) {
            if ($skipFirstRow) {
                $skipFirstRow = false;
                // Add 'subject' to the columns array
                $columns[] = 'subject';
                foreach ($row->getCellIterator() as $cell) {
                    $columns[] = $cell->getValue();
                }
                break; // Only need the columns from the first row
            }
        }

        // Loop through the rows and insert data into the MySQL database
     // Loop through the rows and insert data into the MySQL database
foreach ($sheet->getRowIterator() as $row) {
    $rowData = [];
    
    // Add the subject value to the row data
    $rowData[] = $table_name;
    
    foreach ($row->getCellIterator() as $cell) {
        $rowData[] = $cell->getValue();
    }
            // Generate dynamic column names and values for the SQL query
            $columnNames = implode(', ', $columns);
            $placeholders = implode(', ', array_fill(0, count($columns), '?'));
            
            // Insert data into the MySQL database
            $sql = "INSERT INTO import_marks ($columnNames) VALUES ($placeholders)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($columns)), ...$rowData);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $sqlImportco = "INSERT INTO co_attenment ($columnNames) VALUES ($placeholders)";
            $stmtImportco = mysqli_prepare($conn, $sqlImportco);
            mysqli_stmt_bind_param($stmtImportco, str_repeat('s', count($columns)), ...$rowData);
            mysqli_stmt_execute($stmtImportco);
            mysqli_stmt_close($stmtImportco);
        }
        ?>
        <script>
            function showMessage() {
                alert("The Data Has Been Inserted Successfully");
            }
            showMessage(); // Call the function when the page loads
            // You can also redirect after showing the pop-up if needed
            window.location.href = "http://localhost/sih/index.html";
        </script>
        <?php  } else {
        echo "Invalid file format. Please upload an Excel file.";
    }
}
?>
