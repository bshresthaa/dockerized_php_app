<?php
session_start(); 
require "../databaseMigrate/db.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") { 

    /**
     * take the email and password
     * check against database
     * validate and redirect to the admin page
     **/
        $email = trim(htmlspecialchars($_POST['email'])); 
        $password = trim(htmlspecialchars($_POST['password'])); 

        if(empty($email) || empty($password)) { 
            die("password or email field empty!!"); 
        }

        $raw_sql = $conn->prepare("select username, email, password from users where email = ? ");
        $raw_sql->bind_param("s",$email); 
        $raw_sql->execute();  
        $result = $raw_sql->get_result();
        $user = $result->fetch_assoc(); 

        if(empty($user)) { 
            die("User does not exists. "); 
        }

        
        if (password_verify($password , $user['password']))  { 
                
                $_SESSION['user_id'] = $user['username']; 
                $_SESSION['email'] = $user['email']; 
                header("Location: /admin/view.php"); 
                exit(); 
        } else { 
            die("wrong password!."); 
        }

}else {
    header("Location: index.php"); 
    exit; 
}

?>