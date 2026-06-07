<?php

session_start(); 

if(!isset($_SESSION['user_id'])) { 
    header("Location: ../index.php");
    exit();
}

require_once "../databaseMigrate/db.php"; 


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = "SELECT * FROM info"; 
    $result = $conn->query($query);
    echo "Welcome, " . $_SESSION['email'];
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>View users </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h2>User List</h2>
    <?php if($result && $result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>email</th>
                <th>dob</th>
                <th>gender</th>
            </tr>

            <?php
            while($row=$result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']);?></td>
                <td><?php echo htmlspecialchars($row['name']);?></td>
                <td><?php echo htmlspecialchars($row['email']);?></td>
                <td><?php echo htmlspecialchars($row['dob']);?></td>
                <td><?php echo htmlspecialchars($row['gender']);?></td>
            </tr>
            <?php
            endwhile; 
            ?>
        </table>
        <?php else:?>
            <p>No user found.</p>
        <?php endif;?> 
        
    <a href="../auth/logout_handler.php">
        <button type = "logout" > Logout</button>
    </a>    

    </body>
    </html>

<?php
}else {
    $response = [ 
        'Message' => 'Not Found',
        'Code' => '404'
    ]; 

    header("Content-Type:application/json"); 
    echo  json_encode($response); 
}

?>




