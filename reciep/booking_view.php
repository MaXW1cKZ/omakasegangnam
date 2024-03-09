<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <title>Receptionist</title>
  <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="booking_view.css">
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
      background: #6c050e;
      width: 100%;
    }

    .top {
      display: grid;
      grid-template-columns: 7% 86% 7%;
    }

    .title {
      text-align: center;
      color: #ebe9e9;
      margin-top: 60px;
    }

    #i {
      margin-top: 75px;
      text-align: right;
      color: #ebe9e9;
      text-decoration: none;
    }

    #i:hover {
      color: #9a9a9a;
      cursor: pointer;
    }

    img {
      margin-top: 55px;
    }

    .main {
      margin: 60px 13% 3% 13%;
      /* height: 650px; */
      border-radius: 30px;
      padding: 1% 5% 1% 5%;
    }

    .row1 {
      display: grid;
      grid-template-columns: 42% 58%;
      background: #ebe9e9;
      margin-bottom: 25px;
      border-radius: 10px;
    }

    .row1_l {
      padding: 25px 20px 25px 50px;
      display: grid;
      grid-template-columns: 60% 40%;
    }

    .row1_r {
      padding: 25px 20px 25px 60.5px;
      display: grid;
      grid-template-columns: 37% 63%;
    }

    p {
      font-size: 21px;
    }

    .row2 {
      display: grid;
      grid-template-columns: 42% 58%;
      border-radius: 10px;

    }

    .row2_l {

      margin-right: 12.5px;
      display: flex;
      flex-direction: column;
      border-radius: 10px;
    }

    .row2_l_t {
      padding: 25px 20px 25px 50px;
      background: #ebe9e9;
      margin-bottom: 25px;
      border-radius: 10px;
      display: grid;
      grid-template-columns: 37% 63%;
    }

    .row2_l_b {
      padding: 25px 20px 25px 50px;
      background: #ebe9e9;
      border-radius: 10px;
      display: grid;
      grid-template-columns: 37% 63%;
    }

    .row2_r {
      background: #ebe9e9;
      padding: 25px 20px 25px 48px;
      margin-left: 12.5px;
      border-radius: 10px;
      display: grid;
      grid-template-columns: 37% 63%;
    }

    .p1 {
      margin-bottom: 6px;
    }

    .p2 {
      margin-bottom: 12px;
    }

    img {
      width: 50px;
      height: 50px;
      cursor: pointer;
      border-radius: 50%;
    }

    .but {
      text-align: center;
    }

    button {
      padding: 13px 30px 13px 30px;
      border-radius: 8px;
      font-size: 17px;
      background-color: rgb(14, 207, 14);
      font-weight: bold;
      color: #ebe9e9;
    }

    button:hover {
      background-color: rgb(2, 159, 2);
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?php
  $conn = mysqli_connect("localhost", "root", "", "omakase");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
  }
  $sql = "SELECT booking_id, course_name, seat_id, room_id, booking_date, total_price, booking_status, customers.cus_id, first_name, last_name, phone, email
           FROM booking 
           JOIN customers
           JOIN course
           ON booking.cus_id = customers.cus_id
           AND course.course_id = booking.course_id
           WHERE booking_id = '$booking_id';";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }
  ?>
  <div class="container">

    <div class="top">
      <a class="fa-solid fa-arrow-left fa-2xl" id="i" href="booking.php"></a>
      <h1 class="title">BOOKING</h1>
      <img src="../logo.png" alt="">
    </div>

    <div class="main">
      <div class=row1>
        <div class="row1_l">
          <div class="row1_l_l">
            <p>Booking ID :</p>
          </div>
          <div class="row1_l_r">
            <p><?php echo $row['booking_id'] ?></p>
          </div>

        </div>
        <div class="row1_r">
          <div class="row1_l_l">
            <p>สถานะ : </p>
          </div>
          <div class="row1_l_r">
            <p><?php echo $row['booking_status'] ?></p>
          </div>
        </div>
      </div>
      <div class="row2">
        <div class="row2_l">
          <div class="row2_l_t">
            <div class="row2_l_l">
              <p class="p1">คอร์ส : </p>
              <p class="p1">ราคา : </p>
            </div>
            <div class="row2_l_r">
              <p class="p1"><?php echo $row['course_name'] ?></p>
              <p class="p1"><?php echo $row['total_price'] ?></p>
            </div>

          </div>
          <div class="row2_l_b">
            <div class="row2_l_l">
              <p class="p1">ห้อง : </p>
              <p class="p1">เลขที่นั่ง : </p>
              <p class="p1">วันที่ : </p>
              <p class="p1">เวลา : </p>
            </div>
            <div class="row2_l_r">
              <p class="p1"><?php echo $row['room_id'] ?></p>
              <p class="p1"><?php echo $row['seat_id'] ?></p>
              <p class="p1"><?php echo $row['booking_date'] ?></p>
              <p class="p1">12.00</p>
            </div>

          </div>
        </div>
        <div class="row2_r">
          <div class="row2_r_l">
            <p class="p2">Customer ID : </p>
            <p class="p2">ชื่อ : </p>
            <p class="p2">นามสกุล : </p>
            <p class="p2">เบอร์โทร : </p>
            <p class="p2">อีเมล : </p>
          </div>
          <div class="row2_r_r">
            <p class="p2"><?php echo $row['cus_id'] ?></p>
            <p class="p2"><?php echo $row['first_name'] ?></p>
            <p class="p2"><?php echo $row['last_name'] ?></p>
            <p class="p2"><?php echo $row['phone'] ?></p>
            <p class="p2"><?php echo $row['email'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <form method="post" action="">
      <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
      <div class="but">
        <button type="submit" name="confirm_checkin" >ยืนยันการ check-in</button>
      </div>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_checkin'])) {
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $update_sql = "UPDATE booking SET booking_status = 'check-in' WHERE booking_id = '$booking_id';";
    $update_result = mysqli_query($conn, $update_sql);
    echo '<script>alert("ยืนยันการ check-in สำเร็จ");window.location.replace("booking.php");</script>';
  }
  mysqli_close($conn);
  ?>
</body>

</html>