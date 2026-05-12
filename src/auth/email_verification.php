<?php
    session_start(); 
    $email = $_SESSION['email'];
    if(empty($email) ) { 
        header("Location: ../index.php"); 
        exit(); 
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
<div class = "form-container">
    <div class = "login-page">

        <h1>Verify Email </h1>

            <form METHOD = "POST" id="otpVerify"> 

            <br>
            <p>A verification code was sent to <?php echo $email ?> Please enter the code to verify your account</p>
                <div class = "form-group">
                   
                    <label for="otpcode">OTP:</label>
                    <input type="text" name="otpcode" id="otpcode" 
                    maxlength = "6" pattern = "[0-9]{6}" inputmode = "numeric" placeholder="code" required>
                </div>

                <br>
                <button type = "submit">Verify</button>

            </form>
    </div>

</div>
</body>
<script>
    document.getElementById("otpVerify").addEventListener("submit", function(e) { 
        e.preventDefault(); 

        const form = new FormData(this); 

        fetch("verify_otp.php", { 
            method : "POST",
            body : form
        })
        .then(res=> res.json())
        .then(data=> { 
            alert (data.message); 
            if(data.status === "success") { 
                window.location.href = "../index.php";
               
            }
        })
        .catch(err => console.error("Error", err));

    })
</script>
</html>