<?php
session_start();
// Set session timeout to 30 minutes

$sessionTimeout = 1800; // 30 minutes

// Set session garbage collection lifetime
ini_set('session.gc_maxlifetime', $sessionTimeout);

// Start or resume the session
session_start();

// Set the session cookie lifetime to match the session timeout
session_set_cookie_params($sessionTimeout);

// Initialize last activity time if not already set
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

// Rest of your code...

// Assign session variables only if they are not already set


// Redirect the user to the login page if not logged in
// Assign session variables only if they are not already set
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) {
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        
        
    } else {
        include 'includes/header.html';
        include 'includes/nav.php';
        echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">Your session has expired. Please login again</div>';
        exit;
    }
}
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $sessionTimeout) {
    session_unset();
    session_destroy();
    include 'includes/header.html';
    include 'includes/nav.php';
    echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">Your session has expired. Please login again</div>';
    exit;
}

// Update the user's last activity time
$_SESSION['last_activity'] = time();
    
    // Connecting to the database
    include 'includes/connection.php';



    if (isset($_GET['delete'])) {
        $deleteEmail = $_GET['delete'];
        $_SESSION['deleteEmail'] = $deleteEmail;
        $q = "DELETE FROM data WHERE email='$deleteEmail'";
        $r = mysqli_query($conn, $q);

        if ($r) {
            echo '<script>alert("Records have been deleted.");</script>';
        } else {
            echo '<script>alert("Error deleting records.");</script>';
        }
        $query = "SELECT * FROM data";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0) {
    include 'includes/header.html';
    include 'includes/nav.php';
    echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">No records found</div>';
    mysqli_close($conn);

    exit();
}
         

include 'includes/d2.php';
    exit();


       }

$email = $_SESSION['email'];
$username = $_SESSION['username'];
$q = "SELECT username, email FROM data WHERE email = '$email' AND username = '$username'";
$r = mysqli_query($conn, $q);

 if(mysqli_num_rows($r) == 0){
    include 'includes/header.html';
    include 'includes/nav.php';
    session_unset();
    session_destroy();
    echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">Invalid Username or Password</div>';
    exit();
}
$query = "SELECT * FROM data";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0 && isset($email) && isset($username)) {
    include 'includes/header.html';
    include 'includes/nav.php';
    echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">No records found</div>';
    mysqli_close($conn);

    exit();
}


    

    

    mysqli_close($conn);

    
?>

<!-- Rest of the HTML code -->


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title>Information</title>
   <?php
        include 'includes/header.html';
   ?>
   <?php
        include 'includes/style_d.php';
   ?>
   
</head>
<body>
    <?php
        include 'includes/nav.php';
   ?>
<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['email'])) 
{   echo '<div class="login-message">';
    echo 'You are not logged in. Please log in to view the table.';
    echo '</div>';
    exit();
} 
else{
if (mysqli_num_rows($result) > 0) {
    echo '<table id="myTable">';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Username</th>';
    echo '<th>Password</th>';
    echo '<th>Image</th>';
    echo '<th>Phone Number</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {
       echo '<tr>';
echo '<td><strong>' . $row['name'] . '</strong></td>';
echo '<td><strong>' . $row['email'] . '</strong></td>';
echo '<td><strong>' . $row['username'] . '</strong></td>';
echo '<td><strong>' . $row['password'] . '</strong></td>';
echo '<td><img src="' . htmlspecialchars($row['image']) . '" alt="User Image" class="user-image"></td>';



echo '<td><strong>' . $row['phone_no'] . '</strong></td>';
echo '<td>';
echo '<div class="button-group">';
echo '<form method="POST" style="display: inline;" action="edit.php">';
echo '<input type="hidden" name="email" value="' . $row['email'] . '">';
echo '<button type="submit" name="edit">Edit</button>';
echo '</form>';
echo '<form method="GET" style="display: inline;">';
echo '<button type="submit" name="delete" value="' . $row['email'] . '">Delete</button>';
echo '</form>';
echo '</div>';
echo '</td>';
echo '</tr>';

    }

    echo '</table>';
}

mysqli_close($conn);
}

?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
<a href="logout.php" class="logout"><button>Logout</button></a>
<?php
        include 'includes/footer.php';
   ?>