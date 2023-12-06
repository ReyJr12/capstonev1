<?php
    include("../Login/connection.php");
    include("../Admin/Adminhome.php");
    $notif = "";
    $tableName = "events1"; // Replace with your table name
    $desiredAutoIncrementValue = 1; // Replace with the desired auto-increment value

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get other user inputs from the form
        $title = $_POST["title"];
        $subtitle = $_POST["subtitle"]; // New field added
        $description = $_POST["description"];
        $status = $_POST["status"];

        // File handling for image upload
        $targetDirectory = "uploads/"; // Change this to your desired directory
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $notif =  "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $notif =  "File is not an image.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        $allowedExtensions = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            $notif =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $notif =  "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Prepare the SQL statement to insert data
                $sql = "INSERT INTO events1 (Image, Title, Subtitle, Description, Status) VALUES (?, ?, ?, ?, ?)";
                
                // Prepare and bind parameters to prevent SQL injection
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $targetFile, $title, $subtitle, $description, $status);
            
                // Execute the prepared statement
                if ($stmt->execute()) {
                    $notif = "New record inserted successfully!";
                } else {
                    $notif = "Error: " . $sql . "<br>" . $conn->error;
                }
            
                // Close statement and connection
                $stmt->close();
                $conn->close();
            } else {
                $notif = "Sorry, there was an error uploading your file.";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Event Details and Images</title>
    <link rel="stylesheet" href="UPLOAD.css">
</head>
<body>
<div class="containter1">
        <!-- Your existing HTML form -->
        <div class="main">
            <h2>Upload Event Details and Images</h2>
            <div class="form-container">
                <form method="post" action="UploadImages.php" enctype="multipart/form-data">
                    <p style="font-family:impact; font-size: 20px;">Image: <input style=" width: 100%;" type="file" name="image" id="uploadImage">
                    Title: <input type="text" name="title"><br>
                    Subtitle: <input type="text" name="subtitle"><br> <!-- New input field -->
                    Description:<textarea  class="des1" type="text" name="description"></textarea><br>
                    Status: <input  type="text" name="status"><br>
                    <div style="color: green;"><?php echo $notif; ?></div>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
        
        <!-- Preview for the uploaded image -->
        <div class="fisrtbox">
            <div class="imagePreview" id="imagePreview"></div>
        </div>
    </div>

    <!-- JavaScript for image preview -->
    <script>
        document.getElementById("uploadImage").addEventListener("change", function (event) {
            var reader = new FileReader();
            reader.onload = function () {
                var img = document.createElement("img");
                img.src = reader.result;
                img.width = 400; // Adjust the width as needed
                document.getElementById("imagePreview").innerHTML = "";
                document.getElementById("imagePreview").appendChild(img);
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>
</html>

