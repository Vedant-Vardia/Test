<!-- index1.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="import.css">
    <title>MySQL Table Structure Viewer</title>
</head>
<body>
    <h1>MySQL Table Structure Viewer</h1>
    <form action="show_table_structure.php" method="post" target="tableFrame">
        
        <br>
        <label for="table">Select Table:</label>
  <select id="combo1" name="course" onchange="updateCourseCode()">
        <option value="">Select Course...</option>
        <?php
        // PHP code to fetch course codes from the database and generate options
        $servername = "localhost";  
        $username = "root";
        $password = "";
        $dbname = "co_po"; // Name of your database

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check for connection errors
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT course_code FROM course"; // Assuming the column name is "course_code"

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["course_code"] . '">' . $row["course_code"] . '</option>';
          }
        } else {
          echo "No courses available.";
        }

        // Close the database connection
        $conn->close();
        ?>
      </select>
 
        <br>
        <label for="table">Select Table:</label>
        
    <select id="target" name="Selected_Value" onchange="updateSelectedValue()">
    <option value="">Select...</option>
    <option value="Assignment-1">Assignment-1</option>
    <option value="Assignment-2">Assignment-2</option>
    <option value="Quiz-1">Quiz-1</option>
    <option value="Quiz-2">Quiz-2</option>
    <option value="MTE">MTE</option>
      </select>
  
        <br>
        <input type="submit" value="Show Table Structure" onclick="getValue()">
    </form>

    <iframe name="tableFrame" id="tableFrame" width="100%" height="200"></iframe>

    <div id="additionalButtons" style="margin-top: 20px;">
        <!-- Additional button to be shown after displaying table structure -->
        <button onclick="showUploadForm()">Upload Excel File</button>
    </div>

    <div id="uploadForm" style="display: none;">
        <!-- Form for uploading Excel file (you can customize this) -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".xls, .xlsx">
        <input type="submit" value="Upload">
        <input type="hidden" name="sub" id="combinedValue" name="combinedValue">
        </form>
    </div>
    <script>
        function getValue() {
        // Get the dropdown elements
        var dropdown1 = document.getElementById("combo1");
        var dropdown2 = document.getElementById("target");

        // Get the selected values
        var selectedValue1 = dropdown1.value;
        var selectedValue2 = dropdown2.value;

        // Combine the values with '_'
        var combinedValue = selectedValue1 + '_' + selectedValue2;

        // Set the combined value in the hidden input field
        document.getElementById("combinedValue").value = combinedValue;
    }
        function showUploadForm() {
            document.getElementById('uploadForm').style.display = 'block';
        }
    </script>
</body>
</html>
