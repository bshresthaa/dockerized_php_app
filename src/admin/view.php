<?php

require_once "db.php"; 

$sql = "SELECT * FROM info"; 
$result = $conn->query($sql); 

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
</body>
</html>