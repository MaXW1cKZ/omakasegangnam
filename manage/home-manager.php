<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("localhost", "root", "", "omakase");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//ทั้งหมด
$sql = "SELECT SUM(total_price),COUNT(booking_id) FROM booking";
$sql1 = "SELECT COUNT(booking_id) FROM booking WHERE booking_status = 'checked'";

$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);

$row = mysqli_fetch_assoc($result);
$sumprice = $row["SUM(total_price)"];
$countbook = $row['COUNT(booking_id)'];
$row1 = mysqli_fetch_assoc($result1);

$countbooksuc = $row1['COUNT(booking_id)'];
$date1 = 'ทั้งหมด';

$sql2 = "SELECT COUNT(course_id) FROM booking WHERE course_id = 1";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$countcourse1 = $row2["COUNT(course_id)"];

$sql3 = "SELECT COUNT(course_id) FROM booking WHERE course_id = 2";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$countcourse2 = $row3["COUNT(course_id)"];

$sql4 = "SELECT COUNT(course_id) FROM booking WHERE course_id = 3";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_assoc($result4);
$countcourse3 = $row4["COUNT(course_id)"];

$sql5 = "SELECT COUNT(course_id) FROM booking WHERE course_id = 4";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_assoc($result5);
$countcourse4 = $row5["COUNT(course_id)"];
//แยกวัน
if (isset($_POST['sub'])) {
    $date = $_POST['date'];
    $date1 = "วันที่ ".$_POST['date'];
    $sql = "SELECT COALESCE(SUM(total_price), 0) AS total_price_sum,COALESCE(COUNT(booking_id), 0) AS booking_count FROM booking WHERE booking_date = '$date'";
    $sql1 = "SELECT COALESCE(COUNT(booking_id), 0) AS successful_booking_count FROM booking WHERE booking_status = 'checked' AND booking_date = '$date'";
    $result = mysqli_query($conn, $sql);
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result);
    $row1 = mysqli_fetch_assoc($result1);
    $sumprice = $row["total_price_sum"];
    $countbook = $row['booking_count'];
    $countbooksuc = $row1['successful_booking_count'];

    $sql2 = "SELECT COALESCE(COUNT(course_id),0) FROM booking WHERE course_id = '1' AND booking_date = '$date'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $countcourse1 = $row2["COALESCE(COUNT(course_id),0)"];

    $sql3 = "SELECT COALESCE(COUNT(course_id),0) FROM booking WHERE course_id = '2' AND booking_date = '$date'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $countcourse2 = $row3["COALESCE(COUNT(course_id),0)"];

    $sql4 = "SELECT COALESCE(COUNT(course_id),0) FROM booking WHERE course_id = '3' AND booking_date = '$date'";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $countcourse3 = $row4["COALESCE(COUNT(course_id),0)"];

    $sql5 = "SELECT COALESCE(COUNT(course_id),0) FROM booking WHERE course_id = '4' AND booking_date = '$date'";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $countcourse4 = $row5["COALESCE(COUNT(course_id),0)"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Manager</title>
    <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
        }

        body {
            display: flex;
        }

        .sidebar {
            position: sticky;
            top: 0;
            left: 0;
            bottom: 0;
            width: 145px;
            height: 100vh;
            padding: 0 1.7rem;
            color: #fff;
            overflow: hidden;
            transition: all 1s linear;
            background: #05076c;
        }

        .sidebar:hover {
            width: 270px;
            transition: 0.5s;
        }

        .logo {
            height: 80px;
            padding: 16px;
        }

        .menu {
            height: 88%;
            position: relative;
            list-style: none;
            padding: 0;
        }

        .menu li {
            padding: 1rem;
            margin: 8px 0;
            border-radius: 8px;
            transition: all 0.5s ease-in-out;
        }

        .menu li:hover,
        .active {
            background: #e0e0e058;
        }

        .menu a {
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu a span {
            overflow: hidden;
        }

        .menu a i {
            font-size: 1.2rem;
        }

        /* main body section */
        .main--content {
            /* background-image: url('https://imhttps://images.pexels.com/photos/3109807/pexels-photo-3109807.jpegages.pexels.com/photos/3109850/pexels-photo-3109850.jpeg?cs=srgb&dl=pexels-anni-roenkae-3109850.jpg&fm=jpg'); */
            position: relative;
            width: 100%;
            padding: 1rem;
            /* background-color: #05076c; */
        }

        .header--wrapper img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border-radius: 50%;
        }

        .header--wrapper {
            /* background-image: url('https://images.pexels.com/photos/3109850/pexels-photo-3109850.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'); */
            background-color: #2C0139;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 10px;
            box-shadow: 0px 10px 10px rgba(2, 28, 15, 0.2);
            padding: 30px 2rem;
            margin-bottom: 1rem;
            height: 130px;
        }

        .header--title {
            color: #000000;
            font-size: 20px;
        }

        .user--info {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .search--box {
            background-color: #ebe9e9;
            border-radius: 15px;
            color: #8079e6;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 4px 12px;
        }

        .search--box input {
            background: transparent;
            padding: 10px;
        }

        .search--box i {
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.5s ease-out;
        }

        .search--box i:hover {
            transform: scale(1.1);
            color: #e60f0b;
        }

        .card-container {
            padding: 2rem;
            border-radius: 10px;
        }

        .day-detail {
            color: rgb(26, 22, 22);
            padding-bottom: 10px;
            font-size: 18px;
        }

        .amount {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .title {
            margin-top: 10px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            justify-content: center;
            box-shadow: 0px 10px 10px rgba(0, 0, 0, .2);
            color: rgb(0, 0, 0);
            width: 250px;
            height: 130px;
            gap: 10px;
        }

        .title p {
            width: 200px;
            text-align: center;
            padding: 3px;
            border-radius: 10px;
        }

        .income-chart {
            width: 100%;
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }

        #chart {
            width: 50%;
            padding: 30px;
            background-color: #fff;
            border-radius: 30px;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <div class="menu">
                <li class="active">
                    <a href="#">
                        <i class="fa-solid fa-wallet"></i>
                        <span>Deshboard</span>
                    </a>
                </li>
                <li>
                    <a href="home-menu.php">
                        <i class="fa-solid fa-table-list"></i>
                        <span>Menu</span>
                    </a>
                </li>
                <li>
                    <a href="home-customer.php">
                        <i class="fa-solid fa-user"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li class="logout">
                <a href="../login.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </div>
        </div>
    </div>

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2 style="color:white ">รายรับทั้งหมด</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <form action="" method="post">
                        <button type="submit" name="sub"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <input type="date" name="date" placeholder="Search ex 12/07/45">
                    </form>
                </div>
                <img src="../logo.png" alt="" />
            </div>
        </div>

        <div class="card-container">
            <h3 class="day-detail"><?php echo $date1 ?></h3>
            <div class="card--wrapper">
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <div class="title" style="background-color:#82abfe;">
                                <div style="background-color: #2205C574; border-radius: 10px; width: 6px; height: 50px;"></div>
                                <p>รายรับทั้งหมด <?php echo $sumprice ?> บาท</p>
                            </div>
                            <div class="title" style="background-color: rgb(114, 246, 191);">
                                <div style="background-color: #00710F5C; border-radius: 10px; width: 6px; height: 50px;"></div>
                                <p>การจองทั้งหมด <?php echo $countbook ?></p>
                            </div>
                            <div class="title" style="background-color: rgb(250, 250, 118);">
                                <div style="background-color: #8D8B0071; border-radius: 10px; width: 6px; height: 50px;"></div>
                                <p>การจองที่สำเร็จทั้งหมด <?php echo $countbooksuc ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="income-chart" style="margin-top: 30px; padding:50px 20px; border-radius: 20px;">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
</body>

<script>
    const xValues = ["Azami", "Samurai", "Otsu", "Gangnam"];
    const yValues = [<?php echo $countcourse1 ?>, <?php echo $countcourse2 ?>, <?php echo $countcourse3 ?>, <?php echo $countcourse4 ?>];
    const barColors = ["red", "green", "blue", "orange"];

    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "คอร์สที่ถูกซื้อมากที่สุด"
            },
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true, // เริ่มแกน y ที่ค่า 0
                        stepSize: 1 // กำหนดขนาดของขั้นแต่ละหน่วยบนแกน y
                    }
                }
            }
        }
    });
</script>
</html>