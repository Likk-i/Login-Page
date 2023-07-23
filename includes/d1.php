<?php
$query = "SELECT * FROM data";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0 && isset($email) && isset($username)) {
    include 'header.html';
    include 'nav.php';
    echo '<div style="background-color: #F7350C; color: white; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px; display: flex; justify-content: center; align-items: center; ">No records found</div>';
    mysqli_close($conn);
    exit();
}
mysqli_close($conn);
?>
