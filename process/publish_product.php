<?php  
include "koneksi.php";
$query = mysql_query("SELECT * FROM product WHERE id_product = '$_GET[id_product]'");
$data = mysql_fetch_array($query);

if ($data['status']==1) {
	$sql = mysql_query("UPDATE product SET status = 2 WHERE id_product = '$_GET[id_product]'");
} elseif ($data['status']==2) {
	$sql = mysql_query("UPDATE product SET status = 1 WHERE id_product = '$_GET[id_product]'");
}

if ($sql) {
	echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
}
?>