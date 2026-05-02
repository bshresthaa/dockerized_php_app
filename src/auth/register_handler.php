<?php

require "../databaseMigrate/db.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") { 

$username = trim(htmlspecialchars($_POST['username'])); 
$email = trim(htmlspecialchars($_POST['email'])); 
$password = trim(htmlspecialchars($_POST['password'])); 
$password_encrypted = password_hash($password, PASSWORD_DEFAULT); 

$sql = $conn->prepare("INSERT INTO myapp.users(username, email, password) VALUES(?,?, ?)"); 
$sql->bind_param("sss", $username, $email, $password_encrypted);

if($sql->execute()) {
    if($sql->affected_rows==1){ 
        header("Location: ../index.php?success=1"); 
        exit(); 
    }
}else{ 
    error_log("user creation failed"); 
    echo "something went wrong"; 
}; 

$response = [
    "status" => "User Created",
    "code" => 200
];

echo json_encode($response);
exit();


}else { 
    header("Location: loginfunctions.php");
    exit(); 
}

?>