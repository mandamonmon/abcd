<?php
session_start();
include 'db.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
    echo '<script>window.location="login.php"</script>';
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="Keluar.php">Logout</a></li>
            </ul>
        </div>
    </header>
    
    <div class="section">
        <div class="container">
           <h3>Tambah Data Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($_SESSION['a_global']) ? $_SESSION['a_global']->id : ''; ?>">
                    <input type="text" name="judulFoto" class="input-control" placeholder="Judul Foto" required>
                    <input type="text" name="deskripsiFoto" class="input-control" placeholder="Deskripsi Foto">
                    <input type="date" name="tglUnggah" class="input-control" placeholder="Tanggal Unggah" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $id = isset($_SESSION['a_global']) ? mysqli_real_escape_string($conn, $_SESSION['a_global']->id) : '';
                    $judulFoto = mysqli_real_escape_string($conn, $_POST['judulFoto']);
                    $deskripsiFoto = mysqli_real_escape_string($conn, $_POST['deskripsiFoto']);
                    $tglUnggah = mysqli_real_escape_string($conn, $_POST['tglUnggah']);

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    $type1 = explode('.', $filename);
                    $type2 = end($type1);
                    $newname = 'foto' . time() . '.' . $type2;

                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    if (!in_array($type2, $tipe_diizinkan)) {
                        echo '<script>alert("Format file tidak diizinkan")</script>';
                    } else {
                        move_uploaded_file($tmp_name, './foto/' . $newname);
                        $insert = mysqli_query($conn, "INSERT INTO foto  VALUES (NULL,'$judulFoto','$deskripsiFoto','$tglUnggah','$newname') ");
                        if ($insert) {
                           $id; 
                            
                            echo '<script>alert("Tambah Foto berhasil")</script>';
                            echo '<script>window.location="data-image.php"</script>';
                        } else {
                            echo 'Gagal menambahkan foto: ' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
