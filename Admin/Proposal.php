<?php
// Include the connection file
    include("../Login/connectionPropose.php");
    include("Adminhome.php");

    $fileDirectory = "../Admin/Docs/";
    // Check if delete button is pressed
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM `propose1` WHERE `proid` = $delete_id";
        mysqli_query($conn, $delete_query);
    }

    // Check if form is submitted for updating status
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
        $proid = $_POST['proid'];
        $newStatus = $_POST['new_status'];
        
        $update_query = "UPDATE `propose1` SET `prostatus` = '$newStatus' WHERE `proid` = $proid";
        mysqli_query($conn, $update_query);
    }

    // Query to retrieve data from the database
    $query = "SELECT `proid`, `File1`, `File2`, `proimg`, `orgdept`, `protitle`, `Datee`, `prodescription`, `prostatus` FROM `propose1`";

    // Perform the query
    $result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <style>
        /* Add your CSS styles here */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #FCCB0A;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: maroon;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #FCCB0A;
        }
        tr:hover {
            background-color: #DAA520;
        }
        td {
            color: maroon;
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
        <p class="ContactHEAD">PROPOSAL INBOX</p>
        <P class="Lines"></P>
        
</div>
<form method="post" action="DASHBOARDUPLOAD.php">
    <label for="searchDepartment">Search by Department:</label>
    <input type="text" name="searchDepartment" id="searchDepartment">
    <input type="button" name="search" value="Search" onclick="submitForm()">
</form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>File 1</th>
                <th>File 2</th>
                <th>Organization Department</th>
                <th>Proposal Title</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
           // Query to retrieve data from the database
$query = "SELECT `proid`, `File1`, `File2`, `proimg`, `orgdept`, `protitle`, `Datee`, `prodescription`, `prostatus` FROM `propose1`";

// Perform the query
$result = mysqli_query($conn, $query);

// Initialize a variable for tracking the displayed ID
$displayedID = 1;

// Output data of each row

while ($row = mysqli_fetch_assoc($result)) {
    // Define colors based on status
    $statusColor = '';
    switch ($row["prostatus"]) {
        case 'Approve':
            $statusColor = 'green'; // Green color for 'approve'
            $statusFontSize = '25px'; // Larger font size for 'approve'
            break;
        case 'On hold':
            $statusColor = 'red'; // Red color for 'on hold'
            $statusFontSize = '20px'; // Font size for 'on hold'
            break;
        case 'Pending':
        default:
            $statusColor = 'gray'; // Gray color for 'pending' or default
            $statusFontSize = '20px'; // Font size for 'pending' or default
            break;
    }

    echo "<tr>
    <td>".$displayedID."</td>
    <td><a href='".$fileDirectory.$row["File1"]."' download>".$row["File1"]."</a></td>
    <td><a href='".$fileDirectory.$row["File2"]."' download>".$row["File2"]."</a></td>
    <td>".$row["orgdept"]."</td>
    <td>".$row["protitle"]."</td>
    <td>".$row["Datee"]."</td>
    <td>".$row["prodescription"]."</td>
    <td style='color: $statusColor; font-size: $statusFontSize;'>".$row["prostatus"]."</td>
    <td>
        <form onsubmit='return confirm(\"Are you sure you want to update?\")' method='POST' action=''>
            <input type='hidden' name='proid' value='".$row["proid"]."'>
            <select name='new_status'>
                <option value='Approve' ".($row['prostatus'] == 'Approve' ? 'selected' : '').">Approve</option>
                <option value='On hold' ".($row['prostatus'] == 'On hold' ? 'selected' : '').">On hold</option>
                <option value='Pending' ".($row['prostatus'] == 'Pending' ? 'selected' : '').">Pending</option>
            </select>
            <input type='submit' name='update_status' value='Update'>
        </form>
        <a style=' background-color: white; border: solid black 1px; text-decoration:none; color: black; border-radius:2px; padding-left: 2px; padding-right: 2px;' href='?delete_id=".$row["proid"]."' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
    </td>
</tr>";
// Increment the displayed ID
$displayedID++;
}
            
            ?>
        </tbody>
    </table>
</body>
</html>
