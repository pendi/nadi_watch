<?php 
	include "../koneksi.php";

	$delete = mysql_query("DELETE FROM vendor WHERE id_vendor='$_POST[id]'");
	echo "<script>window.location = '../index.php?list=25&head=admin';</script>";
?>