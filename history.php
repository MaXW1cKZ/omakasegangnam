    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    $cus_id = $_SESSION["cus_id"];
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
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <title>ประวัติการจอง</title>
        <style>
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

            .content {
                padding: 40px 100px;
            }

            .dis {
                display: flex;
                justify-content: space-between;
                margin-bottom: 30px;
                align-items: center;
                /* padding: 10px; */
            }


            .bg-modal {
                background-color: rgba(0, 0, 0, 0.8);
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                display: none;
                justify-content: center;
                align-items: center;
            }

            .modal-contents {
                height: 300px;
                width: 500px;
                background-color: white;
                text-align: center;
                padding: 20px;
                position: relative;
                border-radius: 4px;
            }

            input {
                margin: 15px auto;
                display: block;
                width: 50%;
                padding: 8px;
                border: 1px solid gray;
            }

            .close {
                position: absolute;
                top: 0;
                right: 10px;
                font-size: 42px;
                color: #333;
                transform: rotate(45deg);
                cursor: pointer;

                &:hover {
                    color: #666;
                }
            }

            view-link {
                text-decoration: none;
            }

            .view-link:hover {
                border-bottom: 1px solid #72f2fd;
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
                    <!-- <li class="nav__item"><a href="#" class="nav__link">Reservation</a></li> -->
                    <!-- <li class="nav__item"><a href="history.php" class="nav__link">History</a></li> -->
                    <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
                </ul>
            </nav>
            <ion-icon name="menu-outline" class="header__toggle" id="toggle-menu"></ion-icon>
        </header>

        <div class="content">
            <div class="dis">
                <div>
                    <h3 style="font-size: 25px; font-weight: 15px">ประวัติการจอง</h3>
                    <p sty>รายละเอียดการจองทั้งหมด สถานะการจอง</p>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr style="background-color: #72f2fd">
                            <th scope="col" class="px-6 py-3">Booking ID</th>
                            <th scope="col" class="px-6 py-3">fistname</th>
                            <th scope="col" class="px-6 py-3">lastname</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">view</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT booking.timestamp,booking.booking_id, customers.first_name, customers.last_name, booking.booking_date, booking.total_price, booking.booking_status
            FROM booking 
            JOIN customers ON booking.cus_id = customers.cus_id WHERE booking.cus_id = '$cus_id' ORDER BY  booking.timestamp DESC;";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['booking_id'];
                                echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">' .
                                    '<td class="px-6 py-4">' . $row['booking_id'] . '</td>' .
                                    '<td class="px-6 py-4">' . $row['first_name'] . '</td>' .
                                    '<td class="px-6 py-4">' . $row['last_name'] . '</td>' .
                                    '<td class="px-6 py-4">' . $row['booking_date'] . '</td>' .
                                    '<td class="px-6 py-4">' . $row['total_price'] . '</td>' .
                                    '<td class="px-6 py-4"><div style="width: 80px; background-color: #ffe946; border-radius:20px; text-align: center;">' . $row['booking_status'] . '</td>';

                                // Check if booking status is "booking" before displaying the view link
                                if ($row['booking_status'] == 'booking' || $row['booking_status'] == 'checked') {
                                    echo '<td class="px-6 py-4">' .
                                        '<a href="booking_details.php?booking_id=' . $row['booking_id'] .  '" class="view-link">view</a>
                                        </td>';
                                } else {
                                    echo '<td class="px-6 py-4">Not available</td>';
                                }

                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>

        </script>
    </body>

    </html>