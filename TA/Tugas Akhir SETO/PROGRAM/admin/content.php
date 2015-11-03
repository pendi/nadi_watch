<style type="text/css">
#list {
	width:inherit;
	border: 1px #03C solid;
}
#list th{
	background:#09C;
}
#list td .even {
	background:#0CF;
}
#list tr:hover {
	background:#3FC;
}
</style>
<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET['module']=='home'){
  echo "<div class='top_admin_box'><h2>Selamat Datang</h2></div>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
   
}

// Bagian Modul
elseif ($_GET['module']=='modul'){
  include "modul/mod_modul/modul.php";
}

// Bagian Kategori
elseif ($_GET['module']=='kategori'){
  include "modul/mod_kategori/kategori.php";
}

// Bagian Vendor
elseif ($_GET['module']=='vendor'){
  include "modul/mod_vendor/vendor.php";
}


// Bagian Produk
elseif ($_GET['module']=='produk'){
  include "modul/mod_produk/produk.php";
}


// Bagian Order
elseif ($_GET['module']=='order'){
  include "modul/mod_order/order.php";
}

// Bagian Order
elseif ($_GET['module']=='hubungi'){
  include "modul/mod_hubungi/hubungi.php";
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET['module']=='ongkoskirim'){
  include "modul/mod_ongkoskirim/ongkoskirim.php";
}

// Bagian Password
elseif ($_GET['module']=='password'){
  include "modul/mod_password/password.php";
}

// Bagian Review
elseif ($_GET['module']=='review'){
  include "modul/mod_review/review.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
