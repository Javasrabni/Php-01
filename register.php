<?php
session_start();
include "Service/database.php";

if(isset($_SESSION['is_login'])) {
    header('location: dashboard.php');
}

if (isset($_POST["submitRegister"])) {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES('$username', '$password')";
    
    $Status_message = "";

    
    if ($db->query($sql)) {
        $Status_message = "Register Berhasil";
        header("location: login.php");
        sleep(3);
    } else {
        $Status_message = "Register Gagal";
    }
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
    <?php include "Comp/header.html" ?>

    <?php echo $Status_message ?>

    <p>REGISTER</p>
    <form action="register.php" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button name="submitRegister">SignUp</button>
    </form>
</body>

</html>