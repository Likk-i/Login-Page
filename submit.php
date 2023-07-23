 <?php
  
 if (isset($_POST['submit'])) {
  $hidden_email = $_POST['hidden_email'];
    

    
        include 'includes/connection.php';
   
    $email = $_POST['email'];
    $check_query = "SELECT * FROM data WHERE email = '$email' AND email != '$hidden_email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        include 'includes/header.html';
        include 'includes/nav.php';
       echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">Email ID already exists. Please select other</div>';
        exit();
    }
            
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone_no = $_POST['phone_no'];
            $image = $_FILES['file'];
            $image_name = $image['name'];
            $upload_image = 'images/' . $image_name;

            // Check for file upload errors
            if ($image['error'] !== UPLOAD_ERR_OK) {
                echo "Error uploading file: ";
                switch ($image['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        echo "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        echo "The uploaded file was only partially uploaded";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        echo "No file was uploaded";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        echo "Missing a temporary folder";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        echo "Failed to write file to disk";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        echo "File upload stopped by extension";
                        break;
                    default:
                        echo "Unknown error";
                        break;
                }
                exit();
            }
            
            // File upload is successful, move the uploaded file to the desired location
            if (move_uploaded_file($image['tmp_name'], $upload_image)) {
                $q = "UPDATE data SET name = '$name', email = '$email', username = '$username', password='$password',  image = '$upload_image', phone_no = '$phone_no'  WHERE email = '$hidden_email'";
                $r = mysqli_query($conn, $q);
                if ($r) {
                    header('Location: data.php');
                    exit();
                } else {
                   
                    echo "Error updating data: " . mysqli_error($conn) . "<br>";
echo "Query: " . $q;

                }
            } else {
                echo "Error moving uploaded file";
                exit();
            }
        }