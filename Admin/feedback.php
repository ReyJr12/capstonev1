<?php
include("../Login/connection.php");
include("Adminhome.php");
// Redirect to the current page after deletion
function redirectToCurrentPage() {
    header("Location: feedback.php");
    exit(); // Ensure no further code execution after redirection
}

// Process deletion for feedback table
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM feedback WHERE ID = $delete_id";
    mysqli_query($conn, $delete_query);

    // Reassigning IDs
    $update_query = "SET @num := 0; UPDATE feedback SET ID = @num := @num + 1; ALTER TABLE feedback AUTO_INCREMENT = 1;";
    mysqli_multi_query($conn, $update_query);

    redirectToCurrentPage();
}

// Process deletion for feedback1 table
if (isset($_GET['delete_feedback1_id'])) {
    $delete_id = $_GET['delete_feedback1_id'];
    $delete_query = "DELETE FROM feedback1 WHERE IDs = $delete_id";
    mysqli_query($conn, $delete_query);

    // Reassign IDs
    $update_query = "SET @num := 0; UPDATE feedback1 SET IDs = @num := @num + 1; ALTER TABLE feedback1 AUTO_INCREMENT = 1;";
    mysqli_multi_query($conn, $update_query);

    redirectToCurrentPage();
}

$itemsPerPage = 10; // Set the number of items per page
$totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM feedback1"));
$totalPages = ceil($totalRows / $itemsPerPage);

if (!isset($_GET['page'])) {
    $page = 1; // Default to page 1
} else {
    $page = $_GET['page'];
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $totalPages) {
        $page = $totalPages;
    }
}

$offset = ($page - 1) * $itemsPerPage;

// Fetch records based on pagination
$feedback1_query = "SELECT * FROM feedback1 LIMIT $offset, $itemsPerPage";
$feedback1_result = mysqli_query($conn, $feedback1_query);

?>
<!-- Rest of your HTML code -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Example</title>
    <style>
        /* Add your CSS styles here */
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%; /* Adjust the maximum width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            word-wrap: break-word; /* Wraps text after a certain number of characters */
            max-width: 1370px; /* Set maximum width for each cell */
        }
        th {
            background-color: maroon;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #FCCB0A;
        }
        tr:hover {
            background-color: white;
            color: black;
            font-size: 25px;
        }
        .delete-button {
            display: block;
            width: 100%; /* Set button width to fill the column */
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            border: 1px solid #ccc;
            background-color: #f44336; /* Red color for delete button */
            color: white;
            border-radius: 3px;
        }
        .delete-button:hover {
            background-color: #d32f2f; /* Darker red color on hover */
        }
        .container12{
    display: flex;
    margin-top: 40px;
    margin-left: 25%;
    margin-right: auto;
  }
  
  .Lines{
   margin-top: 30px;
    height: 5px;
    width: 200px;
    background-color: #FCCB0A;
  
  }
  .ContactHEAD{
    margin-left: 10px;
    margin-Right: 10px;
    font-size: 50px;
    color: maroon;
    font-weight: bold;
    font-family: impact;
  
  }
        </style>
</head>
<body>
<div class="container12">  
        <p class="Lines"></p>
        <p class="ContactHEAD">CONTACT US INBOX</p>
        <P class="Lines"></P>
</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $feedback_query = "SELECT * FROM feedback";
                $feedback_result = mysqli_query($conn, $feedback_query);

                while ($feedback_row = mysqli_fetch_assoc($feedback_result)) {
                    echo "<tr>";
                    echo "<td>".$feedback_row['ID']."</td>";
                    echo "<td>".$feedback_row['Firstname']."</td>";
                    echo "<td>".$feedback_row['Lastname']."</td>";
                    echo "<td>".$feedback_row['Email']."</td>";
                    echo "<td>".$feedback_row['Message']."</td>";
                    echo "<td><a href='?delete_id=".$feedback_row['ID']."' onclick='return confirm(\"Would you like to delete?\")'>Delete</a></td>";
                    echo "</tr>";
                }

              
            ?>
        </tbody>
    </table>

    <div class="container12">  
        <p class="Lines"></p>
        <p class="ContactHEAD">FEEDBACK INBOX</p>
        <P class="Lines"></P>
</div>
    <table>
    <thead>
        <tr>
            <th>IDs</th>
            <th>Feedback</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $feedback1_query = "SELECT * FROM feedback1";
        $feedback1_result = mysqli_query($conn, $feedback1_query);

        while ($feedback1_row = mysqli_fetch_assoc($feedback1_result)) {
            echo "<tr>";
            echo "<td>".$feedback1_row['IDs']."</td>";
            echo "<td>".$feedback1_row['FEEDBACK']."</td>";
            echo "<td><a href='?delete_feedback1_id=".$feedback1_row['IDs']."' onclick='return confirm(\"Would you like to delete?\")'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
 
</body>
</html>