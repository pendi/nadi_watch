<?php  
include "../koneksi.php";
$id = $_POST['id'];
$name = $_POST['name'];

$query = "UPDATE vendor SET name='$name' WHERE id='$id'";
$hasil = mysql_query($query);

if ($hasil) {
	// echo "<script>window.alert('Berhasil');</script>";
	echo "<script>window.location = '../index.php?list=25&head=admin';</script>";
} else {
	echo "<script>window.alert('Data Gagal Disimpan');</script>";
	echo "<script>window.location = 'view_product.php';</script>";
}

?>