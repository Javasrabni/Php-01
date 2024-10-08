<?php
session_start();
include "Service/database.php";

if(isset($_SESSION['is_login'])) {
    header('location: dashboard.php');
}

if (isset($_POST['submitLogin'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($sql);

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['username'] = $data['username'];
        $_SESSION['is_login'] = false;

        sleep(3);

        header("location: dashboard.php");
    } else {
        echo "$username tidak ada";
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

    <p>LOGIN</p>
    <form action="login.php" method="POST">
        <input type="text" name="email">
        <input type="password" name="password">
        <button name="submitLogin">LogIn</button>
    </form>
</body>

</html>