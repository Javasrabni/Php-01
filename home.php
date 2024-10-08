<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  include "Comp/header.html"?>
    <form action="login.php" method="POST">
        <input type="text" name="email">
        <input type="password" name="password" >
        <button name="submitLogin">LogIn</button>
    </form>
</body>
</html>