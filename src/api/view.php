<?php
include_once __DIR__ . "/../databseMigrate/db.php"; 

if (strtoupper($_SERVER['REQUEST_METHOD']) == "GET") { 

    $query = 'Select * from info'; 
    $result = $conn->query($query); 

    if(!empty($result)) { 
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"] . "<br>";
        }
    } 
}else { 
    $response= [
        'code' => '402',
        'message' => 'Could not find the method type'
    ]; 

    header("Content-Type:application/json"); 
    echo json_encode($response); 
}

$conn->close(); 

?>