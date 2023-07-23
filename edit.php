<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['edit'])) {
    $db_host = "localhost";
    $db_name = "registration_details";
    $db_pass = "root";
    $db_user = "root";

    $email = $_POST['email'];
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_error()) {
        echo "Connection failed: " . mysqli_connect_error();
        exit();
    } else {
        $query = "SELECT * FROM data WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result); // Fetch the row
             include 'includes/header.html';
             include 'includes/nav.php';
             echo '<style>
        body {
            background-image: url("img/table copy.webp");
            background-repeat: no-repeat;
            background-size: cover;
        }
        </style>';
            
            
            echo "<form method='POST' enctype='multipart/form-data' action='submit.php' onsubmit='return validateForm()'>";
            echo "<input type='hidden' name='hidden_email' value='" . $row['email'] . "'>"; 
            // Add the hidden input field
            echo "<label for='name' style='color: white;'>Name:</label>";
            echo "<textarea name='name' placeholder='" . $row['name'] . "' required></textarea><br>";
            echo "<label for='email' style='color: white;'>Email:</label>";
            echo "<textarea name='email' placeholder='" . $row['email'] . "' required></textarea><br>";
            echo "<label for='username' style='color: white;'>Username:</label>";
            echo "<textarea name='username' placeholder='" . $row['username'] . "' required></textarea><br>";
            echo "<label for='password' style='color: white;'>Password:</label>";
            echo "<textarea name='password' placeholder='" . $row['password'] . "' required></textarea><br>";
            echo "<label for='file' style='color: white;'>File:</label>";
            echo '<input type="file" name="file" ><br>'; // Input field for image upload
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="User Image" class="user-image"><br>'; // Show previous image
            echo "<label for='phone_no' style='color: white;'>Phone number:</label>";
            echo "<textarea name='phone_no' placeholder='" . $row['phone_no'] . "' required></textarea><br>";
            echo "<input type='submit' name='submit' value='Submit'>";
            echo "</form>";
            //echo "</div>";

            // CSS style for .user-image class
            echo "<style>.user-image {
                max-width: 100px;
                max-height: 100px;
            }</style>";

           echo "<script>
    const fileInput = document.querySelector('input[name=file]');
    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        const allowedExtensions = /(\.jpg|\.jpeg)$/i;
        if (!allowedExtensions.exec(file.name)) {
            alert('Only JPG or JPEG files are allowed.');
            fileInput.value = '';
            return false;
        }
    });

    function validateForm() {
        var name = document.getElementsByName('name')[0].value;
        var email = document.getElementsByName('email')[0].value;
        var username = document.getElementsByName('username')[0].value;
        var password = document.getElementsByName('password')[0].value;
        var phoneNo = document.getElementsByName('phone_no')[0].value;

        // Validate phone number format
        var phoneRegex = /^\d+$/;
        if (!phoneRegex.test(phoneNo)) {
            alert('Please enter a valid phone number (digits only).');
            return false;
        }

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        var nameRegex = /^[A-Za-z]+$/;
        if (!nameRegex.test(name)) {
            alert('Please enter a valid name (only alphabets are allowed).');
            return false;
        }

        if (name === '' || email === '' || username === '' || password === '' || phoneNo === '') {
            alert('Please fill in all fields.');
            return false;
        }

        return true;
    }

    
    }
</script>";

        }
    }
}
?>
