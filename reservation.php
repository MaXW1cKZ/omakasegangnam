<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");
session_start();
$cus_id = $_SESSION["cus_id"];
if (isset($_POST['sub'])) {
    $conn = mysqli_connect("localhost", "root", "", "omakase");
    $date = $_POST['date'];
    $booking_datetime = date("Y-m-d H:i:s");
    // echo $booking_datetime;
    $_SESSION['booking_datetime'] = $booking_datetime;
    $sql = "INSERT INTO booking(cus_id,booking_date,timestamp) VALUES('$cus_id','$date','$booking_datetime')";
    $result = mysqli_query($conn, $sql);
    header("Location: room.php?date=$date");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Reservations</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Buhid&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

    @font-face {
        font-family: myWebFont;
        src: url(MN\ DONBURI.ttf);
    }

    @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Noto Sans Thai", sans-serif;
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

    /* ... (your existing CSS code) ... */

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
        content: '';
        /* สร้าง pseudo-element สำหรับเส้นใต้ */
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        /* ปรับความสูงของเส้นใต้ตามต้องการ */
        background-color: #eeee;
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

    @media screen and (max-width: 768px) {
        header {
            height: 48px;
            justify-content: space-between;
            padding: 0 28px;
        }

        .logo a {
            font-size: 0.9rem;
        }

        .logo img {
            width: 30px;
        }

        .header__toggle {
            display: inline;
            color: #eeee;
            font-size: 24px;
        }

        .header__close {
            position: absolute;
            right: 24px;
            display: block;
            font-size: 24px;
            border-radius: 50%;
        }

        .header__close:hover {
            background-color: #00adb5;
        }

        .nav {
            position: fixed;
            top: 0;
            right: -100%;
            background-color: #222831;
            color: #eeee;
            width: 60%;
            height: 100vh;
            padding: 24px 0;
            z-index: 100;
            transition: 0.5s;
            border-radius: 0 0 0 50%;
        }

        .nav__list {
            display: flex;
            flex-direction: column;
        }

        .nav__item {
            margin: 2rem 0;
        }

        .show {
            right: 0;
        }
    }


    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 40px;
        height: 70vh;
    }

    .date {
        width: 500px;
        height: 60px;
        padding: 8px;
        border: 1px solid black;
        border-radius: 14px;
    }

    .btn {
        display: inline-block;
        width: 200px;
        padding: 8px 16px;
        border-radius: 9px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #45a049;
        transform: scale(1.05);
        /* Slight scale up on hover */
    }

    body {
        /* display: flex;
            justify-content: center;
            align-items: center;*/
        min-height: 100vh;
        /* background-color: #000000; */
        background: url(https://images.unsplash.com/photo-1571866735550-7b1ae3bdb144?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat;
        background-size: cover;
        background-position: center;
        color: white;
    }

    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 40px;
    }
</style>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="">
            <a href="" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <li class="nav__item"><a href="home.php" class="nav__link">Home</a></li>
                <!-- <li class="nav__item"><a href="#" class="nav__link">Reservation</a></li> -->
                <li class="nav__item"><a href="history.php" class="nav__link">History</a></li>
                <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <div class="content">
        <br><br><br>
        <h1 class="text-6xl">เลือกวันจอง</h1>
        <form action="" method="POST" class="form">
            <div>
                <label for="date" class="">Date - Required</label><br>
                <input type="date" id="date" class="date" name="date" style="color:black;">
            </div>
            <button name="sub" class="btn btn-primary">ยืนยัน</button>
        </form>
        <p class="" style="text-align: center;">Gangnam Omakase คือที่ที่เราไม่เพียงแค่สัมผัสรสชาติ <br> แต่ยังสัมผัสความอบอุ่นและความสุขที่มาพร้อมกับบรรยากาศและการบริการที่ดี"</p>
    </div>
</body>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("date").setAttribute("min", today);
    const navMenu = document.getElementById('nav-menu'),
        toggleMenu = document.getElementById('toggle-menu'),
        closeMenu = document.getElementById('close-menu')

    toggleMenu.addEventListener('click', () => {
        navMenu.classList.toggle('show')
    })
    closeMenu.addEventListener('click', () => {
        navMenu.classList.remove('show')
    })
</script>

</html>