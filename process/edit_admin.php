<?php 
	include "../koneksi.php";

	$id = $_POST['id'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$level = trim($_POST['level']);
	$password = md5(trim($_POST['password']));

	$updateMember = mysql_query("UPDATE user SET email='$email',first_name='$first_name',last_name='$last_name',level='$level',password='$password' WHERE id='$id'");

	echo "<script>window.location = '../index.php?list=16&head=admin';</script>";
?>