<?php

   include 'db.php';
      
   if(isset($_GET['idp'])){
	   $foto = mysqli_query($conn, "SELECT lokasiFile FROM foto WHERE id = '".$_GET['idp']."' ");
	   $p = mysqli_fetch_object($foto);
	   
	   unlink('./foto/'.$p->lokasiFile);
	   
	  $delete = mysqli_query($conn, "DELETE FROM foto WHERE id = '".$_GET['idp']."' ");
	  echo '<script>window.location="data-image.php"</script>';
   }

?>