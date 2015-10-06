<?php  
	include "../koneksi.php";
	session_start();
	$id = $_POST['id'];
	$act = $_POST['act'];
	$list = $_POST['list'];
	$password = md5($_POST['password']);

	$pass = mysql_query("SELECT password FROM user WHERE id ='$id'");
	$resultPass = mysql_fetch_array($pass);

	if ($password == $resultPass['password']) {
		if ($act == 'email') {
			$email = $_POST['email'];
			$que = mysql_query("SELECT email FROM user WHERE email='$email'");
			$data = mysql_num_rows($que);

			if ($data > 0) {
				echo "<script>window.alert('Email Anda Sudah Terdaftar');</script>";
				echo "<script>window.location = '../index.php?id=$id&list=17&head=admin&act=$act';</script>";
			} else {
				$query = "UPDATE user SET email='$email' WHERE id='$id'";
			}
		} elseif ($act == 'first') {
			$first_name = $_POST['first_name'];
			$query = "UPDATE user SET first_name='$first_name' WHERE id='$id'";
		} elseif ($act == 'last') {
			$last_name = $_POST['last_name'];
			$query = "UPDATE user SET last_name='$last_name' WHERE id='$id'";
		} elseif ($act == 'password') {
			$newpass = md5($_POST['newpass']);
			$newpass2 = md5($_POST['newpass2']);
			$query = "UPDATE user SET password='$newpass' WHERE id='$id'";
		}
	} else {
		echo "<script>window.alert('Password Anda Tidak Cocok');</script>";
		echo "<script>window.location = '../index.php?id=$id&list=$list&head=admin&act=$act';</script>";
	}

	$hasil = mysql_query($query);

	if ($hasil) {
		echo "<script>window.location = '../index.php?list=16&head=admin&act=$act';</script>";
	} else {
		echo "<script>window.alert('Data Gagal Disimpan');</script>";
		echo "<script>window.location = '../index.php?id=$id&list=$list&head=admin&act=$act';</script>";
	}
?>