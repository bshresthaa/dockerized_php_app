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

        <h1>Create User</h1>

            <form METHOD = "POST" id="createAccount"> 

                <div class = "form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="your username" required>
                </div>

                <div class = "form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="your email" required>
                </div>

                <div class = "form-group">
                    <label for="Password">Password</label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                </div>

                <div class = "form-group">
                    <label for="phonenumber">Phone number</label>
                    <input type="phone" name="phonenumber" id="phonenumber" placeholder="" required>
                </div>

                <div class = "form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" name="dob" id="dob"  required>
                </div>

                <button type = "submit">Create Account</button>
                <br>
                <br>
                <a href="../index.php" class=""> Back </a>
            </form>
    </div>

</div>
</body>
<script>
    document.getElementById("createAccount").addEventListener("submit", function(e) { 
        e.preventDefault(); 

        const formData = new FormData(this); 

        fetch("register_handler.php", { 
            method : "POST",
            body : formData
        })
        .then(res=>res.json())
        .then( data=> { 
            if(data.status === "success"){ 
                window.location.href = "email_verification.php";
            } else { 
                //TODO
                alert(data.message);
            }
        })
        .catch (err=>console.error(err)); 
    }); 
</script>
</html>

