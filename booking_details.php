<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$cus_id = $_SESSION["cus_id"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>ประวัติการจอง</title>
    <style>

        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

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
            /*พื้นหลัง*/
            color: black;
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
            padding-left: 20%;
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

        .content {
            height: 100vh;
            background-image: url("https://i.pinimg.com/564x/6f/b1/e4/6fb1e474e6cf56f7fea5497d6be661b3.jpg");
            /* background-color: rgb(98, 195, 252); */
            object-fit: cover;
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .detail {
            width: 500px;
            background-color: aliceblue;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 30px;
            border-radius: 10px;
        }

        .detail p {
            margin: 5px;
        }

        .pro {
            margin-top: 20px;
            padding: 0px 30px;
            width: 100%;
            /* background-color: aquamarine; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
<header>
        <div class="logo">
            <img src="logo.png"
                alt="">
            <a href="home.php" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <li class="nav__item"><a href="home.php" class="nav__link">Home</a></li>
                <li class="nav__item"><a href="reservation.php" class="nav__link">Reservation</a></li>
                <li class="nav__item"><a href="history.php" class="nav__link">History</a></li>
                <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <div class="content">
        <div class="detail">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "omakase");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_GET['booking_id'])) {
                $booking_id = $_GET['booking_id'];

                $sql = "SELECT booking.booking_id, customers.first_name, customers.last_name, booking.booking_date, booking.total_price, booking.booking_status, booking.course_id, booking.seat_id, course.course_name, room.room_name
                        FROM booking 
                        JOIN customers ON booking.cus_id = customers.cus_id 
                        JOIN course ON booking.course_id = course.course_id
                        JOIN room ON booking.room_id = room.room_id
                        WHERE booking.booking_id = '$booking_id';";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Check if booking status is 'checked' to allow cancellation
            ?>

                    <h1 style="margin-top: 5px; margin-bottom: 10px; font-size: 18px; background-color: #f8dc96; width: 100%; text-align: center; border-radius: 20px;">รายละเอียดการจอง</h1>
                    <p style="margin-top: 20px;"><?php echo "Booking ID : " . $row['booking_id'] ?></p>
                    <p><?php echo "ชื่อ : " . $row['first_name'] . " " . $row['last_name'] ?></p>
                    <p style="margin-bottom: 10px;"><?php echo "วันที่จอง : " . $row['booking_date'] ?></p>
                    <div class="pro">
                        <p>Course : </p>
                        <p><?php echo $row['course_name'] ?></p>
                    </div>
                    <div class="pro">
                        <p>Room ID : </p>
                        <p><?php echo $row['room_name'] ?></p>
                    </div>
                    <div class="pro">
                        <p>Seat ID : </p>
                        <p><?php echo $row['seat_id'] ?></p>
                    </div>
                    <p style="margin-top: 20px;">ราคา: <?php echo $row['total_price'] ?></p>
                    <p style="color: Blue">Status: <?php echo $row['booking_status'] ?> </p>

                    <?php


                    ?>
                    <?php
                    if ($row['booking_status'] != 'checked') {
                    ?>
                        <form action="delete.php" method="get">
                            <input type="text" name="customer_id" value="<?php echo $cus_id; ?>" class="hidden">
                            <input type="hidden" name="delete_booking_id" value="<?php echo $row['booking_id']; ?>">
                            <button type="submit" onclick="return confirm('คุณต้องการยกเลิกการจองนี้ ?')" style="width: 100%; margin-top: 10px; background-color: #91FFC0; padding: 8px; width: 150px; border-radius: 10px; color: rgb(22, 21, 21)">ยกเลิกการจอง</button>
                        </form>
            <?php
                    }
                }
            }

            ?>


            <a href="history.php">
                <button style="width: 100%; margin: 20px; background-color: #72bfeb; padding: 8px; width: 150px; border-radius: 10px; color: rgb(22, 21, 21)">ย้อนกลับ</button>
            </a>
        </div>
    </div>

    <?php

    mysqli_close($conn);
    ?>


</body>

</html>