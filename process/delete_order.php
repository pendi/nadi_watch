<?php 
	session_start();
	include "../koneksi.php";

	$id_order = $_GET['id_order'];

	if (isset($_GET['act'])) {
		$deleteOrd = mysql_query("UPDATE orders SET status_order = '4' WHERE id_order='$id_order'");
	} else {
		$deleteOrd = mysql_query("UPDATE orders SET status_order = '5' WHERE id_order='$id_order'");
	}

	if(isset($_SESSION['member'])) {
		echo "<script>window.location = '../index.php?list=31';</script>";
	} else {
		echo "<script>window.location = '../index.php?list=31&kdTrs=$id_order';</script>";
	}
	
?>