<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "omakase");
$bookingid = $_GET['booking_id'];

$sqlcourse = "SELECT course_id FROM booking WHERE booking_id = '$bookingid'";
$resultcourse = mysqli_query($conn, $sqlcourse);

$rowcourse = mysqli_fetch_assoc($resultcourse);
$course_id = $rowcourse['course_id'];

$sql = "SELECT * FROM detail_course_menu 
JOIN menu 
JOIN course 
ON detail_course_menu.menu_name = menu.menu_name
AND detail_course_menu.course_id = course.course_id
WHERE detail_course_menu.course_id = '$course_id'";
$result = mysqli_query($conn, $sql);

$coursename = "SELECT course_name FROM course WHERE course_id = '$course_id'";
$resultname = mysqli_query($conn, $coursename);
$rowname = mysqli_fetch_assoc($resultname);
$course_name = $rowname["course_name"];

if (isset($_POST['sub'])) {
    $selectedMenus = $_POST['menu'];
    foreach ($selectedMenus as $menuName) {
        $escapedMenuName = mysqli_real_escape_string($conn, $menuName);
        $sqll = "INSERT INTO orders (course_id,booking_id,menu_name,order_status) VALUES ('$course_id','$bookingid','$escapedMenuName','wait')";
        $resultorder = mysqli_query($conn, $sqll);
        header("Location: confirmbook.php?booking_id=$bookingid");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="checklist.css">
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        @font-face {
            font-family: myWebFont;
            src: url(MN\ DONBURI.ttf);
        }

        .all {
            /* background-color: #f4f4f4; */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 70px;
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

        .headcon {
            margin: 30px 0px 30px 0px;
            font-family: myWebFont;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px;
            padding: 25px;
        }

        .checkbox-wrapper {
            margin-left: 60px;
        }

        .manucon {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container {
            margin: 1rem 0;
            display: flex;
            align-items: center;
        }

        .container span {
            margin-left: 1rem;
            text-align: center;
        }

        .check-input {
            display: none;
        }

        .checkbox {
            width: 25px;
            height: 25px;
            border: 2px solid #000000;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            padding: 3px;
            transition: 0.3s all;
        }

        .checkbox svg {
            width: 20px;
            height: 20px;
        }

        .check-input[type='checkbox']:checked+.checkbox {
            background-color: #0AD551;
            border: 2px solid #fff;
        }

        .check-input[type='checkbox']:checked+.checkbox svg {
            stroke: #fff;
            stroke-width: 3;
            animation: check 4s forwards;
        }

        .headerwrap {
            text-align: center;
        }

        .pic {
            width: 300px;
            height: 220px;
            object-fit: cover;
        }

        .btn {
            width: 20%;
            padding: 8px;
            border-radius: 10px;
            font-size: 24px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            /* color: #fff; */
            background-color: white;
            color: #64cc9c;
            border: #64cc9c solid 3px;
        }

        .btn:hover {
            background-color: #64cc9c;
            color: white;
            transform: scale(1.05);
        }
        p,span,h2,button{
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
        <div class="headerwrap">
            <div class="menucourse">
                <h1 class="headcon" style="font-size: 50px;">เมนูคอร์ส <?php echo $course_name ?></h1>
                <h2 class="text-xl">กรุณาเลือกเมนู <span id="selectedCount"> 8 รายการ</h2><br>
            </div>
        </div>
        <div class="content">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="manucon">
                    <img class="h-46 rounded-md pic" src="<?php echo $row['menu_img'] ?>" alt="">
                    <br>
                    <form action="" method="post" class="form">
                        <div class="checkbox-wrapper">
                            <div class="container">
                                <input type="checkbox" name="menu[]" value="<?php echo $row['menu_name']; ?>" id="input-<?php echo $row['menu_name']; ?>" class="check-input" />
                                <label for="input-<?php echo $row['menu_name']; ?>" class="checkbox">
                                    <svg viewBox="0 0 22 16" fill="none">
                                        <path d="M1 6.85L8.09677 14L21 1" />
                                    </svg>
                                </label>
                                <span class="text-lg"><?php echo $row['menu_name'] ?></span>
                            </div>
                        </div>
                        <p style="text-align: left; font-size: 13px; padding: 0px 35px 22px 35px;"><?php echo $row['menu_detail']; ?></p>
                </div>
            <?php } ?>
        </div><br>
        <button type="submit" name="sub" class="btn">ยืนยัน</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.check-input');
            const menuBlocks = document.querySelectorAll('.manucon');
            const selectedCountElement = document.getElementById('selectedCount');

            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        menuBlocks[index].style.backgroundColor = '#F0DBC0';
                    } else {
                        menuBlocks[index].style.backgroundColor = '#fff';
                    }

                    const checkedCount = document.querySelectorAll('.check-input:checked').length;
                    if (checkedCount > 8) {
                        alert('โปรดเลือกเมนูเพียง 8 รายการ');
                        this.checked = false;
                        menuBlocks[index].style.backgroundColor = '#fff';
                    }
                    count = 8 - checkedCount;
                    if (count >= 0) {
                        selectedCountElement.textContent = count + " รายการ";
                    } else {
                        selectedCountElement.textContent = "0 รายการ";
                    }
                });
            });

            const form = document.querySelector('.form');
            form.addEventListener('submit', function(event) {
                const checkedCount = document.querySelectorAll('.check-input:checked').length;
                if (checkedCount !== 8) {
                    event.preventDefault();
                    alert('โปรดเลือกเมนูอีก ' + count + ' รายการ');
                }
            });
        });
    </script>

</body>

</html>