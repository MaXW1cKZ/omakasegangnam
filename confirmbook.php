<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("localhost", "root", "", "omakase");
// session_start();
// $cus_id = $_SESSION["cus_id"];
$bookingid = $_GET['booking_id'];
$sql = "SELECT * FROM booking 
JOIN course
JOIN customers
ON booking.course_id = course.course_id
AND customers.cus_id = booking.cus_id
WHERE booking.booking_id = '$bookingid'";
$result = mysqli_query($conn, $sql);
$seat = "SELECT seat_id from booking where booking_id = '$bookingid'";
$resultseat = mysqli_query($conn, $seat);
$seatid = mysqli_fetch_array($resultseat);
$seat = $seatid["seat_id"];

if (isset($_POST["sub"])) {
    $sql1 = "UPDATE booking SET booking_status = 'booking' WHERE booking_id = '$bookingid'";
    $sql2 = "UPDATE seat SET seat_status = 'uv' WHERE seat_id = '$seat'";
    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    echo '<script>alert("ยืนยันการจองสำเร็จ");';
    echo 'window.location.href = "home.php";';
    echo '</script>';
}
if (isset($_POST["cancel"])) {
    $sql2 = "DELETE FROM booking WHERE booking_id = '$bookingid'";
    $result2 = mysqli_query($conn, $sql2);
    echo '<script>alert("ยกเลิกการจองสำเร็จ");';
    echo 'window.location.href = "home.php";';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>booking confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        body {
            min-height: 100vh;
            /* background-color: whitesmoke; */
            /* background: url(https://images.unsplash.com/photo-1571866735550-7b1ae3bdb144?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat; */
            background-size: cover;
            background-position: center;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
        }

        a {
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        header {
            display: flex;
            padding: 1rem 0;
            align-items: center;
            width: 100%;
            /* background-color: rgb(255, 255, 255, 0.1); */
            /* background-color: black; */
            color: black;
            /*พื้นหลัง*/
        }

        .logo {
            width: 50%;
            display: flex;
            align-items: center;
            padding-left: 4%;
        }

        .logo img {
            width: 50px;
            border-radius: 50%;
            margin-right: 10px;

        }

        .header__logo {
            color: black;
            font-weight: 600;
        }

        .nav {
            width: 50%;
            padding-left: 26%;
            padding-right: 3%;
        }

        .nav__list {
            display: flex;
        }

        .nav__item {
            margin: 0 14px;
        }

        /* ... (your existing CSS code) ... */

        .nav__link {
            padding: 10px 0px 5px 0px;
            margin-left: 10px;
            color: black;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 5px;
            position: relative;
        }

        .nav__link::after {
            content: '';
            /* สร้าง pseudo-element สำหรับเส้นใต้ */
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            /* ปรับความสูงของเส้นใต้ตามต้องการ */
            background-color: black;
            transform: scaleX(0);
            /* ตั้งค่าเริ่มต้นให้เส้นใต้มีความกว้างเป็นศูนย์ */
            transform-origin: bottom right;
            transition: transform 0.5s ease;
            /* เพิ่ม transition property */
        }

        .nav__link:hover::after {
            transform: scaleX(1);
            /* ขยายเส้นใต้เมื่อวางเมาส์ */
            transform-origin: bottom left;
        }

        .header__toggle,
        .header__close {
            display: none;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #45a049;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #34C83E;
            transform: scale(1.05);
            /* Slight scale up on hover */
        }

        .btn-secondary {
            background-color: #F45348;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #da190b;
            transform: scale(1.05);
        }

        .all {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }

        hr {
            width: 100%;
            border: none;
            border-top: 2px solid #000000;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        span,h5,strong{
            font-family: "Noto Sans Thai", sans-serif;

        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="">
            <a href="" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <li class="nav__item"><a href="#" class="nav__link">Home</a></li>
                <!-- <li class="nav__item"><a href="reservation.php" class="nav__link">Reservation</a></li> -->
                <li class="nav__item"><a href="history.php" class="nav__link">History</a></li>
                <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <div class="all">
        <div class="container mx-auto" style="display: flex; justify-content: center; align-items: center;">
            <div style="width: 725px; border-radius: 15px 0px 0px 15px; height:500px" class="shadow-lg hover:shadow-xl">
                <img style="border-radius: 15px 0px 0px 15px; width: 100%; height: 100%;" src="https://images.unsplash.com/photo-1681270496598-13c5365730c8?q=80&w=3090&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            </div>
            <div class="max-w-md bg-white shadow-lg hover:shadow-xl transition duration-300 p-10" style="background-color: #D6D6D676;  border-radius: 0px 15px 15px 0px; width: 300px; height: 500px">
                <h5 class="mb-4 text-2xl font-bold text-left text-gray-900">Booking Confirmation</h5>
                <ul class="text-lg text-gray-700">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <p><strong style="display: inline-block; font-size: 16px; ">Booking ID </strong><span style="float: right;"><?php echo $row['booking_id'] ?></span></span></p>
                        <p><strong style="display: inline-block; font-size: 16px;">ชื่อ</strong> <span style="float: right;"> <?php echo $row['first_name'] . " " . $row['last_name'] ?></span></p>
                        <p><strong style="display: inline-block; font-size: 16px;">คอร์ส</strong> <span style="float: right;"> <?php echo $row['course_name'] ?></span></p>
                        <p><strong style="display: inline-block; font-size: 16px;">ห้อง</strong> <span style="float: right;"> <?php echo $row['room_id'] ?></span></p>
                        <p><strong style="display: inline-block; font-size: 16px;">เลขที่นั่ง</strong> <span style="float: right;"> <?php echo $row['seat_id'] ?></span></p>
                        <hr>
                        <p><strong style="display: inline-block; font-size: 16px;">วันที่</strong> <span style="float: right;">เวลา</span></p>
                        <p><strong style="display: inline-block; font-size: 16px;"><?php echo $row['booking_date'] ?></strong> <span style="float: right;"> 12:00</span></p>
                        <hr>
                        <p><strong style="display: inline-block; font-size: 16px;">ราคา</strong> <span style="float: right;"> <?php echo $row['total_price'] ?> บาท</span></p>
                    <?php } ?>
                </ul>
                <form action="" method="post">
                    <div class="flex justify-between mt-5">
                        <button name="cancel" class="btn btn-secondary">ยกเลิก</button>
                        <button name="sub" class="btn btn-primary">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>