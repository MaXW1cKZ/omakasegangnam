<?php
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    
    //database connection
    $conn = mysqli_connect("localhost","root","","omakase");

    
    $sql = "INSERT INTO customers(first_name, last_name, phone, email,username, password)
            VALUES ('$first_name','$last_name','$phone','$email','$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: login.php");
    }else{
        echo("error" . mysqli_error($conn));
    }
?>