<?php 
include("../Login/connectiondepartment.php");
include("Adminhome.php");



// Delete functionality
if (isset($_GET['delete_feedback1_id'])) {
    $deleteId = $_GET['delete_feedback1_id'];
    $deleteQuery = "DELETE FROM dept WHERE depid = $deleteId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Record deleted successfully!";
        echo "<script>window.location = 'DASHBOARDUPLOAD.php#top';</script>"; // Redirect to top of the page after deletion
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Inserting new department event information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetching department event details from the form
    $campus = $_POST['campus'];
    $selectedDepartment = $_POST['selectedDepartment'];
    $departmentEventTitle = $_POST['departmentEventTitle'];
    $departmentEventSubtitle = $_POST['departmentEventSubtitle'];
    $departmentEventDescription = $_POST['departmentEventDescription'];
    
    // Handling the department event image upload (you might need to process the image here)
    $depImage = $_FILES['depImage']['name'];
    $depImageTmpName = $_FILES['depImage']['tmp_name'];
    $depImageDestination = "departmentupload/" . $depImage; // Destination directory to save uploaded images

    // Move uploaded image to the specified directory
    move_uploaded_file($depImageTmpName, $depImageDestination);

    // Inserting data into the database table 'dept'
    
   // Inserting data into the database table 'dept'
$insertQuery = "INSERT INTO `dept` (`Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription`)
VALUES (?, ?, ?, ?, ?, ?)";

   if ($stmt = mysqli_prepare($conn, $insertQuery)) {
    mysqli_stmt_bind_param($stmt, "ssssss", $campus, $selectedDepartment, $depImage, $departmentEventTitle, $departmentEventSubtitle, $departmentEventDescription);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Department event information added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "Prepared statement error: " . mysqli_error($conn);
}
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit-depid'])) {
    $editId = $_POST['edit-depid'];
    $editCampus = $_POST['edit-campus'];
    $editSelectedDepartment = $_POST['edit-selectedDepartment'];
    $editDepartmentEventTitle = $_POST['edit-departmentEventTitle'];
    $editDepartmentEventSubtitle = $_POST['edit-departmentEventSubtitle'];
    $editDepartmentEventDescription = $_POST['edit-departmentEventDescription'];
    
    // Update the database with the received data for editing
    $updateQuery = "UPDATE dept 
                    SET Selectcampus = '$editCampus', 
                        SelectDepartment = '$editSelectedDepartment', 
                        deptitle = '$editDepartmentEventTitle', 
                        depsubtitle = '$editDepartmentEventSubtitle', 
                        depdescription = '$editDepartmentEventDescription' 
                    WHERE depid = $editId";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Department event information updated successfully!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


// Display table based on selection or search
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        $searchDepartment = $_POST['searchDepartment'];
        $displayQuery = "SELECT * FROM dept WHERE SelectDepartment LIKE '%$searchDepartment%'";
    } else {
        // Your previous default display query
        $displayQuery = "SELECT * FROM dept";
    }
    $displayResult = mysqli_query($conn, $displayQuery);
} else {
    // Default display query
    $displayQuery = "SELECT * FROM dept";
    $displayResult = mysqli_query($conn, $displayQuery);
}


// Display table
$displayQuery = "SELECT * FROM dept";
$displayResult = mysqli_query($conn, $displayQuery);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Event Information</title>
    <link rel="stylesheet" href="DASHBOARDUPLOAD1.css">
</head>
<body>
<div class="container122">  
        <p class="Lines1"></p>
        <p class="ContactHEAD1">ADD DEPARTMENT EVENT</p>
        <P class="Lines1"></P>
    </div>
    <div class="container">
    <div class="main">
        <p class="upheader">Add Department Event Information</p>
        <br>
        <form method="post" action="DASHBOARDUPLOAD.php" enctype="multipart/form-data">
            
            <label style="font-size:20px;" for="campus">Select Campus:</label>
            <select name="campus" id="campus">
                <option value="Las Piñas">Las Piñas</option>
                <option value="Molino">Molino</option>
                <option value="Calamba">Calamba</option>
                <!-- Add other campuses as needed -->
            </select><br>   <br>

            <label  style="font-size:20px;" for="selectedDepartment">Select Department:</label>
            <select name="selectedDepartment" id="selectedDepartment" >
            <option value="College of Accountancy">College of Accountancy</option>
            <option value="College of Arts and Sciences">College of Arts and Sciences</option>
            <option value="College of Aviation">College of Aviation</option>
            <option value="College of Business Administration">College of Business Administration</option>
            <option value="College of Computer Studies">College of Computer Studies</option>
            <option value="College of Criminology">College of Criminology</option>
            <option value="College of Dentistry">College of Dentistry</option>
            <option value="College of Education">College of Education</option>
            <option value="College of Education">College of Engineering, Architecture and Technology</option>
            <option value="College of International Tourism and Hospitality Management">College of International Tourism and Hospitality Management</option>
            <option value="College of Maritime Education">College of Maritime Education</option>
            <option value="College of Medical Technology">College of Medical Technology</option>
            <option value="College of Nursing">College of Nursing</option>
            <option value="College of Pharmacy">College of Pharmacy</option>
            <option value="College of Physical Therapy and Occupational Therapy">College of Physical Therapy and Occupational Therapy</option>
            <option value="College of Radiologic Technology">College of Radiologic Technology</option>
            <option value="College of Respiratory Therapy">College of Respiratory Therapy</option>
            </select><br>   <br>

            <label  style="font-size:20px; font-size:20px;" for="depImage">Department Event Image:</label>
            <input type="file" name="depImage" id="depImage" required><br>
            <br>
            <label style="text-align:center; font-size:20px;" for="departmentEventTitle">Department Event Title:</label>
            <input class="depsubti" type="text" name="departmentEventTitle" id="departmentEventTitle" required><br>
            <br>
            <label style="text-align:center; font-size:20px;"  for="departmentEventSubtitle">Department Event Subtitle:</label>
            <input class="depsubti" type="text" name="departmentEventSubtitle" id="departmentEventSubtitle" required><br>
            <br>
            <label for="departmentEventDescription" style="text-align:center; font-size:20px;">Department Event Description:</label><br>
            <textarea class="desP" class name="departmentEventDescription" id="departmentEventDescription" cols="30" rows="5" required></textarea><br>
            <br>
            <input style="width: 100%; font-style:bold; height:30px;" type="submit" name="submit" value="Add to the department">
        </form>
        </div>
    </div>
    <div class="container12">  
        <p class="Lines"></p>
        <p class="ContactHEAD">DEPARTMENT INFORMATION</p>
        <P class="Lines"></P>
        </div>

        <form method="post" action="DASHBOARDUPLOAD.php">
    <label for="searchDepartment">Search by Department:</label>
    <input type="text" name="searchDepartment" id="searchDepartment">
    <input type="button" name="search" value="Search" onclick="submitForm()">
</form>
        <table border='1'>


    <thead>
        <tr>
            <th>ID</th>
            <th>CAMPUS</th>
            <th>DEPARTMENT</th>
            <th>IMAGE</th>
            <th>TITLE</th>
            <th>SUBTITLE</th>
            <th>DEPSCIPTION</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $counter = 1; // Initialize a counter
        while ($row = mysqli_fetch_assoc($displayResult)) {
            echo "<tr>";
            // Display a counter as the first column
            echo "<td>".$counter."</td>";
            echo "<td>".$row['Selectcampus']."</td>";
            echo "<td>".$row['SelectDepartment']."</td>";
            // Displaying the image using <img> tag
            echo "<td><img src='departmentupload/".$row['depimg']."' width='100' height='100' alt='Department Image'></td>";

            // Enable inline editing by setting 'contenteditable'
            echo "<td contenteditable='true' data-id='".$row['depid']."' data-column='deptitle'>".$row['deptitle']."</td>";
            echo "<td contenteditable='true' data-id='".$row['depid']."' data-column='depsubtitle'>".$row['depsubtitle']."</td>";
            echo "<td contenteditable='true' data-id='".$row['depid']."' data-column='depdescription'>".$row['depdescription']."</td>";
            echo "<td>"; // Open the cell for buttons

            echo "<button class='delete-btn' data-id='".$row['depid']."'>Delete</button>"; // Delete button
            echo "</td>";
            
            echo "</tr>";
            $counter++; // Increment the counter for the next row
        }
        ?>
</tbody>
        </table>
    </div>
    <div class="edit-form" style="display: none;">
    <h2>Edit Department Event</h2>
    <form method="post" action="DASHBOARDUPLOAD.php">
        <input type="hidden" id="edit-depid" name="edit-depid">
        <label for="edit-campus">Select Campus:</label>
        <select name="edit-campus" id="edit-campus">
            <option value="Las Piñas">Las Piñas</option>
            <option value="Molino">Molino</option>
            <option value="Calamba">Calamba</option>
            <!-- Add other campuses as needed -->
        </select><br><br>

        <label for="edit-selectedDepartment">Select Department:</label>
        <select name="edit-selectedDepartment" id="edit-selectedDepartment">
            <!-- Add options dynamically based on your departments -->
        </select><br><br>

        <label for="edit-departmentEventTitle">Department Event Title:</label>
        <input type="text" name="edit-departmentEventTitle" id="edit-departmentEventTitle" required><br><br>

        <label for="edit-departmentEventSubtitle">Department Event Subtitle:</label>
        <input type="text" name="edit-departmentEventSubtitle" id="edit-departmentEventSubtitle" required><br><br>

        <label for="edit-departmentEventDescription">Department Event Description:</label><br>
        <textarea name="edit-departmentEventDescription" id="edit-departmentEventDescription" cols="30" rows="5" required></textarea><br><br>

        <input type="submit" name="edit-submit" value="Save Changes">
        <button type="button" class="cancel-btn">Cancel</button>
    </form>
</div>
</body>



<script>// Sa script block, idagdag ang function para sa delete button functionality
const deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const deleteId = this.getAttribute('data-id');
        
        // I-send ang AJAX request para sa pag-delete ng row
        deleteData(deleteId);
    });
});

// Function para sa AJAX request ng pag-delete
function deleteData(id) {
    fetch('DASHBOARDUPLOAD.php?delete_feedback1_id=' + id)
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload(); // Reload the page after deletion
    })
    .catch(error => console.error('Error:', error));
}
   </script> 
<script>
    function submitForm() {
        document.querySelector('form[action="DASHBOARDUPLOAD.php"]').submit();
    }
</script>

</html>
