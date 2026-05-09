<?php

//get session
session_start(); 

//session destroy
$_SESSION=[];
session_destroy(); 

//redirect to homepage. 
header("Location: ../index.php"); 

exit(); 

?>



