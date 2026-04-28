<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class = "form-container">
    <div class = "login-page">

        <h1>Login Here</h1>

            <form METHOD = "POST" action = "loginfunctions.php" id="userLogin"> 

                <div class = "form-group">
                   
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="your email" required>
                </div>

                <div class = "form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                </div>
                
                <br>
                <button type = "submit">Login</button>

            </form>
    </div>

</div>
</body>
<script src = "./script/script.js"></script>
</html>