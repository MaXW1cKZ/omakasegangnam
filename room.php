<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("localhost", "root", "", "omakase");
session_start();
$cus_id = $_SESSION["cus_id"];
$time = $_SESSION['booking_datetime'];
if (isset($_POST['sub'])) {
    $roomid = $_POST['room_id'];
    $date = $_GET['date'];
    $sqlbook  = "SELECT booking_id FROM booking WHERE timestamp = '$time'";
    $bookid = mysqli_query($conn, $sqlbook);
    $row = mysqli_fetch_assoc($bookid);
    $bookingid = $row["booking_id"];
    echo $bookingid;
    $sql = "UPDATE booking
    SET room_id = '$roomid'
    WHERE booking_id = '$bookingid'";
    $result = mysqli_query($conn, $sql);
    header("Location: seat.php?booking_id=$bookingid");
    exit();
}

$sql = "SELECT * FROM room";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');
    @font-face {
        font-family: myWebFont;
        src: url(MN\ DONBURI.ttf);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        
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
        background-color: rgb(255, 255, 255, 0.1);
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



    .all {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }

    .content {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 40px;
        padding: 40px;
    }
    h1 {
        font-family: myWebFont;

    }

    .btn.btn-outline {
        padding: 18px 30px;
        /* Adjust padding as needed */
    }

    hr {
        width: 50%;
        border: none;
        border-top: 2px solid #000000;
        /* Green border color */
        margin-top: 20px;
        margin-bottom: 20px;
    }
    p,input{
        font-family: "Noto Sans Thai", sans-serif;
    }
</style>

<body>
<header>
        <div class="logo">
            <img src="logo.png" alt="">
            <a href="home.php" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <li class="nav__item"><a href="home.php" class="nav__link">Home</a></li>
                <!-- <li class="nav__item"><a href="reservation.php" class="nav__link">Reservation</a></li> -->
                <li class="nav__item"><a href="history.php" class="nav__link">History</a></li>
                <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <div class="all">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Omakase Room</h1>
        <hr>
        <div class="content">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <form action="" method="post">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="h-64" src="<?php echo $row['room_img'] ?>" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?php echo $row['room_name'] ?></div>
                            <p class="text-gray-700 text-base"><?php echo $row['room_detail'] ?></p>
                        </div>
                        <div class="p-6 pt-0 flex justify-end">
                            <input type="hidden" name="room_id" value="<?php echo $row['room_id'] ?>">
                            <input class="btn btn-outline" type="submit" name="sub" value="จอง" class="rounded-lg bg-blue-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
</body>

</html>