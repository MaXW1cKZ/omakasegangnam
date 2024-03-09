<?php
$conn = mysqli_connect("localhost", "root", "", "omakase");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <title>Menu-Manager</title>
  <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
      transition: all 0.7s linear;
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

    .main--content {
      position: relative;
      background: #ffffff;
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
      /* background-color: rgb(255, 250, 183); */
      box-shadow: 0px 10px 10px rgba(0, 0, 0, .2);
      border-radius: 10px;
      padding: 30px 2rem;
      margin-bottom: 1rem;
    }

    .header--title {
      color: #000206;
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
      width: 100%;
      border-radius: 10px;
    }

    .course--card {
      width: 100%;
      display: grid;
      grid-template-columns: auto auto auto auto;
      gap: 10px;
      background-color: #e8ede7;
      border: #120a7f;
    }

    td img {
      width: 36px;
      height: 36px;
      margin-right: .5rem;
      border-radius: 50%;
      vertical-align: middle;
    }

    table,
    th,
    td {
      padding: 1rem;

    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo">
      <div class="menu">
        <li >
          <a href="home-manager.php">
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
        <li class="active">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span>Customer</span>
          </a>
        </li>
        <li class="logout" >
          <a href="../login.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log Out</span>
          </a>
        </li>
      </div>
    </div>
  </div>

  <?php
  $sql = "SELECT * FROM customers;";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  ?>

  <div class="main--content">
    <div class="header--wrapper">
      <div class="header--title">
        <h2 style="font-size: 21px;">รายละเอียดลูกค้า</h2>
        <div style="margin-top: 10px; text-align: center; border-radius: 10px; padding: 5px 1px; background-color: #69CD67; color:white">

          <p style="font-size: 12px;">ลูกค้ามีทั้งหมด : <?php echo $num_rows ?> </p>
        </div>
      </div>
      <div class="user--info">
        <img src="../logo.png" alt="">
      </div>

    </div>

    <div class="option" style="margin-top: 15px">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin-top: 20px">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr style="background-color: #a8ffbf">
              <th scope="col" class="px-6 py-3">#No</th>
              <th scope="col" class="px-6 py-3">Customer ID</th>
              <th scope="col" class="px-6 py-3">first name</th>
              <th scope="col" class="px-6 py-3">last name</th>
              <th scope="col" class="px-6 py-3">phone</th>
              <th scope="col" class="px-6 py-3">email</th>
              <th scope="col" class="px-6 py-3">Username</th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              $count = 1;
              while ($row = mysqli_fetch_assoc($result)) {
            ?>

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-8 py-4"><?php echo $count ?></td>
                  <td class="px-14 py-4"><?php echo $row['cus_id'] ?></td>
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <strong><?php echo  $row['first_name'] ?></strong>
                  </th>
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <strong><?php echo  $row['last_name'] ?></strong>
                  </th>
                  <td class="px-6 py-4"><?php echo  $row['phone'] ?></td>
                  <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><?php echo  $row['email'] ?></a>
                  </td>
                  <td class="px-6 py-4"><?php echo  $row['username'] ?></td>
                </tr>

            <?php
                $count = $count + 1;
              }
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>



</body>

</html>

<?php
mysqli_close($conn);
?>