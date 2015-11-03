<?php
session_start();
include "../config/koneksi.php";
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$username = antiinjection($_POST['username']);
$pass     = antiinjection(md5($_POST['password']));

$login=mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
	include_once $_SERVER['DOCUMENT_ROOT'] . '/TOKO/TA/TA/config/securimage/securimage.php';
	$securimage = new Securimage();
	if ($securimage->check($_POST['captcha_code']) == false) {
		// the code was incorrect
		// you should handle the error so that the form processor doesn't continue

		// or you can use the following code if there is no validation or you do not know how
		echo "<center>LOGIN Gagal<br/>Kode Captcha salah</center>";
		echo "Silahkan <a href='javascript:history.go(-1)'>ulangi lagi.</a>";
		exit;
	}
	else {  
		@session_register("namauser");
		@session_register("namalengkap");
		@session_register("passuser");
		@session_register("leveluser");

		$_SESSION['namauser']     = $r['username'];
		$_SESSION['namalengkap']  = $r['nama_lengkap'];
		$_SESSION['passuser']     = $r['password'];
		$_SESSION['leveluser']    = $r['level'];
		echo "<center>LOGIN Sukses<br/>Anda akan diarahkan ke halaman admin.</center>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=media.php?module=home'>";
	}
}
else{
  echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center><font color='red'LOGIN GAGAL!</font> <br> 
        Username atau Password Anda tidak benar.<br>";
  echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'>";
}
?>
