<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("localhost", "root", "", "omakase");
if (isset($_POST['sub'])) {
    $course_id = $_POST['course_id'];
    $bookingid = $_GET['booking_id'];
    $course = "SELECT price FROM course";
    $resultprice = mysqli_query($conn, $course);
    $row = mysqli_fetch_assoc($resultprice);
    $price = $row["price"];
    $sql = "UPDATE booking
    SET course_id = '$course_id',total_price = '$price'
    WHERE booking_id = '$bookingid'";
    $result = mysqli_query($conn, $sql);
    header("Location: menu.php?booking_id=$bookingid");
    exit();
}
$sql = "SELECT * FROM course";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Course</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

    @font-face {
        font-family: myWebFont;
        src: url(MN\ DONBURI.ttf);
    }

    body {
        background-color: whitesmoke;
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
        background-color: rgb(255, 255, 255, 0.1);
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
        /* padding: 60px; */
        font-family: "Mitr", sans-serif;

    }

    .content {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        margin-top: 100px;
        gap: 30px;
    }

    h1 {
        padding-top: 40px;
        font-family: myWebFont;
        font-size: 60px;
        margin-top: 20px;
        font-weight: 10px;
    }

    hr {
        width: 50%;
        border: none;
        border-top: 2px solid #F61C1C;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    p {
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
        <h1 class="text-6xl font-extrabold leading-none tracking-tight text-gray-900 md:text-6xl lg:text-6xl dark:text-white">คอร์สโอมากาเสะ</h1>
        <br>
        <hr width="50%" />
        <div class="content">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <form action="" method="post">
                    <div class="relative flex w-80 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md" style=" color:black;">
                        <div class="relative mx-4 -mt-5 h-40 overflow-hidden rounded-xl  shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                            <img src="<?php echo $row['img_course'] ?>" alt="">
                        </div>
                        <div class="p-7">
                            <div style="margin: auto; display: flex; align-items: center; justify-content: center; width: 250px; margin-bottom: 15px;height: 40px; background-color:#FFE17B; border-radius: 10px;">
                                <h5 class="mb-1 block font-sans text-xl	 font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                    <?php echo $row["course_name"]; ?>
                                </h5 style="width= 300">
                            </div>
                            <p><?php echo $row["course_detail"]; ?></p>
                            <p><strong>ราคา </strong><?php echo $row["price"]; ?> บาท</p>
                        </div>
                        <div class="p-6 pt-0 flex justify-end">
                            <input type="hidden" name="course_id" value="<?php echo $row['course_id'] ?>">
                            <button data-ripple-light="true" type="submit" name="sub" class="select-none rounded-lg py-3 px-6 text-center align-middle font-sans text-xs font-bold text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" style="background-color: #C51605;">
                                จอง
                            </button>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>

    </div>


</body>
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
</script>

</html>