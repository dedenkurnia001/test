<?php
//session_start();
//if(isset($_SESSION['username']) && isset($_SESSION['level'])){
include "koneksi.php";
//hapus
if(isset($_GET['id_pelanggan'])){
	$kode=$_GET['id_pelanggan'];
	$sql="delete from pelanggan where id_pelanggan='$kode'";
	
	$query=mysqli_query($koneksi,$sql);
	echo "<script language='javascript'>
	alert('Pelanggan has been deleted');
	document.location='v_pelanggan.php';
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