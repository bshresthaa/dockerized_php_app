<?php

require_once "db.php"; 

//check if form was submitted.
if($_SERVER["REQUEST_METHOD"] == "POST") { 

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $dob = trim($_POST['dob'] ?? ''); 
    $gender = trim($_POST['gender'] ?? '');  
    
    if(empty($name) || empty($email)) { 
        die("required fields email and name"); 
    }

    $stmt = $conn->prepare("INSERT INTO info (name, email, dob, gender) VALUES(?,?,?,? )"); 
    if(!$stmt) { 
        die("prepare failed". $conn->error); 
    } 
    $stmt->bind_param("ssss",$name,$email,$dob,$gender); 

    if($stmt->execute()) { 
        echo"data stored sucessfull"; 
    }else { 
        echo"Insert Failed."; 
    }

    $stmt->close(); 
    $conn->close(); 

}else { 
    echo "Invalid response"; 
}
?>
