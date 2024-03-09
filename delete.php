<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$cus_id = $_SESSION["cus_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "omakase");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_GET['delete_booking_id']) && isset($cus_id)) {

        $delete_booking_id = $_GET['delete_booking_id'];
        $sql = "SELECT seat_id FROM booking where booking_id = '$delete_booking_id'";
        $result = mysqli_query($conn, $sql);
        $seatid= mysqli_fetch_array($result);
        $seat = $seatid["seat_id"];
        $sql3 = "UPDATE seat SET seat_status = 'av' WHERE seat_id = '$seat'";
        $result3 = mysqli_query($conn, $sql3);
        $sql = "DELETE FROM booking WHERE booking_id = '$delete_booking_id'";
        echo $delete_booking_id;
        // ทำการลบการจอง
        if (mysqli_query($conn, $sql)) {
            // หากลบสำเร็จ ให้เปลี่ยนเส้นทาง URL ไปยังหน้าประวัติการจอง
            echo "<script>window.location.href = 'history.php'</script>";
        } else {
            // หากเกิดข้อผิดพลาดในการลบ ให้แสดงข้อความข้อผิดพลาด
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    ?>

</body>

</html>