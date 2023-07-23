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

<a href="logout.php" class="logout"><button>Logout</button></a>
<?php
        include 'includes/footer.php';
   ?>