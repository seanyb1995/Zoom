<?php
/* 
* Page: Registration
*/
include('authentication.php');

?>
<html lang="en">
<head>
    <meta chartset="utf-8">
    <title>Mobile Appliction</title>
    <!-- responsive scaling for website -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- linking stylesheet -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
    <body>
        <h3 id="company-name">Zoom</h3>
        <object type="image/svg+xml" data="svg/header.svg">
          Your browser does not support SVG
        </object>
        <section class="dashboard">
            <div class="login-form">
                <form action="register.php" method="POST">
                    <!-- errors -->
                    <?php include('errors.php'); ?>
                    <!-- username input -->
                    <div class="username">
                        <div class="icon-left">
                            <i class="far fa-user"></i>
                        </div>
                        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username ?>"/>
                    </div>
                    <!-- email input -->
                    <div class="email">
                        <div class="icon-left">
                            <i class="far fa-envelope"></i>
                        </div>
                        <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email ?>"/>
                    </div>
                    <!-- password input -->
                    <div class="password">
                        <div class="icon-left">
                            <i class="fas fa-lock"></i>
                        </div>
                    <div class="icon-right">
                      <label class="checkbox-container">
                        <input type="checkbox" onclick="revealregister()">
                        <label for="password_1"></label>
                        <i id="icon" class="fas fa-eye-slash"></i>
                      </label>
                    </div>
                    <input type="password" id="password_1" name="password_1" placeholder="Password"/>
                    </div>
                    <!-- confirm password input -->
                    <div class="password">
                        <div class="icon-left">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password_2" name="password_2" placeholder="Confirm password"/>
                    </div>
                    <div class="terms-and-conditions">
                        <label class="checkbox-container">
                          <input type="checkbox" name="termsandconditions" id="termsandconditions"/>
                          <label for="termsandconditions"></label>
                          <p>I have read and agree to <a>Terms and Conditions</a></p>
                        </label>
                     </div>
                    <div class="login">
                        <button type="submit" class="btn" name="register">Register</button>
                        <span class="color" data-value="1">
                    </div>
                    <!-- register link -->
                    <div class="sign-in">
                        <p>Already a member? <a href="https://zoom-seanyb1995.c9users.io/login.php">Sign in</a></p>
                    </div>
                </form>
            </div>
        </section>
        <!-- scriopts -->
        <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
<footer>
</footer>
</html>