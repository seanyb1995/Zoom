<?php
/* 
* Page: Login
*/
include('authentication.php');
include('config.php');
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
                <form action="login.php" method="POST">
                    <!-- errors -->
                    <?php include('errors.php'); ?>
                    <!-- username input-->
                    <div class="username">
                        <div class="icon-left">
                            <i class="far fa-user"></i>
                        </div>
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"/>
                    </div>
                    <!-- password input -->
                    <div class="password">
                        <div class="icon-left">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="icon-right">
                          <label class="checkbox-container">
                            <input type="checkbox" onclick="reveallogin()">
                            <label for="password"></label>
                            <i id="icon" class="fas fa-eye-slash"></i>
                          </label>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"/>
                    </div>
                    <!-- remember me checkbox -->
                     <div class="remember-me">
                        <label class="checkbox-container">
                          <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>/>
                          <label for="remember"></label>
                          <p>Remember me</p>
                        </label>
                     </div>
                     <!-- forgot password link -->
                    <div class="forgot-password">
                        <a href="">Forgot password?</a>
                    </div>
                    <!-- login button -->
                    <div class="login">
                        <button type="submit" class="btn" name="login">Login</button>
                        <span class="color" data-value="1">
                    </div>
                    <!-- sign up link -->
                    <div class="sign-up">
                        <p>Don't have an account? <a href="http://zoom-seanbuchanan1995351517.codeanyapp.com:3000/register.php">Sign Up Now</a></p>
                    </div>
                </form>
            </div>
        </section>
        <!-- scripts -->
        <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
<footer>
</footer>
</html>