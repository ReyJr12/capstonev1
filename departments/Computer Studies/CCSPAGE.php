<?php
include("../../Login/connectiondepartment.php");

$result = null; // Initialize $result variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campusValue = $_POST['campus']; // Get the selected campus from the form
    $departmentValue = $_POST['department']; // Get the selected department from the form

    if ($campusValue === 'Las Piñas') {
        // Execute SQL query specific to Las Piñas and the selected department
        $sql = "SELECT `depid`, `Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription` 
                FROM `dept`  
                WHERE `Selectcampus` = 'Laspinas' AND `SelectDepartment` = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $departmentValue);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    } else if ($campusValue === 'Molino') {
        // Execute SQL query specific to Molino to retrieve all departments
        $sql = "SELECT `depid`, `Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription` 
                FROM `dept` 
                WHERE `Selectcampus` = 'Molino' AND `SelectDepartment` = ?";
        
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $departmentValue);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    } else if ($campusValue === 'Calamba') {
        // Execute SQL query specific to Calamba to retrieve all departments
        $sql = "SELECT `depid`, `Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription` 
                FROM `dept` 
                WHERE `Selectcampus` = 'Calamba' AND `SelectDepartment` = ?";
        
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $departmentValue);
            $stmt->execute();
            $result = $stmt->get_result();
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" href="CCSPAGE1.css">
    <style>
        .divbody {
            display: <?php echo isset($result) && $result->num_rows > 0 ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <div class="selection">
        <label class="Selectheader" for="campus">Select Campus:</label>
        <select name="campus" id="campus">
            <option value="Las Piñas">Las Piñas</option>
            <option value="Molino">Molino</option>
            <option value="Calamba">Calamba</option>
        </select>
    
        <label class="Selectheader" for="department">Select Department:</label>
        <select name="department" id="department">
        <option value="College of Accountancy">College of Accountancy</option>
            <option value="College of Arts and Sciences">College of Arts and Sciences</option>
            <option value="College of Aviation">College of Aviation</option>
            <option value="College of Business Administration">College of Business Administration</option>
            <option value="College of Computer Studies">College of Computer Studies</option>
            <option value="College of Criminology">College of Criminology</option>
            <option value="College of Dentistry">College of Dentistry</option>
            <option value="College of Education">College of Education</option>
            <option value="College of International Tourism and Hospitality Management">College of International Tourism and Hospitality Management</option>
            <option value="College of Maritime Education">College of Maritime Education</option>
            <option value="College of Medical Technology">College of Medical Technology</option>
            <option value="College of Nursing">College of Nursing</option>
            <option value="College of Pharmacy">College of Pharmacy</option>
            <option value="College of Physical Therapy and Occupational Therapy">College of Physical Therapy and Occupational Therapy</option>
            <option value="College of Radiologic Technology">College of Radiologic Technology</option>
            <option value="College of Respiratory Therapy">College of Respiratory Therapy</option>
            </select><br>   <br>

        <input class="subbtn" type="submit" value="Submit">
        </div>
    </form>
    <div class="divbody">
    <p class="Boxdesign1"></p>
    <div class="newsItem">
    <?php 
        if ($result && $row = $result->fetch_assoc()) {
            // Display the department title and campus name for the first department
            
            echo '<p class="line"></p><p class="departheader">' . $row['SelectDepartment'] . '</p>';
            echo '<p class="departcampuss">' . $row['Selectcampus'] . '</p>';  

            // Display the first department details
            ?>
            
                <div class="firstbox">
                    <?php 
                        // Output the image with the correct path
                        echo '<img class="newsimg1" src="../../Admin/departmentupload/' . $row['depimg'] . '" alt="Image">';
                    ?>
                    <div class="secondbox">
                        <?php 
                            // Output the department title
                            echo '<p class="departitle">' . $row['deptitle'] . '</p>'; 
                        ?>
                        <?php 
                            // Output the department subtitle
                            echo '<p class="departsubtitle">' . $row['depsubtitle'] . '</p>'; 
                        ?>
                        <?php 
                            // Output the department description
                            echo '<p class="DescriptionWrapper">' . $row['depdescription'] . '</p>';
                        ?>
                    </div>
                </div>
            </div>
            <?php 

            // Loop through the rest of the departments
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="newsItem">
                    <div class="firstbox">
                        <?php 
                            // Output the image with the correct path
                            echo '<img class="newsimg1" src="../../Admin/departmentupload/' . $row['depimg'] . '" alt="Image">';
                        ?>
                        <div class="secondbox">
                            <?php 
                                // Output the department title
                                echo '<p class="departitle">' . $row['deptitle'] . '</p>'; 
                            ?>
                            <?php 
                                // Output the department subtitle
                                echo '<p class="departsubtitle">' . $row['depsubtitle'] . '</p>'; 
                            ?>
                            <?php 
                                // Output the department description
                                echo '<p class="DescriptionWrapper">' . $row['depdescription'] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <?php 
            }
        } else {
            echo "No departments found."; // Display a message if no departments are found
        }
    ?>
</div>

</body>
</html>
