<?php 
	include "../koneksi.php";

	$id = $_POST['id'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$level = trim($_POST['level']);
	$password = md5(trim($_POST['password']));

	$updateMember = mysql_query("UPDATE admin SET email_admin='$email',first_name_admin='$first_name',last_name_admin='$last_name',level='$level',password='$password' WHERE id_admin='$id'");

	echo "<script>window.location = '../index.php?list=16&head=admin';</script>";
?>