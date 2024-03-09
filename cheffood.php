<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");
$conn = mysqli_connect("localhost", "root", "", "omakase");

$room = $_POST['room_id'];
// echo $room;

$currentDate = date("Y-m-d");

// ค้นหา booking_id ที่มี booking_date เท่ากับวันปัจจุบัน
$bookdate_query = "SELECT booking_id FROM booking WHERE booking_date = '$currentDate'";
$bookdate_result = mysqli_query($conn, $bookdate_query);
// ถ้ามีการค้นพบ booking_id ในวันนี้
if (mysqli_num_rows($bookdate_result) > 0) {
    // สร้างอาร์เรย์เก็บ booking_id
    $booking_ids = [];

    // เก็บ booking_id ลงในอาร์เรย์
    while ($row = mysqli_fetch_assoc($bookdate_result)) {
        $booking_ids[] = $row['booking_id'];
    }

    // แปลงอาร์เรย์เป็น string สำหรับใช้ในคำสั่ง SQL
    $booking_ids_str = implode(",", $booking_ids);

    // ค้นหาข้อมูลในตาราง order โดยใช้ booking_id ที่ได้มา
    $wait_query = "SELECT * FROM orders 
               JOIN booking 
               JOIN course
               ON orders.booking_id = booking.booking_id 
               AND orders.course_id = course.course_id
               WHERE booking.booking_id IN ($booking_ids_str) 
               AND orders.order_status = 'wait'
               AND booking.room_id = $room";
    $wait_result = mysqli_query($conn, $wait_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu to do</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
        }

        body {
            background-image: url('1.jpg');
        }

        /* menubar */
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
            background-color: rgb(28, 0, 84)
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
            color: #eeee;
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

        .nav__link {
            padding: 10px 0px 5px 0px;
            margin-left: 10px;
            color: #eeee;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 5px;
            position: relative;
        }

        .nav__link::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #eeee;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.5s ease;
        }

        .nav__link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .header__toggle,
        .header__close {
            display: none;
        }

        

        /* เนื้อหา */
        .content {
            padding: 0px 20px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;

        }

        .content div {
            border-radius: 10px;
            margin: 4px 10px;
            padding: 11px;
            overflow-y: auto;
            max-height: 550px;
        }

        .menu-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-height: calc(100% - 40px);
            /* Adjust according to your design */
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="" />
            <a href="" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <li class="nav__item"><i style="color: aliceblue;" class="fa-solid fa-cookie-bite"></i></li>
                <li class="nav__item">
                    <a href="chefroom.php" class="nav__link">Room</a>
                </li>
                <li class="nav__item"><a href="login.php" class="nav__link">Logout</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>

    <div style="padding: 20px 80px;">
        <h2 style="padding: 10px 0px;">รายละเอียดเมนู</h2>
        <p>วันที่ <?php echo $currentDate ?></p>
    </div>
    <div class="content">

        <div class="wait" style="background-color: rgba(247, 200, 196, 0.26);">
            <p style="padding: 10px 20px;">เมนูที่ต้องทำ</p>
            <?php
            while ($row = mysqli_fetch_assoc($wait_result)) { ?>
                <div class="menu-card" style="background-color: rgba(249, 69, 60, 0.196); font-size: 12px">
                    <form action="" style="display: flex; align-items: center; gap: 10px; width: 350px;" method="post">
                        <input type="checkbox" name="order_id" value="<?php echo $row['order_id'] ?>" onchange="waitingStatus(this)">
                        <label style="width: 110px;  for=""><?php echo $row['menu_name'] ?></label>
                        <p style=" width: 120px;"> <?php echo $row['course_name'] ?></p>
                            <p style="width: 90px;">ที่นั่ง : <?php echo $row['seat_id'] ?></p>
                    </form>
                    <p style="background-color: rgb(244, 255, 86); padding: 3px; font-size: 11px; border-radius: 10px;">Waiting</p>
                </div>
            <?php } ?>
        </div>

        <?php
        $currentDate = date("Y-m-d");

        // ค้นหา booking_id ที่มี booking_date เท่ากับวันปัจจุบัน
        $bookdate_query = "SELECT booking_id FROM booking WHERE booking_date = '$currentDate'";
        $bookdate_result = mysqli_query($conn, $bookdate_query);

        if (mysqli_num_rows($bookdate_result) > 0) {
            // สร้างอาร์เรย์เก็บ booking_id
            $booking_ids = [];

            // เก็บ booking_id ลงในอาร์เรย์
            while ($row = mysqli_fetch_assoc($bookdate_result)) {
                $booking_ids[] = $row['booking_id'];
            }

            // แปลงอาร์เรย์เป็น string สำหรับใช้ในคำสั่ง SQL
            $booking_ids_str = implode(",", $booking_ids);

            // ค้นหาข้อมูลในตาราง order โดยใช้ booking_id ที่ได้มา
            $cooking_query = "SELECT * FROM orders 
                           JOIN booking 
                           JOIN course
                           ON orders.booking_id = booking.booking_id 
                           AND orders.course_id = course.course_id
                           WHERE booking.booking_id IN ($booking_ids_str) 
                           AND orders.order_status = 'cooking'
                           AND booking.room_id = $room";

            $cooking_result = mysqli_query($conn, $cooking_query);
        }
        ?>


        <div class="cooking" style="background-color: rgba(247, 244, 196, 0.266);">
            <p style="padding: 10px 20px;">เมนูที่กำลังทำอยู่</p>
            <?php
            while ($row = mysqli_fetch_assoc($cooking_result)) { ?>

                <div class="menu-card" style="background-color: #FFD608; font-size: 12px;">
                    <form action="" style="display: flex; align-items: center; gap: 10px; ">
                        <input type="checkbox" name="order_id" value="<?php echo $row['order_id'] ?>" onchange="cookingStatus(this)">
                        <label style="width: 100px;  for=""><?php echo $row['menu_name'] ?></label>
                    <p style=" width: 90px;"> <?php echo $row['course_name'] ?></p>
                            <p>ที่นั่ง : <?php echo $row['seat_id'] ?></p>
                    </form>
                    <p style="background-color: rgb(244, 255, 86); padding: 3px; font-size: 11px; border-radius: 10px;"><?php echo $row['order_status'] ?></p>
                </div>

            <?php } ?>
        </div>

        <?php
        $currentDate = date("Y-m-d");

        // ค้นหา booking_id ที่มี booking_date เท่ากับวันปัจจุบัน
        $bookdate_query = "SELECT booking_id FROM booking WHERE booking_date = '$currentDate'";
        $bookdate_result = mysqli_query($conn, $bookdate_query);

        if (mysqli_num_rows($bookdate_result) > 0) {
            // สร้างอาร์เรย์เก็บ booking_id
            $booking_ids = [];

            // เก็บ booking_id ลงในอาร์เรย์
            while ($row = mysqli_fetch_assoc($bookdate_result)) {
                $booking_ids[] = $row['booking_id'];
            }

            // แปลงอาร์เรย์เป็น string สำหรับใช้ในคำสั่ง SQL
            $booking_ids_str = implode(",", $booking_ids);

            // ค้นหาข้อมูลในตาราง order โดยใช้ booking_id ที่ได้มา
            $cooked_query = "SELECT * FROM orders 
                           JOIN booking 
                           JOIN course
                           ON orders.booking_id = booking.booking_id 
                           AND orders.course_id = course.course_id
                           WHERE booking.booking_id IN ($booking_ids_str) 
                           AND orders.order_status = 'cooked'
                           AND booking.room_id = $room";

            $cooked_result = mysqli_query($conn, $cooked_query);
        }
        ?>

        <div class="finish" style="background-color: white;">
            <p style="padding: 10px 20px;">เมนูที่ทำเสร็จเเล้ว</p>

            <?php
            while ($row = mysqli_fetch_assoc($cooked_result)) { ?>

                <div class="menu-card" style=" font-size: 12px;">
                    <form action="" style="display: flex; align-items: center; gap: 10px; justify-content: space-between; width: 90%">
                        <label style="width: 130px;" for=""><?php echo $row['menu_name'] ?></label>
                        <p style="width: 120px;"> <?php echo $row['course_name'] ?></p>
                        <p style="width: 50px;">ที่นั่ง : <?php echo $row['seat_id'] ?></p>
                    </form>
                    <!-- <p style="background-color: rgb(103, 255, 86); padding: 4px; font-size: 10px; border-radius: 10px;"><?php echo $row['order_status'] ?></p> -->
                </div>
            <?php } ?>
        </div>

    </div>


    <script>
        const navMenu = document.getElementById('nav-menu'),
            toggleMenu = document.getElementById('toggle-menu'),
            closeMenu = document.getElementById('close-menu')

        toggleMenu.addEventListener('click', () => {
            navMenu.classList.toggle('show')
        })
        closeMenu.addEventListener('click', () => {
            navMenu.classList.remove('show')
        })

        function waitingStatus(checkbox) {
            // ตรวจสอบว่า checkbox ถูกเลือกหรือไม่
            if (checkbox.checked) {
                var order_id = checkbox.value; // รับค่า order_id จาก checkbox
                var xhttp = new XMLHttpRequest(); // สร้าง XMLHttpRequest object
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText); // แสดงข้อมูลที่ได้จากการอัปเดต
                    }
                };
                // สร้าง request เพื่อส่งข้อมูลไปยังไฟล์ PHP ที่ใช้ในการอัปเดต
                xhttp.open("POST", "update_waiting_status.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("order_id=" + order_id);
                window.location.reload();

            }

        }

        function cookingStatus(checkbox) {
            // ตรวจสอบว่า checkbox ถูกเลือกหรือไม่
            if (checkbox.checked) {
                var order_id = checkbox.value; // รับค่า order_id จาก checkbox
                var xhttp = new XMLHttpRequest(); // สร้าง XMLHttpRequest object
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText); // แสดงข้อมูลที่ได้จากการอัปเดต
                    }
                };
                // สร้าง request เพื่อส่งข้อมูลไปยังไฟล์ PHP ที่ใช้ในการอัปเดต
                xhttp.open("POST", "update_cooking_status.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("order_id=" + order_id); // ส่ง order_id ไปยังไฟล์ update_cooking_status.php
                window.location.reload();
            }
        }
    </script>

</body>

</html>