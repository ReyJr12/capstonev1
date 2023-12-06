<?php
    include("../Login/connection.php");
    
    // Process user information form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_user_info'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $sql = "INSERT INTO feedback (Firstname, Lastname, Email, Message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $message);

        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    // Process feedback form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
        if (isset($_POST['comment'])) {
            $comment = $_POST['comment'];

            // Check if the comment length exceeds 1000 characters
            if (strlen($comment) >= 1000) {
                echo "Error: Feedback message should not exceed 1000 characters.";
            } else {
                $sql = "INSERT INTO feedback1 (FEEDBACK) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $comment);
            
                if ($stmt->execute()) {
                    echo "Comment submitted successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
                $stmt->close();
            }}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="UTF-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <title>Home Page</title>
    <link rel="stylesheet" href="../Contactus/Contact1.css">
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
<div class="container1">  
        <p class="Lines"></p>
        <p class="ContactHEAD">CONTACT US</p>
        <P class="Lines"></P>
</div>

<div class="container2">  
    <div class="feedbox">
        <p class="feedboxhead">Let’s get this conversation started. Tell us a bit about yourself, and we’ll get in touch as soon as we can <br> ______</p>
        
        <form action="Contact.php" method="post">
           <div class="flexing1and2">
                <div class="flexing1">
                  <Label class="lbels">First name: </Label><br>
                  <input Class="input"type="text" name="firstname" placeholder="First Name" required><br>
                  </div>
                <div class="flexing2">
                  <Label class="lbels">Last name: </Label>
                  <br>
                  <input Class="input" type="text" name="lastname" placeholder="Last Name" required><br>
                  </div>
            </div>
            <div class="flexingemail">
            <Label class="lbels">Email: </Label>
            <br>
            <input Class="input1"  type="email" name="email" placeholder="Email" required><br>
            </div>
            <div class="flexingemail1">
            <Label class="lbels">Message: </Label>
            <br>
            <textarea class="textarea" name="message" placeholder="Your Message" required></textarea><br>
            </div>
            <input type="submit" name="submit_user_info" class="subbtn" value="SUBMIT MESSAGE ">
        </form>
        
    </div>
</div>

<div class="container1">  
        <p class="Lines"></p>
        <p class="ContactHEAD">FEEDBACK</p>
        <P class="Lines"></P>
</div>
<div class="feedbox1">
        <div class="yellowbg">
            <p class="sendfeedboxhead">Send us your feedback!</p>
        </div>
        <p class="paragraph">Your comments are important to us and are crucial in helping us provide the best service.</p>
        <form action="Contact.php" method="post">
    <textarea class="textarea2" name="comment" id="feedbackMessage" placeholder="Your Message" required></textarea>
    <span id="charCount"></span>
    <input type="submit" name="submit_feedback" class="subbtn1" value="SUBMIT">
</form>
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
<script>
    // Function to update character count and show warning if close to limit
    document.addEventListener("DOMContentLoaded", function() {
        var feedbackMessage = document.getElementById('feedbackMessage');
        var charCount = document.getElementById('charCount');

        feedbackMessage.addEventListener('input', function() {
            var charactersRemaining = 988 - this.value.length;
            charCount.textContent = charactersRemaining + ' characters remaining';
            
            // Apply styles to the charCount element
            charCount.style.color = 'white';
            charCount.style.marginLeft = '20px';

            if (charactersRemaining < 20 && charactersRemaining >= 0) {
                charCount.style.color = 'orange'; // Change color to indicate approaching limit
            } else if (charactersRemaining < 0) {
                charCount.style.color = 'red'; // Change color to indicate exceeding limit
                charCount.textContent = 'Limit exceeded by ' + Math.abs(charactersRemaining) + ' characters!';
            }
        });
    });
</script>
</HTML>