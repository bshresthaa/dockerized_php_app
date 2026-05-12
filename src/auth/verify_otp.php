<?php

session_start(); 

require "../databaseMigrate/db.php"; 


if($_SERVER['REQUEST_METHOD'] == "POST") { 

    $otp = trim(htmlspecialchars($_POST['otpcode']) ); 
    $email = $_SESSION['email']; 

    $sqlCheckOtp = $conn->prepare("SELECT otp FROM users where email = ?"); 
    $sqlCheckOtp->bind_param('s', $email); 
    $sqlCheckOtp->execute(); 
    $result = $sqlCheckOtp->get_result(); 
    $row = $result->fetch_assoc();

    if($row) { 
        // echo($row['otp']); 
        // echo "otp is: ". $otp; 
        if ((string)$row['otp'] === (string)$otp ) { 

            $sqlVerifyEmail = $conn->prepare("UPDATE users set email_verified = '1' where email = ?"); 
            $sqlVerifyEmail->bind_param('s', $email); 
            $sqlVerifyEmail->execute();

            if ($sqlVerifyEmail->affected_rows > 0){
                echo json_encode([
                    "message" => "successfully verified OTP",
                    "status" => "success"
                ]); 
                exit(); 
            }

        }
    }
    
    echo json_encode([
        "message" => "Invalid OTP or something went wrong",
        "status" => "error"
    ]);
    
    exit(); 

}

?>