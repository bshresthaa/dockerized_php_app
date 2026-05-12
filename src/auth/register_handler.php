<?php

session_start(); 

require "../databaseMigrate/db.php"; 
require __DIR__ . '/../vendor/autoload.php';

$apiKey = getenv('RESEND_API_KEY'); 
$resend = Resend::client($apiKey); 

if($_SERVER["REQUEST_METHOD"] == "POST") { 

$username = trim(htmlspecialchars($_POST['username'])); 
$email = trim(htmlspecialchars($_POST['email'])); 
$password = trim(htmlspecialchars($_POST['password'])); 
$password_encrypted = password_hash($password, PASSWORD_DEFAULT); 

$duplicateCheck = $conn->prepare("SELECT * from users where email = ?");
$duplicateCheck->bind_param('s', $email); 
$duplicateCheck->execute(); 

$result = $duplicateCheck->get_result();

if($result->num_rows > 0) { 
    echo json_encode([
        "message" => "User Already Registered",
        "status" => "error"
    ]);
    exit(); 
}

$sql = $conn->prepare("INSERT INTO myapp.users(username, email, password) VALUES(?,?, ?)"); 
$sql->bind_param("sss", $username, $email, $password_encrypted);

if($sql->execute()) {

    $_SESSION['email'] = $email; 

    if($sql->affected_rows==1){
    //generate the OTP. 
    $otp = random_int(100000,999999); 

    //set it in the db. 
    $otp_sql = $conn->prepare("UPDATE myapp.users SET otp = ? where email = ? "); 
    $otp_sql->bind_param('is', $otp,$email);
    $otp_sql->execute();  

    $emailBody = "
        <h2>Your OTP code</h2>
        <p>Here is your OTP code to verify your account: </p>
        <h1>$otp</h1>
    "; 

    $resend->emails->send([
      'from' => 'onboarding@resend.dev',
      'to' => $email,
      'subject' => 'YOUR OTP CODE',
      'html' => $emailBody
    ]);

    echo json_encode([
        "message" => "Successfully registered",
        "status" => "success"
    ]);

    }
}else{ 
    error_log("user creation failed"); 
    echo json_encode([
        "message" => "something went wrong",
        "status" => "error" 
    ]);
}; 

exit();

}else { 
    header("Location: loginfunctions.php");
    exit(); 
}

?>