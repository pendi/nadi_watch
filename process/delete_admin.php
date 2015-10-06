<?php  
	include "../koneksi.php";
	mysql_query("DELETE FROM user WHERE id = '$_POST[id]'");
	echo "<script>window.location = '../index.php?list=9&head=admin';</script>";
?>