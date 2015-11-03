<?php  
include "../koneksi.php";

$email = trim($_POST['email']);
$first_name = strtolower(trim($_POST['first_name']));
$last_name = strtolower(trim($_POST['last_name']));
$address = trim($_POST['address']);
$telp = trim($_POST['telp']);
$password = md5(trim($_POST['password']));

$que = mysql_query("SELECT email_member FROM member WHERE email_member='$email'");
$data = mysql_num_rows($que);

if ($data > 0) {
	echo "<script>window.alert('Email Anda Sudah Terdaftar');</script>";
	echo "<script>window.location = '../index.php?list=3&head=home';</script>";
} else {
	$query = "INSERT INTO member(id_member,email_member,first_name_member,last_name_member,address_member,telp_member,password) VALUES(NULL,'$email','$first_name','$last_name','$address','$telp','$password')";
}

$hasil = mysql_query($query);

if ($hasil) {
	echo "<script>window.location = '../index.php?list=2&head=home';</script>";
} else {
	echo "<script>window.alert('Data Gagal Disimpan');</script>";
	echo "<script>window.location = 'view_admin.php';</script>";
}
?>