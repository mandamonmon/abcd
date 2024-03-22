<?php
	include 'db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">WEB GALERI FOTO</a></h1>
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="galeri.php">Galeri</a></li>
           <li><a href="registrasi.php">Registrasi</a></li>
           <li><a href="login.php">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Registrasi Akun</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
                   <input type="text" name="username" placeholder="Username" class="input-control" required>
                   <input type="text" name="password" placeholder="Password" class="input-control" required>
                   <input type="text" name="email" placeholder="E-mail" class="input-control" required>
                   <input type="text" name="alamat" placeholder="Alamat" class="input-control" required>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama = ucwords($_POST['nama']);
					   $username = $_POST['username'];
					   $password = $_POST['password'];
					   $email = $_POST['email'];
					   $alamat = ucwords($_POST['alamat']);
					   
					   $insert = mysqli_query($conn, "INSERT INTO user VALUES (
					                        null,
											'".$nama."',
											'".$username."',
											'".$password."',
											'".$email."',
											'".$alamat."')
											
											");
						if($insert){
							echo '<script>alert("Registrasi berhasil")</script>';
							echo '<script>window.location="login.php"</script>';
						}else{
						    echo 'gagal '.mysqli_error($conn);
						}
						
					   }
			   ?>
            </div>
            
            </div>
        </div>
        </div>
    </div>
    
   