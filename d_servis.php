<?php
//session_start();
//if(isset($_SESSION['username']) && isset($_SESSION['level'])){
include "koneksi.php";
//hapus
if(isset($_GET['kd_servis'])){
	$kode=$_GET['kd_servis'];
	$sql="delete from servis where kd_servis='$kode'";
	
	$query=mysqli_query($koneksi,$sql);
	echo "<script language='javascript'>
	alert('Servis has been deleted');
	document.location='v_servis.php';
	</script>";
	}else{
	echo "Data yang dihapus belum dipilih";
}
//}else{
//echo "<script language='javascript'>
//alert('Maaf anda tidak bisa mengakses !');
//document.location='index.php';
//</script>";
//}
?>