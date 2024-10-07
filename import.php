<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="import.css">
    <title>Document</title>
</head>

<body>
    <div class="container py-5  gap-3 text-light">

        <label for="SelectCourse">SelectCourse:</label>
            <select id="SelectCourse" name="course" onchange="updateCourseCode()">
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

    

        <label for="Select">SelectTerm:</label>
        <select id="SelectTerm" name="Selected_Value" onchange="updateSelectedValue()">
          <option value="NAN">NAN</option>
          <option value="ASSIGNMENT-1">ASSIGNMENT-1</option>
          <option value="ASSIGNMENT-2">ASSIGNMENT-2</option>
          <option value="QUIZ-1">QUIZ-1</option>
          <option value="QUIZ-2">QUIZ-2</option>
          <option value="MTE">MTE</option>
          
          <!-- Add more animation style options here -->
        </select>
        <button class="SubmitBtn btn-secondary"  onclick="getValue()">Submit</button>
        </div>
        <form action="submit_Data.php" method="post">
        <div class="container marksAssign d-none">
            <div class="btn-group  flex-row gap-3" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" name="co1" class="btn-check" id="btncheck1" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck1">CO1<input name="co1" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
              <br><br><br>
                <input type="checkbox" name="co2" class="btn-check" id="btncheck2" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck2">CO2<input name="co2" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
                <br><br><br>
                <input type="checkbox" name="co3" class="btn-check" id="btncheck3" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck3">CO3<input name="co3" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
                
                </div>
                <br><br><br>
                <div class="btn-group  flex-row gap-3" role="group" aria-label="Basic checkbox toggle button group">
                
                <input type="checkbox" name="co4" class="btn-check" id="btncheck4" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck4">CO4<input name="co4" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
                <br><br><br>
                <input type="checkbox" name="co5" class="btn-check" id="btncheck5" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck5">CO5<input name="co5" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
                <br><br><br>
                <input type="checkbox" name="co6" class="btn-check" id="btncheck6" autocomplete="off">
                <label class="COS btn btn-outline-primary" for="btncheck6">CO6<input name="co6" type="text" class="bg-dark inputElem px-2 mx-2" placeholder="Enter your marks" disabled></label>
                <input type="hidden" name="sub" id="combinedValue" name="combinedValue">
            </div>
                 <button class="SubmitBtn btn-secondary">Submit</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="import.js"></script>
    <script>
        function getValue() {
        // Get the dropdown elements
        var dropdown1 = document.getElementById("SelectCourse");
        var dropdown2 = document.getElementById("SelectTerm");

        // Get the selected values
        var selectedValue1 = dropdown1.value;
        var selectedValue2 = dropdown2.value;

        // Combine the values with '_'
        var combinedValue = selectedValue1 + '_' + selectedValue2;

        // Set the combined value in the hidden input field
        document.getElementById("combinedValue").value = combinedValue;
    }</script>
</body>

</html>
