<?php
include 'config.php'; 

$user_id = $_SESSION['user_id'];

$query = "SELECT status FROM user_activity_status WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];
    echo $status;
} else {
    
    echo 'offline';
}
?>
