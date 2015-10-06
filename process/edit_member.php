<?php 
	include "../koneksi.php";

	$id = $_POST['id'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$address = trim($_POST['address']);
	$telp = trim($_POST['telp']);
	$password = md5(trim($_POST['password']));

	$updateMember = mysql_query("UPDATE member SET email='$email',first_name='$first_name',last_name='$last_name',address='$address',telp='$telp',password='$password' WHERE id='$id'");

	echo "<script>window.location = '../index.php?list=1';</script>";
?>