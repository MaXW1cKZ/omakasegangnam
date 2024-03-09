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
    <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

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
            background: #fbfbfa;
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
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);
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

        .course {
            text-align: center;
            padding: 20px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            cursor: pointer;
        }

        .course:hover,
        #select {
            background-color: #F9E8C9;
        }

        .course img {
            width: 500px;
            height: 300px;
            object-fit: cover;
            border-radius: 20px;
        }

        .option {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
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
                <li class="active">
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
                <h2 style="font-size: 21px">การจัดการเมนู</h2>
                <p style="padding: 10px 0px">คอร์สอาหารทั้งหมด : 4</p>
            </div>
            <div class="user--info">
                <img src="../logo.png" alt="" />
            </div>
        </div>

        <div class="card-container">
            <div class="course--card">

                <?php
                $sql = "SELECT * FROM course;";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>

                        <a href="home-menu.php?course_id=<?php echo $row['course_id'] ?>">
                            <div class="course">
                                <p><?php echo $row['course_name']; ?></p>
                                <img src="<?php echo $row['img_course']; ?>" alt="" />
                            </div>
                        </a>


                <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>


            </div>

            <div class="option" style="margin-top: 15px">
                <div class="add" style="
              display: flex;
              align-items: center;
              justify-content: space-between;
              padding: 0px 20px;">

                <?php
                    if (isset($_GET['course_id'])) {
                        $course_id = $_GET['course_id'];
                        $choose = "SELECT detail_course_menu.menu_name, course.course_name
                                            FROM detail_course_menu
                                            JOIN course ON course.course_id = detail_course_menu.course_id
                                            WHERE detail_course_menu.course_id = '{$course_id}';";
                        $result = mysqli_query($conn, $choose);
                        $row = mysqli_fetch_assoc($result);
                        $num_rows = mysqli_num_rows($result);
                
                ?>
                    <p>เมนูทั้งหมด : <?php echo $num_rows?></p>
                    <p>Course : <?php echo $row['course_name']?> </p>
                    <a href='menu-add.php?course_id=<?php echo  $course_id ?>'><button style="
                  padding: 8px;
                  background-color: #a8ffbf;
                  border-radius: 10px;
                  font-size: 12px;
                ">เพิ่มเมนู <i class="fa-solid fa-plus"></i></button></a>
                </div>

                <?php
                    }
                ?>

                
                <?php
                            if (isset($_GET['course_id'])) {
                                $course_id = $_GET['course_id'];
                                $choose = "SELECT detail_course_menu.menu_name, course.course_name, course.course_id
                                            FROM detail_course_menu
                                            JOIN course ON course.course_id = detail_course_menu.course_id
                                            WHERE detail_course_menu.course_id = '{$course_id}';";
                                $result = mysqli_query($conn, $choose);

                                if (mysqli_num_rows($result) > 0) {
                ?>
                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin-top: 20px">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr >
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800" style="width: 500px; background-color: #201658; color:white; padding-left: 130px;">
                                    ชื่อคอร์ส
                                </th>
                                <th scope="col" class="px-6 py-3" style="width: 550px; background-color: #201658; color:white; padding-left: 150px;">
                                    ชื่อเมนู
                                </th>
                                <th scope="col" class="px-10 py-3 bg-gray-50 dark:bg-gray-800" style="margin-left: 10px; background-color:#201658; color:white;">
                                    รายละเอียด
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                    
                            <?php    while ($row = mysqli_fetch_assoc($result)){ ?>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="px-6 py-4" style="padding-left: 105px;"><?php echo $row['course_name'] ?></td>
                                            <td class="px-6 py-4" style="padding-left: 110px"><?php echo $row['menu_name'] ?></td>
                                            <td class="px-14 py-4"  >
                                                <a href='menu-detail.php?menu_name=<?php echo  $row['menu_name']?>&course_id=<?php echo  $row['course_id']?>' class="font-medium hover:underline" style="color: #78BCFF;"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>

                            <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                            }
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>