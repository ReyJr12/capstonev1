<?php 
include("../Login/connectionPropose.php");
// Path to the directory where files will be stored
$targetDirectory = "../Admin/Docs/";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload handling
    $file1_names = $_FILES['file1']['name'];
    $file2_names = $_FILES['file2']['name'];
    
    // Check if an image file is uploaded
    if (!empty($_FILES['proimg']['name'])) {
        $proimage_name = $_FILES['proimg']['name'];
        $proimage_tmp = $_FILES['proimg']['tmp_name'];
        $target_proimage = "Proposal/" . basename($proimage_name);
    } else {
        $proimage_name = '';
        $proimage_tmp = '';
        $target_proimage = '';
    }

    $organization = $_POST['organization'];
$proposalTitle = $_POST['proposalTitle'];
$proposalDate = $_POST['proposalDate'];
$description = $_POST['comment'];
$campus = $_POST['campus']; // Retrieve the selected campus from the form


    // Arrays to store uploaded file names after upload
    $uploaded_file1 = [];
    $uploaded_file2 = [];

    // Check if the variables are arrays before processing them
    if (is_array($file1_names)) {
        foreach ($file1_names as $key => $file1_name) {
            $target_file1 = $targetDirectory . basename($file1_name);
            move_uploaded_file($_FILES["file1"]["tmp_name"][$key], $target_file1);
            $uploaded_file1[] = basename($file1_name); // Store 
        }
    }
    
    if (is_array($file2_names)) {
        foreach ($file2_names as $key => $file2_name) {
            $target_file2 = $targetDirectory . basename($file2_name);
            move_uploaded_file($_FILES["file2"]["tmp_name"][$key], $target_file2);
            $uploaded_file2[] = basename($file2_name); // Store 
        }
    }
    
    // Move uploaded image 
    if (!empty($proimage_tmp) && !empty($target_proimage) && move_uploaded_file($proimage_tmp, $target_proimage)) {
        // uploaded file details 
        $sql = "INSERT INTO propose1 (File1, File2, proimg, orgdept, protitle, Datee, prodescription, prostatus, procampus) 
                VALUES ('" . implode(',', $uploaded_file1) . "', '" . implode(',', $uploaded_file2) . "', '$proimage_name', '$organization', '$proposalTitle', '$proposalDate', '$description', 'Pending', '$campus')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Files uploaded and data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (empty($proimage_tmp) && empty($target_proimage)) {
        // more uploaded file 
        $sql = "INSERT INTO propose1 (File1, File2, orgdept, protitle, Datee, prodescription, prostatus, procampus) 
                VALUES ('" . implode(',', $uploaded_file1) . "', '" . implode(',', $uploaded_file2) . "', '$organization', '$proposalTitle', '$proposalDate', '$description', 'Pending', '$campus')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Files uploaded and data inserted successfully without an image.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
    <link rel="stylesheet" href="../Dashboard/Proposal.css">
   
</head>
<body>
    <div class="marginbody">
        <div class="divflex">
            <p class="line"></p>
            <p class="headers">DO YOU WANT TO CONDUCT A COMMUNITY EXTENSION SERVICE?</p>
        </div>
    
            <p class="instruction">Instruction for Proposing a Concept Paper for Conducting a Community Extention Services:</p>
        <div class="divspacer">
            <p> 1. ----------------------------
            <br>2. ----------------------------
            <br>3. ----------------------------
            <br>4. ----------------------------
            <br>5. ----------------------------
            <br>
        
            </p>
        </div>
            <p class="instruction">Download the link below to get the file:</p>
        <div class="divflex">
                <img  class="docpic" src="../PICS/Dashboard/Docimg.png">
                 <a class="instructiondoc" href="path/to/your/file.pdf" download="filename"><p>CES_ConceptPaper_Template.docx</p></a>
        </div>
            <br><br>
        <div class="divflex">
            <p class="line"></p>
            <p class="headers">Submit your Concept Paper Proposal</p>
        </div>
        <div class="Boxupload">
         <p class="uploadTitle">File Upload</p>
    <p class="infoinput">Upload a file </p>
    <form action="" method="post" enctype="multipart/form-data">
    <!-- File Upload Section -->
    <p id="addFileLink1" style="cursor: pointer;" class="uplod">Upload File</p>
    <div class="fileInputs" id="file1Container" style="display: none;">
        <input type="file" name="file1[]" id="file1" multiple required />
    </div>

    <div class="fileInputs" id="file2Container" style="display: none;">
        <label for="file2" class="fileLabel">Upload File 2:</label>
        <input type="file" name="file2[]" id="file2" multiple />
    </div>

    <p id="addFileLink" style="cursor: pointer;">+ Add Another File</p>
    <br>
    
    <label for="campus">Select Campus:</label>
    <select id="campus" name="campus">
    <option value="laspinas" selected>Las Piñas</option>
    <option value="molino">Molino</option>
    <option value="calamba">Calamba</option>
    <!-- Add more options as needed -->
</select>
    <!-- Add more options as needed -->
    </select>
    <label for="organization">Select Organization/Department:</label>
    <select id="organization" name="organization">
        <option value="department_1">Department 1</option>
        <option value="department_2">Department 2</option>
        
        <!-- Add more options as needed -->
    </select>
    <br>
    <!-- Proposal Title and Date -->
    <label for="proposalTitle">Proposal Title:</label>  
    <input type="text" id="proposalTitle" name="proposalTitle" required />
    <br>
    <label for="proposalDate">Choose Date:</label>
    <input type="date" id="proposalDate" name="proposalDate" required/>

    <!-- Image Upload -->
    <br> <br>
    <label for="imageUpload">Upload Image:</label>
    <input type="file" id="imageUpload" name="proimg" accept="image/*" />

    <!-- Description Textarea -->
    <textarea name="comment" class="commentBox" placeholder="Enter your Description"></textarea>

    <!-- Button Group -->
    <div class="buttonGroup">
        <button type="button" onclick="window.history.back();" class="cancelButton">Cancel</button>
        <button type="submit" name="submit" class="submitButton">Submit Proposal</button>
    </div>
</form>


</div>
   
    </div>
    
</body>
<script>
     document.getElementById("addFileLink").addEventListener("click", function() {
        var file2Container = document.getElementById("file2Container");
        var addFileLink = document.getElementById("addFileLink");
        
        if (file2Container.style.display === "none") {
            file2Container.style.display = "block";
            addFileLink.textContent = "-Show Less";
        } else {
            file2Container.style.display = "none";
            addFileLink.textContent = "+Add Another File";
        }
    });
    document.getElementById("addFileLink1").addEventListener("click", function() {
    var file1Container = document.getElementById("file1Container");
    var addFileLink1 = document.getElementById("addFileLink1");

    if (file1Container.style.display === "none") {
        file1Container.style.display = "block";
        addFileLink1.style.display = "none"; // Change the text accordingly
    } else {
        file1Container.style.display = "none";
        addFileLink1.textContent = "+ Show File 1"; // Change the text accordingly
    }
});
    
</script>
</html>