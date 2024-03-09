<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// เชื่อมต่อกับฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "omakase");

// ตรวจสอบค่าที่ส่งมาจาก AJAX request
if (isset($_POST['order_id'])) {
    // รับค่า order_id
    $order_id = $_POST['order_id'];

    // ทำการอัปเดตสถานะของคำสั่งในฐานข้อมูล
    $update_query = "UPDATE orders SET order_status = 'cooking' WHERE order_id = $order_id";
    if(mysqli_query($conn, $update_query)) {
        echo "สถานะของคำสั่งถูกอัปเดตเป็น 'cooking' สำเร็จ";
        
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตสถานะของคำสั่ง: " . mysqli_error($conn);
    }
} else {
    echo "ไม่มีการส่งค่า order_id ผ่าน AJAX";
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);
?>

</body>
</html>