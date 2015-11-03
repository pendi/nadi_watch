<?php 
	include "../koneksi.php";
	$name = $_POST['name'];

	$insert = mysql_query("INSERT INTO vendor(id_vendor,name_vendor,sale_vendor) VALUES(null,'$name','0')");

	if ($insert) {
		echo "<script>window.location = '../index.php?list=25&head=admin';</script>";
	} else {
		echo "<script>window.alert('Data Gagal Disimpan');</script>";
		echo "<script>window.location = '../index.php?list=25&head=admin';</script>";
	}
?>