<?php 
    include("../Login/connection.php");
    $status = "new"; // Define the status condition

    $sql = "SELECT `ID`, `Image`, `Title`, `Subtitle`, `Description`, `Status` FROM `events1` WHERE `Status` = ?"; // Modify this query based on your table structure and desired condition
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    $initialEventsToShow = 2; // Define the number of events to display initially
    $eventsDisplayed = 0; // Counter to track displayed events
?>

<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="NEWS.css">
    <title>CORES</title>
</head>
<body >
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
    <div class="AboutNews">
        <P class="Boxdesign1"></P>
        <H1 class="newsHeader">News</H1>
     </div>
    <p class="newsline"></p>

    <div class="newsContainer">
        <?php 
            while ($row = $result->fetch_assoc()) {
                if ($eventsDisplayed < $initialEventsToShow) {
                    // Display initial events
        ?>
                    <div class="newsItem">
                        <div class="firstbox">
                            <?php 
                                // Output the image with the correct path
                                echo '<img class="newsimg1" src="../Admin/' . $row['Image'] . '" alt="Image">';
                            ?>
                        </div>
                        <div class="secondbox">
                            <?php echo '<p class="Maagangheader">' . $row['Title'] . '</p>'; ?>
                            <?php echo '<p class="Maagangdetails">' . $row['Subtitle'] . '</p>'; ?>
                            <?php echo '<p class="Maagangp">' . $row['Description'] . '</p>' ?>
                        </div>
                    </div>
        <?php 
                    $eventsDisplayed++;
                } else {
                    // Hide subsequent events initially
        ?>
                   <div class="newsItem-hiddenEvent" style="display: flex;">
                        <div class="firstbox">
                            <?php 
                                // Output the image with the correct path
                                echo '<img class="newsimg1" src="../Admin/' . $row['Image'] . '" alt="Image">';
                            ?>
                        </div>
                        <div class="secondbox">
                            <?php echo '<p class="Maagangheader">' . $row['Title'] . '</p>'; ?>
                            <?php echo '<p class="Maagangdetails">' . $row['Subtitle'] . '</p>'; ?>
                            <?php echo '<p class="Maagangp">' . $row['Description'] . '</p>' ?>
                        </div>
                    </div>
        <?php 
                }
            }
        ?>
    

    <div class="responsivefoot">
        <button class="loadBtn" id="toggleBtn">-- LOAD MORE --</button>
    </div>
    <img class="footers" src="../PICS/NEWS/footer.png">
</div>
</div>
<script>
    const toggleButton = document.getElementById('toggleBtn');
    const hiddenEvents = document.querySelectorAll('.newsItem-hiddenEvent');

    // Initially hide hidden events
    hiddenEvents.forEach(event => {
        event.style.display = 'none';
    });

    // Set initial state (visible)
    let isContentVisible = false;

    // Function to toggle the content's visibility
    function toggleContentVisibility() {
        hiddenEvents.forEach(event => {
            if (isContentVisible) {
                event.style.display = 'none'; // Hide the content
                toggleButton.textContent = '-- LOAD MORE --'; // Change button text
            } else {
                event.style.display = 'flex'; // Show the content as flex
                toggleButton.textContent = '-- SEE LESS --'; // Change button text
            }
        });
        isContentVisible = !isContentVisible; // Toggle the visibility state

        // Change button text based on visibility
        if (!isContentVisible) {
            toggleButton.textContent = '-- LOAD MORE --'; // Change button text
        } else {
            toggleButton.textContent = '-- SEE LESS --'; // Change button text
        }
    }

    toggleButton.addEventListener('click', toggleContentVisibility);
    document.addEventListener('DOMContentLoaded', function() {
    const dashboardButton = document.getElementById('myBtn');
    const dropdownContent = document.getElementById('myDropdown');

    dashboardButton.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevents click on the button from closing the dropdown immediately
        dropdownContent.classList.toggle('show');
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('#myBtn') && !event.target.closest('#myDropdown')) {
            dropdownContent.classList.remove('show');
        }
    });
});
</script>


</body>
</html>