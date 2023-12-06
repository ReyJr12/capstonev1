<?php
      include("../Login/connection.php");

      function truncateText($text, $limit) {
          $text = strip_tags($text); // Remove any HTML tags for accurate word count
          if (strlen($text) > $limit) {
              $text = substr($text, 0, $limit) . '...'; // Truncate text to the specified limit
          }
          return $text;
      }
  
      // Assuming you have a database connection and a table named 'events1'
      $query = "SELECT Image, Title, Subtitle, Description FROM events1 ORDER BY ID DESC LIMIT 3"; // Retrieve the three latest events
      $result = mysqli_query($conn, $query);
  
      // Check if there are fetched events
      if (mysqli_num_rows($result) > 0) {
          // Fetch the first latest event
          $firstEvent = mysqli_fetch_assoc($result);
  
          // Fetch the second latest event
          $secondEvent = mysqli_fetch_assoc($result);
      
          // Fetch the third latest event
          $thirdEvent = mysqli_fetch_assoc($result);
      } else {
          // If no events are fetched, set default values or leave empty
          $firstEvent = ['Image' => '', 'Title' => '', 'Subtitle' => '', 'Description' => ''];
          $secondEvent = ['Image' => '', 'Title' => '', 'Subtitle' => '', 'Description' => ''];
          $thirdEvent = ['Image' => '', 'Title' => '', 'Subtitle' => '', 'Description' => ''];
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="../HomePage/Homepage.css">
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
    <div class="bodymargin">
        <div class="container">
            <p class="lats">LATEST NEWS</p>
            <p class="LineLatest"></p>
           
            <!-- Display the first latest event -->
            <div class="content">
                <div class="flex-container">
                    <!-- First latest event -->
                    <div class="flex-child-1">
                        <p class="Boxdesign1"></p>
                        <h1 class="PHILOSOPHYHeader">PHILOSOPHY</h1>
                        <p class="PHILOSOPHY">The <strong> Community Extension Services (CES) </strong> believes in the dignity of man and the development of his potentials to the optimum. The program further believes that such development could be attained through the involvement of socially conscious students, faculty members, and non-teaching staff in community services.</p>
                    </div> 
                    <div class="flex-child-2">
                        <div class="flex-container2">
                            <div class="flex-child-2-1">
                                <!-- Display the first latest event details -->
                                <img class="blood" src="../Admin/<?php echo $firstEvent['Image']; ?>" alt="bloodtype">
                                
                                <div class="divtitle">
                                    <p class="title1"><?php echo $firstEvent['Title']; ?></p>
                                    <p class="subtitle1"><?php echo $firstEvent['Subtitle']; ?></p>
                                    <p class="subtitle3"><?php echo truncateText($firstEvent['Description'], 200); ?></p>
                                    <a class="tomaroonReadmore" href="../News/NEWS1.php"><p class="ReadMore">--READ MORE--</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Display the second latest event -->
            <div class="content">
                <div class="flex-container">
                    <!-- Second latest event -->
                    <div class="flex-child-1">
                        <p class="Boxdesign1"></p>
                        <h1 class="PHILOSOPHYHeader">VISION</h1>
                        <p class="PHILOSOPHY">The UPHSD Community Extension Services (CES) is a dynamic, facilitative and integrative office that assists people to become physically and mentally healthy, especially those in the depressed communities in the city of Las Piñas and its environs.</p>
                    </div> 
                    <div class="flex-child-2">
                        <div class="flex-container2">
                            <div class="flex-child-2-1">
                                <!-- Display the second latest event details -->
                                <img class="blood" src="../Admin/<?php echo $secondEvent['Image']; ?>" alt="bloodtype">
                                <div class="divtitle">
                                    <p class="title1"><?php echo $secondEvent['Title']; ?></p>
                                    <p class="subtitle1"><?php echo $secondEvent['Subtitle']; ?></p>
                                    <p class="subtitle3"><?php echo truncateText($secondEvent['Description'], 200); ?></p>
                                    <a class="tomaroonReadmore" href="../News/NEWS1.php"><p class="ReadMore">--READ MORE--</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="LineLatest1"></p>
            <div class="flex-child-1">
                <p class="Boxdesign2"></p>
                
                <h1 class="PHILOSOPHYHeader">MISSION</h1>
            
                <p class="Mission">To effect an environment supportive of the development of self-reliant, healthy, and socially responsible citizens of Las Piñas, and the Philippines in general.</p>
                
            </div> 
        </div>
    </div>
    <div class="flex-container5"> 
    <div class="flex-child-5-1">
        <p class="Boxdesign4"></p>
        <h1 class="QUALITYPOLICYHeader">QUALITY POLICY</h1>
        <p class="QUALITY">The University of Perpetual Help System DALTA (UPHSD) Community Extension Services is committed to the delivery of relevant, responsive, inclusive and sustainable HELPERS programs and services towards the progressive improvement of the quality of life of the identified social development partners of UPHSD.</p>
    </div> 
    <div class="flex-child-5">
        <div class="flex-container6">
            <p class="Boxdesign5"></p>
            <h1 class="QUALITYPOLICYHEADER1">QUALITY OBJECTIVE</h1>
            <p class="qualitypolicyP">
                The University of Perpetual Help System-DALTA shall:
                <div class="liqualityspacing">
                    <li class="liQuality">Provide an enabling environment for all members of the academic and support groups to develop and implement sustainable programs and services that will respond to the needs of the community;</li>
                    <li class="liQuality">Strengthen partnership with the government and non-government institutions in building sustainable, empowered and self-reliant community; and</li>
                    <li class="liQuality">Serve as a catalyst for honing the identity of Perpetualites as Helpers of God.</li>
                </div>
            </p>
        </div>
    </div>
</div>
<div class="highlightheader">
    <p class="Boxdesign6"></p>
    <h1 class="highlightheader1">HIGHLIGHT</h1>
</div>
<div class="backgroundslide">
    <table style="width: 100%; margin-top: 17%;">
        <tr>
            <!-- First Event -->
            <td style="width: 33.33%; text-align: center; color:white; font-size:20px;">
                <img src="../Admin/<?php echo $firstEvent['Image']; ?>" alt="Image 1" style="max-width: 100%; height: auto; width: 350px; max-height: 400px;" id="eventImage1">
                <p class="tals" id="eventTitle1"><?php echo $firstEvent['Title']; ?></p>
                <p class="sub" id="eventSubtitle1"><?php echo $firstEvent['Subtitle']; ?></p>
                <p class="des" id="eventDescription1"><?php echo truncateText($firstEvent['Description'], 200); ?></p>
            </td>

            <!-- Second Event -->
            <td style="width: 33.33%; text-align: center; color:white; font-size:20px;">
                <img src="../Admin/<?php echo $secondEvent['Image']; ?>" alt="Image 2" style="max-width: 100%; height: auto; width: 350px; max-height: 400px;" id="eventImage2">
                <p class="tals" id="eventTitle2"><?php echo $secondEvent['Title']; ?></p>
                <p class="sub" id="eventSubtitle2"><?php echo $secondEvent['Subtitle']; ?></p>
                <p class="des" id="eventDescription2"><?php echo truncateText($secondEvent['Description'], 200); ?></p>
            </td>

            <!-- Third Event -->
            <td style="width: 33.33%; text-align: center; color:white; font-size:20px;">
                <img src="../Admin/<?php echo $thirdEvent['Image']; ?>" alt="Image 3" style="max-width: 100%; height: auto; width: 350px; max-height: 400px;" id="eventImage3">
                <p class="tals" id="eventTitle3"><?php echo $thirdEvent['Title']; ?></p>
                <p class="sub" id="eventSubtitle3"><?php echo $thirdEvent['Subtitle']; ?></p>
                <p class="des" id="eventDescription3"><?php echo truncateText($thirdEvent['Description'], 200); ?></p>
                <button id="nextEventBtn">Next Event</button>
            </td>
        </tr>

    </table>
   
</div>
<div class="flex-container7"> 
         <div class="flex-child-7-1"><p class="Boxdesign6"></p>
            <h1 class="UPCEASHeader">UPHSD’S BEST PRACTICES in COMMUNITY EXTENSION SERVICES</h1>
            <div id="carousel" class="carousel">
                <!-- Images will be loaded dynamically using jQuery --></div>
               <div class="btnslides">
                <button class="btnslides1" id="prevBtn">Previous Slide</button> <!-- Added button for previous slide -->
               <button  class="btnslides1" id="nextBtn">Next Slide</button> <!-- Added button for next slide -->
            </div>
         </div> 
             <div class="flex-child-8">
                <div class="flex-container8"><p class="Boxdesign7"></p>
                    <h1 class="BESGHeader">BILIBID EXTENSION SCHOOL GRADUATION</h1>
                    <div class="videoCES">
                        <iframe   width="520" height="500" src="https://youtube.com/embed/BI95yjXxSFQ?controls=0">
                        </iframe>
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
     
   </div>
   <p style="text-align: center;">DISCLAIMER: Contents stated, posted or uploaded in this website have been collected, processed, and used for legitimate purposes specifically fopr awareness campaign. Authorized personnel are allowed to process, store, save, secure, and protect or destroy the information in accordance with law, rules and regulations. ALL RIGHTS RESERVED. University of Perpetual Help System DALTA
    <br>
    customization by: Reynaldo Cuevas Jr</p>
 
<script>
     $(document).ready(function() {
        var currentEvent = 0; // Track the current event index
        var events1 = [
            {
                title: "<?php echo $firstEvent['Title']; ?>",
                subtitle: "<?php echo $firstEvent['Subtitle']; ?>",
                description: "<?php echo $firstEvent['Description']; ?>",
                image: "<?php echo $firstEvent['Image']; ?>"
            },
            {
                title: "<?php echo $secondEvent['Title']; ?>",
                subtitle: "<?php echo $secondEvent['Subtitle']; ?>",
                description: "<?php echo $secondEvent['Description']; ?>",
                image: "<?php echo $secondEvent['Image']; ?>"
            },
            {
                title: "<?php echo $thirdEvent['Title']; ?>",
                subtitle: "<?php echo $thirdEvent['Subtitle']; ?>",
                description: "<?php echo $thirdEvent['Description']; ?>",
                image: "<?php echo $thirdEvent['Image']; ?>"
            }
        ];

        // Function to display the current event details and images
        unction displayEvent() {
            $('#eventTitle').text(events1[currentEvent]['title']);
            $('#eventSubtitle').text(events1[currentEvent]['subtitle']);
            $('#eventDescription').text(truncateText(events1[currentEvent]['description'], 200));
            $('#eventImage').attr('src', '../Admin/' + events1[currentEvent]['image']);
        }
        // Function to handle displaying the next event
        function displayNextEvent() {
            currentEvent = (currentEvent + 1) % events1.length; // Cycle through events
            displayEvent(); // Display the current event
        }

        // Initially display the first event
         displayEvent();

                // Add functionality to the "Next Event" button
        $('#nextEventBtn').on('click', function() {
            displayNextEvent(); // Display the next event when the button is clicked
        });
        // Function to truncate text
        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.substr(0, maxLength - 1) + '...' : text;
        }

      
    });
</script>
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
