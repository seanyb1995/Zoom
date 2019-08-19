<?php 
//------------------------------------------------------login authenticaiton--//
    session_start();
    
    $username = "";
    $email = "";
    $errors = array();
    
    // MySQL database settings
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "mysql";
    
    // MySQL conneciton
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // Test if connection succeeded
    if(mysqli_connect_errno()) {
        die("Database conneciton failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
        );
    }
    
    
   if(isset($_POST['register'])) {     

        // Get variables
        $username = $_POST['username'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];
        $email = $_POST['email'];
        $termsandconditions = $_POST['termsandconditions'];
        
        // MYSQL injection prevention
        $username = mysqli_real_escape_string($connection,$username);
        $password_1 = mysqli_real_escape_string($connection,$password_1);
        $password_2 = mysqli_real_escape_string($connection,$password_2);
        $email = mysqli_real_escape_string($connection,$email);
        
        // Checking form fields are filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }
        
        if(strlen($username) <5) {
            array_push($errors, "Usernames need to be 5 characters or longer");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          array_push($errors, "Invalid email format");
        }
        
        if(strlen($password_1) <5) {
            array_push($errors, "Passwords need to be 5 characters or longer");
        }
        
        if(strlen($password_2) <5) {
            array_push($errors, "Passwords need to be 5 characters or longer");
        }
        
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
        
         if(!isset($termsandconditions)) { 
            array_push($errors, "You must agree to the Terms and Conditions in-order to be able to register");
         }
         
        
        if (count($errors) == 0) {
            $query = "SELECT * FROM account WHERE username='$username'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) == 1) {
                array_push($errors, "The username is already taken");
            }else{
                $query = "SELECT * FROM account WHERE email='$email'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) == 1) {
                    array_push($errors, "This email already has an account assign to it");
            }else{
                // $password = md5($password_1); // encrypt password before instoring in database
                $password = $password_1; // encrypt password before instoring in database
                $sql = "INSERT INTO account (username, password, email)
                VALUES ('$username', '$password', '$email')";
                mysqli_query($connection, $sql);
                sleep(7.5);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }
        }
    }
    }
    // login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password); 
        
        
        // Checking form fields are filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        
        if (count($errors) == 0) {
            $query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) == 1) {
                if(isset($_POST['remember'])) {
                    setcookie("member_login", $username, time() + (86400 * 30), "/" );
            }else{
                if(!isset($_POST['remember'])) {
                    setcookie("member_login", $username, time() - 3600);
                }
            }
            echo '<h3>Hello</h3>';
            sleep(7.5);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');  
            }else{
                array_push($errors, "The username or password was incorrect");
            }
        }
        
    }
    
    // logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['origin']);
        unset($_SESSION['destination']);
        unset($_SESSION['time']);
        unset($_SESSION['distance']);
        header('location: login.php');
        
    }
    
        // logout
    if (isset($_GET['close'])) {
        unset($_SESSION['origin']);
        unset($_SESSION['destination']);
        unset($_SESSION['time']);
        unset($_SESSION['distance']);
    }
    
?>
