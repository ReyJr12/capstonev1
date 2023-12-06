<?php
include("../Login/connectiondepartment.php");

$result = null; // Initialize $result variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campusValue = 'Molino'; // Set campus value to 'Molino'
    $departmentValue = $_POST['department']; // Get the selected department from the form

    if ($campusValue === 'Molino') {
        // Execute SQL query specific to Molino and the selected department
        $sql = "SELECT `depid`, `Selectcampus`, `SelectDepartment`, `depimg`, `deptitle`, `depsubtitle`, `depdescription` 
                FROM `dept`  
                WHERE  `Selectcampus` = 'Molino' AND`SelectDepartment` = ?";

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
    <link rel="stylesheet" href="CCSPAGE1121.css">
    <style>
        .divbody {
            display: <?php echo isset($result) && $result->num_rows > 0 ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body style="display:flex;">
<div class="selection side-nav  over-flow: hidden;">
    <form method="post" action="">
        <div class="selection">
            <div class="item1"><a class="ADASH" href="Dashboard.php" style="display: flex;"><img class="DASHIMG" src="../PICS/DASHBOARD/ARROW RIGHT.png"><p class="dashboardhead">Dashboard</p></a></div>
               
            <!--<label class="Selectheader" for="campus"><p class="Selectheader1">Select Campus:</p></label>-->
        
         <!--<label class="Selectheader" for="department"><p class="Selectheader1">Select Department:</p></label>-->
          <br>
         <select placeholder="Select" name="department" id="department">
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
            </select><br>   <br>


         

            <input class="subbtn" type="submit" value="Submit">
            <div class="marginboxnav">
                <a href="#" class="aa propose-link" onclick="loadContent()" class="sub-item"><p class="navhead">Propose</p></a>
                <p class="linnav"></p>
                <a href="../Contactus/Contact.php" class="aa" onclick="loadContent()" class="sub-item"><p class="navhead">Feedback</p></a>
                <p class="linnav"></p>
                <a href="../Contactus/Contact.php" class="aa" onclick="loadContent()" class="sub-item"><p class="navhead">Donate</p></a>
            </div>
        <div class="item1"><a class="ADASH" href="../Homepage/HOME-PAGE.php" style="display: flex;"><img class="DASHIMG1" src="../PICS/DASHBOARD/ARROW RIGHT.png"><p class="dashboardhead">Home Page</p></a></div>
        </div>
     </form>
     </div>

     <div class="marginleftt">
       <div class="divbody">
        
     <p class="Boxdesign1"></p>
     <div class="newsItem">
     <div id="contentContainer" class="content-container"></div>

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
        } else {
            echo "No departments found."; // Display a message if no departments are found
        }
    ?>
</div>
    </div>
        </body>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script type="text/javascript">
$(document).ready(function () {
    $('.propose-link').click(function (e) {
        e.preventDefault();
        var filePath = "Proposal.php "; // Ensure the path is correct to Proposal.php
        loadContent(filePath);
        hideResultContainer(); // Call function to hide divbody
    });

    $('.item a').click(function (e) {
        e.preventDefault();
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
    });

    $('.menu-btn').click(function () {
        $('.side-bar').addClass('active');
    });

    function hideResultContainer() {
        $('#resultContainer').css('display', 'none');
    }
});

function loadContent(filePath) {
    $('#contentContainer').load(filePath);
}


</script>
</html>
