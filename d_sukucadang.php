<?php
//session_start();
//if(isset($_SESSION['username']) && isset($_SESSION['level'])){
include "koneksi.php";
//hapus
if(isset($_GET['kd_sukucadang'])){
	$kode=$_GET['kd_sukucadang'];
	$sql="delete from sukucadang where kd_sukucadang='$kode'";
	
	$query=mysqli_query($koneksi,$sql);
	echo "<script language='javascript'>
	alert('Suku Cadang has been deleted');
	document.location='v_sukucadang.php';
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