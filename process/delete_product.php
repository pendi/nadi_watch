<?php  
include "../koneksi.php";
mysql_query("DELETE FROM product WHERE id_product = '$_POST[id]'");
echo "<script>window.location = '../index.php?list=8&head=admin';</script>";
?>