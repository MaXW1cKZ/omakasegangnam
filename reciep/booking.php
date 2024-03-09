<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <title>Receptionist</title>
  <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="booking.css">
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
      background: #6c050e;

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
      position: relative;
      background: #ebe9e9;
      width: 100%;
      padding: 1rem;
    }

    .header--wrapper img {
      width: 50px;
      height: 50px;
      cursor: pointer;
      border-radius: 50%;
    }

    .header--wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      background-color: #fff;
      border-radius: 10px;
      padding: 30px 2rem;
      margin-bottom: 1rem;
    }

    .header--title {
      color: #4b0858;
    }

    .user--info {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .search--box {
      background-color: #ebe9e9;
      border-radius: 15px;
      color: #120a7f;
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

    /* detail income */
    .card-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
    }

    .day-detail {
      color: #4b0858;
      padding-bottom: 10px;
      font-size: 18px;
    }

    .amount {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .tabular--wrapper {
      background: #fff;
      margin-top: 1rem;
      border-radius: 10px;
      padding: 2rem;

    }

    .table-container {
      width: 100%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: #6c050e;
      color: #fff;
    }

    th {
      padding: 15px;
      text-align: left;
      text-align: center;
    }

    tbody {
      background: #f2f2f2;
      text-align: center;
    }

    td {
      padding: 15px;
      font-size: 14px;
      color: #333;
    }

    tr:nth-child(even) {
      background: #fff;
    }

    tfoot {
      background: rgba(113, 99, 186, 255);
      font-weight: bold;
      color: #fff;
    }

    tfoot td {
      padding: 15px;
    }

    .table-container a {
      color: #333;
      text-decoration-line: underline;

    }

    .table-container a:hover {
      cursor: pointer;
      color: rgb(36, 218, 0);
      font-size: 15.5px;
    }
  </style>
</head>

<body>
  <?php
  $conn = mysqli_connect("localhost", "root", "", "omakase");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  ?>
  <div class="sidebar">
    <div class="logo">
      <div class="menu">
        <li class="active">
          <a href="">
            <i class="fa-solid fa-envelope"></i>
            <span>Booking</span>
          </a>
        </li>
        <li>
          <a href="check_In.php">
            <i class="fa-solid fa-utensils"></i>
            <span>Check In</span>
          </a>
        </li>
        <li>
          <a href="check_Bill.php">
            <i class="fa-solid fa-wallet"></i>
            <span>Check Bill</span>
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
        <h2>BOOKING</h2>
      </div>
      <div class="user--info">
        <div class="search--box">
          <form method="post" action="">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="booking_id" placeholder="Booking ID ">
          </form>
        </div>


        <img src="../logo.png" alt="">
      </div>

    </div>

    <div class="tabular--wrapper">

      <div class="table-container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "omakase");

        if (!$conn) {
          die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['booking_id'])) {
          $search_booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);

          $sql = "SELECT booking_id, course_name, seat_id, room_id, booking_date, total_price, booking_status
            FROM booking 
            JOIN customers
            JOIN course
            ON booking.cus_id = customers.cus_id
            AND course.course_id = booking.course_id
            WHERE booking_status = 'booking'
            AND booking.booking_id = '$search_booking_id';";
        } else {
          $sql = "SELECT booking_id, course_name, seat_id, room_id, booking_date, total_price, booking_status
            FROM booking 
            JOIN customers
            JOIN course
            ON booking.cus_id = customers.cus_id
            AND course.course_id = booking.course_id
            WHERE booking_status = 'booking';";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          echo '<table>
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Course Name</th>
                <th>Seat ID</th>
                <th>Room ID</th>
                <th>Date</th>
                <th>Price</th>
                <th>Status</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>';

          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['booking_id'];
            echo '<tr>' .
              '<td>' . $row['booking_id'] . '</td>' .
              '<td>' . $row['course_name'] . '</td>' .
              '<td>' . $row['seat_id'] . '</td>' .
              '<td>' . $row['room_id'] . '</td>' .
              '<td>' . $row['booking_date'] . '</td>' .
              '<td>' . $row['total_price'] . '</td>' .
              '<td>' . $row['booking_status'] . '</td>' .
              '<td>' . '<a href="booking_view.php?booking_id=' . $row['booking_id'] . '">View</a></td>' .
              '</tr>';
          }

          echo '</tbody></table>';
        } else {
          echo "ไม่พบข้อมูล Booking_id";
        }

        mysqli_close($conn);
        ?>
      </div>

    </div>

  </div>

</body>

</html>