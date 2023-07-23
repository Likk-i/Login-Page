
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
 
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    
    
    
    <?php
        require 'includes/nav.php';
   ?>
    <?php
        require 'includes/style_l.php';
   ?>
    <div class="container">
        <div class="form-box">
            <form method="POST" action="data.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <button class="button" name="login">Login</button>
            </form>
            <div class="link">
                <a href="register.php">Signup</a> 
                
            </div>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <?php
        require 'includes/footer.php';
   ?>