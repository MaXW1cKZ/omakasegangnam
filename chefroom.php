<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("localhost", "root", "", "omakase");
$sql = "SELECT * FROM room WHERE room_id = 1 or room_id = 2 or room_id = 3";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM room WHERE room_id = 4 or room_id = 5";
$result1 = mysqli_query($conn, $sql1);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
        @font-face {
            font-family: myWebFont;
            src: url(MN-Dorayaki.ttf);
        }

        body {
            margin: 0;
            /*font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;*/
            background-color: #f4f4f4;
            /* Set background image for the body */
            background-image: url('path/to/your-background-image.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Style for displaying full-screen image */
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
            padding-left: 60%;
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

        h1 {
            color: #333;
            margin-bottom: 15px;
        }

        .grid-container {
            display: flex;
            flex-direction: column;
        }

        /* Add the following CSS to your existing styles */

        .grid-item1,
        .grid-item2,
        .grid-item3,
        .grid-item4,
        .grid-item5 {
            flex: 0 0 auto;
            width: 300px;
            margin: 35px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .in_grid1,
        .in_grid2,
        .in_grid3,
        .in_grid4,
        .in_grid5 {
            background-color: #fdfaf1;
            /* Update background color */
            padding: 20px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            transition: background-color 0.3s ease;
            /* Add a smooth transition effect */
        }

        .grid-item:hover .in_grid1,
        .grid-item:hover .in_grid2,
        .grid-item:hover .in_grid3,
        .grid-item:hover .in_grid4,
        .grid-item:hover .in_grid5 {
            background-color: #f0f0f0;
            /* Change background color on hover */
        }

        .in_grid1 h1,
        .in_grid2 h1,
        .in_grid3 h1,
        .in_grid4 h1,
        .in_grid5 h1 {
            color: #333;
            /* Text color */
            font-size: 20px;
            margin-bottom: 10px;
        }

        .in_grid1 img,
        .in_grid2 img,
        .in_grid3 img,
        .in_grid4 img,
        .in_grid5 img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 10px;
            margin-top: 10px;
            object-fit: cover;
        }



        .top {
            text-align: center;
            padding: 30px;
            font-size: 70px;
        }



        /* Add the following CSS to your existing styles */

        .grid-item1:hover,
        .grid-item2:hover,
        .grid-item3:hover,
        .grid-item4:hover,
        .grid-item5:hover {
            transform: translateY(-5px);
            /* Move the grid item up by 5 pixels on hover */
            transition: transform 0.3s ease;
            /* Add a smooth transition effect */
        }

        .in_grid1:hover,
        .in_grid2:hover,
        .in_grid3:hover,
        .in_grid4:hover,
        .in_grid5:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            /* Add a box-shadow on hover for a more interactive effect */
        }

        .row1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row2 {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        button {
            border: none;
            border-radius: 9px;
            padding: 9px;
            font-size: 100%;
            width: 80px;
            cursor: pointer;
            /* color: white; */
            /* กำหนดสีของตัวอักษร */
            transition: background-color 0.3s, color 0.3s;
            /* เพิ่มการเปลี่ยนแปลงสีพื้นหลังและสีของตัวอักษร */
        }

        button:hover {
            background-color: #F0BB9D;
            /* กำหนดสีพื้นหลังเมื่อเอาเมาส์ไปชี้ที่ปุ่ม */
            color: black;
            /* กำหนดสีของตัวอักษรเมื่อเอาเมาส์ไปชี้ที่ปุ่ม */
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
                 
                <li class="nav__item"><a href="login.php" class="nav__link">Log Out</a></li>
            </ul>
        </nav>
        <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>
    <div class="container">
        <h1 class="top">CHEF</h1>
        <div class="grid-container">
            <form action="cheffood.php" method="post">
                <div class="row1">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="grid-item1" id="grid1">
                            <div class="in_grid1">
                                <h1><?php echo $row['room_name'] ?></h1>
                                <img src="<?php echo $row['room_img'] ?>" alt="">
                                <button type="submit" name="room_id" value="<?php echo $row['room_id'] ?>">เลือก</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
            <form action="cheffood.php" method="post">
                <div class="row2">
                    <?php while ($row = $result1->fetch_assoc()) { ?>
                        <div class="grid-item4" id="grid4">
                            <div class="in_grid4">
                                <h1>Shokugeki</h1>
                                <img src="<?php echo $row['room_img'] ?>" alt="">
                                <button type="submit" name="room_id" value="<?php echo $row['room_id'] ?>">เลือก</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</body>