<?php
include("../Login/connection.php");
include("Adminhome.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitAdd'])) {
        // Assuming you have retrieved other form inputs as well
        $name = $_POST['name'];
        $position = $_POST['position'];

        $imageName = $_FILES['imageC']['name'];
        $imageTmpName = $_FILES['imageC']['tmp_name'];
        $imageSize = $_FILES['imageC']['size'];
        $imageType = $_FILES['imageC']['type'];

        // File handling for image upload
        $targetDirectory = "uploads/"; // Change this to your desired directory
        $targetFile = $targetDirectory . basename($imageName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($imageTmpName);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        $allowedExtensions = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                // Prepare the SQL statement to insert data
                $sql = "INSERT INTO council (ImageC, Name, Position) VALUES (?, ?, ?)";
                
                // Prepare and bind parameters to prevent SQL injection
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $targetFile, $name, $position);
            
                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "New member added successfully!";
                    // Additional code if needed after successful insertion
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            
                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitEdit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $newImageName = $_FILES['newImageC']['name'];
    $newImageTmpName = $_FILES['newImageC']['tmp_name'];
    
    // Check if a new image has been uploaded
    if (!empty($newImageName)) {
        $targetDirectory = "uploads/"; // Change this to your desired directory
        $targetFile = $targetDirectory . basename($newImageName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image or fake image
        $check = getimagesize($newImageTmpName);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($newImageTmpName, $targetFile)) {
                // Update the record with the new image
                $sql = "UPDATE council SET ImageC=?, Name=?, Position=? WHERE Id=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssi", $targetFile, $name, $position, $id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Record updated successfully!";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update the record without changing the image
        $sql = "UPDATE council SET Name=?, Position=? WHERE Id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $position, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button is clicked
    if (isset($_POST['submitDelete'])) {
        $idToDelete = $_POST['id'];
        
        // Perform deletion query
        $sqlDelete = "DELETE FROM council WHERE Id = ?";
        $stmtDelete = mysqli_prepare($conn, $sqlDelete);
        mysqli_stmt_bind_param($stmtDelete, "i", $idToDelete);
        
        if (mysqli_stmt_execute($stmtDelete)) {
            echo "Record deleted successfully!";
            // Redirect or perform any other action after deletion
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmtDelete);
    }
}

// Fetch and display council members' information in a table
$sql = "SELECT Id, ImageC, Name, Position FROM council";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="Council1.css">
</head>
<body>
<div class="container122">  
        <p class="Lines1"></p>
        <p class="ContactHEAD1">ADD COUNCIL MEMBER</p>
        <P class="Lines1"></P>
    </div>
    <div class="container">
   
        <!-- Add new member form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label for="imageC">Upload Image:</label>
            <input type="file" id="imageC" name="imageC"><br><br>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br><br>
            
            <label for="position">Position:</label>
            <input type="text" id="position" name="position"><br><br>
            
            <input type="submit" name="submitAdd" value="Submit">
        </form>
        <div class="container1222">  
        <p class="Lines1"></p>
        <p class="ContactHEAD1">COUNCIL MEMBERS</p>
        <P class="Lines1"></P>
    </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['Id'] . "</td>";
                            echo "<td><img src='" . $row['ImageC'] . "' alt='" . $row['Name'] . "'></td>";
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "<td>" . $row['Position'] . "</td>";
                            echo "<td>
                                <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>
                                    <input type='hidden' name='id' value='" . $row['Id'] . "'>
                                    <input type='text' placeholder='Name:' name='name' value='" . $row['Name'] . "'>
                                    <input type='text' placeholder='Position:' name='position' value='" . $row['Position'] . "'>
                                    <input type='file' name='newImageC'>
                                    <input type='submit' name='submitEdit' value='Update'>
                                    </form>
                                    <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                                    <input type='hidden' name='id' value='" . $row['Id'] . "'>
                                    <input type='submit' name='submitDelete' value='Delete'>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "<tr><td colspan='5'>No records found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>