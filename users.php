<?php

include 'config.php';
/*
$username ="AAA";
$password = sha1("A1");
$password2= crypt("A114148148",'');
*/

$sql = "SELECT * FROM `users` WHERE email = 'v@gmail.com'  ";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    echo "<br> User Exist <br>";
    $_SESSION['user_id'] = $row['id'];
    $query = "INSERT INTO user_activity_status (user_id, status) VALUES ('$user_id', 'online') ON DUPLICATE KEY UPDATE status='online'";

    if (mysqli_query($conn, $query)) {
        echo "User status updated successfully.";
    } else {
        echo "Error updating user status: " . mysqli_error($conn);
    }}else{
        echo"user not found<br>" ;
    }
/*
    if (mysqli_num_rows($result) > 0) {
        echo "User exist";
        
    } else {

        echo $password;

        
    }*/
  


?>