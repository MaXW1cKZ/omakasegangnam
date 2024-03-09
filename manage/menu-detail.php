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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <title>View Menu</title>
  <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Lato", sans-serif;
    }

    body {
      background-color: #fff;
    }

    svg {
      width: 25px;
    }

    header {
      width: 1200px;
      max-width: 90%;
      margin: auto;
      display: grid;
      grid-template-columns: 50px 1fr 50px;
      grid-template-rows: 50px;
      justify-content: center;
      align-items: center;
      position: relative;
      z-index: 100;
    }

    header .logo {
      font-weight: bold;
    }

    header .menu {
      padding: 0;
      margin: 0;
      list-style: none;
      display: flex;
      justify-content: center;
      gap: 20px;
      font-weight: 500;
    }

    .container {
      margin: auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 50px;
    }

    .course {
      margin-top: 20px;
      background-color: #B4F7FF;
      border-radius: 10px;
      box-shadow: 0px 10px 10px rgba(0, 0, 0, .2);
      display: flex;
      max-width: 100%;
      overflow: hidden;
      width: 700px;
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .course h6 {
      opacity: .6;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .course h2 {
      letter-spacing: 1px;
      margin: 10px 0;
    }

    .preview {
      background-color: #FC9D4E;
      color: #fff;
      padding: 25px;
      width: 250px;
      display: flex;
      align-items: center;
    }

    .preview img {
      border-radius: 8px;
      width: 100%;
      height: 140px;
    }

    .pre-info {
      padding: 30px;
      position: relative;
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 7px;
    }

    .progress-wrapper {
      position: absolute;
      top: 30px;
      right: 30px;
      text-align: right;
      width: 150px;
    }

    .info {
      /* background-color: rgb(245, 242, 242); */
      border-radius: 10px;
      /* box-shadow: 0px 10px 10px rgba(0, 0, 0, .2); */
      width: 500px;
      padding: 20px;
    }

    .info h3 {
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">
      <a href="#" onclick="back()"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <ul class="menu">
      <li>View Menu</li>
    </ul>
    <div class="search">
      <i class="fa-solid fa-burger"></i>
    </div>
  </header>

  <?php
  if (isset($_GET['menu_name'])) {
    $menu_name = $_GET['menu_name'];
    $sql = "SELECT * FROM menu WHERE menu_name = '{$menu_name}'; ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
  ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Find the element with the id "menu_name" and set its value to the value of $row['menu_name']
          document.getElementById("menu-name").value = "<?php echo $row['menu_name']; ?>";
          document.getElementById("menu-detail").value = "<?php echo $row['menu_detail']; ?>";
          document.getElementById("menu-img").value = "<?php echo $row['menu_img']; ?>";

        });
      </script>
  <?php
    }
  }
  ?>

  <div class="container">
    <div class="course">
      <div class="preview">
        <img src="<?php echo $row['menu_img']; ?>" alt="">
      </div>
      <div class="pre-info">
        <h6 id="name"><?php echo $row['menu_name']; ?></h6>
        <p id="detail"><?php echo $row['menu_detail']; ?></p>
      </div>
    </div>



    <div class="info">
      <h3>รายละเอียด</h3>
      <div>
        <form action="" method="post">
          <label for="course-name">คอร์สเมนู</label><br>
          <?php
          $course_id = $_GET['course_id'];
          $choose = "SELECT *
            FROM course
            WHERE course_id = '{$course_id}';";
          $result = mysqli_query($conn, $choose);
          $row = mysqli_fetch_assoc($result);
          ?>
          <input name="course-name" readonly id="course_name" value=<?php echo $row['course_name'] ?> style="margin-bottom: 20px; padding: 10px;" class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
          <label for="menu-name">ชื่อเมนู</label><br>
          <input readonly="readonly" name="menu-name" id="menu-name" placeholder="ชื่อเมนู" style="margin-bottom: 10px; padding: 10px;" class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
          <label for="menu-detail">รายละเอียดเมนู</label><br>
          <textarea name="menu-detail" id="menu-detail" cols="55" rows="10" style="margin-top: 10px;  border: 1px solid #888; padding: 12px;"></textarea>
          <label for="menu-img">link รูปภาพเมนู</label><br>
          <input placeholder="ชื่อเมนู" id="menu-img" name="menu-img" style="padding: 10px;" class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
          <div style="display: flex; flex-direction: row; justify-content: flex-end; gap: 10px; margin-top: 10px;">
            <button id="updateContainer" style="padding: 10px; background-color: rgb(158, 251, 225); margin-top: 10px; border-radius: 10px; font-size: 16px;">ดูตัวอย่างเมนู</button>
            <button name="edit" id="edit" style="padding: 10px; background-color: rgb(255, 251, 121); margin-top: 10px; border-radius: 10px;">แก้ไข</button>
            <button name="delete" id="delete" style="padding: 10px; background-color: rgb(255, 182, 121); margin-top: 10px; border-radius: 10px;">ลบ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>


<script>
  function back() {
    window.location.href = 'home-menu.php';
  }

  function edit_menu() {
    var menuName = document.getElementById("menu-name").value;
    var menuDetail = document.getElementById("menu-detail").value;
    var menuImg = document.getElementById("menu-img").value;

    if (menuName.length <= 3) {
      alert("โปรดกรอกชื่อเมนูมากกว่า 3 ตัวอักษร");
    } else if (menuDetail.length <= 7) {
      alert("โปรดกรอกรายละเอียดเมนูมากกว่า 7 ตัวอักษร");
    } else if (menuImg.length <= 10) {
      alert("โปรดกรอกลิงค์รูปภาพเมนูมากกว่า 10 ตัวอักษร");
    } else {
      var url = "menu-edit.php?menu_name=" + menuName + "&menu_detail=" + menuDetail + "&menu_img=" + menuImg;
      window.location.href = url;
    }
  }

  var edit = document.getElementById("edit");
edit.addEventListener("click", (e) => {
  e.preventDefault();
  if (confirm('ยืนยันการอัพเดทรายละเอียดเมนูอาหาร?')) {
    edit_menu();
  }
});



  var deletemenu = document.getElementById("delete");
  deletemenu.addEventListener("click", (e) => {
    e.preventDefault();
    var menuName = document.getElementById("menu-name").value;
    console.log(menuName);
    
    if (confirm('ยืนยันการลบเมนูอาหาร?')){
    var url = "menu-delete.php?menu_name=" + menuName;
    window.location.href = url;
    }
  })




  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("updateContainer").addEventListener("click", function(event) {
      event.preventDefault();

      var menuName = document.getElementById("menu-name").value;
      var menuDetail = document.getElementById("menu-detail").value;
      var menuImg = document.getElementById("menu-img").value;

      document.querySelector('.course h6').textContent = menuName;
      document.querySelector('.course p').textContent = menuDetail;
      document.querySelector('.course img').src = menuImg;
    });
  });
</script>
  <?php
  // close connection
  mysqli_close($conn);
  ?>