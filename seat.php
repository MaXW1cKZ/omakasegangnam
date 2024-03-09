<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$con = mysqli_connect("localhost", "root", "", "omakase");
$bookingid = $_GET['booking_id'];
$sql = "SELECT room_id from booking WHERE booking_id = '$bookingid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$room_id = $row['room_id'];
$seatsql = "SELECT * FROM seat WHERE room_id = '$room_id'";
$seatresult = mysqli_query($con, $seatsql);
$chefsql = "SELECT * FROM chef WHERE room_id = '$room_id'";
$chefresult = mysqli_query($con, $chefsql);
if (isset($_POST['sub'])) {
    $seat = $_POST['seat'];
    $sql = "UPDATE booking
    SET seat_id = '$seat'
    WHERE booking_id = '$bookingid'";
    $result = mysqli_query($con, $sql);
    header("Location: course.php?booking_id=$bookingid");
    exit(); // echo $sql;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Book</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

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
        color: white;
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
        color: white;
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
        background-color: white;
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

    @font-face {
        font-family: myWebFont;
        src: url(MN\ DONBURI.ttf);
    }

    body {
        height: 100%;
        background: -moz-linear-gradient(top, #2B303A 50%, white 50%);
        background: -webkit-linear-gradient(top, #2B303A 50%, white 50%);
        background: linear-gradient(to bottom, #2B303A 50%, white 50%);
    }


    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 20px;
    }

    button {
        /* padding: 10px; */
        font-size: 12px;
        /* font-size: 20px; */
        height: 40px;
        border-radius: 9px;
    }

    button:hover {
        background-color: black;
        color: white;
    }

    .seat {
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }

    .seat input[type='radio'] {
        display: none;

    }

    .seat input[type='radio']+label {
        display: block;
        cursor: pointer;
        width: 100%;
        height: 100%;
        text-align: center;
        line-height: 40px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .seat.av label {
        background-color: black;
        color: black;
    }

    .seat input[type='radio']:checked+label {
        background-color: #B3FFAE;
        color: black;

    }

    .seat input[type='radio']:disabled+label {
        background-color: #FF6464;
        color: white;
        cursor: not-allowed;
    }

    form {
        /* background-color: #000000DA; */
        width: 450px;
        /* height: 200px; */
        padding: 5px 20px;
        border-radius: 12px;
    }

    #seatt {
        /* background-color: #3543FFF1; */
        border: 1px solid black;
        border-radius: 10px;
        color: black;
        width: 700px;
        height: 40px;
        padding: 10px;
    }

    .table {
        background-color: #FFAB35F1;
        color: #2B303A;
        width: 670px;
        padding: 30px;
        border-radius: 50px;
    }

    .chef {
        width: 800px;
    }
    p{
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
    <div class="container mx-auto py-8 content">
        <div class="text-center mb-3">
            <h2 class="text-4xl font-bold text-white" style="font-family: myWebFont;">ข้อมูลเชฟประจำห้อง</h2>
        </div>
        <?php while ($row = $chefresult->fetch_assoc()) { ?>
            <div class="chef bg-white rounded-xl shadow-md overflow-hidden grid grid-cols-2 gap-4 p-8 shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                <div class="img">
                    <img src="<?php echo $row['chef_img'] ?>" class="h-72 w-full object-cover rounded-xl" alt="">
                </div>
                <div>
                    <p><?php echo $row['first_name'] . " " . $row['last_name'] ?></p>
                    <p><?php echo $row['chef_detail'] ?></p>
                </div>
            </div>
        <?php } ?><br>
        <div class="text-4xl font-extrabold dark:text-white">
            <h1 style="font-family: myWebFont;" class="text-4xl">จองที่นั่ง</h1>
        </div>
        <div class="table">
            <h2>Table</h2>
        </div>
        <form action="" method="post" class="form">
            <div class="grid grid-cols-5 gap-4 seat">
                <?php while ($row = $seatresult->fetch_assoc()) { ?>
                    <div class="flex items-center justify-center">
                        <?php if ($row['seat_status'] == 'uv') { ?>
                            <input type="radio" name="seat" value="<?php echo $row['seat_id']; ?>" id="<?php echo $row['seat_id']; ?>" class="<?php echo $row['seat_status'] ?>" disabled />
                        <?php } else { ?>
                            <input type="radio" name="seat" value="<?php echo $row['seat_id']; ?>" id="<?php echo $row['seat_id']; ?>" class="<?php echo $row['seat_status'] ?>" />
                        <?php } ?>
                        <label for="<?php echo $row['seat_id']; ?>" class="ml-2 bg-slate-300"><?php echo $row['seat_id']; ?></label>
                    </div>
                <?php } ?>
            </div><br>
            <div class="flex justify-center">
                <p id="seatt" style="font-size:16px; text-align: left;">เลขที่นั่ง</p>
            </div>
            <div class="mt-8 flex justify-center" style="gap: 20px;">
                <a href="javascript:history.go(-1);" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-400">Back</a>
                <button type="reset" class="bg-gray-300 text-gray-700 py-2 px-4 rounded ml-2 hover:bg-gray-400">ล้าง</button>
                <button type="submit" name="sub" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">ยืนยัน</button>
            </div>
        </form>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const seats = document.querySelectorAll('.seat input[type="radio"]');
        seats.forEach(seat => {
            seat.addEventListener('change', (event) => {
                const selectedSeat = event.target.value;
                const seatText = document.getElementById('seatt');
                seatText.innerHTML = "เลขที่นั่ง " + selectedSeat;
            });
        });

        // เพิ่มการดักจับเหตุการณ์เมื่อคลิกที่ปุ่ม Reset
        const resetButton = document.querySelector('button[type="reset"]');
        resetButton.addEventListener('click', () => {
            const seatText = document.getElementById('seatt');
            seatText.textContent = 'เลขที่นั่ง'; // ลบข้อความออก
        });
    });
</script>

</html>