<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus vendor
if ($module=='vendor' AND $act=='hapus'){
  mysql_query("DELETE FROM vendor WHERE id_vendor='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input vendor
elseif ($module=='vendor' AND $act=='input'){
  $vendor_seo = seo_title($_POST['nama_vendor']);
  mysql_query("INSERT INTO vendor(nama_vendor,seo) VALUES('$_POST[nama_vendor]','$vendor_seo')");
  header('location:../../media.php?module='.$module);
}

// Update vendor
elseif ($module=='vendor' AND $act=='update'){
  $vendor_seo = seo_title($_POST['nama_vendor']);
  mysql_query("UPDATE vendor SET nama_vendor = '$_POST[nama_vendor]', seo='$vendor_seo' WHERE id_vendor = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
