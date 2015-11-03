<?php 
	include "../koneksi.php";

	$id = $_POST['id'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$address = trim($_POST['address']);
	$telp = trim($_POST['telp']);
	$password = md5(trim($_POST['password']));

	$updateMember = mysql_query("UPDATE member SET email_member='$email',first_name_member='$first_name',last_name_member='$last_name',address_member='$address',telp_member='$telp',password='$password' WHERE id_member='$id'");

	echo "<script>window.location = '../index.php?list=1';</script>";
?>