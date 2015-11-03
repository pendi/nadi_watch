<?php
	include "../koneksi.php";

	$id_order = $_POST['id_order'];
	$id_cus = $_POST['id_cus'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$address = trim($_POST['address']);
	$telp = trim($_POST['telp']);
	$time = date("Y-m-d");

	$encript = md5($first_name);
	$regex = preg_replace("/[^A-Za-z]/", '', $encript);
	$alfa = substr($regex, 0, 5);
	$kode = strtoupper($alfa);

	$kdauto = mysql_query("SELECT max(id_cus) AS last FROM customer WHERE id_cus LIKE '$kode%'");
	$result = mysql_fetch_array($kdauto);
	$lastNoCus = $result['last'];
	$lastNoUrut = substr($lastNoCus, 5, 3);
	$nextNoUrut = $lastNoUrut + 1;
	$nextNoCus = $kode.sprintf('%03s', $nextNoUrut);

	if (empty($id_cus)) {
		$update = mysql_query("UPDATE orders SET id_cus='$nextNoCus' WHERE id_order='$id_order'");
		if ($update) {
			$query = "INSERT INTO customer(id_cus,email_cus,first_name_cus,last_name_cus,address_cus,telp_cus,created_time_cus)
						VALUES('$nextNoCus','$email','$first_name','$last_name','$address','$telp','$time')";
			$hasil = mysql_query($query);
			if ($hasil) {
				echo "<script>window.location = '../index.php?list=36&id_cus=$nextNoCus&id_order=$id_order';</script>";
			}
		}
	} else {
		$selectMember = mysql_query("SELECT * FROM member WHERE id_member = '$id_cus'");
		$memberRow = mysql_num_rows($selectMember);
		if ($memberRow > 0) {
			$update = mysql_query("UPDATE orders SET id_cus='$nextNoCus',id_member='$id_cus' WHERE id_order='$id_order'");
			$updateCus = mysql_query("INSERT INTO customer(id_cus,email_cus,first_name_cus,last_name_cus,address_cus,telp_cus,created_time_cus)
						VALUES('$nextNoCus','$email','$first_name','$last_name','$address','$telp','$time')");
			echo "<script>window.location = '../index.php?list=36&id_cus=$nextNoCus&id_order=$id_order';</script>";
		} else {
			$updateCus = mysql_query("UPDATE customer SET email_cus='$email', first_name_cus='$first_name', last_name_cus='$last_name', address_cus='$address', telp_cus='$telp' WHERE id_cus='$id_cus'");
			echo "<script>window.location = '../index.php?list=36&id_cus=$id_cus&id_order=$id_order';</script>";
		}
	}
?>