<?php
session_start(); 
require "../databaseMigrate/db.php"; 

header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] == "POST") { 

    /**
     * take the email and password
     * check against database
     * validate and redirect to the admin page
     **/
        $email = trim(htmlspecialchars($_POST['email'])); 
        $password = trim(htmlspecialchars($_POST['password'])); 

        if(empty($email) || empty($password)) { 
            echo json_encode([
                "message" => "password cannot be empty",
                "status" => "failed"
            ]);
            exit(); 
        }

        $raw_sql = $conn->prepare("select username, email, password from users where email = ? ");
        $raw_sql->bind_param("s",$email); 
        $raw_sql->execute();  
        $result = $raw_sql->get_result();
        $user = $result->fetch_assoc(); 

        if(empty($user)) { 
            echo json_encode([
                "message" => "Username or password incorrect",
                "status" => "failed"
            ]);
            exit();
        }

        
        if (password_verify($password , $user['password']))  { 
                
                $_SESSION['user_id'] = $user['username']; 
                $_SESSION['email'] = $user['email']; 

                echo json_encode([ 
                    "message" => "login success",
                    "status" => "success"
                ]);
                exit(); 
        } else { 

            echo json_encode([ 
                "message" => "wrong password",
                "status" => "failed"
            ]);
            exit(); 
            
        }

}else {
    header("Location: index.php"); 
    exit; 
}

?>