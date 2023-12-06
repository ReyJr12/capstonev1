<?php
      include("../Login/connection.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="Homepage1 copy.css">
</head>
<body>
    <div class="topheader">
        <div class="midtopheader">
            <div class="top-nav">
                <a href="https://perpetualdalta.edu.ph/"><img class="topPerplogo" src="../PICS/HOMEPAGE/PerpetualLogo.png" alt="perpetuallgo"></a>
                <ul class="top-navbuttons">
                    <li><a href="../HomePage/HOME-PAGE.php"><p>Home</p></a></li>
                    <li><a href="../About Us/Aboutus.php"><p>About Us</p></a></li>
                    <li><a href="../News/NEWS1.php"><p>News</p></a></li>
                    <li><a href="#"><p>Contact Us</p></a></li>
                    <li><a href="../Login/Login1.php"><p>Admin</p></a></li>
                    <div class="active"></div>
                </ul>          
            </div>
            <div class="coresdiv">
                <img src="../PICS/HOMEPAGE/WebsitelogoWithletters.png" class="Cores-img">
            </div>
            <div class="dropdown">
                <button id="myBtn" class="dashboardbutton"><b>Dashboard</b>
                    <img src="../PICS/DASHBOARD/drop-down-arrow-3.png" class="Dropdownarrow">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="../Dashboard/Dashboard copy.html"><b>Las-Piñas</b></a>
                    <a href="https://perpetualdalta.edu.ph/molino-2/">Molino</a>
                    <a href="https://perpetualdalta.edu.ph/calamba/"><b>Calamba</b></a>
                </div>
            </div>
        </div>
    </div>
</body>
</HTML>