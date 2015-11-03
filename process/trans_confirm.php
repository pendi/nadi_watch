<?php 
	include "../koneksi.php";
	$id_order = $_POST['id_order'];

	$updateOrd = mysql_query("UPDATE orders SET status_order = 3 WHERE id_order='$id_order'");
	echo "<script>window.location = '../index.php?list=29&head=admin';</script>";
?>