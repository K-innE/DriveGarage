<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id']; 
mysqli_query($conn, "UPDATE user_activity_status SET status='offline' WHERE user_id='$user_id'");

session_unset();
session_destroy();

header('location:log_in.php');
exit();
?>