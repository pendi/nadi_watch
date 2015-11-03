<?php
include "../koneksi.php";
session_start();

if(!isset($_SESSION['transaksi'])){
    $idt = date("YmdHis");
    $_SESSION['transaksi'] = $idt;
}
$idt = $_SESSION['transaksi'];

$email = trim($_POST['email']);
$password = md5(trim($_POST['password']));

$query	= "SELECT * FROM member WHERE email_member='$email' AND password='$password'";
$sql	= mysql_query($query);
$numrow	= mysql_num_rows($sql);
$data = mysql_fetch_array($sql);


if($numrow > 0) {
	$_SESSION['member'] = $data;
	$selectSess = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
	$sessionRow = mysql_num_rows($selectSess);
	if ($sessionRow == 0) {
		header("Location:../index.php?list=1&head=home");
	} else {
		$id_order = $_POST['id_order'];
		header("Location:../index.php?list=21&head=home&id_order=$id_order");
	}
} else {
	echo "<script>window.alert('Periksa Kembali Email dan Password Anda');</script>";
	echo "<script>window.location = '../index.php?list=2&head=home';</script>";
}
?>