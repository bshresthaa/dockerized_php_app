<?php
    session_start(); 
    
    if(empty($_SESSION['user_id'])) { 
        header("Location:../index.php"); 
        exit(); 
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <li> <a href="view.php">back</a></li>
    </div>

    <p id ="p">Hello from the js file</p>
</body>


<script>
    document.getElementById("").addEventListener("") { 

    }
</script>


</html>