<?php
include "../koneksi.php";
session_start();

$email = trim($_POST['email']);
$password = md5(trim($_POST['password']));

$query	= "SELECT * FROM user WHERE email='$email' AND password='$password'";
$sql	= mysql_query($query);
$numrow	= mysql_num_rows($sql);
$data = mysql_fetch_array($sql);

if($numrow > 0) {
	$_SESSION['user'] = $data;
	header("Location:../index.php?list=4&act=admin&head=admin");
} else {
	echo "<script>window.alert('Periksa Kembali Email dan Password Anda');</script>";
	echo "<script>window.location = '../index.php?list=5&head=home';</script>";
}
?>