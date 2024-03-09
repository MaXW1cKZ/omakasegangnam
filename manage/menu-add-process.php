<?php
$servername = "localhost";
$username = "root"; //ตามที่กำหนดให้
$password = ""; //ตามที่กำหนดให้
$dbname = "omakase";    //ตามที่กำหนดให้
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     if (isset($_GET['course_id'])) {
        $course_id = $_GET["course_id"];
        $menu_name = $_GET["menu_name"];
        $menu_detail = $_GET["menu_detail"];
        $menu_img = $_GET["menu_img"];
        if (strlen($menu_name) <= 2) {
          echo "alert('โปรดกรอกชื่อเมนูอย่างน้อย 3 ตัวอักษร')";
        } else if (strlen($menu_detail) <= 6) {
          echo "alert('โปรดกรอกชื่อเมนูอย่างน้อย 7 ตัวอักษร')";
        }else if (strlen($menu_img) <= 8) {
          echo "alert('โปรดกรอกชื่อเมนูอย่างน้อย 9 ตัวอักษร')";
        }else{
          $add_menu = "INSERT INTO menu(menu_name, menu_detail, menu_img) 
                        VALUES ('$menu_name', '$menu_detail', '$menu_img')";
          $deatil_menu = "INSERT INTO detail_course_menu(course_id, menu_name)
                        VALUES ('$course_id', '$menu_name')";
          if(($conn->query($add_menu) === true) and ($conn->query($deatil_menu) === true)){
            echo "<script>alert('การเพิ่มเมนูสำเร็จ')</script>";
            echo "<script>window.location.href = 'home-menu.php';</script>";
          }else{
            echo "<script>alert('การเพิ่มเมนูไม่สำเร็จ')</script>";
            echo "<script>window.location.href = 'menu-add.php';</script>";
          }
        }
      } else {
        echo "<script>alert('เกิดข้อผิดพลาด')</script>";
        echo "<script>window.location.href = 'menu-add.php';</script>";

      }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>