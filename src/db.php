<?php
    $host = "db";
    $username = "root"; 
    $password = "root"; 
    $database = "myapp"; 

    $conn = new mysqli($host,$username,$password,$database); 
    if($conn->connect_error) { 
        die("database connection failed" . $con->connection_error); 
    }
?>