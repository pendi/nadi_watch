<?php
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus hubungi
if ($module=='hubungi' AND $act=='hapus'){
  mysql_query("DELETE FROM kontak WHERE id_kontak='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
?>
