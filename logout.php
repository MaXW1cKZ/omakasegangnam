<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session
session_destroy(); 
// Destroy all sessions
// $conn = mysqli_connect("localhost", "root", "", "omakase");
// $book_id = $_SESSION['book_id'];
// $sql = "SELECT booking_status FROM booking where booking_id = '$book_id";
// echo $sql;
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($result);
// $booking_status = $row['$booking_status'];
// if ($booking_status == 'null') {
//     $sql1 = "DELETE * FROM booking where booking_id = '$book_id'";
//     $result1 = mysqli_query($conn, $sql1);
//     // 
// }


header("Location: login.php"); // Redirect to login page after logout
exit;
?>
