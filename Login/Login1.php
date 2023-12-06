<?php
    include("connection.php");

    $error = ""; // Initialize the error message variable

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['user']); // Sanitize the input
        $password = mysqli_real_escape_string($conn, $_POST['pass']); // Sanitize the input

        $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);    
        $count = mysqli_num_rows($result);

        if($count == 1){
            header("location: ../Admin/HomeAdmin.php");
            exit();
        } else {
            $error = "Incorrect username or password"; // Set error message for invalid credentials
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="Login.css">
 >

</head>
<body class="bgimg">
    <div class="Main-container">
        <div class="first-container">
            <form class="formlogin" action="Login1.php" method="POST">
                <a href="../HOMEPAGE/HOME-PAGE.php"  class="BackButton1" ><p class="BackButton">Back</p></a>
                <img src="../PICS/LOGIN/WebsiteLogo.png" class="WebsiteLogo">
                <h1 class="Logintocores">Log in to CORES</h1>
                <hr class="hr1">
                <label for="username"> Username </label><br>
                <input class="usernamepadding" type="text" id="user" name="user" required><br>
                <label for="password"> Password </label> <br>
                <input class="passwordapadding" type="password" id="pass" name="pass" required>
                <!-- Display error message if login fails -->
                <p style="color: red;"><?php echo $error; ?></p><br>
                <input class="Loginbutton" id="btn" type="submit" value="Login" name="submit">
            </form>
            <p class="details">
                <b>Forgotten Account?</b> <br>
                Contact the ITS Admin to retrieve: <br>
                Dial: <a class="No">+639950430241 </a><br>
                Email: <a class="No1">coresitsadmin@perpetual.edu.ph</a>
            </p>
        </div>
        <div class="second-container">
            <img class="loginright" src="../PICS/LOGIN/loginRightdesign.png">
        </div>
    </div>
</body>
</html>
