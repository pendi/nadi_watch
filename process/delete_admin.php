<?php  
	include "../koneksi.php";
	mysql_query("DELETE FROM admin WHERE id_admin = '$_POST[id]'");
	echo "<script>window.location = '../index.php?list=9&head=admin';</script>";
?>