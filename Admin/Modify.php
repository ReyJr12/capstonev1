<?php
    include("../Login/connection.php");
    include("Adminhome.php");
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
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
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
                    // Redirect to refresh the page after successful insertion
                    header("Refresh:0");
                    exit(); // Ensure no further code executiona after redirection
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Events</title>
    <link rel="stylesheet" href="Modify.css"> <!-- Adjust CSS file path as needed -->
</head>
<body>
<div class="container122">  
        <p class="Lines1"></p>
        <p class="ContactHEAD1">ADD EVENTS</p>
        <P class="Lines1"></P>
    </div>
    <div class="containter1">
        <!-- Your existing HTML form -->
        <div class="fisrtbox">
            <div class="imagePreview" id="imagePreview"></div>
        </div>
        <div class="main">
       
            <p class="upheader">Upload Event Details and Images</p>
            <div class="form-container">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <p style="font-family:impact; font-size: 20px;">
                    <div class="titlesub">
                    <p class="imgP">Image: </p>
                    <input style=" width: 100%; margin: 10px 9px 10px 12px; font-size:20px;" type="file" name="image" id="uploadImage">
                    </div>
                    <div class="titlesub">
                    <input class="titls"  placeholder=" Title:" type="text" name="title"><br>
                    <input class="titls" placeholder="  Date and Spearheaded by:"  type="text" name="subtitle"><br> <!-- New input field -->
                    </div>
                    <div class="titlesub">
                    <p class="desP">Description: </p>
                    </div>
                    <textarea  class="des1" type="text" name="description"></textarea><br>
                 
                    <label class="statp" for="status">Status:</label>
                        <select name="status" id="status">
                            <option value="NEW">NEW</option>
                            <option value="OLD">OLD</option>
                            <!-- Add other status options as needed -->
                        </select><br>
                    <div style="color: green;"><?php echo $notif; ?></div>
                    <input class="btnsub" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
        
        <!-- Preview for the uploaded image -->
       
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

    <!-- PHP code for displaying and editing events -->
    <?php
        // Fetch data from the 'events' table
        $sql = "SELECT * FROM events1";
        $result = $conn->query($sql);

        // Check if there are no events in the table
        if ($result->num_rows === 0) {
            // Set the ID to 0
            $resetID = "ALTER TABLE events1 AUTO_INCREMENT = 0";
            if ($conn->query($resetID) === TRUE) {
                echo "ID reset to 0.";
            } else {
                echo "Error resetting ID: " . $conn->error;
            }
        }

        // Delete event if requested
        if (isset($_GET['delete']) && isset($_GET['id'])) {
            $id = $_GET['id'];

            // Delete the event based on the ID
            $sql = "DELETE FROM events1 WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Event deleted successfully.";
                // Reload the page after deletion
                echo '<script>setTimeout(function(){location.reload();},1000);</script>';
            } else {
                echo "Error deleting event.";
            }
        }
    ?>

    <div class="container122">  
        <p class="Lines1"></p>
        <p class="ContactHEAD1">EVENTS</p>
        <P class="Lines1"></P>
    </div>
    <form method="post" action="DASHBOARDUPLOAD.php">
    <label for="searchDepartment">Search by title:</label>
    <input type="text" name="searchDepartment" id="searchDepartment">
    <input type="button" name="search" value="Search" onclick="submitForm()">
</form>
    <!-- Display Events in a Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($result as $row) { ?>
    <tr>
        <?php foreach ($row as $key => $value) { ?>
            <td class="<?php echo $key === 'Image' ? 'editable-img' : 'editable'; ?>" contenteditable="true" data-id="<?php echo $row['ID']; ?>" data-column="<?php echo $key; ?>">
                <?php 
                    if ($key === 'Image') {
                        echo '<img src="'.$value.'" width="100px" height="auto" alt="Event Image">';
                    } elseif ($key === 'Description') {
                        echo $value; // Display the full description without truncation
                    } else {
                        echo $value;
                    }
                ?>
            </td>
        <?php } ?>
        <td>
            <!-- Update button -->
            <button class="update-btn" data-id="<?php echo $row['ID']; ?>">Update</button>
            <!-- Delete form -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                <button class="dltebtn" type="submit" name="delete">Delete</button>
            </form>
        </td>
    </tr>
<?php } ?>
</table>
<script>
    document.querySelectorAll('.update-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.parentNode.parentNode;
            const cells = row.querySelectorAll('.editable');

            cells.forEach(cell => {
                cell.contentEditable = false;
                cell.classList.remove('editing');
                
                // Hide full description and show truncated description after editing
                if (cell.classList.contains('editable') && cell.dataset.column === 'Description') {
                    cell.querySelector('.truncated-description').style.display = 'block';
                    cell.querySelector('.full-description').style.display = 'none';
                }
            });

            // Get the updated values from the cells
            const id = this.dataset.id;
            const updatedValues = {};
            cells.forEach(cell => {
                const column = cell.dataset.column;
                const value = cell.innerText;
                updatedValues[column] = value;
            });

            // Send an AJAX request to update the data
            updateData(id, updatedValues);
        });
    });

    // Function to send AJAX request for updating data
    function updateData(id, updatedValues) {
        // Send the updated values to your backend for updating the record in the database
        // Use fetch or XMLHttpRequest to send the data to your PHP backend for processing
        // Example using fetch:
        fetch('update_event.php', {
            method: 'POST',
            body: JSON.stringify({ id: id, updatedValues: updatedValues }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response or perform actions after updating
            console.log(data);
            // Reload the page or update the table as needed
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
