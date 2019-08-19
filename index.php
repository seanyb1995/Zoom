<?php
/* 
* Page: Dashboard
*/

include('authentication.php');
include('request.php');
include('process.php');

// access restriction
 if(empty($_SESSION['username'])) {
     header('location: login.php');
 }
 
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Mobile Appliction</title>
    <!-- responsive scaling for website -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- linking stylesheet -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
    <body>
        <section class="dashboard">
            <?php include('errors.php'); ?>
            <div class="top">
                <h3 id="logo">Zoom</h3>
                <i id="hamburger" class="fas fa-bars"></i>
                <i id="hamburger" class="fas fa-times"></i>
            </div>
            <div id="sideNav">
                <div class="logout">
                    <p><i class="fas fa-sign-out-alt"></i><a href="index.php?logout='1'">Logout</a></p>
                </div>
            </div>
            <div id="overlay">
                <div class="loader"></div>
                    <div class="receipt">
                      <h3>Trip Details</h3>
                      <hr>
                      <div class="date">
                        <span class="left">Date</span>
                        <span id="date" class="right"><?php
                        if(isset($_SESSION['origin'])) {
                            echo '<script type="text/JavaScript"> 
                                    var d = new Date();
                                    var n = d.toString();
                                    var date = n.replace("GMT+0800 (Australian Western Standard Time)", "");
                                    document.getElementById("date").innerHTML = date;
                                  </script>';
                        }
                        ?>
                        </span>
                      </div>
                      <br>
                      <hr>
                      <div class="trip">
                        <span id="currentTime" class="left"><?php
                        if(isset($_SESSION['origin'])) {
                            echo '<script type="text/JavaScript"> 
                                    var today = new Date();
                                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                                    document.getElementById("currentTime").innerHTML = time;
                                  </script>';
                        }
                        ?></span>
                        <span class="icon"><i class="fas fa-circle"></i></span>
                        <span class="right"><?php if(isset($_SESSION["origin"])) { echo $_SESSION["origin"]; } ?></span>
                        <br>
                        <br>
                        <span id="endTime" class="left"></span>
                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="right"><?php if(isset($_SESSION["destination"])) { echo $_SESSION["destination"]; } ?></span>
                      </div>
                      <br>
                      <div class="bill">
                        <hr>
                        <span class="left heading">Billing Details</span>
                        <br>
                        <hr>
                        <br>
                        <span class="left heading">Trip Distance</span>
                        <span class="right heading">Trip Duration</span>
                        <br>
                        <span class="left body"><?php if(isset($_SESSION["distance"])) { echo $_SESSION["distance"]; } ?> km</span>
                        <span class="right body"><?php if(isset($_SESSION["time"])) { echo $_SESSION["time"]; } ?> min</span>
                        <br>
                        <br>
                        <span class="left heading">Trip Fare</span>
                        <span class="right heading">Initial Waiting</span>
                        <br>
                        <span class="left body">$<?php if(isset($_SESSION["cost"])) { echo $_SESSION["cost"]; } ?></span>
                        <span class="right body">0:00</span>
                      </div>
                      <br>
                      <a href="index.php?close='1'"><button>close</button></a>
                    </div>
            </div>
            <div class="content">
                <div class="controls">
                    <div class="inputs">
                        <form action="index.php" method="POST">
                            <span class="left"><i class="fas fa-circle"></i></span>
                            <span class="right">
                                <p>From</p>
                                <input type="text" id="origin-input" name="origin" placeholder="Pick-up" value="<?php if(isset($_SESSION["origin"])) { echo $_SESSION["origin"]; } ?>"/>
                                <?php
                                if(isset($_SESSION['origin'])) {
                                    echo '<script type="text/JavaScript">  
                                         document.getElementById("origin-input").disabled = true;
                                         </script>' 
                                    ; 
                                 }
                                 ?>
                            </span>
                            <span>
                                <input type="text" id="latlng" hidden>
                                <button type="button" id="getLocation" value="Reverse Geocode"><i class="fas fa-location-arrow"></i></button>
                            </span>
                            <hr></hr>
                            <span class="left"><i class="fas fa-map-marker-alt"></i></span>
                            <span class="right">
                                <p>To</p>
                                <input type="text" id="destination-input" name="destination" placeholder="Drop-off" value="<?php if(isset($_SESSION["destination"])) { echo $_SESSION["destination"]; } ?>"/>
                                <?php
                                if(isset($_SESSION['destination'])) {
                                    echo '<script type="text/JavaScript">  
                                         document.getElementById("destination-input").disabled = true;
                                         </script>' 
                                    ; 
                                 }
                                 ?>
                            </span>
                            <br></br>
                            <span class="submit">
                                <input type="input" name="username" value="<?php if(isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?>" type="hidden"></input>
                                <input type="input" id="requestTime" name="requestTime" value="<?php if(isset($_SESSION["time"])) { echo $_SESSION["time"]; } ?>"></input>
                                <input type="input" id="requestDistance" name="requestDistance" value="<?php if(isset($_SESSION["distance"])) { echo $_SESSION["distance"]; } ?>"></input>
                                <input type="input" id="requestCost" name="requestCost" value="<?php if(isset($_SESSION["cost"])) { echo $_SESSION["cost"]; } ?>"></input>
                                <input id="request" type="submit" name="request" value="Request Driver"></input>
                            </span>
                        </form>
                    </div>
                </div>
                <div id="map"></div>
                <div id="output">
                    <div class="time">
                        <span class="left"><i class="fas fa-clock"></i></span>
                        <span class="right">
                            <p>Estimated Time</p>
                            <h3 id="time"><?php if(isset($_SESSION["time"])) { 
                                echo '<script type="text/JavaScript">  
                                     document.getElementById("output").style.opacity = "1";
                                     </script>' 
                                ; 
                            } ?></h3>
                        </span>
                    </div>
                    <hr></hr>
                    <div class="distance">
                        <span class="left"><i class="fas fa-road"></i></span>
                        <span class="right">
                            <p>Estimated Distance</p>
                            <h3 id="distance"><?php if(isset($_SESSION["distance"])) { echo $_SESSION["distance"]; } ?></h3>
                        </span>
                    </div>
                    <hr></hr>
                    <div class="cost">
                        <span class="left"><i class="fas fa-dollar-sign"></i></span>
                        <span class="right">
                            <p>Estimated Cost</p>
                            <h3 id="cost"></h3>
                      </span>
                  </div>
                </div>
            </div>
        </section>
        <!-- scripts-->
        <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI9agnTYY5PuR83RIMR2F4YeopMtNenAE&libraries=places&callback=initMap" async defer></script>
        <script type="text/javascript" src="js/dashboard.js"></script>
        <script type="text/javascript" src="js/google.js"></script>
    </body>
<footer>
</footer>
</html>