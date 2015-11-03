<?php 
	include "../koneksi.php";

	$id_order = $_POST['id_order'];
	$id_cus = $_POST['id_cus'];
	$id_fare = $_POST['kecamatan'];

	$updateOrd = mysql_query("UPDATE orders SET id_tarif='$id_fare' WHERE id_order='$id_order'");
	echo "<script>window.location = '../index.php?list=23&id_cus=$id_cus&id_order=$id_order';</script>";

?>