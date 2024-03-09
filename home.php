<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$conn = mysqli_connect("localhost", "root", "", "omakase");
$cus_id = $_SESSION['cus_id'];
$sql = "SELECT username from customers where cus_id = $cus_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$username = $row['username'];
// echo $username;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gangnam Omakase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        * {
            font-family: "Noto Sans Thai", sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url(background.jpg);
            background-size: 100%;
            background-repeat: no-repeat;
            background-color: black;
            display: flex;
            flex-direction: column;
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
            background-color: rgb(255, 255, 255, 0);
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
            color: #fff;
            font-weight: 600;
            font-size: 25px;
        }

        .nav {
            width: 50%;
            padding-left: 32%;
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

        .reservation {
            width: 100px;
            height: 35px;
            border-radius: 10px;
            border: none;
            background-color: brown;
        }

        .reservation:hover {
            background-color: rgb(58, 56, 56);
            color: white;
        }

        .intro {
            margin: 250px 0px 0px 180px;
        }

        .left h1 {
            font-size: 60px;
        }

        /* course ที่ 1 */
        .course1 {
            display: flex;
        }

        .photo-course1,
        .text-course1 {
            flex: 1;
        }

        .photo-course1 {
            width: 50%;
            height: 100%;
        }

        .text-course1 {
            color: white;
            margin-top: 200px;
            text-align: center;
        }

        .text-course1 h1 {
            font-size: 25px;
        }

        .text-course1 p {
            font-size: 14px;
        }

        /* course ที่ 2 */
        .course2 {
            display: flex;
            background-color: #1516179c;
            border: solid 0.3px rgb(28, 28, 28);
        }

        .photo-course2,
        .text-course2 {
            flex: 1;
        }

        .photo-course2 {
            width: 50%;
            height: 100%;
        }

        .text-course2 {
            color: white;
            margin-top: 200px;
            text-align: center;
        }

        .text-course2 h1 {
            font-size: 25px;
        }

        .text-course2 p {
            font-size: 14px;
        }

        /* course ที่ 3 */
        .course3 {
            display: flex;
        }

        .photo-course3,
        .text-course3 {
            flex: 1;
        }

        .photo-course3 {
            width: 50%;
            height: 100%;
        }

        .text-course3 {
            color: white;
            text-align: center;
            margin-top: 200px;
        }

        .text-course3 h1 {
            font-size: 25px;
        }

        .text-course3 p {
            font-size: 14px;
        }

        /* course ที่ 4 */
        .course4 {
            display: flex;
            background-color: #1516179c;
            border: solid 0.3px rgb(28, 28, 28);
        }

        .photo-course4,
        .text-course4 {
            flex: 1;
        }

        .photo-course4 {
            width: 50%;
            height: 100%;
        }

        .text-course4 {
            color: white;
            margin-top: 200px;
            text-align: center;
        }

        .text-course4 h1 {
            font-size: 25px;
        }

        .text-course4 p {
            font-size: 14px;
        }


        .str {
            display: flex;
            flex-direction: column;
            padding: 100px;

        }

        .why,
        .choose {
            flex: 1;
            padding: 10px;
        }

        .choose {
            display: flex;
            justify-content: center;
            /* Center the child elements horizontally */
        }

        .box {
            display: inline-block;
            /* Display boxes inline, side-by-side */
            height: 200px;
            width: 900px;
            border: 1px solid #cab99f;
            border-radius: 15px;
            margin: 20px;
            justify-content: center;
            align-items: center;
        }

        #course-icon {
            position: relative;
            color: #262626;
            transition: .5s;
            z-index: 3;
        }

        #course-icon:hover {
            color: #fff;
            transform: rotateY(180deg);
        }

        #course-img {
            transition: 1s ease;
            border-radius: 40%;
        }

        #course-img:hover {
            border-radius: 20%;
            transition: 1s ease;
        }

        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: #fff;
        }

        .hover-underline-animation::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #cab99f;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }

        .hover-underline-animation:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>

</head>

<body>
    <!-- logo -->
    <header>
        <div class="logo">
            <img src="logo.png" alt="">
            <a href="" class="header__logo">Gangnam Omakase</a>
        </div>
        <nav class="nav" id="nav-menu">
            <ion-icon name="close-outline" class="header__close" id="close-menu"></ion-icon>
            <ul class="nav__list">
                <!-- <li class="nav__item"><a href="#" class="nav__link">Home</a></li> -->
                <!-- <li class="nav__item"><a href="reservation.php" class="nav__link">Reservation</a></li> -->
                <li class="nav__item"><a href="history.php" class="nav__link">ประวัติ</a></li>
                <li class="nav__item"><a href="logout.php" class="nav__link">ออกจากระบบ</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <!-- left main -->
    <div class="intro">
        <div class="left" style="color: white; margin-top: -50px;">
            <p>Hello <?php echo $username ?> Welcome</p>
            <h1>ยินดีต้อนรับ</h1>
            <br>
            พวกเรานำเสนอประสบการณ์โอมากาเสะที่พิเศษไม่เหมือนใคร
            <br>ผ่านคอร์สอาหารที่รังสรรค์ขึ้นด้วยวัตถุดิบสดใหม่ตามฤดูกาล
            <br>ผสมผสานเทคนิคการปรุงอาหารแบบดั้งเดิม
            <br>และความคิดสร้างสรรค์ของเชฟผู้มากประสบการณ์
            <br>
            <br>
            <br>
            <button class="group relative h-10 w-40 overflow-hidden rounded-lg bg-white text-lg shadow" onclick="window.location.href='reservation.php';">
                <div class="absolute inset-0 w-3 bg-red-700 transition-all duration-[250ms] ease-out group-hover:w-full"></div>
                <span class="relative text-black group-hover:text-white">จองโต๊ะอาหาร</span>
            </button>
        </div>
    </div>

    <div class="course1" style="margin-top: 30%;">
        <div class="photo-course1" style="border: 10px;">
            <img src="image1_0.jpg" id="course-img" class="" style="width: 100%; height: 800px; padding: 80px; 
              ">
        </div>
        <div class="text-course1">
            <div style="margin: 0px 100px 0px 100px;">
                <i id="course-icon" class="fa-brands fa-slack" style="color: #cab99f ;font-size: 100px; margin-bottom: 70px;"></i>
                <h1>Azami Omakase</h1>
                <br>
                <p>คอร์สโอมากาเสะที่ออกแบบมาสำหรับผู้ที่ต้องการลองทานอาหารญี่ปุ่นแบบพรีเมียม โดยไม่ต้องเลือกเมนูเอง คอร์สนี้ได้รับแรงบันดาลใจจากดอกไม้ "Azami" หรือดอกอะซามิ ซึ่งเป็นสัญลักษณ์ของความมุ่งมั่น เช่นเดียวกับเชฟของเราที่ทุ่มเทให้กับการคัดสรรวัตถุดิบที่ดีที่สุด</p>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px; margin-top: 40px;"></i>
            </div>
        </div>
    </div>

    <div class="course2">
        <div class="text-course2">
            <div style="margin: 0px 100px 0px 100px;">
                <i id="course-icon" class="fa-solid fa-khanda" style="color: #cab99f ;font-size: 100px; margin-bottom: 70px;"></i>
                <h1>Samurai Sushi</h1>
                <br>
                <p>คอร์สโอมากาเสะที่ออกแบบมาเพื่อนักชิมที่ต้องการสัมผัสประสบการณ์การทานอาหารญี่ปุ่นแบบสุดยอด คอร์สนี้ได้รับแรงบันดาลใจจากวิถีชีวิตของซามูไร เน้นความพิถีพิถันในการคัดสรรวัตถุดิบ เทคนิคการปรุงอาหารชั้นสูง และการนำเสนอที่ประณีต</p>
                <br>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px; margin-top: 40px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
            </div>
        </div>
        <div class="photo-course2">
            <img src="image1_0-2.jpg" id="course-img" class="" style="width: 100%; height: 750px; padding: 80px;">
        </div>
    </div>

    <div class="course3">
        <div class="photo-course3">
            <img src="image1_0-5.jpg" id="course-img" class="" style="width: 100%; height: 750px; padding: 80px;">
        </div>
        <div class="text-course3">
            <div style="margin: 0px 100px 0px 100px;">
                <i id="course-icon" class="fa-solid fa-wind" style="color: #cab99f ;font-size: 100px; margin-bottom: 70px; "></i>
                <h1>Otsu OMakase</h1>
                <br>
                <p>คอร์สโอมากาเสะที่รังสรรค์ขึ้นมาเพื่อมอบประสบการณ์การทานอาหารแบบพิเศษ เน้นความประณีต พิถีพิถัน คัดสรรวัตถุดิบคุณภาพ และเทคนิคการปรุงอาหารชั้นสูง เหมาะสำหรับผู้ที่ต้องการลิ้มลองรสชาติอาหารญี่ปุ่นแท้ๆ ในบรรยากาศอบอุ่น เป็นกันเอง</p>
                <br>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px; margin-top: 40px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
            </div>
        </div>
    </div>

    <div class="course4">
        <div class="text-course4">
            <div style="margin: 0px 100px 0px 100px;">
                <i id="course-icon" class="fa-regular fa-snowflake" style="color: #cab99f ;font-size: 100px; margin-bottom: 70px; "></i>
                <h1>Gangnam Omakase</h1>
                <br>
                <p>คอร์สโอมากาเสะระดับพรีเมียมที่รังสรรค์ขึ้นมาเพื่อมอบประสบการณ์การทานอาหารแบบเหนือระดับ คอร์สนี้ได้รับแรงบันดาลใจจากความคึกคัก ทันสมัย และหรูหรา ผสมผสานกับความประณีตและพิถีพิถันของอาหารญี่ปุ่น</p>
                <br>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px; margin-top: 40px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
                <i class="fa-solid fa-dollar-sign" style="font-size: 25px;"></i>
            </div>
        </div>
        <div class="photo-course4">
            <img src="image1_0-4.jpg" id="course-img" class="" style="width: 100%; height: 800px; padding: 80px;">
        </div>
    </div>

    <div class="str" style="margin: 0px 0px 150px 0px; height: 600px; color: white;">
        <div class="why" style="text-align: center;">
            <br>
            <p style="font-size: 20px;" class="hover-underline-animation">ทำไมต้องเลือกเรา</p>
            <br>
        </div>
        <div class="choose" style="text-align: center; font-size:medium; margin-top: 70px;">
            <div class="box py-2 px-4 bg-transparent text-white font-semibold border border-#cab99f-600 rounded hover:bg-transparent hover:text-white hover:border transition ease-in duration-300 transform hover:-translate-y-8 active:translate-y-0">
                <i id="course-icon" class="fa-solid fa-bowl-food" style="font-size: 50px; margin-top: 50px; color: #cab99f;"></i>
                <p style="margin-top: 30px;">อาหารที่ถูกสุขลักษณะ</p>
            </div>
            <div class="box py-2 px-4 bg-transparent text-white font-semibold border border-#cab99f-600 rounded hover:bg-transparent hover:text-white hover:border transition ease-in duration-300 transform hover:-translate-y-8 active:translate-y-0">
                <i id="course-icon" class="fa-solid fa-seedling" style="font-size: 50px; margin-top: 50px; color: #cab99f;"></i>
                <p style="margin-top: 30px;">สภาพแวดล้อมที่สดใหม่</p>
            </div>
            <div class="box py-2 px-4 bg-transparent text-white font-semibold border border-#cab99f-600 rounded hover:bg-transparent hover:text-white hover:border transition ease-in duration-300 transform hover:-translate-y-8 active:translate-y-0">
                <i id="course-icon" class="fa-solid fa-kitchen-set" style="font-size: 50px; margin-top: 50px; color: #cab99f;"></i>
                <p style="margin-top: 30px;">เชฟฝีมือดี</p>
            </div>
            <div class="box py-2 px-4 bg-transparent text-white font-semibold border border-#cab99f-600 rounded hover:bg-transparent hover:text-white hover:border transition ease-in duration-300 transform hover:-translate-y-8 active:translate-y-0">
                <i id="course-icon" class="fa-solid fa-gift" style="font-size: 50px; margin-top: 50px; color: #cab99f;"></i>
                <p style="margin-top: 30px;">กิจกรรม</p>
            </div>
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
    </script>
</body>

</html>
