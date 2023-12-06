<?php
    include("../Login/connection.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id'], $_POST['title'], $_POST['subtitle'], $_POST['description'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $description = $_POST['description'];

            // Update the event details
            $sql = "UPDATE events1 SET Title=?, Subtitle=?, Description=? WHERE ID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $title, $subtitle, $description, $id);
            $stmt->execute();

            // Redirect back to Modify.php after the update
            header("Location: Modify.php");
            exit();
        } else {
            echo "Event not found or incomplete data.";
        }
    } else {
        // If it's not a POST request, display the edit form
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Retrieve the event based on the ID
            $sql = "SELECT * FROM events1 WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Use the retrieved data to populate an edit form
?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Edit Event</title>
                    <link rel="stylesheet" href="Modify.css">
                </head>
                <body>
                    <h1>Edit Event</h1>
                    <!-- Create a form to edit the event -->
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo $row['Title']; ?>"><br><br>
                        <label for="subtitle">Subtitle:</label>
                        <input type="text" id="subtitle" name="subtitle" value="<?php echo $row['Subtitle']; ?>"><br><br>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description"><?php echo $row['Description']; ?></textarea><br><br>
                        <input type="submit" value="Update">
                    </form>
                </body>
                </html>
<?php
            } else {
                echo "Event not found.";
            }
        }
    }
?>
