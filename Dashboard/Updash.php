<?php
include("../Login/connectiondepartment.php");

$result = null; // Initialize $result variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campusValue = $_POST['campus']; // Get the selected campus from the form
    $departmentValue = $_POST['department']; // Get the selected department from the form

    if ($campusValue === 'Las Piñas') {
        // Execute SQL query specific to Las Piñas and the selected department
        $sql = "SELECT `depid`, `Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription` 
                FROM `dept`  
                WHERE `Selectcampus` = 'Las Piñas' AND `SelectDepartment` = ?";

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
    <link rel="stylesheet" href="Updash1.css">
    <style>
        .divbody {
            display: <?php echo isset($result) && $result->num_rows > 0 ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body >
        <div class="maindiv">
            <div class="leftdiv">
                <div class="nav-margin">
                    <a class="Adash" href="Updash.php">
                     <img class="Dashimg" src="../PICS/DASHBOARD/ARROW RIGHT.png">
                    <p class="Dashhead">Dashboard</p></a>
                
                <br> 
            <div class="campusdiv">
            <form method="post" action="">
              <select name="campus" id="campus" required>
                <option class="options" value="Las Piñas">Las Piñas Campus</option>
                <option class="options" value="Molino">Molino Campus</option>
                <option class="options" value="Calamba">Calamba Campus</option>
              </select>
              </div>
              <br>
              <div class="deptdiv">
               <select  name="department" id="department">
                <option value="" disabled selected>Select Department</option>
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
                </select>
                </div>

                <div class="Otherbtndiv">
                    <a href="#" class="aa propose-link" onclick="loadContent()" class="sub-item"><p class="navhead">Propose</p></a>
                    <p class="Linenav"></p>
                    <a href="../Contactus/Contact.php" class="aa" onclick="loadContent()" class="sub-item"><p class="navhead">Feedback</p></a>
                    <p class="Linenav"></p>
                    <a href="../Contactus/Contact.php" class="aa" onclick="loadContent()" class="sub-item"><p class="navhead">Donate</p></a>
                    <p class="Linenav"></p>
                </div>
                <br>
                </form>
                <a class="Adash" href="../HomePage/HOME-PAGE.php">
                     <img class="Dashimg2" src="../PICS/DASHBOARD/ARROW RIGHT.png">
                    <p class="Dashhead">Home Page</p></a>
            </div>
    
            </div>
            <div class="rightdiv">
                
                <div class="display-side">
                <div id="proposedContent" class="proposed-content">
            <!-- Content from Proposal.php will load here -->
        </div>
          
                <?php 
        if ($result && $row = $result->fetch_assoc()) {
            // Display the department title and campus name for the first department
            
            echo '<p class="line"></p><p class="departmentheader">' . $row['SelectDepartment'] . '</p>';
            echo '<p class="departmentcampus">' . $row['Selectcampus'] . '</p>';  

            // Display the first department details
            ?>
            
                <div class="firstbox">
                    <?php 
                        // Output the image with the correct path
                        echo '<img class="newsimg1" src="../Admin/departmentupload/' . $row['depimg'] . '" alt="Image">';
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
            <?php 

            // Loop through the rest of the departments
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="newsItem">
                    <div class="firstbox">
                        <?php 
                            // Output the image with the correct path
                            echo '<img class="newsimg1" src="../Admin/departmentupload/' . $row['depimg'] . '" alt="Image">';
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
        } 
          
            else {
            echo "
            <img class='PerpetualIMG' src='../PICS/DASHBOARD/DASHBOARDHEADER.png'>
            <img class='PERPSIMG' src='../PICS/DASHBOARD/Perpetualhome.png'>
        </div>"; // Display a message if no departments are found
        }
    ?>
                     
                  
                </div>
            </div>
        </div>


    

</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.propose-link').click(function (e) {
            e.preventDefault();
            var filePath = "Proposal.php";
            loadContent(filePath);
        });

        function loadContent(filePath) {
            $('#proposedContent').load(filePath);
        }
    });


</script>
<script type="text/javascript">
    // When a department is selected, submit the form
    document.getElementById('department').addEventListener('change', function() {
        this.form.submit();
    });
</script>
</html>
