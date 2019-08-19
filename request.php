<?php
//----------------------------------------------------request driver process--//

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

// Create request table
$sql = "CREATE TABLE IF NOT EXISTS request (
        id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
        username VARCHAR(320) NOT NULL,
        origin VARCHAR(320) NOT NULL,
        destination VARCHAR(320) NOT NULL,
        time VARCHAR(320) NOT NULL,
        distance VARCHAR(320) NOT NULL,
        cost VARCHAR(320) NOT NULL,
        PRIMARY KEY (id)
        );";
        
        

// if ($connection->query($sql) === TRUE) {
//     echo "Table account created successfully";
// } else {
//     echo "Error creating table: " . $connection->error;
// }

// $connection->close();

?>