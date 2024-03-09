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
    <meta name="viewport" content="width=ds, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $menu_name = $_GET['menu_name'];
    $menu_detail = $_GET['menu_detail'];
    $menu_img = $_GET['menu_img'];


    $sql = "UPDATE menu SET menu_name='$menu_name', menu_detail='$menu_detail' , menu_img='$menu_img' WHERE menu_name='$menu_name';";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('การอัพเดทเมนูสำเร็จ');</script>";
        echo "<script>window.location.href = 'home-menu.php';</script>";
    }else {
        echo "Error updating record: " . $conn->error;
    }
    ?>
</body>

</html>

<?php
// close connection
mysqli_close($conn);
?>