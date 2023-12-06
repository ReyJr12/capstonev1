
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="Aboutus1.css">
</head>
<body>
<div class="topheader">
        <div class="midtopheader">
            <div class="top-nav">
                <a href="https://perpetualdalta.edu.ph/"><img class="topPerplogo" src="../PICS/HOMEPAGE/PerpetualLogo.png" alt="perpetuallgo"></a>
                <ul class="top-navbuttons">
                    <li><a href="../HomePage/HOME-PAGE.php"><p>Home</p></a></li>
                    <li><a href="../About Us/Aboutus.php"><p>About Us</p></a></li>
                    <li><a href="../News/News1.php"><p>News</p></a></li>
                    <li><a href="../Contactus/Contact.php"><p>Contact Us</p></a></li>
                    <li><a href="../Login/Login1.php"><p>Admin</p></a></li>
                    <div class="active"></div>
                </ul>          
            </div>
            <div class="coresdiv">
                <img src="../PICS/HOMEPAGE/WebsitelogoWithletters.png" class="Cores-img">
            </div>
            <a href="../Dashboard/Updash.php" class="dashboardbutton"><b>Dashboard</b></a>
        </div>
    </div>


    <div class="bodydiv">
        <div class="Aboutces">
            <P class="Boxdesign1"></P>
            <H1 class="ABCESHeader">ABOUT COMMUNITY EXTENSION SERVICES</H1>
        </div>

        <div class="content1">
            <div class="firstbox">
                <img class="CESIMG" src="../PICS/ABOUTUS/CES.png">
            </div>
            <div class="secondbox">
                <p class="CESP">The <b>Community Extension Services (CES)</b> believes in the dignity of man and the development of his potentials to the optimum. The program further believes that such development could be attained through the involvement of socially conscious students, faculty members, and non-teaching staff in community services.
                    <br><br>
                    Community extension services are multifaceted initiatives that play a vital role in fostering collaboration between institutions and communities. One key feature is knowledge transfer, where educational institutions share their expertise through workshops, training programs, and resource provision, enabling community members to acquire new skills and information. Capacity building is another crucial aspect, focusing on empowering individuals and communities by enhancing their skills, capabilities, and resources, spanning areas such as entrepreneurship, health, hygiene, and agriculture.
                    </p>
    </div>
            
        </div>
        <p class="CESP1">Social outreach programs within community extension services address specific social issues, encompassing campaigns on public health, environmental awareness, and initiatives promoting inclusivity and diversity. Moreover, these services often involve research and development through collaborative projects between institutions and local communities, addressing community challenges and contributing to innovative solutions.

Community development lies at the heart of CES, with efforts directed towards infrastructure projects, economic development initiatives, and programs aimed at improving overall quality of life. Environmental conservation is also a key focus, with organizations engaging in activities like tree planting campaigns and waste management programs to protect and preserve the environment.
</p>
         
        <br><br><br>
        <p class="linegray"></p>
        <div class="content">
        <P class="Boxdesign1"></P>
        <h1 class="adminheader"> ADMINISTRATION </h1>
        
        <div class="flex-container">

        <?php
        // Establish a connection to your database
        include("../Login/connection.php");
        
        // Assuming you have a database connection, perform a query to retrieve data
        $query = "SELECT ImageC, Name, Position FROM council";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch associative array from the query result
            while ($row = mysqli_fetch_assoc($result)) {
                // Use the retrieved data dynamically in your HTML structure
                echo '<div class="flex-item">';
              
                echo '<img class="image1" src="../Admin/' . $row['ImageC'] . '" alt="Image">';
                echo '<h2>' . $row['Name'] . '</h2>';
                echo '<p class="position">' . $row['Position'] . '</p>';
                echo '</div>';
            }
            // Free the result set
            mysqli_free_result($result);
        } else {
            // Display an error message if the query fails
            echo "Error retrieving data: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
          
        </div>
    </div>

        </div>
      </div>
    </div>
      </div>
      <div class="footerdown">
        <div class="divinsidefooterdown">
            <img class="IMGLOGOFOOTER" src="../PICS/HOMEPAGE/PerpetualLogo.png">
            <img class="yrs45" src="../PICS/HOMEPAGE/45yrs-e1594896154246.png">
            <p class="linefoot"></p>
            <img class="ISO" src="../PICS/HOMEPAGE/ISO_2023-449x200.png">
            <div class="Footpara">
                <h4 class="foot2">University of Perpetual Help System DALTA</h4>
                <p class="foot1">Alabang-Zapote Avenue, Pamplona 3,</p>
                <p class="foot1">Las Piñas City, 1740</p>
                <p class="foot1">Philippines</p>
                <br>
                <h4  class="foot2">CAMPUSES</h4>
                <p class="foot1">Perpetual Las Piñas      (02) 8872-7041 or (02) 8871-0639 loc. 103/216</p>
                <p class="foot1">Perpetual Molino           (046) 477 – 0602</p>
                <p class="foot1">Perpetual Calamba        (049) 576-6584</p>
            </div>
            
        </div>
     
   </div>
   <p style="text-align: center;">DISCLAIMER: Contents stated, posted or uploaded in this website have been collected, processed, and used for legitimate purposes specifically fopr awareness campaign. Authorized personnel are allowed to process, store, save, secure, and protect or destroy the information in accordance with law, rules and regulations. ALL RIGHTS RESERVED. University of Perpetual Help System DALTA
    <br>
    customization by: Reynaldo Cuevas Jr</p>
 


</body>
<script>
	$(document).ready(function() {
	   var carousel = $('#carousel');
   
	   // Assuming your images are stored in a folder named 'images'
	   var imagesPath = '../images/';
   
	   // Get the number of images in the folder
	   $.ajax({
		   url: imagesPath,
		   success: function (data) {
			   var count = $('a', data).length;
   
			   // Loop through the images and append them to the carousel container
			   for (var i = 1; i <= count; i++) {
				   carousel.append('<img src="' + imagesPath + i + '.jpeg" alt="Images ' + i + '">');
			   }

			   // Initialize the cycle2 plugin with the specified options
			   carousel.cycle({
                   slidewidth:'1000px',
				   slides: '> img',
				   timeout: 2000,
				   speed: 1000,
				   next: '#carousel',
				   prev: '#carousel',
				   pauseOnHover: true,
				   pager: '#pager',
				   pagerTemplate: '<span>{{slideNum}}/{{slideCount}}</span>',
				   allowWrap: false
			   });
		   }
	   });

	   $('#prevBtn').on('click', function() {
		   carousel.cycle('prev'); // Moves to the previous slide
	   });

	   $('#nextBtn').on('click', function() {
		   carousel.cycle('next'); // Moves to the next slide
	   });
	});


    // Get the button, and when the user clicks on it, execute myFunction
    document.getElementById("myBtn").onclick = function() {myFunction()};

    /* myFunction toggles between adding and removing the show class, which is used to hide and show the dropdown content */
    function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
</script>

</html>