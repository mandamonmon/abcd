<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
	
	$produk = mysqli_query($conn, "SELECT * FROM  foto WHERE id = '".$_GET['id']."'");
	if(mysqli_num_rows($produk) == 0){
	    echo '<script>window.location="data-image.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
</head>

<body>
    <!-- header -->
     <header>
        <div class="container">
        <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
        <ul>
		   <li><a href="index.php">Home</a></li>
           <li><a href="dashboard.php">Dashboard</a></li>
           <li><a href="profil.php">Profil</a></li>
           <li><a href="data-image.php">Data Foto</a></li>
           <li><a href="Keluar.php">Keluar</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Foto</h3>
            <div class="box">
    <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="judulFoto" class="input-control" placeholder="judulFoto" value="<?php echo $p->judulFoto ?>" required>
            <input type="text" name="deskripsiFoto" class="input-control" placeholder="deskripsiFoto" value="<?php echo $p->deskripsiFoto ?>" required>
            <input type="date" name="tglUnggah" class="input-control" placeholder="tglUnggah" value="<?php echo $p->tglUnggah ?>" required>
                   
                   <img src="foto/<?php echo $p->lokasiFile ?>" width="100px" />
				   <input type="hidden" name="foto" value="<?php echo $p->lokasiFile ?>" />
                   <input type="file" name="gambar" class="input-control">
                 
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					
					// data inputan dari form
					$judulFoto     = $_POST['judulFoto'];
					$deskripsiFoto     = $_POST['deskripsiFoto'];
					$tglUnggah = $_POST['tglUnggah'];
					$foto      = $_POST['lokasiFile'];
					
					// data gambar yang baru 
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];
					   
					//jika admin ganti gambar
					if($filename != ''){
						
						$type1 = explode('.', $filename);
					    $type2 = $type1[1];

                        $newname = 'foto'.time().'.'.$type2;
					
					    // menampung data format file yang diizinkan
					    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					
					  // validasi format file
					  if(!in_array($type2, $tipe_diizinkan)){
				        // jika format file tidak ada di dalam tipe diizinkan
				        echo '<script>alert("Format file tidak diizinkan")</script>';
						
					  }else{
						unlink('./foto/'.$foto); 
					    move_uploaded_file($tmp_name, './foto/'.$newname);
						$namagambar = $newname;  
					  }
					
					}else{
					   // jika admin tidak ganti gambar
					   $namagambar = $foto;
					   
					}
					
					//query update data produk
					$update = mysqli_query($conn, "UPDATE foto SET
										   tglUnggah          = '".$tglUnggah."',
										   judulFoto          = '".$judulFoto."',
										   deskripsiFoto   = '".$deskripsiFoto."',
										    id      = '".$p->id."' ");
					 if($update){
						echo '<script>alert("Ubah data berhasil")</script>';
					    echo '<script>window.location="data-image.php"</script>';
					 }else{
					    echo 'gagal'.mysqli_error($conn);
							   
						   }
			      }
			   ?>
        </div>
        </div>
    </div>
    
</body>
</html>