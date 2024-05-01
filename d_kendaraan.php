<?php
//session_start();
//if(isset($_SESSION['username']) && isset($_SESSION['level'])){
include "koneksi.php";
//hapus
if(isset($_GET['no_polisi'])){
	$kode=$_GET['no_polisi'];
	$sql="delete from kendaraan where no_polisi='$kode'";
	
	$query=mysqli_query($koneksi,$sql);
	echo "<script language='javascript'>
	alert('Kendaraan has been deleted');
	document.location='v_kendaraan.php';
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