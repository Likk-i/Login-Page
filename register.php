<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $no = $_POST['phone_no'];
    $image = $_FILES['file']['tmp_name'];
    $image_name = $_FILES['file']['name'];
    $upload_image = 'images/' . $image_name;


    // Check for file upload errors
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        // Handle the file upload error
        // ...
        exit();
    }

    // File upload is successful, move the uploaded file to the desired location
    if (move_uploaded_file($image, $upload_image)) {
        // Connect to the database
        require 'includes/connection.php';

        // Check if email already exists
        $q = "SELECT * FROM data WHERE email = '$email'";
        $r = mysqli_query($conn, $q);
        if (mysqli_num_rows($r) > 0) {
            $error_message = "Email already exists. Please select another";
        } else {
            // Insert data into the database
            $query = "INSERT INTO data (name, email, username, password, image, phone_no) VALUES ('$name', '$email', '$user', '$pass', '$upload_image', '$no')";

            if (mysqli_query($conn, $query)) {
                header('Location: login.php');
                exit();
            }
        }

        mysqli_close($conn);
    } else {
        echo "Error moving uploaded file";
        exit();
    }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registration Page</title>
    <?php
        require 'includes/header.html';
   ?>

    
</head>

<body>
    <!-- Including navbar components-->
    <?php
        require 'includes/nav.php';
   ?>
    
     <?php
        require 'includes/style_r.php';
   ?>
    
    <div class="container">
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data">

                <?php if(isset($error_message)): ?>
                   <script>
               alert("<?php echo $error_message; ?>");
                </script>
              <?php endif; ?>


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="image">Image (JPG or JPEG only)</label>
                   <input type="file"  name="file" accept=".jpg, .jpeg" required>
                </div>
                <script>
                 const fileInput = document.getElementById('image');
                  fileInput.addEventListener('change', function() {
                      const file = fileInput.files[0];
                      const allowedExtensions = /(\.jpg|\.jpeg)$/i;
                      if (!allowedExtensions.exec(file.name)) {
                          alert('Only JPG or JPEG files are allowed.');
                          fileInput.value = '';
                          return false;
                      }
                  });
              </script>

                <div class="form-group">
                    <label for="phone_no">Phone Number</label>
                    <input type="text" name="phone_no" required>
                </div>
                
                <button class="button" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
  
    <!-- JavaScript Libraries -->
    <?php
        require 'includes/footer.php';
   ?>