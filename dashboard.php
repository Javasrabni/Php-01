<?php 
    SESSION_START();

    // if(isset($_SESSION['is_login']) === false) {
    //     header('location: home.php');
    // }

    // if(isset($_POST['LogOut'])) {
    //     session_unset();
    //     session_destroy();
    //     header('location: home.php');
    // }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah file sudah di-upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];

        // Cek tipe file, hanya izinkan gambar
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($imageExt), $allowedExt)) {
            // Tentukan lokasi penyimpanan gambar
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
            }

            $imageNewName = uniqid('', true) . '.' . $imageExt;
            $imageDestination = $uploadDir . $imageNewName;

            // Pindahkan file ke folder uploads
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Kode untuk menyimpan data ke database
                echo "Gambar berhasil di-upload dengan nama: $imageNewName dan disimpan di: $imageDestination.";
            } else {
                echo "Terjadi kesalahan saat mengupload gambar.";
            }
        } else {
            echo "Tipe file tidak diperbolehkan. Hanya file JPG, JPEG, PNG, dan GIF.";
        }
    } else {
        echo "Tidak ada file yang di-upload atau terjadi kesalahan.";
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
    <h1>DASHBOARD</h1>

    <p>Halo selamat datang kembali, <?= $_SESSION['username'] ?></p>

    <!-- <form action="dashboard.php" method="POST">
        <button name="LogOut">LogOut</button>
    </form> -->

    <form action="dashboard.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <?php
    $directory = 'uploads/';
    $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    foreach ($images as $image) {
        echo '<div>';
        echo '<img src="' . $image . '" width="200" alt="Uploaded Image">';
        echo '</div>';
    }
    ?>

</body>
</html>