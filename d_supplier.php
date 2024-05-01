<?php
//session_start();
//if(isset($_SESSION['username']) && isset($_SESSION['level'])){
include "koneksi.php";
//hapus
if(isset($_GET['id_supplier'])){
	$kode=$_GET['id_supplier'];
	$sql="delete from supplier where id_supplier='$kode'";
	
	$query=mysqli_query($koneksi,$sql);
	echo "<script language='javascript'>
	alert('Supplier has been deleted');
	document.location='v_supplier.php';
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