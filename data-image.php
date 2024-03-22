<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
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
        <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="dashboard.php">Dashboard</a></li>
           <li><a href="data-image.php">Data Foto</a></li>
           <li><a href="Keluar.php">Logout</a></li>
        </ul>
        </div>
    </header>
        
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Data Galeri Foto</h3>
            <div class="box">
                <p><a href="tambah-image.php"><h4>Tambah Data</h4></a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                           <th width="60px">No</th>
                           <th>Lokasi File</th>
                           <th>Judul Foto</th>
                           <th>Deskripsi</th>
                           <th>Tanggal Unggah</th>
                           <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						    $no = 1;
							$user = $_SESSION['a_global']->id;
                            $foto = mysqli_query($conn, "SELECT * FROM foto WHERE id = '$user' ");
							if(mysqli_num_rows($foto) >0 ){
							while($row = mysqli_fetch_array($foto)){
						?>
                        <tr>
                           <td><?php echo $no++ ?></td>
                           <td><a href="foto/<?php echo $row['lokasiFile']?>" target="_blank"><img src="foto/<?php echo $row['lokasiFile']?>" width="50px"></a></td>
                           <td><?php echo $row['judulFoto'] ?></td>
                           <td><?php echo $row['deskripsiFoto']?></td>
                           <td><?php echo $row['tglUnggah'] ?></td>
                           <td>
                              <a href="edit-image.php?id=<?php echo $row['id'] ?>">Edit</a> || 
                              <a href="proses-hapus.php?idp=<?php echo $row['id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                           </td>
                        </tr>
                        <?php }}else{ ?>
                             <tr>
                                <td colspan="8">Tidak ada data</td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>