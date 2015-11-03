<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus produk
if ($module=='produk' AND $act=='hapus'){
  mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='produk' AND $act=='input'){
	if ($_POST['nama_produk']=="") {
		 header('location:../../media.php?module=produk&act=tambahproduk&f=nama');
	}
	elseif($_POST['harga']==""){
		header('location:../../media.php?module=produk&act=tambahproduk&f=harga');
	}
	elseif($_POST['stok']==""){
		header('location:../../media.php?module=produk&act=tambahproduk&f=stok');
	}
	else {
		$lokasi_file    = $_FILES['gambar']['tmp_name'];
		$tipe_file      = $_FILES['gambar']['type'];
		$nama_file      = $_FILES['gambar']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		$produk_seo      = seo_title($_POST[nama_produk]);

		// Apabila ada gambar yang diupload
		if (!empty($lokasi_file)){
			UploadImage($nama_file_unik);
			$sql = mysql_query("INSERT INTO produk(nama_produk,
													seo,
													id_kategori,
													id_vendor,
													h_awal,
													harga,
													ongkir,
													dimensi,
													berat,
													stok,
													promo,
													soon,
													deskripsi,
													tgl_masuk,
													gambar) 
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
								   '$_POST[vendor]',
								   '$_POST[h_awal]',
                                   '$_POST[harga]',
								   '$_POST[ongkir]',
								   '$_POST[dimensi]',
								   '$_POST[berat]',
                                   '$_POST[stok]',
								   '$_POST[promo]',
								   '$_POST[soon]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang',
                                   '$nama_file_unik')");
			if (!$sql) {
				"Error (no picture):".mysql_error();
			}
		}
		else{
			$sql = mysql_query("INSERT INTO produk(nama_produk,
											seo,
                                    id_kategori,
									id_vendor,
									h_awal,
                                    harga,
									ongkir,
									dimensi,
									berat,
                                    stok,
									promo,
									soon,
                                    deskripsi,
                                    tgl_masuk) 
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
								   '$_POST[vendor]',
								   '$_POST[h_awal]',
                                   '$_POST[harga]',
								   '$_POST[ongkir]',
								   '$_POST[dimensi]',
								   '$_POST[berat]',
                                   '$_POST[stok]',
								   '$_POST[promo]',
								   '$_POST[soon]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang')");
			if (!$sql) {
				"Error (picture):".mysql_error();
			}
		}
		header('location:../../media.php?module='.$module);
	}
}

// Update produk
elseif ($module=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['gambar']['tmp_name'];
  $tipe_file      = $_FILES['gambar']['type'];
  $nama_file      = $_FILES['gambar']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    $sql = mysql_query("UPDATE produk SET nama_produk 	= '$_POST[nama_produk]',
                                   seo  		= '$produk_seo', 
                                   id_kategori 	= '$_POST[kategori]',
								   id_vendor	= '$_POST[vendor]',
								   h_awal		= '$_POST[h_awal]',
                                   harga       	= '$_POST[harga]',
								   ongkir		= '$_POST[ongkir]',
								   dimensi		= '$_POST[dimensi]',
								   berat		= '$_POST[berat]',
                                   stok        	= '$_POST[stok]',
								   promo		= '$_POST[promo]',
								   soon			= '$_POST[soon]',
                                   deskripsi   	= '$_POST[deskripsi]'
                             WHERE id_produk   	= '$_POST[id]'");
  if (!$sql) {
		"Error (no picture):".mysql_error();
	}
  }
  else{
    UploadImage($nama_file_unik);
    $sql = mysql_query("UPDATE produk SET nama_produk 	= '$_POST[nama_produk]',
                                   seo  		= '$produk_seo', 
                                   id_kategori 	= '$_POST[kategori]',
								   id_vendor	= '$_POST[vendor]',
								   h_awal		= '$_POST[h_awal]',
                                   harga       	= '$_POST[harga]',
								   ongkir		= '$_POST[ongkir]',
								   dimensi		= '$_POST[dimensi]',
								   berat		= '$_POST[berat]',
                                   stok        	= '$_POST[stok]',
								   promo		= '$_POST[promo]',
								   soon			= '$_POST[soon]',
                                   deskripsi   	= '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
  if (!$sql) {
		"Error (picture):".mysql_error();
	}
  }
  header('location:../../media.php?lokasi='.$nama_file_unik.'&module='.$module);
}
?>
