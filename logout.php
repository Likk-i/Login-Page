<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();
if(!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        include 'includes/header.html';
        include 'includes/nav.php';
        echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">You have been logged out. Please login again</div>';
        ?>
        <a href = "login.php"></a>
        <?php
        
        exit;
    }

?>


