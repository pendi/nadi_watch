<?php 
	include "../koneksi.php";

	$id_order = $_POST['id_order'];
	$rek_receiver = $_POST['rek_receiver'];
	$name_receiver = $_POST['name_receiver'];
	$rek_sender = $_POST['rek_sender'];
	$name_sender = $_POST['name_sender'];
	$date_payment = $_POST['date_payment'];
	$payment = $_POST['payment'];
	$fileSize = $_FILES["image"]["size"];


	if((!file_exists("../image/confirm"))&&(!is_dir("../image/confirm")))
	{
		$folder = mkdir("../image/confirm");
	}

	$tmp_name = $_FILES["image"]["tmp_name"];
	$name_img = "../image/confirm/".$_FILES["image"]["name"];

	if ($fileSize > 0) {
		move_uploaded_file($tmp_name, $name_img);
		$insertConfirm = mysql_query("INSERT INTO confirm(id_confirm,rek_receiver,name_receiver,rek_sender,name_sender,date_payment,payment,image_confirm,id_order)
								VALUES(null,'$rek_receiver','$name_receiver','$rek_sender','$name_sender','$date_payment','$payment','$name_img','$id_order')");
	} else {
		$insertConfirm = mysql_query("INSERT INTO confirm(id_confirm,rek_receiver,name_receiver,rek_sender,name_sender,date_payment,payment,image_confirm,id_order)
								VALUES(null,'$rek_receiver','$name_receiver','$rek_sender','$name_sender','$date_payment','$payment','','$id_order')");
	}

	//$insertConfirm = mysql_query("INSERT INTO confirm(id,rek_receiver,name_receiver,rek_sender,name_sender,date_payment,payment,invoice)
								//VALUES(null,'$rek_receiver','$name_receiver','$rek_sender','$name_sender','$date_payment','$payment','$invoice')");

	if ($insertConfirm) {
		$updateOrd = mysql_query("UPDATE orders SET status_order = 2 WHERE id_order = '$id_order'");

		if(isset($_SESSION['member'])) {
			echo "<script>window.location = '../index.php?list=31';</script>";
		} else {
			echo "<script>window.location = '../index.php?list=31&kdTrs=$id_order';</script>";
		}
	}
?>