<?php

require_once "../databaseMigrate/db.php"; 

header("Content-Type:application/json"); 

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
        $return = [
            'message'=>'data store successfull',
            'code'  => '200'
        ];

        echo json_encode($return); 
    }else { 
        echo json_encode([
            "status" => "error",
            "message" => "Insert failed"
        ]);
    }

    $stmt->close(); 
    $conn->close(); 

}else { 
    $response = [ 
        'message' => 'Invalid request',
        'status' => 'error'
    ]; 
    echo json_encode($response); 
}
?>
