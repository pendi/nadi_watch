<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus status review
if ($module=='review' AND $act=='hapus'){
  mysql_query("DELETE FROM review_produk WHERE id_review='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
if ($module=='review' AND $act=='update'){
$sql = mysql_query("UPDATE review_produk SET nama_customer='$_POST[nama_customer]', status='$_POST[status]', isi='$_POST[isi]' WHERE id_review='$_POST[id_review]'");
  if(!$sql) {
	"Error :";
	}
	else{
  header('location:../../media.php?module='.$module);
}
  }
?>