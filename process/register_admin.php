<?php  
	include "../koneksi.php";

	$email = trim($_POST['email']);
	$first_name = strtolower(trim($_POST['first_name']));
	$last_name = strtolower(trim($_POST['last_name']));
	$password = md5(trim($_POST['password']));
	$status = $_POST['status'];

	$que = mysql_query("SELECT email_admin FROM admin WHERE email_admin='$email'");
	$data = mysql_num_rows($que);

	if ($data > 0) {
		echo "<script>window.alert('Email Anda Sudah Terdaftar');</script>";
		echo "<script>window.location = '../index.php?list=14&head=admin';</script>";
	} else {
		$query = "INSERT INTO admin(id_admin,email_admin,first_name_admin,last_name_admin,password,level)
				VALUES(NULL,'$email','$first_name','$last_name','$password','$status')";
	}

	$hasil = mysql_query($query);

	if ($hasil) {
		echo "<script>window.location = '../index.php?list=9&head=admin';</script>";
	} else {
		echo "<script>window.alert('Data Gagal Disimpan');</script>";
		echo "<script>window.location = '../index.php?list=14&head=admin';</script>";
	}
?>